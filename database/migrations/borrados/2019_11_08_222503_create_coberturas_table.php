<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoberturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coberturas', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('idestado')->nullable()->index('COBERTURAS_ESTADOS_FK');
            $table->integer('iduser')->nullable()->index('COBERTURAS_USERS_FK');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coberturas');
    }
}