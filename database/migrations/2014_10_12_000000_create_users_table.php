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
        //id, email en password fields hebben geen custom naam gekregen omdat laravel de assumptie maakt dat ze niet worden aangepast. laravel crashed wanneer je aanpast
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('userAvatar')->unique()->nullable(false);
            $table->string('userVoornaam')->nullable(false);
            $table->string('userAchternaam')->nullable(false);
            $table->boolean('beheerderAkkoord')->default(false);
            $table->boolean('beheerderStatus')->default(false);
            $table->boolean('blokkeerStatus')->default(false);
            $table->date("birthdate")->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
