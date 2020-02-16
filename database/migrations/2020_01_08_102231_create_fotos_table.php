<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cameraId');
            $table->foreign('cameraId')->references('id')->on('cameras');
            $table->unsignedBigInteger('userId')->nullable(false);
            $table->foreign('userId')->references('id')->on('users');
            $table->string('fotoFileName', 255)->nullable(false);
            $table->string('fotoTitel', 30)->nullable(false);
            $table->string('fotoOmschrijving', 255)->nullable();
            $table->string('fotoBeheerderblock')->default(false);
            $table->string('epRating')->default(true);
            $table->string('keywords')->nullable();
            $table->date('fotoGenomen')->nullable();
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
        Schema::dropIfExists('fotos');
    }
}
