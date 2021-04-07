<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToTipobienes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipobienes', function(Blueprint $table)
        {
            $table->foreign('idtipoavaluo', 'TIPOBIEN_TIPOAVALUO_FK')->references('id')->on('tipoavaluos')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipobienes', function(Blueprint $table)
        {
            $table->dropForeign('TIPOBIEN_TIPOAVALUO_FK');
        });
    }
}