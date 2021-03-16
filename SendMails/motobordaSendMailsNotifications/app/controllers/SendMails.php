<?php


namespace App\controllers;
use App\models\Actividad;
use App\models\Seguimiento;

use Carbon\Carbon;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMails
{

    public function sendMailsActivities()
    {
      
        /*
        $msg = 'Estimado usuario recuerde que el seguimiento con la actividad ';
        $asunto = "Prueba";
        self::sendMails('correo de prueba', $msg, $asunto);   
        /* */       
        date_default_timezone_set('America/Bogota');
   
        $actividades = Actividad::all();
        $now = new Carbon('tomorrow'); 
        $notification = [];

        foreach ($actividades as $key => $actividad) {
        

             if( $now ==  Carbon::parse($actividad->fecha, 'America/Bogota')){ 
                $msg = 'Hola, recuerde que el seguimiento con la actividad '.$actividad->actividad.' esta programado para realizarse el próximo '.$actividad->fecha;
                $asunto = "Recordatorio próximo seguimiento";
                
                self::sendMails($actividad->seguimiento->plan->valoracion->user->email, $msg, $asunto);          
                self::sendMails($actividad->seguimiento->plan->valoracion->evaluador->email, $msg, $asunto);

                $notification_msg = 'Hola, recuerde que el seguimiento con la actividad '.$actividad->actividad.' esta programado para realizarse el próximo '.$actividad->fecha;
                $notification[] = [ "msg" => $notification_msg, "asunto" => $asunto, "actividad" => $actividad]; 
            }

        }

        header('Content-type: application/json');
        echo json_encode([  "msg" => "Mensajes Enviados de manera exitosa", "send_mails" =>$notification ]);
    }


    public function sendMailsSeguimientos()
    {
        date_default_timezone_set('America/Bogota');

        $seguimientos = Seguimiento::all();
        $now = new Carbon('tomorrow'); 
        $notification = [];
        foreach ($seguimientos as $key => $seguimiento) {
             if( $now ==  Carbon::parse($seguimiento->fecha_seguimiento, 'America/Bogota')){ 
                $msg = 'Hola, recuerda que el plan de trabajo '.$seguimiento->situacion_presentada.' se vence el próximo '.$seguimiento->fecha_seguimiento.'. Recuerde hacer la respectiva verificación.';
                $asunto = "Fecha limite plan de trabajo.";


                $notification_msg = 'Hola, recuerda que el plan de trabajo '.$seguimiento->situacion_presentada.' se vence el próximo '.$seguimiento->fecha_seguimiento.'. Recuerde hacer la respectiva verificación.';
                $notification[] = [ "msg" => $notification_msg, "asunto" => $asunto, "actividad" => $seguimiento]; 

                self::sendMails($seguimiento->plan->valoracion->user->email, $msg, $asunto);
                self::sendMails($seguimiento->plan->valoracion->evaluador->email, $msg, $asunto);
            }

        }

        header('Content-type: application/json');
        echo json_encode([  "msg" => "Mensajes Enviados de manera exitosa", "send_mails" =>$notification]);
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

}