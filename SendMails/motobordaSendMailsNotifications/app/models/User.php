<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
 

    protected $table = 'cms_users';

    public function autoevaluaciones(){
        return $this->hasMany(AutoEvaluacion::class, 'user_id','id');
    }

    public function cargo(){
        return $this->belongsTo(Cargo::class, 'cargoid','id');
    }

    public function autoevaluacioncoordinador()
    {
        return $this->hasMany(AutoEvaluacionCoordinador::class, 'user_id','id');
    }

    public function autoevaluacionevaluada()
    {
        return $this->hasMany(AutoEvaluacionCoordinador::class, 'evaluador_id','id');
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class, 'user_id','id');
    }

}
