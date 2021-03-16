<?php
namespace App\Http\Controllers;

use App\User;
use App\Cargo;
use App\OrdenCargo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CargosController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */

    public function index(Request $request)
    {

        $value = $request->session()->get('admin_id', function() {
            return 'default';
        });

        $user = User::find($value);

        if(empty($user)){
            return redirect()->back();
        }

        if($user->acargo == 'No'){
            return redirect()->back();
        }


        $cargos = Cargo::paginate(12);
        $cargos_select = Cargo::all();
        return view('cargos.index', compact("cargos", "orden_cargos", "cargos_select"));
    }

    public function show($id)
    {
        return view('cargos.create');
    }

    public function search(Request $request)
    {
        if($request->ajax()){
            $cargo = Cargo::find($request->id) ;
            $orden_cargos = OrdenCargo::where('lider_id', "=",$request->id)
                                    ->get();
            return array($cargo,  $orden_cargos);
        }
    }

    public function save_orden_cargos(Request $request)
    {
        if($request->ajax()){
            $cargo = Cargo::find($request->id) ;
            OrdenCargo::where('lider_id', $request->id)->delete();
            $cargos_nuevos = $request->orden_cargos;
            if(!empty($cargos_nuevos)){
                foreach ($cargos_nuevos as $key => $new_cargo) {
                    $orden_cargo = new OrdenCargo();
                    $orden_cargo->lider_id = $request->id;
                    $orden_cargo->cargo_id = $new_cargo;

                    $orden_cargo->save();
                }
                /* */
            }
            return array('status' => 'ok');
        }
    }

}
