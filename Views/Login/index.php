<!doctype html>
<html lang="es">

<head>
    <meta charset="<?php echo SITE_CHARSET ?>">
    <title><?php echo SITE_NAME ?></title>
    <base href="./">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo ASSETS.DS;?>templates/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo ASSETS.DS;?>templates/adminlte/css/adminlte.min.css">
    <!-- Custom Styles Creados por Gabriel -->
    <link rel="stylesheet" href="<?php echo ASSETS;?>/css/style.css">
    <!-- Animate css -->
    <link rel="stylesheet" href="<?php echo ASSETS.DS.TEMPLATE.PLUGINS.DS;?>sweetalert2/animate.min.css">
    <!-- Sweetalert2 css -->
    <link rel="stylesheet" href="<?php echo ASSETS.DS.TEMPLATE.PLUGINS.DS;?>sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-5/assets/css/login-5.css">
        
</head>

<body>


<!-- Login 5 - Bootstrap Brain Component -->
<section class="p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="card border-light-subtle shadow-sm">
      <div class="row g-0">
        <div class="col-12 col-md-6 text-bg-primary">
          <div class="d-flex align-items-center justify-content-center h-100">
            <div class="col-10 col-xl-8 py-3">
              <img class="img-fluid rounded mb-4" loading="lazy" src="./assets/img/bsb-logo-light.svg" width="245" height="80" alt="BootstrapBrain Logo">
              <hr class="border-primary-subtle mb-4">
              <h2 class="h1 mb-4">We make digital products that drive you to stand out.</h2>
              <p class="lead m-0">We write words, take photos, make videos, and interact with artificial intelligence.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h3>Log in</h3>
                </div>
              </div>
            </div>
            <form id="formLogin" method="POST">
                              <div class="row gy-3 gy-md-4 overflow-hidden">
                <div class="col-12">
                  <label for="text" class="form-label">Email <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="usuario" id="usuario" >
                </div>
                <div class="col-12">
                  <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="password" id="password" value="" required>
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
                    <label class="form-check-label text-secondary" for="remember_me">
                      Keep me logged in
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn btn-primary" type="submit" onclick="LoginIN();">Log in now</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-12">
                <hr class="mt-5 mb-4 border-secondary-subtle">
                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                  <a href="#!" class="link-secondary text-decoration-none">Create new account</a>
                  <a href="#!" class="link-secondary text-decoration-none">Forgot password</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
      





    <!-- jQuery -->
    <script src="<?php echo ASSETS.DS;?>templates/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo ASSETS.DS;?>templates/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo ASSETS.DS;?>templates/adminlte/js/adminlte.js"></script>
    <!-- Sweetalert2 JS -->
    <script src="<?php echo ASSETS.DS.TEMPLATE.PLUGINS.DS; ?>sweetalert2/sweetalert2.all.min.js"></script>
     <!-- Validate JS -->
    <script src="<?php echo ASSETS.DS;?>templates/adminlte/plugins/jquery-validation/jquery.validate.min.js"></script>
     <!-- Login JS -->
    <script src="<?php echo ASSETS.DS;?>templates/adminlte/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- Login JS -->
    <script src="<?php echo ASSETS.DS;?>app/js/login.js"></script>
    <!-- Base URL -->
    <script > const base_url = "<?php echo base_url;?>" </script>

</body>

</html>
