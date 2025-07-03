document.addEventListener("DOMContentLoaded",
	function () {
		tblConductores = $('#tblConductores').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}transportes/getAllConductores`,
			},
			columns: [
				{ data: "id" },
				{ data: "tipodoc" },
				{ data: "nombre" },
				{ data: "email" },
				{ data: "telefono" },
				{ data: "estado" },
				{ data: "options" }
			],
			"columnDefs": [ {
				"targets": [0],
				"visible": false
				} ]

		});
	},
	false
)


async function editarConductor(id) {
	event.preventDefault();
	$("#txt_codcategoria").removeClass("is-invalid");
	$("#txt_nomcategoria").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	try {
		const url = `${base_url}transportes/editarConductor`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id },
			dataType: "json",
			success: function (data) {
				$('#conductoresModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Conductor");
				$('#documentos-tab').removeClass('disabled');
				$("#myTab a:first").parent("li").show();
				$("#myTab a:first").tab('show');
				$("#txt_idconductor").val(id);
				$("#operation").val("Edit");
				$("#sel_tipodoc").val(data.TIPODOC);
				$("#txt_nroide").val(data.NROIDE);
				$("#txt_nombre").val(data.NOMBRE);
				$("#txt_email").val(data.EMAIL);
				$("#txt_telefono").val(data.TELEFONO);
				$("#sel_estado").val(data.ESTADO);
				$("#txt_licencia").val(data.LICENCIA);
				$("#fecvence").val(data.FVENCELICENCIA);
				getDetalledocumentos();
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function procesar() {
	event.preventDefault();
	var valida;
	valida = $("#frmConductores").valid();
	if (valida == true) {
		let frmConductores = new FormData(document.querySelector("#frmConductores"));
		try {
			const url = `${base_url}transportes/procesarConductor`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmConductores,
			});
			const resultado = await respuesta.json();
			if (resultado.status == 'save_ok') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Registro creado con exito!',
					showConfirmButton: false,
					timer: 1500
				});
				$("#txt_idconductor").val(resultado.idconductor);
				$("#operation").val("Edit");
				getDetalledocumentos();
				$('#documentos-tab').removeClass('disabled');
				tblConductores.ajax.reload(null, false);
			} else if (resultado.status == 'empresa_existe') {
				Swal.fire({
					icon: 'error',
					title: 'Atención:',
					text: 'Empresa transporte ya existe'
				});
			} else if (resultado.status == 'update_ok') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Actualización Exitosa!',
					showConfirmButton: false,
					timer: 1500
				});
				$('#categoriaModal').modal('hide');
				$('#frmCategoria')[0].reset();
				tblConductores.ajax.reload(null, false);
			} else if (resultado.status == "errorPDO") {
				toastr.error(resultado.msg);
			}
			if (resultado.errorvalida == true) {
				toastr.error(resultado.msg);
			}
		} catch (err) {
			console.log(err);
		}
	}
}

$(function () {
	$('#fecvence').datetimepicker({
		format: 'DD/MM/YYYY'
	});

});

$(document).on('click', '.conductoresModal', function () {
	$('#conductoresModal').modal('show');
	$("#myTab a:first").parent("li").show();
	$("#myTab a:first").tab('show');
	$('#tarifas-tab').addClass('disabled');
	$('#documentos-tab').addClass('disabled');
	$('#frmConductores')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nuevo Conductor");
	$("#operation").val("Add");
});


async function getDetalledocumentos() {
	var idconductor = $("#txt_idconductor").val();
	try {
		const url = `${base_url}transportes/getDocumentosConductor`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idconductor: idconductor },
			success: function (data) {
				document.getElementById("HTMLdetalleDocumentos").innerHTML = data;
			}
		})
	} catch (err) {
		console.log(err);
	}
}


function adjuntarDocumento(idconductor, iddocumento) {
    var inputFile = $('<input type="file" accept=".pdf">');
    $("#iddocumento").val(iddocumento);
	var idproceso = 'conductor';
    inputFile.on('change', function () {
        var file = this.files[0];
        var nombreArchivo = 'conductor_' + idconductor + '_' + iddocumento + '.pdf';
        var formData = new FormData();
        formData.append('file', file, nombreArchivo);
        formData.append('iddocumento', iddocumento);
        formData.append('idconductor', idconductor);
		formData.append('idproceso', idproceso);

        $.ajax({
            url: `${base_url}transportes/subirArchivo`,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {
				getDetalledocumentos();
              	toastr.success('Documento adjuntado con Extio');
            },
            error: function (error) {
                console.error('Error al adjuntar el documento', error);
            }
        });
    });
    inputFile.click();
}


function deleteDocumento(iddocumento){
	Swal.fire({
  			title: 	'Eliminar Documento',
  			text: 	"Confirma que desea eliminar el Documento seleccionado?",
  			icon: 	'warning',
  			showCancelButton: true,
  			confirmButtonColor: '#3085d6',
  			cancelButtonColor: '#d33',
  			confirmButtonText: 'Eliminar'
		}).then((result) => {
			if (result.isConfirmed) {
    			$('#motivoElimina').modal('show');
    			$(".modal-header").css("background-color", "#17a2b8");
    			$(".modal-header").css("color", "white" );
    			$(".modal-title").text("Motivo eliminación");
        		$('#ideliminacion').val(iddocumento);
        		$(document).on('submit', '#frmElimina', function(event){
    				event.preventDefault();
    				 $.ajax({
					      url:`${base_url}transportes/eliminarDocumento`,
					      method:"POST",
					      data:$('#frmElimina').serialize(),
					      dataType:"json",
					      success:function(data){
					      	if(data.status=="delete_ok"){
					      		Swal.fire({
  									position: 'center',
  									icon: 'success',
  									title: 'Estado Eliminado',
  									showConfirmButton: false,
  									timer: 1500
								})
					      		$('#motivoElimina').modal('hide');
								$('#frmElimina')[0].reset();
								getDetalledocumentos();
        						tblConductores.ajax.reload(null, false);
					      	}else if(data.status=="error_delete"){
					      		alert("mal eliminado");
					      	}else if(data.errorvalida==true){
					      		toastr.error(data.msg);
					      	}

					      }
    				})
    			})
  			}
		})
}


/*=================================================================================================================
=            									VALIDACION FORMULARIO ISOCODE 							
==================================================================================================================*/
var validador = $('#frmConductores').validate({
	rules: {
		txt_codiso: {
			required: true,
		},
		txt_descripcion: {
			required: true,
		},
		sel_estado: {
			required: true,
		},
		sel_tamano: {
			required: true,
		},
	},
	messages: {
		txt_codiso: {
			required: "El Codigo es Requerido"

		},
		txt_descripcion: {
			required: "El Nombre Requerido"
		},
		sel_estado: {
			required: "El Estado es Requerido "
		},
		sel_tamano: {
			required: "El Tamaño Requerido"
		},
	},
	errorElement: 'span',
	errorPlacement: function (error, element) {
		error.addClass('invalid-feedback');
		element.closest('.form-group').append(error);
	},
	highlight: function (element, errorClass, validClass) {
		$(element).addClass('is-invalid');
	},
	unhighlight: function (element, errorClass, validClass) {
		$(element).removeClass('is-invalid');
	}
});