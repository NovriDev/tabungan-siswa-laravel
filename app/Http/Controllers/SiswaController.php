<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tabungan;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::latest()->get();
        $title = 'Siswa';
        return view('admin.siswa.index', compact('title', 'siswa'));
    }

    public function create()
    {
        $title = 'Tambah Siswa';
        return view('admin.siswa.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa',
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:siswa',
            'password' => 'required',
        ]);

        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $siswa = new Siswa();
        $siswa->user_id = $user->id;
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->kelas = $request->kelas;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->alamat = $request->alamat;
        $siswa->email = $request->email;
        $siswa->password = Hash::make($request->password);
        $siswa->save();

        if ($siswa && $user) {
            return redirect()->route('siswa.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Siswa Berhasil Ditambahkan');
        } else {
            return redirect()->route('siswa.index')->with('status', 'danger')->with('title', 'Gagal')->with('message', 'Siswa Gagal Ditambahkan');
        }
    }

    public function edit($id)
    {
        $siswa = Siswa::find($id);
        $title = 'Edit Siswa';
        return view('admin.siswa.edit', compact('title', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $id,
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
        ]);

        $siswa = Siswa::find($id);
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->kelas = $request->kelas;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->alamat = $request->alamat;
        $siswa->email = $request->email;

        // Update password jika diisi
        if ($request->password) {
            $siswa->password = Hash::make($request->password);
        }
        $siswa->save();

        // Update data pengguna yang terkait
        $user = User::where('email', $siswa->email)->first(); // Ambil pengguna berdasarkan email
        if ($user) {
            $user->nama = $request->nama;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
        }

        if ($siswa) {
            return redirect()->route('siswa.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Siswa Berhasil Diubah');
        } else {
            return redirect()->route('siswa.index')->with('status', 'danger')->with('status', 'Gagal')->with('message', 'Siswa Gagal Diubah');
        }
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        if ($siswa) {
            // Menghapus semua tabungan yang terkait dengan siswa
            $siswa->tabungan()->delete(); // Menghapus semua entri tabungan yang terkait

            // Menghapus pengguna yang terkait
            $user = User::find($siswa->user_id); // Mengambil pengguna berdasarkan user_id
            if ($user) {
                $user->delete(); // Menghapus pengguna
            }

            $siswa->delete(); // Menghapus siswa
            return redirect()->route('siswa.index')->with('status', 'success')->with('title', 'Berhasil')->with('message', 'Siswa berhasil dihapus');
        } else {
            return redirect()->route('siswa.index')->with('status', 'danger')->with('title', 'Gagal')->with('message', 'Siswa gagal dihapus');
        }
    }

    public function history()
{
    $title = "Pembayaran dan Penarikan";

    // Ambil siswa_id dari siswa yang sedang login
    $siswa_id = auth()->user()->siswa->id;

    // Mengambil data dengan tipe Pemasukan dan Pengeluaran untuk siswa yang login
    $tabungan = Tabungan::where('siswa_id', $siswa_id)
                        ->whereIn('tipe', ['Pemasukan', 'Pengeluaran'])
                        ->latest()
                        ->get();

    return view('admin.tabungan.index', compact('tabungan', 'title', 'siswa_id'));
}


}
