<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>

<style type="text/css">
	
	.card-text{
		font-size:19px;
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
	}

</style>
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 ">
			<div class="card card-info card-outline">
				<div class="card-header">
					<h3 class="card-title">
						<h6><i class="fas fa-user-plus"></i> <?Php echo $data['page_name']; ?></h6>
					</h3>
				</div>
				<div class="card-body">
					<div class="col-md-12 col-sm-12">
						<?php include('../teus/views/contrato/formContrato.php');?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="buscaClienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php include('../teus/views/Modals/buscaClienteModal.php');?>
</div>

<div class="modal fade" id="TarifaAlmacenajeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php include('../teus/views/contrato/TarifaAlmacenajeModal.php');?>
</div>

<div class="modal fade" id="TarifaInspeccionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php include('../teus/views/contrato/TarifaInspeccionModal.php');?>
</div>

<div class="modal fade" id="TarifaTransporteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php include('../teus/views/contrato/TarifaTransporteModal.php');?>
</div>


<div class="modal fade" id="TarifaManipuleoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php include('../teus/views/contrato/TarifaManipuleoModal.php');?>
</div>


<?php footerAdmin($data) ?>