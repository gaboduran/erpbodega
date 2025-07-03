<form id="frmTarifaInspeccion" name="frmTarifaInspeccion" method="POST">
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
              <label class="col-sm-2 col-form-label">Tamaño</label>
              <div class="col-sm-10">
                <select class="form-control form-control-sm" name="sel_tamanoInspeccion" id="sel_tamanoInspeccion" required>
                  <option value="" selected>Seleecione Tamaño</option>
                  <?php  for ($i=0; $i < count($tamano); $i++) { ?> 
                    <option value="<?php echo ucwords($tamano[$i]->TAMANO); ?>"><?php echo ucwords($tamano[$i]->TAMANO); ?></option>
                  <?php } ?>  
                </select> 
              </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Movimiento</label>
                <div class="col-sm-10">
                    <select class="form-control form-control-sm" name="sel_movimientoInspeccion" id="sel_movimientoInspeccion"  required>
                    <option value="" selected>Seleecione Movimiento</option>
                    <?php  for ($i=0; $i < count($movimientoIO); $i++) { ?> 
                      <option value="<?php echo ucwords($movimientoIO[$i]->ID); ?>"><?php echo ucwords($movimientoIO[$i]->CODIGO); ?></option>
                    <?php } ?>  
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Descripcion</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-sm" id="txt_DescripcionMovimiento" name="txt_DescripcionMovimiento"  disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Valor</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-sm custom4" id="txt_valorInspeccion" name="txt_valorInspeccion">
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="txt_idtarifaInspeccion" id="txt_idtarifaInspeccion"/>
          <input type="hidden" name="operationINS" id="operationINS"/>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm" onclick="procesarTarifaINS();">Aceptar</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</form>