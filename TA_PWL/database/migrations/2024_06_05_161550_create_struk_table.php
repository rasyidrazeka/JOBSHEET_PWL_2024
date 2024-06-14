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
        Schema::create('struk', function (Blueprint $table) {
            $table->id('struk_id');
            $table->unsignedBigInteger('penjualan_id')->index();
            $table->text('receipt_data');
            $table->timestamps();

            $table->foreign('penjualan_id')->references('penjualan_id')->on('penjualan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('struk');
    }
};
