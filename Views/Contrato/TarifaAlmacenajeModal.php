<form id="frmTarifaAlmacenaje" name="frmTarifaAlmacenaje" method="POST">
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
          <div class="col-md-12 col-sm-12">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Tamaño</label>
              <div class="col-sm-9">
                <select class="form-control form-control-sm" name="sel_tamano" id="sel_tamano" required>
                  <option value="" selected>Seleecione Tamaño</option>
                  <?php  for ($i=0; $i < count($tamano); $i++) { ?> 
                    <option value="<?php echo ucwords($tamano[$i]->TAMANO); ?>"><?php echo ucwords($tamano[$i]->TAMANO); ?></option>
                  <?php } ?>  
                </select>                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Valor</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="txt_taralmacenamiento" name="txt_taralmacenamiento" value="" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  onChange="this.value = devuelve_float(this.value, '');" style="font-weight:bold;">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Dias Libres</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="txt_diaslibres" name="txt_diaslibres"  onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="" maxlength="5" style="font-weight:bold;">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Despues de X dias</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="txt_diasdespues" name="txt_diasdespues"  onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="5" value="" maxlength="5" style="font-weight:bold;">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Cobrar</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="txt_cobrodespues" name="txt_cobrodespues"  onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="5" value="" maxlength="5" style="font-weight:bold;">
                </div>
              </div>
            </div>
          </div>
              <div class="row">
         <div class="col-md-6">
          <input type="hidden" name="txt_idtarifa" id="txt_idtarifa" value="" />
          <input type="hidden" name="operationALM" id="operationALM" value="" />
        </div>
      </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm" onclick="procesarTarifaALM();">Aceptar</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</form>