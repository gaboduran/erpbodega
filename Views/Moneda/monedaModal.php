<form id="frmMoneda" name="frmMoneda" action="" method="POST">
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
              <label>Codigo</label>
              <div class="input-group">
                <input type="text" name="txt_codigo" id="txt_codigo" class="form-control form-control-sm" maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Descripcion Componente</label>
              <div class="input-group">
                <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control form-control-sm" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
              </div>
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
        <input type="hidden" name="txt_idmoneda" id="txt_idmoneda"/>
        <input type="hidden" name="operation" id="operation"/>
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