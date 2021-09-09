<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GEOBODEGA;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use AuthComtroller;
use Session;

class BodegaController extends Controller
{
    public function Index(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $items = DB::table('GEOBODEGA')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        return view('bodega.index',['bodegas'=>$items]);
    }

    public function CrearBodega(){
        return view('bodega.crearbodega');
    }

    public function EditarBodega($id){       
        $bod = DB::table('GEOBODEGA')
        ->where('IDBODEGA',$id)
        ->first();
        return view('bodega.editarbodega',['bod'=>$bod]);
    }

    public function GuardaBodega(Request $r){

        $permisoID = 2;
            
        try {    
            $validator = $r->validate([
                'nombrecomercial' => 'required|string|min:3',
                'serie' =>'required|string|min:3',
                'secuencial'=>'required',
                'nnotacredito'=> 'required',
                'nguiarem'=>'required',
                'correo'=>'required',                
                'telefono'=>'required',
                'direccion'=>'required'  ,
                'latitud'=>'required',
                'longitud'=>'required'
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
    
        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $cont = GEOBODEGA::where('NOMBRECOMERCIAL',trim($r['nombrecomercial']))
        ->where('IDEMPRESA',$idEmpresa)
        ->count();

        if($cont == 0){

            $bod = new GEOBODEGA();  
            $bod->NOMBRECOMERCIAL = $r['nombrecomercial'];
            $bod->SERIE = $r['serie'];
            $bod->NOSECUENCIAL = $r['secuencial'];
            $bod->NOSECUENCIALNCR = $r['nnotacredito'];
            $bod->NOGUIAREMISION = $r['nguiarem'];
            $bod->LATITUD = $r['latitud'];
            $bod->LONGITUD = $r['longitud'];
            $bod->IDEMPRESA = $idEmpresa ;
            $bod->TELEFONO = $r['telefono'];
            $bod->CORREO = $r['correo'];
            $bod->DIRECCION = $r['direccion'];
            
            try {
                $bod->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Bodega Guardada",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error guardando bodega",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Ya existe bodega con ese nombre.",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function UpdateBodega(Request $r){
        
        $check_permiso = new AuthController();        
        
        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $usuariodata = $session2['usuario'];
        $idEmpresa = $empresadata['IDEMPRESA']; 

        if($check_permiso->IsAuthorized(13) == false){
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "No tiene permiso para la acción.",
                "logo" =>0,
                "firma" =>0
            ]);  
        }

        try {    
            $validator = $r->validate([
                'nombrecomercial' => 'required|string|min:3',
                'serie' =>'required|string|min:3',
                'secuencial'=>'required',
                'nnotacredito'=> 'required',
                'nguiarem'=>'required',
                'correo'=>'required',                
                'telefono'=>'required',
                'direccion'=>'required'  ,
                'latitud'=>'required',
                'longitud'=>'required'
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
        
        $cont = GEOBODEGA::where('NOMBRECOMERCIAL',trim($r['nombrecomercial']))
        ->where('IDEMPRESA',$idEmpresa)
        ->where('IDBODEGA','<>',$r['id'])
        ->count();

        if($cont == 0){

            $bod = GEOBODEGA::where('IDBODEGA',$r['id'])
            ->where('IDEMPRESA',$idEmpresa)
            ->first();  
            
            $bod->NOMBRECOMERCIAL = $r['nombrecomercial'];
            $bod->SERIE = $r['serie'];
            $bod->NOSECUENCIAL = $r['secuencial'];
            $bod->NOSECUENCIALNCR = $r['nnotacredito'];
            $bod->NOGUIAREMISION = $r['nguiarem'];
            $bod->LATITUD = $r['latitud'];
            $bod->LONGITUD = $r['longitud'];           
            $bod->TELEFONO = $r['telefono'];
            $bod->CORREO = $r['correo'];
            $bod->DIRECCION = $r['direccion'];
        
            
            try {
                $bod->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Bodega Actualizado",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error actualizando bodega",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "ya existe bodega con ese nombre",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function DeleteBodega(Request $r){
        
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
