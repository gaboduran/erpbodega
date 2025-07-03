<form id="frmDuplicaItem" name="frmDuplicaItem" action="" method="POST">
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
                    <input type="hidden" id="txt_idtabladup" name="txt_idtabladup" class="form-control form-control-sm" value="">
                    <input type="hidden" id="txt_iditemdup" name="txt_iditemdup" class="form-control form-control-sm" value="">
                        <div class="form-group">
                            <label>Linea a Duplicar Item: </label>
                            <div id="selectB">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" onclick="procesarduplicarItem();" class="btn btn-info btn-sm" name="action" id="action" value="Aceptar">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</form>