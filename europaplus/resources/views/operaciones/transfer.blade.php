@extends('../layouts.admin')
@section('content')  

<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='{{route("operacion.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Operaciones</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Trasnferencia</li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="section">
            <h5>Informaci&oacuten transferencia</h5>
        </div>
    </div>
</div>
<div class="row" style="margin-top:5px;">
    <div class="col-sm-6" style="padding-left:15px;">
    </div>
</div>

<?php $route2 = route("operacion.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/operaciones/list.js'); }}"></script>     
@stop