<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipesTable extends Migration
{
   
    public function up()
    {
        Schema::create('equipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('meta')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('gerente')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipes');
    }
}