<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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

    public function permisos()
    {
        return $this->hasMany(PermisoSalida::class, 'user_id','id');
    }

    public function solicitudes()
    {
        return $this->hasMany(SolicitudTiquetes::class, 'user_id','id');
    }
    public function planesw()
    {
      return $this->hasMany(PlanTrabajo::class, 'user_id','id');
    }

}
