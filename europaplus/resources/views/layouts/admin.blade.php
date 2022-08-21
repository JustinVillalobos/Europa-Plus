<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>EUROPAPLUS</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
        
        <link href="{{ URL::asset('plugins/bootstrap-4.6.2-dist/css/bootstrap.min.css'); }}" rel="stylesheet">
        <link href="{{ URL::asset('plugins/DataTables/datatables.min.css'); }}" rel="stylesheet">

        <script src="{{ URL::asset('plugins/jquery-3.6.0.min.js'); }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="{{ URL::asset('plugins/bootstrap-4.6.2-dist/js/bootstrap.min.js'); }}"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{ URL::asset('css/app.css'); }}" rel="stylesheet">
        <link href="{{ URL::asset('plugins/iconos/style.css'); }}" rel="stylesheet">
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        
       
    </head>
    <body class="antialiased">
        <div style="position:absolute;width:100%;">
        <header >
             <div class="row">
                <div class="col-sm-2">
                <img src="{{ URL::asset('assets/icono.png'); }}" style="width:220px;"/>
                </div>
                <div class="col-sm-8">
                    <img src="{{ URL::asset('assets/logo.png'); }}" />
                   <label> Aplicación Administrativa</label>
                </div>
                <div class="col-sm-2"></div>
             </div>
        </header>
        <nav class="d-flex align-items-center" style="padding: 0px 10px 0px 10px;">
             <div class="row w-100">
                <div class="col-sm-2 d-flex align-items-center justify-content-center text-center border-right">
                    <a href="./admin" class="text-white font-weight-bold"><i class="fa fa-cog" aria-hidden="true"></i> PANEL DE CONTROL</a>
                </div>
                <div class="col-sm-2 d-flex align-items-center justify-content-center text-center border-right">
                    <a href='{{route("alumno.create")}}' class="text-white font-weight-bold"><i class="i i-user-plus" aria-hidden="true"></i> Nuevo Alumno</a>
                </div>
                <div class="col-sm-2 d-flex align-items-center justify-content-center text-center border-right">
                    <a href="./nueva_operacion" class="text-white font-weight-bold"><i class="i i-user-plus" aria-hidden="true"></i> Nueva Operación</a>
                </div>
                <div class="col-sm-2 d-flex align-items-center justify-content-center text-center border-right">
                    <a href='{{route("alumno.index")}}' class="text-white font-weight-bold"><i class="fa fa-book" aria-hidden="true"></i> Datos Aplicación</a>
                </div>
                <div class="col-sm-2 d-flex align-items-center justify-content-center text-center border-right">
                    <a href="./admin" class="text-white font-weight-bold"><i class="i i-cogs" aria-hidden="true"></i> Herramientas</a>
                </div>
             </div>
        </nav>
        <div class="flex-container body" style="overflow-x: hidden;padding-bottom:25px;">
           <div class="row">
                <div class="col-sm-2" style="padding:25px 10px 0px 25px">
                    <div class="row" style="padding:0px 10px 0px 25px;">
                        <div class="card" >
                            <div class="card-header"><i class="fa fa-bookmark" aria-hidden="true"></i>Datos Aplicación</div>
                            <div class="card-body" style="padding-top: 5px;">
                                <ul style="padding-left: 0px;">
                                    <li><a href='{{route("alumno.index")}}'><i class="i i-database"></i> Alumnos</a></li>
                                    <li><a href="{{route('escuelas.index')}}"><i class="i i-database"></i> Escuelas</a></li>
                                    <li><a href="{{route('curso.index')}}"><i class="i i-database"></i> Cursos</a></li>
                                    <li><a href="{{route('alojamientos.index')}}"><i class="i i-database"></i> Alojamientos</a></li>
                                    <li><a href="{{route('suplementos.index')}}"><i class="i i-database"></i> Suplementos</a></li>
                                    <li><a href="{{route('pais.index')}}"><i class="i i-database"></i> Países</a></li>
                                    <li><a href="{{route('provincia.index')}}"><i class="i i-database"></i> Provincias</a></li>
                                    <li><a href="{{route('localidad.index')}}"><i class="i i-database"></i> Localidades</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    @section('content')
                
                    @show
                </div>
           </div>
        </div>
        <footer class="d-flex align-items-center text-white">
            <div class="row w-100">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 d-flex justify-content-center text-white font-weight-bold"> Copyright ©<?php echo date("Y")?></div>
                <div class="col-sm-3"></div>
            </div>
        </footer>
        </div>
        <div style="position:fixed;width:100%;height:100vh;" id="spinDiv">
            <div class="loader">
                <svg viewBox="0 0 120 120" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <circle class="load one" cx="60" cy="60" r="40" />
                    <circle class="load two" cx="60" cy="60" r="40" />
                    <circle class="load three" cx="60" cy="60" r="40" />
                    <g>
                    <circle class="point one" cx="45" cy="70" r="5" />
                    <circle class="point two" cx="60" cy="70" r="5" />
                    <circle class="point three" cx="75" cy="70" r="5" />
                    </g>
                </svg>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
        <script src="{{ URL::asset('plugins/sweetalert2/dist/sweetalert2.all.min.js'); }}"></script>
        <script src="{{ URL::asset('plugins/DataTables/datatables.min.js'); }}"></script>
        <script src="{{ URL::asset('js/Validaciones.js'); }}"></script>
        <script src="{{ URL::asset('js/alerts.js'); }}"></script>

    </body>
</html>