<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    //
    protected $table = "users";

    public function lead(){
        return $this->hasMany('App\Lead');
    }

    public function matricula(){
        return $this->hasMany('App\Matricula');
    }
}