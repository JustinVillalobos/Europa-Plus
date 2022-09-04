<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alojamiento;
use App\Models\Tipo;
session_start();
class AlojamientosController extends Controller
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
        $alojamientos = Alojamiento::select('alojamientos.*','tipos.tipo_descripcion')->join('tipos','alojamientos.tipo_id','tipos.tipo_id')->paginate(10);
        $data = [
            'alojamientos'=>$alojamientos,
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre',
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre'
        ];
        return view('alojamientos.index',$data);
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
        $alojamientos =Alojamiento::select('alojamientos.*','tipos.tipo_descripcion')->join('tipos','alojamientos.tipo_id','tipos.tipo_id');
                  
        if($input['type']=="Nombre"){
            $alojamientos =$alojamientos->where("alojamientos.alj_nombre","LIKE","%{$input['search']}%");
        } 
        if($input['type']=="tipo"){
            $tipo=[];
            $tipos =Tipo::where("tipos.tipo_descripcion","LIKE","%{$input['search']}%")->get();
            foreach ($tipos as $key => $value) {
                # code...
                $tipo[]=$value->tipo_id;
            }

            $alojamientos =$alojamientos->whereIn("alojamientos.tipo_id",$tipo);
        } 
         
        $alojamientos =$alojamientos->paginate($limit);
        return view('alojamientos.index', ["alojamientos"=>$alojamientos,'search'=>$input['search'],'limit'=>$limit,'type'=>$input['type']]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tipos=Tipo::whereIn('tipo_tipo',[0,2])->get();
        $data = [

            'tipos'=>$tipos
        ];
        return view('alojamientos.add',$data);
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
        $datos =$input['alojamiento'];
        $alojamientos = new Alojamiento([
            'alj_nombre'=>$datos['nombre'],
            'alj_descr_en'=>$datos['descr'],
            'alj_descr'=>$datos['descr_es'],
            'tipo_id'=>$datos['tipos']
        ]);
      
        try{
            $alojamientos->save();
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode(false);
        }
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
        $alojamientos=Alojamiento::where('alj_id','=',$id)->first();
        $tipos=Tipo::whereIn('tipo_tipo',[0,2])->get();
        $data = [
            'alojamiento'=>$alojamientos,
            'tipos'=>$tipos
        ];
        return view('alojamientos.edit',$data);
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
        $datos =$input['alojamiento'];
        $alojamientos = Alojamiento::where('alj_id','=',$datos['id'])->first();
        $alojamientos->alj_descr_en = $datos['descr'];
        $alojamientos->alj_nombre = $datos['nombre'];
        $alojamientos->alj_descr = $datos['descr_es'];
        $alojamientos->tipo_id = $datos['tipos'];
        try{
            $alojamientos->save();
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
        $alojamientos = Alojamiento::where('alj_id','=',$id)->first();
       
        try{
            $alojamientos->delete();
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode($e);
        }
    }
}