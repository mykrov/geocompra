<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GEOPRODUCTO;
use App\GEOITEMBOD;
use Illuminate\Support\Facades\Log;
use Session;


class ProductoController extends Controller
{
    public function Index(){
       
        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $dataUsuario = $session2['usuario'];
        $idEmpresa = $empresadata['IDEMPRESA'];
        $rol = Session::get('rol');

        $productos = DB::table('GEOPRODUCTO')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        return view('producto.index',['productos'=>$productos]);
    }

    public function CrearProducto(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $dataUsuario = $session2['usuario'];
        $idEmpresa = $empresadata['IDEMPRESA'];
        $rol = Session::get('rol');

        $proveedores = DB::table('GEOPROVEEDOR')->where('IDEMPRESA',$idEmpresa)->get();
        $categorias = DB::table('GEOCATEGORIA')->where('IDEMPRESA',$idEmpresa)->get();
        $marcas =  DB::table('GEOMARCA')->where('IDEMPRESA',$idEmpresa)->get();

        if(Session::get('rol')=='PRO'){
            $proveedores = DB::table('GEOPROVEEDOR')->get();
            $categorias = DB::table('GEOCATEGORIA')->get();
            $marcas =  DB::table('GEOMARCA')->get();
        }


        $empresas = DB::table('GEOEMPRESA')->get();
        
        return view('producto.crearproducto',[
            'proveedores'=>$proveedores,
            'categorias'=>$categorias,
            'marcas'=>$marcas,
            'empresas'=>$empresas
        ]);
    }

    public function EditarProducto($id){
        
        $proveedores = DB::table('GEOPROVEEDOR')->where('IDEMPRESA',$idEmpresa)->get();
        $categorias = DB::table('GEOCATEGORIA')->where('IDEMPRESA',$idEmpresa)->get();
        $marcas =  DB::table('GEOMARCA')->where('IDEMPRESA',$idEmpresa)->get();
        $producto = GEOPRODUCTO::where('IDPRODUCTO',$id)->first();

        return view('producto.editarproducto',[
            'proveedores'=>$proveedores,
            'categorias'=>$categorias,
            'marcas'=>$marcas,
            'producto'=>$producto
        ]);
    }

    public function GuardaProducto(Request $r){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        Log::info($r->body);

        if(Session::get('rol')== 'PRO'){
            $idEmpresa = $r['idempresa'];
            $empresaApro = DB::table('GEOEMPRESA')->where('IDEMPRESA',$r['idempresa'])->first();
        }
            
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
                'idmarca'=>'required',
                'imagen'=>'required',
                'stock'=>'required'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Debe llenar todos los campos del Formulario."
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
                  
                $destinationPath='public/documents/'.trim($empresaApro->RUC).'/IMAGENES';
                $file_extension = $r->imagen->getClientOriginalExtension();
                $fileName = $pro->CODIGOPRI.'_'.trim($idEmpresa).'.'.$file_extension; 
                $directorioNode = trim('C:\laragon\www\geocompra\storage\app\public\documents\ ').trim($empresaApro->RUC).trim('\IMAGENES\ '). $fileName;                 
                              
                $path = $r->file('imagen')->storeAs($destinationPath,$fileName);
                Log::info($path);

                $pro->IMAGEN = $directorioNode;
                $pro->save();
                $this->AddOnBod($idEmpresa,$pro->IDPRODUCTO,$r['stock']);
                DB::commit();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Producto Guardado",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
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

    public function getProductos(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $productos = DB::table('GEOPRODUCTO')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        if(Session::get('rol') == 'PRO'){
            $productos = DB::table('GEOPRODUCTO')->get();
        }

        return response()->json(['productos'=>$productos,'status'=>'ok']);

    }

    public function AddOnBod($idEmpresa,$idProducto,$stock){
       
        $bodega = DB::table('GEOBODEGA')
        ->where('IDEMPRESA', $idEmpresa)
        ->orderBy('IDBODEGA','desc')
        ->limit(1)
        ->get();

        //Log::info(['Bodega para item Nuevo'=>$bodega]);

        try {
            $proBod = new GEOITEMBOD();
            $proBod->IDPRODUCTO = $idProducto;
            $proBod->IDBODEGA = $bodega[0]->IDBODEGA;
            $proBod->STOCK = $stock;
            $proBod->save();
        } catch (\Throwable $th) {
            
            Log::error('Error Guardando Item en la bodega'); 
            Log::error($th->getMessage());       
        }
        
    }
}
