<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOficinassatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficinassat', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->string('nombre', 150)->nullable();
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
        Schema::dropIfExists('oficinassat');
    }
}