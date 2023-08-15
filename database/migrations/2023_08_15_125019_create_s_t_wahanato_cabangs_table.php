<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSTWahanatoCabangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_t_wahanato_cabangs', function (Blueprint $table) {
            $table->bigIncrements('id_stwahanatocabang');
            $table->date('tgl_st');
            $table->string('nama_penyerah');
            $table->string('nama_penerima');
            $table->string('no_polisi');
            $table->unsignedBigInteger('id_penyewa');
            $table->foreign('id_penyewa')->references('id_penyewa')->on('penyewas')->onDelete('cascade');
            $table->unsignedBigInteger('id_pemakai');
            $table->foreign('id_pemakai')->references('id_pemakai')->on('pemakais')->onDelete('cascade');
            $table->unsignedBigInteger('id_kontraksewa');
            $table->foreign('id_kontraksewa')->references('id_kontraksewa')->on('kontrak_sewas')->onDelete('cascade');
            $table->string('status');
            $table->string('approval');
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
        Schema::dropIfExists('s_t_wahanato_cabangs');
    }
}
