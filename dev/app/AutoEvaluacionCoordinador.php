<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoEvaluacionCoordinador extends Model
{
    protected $table = 'autoevaluacion_coordinador';

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function evaluador(){
        return $this->belongsTo(User::class, 'evaluador_id','id');
    }

    public function evaluacion(){
        return $this->belongsTo(Evaluacion::class, 'evaluacion_id','id');
    }

    public function autoevaluacion(){
        return $this->belongsTo(AutoEvaluacion::class, 'autoevaluacion_id','id');
    }

    public function respuestas(){
        return $this->hasMany(RespuestaAutoevaluacionCoordinador::class, 'eva_coordinador_id','id');
    }

    public function puntuaciones(){
        return $this->hasMany(PuntuacionCoordinador::class, 'eva_coordinador_id','id');
    }

}
