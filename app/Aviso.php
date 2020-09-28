<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    public function colaborador(){
        return $this->belongsTo('App\Colaborador');
    }

    protected $fillable = array(
        'titulo',
        'descricao',
        'colaborador_id'
    );
}
