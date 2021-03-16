<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaTemporalValoracion extends Model
{
    protected $table = 'temporal_puntuacion_valoracion';

    public function evaluacion(){
        return $this->belongsTo(AutoEvaluacionValoracion::class, 't_valoracion_id','id');
    }

    public function competencia(){
        return $this->belongsTo(Competencia::class, 'competencia_id','id');
    }

}
