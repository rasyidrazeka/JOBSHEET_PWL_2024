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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('penjualan_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('customer_id')->index();
            $table->decimal('jumlah_total', 10, 2);
            $table->enum('payment_method', ['cash', 'credit_card', 'debit_card', 'e_wallet']);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('customer_id')->references('customer_id')->on('customer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
