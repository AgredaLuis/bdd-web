<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBienesevaluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienesevaluar', function(Blueprint $table)
        {
            $table->integer('id', true);           
            $table->integer('idsolicitud')->index('BIENESEVALUAR_SOLICITUDES_FK');
            $table->integer('idtipoavaluo')->index('BIENESEVALUAR_TIPOAVALUO_FK');
            $table->integer('idtipobien')->index('BIENESEVALUAR_TIPOBIEN_FK');
            $table->integer('idrevisor');
            $table->integer('idevaluador');
            $table->integer('idusercotizante');
            $table->string('foliointerno', 150)->nullable();
             $table->string('dato', 150)->nullable();
             $table->string('bienobservaciones', 150)->nullable();
             $table->string('avaluoobservaciones', 150)->nullable();
             $table->string('aprobacionbservaciones', 150)->nullable();
             $table->string('importe', 150)->nullable();
             $table->string('valorbien', 150)->nullable();
             $table->string('datoadicional', 150)->nullable();
             $table->string('cp', 150)->nullable();
            $table->string('colonia', 150)->nullable();
            $table->string('calle', 150)->nullable();
            $table->string('numero', 150)->nullable();
            $table->integer('idestado');
            $table->integer('idmunicipio');
            $table->string('nombrerutaevidencia', 255)->nullable();
             $table->string('tipodato', 150)->nullable();
             $table->string('tipodatoadicional', 150)->nullable();
            $table->char('estatus', 1)->nullable()->default('A')->comment('A = Activo, U = Autorizada, N = No Autorizada, S = Asignada');
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
        Schema::dropIfExists('bienesevaluar');
    }
}