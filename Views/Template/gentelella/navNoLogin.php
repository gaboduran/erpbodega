            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
                    </div>

                    <div class="clearfix"></div>
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                      <div class="profile_info">
                            <span>Bienvenido,</span>
                            <h2><?php echo ucwords($_SESSION['nombres']);?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->
                      <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                                <ul class="nav side-menu">
                                     <?php Permisos::mostrar_menu();?>
                                </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>