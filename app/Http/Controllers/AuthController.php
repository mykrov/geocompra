<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\GEOUSUARIO;
use App\GEOEMPRESA;
use App\Http\Controllers\PermisosController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Session;

class AuthController extends Controller
{
    public function Login(Request $r){

        $email = $r['email'];
        $pass =  $r['password'];

        if(trim($email) == '' or trim($pass) == '' ){
            return response()->json([
                'status'=> 'error'
            ]);
        }

        $check = GEOUSUARIO::where('CORREO',trim($email))->first();
        
        if($check){

            $valHash = substr($check->CLAVE,0,3);
            $claveBase = $check->CLAVE;
            
            if($valHash == '$2y'){
                Log::info('Login con hash de Laravel');
            }else{
                Log::info('Login con hash de Node');
                $claveBase = str_replace("$2a$", "$2y$", $check->CLAVE);
            }

            if(Hash::check(trim($pass),$claveBase)){

                $mainmenu = DB::table('MAINMENU')
                ->where('MAINMENU.ESTADO','A')
                //->join('GEOMENU','GEOMENU.IDMAINMENU','MAINMENU.IDMAINMENU')
                ->select(
                    'MAINMENU.NOMBRE',
                    'MAINMENU.ICON',
                    'MAINMENU.IDMAINMENU'
                )
                ->get();
                
                $submenus = DB::table('GEOACCESOS')
                ->where('GEOACCESOS.IDUSUARIO',$check->IDUSUARIO)
                ->join('GEOOPCION','GEOACCESOS.IDOPCION','GEOOPCION.IDOPCION')
                ->select(
                    'GEOOPCION.NOMBREOPCION',                        
                    'GEOOPCION.IDOPCION',                        
                    'GEOOPCION.IDMENU',                        
                    'GEOOPCION.URLOPCION',
                    'GEOACCESOS.ESMENU',
                    'GEOACCESOS.ESTADO'
                )
                ->get();

                Log::info($mainmenu);

                //Login de usuario recien creado desde la app
                if(count($submenus) == 0){
                    try {
                        $genPermisos = new PermisosController();
                        $genPermisos->AddPermisoUser($check->IDUSUARIO,'ADM');
                    } catch (\Throwable $th) {
                        Log::error('Error estableciendo los permisos inicales del usuario.');
                        Log::error($th->getMessage());
                    }

                    $submenus = DB::table('GEOACCESOS')
                    ->where('GEOACCESOS.IDUSUARIO',$check->IDUSUARIO)
                    ->join('GEOOPCION','GEOACCESOS.IDOPCION','GEOOPCION.IDOPCION')
                    ->select(
                        'GEOOPCION.NOMBREOPCION',                        
                        'GEOOPCION.IDOPCION',                        
                        'GEOOPCION.IDMENU',                        
                        'GEOOPCION.URLOPCION',
                        'GEOACCESOS.ESMENU',
                        'GEOACCESOS.ESTADO'
                    )
                    ->get();                   
                }                

                $menus = DB::table('GEOMENU')
                ->get();                

                $empresa = GEOEMPRESA::where('IDEMPRESA',$check->IDEMPRESA)
                ->first();             
                
                Session::put('usuario',[
                    'id'=>$check->IDUSUARIO,
                    'usuario'=>$check,
                    'empresa'=>$empresa
                ]);
                
                Session::put('mainmenu',$mainmenu);
                Session::put('menus',$menus);
                Session::put('submenus',$submenus);
                Session::put('rol',$check->ROL);

                return response()->json([
                    'status'=> 'ok'
                ]);
            }else{
                return response()->json([
                    'status'=> 'error'
                ]);
            }
        }
    }

    public function CreateUser(){

        $user = new GEOUSUARIO();
        //$user->IDUSUARIO = 45;
        $user->NOMBRE = "Manuel";
        $user->CEDULA = "0962749784";
        $user->TELEFONO = "0961213859";
        $user->CORREO = "salvatorex89@gmail.com";
        $user->USUARIO = "mykrov";
        $user->CLAVE = Hash::make('123123');
        $user->ROL = "PRO";
        $user->IDEMPRESA = "3";
        $user->IDBODEGA = "1";
        try {
            $user->save();
            return response()->json("creado");
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }

    }   

    public function Logout(){
        Session::forget('usuario');
        Session::forget('menus');
        Session::forget('submenus');
        return view('login');
    }

    public function IsAuthorized($idOpcion){
        
        $session2 = Session::get('usuario');
        //$empresadata = $session2['empresa']; 
        $usuariodata = $session2['usuario'];
        //$idEmpresa = $empresadata['IDEMPRESA']; 

        $avalible = DB::table('GEOACCESOS')
        ->where('IDOPCION',$idOpcion)
        ->where('IDUSUARIO',$usuariodata['IDUSUARIO'])
        ->where('ESTADO','S')
        ->count();

        if($avalible){
            return true;
        }else{
            return false;
        }
    }
}
