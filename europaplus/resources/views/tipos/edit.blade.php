@extends('../layouts.admin')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href='{{route("tipos.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Tipos</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Tipos</li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    
    

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">EDITAR TIPOS</div>
    </div>
    
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nombre:</label>
                 <input type="text" class="form-control" style="width:67%;" id="descr" value="{{$tipo->tipo_descripcion}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Subtipo:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="subtipo" >
                    <option value="0" <?php if($tipo->tipo_id ==0){echo "selected";}?>>Ambos</option>
                    <option value="1" <?php if($tipo->tipo_id ==1){echo "selected";}?>>Cursos</option>
                    <option value="2" <?php if($tipo->tipo_id ==2){echo "selected";}?>>Alojamientos</option>
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Reserva:</label>
                 <input type="text" class="form-control" style="width:67%;" id="prc" value="{{$tipo->tipo_porcentaje}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-6"></div>

    <div class="col-sm-6 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
        <input type="hidden" id="id" value="{{$tipo->tipo_id}}"/>
        <button class="btn btn-success">Aceptar</button>
        <button class="btn btn-warning text-white" style="margin-left:5px">Cancelar</button>
        <button class="btn btn-primary" style="margin-left:5px">Limpiar</button>
    </div>
</div>
<?php $route2 = route("tipos.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/tipos/edit.js'); }}"></script>     
@stop