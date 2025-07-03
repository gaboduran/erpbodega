<form id="frmDuplicaTablarepara" name="frmDuplicaTablarepara" action="" method="POST">
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
              <label>Seleccionar Tabla Origen</label>
              <select class="form-control form-control-sm" name="sel_cliente_origen" id="sel_cliente_origen" required>
                <option value="" selected>Seleecione Linea</option>
                <?php  for ($i=0; $i < count($lineaConTBR); $i++) { ?> 
                  <option value="<?php echo ucwords($lineaConTBR[$i]->ID); ?>"><?php echo ucwords($lineaConTBR[$i]->NOMCLIENTE); ?></option>
                <?php } ?>  
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label >Seleccionar Tabla Destino</label>
             <select class="form-control form-control-sm" name="sel_cliente_destino" id="sel_cliente_destino" required>
                <option value="" selected>Seleecione Linea</option>
                <?php  for ($i=0; $i < count($lineaSinTBR); $i++) { ?> 
                  <option value="<?php echo ucwords($lineaSinTBR[$i]->ID); ?>"><?php echo ucwords($lineaSinTBR[$i]->NOMCLIENTE); ?></option>
                <?php } ?>  
              </select>
            </div>
          </div>
        </div>
        <div class="row">
         <div class="col-md-6">
       
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <input type="submit" onclick="duplicarTabla();" class="btn btn-info btn-sm" name="action" id="action" value="Aceptar">
      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
</form>