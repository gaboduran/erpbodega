<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h6 class="card-title">Listado General de <?php echo $data['page_name'] ?></h6>
				</div>
				<div class="card-body">
					<?php if (permisos::create()) { ?>
						<div class="mb-2" align="right">
							<a href="<?= base_url ?>usuarios/nuevo" class=""><button class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Nuevo</button></a>
						</div>
					<?php } ?>
					<div class="table-responsive">
						<table id="tblUsuarios" class="table table-bordered table-striped display compact nowrap" width="100%">
							<thead>
								<tr>
									<th>Id</th>
									<th>Usuario</th>
									<th>Nombre</th>
									<th>Email</th>
									<th>Perfil</th>
									<th>Estado</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php include('../teus/views/modals/motivoElimina.php'); ?>
</div>

<div class="modal fade" id="resetPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<?php include('../teus/views/usuarios/resetPasswordModal.php'); ?>
</div>
<?php footerAdmin($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="modal fade" id="clientesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/clientes/clientesModal.php');?>
</div>

<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/modals/motivoElimina.php');?>
</div>