<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntuacionComportamiento extends Model
{
    protected $table = 'puntuacion_comportamiento';

    public function evaluacion(){
        return $this->belongsTo(Evaluacion::class, 'evaluacion_id','id');
    }

    public function competencia(){
        return $this->belongsTo(Competencia::class, 'competencia_id','id');
    }

    public function comportamiento(){
        return $this->belongsTo(Compportamiento::class, 'compportamiento_id','id');
    }

}