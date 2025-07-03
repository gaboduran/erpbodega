<form id="frmElimina" name="frmElimina" action="" method="POST">
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
              <label>Descripción</label>
              <div class="input-group">
                  <textarea style="resize: none;" id="descmotivo" name="descmotivo" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
         <div class="col-md-6">
          <input type="text" name="ideliminacion" id="ideliminacion"/>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <input type="submit" class="btn btn-info btn-sm" name="action" id="action" value="Aceptar">
      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
</form>