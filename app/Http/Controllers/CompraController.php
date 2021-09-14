<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GEOCABINGRESO;
use App\GEOCDETINGRESO;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use AuthComtroller;
use Session;

class CompraController extends Controller
{
    public function Index(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $compras = DB::table('GEOCABINGRESO')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        return view('compra.index',['compras'=>$compras]);
    }

    public function CrearCompra(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $proveedores = DB::table('GEOPROVEEDOR')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();
        $categorias = DB::table('GEOCATEGORIA')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();
        $marcas =  DB::table('GEOMARCA')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        $bodegas = DB::table('GEOBODEGA')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();
       
        return view('compra.crearcompra',[
            'bodegas'=>  $bodegas,
            'proveedores'=>$proveedores,
            'categorias'=>$categorias,
            'marcas'=>$marcas,         
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

    public function GuardaCompra(Request $r){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];
        
        $cabecera = $r[0]['cabecera'];
        $detalles = $r[0]['detalles'];

        try {    

            if(count($detalles) == 0){
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "Debe llenar detalles de productos en la compra.",
                    "logo" =>0,
                    "firma" =>0
                ]);
            }

        } catch (\Throwable $th) {
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Debe llenar todos los campos de la cabecera.",
                "logo" =>0,
                "firma" =>0
            ]);            
        } 
        
        $cont = GEOCABINGRESO::where('NOAUTORIZACION',trim($cabecera['autorizacion']))->count();

        if($cont == 0){
            $cab = new GEOCABINGRESO();        
           
            $cab->TIPODOC = 'FAC';
            $cab->MUMEROFAC = $cabecera['numfac'];
            $cab->NOAUTORIZACION = $cabecera['autorizacion'];
            $cab->BODEGAORIGEN = $cabecera['bodegaori'];
            $cab->BODEGADESTINO = $cabecera['bodegades'];
            $cab->IVA = $cabecera['iva'];
            $cab->SUBTOTAL = $cabecera['subtotal'];
            $cab->DESCUENTO = $cabecera['descuento'];
            $cab->NETO = $cabecera['neto'];
            $cab->FECHAEMI = $cabecera['fechaemi'];
            $cab->HORAEMI = '10:00';
            $cab->ESTADO = 'N';
            $cab->IDUSUARIO =  $session2['id'];
            $cab->IDEMPRESA = $idEmpresa;
            
            
            try {
                DB::beginTransaction();
                $cab->save();

                foreach ($detalles as $key => $value) {
                    $deta = new GEOCDETINGRESO();
                    $deta->IDCABINGRESO = $cab->IDCABINGRESO;
                    $deta->IDPRODUCTO = $value['idproducto'];
                    $deta->CANTIDAD = $value['cantidad'];
                    $deta->COSTO = $value['precio'];
                    $deta->SUBTOTAL = round(floatval($value['cantidad']) * floatval($value['precio']),2) ;
                    $deta->IVA = floatval($deta->IVA);
                    $deta->DESCUENTO = 0;
                    $deta->NETO = round($deta->SUBTOTAL + floatval($deta->IVA),2);
                    $deta->save();
                }

                Log::info(['id de la compra'=> $cab->IDCABINGRESO]);
                DB::commit();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Compra Guardada",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error guardando compras",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Número de Autorización ya existe.",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function UpdateProducto(Request $r){
        
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

    public function DeleteProducto(Request $r){
        
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
}
