<?php

namespace App\Http\Controllers;
use App\AdminMaestroIndicadoresController;
use Illuminate\Http\Request;


use DB;
use Auth;
use Session;
use CRUDBooster;


class Reportesgraficoscomparar extends Controller
{


  public function comparar(Request $request){
$ano = $request->ano;
$ciclo = $request->ciclo;
$ano1 = $request->ano1;
$ciclo1 = $request->ciclo1;
$acargo  = $request->acargo;
 switch ($acargo)
{
  case 'No': $cargonum = '0';
  break;
  case 'Si': $cargonum = '1';

}

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
AND coa.acargo = '$cargonum'

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
AND co.acargo = '$cargonum'

UNION ALL
SELECT
'Inidicadores',
ROUND(AVG(mi.desempeno),0) AS 'promedio1',
(SELECT
ROUND(AVG(miz.desempeno),0)
 FROM
maestro_indicadores AS miz
JOIN cms_users AS uz ON miz.documento = uz.documento
WHERE
miz.meta ='$ciclo'
AND miz.feha_creacion LIKE '%$ano%'
AND miz.documento IN (
SELECT uz.documento FROM
cms_users AS uz
JOIN valoracion AS vz ON vz.user_id = uz.id
JOIN puntuacion_valoracion AS pvz ON pvz.valoracion_id = vz.id
JOIN competencia AS cz ON cz.id = pvz.competencia_id
WHERE
uz.acargo = '$acargo'
AND
cz.acargo = '$cargonum'
)

) AS 'promedio2'
 FROM
maestro_indicadores AS mi
JOIN cms_users AS u ON mi.documento = u.documento
WHERE
mi.meta ='$ciclo1'
AND mi.feha_creacion LIKE '%$ano1%'
AND mi.documento IN (
SELECT u.documento FROM
cms_users AS u
JOIN valoracion AS v ON v.user_id = u.id
JOIN puntuacion_valoracion AS pv ON pv.valoracion_id = v.id
JOIN competencia AS c ON c.id = pv.competencia_id
WHERE
u.acargo = '$acargo'
AND
c.acargo = '$cargonum'

)");


$puntuacionfnl = DB::select("SELECT
co.competencia as 'competencia',
CASE
WHEN (pv.competencia_id = 1) OR (pv.competencia_id = 4 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 2) OR (pv.competencia_id = 5 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 3) OR (pv.competencia_id = 6 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
ELSE 0
END AS 'promedio1',

(
SELECT
CASE
WHEN (pva.competencia_id = 1) OR (pva.competencia_id = 4 ) THEN ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
WHEN (pva.competencia_id = 2) OR (pva.competencia_id = 5 ) THEN ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
WHEN (pva.competencia_id = 3) OR (pva.competencia_id = 6 ) THEN ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
ELSE 0
END
FROM
cms_users AS ua
JOIN valoracion AS va ON ua.id = va.user_id
JOIN puntuacion_valoracion AS pva ON va.id = pva.valoracion_id
JOIN comportamiento AS ca ON pva.comportamiento_id = ca.id
JOIN competencia AS coa ON ca.idcompetencia = coa.id
WHERE
va.created_at LIKE '%$ano%'
AND va.periodo ='$ciclo'
AND coa.acargo = '$cargonum'
AND coa.id = co.id
GROUP BY co.id

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
AND co.acargo = '$cargonum'
GROUP BY co.id ");



$liderazgo = DB::select("SELECT
c.comportamiento as 'competencia',
CASE
WHEN (pv.competencia_id = 1) OR (pv.competencia_id = 4 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 2) OR (pv.competencia_id = 5 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 3) OR (pv.competencia_id = 6 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
ELSE 0
END AS 'promedio1',
(
SELECT
CASE
WHEN (pva.competencia_id = 1) OR (pva.competencia_id = 4 ) THEN ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
WHEN (pva.competencia_id = 2) OR (pva.competencia_id = 5 ) THEN ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
WHEN (pva.competencia_id = 3) OR (pva.competencia_id = 6 ) THEN ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
ELSE 0
END AS 'promedio'
FROM
cms_users AS ua
JOIN valoracion AS va ON ua.id = va.user_id
JOIN puntuacion_valoracion AS pva ON va.id = pva.valoracion_id
JOIN comportamiento AS ca ON pva.comportamiento_id = ca.id
JOIN competencia AS coa ON ca.idcompetencia = coa.id
WHERE
va.created_at LIKE '%$ano%'
AND va.periodo ='$ciclo'
AND coa.acargo = '$cargonum'
AND coa.competencia = 'Liderazgo'
AND ca.id = c.id
GROUP BY ca.id
) AS 'promedio2'
FROM
cms_users AS u
JOIN valoracion AS v ON u.id = v.user_id
JOIN puntuacion_valoracion AS pv ON v.id = pv.valoracion_id
JOIN comportamiento AS c ON pv.comportamiento_id = c.id
JOIN competencia AS co ON c.idcompetencia = co.id
WHERE
v.created_at LIKE '%$ano1%'
AND v.periodo ='$ciclo1'
AND co.acargo = '$cargonum'
AND co.competencia = 'Liderazgo'
GROUP BY c.id ");




$innovacion = DB::select("SELECT
c.comportamiento as 'competencia',
CASE
WHEN (pv.competencia_id = 1) OR (pv.competencia_id = 4 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 2) OR (pv.competencia_id = 5 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 3) OR (pv.competencia_id = 6 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
ELSE 0
END AS 'promedio1',
(
SELECT
CASE
WHEN (pva.competencia_id = 1) OR (pva.competencia_id = 4 ) THEN ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
WHEN (pva.competencia_id = 2) OR (pva.competencia_id = 5 ) THEN ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
WHEN (pva.competencia_id = 3) OR (pva.competencia_id = 6 ) THEN ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
ELSE 0
END AS 'promedio'
FROM
cms_users AS ua
JOIN valoracion AS va ON ua.id = va.user_id
JOIN puntuacion_valoracion AS pva ON va.id = pva.valoracion_id
JOIN comportamiento AS ca ON pva.comportamiento_id = ca.id
JOIN competencia AS coa ON ca.idcompetencia = coa.id
WHERE
va.created_at LIKE '%$ano%'
AND va.periodo ='$ciclo'
AND coa.acargo = '$cargonum'
AND coa.competencia = 'Innovación'
AND ca.id = c.id
GROUP BY ca.id
) AS 'promedio2'
FROM
cms_users AS u
JOIN valoracion AS v ON u.id = v.user_id
JOIN puntuacion_valoracion AS pv ON v.id = pv.valoracion_id
JOIN comportamiento AS c ON pv.comportamiento_id = c.id
JOIN competencia AS co ON c.idcompetencia = co.id
WHERE
v.created_at LIKE '%$ano1%'
AND v.periodo ='$ciclo1'
AND co.acargo = '$cargonum'
AND co.competencia = 'Innovación'
GROUP BY c.id");

$trabajoenequipo = DB::select("SELECT
c.comportamiento as 'competencia',
CASE
WHEN (pv.competencia_id = 1) OR (pv.competencia_id = 4 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 2) OR (pv.competencia_id = 5 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
WHEN (pv.competencia_id = 3) OR (pv.competencia_id = 6 ) THEN ROUND(SUM(pv.puntuacion)/COUNT(pv.comportamiento_id)*100/5,0)
ELSE 0
END AS 'promedio1',
(
SELECT
CASE
WHEN (pva.competencia_id = 1) OR (pva.competencia_id = 4 ) THEN ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
WHEN (pva.competencia_id = 2) OR (pva.competencia_id = 5 ) THEN ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
WHEN (pva.competencia_id = 3) OR (pva.competencia_id = 6 ) THEN ROUND(SUM(pva.puntuacion)/COUNT(pva.comportamiento_id)*100/5,0)
ELSE 0
END AS 'promedio'
FROM
cms_users AS ua
JOIN valoracion AS va ON ua.id = va.user_id
JOIN puntuacion_valoracion AS pva ON va.id = pva.valoracion_id
JOIN comportamiento AS ca ON pva.comportamiento_id = ca.id
JOIN competencia AS coa ON ca.idcompetencia = coa.id
WHERE
va.created_at LIKE '%$ano%'
AND va.periodo ='$ciclo'
AND coa.acargo = '$cargonum'
AND coa.competencia = 'Trabajo en Equipo'
AND ca.id = c.id
GROUP BY ca.id
) AS 'promedio2'
FROM
cms_users AS u
JOIN valoracion AS v ON u.id = v.user_id
JOIN puntuacion_valoracion AS pv ON v.id = pv.valoracion_id
JOIN comportamiento AS c ON pv.comportamiento_id = c.id
JOIN competencia AS co ON c.idcompetencia = co.id
WHERE
v.created_at LIKE '%$ano1%'
AND v.periodo ='$ciclo1'
AND co.acargo = '$cargonum'
AND co.competencia = 'Trabajo en Equipo'
GROUP BY c.id");



return view('graficos/grafico_comparar',
            compact('puntuacionfnl','liderazgo','trabajoenequipo','innovacion','ciclo','ano','acargo','ciclo1','ano1','totales')
);



}



}
