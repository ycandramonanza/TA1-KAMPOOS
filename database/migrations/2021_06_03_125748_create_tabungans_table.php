<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabungans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nasabah_id')->unsigned();
            $table->bigInteger('karyawan_id')->unsigned();
            $table->string('simpan_tabungan');
            $table->string('ambil_tabungan');
            $table->string('tabungan');
            $table->timestamps();
            $table->foreign('nasabah_id')->references('id')->on('nasabahs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('karyawan_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabungans');
    }
}
