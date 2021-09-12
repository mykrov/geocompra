<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermisosController extends Controller
{
    public function index(){

        $menu = DB::table('GEOMENU')->get();
        $opcion = DB::table('GEOOPCION')->get();
        $accesos = DB::table('GEOACCESOS')->get();
        $usuarios = DB::table('GEOUSUARIO')->get(); 

        return view('permisos.index',[
            'menus'=>$menu,
            'opcion'=>$opcion,
            'accesos'=>$accesos,
            'usuarios'=>$usuarios,
            'userbuscado'=>0
        ]);

    }

    public function EditarPermiso(Request $r){
        
        $idAcceso = $r['idacceso'];
        $idUsuario = $r['idusuario'];
        $stado = $r['estado'];

        try {
            $try = DB::statement("Update GEOACCESOS SET ESTADO = '".$stado."' where IDACCESO = ".$idAcceso."and IDUSUARIO=".$idUsuario.";" );

            return response()->json([
                "status"=>"ok",
                "success" => true,
                "message" => "Permiso modificado"
                
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "error modificando permiso"
                
            ]);
        }        
    }

    public function BuscarPermisos($iduser){
        
        $menu = DB::table('GEOMENU')->get();
        $opcion = DB::table('GEOOPCION')->get();
        $accesos = DB::table('GEOACCESOS')->get();
        $usuarios = DB::table('GEOUSUARIO')->get(); 

        return view('permisos.index',[
            'menus'=>$menu,
            'opcion'=>$opcion,
            'accesos'=>$accesos,
            'usuarios'=>$usuarios,
            'userbuscado'=>$iduser

        ]);
    }

    public function CrearPermisosBasicos($iduser){

    }
}
