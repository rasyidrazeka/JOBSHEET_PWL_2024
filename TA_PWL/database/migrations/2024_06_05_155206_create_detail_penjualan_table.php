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
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id('detail_penjualan_id');
            $table->unsignedBigInteger('penjualan_id')->index();
            $table->unsignedBigInteger('produk_id')->index();
            $table->integer('jumlah');
            $table->decimal('harga', 10, 2);
            $table->timestamps();

            $table->foreign('penjualan_id')->references('penjualan_id')->on('penjualan');
            $table->foreign('produk_id')->references('produk_id')->on('produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
