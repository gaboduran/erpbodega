<form id="frmDuplica" name="frmDuplica" action="" method="POST">
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
              <label>Cliente Origen</label>
              <select class="form-control form-control-sm" name="sel_linea_origen" id="sel_linea_origen" required>
              <option selected value="">Seleccione un Cliente Origen</option>
                <?php for ($i = 0; $i < count($linea); $i++) { ?>
                  <option value="<?php echo $linea[$i]->ID; ?>"> <?php echo ucwords($linea[$i]->NOMCLIENTE); ?> </option>
                <?php } ?>

              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Cliente Destino</label>
              <select class="form-control form-control-sm" name="sel_linea_destino" id="sel_linea_destino" required>
              <option selected value="">Seleccione un Cliente Destino</option>
                <?php for ($i = 0; $i < count($linea); $i++) { ?>
                  <option value="<?php echo $linea[$i]->ID; ?>"> <?php echo ucwords($linea[$i]->NOMCLIENTE); ?> </option>
                <?php } ?>

              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" name="idclasificacion" id="idclasificacion" />
            <input type="hidden" name="operation" id="operation" />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" onclick="procesarDuplica();" class="btn btn-info btn-sm" name="action" id="action" value="Aceptar">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</form>