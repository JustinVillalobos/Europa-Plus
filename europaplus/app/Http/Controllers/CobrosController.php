<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operacione;
use App\Models\Paise;
use App\Models\Factura;
use App\Models\Pago;
use App\Models\Localidade;
use App\Models\FacturasCobrada;
use App\Models\Opcione;
use App\Models\SuplementosOperacione;
use App\Models\Provincia;
use App\Models\Tipo;
use Illuminate\Support\Facades\DB;
session_start();

class CobrosController extends Controller
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
    public function index(){
        
    }
    public function cobros($id){
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
								 o.opr_ttl_coste_h,
								 o.opr_empresa,
								 o.opr_agencia,
								 
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
								 
								 a.pais_id alupais, a.alu_nombre, a.alu_apellidos						 																 

   FROM operaciones o JOIN alumnos a ON a.alu_id=o.alu_id LEFT JOIN viajes v ON v.opr_id=o.opr_id LEFT JOIN pagos p ON p.opr_id=o.opr_id WHERE o.opr_id=".$id;
  
        $operacion = DB::select($query);
        $operacion=$operacion[0];
        $pais=Paise::where('pais_id','=',$operacion->alupais)->first();
        $qpagos = "SELECT SUM(pag_importe) as ttl FROM pagos WHERE pag_tipo=1 AND opr_id=".$id;
        $pag_importe = DB::select($qpagos);
		$qpagosReserva = "SELECT pagos.*,facturas.* FROM pagos INNER JOIN facturas ON pagos.fac_id=facturas.fac_id WHERE pag_tipo=1 AND pagos.opr_id=".$id.' order by pagos.pag_id DESC';
        $rspag_reserva = DB::select($qpagosReserva);
        $qpagos = "SELECT * FROM pagos INNER JOIN facturas ON pagos.fac_id=facturas.fac_id WHERE pag_tipo=2 AND pagos.opr_id=".$id.' order by pagos.pag_id DESC';
        $rspag_resto = DB::select($qpagos);
        $qpagos = "SELECT SUM(pag_importe) as ttl FROM pagos WHERE pag_tipo=2 AND opr_id=".$id;
        $pag_importe2 = DB::select($qpagos);
        $qpagos = "SELECT SUM(pag_importe) as ttl FROM pagos WHERE pag_tipo=3 AND opr_id=".$id;
        $pag_importe3 = DB::select($qpagos);
        $qpagos = "SELECT * FROM pagos WHERE pag_tipo=4 AND opr_id=".$id."  order by pagos.pag_id DESC";
        $rspag_devs = DB::select($qpagos);
        $qpagos = "SELECT SUM(pag_importe) as ttl FROM pagos WHERE pag_tipo=4 AND opr_id=".$id;
        
        $pag_importe4 = DB::select($qpagos);
        $qpro = "SELECT f.fac_id, f.fac_numero, f.fac_fecha,f.fac_proforma FROM facturas f WHERE f.opr_id=".$id." AND f.fac_proforma=1  order by f.fac_id DESC";
       
        $facturas = DB::select($qpro);
        $qsups = "SELECT * FROM suplementos_operaciones WHERE  opr_id=".$id;
        $suplementos= DB::select($qsups);

        $facturasCobradas=[];
        $precio=0;
        foreach ($suplementos as $key => $value) {
            # code...
            $precio = $precio + $value->precio_unidad;
        }
        $precioTotal=$operacion->cur_precio+$operacion->alj_precio+$operacion->vje_transfer_precio+$precio-$operacion->opr_descuento;	
        
       $devoluciones=[];
        if(empty($rspag_resto)){
            $rspag_resto=[];
        } 
        if (empty($rspag_devs)){
            $rspag_devs=[];
        }else{
			foreach ($rspag_devs as $key => $value) {
				
				$devolucion=Factura::where('fac_id','=',$value->fac_id)->first();
				$rspag_devs[$key]->factura=$devolucion;
			}
		}
		if(empty($rspag_reserva)){
			$rspag_reserva=[""];
		}
		//SELECT pagos.*,facturas.* FROM pagos INNER JOIN facturas ON pagos.fac_id=facturas.fac_id WHERE pag_tipo=1 AND pagos.opr_id=3538 order by pagos.pag_id DESC;
		//select * from facturas order by opr_id DESC;
		//var_dump($rspag_devs);	
        $data = [
            'operacion'=>$operacion,
            'pais'=>$pais,
            'pag_importe'=>$pag_importe[0],
            'pag_importe2'=>$pag_importe2[0],
            'pag_importe3'=>$pag_importe3[0],
            'pag_importe4'=>$pag_importe4[0],
            'rspag_resto'=>$rspag_resto,
            'rspag_devs'=>$rspag_devs,
            'facturas'=>$facturas,
            'opr_id'=>$id,
           'reserva'=>$rspag_reserva[0],
            "precio"=>$precio,
            'precioTotal'=>$precioTotal,
            'facturasCobradas'=>$facturasCobradas
        ];
        $_SESSION['opr_id']=$id;
            $_SESSION["idOperacion"]=$id;
        $data['id']=$id;
        $_SESSION["operacion"]="4";
        return view("operaciones.cobros",$data);
    }
    public function resto_curso(Request $request){
        $input=$request->all();
        $id= $_SESSION["idOperacion"];
        $query = "SELECT o.opr_id,
								 o.alu_id,
								 o.esc_id,
								 o.vje_id,
								 o.cur_id,
								 o.cur_precio,
								 o.cur_coste,
								 o.cur_semanas,
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
								 o.opr_empresa,
								 o.opr_agencia,
								 
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
								 
								 a.*,
								 c.cur_nombre,
								 
								 es.esc_nombre,
								 es.idi_id,
								 es.loc_id esc_loc,
								 es.prv_id esc_prv,
								 es.pais_id,
								 
						     em.emp_id,
						     em.emp_nombre,
						     em.emp_nombre_corto,
						     em.emp_direccion,
						     em.emp_direccion_2,
						     em.emp_cp,
						     em.emp_cif,
						     em.emp_proveedor,
						     em.emp_contacto_1,
						     em.emp_cnt_apell_1,
						     em.emp_cnt_mail_1,
						     em.emp_telefono_1,
						     em.emp_cnt_func_1,
						     em.emp_contacto_2,
						     em.emp_cnt_apell_2,
						     em.emp_cnt_mail_2,
						     em.emp_telefono_2,
						     em.emp_cnt_func_2,
						     em.emp_fax,
						     em.active,
						     em.pais_id emp_pais,
								 em.prv_id emp_prv,
								 em.loc_id emp_loc,
								 
						     ag.agn_id,
						     ag.agn_nombre,
						     ag.agn_nombre_corto,
						     ag.agn_direccion,
						     ag.agn_direccion_2,
						     ag.agn_cp,						     
						     ag.agn_contacto_1,
						     ag.agn_cnt_apell_1,
						     ag.agn_cnt_mail_1,
						     ag.agn_cnt_func_1,
						     ag.agn_cnt_func_1,
						     ag.agn_contacto_2,
						     ag.agn_cnt_apell_2,
						     ag.agn_cnt_mail_2,
						     ag.agn_cnt_func_2,
						     ag.agn_cnt_func_2,
						     ag.agn_fax,
						     ag.active,
						     ag.pais_id agn_pais,
								 ag.prv_id agn_prv,
								 ag.loc_id agn_loc,
								 
								 f.*,
								 
								 ps.pais_descr,
								 ps1.pais_descr esc_pais,
								 pr.prv_descr,
								 l.loc_descr

   FROM operaciones o 
   LEFT JOIN viajes v ON v.opr_id=o.opr_id 
   LEFT JOIN pagos p ON p.opr_id=o.opr_id 
   LEFT JOIN alumnos a ON a.alu_id=o.alu_id   
   LEFT JOIN cursos c ON c.cur_id=o.cur_id
   LEFT JOIN escuelas es ON es.esc_id=o.esc_id
   LEFT JOIN paises ps ON ps.pais_id=a.pais_id
   LEFT JOIN paises ps1 ON ps1.pais_id=es.pais_id
   LEFT JOIN provincias pr ON pr.prv_id=a.prv_id
   LEFT JOIN localidades l ON l.loc_id=a.loc_id
	 LEFT JOIN empresas em ON em.emp_id=o.opr_empresa
	 LEFT JOIN agencias ag ON ag.agn_id=o.opr_agencia   	 
	 LEFT JOIN facturas f ON f.opr_id=o.opr_id
   WHERE o.opr_id=".$id;
   $operacion= DB::select($query);
   $numProforma=0;
        $tipo=$input['tipo'];
        $resto=$input['resto'];
        $serie="";
        if($tipo==0){
            $serie="A";
        }else if($tipo==1){
            $serie="SN";
        }else if($tipo==2){
            $serie="PF";
			$numProforma=1;
        }
        $qfacnum = "SELECT MAX(IF(fac_id IS NULL, 1, fac_id)) max_facnum FROM facturas WHERE fac_serie='".$serie."'";
        $maximo= DB::select($qfacnum);
       
        $pag_signo=1;
        $fac_descuento=$operacion[0]->opr_descuento;
        $fac_alumno=$operacion[0]->alu_nombre." ".$operacion[0]->alu_apellidos;
        $fac_nombre_curso=$operacion[0]->cur_nombre;
        $lc=$operacion[0]->esc_loc;

        $fac_localidad_curso=Localidade::where('loc_id','=',$lc)->first();
        $fac_localidad_curso=$fac_localidad_curso->loc_descr; 
        $pc=$operacion[0]->esc_pais;
       // $fac_pais_curso=$pc->getHtml();
        $fac_fecha_ini_curso=$operacion[0]->cur_fecha_inicio;
        $fac_fecha_fin_curso=$operacion[0]->cur_fecha_fin;
        $opc_id=$operacion[0]->idi_id;
        $fac_idioma_curso=Opcione::where('opc_id','=',$opc_id)->first();
        $fac_idioma_curso=$fac_idioma_curso->opc_descr;
        $fac_suplementos_curso='';
        $opr_pendiente=$operacion[0]->opr_pendiente;
        //$query = "UPDATE operaciones SET opr_pendiente=".($opr_pendiente-($resto*$pag_signo))." WHERE opr_id=".$id;
        $opr=Operacione::where('opr_id','=',$id)->first();
        $opr->opr_pendiente=$opr_pendiente-($resto*$pag_signo);
        if (($resto>$opr_pendiente) || ($resto==0)){
            $data=[
                'res'=>false,
                'error'=>"El importe a facturar como resto del curso no coincide con la cantidad almacenada en el sistema.",
				'opr'=>json_encode($opr)
            ];
            echo json_encode($data);
            return;
        }
		$qfacnum = "SELECT MAX(IF(fac_num IS NULL, 1, fac_num)) max_facnum FROM facturas WHERE fac_serie='".$serie."'";
		$rsfnum =DB::select($qfacnum);
		$fac_numero=$serie.($rsfnum[0]->max_facnum+1).'/'.substr(date('Y'),2,2);
		
		$operacion_tipo=$input['operacion_tipo'];
        if($operacion_tipo==2){
			$pag_descr='<b>Resto del curso</b>';
		}else if($operacion_tipo==1){
			$pag_descr='<b>Señal de Reserva</b>';
			$tipos=Tipo::join('cursos','cursos.tipo_id','tipos.tipo_id')->where('cursos.cur_id','=',$opr->cur_id)->first();
			$senial=$tipos->tipo_porcentaje;
			if($resto<$senial || $resto>$senial){
				$data=[
					'res'=>false,
					'error'=>"El importe a facturar como  la Señal de Reserva no coincide con la cantidad almacenada en el sistema.",
					'opr'=>json_encode($opr),
					'senial'=>$senial." ".$resto
				];
				echo json_encode($data);
				return;
			}
		}
		
	
  $fac_concepto = $pag_descr . " - " .$operacion[0]->cur_nombre . " de ".$fac_idioma_curso." durante " . $operacion[0]->cur_semanas . " semanas, desde el " . $operacion[0]->cur_fecha_inicio . " hasta el " . $operacion[0]->cur_fecha_fin. " en " . $fac_localidad_curso . " (" . $operacion[0]->esc_pais . ")";
	

if ($tipo!=1)
{
	
$Suplementos_cursos=SuplementosOperacione::select('suplementos.*','suplementos_operaciones.*')->join('suplementos','suplementos.sup_id','suplementos_operaciones.sup_id')->where('suplementos_operaciones.sup_tipo','=',1)
                                ->where('opr_id','=',$id)->get();
foreach($Suplementos_cursos as $s){
	$fac_suplementos_curso.="-".$s->sup_descr." ".number_format($s->precio_unidad, 2, '.', '')." EUR<br/>";
}

  if (trim($fac_suplementos_curso)!='')  {
	$fac_concepto .= "<br/><br/><b>Suplementos:</b><br/>".$fac_suplementos_curso;	
  }
    
  
  if (($operacion[0]->vje_transfer==1) && ($operacion[0]->vje_transfer_precio>0)) {
  	$transfer=($operacion[0]->vje_transfer==1)?'Si':'No';
  	if ($operacion[0]->vje_transfer==1)
  	  $transfer_tipo=($operacion[0]->vje_transfer_tipo==1)?'Ida':(($operacion[0]->vje_transfer_tipo==2)?'Vuelta':'Ida y vuelta');
  	else
  	  $transfer_tipo='No';  	
    $fac_concepto .= "<br/><br/><b>Transfer al aeropuerto (".$transfer_tipo."): </b>".$operacion[0]->vje_transfer_precio." EUR"; 
  }
  
  if (($operacion[0]->vje_vuelo==1) && ($operacion[0]->vje_vuelo_precio>0))
  	$fac_concepto .= "<br/><br/><b>Billete de Avion: </b>".$operacion[0]->vje_vuelo_precio." EUR<br/><br/>";  
}
$provincia=Provincia::where('prv_id','=',$operacion[0]->esc_prv)->first();
$fac_id=$maximo[0]->max_facnum+1;
		$factura=new Factura([
			'fac_id'=>$fac_id, 
			'opr_id'=>$id,
			'fac_num'=>$rsfnum[0]->max_facnum+1,
			'fac_numero'=>$fac_numero,
			'fac_serie'=>$serie,
			'fac_fecha'=>date('d/m/Y'),
			'fac_cantidad'=>$resto,									
			'fac_descuento'=>$operacion[0]->opr_descuento,
			'fac_concepto'=>$fac_concepto,
			'fac_nombre'=>$operacion[0]->alu_nombre,
			'fac_apellidos'=>$operacion[0]->alu_apellidos,
			'fac_direccion'=>$operacion[0]->alu_direccion,
			'fac_cp'=>$operacion[0]->alu_cp,
			'fac_localidad'=>$operacion[0]->loc_descr,
			'fac_provincia'=>$provincia->prv_descr,
			'fac_pais'=>$operacion[0]->esc_pais ,
			'fac_cif'=>"",
			'fac_nombre_empresa'=>"",
			'fac_contacto_empresa'=>"",
			'fac_direccion_empresa'=>"",
			'fac_direccion_empresa_2'=>"",									
			'fac_cp_empresa'=>"",
			'fac_localidad_empresa'=>"",
			'fac_provincia_empresa'=>"",
			'fac_pais_empresa'=>"",
			'fac_cif_empresa'=>"",
			'fac_alumno'=>$operacion[0]->alu_nombre." ".$operacion[0]->alu_apellidos,
			'fac_nombre_curso'=>$operacion[0]->cur_nombre,
			'fac_localidad_curso'=>$fac_localidad_curso ,
			'fac_pais_curso'=>$operacion[0]->esc_pais,
			'fac_fecha_ini_curso'=>$operacion[0]->cur_fecha_inicio,
			'fac_fecha_fin_curso'=>$operacion[0]->cur_fecha_fin,
			'fac_idioma_curso'=>$fac_idioma_curso,
			'fac_suplementos_curso'=>$fac_suplementos_curso,
			'fac_comentarios'=>$operacion[0]->opr_comentarios,
			'fac_proforma'=>$numProforma
		]);
		try{
			
			$factura->save();
			if ($tipo!=2){
				//'fac_num'=>$rsfnum[0]->max_facnum+1,
			//'fac_numero'=>$fac_numero,
			//'fac_serie'=>$serie,
				$factura_new=Factura::where("opr_id","=",$id)->where("fac_num","=",$rsfnum[0]->max_facnum+1)->where('fac_numero',"=",$fac_numero)
										->where("fac_serie","=",$serie)->first();
				$pago= new Pago([
				 'opr_id'=>$id,
				 'pag_importe'=>$resto,
				 'pag_tipo'=>$operacion_tipo,
				 'pag_signo'=>$pag_signo,
				 'fac_id'=>$factura_new->fac_id
				]);
				$pago->save();
				$opr->save();
			 }
			 echo json_encode(true);
		}catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
			$data=[
				'err'=>$th,
				'fac_id'=>$fac_id
			];
            echo json_encode($data);
        }

       
    }
	public function devolucion(Request $request){
        $input=$request->all();
        $id= $_SESSION["idOperacion"];
        $query = "SELECT o.opr_id,
								 o.alu_id,
								 o.esc_id,
								 o.vje_id,
								 o.cur_id,
								 o.cur_precio,
								 o.cur_coste,
								 o.cur_semanas,
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
								 o.opr_empresa,
								 o.opr_agencia,
								 
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
								 
								 a.*,
								 c.cur_nombre,
								 
								 es.esc_nombre,
								 es.idi_id,
								 es.loc_id esc_loc,
								 es.prv_id esc_prv,
								 es.pais_id,
								 
						     em.emp_id,
						     em.emp_nombre,
						     em.emp_nombre_corto,
						     em.emp_direccion,
						     em.emp_direccion_2,
						     em.emp_cp,
						     em.emp_cif,
						     em.emp_proveedor,
						     em.emp_contacto_1,
						     em.emp_cnt_apell_1,
						     em.emp_cnt_mail_1,
						     em.emp_telefono_1,
						     em.emp_cnt_func_1,
						     em.emp_contacto_2,
						     em.emp_cnt_apell_2,
						     em.emp_cnt_mail_2,
						     em.emp_telefono_2,
						     em.emp_cnt_func_2,
						     em.emp_fax,
						     em.active,
						     em.pais_id emp_pais,
								 em.prv_id emp_prv,
								 em.loc_id emp_loc,
								 
						     ag.agn_id,
						     ag.agn_nombre,
						     ag.agn_nombre_corto,
						     ag.agn_direccion,
						     ag.agn_direccion_2,
						     ag.agn_cp,						     
						     ag.agn_contacto_1,
						     ag.agn_cnt_apell_1,
						     ag.agn_cnt_mail_1,
						     ag.agn_cnt_func_1,
						     ag.agn_cnt_func_1,
						     ag.agn_contacto_2,
						     ag.agn_cnt_apell_2,
						     ag.agn_cnt_mail_2,
						     ag.agn_cnt_func_2,
						     ag.agn_cnt_func_2,
						     ag.agn_fax,
						     ag.active,
						     ag.pais_id agn_pais,
								 ag.prv_id agn_prv,
								 ag.loc_id agn_loc,
								 
								 f.*,
								 
								 ps.pais_descr,
								 ps1.pais_descr esc_pais,
								 pr.prv_descr,
								 l.loc_descr

   FROM operaciones o 
   LEFT JOIN viajes v ON v.opr_id=o.opr_id 
   LEFT JOIN pagos p ON p.opr_id=o.opr_id 
   LEFT JOIN alumnos a ON a.alu_id=o.alu_id   
   LEFT JOIN cursos c ON c.cur_id=o.cur_id
   LEFT JOIN escuelas es ON es.esc_id=o.esc_id
   LEFT JOIN paises ps ON ps.pais_id=a.pais_id
   LEFT JOIN paises ps1 ON ps1.pais_id=es.pais_id
   LEFT JOIN provincias pr ON pr.prv_id=a.prv_id
   LEFT JOIN localidades l ON l.loc_id=a.loc_id
	 LEFT JOIN empresas em ON em.emp_id=o.opr_empresa
	 LEFT JOIN agencias ag ON ag.agn_id=o.opr_agencia   	 
	 LEFT JOIN facturas f ON f.opr_id=o.opr_id
   WHERE o.opr_id=".$id;
   $operacion= DB::select($query);
   $numProforma=0;
        $tipo=$input['tipo'];
        $resto=$input['resto'];
        $serie="";
		$serie="AB";
        $qfacnum = "SELECT MAX(IF(fac_id IS NULL, 1, fac_id)) max_facnum FROM facturas WHERE fac_serie='".$serie."'";
        $maximo= DB::select($qfacnum);
        $fac_numero=$serie.($maximo[0]->max_facnum+1).'/'.substr(date('Y'),2,2);
        $pag_signo=1;
        $fac_descuento=$operacion[0]->opr_descuento;
        $fac_alumno=$operacion[0]->alu_nombre." ".$operacion[0]->alu_apellidos;
        $fac_nombre_curso=$operacion[0]->cur_nombre;
        $lc=$operacion[0]->esc_loc;

        $fac_localidad_curso=Localidade::where('loc_id','=',$lc)->first();
        $fac_localidad_curso=$fac_localidad_curso->loc_descr; 
        $pc=$operacion[0]->esc_pais;
       // $fac_pais_curso=$pc->getHtml();
        $fac_fecha_ini_curso=$operacion[0]->cur_fecha_inicio;
        $fac_fecha_fin_curso=$operacion[0]->cur_fecha_fin;
        $opc_id=$operacion[0]->idi_id;
        $fac_idioma_curso=Opcione::where('opc_id','=',$opc_id)->first();
        $fac_idioma_curso=$fac_idioma_curso->opc_descr;
        $fac_suplementos_curso='';
        $opr_pendiente=$operacion[0]->opr_pendiente;
        //$query = "UPDATE operaciones SET opr_pendiente=".($opr_pendiente-($resto*$pag_signo))." WHERE opr_id=".$id;
        $opr=Operacione::where('opr_id','=',$id)->first();
		$pag_signo=-1;
        $opr->opr_pendiente=$opr_pendiente-($resto*$pag_signo);
        if (abs($resto)<=abs($opr->opr_ttl_h)|| ($resto==0)){
            $data=[
                'res'=>false,
                'error'=>"El importe a facturar como resto del curso no coincide con la cantidad almacenada en el sistema.",
				'opr'=>json_encode($opr)
            ];
            echo json_encode($data);
            return;
        }
		$qfacnum = "SELECT MAX(IF(fac_num IS NULL, 1, fac_num)) max_facnum FROM facturas WHERE fac_serie='".$serie."'";
		$rsfnum =DB::select($qfacnum);
		$fac_numero=$serie.($rsfnum[0]->max_facnum+1).'/'.substr(date('Y'),2,2);
        	
  $pag_descr='<b>Devolución</b>';

		
	
  $fac_concepto = $pag_descr . " <br/> " .$input['concepto'];
	


	

$provincia=Provincia::where('prv_id','=',$operacion[0]->esc_prv)->first();
		$factura=new Factura([
			'fac_id'=>$maximo[0]->max_facnum+1, 
			'opr_id'=>$id,
			'fac_num'=>$rsfnum[0]->max_facnum+1,
			'fac_numero'=>$fac_numero,
			'fac_serie'=>$serie,
			'fac_fecha'=>date('d/m/Y'),
			'fac_cantidad'=>$resto,									
			'fac_descuento'=>$operacion[0]->opr_descuento,
			'fac_concepto'=>$fac_concepto,
			'fac_nombre'=>$operacion[0]->alu_nombre,
			'fac_apellidos'=>$operacion[0]->alu_apellidos,
			'fac_direccion'=>$operacion[0]->alu_direccion,
			'fac_cp'=>$operacion[0]->alu_cp,
			'fac_localidad'=>$operacion[0]->loc_descr,
			'fac_provincia'=>$provincia->prv_descr,
			'fac_pais'=>$operacion[0]->esc_pais ,
			'fac_cif'=>"",
			'fac_nombre_empresa'=>"",
			'fac_contacto_empresa'=>"",
			'fac_direccion_empresa'=>"",
			'fac_direccion_empresa_2'=>"",									
			'fac_cp_empresa'=>"",
			'fac_localidad_empresa'=>"",
			'fac_provincia_empresa'=>"",
			'fac_pais_empresa'=>"",
			'fac_cif_empresa'=>"",
			'fac_alumno'=>$operacion[0]->alu_nombre." ".$operacion[0]->alu_apellidos,
			'fac_nombre_curso'=>$operacion[0]->cur_nombre,
			'fac_localidad_curso'=>$fac_localidad_curso ,
			'fac_pais_curso'=>$operacion[0]->esc_pais,
			'fac_fecha_ini_curso'=>$operacion[0]->cur_fecha_inicio,
			'fac_fecha_fin_curso'=>$operacion[0]->cur_fecha_fin,
			'fac_idioma_curso'=>$fac_idioma_curso,
			'fac_suplementos_curso'=>$fac_suplementos_curso,
			'fac_comentarios'=>$operacion[0]->opr_comentarios,
			'fac_proforma'=>$numProforma
		]);
		try{
			$opr->save();
			$factura->save();
			if ($tipo!=2){
				
				$pago= new Pago([
				 'opr_id'=>$id,
				 'pag_importe'=>$resto,
				 'pag_tipo'=>4,
				 'pag_signo'=>$pag_signo,
				 'fac_id'=>$factura->fac_id
				]);
				$pago->save();
			 }
			 echo json_encode($factura->fac_id);
		}catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode($th);
        }

       
    }
	public function save_concepto(Request $request){
		$input=$request->all();
		try{
			$factura=Factura::where("fac_id",'=',$input["factura"])->first();
			$factura->fac_concepto=$input['concepto'];
			$factura->save();
			echo json_encode(true);
		}catch (\Illuminate\Database\QueryException $th) {
            //throw $th;
            echo json_encode($th);
        }
		
	}
	
}

?>
