<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('idusuario');
            $table->integer('idtipobien');
            $table->string('nombre', 150)->nullable();
            $table->string('fecha', 150)->nullable();
            $table->string('ruta', 150)->nullable();
            $table->integer('idsolicitud');
            $table->string('estatus', 150)->nullable();
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
        Schema::dropIfExists('notificaciones');
    }
}