<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaTemporalCoordinador extends Model
{
    protected $table = 'temporal_puntuacion_coordinador';

    public function evaluacion(){
        return $this->belongsTo(AutoEvaluacionCoordinador::class, 't_coordinador_id','id');
    }

    public function competencia(){
        return $this->belongsTo(Competencia::class, 'competencia_id','id');
    }

}
