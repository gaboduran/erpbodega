  <?php headerAdmin($data) ?>
  <?php navAdmin($data) ?>
  <?php topNav($data) ?>
  <style>
@media (min-width: 768px) {
    .dropdown-menu {
        width: 20px !important;
    }
}

.columna-1 {
    width: 300px;
}

.columna-2 {
    width: 160px;
}

.columna-3 {
    width: 40px;
}

table td:nth-last-child(1){
    width:276px;
}

.well {
    background: none;
    height: 320px;
}

.table-scroll {
    display: block;
    max-width: 100%;
}

.table-wrap {
    display: block;
    overflow-x: auto;
    overflow-y: auto;
    height: 250px; 
}

.table-wrap thead th {
    position: sticky;
    top: 0;
    z-index: 2;
    background-color: #17A2B8;
    color: #fff;
}

.table-scroll table {
    width: 100%;
    margin-bottom: 0;
}

.table-scroll thead, .table-scroll tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;
}

.table-scroll tbody {
    display: block;
    max-height: 200px;
    overflow-y: scroll;
}

.table-scroll th, .table-scroll td {
    text-align: center;
    word-wrap: break-word;
}

#tablaDetalle tbody th,
    #tablaDetalle tbody td {
        padding: 4px 4px;
    }
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
                      <div class="row">
                          <input type="hidden" id="txt_iddepot" name="txt_iddepot" class="form-control form-control-sm" value="<?php echo $_SESSION['iddepot']; ?>">
                          <input type="hidden" id="txt_idreserva" name="txt_idreserva" class="form-control form-control-sm" value="<?php echo (isset($reserva[0]->ID) ? ucwords($reserva[0]->ID) : ''); ?>">
                          <div class="col-md-2 col-sm-2">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">BOOKING</label>
                                  <input class="form-control form-control-sm" type="text" name="txt_booking" id="txt_booking" maxlength="100" value="<?php echo (isset($reserva[0]->IDRESERVA) ? ucwords($reserva[0]->IDRESERVA) : ''); ?>" readonly>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-4">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Linea Naviera</label>
                                  <input class="form-control form-control-sm" type="text" name="txt_linea" id="txt_linea" maxlength="100" value="<?php echo (isset($reserva[0]->NOMLINEA) ? ucwords($reserva[0]->NOMLINEA) : ''); ?>" readonly>

                              </div>
                          </div>
                          <div class="col-md-3 col-sm-3">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Tipo Salida</label>
                                  <input class="form-control form-control-sm" type="text" name="txt_tisalida" id="txt_tisalida" maxlength="100" value="<?php echo (isset($reserva[0]->DESMOVIMIENTO) ? ucwords($reserva[0]->DESMOVIMIENTO) : ''); ?>" readonly>
                              </div>
                          </div>
                          <div class="col-md-3 col-sm-3">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Orden de Transporte</label>
                                  <input type="text" name="txt_ordentransporte" id="txt_ordentransporte" class="form-control form-control-sm" value="<?php echo (isset($reserva[0]->IDOTRASPORTE) ? ucwords($reserva[0]->IDOTRASPORTE) . ' - ' . ucwords($reserva[0]->CLIENTEOT) : ''); ?>" readonly>
                                  </td>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-5 col-sm-5">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Cliente</label>
                                  <input type="text" name="txt_cliente" id="txt_cliente" class="form-control form-control-sm" value="<?php echo (isset($reserva[0]->NOMTERCERO) ? ucwords($reserva[0]->NOMTERCERO) : ''); ?>" readonly>

                              </div>
                          </div>
                          <div class="col-md-2 col-sm-2">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Fecha de Vencimiento</label>
                                  <input type="text" name="txt_vencimiento" id="txt_vencimiento" class="form-control form-control-sm" value="<?php echo (isset($reserva[0]->FECHAVENCE) ? ucwords($reserva[0]->FECHAVENCE) : ''); ?>" readonly>
                              </div>
                          </div>
                          <div class="col-md-2 col-sm-2">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Estado</label>
                                  <input type="text" name="txt_cliente" id="txt_cliente" class="form-control form-control-sm" value="<?php echo (isset($reserva[0]->ESTADO) == 1 ? 'Activa' : 'Inactiva'); ?>" readonly>

                              </div>
                          </div>
                      </div>
                      <div class="card mt-5">
   
                          <div class="card-body">
                              <div class="table-responsive-sm">
                                  <div class="tableFixHead">
                                      <?php if (permisos::create()) { ?>
                                          <div class="mb-2" align="right">
                                              <button class="btn btn-success btn-sm detalleReservaModal"><i class="fa fa-plus-circle"></i> Agregar</button>
                                          </div>
                                      <?php } ?>
                                      <table class="table table-hover table-sm table-bordered">
                                          <thead>
                                              <tr>
                                                  <th class="columna-1" scope="col" bgcolor="17A2B8">
                                                      <font color="#fff">Tipo
                                                  </th>
                                                  <th class="columna-1" scope="col" bgcolor="17A2B8">
                                                      <font color="#fff">Cantidad Total
                                                  </th>
                                                  <th class="columna-1" scope="col" bgcolor="17A2B8">
                                                      <font color="#fff">Cantidad Despachados
                                                  </th>
                                                  <th class="columna-1" scope="col" bgcolor="17A2B8">
                                                      <font color="#fff">Pendientes
                                                  </th>
                                                  <th class="columna-2" scope="col" bgcolor="17A2B8">
                                                      <font color="#fff">Estado
                                                  </th>
                                                  <th class="columna-3" scope="col" bgcolor="17A2B8">
                                                      <font color="#fff">Acción
                                                  </th>
                                              </tr>
                                          </thead>
                                          <tbody id="detalleReserva">

                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="well card mt-5" >

                          <div class="card-body">
                              <div class="table-responsive-sm">
                                  <table id="tblDetallesalida_old" class="table-scroll table table-hover table-sm table-bordered">
                                      <thead>
                                          <tr>
                                              <th scope="col" bgcolor="17A2B8">
                                                  <font color="#fff">CIR
                                              </th>
                                              <th scope="col" bgcolor="17A2B8">
                                                  <font color="#fff">CONTENEDOR
                                              </th>
                                              <th scope="col" bgcolor="17A2B8">
                                                  <font color="#fff">FECHA SALIDA
                                              </th>
                                              <th scope="col" bgcolor="17A2B8">
                                                  <font color="#fff">INSPECTOR
                                              </th>
                                              <th scope="col" bgcolor="17A2B8">
                                                  <font color="#fff">ACCION
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody id="tblDetallesalida">

                                      </tbody>
                                    </table>
                              </div>
                          </div>
                      </div>


                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/modals/motivoElimina.php'); ?>
  </div>

  <div class="modal fade" id="detalleReservaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/reserva/detalleReservaModal.php'); ?>
  </div>

  <div class="modal fade" id="detalleSalidaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/reserva/detalleSalidaModal.php'); ?>
  </div>

  <?php footerAdmin($data) ?>
  <?php selectfunctions($data) ?>
  <?php datatables($data) ?>
  <?php functionsJS($data) ?>