<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNucleosProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nucleosprogramas', function (Blueprint $table) {

            $table->increments('id');
            $table->string('cod_udo');
            /*$table->string('cod_cnu');
            $table->string('dependencia');
            $table->string('inicio');
            $table->string('sede');
            $table->text('comentario');*/
            $table->boolean('activo')->default(true);
            $table->integer('id_nucleo')->unsigned();
            $table->foreign('id_nucleo')->references('id')->on('nucleos');
            $table->integer('id_programa')->unsigned();
            $table->foreign('id_programa')->references('id')->on('programas');
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
        Schema::dropIfExists('nucleosprogramas');
    }
}