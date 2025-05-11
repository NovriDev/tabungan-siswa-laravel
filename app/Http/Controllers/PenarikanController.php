<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tabungan;
use Illuminate\Http\Request;

class PenarikanController extends Controller
{
    public function index()
    {
        $title = "Pembayaran";
        $tabungan = Tabungan::where('tipe', 'Pengeluaran')->latest()->get();

        return view('admin.penarikan.index', compact('title', 'tabungan'));
    }

    public function create()
    {
        $title = "Tambah Penarikan";
        $siswa = Siswa::latest()->get();

        return view('admin.penarikan.create', compact('title', 'siswa'));
    }

    public function store(Request $request)
{
    $request->validate([
        'siswa' => 'required',
        'jumlah_penarikan' => 'required',
    ]);

    $siswa_id = $request->siswa;
    $jumlah_penarikan = preg_replace('/[^0-9]/', '', $request->jumlah_penarikan);

    // Ambil total saldo siswa
    $total_saldo = Tabungan::where('siswa_id', $siswa_id)
                            ->sum('saldo');

    // Cek apakah saldo cukup
    if ($total_saldo < $jumlah_penarikan) {
        return redirect()->back()
                         ->with('status', 'danger')
                         ->with('title', 'Gagal')
                         ->with('message', 'Saldo tidak mencukupi untuk penarikan');
    }

    // Simpan transaksi penarikan
    $tabungan = new Tabungan();
    $tabungan->siswa_id = $siswa_id;
    $tabungan->saldo = $jumlah_penarikan; // Saldo dikurangi
    $tabungan->tipe = 'Pengeluaran';
    $tabungan->tanggal_transaksi = now();
    $tabungan->save();

    return redirect()->route('penarikan.invoice', $tabungan->id)
                     ->with('status', 'success')
                     ->with('title', 'Berhasil')
                     ->with('message', 'Penarikan Berhasil Ditambahkan');
}


    public function showInvoice($id)
{
    $title = "Invoice Penarikan";
    $tabungan = Tabungan::findOrFail($id); // Ambil data transaksi berdasarkan ID

    return view('admin.penarikan.invoice', compact('title', 'tabungan'));
}
}
