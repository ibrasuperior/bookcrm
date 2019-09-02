<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('email');
            $table->string('telefone');
            $table->integer('canal_id')->default(0);
            $table->text('obs')->nullable();
            $table->text('origem')->nullable();
            $table->integer('estagio_id')->references('id')->on('users');
            $table->boolean('open')->default(0);
            $table->boolean('matriculado')->default(0);
            $table->integer('colaborador_id')->unsigned();
            $table->foreign('colaborador_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
