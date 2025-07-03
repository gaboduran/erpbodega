  
<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
           <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <h6><i class="fa fa-retweet"></i> <?Php echo $data['page_name']; ?></h6>
                    </h3>
                </div>
                <div class="card-body">
                    <?php if(permisos::create()){ ?>
                         <div align="right">
                            <button class="btn btn-success btn-sm nuevoCategoriaModal"><i class="fa fa-plus-circle"></i> Nuevo</button>
                        </div>
                    <?php }?>
                    <div id="test" style="float: right;"></div>
                     <table id="tblCategoria" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora Inical</th>
                                <th>Hora Final</th>
                                <th># Citas</th>
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

<div class="modal fade" id="categoriaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/categoria/categoriaModal.php');?>
</div>
<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/modals/motivoElimina.php');?>
</div>
<?php footerAdmin($data) ?>