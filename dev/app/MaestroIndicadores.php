<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class MaestroIndicadores extends Model
{
    protected $table = 'maestro_indicadores';

    public function user(){
        return User::find($this->documento);
    }

}
