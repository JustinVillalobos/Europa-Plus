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
        echo "<br><br>";
        echo "<br><br>";
        var_dump($_SESSION);
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
                    $_SESSION['step2']="";
                    return view('operaciones.create',$data);
                }else if($page=="2"){
                    $dataInput['escuelas'] =$_SESSION['step1']['escuela'];
                    echo "<br><br>";
                    var_dump($_SESSION['step1']);
                    $data=$this->step2($dataInput);
                    return view('operaciones.step2',$data);
                }
            }
            switch($dataInput['step']){
                case '1':
                    $_SESSION['step2']="";
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
                    $step2= [
                        'cursos'=>$dataInput['cursos'],
                        'fechaInit'=>$dataInput['fechaInit'],
                        'fechaEnd'=>$dataInput['fechaEnd'],
                        'price'=>$dataInput['price'],
                        'price2'=>$dataInput['price2'],
                        'fechaInit'=>$dataInput['fechaInit'],
                        'fechaEnd'=>$dataInput['fechaEnd'],
                        'fechaInit2'=>$dataInput['fechaInit2'],
                        'fechaEnd2'=>$dataInput['fechaEnd2'],
                        'precios1'=>$dataInput['precios1'],
                        'precios2'=>$dataInput['precios2'],
                        'precios3'=>$dataInput['precios3'],
                        'precios4'=>$dataInput['precios4'],
                        'precios5'=>$dataInput['precios5'],
                        'precios6'=>$dataInput['precios6'],
                        'desc'=>$dataInput['desc'],
                        'apagar'=>$dataInput['apagar'],
                        'numSemanas'=>$dataInput['numSemanas'],
                        'pagado'=>$dataInput['pagado'],
                        'fechaPagado'=>$dataInput['fechaPagado']
                    ];
                   if(!empty($dataInput['scursos'])){
                    $step2['scursos']=$dataInput['scursos'];
                   }else{
                    $step2['scursos']="";
                   }
                   if(!empty($dataInput['scursos2'])){
                    $step2['scursos2']=$dataInput['scursos2'];
                   }else{
                    $step2['scursos2']="-1";
                   }
                   if(!empty($dataInput['sscursos3cursos'])){
                    $step2['scursos3']=$dataInput['scursos3'];
                   }else{
                    $step2['scursos3']="-1";
                   }
                   if(!empty($dataInput['salojamientos'])){
                    $step2['salojamientos']=$dataInput['salojamientos'];
                   }else{
                    $step2['salojamientos']="-1";
                   }
                   if(!empty($dataInput['salojamientos2'])){
                    $step2['salojamientos2']=$dataInput['salojamientos2'];
                   }else{
                    $step2['salojamientos2']="-1";
                   }
                   if(!empty($dataInput['salojamientos3'])){
                    $step2['salojamientos3']=$dataInput['salojamientos3'];
                   }else{
                    $step2['salojamientos3']="-1";
                   }
                   if(!empty($dataInput['alojamientos'])){
                    $step2['alojamientos']=$dataInput['alojamientos'];
                   }else{
                    $step2['alojamientos']="-1";
                   }
                   echo "<br><br>";
                   echo "<br><br>";
                   echo "<br><br>";
                   var_dump($step2);
                   
                    $_SESSION['step2']=$step2;
                    echo "<br><br>";
                   echo "<br><br>";
                    var_dump($_SESSION['step2']);
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
        if(!empty($_SESSION['step2'])){
            $data=[
                'cursos'=>$cursos,
                'suplementos_cursos'=>$Suplementos_cursos,
                'suplementos_alojamientos'=>$Suplementos_alojamientos,
                'alojamientos'=>$alojamientos,
                "isClear"=>false,
                'cur'=>$_SESSION['step2']['cursos'],
                'fechaInit'=>$_SESSION['step2']['fechaInit'],
                'fechaEnd'=>$_SESSION['step2']['fechaEnd'],
                'price'=>$_SESSION['step2']['price'],
                'price2'=>$_SESSION['step2']['price2'],
                 'fechaInit'=>$_SESSION['step2']['fechaInit'],
                'fechaEnd'=>$_SESSION['step2']['fechaEnd'],
                'fechaInit2'=>$_SESSION['step2']['fechaInit2'],
                'fechaEnd2'=>$_SESSION['step2']['fechaEnd2'],
                'precios1'=>$_SESSION['step2']['precios1'],
                'precios2'=>$_SESSION['step2']['precios2'],
                'precios3'=>$_SESSION['step2']['precios3'],
                'precios4'=>$_SESSION['step2']['precios4'],
                'precios5'=>$_SESSION['step2']['precios5'],
                 'precios6'=>$_SESSION['step2']['precios6'],
                'desc'=>$_SESSION['step2']['desc'],
                'apagar'=>$_SESSION['step2']['apagar'],
                'scursos'=>$_SESSION['step2']['scursos'],
                'scursos2'=>$_SESSION['step2']['scursos2'],
                'scursos3'=>$_SESSION['step2']['scursos3'],
                'salojamientos'=>$_SESSION['step2']['salojamientos'],
                'salojamientos2'=>$_SESSION['step2']['salojamientos2'],
                'salojamientos3'=>$_SESSION['step2']['salojamientos3'],
                'alojamiento'=>$_SESSION['step2']['alojamientos'],
                'numSemanas'=>$_SESSION['step2']['numSemanas'],
                'pagado'=>$_SESSION['step2']['apagar'],
                'fechaPagado'=>$_SESSION['step2']['fechaPagado']
            ];
        }else{
            $data=[
                'cursos'=>$cursos,
                'suplementos_cursos'=>$Suplementos_cursos,
                'suplementos_alojamientos'=>$Suplementos_alojamientos,
                'alojamientos'=>$alojamientos,
                "isClear"=>true,
                'cur'=>"",
                'fechaInit'=>"",
                'fechaEnd'=>"",
                'price'=>"",
                'price2'=>"",
                 'fechaInit'=>"",
                'fechaEnd'=>"",
                'fechaInit2'=>"",
                'fechaEnd2'=>"",
                'precios1'=>"",
                'precios2'=>"",
                'precios3'=>"",
                'precios4'=>"",
                'precios5'=>"",
                 'precios6'=>"",
                'desc'=>"",
                'apagar'=>"",
                'scursos'=>"",
                'scursos2'=>"",
                'scursos3'=>"",
                'salojamientos'=>"",
                'salojamientos2'=>"",
                'salojamientos3'=>"",
                'alojamiento'=>"",
                'numSemanas'=>"0",
                'pagado'=>"",
                'fechaPagado'=>""
            ];
        }

       return $data;
    }
    public function step3($dataInput){

    }
    public function vuelo(){
        return view("operaciones.vuelo");
    }
    public function transfer(){
        return view("operaciones.transfer");
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
