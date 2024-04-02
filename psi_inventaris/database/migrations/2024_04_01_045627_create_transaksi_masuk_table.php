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
        Schema::create('transaksi_masuk', function (Blueprint $table) {
            $table->id('transaksi_masuk_id');
            $table->string('nama_barang', 100);
            $table->string('merk', 100);
            $table->text('spesifikasi');
            $table->integer('volume');
            $table->string('satuan', 20);
            $table->integer('harga_satuan');
            $table->dateTime('tanggal_diterima');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_masuk');
    }
};
