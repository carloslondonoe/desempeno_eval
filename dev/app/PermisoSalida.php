<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class PermisoSalida extends Model
{
    protected $table = 'permiso_salida';


    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function jefe(){
        return $this->belongsTo(User::class, 'jefe_id','id');
    }

    
   // 'calamidad_domestica', 'cita_eps', 'compensatorio', 'diligencia_personal', 'dia_de_cumpleanos', 'otro'

}
