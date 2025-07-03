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
                    <h6 class="card-title">Erro</h6>
                </div>
                <div class="text-center">
                        <img src="/" class="rounded" alt="...">

                    <h1>VAMOS A PROBAR</h1>
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
