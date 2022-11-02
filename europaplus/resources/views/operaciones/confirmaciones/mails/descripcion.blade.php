<div class="paper" id="paper">
    @include("../../operaciones/confirmaciones/mails/header")
                        <div class="row" style="margin-top:25px;">
                           <div class="col-sm-12 d-flex-justify-content-center text-center">
                            
                            <h3><strong id="title">Descripción de la solicitud de inscripción</strong></h3>
                           </div>
                        </div>
                        <div class="row" style="margin-top:25px;">
                            
                            <div class="col-sm-12" style="padding-left:30px;padding-right:25px;">
                                <div class="row">
                               
                                    <div class="col-sm-12 ">
                                        <div class="row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10 margin-t-5">
                                                <p>Alumno/a: <span id="alumno"></span></p>
                                               
                                                <p>A quedado preinscrito/a en el curso en las condiciones que a continuación se detallan:</p>
                                                <p style='padding-left:45px'>Idioma: <span id="idioma"></span></p>
                                                <p style='padding-left:45px'>Ciudad: <span id="ciudad"></span></p>
                                                <p style='padding-left:45px'>Tipo de <strong>curso</strong>: <span id="tipoCurso"></span></p>
                                                <p style='padding-left:45px'>Fechas: <span id="fechas"></span></p>
                                                <p style='padding-left:45px'>Tipo de <strong>alojamiento</strong>: <span id="tipoAlojamiento"></span></p>
                                                <p style='padding-left:45px'>Fechas: <span id="fechas2"></span></p>
                                                <p style='padding-left:45px'>Transfer: <span id="transfer"></span></p>
                                                <p style='padding-left:45px'>Suplementos: <span id="sups"></span></p>
                                                <div id="table-calcs" class="row" style='padding-left:60px;margin-top:50px;width:360px'>
                                                    <div class="col-sm-10" style='border-left:1px solid #ff9d0d;'>
                                                        <p style='margin:0'>Precio del curso + alojamiento:</p>
                                                        <p style='margin:0'>Descuento: </p>
                                                        <p style='margin:0'>Suplementos: </p>
                                                        <p style='margin:0'>Transfer: </p>
                                                        <p style='margin:0'>Otros Servicios: </p>
                                                        <p style='margin:0'><strong>Precio Total</strong> </p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p style='margin:0' id="precioca"></p>
                                                        <p style='margin:0' id="des"> </p>
                                                        <p style='margin:0' id="sups2"> </p>
                                                        <p style='margin:0' id="trans"> </p>
                                                        <p style='margin:0' id="others"></p>
                                                        <p style='margin:0'><strong id="total"></strong> </p>
                                                    </div>
                                                </div>
                                                <p style="margin-top:50px">     Estas condiciones tendrán efecto contractual y 
                                                    permanecerán inamovibles una vez efectuado el pago total del 
                                                    curso que arriba se detalla, mientras figuran a solo modo indicativo 
                                                    de la solicitud de la inscripción.<br><br>
                                                    En este momento ha quedado solicitada plaza en la escuela seleccionada. 
                                                    En el plazo maximo de 2 dias una vez recibida la reserva aceptada por la escuela, 
                                                    le enviaremos la confirmacion de la inscripcion definitiva en el programa solicitado.
                                                </p>
                                            </div>
                                            <div class="col-sm-8  margin-t-5 pl-0" id="from">
                                               
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>