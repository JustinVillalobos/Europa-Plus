@extends('../layouts.admin')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <h5><i class="fa fa-book" aria-hidden="true"></i>{{$empresa->nombre}}</h5>
                </li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    <div class="col-sm-6 d-flex align-items-center" style="padding-left:15px;">
        <h1 style="margin:0;">Datos {{$empresa->nombre}}</h1><a href='{{route("europa.edit")}}' class="btn btn-primary" style="margin-left:5px;height:35px;">
                <i class="fa fa-plus"></i> Editar
        </a>
    </div>
    <div class="col-sm-6 d-flex justify-content-end" style="margin-bottom:20px;height:35px;padding:0px 20px 0px 20px;">
       
     
    </div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nombre:</label>
                 <div style="width:67%;" class="text-start">
                    {{$empresa->nombre}}
                </div>
             </div>
        </div>
    </div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Correo:</label>
                 <div style="width:67%;" class="text-start">
                    {{$empresa->correo}}
                </div>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:0px 20px 10px 20px;"></div>
    

    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Sitio web:</label>
                 <div style="width:67%;" class="text-start">
                    {{$empresa->sitio_web}}
                </div>
             </div>
        </div>
    </div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
        <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Teléfono:</label>
                 <div style="width:67%;" class="text-start">
                    {{$empresa->telefono}}
                </div>
             </div>
        </div>
    </div>
   
  
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            
             <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Whatsapp:</label>
                 <div style="width:67%;" class="text-start">
                    {{$empresa->whatsapp}}
                </div>
             </div>
        </div>
    </div>
   
    
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Código Postal:</label>
                 <div style="width:67%;" class="text-start">
                    {{$empresa->codigo_postal}}
                </div>
             </div>
        </div>
    </div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Dirección:</label>
                 <div style="width:67%;" class="text-start">
                    {{$empresa->direccion}}
                </div>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">DATOS DEL BANCO</div>
    </div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Banco:</label>
                 <div style="width:67%;" class="text-start">
                    {{$empresa->banco}}
                </div>
             </div>
        </div>
    </div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">IBAN:</label>
                 <div style="width:67%;" class="text-start">
                    {{$empresa->IBAN}}
                </div>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:0px 20px 10px 20px;"></div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">SWIFT/BIC:</label>
                 <div style="width:67%;" class="text-start">
                    {{$empresa->SWIFT}}
                </div>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:0px 20px 10px 20px;"></div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Dirección del Banco:</label>
                 <div style="width:67%;" class="text-start">
                    {{$empresa->direccion_banco}}
                </div>
             </div>
        </div>
    </div>
</div>
<?php $route2 = route("europa.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/europa/list.js'); }}"></script>       
@stop