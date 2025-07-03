  <?php headerAdmin($data) ?>
  <?php navAdmin($data) ?>
  <?php topNav($data) ?>
  <style>
      textarea {
          resize: none;
      }
  </style>
  </style>
  <div class="right_col" role="main">
      <div class="row">
          <div class="col-md-12 col-sm-12 ">
              <div class="card card-info card-outline">
                  <div class="card-header">
                      <h3 class="card-title">
                          <h6><?Php echo $data['page_name']; ?></h6>
                      </h3>
                  </div>
                  <div class="card-body">
                      <form id="frmFiltrar" name="frmFiltrar" method="POST">
                          <div class="row">
                              <input type="hidden" id="txt_iddepot" name="txt_iddepot" class="form-control" value="1">
                              <div class="col-md-2 col-sm-2">
                                  <div class="form-group">
                                      <label>Fecha Inicial:</label>
                                      <div class="input-group date" data-target-input="nearest">
                                          <input type="text" class="form-control  datetimepicker-input" data-target="#fechaini" id="fechaini" name="fechaini" />
                                          <div class="input-group-append" data-target="#fechaini" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-2">
                                  <div class="form-group">
                                      <label>Fecha Final:</label>
                                      <div class="input-group date" data-target-input="nearest">
                                          <input type="text" class="form-control  datetimepicker-input" data-target="#fechafin" id="fechafin" name="fechafin" />
                                          <div class="input-group-append" data-target="#fechafin" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Linea Naviera</label>
                                      <select class="form-control " name="sel_linea" id="sel_linea" style="width: 100%;">
                                          <option value="">Seleccione Linea</option>
                                          <?php for ($i = 0; $i < count($linea); $i++) { ?>
                                              <option value="<?php echo ucwords($linea[$i]->ID); ?>"><?php echo ucwords($linea[$i]->NOMCLIENTE); ?></optio>
                                              <?php } ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-2">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Tipo Ingreso</label>
                                      <select class="form-control " name="sel_tipoingreso" id="sel_tipoingreso">
                                      <option value="">Seleccione Tipo Ingreso</option>
                                          <?php for ($i = 0; $i < count($movimientoIn); $i++) { ?>
                                              <option value="<?php echo ucwords($movimientoIn[$i]->ID); ?>"><?php echo ucwords($movimientoIn[$i]->DESCRIPCION); ?></optio>
                                              <?php } ?>
                                      </select>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-2">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Grupo Contenedor</label>
                                      <select class="form-control select2" name="sel_grupocont" id="sel_grupocont" style="width: 100%;">
                                          <option value="">Seleccione Grupo</option>
                                          <?php for ($i = 0; $i < count($getGrupoContenedor); $i++) { ?>
                                              <option value="<?php echo ucwords($getGrupoContenedor[$i]->ID); ?>"><?php echo ucwords($getGrupoContenedor[$i]->CODIGO); ?></optio>
                                              <?php } ?>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-4 col-sm-4">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Cliente / Importador</label>
                                      <select class="form-control select2" name="sel_tercero" id="sel_tercero" style="width: 100%;">
                                          <option value="">Seleccione Tercero</option>
                                          <?php for ($i = 0; $i < count($tercero); $i++) { ?>
                                              <option value="<?php echo ucwords($tercero[$i]->ID); ?>"><?php echo ucwords($tercero[$i]->NOMCLIENTE); ?></optio>
                                              <?php } ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-2">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">CONTENEDOR</label>
                                      <input class="form-control" type="text" name="txt_contenedor" id="txt_contenedor" maxlength="30">
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-2">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Tipo Contenedor</label>
                                      <select class="form-control" name="sel_tipocont" id="sel_tipocont" style="width: 100%;">
                                      <option value="">Seleccione Tipo</option>
                                          <?php for ($i = 0; $i < count($tipocontenedor); $i++) { ?>
                                              <option value="<?php echo ucwords($tipocontenedor[$i]->ID); ?>"><?php echo ucwords($tipocontenedor[$i]->CODIGO); ?></optio>
                                              <?php } ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-2">
                                  <div class="form-group">
                                      <label>BL / COMODATO</label>
                                      <input class="form-control" type="text" name="txt_blcomodato" id="txt_blcomodato" maxlength="30">
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-2">
                                  <div class="form-group">
                                      <label>EIR</label>
                                      <input class="form-control" type="text" name="txt_blcomodato" id="txt_blcomodato" maxlength="30">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12 col-sm-12 col-auto text-center">
                                  <button type="button" name="btnGenerarReporte" id="btnGenerarReporte" class="btn btn-info btn-sm" onclick="filtrar();"><i class="fa fa-search"></i> Buscar</button>
                                  <button type="button" class="btn btn-secondary btn-sm" onclick="this.form.reset(); tblReserva.ajax.reload();"><i class="fa fa-eraser"></i> Limpiar</button>
                              </div>
                          </div>
                      </form>
                      <?php if (permisos::create()) { ?>
                          <div class="mb-2" align="right">
                              <button class="btn btn-success btn-sm reservaModal"><i class="fa fa-plus-circle"></i> Nuevo</button>
                          </div>
                      <?php } ?>
                      <div id="test" style="float: right;"></div>
                      <div class="table-responsive">
                          <table id="tblIngresos" class="display" style="width:100%">
                              <thead>
                                  <tr>
                                      <th>EIR</th>
                                      <th>Fecha Ingreso</th>
                                      <th>Linea</th>
                                      <th>Contenedor</th>
                                      <th>Tipo Contenedor</th>
                                      <th>Tipo Ingreso</th>
                                      <th>BL / Comodato</th>
                                      <th>Cliente / Importador</th>
                                      <th data-orderable="false">Acción</th>
                                  </tr>
                              </thead>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="reservaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/reserva/reservaModal.php'); ?>
  </div>

  <div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/modals/motivoElimina.php'); ?>
  </div>



  <?php footerAdmin($data) ?>
  <?php selectfunctions($data) ?>
   <?php datatables($data) ?>
  <?php functionsJS($data) ?>