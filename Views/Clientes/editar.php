<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card mx-auto" style="width:980px">
				<div class="card-header">
					<h5 class="card-title"><?php echo $data['page_name'] ?></h5>
				</div>
				<div class="card-body">
						<?php include('../teus/views/clientes/formCliente.php'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->
<?php footerAdmin($data) ?>
<?php selectfunctions($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>
<script>
	$(document).ready(function() {
		$("#operation").val("Edit");
	});
</script>