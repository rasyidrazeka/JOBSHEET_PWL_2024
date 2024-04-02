<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_keluar', function (Blueprint $table) {
            $table->id('transaksi_keluar_id');
            $table->unsignedBigInteger('transaksi_masuk_id')->index();
            $table->text('keterangan');
            $table->integer('keluar');
            $table->dateTime('tanggal_keluar');
            $table->timestamps();

            $table->foreign('transaksi_masuk_id')->references('transaksi_masuk_id')->on('transaksi_masuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_keluar');
    }
};
