<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Comportamiento extends Model
{
    protected $table = 'comportamiento';

    public function respuestas(){
        return $this->hasMany(PuntuacionComportamiento::class, 'comportamiento_id','id');
    }
}