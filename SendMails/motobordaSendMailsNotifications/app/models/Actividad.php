<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';

    
    public function seguimiento(){
        return $this->belongsTo(Seguimiento::class, 'seguimiento_id','id');
    }

}
