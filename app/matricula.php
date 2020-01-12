<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    public function colaborador(){
        return $this->belongsTo('App\Colaborador');
    }
}