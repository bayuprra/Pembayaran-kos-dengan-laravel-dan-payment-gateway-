<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    function penyewaKosong()
    {
        return DB::table('penyewa')
            ->leftJoin('manage_kost', 'penyewa.id', '=', 'manage_kost.penyewa_id')
            ->whereNull('manage_kost.penyewa_id')
            ->select('penyewa.*')
            ->get();
    }
}
