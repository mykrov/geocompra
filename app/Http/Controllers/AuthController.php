<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\GEOUSUARIO;
use App\GEOEMPRESA;
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
            if(Hash::check(trim($pass),$check->CLAVE)){

                $menus = DB::table('GEOMENU')
                ->get();
                
                $submenus = DB::table('GEOACCESOS')
                ->where('GEOACCESOS.IDUSUARIO',$check->IDUSUARIO)
                ->join('GEOOPCION','GEOACCESOS.IDOPCION','GEOOPCION.IDOPCION')
                ->select(
                    'GEOOPCION.NOMBREOPCION',                        
                    'GEOOPCION.IDOPCION',                        
                    'GEOOPCION.IDMENU',                        
                    'GEOOPCION.URLOPCION',
                    'GEOACCESOS.ESMENU'
                )
                ->get();

                $empresa = GEOEMPRESA::where('IDEMPRESA',$check->IDEMPRESA)
                ->first();
                
                Log::info(['id de empresa'=> $check->IDEMPRESA]);
                Log::info(['empresa'=> $empresa]);
               
                
                Session::put('usuario',['id'=>$check->IDUSUARIO,
                    'usuario'=>$check,
                    'empresa'=>$empresa
                ]);
                
                Session::put('menus',$menus);
                Session::put('submenus',$submenus);

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
        $user->CLAVE = Hash::make('1982537');
        $user->ROL = "ADM";
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
}
