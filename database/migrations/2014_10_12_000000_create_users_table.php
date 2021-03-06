<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();;
            $table->string('password');
            $table->string('nama');
            $table->string('nomor_telpon')->unique();
            $table->text('alamat');
            $table->text('email');
            $table->text('photo');
            $table->boolean('verified')->default(false);
            $table->timestamp('verified_date')->nullable();
            $table->timestamps();
            $table->rememberToken();

            $table->foreign('admin_id')->references('id')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
