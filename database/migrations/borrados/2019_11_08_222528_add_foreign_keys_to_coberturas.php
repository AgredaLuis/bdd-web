<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToCoberturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coberturas', function(Blueprint $table)
        {
            $table->foreign('idestado', 'COBERTURAS_ESTADOS_FK')->references('id')->on('estados')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('iduser', 'COBERTURAS_USERS_FK')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coberturas', function(Blueprint $table)
        {
            $table->dropForeign('COBERTURAS_ESTADOS_FK');
            $table->dropForeign('COBERTURAS_USERS_FK');
        });
    }
}