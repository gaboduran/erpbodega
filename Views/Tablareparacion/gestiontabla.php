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
                                <button class="btn btn-success btn-sm ItemTablaModal"><i class="fa fa-plus-circle"></i> Nuevo</button>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                    <input type="hidden" id="txt_idtabla" name="txt_idtabla" class="form-control form-control-sm" value="<?php echo $data['idtabla']; ?>">
                    <table id="tblDetatablaReparacion" class="table table-bordered table-striped compact nowrap" style="width:100%">
                            <thead>
                                <tr>                                   
                                    <th>Id Item</th>
                                    <th>Componente</th>
                                    <th>Reparacion</th>
                                    <th>Tipo Liquidacion</th>
                                    <th>Tipo Reparacion</th>
                                    <th>Grupo</th>
                                    <th>Material</th>
                                    <th>Localizacion</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="duplicaItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <?php include('../teus/views/tablareparacion/duplicaItemModal.php');?>
</div>
<div class="modal fade" id="ItemTablaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" tabindex="-1">
      <?php include('../teus/views/tablareparacion/ItemTablaModal.php');?>
</div>
<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/modals/motivoElimina.php');?>
</div>
<?php footerAdmin($data) ?>
<?php selectfunctions($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>