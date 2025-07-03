<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<style>
    @media (min-width: 768px) {
        .dropdown-menu {
            width: 20px !important;
            /* change the number to whatever that you need */
        }
    }
</style>
<div class="right_col" role="main">
    <div class="row">

        <div class="col-md-12 col-sm-12">
            <form name="frmComponentedano" id="frmComponentedano" method="POST">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title"><?Php echo $data['page_name']; ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Componente</label>
                                    <select class="form-control form-control-sm select2" name="sel_componente" id="sel_componente" style="width: 100%;">
                                        <option value="">Seleecione Componente</option>
                                        <?php for ($i = 0; $i < count($componente); $i++) { ?>
                                            <option value="<?php echo ucwords($componente[$i]->CODIGO); ?>"><?php echo ucwords($componente[$i]->CONJUNTO); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Daños Disponibles</label>
                                    <select name="listcomponente[]" id="listcomponente" multiple class="form-control" size="8" style="font-size:14px;">

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Daños Asignados</label>
                                    <select name="listcomponente_to[]" id="listcomponente_to" multiple class="form-control" size="8" style="font-size:14px;">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" id="listcomponente_rightAll" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" id="listcomponente_rightSelected" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                            </div>

                            <div class="col-md-3">
                                <button type="button" id="listcomponente_leftSelected" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                            </div>

                            <div class="col-md-3">
                                <button type="button" id="listcomponente_leftAll" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <button type="button" class="btn btn-sm btn-success" onclick="procesar();">Aceptar</button>
                        <a href="<?= base_url ?>depositos"><button type="button" class="btn btn-sm btn-secondary">Cancelar</button></a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<?php footerAdmin($data) ?>

<?php selectfunctions($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>