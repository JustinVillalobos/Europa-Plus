@extends('../layouts.admin')
@section('content')  

<?php 
$temp =explode("/",$alumno->alu_fecha_nacim);
if(strlen($alumno->alu_dni_fexp)>0){
    $tempExp =explode("/",$alumno->alu_dni_fexp);
}else{
    $tempExp = ["","",""];
}

?>
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href='{{route("alumno.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Alumnos</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Ver Alumno</li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">CAMBIAR ESTADO ALUMNO</div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12 form-inline text-end">
                        <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">ESTADO:</label>
                        <select class="form-select" value="{{$alumno->active}}" id="state" style="width:69%;">
                            <option value="1" <?php if($alumno->active==1){echo "selected";}?>>Activo</option>
                            <option value="2" <?php if($alumno->active==2){echo "selected";}?>>Inactivo</option>
                        </select>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                    <div class="col-sm-12 form-inline d-flex justify-content-end" style="margin-top:10px;">
                        <button class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">DATOS PERSONALES</div>
    </div>

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12 form-inline text-end">
                        <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nombre:</label>
                        <input type="text" class="form-control" style="width:66%;" id="nombre" value="{{$alumno->alu_nombre}}" disabled/>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                <div class="row" style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;" >Fecha Nacimiento:</label>
                        <input type="date" class="form-control" style="width:45%;" id="fecha_nacim" value="<?php echo $temp[2]."-".$temp[1]."-".trim($temp[0]) ?>" disabled/>
                        <label class="text-danger font-weight-bold" style="width:10%;justify-content: end; margin-right: 5px;">Edad:</label>
                        <input type="text" class="form-control" style="width:10%;" id="edad" value="{{$alumno->alu_edad}}" disabled/>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
               
                <div class="row" style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class=" font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">E-Mail:</label>
                        <input type="text" class="form-control" style="width:66%;" id="correo" value="{{$alumno->alu_email}}" disabled/>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12 form-inline text-end">
                        <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Apellidos:</label>
                        <input type="text" class="form-control" style="width:66%;" id="apellidos" value="{{$alumno->alu_apellidos}}" disabled/>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                <div class="row" style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Sexo:</label>
                        <Select type="text" class="form-select " style="width:66%;" id="sexo" value="{{$alumno->alu_sexo}}" disabled>
                            <option value="0" <?php if($alumno->alu_sexo ==0){echo "selected";}?>>Hombre</option>
                            <option value="1" <?php if($alumno->alu_sexo ==1){echo "selected";}?>>Mujer</option>
                        </Select>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
               
                <div class="row" style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class="font-weight-bold" style="width:25%;justify-content: end; margin-right: 5px;">Pasaporte/DNI:</label>
                        <input type="text" class="form-control" style="width:30%;" id="pasaporte" value="{{$alumno->alu_dni}}" disabled/>
                        <label class="font-weight-bold" style="width:13%;justify-content: end; margin-right: 5px;">Cáduca:</label>
                        <input type="date" class="form-control" style="width:27%;" id="caduca" value="<?php echo $tempExp[2]."-".$tempExp[1]."-".trim($tempExp[0]) ?>" disabled/>
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
                 <input type="text" class="form-control" style="width:67%;" id="plaza" value="{{$alumno->alu_direccion}}" disabled/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">País:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="paises" value="{{$alumno->pais_id}}" disabled>
                    @foreach($paises as $pais)
                        @if($pais->pais_id!=7)
                            <option value="{{$pais->pais_id}}" <?php if($alumno->pais_id ==$pais->pais_id){echo "selected";}?>>{{$pais->pais_descr}}</option>
                        @endif
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Provincia:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="provincias" value="{{$alumno->prv_id}}" disabled>
                    @foreach($provincias as $provincia)
                         <option value="{{$provincia->prv_id}}" <?php if($alumno->prv_id ==$provincia->prv_id){echo "selected";}?>>{{$provincia->prv_descr}}</option>
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Localidad:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="localidades" value="{{$alumno->loc_id}}" disabled>
                    @foreach($localidades as $localidad)
                         <option value="{{$localidad->loc_id}}" <?php if($alumno->loc_id ==$localidad->loc_id){echo "selected";}?>>{{$localidad->loc_descr}}</option>
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">C. Postal:</label>
                 <input type="text" class="form-control" style="width:67%;" id="cPostal" value="{{$alumno->alu_cp}}" disabled>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Teléfono:</label>
                 <input type="text" class="form-control" style="width:67%;" id="tel" value="{{$alumno->alu_telefono}}" disabled/>
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
                 <Select type="text" class="form-select" style="width:67%;" id="idiomas" value="{{$alumno->idi_id}}" disabled>
                    @foreach($idiomas as $idioma)
                         <option value="{{$idioma->opc_id}}" <?php if($alumno->idioma ==$idioma->opc_id){echo "selected";}?>>{{$idioma->opc_descr}}</option>
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nivel Idioma:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="nivel_idioma" value="{{$alumno->alu_nivel_idioma}}" disabled>
                    <option value='1' <?php if($alumno->alu_nivel_idioma ==1){echo "selected";}?>>Principiante</option>
                    <option value='2' <?php if($alumno->alu_nivel_idioma ==2){echo "selected";}?>>Elemental</option>
                    <option value='3' <?php if($alumno->alu_nivel_idioma ==3){echo "selected";}?>>Intermedio Bajo</option>
                    <option value='4' <?php if($alumno->alu_nivel_idioma ==4){echo "selected";}?>>Intermedio</option>
                    <option value='5' <?php if($alumno->alu_nivel_idioma ==5){echo "selected";}?>>Intermedio Alto</option>
                    <option value='6' <?php if($alumno->alu_nivel_idioma ==6){echo "selected";}?>>Avanzado</option>
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Medio Contacto:</label>
                 <Select type="text" class="form-select" style="width:67%;" id="medioContacto" value="{{$alumno->alu_medio_contacto}}" disabled>
                    @foreach($medios as $m)
                         <option value="{{$m->opc_id}}" <?php if($alumno->alu_medio_contacto ==$m->opc_id){echo "selected";}?>>{{$m->opc_descr}}</option>
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Alergías:</label>
                 <input type="text" class="form-control" style="width:67%;" id="alergias" value="{{$alumno->alu_alergias}}" disabled>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nombre Padre:</label>
                 <input type="text" class="form-control" style="width:67%;" id="nombrePadre" value="{{$alumno->alu_nombre_padre}}" disabled>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Tel. Padre:</label>
                 <input type="text" class="form-control" style="width:67%;" id="telPadre" value="{{$alumno->alu_tel_padre}}" disabled>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-start">
                <label class="font-weight-bold" style="width:100%;justify-content: start; margin-left: 5%;">Observaciones:</label>
                 <textarea type="text" class="form-control" style="width:80%;margin-left: 5%;" id="comentarios" disabled>{{$alumno->alu_comentarios}}</textarea>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-12 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
        <input type="hidden" value="{{$alumno->alu_id}}" id="id"/>
       
    </div>
</div>
<?php $route2 = route("alumno.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/alumnos/view.js'); }}"></script>  
@stop