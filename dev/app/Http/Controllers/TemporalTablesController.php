<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\User;
use App\Evaluacion;
use App\AutoEvaluacion;
use App\PuntuacionValoracion;
use App\TemporalAutoEvaluacion;
use App\RespuestaTemporalAutoevaluacion;
use App\TemporalCoordinador;
use App\RespuestaTemporalCoordinador;
use App\TemporalValoracion;
use App\RespuestaTemporalValoracion;
class TemporalTablesController extends Controller
{

    public function index(Request $request)
    {

        if($request->ajax()){

            $value = $request->session()->get('admin_id', function() {
                return 'default';
            });

            $user = User::find($value);

            $temporal = TemporalAutoEvaluacion::where([ 
                "user_id" => $request->user_id,
                "evaluacion_id" => $request->evaluacion_id,
                "evaluador_id" => $user->id,
            ])->with('respuestas')->first();

            return array('status' => 'ok', "evaluacion"=> $temporal );

            /* */
        }
    }
    
    public function save(Request $request)
    {

        if($request->ajax()){
            //dd($respuestas);
            $value = $request->session()->get('admin_id', function() {
                return 'default';
            });

            $user = User::find($value);

            $temporal = TemporalAutoEvaluacion::where([ 
                "user_id" => $request->user_id,
                "evaluacion_id" => $request->evaluacion_id,
                "evaluador_id" => $user->id,
            ])->first();


           // return array($temporal != null);
            if($temporal != null){
                $evaluacion = $temporal;
            }else{

                $evaluacion = new TemporalAutoEvaluacion();
                $evaluacion->user_id = $request->user_id;
                $evaluacion->evaluacion_id = $request->evaluacion_id;
                $evaluacion->evaluador_id = $user->id;
            }


            //return array( $request->user_id );

            if($evaluacion->save()){


                $temporal_puntuacion = RespuestaTemporalAutoevaluacion::where([ 
                    "t_autoevaluacion_id" => $evaluacion->id,
                    "evaluacion_id" => $evaluacion->evaluacion_id,
                    "competencia_id" => $request->competencia_id,
                    "comportamiento_id" => $request->comportamiento_id,
                ])->first();


                if($temporal_puntuacion != null){
                    $evaluacion = $temporal;

                    $punt = null;
                    $obs = null;

                    if($request->value == 'nullo'){
                        $punt = $temporal_puntuacion->puntuacion;
                    }else{
                        $punt = $request->value;
                    }

                    if($request->observaciones == 'nullo'){
                        $obs = $temporal_puntuacion->observaciones;
                    }else{
                        $obs = $request->observaciones;
                    }

                    
                    $resp_comportamiento = new RespuestaTemporalAutoevaluacion();
                    $resp_comportamiento->t_autoevaluacion_id = $evaluacion->id;
                    $resp_comportamiento->evaluacion_id     = $evaluacion->evaluacion_id;
                    $resp_comportamiento->competencia_id    = $request->competencia_id;
                    $resp_comportamiento->comportamiento_id = $request->comportamiento_id;
                    $resp_comportamiento->puntuacion        = $punt ;
                    $resp_comportamiento->observaciones     = $obs;
                    
                    if($resp_comportamiento->save()){
                        $temporal_puntuacion->delete();
                        
                        return array('status' => 'ok');
                    }


                }else{

                    if($request->value == 'nullo'){
                        $punt = 1;
                    }else{
                        $punt = $request->value;
                    }

                    if($request->observaciones == 'nullo'){
                        $obs = null;
                    }else{
                        $obs = $request->observaciones;
                    }

                    $resp_comportamiento = new RespuestaTemporalAutoevaluacion();
                    $resp_comportamiento->t_autoevaluacion_id = $evaluacion->id;
                    $resp_comportamiento->evaluacion_id     = $evaluacion->evaluacion_id;
                    $resp_comportamiento->competencia_id    = $request->competencia_id;
                    $resp_comportamiento->comportamiento_id = $request->comportamiento_id;
                    $resp_comportamiento->puntuacion        = 1;
                    $resp_comportamiento->observaciones     = $request->observaciones;

                    if($resp_comportamiento->save()){
                        return array('status' => 'ok');
                    }
                }

                

            }
            /* */
        }
    }


