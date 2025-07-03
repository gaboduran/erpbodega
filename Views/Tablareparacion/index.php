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
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?php echo $data['page_name'] ?></h6>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-auto p-2">
                        <div class="btn-group dropright">
                                <button class="btn btn-success btn-sm duplicaTablaRepara"><i class="fa fa-files-o"></i> Duplicar</button>
                            </div>
                        </div>
                        <div class="p-2"> <?php if (permisos::create()) { ?>
                                <button class="btn btn-success btn-sm tablaReparaModal"><i class="fa fa-plus-circle"></i> Nuevo</button>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tbltablaRepara" class="table table-bordered table-striped nowrap display compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th data-orderable="false">Acción</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tablaReparaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/tablareparacion/tablaReparaModal.php'); ?>
</div>

<div class="modal fade" id="duplicaTablaRepModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/tablareparacion/duplicaTablaRepModal.php'); ?>
</div>
<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/modals/motivoElimina.php'); ?>
</div>

<?php footerAdmin($data) ?>
<?php selectfunctions($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>