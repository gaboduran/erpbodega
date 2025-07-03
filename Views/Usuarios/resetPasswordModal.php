<div class="modal-dialog" style="max-width:380px!important;">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Generar Nuevo Passowrd</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                    <h6 id="mensaje"></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                    <button type="button" class="btn btn-info btn-sm" onclick="confirmaEmail();"><i class="fa fa-paper-plane"></i> Enviar Email</button>
                    <button type="button" id="ocultar-mostrar btn-sm" class="btn btn-success" onclick="myFunction();"><i class="fa fa-pencil"></i> Cambiar Manual</button>
                </div>
            </div>
            <div id="ocultar-y-mostrar" style="display:none;">
                <form id="frmCambioManual" name="frmCambioManual">
                <input type="hidden" name="txt_idusuario" id="txt_idusuario" class="form-control form-control-sm" maxlength="100" value="">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <input type="text" name="txt_pass1" id="txt_pass1" class="form-control form-control-sm" maxlength="100" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Confimar Password</label>
                                <div class="input-group">
                                    <input type="text" name="txt_pass2" id="txt_pass2" class="form-control form-control-sm" maxlength="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 block" align="center">
                        <button class="btn btn-success btn-sm" onclick="procesarCambio();">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>