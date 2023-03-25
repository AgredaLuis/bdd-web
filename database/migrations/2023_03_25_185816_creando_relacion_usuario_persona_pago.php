<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreandoRelacionUsuarioPersonaPago extends Migration
{
    public function up()
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
         
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('pagos', function (Blueprint $table) {
            $table->unsignedInteger('persona_id');
            
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
        });
    }

    public function down()
    {
        //
    }
}
