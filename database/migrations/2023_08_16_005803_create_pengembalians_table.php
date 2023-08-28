<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembaliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->bigIncrements('id_pengembalian');
            $table->date('tgl_pengembalian');
            $table->string('alasan');
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
        Schema::dropIfExists('pengembalians');
    }
}
