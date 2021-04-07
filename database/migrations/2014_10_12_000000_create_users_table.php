<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table){

            $table->increments('id');
            $table->string('user',255)->nullable()->default('Invitado');
            $table->string('password',255);
            $table->string('email', 150)->unique()->required();
            $table->char('estatus', 1)->default('A')->nullable()->comment('A = Activo, D = Desactivo');
            $table->string('remember_token',255)->nullable();
            $table->boolean('is_activated')->default(0);
            $table->string('predefined')->default('Invitado');
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
