<?php

namespace App\Http\Controllers;
use App\AdminMaestroIndicadoresController;
use Illuminate\Http\Request;


use DB;
use Auth;
use Session;
use CRUDBooster;


class Reportejefecompara extends Controller
{


  public function comparar(Request $request){
$ano = $request->ano;
$ciclo = $request->ciclo;
$ano1 = $request->ano1;
$ciclo1 = $request->ciclo1;
$jefe = CRUDBooster::myCargoid();
$jefe2 = CRUDBooster::myId();

$totales = DB::select("SELECT
'Competencias' as 'competencia',
ROUND(AVG((mp.promedio*100/5)),1) as'promedio1',
(
SELECT
ROUND(AVG((mp.promedio*100/5)),1) as'promedio1'
FROM
Matriz_de_puntuacion as mp
WHERE
mp.evaluador_id = '$jefe2'
AND mp.ano =  '$ano'
AND mp.periodo = '$ciclo'

) as 'promedio2'
FROM
Matriz_de_puntuacion as mp
WHERE
mp.evaluador_id = '$jefe2'
AND mp.ano =  '$ano1'
AND mp.periodo = '$ciclo1'

UNION ALL
SELECT
'Inidicadores',
ROUND(AVG(mi.desempeno),1) AS 'promedio1',
(
SELECT
ROUND(AVG(miz.desempeno),1)
FROM
valoracion AS vz
JOIN cms_users AS uz ON vz.user_id = uz.id
JOIN maestro_indicadores AS miz ON miz.documento = uz.documento
WHERE
miz.meta = vz.periodo
AND vz.evaluador_id = '$jefe2'
AND vz.periodo = '$ciclo'
AND miz.feha_creacion LIKE '%$ano%'
)AS 'promedio2'
FROM
valoracion AS v
JOIN cms_users AS u ON v.user_id = u.id
JOIN maestro_indicadores AS mi ON mi.documento = u.documento
WHERE
mi.meta = v.periodo
AND v.evaluador_id = '$jefe2'
AND v.periodo = '$ciclo1'
AND mi.feha_creacion LIKE '%$ano1%'
");


$puntuacionfnl = DB::select("SELECT
mp.competencia as 'competencia',
ROUND(AVG((mp.promedio*100/5)),1) as'promedio1',
(
SELECT
ROUND(AVG((mpa.promedio*100/5)),1)
FROM
Matriz_de_puntuacion as mpa
WHERE
mpa.evaluador_id = '$jefe2'
AND mpa.ano = '$ano'
AND mpa.periodo = '$ciclo'
AND mpa.competencia = mp.competencia
GROUP BY mpa.competencia

) as 'promedio2'
FROM
Matriz_de_puntuacion as mp
WHERE
mp.evaluador_id = '$jefe2'
AND mp.ano = '$ano1'
AND mp.periodo = '$ciclo1'
GROUP BY mp.competencia");


$innovacion = DB::select("SELECT
mp.compoetamiento as 'competencia',
ROUND(AVG((mp.promedio*100/5)),1) as'promedio1',
(
SELECT
ROUND(AVG((mpa.promedio*100/5)),1)
FROM
Matriz_de_puntuacion as mpa
WHERE
mpa.evaluador_id = '$jefe2'
AND mpa.ano = '$ano'
AND mpa.periodo = '$ciclo'
AND mpa.competencia = 'Innovación'
AND mpa.compoetamiento = mp.compoetamiento
GROUP BY mpa.compoetamiento

) as 'promedio2'
FROM
Matriz_de_puntuacion as mp
WHERE
mp.evaluador_id = '$jefe2'
AND mp.ano = '$ano1'
AND mp.periodo = '$ciclo1'
AND mp.competencia = 'Innovación'
GROUP BY mp.compoetamiento ");


$trabajoenequipo = DB::select("SELECT
mp.compoetamiento as 'competencia',
ROUND(AVG((mp.promedio*100/5)),1) as'promedio1',
(
SELECT
ROUND(AVG((mpa.promedio*100/5)),1)
FROM
Matriz_de_puntuacion as mpa
WHERE
mpa.evaluador_id = '$jefe2'
AND mpa.ano = '$ano'
AND mpa.periodo = '$ciclo'
AND mpa.competencia = 'Trabajo en Equipo'
AND mpa.compoetamiento = mp.compoetamiento
GROUP BY mpa.compoetamiento

) as 'promedio2'
FROM
Matriz_de_puntuacion as mp
WHERE
mp.evaluador_id = '$jefe2'
AND mp.ano = '$ano1'
AND mp.periodo = '$ciclo1'
AND mp.competencia = 'Trabajo en Equipo'
GROUP BY mp.compoetamiento");



return view('graficos/grafico_comparar_jefe',
            compact('puntuacionfnl','trabajoenequipo','innovacion','ciclo','ano','acargo','ciclo1','ano1','totales')
);



}



}
