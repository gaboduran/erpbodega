<div class="card-body">
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <div class="form-group">
                <label>LINEA</label>
                <?php if (!isset($ingresodata[0]->ID)) { ?>
                    <select class="form-control form-control-sm select2" name="sel_linea" id="sel_linea" style="width: 100%;">
                        <option value="">Seleecione Cliente</option>
                        <?php for ($i = 0; $i < count($linea); $i++) { ?>
                            <option value="<?php echo ucwords($linea[$i]->ID); ?>"><?php echo ucwords($linea[$i]->NOMCLIENTE); ?></optio>
                            <?php } ?>
                    </select>
                <?php } else { ?>
                    <select class="form-control form-control-sm select2" name="sel_linea" id="sel_linea" style="width: 100%;">
                        <option selected value="<?php echo $ingresodata[0]->IDLINEA; ?>"> <?php echo ucwords($ingresodata[0]->NOMLINEA); ?> </option>
                        <?php for ($i = 0; $i < count($nolinea); $i++) { ?>
                            <option value="<?php echo $nolinea[$i]->ID; ?>"> <?php echo ucwords($nolinea[$i]->NOMLINEA); ?> </option>
                        <?php } ?>
                    </select>

                <?php }  ?>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label>SIGLA</label>
                <div class="input-group">
                    <input type="text" id="txt_sigla" name="txt_sigla" class="form-control" maxlength="4" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo (isset($ingresodata[0]->SIGLA) ? ucwords($ingresodata[0]->SIGLA) : ''); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label>NUMERO</label>
                <div class="input-group">
                    <input type="text" name="txt_ncont" id="txt_ncont" class="form-control" maxlength="6" onkeypress="return validaNumericos(event)" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo (isset($ingresodata[0]->NUMERO) ? ucwords($ingresodata[0]->NUMERO) : ''); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-1 col-sm-1">
            <div class="form-group">
                <label>DIGITO</label>
                <div class="input-group">
                    <input type="text" name="txt_digito" id="txt_digito" class="form-control" maxlength="2" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo (isset($ingresodata[0]->DIGITO) ? ucwords($ingresodata[0]->DIGITO) : ''); ?>" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label>TIPO CONTENEDOR</label>
                <div class="input-group">
                    <?php if (!isset($ingresodata[0]->ID)) { ?>
                        <select class="form-control" id="sel_tipocont" name="sel_tipocont">
                        </select>
                    <?php } else { ?>
                        <select class="form-control" id="sel_tipocont" name="sel_tipocont">
                            <option selected value="<?php echo $ingresodata[0]->IDTIPOCONT; ?>"> <?php echo ucwords($ingresodata[0]->TIPOCONT); ?> </option>
                            <?php for ($i = 0; $i < count($notipocont); $i++) { ?>
                                <option value="<?php echo $notipocont[$i]->IDTIPOCONT; ?>"> <?php echo ucwords($notipocont[$i]->CODIGO); ?> </option>
                            <?php } ?>
                        </select>
                    <?php }  ?>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label class="control-label">AÑO FABRICACIÓN</label>
                <div class='input-group date' id='datetimepicker_fabricacion'>
                    <input type="text" class="form-control input-sm" id="fabricacion" maxlength="7" name="fabricacion" placeholder="MM-YYYY" value="<?php echo (isset($ingresodata[0]->FABRICACION) ? ucwords($ingresodata[0]->FABRICACION) : ''); ?>" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label>TARA</label>
                <div class="input-group">
                    <input type="text" name="txt_tara" id="txt_tara" class="form-control" maxlength="7" onkeypress="return validaNumericos(event)" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo (isset($ingresodata[0]->TARA) ? ucwords($ingresodata[0]->TARA) : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label>PAYLOAD</label>
                <div class="input-group">
                    <input type="text" name="txt_payload" id="txt_payload" class="form-control" maxlength="7" onkeypress="return validaNumericos(event)" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo (isset($ingresodata[0]->PAYLOAD) ? ucwords($ingresodata[0]->PAYLOAD) : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label>BL / COMODATO</label>
                <div class="input-group">
                    <input type="text" name="txt_comodato" id="txt_comodato" class="form-control" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo (isset($ingresodata[0]->COMODATO) ? ucwords($ingresodata[0]->COMODATO) : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="form-group">
                <label>TIPO INGRESO</label>
                <div class="input-group">
                    <?php if (!isset($ingresodata[0]->ID)) { ?>
                        <select class="form-control" id="sel_movimiento" name="sel_movimiento">
                        </select>
                    <?php } else { ?>
                        <select class="form-control" id="sel_movimiento" name="sel_movimiento">
                            <option selected value="<?php echo $ingresodata[0]->IDTIPOINGRESO; ?>"> <?php echo ucwords($ingresodata[0]->TIPOINGRESO); ?> </option>
                            <?php for ($i = 0; $i < count($notipoingreso); $i++) { ?>
                                <option value="<?php echo $notipoingreso[$i]->ID; ?>"> <?php echo ucwords($notipoingreso[$i]->DESCRIPCION); ?> </option>
                            <?php } ?>
                        </select>
                    <?php }  ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="form-group">
                <label id="myLabel">.</label>
                <div class="input-group">
                <?php if (isset($ingresodata[0]->ID)) { ?> 
                    <?php if ($ingresodata[0]->IDDEVOLUCION != 0) { ?>
                        <input type="hidden" name="txt_desvio_motdev" id="txt_desvio_motdev" class="form-control" maxlength="5" readonly value="<?php echo (isset($ingresodata[0]->IDDEVOLUCION) ? ucwords($ingresodata[0]->IDDEVOLUCION) : ''); ?>" />
                        <input type="text" name="txt_des_desvio_motdev" id="txt_des_desvio_motdev" class="form-control" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;" readonly  value="<?php echo (isset($ingresodata[0]->IDDEVOLUCION) ? ucwords($ingresodata[0]->MOTIVODEV) : ''); ?>" />
                    <?php }  ?>
                        <?php  if($ingresodata[0]->IDDEVOLUCION == 0) { ?>  
                        <input type="hidden" name="txt_desvio_motdev" id="txt_desvio_motdev" class="form-control" maxlength="5" readonly value="<?php echo $ingresodata[0]->IDPATIO; ?>" />
                        <input type="text" name="txt_des_desvio_motdev" id="txt_des_desvio_motdev" class="form-control" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;" readonly  value="<?php echo (isset($ingresodata[0]->DEPOSITO) ? ucwords($ingresodata[0]->DEPOSITO) : ''); ?>" />
                    <?php }  ?>
                 <?php } else { ?>
                    <input type="hidden" name="txt_desvio_motdev" id="txt_desvio_motdev" class="form-control" maxlength="5" readonly value="" />
                    <input type="text" name="txt_des_desvio_motdev" id="txt_des_desvio_motdev" class="form-control" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;" readonly  value="" />
                    <?php }  ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="form-group">
                <label>CLIENTE IMPORTADOR</label>
                <div class="input-group">
                    <input type="hidden" name="txt_idclienteimpo" id="txt_idclienteimpo" class="form-control" value="<?php echo (isset($ingresodata[0]->IDTERCERO) ? ucwords($ingresodata[0]->IDTERCERO) : ''); ?>" />
                    <input type="text" name="txt_clienteimpo" id="txt_clienteimpo" class="form-control" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;" value="<?php echo (isset($ingresodata[0]->NOMTERCERO) ? ucwords($ingresodata[0]->NOMTERCERO) : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="form-group">
                <label>EMPRESA TRANSPORTE</label>
                <div class="input-group">
                    <input type="hidden" name="txt_idtransporte" id="txt_idtransporte" class="form-control" value="<?php echo (isset($ingresodata[0]->IDTRANSPORTE) ? ucwords($ingresodata[0]->IDTRANSPORTE) : ''); ?>" />
                    <input type="text" name="txt_nomtransporte" id="txt_nomtransporte" class="form-control" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;" value="<?php echo (isset($ingresodata[0]->TRANSPORTE) ? ucwords($ingresodata[0]->TRANSPORTE) : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="form-group">
                <label>CONDUCTOR</label>
                <div class="input-group">
                    <input type="hidden" name="txt_idconductor" id="txt_idconductor" class="form-control" value="<?php echo (isset($ingresodata[0]->IDCONDUCTOR) ? ucwords($ingresodata[0]->IDCONDUCTOR) : ''); ?>" />
                    <input type="text" name="txt_nomconductor" id="txt_nomconductor" class="form-control" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;" value="<?php echo (isset($ingresodata[0]->NOMCONDUCTOR) ? ucwords($ingresodata[0]->NOMCONDUCTOR) : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label>TELEFONO</label>
                <div class="input-group">
                    <input type="text" name="txt_telefono" id="txt_telefono" class="form-control" maxlength="15" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo (isset($ingresodata[0]->TELEFONO) ? ucwords($ingresodata[0]->TELEFONO) : ''); ?>" />
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label>PLACA</label>
                <div class="input-group">
                    <input type="text" name="txt_placa" id="txt_placa" class="form-control" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;" value="<?php echo (isset($ingresodata[0]->PLACA) ? ucwords($ingresodata[0]->PLACA) : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label>SELLO 1</label>
                <div class="input-group">
                    <input type="text" name="txt_sello1" id="txt_sello1" class="form-control" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;" value="<?php echo (isset($ingresodata[0]->SELLO1) ? ucwords($ingresodata[0]->SELLO1) : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label>SELLO 2</label>
                <div class="input-group">
                    <input type="text" name="txt_sello2" id="txt_sello2" class="form-control" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;" value="<?php echo (isset($ingresodata[0]->SELLO2) ? ucwords($ingresodata[0]->SELLO2) : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label>NAVE</label>
                <div class="input-group">
                    <input type="text" name="txt_nave" id="txt_nave" class="form-control" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;" readonly value="<?php echo (isset($ingresodata[0]->NAVE) ? ucwords($ingresodata[0]->NAVE) : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <label>VIAJE</label>
                <div class="input-group">
                    <input type="text" name="txt_viaje" id="txt_viaje" class="form-control" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;" readonly value="<?php echo (isset($ingresodata[0]->VIAJE) ? ucwords($ingresodata[0]->VIAJE) : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="form-group">
                <!--label class="control-label">STAND BY</label>
                                <input  data-toggle="toggle" data-size="small" type="checkbox" id="standby" name="standby"-->
                <label class="control-label">VACIO/CARGADO</label><br>
                <input type="checkbox" checked data-toggle="toggle" data-on="Vacio" data-off="Cargado" data-onstyle="success" data-offstyle="danger">
            </div>
        </div>

    </div>

</div>