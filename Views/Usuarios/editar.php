<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<style>
	#txt_pass1,
	#txt_pass2,
	#lbl_pass1,
	#lbl_pass2 {
		display: none;
	}
</style>
<!-- page content -->
<div class="right_col" role="main">
	<div class="row">

		<div class="col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title"><?php echo $data['page_name'] ?></h5>
				</div>
				<div class="card-body">
					<form id="frmUsuario" name="frmUsuario" method="POST">
						<input type="hidden" id="idusuario" name="idusuario" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite Identificación" value="<?php echo $usuario[0]->ID; ?>">
						<input type="hidden" id="operation" name="operation" class="form-control form-control-sm" value="">
						<?php include('../erpbodega/views/usuarios/formUsuario.php'); ?>
					</form>
				</div>
				<div class="card-footer text-center">
					<button type="button" class="btn btn-success btn-sm" onclick="procesar();">Aceptar</button>
					<a href="<?= base_url ?>usuarios"><button type="button" class="btn btn-secondary btn-sm">Cancelar</button></a>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- /page content -->
<?php footerAdmin($data) ?>
<?php selectfunctions($data) ?>
<?php functionsJS($data) ?>
<script>
	$(document).ready(function() {
		$("#operation").val("Edit");
		$("#txt_usuario").prop("disabled", true);


	});
</script>