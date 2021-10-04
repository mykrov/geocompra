<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use AuthComtroller;
use Session;

class DashboardController extends Controller
{
    public function DataDashboard(){
        
        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $usuarios = DB::table('GEOUSUARIO')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        $facturas = DB::table('GEOCABFACTURA')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        $compras = DB::table('GEOCABINGRESO')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        $comisiones = DB::table('GEOCOMISIONES')
        ->get();

        $chart1 = DB::table('GEOCABFACTURA')
        ->where('IDEMPRESA', $idEmpresa)
        ->select('FECHAEMI', DB::raw('count(FECHAEMI) as TOTAL'))
        ->groupBy('FECHAEMI')
        ->get();

        return $chart1;

        return view('index',[
            'facturas'=>$facturas,
            'compras'=>$compras,
            'usuarios'=>$usuarios,
            'comisiones'=>$comisiones,
            'chart1'=>$chart1
        ]);
        
    }
}
