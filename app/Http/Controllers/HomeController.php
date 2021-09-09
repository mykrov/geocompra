<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function Index(Request $request){
        
        if($request->session()->has('usuario'))
        {
                  
            return view('index',['pagina'=>'Inicio','seccion'=>'Datos']);
        }else{
            return view('login');
        }  

    }
}
