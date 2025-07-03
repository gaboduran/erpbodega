<form id="frmTarifaTransporte" name="frmTarifaTransporte" method="POST">
  <div class="modal-dialog" style="max-width:720px!important;">
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
                <select class="form-control form-control-sm" name="sel_tamanoTransporte" id="sel_tamanoTransporte" required>
                  <option value="" selected>Seleecione Tamaño</option>
                  <?php  for ($i=0; $i < count($tamano); $i++) { ?> 
                    <option value="<?php echo ucwords($tamano[$i]->TAMANO); ?>"><?php echo ucwords($tamano[$i]->TAMANO); ?></option>
                  <?php } ?>  
                </select> 
              </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Condición</label>
                <div class="col-sm-9">
                    <select class="form-control form-control-sm" name="sel_condicion" id="sel_condicion"  required>
                    <option value="" selected>Seleecione Movimiento</option>
                    <option value="L">Lleno</option>
                    <option value="V">Vacio</option>
                     
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Costo Transporte</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm custom4" id="txt_vlrcosto" name="txt_vlrcosto">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Valor Venta</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm custom4" id="txt_vlrVenta" name="txt_vlrVenta">
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="txt_idtarifaTransporte" id="txt_idtarifaTransporte"/>
          <input type="hidden" name="operationTSP" id="operationTSP"/>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm" onclick="procesarTarifaTSP();">Aceptar</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</form>