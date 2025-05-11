<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    protected $table = 'tabungan';
    use HasFactory;
    protected $fillable = ['siswa_id', 'saldo', 'tipe', 'tanggal_transaksi'];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
