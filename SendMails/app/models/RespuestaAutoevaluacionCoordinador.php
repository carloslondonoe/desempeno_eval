<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class RespuestaAutoevaluacionCoordinador extends Model
{
    protected $table = 'respuesta_autoeva_coordinador';

    public function evaluacion(){
        return $this->belongsTo(AutoEvaluacionCoordinador::class, 'eva_coordinador_id','id');
    }

    public function competencia(){
        return $this->belongsTo(Competencia::class, 'competencia_id','id');
    }

}