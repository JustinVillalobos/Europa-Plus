<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Models\EuropaPlu;

session_start();
class EuropaPlusController extends Controller
{
    //
    public function index(){
        $europa=EuropaPlu::where('idEmpresa','=',1)->first();
        $data=[
            "empresa"=>$europa
        ];
        return view('europa_plus/index',$data);
    }
    public function links(){
        return view('europa_plus/links');
    }
    public function edit(){
        $europa=EuropaPlu::where('idEmpresa','=',1)->first();
        $data=[
            "empresa"=>$europa
        ];
        return view('europa_plus/edit',$data);
    }
    public function update(Request $request){

        $input =$request->all();
        try {
            $europa=EuropaPlu::where('idEmpresa','=',1)->first();
            $europa->nombre=$input['nombre'];
            $europa->correo=$input['correo'];
            $europa->sitio_web=$input['sitio_web'];
            $europa->nombre=$input['nombre'];
            $europa->telefono=$input['telefono'];
            $europa->whatsapp=$input['whatsapp'];
            $europa->codigo_postal=$input['codigo_postal'];
            $europa->direccion=$input['direccion'];
            $europa->banco=$input['banco'];
            $europa->IBAN=$input['iban'];
            $europa->SWIFT=$input['swift'];
            $europa->direccion_banco=$input['direccion_banco'];
            $europa->save();
            $_SESSION['empresa']=$europa;
            echo json_encode(true);
        } catch (\Illuminate\Database\QueryException $th) {
            echo json_encode(false);
        }
    }
}
