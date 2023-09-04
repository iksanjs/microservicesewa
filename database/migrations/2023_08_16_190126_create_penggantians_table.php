<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggantiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggantians', function (Blueprint $table) {
            $table->bigIncrements('id_penggantian');
            $table->date('tgl_penggantian');
            $table->unsignedBigInteger('id_kontraksewa');
            $table->foreign('id_kontraksewa')->references('id_kontraksewa')->on('kontrak_sewas')->onDelete('cascade');
            $table->string('no_polisi_sebelumnya');
            $table->string('no_polisi_pengganti');
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
        Schema::dropIfExists('penggantians');
    }
}
