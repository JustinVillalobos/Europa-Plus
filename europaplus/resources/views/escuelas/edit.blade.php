@extends('../layouts.admin')
@section('content')  
<link rel="stylesheet" href="{{ URL::asset('plugins/sceditor/minified/themes/default.min.css'); }}" />

<script src="{{ URL::asset('plugins/sceditor/minified/sceditor.min.js'); }}"></script>
<script src="{{ URL::asset('plugins/sceditor/minified/icons/monocons.js'); }}"></script>
<!-- Include the default theme -->

<div class="row" style="margin-top:25px;">
    <div class="col-sm-12">
        <div class="" style="padding-left:5px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='{{route("escuelas.index")}}' class="text-info"> <h5><i class="fa fa-book" aria-hidden="true"></i>Escuelas</h5></a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar escuela</li>
            </ol>
        </div>
    </div>
</div>
<div class="row" style="margin-top:15px;">
    
    

    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">DATOS ESCUELA</div>
    </div>
    
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nombre:</label>
                 <input type="text" class="form-control" style="width:67%;" id="nombre" value="{{$escuela->esc_nombre_corto}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nombre Completo:</label>
                 <input type="text" class="form-control" style="width:67%;" id="nombre_completo"  value="{{$escuela->esc_nombre}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Idioma:</label>
                 <Select type="text" class="form-select select" style="width:67%;" id="idiomas" value="{{$escuela->idi_id}}">
                    @foreach($idiomas as $idioma)
                         <option value="{{$idioma->opc_id}}">{{$idioma->opc_descr}}</option>
                    @endforeach
                </Select>
                 <span class="text-danger" id="spanidioma"style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Email:</label>
                 <input type="text" class="form-control" style="width:67%;" id="correo" value="{{$escuela->esc_email}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Teléfono:</label>
                 <input type="text" class="form-control" style="width:67%;" id="tel" value="{{$escuela->esc_telefono}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-6">
        
        <div class="row">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Calle/Plaza:</label>
                 <input type="text" class="form-control" style="width:67%;" id="plaza" value="{{$escuela->esc_direccion}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Código Postal:</label>
                 <input type="text" class="form-control" style="width:67%;" id="cPostal" value="{{$escuela->esc_cp}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">País:</label>
                 <Select type="text" class="form-select select" style="width:67%;" id="paises" value="{{$escuela->pais_id}}">
                    @foreach($paises as $pais)
                        @if($pais->pais_id!=7)
                            <option value="{{$pais->pais_id}}" <?php if($pais->pais_id==$escuela->pais_id){echo "selected";}?>>{{$pais->pais_descr}}</option>
                        @endif
                    @endforeach
                </Select>
                 <span class="text-danger" id="spanpaises"style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Provincia:</label>
                 <Select type="text" class="form-select select" style="width:67%;" id="provincias" value="{{$escuela->prv_id}}">
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
                 <Select type="text" class="form-select select" style="width:67%;" id="localidades" value="{{$escuela->loc_id}}">
                    @foreach($localidades as $localidad)
                         <option value="{{$localidad->loc_id}}">{{$localidad->loc_descr}}</option>
                    @endforeach
                </Select>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">CONTACTO [PRINCIPAL]</div>
    </div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;" >
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nombre:</label>
                 <input type="text" class="form-control" style="width:67%;" id="nombre_contacto" value="{{$escuela->esc_contacto_1}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Email:</label>
                 <input type="text" class="form-control" style="width:67%;" id="email_contacto" value="{{$escuela->esc_cnt_mail_1}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Función:</label>
                 <input type="text" class="form-control" style="width:67%;" id="funcion" value="{{$escuela->esc_cnt_func_1}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class="text-danger font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Teléfono:</label>
                 <input type="text" class="form-control" style="width:67%;" id="tel_contacto" value="{{$escuela->esc_cnt_tel_1}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">CONTACTO [TRANSFER]</div>
    </div>
    <div class="col-sm-6" style="padding:10px 20px 0px 20px;" >
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class=" font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Nombre:</label>
                 <input type="text" class="form-control" style="width:67%;" id="nombre_contactot" value="{{$escuela->esc_contacto_2}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class=" font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Email:</label>
                 <input type="text" class="form-control" style="width:67%;" id="email_contactot" value="{{$escuela->esc_cnt_mail_2}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class=" font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Función:</label>
                 <input type="text" class="form-control" style="width:67%;" id="funciont" value="{{$escuela->esc_cnt_func_2}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class=" font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Teléfono:</label>
                 <input type="text" class="form-control" style="width:67%;" id="tel_contactot" value="{{$escuela->esc_cnt_tel_2}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-6"></div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">OTROS DATOS</div>
    </div>
    <div class="col-sm-6">
        
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class=" font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Página web:</label>
                 <input type="text" class="form-control" style="width:67%;" id="pagina" value="{{$escuela->esc_www}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class=" font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Usuario web:</label>
                 <input type="text" class="form-control" style="width:67%;" id="user" value="{{$escuela->esc_usuario}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end">
                <label class=" font-weight-bold" style="width:30%;justify-content: end; margin-right: 5px;">Contraseña:</label>
                 <input type="text" class="form-control" style="width:67%;" id="psw" value="{{$escuela->esc_password}}"/>
                 <span class="text-danger" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">CONDICIONES</div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-1"></div>
            <div class="col-sm-11 form-inline text-start" style="height:200px">
                 <textarea type="text" class="form-control" style="width:95%;height:200px" id="comentarios">{!! $escuela->esc_condiciones !!}</textarea>
                 <span class="text-danger" id="spancomentarios" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">CURSOS</div>
    </div>
    <div class="col-sm-10">
        
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end select-select2-custom" >
                 <select  class="form-select select" style="margin-right:30%;width:100%;" id="cursos" multiple="multiple">
                    @foreach($cursos as $curso)
                        @if(in_array($curso->cur_id,$cursos_escuela))
                         <option value="{{$curso->cur_id}}" selected>{{$curso->cur_descr_en}}</option>
                        @endif
                        @if(!in_array($curso->cur_id,$cursos_escuela))
                            <option value="{{$curso->cur_id}}">{{$curso->cur_descr_en}}</option>
                        @endif
                        
                    @endforeach
                    </select>
                 
             </div>
             <div class="col-sm-12 d-flex justify-content-center text-center">
                <span class="text-danger" id="spancursos" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>

    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">SUPLEMENTOS CURSOS</div>
    </div>
    <div class="col-sm-10">
        
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end select-select2-custom" >
                 <select  class="form-select select" style="margin-right:30%;width:100%;" id="sup-cur" multiple="multiple">
                    @foreach($SuplementosCurso as $s)
                        @if(in_array($s->sup_id,$supl_escuela))
                         <option value="{{$s->sup_id}}" selected>{{$s->sup_descr_en}}</option>
                        @endif
                        @if(!in_array($s->sup_id,$supl_escuela))
                             <option value="{{$s->sup_id}}">{{$s->sup_descr_en}}</option>
                        @endif
                        
                    @endforeach
                    </select>
                 
             </div>
             <div class="col-sm-12 d-flex justify-content-center text-center">
             <span class="text-danger" id="spanscursos" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>

    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">ALOJAMIENTOS</div>
    </div>
    <div class="col-sm-10">
        
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end select-select2-custom" >
                 <select  class="form-select select" style="margin-right:30%;width:100%;" id="alj" multiple="multiple">
                    @foreach($alojamientos as $a)

                        @if(in_array($a->alj_id,$alojamientos_escuela))
                         <option value="{{$a->alj_id}}" selected>{{$a->alj_descr}}</option>
                        @endif
                        @if(!in_array($a->alj_id,$alojamientos_escuela))
                        <option value="{{$a->alj_id}}">{{$a->alj_descr}}</option>
                        @endif
                        
                    @endforeach
                    </select>
                 
             </div>
             <div class="col-sm-12 d-flex justify-content-center text-center">
             <span class="text-danger" id="spanalj" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>

    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">SUPLEMENTOS ALOJAMIENTOS</div>
    </div>
    <div class="col-sm-10">
        
        <div class="row" style="margin-top:5px;">
            <div class="col-sm-12 form-inline text-end select-select2-custom" >
                 <select  class="form-select select" style="margin-right:30%;width:100%;" id="sup-alj" multiple="multiple">
                    @foreach($SuplementosAlojamiento as $s)
                      @if(in_array($s->sup_id,$supl_escuela))
                         <option value="{{$s->sup_id}}" selected>{{$s->sup_descr}}</option>
                        @endif
                        @if(!in_array($s->sup_id,$supl_escuela))
                             <option value="{{$s->sup_id}}">{{$s->sup_descr}}</option>
                        @endif
                    @endforeach
                    </select>
                 
             </div>
             <div class="col-sm-12 d-flex justify-content-center text-center">
             <span class="text-danger" id="spansalj" style="width:100%;margin-right:25%;font-size:11px;"></span>
             </div>
        </div>

    </div>
    <div class="col-sm-6"></div>
    <div class="col-sm-6 d-flex justify-content-end" style="padding:10px 25px 0px 20px;">
        <button class="btn btn-success">Aceptar</button>
        <button class="btn btn-warning text-white" style="margin-left:5px">Cancelar</button>
        <button class="btn btn-primary" style="margin-left:5px">Limpiar</button>
    </div>
</div>
<?php $route2 = route("escuelas.index");?>
<input type="hidden" value="{{$route2}}" id="route" />
<input type="hidden" value="{{$escuela->esc_id}}" id="esc_id" />
<script src="{{ URL::asset('js/escuelas/edit.js'); }}"></script>     
@stop