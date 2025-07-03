<form id="frmCategoria" name="frmCategoria" action="" method="POST">
  <div class="modal-dialog" style="max-width:680px!important;">
    <div class="modal-content">
      <div class="modal-header pt-2 pb-2">
        <h5 class="modal-title" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
          <div class="col-md-6 col-sm-6">
            <div class="form-group">
              <label>Codigo</label>
              <div class="input-group">
                <input type="text" name="txt_codcategoria" id="txt_codcategoria" class="form-control form-control-sm" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform: uppercase;">
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6">
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
          <div class="col-md-12">
            <div class="form-group">
              <label>Decripción</label>
              <div class="input-group">
                <input type="text" name="txt_nomcategoria" id="txt_nomcategoria" class="form-control form-control-sm" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Lineas Disponibles</label>
              <select name="listalinea[]" id="listalinea" multiple class="form-control" size="8" style="font-size:14px;">

              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Lineas Asignadas</label>
              <select name="listalinea_to[]" id="listalinea_to" multiple class="form-control" size="8" style="font-size:14px;">

              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <button type="button" id="listalinea_rightAll" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-forward"></i></button>
          </div>
          <div class="col-md-3">
            <button type="button" id="listalinea_rightSelected" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
          </div>

          <div class="col-md-3">
            <button type="button" id="listalinea_leftSelected" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
          </div>

          <div class="col-md-3">
            <button type="button" id="listalinea_leftAll" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-backward"></i></button>
          </div>
        </div>
        <div class="row">
         <div class="col-md-6">
          <input type="hidden" name="idcategoria" id="idcategoria"/>
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