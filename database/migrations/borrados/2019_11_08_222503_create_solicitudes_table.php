<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('idtipopersona');
            $table->integer('idestado');
            $table->integer('idmunicipio');
            $table->integer('idusersolicitante');
            $table->integer('idusercotizante');
            $table->string('fechacotizacion', 150)->nullable();
            $table->string('nombre', 150)->nullable();
            $table->string('folioexterior', 150)->nullable();
            $table->string('nombrerepresentantelegal', 150)->nullable();
            $table->string('correorepresentantelegal', 150)->nullable();
            $table->string('importeavaluo', 150)->nullable();
            $table->string('fecha', 150)->nullable();
            $table->string('rfc', 150)->nullable();
            $table->string('telefono', 150)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('cp', 150)->nullable();
            $table->string('colonia', 150)->nullable();
            $table->string('calle', 150)->nullable();
            $table->string('numero', 150)->nullable();
            $table->string('observaciones', 255)->nullable();
            $table->string('observacionesaprobacion', 255)->nullable();
            $table->char('estatus', 1)->nullable()->default('A')->comment('A = Activo, C = Cancelada, O = Cotizada, U = Autorizada, S = Asignada, V = Valuada, R = aprobada , E = Eliminada');
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
        Schema::dropIfExists('solicitudes');
    }
}