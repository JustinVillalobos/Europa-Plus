@extends('../layouts.admin_empty')
@section('content')  
<link rel="stylesheet" href="{{ URL::asset('plugins/sceditor/minified/themes/default.min.css'); }}" />

<script src="{{ URL::asset('plugins/sceditor/minified/sceditor.min.js'); }}"></script>
<script src="{{ URL::asset('plugins/sceditor/minified/icons/monocons.js'); }}"></script>
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='{{route("operacion.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Operaciones</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Agregar Operaci&oacuten</li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    
    

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">NUEVA OPERACIÓN - PASO 2 - DATOS DE VIAJE</div>
    </div>
    <form action='{{route("operacion.create")}}' method="POST" id="form"  class="row" style="margin: 0px;">
                @method("POST")
                @csrf
                <input type='hidden' value="<?php echo $isClear;?>" id="isClear" name="isClear">
                <input type='hidden' value="2" id="step"  name="step">
        <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
            <div class="row">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text-danger font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Curso:</label>
                    <select  class="form-select select"  style="width:67%;" id="cursos" name="cursos">
                    @foreach($cursos as $curso)
                        <option value="{{$curso->cur_id}}">{{$curso->cur_descr_en}}</option>
                    @endforeach
                    </select>
                    
                </div>
                <div class="col-sm-12 d-flex justify-content-center text-center">
                    <span class="text-danger" id="spancursos" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text-danger font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Fecha Inicio:</label>
                    <input type="date" class="form-control" style="width:67%;" name="fechaInit" id="fechaInit" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text-danger font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Fecha Fin:</label>
                    <input type="date" class="form-control" style="width:31%;" name="fechaEnd" id="fechaEnd" />
                    <label class="text-danger font-weight-bold" style="width:25%;justify-content: end; margin-right: 5px;">Nro. semanas:</label>
                    <input type="text" class="form-control" style="width:10%;" name="numSemanas" id="numSemanas" disabled/>
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text-danger font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Precio:</label>
                    <input type="text" class="form-control" style="width:67%;" name="price" id="price" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Suplem.[1]:</label>
                    <select  class="form-select select"  style="width:47%;" id="scursos" name="scursos">
                    @foreach($suplementos_cursos as $curso)
                        <option value="{{$curso->sup_id}}">{{$curso->sup_nombre}}</option>
                    @endforeach
                    </select>
                    <label class=" font-weight-bold" style="width:9%;justify-content: end; margin-right: 5px;">Precio:</label>
                    <input type="number" class="form-control" style="width:10%;" name="precios1" id="precios1" />
                </div>
                <div class="col-sm-12 d-flex justify-content-center text-center">
                    <span class="text-danger" id="spanscursos" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Suplem.[2]:</label>
                    <select  class="form-select select"  style="width:47%;" id="scursos2" name="scursos2">
                    @foreach($suplementos_cursos as $curso)
                        <option value="{{$curso->sup_id}}">{{$curso->sup_nombre}}</option>
                    @endforeach
                    </select>
                    <label class=" font-weight-bold" style="width:9%;justify-content: end; margin-right: 5px;">Precio:</label>
                    <input type="number" class="form-control" style="width:10%;" name="precios2" id="precios2" />
                </div>
                <div class="col-sm-12 d-flex justify-content-center text-center">
                    <span class="text-danger" id="spanscursos" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Suplem.[3]:</label>
                    <select  class="form-select select"  style="width:47%;" id="scursos3" name="scursos3">
                    @foreach($suplementos_cursos as $curso)
                        <option value="{{$curso->sup_id}}">{{$curso->sup_nombre}}</option>
                    @endforeach
                    </select>
                    <label class=" font-weight-bold" style="width:9%;justify-content: end; margin-right: 5px;">Precio:</label>
                    <input type="number" class="form-control" style="width:10%;" name="precios3" id="precios3" />
                </div>
                <div class="col-sm-12 d-flex justify-content-center text-center">
                    <span class="text-danger" id="spanscursos" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
             <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Descuento:</label>
                    <input type="number" class="form-control" style="width:22%;" name="desc" id="desc" />
                    <label class=" font-weight-bold" style="width:45%;justify-content: end; margin-right: 5px;font-size:12px">(En euros, aplicables al curso + Alojamiento)</label>
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">A pagar:</label>
                    <input type="number" class="form-control" style="width:22%;" name="apagar" id="apagar" />
                   
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Pagado:</label>
                    <input type="number" class="form-control" style="width:22%;" name="desc" id="desc" />
                    <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Fecha</label>
                    <input type="date" class="form-control" style="width:28%;" name="fechaPagado" id="fechaPagado" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
        </div>
            <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
                <div class="row">
                    <div class="col-sm-12 form-inline text-end">
                        <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Alojamiento:</label>
                        <select  class="form-select select"  style="width:67%;" id="alojamientos" name="alojamientos">
                        @foreach($alojamientos as $curso)
                            <option value="{{$curso->alj_id}}">{{$curso->alj_descr}}</option>
                        @endforeach
                        </select>
                        
                    </div>
                    <div class="col-sm-12 d-flex justify-content-center text-center">
                        <span class="text-danger" id="spancursos" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                <div class="row"  style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Fecha Inicio:</label>
                        <input type="date" class="form-control" style="width:67%;" name="fechaInit2" id="fechaInit2" />
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                <div class="row"  style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Fecha Fin:</label>
                        <input type="date" class="form-control" style="width:67%;" name="fechaEnd2" id="fechaEnd2" />
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                <div class="row"  style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Precio:</label>
                        <input type="text" class="form-control" style="width:67%;" name="price2" id="price2" />
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                <div class="row"  style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Suplem.[1]:</label>
                        <select  class="form-select select"  style="width:47%;" id="salojamientos" name="salojamientos">
                        @foreach($suplementos_alojamientos as $curso)
                            <option value="{{$curso->sup_id}}">{{$curso->sup_nombre}}</option>
                        @endforeach
                        </select>
                        <label class=" font-weight-bold" style="width:9%;justify-content: end; margin-right: 5px;">Precio:</label>
                        <input type="number" class="form-control" style="width:10%;" name="precios4" id="precios4" />
                    </div>
                    <div class="col-sm-12 d-flex justify-content-center text-center">
                        <span class="text-danger" id="spanscursos" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                <div class="row"  style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Suplem.[2]:</label>
                        <select  class="form-select select"  style="width:47%;" id="salojamientos2" name="salojamientos2">
                        @foreach($suplementos_alojamientos as $curso)
                            <option value="{{$curso->sup_id}}">{{$curso->sup_nombre}}</option>
                        @endforeach
                        </select>
                        <label class=" font-weight-bold" style="width:9%;justify-content: end; margin-right: 5px;">Precio:</label>
                        <input type="number" class="form-control" style="width:10%;" name="precios5" id="precios5" />
                    </div>
                    <div class="col-sm-12 d-flex justify-content-center text-center">
                        <span class="text-danger" id="spanscursos" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
                <div class="row"  style="margin-top:5px;">
                    <div class="col-sm-12 form-inline text-end">
                        <label class=" font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Suplem.[3]:</label>
                        <select  class="form-select select"  style="width:47%;" id="salojamientos3" name="salojamientos3">
                        @foreach($suplementos_alojamientos as $curso)
                            <option value="{{$curso->sup_id}}">{{$curso->sup_nombre}}</option>
                        @endforeach
                        </select>
                        <label class=" font-weight-bold" style="width:9%;justify-content: end; margin-right: 5px;">Precio:</label>
                        <input type="number" class="form-control" style="width:10%;" name="precios6" id="precios6" />
                    </div>
                    <div class="col-sm-12 d-flex justify-content-center text-center">
                        <span class="text-danger" id="spanscursos" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
                <div class="section mouse-event" data-toggle="collapse" data-target="#ci" aria-expanded="false" aria-controls="collapseExample">
                    <div class="row">
                        <div class="col-sm-11">Comentarios Internos</div>
                        <div class="col-sm-1 d-flex align-items-center text-end"><i class="fa fa-arrows-v" aria-hidden="true"></i></div>
                    </div>
                </div>
                <div class="collapse" id="ci">
                    <textarea type="text" class="form-control" style="width:80%;margin-left: 5%;margin-top:25px;"  name="tci" id="tci"></textarea>
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
                <div class="section mouse-event" data-toggle="collapse" data-target="#ce" aria-expanded="false" aria-controls="collapseExample">
                    <div class="row">
                        <div class="col-sm-11">Comentarios para la escuela</div>
                        <div class="col-sm-1 d-flex align-items-center text-end"><i class="fa fa-arrows-v" aria-hidden="true"></i></div>
                    </div>
                </div>
                <div class="collapse" id="ce">
                    <textarea type="text" class="form-control" style="width:80%;margin-left: 5%;margin-top:25px;" name="tce" id="tce"></textarea>
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
                <div class="section mouse-event" data-toggle="collapse" data-target="#ic" aria-expanded="false" aria-controls="collapseExample">
                    <div class="row">
                        <div class="col-sm-11">Informaci&oacuten Curso(bono)</div>
                        <div class="col-sm-1 d-flex align-items-center text-end"><i class="fa fa-arrows-v" aria-hidden="true"></i></div>
                    </div>
                </div>
                <div class="collapse" id="ic">
                    <textarea type="text" class="form-control" style="width:80%;margin-left: 5%;margin-top:25px;" name="tic" id="tic"></textarea>
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
                <div class="section mouse-event" data-toggle="collapse" data-target="#ia" aria-expanded="false" aria-controls="collapseExample">
                    <div class="row">
                        <div class="col-sm-11">Informaci&oacuten Alojamiento</div>
                        <div class="col-sm-1 d-flex align-items-center text-end"><i class="fa fa-arrows-v" aria-hidden="true"></i></div>
                    </div>
                </div>
                <div class="collapse" id="ia">
                    <textarea type="text" class="form-control" style="width:80%;margin-left: 5%;margin-top:25px;" name="tia"  id="tia"></textarea>
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
        </form>
    <div class="col-sm-6 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
        <form action='{{route("operacion.create")}}' method="POST"   style="margin: 0px;">
                    @method("POST")
                    @csrf
                    <input type="hidden" value="prev" id="action" name="action"/>
                    <input type="hidden" value="1" id="page" name="page"/>
            <button type="submit" class="btn btn-success">Anterior</button>
        </form>
        <button onclick="next(3)" class="btn btn-success" style="margin-left:5px">Siguiente</button>

        <button class="btn btn-warning text-white" style="margin-left:5px">Cancelar</button>
        <button class="btn btn-primary" style="margin-left:5px">Limpiar</button>
    </div>
    
</div>
<?php $route2 = route("operacion.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/operaciones/add.js'); }}"></script>     
@stop