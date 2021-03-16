<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PlanTrabajo extends Model
{
    protected $table = 'plan_de_trabajo';

    public function seguimientos(){
        return $this->hasMany(Seguimiento::class, 'plan_id','id');
    }

    public function valoracion(){
        return $this->belongsTo(Valoracion::class, 'valoracion_id','id');
    }

    public function User(){
      return $this->hasMany(User::class, 'id','user_id')
    }


}
