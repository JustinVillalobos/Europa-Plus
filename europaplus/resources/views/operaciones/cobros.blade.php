@extends('../layouts.admin_operacion')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href='{{route("operacion.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Operaciones</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Cobros</li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    
    

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">Datos Cobro[ {{$operacion->alu_nombre." ".$operacion->alu_apellidos}} ]</div>
    </div>
    
    <div class="text-right" style="padding:10px 20px 0px 20px;width:210px">
        <label class="text-danger" style="text-decoration:underline;margin:0">Importe total a facturar:</label>
    </div>
    <div class="" style="padding:10px 20px 0px 20px;width:200px;">
        {{ number_format($operacion->opr_ttl_coste_h, 2, '.', '')}} EUR
    </div>
    <div class="col-sm-12"></div>
    @if($operacion->opr_descuento>0)
        <div class="text-right" style="padding:10px 20px 0px 20px;width:210px">
            <label class="text-" style="text-decoration:underline;margin:0">Descuento:</label>
        </div>
        <div class="" style="padding:10px 20px 0px 20px;width:200px;">
        <?php $desc=$operacion->opr_descuento;?>
            {{number_format($desc, 2, '.', '')}} EUR
        </div>
        <div class="col-sm-12"></div>
    @endif
    <?php $numspagrs=count($rspag_resto)?>
    @if (($pag_importe3->ttl==0) || ($operacion->opr_pendiente>0) || ($numspagrs>0)) 
        @if ($pag_importe3->ttl==0) 
            <div class="text-right" style="padding:10px 20px 0px 20px;width:210px">
                <label class="text-" style="text-decoration:underline;margin:0">Señal de reserva:</label>
            </div>
            <div class="" style="padding:10px 20px 0px 20px;width:130px;">
                {{number_format($pag_importe->ttl, 2, '.', '')}} EUR
            </div>
            
        @endif
    @endif
    @if($pag_importe->ttl==0)
        <div class="" style="padding:10px 20px 0px 0px;width:150px;">
                <input type="text" class="form-control" id="senial" />
            </div>
            <div class="" style="padding:10px 20px 0px 0px;width:400px;">
                <button class="btn btn-success" onclick="facturar()">Facturar</button>
                <button class="btn btn-success" onclick="sinfacturar()">Sin Facturar</button>
                <button class="btn btn-success" onclick="proforma()">Pro Forma</button>
            </div>
    @endif
    <div class="col-sm-12"></div>
    @if($operacion->opr_pendiente>0)
        <div class="text-right" style="padding:10px 20px 0px 20px;width:210px">
            <label class="text-" style="text-decoration:underline;margin:0">Resto del curso:</label>
        </div>
        <div class="" style="padding:10px 20px 0px 20px;width:130px;">
            @if(count($rspag_resto)>0)
            {{ number_format($rspag_resto[0]->pag_importe, 2, '.', '') }} EUR
            @endif
            @if(count($rspag_resto)==0)
                0.00 EUR
            @endif
        </div>
        @if($numspagrs==0)
            <div class="" style="padding:10px 20px 0px 0px;width:150px;">
                <input type="text" class="form-control" id="restocurso" />
            </div>
            <div class="" style="padding:10px 20px 0px 0px;width:400px;">
                <button class="btn btn-success" onclick="facturar()">Facturar</button>
                <button class="btn btn-success" onclick="sinfacturar()">Sin Facturar</button>
                <button class="btn btn-success" onclick="proforma()">Pro Forma</button>
            </div>
        @endif
    @endif
    <div class="col-sm-12"></div>
    @if ($pag_importe->ttl==0) 
        <div class="text-right" style="padding:10px 20px 0px 20px;width:210px">
            <label class="text-danger" style="text-decoration:underline;margin:0">Curso completo:</label>
        </div>
        <div class="" style="padding:10px 20px 0px 20px;width:200px;">
       
            {{ number_format($pag_importe3->ttl, 2, '.', '')}} EUR
        </div>
    @endif
    <div class="col-sm-12"></div>
    <div class="text-right" style="padding:10px 20px 0px 20px;width:210px">
        <label class="text-danger" style="text-decoration:underline;margin:0">Total cobrado:</label>
    </div>
    <div class="" style="padding:10px 20px 0px 20px;width:200px;">
    <?php $total=$pag_importe->ttl+$pag_importe2->ttl+$pag_importe3->ttl?>
        {{ number_format($total, 2, '.', '')}} EUR
    </div>
    <div class="col-sm-12"></div>
    <div class="text-right" style="padding:10px 20px 0px 20px;width:210px">
        <label class="text-danger" style="text-decoration:underline;margin:0">Pendiente:</label>
    </div>
    <div class="" style="padding:10px 20px 0px 20px;width:200px;">
        <?php 
            if (count($rspag_devs)>0) {
                $pendiente=floatval($operacion->opr_pendiente)-floatval($rspag_devs[0]->pag_importe);
            }else{
                $pendiente=$operacion->opr_pendiente;
            }
               
            
               
            echo number_format($pendiente, 2, '.', '') . " EUR"; 
        ?>
    </div>
   
    <div class="col-sm-12"></div>
    

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">Facturas Pro Forma</div>
    </div>
    <div class="col-sm-12" style="padding:10px 40px 0px 40px;">
    @if(count($facturas)==0)
        <div class="font-weight-bold" style="padding-left:25px;">
            <?php echo "No hay facturas Pro Forma" ?>
        </div>
    @endif
    @foreach($facturas as $factura)
            <?php echo '<b>'. $factura->fac_fecha .'</b>&nbsp;'. $factura->fac_numero .'&nbsp;<a class="slink" href="javascript: openfacwnd(\'factura.php?proforma=1&opr_id='.$opr_id.'&fac_id='.$factura->fac_id.'\');">Ver</a>&nbsp;<a class="slink" href="#" onClick="document.edtfac.fac_id.value='.$factura->fac_id.'; document.edtfac.extrafac.value=0; document.edtfac.pag_tipo.value=3; document.edtfac.submit();">Editar</a>';?> 
    @endforeach
    
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">Devoluciones</div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
            <div class="row">
                <div class="" style="width:100px">
                    <label>Devolución:</label>
                </div>
                <div class="" style="width:100px">
                    <input type="text" name="dev" id="dev" class="form-control"/>
                </div>
                <div class="" style="width:40px">
                    <label>EUR</label>
                </div>
                <div class="" style="width:270px">
                    <button class="btn btn-success">Abonar</button>
                    <button class="btn btn-success">Abonar sin factura</button>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        @foreach($rspag_devs as $key=>$dev)
                            <div class="col-sm-12"><strong>{{number_format($dev->pag_importe, 2, '.', '')}} EUR</strong></div>
                            <div class="col-sm-4">
                                <b>Nota de Abono: </b>{{$devoluciones[$key][0]->fac_fecha."  ".$devoluciones[$key][0]->fac_numero}}
                            </div>
                            <div class="col-sm-2">
                             <a class="slink" href="javascript: openfacwnd(\'abono.php?opr_id='.<?php echo $opr_id;?>.'&fac_id='<?php $devoluciones[$key][0]->fac_id?>'\');">Ver</a>
                             <a class="slink" href="#" onClick="document.edtfac.fac_id.value='<?php $devoluciones[$key][0]->fac_id?>'; document.edtfac.extrafac.value=1; document.edtfac.pag_tipo.value=4; document.edtfac.submit();">Editar</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-right" style="padding:10px 20px 0px 20px;width:210px;margin-top:25px;">
                    <label class="text-danger" style="text-decoration:underline;margin:0">Total:</label>
                </div>
                <div class="" style="padding:10px 20px 0px 20px;width:200px;;margin-top:25px;">
                    {{ number_format($operacion->opr_pendiente, 2, '.', '') }}  EUR
                </div>
                <div class="col-sm-12"></div>
            </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">Resultados de la operación</div>
    </div>
    <div class="text-" style="padding:10px 20px 0px 20px;width:610px;    padding-left: 147px;">
         <label class="" style="text-decoration:underline;margin:0"><span class="text-danger">Curso</span> (Curso + Alojamiento + Suplementos + Transfer)</label>
    </div>
 
    <div class="col-sm-12"></div>
    <div class="text-right" style="padding:10px 20px 0px 20px;width:210px;;">
         <label class="" style="text-decoration:underline;margin:0">Precio:</label>
    </div>
    <div class="" style="padding:10px 20px 0px 20px;width:200px;">
     {{ number_format($precioTotal, 2, '.', '') }}  EUR
    </div>
    <div class="col-sm-12"></div>
    <div class="text-right" style="padding:10px 20px 0px 20px;width:210px;;">
         <label class="" style="text-decoration:underline;margin:0">Costes:</label>
    </div>
    <div class="" style="padding:10px 20px 0px 20px;width:200px;">
    {{ number_format($operacion->opr_ttl_coste+$operacion->vje_transfer_coste, 2, '.', '') }}  EUR
    </div>
    <div class="col-sm-12"></div>
    <div class="text-right" style="padding:10px 20px 0px 20px;width:210px;;">
         <label class="" style="text-decoration:underline;margin:0">Resultado:</label>
    </div>
    <div class="" style="padding:10px 20px 0px 20px;width:200px;">
    <?php
     $diff1=($precioTotal)-($operacion->opr_ttl_coste+$operacion->vje_transfer_coste);
    ?>
     {{ number_format($diff1, 2, '.', '') }}  EUR
    </div>
    <div class="col-sm-12"></div>
    <div class="text-" style="padding:10px 20px 0px 20px;width:610px;    padding-left: 147px;">
         <label class="" style="text-decoration:underline;margin:0"><span class="text-danger">Vuelo</span></label>
    </div>
 
    <div class="col-sm-12"></div>
    <div class="text-right" style="padding:10px 20px 0px 20px;width:210px;;">
         <label class="" style="text-decoration:underline;margin:0">Precio:</label>
    </div>
    <div class="" style="padding:10px 20px 0px 20px;width:200px;">
     {{ number_format($operacion->vje_vuelo_precio, 2, '.', '') }}  EUR
    </div>
    <div class="col-sm-12"></div>
    <div class="text-right" style="padding:10px 20px 0px 20px;width:210px;;">
         <label class="" style="text-decoration:underline;margin:0">Costes:</label>
    </div>
    <div class="" style="padding:10px 20px 0px 20px;width:200px;">
    {{ number_format($operacion->vje_vuelo_coste, 2, '.', '') }}  EUR
    </div>
    <div class="col-sm-12"></div>
    <div class="text-right" style="padding:10px 20px 0px 20px;width:210px;;">
         <label class="" style="text-decoration:underline;margin:0">Resultado:</label>
    </div>
    <div class="" style="padding:10px 20px 0px 20px;width:200px;">
    <?php
     $diff2=($operacion->vje_vuelo_precio-$operacion->vje_vuelo_coste);
    ?>
     {{ number_format($diff2, 2, '.', '') }}  EUR
    </div>
    <div class="col-sm-12"></div>
    <div class="text-right" style="padding:10px 20px 0px 20px;width:210px;;">
         <label class="text-danger" style="text-decoration:underline;margin:0">Resultado operación:</label>
    </div>
    <div class="" style="padding:10px 20px 0px 20px;width:200px;">
     {{ number_format($diff2+$diff1, 2, '.', '') }}  EUR
    </div>
    <div class="col-sm-12"></div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">Facturas Cobradas</div>
       
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
            <div class="row">
               @if(count($facturasCobradas)>0)
                <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($facturasCobradas as $f)
                            <tr>
                                <td>{{date_format(date_create($f->register_date),"i:h d-m-Y")}}</td>
                                <td>{{$f->monto}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
               @endif
               @if(count($facturasCobradas)==0)
                   <div class="font-weight-bold" style="padding-left:25px;">
                         No se ha facturado nada.
                   </div>
               @endif
            </div>
    </div>
    
</div>
<?php $route2 = route("operacion.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/operaciones/cobros.js'); }}"></script>   
@stop