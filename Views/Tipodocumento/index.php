<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Listado General <?php echo $data['page_name'] ?></h6>
                </div>
                <div class="card-body">
                    <?php if (permisos::create()) { ?>
                        <div class="d-flex justify-content-end mb-2">
                            <button class="btn btn-success btn-sm TipodocumentoModal"><i class="fa fa-plus-circle"></i> Nuevo</button>
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table id="tblTipoDoc" class="table table-bordered table-striped compact nowrap" width="100%">
                        <thead style="background:#343A40; color:white">
                                <tr>
                                    <th>ID</th>
                                    <th>Abreviatura</th>
                                    <th>Descripciòn</th>
                                    <th>Estado</th>
                                    <th style="text-align: center;">Acción</th>
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
<div class="modal fade" id="TipodocumentoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/Tipodocumento/TipodocumentoModal.php'); ?>
</div>
<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/modals/motivoElimina.php'); ?>
</div>
<?php footerAdmin($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>