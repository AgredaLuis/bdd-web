<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallessolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallessolicitudes', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('idusuario');
            $table->integer('idsolicitud');
            $table->string('fecha', 150)->nullable();
            $table->string('estatus', 150)->nullable();
            $table->integer('idtipobien');
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
        Schema::dropIfExists('detallessolicitudes');
    }
}