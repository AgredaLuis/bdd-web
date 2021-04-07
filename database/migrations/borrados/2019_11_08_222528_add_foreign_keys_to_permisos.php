<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPermisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permisos', function(Blueprint $table)
        {
            $table->foreign('idmodulo', 'PERMISOS_MODULOS_FK')->references('id')->on('modulos')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('iduser', 'PERMISOS_USERS_FK')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permisos', function(Blueprint $table)
        {
            $table->dropForeign('PERMISOS_MODULOS_FK');
            $table->dropForeign('PERMISOS_USERS_FK');
        });
    }
}
