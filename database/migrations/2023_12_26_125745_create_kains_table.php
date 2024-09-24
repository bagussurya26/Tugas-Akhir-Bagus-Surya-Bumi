<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kains', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kain');
            $table->unsignedBigInteger('kategori_kain_id');
            $table->foreign('kategori_kain_id')->references('id')->on('kategori_kains');
            $table->unsignedBigInteger('rak_id');
            $table->foreign('rak_id')->references('id')->on('raks');
            $table->string('nama');
            $table->double('lebar');
            $table->double('incoming_stok')->default(0);
            $table->double('stok')->default(0);
            $table->string('warna')->nullable();
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('kains', function (Blueprint $table) {
            $table->dropForeign(['kategori_kain_id']);
            $table->dropColumn('kategori_kain_id');
            $table->dropForeign(['rak_id']);
            $table->dropColumn('rak_id');
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
            $table->dropForeign(['updated_by']);
            $table->dropColumn('updated_by');
        });
        Schema::dropIfExists('kains');
    }
};
