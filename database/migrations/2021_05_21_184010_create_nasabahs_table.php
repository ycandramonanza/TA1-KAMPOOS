<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNasabahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('karyawan_id')->unsigned();
            $table->string('nama');
            $table->string('alamat');
            $table->string('jenis_kelamin');
            $table->string('no_hp');
            $table->string('image');
            $table->string('jumlah_pinjaman');
            $table->string('jumlah_pembayaran');
            $table->string('sisa_pinjaman');
            $table->string('jumlah_tabungan');
            $table->timestamps();

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
        Schema::dropIfExists('nasabahs');
    }
}
