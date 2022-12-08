@extends('../layouts.admin')
@section('content')  
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <h5><i class="fa fa-book" aria-hidden="true"></i>Links</h5>
                </li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
  
    <div class="col-sm-6 d-flex justify-content-end" style="margin-bottom:20px;height:35px;padding:0px 20px 0px 20px;">
      
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <table class="table table-bordered" style="margin-bottom:3px;">
            <thead>
                <tr>
                    <th>Link</th>
                    <th style="width:75px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
               <tr>
                <td>Formulario Junior</td>
                <td>
                    <?php $route = route("formularios.index")."/junior"?>
                                <button type="submit" class="btn btn-info text-white" style="margin-left:5px;width:25px;height:29px;" onclick='link("<?php echo $route;?>")'>
                                    <i class="fa fa-link"></i>
                                </button>
                </td>
               </tr>
               <tr>
                <td>Formulario Adultos</td>
                <td>
                    <?php $route = route("formularios.index")."/junior"?>
                                <button type="submit" class="btn btn-info text-white" style="margin-left:5px;width:25px;height:29px;" onclick='link("<?php echo $route;?>")'>
                                    <i class="fa fa-link"></i>
                                </button>
                </td>
               </tr>
               <tr>
                <td>Formulario Trimestre escolar</td>
                <td>
                    <?php $route = route("formularios.index")."/junior"?>
                                <button type="submit" class="btn btn-info text-white" style="margin-left:5px;width:25px;height:29px;" onclick='link("<?php echo $route;?>")'>
                                    <i class="fa fa-link"></i>
                                </button>
                </td>
               </tr>
               <tr>
                <td>Formulario Trimestre escolar + Tenis FTM</td>
                <td>
                    <?php $route = route("formularios.index")."/junior"?>
                                <button type="submit" class="btn btn-info text-white" style="margin-left:5px;width:25px;height:29px;" onclick='link("<?php echo $route;?>")'>
                                    <i class="fa fa-link"></i>
                                </button>
                </td>
               </tr>
               <tr>
                <td>Formulario Año escolar</td>
                <td>
                    <?php $route = route("formularios.index")."/junior"?>
                                <button type="submit" class="btn btn-info text-white" style="margin-left:5px;width:25px;height:29px;" onclick='link("<?php echo $route;?>")'>
                                    <i class="fa fa-link"></i>
                                </button>
                </td>
               </tr>
               <tr>
                <td>Formulario Año escolar + Tenis FTM</td>
                <td>
                    <?php $route = route("formularios.index")."/junior"?>
                                <button type="submit" class="btn btn-info text-white" style="margin-left:5px;width:25px;height:29px;" onclick='link("<?php echo $route;?>")'>
                                    <i class="fa fa-link"></i>
                                </button>
                </td>
               </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12" style="padding:0px 20px 10px 20px;">
        
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ URL::asset('js/pais/list.js'); }}"></script>       
<script>
    function link(codigo){
        navigator.clipboard.writeText(codigo)
        .then(() => {
            toastr["success"]("Link copiado")

            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
            console.log("Text copied to clipboard...")
        })
            .catch(err => {
            console.log('Something went wrong', err);
        });
    }
</script>
@stop