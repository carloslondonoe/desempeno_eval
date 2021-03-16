<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

//Excel
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;


//Models
use App\User;
use App\Valoracion;
use App\Evaluacion;
use App\AutoEvaluacion;
use App\PuntuacionValoracion;


use App\TemporalValoracion;

class ValoracionController extends Controller
{

    public function index()
    {
        $valoraciones = Valoracion::all();
        return view('evaluaciones.show_autoevaluacion', compact("autoevaluacion"));
    }

    public function valoracion($evaluacion, Request $request)
    {

        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }

        $autoevaluacion = AutoEvaluacion::find($evaluacion);
        $evaluado = User::find($autoevaluacion->user_id);

        $evaluacion = $autoevaluacion->evaluacion;


        /*
        if($retornar){
            return view('evaluaciones.reporteautoevaluacion', compact("user","evaluacion"));;
        }

        /** */
        return view('valoraciones.valoracion', compact("user","evaluacion", "evaluado", "autoevaluacion"));

    }

    public function save_valoracion(Request $request)
    {
        date_default_timezone_set('America/Bogota');

        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }
        $delete_evaluaciones_user = User::find($request->user_id);

        $cant = Valoracion::whereYear('created_at', '=', date("Y"))->where('user_id', $request->user_id)->count();

        $evaluacion = new Valoracion();
        $evaluacion->user_id = $request->user_id;
        $evaluacion->evaluador_id = $user->id;
        $evaluacion->evaluacion_id = $request->evaluacion_id;
        $evaluacion->periodo = $cant+ 1;
        //$evaluacion->autoevaluacion_id = $request->autoevaluacion_id;

        if($evaluacion->save()){
            $respuestas = $request->autoevaluacion;

            foreach ($respuestas as $key => $resp) {

                foreach ($resp as $key => $value) {

                    foreach ($value as $key => $comp) {


                        $resp_comportamiento = new PuntuacionValoracion();
                        $resp_comportamiento->valoracion_id     = $evaluacion->id;
                        $resp_comportamiento->evaluacion_id     = $evaluacion->evaluacion_id;
                        $resp_comportamiento->competencia_id    = $comp['competencia_id'];
                        $resp_comportamiento->comportamiento_id = $comp['comportamiento_id'];
                        $resp_comportamiento->puntuacion        = $comp['respuesta'];
                        $resp_comportamiento->observaciones     = $comp['observaciones'];

                        $resp_comportamiento->save();

                    }
                }
            }


            foreach ($delete_evaluaciones_user->autoevaluaciones as $key => $autoeva) {

                foreach ($autoeva->puntuaciones as $key => $puntuaciones) {

                    $puntuaciones->delete();
                }

                $autoeva->delete();
            }

            foreach ($delete_evaluaciones_user->autoevaluacioncoordinador as $key => $autoeva) {
                foreach ($autoeva->puntuaciones as $key => $puntuaciones) {
                    $puntuaciones->delete();
                }

                $autoeva->delete();
            }

            $temporal = TemporalValoracion::where([
                "user_id" => $request->user_id,
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
            $puntuaciones = $request->autoevaluacion;

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

    public function report_excel(Request $request)
    {
        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $jefe = User::find($value);

        if(empty($jefe) || $jefe->acargo == 'No'){
            return redirect()->back();
        }


        return view('valoraciones.report_excel', compact("autoevaluacion"));
    }

    public function export_excel(Request $request)
    {




        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $jefe = User::find($value);

        if(empty($jefe) || $jefe->acargo == 'No'){
            return redirect()->back();
        }
        $periodo = $request->periodo;
        $ano     = $request->ano;
        $acargo  = null;
        if( $request->acargo == 'true'){
            $acargo  = 'Si';
        }else{
            $acargo  = 'No';
        }

        $valoraciones_ids = Valoracion::select('valoracion.id')
                            ->join('cms_users', 'cms_users.id', '=', 'valoracion.user_id')
                            ->where('valoracion.periodo',  $periodo)
                            ->whereYear('valoracion.created_at', '=', $ano)
                            ->where('cms_users.acargo', $acargo)
                            ->get();

        $valoraciones = Valoracion::whereIn('id',$valoraciones_ids->toArray())->get();
        $spreadsheet = new Spreadsheet;

      //Set Document Properties
      $spreadsheet->getProperties()->setCreator('Plataforma de Formacióm')
      ->setLastModifiedBy($jefe->name)
      ->setTitle('Reporte de Usuarios inscritos')
      ->setSubject('Reporte de Usuarios inscritos por mes')
      ->setDescription('Reporte de Usuarios inscritos por mes');

      //Add styles to header
      $styleArray = [
        'font' => ['bold' => true],
        'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
      ];
      $spreadsheet->getActiveSheet()->getStyle('A1:AE1')->applyFromArray($styleArray);

      //Auto fit column to content
      foreach(range('A','Z') as $columnID) {
  			$spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
  		}

      //unset($columnID);
      foreach(range('A','D') as $columnID) {
        $spreadsheet->getActiveSheet()->getColumnDimension('A'.$columnID)->setAutoSize(true);
      }

      //Set names of header cells
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue("A1", "ÁREA")
        ->setCellValue("B1", "EMPLEADO")
        ->setCellValue("C1", "INDICADORES")
        ->setCellValue("D1", "COMPETENCIAS")
        ->setCellValue("E1", "LIDERAZGO")
        ->setCellValue("F1", "TRABAJO EN EQUIPO")
        ->setCellValue("G1", "INNOVACIÓN");
        //Add data to spreadsheet
        $x= 2;
         //$y= 1;

        //add Values
        foreach ($valoraciones as $valoracion) {
            $puntuacion_liderazgo = 0;
            $puntuacion_equipo = 0;
            $puntuacion_innovacion = 0;

            $cont_liderazgo = 0;
            $cont_equipo = 0;
            $cont_innovacion = 0;

            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $x, $valoracion->user->cargo->obj_area->area);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $x, $valoracion->user->name);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, $x, $valoracion->id);



            foreach ($valoracion->puntuaciones as $key => $puntuacion) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($key + 8, 1, "Competencia: ".$puntuacion->competencia->competencia.PHP_EOL.PHP_EOL.'    Comportamiento: '.$puntuacion->comportamiento->comportamiento);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($key + 8, $x, $puntuacion->puntuacion);
                if($puntuacion->competencia->competencia == 'Liderazgo'){
                    $puntuacion_liderazgo = $puntuacion_liderazgo + $puntuacion->puntuacion;
                    $cont_liderazgo = $cont_liderazgo+1;
                }
                if($puntuacion->competencia->competencia == 'Trabajo en Equipo'){
                    $puntuacion_equipo = $puntuacion_equipo + $puntuacion->puntuacion;
                    $cont_equipo = $cont_equipo+1;
                }

                if($puntuacion->competencia->competencia == 'Innovación'){
                    $puntuacion_innovacion = $puntuacion_innovacion + $puntuacion->puntuacion;
                    $cont_innovacion = $cont_innovacion+1;
                }
            }

            $max_total_liderazgo = $cont_liderazgo * 5;
            $max_total_equipo = $cont_equipo * 5;
            $max_total_innovacion = $cont_innovacion * 5;

            $promedio_liderazgo = 0;
            $promedio_equipo = 0;
            $promedio_innovacion = 0;

            if($cont_liderazgo != 0){
                $promedio_liderazgo = $puntuacion_liderazgo/$cont_liderazgo;
            }

            if($cont_equipo != 0){
                $promedio_equipo = $puntuacion_equipo/$cont_equipo;
            }

            if($cont_innovacion != 0){
                $promedio_innovacion = $puntuacion_innovacion/$cont_innovacion;
            }

            if($max_total_liderazgo != 0){
                $total_liderazgo = $promedio_liderazgo*100/$max_total_liderazgo;
            }

            if($max_total_equipo != 0){
                $total_equipo = $promedio_equipo*100/$max_total_equipo;
            }

            if($max_total_innovacion != 0){
                $total_innovacion = $promedio_innovacion*100/$max_total_innovacion;
            }

            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, $x, number_format((float)$total_liderazgo, 2, '.', '').'%');
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, $x, number_format((float)$total_equipo, 2, '.', '').'%');
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(7, $x, number_format((float)$total_innovacion, 2, '.', '').'%');
            $x++;
            //$y++;
        }

        //foreach ($programs->cursor() as $program) {
          //$spreadsheet->setActiveSheetIndex(0)
              //->setCellValue("A$x",$program->number)
              //->setCellValue("B$x",$program->name)
              //->setCellValue("C$x",$program->knowledge_area->name)
              //->setCellValue("D$x",$program->type->name)
              //->setCellValue("E$x",$program->starts_at->toDateString())
              //->setCellValue("F$x",$program->ends_at->toDateString())
              //->setCellValue("G$x",$program->is_opened ? 'Si' : 'No')
              //->setCellValue("H$x",$program->is_suspended ? 'Si' : 'No');

  		  //}

        //Rename spreadsheet
        $spreadsheet->getActiveSheet()->setTitle('Reporte emprendedores');

        //Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        //Save spreadsheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="reporte_inscritos.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer->save('php://output');
        exit;



        //return view('valoraciones.export_excel', [
        //    'valoraciones' => $valoraciones,
        //]);
    }
}
