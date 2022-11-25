@extends('../layouts.admin')
@section('content')  
<link href="{{ URL::asset('css/factura.css'); }}" rel="stylesheet">
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="section">
            <h5>Reportes</h5>
        </div>
    </div>
</div>
<div class="row" style="margin-top:5px;">
    <form action='{{route("reporte.busqueda")}}' method="GET" class="row d-flex"  style="margin: 0px;">
            @method("GET")
            @csrf
        <div class="col-sm-8" style="padding:10px 20px 0px 20px;">
            <input type="hidden" class="form-control" style="width:67%;" id="c" name="c" value="0"/>
                <div class="row">
                    <div class="col-sm-12 form-inline text-end">
                        <label class=" font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Número Factura:</label>
                        <input type="text" class="form-control" style="width:67%;" id="num" name="num" value="{{$num}}"/>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                <div class="row" style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class=" font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Importe Factura:</label>
                        <input type="text" class="form-control" style="width:67%;" id="imp" name="imp" value="{{$imp}}"/>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                <div class="row" style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class=" font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Fecha Emisión ( de-a ):</label>
                        <input type="date" class="form-control" style="width:33%;" id="init" name="init" value="{{$init}}"/>
                        <input type="date" class="form-control" style="width:33%;margin-left:1%;" id="init" name="end" value="{{$end}}"/>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
            
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-8 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
            <button type="submit" class="btn btn-success">Aceptar</button>
            <a href='{{route("reporte.index")}}' class="btn btn-warning text-white" style="margin-left:5px">Reiniciar</a>
        </div>
    </form>
    @if(!empty($facturas))
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">Resultados</div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
       
        <table class="table table-bordered" style="margin-bottom:3px;">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Serie/Número</th>
                    <th>Nombre</th>
                    <th>Concepto</th>
                    <th>Importe</th>
                    <th style="width:75px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facturas as $f)
                    <tr>
                        <td>{{$f->fac_fecha}}</td>
                        <td>{{$f->fac_numero}}</td>
                        <td>{{$f->fac_nombre}} {{$f->fac_apellidos}}</td>
                        <td>{!! $f->fac_concepto !!}</td>
                        <td>{{number_format($f->fac_cantidad, 2, '.', ',')}}€</td>
                        <td  class="container" style="width: 75px;vertical-align: middle;text-align: center;">
                             <div class="row">
                                <div class="col-sm-12">
                                <button type="submit" class="btn btn-danger" style="margin-left:5px;" onclick="loadModal({{$f->fac_id}},{{$f->fac_proforma}})">
                                    <i class="fa fa-file-pdf-o "></i>
                                </button>
                                </div>
                             </div>
                        </td>
                    
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    <div class="col-sm-12" style="padding:0px 20px 10px 20px;">
        {{ $facturas->links('vendor.pagination.bootstrap-4') }}
    </div>
    @endif
</div>
<div class="modal fade  " id="modal" >
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Factura</h4>
        <button type="button" class="close" data-dismiss="modal" style="font-size: 24px;" onclick="closeModal()">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="overflow-y: auto;overflow-x: auto;">
        <div class="row">
                <div class="col-sm-12">
                    <div class="paper">
                    <div class="paper" id="paper">
                     @include("../operaciones/confirmaciones/mails/header")
   
                        <div class="row" style="margin-top:25px;">
                            <div class="col-sm-12" style="padding-left:25px;padding-right:15px">
                                <div class="line"></div>
                            </div>
                            <div class="col-sm-12" style="padding-left:30px;padding-right:25px;margin-top:15px;">
                                <div class="row">
                                    <div class="col-sm-7 bordered-data">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <strong>Nombre:</strong>
                                            </div>
                                            <div class="col-sm-9" id="nombre">
                                               
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Apellidos:</strong>
                                            </div>
                                            <div class="col-sm-9" id="apellidos">
                                                
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Direcci&oacuten:</strong>
                                            </div>
                                            <div class="col-sm-9" id="dir">
                                               
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>CP:</strong>
                                            </div>
                                            <div class="col-sm-9" id="cp">
                                              
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Localidad:</strong>
                                            </div>
                                            <div class="col-sm-9" id="loc">
                                               
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Provincia:</strong>
                                            </div>
                                            <div class="col-sm-9" id="prv">
                                               
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Pa&iacutes:</strong>
                                            </div>
                                            <div class="col-sm-9" id="pais">
                                               
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>NIF:</strong>
                                            </div>
                                            <div class="col-sm-9" id="nif">
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" style="padding-left:30px;padding-right:30px;margin-top:15px;">
                                <div class="row">
                                    <div class="col-sm-12 bordered-data2">
                                        <div class="row">
                                            <div class="col-sm-12 d-flex justify-content-end">
                                               <label class="date_"> Madrid, a <?php echo  date('d')?> de <span id='mes'></span> <?php echo date('Y');?></label>
                                            </div>
                                            <div class="col-sm-12">
                                               <label class="fac_info"><strong style="text-transform:uppercase;">FACTURA No: </strong> <span id='numero'></span></label> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 bordered-data3">
                                        <div class="row header-border">
                                            <div class="col-sm-9 text-center">Concepto</div>
                                            <div class="col-sm-3 text-center">Importe</div>
                                        </div>
                                        <div class="row body-border">
                                            <div class="col-sm-9 " id="text-body"></div>
                                            <div class="col-sm-9 " id="text-body2" style="display:none">
                                                    <textarea id="editable_textarea"></textarea>
                                            </div>
                                            <div class="col-sm-3 text-center" id="importe"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 bordered-data4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>Alumno:</strong>
                                            </div>
                                            <div class="col-sm-12 bg-total">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <strong>Total</strong>
                                                            </div>
                                                            <div class="col-sm-2 text-end">
                                                                <label><strong><span id="total"></span> EUR</strong></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 text-center">
                                                        IVA incluido, R&eacutegimen especial Agencias de viaje CICMA 4280
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 bordered-data5">
                                        <div class="row">
                                            <div class="col-sm-12"><strong>Transferencia Bancaria: </strong> <?php echo $_SESSION['empresa']->nombre;?></div>
                                            <div class="col-sm-12"><?php echo $_SESSION['empresa']->banco;?></div>
                                            <div class="col-sm-12"><?php echo $_SESSION['empresa']->direccion_banco;?></div>
                                            <div class="col-sm-12">IBAN: <?php echo $_SESSION['empresa']->IBAN;?></div>
                                            <div class="col-sm-12">SWIFT/BIC: <?php echo $_SESSION['empresa']->SWIFT;?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="fac_id" value="0"/>
                    </div>
                </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-primary btn-modal" data-dismiss="modal" style="margin-left:5px;"  onclick="printFactura(true)"><i class="fa fa-save"></i> Imprimir</button>
        <button type="button" class="btn btn-danger btn-modal" data-dismiss="modal" onclick="closeModal()">Cerrar</button>
      </div>

    </div>
  </div>
</div>
<?php $route2 = route("reporte.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
  <script src="https://unpkg.com/jspdf-autotable@3.5.22/dist/jspdf.plugin.autotable.js"></script>
  <script src="{{ URL::asset('js/operaciones/modales/header.js'); }}"></script>  
<script src="{{ URL::asset('js/reporte/generate.js'); }}"></script>    
@stop