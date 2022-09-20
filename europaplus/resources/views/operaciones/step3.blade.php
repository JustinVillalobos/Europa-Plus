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
        <div class="section">NUEVA OPERACIÓN - PASO 3 - DATOS DE VUELO</div>
    </div>
    <form action='{{route("operacion.create")}}' method="POST" id="form"  class="row" style="margin: 0px;">
                @method("POST")
                @csrf
                <input type='hidden' value="<?php echo $isClear;?>" id="isClear" name="isClear">
                <input type='hidden' value="3" id="step"  name="step">
        <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
            <div class="section">Vuelo</div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text-danger font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Vuelo:</label>
                    <select class="form-select" style="width:67%;" name="vuelo" id="vuelo" >
                        <option value="0">Si</option>
                        <option value="1">No</option>
                    </select>
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Tipo:</label>
                    <select class="form-select" style="width:67%;" name="tipo" id="tipo" >
                        <option value="0">Ida y Vuelta</option>
                        <option value="1">Ida</option>
                        <option value="2">Vuelta</option>
                    </select>
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Precio:</label>
                    <input type="text" class="form-control" style="width:67%;" name="price" id="price" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Costo:</label>
                    <input type="text" class="form-control" style="width:67%;" name="costo" id="costo" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
            <div class="section">Transferencia</div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text-danger font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Transfer:</label>
                    <select class="form-select" style="width:67%;" name="Transfer" id="Transfer" >
                        <option value="0">Si</option>
                        <option value="1">No</option>
                    </select>
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Tipo:</label>
                    <select class="form-select" style="width:67%;" name="tipot" id="tipot" >
                        
                        <option value="0">Ida y Vuelta</option>
                        <option value="1">Ida</option>
                        <option value="2">Vuelta</option>
                    </select>
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Precio:</label>
                    <input type="text" class="form-control" style="width:67%;" name="pricet" id="pricet" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-contentt: end; margin-right: 5px;">Costo:</label>
                    <input type="text" class="form-control" style="width:67%;" name="costo" id="costot" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
            <div class="section">Vuelta</div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-contentt: end; margin-right: 5px;">Fecha Salida:</label>
                    <input type="date" class="form-control" style="width:67%;" name="fsalidav2" id="fsalidav2" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-contentt: end; margin-right: 5px;">Hora Salida:</label>
                    <input type="time" class="form-control" style="width:67%;" name="hsalidav2" id="hsalidav2" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-contentt: end; margin-right: 5px;">Fecha Llegada:</label>
                    <input type="date" class="form-control" style="width:67%;" name="fllegadav2" id="fllegadav2" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-contentt: end; margin-right: 5px;">Hora Llegada:</label>
                    <input type="time" class="form-control" style="width:67%;" name="hllegadav2" id="hllegadav2" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-contentt: end; margin-right: 5px;">Aeropuerto / Estaci&oacuten:</label>
                    <input type="text" class="form-control" style="width:67%;" name="estacionv2" id="estacionv2" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">N&uacutemero vuelo /v&iacutea:</label>
                    <input type="text" class="form-control" style="width:30%;" name="numerov2" id="numerov2" />
                    <label class="text- font-weight-bold" style="width:20%;justify-content: end; margin-right: 5px;">L&iacutenea:</label>
                    <input type="text" class="form-control" style="width:16%;" name="numerov" id="numerov" />
                    <label class="text- font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;"></label>
                    <label class="text- font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Loc:</label>
                    <input type="text" class="form-control" style="width:20%;" name="locv2" id="locv2" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
            <div class="section">Ida</div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-contentt: end; margin-right: 5px;">Fecha Salida:</label>
                    <input type="date" class="form-control" style="width:67%;" name="fsalidav" id="fsalidav" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-contentt: end; margin-right: 5px;">Hora Salida:</label>
                    <input type="time" class="form-control" style="width:67%;" name="hsalidav" id="hsalidav" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-contentt: end; margin-right: 5px;">Fecha Llegada:</label>
                    <input type="date" class="form-control" style="width:67%;" name="fllegadav" id="fllegadav" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-contentt: end; margin-right: 5px;">Hora Llegada:</label>
                    <input type="time" class="form-control" style="width:67%;" name="hllegadav" id="hllegadav" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-contentt: end; margin-right: 5px;">Aeropuerto / Estaci&oacuten:</label>
                    <input type="text" class="form-control" style="width:67%;" name="estacionv" id="estacionv" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
            <div class="row"  style="margin-top:5px;">
                <div class="col-sm-12 form-inline text-end">
                    <label class="text- font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">N&uacutemero vuelo /v&iacutea:</label>
                    <input type="text" class="form-control" style="width:30%;" name="numerov" id="numerov" />
                    <label class="text- font-weight-bold" style="width:20%;justify-content: end; margin-right: 5px;">L&iacutenea:</label>
                    <input type="text" class="form-control" style="width:16%;" name="numerov" id="numerov" />
                    <label class="text- font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;"></label>
                    <label class="text- font-weight-bold" style="width:15%;justify-content: end; margin-right: 5px;">Loc:</label>
                    <input type="text" class="form-control" style="width:20%;" name="locv" id="locv" />
                    <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                </div>
            </div>
        </div>
            <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
                <div class="section mouse-event" data-toggle="collapse" data-target="#ii" aria-expanded="false" aria-controls="collapseExample">
                        <div class="row">
                            <div class="col-sm-11">Informaci&oacutenes Ida</div>
                            <div class="col-sm-1 d-flex align-items-center text-end"><i class="fa fa-arrows-v" aria-hidden="true"></i></div>
                        </div>
                    </div>
                    <div class="collapse" id="ii">
                        <textarea type="text" class="form-control" style="width:80%;margin-left: 5%;margin-top:25px;" name="tii" id="tii"></textarea>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>
            </div>
            <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
                <div class="section mouse-event" data-toggle="collapse" data-target="#iv" aria-expanded="false" aria-controls="collapseExample">
                        <div class="row">
                            <div class="col-sm-11">Informaci&oacutenes Vuelta</div>
                            <div class="col-sm-1 d-flex align-items-center text-end"><i class="fa fa-arrows-v" aria-hidden="true"></i></div>
                        </div>
                    </div>
                    <div class="collapse" id="iv">
                        <textarea type="text" class="form-control" style="width:80%;margin-left: 5%;margin-top:25px;" name="tiv" id="tiv"></textarea>
                        <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
                    </div>

            </div>
        </form>
    <div class="col-sm-6 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
        <form action='{{route("operacion.create")}}' method="POST"   style="margin: 0px;">
                    @method("POST")
                    @csrf
                    <input type="hidden" value="prev" id="action" name="action"/>
                    <input type="hidden" value="2" id="page" name="page"/>
            <button type="submit" class="btn btn-success">Anterior</button>
        </form>
        <button onclick="Finally(3)" class="btn btn-success" style="margin-left:5px">Guardar</button>

        <button type="button" class="btn btn-warning text-white" style="margin-left:5px">Cancelar</button>
        <button type="button" class="btn btn-primary" style="margin-left:5px" onclick="clearStep3()">Limpiar</button>
    </div>
    
</div>
<?php $route2 = route("operacion.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/operaciones/add.js'); }}"></script>     
@stop