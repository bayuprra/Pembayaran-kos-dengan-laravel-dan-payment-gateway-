<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KamarModel extends Model
{
    use HasFactory;
    protected $table = "kamar";
    protected $fillable = [
        'nomor',
        'harga',
        'fitur'
    ];
    public $timestamps = false;

    function jumlahKamar()
    {
        return DB::table($this->table)
            ->get()
            ->count();
    }
}
