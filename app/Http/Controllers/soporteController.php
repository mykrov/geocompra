<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GEOSOPORTE;
use Illuminate\Support\Facades\Log;
use Session;
Use \Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarEmailsMailable;

class soporteController extends Controller
{

     public function Index(){
        return view('soporte.index');//,['cantones'=>$cantones]
    }
     public function CrearSoporte(){
        $empresas = DB::table('GEOEMPRESA')->get();
        return view('soporte.crearsoporte',['empresas'=>$empresas]);
    }
    public function GuardarSoporte(Request $r){
        $mytime = Carbon::now();

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa'];
        $idEmpresa = $empresadata['IDEMPRESA'];
        $usuariodata=$session2['usuario'];
        Log::info($r->body);
        $empresaApro = $idEmpresa;
        try {
            $validator = $r->validate([
                'dataSoporte' => 'required|string|min:3',
                'imagen1'=>'required',
               /// 'imagen2'=>'required',
               // 'imagen3'=>'required'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
            "status"=>"error",
            "success" => false,
            "message" => "Debe llenar todos los campos del Formulario."
            ]);
        }
        $sop = new GEOSOPORTE();
        $sop->COMENTARIO=$r['dataSoporte'];
        $sop->IMAGENSOPORTE1= "";
        $sop->IMAGENSOPORTE2= "";
        $sop->IMAGENSOPORTE3= "";
        $sop->IDUSUARIO=$usuariodata['IDUSUARIO'];


        try {
                DB::beginTransaction();
                $destinationPath='public/geocompra/images/soporte';
                $file_extension = $r->imagen1->getClientOriginalExtension();
                $file_extension2 = $r->imagen2->getClientOriginalExtension();
                $file_extension3 = $r->imagen3->getClientOriginalExtension();
                $fileName =  $mytime->format('d').$mytime->format('s').'image1'.'.'.$file_extension;
                $fileName2 = $mytime->format('d').$mytime->format('s').'image2'.'.'.$file_extension2;
                $fileName3 = $mytime->format('d').$mytime->format('s').'image3'.'.'.$file_extension3;
               // $directorioNode = trim($empresaApro->RUC).trim('\IMAGENES\ '). $fileName;

                $directorioNode = 'soporte/'.$fileName;
                $directorioNode2 ='soporte/'.$fileName2;
                $directorioNode3 ='soporte/'.$fileName3;
                try {
                    $path = $r->file('imagen1')->storeAs($destinationPath,$fileName);
                    $path2 = $r->file('imagen2')->storeAs($destinationPath,$fileName2);
                    $path3 = $r->file('imagen3')->storeAs($destinationPath,$fileName3);
                    Log::info($path);
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                    return response()->json([
                        "status"=>"error",
                        "success" => false,
                        "message" => "error guardando almacenando imagen",
                        "logo" =>0,
                        "firma" =>0
                    ]);
                }

                $sop->IMAGENSOPORTE1 = $directorioNode;
                $sop->IMAGENSOPORTE2 = $directorioNode2;
                $sop->IMAGENSOPORTE3 = $directorioNode3;

                $correo=new EnviarEmailsMailable($r->all());
                Mail::to('cede97bsc@hotmail.com')->send($correo);
                $sop->save();
                DB::commit();

                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Soporte enviado con exito",
                    "logo" =>0,
                    "firma" =>0
                ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "error guardando soporte",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

}
