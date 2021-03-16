<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';

    
    public function cargos(){
        return $this->hasMany(Cargo::class, 'area','id');
    }



}
