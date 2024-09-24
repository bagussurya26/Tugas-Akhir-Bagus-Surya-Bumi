<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk');
            $table->unsignedBigInteger('kategori_produk_id');
            $table->foreign('kategori_produk_id')->references('id')->on('kategori_produks');
            $table->unsignedBigInteger('rak_id');
            $table->foreign('rak_id')->references('id')->on('raks');
            $table->string('nama');
            $table->enum('tipe_fit', ['REGULAR', 'SLIM', 'BIG SIZE']);
            $table->enum('tipe_lengan', ['PANJANG', 'PENDEK', 'MANSET']);
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
        Schema::table('produks', function (Blueprint $table) {
            $table->dropForeign(['kategori_produk_id']);
            $table->dropColumn('kategori_produk_id');
            $table->dropForeign(['rak_id']);
            $table->dropColumn('rak_id');
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
            $table->dropForeign(['updated_by']);
            $table->dropColumn('updated_by');
        });
        Schema::dropIfExists('produks');
    }
};
