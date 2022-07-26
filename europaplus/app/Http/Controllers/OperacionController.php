<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operacione;
use App\Models\Alumno;
use App\Models\Escuela;
use App\Models\Alojamiento;
use App\Models\Curso;
use App\Models\Suplemento;
use App\Models\Viaje;
use  App\Models\SuplementosOperacione;
use  App\Models\EuropaPlu;
session_start();
class OperacionController extends Controller
{
    public $isProduction=false;
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
        $operaciones =Operacione::select('operaciones.*','alumnos.*','cursos.*','operaciones.opr_id as esc_nombre')
                                ->join('cursos','operaciones.cur_id','cursos.cur_id')
                               // ->join('cursos_escuelas','cursos.cur_id','cursos_escuelas.cur_id')
                               // ->join('escuelas','escuelas.esc_id','cursos_escuelas.esc_id')
                                ->join('alumnos','alumnos.alu_id','operaciones.alu_id')
                                ->where('operaciones.opr_state','=','0')
                                ->where('operaciones.opr_cancelada','=','0')
                                ->orderBy('operaciones.opr_id','DESC') 
                                ->paginate(10);
       foreach ($operaciones as $key => $value) {
            $escuela= Escuela::join('cursos_escuelas','escuelas.esc_id','cursos_escuelas.esc_id')
                                ->join('cursos','cursos_escuelas.cur_id','cursos.cur_id')
                                ->where('cursos.cur_id','=', $operaciones[$key]->cur_id)->first();

            if(!empty($escuela)){
                $operaciones[$key]->esc_nombre=$escuela->esc_nombre;
            }else{
                $operaciones[$key]->esc_nombre="";
            }
          
        }
        $data =[
            'operaciones'=>$operaciones,
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre',
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre',
            'tipo'=>0,
            'date'=> date('Y'),
            "order"=>4
        ];
        return view('operaciones.index',$data);
    }
    public function busquedaOperacion(Request $request)
    {
        //
        $operaciones=Operacione::select('operaciones.*','alumnos.*','cursos.*','escuelas.*','escuelas.esc_nombre as esc_nombre')
        ->join('cursos','operaciones.cur_id','cursos.cur_id')
        ->leftJoin('cursos_escuelas','cursos.cur_id','cursos_escuelas.cur_id')
        ->leftJoin('escuelas','escuelas.esc_id','cursos_escuelas.esc_id')
        ->leftJoin('alumnos','alumnos.alu_id','operaciones.alu_id');
       // ->where('operaciones.opr_state','=','0')
       // ->orderBy('operaciones.opr_id','DESC') 
      //  ->paginate(10);->whereRaw("".$where)
        $input =   $request->all(); 
        if(empty($input['search']) && empty($input['limit'])){
            $input['search'] ="" ;
                $input['limit'] = $_SESSION['limit'];
                
            
        }
        if(is_null($input['search'])){
            $input['search'] ="" ;
           
        }else{
            if($input['search']==""){
                $input['search'] ="" ;
            }else{
                $_SESSION['search'] =  "";
           
                
            }
           
        }
        if(is_null($input['limit'])){
            $input['limit'] = $_SESSION['limit'];
           
        }else{
            $_SESSION['limit'] = $input['limit'];
        }
        $limit = $input['limit'];
       // $paises =Paise::select('paises.*');
                  
        if($input['tipo']==0){
            //$paises =$paises->where("paises.pais_descr","LIKE","%{$input['search']}%");
            $operaciones=$operaciones->where('operaciones.opr_state','=','0')->where('operaciones.opr_cancelada','=','0');
            //o.opr_state=0 and o.opr_cancelada=0
        }else if($input['tipo']==6){
            $operaciones=$operaciones->where('operaciones.opr_cancelada','=','1');
        } else if($input['tipo']==1){
            $operaciones=$operaciones->where('operaciones.opr_pago_previo','=','0')->where('operaciones.opr_cancelada','=','0');
            //o.opr_pago_previo=0 and o.opr_cancelada=0
        }else if($input['tipo']==2){
            $operaciones=$operaciones->where('operaciones.opr_pendiente','>','0')->where('operaciones.opr_cancelada','=','0');
            //o.opr_pendiente>0 and o.opr_cancelada=0
        }else if($input['tipo']==3){
            $operaciones=$operaciones->where('operaciones.opr_state','=','1')->where('operaciones.opr_cancelada','=','0');
            //o.opr_state=1 and o.opr_cancelada=0
        }else if($input['tipo']==4){
            $operaciones=$operaciones->where('operaciones.opr_cur_state','=','1')->where('operaciones.opr_cancelada','=','0');
            //o.opr_cur_state=1 and o.opr_cancelada=0
        }else if($input['tipo']==5){
            //o.opr_confirm_state=0 and o.opr_cancelada=0
            $operaciones=$operaciones->where('operaciones.opr_confirm_state','=','0')->where('operaciones.opr_cancelada','=','0');
        }
        if(!empty($input['search'])){
            $operaciones=$operaciones->whereRaw("operaciones.opr_id=".$input['search']." or escuelas.esc_nombre=".$input['search']." or alumnos.alu_apellidos=".$input['search']."");
        }
       
        if($input['order']==0){
            $operaciones= $operaciones->orderBy('operaciones.opr_id','DESC') ;
        }else if($input['order']==1){
            $operaciones= $operaciones->orderBy('operaciones.cur_fecha_inicio','DESC')->orderBy('operaciones.cur_fecha_fin','DESC') ;
        }else if($input['order']==2){
            $operaciones= $operaciones->orderBy('operaciones.opr_fecha','DESC') ;
            
        }else if($input['order']==3){
            $operaciones= $operaciones->orderBy('alumnos.alu_apellidos','ASC') ;
            
        }else if($input['order']==4){
            $operaciones= $operaciones->orderBy('escuelas.esc_nombre','ASC') ;
        }
       
       
        $operaciones =$operaciones->paginate($limit);
       
       $data=[
        "operaciones"=>$operaciones,
        'search'=>$input['search'],
        'limit'=>$limit,
        'type'=>"",
        'tipo'=>$input['tipo'],
            'date'=> $input['date'],
            "order"=>$input['order']
       ];
        return view('operaciones.index',  $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
       
        $dataInput =$request->all();
        if(empty($dataInput['step']) && empty($dataInput['page'])){
           $data = $this->step1($dataInput); 
           return view('operaciones/add.create',$data);
        }else{
            if(!empty($dataInput['action'])){
                $page = $dataInput['page'];
                if($page=="1"){
                    $alumnos =Alumno::select('alumnos.*')->where("alumnos.active",'=','1')->get();
                    $escuelas=Escuela::select('escuelas.*')->get();
                    $data=[
                        'alumnos'=>$alumnos,
                        'escuelas'=>$escuelas,
                        'alumno'=>$_SESSION['step1']['alumno'],
                        'fecha'=>$_SESSION['step1']['fecha'],
                        'escuela'=>$_SESSION['step1']['escuela'],
                        'vuelo'=>1,
                        "isClear"=>false
                    ];
                    $_SESSION['step2']="";
                    return view('operaciones/add.create',$data);
                }else if($page=="2"){
                    $dataInput['escuelas'] =$_SESSION['step1']['escuela'];
                    $data=$this->step2($dataInput);
                    if($_SESSION['step1']['vuelo']==1){
                        $data['isFinaly']=1;
                    }else{
                        $data['isFinaly']=2;
                    }
                    return view('operaciones/add.step2',$data);
                }
            }
            switch($dataInput['step']){
                case '1':
                    $_SESSION['step2']="";
                    $step1= [
                        'fecha'=>$dataInput['fecha'],
                        'alumno'=>$dataInput['alumnos'],
                        'escuela'=>$dataInput['escuelas'],
                        'vuelo'=>1
                    ];
                   
                    $_SESSION['step1']=$step1;
                    $data=$this->step2($dataInput);
                    
                    if($_SESSION['step1']['vuelo']==1){
                        $data['isFinaly']=1;
                    }else{
                        $data['isFinaly']=2;
                    }
                    return view('operaciones/add.step2',$data);
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

                   
                    $_SESSION['step2']=$step2;

                    $data=$this->step2($dataInput);
                    
                    return view('operaciones/add.step3',$data);
                    break;
            }
        }
    }
    public function step1($dataInput){
        if(empty($dataInput['action'])){
            $_SESSION['step1']="";
            $alumnos =Alumno::select('alumnos.*')->where("alumnos.active",'=','1')->get();
            $escuelas=Escuela::select('escuelas.*')->get();
            $data=[
                'alumnos'=>$alumnos,
                'escuelas'=>$escuelas,
                'alumno'=>"",
                'fecha'=>"",
                'escuela'=>"",
                'vuelo'=>1,
                "isClear"=>true
            ];
           
            return $data;
        }else{
            $page = $dataInput['page'];
            if($page=="1"){
                $alumnos =Alumno::select('alumnos.*')->where("alumnos.active",'=','1')->get();
                $escuelas=Escuela::select('escuelas.*')->get();
                $data=[
                    'alumnos'=>$alumnos,
                    'escuelas'=>$escuelas,
                    'alumno'=>$_SESSION['step1']['alumno'],
                    'fecha'=>$_SESSION['step1']['fecha'],
                    'escuela'=>$_SESSION['step1']['escuela'],
                    'vuelo'=>1,
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
                'pagado'=>$_SESSION['step2']['pagado'],
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
                'desc'=>"0",
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
    public function step1Edit($dataInput,$opr_id){
        if(empty($dataInput['action'])){
            $_SESSION['step1']="";
            $alumnos =Alumno::select('alumnos.*')->where("alumnos.active",'=','1')->get();
            $escuelas=Escuela::select('escuelas.*')->get();
            $operacion = Operacione::where('opr_id','=',$opr_id)->first();
            $data=[
                'alumnos'=>$alumnos,
                'escuelas'=>$escuelas,
                'alumno'=>$operacion->alu_id,
                'fecha'=>$operacion->opr_fecha,
                'escuela'=>$operacion->esc_id,
                'vuelo'=>$operacion->vje_id,
                "isClear"=>false
            ];
           
            return $data;
        }else{
            $page = $dataInput['page'];
            if($page=="1"){
               
                $alumnos =Alumno::select('alumnos.*')->where("alumnos.active",'=','1')->get();
                $escuelas=Escuela::select('escuelas.*')->get();
                $data=[
                    'alumnos'=>$alumnos,
                    'escuelas'=>$escuelas,
                    'alumno'=>$_SESSION['step1']['alumno'],
                    'fecha'=>$_SESSION['step1']['fecha'],
                    'escuela'=>$_SESSION['step1']['escuela'],
                    'vuelo'=>1,
                    "isClear"=>false
                ];
                return $data;
            }
        }
    }
    public function step2Edit($dataInput,$opr_id){
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
                'pagado'=>$_SESSION['step2']['pagado'],
                'fechaPagado'=>$_SESSION['step2']['fechaPagado'],
                'opr_comentarios'=>"",
                'opr_comentarios_esc'=>"",
                'opr_cmntsalu'=>"",
                'opr_cmntsalj'=>""
            ];
        }else{
            
            $operacion = Operacione::where('opr_id','=',$opr_id)->first();
            
            $suplementos_cursos=SuplementosOperacione::where('opr_id','=',$opr_id)
                                                    ->where('sup_tipo','=','0')->get();
            $suplementos_alojamiento=SuplementosOperacione::where('opr_id','=',$opr_id)
                                                    ->where('sup_tipo','=','1')->get();

            $sc=[];
            
            if(count($suplementos_cursos)>0){
                $sc[]=array("sup_id"=>$suplementos_cursos[0]->sup_id,"precio"=>$suplementos_cursos[0]->precio_unidad);
            }else{
                $sc[]=array("sup_id"=>0,"precio"=>0);
            }
            if(count($suplementos_cursos)>1){
                $sc[]=array("sup_id"=>$suplementos_cursos[1]->sup_id,"precio"=>$suplementos_cursos[1]->precio_unidad);
            }else{
                $sc[]=array("sup_id"=>0,"precio"=>0);
            }
            if(count($suplementos_cursos)>2){
                $sc[]=array("sup_id"=>$suplementos_cursos[2]->sup_id,"precio"=>$suplementos_cursos[2]->precio_unidad);
            }else{
                $sc[]=array("sup_id"=>0,"precio"=>0);
            }
            if(count($suplementos_alojamiento)>0){
                $sc[]=array("sup_id"=>$suplementos_alojamiento[0]->sup_id,"precio"=>$suplementos_alojamiento[0]->precio_unidad);
            }else{
                $sc[]=array("sup_id"=>0,"precio"=>0);
            }
            if(count($suplementos_alojamiento)>1){
                $sc[]=array("sup_id"=>$suplementos_alojamiento[1]->sup_id,"precio"=>$suplementos_alojamiento[1]->precio_unidad);
            }else{
                $sc[]=array("sup_id"=>0,"precio"=>0);
            }
            if(count($suplementos_alojamiento)>2){
                $sc[]=array("sup_id"=>$suplementos_alojamiento[2]->sup_id,"precio"=>$suplementos_alojamiento[2]->precio_unidad);
            }else{
                $sc[]=array("sup_id"=>0,"precio"=>0);
            }
            
            $data=[
                'cursos'=>$cursos,
                'suplementos_cursos'=>$Suplementos_cursos,
                'suplementos_alojamientos'=>$Suplementos_alojamientos,
                'alojamientos'=>$alojamientos,
                "isClear"=>false,
                'cur'=> $operacion->cur_id,
                'fechaInit'=> $operacion->cur_fecha_inicio,
                'fechaEnd'=>$operacion->cur_fecha_fin,
                'price'=>$operacion->cur_precio,
                'price2'=>$operacion->alj_precio,
                'fechaInit'=> $operacion->cur_fecha_inicio,
                'fechaEnd'=>$operacion->cur_fecha_fin,
                'fechaInit2'=>$operacion->alj_fecha_inicio,
                'fechaEnd2'=>$operacion->alj_fecha_fin,
                'precios1'=>$sc[0]['precio'],
                'precios2'=>$sc[1]['precio'],
                'precios3'=>$sc[2]['precio'],
                'precios4'=>$sc[3]['precio'],
                'precios5'=>$sc[4]['precio'],
                 'precios6'=>$sc[5]['precio'],
                'desc'=>$operacion->opr_descuento,
                'apagar'=>$operacion->opr_apagar,
                'scursos'=>$sc[0]['sup_id'],
                'scursos2'=>$sc[1]['sup_id'],
                'scursos3'=>$sc[2]['sup_id'],
                'salojamientos'=>$sc[3]['sup_id'],
                'salojamientos2'=>$sc[4]['sup_id'],
                'salojamientos3'=>$sc[5]['sup_id'],
                'alojamiento'=>$operacion->alj_id,
                'numSemanas'=>$operacion->cur_semanas,
                'pagado'=>$operacion->opr_ttl_coste,
                'fechaPagado'=>$operacion->cur_fecha_pagprov,
                'opr_comentarios'=>$operacion->opr_comentarios,
                'opr_comentarios_esc'=>$operacion->opr_comentarios_esc,
                'opr_cmntsalu'=>$operacion->opr_cmntsalu,
                'opr_cmntsalj'=>$operacion->opr_cmntsalj
                
            ];
        }
        

       return $data;
    }
    public function step3Edit($dataInput,$opr_id){
        $viaje = Viaje::where('opr_id','=',$opr_id)->first();
        
        $data = [
            "isClear"=>false,
            'vje_vuelo'=>$viaje->vje_vuelo,
            'vje_transfer'=>$viaje->vje_transfer,
            'vje_descr'=>"",
            'vje_ida_linea'=>$viaje->vje_ida_linea,
            'vje_ida_salida'=>$viaje->vje_ida_salida,
            'vje_ida_hsalida'=>$viaje->vje_ida_hsalida,
            'vje_ida_llegada'=>$viaje->vje_ida_llegada,
            'vje_ida_hllegada'=>$viaje->vje_ida_hllegada,
            'vje_ida_aeropuerto'=>$viaje->vje_ida_aeropuerto,
            'vje_ida_aeropuerto1'=>$viaje->vje_ida_aeropuerto1,
            'vje_ida_num_vuelo'=>$viaje->vje_ida_num_vuelo,
            'vje_ida_num_vuelo1'=>$viaje->vje_ida_num_vuelo1,
            'vje_vta_linea'=>$viaje->vje_vta_linea,
            'vje_vta_salida'=>$viaje->vje_vta_salida,
            'vje_vta_hsalida'=>$viaje->vje_vta_hsalida,
            'vje_vta_llegada'=>$viaje->vje_vta_llegada,
            'vje_vta_hllegada'=>$viaje->vje_vta_hllegada,
            'vje_vta_aeropuerto'=>$viaje->vje_vta_aeropuerto,
            'vje_vta_aeropuerto1'=>$viaje->vje_vta_aeropuerto1,
            'vje_vta_num_vuelo'=>$viaje->vje_vta_num_vuelo,
            'vje_vta_num_vuelo1'=>$viaje->vje_vta_num_vuelo1,
            'vje_vuelo_precio'=>$viaje->vje_vuelo_precio,
            'vje_transfer_precio'=>$viaje->vje_transfer_precio,
            'axp_id'=>0,
            'vje_info_salida'=>$viaje->vje_info_salida,
            'vje_info_llegada'=>$viaje->vje_info_llegada,
            'vje_vuelo_tipo'=>$viaje->vje_vuelo_tipo,
            'vje_vuelo_coste'=>$viaje->vje_vuelo_coste,
            'vje_transfer_tipo'=>$viaje->vje_transfer_tipo,
            'vje_transfer_coste'=>$viaje->vje_transfer_coste,
            'opr_id'=>$viaje->opr_id,
            'vje_ida_localizador'=>$viaje->vje_ida_localizador,
            'vje_vta_localizador'=>$viaje->vje_vta_localizador
        ];
        
        return $data;
    }
    public function curso_operacion($id){
        try {
            //code...
            $_SESSION['opr_id']=$id;
            $_SESSION["idOperacion"]=$id;
            $_SESSION["operacion"]="1";
            $operacion = Operacione::where('opr_id','=',$id)->first();
            $_SESSION["status_curso"]= $operacion->opr_cur_state;
            $opr_id=$id;
            $operacion = Operacione::where('opr_id','=',$opr_id)->first();
            $cursos=Curso::select('cursos.*')
                            ->join('cursos_escuelas','cursos_escuelas.cur_id','cursos.cur_id')
                            ->where('cursos_escuelas.esc_id','=',$operacion->esc_id)->get();
            $alojamientos=Alojamiento::select('alojamientos.*')
                                ->join('alojamientos_escuelas','alojamientos_escuelas.alj_id','alojamientos.alj_id')
                                ->where('alojamientos_escuelas.esc_id','=',$operacion->esc_id)->get();
            $Suplementos_cursos_list=Suplemento::select('suplementos.*')
                                    ->join('suplementos_escuelas','suplementos.sup_id','suplementos_escuelas.sup_id')
                                    ->where('suplementos_escuelas.esc_id','=',$operacion->esc_id)
                                    ->where('suplementos.sup_tipo','=','0')->get();
            $Suplementos_alojamientos_list=Suplemento::select('suplementos.*')
                                ->join('suplementos_escuelas','suplementos.sup_id','suplementos_escuelas.sup_id')
                                ->where('suplementos_escuelas.esc_id','=',$operacion->esc_id)
                                ->where('suplementos.sup_tipo','=','1')->get();
           
            $suplementos_cursos=SuplementosOperacione::where('opr_id','=',$opr_id)
                                                    ->where('sup_tipo','=','0')->get();
            $suplementos_alojamiento=SuplementosOperacione::where('opr_id','=',$opr_id)
                                                    ->where('sup_tipo','=','1')->get();

            $sc=[];
            
            if(count($suplementos_cursos)>0){
                $sc[]=array("sup_id"=>$suplementos_cursos[0]->sup_id,"precio"=>$suplementos_cursos[0]->precio_unidad);
            }else{
                $sc[]=array("sup_id"=>0,"precio"=>0);
            }
            if(count($suplementos_cursos)>1){
                $sc[]=array("sup_id"=>$suplementos_cursos[1]->sup_id,"precio"=>$suplementos_cursos[1]->precio_unidad);
            }else{
                $sc[]=array("sup_id"=>0,"precio"=>0);
            }
            if(count($suplementos_cursos)>2){
                $sc[]=array("sup_id"=>$suplementos_cursos[2]->sup_id,"precio"=>$suplementos_cursos[2]->precio_unidad);
            }else{
                $sc[]=array("sup_id"=>0,"precio"=>0);
            }
            if(count($suplementos_alojamiento)>0){
                $sc[]=array("sup_id"=>$suplementos_alojamiento[0]->sup_id,"precio"=>$suplementos_alojamiento[0]->precio_unidad);
            }else{
                $sc[]=array("sup_id"=>0,"precio"=>0);
            }
            if(count($suplementos_alojamiento)>1){
                $sc[]=array("sup_id"=>$suplementos_alojamiento[1]->sup_id,"precio"=>$suplementos_alojamiento[1]->precio_unidad);
            }else{
                $sc[]=array("sup_id"=>0,"precio"=>0);
            }
            if(count($suplementos_alojamiento)>2){
                $sc[]=array("sup_id"=>$suplementos_alojamiento[2]->sup_id,"precio"=>$suplementos_alojamiento[2]->precio_unidad);
            }else{
                $sc[]=array("sup_id"=>0,"precio"=>0);
            }
            
            $data=[
                'cursos'=>$cursos,
                'suplementos_cursos'=>$Suplementos_cursos_list,
                'suplementos_alojamientos'=>$Suplementos_alojamientos_list,
                'alojamientos'=>$alojamientos,
                "isClear"=>false,
                'cur'=> $operacion->cur_id,
                'fechaInit'=> $operacion->cur_fecha_inicio,
                'fechaEnd'=>$operacion->cur_fecha_fin,
                'price'=>$operacion->cur_precio,
                'price2'=>$operacion->alj_precio,
                'fechaInit'=> $operacion->cur_fecha_inicio,
                'fechaEnd'=>$operacion->cur_fecha_fin,
                'fechaInit2'=>$operacion->alj_fecha_inicio,
                'fechaEnd2'=>$operacion->alj_fecha_fin,
                'precios1'=>$sc[0]['precio'],
                'precios2'=>$sc[1]['precio'],
                'precios3'=>$sc[2]['precio'],
                'precios4'=>$sc[3]['precio'],
                'precios5'=>$sc[4]['precio'],
                 'precios6'=>$sc[5]['precio'],
                'desc'=>$operacion->opr_descuento,
                'apagar'=>$operacion->opr_apagar,
                'scursos'=>$sc[0]['sup_id'],
                'scursos2'=>$sc[1]['sup_id'],
                'scursos3'=>$sc[2]['sup_id'],
                'salojamientos'=>$sc[3]['sup_id'],
                'salojamientos2'=>$sc[4]['sup_id'],
                'salojamientos3'=>$sc[5]['sup_id'],
                'alojamiento'=>$operacion->alj_id,
                'numSemanas'=>$operacion->cur_semanas,
                'pagado'=>$operacion->opr_ttl_coste,
                'fechaPagado'=>$operacion->cur_fecha_pagprov,
                'opr_comentarios'=>$operacion->opr_comentarios,
                'opr_comentarios_esc'=>$operacion->opr_comentarios_esc,
                'opr_cmntsalu'=>$operacion->opr_cmntsalu,
                'opr_cmntsalj'=>$operacion->opr_cmntsalj,
                'id'=>$id
                
            ];
            return view("operaciones.curso",$data);
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to('./operacion');
        }
    }
    public function vuelo($id){
        try {
            $_SESSION['opr_id']=$id;
            $_SESSION["idOperacion"]=$id;
            $_SESSION["operacion"]="2";

            $operacion=Operacione::where("opr_id","=",$id)->first();
            $_SESSION["opr_tfr_state"]=$operacion->opr_tfr_state;
           
            $viaje = Viaje::where('opr_id','=',$id)->first();
            if(empty($viaje)){

                return redirect()->to('./operacion');
            }
            $data = $this->step3Edit("",$id);
            $data['id']=$id;
            return view("operaciones.vuelo",$data);
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to('./operacion');
        }

        
    }
    public function transfer($id){
        try {
            $_SESSION['opr_id']=$id;
            $_SESSION["idOperacion"]=$id;
            $operacion=Operacione::where("opr_id","=",$id)->first();
            $_SESSION["opr_tfr_state"]=$operacion->opr_tfr_state;
            $_SESSION["operacion"]="3";
            $viaje = Viaje::where('opr_id','=',$id)->first();
            if(empty($viaje)){

                return redirect()->to('./operacion');
            }
            $data = $this->step3Edit("",$id);
            $data['id']=$id;
            return view("operaciones.transfer",$data);
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to('./operacion');
        }
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
        $input = $request->all();
        $step1=$_SESSION['step1'];
        $step2=$_SESSION['step2'];
        
        
        /*Cursos suplementarios */

        $suplementos=[];
        $opr_pendiente=0;
        $opr_ttl_coste_h=0;
        if(!empty($step2['precios1'])){
            if(!empty($step2['scursos'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['scursos'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios1'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>0
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios1'];
                
                $suplementos[]=$suplemento;
            }
        }
        if(!empty($step2['precios2'])){
            if(!empty($step2['scursos2'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['scursos2'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios2'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>0
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios2'];
                $suplementos[]=$suplemento;
            }
        }
        if(!empty($step2['precios3'])){
            if(!empty($step2['scursos3'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['scursos3'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios3'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>0
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios3'];
                $suplementos[]=$suplemento;
            }
        }
        /* Alojamientos suplementarios */
        if(!empty($step2['precios4'])){
            if(!empty($step2['salojamientos'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['salojamientos'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios4'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>1
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios4'];
                $suplementos[]=$suplemento;
            }
        }
        if(!empty($step2['precios5'])){
            if(!empty($step2['salojamientos2'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['salojamientos2'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios5'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>1
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios5'];
                $suplementos[]=$suplemento;
            }
        }
        if(!empty($step2['precios6'])){
            if(!empty($step2['salojamientos3'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['salojamientos3'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios6'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>1
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios6'];
                $suplementos[]=$suplemento;
            }
        }
        $opr_pendiente= $opr_pendiente+$step2['price'];
        if(!empty($step2['price2'])){
            $opr_pendiente= $opr_pendiente+$step2['price2'];
        }
        $opr_ttl_coste_h=$opr_pendiente;
        if(!empty($input['price'])){
            $opr_pendiente= $opr_pendiente+$input['price'];
        }else{
            $input['price']=0;
        }
       
        if(!empty($input['pricet'])){
            $opr_pendiente= $opr_pendiente+$input['pricet'];
        }
        if(empty($step2['pagado'])){
            $step2['pagado']=0;
        }
        if(empty($step2['apagar'])){
            $step2['apagar']=0;
        }
        if(empty($input['tipot'])){
            $input['tipot']=0;
        }
        if(empty($input['costo'])){
            $input['costo']=0;
        }
        if(empty($input['costot'])){
            $input['costot']=0;
        }
        if($step2['alojamientos']=="-1"){
            $step2['alojamientos']=null;
        }
        if(empty($input['price'])){
            $input['price']=0;
        }
        if(empty($input['pricet'])){
            $input['pricet']=0;
        }
      
        $opr_ttl_coste_h=$opr_ttl_coste_h+$input['price']+$input['pricet']-$input['costo']-$input['costot'];
        $opr_pendiente= $opr_pendiente-$step2['desc']-  $step2['pagado']-$input['costo']-$input['costot'];
        $operacion= new Operacione([
            'alu_id'=>$step1['alumno'],
            'esc_id'=>$step1['escuela'],
            'vje_id'=>1,
            'cur_id'=>$step2['cursos'],
            'cur_precio'=>$step2['price'],
            'cur_coste'=>0,
            'cur_fecha_inicio'=>$step2['fechaInit'],
            'cur_fecha_fin'=>$step2['fechaEnd'],
            'cur_semanas'=>$step2['numSemanas'],
            'alj_id'=>$step2['alojamientos'],
            'alj_fecha_inicio'=>$step2['fechaInit2'],
            'alj_fecha_fin'=>$step2['fechaEnd2'],
            'alj_precio'=>$step2['price2'],
            'alj_coste'=>0,
            'opr_fecha'=>$step1['fecha'],
            'opr_cur_state'=>0,
            'opr_vje_state'=>0,
            'opr_tfr_state'=>0,
            'opr_descr_state'=>0,
            'opr_confirm_state'=>0,
            'opr_entrega_state'=>0,
            'opr_pago_previo'=>0,
            'opr_pendiente'=>$opr_pendiente,
            'opr_seguro'=>0,
            'opr_comentarios'=>$input['comentarios_internos'],
            'opr_comentarios_esc'=>$input['comentarios_esc'],
            'opr_cmntsalu'=>$input['informacion_curso'],
            'opr_cmntsalj'=>$input['informacion_alojamiento'],
            'opr_state'=>0,
            'opr_descuento'=>$step2['desc'],
            'opr_ttl_coste'=>$step2['pagado'],
            'opr_empresa'=>"0",
            'opr_agencia'=>"0",
            'opr_modificada'=>"0",
            'opr_ttl_coste_h'=>$opr_ttl_coste_h,
            'opr_modificada_tfr'=>"0",
            'opr_cancelada'=>0,
            'opr_alutoint'=>"0",
            'opr_year'=>date('Y'),
            'opr_apagar'=>$step2['apagar'],
            'cur_fecha_pagprov'=>$step2['fechaPagado']
        ]);
       
        $curso = Curso::where('cur_id','=',$step2['cursos'])->first();
        $estudiante = Alumno::where('alu_id','=',$step1['alumno'])->where("alumnos.active",'=','1')->first();
        $escuela = Escuela::where('esc_id','=',$step1['escuela'])->first();
        
        $operacion->save();
        $nueva_operacion=Operacione::where('alu_id','=',$operacion->alu_id)
                                    ->where('esc_id','=',$operacion->esc_id)
                                    ->where('cur_id','=',$operacion->cur_id)
                                    ->where('opr_fecha','=',$operacion->opr_fecha)
                                    ->where('opr_pendiente','=',$operacion->opr_pendiente)->first();
       if($step1['vuelo']==1){
        
            $viaje=new Viaje([
                'vje_vuelo'=>$input['vuelo'],
                'vje_transfer'=>$input['Transfer'],
                'vje_descr'=>"Datos viaje:".$curso->cur_descr." en ".$escuela->esc_nombre_corto."  para ".$estudiante->alu_nombre." ".$estudiante->alu_apellidos,
                'vje_ida_linea'=>$input['linea'],
                'vje_ida_salida'=>$input['fsalidav'],
                'vje_ida_hsalida'=>$input['hsalidav'],
                'vje_ida_llegada'=>$input['fllegadav'],
                'vje_ida_hllegada'=>$input['hllegadav'],
                'vje_ida_aeropuerto'=>$input['estacionv'],
                'vje_ida_aeropuerto1'=>$input['estacionv'],
                'vje_ida_num_vuelo'=>$input['numerov3'],
                'vje_ida_num_vuelo1'=>$input['numerov3'],
                'vje_vta_linea'=>$input['linea2'],
                'vje_vta_salida'=>$input['fsalidav2'],
                'vje_vta_hsalida'=>$input['hsalidav2'],
                'vje_vta_llegada'=>$input['fllegadav2'],
                'vje_vta_hllegada'=>$input['hllegadav2'],
                'vje_vta_aeropuerto'=>$input['estacionv2'],
                'vje_vta_aeropuerto1'=>$input['estacionv2'],
                'vje_vta_num_vuelo'=>$input['numerov2'],
                'vje_vta_num_vuelo1'=>$input['numerov2'],
                'vje_vuelo_precio'=>$input['price'],
                'vje_transfer_precio'=>$input['pricet'],
                'axp_id'=>"3",
                'vje_info_salida'=>$input['informacionId'],
                'vje_info_llegada'=>$input['informacionVuelta'],
                'vje_vuelo_tipo'=>$input['tipo'],
                'vje_vuelo_coste'=>$input['costo'],
                'vje_transfer_tipo'=>$input['tipot'],
                'vje_transfer_coste'=>$input['costot'],
                'opr_id'=>0,
                'vje_ida_localizador'=>$input['locv'],
                'vje_vta_localizador'=>$input['locv2']
            ]);
        $viaje->opr_id = $nueva_operacion->opr_id;
        $viaje->save();
        }
                                    
        foreach ($suplementos as $key => $s) {
            $s->opr_id = $nueva_operacion->opr_id;
            if($s->sup_id!="-1"){
                $s->save();
            }
           
        }
        $data = [
            'res'=>true,
            'opr_id'=>$nueva_operacion->opr_id
        ];
        echo (json_encode($data));
        return ;
        
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
    public function edits(Request $request,$id){
       $d =$this->edit($request,$id);
       $_SESSION['idOperacion']=$id;
       $_SESSION['operacion']=5;
       return view('operaciones/edit.create',$d);
    }
    public function edit(Request $request,$id=null)
    {
        //
        $dataInput =$request->all();
        $opr_id="";
        if(is_null($id)){
            if(empty($dataInput['action']) && empty($dataInput['step'])){
                $opr_id = $_SESSION['opr_id'];
                $data=$this->step2Edit($dataInput, $opr_id);
                return view('operaciones/edit.step2',$data);
            }
           
        }else{
            $_SESSION['opr_id'] = $id;
            $opr_id =  $id;
        }
       
        if(empty($dataInput['step']) && empty($dataInput['page'])){
           $data = $this->step1Edit($dataInput,$opr_id); 
          
           return $data;
        }else{
            if(!empty($dataInput['action'])){
                $page = $dataInput['page'];
                if($page=="1"){
                   
                    $alumnos =Alumno::select('alumnos.*')->where("alumnos.active",'=','1')->get();
                    $escuelas=Escuela::select('escuelas.*')->get();
                    $data=[
                        'alumnos'=>$alumnos,
                        'escuelas'=>$escuelas,
                        'alumno'=>$_SESSION['step1']['alumno'],
                        'fecha'=>$_SESSION['step1']['fecha'],
                        'escuela'=>$_SESSION['step1']['escuela'],
                        'vuelo'=>1,
                        "isClear"=>false
                    ];
                    $_SESSION['step2']="";
                    return view('operaciones/edit.create',$data);
                }else if($page=="2"){
                    $dataInput['escuelas'] =$_SESSION['step1']['escuela'];
                    $operacion = Operacione::where('opr_id','=',$opr_id)->first();
                    $data=$this->step2Edit($dataInput,$opr_id);
                    if($_SESSION['step1']['vuelo']==1){
                        $data['isFinaly']=1;
                    }else{
                        $data['isFinaly']=2;
                    }
                   
                    return view('operaciones/edit.step2',$data);
                }
            }
            switch($dataInput['step']){
                case '1':
                    $_SESSION['step2']="";
                    $step1= [
                        'fecha'=>$dataInput['fecha'],
                        'alumno'=>$dataInput['alumnos'],
                        'escuela'=>$dataInput['escuelas'],
                        'vuelo'=>1
                    ];
                   
                    $_SESSION['step1']=$step1;
                    $opr_id = $_SESSION['opr_id'];
                    $operacion = Operacione::where('opr_id','=',$opr_id)->first();
                    $data=$this->step2Edit($dataInput,$opr_id);
                    if($_SESSION['step1']['vuelo']==1){
                        $data['isFinaly']=1;
                    }else{
                        $data['isFinaly']=2;
                    }
                    return view('operaciones/edit.step2',$data);
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

                   
                    $_SESSION['step2']=$step2;

                    $opr_id = $_SESSION['opr_id'];
                    $viaje = Viaje::where('opr_id','=',$opr_id)->first();

                    if(!empty($viaje)){
                        $data=$this->step3Edit($dataInput,$opr_id);
                       
                        return view('operaciones/edit.step3',$data);
                        break;
                    }else{
                        
                        echo "No deberia estar aca";
                    }
                    
            }
        }
    }

    public function cursoSave(Request $request)
    {
       
        $data = [
            'res'=>true,
            'opr_id'=>0
        ];
        echo (json_encode($data));
        return ;
    }
    public function cursoUpdate(Request $request)
    {
        $input = $request->all();
       
        $step2=$input;
        
        
        /*Cursos suplementarios */

        $suplementos=[];
        $opr_pendiente=0;
        $opr_ttl_coste_h=0;
        if(!empty($step2['precios1'])){
            if(!empty($step2['scursos'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['scursos'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios1'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>0
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios1'];
                
                $suplementos[]=$suplemento;
            }
        }
        if(!empty($step2['precios2'])){
            if(!empty($step2['scursos2'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['scursos2'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios2'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>0
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios2'];
                $suplementos[]=$suplemento;
            }
        }
        if(!empty($step2['precios3'])){
            if(!empty($step2['scursos3'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['scursos3'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios3'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>0
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios3'];
                $suplementos[]=$suplemento;
            }
        }
        /* Alojamientos suplementarios */
        if(!empty($step2['precios4'])){
            if(!empty($step2['salojamientos'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['salojamientos'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios4'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>1
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios4'];
                $suplementos[]=$suplemento;
            }
        }
        if(!empty($step2['precios5'])){
            if(!empty($step2['salojamientos2'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['salojamientos2'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios5'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>1
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios5'];
                $suplementos[]=$suplemento;
            }
        }
        if(!empty($step2['precios6'])){
            if(!empty($step2['salojamientos3'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['salojamientos3'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios6'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>1
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios6'];
                $suplementos[]=$suplemento;
            }
        }
        $opr_pendiente= $opr_pendiente+$step2['price'];
        if(!empty($step2['price2'])){
            $opr_pendiente= $opr_pendiente+$step2['price2'];
        }
        $opr_ttl_coste_h=$opr_pendiente;
        if(!empty($input['price'])){
            $opr_pendiente= $opr_pendiente+$input['price'];
        }
        if(!empty($input['pricet'])){
            $opr_pendiente= $opr_pendiente+$input['pricet'];
        }
        if(empty($step2['pagado'])){
            $step2['pagado']=0;
        }
        if(empty($step2['apagar'])){
            $step2['apagar']=0;
        }
        if(empty($input['tipot'])){
            $input['tipot']=0;
        }
        if(empty($input['costo'])){
            $input['costo']=0;
        }
        if($step2['alojamientos']=="-1"){
            $step2['alojamientos']=null;
        }
        if(empty($input['price'])){
            $input['price']=0;
        }
        if(empty($input['pricet'])){
            $input['pricet']=0;
        }

        $viaje= Viaje::where("opr_id","=",$_SESSION['opr_id'])->first();
        $opr_ttl_coste_h=$opr_ttl_coste_h+$viaje->vje_vuelo_precio+$viaje->vje_transfer_precio-$viaje->vje_vuelo_coste-$viaje->vje_transfer_coste;
        $opr_pendiente= $opr_pendiente-$step2['desc']-  $step2['pagado']-$viaje->vje_vuelo_coste-$viaje->vje_transfer_coste;
      
        $operacion= Operacione::where('opr_id','=',$_SESSION['opr_id'])->first();
        

        $operacion->cur_id = $step2['cursos'];
        $operacion->cur_precio = $step2['price'];
        $operacion->cur_fecha_inicio = $step2['fechaInit'];
        $operacion->cur_fecha_fin = $step2['fechaEnd'];

        $operacion->cur_semanas = $step2['numSemanas'];
        $operacion->alj_id = $step2['alojamientos'];
        $operacion->alj_fecha_inicio = $step2['fechaInit2'];
        $operacion->alj_fecha_fin = $step2['fechaEnd2'];
        $operacion->alj_precio = $step2['price2'];
      
      $operacion->opr_pendiente = $opr_pendiente;
      $operacion->opr_comentarios = $input['comentarios_internos'];
      $operacion->opr_comentarios_esc = $input['comentarios_esc'];
      $operacion->opr_cmntsalu = $input['informacion_curso'];
      $operacion->opr_cmntsalj = $input['informacion_alojamiento'];
      $operacion->opr_descuento = $step2['desc'];
      $operacion->opr_ttl_coste = $step2['pagado'];
      $operacion->opr_modificada = 1;
      $operacion->opr_ttl_coste_h = $opr_ttl_coste_h;

      $operacion->opr_apagar = $step2['apagar'];
      $operacion->cur_fecha_pagprov = $step2['fechaPagado'];
      
       
       
       
        
        try {
            $operacion->save();
            $nueva_operacion=Operacione::where('opr_id','=',$_SESSION['opr_id'])->first();
            
            $suplementosViejos = SuplementosOperacione::where('opr_id','=',$_SESSION['opr_id'])->get();
            foreach ($suplementosViejos as $key => $s) {
                $s->delete();
            }                          
            foreach ($suplementos as $key => $s) {
                $s->opr_id = $nueva_operacion->opr_id;
                if($s->sup_id!="-1"){
                    $s->save();
                }
                
            }
            $data = [
                'res'=>true,
                'opr_id'=>$nueva_operacion->opr_id
            ];
            echo (json_encode($data));
        } catch (\Illuminate\Database\QueryException $th) {
            echo (json_encode(false));
        }
        return ;
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
        $input = $request->all();
        $step1=$_SESSION['step1'];
        $step2=$_SESSION['step2'];
        
        
        /*Cursos suplementarios */

        $suplementos=[];
        $opr_pendiente=0;
        $opr_ttl_coste_h=0;
        if(!empty($step2['precios1'])){
            if(!empty($step2['scursos'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['scursos'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios1'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>0
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios1'];
                
                $suplementos[]=$suplemento;
            }
        }
        if(!empty($step2['precios2'])){
            if(!empty($step2['scursos2'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['scursos2'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios2'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>0
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios2'];
                $suplementos[]=$suplemento;
            }
        }
        if(!empty($step2['precios3'])){
            if(!empty($step2['scursos3'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['scursos3'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios3'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>0
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios3'];
                $suplementos[]=$suplemento;
            }
        }
        /* Alojamientos suplementarios */
        if(!empty($step2['precios4'])){
            if(!empty($step2['salojamientos'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['salojamientos'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios4'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>1
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios4'];
                $suplementos[]=$suplemento;
            }
        }
        if(!empty($step2['precios5'])){
            if(!empty($step2['salojamientos2'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['salojamientos2'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios5'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>1
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios5'];
                $suplementos[]=$suplemento;
            }
        }
        if(!empty($step2['precios6'])){
            if(!empty($step2['salojamientos3'])){
                $suplemento = new SuplementosOperacione([
                    'sup_id'=>$step2['salojamientos3'],
                    'opr_id'=>0,
                    'precio_unidad'=>$step2['precios6'],
                    'num_dias'=>0,
                    'num_semanas'=>0,
                    'sup_tipo'=>1
                ]);
                $opr_pendiente=$opr_pendiente+$step2['precios6'];
                $suplementos[]=$suplemento;
            }
        }
        $opr_pendiente= $opr_pendiente+$step2['price'];
        if(!empty($step2['price2'])){
            $opr_pendiente= $opr_pendiente+$step2['price2'];
        }
        $opr_ttl_coste_h=$opr_pendiente;
        if(!empty($input['price'])){
            $opr_pendiente= $opr_pendiente+$input['price'];
        }
        if(!empty($input['pricet'])){
            $opr_pendiente= $opr_pendiente+$input['pricet'];
        }
        if(empty($step2['pagado'])){
            $step2['pagado']=0;
        }
        if(empty($step2['apagar'])){
            $step2['apagar']=0;
        }
        if(empty($input['tipot'])){
            $input['tipot']=0;
        }
        if(empty($input['costo'])){
            $input['costo']=0;
        }
        if($step2['alojamientos']=="-1"){
            $step2['alojamientos']=null;
        }
        if(empty($input['price'])){
            $input['price']=0;
        }
        if(empty($input['pricet'])){
            $input['pricet']=0;
        }
      
        $opr_ttl_coste_h=$opr_ttl_coste_h+$input['price']+$input['pricet']-$input['costo']-$input['costot'];
        $opr_pendiente= $opr_pendiente-$step2['desc']-  $step2['pagado']-$input['costo']-$input['costot'];
     
        $operacion= Operacione::where('opr_id','=',$_SESSION['opr_id'])->first();
        $operacion->alu_id = $step1['alumno'];
        $operacion->esc_id = $step1['escuela'];
        $operacion->vje_id =1;

        $operacion->cur_id = $step2['cursos'];
        $operacion->cur_precio = $step2['price'];
        $operacion->cur_fecha_inicio = $step2['fechaInit'];
        $operacion->cur_fecha_fin = $step2['fechaEnd'];

        $operacion->cur_semanas = $step2['numSemanas'];
        $operacion->alj_id = $step2['alojamientos'];
        $operacion->alj_fecha_inicio = $step2['fechaInit2'];
        $operacion->alj_fecha_fin = $step2['fechaEnd2'];
        $operacion->alj_precio = $step2['price2'];
      
      $operacion->opr_pendiente = $opr_pendiente;
      $operacion->opr_comentarios = $input['comentarios_internos'];
      $operacion->opr_comentarios_esc = $input['comentarios_esc'];
      $operacion->opr_cmntsalu = $input['informacion_curso'];
      $operacion->opr_cmntsalj = $input['informacion_alojamiento'];
      $operacion->opr_descuento = $step2['desc'];
      $operacion->opr_ttl_coste = $step2['pagado'];
      $operacion->opr_modificada = 1;
      $operacion->opr_ttl_coste_h = $opr_ttl_coste_h;

      $operacion->opr_apagar = $step2['apagar'];
      $operacion->cur_fecha_pagprov = $step2['fechaPagado'];
      
       
        $curso = Curso::where('cur_id','=',$step2['cursos'])->first();
        $estudiante = Alumno::where('alu_id','=',$step1['alumno'])->where("alumnos.active",'=','1')->first();
        $escuela = Escuela::where('esc_id','=',$step1['escuela'])->first();
        
        try {
            $operacion->save();
            $nueva_operacion=Operacione::where('opr_id','=',$_SESSION['opr_id'])->first();
            if($step1['vuelo']==1){
                if(empty($input['price'])){
                    $input['price']=0;
                }
                if(empty($input['pricet'])){
                    $input['pricet']=0;
                }
                $viaje= Viaje::where('opr_id','=',$_SESSION['opr_id'])->first();
               if(empty($viaje)){
                  
               }else{
                    $viaje->vje_vuelo = $input['vuelo'];
                    $viaje->vje_transfer = $input['Transfer'];
                    $viaje->vje_descr = "Datos viaje:".$curso->cur_descr." en ".$escuela->esc_nombre_corto."  para ".$estudiante->alu_nombre." ".$estudiante->alu_apellidos;
                    $viaje->vje_ida_salida = $input['fsalidav'];
                    $viaje->vje_ida_hsalida = $input['hsalidav'];
                    $viaje->vje_ida_llegada = $input['fllegadav'];
                    $viaje->vje_ida_hllegada = $input['hllegadav'];
                    $viaje->vje_ida_linea = $input['linea'];
                    $viaje->vje_ida_aeropuerto = $input['estacionv'];
                    $viaje->vje_ida_aeropuerto1 = $input['estacionv'];
                    $viaje->vje_ida_num_vuelo = $input['numerov3'];
                    $viaje->vje_ida_num_vuelo1 = $input['numerov3'];
                    $viaje->vje_vta_linea = $input['linea2'];
                    $viaje->vje_vta_salida = $input['fsalidav2'];
                    $viaje->vje_vta_hsalida = $input['hsalidav2'];
                    $viaje->vje_vta_llegada = $input['fllegadav2'];
                    $viaje->vje_vta_aeropuerto = $input['estacionv2'];
                    $viaje->vje_vta_aeropuerto1 = $input['estacionv2'];
                    $viaje->vje_vta_num_vuelo = $input['numerov2'];
                    $viaje->vje_vta_num_vuelo1 = $input['numerov2'];
                    $viaje->vje_vuelo_precio = $input['price'];
                    $viaje->vje_transfer_precio = $input['pricet'];
                    $viaje->vje_info_salida = $input['informacionId'];
                    $viaje->vje_info_llegada = $input['informacionVuelta'];
                    $viaje->vje_vuelo_tipo = $input['tipo'];
                    $viaje->vje_vuelo_coste = $input['costo'];
                    $viaje->vje_transfer_tipo = $input['tipot'];
                    $viaje->vje_transfer_coste = $input['costot'];
                    $viaje->vje_ida_localizador = $input['locv'];
                    $viaje->vje_vta_localizador = $input['locv2'];
                    $viaje->save();
               }
            }
            $suplementosViejos = SuplementosOperacione::where('opr_id','=',$_SESSION['opr_id'])->get();
            foreach ($suplementosViejos as $key => $s) {
                $s->delete();
            }                          
            foreach ($suplementos as $key => $s) {
                $s->opr_id = $nueva_operacion->opr_id;
                if($s->sup_id!="-1"){
                    $s->save();
                }
                
            }
            $data = [
                'res'=>true,
                'opr_id'=>$nueva_operacion->opr_id
            ];
            echo (json_encode($data));
        } catch (\Illuminate\Database\QueryException $th) {
            echo (json_encode(false));
        }
        return ;
    }

    public function vueloSave(Request $request){
        try {
            $input=$request->all();
            if(empty($input['price'])){
                $input['price']=0;
            }
            if(empty($input['pricet'])){
                $input['pricet']=0;
            }
            
           
            $viaje= Viaje::where('opr_id','=',$_SESSION['opr_id'])->first();
            $viaje->vje_vuelo = $input['vuelo'];
         
            $viaje->vje_ida_salida = $input['fsalidav'];
            $viaje->vje_ida_hsalida = $input['hsalidav'];
            $viaje->vje_ida_llegada = $input['fllegadav'];
            $viaje->vje_ida_hllegada = $input['hllegadav'];
            $viaje->vje_ida_linea = $input['linea'];
            $viaje->vje_ida_aeropuerto = $input['estacionv'];
            $viaje->vje_ida_aeropuerto1 = $input['estacionv'];
            $viaje->vje_ida_num_vuelo = $input['numerov3'];
            $viaje->vje_ida_num_vuelo1 = $input['numerov3'];
            $viaje->vje_vta_linea = $input['linea2'];
            $viaje->vje_vta_salida = $input['fsalidav2'];
            $viaje->vje_vta_hsalida = $input['hsalidav2'];
            $viaje->vje_vta_llegada = $input['fllegadav2'];
            $viaje->vje_vta_aeropuerto = $input['estacionv2'];
            $viaje->vje_vta_aeropuerto1 = $input['estacionv2'];
            $viaje->vje_vta_num_vuelo = $input['numerov2'];
            $viaje->vje_vta_num_vuelo1 = $input['numerov2'];
            $viaje->vje_vuelo_precio = $input['price'];
         
            $viaje->vje_info_salida = $input['informacionId'];
            $viaje->vje_info_llegada = $input['informacionVuelta'];
            $viaje->vje_vuelo_tipo = $input['tipo'];
            $viaje->vje_vuelo_coste = $input['costo'];
         
            $viaje->vje_ida_localizador = $input['locv'];
            $viaje->vje_vta_localizador = $input['locv2'];
            
            $operacion=Operacione::where("opr_id","=",$_SESSION['opr_id'])->first();
           // $viaje= Viaje::where("opr_id","=",$_SESSION['opr_id'])->first();
           $sups=0;
           $suplementos=SuplementosOperacione::where('opr_id','=',$_SESSION['opr_id'])->get(); 
           foreach ($suplementos as $key => $value) {
            $sups= $sups+$value->precio_unidad;
           }
            $opr_ttl_coste_h=$sups+$viaje->vje_vuelo_precio+$viaje->vje_transfer_precio-$viaje->vje_vuelo_coste-$viaje->vje_transfer_coste;
            $opr_pendiente= $sups-$operacion->opr_descuento- $operacion->opr_ttl_coste-$viaje->vje_vuelo_coste-$viaje->vje_transfer_coste;
          
            $operacion->opr_ttl_coste_h = $opr_ttl_coste_h;
            $operacion->opr_pendiente=$opr_pendiente;
            $viaje->save();
            $data = [
                'res'=>true,
                'opr_id'=>$_SESSION['opr_id']
            ];
            echo (json_encode($data));
        } catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode($th);
        }
    }
    public function transferSave(Request $request){
        try {
            $input=$request->all();
            if(empty($input['price'])){
                $input['price']=0;
            }
            if(empty($input['pricet'])){
                $input['pricet']=0;
            }
           
            $viaje= Viaje::where('opr_id','=',$_SESSION['opr_id'])->first();
            
            $viaje->vje_transfer = $input['Transfer'];
            $viaje->vje_ida_salida = $input['fsalidav'];
            $viaje->vje_ida_hsalida = $input['hsalidav'];
            $viaje->vje_ida_llegada = $input['fllegadav'];
            $viaje->vje_ida_hllegada = $input['hllegadav'];
            $viaje->vje_ida_linea = $input['linea'];
            $viaje->vje_ida_aeropuerto = $input['estacionv'];
            $viaje->vje_ida_aeropuerto1 = $input['estacionv'];
            $viaje->vje_ida_num_vuelo = $input['numerov3'];
            $viaje->vje_ida_num_vuelo1 = $input['numerov3'];
            $viaje->vje_vta_linea = $input['linea2'];
            $viaje->vje_vta_salida = $input['fsalidav2'];
            $viaje->vje_vta_hsalida = $input['hsalidav2'];
            $viaje->vje_vta_llegada = $input['fllegadav2'];
            $viaje->vje_vta_aeropuerto = $input['estacionv2'];
            $viaje->vje_vta_aeropuerto1 = $input['estacionv2'];
            $viaje->vje_vta_num_vuelo = $input['numerov2'];
            $viaje->vje_vta_num_vuelo1 = $input['numerov2'];
           
            $viaje->vje_transfer_precio = $input['pricet'];
            $viaje->vje_info_salida = $input['informacionId'];
            $viaje->vje_info_llegada = $input['informacionVuelta'];
            
           
            $viaje->vje_transfer_tipo = $input['tipot'];
            $viaje->vje_transfer_coste = $input['tipot'];
            $viaje->vje_ida_localizador = $input['locv'];
            $viaje->vje_vta_localizador = $input['locv2'];
        
            $viaje->save();
            $data = [
                'res'=>true,
                'opr_id'=>$_SESSION['opr_id']
            ];
            echo (json_encode($data));
        } catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode($th);
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
        $input =   $request->all(); 
        $id =$input['id'];
        $suplementosViejos = SuplementosOperacione::where('opr_id','=',$id)->get(); 
        $viaje =  Viaje::where('opr_id','=',$id)->first();    
        $operacion =  Operacione::where('opr_id','=',$id)->first();  
        try {
            foreach ($suplementosViejos as $key => $s) {
                $s->delete();
            }
           if(!empty($viaje)){
            $viaje->delete();
           }
            
            $operacion->delete();
            echo (json_encode(true));

        } catch (\Illuminate\Database\QueryException $th) {
            echo (json_encode($th));
        } 
    }
}
