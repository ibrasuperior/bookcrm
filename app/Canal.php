<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    public $table = "canais" ;
    public $timestamps = false ;

    public function lead(){
        return $this->hasMany('App\Lead');
    }
}
