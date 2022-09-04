@extends('../layouts.admin')
@section('content')  
<link href="{{ URL::asset('css/factura.css'); }}" rel="stylesheet">
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="section">
            <h5>Operaciones</h5>
        </div>
    </div>
</div>
<div class="row" style="margin-top:5px;">
    <div class="col-sm-6" style="padding-left:15px;">
        <a href='{{route("operacion.create")}}' class="btn btn-primary" style="margin-left:5px;height:35px;">
                <i class="fa fa-plus"></i> Nueva Operaci&oacuten
        </a>
    </div>
        <div class="col-sm-6 d-flex justify-content-end" style="margin-bottom:20px;height:35px;padding:0px 20px 0px 20px;">
            <form action='{{route("operacion.busquedaOperacion")}}' method="GET" class="d-flex"  style="margin: 0px;">
                @method("GET")
                @csrf
                <select name="limit" class="form-select" style="width:80px;">
                    <option <?php if($limit == 10){ echo "selected";}?>>10</option>
                    <option <?php if($limit == 15){ echo "selected";}?>>15</option>
                    <option <?php if($limit == 25){ echo "selected";}?>>25</option>
                    <option <?php if($limit == 50){ echo "selected";}?>>50</option>
                    <option <?php if($limit == 100){ echo "selected";}?>>100</option>
                </select>
                <input type="text" name="search" value="<?php echo $search;?>" class="form-control"  placeholder="Buscar..." style="margin-left:5px;width:67%"/>
                <select name="type" class="form-select" style="width:120px;margin-left:5px">
                    <option <?php if($type == 'Nombre'){ echo "selected";}?>>Nombre</option>
                </select>
                <button type="submit" class="btn btn-success" style="margin-left:5px">
                    <i class="fa fa-search"></i>
                </button>
                                            
                </form>
                <a href='{{route("operacion.index")}}' class="btn btn-primary" style="margin-left:5px">
                    <i class="fa fa-refresh"></i>
                </a>
            
        </div>
    @if(!empty($operaciones))
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">Resultados</div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
       
        <table class="table table-bordered" style="margin-bottom:3px;">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th style="width:75px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($operaciones as $key=>$o)
                    <tr>
                        <?php
                            $date = date_create($o->opr_fecha);

                            $formated_DATETIME = date_format($date, 'd/m/Y');
                        ?>
                        <td class="" >
                            <div class="row">
                                <div class="col-sm-12 mouse-event" data-toggle="collapse" data-target="#collapseExample<?php echo $key;?>" aria-expanded="false" aria-controls="collapseExample">
                                    {{$formated_DATETIME}} <strong>{{$o->alu_nombre." ".$o->alu_apellidos}}</strong>
                                </div> 
                            </div>
                            <div class="collapse" id="collapseExample<?php echo $key;?>">
                                <div class="card card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                </div>
                            </div>
                        </td>

                        <td  class="container" style="width: 75px;vertical-align: middle;text-align: center;">
                             <div class="row">
                                <div class="col-sm-12">
                                
                                </div>
                             </div>
                        </td>
                    
                    </tr>

                @endforeach
            </tbody>
        </table>
        
    </div>
    <div class="col-sm-12" style="padding:0px 20px 10px 20px;">
        {{ $operaciones->links('vendor.pagination.bootstrap-4') }}
    </div>
    @endif
</div>

<?php $route2 = route("pais.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/operaciones/list.js'); }}"></script>     
@stop