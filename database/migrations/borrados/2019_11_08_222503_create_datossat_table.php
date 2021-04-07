<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatossatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datossat', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('iduser')->nullable()->index('DATOSSAT_USERS_FK');
            $table->integer('idoficinasat')->nullable()->index('DATOSSAT_OFICINASAT_FK');
            $table->string('nombre', 150)->nullable();
            $table->string('rfc', 30)->nullable();
            $table->string('cargo', 150)->nullable();
            $table->string('telefono', 20)->nullable();
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
        Schema::dropIfExists('datossat');
    }
}