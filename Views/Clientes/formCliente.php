<input type="hidden" id="operation" name="operation" class="form-control form-control-sm" value="">
<input type="hidden" id="idcliente" name="idcliente" class="form-control form-control-sm" id="exampleInputEmail1" value="<?php echo (isset($cliente[0]->ID) ? ($cliente[0]->ID) : ''); ?>">
    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Generales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="movimientos-tab" data-toggle="tab" href="#movimientos" role="tab" aria-controls="movimientos" aria-selected="false">Movimientos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="sellos-tab" data-toggle="tab" href="#sellos" role="tab" aria-controls="sellos" aria-selected="false">Sellos</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-2 col-sm-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tipo Doc.</label>
                        <?php if (!isset($cliente[0]->ESTADO)) { ?>
                            <select class="form-control form-control-sm" name="sel_tipodoc" id="sel_tipodoc" required>
                                <option value="" selected>Seleecione Tipo</option>
                                <?php for ($i = 0; $i < count($tipodoc); $i++) { ?>
                                    <option value="<?php echo ucwords($tipodoc[$i]->CODIGO); ?>"><?php echo ucwords($tipodoc[$i]->CODIGO); ?></option>
                                <?php } ?>
                            </select>
                        <?php } else { ?>
                            <select class="form-control form-control-sm" name="sel_tipodoc" id="sel_tipodoc" required>
                                <option selected value="<?php echo $cliente[0]->TIPODOC; ?>"> <?php echo ucwords($cliente[0]->TIPODOC); ?> </option>
                                <?php for ($i = 0; $i < count($tipodoc); $i++) { ?>
                                    <option value="<?php echo $tipodoc[$i]->CODIGO; ?>"> <?php echo ucwords($tipodoc[$i]->CODIGO); ?> </option>
                                <?php } ?>
                            </select>
                        <?php }  ?>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label>Identificacion</label>
                        <div class="input-group">
                            <input type="text" name="txt_idecliente" id="txt_idecliente" class="form-control form-control-sm" maxlength="100" value="<?php echo (isset($cliente[0]->IDECLIENTE) ? ($cliente[0]->IDECLIENTE) : ''); ?>" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-md-7">
                    <div class="form-group">
                        <label>Nombre Cliente</label>
                        <div class="input-group">
                            <input type="text" name="txt_nomcliente" id="txt_nomcliente" class="form-control form-control-sm" maxlength="100" value="<?php echo (isset($cliente[0]->NOMCLIENTE) ? ucwords($cliente[0]->NOMCLIENTE) : ''); ?>" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Contacto</label>
                        <div class="input-group">
                            <input type="text" name="txt_contacto" id="txt_contacto" class="form-control form-control-sm" maxlength="100" value="<?php echo (isset($cliente[0]->CONTACTO) ? ucwords($cliente[0]->CONTACTO) : ''); ?>" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Telefono</label>
                        <div class="input-group">
                            <input type="text" name="txt_telefono" id="txt_telefono" class="form-control form-control-sm" maxlength="15" value="<?php echo (isset($cliente[0]->TELEFONO) ? ucwords($cliente[0]->TELEFONO) : ''); ?>" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <input type="text" name="txt_email" id="txt_email" class="form-control form-control-sm" maxlength="100" value="<?php echo (isset($cliente[0]->EMAIL) ? strtolower($cliente[0]->EMAIL) : ''); ?>" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Estado</label>
                        <?php if (!isset($cliente[0]->ESTADO)) { ?>
                            <select class="form-control form-control-sm" name="sel_estado" id="sel_estado" required>
                                <option selected value="1">Activo</option>
                                <option value="0">Inativo</option>
                            </select>
                        <?php } else { ?>
                            <select class="form-control form-control-sm" name="sel_estado" id="sel_estado" required>
                                <option selected value="<?php echo $cliente[0]->ESTADO; ?>"> <?php echo ucwords($cliente[0]->DESCESTADO); ?> </option>
                                <?php for ($i = 0; $i < count($estado); $i++) { ?>
                                    <option value="<?php echo $estado[$i]->ID; ?>"> <?php echo ucwords($estado[$i]->DESCESTADO); ?> </option>
                                <?php } ?>
                            </select>
                        <?php }  ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="lineanav" id="lineanav" <?php echo !empty($cliente[0]->LINEANAV) == true ? "checked" : ''; ?> />
                            <label for="lineanav" class="custom-control-label">Linea Naviera</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="liquidadano" id="liquidadano" <?php echo !empty($cliente[0]->LIQUIDADANO) == true ? "checked" : ''; ?> />
                            <label for="liquidadano" class="custom-control-label">Liquida Daños</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="consignee" id="consignee" <?php echo !empty($cliente[0]->CONSIGNATARIO) == true ? "checked" : ''; ?> />
                            <label for="consignee" class="custom-control-label">Consignatario</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="txt_idcliente" id="txt_idcliente" />
                    <input type="hidden" name="operation" id="operation" />
                </div>
            </div>
            <hr class="border-bottom border-1 border-light">
            <div align="center">
                <input type="submit" onclick="procesar();" class="btn btn-info btn-sm" name="action" id="action" value="Aceptar">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <div class="tab-pane fade" id="movimientos" role="tabpanel" aria-labelledby="movimientos-tab">
            <form id="frmMovCliente" name="frmMovCliente" action="" method="POST">
                <input type="hidden" name="idclientemov" id="idclientemov" class="form-control form-control-sm" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                <?php if (!isset($cliente[0]->ID)) { ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Movimientos Ingresos Disponibles</label>
                                <select id="listIngreso" multiple class="form-control" size="8" style="font-size:14px;">
                                    <?php for ($i = 0; $i < count($movallingreso); $i++) { ?>
                                        <option value="<?php echo $movallingreso[$i]->ID; ?>"> <?php echo ucwords($movallingreso[$i]->DESCRIPCION); ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Movimientos Ingresos Asignados</label>
                                <select name="listIngreso_to[]" id="listIngreso_to" multiple class="form-control" size="8" style="font-size:14px;">

                                </select>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Movimientos Ingresos Disponibles</label>
                                <select id="listIngreso" multiple class="form-control" size="8" style="font-size:14px;">
                                    <?php for ($i = 0; $i < count($movingresofree); $i++) { ?>
                                        <option value="<?php echo $movingresofree[$i]->ID; ?>"> <?php echo ucwords($movingresofree[$i]->DESCRIPCION); ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Movimientos Ingresos Asignados</label>
                                <select name="listIngreso_to[]" id="listIngreso_to" multiple class="form-control" size="8" style="font-size:14px;">
                                    <?php for ($i = 0; $i < count($movingreso); $i++) { ?>
                                        <option value="<?php echo $movingreso[$i]->ID; ?>"> <?php echo ucwords($movingreso[$i]->DESCRIPCION); ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-3">
                        <button type="button" id="listIngreso_rightAll" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="listIngreso_rightSelected" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                    </div>

                    <div class="col-md-3">
                        <button type="button" id="listIngreso_leftSelected" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                    </div>

                    <div class="col-md-3">
                        <button type="button" id="listIngreso_leftAll" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                    </div>

                </div>

                <?php if (!isset($cliente[0]->ID)) { ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Movimientos Salida Disponibles</label>
                                <select id="listSalida" multiple class="form-control" size="8" style="font-size:14px;">
                                    <?php for ($i = 0; $i < count($movallsalida); $i++) { ?>
                                        <option value="<?php echo $movallsalida[$i]->ID; ?>"> <?php echo ucwords($movallsalida[$i]->DESCRIPCION); ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Movimientos Salida Asignados</label>
                                <select name="listSalida_to[]" id="listSalida_to" multiple class="form-control" size="8" style="font-size:14px;">

                                </select>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Movimientos Salida Disponibles</label>
                                <select id="listSalida" multiple class="form-control" size="8" style="font-size:14px;">
                                    <?php for ($i = 0; $i < count($movsalidafree); $i++) { ?>
                                        <option value="<?php echo $movsalidafree[$i]->ID; ?>"> <?php echo ucwords($movsalidafree[$i]->DESCRIPCION); ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Movimientos Salida Asignados</label>
                                <select name="listSalida_to[]" id="listSalida_to" multiple class="form-control" size="8" style="font-size:14px;">
                                    <?php for ($i = 0; $i < count($movsalida); $i++) { ?>
                                        <option value="<?php echo $movsalida[$i]->ID; ?>"> <?php echo ucwords($movsalida[$i]->DESCRIPCION); ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-3">
                        <button type="button" id="listSalida_rightAll" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="listSalida_rightSelected" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                    </div>

                    <div class="col-md-3">
                        <button type="button" id="listSalida_leftSelected" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                    </div>

                    <div class="col-md-3">
                        <button type="button" id="listSalida_leftAll" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                    </div>

                </div>
                <hr class="border-bottom border-1 border-light">
                <div align="center">
                    <input type="submit" onclick="procesarMovimiento();" class="btn btn-info btn-sm" value="Aceptar">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="sellos" role="tabpanel" aria-labelledby="sellos-tab">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="chk_sellofunda" id="chk_sellofunda" <?php echo  !empty($cliente[0]->SELLOFUNDA) == true ? "checked" : ''; ?> />
                            <label for="chk_sellofunda" class="custom-control-label">Requeire Sello Funda</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="chk_viajenave" id="chk_viajenave" <?php echo  !empty($cliente[0]->VIAJENAVE) == true ? "checked" : ''; ?> />
                            <label for="chk_viajenave" class="custom-control-label">Requeire Viaje / Nave</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="chk_sellovacio" id="chk_sellovacio" <?php echo  !empty($cliente[0]->SELLOVACIO) == true ? "checked" : ''; ?> />
                            <label for="chk_sellovacio" class="custom-control-label">Requeire Sello Vacio</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="chk_selloventilacion" id="chk_selloventilacion" <?php echo  !empty($cliente[0]->SELLOVENTILACION) == true ? "checked" : ''; ?> />
                            <label for="chk_selloventilacion" class="custom-control-label">Requeire Sello Ventilación</label>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="border-bottom border-1 border-light">
                <div align="center">
                    <input type="submit" onclick="procesarSellos();" class="btn btn-info btn-sm" value="Aceptar">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
        </div>
    </div>