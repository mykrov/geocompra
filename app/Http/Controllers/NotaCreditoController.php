<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GEONCRCAB;
use App\GEONCRDET;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use AuthComtroller;
use Session;
use Carbon\Carbon;

class NotaCreditoController extends Controller
{
    public function Index(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $ncrs = DB::table('GEONCRCAB')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        return view('ncr.index',['ncrs'=> $ncrs ]);
    }

    public function CrearNotaCredito(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $bodegas = DB::table('GEOBODEGA')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        $motivos = DB::table('GEOMOTIVO')->get();
       
        return view('ncr.crearncr',[
            'bodegas'=>  $bodegas,
            'motivos'=>  $motivos                          
        ]);
    }

    public function EditarCompra($id){
        
        $proveedores = DB::table('GEOPROVEEDOR')->get();
        $categorias = DB::table('GEOCATEGORIA')->get();
        $marcas =  DB::table('GEOMARCA')->get();
        $producto = GEOPRODUCTO::where('IDPRODUCTO',$id)->first();

        return view('producto.editarproducto',[
            'proveedores'=>$proveedores,
            'categorias'=>$categorias,
            'marcas'=>$marcas,
            'producto'=>$producto
        ]);
    }

    public function GuardaNcr(Request $r){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $usuariodata=$session2['usuario'];
        $idEmpresa = $empresadata['IDEMPRESA'];  
        
        $cabecera = $r[0]['cabecera'];
        $detalles = $r[0]['detalles'];

        
        try {    

            if(count($detalles) == 0){
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "No hay detalles en la Nota de Crédito.",
                    "logo" =>0,
                    "firma" =>0
                ]);
            }

        } catch (\Throwable $th) {
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Debe llenar todos los campos del documento.",
                "logo" =>0,
                "firma" =>0
            ]);            
        } 
        
        $cont = GEONCRCAB::where('SECFACTURA',trim($r['facsecuencial']))
        ->where('IDMOTIVO',$r['idmotivo'])
        ->count();

        if($cont == 0){
            
            $date = Carbon::now();
            $ncr = new GEONCRCAB(); 
            $ncr->SUBTOTALBNCR = $r["subtotalncr"];
            $ncr->DESCUENTONCR = $r["descuentoncr"];

            $ncr->IVAFAC = $r["ivafac"];
            $ncr->NETOFAC = $r["netofac"];
            $ncr->FECHAEMI = $date->format('d-m-Y');
            $ncr->SECFACTURA = $r["facsecuencial"];
            $ncr->CLAVEACCESO = "";
            $ncr->NOAUTORIZACION = "";
            $ncr->ARCHIVOXML = "";
            $ncr->FIRMAXML = "";
            $ncr->ARCHIVOAUTORIZADO= "";
            $ncr->ARCHIVOPDF= "";
            $ncr->ARCHIVOERROR = "";
            $ncr->CODERROR = "";
            $ncr->FECHAPROCESO = $r[""];
            $ncr->HORAPROCESO = $r[""];
            $ncr->ESTADOPROCESO = 'N';
            $ncr->IDUSUARIO = $usuariodata['IDUSUARIO'] ;
            $ncr->MOTIVO = $r["idmotivo"];
            $ncr->IDEMPRESA = $idEmpresa;
            $ncr->IDBODEGA = $r["idbodega"];

            try {
                DB::beginTransaction();
                $ncr->save();
                $linea =  1;
                foreach ($detalles as $key => $value) {
                    $deta = new GEONCRDET();
                   
                    $deta->IDEMPRESA= $idEmpresa;
                    $deta->IDSUCURSAL= 1;
                    $deta->LINEA= $linea;
                    $deta->IDITEM= $value['idproducto'];
                    $deta->CANTIDAD= $value['cantidad'];
                    $deta->PRECIO= $value['precio'];
                    $deta->SUBTOTAL= $value['subtotal'];
                    $deta->DESCUENTO= $value['descuento'];
                    $deta->IVA= $value['iva'];
                    $deta->NETO= $value['neto'];
                    $deta->PORIVA= $value['poriva'];
                    $deta->GRABAIVA= 'S';
                    $deta->SECUENCIALNCR = $ncr->SECUENCIALNCR;
                    $deta->save();
                    $linea++;
                }
               
                DB::commit();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Nota de Credito Guardada",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "Error guardando Nota de Credito",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Ya existe una Nota de Credito en el Documento ".$r['facnumero']." con el motivo seleccionado.",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function UpdateNcr(Request $r){
        
        try {    
            $validator = $r->validate([
                'codigopri' => 'required|string|min:3',
                'codigosec' =>'required|string|min:3',
                'nombre'=>'required|string|min:3',
                'precio'=> 'required',
                'costo'=>'required',
                'grabaiva'=>'required',                
                'estado'=>'required',
                'proveedor'=>'required',
                'idcategoria'=>'required',
                'idmarca'=>'required'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Debe llenar todos los campos del Formulario.",
                "logo" =>0,
                "firma" =>0
            ]);            
        } 
        
        $cont = GEOPRODUCTO::where('CODIGOPRI',trim($r['codigopri']))
        ->where('IDPRODUCTO','<>',$r['idproducto'])
        ->count();

        if($cont == 0){

            $pro = GEOPRODUCTO::where('IDPRODUCTO',$r['idproducto'])->first();        
            $pro->CODIGOPRI=$r['codigopri'];
            $pro->CODIGOSEC= $r['codigosec'];
            $pro->NOMBRE= $r['nombre'];
            $pro->PRECIO= $r['precio'];
            $pro->GRABAIVA= $r['grabaiva'];
            $pro->IMAGEN= "";
            $pro->ESTADO= $r['estado'];
            $pro->IDCATEGORIA= $r['idcategoria'];
            $pro->IDMARCA= $r['idmarca'];
            $pro->COSTO= $r['costo'];
            $pro->IDPROVEEDOR= $r['proveedor'];
            
            try {
                $pro->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Producto Actualizado",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error actualizando producto",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Codigo Principal de producto ya existe.",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function DeleteNcr(Request $r){
        
        $ID = $r['idProducto'];
        $pro = GEOPRODUCTO::where('IDPRODUCTO',$ID)->first();

        try {
            $pro->delete();
            return response()->json([
                "status"=>"ok",
                "success" => true,
                "message" => "Producto Eliminado",
                "logo" =>0,
                "firma" =>0
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Error al Eliminar",
                "logo" =>0,
                "firma" =>0
            ]);
        }
        
    }

    public function getFacturas(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $facturas = DB::table('GEOCABFACTURA')
        ->join('GEOCLIENTE','GEOCABFACTURA.CLIENTE','GEOCLIENTE.IDCLIENTE')
        ->where('IDEMPRESA',$idEmpresa)
        ->select(['GEOCABFACTURA.NUMEROFAC',
                'GEOCLIENTE.NOMBRECLIENTE',
                'GEOCABFACTURA.FECHAEMI',
                'GEOCLIENTE.IDCLIENTE',
                'GEOCABFACTURA.SECUENCIAL'])
        ->get();

        return response()->json(['facturas'=>$facturas,'status'=>'ok']);

    }
}
