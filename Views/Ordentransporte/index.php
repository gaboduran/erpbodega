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

    .columna-1 {
            width: 500px;
        }
        .columna-2 {
            width: 60px;
        }
        .columna-3 {
            width: 40px;
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
                                <button class="btn btn-success btn-sm Ordentransporte"><i class="fa fa-plus-circle"></i> Nuevo</button>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tblIsoCodes" class="table table-bordered table-striped compact nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID Orden</th>
                                    <th>Cliente</th>
                                    <th>Tipo Orden</th>
                                    <th>Fecha Vence</th>
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
<div class="modal fade" id="ordenTransporteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/Ordentransporte/ordenTransporteModal.php'); ?>
</div>
<?php footerAdmin($data) ?>
<?php datatables($data) ?>
<?php selectfunctions($data) ?>
<?php functionsJS($data) ?>