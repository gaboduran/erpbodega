<form id="frmContenedores" name="frmContenedores" action="" method="POST">
    <div class="modal-dialog" style="max-width:980px!important;">
        <div class="modal-content">
            <div class="modal-header pt-2 pb-2">
                <h5 class="modal-title" id="tituloModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="col-md-12 column">
                            <table class="table table-bordered table-striped nowrap display compact table-hover" style="width:100%" id="tab_logic">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col" bgcolor="17A2B8">
                                            <font color="#fff">CONTENEDOR
                                        </th>
                                        <th class="text-center" scope="col" bgcolor="17A2B8">
                                            <font color="#fff">TIPO
                                        </th>
                                        <th class="text-center" scope="col" bgcolor="17A2B8">
                                            <font color="#fff">DIAS EN PATIO
                                        </th>

                                        <th class="text-center" scope="col" bgcolor="17A2B8">
                                            <font color="#fff">Accion
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form id="form_valores" name="form_valores" action="">
                                    <input type="hidden" name="idlinea" id="idlinea" class="form-control form-control-sm" />
                                    <input type="hidden" name="txt_idpreasignacion" id="txt_idpreasignacion" class="form-control form-control-sm" />
                                        <tr id='addr0'>
                                            <td>
                                                <input type="text" name="txt_ncontenedor" id="txt_ncontenedor" class="form-control form-control-sm"  style="text-transform: uppercase;" maxlength="11"/>
                                            </td>
                                            <td>
                                                <input type="text" name="txt_tipocont" id="txt_tipocont" readonly class="form-control form-control-sm" />
                                                <input type="hidden" name="txt_idtipocont" id="txt_idtipocont" readonly class="form-control form-control-sm" />
                                            </td>
                                            <td>
                                                <input type="text" name="txt_diaspatio" id="txt_diaspatio" disabled class="form-control form-control-sm"  />
                                            </td>
                                            <td>
                                                <input type="submit" onclick="saveContenedor();" class="btn btn-info btn-sm" name="btn_actionItem" id="btn_actionItem" value="Agregar">
                                            </td>
                                        </tr>
                                    </form>
                                    <tr id='addr1'></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table id="tblContenedores" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Contenedor</th>
                                    <th>Tipo</th>
                                    <th>Dias Patio</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex">

                            <div class="p-2">
                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <a class ="btn btn-sm btn-primary" href="javascript:void(0)" id="imprimir_excel" role="button" ><i class="fa fa-cloud-download"></i> Decargar Listado</a>
                                    <button type="button" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Ver Archivo</button>
                                    <button type="button" class="btn btn-sm btn-info" onClick="adjuntarDocumento()" ><i class="fa fa-cloud-upload"></i> Cargar Listado</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="txt_idcliente" id="txt_idcliente" />
                        <input type="hidden" name="operation" id="operation" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</form>
<style>
        .table-responsive {
            width: 100%;
        }
        .display, .dataTables_scrollHeadInner, .no-footer, .dataTable, table tr, table thead{
            width: 100% !important;
        }
    </style>