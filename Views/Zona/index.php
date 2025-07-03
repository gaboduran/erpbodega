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
                        <div class="p-2"> <?php if (permisos::create()) { ?>
                                <button class="btn btn-success btn-sm zonaModal"><i class="fa fa-plus-circle"></i> Nuevo</button>
                            <?php } ?>
                        </div>
                    </div>
                    <table id="tblDanos" class="table table-bordered table-striped nowrap display compact" style="width:100%">
                            <thead style="background:#343A40; color:white">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Bahias</th>
                                        <th>Filas</th>
                                        <th>Alto</th>
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
<div class="modal fade" id="zonaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/zona/zonaModal.php'); ?>
</div>
<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/modals/motivoElimina.php'); ?>
</div>

<?php footerAdmin($data) ?>
<?php selectfunctions($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>