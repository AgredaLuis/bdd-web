<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('ci');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('nacionalidad',1);
            $table->string('genero',1);
            $table->string('estatus_civil',1);
            $table->date('fecha_nacimiento');
            $table->string('email');
            $table->string('telefono_movil')->nullable();
            $table->string('telefono_local')->nullable();
            $table->string('discapacidad')->nullable();
            $table->string('imagen')->default('img/user2-160x160.jpg');
            $table->string('trabajo_empresa');
            $table->string('trabajo_cargo');
            $table->integer('trabajo_tiempo_servicio')->unsigned()->nullable();
            $table->boolean('activo')->default(true);
            $table->string('direccion');
            /*$table->integer('id_estado')->unsigned();
            $table->foreign('id_estado')->references('id')->on('estados');
            $table->integer('id_municipio')->unsigned();
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->integer('id_ciudad')->unsigned();
            $table->foreign('id_ciudad')->references('id')->on('ciudades');*/
            $table->integer('id_parroquia')->unsigned();
            $table->foreign('id_parroquia')->references('id')->on('parroquias');
            $table->string('ciudad');
            $table->boolean('confirmado')->default(false);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
