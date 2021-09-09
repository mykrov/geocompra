<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GEOUSUARIO;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Session;

 

class UsuarioController extends Controller
{
    

    public function Index(){
        $items = DB::table('GEOUSUARIO')->get();
        return view('usuario.index',['usuarios'=>$items]);
    }

    public function CrearUsuario(){
        $roles = DB::table('GEOROLES')->get();
        $bodegas = DB::table('GEOBODEGA')->get();
        
        return view('usuario.crearusuario',[
            'roles'=>$roles,
            'bodegas'=>$bodegas            
        ]);
    }

    public function EditarUsuario($id){
        
        $roles = DB::table('GEOROLES')->get();
        $bodegas = DB::table('GEOBODEGA')->get();
        $usuario = GEOUSUARIO::where('IDUSUARIO',$id)->first();

        return view('usuario.editarusuario',[
            'roles'=>$roles,
            'bodegas'=>$bodegas ,
            'usuario'=>$usuario
        ]);
    }

    public function GuardaUsuario(Request $r){

        $permisoID = 2;
            
        try {    
            $validator = $r->validate([
                'nombre' => 'required|string|min:3',
                'cedula' =>'required|string|min:3',
                'telefono'=>'required|string|min:3',
                'correo'=> 'required',
                'usuario'=>'required',
                'idrol'=>'required',                
                'idbodega'=>'required',
                'clave'=>'required'                
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

        $cont = GEOUSUARIO::where('CEDULA',trim($r['cedula']))
        ->where('IDEMPRESA',$idEmpresa)
        ->count();

        if($cont == 0){
            $user = new GEOUSUARIO(); 
            
            $user->NOMBRE = $r["nombre"];
            $user->CEDULA = $r["cedula"];
            $user->TELEFONO = $r["telefono"];
            $user->CORREO = $r["correo"];
            $user->USUARIO = $r["usuario"];
            $user->CLAVE = Hash::make($r["clave"]);
            $user->ROL = $r["idrol"];
            $user->IDEMPRESA = $idEmpresa;
            $user->IDBODEGA = $r["idbodega"];
            
            try {
                $user->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Usuario Guardado",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error guardando usuario",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Ya existe usuario con esa cedula.",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function UpdateUsuario(Request $r){
        
        
        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $usuariodata = $session2['usuario'];
        $idEmpresa = $empresadata['IDEMPRESA']; 

        $avalible = DB::table('GEOACCESOS')
        ->where('IDOPCION',3)
        ->where('IDUSUARIO',$usuariodata['IDUSUARIO'])
        ->where('ESTADO','S')
        ->count();

        if($avalible == 0){
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
                'cedula' =>'required|string|min:3',
                'telefono'=>'required|string|min:3',
                'correo'=> 'required',
                'usuario'=>'required',
                'idrol'=>'required',                
                'idbodega'=>'required',
               
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
        

        $cont = GEOUSUARIO::where('CEDULA',trim($r['cedula']))
        ->where('IDEMPRESA',$idEmpresa)
        ->where('CEDULA','<>',$r['cedula'])
        ->count();

        if($cont == 0){

            $user = GEOUSUARIO::where('CEDULA',$r['cedula'])
            ->where('IDEMPRESA',$idEmpresa)
            ->first();  
            
            Log::info(['usuario a Modificar'=>$user]);
            $user->NOMBRE = $r["nombre"];
            $user->CEDULA = $r["cedula"];
            $user->TELEFONO = $r["telefono"];
            $user->CORREO = $r["correo"];
            $user->USUARIO = $r["usuario"];
            
            if(trim($r['clave'] != '' )){
                $user->CLAVE = Hash::make($r["clave"]);
            }
           
            $user->ROL = $r["idrol"];
            $user->IDEMPRESA = $idEmpresa;
            $user->IDBODEGA = $r["idbodega"];
            
            try {
                $user->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Usuario Actualizado",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error actualizando usuario",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "ya existe usuario con esa cedula.",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function DeleteUsuario(Request $r){
        
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
