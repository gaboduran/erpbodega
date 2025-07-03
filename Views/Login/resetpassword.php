<!doctype html>
<html lang="es">

<head>
    <meta charset="<?php echo SITE_CHARSET ?>">
    <title><?php echo SITE_NAME ?></title>
    <base href="./">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo ASSETS.DS;?>templates/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo ASSETS.DS;?>templates/adminlte/css/adminlte.min.css">
    <!-- Custom Styles Creados por Gabriel -->
    <!-- Animate css -->
    <link rel="stylesheet" href="<?php echo ASSETS.DS.TEMPLATE.PLUGINS.DS;?>sweetalert2/animate.min.css">
    <!-- Sweetalert2 css -->
    <link rel="stylesheet" href="<?php echo ASSETS.DS.TEMPLATE.PLUGINS.DS;?>sweetalert2/sweetalert2.min.css">
     <!-- Toastr css -->
     <link rel="stylesheet" href="<?php echo ASSETS.DS.TEMPLATE.PLUGINS.DS;?>toastr/toastr.css">


</head>

<body>
<div class="login-page">
        <div class="login-box animate__animated animate__backInLeft">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Cambio Contraseña</p>
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
                            <div class="col-12">
                                <button id="btn_procesar" name="btn_procesar" class="btn btn-outline-secondary btn-block" onclick="procesaCambio();">Aceptar</button>
                                
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
</div>
    <!-- jQuery -->
    <script src="<?php echo ASSETS.DS;?>templates/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo ASSETS.DS;?>templates/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="<?php echo ASSETS.DS;?>templates/adminlte/js/adminlte.js"></script>
    <!-- Validate JS -->
    <script src="<?php echo ASSETS.DS;?>templates/adminlte/plugins/jquery-validation/jquery.validate.min.js"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Login JS -->
    <script src="<?php echo ASSETS.DS;?>app/js/reset.js"></script>
    <!-- Base URL -->
    <script>
    const base_url = "<?php echo base_url;?>"
    </script>

</body>

</html>