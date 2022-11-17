<div class="row">
                                    <div class="col-sm-10 d-flex">
                                       <div class="row">
                                            <div class="col-sm-8 border-right info">
                                                <div class="row">
                                                    <div class="col-sm-10 ">
                                                        <label class="mouse-event2" onClick="goToCurso(<?php echo $o->opr_id?>)"><strong>Europa Plus {{$o->esc_nombre}} {{$o->opr_id}} </strong> ({{$o->cur_nombre}})</label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="semaforo">
                                                            <span class="<?php if($o->opr_cur_state==0){echo "text-danger";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                            <span class="<?php if($o->opr_cur_state==1){echo "text-warning";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                            <span class="<?php if($o->opr_cur_state==2){echo "text-success";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 " style="padding-left:25px;">
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <label class="mouse-event2" onClick="goToVuelo(<?php echo $o->opr_id?>)"><span class="text-primary"><i class="fa fa-plane" aria-hidden="true"></i></span> Vuelo</label>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="semaforo">
                                                                    <span class="<?php if($o->opr_vje_state==0){echo "text-danger";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                                   
                                                                    <span class="<?php if($o->opr_vje_state==1){echo "text-success";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12" style="padding-left:25px;">
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                            <label class="mouse-event2" onClick="goToTransfer(<?php echo $o->opr_id?>)"><span class="text-primary"><i class="fa fa-exchange" aria-hidden="true"></i></span> Transferencia</label>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="semaforo">
                                                                    <span class="<?php if($o->opr_tfr_state==0){echo "text-danger";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                                    <span class="<?php if($o->opr_tfr_state==1){echo "text-warning";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                                    <span class="<?php if($o->opr_tfr_state==2){echo "text-success";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 border-right">
                                                <div class="row info">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <label class="mouse-event2" onclick="loadModalSolicitud(<?php echo $o->opr_id; ?>)"><span class="text-success"><i class="fa fa-file-o" aria-hidden="true"></i></span> Descripci&oacuten</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="semaforo">
                                                                    <span class="<?php if($o->opr_descr_state==0){echo "text-danger";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                                    <span class="<?php if($o->opr_descr_state==1){echo "text-success";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <label><span class="text-success"><i class="fa fa-check-square" aria-hidden="true"></i></span> 
                                                                <label class="mouse-event2" onclick="loadModalCondicionada(<?php echo $o->opr_id; ?>)">Condicionada</label> > <label class="mouse-event2" onclick="loadModalConfirmacion(<?php echo $o->opr_id; ?>)">Confirmaci&oacuten</label></label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="semaforo">
                                                                    <span class="<?php if($o->opr_confirm_state==0){echo "text-danger";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                                    <span class="<?php if($o->opr_confirm_state==1){echo "text-warning";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                                    <span class="<?php if($o->opr_confirm_state==2){echo "text-success";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <label class="mouse-event2" onclick="entrega_state(<?php echo $o->opr_id; ?>)"><span class="text-success"><i class="fa fa-handshake-o" aria-hidden="true"></i></span> Entrega</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="semaforo">
                                                                    <span class="<?php if($o->opr_entrega_state==0){echo "text-danger";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                                    <span class="<?php if($o->opr_entrega_state==1){echo "text-success";}?>"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-2 info">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-6 pr-0 "><label class="mouse-event2" onclick="goToCobros(<?php echo $o->opr_id;?>)"><span class="text-success"><i class="fa fa-usd" aria-hidden="true"></i></span> Señal</label></div>
                                                    <div class="col-sm-6 text-end" style="padding-right:15px;"><strong>{{number_format($o->opr_pago_previo, 2, ',', '.')}}</strong></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-6 pr-0 "><label class="mouse-event2" onclick="goToCobros(<?php echo $o->opr_id;?>)"><span class="text-success"><i class="fa fa-usd" aria-hidden="true"></i></span> Pendiente</label></div>
                                                    <div class="col-sm-6 text-end" style="padding-right:15px;"><strong>{{number_format($o->opr_pendiente, 2, ',', '.')}}</strong></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 ">
                                                <div class="row">
                                                    <div class="col-sm-6 pr-0 "><label class="mouse-event2" onclick="goToCobros(<?php echo $o->opr_id;?>)"><span class="text-warning"><i class="fa fa-certificate" aria-hidden="true"></i></span> Seguro</label></div>
                                                    @if($o->opr_seguro==0)
                                                    <div class="col-sm-6 text-end text-danger" style="padding-right:15px;"><Strong>NO</Strong></div>
                                                    @endif
                                                    @if($o->opr_seguro!=0)
                                                    <div class="col-sm-6 text-end" style="padding-right:15px;"><strong>{{number_format($o->opr_seguro, 2, ',', '.')}}</strong></div>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>