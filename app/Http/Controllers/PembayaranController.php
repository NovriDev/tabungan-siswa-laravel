<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tabungan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $title = "Pembayaran";
        $tabungan = Tabungan::where('tipe', 'Pemasukan')->latest()->get();

        return view('admin.pembayaran.index', compact('title', 'tabungan'));
    }

    public function create()
    {
        $title = "Tambah Pembayaran";
        $siswa = Siswa::latest()->get();

        return view('admin.pembayaran.create', compact('title', 'siswa'));
    }

    public function store(Request $request)
{
    $request->validate([
        'siswa' => 'required',
        'jumlah_pembayaran' => 'required',
    ]);

    $tabungan = new Tabungan();
    $tabungan->siswa_id = $request->siswa;
    $tabungan->saldo = preg_replace('/[^0-9]/', '', $request->jumlah_pembayaran);
    $tabungan->tipe = 'Pemasukan';
    $tabungan->tanggal_transaksi = date('Y-m-d H:i:s');
    $tabungan->save();

    if ($tabungan) {
        // Redirect ke halaman invoice
        return redirect()->route('pembayaran.invoice', $tabungan->id)
                         ->with('status', 'success')
                         ->with('title', 'Berhasil')
                         ->with('message', 'Pembayaran Berhasil Ditambahkan');
    } else {
        return redirect()->route('pembayaran.index')
                         ->with('status', 'danger')
                         ->with('title', 'Gagal')
                         ->with('message', 'Pembayaran Gagal Ditambahkan');
    }
}

    public function showInvoice($id)
{
    $title = "Invoice Pembayaran";
    $tabungan = Tabungan::findOrFail($id); // Ambil data transaksi berdasarkan ID

    return view('admin.pembayaran.invoice', compact('title', 'tabungan'));
}
}
