<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';

    
    public function seguimiento(){
        return $this->belongsTo(Seguimiento::class, 'seguimiento_id','id');
    }



}
