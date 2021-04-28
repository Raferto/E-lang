<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTermasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termasuk', function (Blueprint $table) {
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('kategori_id');

            $table->primary(['barang_id', 'kategori_id']);
            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->foreign('barang_id')->references('id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_termasuk');
    }
}
