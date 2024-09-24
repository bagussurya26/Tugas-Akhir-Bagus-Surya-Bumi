<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('list_kains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nota_produksi_id');
            $table->foreign('nota_produksi_id')->references('id')->on('nota_produksis');
            $table->unsignedBigInteger('kain_id');
            $table->foreign('kain_id')->references('id')->on('kains');
            $table->double('qty_kain_total');
        });
    }

    public function down()
    {
        Schema::table('list_kains', function (Blueprint $table) {
            $table->dropForeign(['nota_produksi_id']);
            $table->dropColumn('nota_produksi_id');
            $table->dropForeign(['kain_id']);
            $table->dropColumn('kain_id');
        });
        Schema::dropIfExists('list_kains');
    }
};
