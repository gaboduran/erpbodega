<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Listado General de <?php echo $data['page_name'] ?></h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 col-sm-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Perfil</label>
                                <select class="form-control form-control-sm" name="sel_perfil" id="sel_perfil" required>
                                    <option value="" selected>Seleecione Perfil</option>
                                    <?php for ($i = 0; $i < count($dataPerfil); $i++) { ?>
                                        <option value="<?php echo ucwords($dataPerfil[$i]->ID); ?>"><?php echo ucwords($dataPerfil[$i]->NOMPERFIL); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="nav flex-column nav-tabs h-200" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <?php
                            for ($i = 0; $i < count($dataRolesespeciales); $i++) { ?>
                                <a class="nav-link" id="vert-tabs-<?php echo $dataRolesespeciales[$i]->IDMODULO; ?>" data-toggle="pill" href="#vert-tabs-<?php echo $dataRolesespeciales[$i]->IDMODULO; ?>" role="tab" aria-controls="vert-tabs-<?php echo $dataRolesespeciales[$i]->IDMODULO; ?>" aria-selected="true"><?php echo ucwords($dataRolesespeciales[$i]->NOMBRE); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-7 col-sm-9">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                1.
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                2.
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                3.
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                                4.
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="motivoElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/modals/motivoElimina.php'); ?>
</div>
<div class="modal fade" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('../teus/views/perfiles/perfilModal.php'); ?>
</div>
<?php footerAdmin($data) ?>
<?php datatables($data) ?>
<?php functionsJS($data) ?>