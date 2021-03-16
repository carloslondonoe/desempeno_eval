<?php

namespace App\Http\Controllers;
use App\AdminMaestroIndicadoresController;
use Illuminate\Http\Request;


use DB;
use Auth;
use Session;
use CRUDBooster;

class Reporte_viajes extends Controller

{

public function viajes(Request $request ){

$idvjs = $request->vjs;
$rechazo = $request->rechazar;
$autoriza = $request->autorizar;

if (empty($idvjs)){
}
else{
  $upgestion = DB::UPDATE("UPDATE destinos SET gestion = 1 WHERE id = '$idvjs' ");
}

if(empty($rechazo)){ }else{ $uprechazo = DB::UPDATE("UPDATE solicitud_tiquetes SET autorizado = 'rechazado' WHERE id = '$rechazo' "); }

if(empty($autoriza)){ }else{ $upautoriza = DB::UPDATE("UPDATE solicitud_tiquetes SET autorizado = 'confirmado' WHERE id = '$autoriza' "); }

$rptviajes = DB::select("SELECT
d.id as 'id',
st.id as 'idst',
d.gestion as 'gestion',
u.documento as 'documento',
u.name as 'nombre',
u.apellido as 'apellido',
u.email as 'correo',
c.cargo as 'cargo',
st.autorizado as 'autorizado',
st.motivo as 'motivo',
st.proyecto as 'proyecto',
st.direccion as 'direccion',
st.reserva_hotelera as 'reservah',
st.taxi as 'taxi',
st.observaciones as 'observaciones',
d.destino as 'destino',
d.dia_salida as 'dsalida',
d.dia_regreso as 'dregreso',
d.hora_salida as 'hsalida',
d.hora_regreso as 'hregreso',
DATE_FORMAT(st.created_at ,'%Y/%m/%d') as 'soliciado'
FROM
destinos AS d
JOIN solicitud_tiquetes AS st ON d.solicitud_tiquete_id = st.id
JOIN cms_users AS u ON st.user_id = u.id
JOIN cargo AS c ON u.cargoid = c.id
ORDER BY d.gestion ASC, st.created_at DESC
");

return view('solicitudes_tiquetes/viajesfull',
          compact('rptviajes')
                );

}

}
