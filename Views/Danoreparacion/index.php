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
            <form name="frmDanoReparacion" id="frmDanoReparacion" method="POST">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title"><?Php echo $data['page_name']; ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Daño:</label>
                                    <select class="form-control form-control-sm select2" name="sel_dano" id="sel_dano" required style="width: 100%;">
                                        <option value="">Seleecione Daño</option>
                                        <?php for ($i = 0; $i < count($dano); $i++) { ?>
                                            <option value="<?php echo ucwords($dano[$i]->CODDANO); ?>"><?php echo ucwords($dano[$i]->CONJUNTO); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Reparaciones Disponibles</label>
                                    <select name="listrepara[]" id="listrepara" multiple class="form-control" size="8" style="font-size:14px;">

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Reparaciones Asignadas</label>
                                    <select name="listrepara_to[]" id="listrepara_to" multiple class="form-control" size="8" style="font-size:14px;">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" id="listrepara_rightAll" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" id="listrepara_rightSelected" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                            </div>

                            <div class="col-md-3">
                                <button type="button" id="listrepara_leftSelected" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                            </div>

                            <div class="col-md-3">
                                <button type="button" id="listrepara_leftAll" class="btn btn-sm btn-info btn-block"><i class="glyphicon glyphicon-backward"></i></button>
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