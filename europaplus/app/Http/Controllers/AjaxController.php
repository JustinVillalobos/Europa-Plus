<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;
use App\Models\Paise;
use App\Models\Localidade;
use App\Models\Alumno;
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
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input =   $request->all(); 
        $datos =$input['alumno'];
        $alumno = new Alumno([
            'idi_id'=> $datos['idiomas'],
            'alu_nombre'=>$datos['nombre'],
            'alu_apellidos'=>$datos['apellidos'],
            'alu_email'=>$datos['correo'],
            'alu_dni'=>$datos['pasaporte'],
            'alu_direccion'=>$datos['plaza'],
            'alu_cp'=>$datos['codigoPostal'],
            'alu_fecha_nacim'=>$datos['fecha_nacim'],
            'alu_edad'=>$datos['edad'],
            'alu_sexo'=>$datos['sexo'],
            'alu_profesion'=>$datos['profesion'],
            'alu_nivel_idioma'=>$datos['nivel_idioma'],
            'alu_alergias'=>$datos['alergias'],
            'alu_nombre_padre'=>$datos['nombrePadre'],
            'alu_tel_padre'=>$datos['telPadre'],
            'alu_medio_contacto'=>$datos['medioContacto'],
            'loc_id'=>$datos['localidades'],
            'prv_id'=>$datos['provincias'],
            'pais_id'=>$datos['paises'],
            'alu_dni_fexp'=>$datos['caduca']
        ]);
        $alumno->save();
        echo json_encode(true);
    }

}
