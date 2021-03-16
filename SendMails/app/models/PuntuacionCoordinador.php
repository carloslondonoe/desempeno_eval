<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PuntuacionCoordinador extends Model
{
    protected $table = 'puntuacion_coordinador';

    public function evaluacion(){
        return $this->belongsTo(AutoEvaluacionCoordinador::class, 'eva_coordinador_id','id');
    }

    public function competencia(){
        return $this->belongsTo(Competencia::class, 'competencia_id','id');
    }

}