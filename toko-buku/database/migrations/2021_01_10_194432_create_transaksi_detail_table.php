<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('buku_id');
    
            $table->integer('price_perpcs');
            $table->integer('amount');
            $table->integer('total_price');
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('transaksi');
            $table->foreign('buku_id')->references('id')->on('buku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_detail');
    }
}
