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
}
