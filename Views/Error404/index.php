<?php headerAdmin($data) ?>
<?php navAdmin() ?>
<?php topNav() ?>
<div class="right_col" role="main">

	<h1>
		404 Error Pagina
	</h1>

<section class="content">
	<div class="error-page">
		<h2 class="headline text-yellow"> 404</h2>
		<div class="error-content">
			<h3><i class="fa fa-warning text-yellow"></i> Pagina no Encontrada</h3>
			<p>
				Atención: La pagiga a la cual esta intentando acceder no se encuentra 
				Por favor, dar Click:  <a href="<?php echo base_url."/".DASHBOARD ?>">Para retornar al inicio</a>
			</p>
		</div>

	</div>
</section>
</div>

<?php footerAdmin($data) ?>