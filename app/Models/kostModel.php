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

    function userDataKost($id)
    {
        return DB::table('penyewa as p')
            ->leftJoin('manage_kost as m', 'p.id', '=', 'm.penyewa_id')
            ->join('kamar as k', 'm.kamar_id', '=', 'k.id')
            ->select(
                'p.*',
                'm.id as kostId',
                'm.status as kostStatus',
                'm.created_at as kostCreated_at',
                'm.expired_at as kostExpired_at',
                'k.id as kamarId',
                'k.nomor as kamarNomor',
                'k.harga as kamarHarga',
                'k.fitur as kamarFitur'
            )
            ->where('p.id', $id)
            ->first();
    }
}
