@extends('../layouts.admin_operacion')
@section('content')  
<link rel="stylesheet" href="{{ URL::asset('plugins/sceditor/minified/themes/default.min.css'); }}" />

<script src="{{ URL::asset('plugins/sceditor/minified/sceditor.min.js'); }}"></script>
<script src="{{ URL::asset('plugins/sceditor/minified/icons/monocons.js'); }}"></script>
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
                <input type="text" class="form-control" id="reserva" />
            </div>
            <div class="" style="padding:10px 20px 0px 0px;width:400px;">
                <button class="btn btn-success" onclick="facturarReserva()">Facturar</button>
                <button class="btn btn-success" onclick="sinfacturarReserva()">Sin Facturar</button>
                
            </div>
    @endif
    <div class="col-sm-12"></div>
    @if($operacion->opr_pendiente>0)
        <div class="text-right" style="padding:10px 20px 0px 20px;width:210px">
            <label class="text-" style="text-decoration:underline;margin:0">Resto del curso: {{ number_format($operacion->opr_pendiente, 2, '.', '')}}</label>
        </div>
        <div class="" style="padding:10px 20px 0px 20px;width:130px;">
            @if(count($rspag_resto)>0)
            {{ number_format($pag_importe2->ttl, 2, '.', '')}} EUR
            @endif
            @if(count($rspag_resto)==0)
                0.00 EUR
            @endif
        </div>
        @if($numspagrs>=0 )
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
    <?php $total=$pag_importe->ttl+$pag_importe2->ttl+$pag_importe3->ttl+$operacion->opr_descuento?>
        {{ number_format($total, 2, '.', '')}} EUR
    </div>
    <div class="col-sm-12"></div>
    <div class="text-right" style="padding:10px 20px 0px 20px;width:210px">
        <label class="text-danger" style="text-decoration:underline;margin:0">Pendiente:</label>
    </div>
    <div class="" style="padding:10px 20px 0px 20px;width:200px;">
        <?php 
            if (count($rspag_devs)>0 ) {
                $pendiente=floatval($operacion->opr_pendiente)-floatval($pag_importe4->ttl);
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
        <?php echo '<b>'. $factura->fac_fecha .'</b>&nbsp;'. $factura->fac_numero .'&nbsp;<a class="slink" href="#"onclick="loadModal('.$factura->fac_id.','.$factura->fac_proforma.')">Ver</a>';?> 
        <br>
    @endforeach
    
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">Devoluciones</div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
            <div class="row">
                
                <div class="w-100">
                    <button  class="btn btn-info" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Nueva devolución </button>
                    <div class="collapse row" id="collapseExample" style="margin-top:15px">
                            
                            <div class="" style="width:100px">
                                <label>Devolución:</label>
                            </div>
                            <div class="" style="width:100px">
                                <input type="text" name="dev" id="dev" class="form-control"/>
                            </div>
                            <div class="" style="width:40px">
                                <label>EUR</label>
                            </div>
                            <div class="w-100" style="margin-top:15px;"></div>
                            <div class="" style="width:100px">
                                <label>Concepto:</label>
                            </div>
                            <div class="" style="width:300px;">
                                <textarea type="text" name="concepto" id="concepto" class="form-control w-100" style="min-height:150px;"></textarea>
                            </div>
                            <div class="w-100" style="margin-top:15px;"></div>
                            <div class="" style="width:270px;">
                                <button class="btn btn-success" onclick="abonarConFactura()">Abonar</button>
                                <button class="btn btn-success" onclick="abonarSinFactura()">Abonar sin factura</button>
                            </div>
                     </div>
                   
                </div>
                <div class="col-sm-12">

                    <div style="margin-top:10px;width:50%;border-bottom:1px solid;"></div>
                    <div class="row">
                        @foreach($rspag_devs as $key=>$dev)
                            <div class="col-sm-12"><strong>{{number_format($dev->pag_importe, 2, '.', '')}} EUR</strong></div>
                            <div class="col-sm-4">
                                <b>Nota de Abono: </b>{{$dev->factura->fac_fecha."  ".$dev->factura->fac_numero}}
                            </div>
                            <div class="col-sm-2">
                             <a class="slink" href="#" onclick="loadModal(<?php echo $dev->factura->fac_id?>,<?php echo $dev->factura->fac_proforma?>)">Ver</a>
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
               @if(count($rspag_resto)>0)
                <table class="table" style="width:200px;margin-left:20px;">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totalCobrado=0;?>
                        @foreach($rspag_resto as $f)
                            <?php $totalCobrado=$totalCobrado+$f->pag_importe;?>
                            <tr>
                                <td>{{$f->fac_fecha." ".$f->fac_id}}</td>
                                <td>{{$f->pag_importe}}</td>
                                <td><a href="#" onclick="loadModal(<?php echo $f->fac_id?>,<?php echo $f->fac_proforma?>)">Ver</a></td>
                            </tr>
                        @endforeach
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>{{$totalCobrado}}</strong></td>
                                
                            </tr>
                        </tbody>
                    </table>
               @endif
               @if(count($rspag_resto)==0)
                   <div class="font-weight-bold" style="padding-left:25px;">
                         No se ha facturado nada.
                   </div>
               @endif
            </div>
    </div>
    
</div>
@include('../operaciones/confirmaciones/ver_factura')
<?php $route2 = route("operacion.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<input type="hidden" value="{{$operacion->opr_id}}" id="fac_id" />
<script src="{{ URL::asset('js/operaciones/cobros.js'); }}"></script>   
<script src="{{ URL::asset('js/operaciones/facturas.js'); }}"></script>  
@stop