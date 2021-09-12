<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GEOITEMBOD;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use AuthComtroller;
use Session;

class ItembodController extends Controller
{
    public function Index(){
        $itembods = DB::table('GEOITEMBOD')
        ->join('GEOPRODUCTO','GEOITEMBOD.IDPRODUCTO','GEOPRODUCTO.IDPRODUCTO')
        ->join('GEOBODEGA','GEOITEMBOD.IDBODEGA','GEOBODEGA.IDBODEGA')
        ->select([
            'GEOITEMBOD.IDITEMBOD',
            DB::raw('GEOPRODUCTO.NOMBRE as NOMBRE'),
            DB::raw('GEOITEMBOD.STOCK as STOCK'),
            DB::raw('GEOBODEGA.NOMBRECOMERCIAL as BODEGA'),
        ])
        ->get();
        return view('itembod.index',['itembods'=>$itembods]);
    }

    public function CrearItembod(){
        $proveedores = DB::table('GEOPROVEEDOR')->get();
        $categorias = DB::table('GEOCATEGORIA')->get();
        $marcas =  DB::table('GEOMARCA')->get();
        return view('producto.crearproducto',[
            'proveedores'=>$proveedores,
            'categorias'=>$categorias,
            'marcas'=>$marcas
        ]);
    }

    public function EditarItembod($id){
        
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

    public function GuardaItembod(Request $r){
            
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
            
            try {
                $pro->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Producto Guardado",
                    "logo" =>0,
                    "firma" =>0
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

    public function UpdateItembod(Request $r){
        
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

    public function DeleteItembod(Request $r){
        
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
