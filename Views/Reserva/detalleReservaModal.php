<form id="frmdetReserva" name="frmdetReserva" action="" method="POST">
  <div class="modal-dialog" style="max-width:480px!important;">
    <div class="modal-content">
      <div class="modal-header pt-2 pb-2">
        <h5 class="modal-title" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Tipo</label>
              <div class="input-group">
                <select class="form-control form-control-sm" name="sel_tipocont" id="sel_tipocont" required>
                  <option value="" selected>Seleccione Tipo</option>
                  <?php for ($i = 0; $i < count($tipocont); $i++) { ?>
                    <option value="<?php echo ucwords($tipocont[$i]->ID); ?>"><?php echo ucwords($tipocont[$i]->CODIGO); ?></optio>
                    <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Cantidad</label>
              <input class="form-control form-control-sm" type="text" name="txt_cantidad" id="txt_cantidad" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="4">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label >Estado</label>
              <select class="form-control form-control-sm" name="sel_estado" id="sel_estado" required>
                <option value="1" selected>Activo</option>
                <option value="0">Inativo</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" name="txt_iddetReserva" id="txt_iddetReserva" />
            <input type="hidden" name="txt_operation" id="txt_operation" />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-info btn-sm" onclick="procesardetalleReserva();" name="action" id="action" value="Aceptar">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</form>