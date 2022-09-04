<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo;
session_start();
class TipoController extends Controller
{public function __construct(){
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
    $tipos = Tipo::select('tipos.*')
                        ->paginate(10);
    $data = [
        'tipos'=>$tipos,
        'search'=>"",
        'limit'=>10,
        'type'=>'Nombre',
        'search'=>"",
        'limit'=>10,
        'type'=>'Nombre'
    ];
    return view('tipos.index',$data);
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
    $tipos =Tipo::select('tipos.*');
              
    if($input['type']=="Nombre"){
        $tipos =$tipos->where("tipos.tipo_descripcion","LIKE","%{$input['search']}%");
    } 
    if($input['type']=="tipo"){
        $tipo=[];
        $sujeto = "Ambos";
        $patron = '/^'.$input["search"].'/';
        if(preg_match($patron, $sujeto, $coincidencias)>0){
            $tipo[]=0;
        }
        $sujeto = "Cursos";
        if(preg_match($patron, $sujeto, $coincidencias)>0){
            $tipo[]=1;
        }
        $sujeto = "Alojamientos";
        if(preg_match($patron, $sujeto, $coincidencias)>0){
            $tipo[]=2;
        }

        $tipos =$tipos->whereIn("tipos.tipo_tipo",$tipo);
    } 
    $tipos =$tipos->paginate($limit);
    return view('tipos.index', ["tipos"=>$tipos,'search'=>$input['search'],'limit'=>$limit,'type'=>$input['type']]);
}
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    //

    return view('tipos.add');
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
    $datos =$input['tipo'];
    $tipos = new Tipo([
        'tipo_descripcion'=>$datos['descr'],
        'tipo_tipo'=>$datos['subtipo'],
        'tipo_porcentaje'=>$datos['prc']
    ]);
    
    try{
        $tipos->save();
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
    $tipos=Tipo::select('tipos.*')
                    ->where('tipos.tipo_id','=',$id)->first();
    $data = [
        'tipo'=>$tipos
    ];
    return view('tipos.edit',$data);
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
    $datos =$input['tipo'];
    $tipos=Tipo::select('tipos.*')
                    ->where('tipos.tipo_id','=',$datos['id'])->first();
    
   
    $tipos->tipo_tipo =$datos['subtipo'];
    $tipos->tipo_porcentaje =$datos['prc'];
    $tipos->tipo_descripcion = $datos['descr'];
    try{
        $tipos->save();
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
    $tipos=Tipo::select('tipos.*')
                    ->where('tipos.tipo_id','=',$input['id'])->first();
    try{
        $tipos->delete();
        echo json_encode(true);
    }catch(\Illuminate\Database\QueryException $e){
        echo json_encode(false);
    }
}
}
