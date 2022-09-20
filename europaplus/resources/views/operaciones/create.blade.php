@extends('../layouts.admin_empty')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='{{route("operacion.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Operaciones</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Agregar Operaci&oacuten</li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    
    

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">NUEVA OPERACIÓN - PASO 1 - DATOS ESTUDIANTE</div>
    </div>
    <form action='{{route("operacion.create")}}' method="POST"   style="margin: 0px;" onsubmit="return validateStep1()">
                @method("POST")
                @csrf
                <input type='hidden' value="<?php echo $isClear;?>" id="isClear" name="isClear">
                <input type='hidden' value="1" id="step" name="step">
        <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
            <div class="row">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Fecha:</label>
                    @if(empty($fecha))
                    <input type="date" class="form-control" style="width:67%;" name="fecha" id="fecha" value="<?php echo date('Y-m-d') ?>"/>
                    @endif
                    @if(!empty($fecha))
                    <input type="date" class="form-control" style="width:67%;" name="fecha" id="fecha" value="<?php echo $fecha; ?>"/>
                    @endif
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end ">
                    <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Alumnos:</label>
                    <select id="alumnos" name="alumnos" style="width:67%;">
                        @foreach($alumnos as $a)
                            <option value="{{$a->alu_id}}"  <?php if($alumno==$a->alu_id){echo "selected";}?>>{{$a->alu_nombre." ".$a->alu_apellidos}}</option>
                        @endforeach
                    </select>
                   
                </div>
                <div class="col-sm-12 d-flex justify-content-end text-end">
                    <span class="text-danger" id="spanalu" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end ">
                    <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Escuelas:</label>
                    <select id="escuelas" name="escuelas" style="width:67%;">
                        @foreach($escuelas as $e)
                            <option value="{{$e->esc_id}}" <?php if($escuela==$e->esc_id){echo "selected";}?>>{{$e->esc_nombre}}</option>
                        @endforeach
                    </select>
                   
                </div>
                <div class="col-sm-12 d-flex justify-content-end text-end">
                    <span class="text-danger" id="spanescu" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end ">
                    <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Vuelo/Transfer:</label>
                    <select id="vuelo" name="vuelo" style="width:67%;">
                        <option value="0" <?php if($vuelo=="0"){echo "selected";}?>>Si</option>
                        <option value="1" <?php if($vuelo=="1"){echo "selected";}?>>No</option>
                    </select>
                   
                </div>
                <div class="col-sm-12 d-flex justify-content-end text-end">
                    <span class="text-danger" id="spanvu" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
        </div>
    
  
    <div class="col-sm-6 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
        <button type="submit" class="btn btn-success">Siguiente</button>
        <button class="btn btn-warning text-white" style="margin-left:5px">Cancelar</button>
        <button type="button"class="btn btn-primary" style="margin-left:5px" onclick="clearStep1()">Limpiar</button>
    </div>
    </form>
</div>
<?php $route2 = route("operacion.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/operaciones/add.js'); }}"></script>     
@stop