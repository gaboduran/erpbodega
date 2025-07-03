<?php 
 //   $objTabla = new tablareparacion();

?>

<div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Daños</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listado General de <?php echo $data['page_name'] ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php if (permisos::create()) { ?>
                                        <div align="right">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button class="btn btn-success btn-sm" onclick="TablaReparacionModal();"><i class="fa fa-plus-circle"></i> Nuevo</button>
                                                <button class="btn btn-info btn-sm nuevoMotonaveModal"><i class="fa fa-files-o"></i> Duplicar</button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="table-responsive">
                                        <table id="tbltablaRepara" class="table table-bordered table-striped compact nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nombre</th>
                                                    <th>Estado</th>
                                                    <th data-orderable="false">Acción</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>