<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GEOEMPRESA;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use AuthComtroller;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class EmpresaController extends Controller
{
    public function Index(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $items = DB::table('GEOEMPRESA')
        ->join('GEOPROVINCIA','GEOPROVINCIA.IDPROVINCIA','GEOEMPRESA.IDPROVINCIA')       
        ->select([
            'GEOEMPRESA.IDEMPRESA',
            'GEOEMPRESA.RAZONSOCIAL',
            'GEOEMPRESA.RUC',
            'GEOEMPRESA.CORREO',
            'GEOPROVINCIA.NOMBRE as PROVINCIA',
            'GEOEMPRESA.ESTADO',
            'GEOEMPRESA.AMBIENTE',
            'GEOEMPRESA.CONTRIBUYENTEESPECIAL',
            'GEOEMPRESA.OBLIGADOCONTA',
        ])
        ->get();

        return view('empresa.index',['empresas'=>$items]);
    }

    public function CrearEmpresa(){

        $provincias = DB::table('GEOPROVINCIA')->get();
        $cantones = DB::table('GEOCANTON')->get();
        $parroquias = DB::table('GEOPARROQUIA')->get();

        return view('empresa.crearempresa',[
            'provincias'=>$provincias,
            'cantones'=>$cantones,
            'parroquias'=>$parroquias
        ]);
    }

    public function EditarEmpresa($id){       
        $marca = DB::table('GEOMARCA')
        ->where('IDMARCA',$id)
        ->first();
        return view('marca.editarmarca',['marca'=>$marca]);
    }

    public function GuardaEmpresa(Request $r){

        $permisoID = 27;
            
        try {    
            $validator = $r->validate([
                'razonsocial' => 'required|string|min:3',
                'ruc' => 'required',
                'correo' => 'required',
                'actividadeconomica' => 'required',
                'clavecertificado' => 'required',
                'firma'=> 'required|max:200'
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

        $cont = GEOEMPRESA::where('RUC',trim($r['ruc']))
        ->count();

        if($cont == 0){

            $backsal ='\ ';
            $dirFirm = 'C:\laragon\www\geocompra\storage\app\public\documents\ ';
            $certs = array();
            $pkcs12= file_get_contents($r->firma);   
            $fechaVenFirma = "";     
            $fechaEmiFirma = "";

            if(!openssl_pkcs12_read($pkcs12, $certs, $r->clavecertificado)){
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "La contraseña proporcionada para la Firma es incorrecta.",
                    "logo" =>0,
                    "firma" =>0
                ]);
            }else{           
                $CertPriv  =  openssl_x509_parse($certs['cert']);
                $fechaVenFirma = date('Y-m-d', $CertPriv['validTo_time_t']);
                $fechaEmiFirma = date('Y-m-d', $CertPriv['validFrom_time_t']);
                
                $date_now = date("Y-m-d");
    
                if ($date_now > $fechaVenFirma) {
                    Log::error('Firma Vencida');
                    Log::info($fechaVenFirma);
                    return response()->json([
                        "status"=>"error",
                        "success" => false,
                        "message" => "La firma electrónica está caducada. Fecha Vencimiento : ".date('d-m-Y', $CertPriv['validTo_time_t']),
                        "logo" =>0,
                        "firma" =>0
                    ]);
                }
                
            }



            $empre = new GEOEMPRESA();  
            $empre->RAZONSOCIAL = $r['razonsocial'];
            $empre->RUC = $r['ruc'];
            $empre->CORREO = $r['correo'];
            $empre->RUTACERTIFICADO = $r[''];
            $empre->LOGOEMPRESA = trim($dirFirm).'logoEmpresa_'.trim($r->ruc).'.jpg';
            $empre->IDPROVINCIA = $r['idprovincia'];
            $empre->IDCANTON = $r['idcanton'];
            $empre->IDPARROQUIA = $r['idparroquia'];
            $empre->ACTIVIDADECONOMICA = $r['actividadeconomica'];
            $empre->CLAVEERTIFICADO = $r['clavecertificado'];
            $empre->ESTADO = "I";
            $empre->AMBIENTE = $r['ambiente'];
            $empre->OBLIGADOCONTA = "NO";
            $empre->USAFACELECTRONICA = "N";              
            $empre->IDTIPONEGOCIO = 1; 
            $empre->WSRECEPRUEBA = "";
            $empre->WSRECPRODUCCION = "";
            $empre->WSAUTOPRUEBA = "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl";
            $empre->WSAUTOPRODUCCION = "https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl";

            $empre->RUTAARCHIVOXMLFAC = "";
            $empre->RUTAARCHIVOSPDF = "";
            $empre->RUTAXMLFIRMADO = "";
            $empre->RUTAXMLAUTORIZADO = "";
            $empre->RUTAXMLERROR = "";

            if($r['agente'] == 'on'){
                $empre->AGENTERETENCION = 1;
            }

            if($r['contribuyente'] == 'on'){
                $empre->CONTRIBUYENTEESPECIAL = 1;
            }

            if($r['estado'] == 'on'){
                $empre->ESTADO = "A";
            }


            if($r['contabilidad'] == 'on'){
                $empre->OBLIGADOCONTA = "SI";
            }
            
            if($r['usafacelectronica'] == 'on'){
                $empre->USAFACELECTRONICA = "S";
            }

            try {
                $empre->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Empresa Guardada",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error guardando empresa",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Ya existe empresa con ese RUC.",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function UpdateMarca(Request $r){
        
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
                'nombre' => 'required|string|min:3',
                'id'=>'required'
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
        
        $cont = GEOMARCA::where('NOMBRE','=',trim($r['nombre']))
        ->where('IDEMPRESA',$idEmpresa)
        ->count();

        //Log::info(['count'=> $cont]);

        if($cont == 0){

            $marca= GEOMARCA::where('IDMARCA',$r['id'])
            ->where('IDEMPRESA',$idEmpresa)
            ->first();  

            Log::info(['categoria a update'=>$marca]);
            
            $marca->NOMBRE = $r['nombre'];            
        
            try {
                $marca->save();
    
                return response()->json([
                    "status"=>"ok",
                    "success" => true,
                    "message" => "Categoria Actualizada",
                    "logo" =>0,
                    "firma" =>0
                ]); 
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "error actualizando categoria",
                    "logo" =>0,
                    "firma" =>0
                ]);  
            }
        }else{
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "ya existe categoria con ese nombre",
                "logo" =>0,
                "firma" =>0
            ]);
        }
    }

    public function DeleteCategoria(Request $r){
        
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
