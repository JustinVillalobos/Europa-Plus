<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
session_start();
class LoginController extends Controller
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
        return view('login.index');
    }
    public function loginValidator(Request $request){
        $input = $request->all();
        $usuario = User::where('name','=',$input['user'])
                            ->where('password','=',md5($input['pass']))
                            ->first();
        
        if(empty($usuario)){

            $_SESSION["errorBD"] = "**Usuario no encontrado.";
            return view('login.index');
        }else{
            var_dump("PSS");
            $_SESSION["errorBD"] = "";
            $_SESSION['id'] = $usuario->id;
            return redirect()->to('./alumno');
        }
        
       
    }
    public function logout(){
        $_SESSION['id'] = "";
        return redirect()->to('/');
    }
}
