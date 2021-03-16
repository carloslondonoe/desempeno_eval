<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class OrdenCargo extends Model
{
    protected $table = 'orden_cargos';

    public function lider(){
        return $this->belongsTo(Cargo::class, 'lider_id','id');
    }

    public function cargo(){
        return $this->belongsTo(Cargo::class, 'cargo_id','id');
    }
}
