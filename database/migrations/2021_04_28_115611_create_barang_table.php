<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('merek')->nullable();
            $table->string('no_reg')->nullable();
            $table->string('tahun')->nullable();
            $table->integer('unit');
            $table->string('kondisi');
            $table->string('image_url')->nullable();
            $table->unsignedBigInteger('ruangan_id');
            $table->foreign('ruangan_id')->references('id')->on('ruangan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
