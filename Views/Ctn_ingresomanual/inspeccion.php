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


    .celda-personalizada {
        font-weight: bold;
        /* Texto en negrilla */
        background-color: #d3d3d3;
        /* Fondo gris claro */
        padding: 10px;
        /* Opcional: Añadir un poco de espacio interno */
        text-align: left;
        /* Opcional: Alinear el texto a la izquierda (puedes cambiarlo a 'center' o 'right') */
    }
</style>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-11 col-sm-11 mx-auto">
            <div class="card mb-2">
                <div class="card-header">
                    <h6 class="card-title"><?php echo $data['page_name'] ?></h6>
                </div>
                <form id="frmIngresoCont" name="frmIngresoCont" method="POST">
                    <input type="hidden" id="idingreso" name="idingreso" class="form-control form-control-sm" value="<?php echo (isset($data['idingreso']) ? ucwords($data['idingreso']) : ''); ?>">

                    <input type="hidden" id="txt_idlinea" name="txt_idlinea" class="form-control form-control-sm" value="<?php echo (isset($linea[0]->IDLINEA) ? ucwords($linea[0]->IDLINEA) : ''); ?>">

                    <input type="hidden" id="operation" name="operation" class="form-control form-control-sm" value="">
                </form>
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="container mt-1">
                        <div class="table-responsive">
                            <table class="table table-bordered jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title" colspan="14">DETALLE INGRESO </th>

                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3">Conteneodor</td>
                                        <td colspan="3" id="txt_contenedor" class="celda-personalizada"></td>
                                        <td>Tipo</td>
                                        <td id="txt_tipocontenedor" class="celda-personalizada"></td>
                                        <td>Lineas Naviera</td>
                                        <td colspan="3" id="txt_nomlinea" class="celda-personalizada"></td>
                                        <td>Fecha Ingreso</td>
                                        <td colspan="" id="txt_fechaingreso" class="celda-personalizada"></td>

                                    </tr>
                                    <tr>
                                        <td colspan="3">Fecha Fabricación</td>
                                        <td colspan="3" id="txt_fabricacion" class="celda-personalizada"></td>

                                        <td colspan="1">Payload</td>
                                        <td colspan="2" id="txt_payload" class="celda-personalizada"></td>

                                        <td colspan="2">Tara</td>
                                        <td id="txt_tara" class="celda-personalizada"></td>
                                        <td colspan="1">Isocode</td>
                                        <td>45G1</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Movimiento</td>
                                        <td colspan="4" id="txt_movimiento" class="celda-personalizada"></td>
                                        <td>Patio</td>
                                        <td colspan="3" id="txt_deposito" class="celda-personalizada"></td>
                                        <td colspan="2">COMODATO / BL</td>
                                        <td colspan="2" id="txt_comodato" class="celda-personalizada"></td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Cliente / Tercero</td>
                                        <td colspan="5" id="txt_cliente" class="celda-personalizada"> </td>
                                        <td colspan="2">Tranportes</td>
                                        <td colspan="5" id="txt_transporte" class="celda-personalizada"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Conductor</td>
                                        <td colspan="4" id="txt_nomconductor" class="celda-personalizada"></td>
                                        <td>Placa</td>
                                        <td id="txt_placa" class="celda-personalizada"></td>
                                        <td>Telefono</td>
                                        <td id="txt_telefono" class="celda-personalizada"></td>
                                        <td>Inspector</td>
                                        <td colspan="2" id="txt_inspector" class="celda-personalizada">Ramon Arevalo</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Estado</td>
                                        <td colspan="4">
                                            <select class="form-control form-control-sm" name="sel_clasificacion" id="sel_clasificacion" required>
                                                <option value="" selected>Seleecione Tipo</option>
                                                <?php for ($i = 0; $i < count($data['estadolinea']); $i++) { ?>
                                                    <option value="<?php echo ucwords(string: $data['estadolinea'][$i]->ID); ?>"><?php echo ucwords(string: $data['estadolinea'][$i]->DESCRIPCION); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td colspan="1">Categoria</td>
                                        <td colspan="3">
                                            <select class="form-control form-control-sm" name="sel_categoria" id="sel_categoria" required>
                                                <option value="" selected>Seleecione Categoria</option>
                                                <?php for ($i = 0; $i < count($data['categorialinea']); $i++) { ?>
                                                    <option value="<?php echo ucwords($data['categorialinea'][$i]->ID); ?>"><?php echo ucwords(string: $data['categorialinea'][$i]->NOMCATEGORIA); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td colspan="1">Condición General</td>
                                        <td colspan="3">
                                            <select class="form-control form-control-sm" name="sel_condiciongral" id="sel_condiciongral" required>
                                                <option value="" selected>Seleecione Condición</option>
                                                <option value="O">Operativo</option>
                                                <option value="D">Dañado</option>

                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-info btn-sm" onclick="actualizaEstado();"><i class="fa fa-check"></i> ACEPTAR</button>

                </div>


            </div>
        </div>
        <div class="col-md-12 col-sm-12 mt-1">
            <div class="card mb-2">
                <div class="col-md-12 col-sm-12 mt-2">
                    <div class="container mt-1">
                        <div class="table-responsive">
                        <?php if ($data['estadotablarep'][0]->CONTEO == 1) {?>
                            <div class="p-2" align="left">
                                <div class="btn-group dropright">
                                    <button class="btn btn-success btn-sm danosModal"><i class="fa fa-plus-circle"></i> Nuevo</button>
                                    <button class="btn btn-warning btn-sm"><i class="fa fa-camera"></i> Fotos</button>

                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paper-plane"></i>
                                        EDI
                                    </button>
                                    <div class="dropdown-menu">
                                        <form id="frmRptGeneralMaestro" name="frmRptGeneralMaestro" method="POST" action="">
                                            <a class="dropdown-item" href="javascript:void(0)" id="imprimir_excel"> Ingreso</a>
                                        </form>
                                        <a class="dropdown-item" href="javascript:void(0)" id="imprimir_listado"> Daños</a>

                                    </div>
                                </div>
                            </div>
                            <?php } ?>
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
<?php helperNumericos($data) ?>


<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" href="<?php echo ASSETS . DS . TEMPLATE . PLUGINS . DS; ?>viewbox/viewbox.css">

<script src="<?php echo ASSETS . DS . TEMPLATE . PLUGINS . DS; ?>viewbox/jquery.viewbox.min.js"></script>