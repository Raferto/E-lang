<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('penawaran_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('admin_id')->nullable();;

            $table->text('bukti_pembayaran');
            $table->string('status')->default('new');;
            $table->timestamp('deadline');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('penawaran_id')->references('id')->on('penawaran_barang');
            $table->foreign('admin_id')->references('id')->on('penawaran_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
