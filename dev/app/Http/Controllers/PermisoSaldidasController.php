<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
//Models
use App\User;
use App\OrdenCargo;
use App\PermisoSalida;

//Mails
use Illuminate\Support\Facades\URL;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PermisoSaldidasController extends Controller
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
        return view('permisos_salidas.index', compact("jefe", "users"));
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

        return view('permisos_salidas.show', compact( "user", "jefe"));
    }

    public function mis_permisos(Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }

        return view('permisos_salidas.show', compact( "user"));
    }

    public function show_permiso($permiso_id, Request $request)
    {
        if($request->ajax()){
            $permiso = PermisoSalida::find($permiso_id);
            if( $permiso != null ){
                return array('status' => 'ok', 'permiso' => $permiso);
            }else{
                return array('status' => 'error');
            }
        }
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


            return view('permisos_salidas.create', compact("user"));
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

            $permiso = new PermisoSalida;
            $permiso->user_id  = $user->id;
            //$permiso->jefe_id  = $user->id;
            $permiso->razon_salida = $request->razon_salida;
            $permiso->otra_razon_salida = $request->otra_razon_salida;
            $permiso->dia_salida = $request->dia_salida;
            $permiso->dia_regreso = $request->dia_regreso;
            $permiso->hora_salida = $request->hora_salida;
            $permiso->hora_regreso = $request->hora_regreso;
            $permiso->observaciones = $request->observaciones;
            $permiso->autorizado = 'pendiente';

            if($permiso->save()){
                $razon_salida = '';
                $jefes_ids = [];
                $orden_cargos = OrdenCargo::where('cargo_id', '=', $user->cargoid)->get();

                foreach ($orden_cargos as $key => $cargo) {
                    $jefes_ids[] = $cargo->lider_id;
                }

                // $jefes_ids[] = 76;
                // $jefes_ids[] = 119;
                // $jefes_ids[] = 134;
                // $jefes_ids[] = 133;

                $jefes = User::whereIn('cargoid', $jefes_ids)->get();
                //$jefes_copia = User::whereIn('id', [76,119,133])->get();

                if($permiso->razon_salida == 'calamidad_domestica'){
                    $razon_salida = 'Calamidad domestica';
                }

                if($permiso->razon_salida == 'cita_eps'){
                    $razon_salida = 'Cita Eps';
                }

                if($permiso->razon_salida == 'compensatorio'){
                    $razon_salida = 'Compensatorio';
                }

                if($permiso->razon_salida == 'diligencia_personal'){
                    $razon_salida = 'Diligencia Personal';
                }

                if($permiso->razon_salida == 'dia_de_cumpleanos'){
                    $razon_salida = 'Día De Cumpleaños';
                }

                if($permiso->razon_salida == 'otro'){
                    $razon_salida = 'Otro Cúal?';
                }

                if($permiso->razon_salida == null){
                    $razon_salida = '';
                }


                foreach ($jefes as $key => $jefe) {
                    $msg_1 = 'Hola <strong>'
                    .$jefe->name.' '.$jefe->apellido.'</strong>, <br/>'
                    .'Queremos informate que el usuario:  <strong>'.$user->name.' '.$user->apellido
                    .'</strong>, Solicito un permiso de salida con el motivo de <strong>'
                    .$razon_salida.', '.$permiso->otra_razon_salida
                    .'</strong> el día <strong>'
                    .$permiso->dia_salida
                    .'</strong> a las  <strong>'
                    .$permiso->hora_salida
                    .'</strong> hasta el día <strong>'
                    .$permiso->dia_regreso
                    .'</strong> a las <strong>'
                    .$permiso->hora_regreso
                    .'.<br/></strong> <strong>Observaciones:   </strong><br/>'
                    .$permiso->observaciones
                    .'<br/>'
                    .'<a href="'.url('/cancelar_permiso/ '.$permiso->id).'/'.$jefe->id.'">Rechazar</a>'
                    .'<br/>'
                    .'<a href="'.url('/aceptar_permiso/ '.$permiso->id).'/'.$jefe->id.'">Aceptar</a>';
                    $msg = $msg_1;
                    $asunto = 'Permiso de salida';
                    $send_mail = $this->sendMails($jefe->email, $msg, $asunto);
                }

                /*
                foreach ($jefes_copia as $key => $jefe) {
                    $msg_1 = 'Hola <strong>'
                    .$jefe->name.' '.$jefe->apellido.'</strong>, <br/>'
                    .'Queremos informate que el usuario:  <strong>'.$user->name.' '.$user->apellido
                    .'</strong>, Solicito un permiso de salida con el motivo de <strong>'
                    .$razon_salida.', '.$permiso->otra_razon_salida
                    .'</strong> el día <strong>'
                    .$permiso->dia_salida
                    .'</strong> a las  <strong>'
                    .$permiso->hora_salida
                    .'</strong> hasta el día <strong>'
                    .$permiso->dia_regreso
                    .'</strong> a las <strong>'
                    .$permiso->hora_regreso
                    .'.<br/></strong> <strong>Observaciones:   </strong><br/>'
                    .$permiso->observaciones
                    .'<br/>'
                    .'<a href="'.url('/cancelar_permiso/ '.$permiso->id).'/'.$jefe->id.'">Rechazar</a>'
                    .'<br/>'
                    .'<a href="'.url('/aceptar_permiso/ '.$permiso->id).'/'.$jefe->id.'">Aceptar</a>';
                    $msg = $msg_1;
                    $asunto = 'Permiso de salida';
                    $send_mail = $this->sendMails($jefe->email, $msg, $asunto);
                }

*/

                return view('permisos_salidas.notification');
            }

    }

    public function cancelPermissions($id, $jefe_id,Request $request)
    {
            $permiso = PermisoSalida::find($id);
            $jefe = User::find($jefe_id);
            if($permiso->autorizado == 'pendiente' ){
                $permiso->autorizado = 'rechazado';
                if($permiso->save()){


                    if($permiso->razon_salida == 'calamidad_domestica'){
                        $razon_salida = 'Calamidad domestica';
                    }

                    if($permiso->razon_salida == 'cita_eps'){
                        $razon_salida = 'Cita Eps';
                    }

                    if($permiso->razon_salida == 'compensatorio'){
                        $razon_salida = 'Compensatorio';
                    }

                    if($permiso->razon_salida == 'diligencia_personal'){
                        $razon_salida = 'Diligencia Personal';
                    }

                    if($permiso->razon_salida == 'dia_de_cumpleanos'){
                        $razon_salida = 'Día De Cumpleaños';
                    }

                    if($permiso->razon_salida == 'otro'){
                        $razon_salida = 'Otro Cúal?';
                    }

                    if($permiso->razon_salida == null){
                        $razon_salida = '';
                    }

                    $msg_1 = 'Hola <strong>'
                    .$permiso->user->name.' '.$permiso->apellido.'</strong>, <br/>'
                    .'Queremos informate que el usuario:  <strong>'.$jefe->name.' '.$jefe->apellido
                    .'</strong>, ha rechazado tu solicitud de permiso de salida con el motivo de <strong>'
                    .$razon_salida.', '.$permiso->otra_razon_salida
                    .'</strong> el día <strong>'
                    .$permiso->dia_salida
                    .'</strong> a las  <strong>'
                    .$permiso->hora_salida
                    .'</strong> hasta el día <strong>'
                    .$permiso->dia_regreso
                    .'</strong> a las <strong>'
                    .$permiso->hora_regreso
                    .'.<br/></strong> <strong>Observaciones:   </strong><br/>'
                    .$permiso->observaciones;
                    $msg = $msg_1;
                    $asunto = 'Rechazado permiso de salida';
                    $send_mail = $this->sendMails($permiso->user->email, $msg, $asunto);

                    if($request->ajax()){
                        return array('status' => 'ok', 'msg'=> 'Permiso rechazado y notificado al usuario vía email');
                    }

                    return view('permisos_salidas.response_permission');
                }
            }
    }

    public function acceptPermissions($id, $jefe_id,Request $request)
    {
        $permiso = PermisoSalida::find($id);
        $jefe = User::find($jefe_id);
        if($permiso->autorizado == 'pendiente' ){
            $permiso->autorizado = 'confirmado';
            if($permiso->save()){


                if($permiso->razon_salida == 'calamidad_domestica'){
                    $razon_salida = 'Calamidad domestica';
                }

                if($permiso->razon_salida == 'cita_eps'){
                    $razon_salida = 'Cita Eps';
                }

                if($permiso->razon_salida == 'compensatorio'){
                    $razon_salida = 'Compensatorio';
                }

                if($permiso->razon_salida == 'diligencia_personal'){
                    $razon_salida = 'Diligencia Personal';
                }

                if($permiso->razon_salida == 'dia_de_cumpleanos'){
                    $razon_salida = 'Día De Cumpleaños';
                }

                if($permiso->razon_salida == 'otro'){
                    $razon_salida = 'Otro Cúal?';
                }

                if($permiso->razon_salida == null){
                    $razon_salida = '';
                }

                $msg_1 = 'Hola <strong>'
                .$permiso->user->name.' '.$permiso->apellido.'</strong>, <br/>'
                .'Queremos informate que el usuario:  <strong>'.$jefe->name.' '.$jefe->apellido
                .'</strong>, ha autorizado tu solicitud de permiso de salida con el motivo de <strong>'
                .$razon_salida.', '.$permiso->otra_razon_salida
                .'</strong> el día <strong>'
                .$permiso->dia_salida
                .'</strong> a las  <strong>'
                .$permiso->hora_salida
                .'</strong> hasta el día <strong>'
                .$permiso->dia_regreso
                .'</strong> a las <strong>'
                .$permiso->hora_regreso
                .'.<br/></strong> <strong>Observaciones:   </strong><br/>'
                .$permiso->observaciones;
                $msg = $msg_1;
                $asunto = 'Confirmación Permiso de salida';
                $send_mail = $this->sendMails($permiso->user->email, $msg, $asunto);

                if($request->ajax()){
                    return array('status' => 'ok', 'msg'=> 'Permiso confirmado y notificado al usuario vía email');
                }

                return view('permisos_salidas.response_permission');
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
            //Copia
            $mail->addBCC('alejandra.giraldo@motoborda.com');
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

    public function razon($razon_salida){

        if($razon_salida == 'calamidad_domestica'){
            return 'Calamidad domestica';
        }

        if($razon_salida == 'cita_eps'){
            return 'Cita Eps';
        }

        if($razon_salida == 'compensatorio'){
            return 'Compensatorio';
        }

        if($razon_salida == 'diligencia_personal'){
            return 'Diligencia Personal';
        }

        if($razon_salida == 'dia_de_cumpleanos'){
            return 'Día De Cumpleaños';
        }

        if($razon_salida == 'otro'){
            return 'Otro Cúal?';
        }

        if($razon_salida == null){
            return '';
        }


        //return $this->razon_salida == 'calamidad_domestica' ?? 'Calamidad domestica';
        //return $this->razon_salida == 'cita_eps' ?? 'Cita Eps';
        //return $this->razon_salida == 'calamidad_domestica' ?? 'Calamidad domestica';
        //return $this->razon_salida == 'calamidad_domestica' ?? 'Calamidad domestica';
        //return $this->razon_salida == 'calamidad_domestica' ?? 'Calamidad domestica';

    }

}
