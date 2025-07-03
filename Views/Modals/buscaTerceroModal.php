<form id="frmBuscaTercero" name="frmBuscaTercero" action="" method="POST">
  <div class="modal-dialog" style="max-width:480px!important;">
    <div class="modal-content">
      <div class="modal-header pt-2 pb-2">
        <h5 class="modal-title" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row">
        <div class="col-md-12">
          <fieldset class="border p-1">

            <div class="form-row">
              <div class="col-md-5">
                <select class="form-control form-control-sm" name="sel_criterio_tercero" id="sel_criterio_tercero" required>
                  <option value="I">Identificacion</option>
                  <option value="N">Nombre</option>
                </select>
              </div>
              <div class="col-md-5">
                <input type="text" class="form-control form-control-sm" name="parametro_tercero" id="parametro_tercero">
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-sm btn-success" id="btnBuscaTercero" name="btnBuscaTercero" onclick="getTercero();">Aceptar</button> 
              </div>
            </div>
          </fieldset>
        </div>
      </div>
    </br>
      <div class="row">
       <div class="col-md-12">
        <table  class="table table-hover table-sm table-bordered" style="width:100%" id="tblBuscaTercero">
          <thead>
            <tr>
              <th scope="col"><font color="#fff">Identificación</th>
              <th scope="col"><font color="#fff">Nombre</th>
              <th scope="col"><font color="#fff">Acción</th>
            </tr>
          </thead>
          <tbody id="ResultBuscaTercero" name="ResultBuscaTercero">
           <tr>
             <td colspan="3">No hay resultados</td>
           </tr>
         </tbody>
       </table>
     </div>

   </div>
 </div>
</div>
</div>
</form>