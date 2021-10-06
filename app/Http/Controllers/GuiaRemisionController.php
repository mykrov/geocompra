<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\GEOGUIACAB;
use App\GEOGUIAREMIDET;
use App\GEOCABFACTURA;
use App\GEODETFACTURA;
use App\GEOBODEGA;

class GuiaRemisionController extends Controller
{
    public function Index(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $dataUsuario = $session2['usuario'];
        $idEmpresa = $empresadata['IDEMPRESA'];

        $guias = DB::table('GEOGUIACAB')
        ->join('GEOMOTIVOGUIA','GEOGUIACAB.CODMOTIVO','GEOMOTIVOGUIA.IDMOTIVOGUIA')
        ->where('GEOGUIACAB.IDEMPRESA',$idEmpresa)
        ->select([
            'GEOGUIACAB.CLAVEACCESO',
            'GEOGUIACAB.FECHAEMI',
            'GEOGUIACAB.OBSERVACION',
            'GEOGUIACAB.SECUENCIAL',
            'GEOGUIACAB.SECUENCIALFAC',
            'GEOMOTIVOGUIA.NOMBRE as MOTIVO'
        ])
        ->get();

        if(Session::get('rol') == 'PRO'){
            $guias = DB::table('GEOGUIACAB')
            ->join('GEOMOTIVOGUIA','GEOGUIACAB.CODMOTIVO','GEOMOTIVOGUIA.IDMOTIVOGUIA')
            ->select([
                'GEOGUIACAB.CLAVEACCESO',
                'GEOGUIACAB.FECHAEMI',
                'GEOGUIACAB.OBSERVACION',
                'GEOGUIACAB.SECUENCIAL',
                'GEOGUIACAB.SECUENCIALFAC',
                'GEOMOTIVOGUIA.NOMBRE as MOTIVO'
            ])
            ->get();

        }

        return view('guiaremision.index',['guias'=>$guias]);
    }

    public function CrearGuiaRemision(){
        
        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $dataUsuario = $session2['usuario'];
        $idEmpresa = $empresadata['IDEMPRESA'];

        $repartidores= DB::table('GEOREPARTIDOR')
        ->join('GEOUSUARIO','GEOUSUARIO.IDUSUARIO','GEOREPARTIDOR.IDUSUARIO')
        ->where('GEOUSUARIO.IDEMPRESA',$idEmpresa)
        ->select('GEOUSUARIO.NOMBRE','GEOUSUARIO.TELEFONO',
        'GEOREPARTIDOR.VEHICULO','GEOREPARTIDOR.PLACA')
        ->get();

        $motivosguias= DB::table('GEOMOTIVOGUIA')->get();

        $bodegas = DB::table('GEOBODEGA')->where('IDEMPRESA',$idEmpresa)->get();

        if(Session::get('rol') == 'PRO'){
            $bodegas = DB::table('GEOBODEGA')->get();
            $repartidores= DB::table('GEOREPARTIDOR')
            ->join('GEOUSUARIO','GEOUSUARIO.IDUSUARIO','GEOREPARTIDOR.IDUSUARIO')
            ->select('GEOUSUARIO.NOMBRE','GEOUSUARIO.TELEFONO',
            'GEOREPARTIDOR.VEHICULO','GEOREPARTIDOR.PLACA','GEOUSUARIO.IDUSUARIO')
            ->get();
        }

        return view('guiaremision.crearguiaremision',[
            'repartidores'=>$repartidores,
            'motivos'=>$motivosguias,
            'bodegas'=>$bodegas
        ]);
    }

    public function GuardarGuiaRemision(Request $r){
        
        $validator = Validator::make(
            $r->all(), [
                'facnumero' =>'required',
                'facsecuencial' =>'required',
                'clientenombre' =>'required',
                'numguia' =>'required',
                'numautorizacion' =>'required',
                'fechaemi' =>'required',
                'idmotivo' =>'required',
                'idrepartidor' =>'required',
                'idbodega' =>'required'
            ],
        );

        if ($validator->fails()) {
            Log::error('campos del formulario faltantes Guia Remision');
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'message'=>'Los campos en el formulario son necesarios.',
                'fieldError' => $validator->errors()->keys(),
            ], 200);    
        }

        $guiaCont = GEOGUIACAB::where('NOAUTORIZACION',$r["numautorizacion"])->count();

        if($guiaCont > 0){
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'message'=>'Ya existe una Guia de Remisión con el número de Autorizacion '.$r["numautorizacion"],
                'fieldError' => null,
            ], 200);
        }

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $dataUsuario = $session2['usuario'];
        $idEmpresa = $empresadata['IDEMPRESA'];

        
        
        DB::beginTransaction();  
        try {

            $cabFactura = GEOCABFACTURA::where('SECUENCIAL',$r['facsecuencial'])->first();
            $detFactura = GEODETFACTURA::where('SECUENCIALFAC',$r['facsecuencial'])->get();
            $bodega= GEOBODEGA::where('IDBODEGA',$r['idbodega'])->first();
            
            $guia = new GEOGUIACAB();
            $guia->SECUENCIAL = $bodega->NOGUIAREMISION + 1;
            $guia->ARCHIVOAUTORIZADO = "";
            $guia->ARCHIVOERROR = "";
            $guia->ARCHIVOPDF = "";
            $guia->ARCHIVOXML = "";
            $guia->CLAVEACCESO = $r["numautorizacion"];
            $guia->CODERROR = "";
            $guia->ESTADOPROCESO = "N";
            $guia->FECHAEMI = $r["fechaemi"];
            $guia->FECHAPROCESO = $r["fechaemi"];
            $guia->FIRMAXML = "";
            $guia->HORAPROCESO = NULL;
            $guia->IDEMPRESA = $cabFactura->IDEMPRESA;
            $guia->IDSUCURSAL = $cabFactura->IDEMPRESA;
            $guia->NOAUTORIZACION = $r["numautorizacion"];
            $guia->SECUENCIALFAC = $r['facsecuencial'];
            $guia->OBSERVACION = $r["observacion"];
            $guia->IDREPARTIDOR = $r["idrepartidor"];
            $guia->IDUSUARIO = $dataUsuario->IDUSUARIO;
            $guia->FECHAFIN = NULL;
            $guia->CODMOTIVO = $r["idmotivo"];
            $guia->save();
    
            $bodega->NOGUIAREMISION = $guia->SECUENCIAL;
            $bodega->save();

            foreach ($detFactura as  $detf) {

                $detGr = new GEOGUIAREMIDET();
                $detGr->IDEMPRESA = $cabFactura->IDEMPRESA;
                $detGr->IDSUCURSAL = $cabFactura->IDSUCURSAL;
                $detGr->LINEA = $detf->LINEA;
                $detGr->IDITEM = $detf->IDITEM;
                $detGr->CANTIDAD =$detf->CANTIDAD ;
                $detGr->PORIVA = $detf->PORIVA;
                $detGr->SECUENCIALGR = $guia->SECUENCIAL;
                $detGr->save();
            }

            DB::commit();

            return response()->json([
                'status' => 'ok',
                'msg'    => '',
                'message'=>'Guia Remision Secuencial '. $guia->SECUENCIAL,
                'fieldError' => null
            ], 200);

        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'message'=>'error al Guardar Guia',
                'fieldError' => $validator->errors()->keys(),
            ], 200);
        }
    }
}
