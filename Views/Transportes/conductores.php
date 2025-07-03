<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>

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
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Exportar
                                </button>
                                <div class="dropdown-menu">
                                    <form id="frmRptGeneralMaestro" name="frmRptGeneralMaestro" method="POST" action="<?php echo base_url; ?>views/reportes/pruebaExel.php">
                                        <a class="dropdown-item" href="javascript:void(0)" id="imprimir_excel"><img src="<?php echo base_url ?>/image/app/excel.png" height="30" width="40" /> Excel</a>
                                    </form>
                                    <a class="dropdown-item" href="javascript:void(0)" id="imprimir_listado"><img src="<?php echo base_url ?>/image/app/pdf.png" height="35" width="40" /> PDF</a>

                                </div>
                            </div>
                        </div>
                        <div class="p-2"> <?php if (permisos::create()) { ?>
                                <button class="btn btn-success btn-sm conductoresModal"><i class="fa fa-plus-circle"></i> Nuevo</button>
                            <?php } ?>
                        </div>
                    </div>
                    <?php //debug(Permisos::getPermisosMoludos(1)) ?>
                    <div class="table-responsive">
                        <table id="tblConductores" class="table table-bordered table-striped compact nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Tamaño</th>
                                    <th>Linea</th>
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


<div class="modal fade" id="conductoresModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<?php include('../teus/views/Transportes/conductoresModal.php'); ?>
</div>

<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/modals/motivoElimina.php'); ?>
</div>

<?php footerAdmin($data) ?>
<?php datatables($data) ?>

<?php functionsJS($data) ?>