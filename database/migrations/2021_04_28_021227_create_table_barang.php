<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBarang extends Migration
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
            $table->text('nama');
            $table->text('photo');
            $table->text('deskripsi');
            $table->string('status');
            $table->timestamp('lelang_start')->nullable();
            $table->timestamp('lelang_finished')->nullable();
            $table->unsignedFloat('harga_tertinggi')->default(0);
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
        Schema::dropIfExists('table_barang');
    }
}
