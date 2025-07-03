  
<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
           <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <h6><?Php echo $data['page_name']; ?></h6>
                    </h3>
                </div>
                <div class="card-body">
                    <?php if(permisos::create()){ ?>
                         <div align="right">
                            <a href="<?= base_url ?>contrato/nuevo" class=""><button class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Nuevo</button></a>
                        </div>
                    <?php }?>
                    <div id="test" style="float: right;"></div>
                     <table id="tblContrato" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Periodo Facturación</th>
                                <th>Moneda</th>
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
<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/modals/motivoElimina.php');?>
</div>

<?php footerAdmin($data) ?>