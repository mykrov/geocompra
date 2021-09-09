<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermisosController extends Controller
{
    public function index(){

        $menu = DB::table('GEOMENU')->get();
        $opcion = DB::table('GEOOPCION')->get();
        $accesos = DB::table('GEOACCESOS')->get();
        $usuarios = DB::table('GEOUSUARIO')->get(); 

        return view('permisos',[
            'menus'=>$menu,
            'opcion'=>$opcion,
            'accesos'=>$accesos,
            'usuarios'=>$usuarios
        ]);

    }
}
