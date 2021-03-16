<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    protected $table = 'valoracion';

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function evaluador(){
        return $this->belongsTo(User::class, 'evaluador_id','id');
    }

    public function planes(){
        return $this->hasOne(PlanTrabajo::class, 'valoracion_id','id');
    }

    public function evaluacion(){
        return $this->belongsTo(Evaluacion::class, 'evaluacion_id','id');
    }

    public function puntuaciones(){
        return $this->hasMany(PuntuacionValoracion::class, 'valoracion_id','id');
    }
    /* */

}