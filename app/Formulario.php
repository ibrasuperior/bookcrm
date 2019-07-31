<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $fillable = array (
        'operador',
        'nome',
        'celular',
        'email',
        'curso',
        'tipo',
        'cargaHoraria',
        'faculdade',
        'midia',
        'horarioContato',
        'graduacao',
        'estado',
        'cidade',
        'rua',
        'numero',
        'bairro',
        'cep',
        'pais',
        'dataNasc',
        'cpf',
        'nomeMae',
        'nomePai',
        'valorMatricula',
        'vencimentoMatricula',
        'valorMensalidade',
        'vencimentoMensalidade',
        'obs',
        'valorTotal',
        'parcelas',
        'comercial',
        'tcc',
        'sexo',
        'pagamento',

    );
        
}
