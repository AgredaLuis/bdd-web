<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToTituloprofesionales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tituloprofesionales', function(Blueprint $table)
        {
            $table->foreign('idnivelestudio', 'TITULOS_NIVEL_FK')->references('id')->on('nivelestudios')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tituloprofesionales', function(Blueprint $table)
        {
            $table->dropForeign('TITULOS_NIVEL_FK');
        });
    }
}