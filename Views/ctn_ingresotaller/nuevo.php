<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card mx-auto" >
				<div class="card-header">
					<h5 class="card-title"> <?php echo $data['page_name'] ?></h5>
				</div>
				<div class="card-body">
					<?php include('../teus/views/reserva/formReserva.php'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="buscaClienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php include('../teus/views/Modals/buscaClienteModal.php'); ?>
</div>

<div class="modal fade" id="buscaTerceroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php include('../teus/views/Modals/buscaTerceroModal.php'); ?>
</div>

<!-- /page content -->
<?php footerAdmin($data) ?>
<?php selectfunctions($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>
<script>

</script>