<?php

namespace App\Http\Controllers;
use App\AdminMaestroIndicadoresController;
use Illuminate\Http\Request;


use DB;
use Auth;
use Session;
use CRUDBooster;


class Reportesgraficoscontroller extends Controller
{


  public function competencias(Request $request){
$ano    = $request->ano;
$ciclo   = $request->ciclo;
$acargo  = $request->acargo;
 switch ($acargo)
{
  case 'No': $cargonum = '0';
  break;
  case 'Si': $cargonum = '1';

}


$puntuacionfnl = DB::select(" SELECT
  co.competencia as 'competencia',
CASE
WHEN (pv.competencia_id = 1) OR (pv.competencia_id = 4 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 2) OR (pv.competencia_id = 5 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 3) OR (pv.competencia_id = 6 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
ELSE 0
END AS 'promedio'
FROM
cms_users AS u
JOIN valoracion AS v ON u.id = v.user_id
JOIN puntuacion_valoracion AS pv ON v.id = pv.valoracion_id
JOIN comportamiento AS c ON pv.comportamiento_id = c.id
JOIN competencia AS co ON c.idcompetencia = co.id
WHERE
v.created_at LIKE '%$ano%'
AND
v.periodo ='$ciclo'

AND co.acargo = '$cargonum'
GROUP BY pv.competencia_id
UNION ALL
SELECT
'Inidicadores',
ROUND(AVG(mi.desempeno),0)
 FROM
maestro_indicadores AS mi
JOIN cms_users AS u ON mi.documento = u.documento
WHERE
mi.meta ='$ciclo'
AND mi.feha_creacion LIKE '%$ano%'
AND mi.documento IN (
SELECT u.documento FROM
cms_users AS u
JOIN valoracion AS v ON v.user_id = u.id
JOIN puntuacion_valoracion AS pv ON pv.valoracion_id = v.id
JOIN competencia AS c ON c.id = pv.competencia_id
WHERE
c.acargo = '$cargonum'
GROUP BY u.id
)

");



$liderazgo = DB::select(" SELECT
c.comportamiento as 'competencia',
CASE
WHEN (pv.competencia_id = 1) OR (pv.competencia_id = 4 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 2) OR (pv.competencia_id = 5 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 3) OR (pv.competencia_id = 6 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
ELSE 0
END AS 'promedio'
FROM
cms_users AS u
JOIN valoracion AS v ON u.id = v.user_id
JOIN puntuacion_valoracion AS pv ON v.id = pv.valoracion_id
JOIN comportamiento AS c ON pv.comportamiento_id = c.id
JOIN competencia AS co ON c.idcompetencia = co.id
WHERE
v.created_at LIKE '%$ano%'
AND v.periodo ='$ciclo'
AND co.acargo = '$cargonum'
AND co.competencia = 'Liderazgo'
GROUP BY pv.comportamiento_id ");

$innovacion = DB::select(" SELECT
  c.comportamiento as 'competencia',
CASE
WHEN (pv.competencia_id = 1) OR (pv.competencia_id = 4 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 2) OR (pv.competencia_id = 5 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 3) OR (pv.competencia_id = 6 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
ELSE 0
END AS 'promedio'
FROM
cms_users AS u
JOIN valoracion AS v ON u.id = v.user_id
JOIN puntuacion_valoracion AS pv ON v.id = pv.valoracion_id
JOIN comportamiento AS c ON pv.comportamiento_id = c.id
JOIN competencia AS co ON c.idcompetencia = co.id
WHERE
v.created_at LIKE '%$ano%'
AND v.periodo ='$ciclo'
AND co.acargo = '$cargonum'
AND co.competencia = 'Innovación'
GROUP BY pv.comportamiento_id ");

$trabajoenequipo = DB::select(" SELECT
  c.comportamiento as 'competencia',
CASE
WHEN (pv.competencia_id = 1) OR (pv.competencia_id = 4 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 2) OR (pv.competencia_id = 5 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 3) OR (pv.competencia_id = 6 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
ELSE 0
END AS 'promedio'
FROM
cms_users AS u
JOIN valoracion AS v ON u.id = v.user_id
JOIN puntuacion_valoracion AS pv ON v.id = pv.valoracion_id
JOIN comportamiento AS c ON pv.comportamiento_id = c.id
JOIN competencia AS co ON c.idcompetencia = co.id
WHERE
v.created_at LIKE '%$ano%'
AND v.periodo ='$ciclo'
AND co.acargo = '$cargonum'
AND co.competencia = 'Trabajo en Equipo'
GROUP BY pv.comportamiento_id ");






$puntostrabajoenequipo = json_encode($trabajoenequipo);
$puntosinnovacion = json_encode($innovacion);
$liderpuntos = json_encode($liderazgo);
$puntua  = json_encode($puntuacionfnl);
return view('graficos/graficos',
          compact('puntua', 'liderpuntos','puntostrabajoenequipo','puntosinnovacion')
        );


}



}
