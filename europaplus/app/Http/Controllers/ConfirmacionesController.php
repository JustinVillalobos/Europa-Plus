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
use App\Models\Opcione;
use App\Models\Tipo;
use App\Models\Archivo;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\SolicitudCurso;
use App\Mail\DescripcionOperacion;
use App\Mail\Mensaje;
session_start();

class ConfirmacionesController extends Controller
{
    //
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
    public function index(){
        
    }
public function solicitud_transfer_modal(Request $request){
    $input=$request->all();
    $id=$input["id"];
    $query="SELECT o.opr_id,
	o.alu_id,
	o.esc_id,
	o.vje_id,
	o.cur_id,
	o.cur_precio,
	o.cur_coste,
	DATE_FORMAT(o.cur_fecha_inicio, '%d/%m/%Y') cur_fecha_inicio,
	DATE_FORMAT(o.cur_fecha_fin, '%d/%m/%Y') cur_fecha_fin,
	o.alj_id,
	DATE_FORMAT(o.alj_fecha_inicio, '%d/%m/%Y') alj_fecha_inicio,
	DATE_FORMAT(o.alj_fecha_fin, '%d/%m/%Y') alj_fecha_fin,
	o.alj_precio,
	o.alj_coste,
	DATE_FORMAT(o.opr_fecha, '%d/%m/%Y') opr_fecha,
	o.opr_cur_state,
	o.opr_vje_state,
	o.opr_tfr_state,
	o.opr_descr_state,
	o.opr_confirm_state,
	o.opr_entrega_state,
	o.opr_pago_previo,
	o.opr_pendiente,
	o.opr_seguro,
	o.opr_comentarios,
	o.opr_cmntsalu,
	o.opr_state,
	o.opr_descuento,
	o.opr_ttl_coste,
	o.opr_modificada_tfr,
	
	v.vje_id,
	v.vje_vuelo,
	v.vje_transfer,
	v.vje_descr,
	v.vje_ida_linea,
	DATE_FORMAT(v.vje_ida_salida, '%d/%m/%Y') vje_ida_salida,
	v.vje_ida_hsalida,
	DATE_FORMAT(v.vje_ida_llegada, '%d/%m/%Y') vje_ida_llegada,
	v.vje_ida_hllegada,
	v.vje_ida_aeropuerto,
	v.vje_ida_num_vuelo,
	v.vje_vta_linea,
	DATE_FORMAT(v.vje_vta_salida, '%d/%m/%Y') vje_vta_salida,
	v.vje_vta_hsalida,
	DATE_FORMAT(v.vje_vta_llegada, '%d/%m/%Y') vje_vta_llegada,
	v.vje_vta_hllegada,
	v.vje_vta_aeropuerto,
	v.vje_vta_num_vuelo,
	v.vje_vuelo_precio,
	v.vje_transfer_precio,
	v.axp_id,
	v.vje_info_salida,
	v.vje_info_llegada,
	v.vje_vuelo_tipo,
	v.vje_vuelo_coste,
	v.vje_transfer_tipo,
	v.vje_transfer_coste,
	
	a.alu_nombre, a.alu_apellidos, a.alu_empresa, a.idi_id, a.alu_email, a.alu_edad, a.alu_profesion, a.alu_nivel_idioma, a.alu_sexo, a.alu_dieta, a.alu_fumador,
	
	e.esc_nombre, e.esc_email, e.esc_contacto_1, e.esc_cnt_mail_1,
	
	c.cur_nombre,
	
	al.alj_nombre,
	
	l.loc_descr cur_localidad

   FROM operaciones o 
   LEFT JOIN viajes v ON v.opr_id=o.opr_id 
	 JOIN alumnos a ON a.alu_id=o.alu_id 
	 JOIN escuelas e ON e.esc_id=o.esc_id 
	 JOIN cursos c ON c.cur_id=o.cur_id  
	 LEFT JOIN alojamientos al ON al.alj_id=o.alj_id
	 JOIN localidades l ON l.loc_id=e.loc_id	 
	  
   WHERE o.opr_id=".$id;
    $operacion = DB::select($query);
    $_SESSION["idOperacion"]=$id;
    $empresa=$_SESSION['empresa'];
    $data=[
        'operacion'=>$operacion,
        'empresa'=>$empresa
    ];
    echo json_encode($data);
}
    public function solicitud_curso_modal(Request $request){
        $input=$request->all();
        $id=$input["id"];
        $query="SELECT o.opr_id,
                o.alu_id,
                o.esc_id,
                o.vje_id,
                o.cur_id,
                o.cur_precio,
                o.cur_coste,
                DATE_FORMAT(o.cur_fecha_inicio, '%d/%m/%Y') cur_fecha_inicio,
                DATE_FORMAT(o.cur_fecha_fin, '%d/%m/%Y') cur_fecha_fin,
                o.alj_id,
                DATE_FORMAT(o.alj_fecha_inicio, '%d/%m/%Y') alj_fecha_inicio,
                DATE_FORMAT(o.alj_fecha_fin, '%d/%m/%Y') alj_fecha_fin,
                o.alj_precio,
                o.alj_coste,
                DATE_FORMAT(o.opr_fecha, '%d/%m/%Y') opr_fecha,
                o.opr_cur_state,
                o.cur_semanas,
                o.opr_vje_state,
                o.opr_tfr_state,
                o.opr_descr_state,
                o.opr_confirm_state,
                o.opr_entrega_state,
                o.opr_pago_previo,
                o.opr_pendiente,
                o.opr_seguro,
                o.opr_comentarios,
                o.opr_comentarios_esc,
                o.opr_cmntsalu,
                o.opr_state,
                o.opr_descuento,
                o.opr_ttl_coste,
                o.opr_modificada,
                
                v.vje_id,
                v.vje_vuelo,
                v.vje_transfer,
                v.vje_descr,
                v.vje_ida_linea,
                DATE_FORMAT(v.vje_ida_salida, '%d/%m/%Y') vje_ida_salida,
                v.vje_ida_hsalida,
                DATE_FORMAT(v.vje_ida_llegada, '%d/%m/%Y') vje_ida_llegada,
                v.vje_ida_hllegada,
                v.vje_ida_aeropuerto,
                v.vje_ida_num_vuelo,
                v.vje_vta_linea,
                DATE_FORMAT(v.vje_vta_salida, '%d/%m/%Y') vje_vta_salida,
                v.vje_vta_hsalida,
                DATE_FORMAT(v.vje_vta_llegada, '%d/%m/%Y') vje_vta_llegada,
                v.vje_vta_hllegada,
                v.vje_vta_aeropuerto,
                v.vje_vta_num_vuelo,
                v.vje_vuelo_precio,
                v.vje_transfer_precio,
                v.axp_id,
                v.vje_info_salida,
                v.vje_info_llegada,
                v.vje_vuelo_tipo,
                v.vje_vuelo_coste,
                v.vje_transfer_tipo,
                v.vje_transfer_coste,
                
                a.alu_nombre, a.alu_apellidos, a.alu_empresa, a.idi_id, a.alu_email, a.alu_edad, a.alu_profesion, a.alu_nivel_idioma, a.alu_sexo, 
                a.alu_dieta, a.alu_dieta_descr, a.alu_fumador, a.alu_tol_anim, a.alu_animales, a.alu_alergias, a.alu_fecha_nacim,
                
                e.esc_nombre, e.esc_email, e.esc_contacto_1, e.esc_cnt_mail_1, pe.pais_descr esc_pais,
                
                c.cur_nombre, c.cur_descr_de, c.cur_descr_en, c.cur_descr,
                
                al.alj_nombre, al.alj_descr_de, al.alj_descr_en, al.alj_descr,
                
                l.loc_descr cur_localidad
            
            FROM operaciones o 
            LEFT JOIN viajes v ON v.opr_id=o.opr_id 
                JOIN alumnos a ON a.alu_id=o.alu_id 
                JOIN escuelas e ON e.esc_id=o.esc_id 
                JOIN paises pe ON pe.pais_id=e.pais_id
                JOIN cursos c ON c.cur_id=o.cur_id  
                LEFT JOIN alojamientos al ON al.alj_id=o.alj_id
                JOIN localidades l ON l.loc_id=e.loc_id	 	 
                
            WHERE o.opr_id=".$id;
             $_SESSION["idOperacion"]=$id;
        $operacion = DB::select($query);
        $empresa=$_SESSION['empresa'];
        $data=[
            'operacion'=>$operacion,
            'empresa'=>$empresa
        ];
        echo json_encode($data);
    }
    public function descripcion_modal(Request $request){
        $input=$request->all();
        $id=$input["id"];
        $query = "SELECT o.opr_id,
	o.alu_id,
	o.esc_id,
	o.vje_id,
	o.cur_id,
	o.cur_precio,
	o.cur_coste,
	DATE_FORMAT(o.cur_fecha_inicio, '%d/%m/%Y') cur_fecha_inicio,
	DATE_FORMAT(o.cur_fecha_fin, '%d/%m/%Y') cur_fecha_fin,
	o.alj_id,
	DATE_FORMAT(o.alj_fecha_inicio, '%d/%m/%Y') alj_fecha_inicio,
	DATE_FORMAT(o.alj_fecha_fin, '%d/%m/%Y') alj_fecha_fin,
	o.alj_precio,
	o.alj_coste,
	DATE_FORMAT(o.opr_fecha, '%d/%m/%Y') opr_fecha,
	o.opr_cur_state,
	o.opr_vje_state,
	o.opr_tfr_state,
	o.opr_descr_state,
	o.opr_confirm_state,
	o.opr_entrega_state,
	o.opr_pago_previo,
	o.opr_pendiente,
	o.opr_seguro,
	o.opr_comentarios,
	o.opr_cmntsalu,
	o.opr_state,
	o.opr_descuento,
	o.opr_ttl_coste,
	o.opr_modificada,
	
	v.vje_id,
	v.vje_vuelo,
	v.vje_transfer,
	v.vje_descr,
	v.vje_ida_linea,
	DATE_FORMAT(v.vje_ida_salida, '%d/%m/%Y') vje_ida_salida,
	v.vje_ida_hsalida,
	DATE_FORMAT(v.vje_ida_llegada, '%d/%m/%Y') vje_ida_llegada,
	v.vje_ida_hllegada,
	v.vje_ida_aeropuerto,
	v.vje_ida_num_vuelo,
	v.vje_vta_linea,
	DATE_FORMAT(v.vje_vta_salida, '%d/%m/%Y') vje_vta_salida,
	v.vje_vta_hsalida,
	DATE_FORMAT(v.vje_vta_llegada, '%d/%m/%Y') vje_vta_llegada,
	v.vje_vta_hllegada,
	v.vje_vta_aeropuerto,
	v.vje_vta_num_vuelo,
	v.vje_vuelo_precio,
	v.vje_transfer_precio,
	v.axp_id,
	v.vje_info_salida,
	v.vje_info_llegada,
	v.vje_vuelo_tipo,
	v.vje_vuelo_coste,
	v.vje_transfer_tipo,
	v.vje_transfer_coste,
	
	a.alu_nombre, a.alu_apellidos, a.alu_empresa, e.idi_id, a.alu_email,
	
	e.esc_nombre, 
	
	c.cur_descr cur_nombre,
	
	al.alj_descr alj_nombre,
	
	l.loc_descr cur_localidad

   FROM operaciones o 
   LEFT JOIN viajes v ON v.opr_id=o.opr_id 
	 JOIN alumnos a ON a.alu_id=o.alu_id 
	 JOIN escuelas e ON e.esc_id=o.esc_id 
	 JOIN cursos c ON c.cur_id=o.cur_id  
	 LEFT JOIN alojamientos al ON al.alj_id=o.alj_id
	 JOIN localidades l ON l.loc_id=e.loc_id	 
	  
   WHERE o.opr_id=".$id;
   $operacion = DB::select($query);
   $_SESSION["idOperacion"]=$id;
   $qsups = "SELECT so.*,s.* FROM suplementos_operaciones so INNER JOIN suplementos s ON so.sup_id=s.sup_id WHERE opr_id=".$id;
   $suplementos = DB::select($qsups);
   $html="";
   $precio=0;
   foreach ($suplementos  as $key => $value) {
    $precio=$precio+$value->precio_unidad;
        if($key<count($suplementos)-1){
            $html=$html."".$value->sup_descr.", ";
        }else{
            $html=$html."".$value->sup_descr."";
        }
   }
   $idioma=Opcione::where('opc_id','=',$operacion[0]->idi_id)->first();
        $empresa=$_SESSION['empresa'];
        $data=[
            'operacion'=>$operacion,
            'empresa'=>$empresa,
            'suplementos'=>array("nombres"=>$html,"precio"=>$precio),
            'idioma'=>$idioma
        ];
        echo json_encode($data);
    }
    public function confirmacion_condicionada(Request $request){
        $input=$request->all();
        $id=$input["id"];
        $_SESSION["idOperacion"]=$id;
        $query="SELECT o.opr_id,
        o.alu_id,
        o.esc_id,
        o.vje_id,
        o.cur_id,
        o.cur_precio,
        o.cur_coste,
        DATE_FORMAT(o.cur_fecha_inicio, '%d/%m/%Y') cur_fecha_inicio,
        DATE_FORMAT(o.cur_fecha_fin, '%d/%m/%Y') cur_fecha_fin,
        o.alj_id,
        DATE_FORMAT(o.alj_fecha_inicio, '%d/%m/%Y') alj_fecha_inicio,
        DATE_FORMAT(o.alj_fecha_fin, '%d/%m/%Y') alj_fecha_fin,
        o.alj_precio,
        o.alj_coste,
        DATE_FORMAT(o.opr_fecha, '%d/%m/%Y') opr_fecha,
        o.opr_cur_state,
        o.opr_vje_state,
        o.opr_tfr_state,
        o.opr_descr_state,
        o.opr_confirm_state,
        o.opr_entrega_state,
        o.opr_pago_previo,
        o.opr_pendiente,
        o.opr_seguro,
        o.opr_comentarios,
        o.opr_cmntsalu,
        o.opr_state,
        o.opr_descuento,
        o.opr_ttl_coste,
        o.opr_modificada,
        
        v.vje_id,
        v.vje_vuelo,
        v.vje_transfer,
        v.vje_descr,
        v.vje_ida_linea,
        DATE_FORMAT(v.vje_ida_salida, '%d/%m/%Y') vje_ida_salida,
        v.vje_ida_hsalida,
        DATE_FORMAT(v.vje_ida_llegada, '%d/%m/%Y') vje_ida_llegada,
        v.vje_ida_hllegada,
        v.vje_ida_aeropuerto,
        v.vje_ida_num_vuelo,
        v.vje_vta_linea,
        DATE_FORMAT(v.vje_vta_salida, '%d/%m/%Y') vje_vta_salida,
        v.vje_vta_hsalida,
        DATE_FORMAT(v.vje_vta_llegada, '%d/%m/%Y') vje_vta_llegada,
        v.vje_vta_hllegada,
        v.vje_vta_aeropuerto,
        v.vje_vta_num_vuelo,
        v.vje_vuelo_precio,
        v.vje_transfer_precio,
        v.axp_id,
        v.vje_info_salida,
        v.vje_info_llegada,
        v.vje_vuelo_tipo,
        v.vje_vuelo_coste,
        v.vje_transfer_tipo,
        v.vje_transfer_coste,
        
        a.alu_nombre, a.alu_apellidos, a.alu_empresa, e.idi_id, a.alu_email, 
        
        e.esc_nombre, 
        
        c.cur_descr cur_nombre,
        c.cur_tipo_curso,
        
        al.alj_descr alj_nombre,
        
        l.loc_descr cur_localidad
    
       FROM operaciones o 
       LEFT JOIN viajes v ON v.opr_id=o.opr_id 
         JOIN alumnos a ON a.alu_id=o.alu_id 
         JOIN escuelas e ON e.esc_id=o.esc_id 
         JOIN cursos c ON c.cur_id=o.cur_id  
         LEFT JOIN alojamientos al ON al.alj_id=o.alj_id
         JOIN localidades l ON l.loc_id=e.loc_id	 
          
       WHERE o.opr_id=".$id;
       $operacion = DB::select($query);
        $idioma=Opcione::where('opc_id','=',$operacion[0]->idi_id)->first();
        $empresa=$_SESSION['empresa'];
        $qsups = "SELECT so.*,s.* FROM suplementos_operaciones so INNER JOIN suplementos s ON so.sup_id=s.sup_id WHERE opr_id=".$id;
        $suplementos = DB::select($qsups);
        $html="";
        $precio=0;
        foreach ($suplementos  as $key => $value) {
            $precio=$precio+$value->precio_unidad;
                if($key<count($suplementos)-1){
                    $html=$html."".$value->sup_descr.", ";
                }else{
                    $html=$html."".$value->sup_descr."";
                }
        }
        $price=0;
        $curso=Curso::where('cur_id','=',$operacion[0]->cur_id)->first();
        $tipo=Tipo::where('tipo_id','=',$curso->tipo_id)->first();
        $prc=$tipo->tipo_porcentaje;
        $data=[
            'operacion'=>$operacion,
            'empresa'=>$empresa,
            'suplementos'=>array("nombres"=>$html."","precio"=>$precio),
            'idioma'=>$idioma,
            'prc'=>$prc
        ];
        echo json_encode($data);
    }
    public function solicitud_curso_email(Request $request){
        
        $id=$_SESSION["idOperacion"];
        $input=$request->all();
        $tipo=$input["tipo"];
        try {
            $operacion = Operacione::where('opr_id','=',$id)->first();
            $operacion->opr_cur_state=1;

            
            $file=base64_decode($_POST['file']);
                $o = json_decode($input['operacion']);
                $path='files/'.$o->alu_nombre."_".$o->alu_apellidos;
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $date=date("d-m-Y");
                file_put_contents($path.'/'.'Solicitud_curso_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',$file);
               $d=[
                "path"=>$path.'/'.'Solicitud_curso_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',
                "operacion"=>$o,
                "name"=>'Solicitud Curso '.$o->alu_nombre." ".$o->alu_apellidos.' '.$date.'.pdf',
                "title"=>"Solicitud Curso",
                "subject"=>"Se le adjunta la  solicitud del curso Europa Plus"
               ];
            if($tipo==1){
               
                if($this->isProduction){
                    Mail::to($o->alu_correo)->send(new DescripcionOperacion($d));
                }else{
                    Mail::to("jusymey@gmail.com")->send(new DescripcionOperacion($d));
                }
                
                
                
                //send
            }else{
                $operacion->opr_cur_state=2; 
            }
            $operacion->save();
            $archivo=new Archivo([
                'idOperacion'=>$o->opr_id,
                'path'=>$path.'/'.'Solicitud_curso_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',
                'tipo_archivo'=>0,
                'status'=>0,
                'fechaGenerado'=>date("i:h d/m/Y").""
            ]);
            $archivo->save();
            echo json_encode(true);
        } catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode(false);
        }
        
    }
    public function test(){
        Mail::to("justinvillaespinoza68@gmail.com")->send(new SolicitudCurso(""));
        echo " true ";
    }
    public function confirmar_condicionada_email(Request $request){
        
        $id=$_SESSION["idOperacion"];
        $input=$request->all();
        $tipo=$input["tipo"];
        try {
            $operacion = Operacione::where('opr_id','=',$id)->first();
            $operacion->opr_confirm_state=1;

           
            $file=base64_decode($_POST['file']);
            $o = json_decode($input['operacion']);
            $path='files/'.$o->alu_nombre."_".$o->alu_apellidos;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $date=date("d-m-Y");
            file_put_contents($path.'/'.'Confirmacion_condicionada_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',$file);
           $d=[
            "path"=>$path.'/'.'Confirmacion_condicionada_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',
            "operacion"=>$o,
            "name"=>'Confirmación Condicionada '.$o->alu_nombre." ".$o->alu_apellidos.' '.$date.'.pdf',
            "title"=>"Confirmación Condicionada",
            "subject"=>"Se le adjunta la  Confirmación Condicionada Europa Plus"
           ];
        if($tipo==1){
           
            if($this->isProduction){
                Mail::to($o->alu_correo)->send(new DescripcionOperacion($d));
            }else{
                Mail::to("jusymey@gmail.com")->send(new DescripcionOperacion($d));
            }
            
            
            
            //send
        }else{
            $operacion->opr_confirm_state=2; 
        }
        $operacion->save();
        $archivo=new Archivo([
            'idOperacion'=>$o->opr_id,
            'path'=>$path.'/'.'Confirmacion_condicionada_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',
            'tipo_archivo'=>1,
            'status'=>0,
            'fechaGenerado'=>date("i:h d/m/Y").""
        ]);
        $archivo->save();
            echo json_encode(true);
        } catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode(false);
        }
        
    }
    public function confirmar_email(Request $request){
        
        $id=$_SESSION["idOperacion"];
        $input=$request->all();
        $tipo=$input["tipo"];
        try {
            $operacion = Operacione::where('opr_id','=',$id)->first();
            $operacion->opr_confirm_state=2;

           
            $file=base64_decode($_POST['file']);
            $o = json_decode($input['operacion']);
            $path='files/'.$o->alu_nombre."_".$o->alu_apellidos;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $date=date("d-m-Y");
            file_put_contents($path.'/'.'Confirmacion_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',$file);
           $d=[
            "path"=>$path.'/'.'Confirmacion_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',
            "operacion"=>$o,
            "name"=>'Confirmación '.$o->alu_nombre." ".$o->alu_apellidos.' '.$date.'.pdf',
            "title"=>"Confirmación ",
            "subject"=>"Se le adjunta la  Confirmación Europa Plus"
           ];
        if($tipo==1){
           
            if($this->isProduction){
                Mail::to($o->alu_correo)->send(new DescripcionOperacion($d));
            }else{
                Mail::to("jusymey@gmail.com")->send(new DescripcionOperacion($d));
            }
            
            
            
            //send
        }else{
            $operacion->opr_confirm_state=2; 
        }
        $operacion->save();
        $archivo=new Archivo([
            'idOperacion'=>$o->opr_id,
            'path'=>$path.'/'.'Confirmacion_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',
            'tipo_archivo'=>2,
            'status'=>0,
            'fechaGenerado'=>date("i:h d/m/Y").""
        ]);
        $archivo->save();
            echo json_encode(true);
        } catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode(false);
        }
        
    }
    public function entrega_email(Request $request){
        
        
        $input=$request->all();
        $id=$input["id"];
        try {
            $operacion = Operacione::where('opr_id','=',$id)->first();
            $operacion->opr_entrega_state=1;
            $alumno=Alumno::where("alu_id","=",$operacion->alu_id)->first();
            $d=[
                
                "name"=>'Confirmación de entrega ',
                "title"=>"Confirmación de entrega  Europa Plus",
                "subject"=>"Se confirma la entrega Europa Plus<br>",
                "alumno"=>$alumno
               ];
               if($this->isProduction){
                Mail::to($alumno->alu_correo)->send(new Mensaje($d));
            }else{
                Mail::to("jusymey@gmail.com")->send(new Mensaje($d));
            }
            $operacion->save();
           
            echo json_encode(true);
        } catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode(false);
        }
        
    }
    
    
    public function solicitud_transfer_email(Request $request){
        
        $id=$_SESSION["idOperacion"];
        $input=$request->all();
        $tipo=$input["tipo"];
        try {
            $operacion = Operacione::where('opr_id','=',$id)->first();
            $operacion->opr_tfr_state=1;

            
            $file=base64_decode($_POST['file']);
                $o = json_decode($input['operacion']);
                $path='files/'.$o->alu_nombre."_".$o->alu_apellidos;
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $date=date("d-m-Y");
                file_put_contents($path.'/'.'Solicitud_transferencia_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',$file);
               $d=[
                "path"=>$path.'/'.'Solicitud_transferencia_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',
                "operacion"=>$o,
                "name"=>'Solicitud de transferencia '.$o->alu_nombre." ".$o->alu_apellidos.' '.$date.'.pdf',
                "title"=>"Solicitud de transferencia",
                "subject"=>"Se le adjunta la solicitud de transferencia Europa Plus"
               ];
            if($tipo==1){
               
                if($this->isProduction){
                    Mail::to($o->alu_correo)->send(new DescripcionOperacion($d));
                }else{
                    Mail::to("jusymey@gmail.com")->send(new DescripcionOperacion($d));
                }
                
                
                
                //send
            }else{
                $operacion->opr_tfr_state=1;
            }
            $operacion->save();
           
            $archivo=new Archivo([
                'idOperacion'=>$o->opr_id,
                'path'=>$path.'/'.'Solicitud_transferencia_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',
                'tipo_archivo'=>3,
                'status'=>0,
                'fechaGenerado'=>date("i:h d/m/Y").""
            ]);
            $archivo->save();
            echo json_encode(true);
        } catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode(false);
        }
        
    }
    public function descripcion_email(Request $request){
        
        $id=$_SESSION["idOperacion"];
        $input=$request->all();
       
        $tipo=$_POST["tipo"];
        try {
            
            $operacion = Operacione::where('opr_id','=',$id)->first();
            

           
           
            if(empty($operacion)){
                $data=[
                    'operacion'=>json_encode($operacion),
                    'res'=>false,
                    'opr_id'=>$id
                ];
                echo json_encode($data);
                return;
            }
            $operacion->opr_descr_state=1;
          
            $operacion->save();
           

            $operacion->save();
            $file=base64_decode($_POST['file']);
                $o = json_decode($input['operacion']);
                $path='files/'.$o->alu_nombre."_".$o->alu_apellidos;
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $date=date("d-m-Y");
                file_put_contents($path.'/'.'Descripcion_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',$file);
               $d=[
                "path"=>$path.'/'.'Descripcion_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',
                "operacion"=>$o,
                "name"=>'Descripción '.$o->alu_nombre." ".$o->alu_apellidos.' '.$date.'.pdf',
                "title"=>"Descripción de curso",
                "subject"=>"Se le adjunta la descripción Europa Plus"
               ];
            if($tipo==1){
               
                if($this->isProduction){
                    Mail::to($o->alu_correo)->send(new DescripcionOperacion($d));
                }else{
                    Mail::to("justinvillaespinoza68@gmail.com")->send(new DescripcionOperacion($d));
                }
                
                
                
                //send
            }
            $archivo=new Archivo([
                'idOperacion'=>$o->opr_id,
                'path'=>$path.'/'.'Descripcion_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',
                'tipo_archivo'=>4,
                'status'=>0,
                'fechaGenerado'=>date("i:h d/m/Y").""
            ]);
            $archivo->save();
            $data=[
                'operacion'=>json_encode(""),
                'res'=>true,
                'opr_id'=>$id
            ];
            echo json_encode($data);
        } catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode($th);
        }
        
    }
    public function sendFactura(Request $request){
        $input=$request->all();
        $file=base64_decode($_POST['file']);
        $o = json_decode($input['factura']);
        $path='files/'.$o->alu_nombre."_".$o->alu_apellidos;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $date=date("d-m-Y");
        file_put_contents($path.'/'.'Factura_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',$file);
       $d=[
        "path"=>$path.'/'.'Factura_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',
        "operacion"=>$o,
        "name"=>'Factura '.$o->alu_nombre." ".$o->alu_apellidos.' '.$date.'.pdf',
        "title"=>"Factura",
        "subject"=>"Se le adjunta la factura Europa Plus"
       ];
       if($this->isProduction){
        Mail::to($o->alu_correo)->send(new DescripcionOperacion($d));
    }else{
        Mail::to("jusymey@gmail.com")->send(new DescripcionOperacion($d));
    }
    $archivo=new Archivo([
        'idOperacion'=>$o->opr_id,
        'path'=>$path.'/'.'Factura_'.$o->alu_nombre."_".$o->alu_apellidos.'_'.$date.'.pdf',
        'tipo_archivo'=>4,
        'status'=>0,
        'fechaGenerado'=>date("i:h d/m/Y").""
    ]);
    $archivo->save();
    echo json_encode(true);
    }
    public function confirmacion_curso_email(Request $request){
        
        $id=$_SESSION["idOperacion"];
        try {
            $operacion = Operacione::where('opr_id','=',$id)->first();
            $operacion->opr_cur_state=2;
            $alumno=Alumno::where("alu_id","=",$operacion->alu_id)->first();
            $curso=Curso::where("cur_id","=",$operacion->cur_id)->first();
            $d=[
                
                "name"=>'Confirmación de curso ',
                "title"=>"Confirmación de curso  Europa Plus",
                "subject"=>"Se confirma la inscripción del curso ".$curso->cur_nombre." Europa Plus<br>",
                "alumno"=>$alumno
               ];
               if($this->isProduction){
                Mail::to($alumno->alu_correo)->send(new Mensaje($d));
            }else{
                Mail::to("jusymey@gmail.com")->send(new Mensaje($d));
            }
            $operacion->save();
            echo json_encode(true);
        } catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode(false);
        }
        
    }

    
    public function confirmacion_transfer_email(Request $request){
        
        $id=$_SESSION["idOperacion"];
        try {
            $operacion = Operacione::where('opr_id','=',$id)->first();
            $operacion->opr_tfr_state=2;
            $alumno=Alumno::where("alu_id","=",$operacion->alu_id)->first();
            $curso=Curso::where("cur_id","=",$operacion->cur_id)->first();
            $d=[
                
                "name"=>'Confirmación de transferencia ',
                "title"=>"Confirmación de transferencia  Europa Plus",
                "subject"=>"Se confirma la transferencia del alumno ".$alumno->alu_nombre." ".$alumno->alu_apellidos." Europa Plus<br>",
                "alumno"=>$alumno
               ];
               if($this->isProduction){
                Mail::to($alumno->alu_correo)->send(new Mensaje($d));
            }else{
                Mail::to("jusymey@gmail.com")->send(new Mensaje($d));
            }
            $operacion->save();
            echo json_encode(true);
        } catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode(false);
        }
        
    }
    public function confirmacion_vuelo_email(Request $request){
        
        $id=$_SESSION["idOperacion"];
        try {
            $operacion = Operacione::where('opr_id','=',$id)->first();
            $operacion->opr_vje_state=1;
            $alumno=Alumno::where("alu_id","=",$operacion->alu_id)->first();
            $curso=Curso::where("cur_id","=",$operacion->cur_id)->first();
            $d=[
                
                "name"=>'Confirmación de vuelo ',
                "title"=>"Confirmación de vuelo  Europa Plus",
                "subject"=>"Se confirma el vuelo del alumno ".$alumno->alu_nombre." ".$alumno->alu_apellidos." Europa Plus<br>",
                "alumno"=>$alumno
               ];
               if($this->isProduction){
                Mail::to($alumno->alu_correo)->send(new Mensaje($d));
            }else{
                Mail::to("jusymey@gmail.com")->send(new Mensaje($d));
            }
            $operacion->save();
            echo json_encode(true);
        } catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode(false);
        }
        
    }
    
    public function confirmacion_seguro(Request $request){
        
        $id=$_SESSION["idOperacion"];
        try {
            $operacion = Operacione::where('opr_id','=',$id);//->where('opr_pendiente','=','0')
                                                           // ->where('opr_seguro','=','1')
                                                          //  ->where('opr_cur_state','=','2')
                                                          //  ->where('opr_confirm_state','=','2')
                                                          //  ->where('opr_entrega_state','=','1');
          /*  $q1 = "SELECT v.vje_vuelo, v.vje_transfer FROM operaciones o JOIN viajes v ON v.opr_id=o.opr_id WHERE (o.vje_id is not null) and (o.opr_id=".$id.")";
            $operacion_2 = DB::select($q1);
            
            $c=count($operacion_2);
            if($c>0){
                if($operacion_2[0]->vje_vuelo>0){
                    $operacion->where('opr_vje_state','=',1);
                }
                if($operacion_2[0]->vje_transfer>0){
                    $operacion->where('opr_tfr_state','=',2);
                }
            }*/

            $operacion=$operacion->first();
           
            if(empty($operacion)){
                $data=[
                    'operacion'=>json_encode($operacion),
                    'res'=>false,
                    'opr_id'=>$id
                ];
                echo json_encode($data);
                return;
            }
            $operacion->opr_state=1;
          
            $operacion->save();
            $alumno=Alumno::where("alu_id",'=',$operacion->alu_id)->first();
            $d=[
                
                "name"=>'Confirmación de seguro '.$alumno->alu_nombre." ".$alumno->alu_apellidos,
                "title"=>"Confirmación de seguro ",
                "subject"=>"Se ha Confirmado el seguro de Europa Plus",
                "alumno"=>$alumno
               ];
               if($this->isProduction){
                Mail::to($alumno->alu_correo)->send(new Mensaje($d));
            }else{
                Mail::to("jusymey@gmail.com")->send(new Mensaje($d));
            }
               
                
            $data=[
                'operacion'=>json_encode($operacion),
                'res'=>true,
                'opr_id'=>$id
            ];
            echo json_encode($data);
            //var_dump($operacion_2);
        } catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode(false);
        }
        
    }

    
}
