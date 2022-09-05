@extends('../layouts.admin')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='{{route("curso.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Cursos</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Agregar Cursos</li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    
    

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">NUEVO CURSO - PASO 2</div>
    </div>
    <form action='{{route("operacion.create")}}' method="POST"   style="margin: 0px;">
                @method("POST")
                @csrf
                <input type='hidden' value="2" name="step">
        <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
            <div class="row">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Fecha:</label>
                    <input type="date" class="form-control" style="width:67%;" name="fecha" id="fecha" value="<?php echo date('Y-m-d') ?>"/>
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
        </div>
    
  
    <div class="col-sm-6 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
        <button type="submit" class="btn btn-success">Aceptar</button>
        <button class="btn btn-warning text-white" style="margin-left:5px">Cancelar</button>
        <button class="btn btn-primary" style="margin-left:5px">Limpiar</button>
    </div>
    </form>
</div>
<?php $route2 = route("operacion.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/operaciones/add.js'); }}"></script>     
@stop