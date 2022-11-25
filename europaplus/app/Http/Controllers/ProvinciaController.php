<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;
use App\Models\Paise;
session_start();
class ProvinciaController extends Controller
{
    public function __construct(){
        $uri = request()->route()->uri;
        if(empty($_SESSION['id']) ){
            return redirect('/')->send();
        }else{
            
            if(!empty($_SESSION['id'])){
                
                if($_SESSION['id']=="" ){
                   
                    return redirect('/loginAdmin')->send();
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
        $provincias = Provincia::select('provincias.*','paises.*')
                            ->join('paises','provincias.pais_id','=','paises.pais_id')
                            ->paginate(10);
        $data = [
            'provincias'=>$provincias,
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre',
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre'
        ];
        return view('provincias.index',$data);
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
        $provincias =Provincia::select('provincias.*','paises.*')
                                ->join('paises','provincias.pais_id','=','paises.pais_id');
                  
        if($input['type']=="Nombre"){
            $provincias =$provincias->where("provincias.prv_descr","LIKE","%{$input['search']}%");
        } 
        if($input['type']=="Pais"){
            $provincias =$provincias->where("paises.pais_descr","LIKE","%{$input['search']}%");
        } 
        $provincias =$provincias->paginate($limit);
        return view('provincias.index', ["provincias"=>$provincias,'search'=>$input['search'],'limit'=>$limit,'type'=>$input['type']]);
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
        $data = [
            'paises'=>$paises
        ];
        return view('provincias.add',$data);
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
        $datos =$input['provincia'];
        $provincia = new Provincia([
            'prv_descr'=>$datos['descr'],
            'pais_id'=>$datos['pais']
        ]);
        
        try{
            $provincia->save();
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
        $provincia=Provincia::select('provincias.*')
                        ->where('provincias.prv_id','=',$id)->first();
        $paises = Paise::all();
        $data = [
            'provincia'=>$provincia,
            'paises'=>$paises
        ];
        return view('provincias.edit',$data);
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
        $datos =$input['provincia'];
        $provincia=Provincia::select('provincias.*')
                        ->where('provincias.prv_id','=',$datos['id'])->first();
        
       
        $provincia->pais_id =$datos['pais'];
        $provincia->prv_descr = $datos['descr'];
        try{
            $provincia->save();
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
        $provincia=Provincia::select('provincias.*')
                        ->where('provincias.prv_id','=',$input['id'])->first();
        try{
            $provincia->delete();
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode(false);
        }
    }
}
