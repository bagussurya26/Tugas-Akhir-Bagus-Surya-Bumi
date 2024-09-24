<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('komposisi', function (Blueprint $table) {
            $table->unsignedBigInteger('list_kain_id');
            $table->foreign('list_kain_id')->references('id')->on('list_kains');
            $table->unsignedBigInteger('produk_ukuran_id');
            $table->foreign('produk_ukuran_id')->references('id')->on('produk_ukuran');
            $table->double('qty_kain');
            $table->integer('qty_produk');
        });
    }

    public function down()
    {
        Schema::table('komposisi', function (Blueprint $table) {
            $table->dropForeign(['list_kain_id']);
            $table->dropColumn('list_kain_id');
            $table->dropForeign(['produk_ukuran_id']);
            $table->dropColumn('produk_ukuran_id');
        });
        Schema::dropIfExists('komposisi');
    }
};
