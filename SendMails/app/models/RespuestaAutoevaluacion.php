<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class RespuestaAutoevaluacion extends Model
{
    protected $table = 'respuesta_autoevaluacion';

    public function evaluacion(){
        return $this->belongsTo(AutoEvaluacion::class, 'autoevaluacion_id','id');
    }

    public function competencia(){
        return $this->belongsTo(Competencia::class, 'competencia_id','id');
    }

}
