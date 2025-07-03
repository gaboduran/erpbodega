<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-left mb-2">
                        <h5 class="card-title">Permisos Genereales <?php echo ucwords($data['page_name']) ?></h5>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <form id="frmPermisos" name="frmPermisos" method="POST">
                        <input type="hidden" name="txt_idperfil" id="txt_idperfil" value="<?php echo $data['idperfil']; ?>">
                        <table id="tblPerfilesdet" class="display compact nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Modulo</th>
                                <th>Ver</th>
                                <th>Crear</th>
                                <th>Actualizar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="nuevoPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/perfiles/nuevoPerfil.php'); ?>
</div>
<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/modals/motivoElimina.php'); ?>
</div>
<?php Loader($data) ?>
<?php footerAdmin($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>
