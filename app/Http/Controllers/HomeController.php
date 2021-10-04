<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function Index(Request $request){
        
        if($request->session()->has('usuario'))
        {
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

            $chart2 = DB::table('GEOCABFACTURA')
            ->where('IDEMPRESA', $idEmpresa)
            ->select('FECHAEMI', DB::raw('SUM(NETOFAC) as NETO'))
            ->groupBy('FECHAEMI')
            ->get();


            return view('index',[
                'facturas'=>$facturas,
                'compras'=>$compras,
                'usuarios'=>$usuarios,
                'comisiones'=>$comisiones,
                'chart1'=>$chart1,
                'chart2'=>$chart2
            ]);
                    
            //return view('index',['pagina'=>'Inicio','seccion'=>'Datos']);
        }else{
            return view('login');
        }  

    }
}
