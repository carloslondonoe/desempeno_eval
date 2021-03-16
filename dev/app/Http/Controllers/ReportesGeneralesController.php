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
use App\MaestroIndicadores;
use App\Competencia;
use App\PuntuacionValoracion;


class ReportesGeneralesController extends Controller
{
  public function report_excel(Request $request)
  {
      $value = $request->session()->get('admin_id', function() {
          return 'default';
      });

      $jefe = User::find($value);

      if(empty($jefe) || $jefe->acargo == 'No'){
          return redirect()->back();
      }

      return view('reportes_generales.report_excel', compact("autoevaluacion"));
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

      //$maestro_indicadores = MaestroIndicadores::all();

      $mes      = $request->mes;
      $ano      = $request->ano;
      $ciclo    = $request->ciclo;
      $acargo   = null;
      //dd($request);
      $mes_nombre = '';
      if($mes == '01'){
        $mes_nombre = 'ENERO';
      }

      if($mes == '02'){
        $mes_nombre = 'FEBRERO';
      }

      if($mes == '03'){
        $mes_nombre = 'MARZO';
      }

      if($mes == '04'){
        $mes_nombre = 'ABRIL';
      }

      if($mes == '05'){
        $mes_nombre = 'MAYO';
      }

      if($mes == '06'){
        $mes_nombre = 'JUNIO';
      }

      if($mes == '07'){
        $mes_nombre = 'JULIO';
      }

      if($mes == '08'){
        $mes_nombre = 'AGOSTO';
      }

      if($mes == '09'){
        $mes_nombre = 'SEPTIEMBRE';
      }

      if($mes == '10'){
        $mes_nombre = 'OCTUBRE';
      }

      if($mes == '11'){
        $mes_nombre = 'NOVIEMBRE';
      }

      if($mes == '12'){
        $mes_nombre = 'DICIEMBRE';
      }


      if( $request->acargo == 'true'){
          $acargo  = 'Si';
            $title ='CON PERSONAL A CARGO '.$ciclo.' '.$ano;
      }else{
          $acargo  = 'No';
          $title = 'SIN PERSONAL A CARGO '.$ciclo.' '.$ano;
      }

      $valoraciones_ids = Valoracion::select('valoracion.id')
        ->join('cms_users', 'cms_users.id', '=', 'valoracion.user_id')
        ->whereYear('valoracion.created_at', '=', $ano)
        ->where('cms_users.acargo', $acargo)
        ->where('valoracion.periodo', $ciclo)
        ->get();


      $valoraciones = Valoracion::whereIn('id',$valoraciones_ids->toArray())->get();



      $spreadsheet = new Spreadsheet;

    //Set Document Properties
    $spreadsheet->getProperties()->setCreator('Reporte')
      ->setLastModifiedBy($jefe->name);

    //Add styles to header
    $styleArray = [
      'font' => ['bold' => true],
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
    ];
    $spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);

    //Auto fit column to content
    foreach(range('A','Z') as $columnID) {
      $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }


    $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue("A1", $title)
      ->setCellValue("A2", "Indicadores")
      ->setCellValue("B2", "Compentencias");

    //$competencias = Competencia::all();
    if($acargo == 'No'){
        $competencias = Competencia::all()->where('acargo', 0);
    }

    else
    {
        $competencias = Competencia::all()->where('acargo',1);
    }


    $y= 2;
    $x= 4;


    $indicadores = MaestroIndicadores::where('meta', $ciclo)->whereYear('feha_creacion', $ano)->get();

    $cont_indicador = 0;
    $puntuacion_indicador = 0;
    foreach ($indicadores as $key => $indicador) {
      # code...
      $puntuacion_indicador = $puntuacion_indicador + $indicador->desempeno;
      $cont_indicador = $cont_indicador+1;
    }

    $promedio_indicador = 0;

    if($cont_indicador != 0){
      $promedio_indicador = $puntuacion_indicador/$cont_indicador;
    }
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue("A3", number_format((float) $promedio_indicador, 2, '.', '').'%');


