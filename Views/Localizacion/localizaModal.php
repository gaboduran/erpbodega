<form id="frmLocaliza" name="frmLocaliza" action="" method="POST">
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
            <label>Componente</label>
                <select class="form-control form-control-sm select2" name="sel_componente" id="sel_componente" required style="width: 100%;">
                <option value="">Seleecione Componente</option>
                <?php  for ($i=0; $i < count($componente); $i++) { ?> 
                  <option value="<?php echo ucwords($componente[$i]->CODIGO); ?>"><?php echo ucwords($componente[$i]->CONJUNTO); ?></option>
                <?php } ?>  
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Primer Caracter</label>
              <select class="form-control form-control-sm" name="sel_primercaracter" id="sel_primercaracter" required>
                <option value="" selected>Seleccione Caracter</option>
                 <?php  for ($i=0; $i < count($pricaracter); $i++) { ?> 
                  <option value="<?php echo ucwords($pricaracter[$i]->LETRA); ?>"><?php echo ucwords($pricaracter[$i]->LETRA).' - '.ucwords($pricaracter[$i]->NOMBREIN); ?></option>
                <?php } ?>  
              </select>
            </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <label >Segundo Caracter</label>
            <select class="form-control form-control-sm" name="sel_segundocaracter" id="sel_segundocaracter" required>
              <option value="" selected>Seleccione Caracter</option>
               <?php  for ($i=0; $i < count($segcaracter); $i++) { ?> 
                  <option value="<?php echo ucwords($segcaracter[$i]->LETRA); ?>"><?php echo ucwords($segcaracter[$i]->LETRA).' - '.ucwords($segcaracter[$i]->NOMBREIN); ?></option>
                <?php } ?>  
            </select>
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
        <input type="hidden" name="idlocalizacion" id="idlocalizacion"/>
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