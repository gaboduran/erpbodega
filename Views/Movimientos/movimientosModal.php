<form id="frmMovimiento" name="frmMovimiento" action="" method="POST">
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
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <label>Descripción</label>
              <div class="input-group">
                <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control form-control-sm" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 ">
            <div class="form-group">
              <label for="exampleInputEmail1">Tipo Movimiento</label>
              <select class="form-control form-control-sm" name="sel_tipomovimiento" id="sel_tipomovimiento" required>
                <option value="" selected>Seleecione Movimiento</option>
                <?php for ($i = 0; $i < count($tipomovimiento); $i++) { ?>
                  <option value="<?php echo ucwords($tipomovimiento[$i]->ID); ?>"><?php echo ucwords($tipomovimiento[$i]->DESCRIPCION); ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <label>Estado</label>
              <select class="form-control form-control-sm" name="sel_estado" id="sel_estado" required>
                <option value="1" selected>Activo</option>
                <option value="0">Inativo</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="generaedi" id="generaedi" value="" />
                <label for="generaedi" class="custom-control-label">Genera EDI</label>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="aprobacion" id="aprobacion" value="" />
                <label for="aprobacion" class="custom-control-label">Requiere Aprobación</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" name="idmovimiento" id="idmovimiento" />
            <input type="hidden" name="operation" id="operation" />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" onclick="procesar();" class="btn btn-info btn-sm" name="action" id="action" value="Aceptar">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</form>