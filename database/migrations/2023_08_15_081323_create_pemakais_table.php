<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemakaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemakais', function (Blueprint $table) {
            $table->bigIncrements('id_pemakai');
            $table->unsignedBigInteger('id_penyewa');
            $table->foreign('id_penyewa')->references('id_penyewa')->on('penyewas')->onDelete('cascade');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('no_hp');
            $table->string('status');
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
        Schema::dropIfExists('pemakais');
    }
}
