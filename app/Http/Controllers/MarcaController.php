<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AuthComtroller;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\GEOMARCA;



class MarcaController extends Controller
{
    public function Index(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $items = DB::table('GEOMARCA')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        if(Session::get('rol')=='PRO'){
            $items = DB::table('GEOMARCA')->get();
        }

        return view('marca.index',['marcas'=>$items]);
    }

    public function CrearMarca(){
        $empresas = DB::table('GEOEMPRESA')->get();
        return view('marca.crearmarca',['empresas'=>$empresas]);
    }

    public function EditarMarca($id){       
        $marca = DB::table('GEOMARCA')
        ->where('IDMARCA',$id)
        ->first();
        return view('marca.editarmarca',['marca'=>$marca]);
    }

    public function GuardaMarca(Request $r){

        $permisoID = 27;
            
        try {    
            $validator = $r->validate([
                'nombre' => 'required|string|min:3'
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

        if(Session::get('rol') == 'PRO'){
            $idEmpresa = $r['idempresa'];
        }

        $cont = GEOMARCA::where('NOMBRE',trim($r['nombre']))
        ->where('IDEMPRESA',$idEmpresa)
        ->count();

        if($cont == 0){

            $marca = new GEOMARCA();  
            $marca->NOMBRE = $r['nombre'];
            $marca->IDEMPRESA = $idEmpresa;
           
            
            try {
                $marca->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Marca Guardada",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error guardando marca",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Ya existe categoria con ese nombre.",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function UpdateMarca(Request $r){
        
        $check_permiso = new AuthController();        
        
        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $usuariodata = $session2['usuario'];
        $idEmpresa = $empresadata['IDEMPRESA']; 

        if($check_permiso->IsAuthorized(27) == false){
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
                'nombre' => 'required|string|min:3',
                'id'=>'required'
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
        
        $cont = GEOMARCA::where('NOMBRE','=',trim($r['nombre']))
        ->where('IDEMPRESA',$idEmpresa)
        ->count();

        //Log::info(['count'=> $cont]);

        if($cont == 0){

            $marca= GEOMARCA::where('IDMARCA',$r['id'])
            ->where('IDEMPRESA',$idEmpresa)
            ->first();  

            Log::info(['categoria a update'=>$marca]);
            
            $marca->NOMBRE = $r['nombre'];            
        
            try {
                $marca->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Categoria Actualizada",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error actualizando categoria",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "ya existe categoria con ese nombre",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function DeleteCategoria(Request $r){
        
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
