<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoCategorieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_categorie', function (Blueprint $table) {
            $table->unsignedBigInteger('fotoId');
            $table->foreign('fotoId')->references('id')->on('fotos');
            $table->unsignedBigInteger('categorieId');
            $table->foreign('categorieId')->references('id')->on('categorien');
            $table->primary(['fotoId', 'categorieId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foto_categorie');
    }
}
