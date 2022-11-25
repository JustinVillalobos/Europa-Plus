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
    <form action='{{route("operacion.create")}}' method="POST"   style="margin: 0px;">
                        @method("POST")
                        @csrf
        <a href="#" onclick="this.parentNode.submit();"  class="btn btn-primary" style="margin-left:5px;height:35px;">
                <i class="fa fa-plus"></i> Nueva Operaci&oacuten
        </a>
        </form>
    </div><div class="col-sm-6" style="padding-left:15px;"></div>
        <div class="col-sm- 12" style="padding:0px 20px 0px 20px;">
            <form action='{{route("operacion.busquedaOperacion")}}' method="GET"    style="margin: 0px;">
                @method("GET")
                @csrf
                <div class="row">
                    <div class="col-sm-12 filter" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <span><i class="fa fa-filter" aria-hidden="true"></i></span> Filtros
                    </div>
                </div>
                <div class="row collapse justify-content-center" id="collapseExample">
                    <div class="col-sm-6">
                        <div class="row">
                        <div class="col-sm-3" style="margin-top: 15px;">
                        <select name="limit" class="form-select " >
                                <option <?php if($limit == 10){ echo "selected";}?>>10</option>
                                <option <?php if($limit == 15){ echo "selected";}?>>15</option>
                                <option <?php if($limit == 25){ echo "selected";}?>>25</option>
                                <option <?php if($limit == 50){ echo "selected";}?>>50</option>
                                <option <?php if($limit == 100){ echo "selected";}?>>100</option>
                            </select>
                    </div>
                    <div class="col-sm-9"  style="margin-top: 15px;">
                        <input type="text" name="search" value="<?php echo $search;?>" class="form-control"  placeholder="Buscar..." />
                    </div>
                    <div class="col-sm-12"  style="margin-top: 15px;">
                        <label>Operaciones</label>
                        <select class="form-select" name="tipo">
                            <option value="0" <?php if($tipo == 0){ echo "selected";}?>>Activas</option>
                            <option value="1" <?php if($tipo == 1){ echo "selected";}?>>Pendientes Señal</option>
                            <option value="2" <?php if($tipo == 2){ echo "selected";}?>>Pendientes Resto</option>
                            <option value="3" <?php if($tipo == 3){ echo "selected";}?>>Terminadas</option>
                            <option value="4" <?php if($tipo == 4){ echo "selected";}?>>Pendientes Confirmar Escuela</option>
                            <option value="5" <?php if($tipo == 5){ echo "selected";}?>>Pendientes Confirmar Alumno</option>
                            <option value="6" <?php if($tipo == 6){ echo "selected";}?>>Canceladas</option>
                        </select>
                    </div>
                    <div class="col-sm-12"  style="margin-top: 15px;">
                        <label>Ejercicio</label>
                        <select class="form-select" name="date">
                            <option value="<?php echo date('Y',strtotime('+1 year'));?>"  <?php if($date == date('Y',strtotime('+1 year'))){ echo "selected";}?>><?php echo date('Y',strtotime('+1 year'));?> </option>
                            <option value="<?php echo date('Y');?>"  <?php if($date == date('Y')){ echo "selected";}?>><?php echo date('Y');?></option>
                            <option value="<?php echo date('Y',strtotime('-1 year'));?>"  <?php if($date == date('Y',strtotime('-1 year'))){ echo "selected";}?>><?php echo date('Y',strtotime('-1 year'));?></option>
                        </select>
                    </div>
                    <div class="col-sm-12"  style="margin-top: 15px;">
                        <label>Ordenadas</label>
                        <select class="form-select" name="order">
                            <option value="0" <?php if($order ==4 ){ echo "selected";}?>>Código Operación</option>
                            <option value="1" <?php if($order == 0){ echo "selected";}?>>Fechas Cursos</option>
                            <option value="2" <?php if($order == 1){ echo "selected";}?>>Fecha Inscripción</option>
                            <option value="3" <?php if($order == 2){ echo "selected";}?>>Apellidos Alumno</option>
                            <option value="4" <?php if($order ==3 ){ echo "selected";}?>>Escuela</option>
                        </select>
                    </div>
                    <div class="col-sm-12 d-flex justify-content-end" style="margin-top: 15px;">
                        <button type="submit" class="btn btn-success" style="margin-left:5px">
                            <i class="fa fa-search"></i>
                        </button>  
                        <a href='{{route("operacion.index")}}' class="btn btn-primary" style="margin-left:5px">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                        </div>
                    </div>
                </div>
                           
                    
                   
                                        
                </form>
                
                
            
        </div>
    @if(!empty($operaciones))

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
       
        <table class="table table-bordered" style="margin-bottom:3px;">
            <thead>
                <tr>
                    <th></th>
                    
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
                            <div class="row" style="font-size:18px;">
                                <div class="col-sm-12 " >
                                    <div class="row">
                                        <div class="col-sm-10 mouse-event" data-toggle="collapse" data-target="#collapseExample<?php echo $key;?>" aria-expanded="false" aria-controls="collapseExample">
                                            {{$formated_DATETIME}} <strong>{{$o->alu_nombre." ".$o->alu_apellidos}}</strong>
                                        </div>
                                        <div class="col-sm-2 d-flex justify-content-center"> 
                                            <form action='{{route("operacion.edits", [$o])}}' method="post" >
                                                @method("get")
                                                @csrf
                                                <button type="submit" class="btn btn-warning text-white" style="margin-left:5px;">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </form>
                                            <form action='{{route("operacion.destroy", [$o])}}' method="post" onsubmit="return validate(event,this,{{$o->opr_id}})">
                                                @method("delete")
                                                @csrf
                                                <button type="submit" class="btn btn-danger" style="margin-left:5px;">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="collapse" id="collapseExample<?php echo $key;?>">
                                <div class="card card-body">
                                  @include('../operaciones/operacion')
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
@include("../operaciones/confirmaciones/descripcion")
@include("../operaciones/confirmaciones/confirmacion")
@include("../operaciones/confirmaciones/confirmacion_condicionada")
<?php $route2 = route("operacion.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/operaciones/list.js'); }}"></script>     
@stop