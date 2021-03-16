<?php
namespace App\Http\Controllers;

use App\User;
use App\Evaluacion;
use App\Cargo;
use App\AutoEvaluacion;
use App\RespuestaAutoevaluacion;
use App\Competencia;
use App\PuntuacionCoordinador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrdenCargo;
use App\RespuestaAutoevaluacionCoordinador;
use App\AutoEvaluacionCoordinador;
use App\PuntuacionComportamiento;
use App\Seguimiento;
use App\PlanTrabajo;
use App\Valoracion;
use App\Actividad;
use App\PuntuacionValoracion;

use App\TemporalAutoEvaluacion;
use App\TemporalCoordinador;

use Illuminate\Support\Facades\URL;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EvaluacionesController extends Controller
{

    public function duration_valuation()
    {
        $evaluaciones = Evaluacion::all();
        return view('evaluaciones.index', compact("evaluaciones"));
    }

    public function save_duration(Request $request)
    {
        if($request->ajax()){
            $evaluacion = Evaluacion::find($request->id);
            $evaluacion->duracion = $request->duration;
            $evaluacion->formato   = $request->format;

            if($evaluacion->save()){
                return array( "status" => "ok", "evaluacion"=> $evaluacion );
            }
            return array( "status" => "error" );
        }
    }

    public function autoEvaluacion(Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }

        $autoevaluacion = AutoEvaluacion::where('user_id',"=", $user->id)
                                                ->get();


        $competencias_id = [];
        $evaluacion = Evaluacion::where('idcargo', '=', $user->cargoid)->get();

        if(sizeof($evaluacion) == 0){
            $evaluacion = Evaluacion::where('titulo','=','General')->get();
        }


        if(sizeof($user->valoraciones) > 0 && $evaluacion[0]['formato'] != null){
          $date_start = new \DateTime($user->valoraciones->last()->created_at);
          $fecha_eval = date_format($date_start,'Y');
          $hoy = new \DateTime();
          $hoyy = date_format($hoy,'Y');
          $annos = $hoy->diff($date_start);

          //Fechas fin
          $fecha_fn1 = new \DateTime($user->valoraciones->last()->evaluacion->fecha);
          $fecha_fn2 = new \DateTime();
         $dias = $fecha_fn1->diff($fecha_fn2);
$error1 = 1;
$error2 = 0;
            if($evaluacion[0]['formato'] == 'd'){
                //if($annos->d <= intval($evaluacion[0]['duracion'])){
                if(($hoyy <= $evaluacion[0]['fecha']) && ($error1 == $error2)){

                    return redirect()->back();
                }
            }

            if($evaluacion[0]['formato'] == 'm'){
                if($annos->m <= $evaluacion[0]['duracion']){
                    return redirect()->back();
                }
            }

            if($evaluacion[0]['formato'] == 'y'){
                if($annos->y <= $evaluacion[0]['duracion']){
                    return redirect()->back();
                }
            }
        }
        /* */
        /*
        $retornar = false;
        foreach ($evaluacion as $key => $data) {
            if(!empty($autoevaluacion) && $data->idcargo == $user->cargoid){
                $retornar = true;
            }
        }


        if($retornar){
            return view('evaluaciones.reporteautoevaluacion', compact("user","evaluacion"));;
        }

        /** */
        return view('evaluaciones.autoevaluacion', compact("user","evaluacion"));
    }

    public function save_autoevaluacion(Request $request)
    {
        $respuestas = $request->autoevaluacion;
        //dd($respuestas);
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }

        $evaluacion = new AutoEvaluacion();
        $evaluacion->user_id = $user->id;
        $evaluacion->evaluacion_id = $request->evaluacion_id;
        if($evaluacion->save()){
            $respuestas = $request->autoevaluacion;

            foreach ($respuestas as $key => $resp) {

                foreach ($resp as $key => $value) {
                    foreach ($value as $key => $comp) {
                        $resp_comportamiento = new PuntuacionComportamiento();
                        $resp_comportamiento->autoevaluacion_id = $evaluacion->id;
                        $resp_comportamiento->evaluacion_id     = $evaluacion->evaluacion_id;
                        $resp_comportamiento->competencia_id    = $comp['competencia_id'];
                        $resp_comportamiento->comportamiento_id = $comp['comportamiento_id'];
                        $resp_comportamiento->puntuacion        = $comp['respuesta'];
                        $resp_comportamiento->observaciones     = $comp['observaciones'];

                        $resp_comportamiento->save();
                    }
                }

                /*
                $resEvaluacion = new RespuestaAutoevaluacion();
                $resEvaluacion->autoevaluacion_id = $evaluacion->id;
                $resEvaluacion->evaluacion_id = $evaluacion->evaluacion_id;
                $resEvaluacion->competencia_id = $resp['competencia_id'];
                $resEvaluacion->puntuacion = $resp['respuesta'];
                $resEvaluacion->observaciones = $resp['observaciones'];

                $resEvaluacion->save();
                /* */
            }


            $temporal = TemporalAutoEvaluacion::where([
                "user_id" => $user->id,
                "evaluacion_id" => $request->evaluacion_id
            ])->with('respuestas')->first();

            foreach ($temporal->respuestas as $key => $rs) {
                # code...
                $rs->delete();
            }

            $temporal->delete();
            /* */
            //$this->alert[] = ["message"=>"Lorem ipsum dolor sit amet, amet sit dolor ipsum lorem...","type"=>"info"];
            //return view('evaluaciones.lista_user_autoevaluacion', compact("user"));
            return redirect()->route('lista_autoevaluaciones');
        }else{
            return redirect()->back();
        }
    }

    public function lista_auto_evalucione(Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user) || $user->acargo == 'No'){
            return redirect()->back();
        }

        $cargo_ids = [];
        $orden_cargos = OrdenCargo::where('lider_id', '=', $user->cargoid)->get();

        foreach ($orden_cargos as $key => $cargo) {
            $cargo_ids[] = $cargo->cargo_id;
        }
        /* */
        //$evaluaciones = Evaluacion::whereIn('idcargo',$cargo_ids)->get();
        $evaluacion_general = Evaluacion::where('titulo','=','General')->get();
        $users = User::whereIn('cargoid', $cargo_ids)->get();

        //dd($users);
        return view('evaluaciones.lista_autoevaluaciones', compact("user", "users", "evaluacion_general"));
    }

    public function autoEvaluacionCoordinador($evaluated_id, Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }

        $evaluated = User::find($evaluated_id);


        $evaluado = $evaluated;
        $array_size = null;
        if( $evaluated->autoevaluaciones != null ){
            $array_size = $evaluated->autoevaluaciones->last();
        }

        if($array_size != null ){
            $autoevaluacion = AutoEvaluacion::find($evaluated->autoevaluaciones->last()->id);
            $evaluacion = $autoevaluacion->evaluacion;
        }else{

            $evaluacion = Evaluacion::where('idcargo', '=', $evaluated->cargoid)->first();



            if($evaluacion == null){
                $evaluacion = Evaluacion::where('titulo','=','General')->first();
            }

        }




        return view('evaluaciones.calificar_autoevaluacion', compact("user","evaluacion", "evaluado", "autoevaluacion"));

    }

    public function save_calificacion_coordinador(Request $request)
    {

        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }

        $evaluacion = new AutoEvaluacionCoordinador();
        $evaluacion->user_id = $request->user_id;
        $evaluacion->evaluador_id = $user->id;
        $evaluacion->cargo_id = $request->cargo_id;
        $evaluacion->evaluacion_id = $request->evaluacion_id;
        //$evaluacion->autoevaluacion_id = $request->autoevaluacion_id;

        if($evaluacion->save()){
            $respuestas = $request->autoevaluacion;

            foreach ($respuestas as $key => $resp) {

                foreach ($resp as $key => $value) {

                    foreach ($value as $key => $comp) {


                        $resp_comportamiento = new PuntuacionCoordinador();
                        $resp_comportamiento->eva_coordinador_id = $evaluacion->id;
                        $resp_comportamiento->evaluacion_id     = $evaluacion->evaluacion_id;
                        $resp_comportamiento->competencia_id    = $comp['competencia_id'];
                        $resp_comportamiento->comportamiento_id = $comp['comportamiento_id'];
                        $resp_comportamiento->puntuacion        = $comp['respuesta'];
                        $resp_comportamiento->observaciones     = $comp['observaciones'];

                        $resp_comportamiento->save();

                    }
                }
            }

            $temporal = TemporalCoordinador::where([
                "user_id" =>  $request->user_id,
                "evaluacion_id" => $request->evaluacion_id
            ])->with('respuestas')->first();



            if($temporal != null){

                foreach ($temporal->respuestas as $key => $rs) {
                    # code...
                    $rs->delete();
                }

                $temporal->delete();
            }
            /* */
            //$this->alert[] = ["message"=>"Lorem ipsum dolor sit amet, amet sit dolor ipsum lorem...","type"=>"info"];
            //return view('evaluaciones.lista_user_autoevaluacion', compact("user"));
            return redirect()->route('autoevaluaciones');
        }else{
            return redirect()->back();
        }


        /*
        if($evaluacion->save()){
            $respuestas = $request->autoevaluacion;

            $respuestas = $request->autoevaluacion;
            foreach ($respuestas as $key => $resp) {
                $resEvaluacion = new RespuestaAutoevaluacionCoordinador();

                $resEvaluacion->eva_coordinador_id = $evaluacion->id;
                $resEvaluacion->evaluacion_id = $evaluacion->evaluacion_id;
                $resEvaluacion->competencia_id = $resp['competencia_id'];
                $resEvaluacion->puntuacion = $resp['respuesta'];
                $resEvaluacion->observaciones = $resp['observaciones'];
                /* */
                /*
                $resEvaluacion->save();

            }

            return redirect()->route('autoevaluaciones');
        }
        /* */
    }

    public function lista_user_auto_auto_evaluaciones(Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }

        $autoevaluaciones = AutoEvaluacion::where('user_id', '=',$user->id )->paginate(15);

        $evaluacion_general = Evaluacion::where('titulo','=','General')->get();


        //return $evaluaciones;

        return view('evaluaciones.lista_user_autoevaluacion', compact("user", "autoevaluaciones", "evaluacion_general"));
    }

    public function show_autoevaluacion($id,Request $request)
    {
        $autoevaluacion = AutoEvaluacion::find($id);
        return view('evaluaciones.show_autoevaluacion', compact("autoevaluacion"));
    }

    public function plan_trabajo($id, Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }

        $valoracion = Valoracion::find($id);
        $save = $request->save;
        return view('evaluaciones.plan_trabajo', compact("valoracion", "user", "save"));
    }

    public function save_plan_trabajo(Request $request)
    {
        if($request->ajax()){
            if(empty($request->plan_id)){

                $plan_trabajo = new PlanTrabajo();

                $plan_trabajo->user_id              = $request->user_id;
                $plan_trabajo->lider_id             = $request->lider_id;
                $plan_trabajo->valoracion_id    = $request->valoracion_id;

                if($plan_trabajo->save()){
                    $seguimiento = new Seguimiento();
                    $seguimiento->plan_id               = $plan_trabajo->id;
                    $seguimiento->situacion_presentada  = $request->situacion_presentada;
                    $seguimiento->aspecto_a_mejorar     = $request->aspecto_a_mejorar;
                    $seguimiento->accion_a_tomar        = $request->accion_a_tomar;
                    $seguimiento->fecha_seguimiento     = $request->fecha_seguimiento;
                    $seguimiento->estado                = 'pendiente';

                    if ($seguimiento->save()) {

                        $user_mail = User::find($request->user_id);

                        //$msg = 'Se ha generado un nuevo plan de trabajo visite: '.url('/plan_trabajo/accept/'.$seguimiento->id);
                        //$msg_1 = 'Se ha generado un nuevo plan de trabajo visite: http://carloslondono.com.co/motoborda/plan_trabajo/accept/'.$seguimiento->id;
                        $msg_1 = 'Hola '.$user_mail->name.' '.$user_mail->apellido.', queremos informarte que se ha generado un nuevo plan de trabajo con el nombre '.$seguimiento->situacion_presentada.'. Te invitamos a ingresar en el siguiente link y si estás de acuerdo aceptar el plan y comenzar a trabajar en su desarrollo. '.url('/plan_trabajo/accept/'.$seguimiento->id).'. <br>Muchas gracias.';
                        $msg = $msg_1;
                        $asunto = 'Nuevo plan de trabajo generado';
                        $send_mail = $this->sendMails($user_mail->email, $msg, $asunto);

                        return array('status' => 'ok', 'plan_trabajo' => $plan_trabajo, 'seguimiento' => $seguimiento);
                    }

                }else{
                    return array('status' => 'error');
                }
            }else {
                    $plan_trabajo = PlanTrabajo::find($request->plan_id);
                    $seguimiento = new Seguimiento();
                    $seguimiento->plan_id               = $plan_trabajo->id;
                    $seguimiento->situacion_presentada  = $request->situacion_presentada;
                    $seguimiento->aspecto_a_mejorar     = $request->aspecto_a_mejorar;
                    $seguimiento->accion_a_tomar        = $request->accion_a_tomar;
                    $seguimiento->fecha_seguimiento     = $request->fecha_seguimiento;
                    $seguimiento->estado                = 'pendiente';

                    if ($seguimiento->save()) {
                        $user_mail = User::find($request->user_id);
                        //$msg = 'Se ha generado un nuevo plan de trabajo visite: '.url('/plan_trabajo/accept/'.$seguimiento->id);
                        //$msg_1 = 'Se ha generado un nuevo plan de trabajo visite: http://carloslondono.com.co/motoborda/plan_trabajo/accept/'.$seguimiento->id;

                        $msg_1 = 'Hola '.$user_mail->name.' '.$user_mail->apellido.', queremos informarte que se ha generado un nuevo plan de trabajo con el nombre '.$seguimiento->situacion_presentada.'. Te invitamos a ingresar en el siguiente link y si estás de acuerdo aceptar el plan y comenzar a trabajar en su desarrollo.  '.url('/plan_trabajo/accept/'.$seguimiento->id).'. <br>Muchas gracias.';
                        $msg = $msg_1;
                        $asunto = 'Nuevo plan de trabajo generado';
                        $send_mail = $this->sendMails($user_mail->email, $msg, $asunto);
                        return array('status' => 'ok', 'plan_trabajo' => $plan_trabajo, 'seguimiento' => $seguimiento);
                    }
            }



            return $request->situacion_presentada;
        }
    }

    public function select_seguimiento($id, Request $request)
    {
        if($request->ajax()){
            $seguimiento = Seguimiento::find($id);

            if($seguimiento != null ){
                return array('status' => 'ok', 'seguimiento' => $seguimiento);
            }else{
                return 404;
            }
        }
    }

    public function update_seguimiento($id, Request $request)
    {
        if($request->ajax()){
            $seguimiento =  Seguimiento::find($id);
            $seguimiento->situacion_presentada  = $request->situacion_presentada;
            $seguimiento->aspecto_a_mejorar     = $request->aspecto_a_mejorar;
            $seguimiento->accion_a_tomar        = $request->accion_a_tomar;
            $seguimiento->fecha_seguimiento     = $request->fecha_seguimiento;
            $seguimiento->estado                = 'pendiente';

            if($seguimiento->save()){
                return array('status' => 'ok', 'seguimiento' => $seguimiento);
            }else{
                return 404;
            }
        }
    }

    public function delete_seguimiento($id, Request $request)
    {
        if($request->ajax()){
            $seguimiento =  Seguimiento::find($id);

            foreach ($seguimiento->actividades as $key => $actividad) {
                $actividad->delete();
            }

            if($seguimiento->delete()){
                return array('status' => 'ok', 'seguimiento' => $seguimiento);
            }else{
                return 404;
            }
        }
    }

    public function sendMails($emails, $msg, $asunto)
    {
            $mail = new PHPMailer(true);

            //Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'evaluaciones.motoborda@gmail.com';                     // SMTP username
            $mail->Password   = 'Ev4lu4c10nD*';                               // SMTP password
            $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 465;
            // Activo condificacción utf-8
            $mail->CharSet = 'UTF-8';


            //Recipients
            $mail->setFrom('evaluaciones.motoborda@gmail.com', 'evaluaciones.motoborda@gmail.com');
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $msg;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->addAddress($emails);


            if($mail->send()){
                return true;
            }
    }

    public function select_activities(Request $request)
    {
        if($request->ajax()){
            $seguimiento = Seguimiento::find($request->seguimiento_id);

            if($seguimiento != null ){
                return array('status' => 'ok', 'actividades' => $seguimiento->actividades);
            }else{
                return 404;
            }
        }
    }

    public function select_activity($id, Request $request)
    {
        $actividad = Actividad::find($id);

        if($actividad != null){
            return array('status' => 'ok', 'actividad' => $actividad);
        }else{
            return 404;
        }

    }

    public function update_activity($id,Request $request)
    {
        $actividad = Actividad::find($id);
        $actividad->actividad = $request->actividad;
        $actividad->observaciones = $request->observaciones;
        $actividad->fecha = $request->fecha;

        if($actividad->save()){
            return array('status' => 'ok', 'actividad' => $actividad);
        }else{
            return 404;
        }

    }

    public function save_activity(Request $request)
    {
        if($request->ajax()){
            $actividad = new Actividad();
            $actividad->seguimiento_id = $request->seguimiento_id;
            $actividad->actividad = $request->actividad;
            $actividad->observaciones = $request->observaciones;
            $actividad->fecha = $request->fecha;

            if($actividad->save()){
                $user_mail = User::find($request->user_id);
                $lider = User::find($request->lider_id);
                //$msg = 'la tarea '.$actividad->actividad.' le ha sido creada por '.$lider->name.' '.$lider->apellido.' cargo: '.$lider->cargo->cargo;
                $asunto = 'Nuevo seguimiento generado';
                $msg = 'Hola '.$user_mail->name.' '.$user_mail->apellido.', queremos informarte que se ha generado un nuevo seguimiento al plan de trabajo '.$actividad->seguimiento->situacion_presentada.', Recuerda que la próxima revisión será el '.$actividad->fecha.'.';
                $send_mail = $this->sendMails($user_mail->email, $msg, $asunto);

                return array('status' => 'ok', 'actividad' => $actividad);
            }else{
                return 404;
            }
        }
    }

    public function delete_activity($id,Request $request)
    {
        $actividad = Actividad::find($id);

        if($actividad->delete()){
            return array('status' => 'ok', 'actividad' => $actividad);
        }else{
            return 404;
        }
    }

    public function close_activities(Request $request)
    {
        if($request->ajax()){
            $actividad = Actividad::find($request->actividad_id);
            $actividad->cerrado = 1;
            if($actividad->save() ){
                return array('status' => 'ok', 'actividad' => $actividad);
            }else{
                return 404;
            }
        }
    }

    public function accept_plan_trabajo($id, Request $request)
    {
        $seguimiento = Seguimiento::find($id);
        return view('evaluaciones.aceptar_planes_de_trabajo', compact("seguimiento"));
    }

    public function aceptar_seguimiento($id, Request $request)
    {
        $seguimiento = Seguimiento::find($id);
        $seguimiento->estado = 'aceptado';

        $seguimiento->save();
        $asunto = 'Plan de trabajo aceptado';
        $msg = 'El <strong>plan de trabajo</strong> para <strong>'.$seguimiento->plan->valoracion->user->name.' '.$seguimiento->plan->valoracion->user->apellido.'</strong> con la situación presentada '.$seguimiento->situacion_presentada.' ha sido aceptado.';
        $this->sendMails($seguimiento->plan->valoracion->evaluador->email, $msg, $asunto);


        return view('evaluaciones.aceptar_planes_de_trabajo', compact("seguimiento"));
    }

    public function rechazar_seguimiento($id, Request $request)
    {
        $seguimiento = Seguimiento::find($id);
        $seguimiento->estado = 'rechazado';

        $seguimiento->observaciones = $request->observaciones;

        $seguimiento->save();
        $asunto = 'Plan de trabajo rechazado';
        $msg = 'El   <strong>plan de trabajo</strong> con la situación presentada para <strong>'.$seguimiento->plan->valoracion->user->name.' '.$seguimiento->plan->valoracion->user->apellido.'</strong>' .$seguimiento->situacion_presentada.' no ha sido aceptada <br> motivo: <br>'.$request->observaciones;

       $this->sendMails($seguimiento->plan->valoracion->evaluador->email, $msg, $asunto);


        return view('evaluaciones.aceptar_planes_de_trabajo', compact("seguimiento"));
    }

    public function reporte_final( $valoracion_id)
    {
        $valoracion = Valoracion::find($valoracion_id);
        $observacionval = PuntuacionValoracion::find($valoracion_id);

        return view('evaluaciones.reporte_general', compact("valoracion","observacionval"));

    }

    public function close_plan($id, Request $request)
    {
        if($request->ajax()){
            $seguimiento = Seguimiento::find($id);
            $activity_check = true;
            if($seguimiento->estado == 'aceptado'){


                foreach ($seguimiento->actividades as $key => $actividad) {
                    if($actividad->cerrado != 1){
                        $activity_check = false;
                    }
                }

                if( $activity_check ){
                    $seguimiento->cerrado = 1;

                    if($seguimiento->save()){
                        return array('status' => 'ok', 'seguimiento' => $seguimiento, 'msg' => 'Plan cerrado de manera exitosa', 'class' => 'alert-success');
                    }else{
                        return 404;
                    }
                }else{
                return array('status' => 'actividades', 'seguimiento' => $seguimiento, 'msg' => 'Las actividades de esta plan no han sido cerradas', 'class' => 'alert-warning');
                }
            }else{
                return array('status' => 'plan_pendiente', 'seguimiento' => $seguimiento, 'msg' => 'El plan de trabajo no ha sido aceptado por el trabajador', 'class' => 'alert-warning');
            }

        }
    }

    public function lista_user_auto_auto_evaluaciones_new(Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user) || $user->acargo == 'No'){
            return redirect()->back();
        }

        $cargo_ids = [];
        $orden_cargos = OrdenCargo::where('lider_id', '=', $user->cargoid)->get();

        foreach ($orden_cargos as $key => $cargo) {
            $cargo_ids[] = $cargo->cargo_id;
        }
        /* */
        //$evaluaciones = Evaluacion::whereIn('idcargo',$cargo_ids)->get();
        $evaluacion_general = Evaluacion::where('titulo','=','General')->get();
        $users = User::whereIn('cargoid', $cargo_ids)->get();
        //dd($users);
        return view('evaluaciones.lista_autoevaluaciones_new', compact("user", "users", "evaluacion_general"));
    }

    public function mis_planes(Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);


        if(empty($user)){
            return redirect()->back();
        }

        $planes = PlanTrabajo::where('user_id', '=', $user->id)->get();

        $years = [];
        foreach ($planes as $key => $plan) {
            $years[] = date("Y", strtotime($plan->created_at));
        }

        $years = array_unique($years);


        return view('evaluaciones.mis_planes', compact("user", "planes", "years"));

    }

    public function plan_trabajo_admin(Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user) || $user->acargo == 'No'){
            return redirect()->back();
        }

        $cargo_ids = [];
        $orden_cargos = OrdenCargo::where('lider_id', '=', $user->cargoid)->get();

        foreach ($orden_cargos as $key => $cargo) {
            $cargo_ids[] = $cargo->cargo_id;
        }
        /* */
        $users = User::whereIn('cargoid', $cargo_ids)->get();
        return view('evaluaciones.lista_planes_trabajo', compact("user", "users"));
    }

    public function plan_trabajo_admin_user($user_id, Request $request)
    {
        $user = User::find($user_id);

        $planes = PlanTrabajo::where('user_id', '=', $user->id)->get();

        $years = [];
        foreach ($planes as $key => $plan) {
            $years[] = date("Y", strtotime($plan->created_at));
        }

        $years = array_unique($years);

        return view('evaluaciones.plan_trabajo_admin_user', compact("user", "years", "planes"));
    }

    public function plan_trabajo_admin_user_seguimiento($seguimiento_id, Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user) || $user->acargo == 'No'){
            return redirect()->back();
        }

        $seguimiento = Seguimiento::find($seguimiento_id);


        return view('evaluaciones.plan_trabajo_admin_user_seguimiento', compact("user", "seguimiento"));
    }

}
