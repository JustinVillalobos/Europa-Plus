@extends('../layouts.admin')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href='{{route("localidad.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Localidades</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Localidad</li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    
    

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">EDITAR LOCALIDAD</div>
    </div>
    
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nombre:</label>
                 <input type="text" class="form-control" style="width:67%;" id="descr" value="{{$localidad->loc_descr}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">País:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="paises" value="{{$localidad->pais_id}}">
                    @foreach($paises as $pais)
                        @if($pais->pais_id!=7)
                            <option value="{{$pais->pais_id}}" <?php if($pais->pais_id ==$localidad->pais_id){echo "selected";}?>>{{$pais->pais_descr}}</option>
                        @endif
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Provincia:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="provincias" value="{{$localidad->prv_id}}">
                    @foreach($provincias as $provincia)
                         <option value="{{$provincia->prv_id}}" <?php if($provincia->pais_id ==$localidad->prv_id){echo "selected";}?>>{{$provincia->prv_descr}}</option>
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-6"></div>

    <div class="col-sm-6 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
        <input type="hidden" id="id" value="{{$localidad->loc_id}}"/>
        <button class="btn btn-success">Aceptar</button>
        <button class="btn btn-warning text-white" style="margin-left:5px">Cancelar</button>
        <button class="btn btn-primary" style="margin-left:5px">Limpiar</button>
    </div>
</div>
<?php $route2 = route("localidad.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/localidad/edit.js'); }}"></script>     
@stop