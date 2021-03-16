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


use App\TemporalValoracion;

class MaestroIndicadorController extends Controller
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


        return view('maestro_indicadores.report_excel', compact("autoevaluacion"));
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

        $periodo = $request->periodo;
        $ano     = $request->ano;
        $acargo  = null;

        if( $request->acargo == 'true'){
            $acargo  = 'Si';
            $title = 'Indicadores con personal acargo';
        }else{
            $acargo  = 'No';
            $title = 'Indicadores sin personal acargo';
        }

        //$maestro_indicadores = MaestroIndicadores::whereYear('feha_creacion', '=', $ano)
        //                    ->whereIn('documento', $users->toArray()) ->get();
        $maestro_indicadores = MaestroIndicadores::select('documento')->whereYear('feha_creacion', '=', $ano)
                                                            ->get();

        $users = User::where('acargo', $acargo)->whereIn('documento', $maestro_indicadores->toArray())->get();

        $spreadsheet = new Spreadsheet;

      //Set Document Properties
      $spreadsheet->getProperties()->setCreator('Plataforma de Formacióm')
      ->setLastModifiedBy($jefe->name)
      ->setTitle('Reporte indicadores');

      //Add styles to header
      $styleArray = [
        'font' => ['bold' => true],
        'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
      ];

      $spreadsheet->getActiveSheet()->getStyle('A1:O1')->applyFromArray($styleArray);

      $spreadsheet->getActiveSheet()->mergeCells('A1:O1');
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
        ->setCellValue("A1", $title)
        ->setCellValue("A2", "ÁREA")
        ->setCellValue("B2", "EMPLEADO")
        ->setCellValue("C2", "PROMEDIO INDIVIDUAL")
        ->setCellValue("D2", "MES1")
        ->setCellValue("E2", "MES2")
        ->setCellValue("F2", "MES3")
        ->setCellValue("G2", "MES4")
        ->setCellValue("H2", "MES5")
        ->setCellValue("I2", "MES6")
        ->setCellValue("J2", "MES7")
        ->setCellValue("K2", "MES8")
        ->setCellValue("L2", "MES9")
        ->setCellValue("M2", "MES10")
        ->setCellValue("N2", "MES11")
        ->setCellValue("O2", "MES12");

        //Add data to spreadsheet
        $x= 3;

        //add Values
        foreach ($users as $us) {

          $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $x, $us->cargo->obj_area->area);
          $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $x, $us->name.' '.$us->apellido);

          $maestro_indicadores = MaestroIndicadores::where('documento', $us->documento)->where('meta', $periodo)->whereYear('feha_creacion', $ano)->get();
          $puntuacion = 0;
          $cont = 0;

          $sum_desempeno = 0;
          $cont_desempeno = 0;
          $total_desempeno = 0;

          foreach ($maestro_indicadores as $key => $indicadores) {
            # code...
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3 + date("m", strtotime($indicadores->feha_creacion)), $x, $indicadores->desempeno.'%');


            $sum_desempeno = $sum_desempeno + $indicadores->desempeno;
            $cont_desempeno = $cont_desempeno+1;
          }



          $promedio = 0;
          if($cont_desempeno != 0){
            $total_desempeno =  $sum_desempeno/$cont_desempeno;
          }
         /* */

          $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, $x, number_format((float)$total_desempeno.'%'));
          $x++;
        }
        /* */


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



        //return view('valoraciones.export_excel', [
        //    'valoraciones' => $valoraciones,
        //]);
    }
}
