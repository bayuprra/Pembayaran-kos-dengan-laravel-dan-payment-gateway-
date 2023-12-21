<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Penyewa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyewa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akun_id')
                ->constrained('akun');
            $table->string('nama');
            $table->string('telpon', 15);
            $table->bigInteger('ktp');
            $table->string('email');
            $table->boolean('gender')->default(true);
            $table->string('kontak_darurat', 15);
            $table->integer('penghuni');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyewa');
    }
}
