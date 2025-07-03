      <?php headerAdmin($data) ?>
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
          </div>

          <div class="clearfix"></div>
          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_info">
              <span>Bienvenido:</span>
              <h2><?php echo ucwords($_SESSION['nombres']); ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <!-- sidebar menu -->

          <!-- /sidebar menu -->
        </div>
      </div> <?php topNav($data) ?>
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="row">

          <div class="col-md-4 col-sm-4">
            <div class="x_panel">
              <div class="x_title">
                <h2><i class="fa fa-industry"></i> Bodegas Asignadas</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="tab-content" id="myTabContent">
                  <form id="frmDeposito" name="frmDeposito" method="POST">
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Bodega a Trabajar</label>
                        <select class="form-control" name="sel_bodega" id="sel_bodega" required style="  font-size:13px;">
                          <option value="" selected>Seleccione una Bodega </option>
                          <?php for ($i = 0; $i < count($bodega); $i++) { ?>
                            <option value="<?= $bodega[$i]->ID;  ?>"><?= ucwords($bodega[$i]->NOMBRE); ?> </option>
                          <?php } ?>
                        </select>
                        <input type="hidden" id="idperfil" name="idperfil" value="<?= $idperfil;  ?>">

                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="x_footer text-center">
                <button type="button" class="btn btn-success" onclick="seleccionaBodega();">Aceptar</button>
                <a href="<?= base_url ?>" class=""><button class="btn btn-secondary">Cancelar</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <?php footerAdmin($data) ?>
      <?php functionsJS($data) ?>