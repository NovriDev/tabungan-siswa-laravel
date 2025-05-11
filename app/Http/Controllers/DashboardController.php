<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use App\Models\User;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";

        $jumlahDataSiswa = User::where('level', 'Siswa')->count();
        $jumlahAllSaldo = Tabungan::selectRaw('SUM(CASE WHEN tipe = "Pemasukan" THEN saldo ELSE 0 END) - SUM(CASE WHEN tipe = "Pengeluaran" THEN saldo ELSE 0 END) as total_saldo')->value('total_saldo');

        // Check user level and filter accordingly
        $user = Auth::user();
        if ($user->level == 'Siswa') {
            // Data for the current logged-in student
            $dataSaldoSiswa = Siswa::select('siswa.id', 'siswa.nama')
                ->leftJoin('tabungan', 'siswa.id', '=', 'tabungan.siswa_id')
                ->where('siswa.user_id', auth()->id())
                ->selectRaw('SUM(CASE WHEN tipe = "Pemasukan" THEN saldo ELSE 0 END) - SUM(CASE WHEN tipe = "Pengeluaran" THEN saldo ELSE 0 END) as total_saldo')
                ->groupBy('siswa.id', 'siswa.nama')
                ->get();
        } else if ($user->level == 'Walas') {
            // Data for the teacher (Wali Kelas)
            $waliKelas = WaliKelas::where('user_id', $user->id)->first();
    
            if (!$waliKelas) {
                return redirect()->back()->with('error', 'Anda belum terdaftar sebagai wali kelas.');
            }
    
            // Filter students by class
            $dataSaldoSiswa = Siswa::where('kelas', $waliKelas->kelas)
                ->select('siswa.id', 'siswa.nama')
                ->leftJoin('tabungan', 'siswa.id', '=', 'tabungan.siswa_id')
                ->selectRaw('SUM(CASE WHEN tipe = "Pemasukan" THEN saldo ELSE 0 END) - SUM(CASE WHEN tipe = "Pengeluaran" THEN saldo ELSE 0 END) as total_saldo')
                ->groupBy('siswa.id', 'siswa.nama')
                ->get();
        } else {
            // Data for Admin or other roles
            $dataSaldoSiswa = Siswa::select('siswa.id', 'siswa.nama')
                ->leftJoin('tabungan', 'siswa.id', '=', 'tabungan.siswa_id')
                ->selectRaw('SUM(CASE WHEN tipe = "Pemasukan" THEN saldo ELSE 0 END) - SUM(CASE WHEN tipe = "Pengeluaran" THEN saldo ELSE 0 END) as total_saldo')
                ->groupBy('siswa.id', 'siswa.nama')
                ->get();
        }

        // Calculate the total number of students and total saldo
        $siswa = Siswa::where('user_id', $user->id)->first(); // Ambil data siswa berdasarkan user_id
        $namaSiswa = $siswa ? $siswa->nama : 'Tidak Ditemukan'; // Jika siswa ditemukan, tampilkan namanya
        $walas = WaliKelas::where('user_id', $user->id)->first(); // Ambil data siswa berdasarkan user_id
        $namaWalas = $walas ? $walas->nama : 'Tidak Ditemukan'; // Jika walas ditemukan, tampilkan namanya
        $kelasWalas = $walas ? $walas->kelas : 'Tidak Ditemukan'; // Jika walas ditemukan, tampilkan kelas
        $jumlahAllSaldo = $dataSaldoSiswa->sum('total_saldo');

        return view('admin.dashboard.index', compact(
            'title',
            'jumlahDataSiswa',
            'jumlahAllSaldo',
            'dataSaldoSiswa',
            'namaSiswa',
            'namaWalas',
            'kelasWalas',
        ));
    }

    public function historyAllSiswa()
{
    $title = "Pembayaran dan Penarikan";

    // Mengambil data dengan tipe Pemasukan dan Pengeluaran
    $tabungan = Tabungan::whereIn('tipe', ['Pemasukan', 'Pengeluaran'])->latest()->get();

    return view('admin.tabungan.history', compact('tabungan', 'title'));
}

}
