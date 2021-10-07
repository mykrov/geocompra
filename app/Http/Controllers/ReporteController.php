<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use AuthComtroller;
use Carbon\Carbon;
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

        Log::info('empresa buscada'. $r['idempresa']);

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $dataUsuario = $session2['usuario'];
        $idEmpresa = $empresadata['IDEMPRESA'];
        
        if($r['tipoinforme'] == 'empresas'){
            return $this->BuscaEmpresas($desde,$hasta,$r['idempresa']);
        }elseif($r['tipoinforme'] == 'ventas'){
            return $this->BuscarVentas($desde,$hasta,$r['idempresa']);
        }elseif($r['tipoinforme'] == 'comisiones'){
            return $this->BuscarComisiones($desde,$hasta,$r['idempresa']);
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

    public function BuscarVentas($desde,$hasta,$idEmpresa){

        $f1 = Carbon::createFromFormat('Y-m-d',$desde);
        $f2 = Carbon::createFromFormat('Y-m-d',$hasta);
        $fecD = $f1->format('d-m-Y ').'00:00:00';
        $fecH = $f2->format('d-m-Y ').'00:00:00';
        
        $facturas = DB::table('GEOCABFACTURA')
        ->join('GEOCLIENTE','GEOCABFACTURA.CLIENTE','GEOCLIENTE.IDCLIENTE')
        ->where('GEOCABFACTURA.IDEMPRESA',$idEmpresa)
        ->whereBetween('GEOCABFACTURA.FECHAEMI',array($fecD, $fecH))
        ->select([
            'GEOCABFACTURA.FECHAEMI',
            'GEOCABFACTURA.NUMEROFAC',
            'GEOCLIENTE.NOMBRECLIENTE as CLIENTE',
            'GEOCABFACTURA.SUBTOTALFAC',
            'GEOCABFACTURA.SUBTOTAL0',
            'GEOCABFACTURA.IVAFAC',
            'GEOCABFACTURA.NETOFAC',
            'GEOCABFACTURA.ESTADOPROCESO as ESTADO'
        ])
        ->get();
        
        return view('reporte.ventas',['ventas'=>$facturas]);

    }

    public function BuscarComisiones($desde,$hasta,$idEmpresa){
        
        $f1 = Carbon::createFromFormat('Y-m-d',$desde);
        $f2 = Carbon::createFromFormat('Y-m-d',$hasta);
        $fecD = $f1->format('d-m-Y ').'00:00:00';
        $fecH = $f2->format('d-m-Y ').'00:00:00';
        
        $comisiones = DB::table('GEOCOMISIONES')
        ->join('GEOEMPRESA','GEOCOMISIONES.IDEMPRESA','GEOEMPRESA.IDEMPRESA')
        ->where('GEOCOMISIONES.IDEMPRESA',$idEmpresa)
        ->whereBetween('GEOCOMISIONES.FECHACREACION',array($fecD, $fecH))
        ->select([
            'GEOCOMISIONES.FECHACREACION',
            'GEOEMPRESA.RAZONSOCIAL as EMPRESA',
            'GEOCOMISIONES.MONTO',
            'GEOCOMISIONES.SECUENCIALFAC',
        ])
        ->get();
        
        return view('reporte.comisiones',['comisiones'=>$comisiones]);
    }

   
}
