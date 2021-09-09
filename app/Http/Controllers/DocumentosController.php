<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Session;
use GuzzleHttp\Client;
use Carbon\Carbon;



class DocumentosController extends Controller
{
    public function IndexDocumento(){
        return view('documentos',['pagina'=>'Documentos','seccion'=>'Facturas']);
    }

    public function ConsultarFacturas(Request $r){

        Log::info(['peticion de consulta de factura'=>$r]);
        
        if($r->session()->has('usuario')){

            $f1 = Carbon::createFromFormat('Y-m-d',$r['fecha1']);
            $f2 = Carbon::createFromFormat('Y-m-d',$r['fecha2']);

            $userDT2 = Session::get('usuario');
            $empresad =  $userDT2['empresa'];  

            $client = new Client(['base_uri' => env('APP_URL_APOLO'),'verify' => false]); 
            $response = $client->request('POST', '/api/facturalist', ['form_params' => [
                'empresa' => $empresad->EMPRESA,
                'fecha1' => $f1->format('d-m-Y'),
                'fecha2' => $f2->format('d-m-Y')
            ]]);

            $ress = $response->getBody()->getContents();
            $data = json_decode($ress);
            
            return response()->json(['facturas'=>$data]);

        }else{
           
            return response()->json([
                'error'=>'empresa no logueada',
                'status'=>'error',
                'succesfull'=>false
            ]);
        }
    }
}
