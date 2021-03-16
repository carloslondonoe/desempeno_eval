<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\User;
use App\SolicitudTiquetes;
use App\Destino;
use App\OrdenCargo;

//Mails
use Illuminate\Support\Facades\URL;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SolicitudesTiquetesController extends Controller
{

    public function index(Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $jefe = User::find($value);

        if(empty($jefe) || $jefe->acargo == 'No'){
            return redirect()->back();
        }

        $cargo_ids = [];
        $orden_cargos = OrdenCargo::where('lider_id', '=', $jefe->cargoid)->get();

        foreach ($orden_cargos as $key => $cargo) {
            $cargo_ids[] = $cargo->cargo_id;
        }

        $users = User::whereIn('cargoid', $cargo_ids)->get();
        return view('solicitudes_tiquetes.index', compact("jefe", "users"));
    }

    public function show($id, Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $jefe = User::find($value);

        if(empty($jefe) || $jefe->acargo == 'No'){
            return redirect()->back();
        }

        $user = User::find($id);

        return view('solicitudes_tiquetes.show', compact( "user", "jefe"));
    }

    public function mis_solicitudes(Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }

        return view('solicitudes_tiquetes.show', compact( "user"));
    }

    public function create(Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }


        return view('solicitudes_tiquetes.create', compact("user"));
    }

    public function store(Request $request)
    {

        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }
        $taxi = false;
        $hotel = false;

        if($request->reserva_hotelera == 'true'){
            $taxi = true;
        }

        if($request->taxi == 'true'){
            $taxi = true;
        }

        $solicitud = new SolicitudTiquetes;
        $solicitud->user_id  = $user->id;
        //$permiso->jefe_id  = $user->id;
        $solicitud->motivo = $request->motivo;
        $solicitud->proyecto = $request->proyecto;
        $solicitud->direccion = $request->direccion;
        $solicitud->observaciones = $request->observaciones;
        $solicitud->reserva_hotelera = $hotel;
        $solicitud->taxi = $taxi;
        $solicitud->autorizado = 'pendiente';

        if($solicitud->save()){
            $jefes_ids = [];
            $orden_cargos = OrdenCargo::where('cargo_id', '=', $user->cargoid)->get();

            foreach ($request->destino_attibutes as $key => $destinos) {
                $destino = new Destino;
                $destino->solicitud_tiquete_id = $solicitud->id;
                $destino->destino = $destinos['destino'];


                $destino->dia_regreso = $destinos['dia_regreso'];
                $destino->hora_salida = $destinos['hora_salida'];
                $destino->hora_regreso = $destinos['hora_regreso'];
                $destino->dia_salida = $destinos['dia_salida'];


                $destino->save();
            }

            foreach ($orden_cargos as $key => $cargo) {
                $jefes_ids[] = $cargo->lider_id;
            }


            $jefes = User::whereIn('cargoid', $jefes_ids)->get();


            foreach ($jefes as $key => $jefe) {

                $msg_1 = 'Hola <strong>'
                .$jefe->name.' '.$jefe->apellido.'</strong>, <br/>'
                .'Queremos informate que el usuario:  <strong>'.$user->name.' '.$user->apellido
                .'</strong>, solicitó un tiquete con motivo de <strong>'
                .$solicitud->motivo
                .'<br/>'
                .'<a href="'.url('/solicitudes/show/'.$user->id).'">Ver solicitud</a>'
                .'<br/>'
                .'<a href="'.url('/cancelar_solicitud/'.$solicitud->id).'/'.$jefe->id.'">Cancelar</a>'
                .'<br/>'
                .'<a href="'.url('/aceptar_solicitud/'.$solicitud->id).'/'.$jefe->id.'">Aceptar</a>'
                .'<br/>'
                .$solicitud->motivo;
                $msg = $msg_1;
                $asunto = 'Autorización viaje';
                $send_mail = $this->sendMails($jefe->email, $msg, $asunto);
            }


            return view('solicitudes_tiquetes.notification');
        }


    }

    public function show_solicitud($solicitud_id, Request $request)
    {
        if($request->ajax()){
            $solicitud = SolicitudTiquetes::find($solicitud_id);
            if( $solicitud != null ){
                return array('status' => 'ok', 'solicitud' => $solicitud, 'destinos' => $solicitud->destinos);
            }else{
                return array('status' => 'error');
            }
        }
    }

    public function cancelSolicitud($id, $jefe_id,Request $request)
    {
        $solicitud = SolicitudTiquetes::find($id);
        $jefe = User::find($jefe_id);
        if($solicitud->autorizado == 'pendiente' ){
            $solicitud->autorizado = 'rechazado';
            if($solicitud->save()){
                $msg_1 = 'Hola <strong>'
                .$solicitud->user->name.' '.$solicitud->user->apellido.'</strong>, <br/>'
                .'Queremos informate que el usuario:  <strong>'.$jefe->name.' '.$jefe->apellido
                .'</strong>, ha rechazado tu solicitud de viaje con el motivo <strong>'
                .'<br/>'
                .$solicitud->motivo;
                $msg = $msg_1;
                $asunto = 'Autorización viaje';
                $send_mail = $this->sendMails($solicitud->user->email, $msg, $asunto);

                if($request->ajax()){
                    return array('status' => 'ok', 'msg'=> 'Permiso rechazado y notificado al usuario vía email');
                }

                return view('solicitudes_tiquetes.response_permission');
            }
        }
    }

    public function acceptSolicitud($id, $jefe_id,Request $request)
    {
            $solicitud = SolicitudTiquetes::find($id);
            $jefe = User::find($jefe_id);

            if($solicitud->autorizado == 'pendiente' ){
                $solicitud->autorizado = 'confirmado';
                if($solicitud->save()){
                    $msg_1 = 'Hola <strong>'
                    .$solicitud->user->name.' '.$solicitud->user->apellido.'</strong>, <br/>'
                    .'Queremos informate que el usuario:  <strong>'.$jefe->name.' '.$jefe->apellido
                    .'</strong>, ha autorizado tu solicitud de viaje con el motivo de <strong>'
                    .'<br/>'
                    .$solicitud->motivo;
                    $msg = $msg_1;
                    $asunto = 'Autorización viaje';
                    $send_mail = $this->sendMails($solicitud->user->email, $msg, $asunto);

                    if($request->ajax()){
                        return array('status' => 'ok', 'msg'=> 'Permiso confirmado y notificado al usuario vía email');
                    }

                    return view('solicitudes_tiquetes.response_permission');
                }
            }
    }

    public function sendMails($emails, $msg, $asunto)
    {

//numero envio
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
            //Copia
            $mail->addCC('beatriz.gallego@motoborda.com');
            if(($user->id == 99) OR ($user->id == 100) OR ($user->id == 102) OR ($user->id == 103) OR ($user->id == 104) OR ($user->id == 108) OR ($user->id == 109) OR ($user->id == 127) OR($user->id == 128)  )
            {
              $mail->addBCC('diego.osorio@motoborda.com');
            }
            //$mail->addBCC('jorge.calderon@motoborda.com');
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



}
