@extends('../layouts.admin')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href='{{route("provincia.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Provincias</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Provincia</li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    
    

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">EDITAR PROVINCIA</div>
    </div>
    
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nombre:</label>
                 <input type="text" class="form-control" style="width:67%;" id="descr" value="{{$provincia->prv_descr}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">País:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="paises" value="{{$provincia->pais_id}}">
                    @foreach($paises as $pais)
                        @if($pais->pais_id!=7)
                            <option value="{{$pais->pais_id}}" <?php if($pais->pais_id ==$provincia->pais_id){echo "selected";}?>>{{$pais->pais_descr}}</option>
                        @endif
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-6"></div>

    <div class="col-sm-6 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
        <input type="hidden" id="id" value="{{$provincia->prv_id}}"/>
        <button class="btn btn-success">Aceptar</button>
        <button class="btn btn-warning text-white" style="margin-left:5px">Cancelar</button>
        <button class="btn btn-primary" style="margin-left:5px">Limpiar</button>
    </div>
</div>
 
<script src="{{ URL::asset('js/provincia/edit.js'); }}"></script>     
@stop