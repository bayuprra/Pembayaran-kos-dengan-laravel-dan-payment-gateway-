<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class kostModel extends Model
{
    use HasFactory;
    protected $table = "manage_kost";
    protected $fillable = [
        'kamar_id',
        'penyewa_id',
        'status',
        'created_at',
        'expired_at'
    ];
    public $timestamps = false;

    function getData()
    {
        return DB::table('manage_kost as m')
            ->join('kamar as k', 'k.id', '=', 'm.kamar_id')
            ->leftJoin('penyewa as p', 'p.id', '=', 'm.penyewa_id')
            ->select(
                'm.*',
                'k.id as kId',
                'k.nomor as kNomor',
                'k.harga as kHarga',
                'k.fitur as kFitur',
                'p.id as pId',
                'p.nama as pNama',
                'p.telpon as pTelpon'
            )
            ->get();
    }
}
