<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GEOREPARTIDOR;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use AuthComtroller;
use Session;

class RepartidorController extends Controller
{
    public function Index(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $items = DB::table('GEOREPARTIDOR')        
        ->join('GEOUSUARIO','GEOREPARTIDOR.IDUSUARIO','GEOUSUARIO.IDUSUARIO')
        ->where('GEOUSUARIO.IDEMPRESA',$idEmpresa)
        ->select([
            'GEOREPARTIDOR.IDREPARTIDOR',
            'GEOUSUARIO.NOMBRE',
            'GEOREPARTIDOR.VEHICULO',
            'GEOREPARTIDOR.PLACA'
        ])
        ->get();

        return view('repartidor.index',['repartidores'=>$items]);
    }

    public function CrearRepartidor(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $usuarios = DB::table('GEOUSUARIO')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();

        if(Session::get('rol') == 'PRO'){
            $usuarios = DB::table('GEOUSUARIO')->get();
        }

        return view('repartidor.crearrepartidor',['usuarios'=>$usuarios]);
    }

    public function EditarRepartidor($id){  
        
        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $usuarios = DB::table('GEOUSUARIO')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();
        
        $repartidor = DB::table('GEOREPARTIDOR')
        ->where('IDREPARTIDOR',$id)
        ->first();

        return view('repartidor.editarrepartidor',['usuarios'=>$usuarios,'repartidor'=>$repartidor]);
    }

    public function GuardaRepartidor(Request $r){

        $permisoID = 27;
            
        try {    
            $validator = $r->validate([
                'vehiculo' => 'required|string|min:3',
                'placa'=>'required',
                'idusuario'=>'required'
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

        $cont = GEOREPARTIDOR::where('PLACA',trim($r['placa']))
        ->count();

        if($cont == 0){

            $repar = new GEOREPARTIDOR();  
            $repar->VEHICULO = $r['vehiculo'];
            $repar->PLACA = $r['placa'];
            $repar->IDUSUARIO = $r['idusuario'];
           
            
            try {
                $repar->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Repartidor Guardado",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error guardando repartidor",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Ya existe placa registrada.",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function UpdateRepartidor(Request $r){
        
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
                'vehiculo' => 'required|string|min:3',
                'id'=>'required',
                'placa'=>'required'
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
        
        $cont = DB::table('GEOREPARTIDOR')
        ->join('GEOUSUARIO','GEOUSUARIO.IDUSUARIO','GEOREPARTIDOR.IDUSUARIO')
        ->where('GEOUSUARIO.IDEMPRESA',$idEmpresa)
        ->where('GEOREPARTIDOR.PLACA',$r['placa'])
        ->where('GEOREPARTIDOR.IDUSUARIO',$r['idusuario'])
        ->count();

        Log::info(['countador'=> $cont]);

        if($cont == 0){

            $repar = GEOREPARTIDOR::where('IDREPARTIDOR',$r['id'])
            ->first();  

            $repar->VEHICULO = $r['vehiculo'];
            $repar->PLACA = $r['placa'];
            $repar->IDUSUARIO = $r['idusuario'];
           
                     
        
            try {
                $repar->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Repartidor Actualizado",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error actualizando rapartidor",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "ya existe repartidor con esa placa y usuario",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function DeleteRepartidor(Request $r){
        
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
