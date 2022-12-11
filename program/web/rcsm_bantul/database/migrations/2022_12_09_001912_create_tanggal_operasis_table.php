<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanggalOperasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggal_operasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_operasi_id');
            $table->date('tanggal_operasi');
            $table->integer('tanggal');
            $table->integer('bulan');
            $table->integer('tahun');
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
        Schema::dropIfExists('tanggal_operasis');
    }
}
