<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->unsignedBigInteger('produk_warna_id');
            $table->foreign('produk_warna_id')->references('id')->on('produk_warna');
            $table->unsignedBigInteger('kain_id');
            $table->foreign('kain_id')->references('id')->on('kains');
            $table->enum('tipe', ['UTAMA', 'KOMBINASI']);
        });
    }

    public function down()
    {
        Schema::table('reseps', function (Blueprint $table) {
            $table->dropForeign(['produk_warna_id']);
            $table->dropColumn('produk_warna_id');
            $table->dropForeign(['kain_id']);
            $table->dropColumn('kain_id');
        });
        Schema::dropIfExists('reseps');
    }
};
