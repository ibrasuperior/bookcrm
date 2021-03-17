<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulariosTable extends Migration
{
    
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('celular');
            $table->string('email');
            $table->string('curso');
            $table->string('tipo');
            $table->string('rua');
            $table->string('sexo');
            $table->string('cargaHoraria');
            $table->string('faculdade');
            $table->string('horarioContato');
            $table->string('graduacao');
            $table->string('estado');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('endereco');
            $table->string('pais');
            $table->string('dataNasc');
            $table->string('cep');
            $table->string('tcc');
            $table->string('pagamento');
            $table->string('cpf');
            $table->string('nomeMae');
            $table->string('nomePai');
            $table->string('valorMatricula');
            $table->string('vencimentoMatricula');
            $table->string('valorMensalidade');
            $table->string('vencimentoMensalidade');
            $table->string('parcelas');
            $table->string('valorTotal');
            $table->text('obs');
            $table->string('operador');
            $table->string('midia');
            $table->integer('numero');
            $table->integer('comercial')->default(0);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('formularios');
    }
}