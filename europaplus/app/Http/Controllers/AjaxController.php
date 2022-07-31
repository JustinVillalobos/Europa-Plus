<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;
use App\Models\Paise;
use App\Models\Localidade;
class AjaxController extends Controller
{
    //
    public function getProvincias(Request $request){
        $input =   $request->all(); 
        $provincias = Provincia::where('provincias.pais_id','=',$input['pais_id'])->get();
        $localidades = [];
        if(count($provincias)>=1){
            $localidades = Localidade::select('localidades.*')
                                    ->where('localidades.prv_id','=',$provincias[0]->prv_id)->get();
        }
        

        $data = [
            'provincias'=>$provincias,
            'localidades'=>$localidades
        ];
        echo json_encode($data);
        return;
    }
    public function getLocalidades(Request $request){
        $input =   $request->all(); 
        $localidades = Localidade::select('localidades.*')
                                    ->where('localidades.prv_id','=',$input['prv_id'])->get();
        $data = [
            'localidades'=>$localidades
        ];
        echo json_encode($data);
         return;
    }
}
