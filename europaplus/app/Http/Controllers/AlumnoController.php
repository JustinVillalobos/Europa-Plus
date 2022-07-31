<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
session_start();
class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $alumnos =Alumno::select('alumnos.*','opciones.*','paises.pais_descr')
                            ->join('opciones','alumnos.idi_id','=','opciones.opc_id')
                            ->join('provincias','alumnos.prv_id','=','provincias.prv_id')
                            ->join('paises','provincias.pais_id','=','paises.pais_id')
                            ->paginate(10);
        return view('alumnos.index', ["alumnos"=>$alumnos,'search'=>"",'limit'=>10,'type'=>'Nombre']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formulario()
    {
        //
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function busqueda(Request $request)
    {
        //
        $input =   $request->all(); 
        if(empty($input['search']) && empty($input['limit'])){
            $input['search'] ="" ;
                $input['limit'] = $_SESSION['limit'];
                $input['type'] = $_SESSION['type'];
            
        }
        if(is_null($input['search'])){
            $input['search'] =$_SESSION['search'];
            $input['type'] = $_SESSION['type'];
        }else{
            $_SESSION['search'] =  $input['search'];
           
            $_SESSION['type'] = $input['type'];
        }
        if(is_null($input['limit'])){
            $input['limit'] = $_SESSION['limit'];
           
        }else{
            $_SESSION['limit'] = $input['limit'];
        }
        $limit = $input['limit'];
        $alumnos =Alumno::select('alumnos.*','opciones.*','paises.pais_descr')
                            ->join('opciones','alumnos.idi_id','=','opciones.opc_id')
                            ->join('provincias','alumnos.prv_id','=','provincias.prv_id')
                            ->join('paises','provincias.pais_id','=','paises.pais_id');
                  
        if($input['type']=="Nombre"){
            $alumnos =$alumnos->where("alumnos.alu_nombre","LIKE","%{$input['search']}%");
        } else if ($input['type']=="Apellidos"){
            $alumnos = $alumnos->where("alumnos.alu_apellidos","LIKE","%{$input['search']}%");
        }else if($input['type']=="Idioma"){
            $alumnos =$alumnos->where("opciones.opc_descr","LIKE","%{$input['search']}%");
        }else if($input['type']=="Pais"){
            $alumnos =$alumnos->where("paises.pais_descr","LIKE","%{$input['search']}%");
        }
         
        $alumnos =$alumnos->paginate($limit);
        return view('alumnos.index', ["alumnos"=>$alumnos,'search'=>$input['search'],'limit'=>$limit,'type'=>$input['type']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('alumnos.create');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('alumnos.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('alumnos.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
