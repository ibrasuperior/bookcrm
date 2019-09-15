<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    //
    public function colaborador(){
        return $this->belongsTo('App\Colaborador');
    }

    public function canal(){
        return $this->belongsTo('App\Canal');
    }

    public function estagio(){
        return $this->belongsTo('App\Estagio');
    }

    protected $fillable = array(
        'nome',
        'email',
        'telefone',
        'obs',
        'colaborador_id',
        'created_at'
    );
}
