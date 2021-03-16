<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SolicitudTiquetes extends Model
{
    protected $table = 'solicitud_tiquetes';


    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function jefe(){
        return $this->belongsTo(User::class, 'jefe_id','id');
    }

    public function destinos(){
        return $this->hasMany(Destino::class, 'solicitud_tiquete_id','id');
    }
    
   // 'calamidad_domestica', 'cita_eps', 'compensatorio', 'diligencia_personal', 'dia_de_cumpleanos', 'otro'

}
