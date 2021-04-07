<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatoslgcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datoslgc', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('iduser')->nullable()->index('DATOSLGC_USERS_FK');
            $table->string('nombre', 150)->nullable();
            $table->string('apellidopat', 150)->nullable();
            $table->string('apellidomat', 150)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('telefonofijo', 20)->nullable();
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
        Schema::dropIfExists('datoslgc');
    }
}