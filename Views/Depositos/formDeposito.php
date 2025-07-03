<form id="frmDeposito" name="frmDeposito" method="POST">
    <input type="hidden" id="operation" name="operation" class="form-control form-control-sm" value="<?php echo $data['operation']; ?>">
    <input type="hidden" id="iddeposito" name="iddeposito" class="form-control form-control-sm" id="exampleInputEmail1" value="<?php echo (isset($deposito[0]->ID) ? ($deposito[0]->ID) : ''); ?>">
    <div class="row mt-2">
        <div class="col-md-6 col-sm-6 ">
            <div class="card">
                <div class="card-header" style="background-color: #5bc0de; height: 35px; color: white !important; font-weight: bold;">DATOS BASICOS</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" id="txt_nombre" name="txt_nombre" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite Nombre" value="<?php echo (isset($deposito[0]->NOMDEPOSITO) ? ucwords($deposito[0]->NOMDEPOSITO) : ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 col-sm-6 ">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ciudad</label>
                                <?php if (!isset($deposito[0]->ID)) { ?>
                                    <select class="form-control form-control-sm" name="sel_ciudad" id="sel_ciudad" required>
                                        <option value="" selected>Seleecione Ciudad</option>
                                        <?php for ($i = 0; $i < count($ciudad); $i++) { ?>
                                            <option value="<?php echo ucwords($ciudad[$i]->CODIGO); ?>"><?php echo ucwords($ciudad[$i]->NOMBRE); ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <select class="form-control form-control-sm" name="sel_ciudad" id="sel_ciudad" required>
                                        <option selected value="<?php echo $deposito[0]->CODCIUDAD; ?>"> <?php echo ucwords($deposito[0]->NOMCIUDAD); ?> </option>
                                        <?php for ($i = 0; $i < count($ciudad); $i++) { ?>
                                            <option value="<?php echo $ciudad[$i]->CODIGO; ?>"> <?php echo ucwords($ciudad[$i]->NOMBRE); ?> </option>
                                        <?php } ?>
                                    </select>
                                <?php }  ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Estado</label>
                                <?php if (!isset($deposito[0]->ID)) { ?>
                                    <select class="form-control form-control-sm" name="sel_estado" id="sel_estado" required>
                                        <option selected value="1">Activo</option>
                                        <option value="0">Inativo</option>
                                    </select>
                                <?php } else { ?>
                                    <select class="form-control form-control-sm" name="sel_estado" id="sel_estado" required>
                                        <option selected value="<?php echo $deposito[0]->ESTADO; ?>"> <?php echo ucwords($deposito[0]->DESCESTADO); ?> </option>
                                        <?php for ($i = 0; $i < count($estado); $i++) { ?>
                                            <option value="<?php echo $estado[$i]->ID; ?>"> <?php echo ucwords($estado[$i]->DESCESTADO); ?> </option>
                                        <?php } ?>
                                    </select>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="inginventario" id="inginventario"  <?php if (!empty($deposito[0]->INGINVENTARIO)) {  ?> checked <?php } else { ?> <?php '';}  ?> />
                                    <label for="inginventario" class="custom-control-label">Ingresa unidades a Inventario</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 ">
            <div class="card">
                <div class="card-header" style="background-color: #5bc0de; height: 35px; color: white !important; font-weight: bold;">LINEAS NAVIERAS</div>
                <div class="card-body">

                    <?php if (!isset($deposito[0]->ID)) { ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Lineas Disponibles</label>
                                    <select id="listLineas" multiple class="form-control" size="8" style="font-size:14px;">
                                        <?php for ($i = 0; $i < count($linea); $i++) { ?>
                                            <option value="<?= $linea[$i]->ID;  ?>"><?= ucwords($linea[$i]->NOMCLIENTE); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Lineas Asignadas</label>
                                    <select name="listLineas_to[]" id="listLineas_to" multiple class="form-control" size="8" style="font-size:14px;">

                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Lineas Disponibles</label>
                                    <select id="listLineas" multiple class="form-control" size="8" style="font-size:14px;">
                                        <?php for ($i = 0; $i < count($clientesfree); $i++) { ?>
                                            <option value="<?= $clientesfree[$i]->ID;  ?>"><?= ucwords($clientesfree[$i]->NOMCLIENTE); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Lineas Asignadas</label>
                                    <select name="listLineas_to[]" id="listLineas_to" multiple class="form-control" size="8" style="font-size:14px;">
                                        <?php for ($i = 0; $i < count($clientedepot); $i++) { ?>
                                            <option value="<?= $clientedepot[$i]->ID;  ?>"><?= ucwords($clientedepot[$i]->NOMCLIENTE); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php }  ?>
                    <div class="row">
                        <div class="col-md-3">
                            <button type="button" id="listLineas_rightAll" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="listLineas_rightSelected" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                        </div>

                        <div class="col-md-3">
                            <button type="button" id="listLineas_leftSelected" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                        </div>

                        <div class="col-md-3">
                            <button type="button" id="listLineas_leftAll" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="border-bottom border-1 border-light">
    <div align="center">
        <input type="submit" onclick="procesar();" class="btn btn-info btn-sm" value="Aceptar">
        <a href="<?= base_url ?>depositos"><button type="button" class="btn btn-secondary btn-sm">Regresar</button></a>
    </div>
</form>