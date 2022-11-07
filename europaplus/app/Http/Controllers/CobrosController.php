<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operacione;
use App\Models\Paise;
use App\Models\Factura;
use App\Models\Pago;
use App\Models\FacturasCobrada;
use Illuminate\Support\Facades\DB;
session_start();

class CobrosController extends Controller
{
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
        $qpagos = "SELECT * FROM pagos WHERE pag_tipo=2 AND opr_id=".$id;
        $rspag_resto = DB::select($qpagos);
        $qpagos = "SELECT SUM(pag_importe) as ttl FROM pagos WHERE pag_tipo=2 AND opr_id=".$id;
        $pag_importe2 = DB::select($qpagos);
        $qpagos = "SELECT SUM(pag_importe) as ttl FROM pagos WHERE pag_tipo=3 AND opr_id=".$id;
        $pag_importe3 = DB::select($qpagos);
        $qpagos = "SELECT * FROM pagos WHERE pag_tipo=4 AND opr_id=".$id;
        $rspag_devs = DB::select($qpagos);
        $qpagos = "SELECT SUM(pag_importe) as ttl FROM pagos WHERE pag_tipo=4 AND opr_id=".$id;
        
        $pag_importe4 = DB::select($qpagos);
        $qpro = "SELECT f.fac_id, f.fac_numero, f.fac_fecha FROM facturas f WHERE f.opr_id=".$id." AND f.fac_proforma=1";
       
        $facturas = DB::select($qpro);
        $qsups = "SELECT * FROM suplementos_operaciones WHERE  opr_id=".$id;
        $suplementos= DB::select($qsups);
        $query="SELECT * FROM facturas_cobradas WHERE  opr_id=".$id;
        $facturasCobradas=DB::select($query);
        $precio=0;
        foreach ($suplementos as $key => $value) {
            # code...
            $precio = $precio + $value->precio_unidad;
        }
        $precioTotal=$operacion->cur_precio+$operacion->alj_precio+$operacion->vje_transfer_precio+$precio-$operacion->opr_descuento;	
        var_dump($operacion->cur_precio);	
       $devoluciones=[];
        if(empty($rspag_resto)){
            $rspag_resto=[];
        } 
        if (empty($rspag_devs)){
            $rspag_devs=[];
        }else{
            foreach ($rspag_devs as $key => $value) {
                $qpagos = "SELECT f.fac_id, f.fac_numero, f.fac_fecha FROM facturas f JOIN pagos p ON p.fac_id=f.fac_id WHERE p.pag_tipo=4 AND p.opr_id=".$id." AND p.pag_id=".$rspag_devs[$key]->pag_id;
                $devoluciones[]=DB::select($qpagos);
            }
            
        }
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
            'devoluciones'=>$devoluciones,
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
        echo json_encode($id);
    }
}

?>
