<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulos', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->string('controlador')->nullable();
            $table->string('accion')->nullable();
            $table->string('nombreruta')->nullable();
            $table->integer('idpadre')->nullable();
            $table->string('icono', 100)->nullable();
            $table->string('nombre', 150)->nullable();
            $table->string('color_permiso', 50)->nullable();
            $table->string('background_permiso', 50)->nullable();
            $table->string('modulo_permiso', 250)->nullable();
            $table->string('nombre_permiso', 250)->nullable();
            $table->string('descripcion', 250)->nullable();
            $table->integer('dependede')->nullable();
            $table->integer('orden')->nullable();
            $table->string('ajax', 1)->nullable()->default("0");
            $table->string('estatus', 1)->nullable()->default("A")->comment('A = Activo, D = Desactivo');
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
        Schema::dropIfExists('modulos');
    }
}
