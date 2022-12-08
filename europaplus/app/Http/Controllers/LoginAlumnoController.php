<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use  App\Models\EuropaPlu;
session_start();
class LoginAlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $_SESSION["errorBD"]="";
        $_SESSION['id'] ="";
        return view('loginAlumno.index');
    }
    public function loginValidator(Request $request){
        $input = $request->all();
        $usuario = User::where('name','=',$input['user'])
                            ->where('password','=',md5($input['pass']))
                            ->where('group_id','=',2)
                            ->first();
        
        if(empty($usuario)){

            $_SESSION["errorBD"] = "**Usuario no encontrado.";
            return view('loginAlumno.index');
        }else{
            $empresa=EuropaPlu::where("idEmpresa",'=','1')->first();
            $_SESSION["errorBD"] = "";
            $_SESSION["empresa"]=$empresa;
            $_SESSION['id'] = $usuario->id;
            return redirect()->to('./panel');
        }
        
       
    }
    public function logout(){
        $_SESSION['id'] = "";
        return redirect()->to('/loginAlumno');
    }
}
