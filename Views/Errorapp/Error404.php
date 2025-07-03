<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Error detectado</h6>
                </div>
                <div class="text-center">
                    <img src="../image/error404.png" class="rounded" alt="...">
                    <h6>El recurso que está buscando no existe, es posible que haya </h6>
                    <h6>sido movido o no está disponible temporalmente</h6>
                    <a href="<?= base_url ?>ctn_consultaingreso"><button type="button" class="btn btn-info">Regresar</button></a>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php footerAdmin($data) ?>
<?php functionsJS($data) ?>