<form id="frmReserva" name="frmReserva" action="" method="POST">
  <div class="modal-dialog" style="max-width:680px!important;">
    <div class="modal-content">
      <div class="modal-header pt-2 pb-2">
        <h5 class="modal-title" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="operation" id="operation"/>
      <input type="hidden" name="idreserva" id="idreserva"/>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Booking</label>
              <div class="input-group">
                <input type="text" name="txt_booking" id="txt_booking" class="form-control" maxlength="50" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Linea</label>
              <select class="form-control select2" name="sel_linea" id="sel_linea" required style="width: 100%;">
                <option value="">Seleecione Linea</option>
                <?php for ($i = 0; $i < count($linea); $i++) { ?>
                  <option value="<?php echo ucwords($linea[$i]->ID); ?>"><?php echo ucwords($linea[$i]->NOMCLIENTE); ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Cliente</label>
              <div class="input-group">
                <input type="text" name="txt_cliente" id="txt_cliente" class="form-control" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                <input type="hidden" name="txt_idcliente" id="txt_idcliente" class="form-control" value="">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Tipo Salida </label>
              <select class="form-control" id="sel_tisalida" name="sel_tisalida" >
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Fecha Vencimiento</label>
              <div class="input-group date" data-target-input="nearest">
                <input type="text" id="fecvence" name="fecvence" class="form-control  datetimepicker-input" data-target="#fecvence" />
                <div class="input-group-append" data-target="#fecvence" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Estado</label>
              <select class="form-control" name="sel_estado" id="sel_estado" required>
                <option value="1" selected>Activo</option>
                <option value="0">Inativo</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Orden de Transporte</label>
              <div class="input-group">
              <input type="hidden" name="txt_idorden" id="txt_idorden" class="form-control">
              <input type="text" name="txt_orden" id="txt_orden" class="form-control" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Observaciones</label>
              <div class="input-group">
                <textarea class="form-control" id="txt_observaciones" name="txt_observaciones" rows="2"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" onclick="procesarReserva();" class="btn btn-info btn-sm" name="action" id="action" value="Aceptar">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</form>