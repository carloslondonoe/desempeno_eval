<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = 'seguimientos';

    public function plan(){
        return $this->belongsTo(PlanTrabajo::class, 'plan_id','id');
    }

    public function actividades(){
        return $this->hasMany(Actividad::class, 'seguimiento_id','id');
    }
    
}