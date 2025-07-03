<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<style>
    @media (min-width: 768px) {
        .dropdown-menu {
            width: 20px !important;
            /* change the number to whatever that you need */
        }
    }


    table#tblRptgnralOperacionYR td:nth-child(1),
    table#tblRptgnralOperacionYR th:nth-child(1) {
        text-align: center;
    }

    .color-rojo {
        color: white;
    }
</style>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?php echo $data['page_name'] ?></h6>
                </div>
                <?php //debug(ctn_ingresomanualModel::getOneIngreso(24)) ?>
                    <form id="frmIngresoCont" name="frmIngresoCont" method="POST">
						<input type="text" id="idingreso" name="idingreso" class="form-control form-control-sm" id="exampleInputEmail1" value="">
						<input type="text" id="operation" name="operation" class="form-control form-control-sm" value="<?php echo $data['operation']  ?>">
						<?php include('../teus/views/Ctn_ingresomanual/formIngreso.php'); ?>
					</form>
                    <div class="card-footer text-center">
                        <button type="button" class="btn btn-info" onclick="procesar();"><i class="fa fa-check"></i> ACEPTAR</button>
                        <button type="button" class="btn btn-success Uploadfotos" id="btn_Uploadfotos" onclick="Uploadfotos();"><i class="fa fa-camera"></i> FOTOS</button>
                        <button type="button" class="btn btn-warning" id="btn_inspeccion" onclick="IngresoDanos();"><i class="fa fa-wrench"></i> INSPECCION</button>
                    </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="devolucionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/Ctn_ingresomanual/devolucionModal.php'); ?>
</div>

<div class="modal fade" id="UploadfotosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/Uploadfotos/UploadfotosModal.php'); ?>
</div>

<div class="modal fade" id="inspeccionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/Ctn_ingresomanual/inspeccionModal.php'); ?>
</div>

<?php Loader($data) ?>
<?php footerAdmin($data) ?>
<?php selectfunctions($data) ?>
<?php functionsJS($data) ?>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" href="<?php echo ASSETS . DS . TEMPLATE . PLUGINS . DS; ?>viewbox/viewbox.css">

<script src="<?php echo ASSETS . DS . TEMPLATE . PLUGINS . DS; ?>viewbox/jquery.viewbox.min.js"></script>
