<?php headerAdmin($data) ?>
<?php navAdmin($data) ?>
<?php topNav($data) ?>

<style>

</style>


<div class="content-wrapper">
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-3 justify-content-center">
                <div class="col-md-4 col-sm-4">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><?Php echo $data['page_name']; ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <form id="frmUpdatePassword" name="frmUpdatePassword" method="POST">
                                         <div class="row">
                                         <input type="hidden" name="txt_usuario" id="txt_usuario" class="form-control form-control-sm" value="<?php echo $_SESSION['usuario'] ?>" readonly>
                                            <div class="col-md-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="label-name">Constraseña</label>
                                                    <div class="input-group">
                                                        <input type="password" name="txt_pass1" id="txt_pass1" class="form-control form-control-sm" maxlength="15" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Confirmar Contraseña</label>
                                                    <div class="input-group">
                                                        <input type="password" name="txt_pass2" id="txt_pass2" class="form-control form-control-sm" maxlength="15" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <input type="submit" onclick="processUpdate();" class="btn btn-info btn-block" name="action" id="action" value="Aceptar">
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php footerAdmin($data) ?>
<?php functionsJS($data) ?>