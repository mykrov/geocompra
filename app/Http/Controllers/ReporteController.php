<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use AuthComtroller;
use Session;

class ReporteController extends Controller
{
    public function Index(){
        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];
        
        $empresas = DB::table('GEOEMPRESA')->where('IDEMPRESA',$idEmpresa)->get();

        if(Session::get('rol') == 'PRO'){
            $empresas = DB::table('GEOEMPRESA')->get();
        }
        
        return view('reporte.index',['empresas'=>$empresas]);
    }

    public function BuscaReporte(Request $r){

        $desde = $r['fechadesde'];
        $hasta = $r['fechahasta'];

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $dataUsuario = $session2['usuario'];
        $idEmpresa = $empresadata['IDEMPRESA'];
        
        if($r['tipoinforme'] == 'empresas'){
            Log::info('Reporte de Empresas');
            return $this->BuscaEmpresas($desde,$hasta,$idEmpresa);
        }elseif($r['tipoinforme'] == 'comisiones'){

        }
       
    }

    public function BuscaEmpresas($desde,$hasta,$idEmpresa){
        $rol = Session::get('rol');
        if($rol == 'PRO'){
            $items = DB::table('GEOEMPRESA')
            ->join('GEOPROVINCIA','GEOPROVINCIA.IDPROVINCIA','GEOEMPRESA.IDPROVINCIA')       
            ->select([
                'GEOEMPRESA.IDEMPRESA',
                'GEOEMPRESA.RAZONSOCIAL',
                'GEOEMPRESA.RUC',
                'GEOEMPRESA.CORREO',
                'GEOPROVINCIA.NOMBRE as PROVINCIA',
                'GEOEMPRESA.ESTADO',
                'GEOEMPRESA.AMBIENTE',
                'GEOEMPRESA.CONTRIBUYENTEESPECIAL',
                'GEOEMPRESA.OBLIGADOCONTA',
            ])
            ->get();
            return view('reporte.empresas',['empresas'=>$items]);
        }else{
            $items = DB::table('GEOEMPRESA')
            ->where('IDEMPRESA', $idEmpresa)
            ->join('GEOPROVINCIA','GEOPROVINCIA.IDPROVINCIA','GEOEMPRESA.IDPROVINCIA')       
            ->select([
                'GEOEMPRESA.IDEMPRESA',
                'GEOEMPRESA.RAZONSOCIAL',
                'GEOEMPRESA.RUC',
                'GEOEMPRESA.CORREO',
                'GEOPROVINCIA.NOMBRE as PROVINCIA',
                'GEOEMPRESA.ESTADO',
                'GEOEMPRESA.AMBIENTE',
                'GEOEMPRESA.CONTRIBUYENTEESPECIAL',
                'GEOEMPRESA.OBLIGADOCONTA',
            ])
            ->get();
            return view('reporte.empresas',['empresas'=>$items]);
        }
    }

    public function comisiones($desde,$hasta,$idEmpresa){

    }
}
