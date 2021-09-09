<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;
use Illuminate\Support\Facades\Log;


class ValidacionRucController extends Controller
{
    public function ValidaRuc($id){        
        
        $client = new Client;
        $request = $client->get('http://181.198.213.18:8083/Home/GetRucs?id='.$id);
        $response = $request->getBody()->getContents();
        $data = json_decode($response );       
        
        if($data[0]->Razon_social != '' and $data[0]->Razon_social != null){
            return response()->json($data);
        }else{
            return response()->json(['status'=>'error'],500);
        }   
    }
}
