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
						<div class="d-flex justify-content-end mb-2">
						<a href="<?= base_url ?>clientes/nuevo" class=""><button class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Nuevo</button></a>
						</div>
					<?php } ?>
					<div class="table-responsive">
						<table id="tblClientes" class="table table-bordered table-striped compact nowrap" width="100%">
							<thead>
								<tr>
									<th>Identificaciòn</th>
									<th>Nombre</th>
									<th>Email</th>
									<th>Estado</th>
                                    <th data-orderable="false">Acción</th>
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
<div class="modal fade" id="clientesModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php include('../teus/views/clientes/clientesModal1.php'); ?>
</div>

<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php include('../teus/views/modals/motivoElimina.php'); ?>
</div>


<?php footerAdmin($data) ?>
<?php selectfunctions($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>