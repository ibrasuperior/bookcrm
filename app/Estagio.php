<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Estagio extends Model
{
    public $timestamps = false ;

    public function lead(){
        return $this->hasMany('App\Lead');
    }
}
