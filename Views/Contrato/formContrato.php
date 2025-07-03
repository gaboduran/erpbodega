<form id="frmDatosContrato" name="frmDatosContrato" method="POST">
	<div class="card">
		<div class="card-header" style="background-color: #5bc0de; height: 35px; color: white !important; font-weight: bold;" >DATOS BASICOS</div>
		<div class="card-body">
			<div class="row">
				<input type="hidden" id="operation" name="operation" class="form-control form-control-sm" value="<?php echo $data['operation']; ?>" >
				<input type="hidden" id="idcontrato" name="idcontrato" class="form-control form-control-sm" value="<?php echo isset($contratoinfo[0]->ID) ? ucwords($contratoinfo[0]->ID) : '' ;?>" required>
				<input type="hidden" id="txt_idecliente_1" name="txt_idecliente_1" class="form-control form-control-sm" value="<?php echo isset($contratoinfo[0]->IDECLIENTE) ? ucwords($contratoinfo[0]->IDECLIENTE) : '' ;?>" required>
				<div class="col-md-4 col-sm-4 ">
					<div class="form-group">
						<label for="exampleInputEmail1">Identificacion Cliente</label>
						<div class="input-group">
							<input type="text" id="txt_idecliente" name="txt_idecliente" class="form-control form-control-sm" value="<?php echo isset($contratoinfo[0]->IDECLIENTE) ? ucwords($contratoinfo[0]->IDECLIENTE) : '' ?>">
							<span class="input-group-btn">
								<button id="buscaCliente" class="btn btn-info btn-sm  buscaCliente" type="button"><i class="fas fa-search"></i></button></span>
							</div>
						</div>
					</div>
					<div class="col-md-8 col-sm-8">
						<div class="form-group">
							<label for="exampleInputEmail1">Nombre Cliente</label>
							<input type="text" id="txt_nomcliente" name="txt_nomcliente" class="form-control form-control-sm" id="txt_nomcliente" value="<?php echo isset($contratoinfo[0]->NOMCLIENTE) ? ucwords($contratoinfo[0]->NOMCLIENTE) : '' ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<?php //debug(Listas::getNoAllMoneda($contratoinfo[0]->MONDEDA)); ?>
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Perido de Facturacion</label>
							<select class="form-control form-control-sm" name="sel_perfactura" id="sel_perfactura" required>
								<option value="<?php echo isset($contratoinfo[0]->PERIODOFACTURA) ? ucwords($contratoinfo[0]->PERIODOFACTURA) : '' ?>" selected><?php echo isset($contratoinfo[0]->NOMPERIODO) ? ucwords($contratoinfo[0]->NOMPERIODO) : '' ?></option>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Moneda Facturacion</label>
							<select class="form-control form-control-sm" name="sel_moneda" id="sel_moneda" required>

							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label >Estado</label>
							<select class="form-control form-control-sm" name="sel_estado" id="sel_estado" required>
								
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer text-center">
				<button type="button" class="btn btn-sm btn-success" name="btnSavecontrato" id="btnSavecontrato" onclick="procesarContrato();">Aceptar</button>
				<a href="<?= base_url ?>contrato"><button type="button" class="btn btn-sm btn-secondary">Cancelar</button></a>
			</div>
		</div>
	</form>
