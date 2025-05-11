<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Seeder;

class DataSiswa extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa')->insert([
            [
            'user_id' => 2,
            'nis' => '12345',
            'nama' => 'Siswa',
            'kelas' => 'X',
            'jenis_kelamin' => 'L',
            'alamat' => 'Alamat Siswa 1',
            'email' => 'siswa@example.com',
            'password' => Hash::make('siswa'),
            ],
        ]);
    }
}
