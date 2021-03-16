<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaTemporalAutoevaluacion extends Model
{
    protected $table = 'temporal_puntuacion_autoevaluacion';

    public function evaluacion(){
        return $this->belongsTo(AutoEvaluacion::class, 't_autoevaluacion_id','id');
    }

    public function competencia(){
        return $this->belongsTo(Competencia::class, 'competencia_id','id');
    }

}
