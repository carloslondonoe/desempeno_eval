<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntuacionValoracion extends Model
{
    protected $table = 'puntuacion_valoracion';

    public function evaluacion(){
        return $this->belongsTo(Valoracion::class, 'valoracion_id','id');
    }

    public function competencia(){
        return $this->belongsTo(Competencia::class, 'competencia_id','id');
    }

    public function comportamiento(){
        return $this->belongsTo(Comportamiento::class, 'comportamiento_id','id');
    }

}