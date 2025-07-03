<?php headerAdmin($data) ?>
<?php navAdmin() ?>
<?php topNav() ?>
<div class="right_col" role="main">

	<h1>
		401 Acceso No Autorizado
	</h1>

<section class="content">
	<div class="error-page">
		<h2 class="headline text-yellow"> 401</h2>
		<div class="error-content">
			<h3><i class="fa fa-warning text-yellow"></i> Acceso no Aurotizado</h3>
			<p>
				Atención: Usted no cuena con los privilegios necesarios para acceder a este sitio.
				Por favor, dar Click:  <a href="<?php echo base_url.DASHBOARD ?>">Para retornar al inicio</a>
			</p>
		</div>

	</div>
</section>
</div>

<?php footerAdmin($data) ?>