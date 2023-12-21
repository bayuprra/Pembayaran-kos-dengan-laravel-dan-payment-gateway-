<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaModel extends Model
{
    use HasFactory;
    protected $table = "penyewa";
    protected $fillable = [
        'akun_id',
        'nama',
        'telpon',
        'ktp',
        'email',
        'gender',
        'kontak_darurat',
        'penghuni'
    ];
    public $timestamps = false;
}
