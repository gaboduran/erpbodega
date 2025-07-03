<form id="frmdetReserva" name="frmdetReserva" action="" method="POST">
  <div class="modal-dialog" style="max-width:480px!important;">
    <div class="modal-content">
      <div class="modal-header pt-2 pb-2">
        <h5 class="modal-title" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="tablaDetalle table table-bordered" id="tablaDetalle">
                <tbody>
                    <tr id="trcontenedor">
                        <th scope="row"># Contenedor</th>
                        <td colspan="3" id="ncont"></td>
                    </tr>
                    <tr id="trtamano">
                        <th scope="row">Tamaño</th>
                        <td colspan="3" id="tamano"></td>
                    </tr>
                    <tr id="trtipo">
                        <th scope="row">Tipo</th>
                        <td colspan="3" id="tipo"></td>
                    </tr>
                    <tr id="trtara">
                        <th scope="row">Tara</th>
                        <td colspan="3" id="tara"></td>
                    </tr>
                    <tr id="trestado">
                        <th scope="row">Estado</th>
                        <td colspan="3" id="estado"></td>
                    </tr>
                    <tr id="trguia">
                        <th scope="row"># Guia</th>
                        <td colspan="3" id="guia"></td>
                    </tr>
                    <tr id="trlinea">
                        <th scope="row">Linea</th>
                        <td colspan="3" id="linea"></td>
                    </tr>
                    <tr id="trbl">
                        <th scope="row">BL</th>
                        <td colspan="3" id="bl"></td>
                    </tr>
                    <tr id="trfingreso">
                        <th scope="row">Fecha Ingreso</th>
                        <td colspan="3" id="fingreso"></td>
                    </tr>
                    <tr id="trtotalguia">
                        <th scope="row">Total Guia</th>
                        <td colspan="3" id="totalguia"></td>
                    </tr>
                    <tr id="trpatio">
                        <th scope="row">Patio</th>
                        <td colspan="3" id="patio"></td>
                    </tr>
                    <tr id="trcliente">
                        <th scope="row">Cliente</th>
                        <td colspan="3" id="cliente"></td>
                    </tr>
                    <tr id="trnitcliente">
                        <th scope="row">Nit cliente</th>
                        <td colspan="3" id="nitcliente"></td>
                    </tr>
                </tbody>
            </table>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-info btn-sm" onclick="procesardetalleReserva();" name="action" id="action" value="Aceptar">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</form>