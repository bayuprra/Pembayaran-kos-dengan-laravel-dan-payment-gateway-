<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ManageKost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_kost', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kamar_id')
                ->constrained('kamar')
                ->onDelete('cascade');
            $table->foreignId('penyewa_id')
                ->nullable()
                ->constrained('penyewa')
                ->onDelete('set null');
            $table->boolean('status')->default(false);
            $table->date("created_at")->nullable();
            $table->date("expired_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_kost');
    }
}
