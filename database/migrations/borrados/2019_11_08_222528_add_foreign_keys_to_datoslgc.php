<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToDatoslgc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datoslgc', function(Blueprint $table)
        {
            $table->foreign('iduser', 'DATOSLGC_USERS_FK')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datoslgc', function(Blueprint $table)
        {
            $table->dropForeign('DATOSLGC_USERS_FK');
        });
    }
}