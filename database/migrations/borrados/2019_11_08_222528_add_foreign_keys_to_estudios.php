<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToEstudios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estudios', function(Blueprint $table)
        {
            $table->foreign('idnivelestudio', 'ESTUDIOS_NIVELESTUDIOS_FK')->references('id')->on('nivelestudios')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('idtituloprofesional', 'ESTUDIOS_TITULOPROFESIONAL_FK')->references('id')->on('tituloprofesionales')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('iduser', 'ESTUDIOS_USERS_FK')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estudios', function(Blueprint $table)
        {
            $table->dropForeign('ESTUDIOS_NIVELESTUDIOS_FK');
            $table->dropForeign('ESTUDIOS_TITULOPROFESIONAL_FK');
            $table->dropForeign('ESTUDIOS_USERS_FK');
        });
    }
}