<form id="frmTarifaTaller" name="frmTarifaTaller" method="POST">
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
                <label class="col-sm-3 col-form-label">Valor Deposito</label>
                <div class="col-sm-9">
                   <input type="text" id="txt_vlrtardeposito" name="txt_vlrtardeposito" class="form-control form-control-sm custom4">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Valor Cliente</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm custom4" id="txt_vlrtarcliente" name="txt_vlrtarcliente">
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="txt_idtarifaTaller" id="txt_idtarifaTaller"/>
          <input type="hidden" name="operationTLL" id="operationTLL"/>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm" onclick="procesarTarifaTLL();">Aceptar</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</form>