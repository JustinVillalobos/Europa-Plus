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
                                            <div class="col-sm-8  margin-t-5 pl-0" id="nombreC">
                                               
                                            </div>
                                            <div class="col-sm-4 d-flex text-right  margin-t-5">
                                                
                                            </div>
                                            <div class="col-sm-8  margin-t-5 pl-0" id="to">Ha quedado inscrito/a en el curso en las condiciones que a continuación se detallan:
                                            </div>
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Ciudad:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="dirC">
                                               
                                            </div>
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Idioma:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="idiomaC">
                                              
                                            </div>
                                            
                                            <div class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Tipo de curso:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="tipoC">
                                               
                                            </div>
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Fechas:</strong>
                                            </div>
                                            
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="fechasCursosC">
                                               
                                            </div>
                                            
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Tipo de alojamiento:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="tipoAlojamientoC">
                                               
                                            </div>
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Fechas:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="fechaAlojamientoC">
                                               
                                            </div>
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Transfer:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0"  id="transferC">
                                               
                                            </div>
                                            <div  style="margin:0;" class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Vuelo:</strong>
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="vueloC">
                                               
                                            </div>
                                            <div style="margin:0;"  class="col-sm-4 d-flex text-right  margin-t-5">
                                                
                                            </div>
                                            <div  style="margin:0;" class="col-sm-8  margin-t-5 pl-0" id="vueloDataC">
                                               
                                            </div>
                                            <div  class="col-sm-4 d-flex text-right  margin-t-5">
                                                <strong>Suplementos:</strong>
                                            </div>
                                            <div   class="col-sm-8  margin-t-5 pl-0" id="supsC">
                                               
                                            </div>
                                            <div class="col-sm-6  margin-t-5 pl-0">
                                                <div id="table-calcs2" class="row" style='padding-left:60px;margin-top:10px;width:360px'>
                                                    <div class="col-sm-10" style='border-left:1px solid #ff9d0d;'>
                                                        <p style='margin:0' class="pp2 pcac">Precio del curso + alojamiento:</p>
                                                        <p style='margin:0'  class="pp2 pdc">Descuento: </p>
                                                        <p style='margin:0'  class="pp2 psc">Suplementos: </p>
                                                        <p style='margin:0'  class="pp2 ptc">Transfer: </p>
                                                        <p style='margin:0'  class="pp2 poc">Otros Servicios: </p>
                                                        <p style='margin:0'  class="pp2 pptc"><strong>Precio Total</strong> </p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p style='margin:0' id="preciocaCc"  class="pp3 pcac"></p>
                                                        <p style='margin:0' id="desCc" class="pp3 pdc"> </p>
                                                        <p style='margin:0' id="sups2Cc" class="pp3 psc"> </p>
                                                        <p style='margin:0' id="transCc"  class="pp3 ptc"> </p>
                                                        <p style='margin:0' id="othersCc" class="pp3 poc"></p>
                                                        <p style='margin:0' class="pp3 pptc"><strong id="totalCC"></strong> </p>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="col-sm-11  margin-t-5 pl-0" id="data_info_c">
                                                <p style="margin-top:10px;margin-bottom:0px;font-size:13px" class="pp4">Para que la reserva de plaza sea efectiva habrá de ingresarse la cantidad de <span id="price"></span> euros en la cuenta bancaria  de Europa Plus s.l. antes del tercer día despúes de recibir esta confirmación. Esta cantidad sera descontada del precio final.Este documento solo sera válido adjuntando la factura del pago mencionado. La transferencia se hara a la siguiente cuenta bancaria: 
                                                   
                                                </p>
                                                <p style="margin:0;font-size:13px" class="pp4" id="banco">Banco</p>
                                                <p style="margin:0;font-size:13px" class="pp4" id="direccion_banco">Calle Edgar Neville 4, 28020 Madrid</p>
                                                <p style="margin:0;font-size:13px" class="pp4" id="IBAN">IBAN</p>
                                                <p style="margin:0;font-size:13px" class="pp4" id="codigo_postal"></p>
                                                <p class="pp4" style="font-size:13px">Estas condiciones tendrán efecto contractual y permanecerán inamovibles una vez efectuado el pago total del curso que arriba se  detalla, mientras figuran a solo modo indicativo de la solicitud de la inscripción. El resto del importe total de su viaje lingüístico se hará en dos partes iguales: junio y en agosto. Gracias por elegirnos para la realización de su curso y esperamos que quede satisfecho con nuestros servicios.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>


