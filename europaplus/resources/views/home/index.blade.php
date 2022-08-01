@extends('../layouts.cliente')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <h1>FORMULARIO DE REGISTRO EUROPAPLUS</h1>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <h2>Registro Completado</h2>
    </div>
    <div class="col-sm-12 d-flex justify-content-center" style="padding:10px 20px 0px 20px;">
        <img src="{{ URL::asset('assets/4tintas.jpg'); }}" />
    </div>
    
</div>
 
<script src="{{ URL::asset('js/alumnos/formulario.js'); }}"></script>     
@stop