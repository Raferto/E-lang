<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePenawaranBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penawaran_barang', function (Blueprint $table) {
            $table->id();
            $table->decimal('harga', 9, 3);
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barang');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_penawaran_barang');
    }
}
