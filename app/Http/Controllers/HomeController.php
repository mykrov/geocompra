<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function Index(Request $request){
        
        if($request->session()->has('usuario'))
        {
            $session2 = Session::get('usuario');
            $empresadata = $session2['empresa']; 
            $idEmpresa = $empresadata['IDEMPRESA'];
            $date = Carbon::now();

            $usuarios = DB::table('GEOUSUARIO')
            ->where('IDEMPRESA',$idEmpresa)
            ->get();

            //facturas que sean del dia.
            $facturas = DB::table('GEOCABFACTURA')
            ->where('IDEMPRESA',$idEmpresa)
            ->whereBetween('FECHAEMI',[ $date->format('d-m-Y'),$date->format('d-m-Y')])
            ->get();

            //diaria.
            $compras = DB::table('GEOCABINGRESO')
            ->where('IDEMPRESA',$idEmpresa)
            ->whereBetween('FECHAEMI',[ $date->format('d-m-Y'),$date->format('d-m-Y')])
            ->get();

            //diario.
            $comisiones = DB::table('GEOCOMISIONES')
            ->whereBetween('FECHACREACION',[ $date->format('d-m-Y'),$date->format('d-m-Y')])
            ->get();

            //rango de un mes para los charts . para PRO todos.
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
