<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DataTabungan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tabungan')->insert([
            [
            'siswa_id' => 1,
            'saldo' => 100000,
            'tipe' => 'Pemasukan',
            'tanggal_transaksi' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'siswa_id' => 1,
            'saldo' => 150000,
            'tipe' => 'Pemasukan',
            'tanggal_transaksi' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'siswa_id' => 1,
            'saldo' => 200000,
            'tipe' => 'Pengeluaran',
            'tanggal_transaksi' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
