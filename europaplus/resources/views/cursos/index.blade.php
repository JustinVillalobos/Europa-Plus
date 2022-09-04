@extends('../layouts.admin')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <h5><i class="fa fa-book" aria-hidden="true"></i>Cursos</h5>
                </li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    <div class="col-sm-6" style="padding-left:15px;">
        <a href='{{route("curso.create")}}' class="btn btn-primary" style="margin-left:5px;height:35px;">
                <i class="fa fa-plus"></i> Agregar Curso
        </a>
    </div>
    <div class="col-sm-6 d-flex justify-content-end" style="margin-bottom:20px;height:35px;padding:0px 20px 0px 20px;">
        <form action='{{route("curso.busqueda")}}' method="GET" class="d-flex"  style="margin: 0px;">
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
                <option value="Nombre"<?php if($type == 'Nombre'){ echo "selected";}?>>Nombre</option>
                <option value="tipo"<?php if($type == 'tipo'){ echo "selected";}?>>Tipo</option>
            </select>
            <button type="submit" class="btn btn-success" style="margin-left:5px">
                <i class="fa fa-search"></i>
            </button>
                                        
        </form>
        <a href='{{route("curso.index")}}' class="btn btn-primary" style="margin-left:5px">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <table class="table table-bordered" style="margin-bottom:3px;">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Descripción Inglés</th>
                    <th>Tipo</th>
                    <th style="width:75px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cursos as $nivel)
                    <tr>
                    <td>{{$nivel->cur_nombre}}</td>
                        <td>{{$nivel->cur_descr_en}}</td>
                        <td>{{$nivel->tipo_descripcion}}</td>
                        <td style="width:125px;" class="d-flex justify-content-center">
                            
                            <form action='{{route("curso.edit", [$nivel])}}' method="post" >
                                @method("get")
                                @csrf
                                <button type="submit" class="btn btn-warning text-white" style="margin-left:5px;">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </form>
                            <form action='{{route("curso.destroy", [$nivel])}}' method="post" onsubmit="return validate(event,this,{{$nivel->cur_id}})">
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
        {{ $cursos->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
<?php $route2 = route("curso.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/cursos/list.js'); }}"></script>       
@stop