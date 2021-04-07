<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToBienesevaluar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bienesevaluar', function(Blueprint $table)
        {
            $table->foreign('idsolicitud', 'BIENESEVALUAR_SOLICITUDES_FK')->references('id')->on('solicitudes')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('idtipoavaluo', 'BIENESEVALUAR_TIPOAVALUO_FK')->references('id')->on('tipoavaluos')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('idtipobien', 'BIENESEVALUAR_TIPOBIEN_FK')->references('id')->on('tipobienes')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bienesevaluar', function(Blueprint $table)
        {
            $table->dropForeign('BIENESEVALUAR_SOLICITUDES_FK');
            $table->dropForeign('BIENESEVALUAR_TIPOAVALUO_FK');
            $table->dropForeign('BIENESEVALUAR_TIPOBIEN_FK');
        });
    }
}
