<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nombre');
            $table->string('mencion');
            $table->text('descripcion');
            $table->text('perfil');
            $table->string('inicio');
            $table->string('titulo');
            $table->boolean('activo')->default(true);
            $table->integer('id_area')->unsigned();
            $table->foreign('id_area')->references('id')->on('areas');
            $table->integer('id_grado')->unsigned();
            $table->foreign('id_grado')->references('id')->on('grados');
            $table->integer('id_modalidad')->unsigned();
            $table->foreign('id_modalidad')->references('id')->on('modalidades');
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
        Schema::dropIfExists('programas');
    }
}