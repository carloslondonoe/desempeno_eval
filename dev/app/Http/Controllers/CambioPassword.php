<?php
namespace App\Http\Controllers;
use App\AdminMaestroIndicadoresController;
use Illuminate\Http\Request;
use App\User;


use DB;
use Auth;
use Session;
use CRUDBooster;


class CambioPassword extends Controller
{

public function password(Request $request){

$newpassword = $request->password;

$iduser = CRUDBooster::myId();


IF($newpassword == '')
{
  
}
ELSE {

$actualizar = DB::update(" UPDATE cms_users SET password = '$newpassword'  WHERE id = '$iduser' ");

}

/*
$actualizar = DB::table('cms_users')
              ->where('id', '= ', $iduser)
              ->update(['password' => $newpassword]);

*/


//$cambio = DB::select("SELECT u.email FROM cms_users AS u WHERE u.id = $iduser ");




  return view('password/password',
            compact('newpassword')
          );



}


}
