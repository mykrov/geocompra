<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GEOCATEGORIA;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use AuthComtroller;
use Session;

class CategoriaController extends Controller
{
    public function Index(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $items = DB::table('GEOCATEGORIA')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        return view('categoria.index',['categorias'=>$items]);
    }

    public function CrearCategoria(){
        return view('categoria.crearcategoria');
    }

    public function EditarCategoria($id){       
        $cat = DB::table('GEOCATEGORIA')
        ->where('IDCATEGORIA',$id)
        ->first();
        return view('categoria.editarcategoria',['categoria'=>$cat]);
    }

    public function GuardaCategoria(Request $r){

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

        $cont = GEOCATEGORIA::where('NOMBRE',trim($r['nombre']))
        ->where('IDEMPRESA',$idEmpresa)
        ->count();

        if($cont == 0){

            $cat = new GEOCATEGORIA();  
            $cat->NOMBRE = $r['nombre'];
            $cat->IDEMPRESA = $idEmpresa;
           
            
            try {
                $cat->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Categoria Guardada",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error guardando categoria",
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

    public function UpdateCategoria(Request $r){
        
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
        
        $cont = GEOCATEGORIA::where('NOMBRE','=',trim($r['nombre']))
        ->where('IDEMPRESA',$idEmpresa)
        ->count();

        Log::info(['count'=> $cont]);

        if($cont == 0){

            $cate = GEOCATEGORIA::where('IDCATEGORIA',$r['id'])
            ->where('IDEMPRESA',$idEmpresa)
            ->first();  

            Log::info(['categoria a update'=>$cate]);
            
            $cate->NOMBRE = $r['nombre'];            
        
            try {
                $cate->save();
    
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
