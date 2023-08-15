<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrakSewasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak_sewas', function (Blueprint $table) {
            $table->bigIncrements('id_kontraksewa');
            $table->date('tgl_sewa');
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->string('biaya_sewa');
            $table->string('no_polisi');
            $table->unsignedBigInteger('id_penyewa');
            $table->foreign('id_penyewa')->references('id_penyewa')->on('penyewas')->onDelete('cascade');
            $table->unsignedBigInteger('id_pemakai');
            $table->foreign('id_pemakai')->references('id_pemakai')->on('pemakais')->onDelete('cascade');
            $table->string('status');
            $table->string('approval');
            $table->unsignedBigInteger('id_sppk');
            $table->foreign('id_sppk')->references('id_sppk')->on('sppks')->onDelete('cascade');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontrak_sewas');
    }
}
