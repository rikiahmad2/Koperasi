<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePembiayaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembiayaan', function (Blueprint $table) {
            $table->id('id_pembiayaan');
            $table->string('no_rekening');
            $table->bigInteger('total_pinjaman');
            $table->integer('jumlah_angsuran');
            $table->integer('margin_keuntungan');
            $table->integer('sisa_angsuran');
            $table->integer('sisa_cicilan');
            $table->bigInteger('id_nasabah')->unsigned();
            $table->timestamps();
        });

        Schema::table('pembiayaan', function (Blueprint $table) {
            $table->foreign('id_nasabah')->references('id_nasabah')->on('nasabah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembiayaan');
    }
}
