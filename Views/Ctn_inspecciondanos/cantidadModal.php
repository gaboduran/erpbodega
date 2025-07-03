<div class="modal-dialog" style="max-width:480px!important;">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="tituloMedidas"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
            </button>
        </div>
        <form id="frmMedidasArea" name="frmMedidasArea" method="POST">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="txt_reparacion" class="col-sm-2 col-form-label">Ancho</label>
                    <div class="col-md-10 col-sm-10">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" id="txt_idconductor" name="txt_idconductor" class="form-control">
                                <input type="number" id="ancho_modal" name="ancho_modal" class="form-control form-control-sm" required maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                <span class="input-group-btn">
                                    <button id="btnbusca" class="btn btn-info btn-sm" type="button" onclick="liquidarValores();"><i class="fa fa-usd"></i> Liquidar
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-auto">
                        <h6>Vlr. HH</h6>
                    </div>
                    <div class="col-auto ms-3">
                        <h6 id="lbl_vlrhh" name="lbl_vlrhh"></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <h6>Vlr. MT</h6>
                    </div>
                    <div class="col-auto ms-3">
                        <h6 id="lbl_vlrmt" name="lbl_vlrmt"></h6>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="btn_pasardatos" name="btn_pasardatos" onclick="pasarDatos();"><i class="fa fa-plus-circle"></i> Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>

            </div>

        </form>

    </div>
</div>