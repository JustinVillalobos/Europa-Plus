<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Provincia;
use App\Models\Paise;
use App\Models\Localidade;
use App\Models\Opcione;
use App\Models\Escuela;
use App\Models\User;
use Mail;

use App\Mail\Mensaje;
session_start();
class AlumnoController extends Controller
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
        $alumnos =Alumno::select('alumnos.*','opciones.*','paises.pais_descr','paises.pais_descr as esc_nombre')
                            ->join('opciones','alumnos.idi_id','=','opciones.opc_id')
                            ->join('provincias','alumnos.prv_id','=','provincias.prv_id')
                            ->join('paises','provincias.pais_id','=','paises.pais_id')
                            ->paginate(10);
                            foreach ($alumnos as $key => $value) {
                                $escuela= Escuela::join('cursos_escuelas','escuelas.esc_id','cursos_escuelas.esc_id')
                                                    ->join('cursos','cursos_escuelas.cur_id','cursos.cur_id')
                                                    ->where('cursos.cur_id','=', $alumnos[$key]->cur_id)->first();
                    
                                if(!empty($escuela)){
                                    $alumnos[$key]->esc_nombre=$escuela->esc_nombre;
                                }else{
                                    $alumnos[$key]->esc_nombre="".$alumnos[$key]->cur_id;
                                }
                              
                            }
        
        return view('alumnos.index', ["alumnos"=>$alumnos,'search'=>"",'limit'=>10,'type'=>'Nombre']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formulario()
    {
        //
        $paises = Paise::all();
        
        $provincias = Provincia::where('provincias.pais_id','=',$paises[1]->pais_id)->get();
        $localidades = Localidade::select('localidades.*')
                                    ->where('localidades.prv_id','=',$provincias[0]->prv_id)->get();
        $idiomas = Opcione::all()
                            ->whereIn('opc_tipo_id',[3,4]);
        $medios = Opcione::all()
                            ->whereIn('opc_tipo_id',[2]);
        $data = [
            'paises'=>$paises,
            'provincias'=>$provincias,
            'localidades'=>$localidades,
            'idiomas'=>$idiomas,
            'medios'=>$medios
        ];
        return view('alumnos.formulario',$data);
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
            $_SESSION['search'] =  $input['search'];
           
            $_SESSION['type'] = $input['type'];
        }
        if(is_null($input['limit'])){
            $input['limit'] = $_SESSION['limit'];
           
        }else{
            $_SESSION['limit'] = $input['limit'];
        }
        $limit = $input['limit'];
        $alumnos =Alumno::select('alumnos.*','opciones.*','paises.pais_descr')
                            ->join('opciones','alumnos.idi_id','=','opciones.opc_id')
                            ->join('provincias','alumnos.prv_id','=','provincias.prv_id')
                            ->join('paises','provincias.pais_id','=','paises.pais_id');
                  
        if($input['type']=="Nombre"){
            $alumnos =$alumnos->where("alumnos.alu_nombre","LIKE","%{$input['search']}%");
        } else if ($input['type']=="Apellidos"){
            $alumnos = $alumnos->where("alumnos.alu_apellidos","LIKE","%{$input['search']}%");
        }else if($input['type']=="Idioma"){
            $alumnos =$alumnos->where("opciones.opc_descr","LIKE","%{$input['search']}%");
        }else if($input['type']=="Pais"){
            $alumnos =$alumnos->where("paises.pais_descr","LIKE","%{$input['search']}%");
        }
         
        $alumnos =$alumnos->paginate($limit);
        return view('alumnos.index', ["alumnos"=>$alumnos,'search'=>$input['search'],'limit'=>$limit,'type'=>$input['type']]);
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
        $medios = Opcione::all()
                            ->whereIn('opc_tipo_id',[2]);
        $data = [
            'paises'=>$paises,
            'provincias'=>$provincias,
            'localidades'=>$localidades,
            'idiomas'=>$idiomas,
            'medios'=>$medios
        ];
        return view('alumnos.create',$data);
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
        $datos =$input['alumno'];
        $alumno = new Alumno([
            'idi_id'=> $datos['idiomas'],
            'alu_nombre'=>$datos['nombre'],
            'alu_apellidos'=>$datos['apellidos'],
            'alu_email'=>$datos['correo'],
            'alu_dni'=>$datos['pasaporte'],
            'alu_direccion'=>$datos['plaza'],
            'alu_cp'=>$datos['codigoPostal'],
            'alu_fecha_nacim'=>$datos['fecha_nacim'],
            'alu_edad'=>$datos['edad'],
            'alu_sexo'=>$datos['sexo'],
            'alu_telefono'=>$datos['tel'],
            'alu_nivel_idioma'=>$datos['nivel_idioma'],
            'alu_alergias'=>$datos['alergias'],
            'alu_nombre_padre'=>$datos['nombrePadre'],
            'alu_tel_padre'=>$datos['telPadre'],
            'alu_medio_contacto'=>$datos['medioContacto'],
            'loc_id'=>$datos['localidades'],
            'prv_id'=>$datos['provincias'],
            'pais_id'=>$datos['paises'],
            'alu_dni_fexp'=>$datos['caduca'],
            'alu_comentarios'=>$datos['comentarios']
        ]);
        $name=$alumno->alu_nombre;
        
        $a=$alumno->alu_apellidos;
       
        $psw=$name[0]."".$a[0]."".round(microtime(true));
        $body="Usuario:".$alumno->alu_email."<br>Contraseña:".$psw;
        $d=[
                
            "name"=>'Credenciales de acceso '.$alumno->alu_nombre." ".$alumno->alu_apellidos,
            "title"=>"Credenciales de acceso  Europa Plus",
            "subject"=>"Se adjuntan las credenciales de accesso al sistema Europa Plus<br>". $body,
            "alumno"=>$alumno
           ];
           if($this->isProduction){
            Mail::to($alumno->alu_correo)->send(new Mensaje($d));
        }else{
            Mail::to("jusymey@gmail.com")->send(new Mensaje($d));
        }
        $user=new User([
            'group_id'=>2,
            'name'=>$alumno->alu_email,
            'password'=>md5($psw)
        ]);
        $user->save();
        $alumno->save();
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
        $alumno=Alumno::where('alu_id','=',$id)->first();
        $paises = Paise::all();
        
        $provincias = Provincia::where('provincias.pais_id','=',$alumno->pais_id)->get();
        $localidades = Localidade::select('localidades.*')
                                    ->where('localidades.prv_id','=',$provincias[0]->prv_id)->get();
        $idiomas = Opcione::all()
                            ->whereIn('opc_tipo_id',[3,4]);
        $medios = Opcione::all()
                            ->whereIn('opc_tipo_id',[2]);
        $data = [
            'paises'=>$paises,
            'provincias'=>$provincias,
            'localidades'=>$localidades,
            'idiomas'=>$idiomas,
            'medios'=>$medios,
            'alumno'=>$alumno
        ];
        return view('alumnos.view',$data);
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
        $alumno=Alumno::where('alu_id','=',$id)->first();
        $paises = Paise::all();
        
        $provincias = Provincia::where('provincias.pais_id','=',$alumno->pais_id)->get();
        $localidades = Localidade::select('localidades.*')
                                    ->where('localidades.prv_id','=',$provincias[0]->prv_id)->get();
        $idiomas = Opcione::all()
                            ->whereIn('opc_tipo_id',[3,4]);
        $medios = Opcione::all()
                            ->whereIn('opc_tipo_id',[2]);
        $data = [
            'paises'=>$paises,
            'provincias'=>$provincias,
            'localidades'=>$localidades,
            'idiomas'=>$idiomas,
            'medios'=>$medios,
            'alumno'=>$alumno
        ];
        return view('alumnos.edit',$data);
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
        $input =   $request->all(); 
        $datos =$input['alumno'];
        
        $alumno=Alumno::where('alu_id','=',$datos['id'])->first();
        $alumno->idi_id=$datos['idiomas'];
        $alumno->alu_nombre=$datos['nombre'];
        $alumno->alu_apellidos=$datos['apellidos'];
        $alumno->alu_email=$datos['correo'];
        $alumno->alu_dni=$datos['pasaporte'];
        $alumno->alu_direccion=$datos['plaza'];
        $alumno->alu_cp=$datos['codigoPostal'];
        $alumno->alu_fecha_nacim=$datos['fecha_nacim'];
        $alumno->alu_edad=$datos['edad'];
        $alumno->alu_sexo=$datos['sexo'];
        $alumno->alu_telefono=$datos['tel'];
        $alumno->alu_nivel_idioma=$datos['nivel_idioma'];
        $alumno->alu_alergias=$datos['alergias'];
        $alumno->alu_nombre_padre=$datos['nombrePadre'];
        $alumno->alu_tel_padre=$datos['telPadre'];
        $alumno->alu_medio_contacto=$datos['medioContacto'];
        $alumno->loc_id=$datos['localidades'];
        $alumno->prv_id=$datos['provincias'];
        $alumno->pais_id=$datos['paises'];
        $alumno->alu_dni_fexp=$datos['caduca'];
        $alumno->alu_comentarios = $datos['comentarios'];
        $alumno->save();
        echo json_encode(true);
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEstado(Request $request)
    {
        $input =   $request->all(); 
        
        
        try{
            $alumno=Alumno::where('alu_id','=',$input['id'])->first();
            $alumno->active=$input['estado'];
            $alumno->save();
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
        $alumno=Alumno::where('alu_id','=',$id)->first();
        try{
            $alumno->delete();
            echo json_encode(true);
        }catch(\Illuminate\Database\QueryException $e){
            $alumno->active=2;
            $alumno->save();
            echo json_encode(false);
        }
        
        
    }
}
