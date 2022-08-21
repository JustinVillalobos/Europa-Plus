@extends('../layouts.admin')
@section('content')  
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
                                <button type="submit" class="btn btn-danger" style="margin-left:5px;">
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

<?php $route2 = route("pais.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/pais/list.js'); }}"></script>    
@stop