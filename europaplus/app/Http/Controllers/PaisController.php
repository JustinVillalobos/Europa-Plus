<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paise;
session_start();
class PaisController extends Controller
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
        $paises = Paise::select('paises.*')->paginate(10);;
        $data = [
            'paises'=>$paises,
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre',
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre'
        ];
        return view('paises.index',$data);
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
        $paises =Paise::select('paises.*');
                  
        if($input['type']=="Nombre"){
            $paises =$paises->where("paises.pais_descr","LIKE","%{$input['search']}%");
        } 
         
        $paises =$paises->paginate($limit);
        return view('paises.index', ["paises"=>$paises,'search'=>$input['search'],'limit'=>$limit,'type'=>$input['type']]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('paises.add');
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
        $datos =$input['pais'];
        $pais = new Paise([
            'pais_descr'=>$datos['descr']
        ]);
        $pais->save();
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
        $pais=Paise::where('paises.pais_id','=',$id)->first();
        $data = [
            'pais'=>$pais,
        ];
        return view('paises.edit',$data);
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
        $datos =$input['pais'];
        $pais = Paise::where('pais_id','=',$datos['id'])->first();
        $pais->pais_descr = $datos['descr'];
        $pais->save();
        echo json_encode(true);
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
        $pais = Paise::where('pais_id','=',$id)->first();
       
        try{
            $pais->delete();
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode($e);
        }
    }
}
