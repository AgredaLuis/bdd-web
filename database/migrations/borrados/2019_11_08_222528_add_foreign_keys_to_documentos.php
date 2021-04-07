<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToDocumentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documentos', function(Blueprint $table)
        {
            $table->foreign('idtipodocumento', 'DOCUMENTOS_TIPODOCUMENTOS_FK')->references('id')->on('tipodocumentos')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('iduser', 'DOCUMENTOS_USERS_FK')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documentos', function(Blueprint $table)
        {
            $table->dropForeign('DOCUMENTOS_TIPODOCUMENTOS_FK');
            $table->dropForeign('DOCUMENTOS_USERS_FK');
        });
    }
}