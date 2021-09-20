<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GEODETFORMAPAGO;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class FormaPagoController extends Controller
{
    public function CrearFormaPago(){      
        
        if(Session::get('usuario')){
            $session2 = Session::get('usuario');
            $empresadata = $session2['empresa']; 
            $idEmpresa = $empresadata['IDEMPRESA'];

            $formap = DB::table('GEODETFORMAPAGO')
            ->where('IDEMPRESA',$idEmpresa)
            ->get();
            $empresas = DB::table('GEOEMPRESA')->get();

            if(count($formap) == 1){
                return view('formapago.crearformapago',['detformapago'=> $formap,['empresas'=>$empresas]]);
            }else{
                
                return view('formapago.crearformapago',['empresas'=>$empresas]);
            } 
        }else{
            $empresas = DB::table('GEOEMPRESA')->get();
            return view('formapago.crearformapago',['empresas'=>$empresas]);
        }
        
    }

    public function GuardaFormaPago(Request $r){

        $efec = $r['efectivo'];
        $trans = $r['transferencia'];
        $paypal = $r['paypal'];
        $privatekey = $r['privatekey'];
        $publickey = $r['publickey'];
        $machinekey = $r['machinekey'];
        $token = $r['token'];

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        if(Session::get('rol')=='PRO'){
            $idEmpresa = $r['idempresa'];
        }

        try {
            if($efec == 'on'){
                $forma = DB::table('GEODETFORMAPAGO')
                ->where('IDEMPRESA',$idEmpresa)
                ->where('IDMEDIOPAGO',3)
                ->get();
                if(count($forma) == 0 ){
                    $newForma = new GEODETFORMAPAGO();
                    $newForma->IDEMPRESA =$idEmpresa;
                    $newForma->IDMEDIOPAGO = 3;
                    $newForma->PRIVATEKEY = "";
                    $newForma->PUBLICKEY = "";
                    $newForma->MACHINEKEY = "";
                    $newForma->TOKEN = "";
                    $newForma->save();
                }
            }
    
            if($trans == 'on'){
                $forma = DB::table('GEODETFORMAPAGO')
                ->where('IDEMPRESA',$idEmpresa)
                ->where('IDMEDIOPAGO',5)
                ->get();
                if(count($forma) == 0 ){
                    $newForma = new GEODETFORMAPAGO();
                    $newForma->IDEMPRESA =$idEmpresa;
                    $newForma->IDMEDIOPAGO = 5;
                    $newForma->PRIVATEKEY = "";
                    $newForma->PUBLICKEY = "";
                    $newForma->MACHINEKEY = "";
                    $newForma->TOKEN = "";
                    $newForma->save();
                }
            }
    
            if($trans == 'on'){
                $forma = DB::table('GEODETFORMAPAGO')
                ->where('IDEMPRESA',$idEmpresa)
                ->where('IDMEDIOPAGO',4)
                ->get();
                if(count($forma) == 0 ){
                    $newForma = new GEODETFORMAPAGO();
                    $newForma->IDEMPRESA =$idEmpresa;
                    $newForma->IDMEDIOPAGO = 4;
                    $newForma->PRIVATEKEY = trim($privatekey);
                    $newForma->PUBLICKEY = trim($publickey);
                    $newForma->MACHINEKEY = trim($machinekey);
                    $newForma->TOKEN = trim($token);
                    $newForma->save();
                }
            }

            return response()->json([
                "status"=>"ok",
                "success" => true,
                "message" => "Formas de pago Actualizadas"                
            ]);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Error Formas Actualizadas"
            ]);
        }
    }
}
