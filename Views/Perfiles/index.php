<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Listado General de <?php echo $data['page_name'] ?></h6>
                </div>
                <div class="card-body">

                <?php //debug(PermisosEspeciales::getPermisosMoludos(1)); ?>
                <?php // debug(Permisos::getPermisos(PERFILES)); ?>
                    <?php if (permisos::create()) { ?>
                        <div class="mb-2" align="right">
                            <button class="btn btn-success btn-sm perfilModal"><i class="fa fa-plus-circle"></i> Nuevo</button>
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table id="tblPerfiles" class="table table-bordered table-striped compact nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Perfil</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/modals/motivoElimina.php'); ?>
</div>
<div class="modal fade" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/perfiles/perfilModal.php'); ?>
</div>
<?php footerAdmin($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>