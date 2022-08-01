@extends('../layouts.admin')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <h5><i class="fa fa-book" aria-hidden="true"></i>localidades</h5>
                </li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    <div class="col-sm-6" style="padding-left:15px;">
        <a href="/localidad/create" class="btn btn-primary" style="margin-left:5px;height:35px;">
                <i class="fa fa-plus"></i> Agregar localidad
        </a>
    </div>
    <div class="col-sm-6 d-flex justify-content-end" style="margin-bottom:20px;height:35px;padding:0px 20px 0px 20px;">
        <form action='{{route("localidad.busqueda")}}' method="GET" class="d-flex"  style="margin: 0px;">
            @method("GET")
            @csrf
            <select name="limit" class="form-select" style="width:80px;">
                <option <?php if($limit == 10){ echo "selected";}?>>10</option>
                <option <?php if($limit == 15){ echo "selected";}?>>15</option>
                <option <?php if($limit == 25){ echo "selected";}?>>25</option>
                <option <?php if($limit == 50){ echo "selected";}?>>50</option>
                <option <?php if($limit == 100){ echo "selected";}?>>100</option>
            </select>
            <input type="text" name="search" value="<?php echo $search;?>" class="form-control"  placeholder="Buscar..." style="margin-left:5px;width:67%"/>
            <select name="type" class="form-select" style="width:120px;margin-left:5px">
                <option <?php if($type == 'Nombre'){ echo "selected";}?>>Nombre</option>
                <option value="Pais"<?php if($type == 'Pais'){ echo "selected";}?>>Países</option>
                <option value="Provincias"<?php if($type == 'Provincias'){ echo "selected";}?>>Provincias</option>
            </select>
            <button type="submit" class="btn btn-success" style="margin-left:5px">
                <i class="fa fa-search"></i>
            </button>
                                        
        </form>
        <a href="/localidad" class="btn btn-primary" style="margin-left:5px">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <table class="table table-bordered" style="margin-bottom:3px;">
            <thead>
                <tr>
                    <th>Localidad</th>
                    <th>Provincia</th>
                    <th>País</th>
                    <th style="width:75px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($localidades as $nivel)
                    <tr>
                    <td>{{$nivel->loc_descr}}</td>
                        <td>{{$nivel->prv_descr}}</td>
                        <td>{{$nivel->pais_descr}}</td>
                        <td style="width:125px;" class="d-flex justify-content-center">
                            
                            <form action='{{route("localidad.edit", [$nivel])}}' method="post" >
                                @method("get")
                                @csrf
                                <button type="submit" class="btn btn-warning text-white" style="margin-left:5px;">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </form>
                            <form action='{{route("localidad.destroy", [$nivel])}}' method="post" onsubmit="return validate(event,this,{{$nivel->alu_id}})">
                                @method("delete")
                                @csrf
                                <button type="submit" class="btn btn-danger" style="margin-left:5px;">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-sm-12" style="padding:0px 20px 10px 20px;">
        {{ $localidades->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

<script src="{{ URL::asset('js/provincia/list.js'); }}"></script>       
@stop