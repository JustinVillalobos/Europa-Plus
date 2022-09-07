<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operacione;
use App\Models\Alumno;
use App\Models\Escuela;
use App\Models\Alojamiento;
use App\Models\Curso;
use App\Models\Suplemento;
session_start();
class OperacionController extends Controller
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
        $operaciones =Operacione::select('operaciones.*','alumnos.*','cursos.*','escuelas.esc_nombre')
                                ->join('cursos','operaciones.cur_id','cursos.cur_id')
                                ->join('cursos_escuelas','cursos.cur_id','cursos_escuelas.cur_id')
                                ->join('escuelas','escuelas.esc_id','cursos_escuelas.esc_id')
                                ->join('alumnos','alumnos.alu_id','operaciones.alu_id')
                                
                                ->orderBy('operaciones.opr_id','DESC')
                                ->paginate(10);
        $data =[
            'operaciones'=>$operaciones,
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre',
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre'
        ];
        return view('operaciones.index',$data);
    }
    public function busquedaOperacion(Request $request)
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
       // $paises =Paise::select('paises.*');
                  
        if($input['type']=="Nombre"){
            //$paises =$paises->where("paises.pais_descr","LIKE","%{$input['search']}%");
        } 
         
       // $paises =$paises->paginate($limit);
       $operaciones=[];
        return view('operaciones.index', ["operaciones"=>$operaciones,'search'=>$input['search'],'limit'=>$limit,'type'=>$input['type']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        var_dump($request->all());
        $dataInput =$request->all();
        if(empty($dataInput['step']) && empty($dataInput['page'])){
           $data = $this->step1($dataInput); 
           return view('operaciones.create',$data);
        }else{
            if(!empty($dataInput['action'])){
                $page = $dataInput['page'];
                if($page=="1"){
                    $alumnos =Alumno::select('alumnos.*')->get();
                    $escuelas=Escuela::select('escuelas.*')->get();
                    $data=[
                        'alumnos'=>$alumnos,
                        'escuelas'=>$escuelas,
                        'alumno'=>$_SESSION['step1']['alumno'],
                        'fecha'=>$_SESSION['step1']['fecha'],
                        'escuela'=>$_SESSION['step1']['escuela'],
                        'vuelo'=>$_SESSION['step1']['vuelo'],
                        "isClear"=>false
                    ];
                    return view('operaciones.create',$data);
                }else if($page=="2"){
                    $dataInput['escuelas'] =$_SESSION['step1'];
                    $data=$this->step2($dataInput);
                    return view('operaciones.step2',$data);
                }
            }
            switch($dataInput['step']){
                case '1':
                    $step1= [
                        'fecha'=>$dataInput['fecha'],
                        'alumno'=>$dataInput['alumnos'],
                        'escuela'=>$dataInput['escuelas'],
                        'vuelo'=>$dataInput['vuelo']
                    ];
                   
                    $_SESSION['step1']=$step1;
                    $data=$this->step2($dataInput);
                    return view('operaciones.step2',$data);
                    break;
                case '2':
                    $dataInput['escuelas'] =$_SESSION['step1'];
                    $data=$this->step2($dataInput);
                    return view('operaciones.step3',$data);
                    break;
            }
        }
    }
    public function step1($dataInput){
        if(empty($dataInput['action'])){
            $_SESSION['step1']="";
            $alumnos =Alumno::select('alumnos.*')->get();
            $escuelas=Escuela::select('escuelas.*')->get();
            $data=[
                'alumnos'=>$alumnos,
                'escuelas'=>$escuelas,
                'alumno'=>"",
                'fecha'=>"",
                'escuela'=>"",
                'vuelo'=>"",
                "isClear"=>true
            ];
           
            return $data;
        }else{
            $page = $dataInput['page'];
            if($page=="1"){
                $alumnos =Alumno::select('alumnos.*')->get();
                $escuelas=Escuela::select('escuelas.*')->get();
                $data=[
                    'alumnos'=>$alumnos,
                    'escuelas'=>$escuelas,
                    'alumno'=>$_SESSION['step1']['alumno'],
                    'fecha'=>$_SESSION['step1']['fecha'],
                    'escuela'=>$_SESSION['step1']['escuela'],
                    'vuelo'=>$_SESSION['step1']['vuelo'],
                    "isClear"=>false
                ];
                return $data;
            }
        }
    }
    public function step2($dataInput){
        $cursos=Curso::select('cursos.*')
                            ->join('cursos_escuelas','cursos_escuelas.cur_id','cursos.cur_id')
                            ->where('cursos_escuelas.esc_id','=',$dataInput['escuelas'])->get();
        $alojamientos=Alojamiento::select('alojamientos.*')
                            ->join('alojamientos_escuelas','alojamientos_escuelas.alj_id','alojamientos.alj_id')
                            ->where('alojamientos_escuelas.esc_id','=',$dataInput['escuelas'])->get();
        $Suplementos_cursos=Suplemento::select('suplementos.*')
                                ->join('suplementos_escuelas','suplementos.sup_id','suplementos_escuelas.sup_id')
                                ->where('suplementos_escuelas.esc_id','=',$dataInput['escuelas'])
                                ->where('suplementos.sup_tipo','=','0')->get();
        $Suplementos_alojamientos=Suplemento::select('suplementos.*')
                                ->join('suplementos_escuelas','suplementos.sup_id','suplementos_escuelas.sup_id')
                                ->where('suplementos_escuelas.esc_id','=',$dataInput['escuelas'])
                                ->where('suplementos.sup_tipo','=','1')->get();
        $data=[
            'cursos'=>$cursos,
            'suplementos_cursos'=>$Suplementos_cursos,
            'suplementos_alojamientos'=>$Suplementos_alojamientos,
            'alojamientos'=>$alojamientos,
            "isClear"=>true
        ];
       return $data;
    }
    public function step3($dataInput){

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
