<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WaliKelasController extends Controller
{
    public function index()
    {
        $walikelas = WaliKelas::latest()->get();
        $title = 'Wali Kelas';
        return view('admin.walikelas.index', compact('title', 'walikelas'));
    }

    public function create()
    {
        $title = 'Tambah Walas';
        return view('admin.walikelas.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:walikelas',
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:walikelas',
            'password' => 'required',
        ]);

        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = 'Walas';
        $user->save();

        $walikelas = new WaliKelas();
        $walikelas->user_id = $user->id;
        $walikelas->nip = $request->nip;
        $walikelas->nama = $request->nama;
        $walikelas->kelas = $request->kelas;
        $walikelas->jenis_kelamin = $request->jenis_kelamin;
        $walikelas->alamat = $request->alamat;
        $walikelas->email = $request->email;
        $walikelas->password = Hash::make($request->password);
        $walikelas->save();

        if ($walikelas && $user) {
            return redirect()->route('walas.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Wali Kelas Berhasil Ditambahkan');
        } else {
            return redirect()->route('walas.index')->with('status', 'danger')->with('title', 'Gagal')->with('message', 'Wali Kelas Gagal Ditambahkan');
        }
    }

    public function edit($id)
    {
        $walikelas = WaliKelas::find($id);
        $title = 'Edit Walas';
        return view('admin.walikelas.edit', compact('title', 'walikelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|unique:walikelas,nip,' . $id,
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
        ]);

        $walikelas = WaliKelas::find($id);
        $walikelas->nip = $request->nip;
        $walikelas->nama = $request->nama;
        $walikelas->kelas = $request->kelas;
        $walikelas->jenis_kelamin = $request->jenis_kelamin;
        $walikelas->alamat = $request->alamat;
        $walikelas->email = $request->email;

        // Update password jika diisi
        if ($request->password) {
            $walikelas->password = Hash::make($request->password);
        }
        $walikelas->save();

        // Update data pengguna yang terkait
        $user = User::where('email', $walikelas->email)->first(); // Ambil pengguna berdasarkan email
        if ($user) {
            $user->nama = $request->nama;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
        }

        if ($walikelas) {
            return redirect()->route('walas.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Wali Kelas Berhasil Diubah');
        } else {
            return redirect()->route('walas.index')->with('status', 'danger')->with('status', 'Gagal')->with('message', 'Wali Kelas Gagal Diubah');
        }
    }

    public function destroy($id)
    {
        $walikelas = WaliKelas::find($id);
        if ($walikelas) {
            $walikelas->delete(); // Menghapus semua entri tabungan yang terkait

            // Menghapus pengguna yang terkait
            $user = User::find($walikelas->user_id); // Mengambil pengguna berdasarkan user_id
            if ($user) {
                $user->delete(); // Menghapus pengguna
            }

            $walikelas->delete(); // Menghapus walikelas
            return redirect()->route('walas.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Wali Kelas berhasil dihapus');
        } else {
            return redirect()->route('walas.index')->with('status', 'danger')->with('title', 'Gagal')->with('message', 'Wali Kelas gagal dihapus');
        }
    }
}
