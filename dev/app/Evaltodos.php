<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Evaltodos extends Model
{
  protected $table = 'evaluacion_todos';

  public function colaborador_id(){
      return $this->belongsTo(User::class, 'colaborador_id','id');
  }

  public function evaluador(){
      return $this->belongsTo(User::class, 'evaluador','id');
  }
  public function evaluacion_t(){
      return $this->belongsTo(EvaluacionesTodos::class, 'evaluacion_t','id');
  }

}