    public function indexCoordinador(Request $request)
    {

        if($request->ajax()){

            $value = $request->session()->get('admin_id', function() {
                return 'default';
            });

            $user = User::find($value);

            $temporal = TemporalCoordinador::where([ 
                "user_id" => $request->user_id,
                "evaluacion_id" => $request->evaluacion_id,
                "evaluador_id" => $user->id,
            ])->with('respuestas')->first();

            return array('status' => 'ok', "evaluacion"=> $temporal );

            /* */
        }
    }
    
    public function saveCoordinador(Request $request)
    {

        if($request->ajax()){
            
            //dd($respuestas);
            $value = $request->session()->get('admin_id', function() {
                return 'default';
            });

            $user = User::find($value);

            $temporal = TemporalCoordinador::where([ 
                "user_id" => $request->user_id,
                "evaluacion_id" => $request->evaluacion_id,
                "evaluador_id" => $user->id,
            ])->first();


           // return array($temporal != null);
            if($temporal != null){
                $evaluacion = $temporal;
            }else{

                $evaluacion = new TemporalCoordinador();
                $evaluacion->user_id = $request->user_id;
                $evaluacion->evaluacion_id = $request->evaluacion_id;
                $evaluacion->evaluador_id = $user->id;
            }


            //return array( $request->user_id );

            if($evaluacion->save()){


                $temporal_puntuacion = RespuestaTemporalCoordinador::where([ 
                    "t_coordinador_id" => $evaluacion->id,
                    "evaluacion_id" => $evaluacion->evaluacion_id,
                    "competencia_id" => $request->competencia_id,
                    "comportamiento_id" => $request->comportamiento_id,
                ])->first();


                if($temporal_puntuacion != null){
                    $evaluacion = $temporal;

                    $punt = null;
                    $obs = null;

                    if($request->value == 'nullo'){
                        $punt = $temporal_puntuacion->puntuacion;
                    }else{
                        $punt = $request->value;
                    }

                    if($request->observaciones == 'nullo'){
                        $obs = $temporal_puntuacion->observaciones;
                    }else{
                        $obs = $request->observaciones;
                    }

                    
                    $resp_comportamiento = new RespuestaTemporalCoordinador();
                    $resp_comportamiento->t_coordinador_id = $evaluacion->id;
                    $resp_comportamiento->evaluacion_id     = $evaluacion->evaluacion_id;
                    $resp_comportamiento->competencia_id    = $request->competencia_id;
                    $resp_comportamiento->comportamiento_id = $request->comportamiento_id;
                    $resp_comportamiento->puntuacion        = $punt ;
                    $resp_comportamiento->observaciones     = $obs;
                    
                    if($resp_comportamiento->save()){
                        $temporal_puntuacion->delete();
                        
                        return array('status' => 'ok');
                    }


                }else{

                    if($request->value == 'nullo'){
                        $punt = 1;
                    }else{
                        $punt = $request->value;
                    }

                    if($request->observaciones == 'nullo'){
                        $obs = null;
                    }else{
                        $obs = $request->observaciones;
                    }

                    $resp_comportamiento = new RespuestaTemporalCoordinador();
                    $resp_comportamiento->t_coordinador_id = $evaluacion->id;
                    $resp_comportamiento->evaluacion_id     = $evaluacion->evaluacion_id;
                    $resp_comportamiento->competencia_id    = $request->competencia_id;
                    $resp_comportamiento->comportamiento_id = $request->comportamiento_id;
                    $resp_comportamiento->puntuacion        = 1;
                    $resp_comportamiento->observaciones     = $request->observaciones;

                    if($resp_comportamiento->save()){
                        return array('status' => 'ok');
                    }
                }

                

            }
            /* */
        }
    }

