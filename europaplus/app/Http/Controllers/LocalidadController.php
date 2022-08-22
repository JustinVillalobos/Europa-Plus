<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;
use App\Models\Paise;
use App\Models\Localidade;
session_start();
class LocalidadController extends Controller
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
        $localidades = Localidade::select('localidades.*','provincias.*','paises.*')
                            ->join('provincias','provincias.prv_id','=','localidades.prv_id')
                            ->join('paises','provincias.pais_id','=','paises.pais_id')
                            ->paginate(10);
        $data = [
            'localidades'=>$localidades,
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre',
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre'
        ];
        return view('localidades.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $paises = Paise::all();
        $provincias = Provincia::where('provincias.pais_id','=',$paises[1]->pais_id)->get();
        $data = [
            'paises'=>$paises,
            'provincias'=>$provincias
        ];
        return view('localidades.add',$data);
        
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
        $localidades = Localidade::select('localidades.*','provincias.*','paises.*')
                                    ->join('provincias','provincias.prv_id','=','localidades.prv_id')
                                    ->join('paises','provincias.pais_id','=','paises.pais_id');
                  
        if($input['type']=="Nombre"){
            $localidades =$localidades->where("localidades.loc_descr","LIKE","%{$input['search']}%");
        } 
        if($input['type']=="Pais"){
            $localidades =$localidades->where("paises.pais_descr","LIKE","%{$input['search']}%");
        } 
        if($input['type']=="Provincias"){
            $localidades =$localidades->where("provincias.prv_descr","LIKE","%{$input['search']}%");
        } 
        
        $localidades =$localidades->paginate($limit);
        return view('localidades.index', ["localidades"=>$localidades,'search'=>$input['search'],'limit'=>$limit,'type'=>$input['type']]);
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
        $datos =$input['localidad'];
        $localidad = new Localidade([
            'loc_descr'=>$datos['descr'],
            'pais_id'=>$datos['pais'],
            'prv_id'=>$datos['provincia']
        ]);
        
        try{
            $localidad->save();
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
        $localidad=Localidade::select('localidades.*')
        ->where('localidades.loc_id','=',$id)->first();
        $paises = Paise::all();
        $provincias = Provincia::where('provincias.pais_id','=',$localidad->pais_id)->get();
        $data = [
        'provincias'=>$provincias,
        'paises'=>$paises,
        'localidad'=>$localidad
        ];
        return view('localidades.edit',$data);
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
        $datos =$input['localidad'];
        $localidad=Localidade::select('localidades.*')
                                ->where('localidades.loc_id','=',$datos['id'])->first();
        $localidad->pais_id =$datos['pais'];
        $localidad->prv_id =$datos['provincia'];
        $localidad->loc_descr = $datos['descr'];
        try{
            $localidad->save();
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
        $localidad=Localidade::select('localidades.*')
                                ->where('localidades.loc_id','=',$input['id'])->first();
        try{
            $localidad->delete();
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode(false);
        }
    }
}
