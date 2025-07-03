  <form id="frmDatosReserva" name="frmDatosReserva" method="POST">
    <div class="card">
      <div class="card-header" style="background-color: #5bc0de; height: 35px; color: white !important; font-weight: bold;" >DATOS BASICOS</div>
      <div class="card-body">
        <input type="hidden" id="operation" name="operation" class="form-control form-control-sm" value="<?php echo $data['operation']; ?>" >
        <div class="row">
          <div class="col-md-2 col-sm-2">
            <div class="form-group">
              <label for="exampleInputEmail1">ID Reserva</label>
              <div class="input-group">
                <input type="text" id="txt_nroreserva" name="txt_nroreserva" class="form-control form-control-sm" value="<?php echo $reservaInfo[0]->IDRESERVA ?? '' ?>" style="text-transform:uppercase">
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-2">
          <div class="form-group">
            <label for="exampleInputEmail1">Id Linea</label>
            <div class="input-group">
              <input type="text" id="txt_idcliente" name="txt_idcliente" class="form-control form-control-sm" value="<?php echo $reservaInfo[0]->NROIDECLIENTE ?? '' ?>">
              <span class="input-group-btn">
                <button id="BtngetClienteModal" class="btn btn-info btn-sm getClienteModal" type="button"><i class="fas fa-search"></i></button></span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre Linea</label>
              <input type="text" id="txt_nomcliente" name="txt_nomcliente" class="form-control form-control-sm" value="<?php echo isset($reservaInfo[0]->NOMCLIENTE) ? ucwords($reservaInfo[0]->NOMCLIENTE) : '' ?>" readonly>
            </div>
          </div>
          <div class="col-md-2 col-sm-2">
            <div class="form-group">
              <label for="exampleInputEmail1">Id Tercero</label>
              <div class="input-group">
                <input type="text" id="txt_idetercero" name="txt_idetercero" class="form-control form-control-sm" value="<?php echo $reservaInfo[0]->NROIDETERCERO ?? '' ?>">
                <span class="input-group-btn">
                  <button id="BtngetTerceroModal" class="btn btn-info btn-sm getTerceroModal" type="button"><i class="fas fa-search"></i></button></span>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label >Nombre Tercero</label>
                <input type="text" id="txt_nomtercero" name="txt_nomtercero" class="form-control form-control-sm" value="<?php echo isset($reservaInfo[0]->NOMCLIENTE) ? ucwords($reservaInfo[0]->NOMTERCERO) : '' ?>" readonly>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3">
            <div class="form-group">
              <label>Fecha Vencimiento</label>
              <div class="input-group date" id="maskfecha" data-target-input="nearest">
                <input type="text" name="txt_fvence" id="txt_fvence" class="form-control form-control-sm datetimepicker-input" data-target="#maskfecha"/ value="<?php echo isset($reservaInfo[0]->FECHAVENCE) ? ucwords(to_date_ddmmyyyy($reservaInfo[0]->FECHAVENCE)) : '' ?>">
                <div class="input-group-append" data-target="#maskfecha" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>    
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-center">
        <button type="button" class="btn btn-sm btn-success" name="btnSavecontrato" id="btnSavecontrato" onclick="procesarReserva();">Aceptar</button>
        <button type="button" class="btn btn-sm btn-secondary">Cancelar</button>
      </div>
    </div>
  </form>
  <div class="col-md-12 col-sm-12 ">
  <div align="right">
  </br>
  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <button class="btn btn-success btn-sm detalleReservaModal" id="Btn_nuevodetalleReservaModal" disabled><i class="fa fa-plus-circle"></i> Nuevo</button>
      <div class="btn-group">
      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
      <i class="icon-printer2 position-left"></i> Imprimir Reporte
      <span class="caret"></span></button>
      <ul class="dropdown-menu dropdown-menu-right">
      <li><a id="imprimirDetReserva" href="javascript:void(0)" onclick="PDF(<?php echo $reservaInfo[0]->ID; ?>);" 
      ><i class="icon-file-pdf"></i> PDF</a></li>
      <li class="divider"></li>
      <li><a id="print_inactivos" href="javascript:void(0)">
      <i class="icon-file-pdf"></i> Clientes Inactivos</a></li>
    </ul>
                </div>
  </div>

  </div>
  <input class="form-control form-control-sm" type="hidden" name="txt_idreserva" id="txt_idreserva" value="<?php echo isset($reservaInfo[0]->ID) ?  $reservaInfo[0]->ID : '' ; ?>">

  <div class="table-responsive-sm">
  <div class="tableFixHead">
  <table class="table table-hover table-sm table-bordered">
    <thead>
      <tr>
        <th scope="col" bgcolor="17A2B8"><font color="#fff">Tamaño</th>
        <th scope="col" bgcolor="17A2B8"><font color="#fff">Tipo</th>
        <th scope="col" bgcolor="17A2B8"><font color="#fff">Cantidad</th>
        <th scope="col" bgcolor="17A2B8"><font color="#fff">Despachados</th>
        <th scope="col" bgcolor="17A2B8"><font color="#fff">Saldo</th>
        <th scope="col" bgcolor="17A2B8"><font color="#fff">Acción</th>
      </tr>
    </thead>
    <tbody id="detalleReserva">

  </tbody>
  </table>
  </div>
  </div>
  </div>
  <div class="col-md-12 col-sm-12 ">
    <div class="table-responsive-sm">
    <div class="tableDetsalidaReserva">
    <table class="table table-hover table-sm table-bordered">
      <thead>
        <tr>
          <th scope="col"  bgcolor="17A2B8"><font color="#fff">CIR</th>
          <th scope="col"  bgcolor="17A2B8"><font color="#fff">Contenedor</th>
          <th scope="col"  bgcolor="17A2B8"><font color="#fff">Tamaño - Tipo</th>
          <th scope="col"  bgcolor="17A2B8"><font color="#fff">Fecha Salida</th>
          <th scope="col"  bgcolor="17A2B8"><font color="#fff">Inspector</th>
          <th scope="col"  bgcolor="17A2B8"><font color="#fff">Accion</th>
        </tr>
      </thead>
      <tbody id="detalleReservabyTipo">
      <tr>
        <td colspan="6">Seleccione un fila para ver el Detalle</td>
      </tr>
    </tbody>
  </table>
  </div>
  </div>
  </div>