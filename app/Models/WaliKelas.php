<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    protected $table = 'walikelas';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'kelas',
        'email',
        'password',
        'jenis_kelamin',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

