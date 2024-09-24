<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produk_ukuran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_warna_id');
            $table->foreign('produk_warna_id')->references('id')->on('produk_warna');
            $table->unsignedBigInteger('ukuran_id');
            $table->foreign('ukuran_id')->references('id')->on('ukurans');
            $table->double('harga')->default(0);
            $table->integer('stok')->default(0);
            $table->integer('incoming_stok')->default(0);           
            
        });
    }

    public function down()
    {
        Schema::table('produk_ukuran', function (Blueprint $table) {
            $table->dropForeign(['produk_warna_id']);
            $table->dropColumn('produk_warna_id');
            $table->dropForeign(['ukuran_id']);
            $table->dropColumn('ukuran_id');
        });
        Schema::dropIfExists('produk_ukuran');
    }
};
