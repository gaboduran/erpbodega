<div class="modal-dialog" style="max-width:980px!important;">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalles daños</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
            </button>
        </div>
        <form id="uploadForm" name="uploadForm" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="p-2">
                    <?php if (permisos::create()) { ?>
                        <input type="submit" class="btn btn-success" value="Subir Imágenes">

                    <?php } ?>
                </div>
                <div id="principal">
                    <div id="result">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>

        </form>

    </div>
</div>