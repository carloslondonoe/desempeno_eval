<?php

namespace App\Http\Controllers;
use App\AdminMaestroIndicadoresController;
use Illuminate\Http\Request;


use DB;
use Auth;
use Session;
use CRUDBooster;


class Reportesgraficoscompararfull extends Controller
{


  public function compararfull(Request $request){
$ano = $request->ano;
$ciclo = $request->ciclo;
$ano1 = $request->ano1;
$ciclo1 = $request->ciclo1;
//$acargo  = $request->acargo;
 /*switch ($acargo)
{
  case 'No': $cargonum = '0';
  break;
  case 'Si': $cargonum = '1';

}
*/
$totales = DB::select("SELECT
'Competencias' as 'competencia',
ROUND((
ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)+
ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)+
ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
)/3 ,0) AS 'promedio1',

(
SELECT
ROUND((
ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)+
ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)+
ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
)/3 ,0)
FROM
cms_users AS ua
JOIN valoracion AS va ON ua.id = va.user_id
JOIN puntuacion_valoracion AS pva ON va.id = pva.valoracion_id
JOIN comportamiento AS ca ON pva.comportamiento_id = ca.id
JOIN competencia AS coa ON ca.idcompetencia = coa.id
WHERE
va.created_at LIKE '%$ano%'
AND va.periodo ='$ciclo'

) AS 'promedio2'

FROM
cms_users AS u
JOIN valoracion AS v ON u.id = v.user_id
JOIN puntuacion_valoracion AS pv ON v.id = pv.valoracion_id
JOIN comportamiento AS c ON pv.comportamiento_id = c.id
JOIN competencia AS co ON c.idcompetencia = co.id
WHERE
v.created_at LIKE '%$ano1%'
AND
v.periodo ='$ciclo1'

UNION ALL
SELECT
'Inidicadores',
ROUND(AVG(mi.desempeno),0) AS 'promedio1',
(SELECT
ROUND(AVG(miz.desempeno),0)
 FROM
maestro_indicadores AS miz
WHERE
miz.meta ='$ciclo'
AND miz.feha_creacion LIKE '%$ano%'

) AS 'promedio2'
 FROM
maestro_indicadores AS mi
WHERE
mi.meta ='$ciclo1'
AND mi.feha_creacion LIKE '%$ano1%' ");


$puntuacionfnl = DB::select("SELECT
vc.competencia AS 'competencia',
ROUND(AVG(vc.promedio),0) AS 'promedio1',
(
SELECT
ROUND(AVG(vca.promedio),0)
FROM
vista_competencias AS vca
WHERE
vca.ano = '$ano'
AND
vca.periodo ='$ciclo'
AND
vca.competencia = vc.competencia
GROUP BY
vca.competencia
) AS 'promedio2'
 FROM
vista_competencias AS vc
WHERE
vc.ano = '$ano1'
AND
vc.periodo = '$ciclo1'
GROUP BY
vc.competencia");


$innovacion = DB::select("SELECT
vc.compoetamiento AS 'competencia',
ROUND(AVG(vc.promedio),0) AS 'promedio1',
(
SELECT
ROUND(AVG(vca.promedio),0)
FROM
vista_comportamientos AS vca
WHERE
vca.ano = '$ano'
AND
vca.periodo ='$ciclo'
AND
vca.compoetamiento = vc.compoetamiento
GROUP BY
vca.compoetamiento
) AS 'promedio2'
 FROM
vista_comportamientos AS vc
WHERE
vc.ano = '$ano1'
AND
vc.periodo = '$ciclo1'
AND
vc.competencia = 'Innovación'
GROUP BY
vc.compoetamiento");




$trabajoenequipo = DB::select("SELECT
vc.compoetamiento AS 'competencia',
ROUND(AVG(vc.promedio),0) AS 'promedio1',
(
SELECT
ROUND(AVG(vca.promedio),0)
FROM
vista_comportamientos AS vca
WHERE
vca.ano = '$ano'
AND
vca.periodo = '$ciclo'
AND
vca.compoetamiento = vc.compoetamiento
GROUP BY
vca.compoetamiento
) AS 'promedio2'
 FROM
vista_comportamientos AS vc
WHERE
vc.ano = '$ano1'
AND
vc.periodo = '$ciclo1'
AND
vc.competencia = 'Trabajo en Equipo'
GROUP BY
vc.compoetamiento");



return view('graficos/grafico_comparar_full',
            compact('puntuacionfnl','trabajoenequipo','innovacion','ciclo','ano','ciclo1','ano1','totales')
);



}



}
