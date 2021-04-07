<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('idtipodocumento')->nullable()->index('DOCUMENTOS_TIPODOCUMENTOS_FK');
            $table->integer('iduser')->nullable()->index('DOCUMENTOS_USERS_FK');
            $table->string('fecha', 30)->nullable();
            $table->string('descripcion', 255)->nullable();
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
        Schema::dropIfExists('documentos');
    }
}