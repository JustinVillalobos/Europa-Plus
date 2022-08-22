<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opcione;
use App\Models\Paise;
use App\Models\Provincia;
use App\Models\Localidade;
use App\Models\Escuela;
use App\Models\Curso;
use App\Models\Suplemento;
use App\Models\Alojamiento;
use App\Models\SuplementosEscuela;
use App\Models\CursosEscuela;
use App\Models\AlojamientosEscuela;
session_start();
class EscuelasController extends Controller
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
        $escuelas = Escuela::select('escuelas.*','paises.*','opciones.opc_descr')
                            ->join('opciones','escuelas.idi_id','=','opciones.opc_id')
                            ->join('paises','escuelas.pais_id','=','paises.pais_id')
                            ->paginate(10);
        $data = [
            'escuelas'=>$escuelas,
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre',
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre'
        ];
        $_SESSION['search']="";
        $_SESSION['type']="";
        $_SESSION['limit']="";
        return view('escuelas.index',$data);
    }
    public function busqueda(Request $request){

        $input = $request->all();
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
        $escuelas = Escuela::select('escuelas.*','paises.*','opciones.opc_descr')
                            ->join('opciones','escuelas.idi_id','=','opciones.opc_id')
                            ->join('paises','escuelas.pais_id','=','paises.pais_id');        
        if($input['type']=="Nombre"){
            $escuelas =$escuelas->where("escuelas.esc_nombre","LIKE","%{$input['search']}%");
        } 
        if($input['type']=="Pais"){
            $escuelas =$escuelas->where("paises.pais_descr","LIKE","%{$input['search']}%");
        } 
        if($input['type']=="Idioma"){
            $escuelas =$escuelas->where("opciones.opc_descr","LIKE","%{$input['search']}%");
        } 
         
        $escuelas =$escuelas->paginate($limit);
        $data = [
            'escuelas'=>$escuelas,
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre',
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre'
        ];
        return view('escuelas.index',$data);
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
        $localidades = Localidade::select('localidades.*')
                                    ->where('localidades.prv_id','=',$provincias[0]->prv_id)->get();
        $idiomas = Opcione::all()
                ->whereIn('opc_tipo_id',[3,4]);

                $cursos = Curso::select('cursos.*')->get();
        $SuplementosCurso = Suplemento::select("suplementos.*")->where('sup_tipo','=','0')->get();
        $SuplementosAlojamiento= Suplemento::select("suplementos.*")->where('sup_tipo','=','1')->get();
        $alojamientos = Alojamiento::select('alojamientos.*')->get();
        $data = [
                    'cursos'=>$cursos,
                    'paises'=>$paises,
                    'provincias'=>$provincias,
                    'localidades'=>$localidades,
                    'idiomas'=>$idiomas,
                    'SuplementosCurso'=>$SuplementosCurso,
                    'SuplementosAlojamiento'=>$SuplementosAlojamiento,
                    'alojamientos'=>$alojamientos
                ];
        return view('escuelas.add',$data);
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
        $datos = $input['escuela'];
        $escuela_search = Escuela::where('esc_nombre','=',$datos['nombre'])->first();
    
        if(!empty($escuela_search)){
            echo json_encode('Ya existe una escuela registrada con ese nombre');
            return;
        }
       
        $escuela = new Escuela(
            [
                'esc_nombre'=>$datos['nombre_completo'],
                'esc_nombre_corto'=>$datos['nombre'],
                'esc_direccion'=>$datos['plaza'],
                'esc_email'=>$datos['correo'],
                'esc_telefono'=>$datos['tel'],
                'esc_cp'=>$datos['cPostal'],
                'idi_id'=>$datos['idiomas'],
                "loc_id"=>$datos['localidades'],
                'prv_id'=>$datos['provincias'],
                'pais_id'=>$datos['paises'],
                'esc_www'=>$datos['pagina'],
                'esc_usuario'=>$datos['user'],
                'esc_password'=>$datos['psw'],
                'esc_condiciones'=>$datos['comentarios'],
                'esc_contacto_1'=>$datos['nombre_contacto'],
                'esc_cnt_mail_1'=>$datos['email_contacto'],
                'esc_cnt_func_1'=>$datos['funcion'],
                'esc_cnt_tel_1'=>$datos['tel_contacto'],
                'esc_contacto_2'=>$datos['nombre_contactot'],
                'esc_cnt_mail_2'=>$datos['email_contactot'],
                'esc_cnt_func_2'=>$datos['funciont'],
                'esc_cnt_tel_2'=>$datos['tel_contactot']
            ]
        );
        try{
            $escuela->save();
            $new_escula = Escuela::where('esc_nombre','=',$datos['nombre'])->first();
            /**                         Cursos                               **/
            $cursos = $datos['cursos'];
            for($i=0;$i<count($cursos);$i++){
                $curso =new CursosEscuela ([
                    'cur_id'=>$cursos[$i],
                    'esc_id'=>$new_escula->esc_id
                ]);
                $curso->save();
            }
            /**                         suplementos cursos                               **/
            $supcur = $datos['supcur'];
            for($i=0;$i<count($supcur);$i++){
                $sup =new SuplementosEscuela ([
                    'sup_id'=>$supcur[$i],
                    'esc_id'=>$new_escula->esc_id
                ]);
                $sup->save();
            }
            /**                         Alojamientos                               **/
            $alj = $datos['alj'];
            for($i=0;$i<count($alj);$i++){
                $a =new AlojamientosEscuela ([
                    'alj_id'=>$alj[$i],
                    'esc_id'=>$new_escula->esc_id
                ]);
                $a->save();
            }
            /**                         Suplementos alojamientos                               **/
            $supalj = $datos['supalj'];
            for($i=0;$i<count($supalj);$i++){
                $sup =new SuplementosEscuela ([
                    'sup_id'=>$supalj[$i],
                    'esc_id'=>$new_escula->esc_id
                ]);
                $sup->save();
            }
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
           // echo json_encode($e);
            echo json_encode('Ocurrio un problema en el servidor');
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
        $escuela = Escuela::where('esc_id','=',$id)->first();
        $paises = Paise::all();
        
        $provincias = Provincia::where('provincias.pais_id','=',$escuela->pais_id)->get();
        $localidades = Localidade::select('localidades.*')
                                    ->where('localidades.prv_id','=',$provincias[0]->prv_id)->get();
        $idiomas = Opcione::all()
                ->whereIn('opc_tipo_id',[3,4]);

                $cursos = Curso::select('cursos.*')->get();
        $SuplementosCurso = Suplemento::select("suplementos.*")->where('sup_tipo','=','0')->get();
        $SuplementosAlojamiento= Suplemento::select("suplementos.*")->where('sup_tipo','=','1')->get();
        $alojamientos = Alojamiento::select('alojamientos.*')->get();

       
        $cursos_escuela =Curso::select('cursos.cur_id')
                                    ->join('cursos_escuelas','cursos_escuelas.cur_id','=','cursos.cur_id')
                                    ->join('escuelas','escuelas.esc_id','=','cursos_escuelas.esc_id')
                                    ->where('escuelas.esc_id','=',$id)
                                    ->get();
        $supl_escuela =Suplemento::select('suplementos.sup_id')
                                    ->join('suplementos_escuelas','suplementos_escuelas.sup_id','=','suplementos.sup_id')
                                    ->join('escuelas','escuelas.esc_id','=','suplementos_escuelas.esc_id')
                                    ->where('escuelas.esc_id','=',$id)
                                    ->get();
        $alojamientos_escuela = Alojamiento::select('alojamientos.alj_id')
                                                ->join('alojamientos_escuelas','alojamientos_escuelas.alj_id','=','alojamientos.alj_id')
                                                ->join('escuelas','escuelas.esc_id','=','alojamientos_escuelas.esc_id')
                                                ->where('escuelas.esc_id','=',$id)
                                                ->get();
        $ce =[];
        for($i=0;$i<count($cursos_escuela);$i++){
            $ce[] =$cursos_escuela[$i]->cur_id;
        }
        $cursos_escuela = $ce;
        $ce =[];
        for($i=0;$i<count($supl_escuela);$i++){
            $ce[] =$supl_escuela[$i]->sup_id;
        }
        $supl_escuela=$ce;
        $ce =[];
        for($i=0;$i<count($alojamientos_escuela);$i++){
            $ce[] =$alojamientos_escuela[$i]->alj_id;
        }
        $alojamientos_escuela=$ce;
        $data = [
                    'cursos'=>$cursos,
                    'paises'=>$paises,
                    'provincias'=>$provincias,
                    'localidades'=>$localidades,
                    'idiomas'=>$idiomas,
                    'SuplementosCurso'=>$SuplementosCurso,
                    'SuplementosAlojamiento'=>$SuplementosAlojamiento,
                    'alojamientos'=>$alojamientos,
                    'escuela'=>$escuela,
                    'supl_escuela'=>$supl_escuela,
                    'alojamientos_escuela'=>$alojamientos_escuela,
                    'cursos_escuela'=>$cursos_escuela
                ];
        return view('escuelas.edit',$data);

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
        $input = $request->all();
        $datos = $input['escuela'];
        $id = $datos['esc_id'];
        $escuela_search = Escuela::where('esc_nombre','=',$datos['nombre'])->first();
    
        if(!empty($escuela_search)){
            if($escuela_search->esc_id !=$datos['esc_id']){
                echo json_encode('Ya existe una escuela registrada con ese nombre');
                return;
            }
            
        }
       $escuela =Escuela::where('esc_id','=',$datos['esc_id'])->first();
        $escuela->esc_nombre=$datos['nombre_completo'];
        $escuela->esc_nombre_corto=$datos['nombre'];
        $escuela->esc_direccion=$datos['plaza'];
        $escuela->esc_email=$datos['correo'];
        $escuela->esc_telefono=$datos['tel'];
        $escuela->esc_cp=$datos['cPostal'];
        $escuela->idi_id=$datos['idiomas'];
        $escuela->loc_id=$datos['localidades'];
        $escuela->prv_id=$datos['provincias'];
        $escuela->pais_id=$datos['paises'];
        $escuela->esc_www=$datos['pagina'];
        $escuela->esc_usuario=$datos['user'];
        $escuela->esc_password=$datos['psw'];
        $escuela->esc_condiciones=$datos['comentarios'];
        $escuela->esc_contacto_1=$datos['nombre_contacto'];
        $escuela->esc_cnt_mail_1=$datos['email_contacto'];
        $escuela->esc_cnt_func_1=$datos['funcion'];
        $escuela->esc_cnt_tel_1=$datos['tel_contacto'];
        $escuela->esc_contacto_2=$datos['nombre_contactot'];
        $escuela->esc_cnt_mail_2=$datos['email_contactot'];
        $escuela->esc_cnt_func_2=$datos['funciont'];
        $escuela->esc_cnt_tel_2=$datos['tel_contactot'];

        try{
           
            $escuela->save();
            $cursos_escuela =CursosEscuela::select('cursos_escuelas.*')
                                    ->join('cursos','cursos_escuelas.cur_id','=','cursos.cur_id')
                                    ->join('escuelas','escuelas.esc_id','=','cursos_escuelas.esc_id')
                                    ->where('escuelas.esc_id','=',$id)
                                    ;
           $supl_escuela =SuplementosEscuela::select('suplementos_escuelas.*')
                                        ->join('suplementos','suplementos_escuelas.sup_id','=','suplementos.sup_id')
                                        ->join('escuelas','escuelas.esc_id','=','suplementos_escuelas.esc_id')
                                        ->where('escuelas.esc_id','=',$id)
                                        ;
            $alojamientos_escuela = AlojamientosEscuela::select('alojamientos_escuelas.*')
                                                ->join('alojamientos','alojamientos_escuelas.alj_id','=','alojamientos.alj_id')
                                                ->join('escuelas','escuelas.esc_id','=','alojamientos_escuelas.esc_id')
                                                ->where('escuelas.esc_id','=',$id)
                                                ;
            $cursos_escuela->delete();
            $supl_escuela->delete();
            $alojamientos_escuela->delete();
            $new_escula = Escuela::where('esc_id','=',$datos['esc_id'])->first();
            /**                         Cursos                               **/
            $cursos = $datos['cursos'];
            for($i=0;$i<count($cursos);$i++){
                $curso =new CursosEscuela ([
                    'cur_id'=>$cursos[$i],
                    'esc_id'=>$new_escula->esc_id
                ]);
                $curso->save();
            }
            /**                         suplementos cursos                               **/
            $supcur = $datos['supcur'];
            for($i=0;$i<count($supcur);$i++){
                $sup =new SuplementosEscuela ([
                    'sup_id'=>$supcur[$i],
                    'esc_id'=>$new_escula->esc_id
                ]);
                $sup->save();
            }
            /**                         Alojamientos                               **/
            $alj = $datos['alj'];
            for($i=0;$i<count($alj);$i++){
                $a =new AlojamientosEscuela ([
                    'alj_id'=>$alj[$i],
                    'esc_id'=>$new_escula->esc_id
                ]);
                $a->save();
            }
            /**                         Suplementos alojamientos                               **/
            $supalj = $datos['supalj'];
            for($i=0;$i<count($supalj);$i++){
                $sup =new SuplementosEscuela ([
                    'sup_id'=>$supalj[$i],
                    'esc_id'=>$new_escula->esc_id
                ]);
                $sup->save();
            }
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode($e);
           // echo json_encode('Ocurrio un problema en el servidor');
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
        $esc = Escuela::where('esc_id','=',$id)->first();
       
        try{
            $esc->delete();
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            echo json_encode(false);
        }
    }
}
