<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Seguimiento;
use Carbon\Carbon;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMailNotificationSeguimiento extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendMailSeguimiento:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mandar email de planes de trabajo que estan a un día de expirar';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        date_default_timezone_set('America/Bogota');
        //
        $this->line('Notificando a Planes de trabajo próximos a vencer por un día');
        $seguimientos = Seguimiento::all();
        $now = new Carbon('tomorrow');



        foreach ($seguimientos as $key => $seguimiento) {
            //if( $now->eq(  $seguimiento->fecha_seguimiento) ){
             if( $now ==  Carbon::parse($seguimiento->fecha_seguimiento, 'America/Bogota')){
                $this->line('Notificando seguimientos '. $seguimiento->id);
                $msg = 'Hola, recuerda que el plan de trabajo elaborado para <strong>'.$seguimiento->plan->valoracion->user->name.' '.$seguimiento->plan->valoracion->user->apellido.'</strong>  '.$seguimiento->situacion_presentada.' se vence el próximo '.$seguimiento->fecha_seguimiento;
                $asunto = "Fecha limite plan de trabajo.";
                $this->sendMails($seguimiento->plan->valoracion->user->email, $msg, $asunto);
                $this->sendMails($seguimiento->plan->valoracion->evaluador->email, $msg, $asunto);
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

}
