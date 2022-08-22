<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use Illuminate\Support\Facades\DB;
session_start();
class ReporteController extends Controller
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
    //
    public function index(){

        $_SESSION['num']="";
        $_SESSION['init']="";
        $_SESSION['end']="";
        $_SESSION['imp']="";
        $_SESSION['where']="";
        $data = [
            'facturas'=>[],
            'end'=>'',
            'init'=>'',
            'num'=>'',
            'imp'=>''
        ];
        return view('reporte.index',$data);
    }
    public function busqueda(Request $request){
        $input = $request->all();
        $where="";
        $count=0;
        if(!empty($input['num'])){
            $where=$where."fac_id =".$input['num']." ";
            $count++;
            $_SESSION['num']=$input['num'];
        }else{
            $_SESSION['num']="";
        }
        if(!empty($input['imp'])){
            if(!empty($where)){
                $where=$where."and fac_cantidad =".$input['imp']." ";
            }else{
                $where=$where."fac_cantidad =".$input['imp']." ";
            }
            $count++;
            $_SESSION['imp']=$input['imp'];

        }else{
            if(!empty($input['c'])){
                $_SESSION['imp']="";
            }   
            
        }
        if(!empty($input['init'])){
            if(!empty($where)){
                $where=$where." and STR_TO_DATE(fac_fecha, '%m/%d/%Y') >='".$input['init']."' ";
            }else{
                $where=$where."STR_TO_DATE(fac_fecha, '%m/%d/%Y') >='".$input['init']."' ";
            }
            $count++;
            $_SESSION['init']=$input['init'];
           
        }else{
            if(!empty($input['c'])){
                $_SESSION['init']="";
            }  
            
        }
        if(!empty($input['end'])){
            if(!empty($where)){
                $where=$where."and STR_TO_DATE(fac_fecha, '%m/%d/%Y') <='".$input['end']."' ";
            }else{
                $where=$where."STR_TO_DATE(fac_fecha, '%m/%d/%Y') <='".$input['end']."' ";
            }
            $count++;
            $_SESSION['end']=$input['end'];
           
        }else{
           
            if(!empty($input['c'])){
                $_SESSION['end']="";
            }
        }
        if($count>0){
            $_SESSION['where']=$where;
            
        }else{

        }
        if(empty($where)){
            if(!empty($_SESSION['where'])){
                $where=$_SESSION['where'];
            }else{
                $_SESSION['where']="";
                $where=$_SESSION['where'];
            }
           
            $input['init']=$_SESSION['init'];
            $input['end']=$_SESSION['end'];
            $input['imp']=$_SESSION['imp'];
            $input['num']=$_SESSION['num'];
        }
        if(!empty($where)){
            $facturas = DB::table('facturas')->select('*')->whereRaw("".$where)->paginate(10);
        }else{
            $facturas=[];
        }

        $data = [
            'facturas'=>$facturas,
            'end'=> $input['end'],
            'init'=>$input['init'],
            'num'=>$input['num'],
            'imp'=>$input['imp']
        ];
        return view('reporte.index',$data);
    }
    public function generateFactura(Request $request){
        $proforma = $request['proforma'];
        $fac_id = $request['fac_id'];
        $opr_id = $request['opr_id'];
      /*  if ($proforma==1) {
            $query = "SELECT f.*, o.*, esc.*, a.*, idiom.opc_descr idioma
               FROM facturas f
               JOIN operaciones o ON o.opr_id=f.opr_id
               LEFT JOIN escuelas esc ON esc.esc_id=o.esc_id
               LEFT JOIN alumnos a ON a.alu_id=o.alu_id   
               LEFT JOIN opciones idiom ON idiom.opc_id=esc.idi_id
               WHERE f.fac_proforma=1 and f.fac_id=".$fac_id;    
        }else {
            $query = "SELECT f.*, o.*, esc.*, a.*, p.pag_tipo, idiom.opc_descr idioma
               FROM facturas f
               JOIN operaciones o ON o.opr_id=f.opr_id
               LEFT JOIN pagos p ON p.fac_id=f.fac_id       
               LEFT JOIN escuelas esc ON esc.esc_id=o.esc_id
               LEFT JOIN alumnos a ON a.alu_id=o.alu_id   
               LEFT JOIN opciones idiom ON idiom.opc_id=esc.idi_id
               WHERE f.fac_id=".$fac_id;
        } */
    }
}
