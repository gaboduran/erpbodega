<div class="modal-dialog" style="max-width:680px!important;">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalles daños</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
            </button>
        </div>
        <form id="frmdetalledano" name="frmdetalledano" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control form-control-sm" id="txt_idingreso" name="txt_idingreso">
            <input type="text" class="form-control form-control-sm" id="txt_idlinea1" name="txt_idlinea1">

            <div class="modal-body">
                <div class="text-right mt-1 mb-1">
                    <button type="button" class="btn btn-danger"><i class="fa fa-list"></i> Plantillas</button>
                </div>
                <div class="form-group row">
                    <label for="txt_componente" class="col-sm-2 col-form-label">Componente</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control form-control-sm" id="codcomponente" name="codcomponente">
                        <input type="text" class="form-control form-control-sm" id="txt_componente" name="txt_componente" style="text-transform: uppercase;">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_reparacion" class="col-sm-2 col-form-label">Reparacion</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control form-control-sm" id="txt_codrepara" name="txt_codrepara">
                        <input type="text" class="form-control form-control-sm" id="txt_reparacion" name="txt_reparacion">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sel_localiza" class="col-sm-2 col-form-label">Localización</label>
                    <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="sel_localiza" name="sel_localiza">
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_ubica" class="col-sm-2 col-form-label">Ubicación</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txt_ubica" name="txt_ubica">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_dano_1" class="col-sm-2 col-form-label">Daño</label>
                    <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="sel_dano" name="sel_dano">
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_largo" class="col-sm-2 col-form-label">Largo</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txt_largo" name="txt_largo" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_cantidad" class="col-sm-2 col-form-label">Ancho</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" id="txt_ancho" name="txt_ancho" readonly>
                            <div class="input-group-append">
                                <button id="btn_liquidadArea" class="btn btn-info btn-sm" type="button" onclick="liquidarArea();" disabled>
                                    <i class="fa fa-usd"></i> Liquidar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" id="txt_cantidad" name="txt_cantidad" readonly>
                            <div class="input-group-append">
                                <button id="btn_liquidadUnd" class="btn btn-info btn-sm" type="button" onclick="liquidarUnidad();" disabled>
                                    <i class="fa fa-usd"></i> Liquidar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="sel_cargo" class="col-sm-2 col-form-label">Cargo</label>
                    <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="sel_cargo" name="sel_cargo">
                            <option value="" selected>Seleccione Responsable </option>
                            <?php for ($i = 0; $i < count($cargo); $i++) { ?>
                                <option value="<?php echo $cargo[$i]->CODIGO; ?>"> <?php echo ucwords($cargo[$i]->CODIGO) . ' - ' . ucwords($cargo[$i]->DESCRIPCION); ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_chh" class="col-sm-2 col-form-label">Horas Hombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txt_hh" name="txt_hh" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_chh" class="col-sm-2 col-form-label">CTO. H.H</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txt_chh" name="txt_chh" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_cm" class="col-sm-2 col-form-label">CTO. Material</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txt_cm" name="txt_cm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_ct" class="col-sm-2 col-form-label">CTO. Total</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txt_ct" name="txt_ct" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_ct" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                        <textarea style="resize: none;" id="txt_descripcion2" name="txt_descripcion2" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>
                </div>
                <input type="hidden" name="txt_iditem" id="txt_iditem" class="form-control form-control-sm" maxlength="100">
                <input type="hidden" name="txt_iddano" id="txt_iddano" class="form-control form-control-sm" maxlength="100">
                <input type="hidden" name="operation_item" id="operation_item" class="form-control form-control-sm" maxlength="100">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info"><i class="fa fa-plus-circle"></i> Nuevo</button>
                <button type="button" class="btn btn-success" id="btn_procesaDano" onclick="saveDano();" ;><i class="fa fa-floppy-o"></i> </button>
                <button type="button" class="btn btn-info" id="btn_Uploadfotos" onclick="getImagendano();"><i class="fa fa-camera"></i> Fotos</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
            </div>

        </form>

    </div>
</div>