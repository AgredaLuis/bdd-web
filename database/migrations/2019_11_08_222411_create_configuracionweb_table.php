<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracionwebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracionweb', function(Blueprint $table)
        {
            $table->integer('id')->autoIncrement();
            $table->string('nombre', 100)->nullable();
            $table->string('parametros', 1500)->nullable();
            $table->integer('tipo')->nullable();
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
        Schema::dropIfExists('configuracionweb');
    }
}
