<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
   
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('educa_leads')->nullabel()->default(0);
            $table->tinyInteger('leads_active')->nullabel()->default(0);
            $table->integer('equipe_id')->unsigned()->references('id')->on('equipes')->default(0);
            $table->integer('permissoes')->default(1);
            $table->boolean('leads_daily')->default(0);
            $table->boolean('active')->default(1);
            $table->rememberToken();
            $table->string('supervisor')->nullable();;
            $table->string('gerente')->nullable();;
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('users');
    }
}