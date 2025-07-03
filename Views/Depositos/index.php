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
                    <div class="row">
                        <?php if (permisos::create()) { ?>
                            <div class="d-flex justify-content-end mb-2">
                                <a href="<?= base_url ?>depositos/nuevo" class=""><button class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Nuevo</button></a>
                            </div>
                        <?php } ?>
                        <div class="table-responsive">
                            <table id="tblDepositos" class="table table-bordered table-striped compact nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>id</th>
                                        <th>Nombre</th>
                                        <th>Ubicacion</th>
                                        <th>Inventario</th>
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
</div>

<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/modals/motivoElimina.php'); ?>
</div>
<?php footerAdmin($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>