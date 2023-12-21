<?php

namespace Database\Seeders;

use App\Models\KamarModel;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nomor'         => '001',
                'harga'      => 1500000,
                'fitur'       => "AC,Kasur,lemari,meja belajar,kamar mandi dalam",
            ],
            [
                'nomor'         => '002',
                'harga'      => 1300000,
                'fitur'       => "AC,Kasur,lemari,meja belajar,kamar mandi luar",
            ]
        ];

        foreach ($data as $item) {
            KamarModel::create($item);
        }
    }
}
