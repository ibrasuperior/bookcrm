<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatriculasTable extends Migration
{

    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('quant');
            $table->string('canal');
            $table->string('produto')->default(null);
            $table->string('pagamento')->default(null);
            $table->string('estado')->default(null);
            $table->string('valor');
            $table->boolean('pago')->default(0);
            $table->string('vencimento')->default(null);
            $table->integer('colaborador_id');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('matriculas');
    }
}
