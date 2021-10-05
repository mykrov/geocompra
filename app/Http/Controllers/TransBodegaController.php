<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\GEOPRODUCTO;
use App\GEOITEMBOD;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use AuthComtroller;
use Session;


class TransBodegaController extends Controller
{
    
    public function Index(){

        $session2 = Session::get('usuario');
        $empresadata = $session2['empresa']; 
        $idEmpresa = $empresadata['IDEMPRESA'];

        $items = DB::table('GEOPRODUCTO')
        ->where('IDEMPRESA',$idEmpresa)
        ->where('STOCK','>',0)
        ->get();

        $bodegas = DB::table('GEOBODEGA')
        ->where('IDEMPRESA',$idEmpresa)
        ->get();


        return view('bodega.transferencia',[
            'productos'=>$items,
            'bodegas'=>$bodegas
        ]);
    }

    public function CrearTransBodega(Request $r){

        Log::info(['Transferencia'=>$r]);

        $item = $r['idproducto'];
        $cantidad = $r['transferir'];
        $origen = $r['idbodegaorigen'];
        $destino = $r['idbodegadestino'];

        $itembodOri = GEOITEMBOD::where('IDBODEGA',$origen)
        ->where('IDPRODUCTO',$item)
        ->where('STOCK','>',0)
        ->first();

        DB::beginTransaction();

        try {
            if($itembodOri == null){
                return response()->json([
                    "status"=>"error",
                    "success" => false,
                    "message" => "No se encontró Stock en la bodega origen del Producto ".$item
                ]);
            }else{
                if($itembodOri->STOCK < $cantidad){
                    return response()->json([
                        "status"=>"error",
                        "success" => false,
                        "message" => "La cantidad a transferir es mayor a la disponible en la bodega de origen, Stock= ".$itembodOri->STOCK
                    ]);
                }else{
                    $itembodOri->STOCK = $itembodOri->STOCK - $cantidad;
                    $itembodOri->save();
                }
            }
    
            $itembodDes = GEOITEMBOD::where('IDBODEGA',$destino)
            ->where('IDPRODUCTO',$item)
            ->first();
    
            if($itembodDes == null){
                $newItemBod = new GEOITEMBOD();
                $newItemBod->IDBODEGA = $destino;
                $newItemBod->IDPRODUCTO = $item;
                $newItemBod->STOCK = $cantidad;
            }else{
                $itembodDes->STOCK =  $itembodDes->STOCK + $cantidad;
                $itembodDes->save();
            }
            DB::commit();

            return response()->json([
                "status"=>"ok",
                "success" => true,
                "message" => "Transferencia de Bodega realizada con exito."
            ]);


        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            return response()->json([
                "status"=>"error",
                "success" => false,
                "message" => "Error en Transferencia de Bodega"
            ]);
        }
    }
}
