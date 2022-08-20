@extends('../layouts.admin')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href='{{route("alumno.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Alumnos</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Agregar Alumno</li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">DATOS PERSONALES</div>
    </div>

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12 form-inline text-end">
                        <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nombre:</label>
                        <input type="text" class="form-control" style="width:66%;" id="nombre"/>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                <div class="row" style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;" >Fecha Nacimiento:</label>
                        <input type="date" class="form-control" style="width:45%;" id="fecha_nacim"/>
                        <label class="text-danger font-weight-bold" style="width:10%;justify-content: end; margin-right: 5px;">Edad:</label>
                        <input type="text" class="form-control" style="width:10%;" id="edad" disabled/>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                
                <div class="row" style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class=" font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">E-Mail:</label>
                        <input type="text" class="form-control" style="width:66%;" id="correo"/>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12 form-inline text-end">
                        <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Apellidos:</label>
                        <input type="text" class="form-control" style="width:66%;" id="apellidos"/>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                <div class="row" style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Sexo:</label>
                        <Select type="text" class="form-select " style="width:66%;" id="sexo">
                            <option value="0">Hombre</option>
                            <option value="1">Mujer</option>
                        </Select>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
               
                <div class="row" style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class="font-weight-bold" style="width:25%;justify-content: end; margin-right: 5px;">Pasaporte/DNI:</label>
                        <input type="text" class="form-control" style="width:30%;" id="pasaporte"/>
                        <label class="font-weight-bold" style="width:13%;justify-content: end; margin-right: 5px;">Cáduca:</label>
                        <input type="date" class="form-control" style="width:27%;" id="caduca"/>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">DIRECCIÓN [PRINCIPAL]</div>
    </div>
    
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Calle/Plaza:</label>
                 <input type="text" class="form-control" style="width:67%;" id="plaza"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">País:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="paises">
                    @foreach($paises as $pais)
                        @if($pais->pais_id!=7)
                            <option value="{{$pais->pais_id}}">{{$pais->pais_descr}}</option>
                        @endif
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Provincia:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="provincias">
                    @foreach($provincias as $provincia)
                         <option value="{{$provincia->prv_id}}">{{$provincia->prv_descr}}</option>
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Localidad:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="localidades">
                    @foreach($localidades as $localidad)
                         <option value="{{$localidad->loc_id}}">{{$localidad->loc_descr}}</option>
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">C. Postal:</label>
                 <input type="text" class="form-control" style="width:67%;" id="cPostal">
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Teléfono:</label>
                 <input type="text" class="form-control" style="width:67%;" id="tel"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">Otros Datos</div>
    </div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Idioma:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="idiomas">
                    @foreach($idiomas as $idioma)
                         <option value="{{$idioma->opc_id}}">{{$idioma->opc_descr}}</option>
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nivel Idioma:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="nivel_idioma">
                    <option value='1'>Principiante</option>
                    <option value='2'>Elemental</option>
                    <option value='3'>Intermedio Bajo</option>
                    <option value='4'>Intermedio</option>
                    <option value='5'>Intermedio Alto</option>
                    <option value='6'>Avanzado</option>
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Medio Contacto:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="medioContacto">
                    @foreach($medios as $m)
                         <option value="{{$m->opc_id}}">{{$m->opc_descr}}</option>
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Alergías:</label>
                 <input type="text" class="form-control" style="width:67%;" id="alergias">
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nombre Padre/Madre:</label>
                 <input type="text" class="form-control" style="width:67%;" id="nombrePadre">
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Tel. Padre/Madre:</label>
                 <input type="text" class="form-control" style="width:67%;" id="telPadre">
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-start">
                <label class="font-weight-bold" style="width:100%;justify-content: start; margin-left: 5%;">Observaciones:</label>
                 <textarea type="text" class="form-control" style="width:80%;margin-left: 5%;" id="comentarios"></textarea>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-12 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
        <button class="btn btn-success">Aceptar</button>
        <button class="btn btn-warning text-white" style="margin-left:5px">Cancelar</button>
        <button class="btn btn-primary" style="margin-left:5px">Limpiar</button>
    </div>
</div>
<?php $route2 = route("alumno.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/alumnos/add.js'); }}"></script>     
@stop