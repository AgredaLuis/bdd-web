<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programaciones', function (Blueprint $table) {
            
            $table->increments('id');
            $table->date('inicio');
            $table->date('fin');
            $table->string('observacion');
            $table->boolean('activo')->default(true);
            $table->integer('id_tipoprogramacion')->unsigned();
            $table->foreign('id_tipoprogramacion')->references('id')->on('tiposprogramaciones');
            $table->integer('id_nucleoprograma')->unsigned();
            $table->foreign('id_nucleoprograma')->references('id')->on('nucleosprogramas');
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
        Schema::dropIfExists('programaciones');
    }
}