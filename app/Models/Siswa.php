<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nis',
        'nama',
        'kelas',
        'email',
        'password',
        'jenis_kelamin',
        'alamat',
    ];
    public function tabungan()
    {
        return $this->hasMany(Tabungan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
