<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GEOPRODUCTO;
use App\GEOPROCOMPUESTO;
use Illuminate\Support\Facades\Log;
use Session;

class ProductoCompuesto extends Controller
{
    public function Index(){
        $productos = DB::table('GEOPRODUCTO')->get();
        return view('producto.index',['productos'=>$productos]);
    }

    public function CreaProductoCompuesto(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $dataUsuario = $session2['usuario'];
        $idEmpresa = $empresadata['IDEMPRESA'];
        $rol = Session::get('rol');
        
        $proveedores = DB::table('GEOPROVEEDOR')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();
        
        $categorias = DB::table('GEOCATEGORIA')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();
        
        $marcas =  DB::table('GEOMARCA')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();
        return view('productocompuesto.crearproductocompuesto',[
            'proveedores'=>$proveedores,
            'categorias'=>$categorias,
            'marcas'=>$marcas
        ]);
    }

    public function EditarProducto($id){
        
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

    public function GuardaProductoCompuesto(Request $r){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];
            
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
        
        $cont = GEOPRODUCTO::where('CODIGOPRI',trim($r['codigopri']))->count();

        if($cont == 0){
            $pro = new GEOPRODUCTO();        
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
            $pro->IDEMPRESA =$idEmpresa;
            
            try {

                DB::beginTransaction();
                $pro->save();
                DB::commit();
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Producto Creado",
                    "logo" =>0,
                    "firma" =>0,
                    "idproducto"=>$pro->IDPRODUCTO
                ]); 
            } catch (\Throwable $th) {
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error guardando producto",
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

    
    public function CrearSubProductos(Request $r){
        
        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];
        
        $detalles = $r['productoshijos'];
        Log::info(['Productos hijos'=> $detalles]);
        
        DB::beginTransaction();
        foreach ($detalles as $key => $value) {

            $subpro = new GEOPROCOMPUESTO();
            $subpro->IDPRODUCTO = $value['idproducto'];
            $subpro->CODPRINCIPAL = $value['idpadre'];
            $subpro->NOMBREPRODUCTO = $value['nombre'];
            $subpro->CANTIDAD = 1;

            try {
                $subpro->save();
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error guardando producto compuesto."
                ]);
            }
        }
       
        DB::commit();
        return response()->json([
            "status"=>"ok",
            "success" => true,
            "message" => "producto compuesto guardado."
        ]);        
    }
}
