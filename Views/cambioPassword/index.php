<?php headerAdmin($data) ?>
<?php navAdminNoLogin($data) ?>
<?php topnavNoLogin($data) ?>
<div class="right_col" role="main">
	<div class="row">
		<div class="mx-auto" style="width: 400px;">

			<div class="card">
				<div class="card-header">
					<h6 class="card-title">Cambio Password de Acceso al Sistema</h6>
				</div>
				<div class="card-body login-card-body">
					<form id="frmCambiarPassword" name="frmCambiarPassword" method="POST">
						<div class="row">
							<div class="input-group mb-3">
								<input type="password" name="txt_pass1" id="txt_pass1" class="form-control" placeholder="Digite Contraseña" required>
							</div>
						</div>
						<div class="row">
							<div class="input-group mb-3">
								<input type="password" name="txt_pass2" id="txt_pass2" class="form-control" placeholder="Confirme Contraseña" required>
							</div>
						</div>
						<div class="row mt-2">
							<!-- /.col -->
							<div class="col-md-12">
								<button type="" class="btn btn-outline-info btn-block" onclick="CambiarPassword();">Aceptar</button>

							</div>
							<!-- /.col -->
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php footerAdmin($data) ?>
<?php selectfunctions($data) ?>
<?php functionsJS($data) ?>