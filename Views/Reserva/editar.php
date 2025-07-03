<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<link href="<?php echo ASSETS.DS.CSS.DS; ?>estilostabla.css" rel="stylesheet">
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 ">
			<div class="card card-info card-outline">
				<div class="card-header">
					<h3 class="card-title">
						<h6><i class="fa fa-pencil-square-o"></i> <?Php echo $data['page_name']; ?></h6>
					</h3>
				</div>
				<div class="card-body">
					<div class="col-md-12 col-sm-12">
						<?php include('../teus/views/reserva/formReserva.php');?>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="buscaClienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php include('../teus/views/contrato/buscaClienteModal.php');?>
</div>

<div class="modal fade" id="detalleReservaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/reserva/detalleReservaModal.php');?>
</div>

<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('../teus/views/modals/motivoElimina.php');?>
</div>

<?php footerAdmin($data) ?>