    foreach ($competencias as $key => $competencia) {
      # code...
      $puntuacion_comp = 0;
      $cont_comp = 0;

      // $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($key+3, $y, $competencia->competencia);
      $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($key+3, $y, $competencia->competencia);
      $spreadsheet->getActiveSheet()->mergeCellsByColumnAndRow(1,$x, 5, $x);
      $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $x, $competencia->competencia);

      foreach ($competencia->comportamientos as $i => $comportamiento) {
        # code...
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($i+1, $x+1, $comportamiento->comportamiento);

        $puntuacion = 0;
        $cont = 0;

        foreach ($valoraciones as $k => $valoracion) {
          # code...
          foreach ($valoracion->puntuaciones as $e => $puntuacion_val) {
            # code...
            if($puntuacion_val->comportamiento_id == $comportamiento->id){
              $puntuacion = $puntuacion + $puntuacion_val->puntuacion;
              $cont = $cont+1;
            }

            if($puntuacion_val->competencia_id == $competencia->id){
              $puntuacion_comp = $puntuacion_comp + $puntuacion_val->puntuacion;
              $cont_comp = $cont_comp+1;
            }

          }

        }

        $promedio = 0;

        if($cont != 0){
          $promedio = $puntuacion/$cont;
        }
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($i+1, $x+2, number_format((float) $this->FormatAverage($promedio), 2, '.', '').'%');

        /*
        $puntuaciones = PuntuacionValoracion::join('valoracion', 'puntuacion_valoracion.valoracion_id', '=', 'valoracion.id')
          ->join('cms_users', 'cms_users.id', '=', 'valoracion.user_id')
          ->whereYear('valoracion.created_at', '=', $ano)
          ->whereMonth('valoracion.created_at', '=', $mes)
          ->where('cms_users.acargo', $acargo)
          ->where('puntuacion_valoracion.comportamiento_id',  $comportamiento->id)
          ;
          /* */

      }


      $promedio_comp = 0;

        if($cont_comp != 0){
          $promedio_comp = $puntuacion_comp/$cont_comp;
        }

        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($key+3, 3, number_format((float) $this->FormatAverage($promedio_comp), 2, '.', '').'%');


