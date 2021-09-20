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

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $itembods = DB::table('GEOITEMBOD')
        ->join('GEOPRODUCTO','GEOITEMBOD.IDPRODUCTO','GEOPRODUCTO.IDPRODUCTO')
        ->join('GEOBODEGA','GEOITEMBOD.IDBODEGA','GEOBODEGA.IDBODEGA')
        ->where('GEOPRODUCTO.IDEMPRESA',$idEmpresa)
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
        
        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $productos = DB::table('GEOPRODUCTO')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        $bodegas = DB::table('GEOBODEGA')->where('IDEMPRESA',$idEmpresa)->get();

        $categorias = DB::table('GEOCATEGORIA')->where('IDEMPRESA',$idEmpresa)->get();
        $marcas =  DB::table('GEOMARCA')->where('IDEMPRESA',$idEmpresa)->get();
        $empresas = DB::table('GEOEMPRESA')->get();

        return view('itembod.crearitembod',[
            'productos'=>$productos,
            'bodegas'=> $bodegas,
            'empresas'=>$empresas
           
        ]);
    }

    public function EditarItembod($id){
        
        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $productos = DB::table('GEOPRODUCTO')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        $bodegas = DB::table('GEOBODEGA')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        if(Session::get('rol') == 'PRO'){
            $productos = DB::table('GEOPRODUCTO')->get();
            $bodegas = DB::table('GEOBODEGA')->get();
        }

        
        $item = GEOITEMBOD::where('IDITEMBOD',$id)->first();
       
        return view('itembod.editaritembod',[
            'productos'=>$productos,
            'bodegas'=> $bodegas,
            'itembod'=>$item
        ]);
    }

    public function GuardaItembod(Request $r){
            
        try {    
            $validator = $r->validate([
                'stock' => 'required'
                
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
        
        $cont = GEOITEMBOD::where('IDPRODUCTO',trim($r['idproducto']))
        ->where('IDBODEGA',trim($r['idbodega']))
        ->count();

        if($cont == 0){
            $itembod = new GEOITEMBOD();        
            $itembod->IDBODEGA=$r['idbodega'];
            $itembod->IDPRODUCTO=$r['idproducto'];
            $itembod->STOCK=$r['stock'];
            
           
            
            try {
                $itembod->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Item agregado a bodega",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error guardando Item en bodega",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Ya existe registro del producto en la bodega.",
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
