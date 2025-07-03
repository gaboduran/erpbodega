<form id="frmPosicion" name="frmPosicion" action="" method="POST">
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
          <div class="col-md-6">
            <div class="form-group">
              <label>Letra</label>
              <div class="input-group">
                <input type="text" name="txt_letra" id="txt_letra" class="form-control form-control-sm" maxlength="1" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-transform:uppercase;" style="text-transform: uppercase;">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Posición Caracter</label>
              <div class="input-group">
               <select class="form-control form-control-sm" name="sel_caracter" id="sel_caracter" required>
                <option value="" selected>Seleccione Posición</option>
                <option value="1">Primer Caracter</option>
                <option value="2">Segundo Caracter</option>
              </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Nombre Ingles</label>
              <div class="input-group">
                <input type="text" name="txt_nombrein" id="txt_nombrein" class="form-control form-control-sm" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Nombre Español</label>
              <div class="input-group">
                <input type="text" name="txt_nombrees" id="txt_nombrees" class="form-control form-control-sm" maxlength="100" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
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
          <input type="hidden" name="idposicion" id="idposicion"/>
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