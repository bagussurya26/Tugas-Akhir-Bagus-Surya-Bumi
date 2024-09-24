<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_belis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_nota');
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id')->on('karyawans');
            $table->timestamp('tgl_pesan');
            $table->timestamp('tgl_terima');
            // $table->timestamp('tgl_bayar')->nullable();
            $table->enum('satuan', ['Meter', 'Yard']);
            // $table->enum('status_terima', ['Belum Terima', 'Sudah Terima']);
            // $table->enum('status_bayar', ['Belum Bayar', 'Sudah Bayar']);
            // $table->enum('status', ['Belum Terima', 'Selesai']);
            $table->string('foto')->nullable();
            $table->double('grand_total');
            $table->integer('total_qty_roll');
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
        Schema::table('nota_belis', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->dropColumn('supplier_id');
            $table->dropForeign(['karyawan_id']);
            $table->dropColumn('karyawan_id');
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
            $table->dropForeign(['updated_by']);
            $table->dropColumn('updated_by');
        });
        Schema::dropIfExists('nota_belis');
    }
};
