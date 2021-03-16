<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $table = 'competencia';

    public function respuestas(){
        return $this->hasMany(RespuestaAutoevaluacion::class, 'competencia_id','id');
    }
    
    public function comportamientos(){
        return $this->hasMany(Comportamiento::class, 'idcompetencia','id');
    }
}