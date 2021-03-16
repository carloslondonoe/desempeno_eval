<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = 'evaluacion';
    
    public function cargo(){
        return $this->belongsTo(Cargo::class, 'idcargo','id');
    }

    public function autoevaluaciones(){
        return $this->hasMany(AutoEvaluacion::class, 'evaluacion_id','id');
    }

    public function comp_a(){
        return $this->belongsTo(Competencia::class, 'competecia_a','id');
    }

    public function comp_b(){
        return $this->belongsTo(Competencia::class, 'competecia_b','id');
    }

    public function comp_c(){
        return $this->belongsTo(Competencia::class, 'competecia_c','id');
    }

    public function comp_d(){
        return $this->belongsTo(Competencia::class, 'competencia_d','id');
    }

  
}
