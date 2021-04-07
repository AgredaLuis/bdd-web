<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToDatossat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datossat', function(Blueprint $table)
        {
            $table->foreign('iduser', 'DATOSSAT_USERS_FK')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('idoficinasat', 'DATOSSAT_OFICINASAT_FK')->references('id')->on('oficinassat')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datossat', function(Blueprint $table)
        {
            $table->dropForeign('DATOSSAT_USERS_FK');
            $table->dropForeign('DATOSSAT_OFICINASAT_FK');
        });
    }
}