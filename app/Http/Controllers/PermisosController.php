<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\GEOACCESOS;

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

    public function AddPermisoUser($iduser,$tipo){
        
        $opciones =[];
        
        if($tipo == 'PRO'){
            $opciones = [2,3,5,6,7,8,9,11,12,13,15,17,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37];
        }else{
            $opciones = [6,7,11,15,21,23,25,28,31,34,39,38,40];
        }
        
        $opcionNOMenu = [9,10,3,13,27,30,33,17,36];
          
        foreach ($opciones as $key => $value) {
           
            $acceso = GEOACCESOS::where('IDUSUARIO',$iduser)
            ->where('IDOPCION',$value)
            ->count(); 

            if($acceso == 0){
                try {
                    $newAcceso = new GEOACCESOS();
                    $newAcceso->IDUSUARIO = $iduser;
                    $newAcceso->IDOPCION = $value;
                    $newAcceso->ESMENU = 'S';

                    if(in_array($value,$opcionNOMenu)){
                        $newAcceso->ESMENU = 'N';
                    }

                    $newAcceso->ESTADO = 'S';
                    $newAcceso->save();
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }                
           }
        }
    }
}
