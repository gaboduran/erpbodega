<form id="frmPlaneacion" name="frmPlaneacion" action="" method="POST">
  <div class="modal-dialog" style="max-width:780px!important;">
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
              <label>Fecha Inicial:</label>
              <div class="input-group date" data-target-input="nearest">
                <input type="text" class="form-control  datetimepicker-input" data-target="#fechaini" id="fechaini" name="fechaini" />
                <div class="input-group-append" data-target="#fechaini" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6">
            <div class="form-group">
              <label>Fecha Final:</label>
              <div class="input-group date" data-target-input="nearest">
                <input type="text" class="form-control  datetimepicker-input" data-target="#fechafin" id="fechafin" name="fechafin" />
                <div class="input-group-append" data-target="#fechafin" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-6">
            <div class="form-group">
              <label>Zona</label>
              <div class="input-group">
              <select class="form-control" name="sel_zona" id="sel_zona" required  style="  font-size:13px;">
                <option value="" selected>Seleccione una Zona</option>
               <?php for ($i=0; $i < count($zona) ; $i++) { ?>         
                  <option value="<?= $zona[$i]->ID;  ?>"><?= ucwords($zona[$i]->NOMBRE);?></option>
                <?php } ?>    
              </select>              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6">
            <div class="form-group">
              <label>Estado</label>
              <select class="form-control" name="sel_estado" id="sel_estado" required>
                <option value="1" selected>Activo</option>
                <option value="0">Inativo</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Clasificaciones Disponibles</label>
              <select name="listacalificacion[]" id="listacalificacion" multiple class="form-control" size="8" style="font-size:14px;">

              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Clasificaciones Asignadas</label>
              <select name="listacalificacion_to[]" id="listacalificacion_to" multiple class="form-control" size="8" style="font-size:14px;">

              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <button type="button" id="listacalificacion_rightAll" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-forward"></i></button>
          </div>
          <div class="col-md-3">
            <button type="button" id="listacalificacion_rightSelected" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
          </div>

          <div class="col-md-3">
            <button type="button" id="listacalificacion_leftSelected" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
          </div>

          <div class="col-md-3">
            <button type="button" id="listacalificacion_leftAll" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-backward"></i></button>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Categorias Disponibles</label>
              <select name="listacategoria[]" id="listacategoria" multiple class="form-control" size="8" style="font-size:14px;">

              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Categorias Asignadas</label>
              <select name="listacategoria_to[]" id="listacategoria_to" multiple class="form-control" size="8" style="font-size:14px;">

              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <button type="button" id="listacategoria_rightAll" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-forward"></i></button>
          </div>
          <div class="col-md-3">
            <button type="button" id="listacategoria_rightSelected" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
          </div>

          <div class="col-md-3">
            <button type="button" id="listacategoria_leftSelected" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
          </div>

          <div class="col-md-3">
            <button type="button" id="listacategoria_leftAll" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-backward"></i></button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" name="idplaneacion" id="idplaneacion" />
            <input type="hidden" name="operation" id="operation" />
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