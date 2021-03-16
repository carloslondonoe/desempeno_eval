<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Cargo;
use App\OrdenCargo;
use App\Evaltodos;
use App\EvaluacionesTodos;


use DB;
use Auth;
use Session;
use CRUDBooster;

class AdminEvalTodos extends Controller
{
  /**
   * Show the profile for the given user.
   *
   * @param  int  $id
   * @return View
   */


public function mis360(Request $request)
{

$miusereval = CRUDBooster::myId();

$misevaluaciones = DB::select("SELECT
CONCAT(u.apellido,' ',u.name) as 'usuario',
evr.nombre as 'evaluacion',
et.colaborador_id as 'evaluado',
et.evaluador as 'evaluador',
et.id as 'evl'
 FROM evaluacion_todos as et
INNER JOIN evaluaciones_360 as evr ON et.evaluacion_t = evr.id
INNER JOIN cms_users as u ON et.colaborador_id = u.id
WHERE
et.estado = 2
AND et.evaluador ='$miusereval'");

return view('eval_360/para_evaluar', compact("misevaluaciones"));

}

public function realizar(Request $request )
{
$miusereval = CRUDBooster::myId();
$eval = $_GET['evl'];
$eval360 = DB::select("SELECT
CONCAT(u.name,' ',u.apellido) as 'colaborador',
CASE
WHEN u.acargo = 'No' THEN 1
WHEN u.acargo = 'Si' THEN 0
ELSE 0
END as 'p_cargo',
ev.nombre as 't_evaluacion',
c.cargo as 'cargo'
 FROM
evaluacion_todos as et
JOIN cms_users as u ON et.colaborador_id = u.id
JOIN evaluaciones_360 as ev ON et.evaluacion_t = ev.id
LEFT JOIN cargo as c ON c.id = u.cargoid
WHERE
et.evaluador ='$miusereval'
AND et.id = '$eval'");

$preguntas = DB::select("SELECT id,p_acargo,id_competencia,nombre FROM comportamiento_360");


return view('eval_360/evaluacion360', compact("eval","eval360", "preguntas"));

}



   public function index(Request $request)
   {
//echo $name    = $_POST["name"];
$miuser = CRUDBooster::myId();
//$miuser = 79;

//$cargos = DB::select("SELECT id as 'idc', nombre as 'nombre' FROM evaluaciones_360");
       $cargos = EvaluacionesTodos::all();
       //$cargos_select = Cargo::all();
  $evaluadores = DB::select("SELECT us.id as 'id', et.evaluacion_t, 
CONCAT(us.name,' ',us.apellido,' ','Cargo: ',cc.cargo) as 'cargo'

 FROM
cms_users as us
JOIN cargo as cc ON us.cargoid = cc.id
JOIN evaluacion_todos as et ON us.id = et.colaborador_id
WHERE
us.status = 'Activo'
AND et.evaluador = '$miuser'");

  $cargos_select = DB::select("SELECT us.id as 'id',
  CONCAT(us.name,' ',us.apellido,' ','Cargo: ',cc.cargo) as 'cargo'
   FROM
  cms_users as us
  JOIN cargo as cc ON us.cargoid = cc.id
  WHERE
  us.status = 'Activo'
  AND us.id <> '$miuser' ");
//die(var_dump( $evaluadores));


    return view('eval_360/eval_todos', compact("tipoeval","cargos", "orden_cargos", "cargos_select", "evaluadores"));
   }
   public function guardarEvaluadores(Request $request)
   {
    $miuser = CRUDBooster::myId();
     //$miuser = 79;
     
       $items=  $request->items;
       $items2=  $request->items2;
       $items3=  $request->items3;

       Evaltodos::where('evaluador', $miuser)->delete();
       // die(var_dump(intval($items3)));

   if(!empty($items)){
        foreach ($items as $key => $new_cargo) {
            //die(var_dump(intval($new_cargo)));
            $orden_cargo = new Evaltodos();
            $orden_cargo->colaborador_id = intval($new_cargo) ;
            $orden_cargo->evaluador = $miuser;
            $orden_cargo->evaluacion_t = 1;
            $orden_cargo->save();
        }
    }
  
    if(!empty($items2)){
        foreach ($items2 as $key => $new_cargo) {
            $orden_cargo = new Evaltodos();
            $orden_cargo->colaborador_id = intval($new_cargo) ;
            $orden_cargo->evaluador = $miuser;
            $orden_cargo->evaluacion_t = 2;
            $orden_cargo->save();
        }
    }
    if(!empty($items3)){
        foreach ($items3 as $key => $new_cargo) {
            $orden_cargo = new Evaltodos();
            $orden_cargo->colaborador_id = intval($new_cargo) ;
            $orden_cargo->evaluador = $miuser;
            $orden_cargo->evaluacion_t = 3;
            $orden_cargo->save();
        }
    }

     
    return array('status' => 'ok');
     
   }
   public function show($id)
   {
       return view('eval_360/create');
   }

   public function search(Request $request)
   {
$miuser = CRUDBooster::myId();


       if($request->ajax()){


$cargo = DB::select("SELECT us.id as 'id',
CONCAT(us.name,' ',us.apellido) as 'cargo'
FROM
cms_users as us
JOIN cargo as cc ON us.cargoid = cc.id
JOIN evaluacion_todos as et ON us.id = et.evaluador
WHERE
us.status = 'Activo'
AND
us.id <> '$miuser'
AND et.evaluacion_t = 2 " );

/*$orden_cargos = OrdenCargo::where('lider_id', "=",$request->id)
                                   ->get();
           return array($cargo,  $orden_cargos);*/

$orden_cargos = Evaltodos::where('colaborador_id','=',$miuser)
                          ->get();
                          return array($cargo , $orden_cargos);
       }
   }



   public function save_evaluadores(Request $request)
   {
$miuser = CRUDBooster::myId();
if($request->ajax()){

    Evaltodos::where('colaborador_id', $miuser)->delete();
    $cargos_nuevos = $request->orden_cargos;
    if(!empty($cargos_nuevos)){
        foreach ($cargos_nuevos as $key => $new_cargo) {
            $orden_cargo = new Evaltodos();
            $orden_cargo->colaborador_id = $miuser;
            $orden_cargo->evaluador = $new_cargo;
            $orden_cargo->evaluacion_t = $new_cargo;

            $orden_cargo->save();
        }
        /* */
    }
    return array('status' => 'ok');
}


   }

 }
