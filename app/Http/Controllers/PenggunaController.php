<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use Hash;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $title = "Pengguna";
        $user = User::latest()->get();

        return view('admin.pengguna.index', compact('title', 'user'));
    }

    public function create()
    {
        $title = "Tambah Pengguna";
        $level = ['Admin', 'Pelanggan'];

        return view('admin.pengguna.create', compact('title', 'level'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,level',
            'password' => 'required',
        ]);
        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = 'Admin';
        $user->save();

        if ($user) {
            return redirect()->route('pengguna.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Pengguna Berhasil Ditambahkan');
        } else {
            return redirect()->route('pengguna.index')->with('status', 'danger')->with('status', 'Gagal')->with('message', 'Pengguna Gagal Ditambahkan');
        }
    }

    public function edit($id)
    {
        $title = "Edit Pengguna";
        $user = User::find($id);
        $level = ['Admin', 'Pelanggan'];

        return view('admin.pengguna.edit', compact('title', 'user', 'level'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
        ]);

        $user = User::find($id);
        $user->nama = $request->nama;
        $user->email = $request->email;

        // Update password jika diisi
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Jika level pengguna adalah 'Siswa', perbarui data siswa yang terkait
        if ($user->level == 'Siswa') {
            $siswa = Siswa::where('email', $user->email)->first(); // Ambil siswa berdasarkan email
            if ($siswa) {
                $siswa->nama = $request->nama;
                $siswa->email = $request->email;
                // Update password jika diisi
                if ($request->password) {
                    $siswa->password = Hash::make($request->password);
                }
                $siswa->save();
            }
        }

        if ($user) {
            return redirect()->route('pengguna.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Pengguna Berhasil Diubah');
        } else {
            return redirect()->route('pengguna.index')->with('status', 'danger')->with('status', 'Gagal')->with('message', 'Pengguna Gagal Diubah');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('pengguna.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Pengguna Berhasil Dihapus');
        } else {
            return redirect()->route('pengguna.index')->with('status', 'danger')->with('status', 'Gagal')->with('message', 'Pengguna Gagal Dihapus');
        }
    }
}
