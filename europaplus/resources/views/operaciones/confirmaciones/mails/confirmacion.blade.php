<div class="paper" id="paper">
    @include("../../operaciones/confirmaciones/mails/header")
                        <div class="row" style="margin-top:10px;">
                           <div class="col-sm-12 d-flex-justify-content-center text-center">
                            
                            <h3><strong id="title">Confirmación de inscripción</strong></h3>
                           </div>
                        </div>
                        <div class="row" style="margin-top:25px;">
                            
                            <div class="col-sm-12" style="padding-left:30px;padding-right:25px;">
                                <div class="row">
                                <div class="col-sm-2 "></div>
                                    <div class="col-sm-10 ">
                                        <div class="row">
                                            <div class="col-sm-4 d-flex text-right margin-t-5">
                                                <strong>Alumno/a:</strong>
                                            </div>
                                            <div class="col-sm-8  margin-t-5 pl-0" id="nombreCc">
                                               
                                            </div>
                                            <div class="col-sm-4 d-flex text-right  margin-t-5">
                                                
                                            </div>
                                            <div class="col-sm-8  margin-t-5 pl-0" id="to">Ha quedado inscrito/a en el curso en las condiciones que a continuación se detallan:
                                            </div>
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Ciudad:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="dirCc">
                                               
                                            </div>
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Idioma:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="idiomaCc">
                                              
                                            </div>
                                            
                                            <div class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Tipo de curso:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="tipoCc">
                                               
                                            </div>
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Fechas:</strong>
                                            </div>
                                            
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="fechasCursosCc">
                                               
                                            </div>
                                            
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Tipo de alojamiento:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="tipoAlojamientoCc">
                                               
                                            </div>
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Fechas:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="fechaAlojamientoCc">
                                               
                                            </div>
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Transfer:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0"  id="transferCc">
                                               
                                            </div>
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Vuelo:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="vueloCc">
                                               
                                            </div>
                                            <div style="margin:0;"  class="col-sm-4 d-flex text-right  margin-t-5">
                                                
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="vueloDataCc">
                                               
                                            </div>
                                            <div  class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Suplementos:</strong>
                                            </div>
                                            <div   class="col-sm-8  margin-t-5 pl-0" id="supsCc">
                                               
                                            </div>
                                            <div class="col-sm-6  margin-t-5 pl-0">
                                                <div id="table-calcs2c" class="row" style='padding-left:60px;margin-top:10px;width:360px'>
                                                    <div class="col-sm-10" style='border-left:1px solid #ff9d0d;'>
                                                        <p style='margin:0' class="pp2 pcacc">Precio del curso + alojamiento:</p>
                                                        <p style='margin:0'  class="pp2 pdcc">Descuento: </p>
                                                        <p style='margin:0'  class="pp2 pscc">Suplementos: </p>
                                                        <p style='margin:0'  class="pp2 ptcc">Transfer: </p>
                                                        <p style='margin:0'  class="pp2 pocc">Otros Servicios: </p>
                                                        <p style='margin:0'  class="pp2 pptcc"><strong>Precio Total</strong> </p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p style='margin:0' id="preciocaCcc"  class="pp3 pcacc"></p>
                                                        <p style='margin:0' id="desCf" class="pp3 pdcc"> </p>
                                                        <p style='margin:0' id="sups2Cf" class="pp3 pscc"> </p>
                                                        <p style='margin:0' id="transCf"  class="pp3 ptcc"> </p>
                                                        <p style='margin:0' id="othersCf" class="pp3 pocc"></p>
                                                        <p style='margin:0' class="pp3 pptcc"><strong id="totalCCc"></strong> </p>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="col-sm-11  margin-t-5 pl-0" id="data_info_cc">
                                                <p style="margin-top:10px;margin-bottom:0px;font-size:13px" class="pp4"> Estas condiciones tendrán efecto contractual y permanecerán inamovibles una vez efectuado el pago total del curso que arriba se detalla, mientras figuran a solo modo indicativo de la solicitud de la inscripción.
                                                </p>
                                                
                                                <p class="pp4" style="font-size:13px;margin-bottom:0px;">21 días antes del comienzo de las clases deberá hacer efectiva la totalidad del importe de su viaje lingüístico y le entregaremos la documentación relativa a su reserva, así como el correspondiente material geográfico y turístico de la ciudad de su elección y su entorno.
</p><p style="margin-top:0px;margin-bottom:0px;font-size:13px" class="pp4"> Gracias por elegirnos para la realización de su curso y esperamos que quede satisfecho con nuestros servicios.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>


                   



