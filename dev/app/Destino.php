<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    protected $table = 'destinos';


    public function Solicitud(){
        return $this->belongsTo(SolicitudTiquetes::class, 'solicitud_tiquete_id','id');
    }
    
   // 'calamidad_domestica', 'cita_eps', 'compensatorio', 'diligencia_personal', 'dia_de_cumpleanos', 'otro'

}
