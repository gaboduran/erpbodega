<form id="frmConductores" name="frmConductores" action="" method="POST">
    <div class="modal-dialog" style="max-width:780px!important;">
        <div class="modal-content">
            <div class="modal-header pt-2 pb-2">
                <h5 class="modal-title" id="tituloModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="operation" name="operation" class="form-control form-control-sm" value="<?php echo (isset($transporte[0]->ID) ? ucwords($transporte[0]->ID) : ''); ?>">
                <input type="hidden" id="txt_idconductor" name="txt_idconductor" class="form-control form-control-sm" value="<?php echo (isset($transporte[0]->NROIDE) ? ucwords($transporte[0]->NROIDE) : ''); ?>">
                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Generales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="documentos-tab" data-toggle="tab" href="#documentos" role="tab" aria-controls="documentos" aria-selected="false">Documentos</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tipo Doc.</label>
                                    <select class="form-control form-control-sm" name="sel_tipodoc" id="sel_tipodoc" required>
                                        <option value="" selected>Seleecione Tipo</option>
                                        <?php for ($i = 0; $i < count($tipodoc); $i++) { ?>
                                            <option value="<?php echo ucwords($tipodoc[$i]->ID); ?>"><?php echo ucwords($tipodoc[$i]->CODIGO); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Identificación</label>
                                    <input type="text" id="txt_nroide" name="txt_nroide" class="form-control form-control-sm" onkeypress="return validaNumericos(event)" placeholder="Digite Numero Ide." maxlength="15" value="<?php echo (isset($transporte[0]->NROIDE) ? ucwords($transporte[0]->NROIDE) : ''); ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" id="txt_nombre" name="txt_nombre" class="form-control form-control-sm" placeholder="Digite Nombre" maxlength="150" value="<?php echo (isset($transporte[0]->NROIDE) ? ucwords($transporte[0]->NROIDE) : ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" id="txt_email" name="txt_email" class="form-control form-control-sm" placeholder="Ingrese Email" maxlength="100" value="<?php echo (isset($transporte[0]->NROIDE) ? ucwords($transporte[0]->NROIDE) : ''); ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telefono</label>
                                    <input type="text" id="txt_telefono" name="txt_telefono" class="form-control form-control-sm" placeholder="Ingrese telefono" maxlength="15" value="<?php echo (isset($transporte[0]->NROIDE) ? ucwords($transporte[0]->NROIDE) : ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control form-control-sm" name="sel_estado" id="sel_estado" required>
                                        <option value="" selected>Seleecione Estado</option>
                                        <?php for ($i = 0; $i < count($estado); $i++) { ?>
                                            <option value="<?php echo $estado[$i]->ID; ?>"> <?php echo ucwords($estado[$i]->DESCESTADO); ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Licencia Conducción</label>
                                    <input type="text" id="txt_licencia" name="txt_licencia" class="form-control form-control-sm" placeholder="Ingrese Licencia" maxlength="50" value="<?php echo (isset($transporte[0]->NROIDE) ? ucwords($transporte[0]->NROIDE) : ''); ?>">
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5">
                              <div class="form-group">
                                  <label>Fecha Vencimiento:</label>
                                  <div class="input-group date" data-target-input="nearest">
                                      <input type="text" class="form-control form-control-sm  datetimepicker-input" data-target="#fecvence" id="fecvence" name="fecvence" />
                                      <div class="input-group-append" data-target="#fecvence" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <hr class="border-bottom border-1 border-light">
                        <div align="center">
                            <input type="submit" onclick="procesar();" class="btn btn-info btn-sm" name="action" id="action" value="Aceptar">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="documentos-tab">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <table class="table table-bordered table-striped nowrap display compact table-hover mt-1" id="tab_logic">
                                    <thead>
                                        <tr>
                                            <th class="columna-1 text-center" scope="col" bgcolor="17A2B8">
                                                <font color="#fff">Descripcion
                                            </th>
                                            <th class="columna-2 text-center" scope="col" bgcolor="17A2B8">
                                                <font color="#fff">Fecha Cargue
                                            </th>
                                            <th class="columna-3 text-left" scope="col" bgcolor="17A2B8">
                                                <font color="#fff">Accion
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id='HTMLdetalleDocumentos'>

                                    </tbody>
                                </table>
                                <input type="hidden" name="iddocumento" id="iddocumento" class="form-control form-control-sm" />
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>