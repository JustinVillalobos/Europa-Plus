<div class="row">
                            <div class="col-sm-4" style="padding-top:25px;padding-left:25px;">
                            <img src="{{ URL::asset('assets/4tintas.png'); }}" style="width:250px;" id="logo_modal"/>
                            </div>
                            <div class="col-sm-1" style="padding-top:25px;padding-left:25px;padding-right:0px;width: 45px;">
                                <div class="line-break-orange"></div>
                            </div>
                            <div class="col-sm-4 d-flex align-items-end" style="font-size:11px;padding-left:0px;">
                                <div class="row">
                                    <label class="col-sm-12" style="margin: 0;"><?php echo $_SESSION['empresa']->direccion;?></label>
                                   
                                    <label class="col-sm-12" style="margin: 0;">Télef. <?php echo $_SESSION['empresa']->telefono;?> WhatsApp:<?php echo $_SESSION['empresa']->whatsapp;?></label>
                                   
                                    <label class="col-sm-12" style="margin: 0;"><?php echo $_SESSION['empresa']->correo;?></label>
                                   
                                    <label class="col-sm-12" style="margin: 0;"><?php echo $_SESSION['empresa']->sitio_web;?></label>
                                   
                                    <label class="col-sm-12" style="margin: 0;"><?php echo $_SESSION['empresa']->codigo_postal;?></label>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-12 line-p">
                                <div class="line-break-orange2"></div>
                            </div>
                        </div>