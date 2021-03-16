<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargo';

    public function evaluaciones(){
        return $this->hasMany(Evaluacion::class, 'idcargo','id');
    }

    public function cargos(){
        return $this->hasMany(OrdenCargo::class, 'lider_id','id');
    }

    public function obj_area(){
        return $this->belongsTo(Area::class, 'area','id');
    }

}
