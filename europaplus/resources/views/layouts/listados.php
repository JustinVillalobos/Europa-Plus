@extends('../layouts.admin')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="section">
            <h5>Alumnos</h5>
        </div>
    </div>
</div>
<div class="row" style="margin-top:5px;">
    <div class="col-sm-12 d-flex justify-content-end" style="margin-bottom:20px;height:35px;padding:0px 20px 0px 20px;">
        <form action='{{route("alumno.busqueda")}}' method="GET" class="d-flex"  style="margin: 0px;">
            @method("GET")
            @csrf
            <select name="limit" class="form-control" style="width:60px;">
                <option <?php if($limit == 10){ echo "selected";}?>>10</option>
                <option <?php if($limit == 15){ echo "selected";}?>>15</option>
                <option <?php if($limit == 25){ echo "selected";}?>>25</option>
                <option <?php if($limit == 50){ echo "selected";}?>>50</option>
                <option <?php if($limit == 100){ echo "selected";}?>>100</option>
            </select>
            <input type="text" name="search" value="<?php echo $search;?>" class="form-control"  placeholder="Buscar..." style="margin-left:5px;width:67%"/>
            <select name="type" class="form-control" style="width:120px;margin-left:5px">
                <option <?php if($type == 'Nombre'){ echo "selected";}?>>Nombre</option>
                <option <?php if($type == 'Apellidos'){ echo "selected";}?>>Apellidos</option>
                <option <?php if($type == 'Idioma'){ echo "selected";}?>>Idioma</option>
                <option <?php if($type == 'Pais'){ echo "selected";}?>>País</option>
            </select>
            <button type="submit" class="btn btn-success" style="margin-left:5px">
                <i class="fa fa-search"></i>
            </button>
                                        
        </form>
        <a href="/alumno" class="btn btn-primary" style="margin-left:5px">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <table class="table table-bordered" style="margin-bottom:3px;">
            <thead>
                <tr>
                    <th>Apelldios</th>
                    <th>Nombre</th>
                    <th>Fecha Nacimiento</th>
                    <th>Idioma</th>
                    <th>País</th>
                    <th style="width:75px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alumnos as $nivel)
                    <tr>
                        <td>{{$nivel->alu_apellidos}}</td>
                        <td>{{$nivel->alu_nombre}}</td>
                        <td>{{$nivel->alu_fecha_nacim}}</td>
                        <td>{{$nivel->opc_descr}}</td>
                        <td>{{$nivel->pais_descr}}</td>
                        <td style="width:125px;" class="d-flex justify-content-center">
                            <form action='{{route("alumno.show", [$nivel])}}' method="post" >
                                @method("get")
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </form>
                            <form action='{{route("alumno.edit", [$nivel])}}' method="post" >
                                @method("get")
                                @csrf
                                <button type="submit" class="btn btn-warning" style="margin-left:5px;">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </form>
                            <form action='{{route("alumno.destroy", [$nivel])}}' method="post" >
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
        {{ $alumnos->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

           
@stop