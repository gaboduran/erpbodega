<div class="modal-dialog" style="max-width:780px!important;">
  <div class="modal-content">
    <div class="modal-header pt-2 pb-2">
      <h5 class="modal-title" id="tituloModal"></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos Generales</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="empresas-tab" data-toggle="tab" href="#empresas" role="tab" aria-controls="empresas" aria-selected="false">Empresas</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <form id="frmOrdenTransporte" name="frmOrdenTransporte" action="" method="POST">
            <input type="hidden" id="txt_idorden" name="txt_idorden" class="form-control form-control-sm" value="">
            <input type="hidden" id="operation" name="operation" class="form-control form-control-sm custom4" value="">
            <div class="row">
              <div class="col-md-8 col-sm-8">
                <div class="form-group">
                  <label>Cliente</label>
                  <select class="form-control form-control-sm select2" name="sel_cliente" id="sel_cliente" style="width: 100%;">
                    <option value="">Seleecione Cliente</option>
                    <?php  for ($i=0; $i < count($linea); $i++) { ?> 
                      <option value="<?php echo ucwords($linea[$i]->ID); ?>"><?php echo ucwords($linea[$i]->NOMCLIENTE); ?></optio>
                    <?php } ?>  
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="form-group">
                  <label>Tipo Orden</label>
                  <select class="form-control" name="sel_tiorden" id="sel_tiorden" style="width: 100%;">
                    <option value="">Seleecione Tipo Orden</option>
                    <?php  for ($i=0; $i < count($tipoorden); $i++) { ?> 
                      <option value="<?php echo ucwords($tipoorden[$i]->ID); ?>"><?php echo ucwords($tipoorden[$i]->DESCRIPCION); ?></optio>
                    <?php } ?>  
                  </select>
                </div>
              </div>
            </div>

            <hr class="border-bottom border-1 border-light">
            <div align="center">
              <input type="submit" onclick="procesar();" class="btn btn-info btn-sm" name="action" id="action" value="Aceptar">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
        <div class="tab-pane fade" id="empresas" role="tabpanel" aria-labelledby="empresas-tab">
          <div class="row clearfix">
            <div class="col-md-12 column">
              <table class="table table-bordered table-striped nowrap display compact table-hover" id="tab_logic">
                <thead>
                  <tr>
                    <th class="columna-1 text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">EMPRESA TRANSPORTE
                    </th>
                    <th  class="columna-2 text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">CANTIDAD
                    </th>
                    <th class="columna-3 text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">Acción
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <form id="form_valores" name="form_valores" action="">
                    <input type="hidden" name="operation_item" id="operation_item" class="form-control form-control-sm" />
                    <input type="hidden" name="txt_id" id="txt_id" class="form-control form-control-sm" />
                    <tr id='addr0'>
                      <td>
                      <input type="hidden" name="txt_idtransporte" id="txt_idtransporte" class="form-control form-control-sm" />
                        <input type="text" name="txt_nomtransporte" id="txt_nomtransporte" class="form-control form-control-sm" />
                      </td>
                      <td  WIDTH="10">
                        <input type="text" name="txt_cantidad" id="txt_cantidad" class="form-control form-control-sm" maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" />
                      </td>
                      <td>
                        <input type="submit" onclick="procesarTransporte();" class="btn btn-info btn-sm" name="btn_actionItem" id="btn_actionItem" value="Agregar">
                      </td>
                    </tr>
                  </form>
                  <tr id='addr1'></tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col-md-12 column">
              <table class="table table-bordered table-striped nowrap display compact table-hover mt-1" id="tab_logic">
                <thead>
                  <tr>
                    <th class="columna-1 text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">EMPRESA
                    </th>
                    <th class="columna-2 text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">CANTIDAD
                    </th>
                    <th class="columna-3 text-right" scope="col" bgcolor="17A2B8">
                      <font color="#fff">ACCION
                    </th>
                  </tr>
                </thead>
                <tbody id='detalleTransporteOrden'>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>