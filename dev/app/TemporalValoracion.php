<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemporalValoracion extends Model
{
    protected $table = 'temporal_valoracion';

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function evaluacion(){
        return $this->belongsTo(Evaluacion::class, 'evaluacion_id','id');
    }

    public function respuestas(){
        return $this->hasMany(RespuestaTemporalAutoevaluacion::class, 't_valoracion_id','id');
    }

    public function autoevaluacioncoordinador(){
        return $this->hasOne(AutoEvaluacionCoordinador::class, 'autoevaluacion_id','id');
    }

    public function puntuaciones(){
        return $this->hasMany(PuntuacionComportamiento::class, 'autoevaluacion_id','id');
    }

    
    
}
