<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('nota_jual_details', function (Blueprint $table) {
            $table->unsignedBigInteger('nota_jual_id');
            $table->foreign('nota_jual_id')->references('id')->on('nota_juals');
            $table->unsignedBigInteger('produk_ukuran_id');
            $table->foreign('produk_ukuran_id')->references('id')->on('produk_ukuran');
            $table->integer('qty_produk');
            $table->double('harga');
            $table->double('subtotal');
        });
    }

    public function down()
    {
        Schema::table('nota_jual_details', function (Blueprint $table) {
            $table->dropForeign(['nota_jual_id']);
            $table->dropColumn('nota_jual_id');
            $table->dropForeign(['produk_ukuran_id']);
            $table->dropColumn('produk_ukuran_id');
        });
        Schema::dropIfExists('nota_jual_details');
    }
};
