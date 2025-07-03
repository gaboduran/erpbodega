	<div class="row">
		<div class="col-md-6">
			<div class="card card-info card-outline">
				<div class="card-header">
					<h6 class="card-title"> Datos Basicos </h6>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Identificación</label>
								<input type="text" id="txt_ide" name="txt_ide" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite Identificación" maxlength="15" value="<?php echo (isset($usuario[0]->NROIDE) ? ucwords($usuario[0]->NROIDE) : ''); ?>">
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Nombres</label>
								<input type="text" id="txt_nombre" name="txt_nombre" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite Nombres" maxlength="20" value="<?php echo (isset($usuario[0]->NOMBRE) ? ucwords($usuario[0]->NOMBRE) : ''); ?>">
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Apellidos</label>
								<input type="text" id="txt_apellido" name="txt_apellido" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite Apellidos" maxlength="20" value="<?php echo (isset($usuario[0]->APELLIDOS) ? ucwords($usuario[0]->APELLIDOS) : ''); ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6 ">
							<div class="form-group">
								<label for="exampleInputEmail1">Email</label>
								<input type="email" id="txt_email" name="txt_email" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite Eamil" maxlength="80" value="<?php echo (isset($usuario[0]->EMAIL) ? strtolower($usuario[0]->EMAIL) : ''); ?>">
							</div>
						</div>
						<div class="col-md-6 col-sm-6 ">
							<div class="form-group">
								<label for="exampleInputEmail1">Telefono</label>
								<input type="text" id="txt_telefono" name="txt_telefono" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite Telefono" maxlength="15" value="<?php echo (isset($usuario[0]->TELEFONO) ? ucwords($usuario[0]->TELEFONO) : ''); ?>">
							</div>
						</div>
					</div>
					<div class="row">

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
						<div class="col-md-6 col-sm-6 ">
							<div class="form-group">
								<label for="exampleInputEmail1">Perfil</label>
								<?php if (!isset($usuario[0]->ESTADO)) { ?>
									<select class="form-control form-control-sm" name="sel_perfil" id="sel_perfil" required>
										<option value="" selected>Seleecione Perfil</option>
										<?php for ($i = 0; $i < count($perfil); $i++) { ?>
											<option value="<?php echo ucwords($perfil[$i]->ID); ?>"><?php echo ucwords($perfil[$i]->NOMPERFIL); ?></option>
										<?php } ?>
									</select>
								<?php } else { ?>
									<select class="form-control form-control-sm" name="sel_perfil" id="sel_perfil" required>
										<option selected value="<?php echo $usuario[0]->IDPERFIL; ?>"> <?php echo ucwords($usuario[0]->NOMPERFIL); ?> </option>
										<?php for ($i = 0; $i < count($perfiles); $i++) { ?>
											<option value="<?php echo $perfiles[$i]->IDPERFIL; ?>"> <?php echo ucwords($perfiles[$i]->NOMPERFIL); ?> </option>
										<?php } ?>
									</select>
								<?php }  ?>
							</div>
						</div>
					</div>
					<div class="row">
			
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Tipo Usuario</label>
								<?php if (!isset($usuario[0]->CODTIPOUSER)) { ?>
									<select class="form-control form-control-sm" name="sel_tipousuario" id="sel_tipousuario" required>
										<?php for ($i = 0; $i < count($tipousuario); $i++) { ?>
											<option value="<?php echo ucwords($tipousuario[$i]->CODIGO); ?>"><?php echo ucwords($tipousuario[$i]->DESCRIPCION); ?></option>
										<?php } ?>
									</select>
								<?php } else { ?>
									<select class="form-control form-control-sm" name="sel_tipousuario" id="sel_tipousuario" required>
										<option selected value="<?php echo $usuario[0]->CODTIPOUSER; ?>"> <?php echo ucwords($usuario[0]->DESCTIPOUSER); ?> </option>
										<?php for ($i = 0; $i < count($tipousuario); $i++) { ?>
											<option value="<?php echo ucwords($tipousuario[$i]->CODIGO); ?>"><?php echo ucwords($tipousuario[$i]->DESCRIPCION); ?></option>
										<?php } ?>
									</select>
								<?php }  ?>
							</div>
						</div>
										<div class="col-md-6 col-sm-6 ">
							<div class="form-group">
								<label for="exampleInputEmail1">Usuario</label>
								<input type="text" id="txt_usuario" name="txt_usuario" class="form-control form-control-sm" autocomplete="off" placeholder="Digite Usuario" value="<?php echo (isset($usuario[0]->USUARIO) ? ucwords($usuario[0]->USUARIO) : ''); ?>">
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="col-md-6">
			<div class="card card-info card-outline">
				<div class="card-header">
					<h6 class="card-title">Asignación Bodegas</h6>
				</div>
				<div class="card-body">
					<div class="row">
						<?php if (!isset($usuario[0]->ESTADO)) { ?>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Lineas Disponibles</label>
									<select id="listLineas" multiple class="form-control" size="8" style="font-size:14px;">
										<?php for ($i = 0; $i < count($bodegas); $i++) { ?>
											<option value="<?= $bodegas[$i]->ID;  ?>"><?= ucwords($bodegas[$i]->NOMBRE); ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Lineas Asignadas</label>
									<select name="listLineas_to[]" id="listLineas_to" multiple class="form-control" size="8" style="font-size:14px;">

									</select>
								</div>
							</div>
						<?php } else { ?>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Bodegas Disponibles</label>
									<select id="listLineas" multiple class="form-control" size="8" style="  font-size:14px;">
										<?php for ($i = 0; $i < count($BodegasFree); $i++) { ?>
											<option value="<?= $BodegasFree[$i]->ID;  ?>"><?= ucwords($BodegasFree[$i]->NOMBRE); ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Bodegas Asignadas</label>
									<select name="listLineas_to[]" id="listLineas_to" multiple class="form-control" size="8" style="  font-size:14px;">
										<?php for ($i = 0; $i < count($bodegasuser); $i++) { ?>
											<option value="<?= $bodegasuser[$i]->ID;  ?>"><?= ucwords($bodegasuser[$i]->NOMBRE); ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						<?php }  ?>
					</div>
					<div class="row">
						<div class="col-md-3">
							<button type="button" id="listLineas_rightAll" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-forward"></i></button>
						</div>
						<div class="col-md-3">
							<button type="button" id="listLineas_rightSelected" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
						</div>

						<div class="col-md-3">
							<button type="button" id="listLineas_leftSelected" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
						</div>

						<div class="col-md-3">
							<button type="button" id="listLineas_leftAll" class="btn btn-sm btn-light btn-block"><i class="glyphicon glyphicon-backward"></i></button>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>