      $x = $x+3;
    }

    //$spreadsheet->getActiveSheet()->mergeCells('A1:H1');


      //Rename spreadsheet
      $spreadsheet->getActiveSheet()->setTitle('Reporte');

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

  }

  public function report_excel_por_mes(Request $request)
  {
      $value = $request->session()->get('admin_id', function() {
          return 'default';
      });

      $jefe = User::find($value);

      if(empty($jefe) || $jefe->acargo == 'No'){
          return redirect()->back();
      }


      return view('reportes_generales.report_excel_por_mes', compact("autoevaluacion"));
  }

  public function export_excel_por_mes(Request $request)
  {

      $value = $request->session()->get('admin_id', function() {
          return 'default';
      });

      $jefe = User::find($value);

      if(empty($jefe) || $jefe->acargo == 'No'){
          return redirect()->back();
      }

      //$maestro_indicadores = MaestroIndicadores::all();

      $ano      = $request->ano;
      $acargo   = null;

      $meses    = [];

      for ($i=1; $i <= 12 ; $i++) {
        # code...
        if($i < 10){
          $meses[] = "0".$i;
        }else{
          $meses[] = $i;
        }
      }


      $spreadsheet = new Spreadsheet;

      //Set Document Properties
      $spreadsheet->getProperties()->setCreator('Reporte')
        ->setLastModifiedBy($jefe->name);

      //Add styles to header
      $styleArray = [
        'font' => ['bold' => true],
        'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
      ];
      $spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);

      //Auto fit column to content
      foreach(range('A','Z') as $columnID) {
        $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
      }

      $initial_x = 1;
      foreach ($meses as $key => $mes) {
        # code...
        $valoraciones_ids = Valoracion::select('valoracion.id')
        ->join('cms_users', 'cms_users.id', '=', 'valoracion.user_id')
        ->whereYear('valoracion.created_at', '=', $ano)
        ->whereMonth('valoracion.created_at', $mes)
        ->where('cms_users.acargo', $acargo)
        ->get();

        $valoraciones = Valoracion::whereIn('id',$valoraciones_ids->toArray())->get();

        if(!empty($valoraciones)){
          $mes_nombre = '';
          if($mes == '01'){
            $mes_nombre = 'ENERO';
          }

          if($mes == '02'){
            $mes_nombre = 'FEBRERO';
          }

          if($mes == '03'){
            $mes_nombre = 'MARZO';
          }

          if($mes == '04'){
            $mes_nombre = 'ABRIL';
          }

          if($mes == '05'){
            $mes_nombre = 'MAYO';
          }

          if($mes == '06'){
            $mes_nombre = 'JUNIO';
          }

          if($mes == '07'){
            $mes_nombre = 'JULIO';
          }

          if($mes == '08'){
            $mes_nombre = 'AGOSTO';
          }

          if($mes == '09'){
            $mes_nombre = 'SEPTIEMBRE';
          }

          if($mes == '10'){
            $mes_nombre = 'OCTUBRE';
          }

          if($mes == '11'){
            $mes_nombre = 'NOVIEMBRE';
          }

          if($mes == '12'){
            $mes_nombre = 'DICIEMBRE';
          }


          if( $request->acargo == 'true'){
              $acargo  = 'Si';
              $title ='CON PERSONAL A CARGO '.$mes_nombre.' '.$ano;
          }else{
              $acargo  = 'No';
              $title = 'SIN PERSONAL A CARGO '.$mes_nombre.' '.$ano;
          }


          $spreadsheet->getActiveSheet()->mergeCellsByColumnAndRow(1,$initial_x, 5, $initial_x);
          $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $initial_x, $title);
          $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $initial_x+1, "Indicadores");
          $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $initial_x+1, "Compentencias");


          //$competencias = Competencia::all();
          if($acargo == 'No'){
            $competencias = Competencia::all()->where('acargo', 0);
        }

        else
        {
            $competencias = Competencia::all()->where('acargo',1);
        }
          $y= 2;
          $x= 4;


          $indicadores = MaestroIndicadores::whereMonth('feha_creacion', $mes)->whereYear('feha_creacion', $ano)->get();
          $cont_indicador = 0;
          $puntuacion_indicador = 0;
          foreach ($indicadores as $key => $indicador) {
            # code...
            $puntuacion_indicador = $puntuacion_indicador + $indicador->desempeno;
            $cont_indicador = $cont_indicador+1;
          }

          $promedio_indicador = 0;

          if($cont_indicador != 0){
            $promedio_indicador = $puntuacion_indicador/$cont_indicador;
          }

          $spreadsheet->getActiveSheet()
              ->setCellValueByColumnAndRow(1, $initial_x+2,number_format((float) $promedio_indicador, 2, '.', '').'%');

          foreach ($competencias as $key => $competencia) {
            # code...
            $puntuacion_comp = 0;
            $cont_comp = 0;

            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($key+3, $initial_x+$x, $competencia->competencia);
            $spreadsheet->getActiveSheet()->mergeCellsByColumnAndRow(1,$initial_x+$x, 5, $initial_x+$x);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $initial_x+$x, $competencia->competencia);

            foreach ($competencia->comportamientos as $i => $comportamiento) {
              # code...
              $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($i+1, $initial_x+$x+1, $comportamiento->comportamiento);

              $puntuacion = 0;
              $cont = 0;

              foreach ($valoraciones as $k => $valoracion) {
                # code...
                foreach ($valoracion->puntuaciones as $e => $puntuacion_val) {
                  # code...
                  if($puntuacion_val->comportamiento_id == $comportamiento->id){
                    $puntuacion = $puntuacion + $puntuacion_val->puntuacion;
                    $cont = $cont+1;
                  }

                  if($puntuacion_val->competencia_id == $competencia->id){
                    $puntuacion_comp = $puntuacion_comp + $puntuacion_val->puntuacion;
                    $cont_comp = $cont_comp+1;
                  }

                }
              }

              $promedio = 0;

              if($cont != 0){
                $promedio = $puntuacion/$cont;
              }

              $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($i+1, $initial_x+$x+2, number_format((float)$this->FormatAverage($promedio), 2, '.', '').'%');

            }


            $promedio_comp = 0;

              if($cont_comp != 0){
                $promedio_comp = $puntuacion_comp/$cont_comp;
              }

              $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($key+3, 3, number_format((float)$this->FormatAverage($promedio_comp), 2, '.', '').'%');


            $x = $x+3;
          }

          $initial_x = $initial_x+11;

        }
      }













    /*

    /* */

    //$spreadsheet->getActiveSheet()->mergeCells('A1:H1');


      //Rename spreadsheet
      $spreadsheet->getActiveSheet()->setTitle('Reporte');

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

  }

  public function export_excel_por_ciclos(Request $request)
  {

      $value = $request->session()->get('admin_id', function() {
          return 'default';
      });

      $jefe = User::find($value);

      if(empty($jefe) || $jefe->acargo == 'No'){
          return redirect()->back();
      }

      //$maestro_indicadores = MaestroIndicadores::all();

      $ano      = $request->ano;
      $acargo   = null;

      $ciclos    = ["1", "2"];

      /*
      for ($i=1; $i <= 12 ; $i++) {
        # code...
        $meses[] = $i;
      }
      /* */


      $spreadsheet = new Spreadsheet;

      //Set Document Properties
      $spreadsheet->getProperties()->setCreator('Reporte')
        ->setLastModifiedBy($jefe->name);

      //Add styles to header
      $styleArray = [
        'font' => ['bold' => true],
        'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
      ];
      $spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);

      //Auto fit column to content
      foreach(range('A','Z') as $columnID) {
        $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
      }

      $initial_x = 1;
      foreach ($ciclos as $key => $ciclo) {
        # code...
        $valoraciones_ids = Valoracion::select('valoracion.id')
        ->join('cms_users', 'cms_users.id', '=', 'valoracion.user_id')
        ->whereYear('valoracion.created_at', '=', $ano)
        ->where('valoracion.periodo', '=', $ciclo)
        ->where('cms_users.acargo', $acargo)
        ->get();

        $valoraciones = Valoracion::whereIn('id',$valoraciones_ids->toArray())->get();

        if(!empty($valoraciones)){
          $mes_nombre = 'CICLO'.$ciclo;


          if( $request->acargo == 'true'){
              $acargo  = 'Si';
              $title ='CON PERSONAL A CARGO '.$mes_nombre.' '.$ano;
          }else{
              $acargo  = 'No';
              $title = 'SIN PERSONAL A CARGO '.$mes_nombre.' '.$ano;
          }


          $spreadsheet->getActiveSheet()->mergeCellsByColumnAndRow(1,$initial_x, 5, $initial_x);
          $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $initial_x, $title);
          $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $initial_x+1, "Indicadores");
          $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $initial_x+1, "Compentencias");


         // $competencias = Competencia::all();
         if($acargo == 'No'){
            $competencias = Competencia::all()->where('acargo', 0);
        }

        else
        {
            $competencias = Competencia::all()->where('acargo',1);
        }


          $y= 2;
          $x= 4;


          $indicadores = MaestroIndicadores::where('meta', $ciclo)->whereYear('feha_creacion', $ano)->get();
          $cont_indicador = 0;
          $puntuacion_indicador = 0;
          foreach ($indicadores as $key => $indicador) {
            # code...
            $puntuacion_indicador = $puntuacion_indicador + $indicador->desempeno;
            $cont_indicador = $cont_indicador+1;
          }

          $promedio_indicador = 0;

          if($cont_indicador != 0){
            $promedio_indicador = $puntuacion_indicador/$cont_indicador;
          }

          $spreadsheet->getActiveSheet()
              ->setCellValueByColumnAndRow(1, $initial_x+2,number_format((float)$promedio_indicador, 2, '.', '').'%');

          foreach ($competencias as $key => $competencia) {
            # code...
            $puntuacion_comp = 0;
            $cont_comp = 0;

            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($key+3, $initial_x+$x, $competencia->competencia);
            $spreadsheet->getActiveSheet()->mergeCellsByColumnAndRow(1,$initial_x+$x, 5, $initial_x+$x);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $initial_x+$x, $competencia->competencia);

            foreach ($competencia->comportamientos as $i => $comportamiento) {
              # code...
              $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($i+1, $initial_x+$x+1, $comportamiento->comportamiento);

              $puntuacion = 0;
              $cont = 0;

              foreach ($valoraciones as $k => $valoracion) {
                # code...
                foreach ($valoracion->puntuaciones as $e => $puntuacion_val) {
                  # code...
                  if($puntuacion_val->comportamiento_id == $comportamiento->id){
                    $puntuacion = $puntuacion + $puntuacion_val->puntuacion;
                    $cont = $cont+1;
                  }

                  if($puntuacion_val->competencia_id == $competencia->id){
                    $puntuacion_comp = $puntuacion_comp + $puntuacion_val->puntuacion;
                    $cont_comp = $cont_comp+1;
                  }

                }
              }

              $promedio = 0;

              if($cont != 0){
                $promedio = $puntuacion/$cont;
              }

              $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($i+1, $initial_x+$x+2, number_format((float)$this->FormatAverage($promedio), 2, '.', '').'%');

            }


            $promedio_comp = 0;

              if($cont_comp != 0){
                $promedio_comp = $puntuacion_comp/$cont_comp;
              }

              $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($key+3, 3, number_format((float)$this->FormatAverage($promedio_comp), 2, '.', '').'%');


            $x = $x+3;
          }

          $initial_x = $initial_x+11;

        }
      }













    /*

    /* */

    //$spreadsheet->getActiveSheet()->mergeCells('A1:H1');


      //Rename spreadsheet
      $spreadsheet->getActiveSheet()->setTitle('Reporte');

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

  }

  public function graphical_report(Request $request)
  {

    //$jefe = User::find($id);

    $mes                = $request->mes;
    $ano                = $request->ano;
    $competencies_label = [];
    $competencies_data = [];
    $indicador_data = [];

    if( $request->acargo == 'true'){
        $acargo  = 'Si';
    }else{
        $acargo  = 'No';
    }


    $valoraciones_ids = Valoracion::select('valoracion.id')
      ->join('cms_users', 'cms_users.id', '=', 'valoracion.user_id')
      ->whereYear('valoracion.created_at', '=', $ano)
      ->whereMonth('valoracion.created_at', '=', $mes)
      ->where('cms_users.acargo', $acargo)
      ->get();


    $valoraciones = Valoracion::whereIn('id',$valoraciones_ids->toArray())->get();

    //$competencias = Competencia::all();

    if($acargo == 'No'){
        $competencias = Competencia::all()->where('acargo', 0);
    }

    else
    {
        $competencias = Competencia::all()->where('acargo',1);
    }


    $indicadores = MaestroIndicadores::whereMonth('feha_creacion', $mes)->whereYear('feha_creacion', $ano)->get();
    $cont_indicador = 0;
    $puntuacion_indicador = 0;


    foreach ($indicadores as $key => $indicador) {
      # code...

      $puntuacion_indicador = $puntuacion_indicador + $indicador->desempeno;
      $cont_indicador = $cont_indicador+1;
    }

    $promedio_indicador = 0;


    if($cont_indicador != 0){
      $promedio_indicador = $puntuacion_indicador/$cont_indicador;
    }
    $indicador_data = round(  $promedio_indicador, 1);
    $puntuacion_comp = 0;
    $cont_comp = 0;
    $promedio_compentencia = 0;
    foreach ($competencias as $key => $competencia) {



      foreach ($valoraciones as $k => $valoracion) {
        # code...
        foreach ($valoracion->puntuaciones as $e => $puntuacion_val) {
          # code...


          if($puntuacion_val->competencia_id == $competencia->id){
            $puntuacion_comp = $puntuacion_comp + $puntuacion_val->puntuacion;
            $cont_comp = $cont_comp+1;
          }

        }
      }

      $competencies_label[] = array(
                                'id' => $competencia->id,
                                'name'=>$competencia->competencia
                              );

      $puntuacion_comp = 0;
      $cont_comp = 0;


      $promedio_comp = 0;

        if($cont_comp != 0){
          $promedio_comp = $puntuacion_comp/$cont_comp;
        }

      $competencies_data[] = round($this->FormatAverage($promedio_comp), 1);
    }

    return array(
      'status'              => 'ok',
      'competencies_label'  => $competencies_label,
      'competencies_data'   => $competencies_data,
      'indicador_data'      => $indicador_data
    );
  }

  public function graphical_report_behavior(Request $request)
  {
    //$jefe = User::find($id);
    $id                 = $request->id;
    $mes                = $request->mes;
    $ano                = $request->ano;
    $acargo             = null;


    //return array('id' => $id, 'mes' => $mes, 'ano' => $ano, 'acargo' => $acargo );
    $competencies_label = [];
    $competencies_data = [];

    $behavior_label = [];
    $behavior_data = [];


    if( $request->acargo == 'true'){
        $acargo  = 'Si';
    }else{
        $acargo  = 'No';
    }

    $valoraciones_ids = Valoracion::select('valoracion.id')
      ->join('cms_users', 'cms_users.id', '=', 'valoracion.user_id')
      ->whereYear('valoracion.created_at', '=', $ano)
      ->whereMonth('valoracion.created_at', '=', $mes)
      ->where('cms_users.acargo', $acargo)
      ->get();


    $valoraciones = Valoracion::whereIn('id',$valoraciones_ids->toArray())->get();



    $competencia = Competencia::find($id);

      $competencies_label[] = $competencia->competencia;

      $puntuacion_comp = 0;
      $cont_comp = 0;

      foreach ($competencia->comportamientos as $i => $comportamiento) {

        $puntuacion = 0;
        $cont = 0;
        $behavior_label[] = $comportamiento->comportamiento;

        foreach ($valoraciones as $k => $valoracion) {
          # code...
          foreach ($valoracion->puntuaciones as $e => $puntuacion_val) {
            # code...
            if($puntuacion_val->comportamiento_id == $comportamiento->id){
              $puntuacion = $puntuacion + $puntuacion_val->puntuacion;
              $cont = $cont+1;
            }

            if($puntuacion_val->competencia_id == $competencia->id){
              $puntuacion_comp = $puntuacion_comp + $puntuacion_val->puntuacion;
              $cont_comp = $cont_comp+1;
            }

          }
        }

        $promedio = 0;

        if($cont != 0){
          $promedio = $puntuacion/$cont;
        }

        $behavior_data[] = round($this->FormatAverage($promedio), 1);
      }

    return array(
      'status'              => 'ok',
      'behavior_label'      => $behavior_label,
      'behavior_data'       => $behavior_data,
    );
  }

  public function graphical_report_view(Request $request)
  {
    $value = $request->session()->get('admin_id', function() {
        return 'default';
    });

    $jefe = User::find($value);

    if(empty($jefe) || $jefe->acargo == 'No'){
        return redirect()->back();
    }

    return view('reportes_generales.report_graphic');
  }


  public function graphical_report_cycle(Request $request)
  {

    //$jefe = User::find($id);

    $cycle                = $request->cycle;
    $ano                = $request->ano;
    $competencies_label = [];
    $competencies_data = [];
    $indicador_data = [];
    $acargo = "";
    if( $request->acargo == 'true'){
        $acargo  = 'Si';
    }else{
        $acargo  = 'No';
    }


    $valoraciones_ids = Valoracion::select('valoracion.id', 'valoracion.periodo')
      ->join('cms_users', 'cms_users.id', '=', 'valoracion.user_id')
      ->whereYear('valoracion.created_at', '=', $ano)
      ->where('valoracion.periodo', '=', $cycle)
      ->where('cms_users.acargo', "=",$acargo)
      ->get();


    $valoraciones = Valoracion::whereIn('id',$valoraciones_ids->toArray())->get();


    //$competencias = Competencia::all();

    if($acargo == 'No'){
        $competencias = Competencia::all()->where('acargo', 0);
    }

    else
    {
        $competencias = Competencia::all()->where('acargo',1);
    }

    $indicadores = MaestroIndicadores::where('meta', $cycle)->whereYear('feha_creacion', $ano)->get();


    $cont_indicador = 0;
    $puntuacion_indicador = 0;


    foreach ($indicadores as $key => $indicador) {
      # code...

      $puntuacion_indicador = $puntuacion_indicador + $indicador->desempeno;
      $cont_indicador = $cont_indicador+1;
    }

    $promedio_indicador = 0;


    if($cont_indicador != 0){
      $promedio_indicador = $puntuacion_indicador/$cont_indicador;
    }
    $indicador_data = round($promedio_indicador, 1);
    $puntuacion_comp = 0;
    $cont_comp = 0;
    $promedio_compentencia = 0;
    foreach ($competencias as $key => $competencia) {



      foreach ($valoraciones as $k => $valoracion) {
        # code...
        foreach ($valoracion->puntuaciones as $e => $puntuacion) {
          # code...
          if($puntuacion->competencia_id == $competencia->id){
            $puntuacion_comp = $puntuacion_comp + $puntuacion->puntuacion;
            $cont_comp = $cont_comp+1;
          }

        }
      }

      $competencies_label[] = array(
                                'id' => $competencia->id,
                                'name'=>$competencia->competencia
                              );

      $promedio_comp = 0;

        if($cont_comp != 0){
          $promedio_comp = $puntuacion_comp/$cont_comp;
        }

      $competencies_data[] = round($this->FormatAverage($promedio_comp), 1);
    }

    return array(
      'status'              => 'ok',
      'competencies_label'  => $competencies_label,
      'competencies_data'   => $competencies_data,
      'indicador_data'      => $indicador_data
    );
  }

  public function graphical_report_behavior_cycle(Request $request)
  {

    //$jefe = User::find($id);
    $id                 = $request->id;
    $cycle              = $request->cycle;
    $ano                = $request->ano;
    $acargo             = null;


    //return array('id' => $id, 'mes' => $mes, 'ano' => $ano, 'acargo' => $acargo );
    $competencies_label = [];
    $competencies_data = [];

    $behavior_label = [];
    $behavior_data = [];


    if( $request->acargo == 'true'){
        $acargo  = 'Si';
    }else{
        $acargo  = 'No';
    }

    $valoraciones_ids = Valoracion::select('valoracion.id')
      ->join('cms_users', 'cms_users.id', '=', 'valoracion.user_id')
      ->whereYear('valoracion.created_at', '=', $ano)
      ->where('valoracion.periodo', '=', $cycle)
      ->where('cms_users.acargo', $acargo)
      ->get();

    $valoraciones = Valoracion::whereIn('id',$valoraciones_ids->toArray())->get();


    $competencia = Competencia::find($id);

      $competencies_label[] = $competencia->competencia;

      $puntuacion_comp = 0;
      $cont_comp = 0;

      foreach ($competencia->comportamientos as $i => $comportamiento) {

        $puntuacion = 0;
        $cont = 0;
        $behavior_label[] = $comportamiento->comportamiento;

        foreach ($valoraciones as $k => $valoracion) {
          # code...
          foreach ($valoracion->puntuaciones as $e => $puntuacion_val) {
            # code...
            if($puntuacion_val->comportamiento_id == $comportamiento->id){
              $puntuacion = $puntuacion + $puntuacion_val->puntuacion;
              $cont = $cont+1;
            }

            if($puntuacion_val->competencia_id == $competencia->id){
              $puntuacion_comp = $puntuacion_comp + $puntuacion_val->puntuacion;
              $cont_comp = $cont_comp+1;
            }

          }
        }

        $promedio = 0;

        if($cont != 0){
          $promedio = $puntuacion/$cont;
        }

        $behavior_data[] = round($this->FormatAverage($promedio), 1);
      }

    return array(
      'status'              => 'ok',
      'behavior_label'      => $behavior_label,
      'behavior_data'       => $behavior_data,
    );
  }

  public function FormatAverage($average = null)
  {
    return $average * 100 /5;
  }

}
