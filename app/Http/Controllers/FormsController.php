<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class FormsController extends Controller
{
    public function EmpresaForm(Request $r){
        
        Log::info($r);
        $direccion = $r['direccion'];
        $tlfEmpre = $r['telefono'];
        $serie = $r['serie'];
        $numerofac = $r['numerofac'];
        $gerente = $r['gerente'];
        $rucgerente = $r['gerenteruc'];
        $tlfgerente = $r['gerentetlf'];
        $logo = $r->file('logo');
        $firma = $r->file('firma');
        $password_firma = $r['password_firma'];


        $client = new Client(['base_uri' => env('APP_URL_APOLO')]);

        $response = $client->request('POST', '/api/updatedata', ['form_params' => [
            'direccion' => $direccion,
            'tlfempre' => $tlfEmpre,
            'serie' => $serie,
            'numerofac' => $numerofac,
            'gerente' => $gerente,
            'rucgerente' => $rucgerente,
            'tlfgerente' => $tlfgerente,
            'logo'=> $logo,
            'firma'=>$firma,
            'password_firma'=>$password_firma
        ]]);

        $ress = $response->getBody()->getContents();
        Log::info(['Datos de Ress '=>$ress]);
        $data = json_decode($ress);
        
        if($data->status == 'error'){
            return response()->json(['status'=>'error','message'=>$data->message],500);
        }else{               

            $dataEmpresa = $data->empresa; 
            return response()->json(['status'=>'ok','message'=>'login_ok'],200);
        }

    }
}
