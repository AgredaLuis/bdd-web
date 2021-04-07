<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTituloprofesionalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tituloprofesionales', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->string('nombre', 150)->nullable();
            $table->integer('idnivelestudio')->index('TITULOS_NIVEL_FK');
            $table->char('estatus', 1)->nullable()->default('A')->comment('A = Activo, D = Desactivo');
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
        Schema::dropIfExists('tituloprofesionales');
    }
}