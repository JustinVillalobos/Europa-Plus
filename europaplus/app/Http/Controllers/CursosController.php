<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Tipo;
session_start();
class CursosController extends Controller
{
    public function __construct(){
        $uri = request()->route()->uri;
        if(empty($_SESSION['id']) ){
            return redirect('/')->send();
        }else{
            
            if(!empty($_SESSION['id'])){
                
                if($_SESSION['id']=="" ){
                   
                    return redirect('/')->send();
                }
            }
        }
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $_SESSION['search'] = "";
        $_SESSION['limit']="";
        $_SESSION['type'] = "";
        $cursos = Curso::select('cursos.*','tipos.tipo_descripcion')->join('tipos','cursos.tipo_id','tipos.tipo_id')->paginate(10);
        $data = [
            'cursos'=>$cursos,
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre',
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre'
        ];
        return view('cursos.index',$data);
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
            if($input['search']==""){
                $input['search'] =$_SESSION['search'];
            }else{
                $_SESSION['search'] =  $input['search'];
           
                $_SESSION['type'] = $input['type'];
            }
           
        }
        if(is_null($input['limit'])){
            $input['limit'] = $_SESSION['limit'];
           
        }else{
            $_SESSION['limit'] = $input['limit'];
        }
        $limit = $input['limit'];
        $cursos =Curso::select('cursos.*','tipos.tipo_descripcion')->join('tipos','cursos.tipo_id','tipos.tipo_id');
                  
        if($input['type']=="Nombre"){
            $cursos =$cursos->where("cursos.cur_nombre","LIKE","%{$input['search']}%");
        } 
        if($input['type']=="tipo"){
            $tipo=[];
            $tipos =Tipo::where("tipos.tipo_descripcion","LIKE","%{$input['search']}%")->get();
            foreach ($tipos as $key => $value) {
                # code...
                $tipo[]=$value->tipo_id;
            }

            $cursos =$cursos->whereIn("cursos.tipo_id",$tipo);
        } 
         
        $cursos =$cursos->paginate($limit);
        return view('cursos.index', ["cursos"=>$cursos,'search'=>$input['search'],'limit'=>$limit,'type'=>$input['type']]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tipos=Tipo::whereIn('tipo_tipo',[0,1])->get();
        $data = [

            'tipos'=>$tipos
        ];
        return view('cursos.add',$data);
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
        $datos =$input['curso'];
        $curso = new Curso([
            'cur_nombre'=>$datos['nombre'],
            'cur_descr_en'=>$datos['descr'],
            'tipo_id'=>$datos['tipos'],
            'cur_descr'=>$datos['descr_es']
        ]);

        $curso->save();
        echo json_encode(true);
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
        $curso=Curso::where('cur_id','=',$id)->first();
        $tipos=Tipo::whereIn('tipo_tipo',[0,1])->get();
        $data = [
            'curso'=>$curso,
            'tipos'=>$tipos
        ];
        return view('cursos.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $input =   $request->all(); 
        $datos =$input['curso'];
        $curso = Curso::where('cur_id','=',$datos['id'])->first();
        $curso->cur_descr_en = $datos['descr'];
        $curso->cur_nombre = $datos['nombre'];
        $curso->tipo_id = $datos['tipos'];
        $curso->cur_descr=$datos['descr_es'];
        try{
            $curso->save();
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode(false);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $input =   $request->all(); 
        $id =$input['id'];
        $curso = Curso::where('cur_id','=',$id)->first();
       
        try{
            $curso->delete();
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode($e);
        }
    }
}
