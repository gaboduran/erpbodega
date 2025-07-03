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
                <?php // debug(ctn_ingresomanualModel::getOneIngreso(26)) 
                ?>
                <form id="frmIngresoCont" name="frmIngresoCont" method="POST">
                    <input type="text" id="idingreso" name="idingreso" class="form-control form-control-sm" id="exampleInputEmail1" value="<?php echo (isset($data['idingreso']) ? ucwords($data['idingreso']) : ''); ?>">
                    <input type="text" id="txt_idlinea" name="txt_idlinea" class="form-control form-control-sm" id="exampleInputEmail1" value="<?php echo (isset($linea[0]->IDLINEA) ? ucwords($linea[0]->IDLINEA) : ''); ?>">
                    <input type="text" id="operation" name="operation" class="form-control form-control-sm" value="">
                </form>
                <div class="col-md-12 col-sm-12">
                    <div class="container mt-1">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="p-3">

                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label for="fname" class="control-label">First Name</label>
                                            <label for="fname" class="control-label">First Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 text-white">Column 2</div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 text-white">Column 3</div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 text-white">Column 4</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="container mt-1">
                        <div class="table-responsive">
                            <div class="p-2" align="right">
                                <?php if (permisos::create()) { ?>
                                    <button class="btn btn-success danosModal"><i class="fa fa-plus-circle"></i> Agregar</button>

                                <?php } ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title no-link last"><span class="nobr">Acción</span>
                                            <th class="column-title">Componente </th>
                                            <th class="column-title">Ubicación </th>
                                            <th class="column-title">Daño </th>
                                            <th class="column-title">Reperación </th>
                                            <th class="column-title">Largo </th>
                                            <th class="column-title">Ancho </th>
                                            <th class="column-title">Cantidad </th>
                                            <th class="column-title">Cargo </th>
                                            <th class="column-title">Horas </th>
                                            <th class="text-right column-title">C.H.H.</th>
                                            <th class="text-right column-title">C.M.</th>
                                            <th class="text-right column-title">C.Total</th>
                                            </th>
                                            <th class="bulk-actions" colspan="7">
                                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="detelleDanos">
                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
         
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="danoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/Ctn_ingresomanual/danoModal.php'); ?>
</div>


<div class="modal fade" id="medidasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/Ctn_ingresomanual/medidasModal.php'); ?>
</div>


<div class="modal fade" id="unidadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/Ctn_ingresomanual/unidadModal.php'); ?>
</div>


<div class="modal fade" id="UploadfotosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/Uploadfotos/UploadfotosModal.php'); ?>
</div>

<?php Loader($data) ?>
<?php footerAdmin($data) ?>
<?php selectfunctions($data) ?>
<?php functionsJS($data) ?>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" href="<?php echo ASSETS . DS . TEMPLATE . PLUGINS . DS; ?>viewbox/viewbox.css">

<script src="<?php echo ASSETS . DS . TEMPLATE . PLUGINS . DS; ?>viewbox/jquery.viewbox.min.js"></script>