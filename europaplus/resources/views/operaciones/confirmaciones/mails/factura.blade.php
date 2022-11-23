<div class="paper" id="paper">
    @include("../../operaciones/confirmaciones/mails/header")
   
                        <div class="row" style="margin-top:25px;">
                            <div class="col-sm-12" style="padding-left:25px;padding-right:15px">
                                <div class="line"></div>
                            </div>
                            <div class="col-sm-12" style="padding-left:30px;padding-right:25px;margin-top:15px;">
                                <div class="row">
                                    <div class="col-sm-7 bordered-data">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <strong>Nombre:</strong>
                                            </div>
                                            <div class="col-sm-9" id="nombre">
                                               
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Apellidos:</strong>
                                            </div>
                                            <div class="col-sm-9" id="apellidos">
                                                
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Direcci&oacuten:</strong>
                                            </div>
                                            <div class="col-sm-9" id="dir">
                                               
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>CP:</strong>
                                            </div>
                                            <div class="col-sm-9" id="cp">
                                              
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Localidad:</strong>
                                            </div>
                                            <div class="col-sm-9" id="loc">
                                               
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Provincia:</strong>
                                            </div>
                                            <div class="col-sm-9" id="prv">
                                               
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Pa&iacutes:</strong>
                                            </div>
                                            <div class="col-sm-9" id="pais">
                                               
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>NIF:</strong>
                                            </div>
                                            <div class="col-sm-9" id="nif">
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" style="padding-left:30px;padding-right:30px;margin-top:15px;">
                                <div class="row">
                                    <div class="col-sm-12 bordered-data2">
                                        <div class="row">
                                            <div class="col-sm-12 d-flex justify-content-end">
                                               <label> Madrid, a <?php echo  date('d')?> de <span id='mes'></span> <?php echo date('Y');?></label>
                                            </div>
                                            <div class="col-sm-12">
                                               <label><strong style="text-transform:uppercase;">FACTURA No: </strong> <span id='numero'></span></label> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 bordered-data3">
                                        <div class="row header-border">
                                            <div class="col-sm-9 text-center">Concepto</div>
                                            <div class="col-sm-3 text-center">Importe</div>
                                        </div>
                                        <div class="row body-border">
                                            <div class="col-sm-9 " id="text-body"></div>
                                            <div class="col-sm-9 " id="text-body2" style="display:none">
                                                    <textarea id="editable_textarea"></textarea>
                                            </div>
                                            <div class="col-sm-3 text-center" id="importe"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 bordered-data4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>Alumno:</strong>
                                            </div>
                                            <div class="col-sm-12 bg-total">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <strong>Total</strong>
                                                            </div>
                                                            <div class="col-sm-2 text-end">
                                                                <label><strong><span id="total"></span> EUR</strong></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 text-center">
                                                        IVA incluido, R&eacutegimen especial Agencias de viaje CICMA 4280
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 bordered-data5">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>Transferencia Bancaria: </strong> <?php echo $_SESSION['empresa']->nombre;?>
                                            </div>
                                            <div class="col-sm-12">
                                            <?php echo $_SESSION['empresa']->banco;?>
                                            </div>
                                            <div class="col-sm-12">
                                            <?php echo $_SESSION['empresa']->direccion_banco;?>
                                            </div>
                                            <div class="col-sm-12">
                                                 IBAN: <?php echo $_SESSION['empresa']->IBAN;?>
                                            </div>
                                            <div class="col-sm-12">
                                                SWIFT/BIC: <?php echo $_SESSION['empresa']->SWIFT;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>