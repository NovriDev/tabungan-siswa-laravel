<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'nama' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'level' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nama' => 'Siswa',
            'email' => 'siswa@example.com',
            'password' => Hash::make('siswa'),
            'level' => 'Siswa',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
