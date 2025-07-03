<div class="modal-dialog" style="max-width:980px!important;">
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
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Generales</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="unidad-tab" data-toggle="tab" href="#unidad" role="tab" aria-controls="unidad" aria-selected="false">Valores Unidad</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="tarifas-tab" data-toggle="tab" href="#tarifas" role="tab" aria-controls="tarifas" aria-selected="false">Valores Area-Lineal</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <form id="frmnuevoItemTabla" name="frmnuevoItemTabla" action="" method="POST">
            <input type="text" id="txt_iditem" name="txt_iditem" class="form-control form-control-sm">
            <input type="text" id="txt_idtabla" name="txt_idtabla" class="form-control form-control-sm custom4" value="<?php echo $data['idtabla']; ?>">
            <input type="text" id="operation" name="operation" class="form-control form-control-sm custom4">
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Componente</label>
                  <select class="form-control form-control-sm" name="sel_componente" id="sel_componente" style="width: 100%;">
                    <option value="">Seleecione Componente</option>
                    <?php for ($i = 0; $i < count($componente); $i++) { ?>
                      <option value="<?php echo ucwords($componente[$i]->CODIGO); ?>"><?php echo ucwords($componente[$i]->CONJUNTO); ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Reparacion</label>
                  <select class="form-control form-control-sm" name="sel_reparacion" id="sel_reparacion" style="width: 100%;">
                    <option value="">Seleecione reparación</option>
                    <?php for ($i = 0; $i < count($reparacion); $i++) { ?>
                      <option value="<?php echo ucwords($reparacion[$i]->CODREPARA); ?>"><?php echo ucwords($reparacion[$i]->CONJUNTO); ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Grupo Tipo de Contenedor</label>
                  <select class="selectGrupo form-control form-control-sm" name="sel_grupotipo[]" id="sel_grupotipo" multiple="multiple" data-placeholder="Grupo Contenedor" style="width: 100%;">
                    <?php for ($i = 0; $i < count($GrupoTipoCont); $i++) { ?>
                      <option value="<?php echo ucwords($GrupoTipoCont[$i]->CODIGO); ?>"><?php echo ucwords($GrupoTipoCont[$i]->CODIGO); ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Material</label>
                  <select class="form-control form-control-sm" name="sel_material" id="sel_material" style="width: 100%;">
                    <option value="">Seleecione Material</option>
                    <?php for ($i = 0; $i < count($material); $i++) { ?>
                      <option value="<?php echo ucwords($material[$i]->CODIGO); ?>"><?php echo ucwords($material[$i]->CONJUNTO); ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Tamaño</label>
                  <select class="selectTamano form-control form-control-sm" name="sel_tamano[]" id="sel_tamano" multiple="multiple" data-placeholder="Tamano" style="width: 100%;">
                    <?php for ($i = 0; $i < count($tamano); $i++) { ?>
                      <option value="<?php echo ucwords($tamano[$i]->TAMANO); ?>"><?php echo ucwords($tamano[$i]->TAMANO); ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Localización</label>
                  <select class="form-control form-control-sm" name="sel_localiza" id="sel_localiza" style="width: 100%;">
                    <option value="" selected>Seleecione Localización</option>

                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Tipo Liquidacion</label>
                  <select class="form-control form-control-sm" name="sel_tipoliquida" id="sel_tipoliquida" style="width: 100%;">
                    <option value="">Seleecione Tipo Liquidacion</option>
                    <?php for ($i = 0; $i < count($tipoliquida); $i++) { ?>
                      <option value="<?php echo strtoupper($tipoliquida[$i]->CODIGO); ?>"><?php echo strtoupper($tipoliquida[$i]->CODIGO); ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Unidad Medida</label>
                  <select class="form-control form-control-sm" name="sel_unidad" id="sel_unidad" style="width: 100%;">
                    <option value="">Seleecione Unidad Medida</option>

                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label>Tipo Reparacion</label>
                  <select class="form-control form-control-sm" name="sel_tiporepara" id="sel_tiporepara" style="width: 100%;">
                    <option value="">Seleecione Tipo Liquidacion</option>
                    <?php for ($i = 0; $i < count($tiporepara); $i++) { ?>
                      <option value="<?php echo strtoupper($tiporepara[$i]->CODIGO); ?>"><?php echo ucwords($tiporepara[$i]->DESCRIPCION); ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 ">
                <div class="form-group">
                  <label>Estado</label>
                  <?php if (!isset($usuario[0]->ESTADO)) { ?>
                    <select class="form-control form-control-sm" name="sel_estado" id="sel_estado" required>
                      <option selected value="1">Activo</option>
                      <option value="0">Inativo</option>
                    </select>
                  <?php } else { ?>
                    <select class="form-control form-control-sm" name="sel_estado" id="sel_estado" required>
                      <option selected value="<?php echo $usuario[0]->ESTADO; ?>"> <?php echo ucwords($usuario[0]->DESCESTADO); ?> </option>
                      <?php for ($i = 0; $i < count($estado); $i++) { ?>
                        <option value="<?php echo $estado[$i]->ID; ?>"> <?php echo ucwords($estado[$i]->DESCESTADO); ?> </option>
                      <?php } ?>
                    </select>
                  <?php }  ?>
                </div>
              </div>
            </div>
            <hr class="border-bottom border-1 border-light">
            <div align="center">
              <input type="submit" onclick="procesarItem();" class="btn btn-info btn-sm" name="action" id="action" value="Aceptar">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
        <div class="tab-pane fade" id="tarifas" role="tabpanel" aria-labelledby="tarifas-tab">
          <div class="row clearfix">
            <div class="col-md-12 column">
              <table class="table table-bordered table-striped nowrap display compact table-hover" id="tab_logic" style="width: 100% !important;margin-left: 0px;">
                <thead>
                  <tr>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">LARGO
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">ANCHO
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">TIEMPO
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">VLR. MATERIAL
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">Accion
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <form id="form_valores" name="form_valores" action="">
                    <input type="text" name="operation_item" id="operation_item" class="form-control form-control-sm" />
                    <input type="text" name="txt_id" id="txt_id" class="form-control form-control-sm" />
                    <tr id='addr0'>
                      <td>
                        <input type="text" name="txt_largo" id="txt_largo" class="form-control form-control-sm" onChange="this.value = devuelve_float(this.value, '')" />
                      </td>
                      <td>
                        <input type="text" name="txt_ancho" id="txt_ancho" class="form-control form-control-sm" onChange="this.value = devuelve_float(this.value, '')" />
                      </td>
                      <td>
                        <input type="text" name="txt_hh" id="txt_hh" class="form-control form-control-sm" onChange="this.value = devuelve_float(this.value, '')" />
                      </td>
                      <td>
                        <input type="text" name="txt_vlrmaterial" id="txt_vlrmaterial" class="form-control form-control-sm" onChange="this.value = devuelve_float(this.value, '')" />
                      </td>
                      <td>
                        <input type="submit" onclick="addValoresItem();" class="btn btn-info btn-sm" name="btn_actionItem" id="btn_actionItem" value="Agregar">
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
              <div class="d-flex">
                <div class="mr-auto p-2">
                  <button class="btn btn-info btn-sm" onclick="LimpiarForm();" > Limipar</button>
                </div>
                <div class="p-2"> 
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button type="button" class="btn btn-sm btn-success">Ver Archivo</button>
                    <button type="button" class="btn btn-sm btn-info">Cargar Listado</button>
                    <button type="button" class="btn btn-sm btn-danger">Eliminar Listado</button>
                  </div>
                </div>
              </div>
              <table class="table table-bordered table-striped nowrap display compact table-hover mt-1" id="tab_logic">
                <thead>
                  <tr>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">LARGO
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">ANCHO
                    </th>
                    <th class="text-right" scope="col" bgcolor="17A2B8">
                      <font color="#fff">HORAS HOMBRE
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">CHH
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">VLR. MATERIAL
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">TOTAL
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">Accion
                    </th>
                  </tr>
                </thead>
                <tbody id='detalleValoresbyItem'>

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="unidad" role="tabpanel" aria-labelledby="unidad-tab">
          <div class="row clearfix">
            <div class="col-md-12 column">
              <table class="table table-bordered table-striped nowrap display compact table-hover" id="tab_logic" style="width: 100% !important;margin-left: 0px;">
                <thead>
                  <tr>
                   <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">CANTIDAD
                    </th>
                     <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">TIEMPO
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">VLR. MATERIAL
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">Accion
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <form id="form_valoresunidad" name="form_valoresunidad" action="">
                    <input type="text" name="operation_itemund" id="operation_itemund" class="form-control form-control-sm" />
                    <input type="text" name="txt_idund" id="txt_idund" class="form-control form-control-sm" />
                    <tr id='addr0'>
                    <td>
                        <input type="text" name="txt_cantidad" id="txt_cantidad" class="form-control form-control-sm" onChange="this.value = devuelve_float(this.value, '')" />
                      </td>
                      <td>
                        <input type="text" name="txt_hhund" id="txt_hhund" class="form-control form-control-sm" onChange="this.value = devuelve_float(this.value, '')" />
                      </td>
                      <td>
                        <input type="text" name="txt_vlrmaterialund" id="txt_vlrmaterialund" class="form-control form-control-sm" onChange="this.value = devuelve_float(this.value, '')" />
                      </td>
                      <td>
                        <input type="submit" onclick="addValoresItemUnidad();" class="btn btn-info btn-sm" name="btn_actionItemund" id="btn_actionItemund" value="Agregar">
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
              <div class="d-flex">
                <div class="mr-auto p-2">
                  <button class="btn btn-info btn-sm" onclick="LimpiarForm();" > Limipar</button>
                </div>
                <div class="p-2"> 
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button type="button" class="btn btn-sm btn-success">Ver Archivo</button>
                    <button type="button" class="btn btn-sm btn-info">Cargar Listado</button>
                    <button type="button" class="btn btn-sm btn-danger">Eliminar Listado</button>
                  </div>
                </div>
              </div>
              <table class="table table-bordered table-striped nowrap display compact table-hover mt-1" id="tab_logic">
                <thead>
                  <tr>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">CANTIDAD
                    </th>
                    <th class="text-right" scope="col" bgcolor="17A2B8">
                      <font color="#fff">HORAS HOMBRE
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">CHH
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">VLR. MATERIAL
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">TOTAL
                    </th>
                    <th class="text-center" scope="col" bgcolor="17A2B8">
                      <font color="#fff">Accion
                    </th>
                  </tr>
                </thead>
                <tbody id='detalleValoresbyItemUnd'>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  

  table.display tr{
    width: 100% !important;
  }
  table tr{
    width: 100% !important;
  }
</style>