    public function indexValoracion(Request $request)
    {

        if($request->ajax()){

            $value = $request->session()->get('admin_id', function() {
                return 'default';
            });

            $user = User::find($value);

            $temporal = TemporalValoracion::where([ 
                "user_id" => $request->user_id,
                "evaluacion_id" => $request->evaluacion_id,
                "evaluador_id" => $user->id,
            ])->with('respuestas')->first();

            return array('status' => 'ok', "evaluacion"=> $temporal );

            /* */
        }
    }
    
    public function saveValoracion(Request $request)
    {

        if($request->ajax()){
            
            //dd($respuestas);
            $value = $request->session()->get('admin_id', function() {
                return 'default';
            });

            $user = User::find($value);

            $temporal = TemporalValoracion::where([ 
                "user_id" => $request->user_id,
                "evaluacion_id" => $request->evaluacion_id,
                "evaluador_id" => $user->id,
            ])->first();


           // return array($temporal != null);
            if($temporal != null){
                $evaluacion = $temporal;
            }else{

                $evaluacion = new TemporalValoracion();
                $evaluacion->user_id = $request->user_id;
                $evaluacion->evaluacion_id = $request->evaluacion_id;
                $evaluacion->evaluador_id = $user->id;
            }


            //return array( $request->user_id );

            if($evaluacion->save()){


                $temporal_puntuacion = RespuestaTemporalValoracion::where([ 
                    "t_valoracion_id" => $evaluacion->id,
                    "evaluacion_id" => $evaluacion->evaluacion_id,
                    "competencia_id" => $request->competencia_id,
                    "comportamiento_id" => $request->comportamiento_id,
                ])->first();


                if($temporal_puntuacion != null){
                    $evaluacion = $temporal;

                    $punt = null;
                    $obs = null;

                    if($request->value == 'nullo'){
                        $punt = $temporal_puntuacion->puntuacion;
                    }else{
                        $punt = $request->value;
                    }

                    if($request->observaciones == 'nullo'){
                        $obs = $temporal_puntuacion->observaciones;
                    }else{
                        $obs = $request->observaciones;
                    }

                    
                    $resp_comportamiento = new RespuestaTemporalValoracion();
                    $resp_comportamiento->t_valoracion_id = $evaluacion->id;
                    $resp_comportamiento->evaluacion_id     = $evaluacion->evaluacion_id;
                    $resp_comportamiento->competencia_id    = $request->competencia_id;
                    $resp_comportamiento->comportamiento_id = $request->comportamiento_id;
                    $resp_comportamiento->puntuacion        = $punt ;
                    $resp_comportamiento->observaciones     = $obs;
                    
                    if($resp_comportamiento->save()){
                        $temporal_puntuacion->delete();
                        
                        return array('status' => 'ok');
                    }


                }else{

                    if($request->value == 'nullo'){
                        $punt = 1;
                    }else{
                        $punt = $request->value;
                    }

                    if($request->observaciones == 'nullo'){
                        $obs = null;
                    }else{
                        $obs = $request->observaciones;
                    }

                    $resp_comportamiento = new RespuestaTemporalValoracion();
                    $resp_comportamiento->t_valoracion_id = $evaluacion->id;
                    $resp_comportamiento->evaluacion_id     = $evaluacion->evaluacion_id;
                    $resp_comportamiento->competencia_id    = $request->competencia_id;
                    $resp_comportamiento->comportamiento_id = $request->comportamiento_id;
                    $resp_comportamiento->puntuacion        = 1;
                    $resp_comportamiento->observaciones     = $request->observaciones;

                    if($resp_comportamiento->save()){
                        return array('status' => 'ok');
                    }
                }

                

            }
            /* */
        }
    }

}