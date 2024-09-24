<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nota_beli_details', function (Blueprint $table) {
            $table->unsignedBigInteger('nota_beli_id');
            $table->foreign('nota_beli_id')->references('id')->on('nota_belis');
            $table->unsignedBigInteger('kain_id');
            $table->foreign('kain_id')->references('id')->on('kains');           
            $table->integer('qty_roll');
            $table->double('panjang');
            $table->double('total_panjang');
            $table->double('harga');
            $table->double('subtotal');
        });
    }

    public function down()
    {
        Schema::table('nota_beli_details', function (Blueprint $table) {
            $table->dropForeign(['nota_beli_id']);
            $table->dropColumn('nota_beli_id');
            $table->dropForeign(['kain_id']);
            $table->dropColumn('kain_id');
        });
        Schema::dropIfExists('nota_beli_details');
    }
};
