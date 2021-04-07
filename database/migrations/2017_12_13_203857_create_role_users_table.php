<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('role_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->default(4);
            $table->integer('user_id')->unsigned();
            $table->boolean('is_activated')->default(0);//nuevo
            $table->boolean('is_predefined')->default(0);//nuevo
            $table->string('token')->nullable();//nuevo

            $table->unique(['user_id','role_id']);//clave compuesta
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');

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
        //
        Schema::dropIfExists('role_users');
    }
}