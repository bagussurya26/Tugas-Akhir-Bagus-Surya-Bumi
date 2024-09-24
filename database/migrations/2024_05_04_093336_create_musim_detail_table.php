<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('musim_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('musim_id');
            $table->foreign('musim_id')->references('id')->on('musims');
            $table->string('tahun');
            $table->string('bulan_awal');
            $table->string('bulan_akhir');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('musim_detail', function (Blueprint $table) {
            $table->dropForeign(['musim_id']);
            $table->dropColumn('musim_id');
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
            $table->dropForeign(['updated_by']);
            $table->dropColumn('updated_by');
        });
        Schema::dropIfExists('musim_detail');
    }
};