</div>
<div class="col-md-12 col-sm-12">
	<div class="card">
		<div class="card-header" style="background-color: #5bc0de; height: 35px; color: white !important; font-weight: bold;" >TARIFAS</div>
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-sm-12">
					<div class="card card-info card-outline card-outline-tabs">
						<div class="card-header p-0 border-bottom-0">
							<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="almacenamiento-tab" data-toggle="pill" href="#almacenamiento" role="tab" aria-controls="almacenamiento" aria-selected="true">Almacenamiento</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="inspeccion-tab" data-toggle="pill" href="#inspeccion" role="tab" aria-controls="inspeccion" aria-selected="false">Inspección</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="manipuleo-tab" data-toggle="pill" href="#manipuleo" role="tab" aria-controls="manipuleo" aria-selected="false">Manipuleo</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="taller-tab" data-toggle="pill" href="#taller" role="tab" aria-controls="taller" aria-selected="false">Taller</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="transporte-tab" data-toggle="pill" href="#transporte" role="tab" aria-controls="transporte" aria-selected="false">Transporte</a>
								</li>
							</ul>
						</div>
						<div class="card-body  d-flex flex-column">
							<div class="tab-content" id="custom-tabs-four-tabContent">
								<div class="tab-pane fade show active" id="almacenamiento" role="tabpanel" aria-labelledby="almacenamiento-tab">
									<form id="frmAddTarifaAlacenamiento" name="frmAddTarifaAlacenamiento" method="POST">
										<input type="hidden" id="txt_idcontrato" name="txt_idcontrato" class="form-control form-control-sm" value="<?php  echo isset($contratoinfo[0]->ID) ? ucwords($contratoinfo[0]->ID) : ''?>">
									</form>
									<div class="row">				  	
										<div class="col-md-12 col-sm-12">
											<div class="table-responsive-sm">
												<div align="right">
												   	<button type="button" class="btn btn-sm btn-success nuevaTarifaALM" name="btnAddTarifaAlmacenamiento" id="btnAddTarifaAlmacenamiento" disabled><i class="fa fa-plus-circle"></i> Nuevo</button>
												</div>
												<table  class="table table-hover table-bordered table-striped table-sm" style="width:100%" id="detAlamacenamiento">
													<thead>
														<tr>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Tamaño</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Valor</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Dias libres</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Depues de X Dias</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Cobrar</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Accion</th>
														</tr>
													</thead>
															<tbody id="tblDetalleTarifa" name="tblDetalleTarifa">

															</tbody>
													</table>
												</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="inspeccion" role="tabpanel" aria-labelledby="inspeccion-tab">
											<form id="frmAddTarifaInspeccion" name="frmAddTarifaInspeccion" method="POST">
											<div class="row">				  	
											<div class="col-md-12 col-sm-12">
												<div class="table-responsive-sm">
													<div align="right">
												   		<button type="button" class="btn btn-sm btn-success nuevaTarifaINS" name="btnAddTarifaInspeccion" id="btnAddTarifaInspeccion"><i class="fa fa-plus-circle"></i> Nuevo</button>
													</div>
													<table  class="table table-hover table-bordered table-striped table-sm" style="width:100%" id="detInspeccion">
														<thead>
															<tr>
																<th scope="col" bgcolor="17A2B8"><font color="#fff">Tamaño</th>
																<th scope="col" bgcolor="17A2B8"><font color="#fff">Movimiento</th>
																<th scope="col" bgcolor="17A2B8"><font color="#fff">Descripcion</th>
																<th scope="col" bgcolor="17A2B8"><font color="#fff">Valor</th>
																<th scope="col" bgcolor="17A2B8"><font color="#fff">Accion</th>
															</tr>
														</thead>
														<tbody id="tblDetalleInspeccion" name="tblDetalleInspeccion">

														</tbody>
													</table>
												</div>
												</div>
											</div>
										</form>
									</div>	
							<div class="tab-pane fade" id="manipuleo" role="tabpanel" aria-labelledby="manipuleo-tab">
								<form id="frmAddTarifaManipuleo" name="frmAddTarifaManipuleo" method="POST">
									<div class="row">				  	
										<div class="col-md-12 col-sm-12">
											<div class="table-responsive-sm">
												<div align="right">
												   	<button type="button" class="btn btn-sm btn-success nuevaTarifaMNP" name="btnAddTarifaManipuleo" id="btnAddTarifaManipuleo"><i class="fa fa-plus-circle"></i> Nuevo</button>
												</div>
												<table  class="table table-hover table-bordered table-striped table-sm" style="width:100%" id="detManipuelo">
													<thead>
														<tr>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Tamaño</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Movimiento</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Descripcion</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Valor</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Accion</th>
														</tr>
													</thead>
														<tbody id="tblDetalleManipuleo" name="tblDetalleManipuleo">

														</tbody>
												</table>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="taller" role="tabpanel" aria-labelledby="taller-tab">
								<form id="frmAddTarifaTaller" name="frmAddTarifaTaller" method="POST">
					
									<div class="row">				  	
										<div class="col-md-12 col-sm-12">
											<div class="table-responsive-sm">
												<div align="right">
												   	<button type="button" class="btn btn-sm btn-success nuevaTarifaTLL" name="btnAddTarifaTaller" id="btnAddTarifaTaller"><i class="fa fa-plus-circle"></i> Nuevo</button>
												</div>
												<table  class="table table-hover table-bordered table-striped table-sm" style="width:100%" id="detTaller">
													<thead>
														<tr>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Valor Deposito</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Valor Cliente	</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Accion</th>
														</tr>
													</thead>
														<tbody id="tblDetalleTaller" name="tblDetalleTaller">

														</tbody>
												</table>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="transporte" role="tabpanel" aria-labelledby="transporte-tab">
								<form id="frmAddTarifaTransporte" name="frmAddTarifaTransporte" method="POST">
									<div class="row">				  	
										<div class="col-md-12 col-sm-12">
											<div class="table-responsive-sm">
												<div align="right">
												   	<button type="button" class="btn btn-sm btn-success nuevaTarifaTSP" name="btnAddTarifaTransporte" id="btnAddTarifaTransporte"><i class="fa fa-plus-circle"></i> Nuevo</button>
												</div>
												<table  class="table table-hover table-bordered table-striped table-sm" style="width:100%" id="detTransporte">
													<thead>
														<tr>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Tamaño</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Condición</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Costo</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Valor Venta</th>
															<th scope="col" bgcolor="17A2B8"><font color="#fff">Accion</th>
														</tr>
													</thead>
														<tbody id="tblDetalleTransporte" name="tblDetalleTransporte">

														</tbody>
												</table>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>