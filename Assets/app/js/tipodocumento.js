document.addEventListener("DOMContentLoaded",
	function () {
		tblTipoDoc = $('#tblTipoDoc').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Tipodocumento/getAllTipoDoc`,
			},
			columns: [
				{ data: "id" },
				{ data: "codigo" },
				{ data: "descripcion" },
				{ data: "estado" },
				{ data: "options" }
			],
			"columnDefs": [{
				"targets": [0],
				"visible": false
			}]

		});
	},
	false
)
async function editar(id) {
	event.preventDefault();
	$("#txt_codigo").removeClass("is-invalid");
	$("#txt_descripcion").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	try {
		const url = `${base_url}Tipodocumento/edit`;
		$.ajax({
			url: url,
			method: "POST",
			data: {id:id},
			dataType: "json",
			success: function (data) {
				$('#TipodocumentoModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Cargo");
				$("#txt_codigo").val(data.CODIGO);
				$("#txt_descripcion").val(data.DESCRIPCION);
				$("#sel_estado").val(data.ESTADO);
				$("#operation").val("Edit");
				$("#txt_id").val(id);
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function procesar() {
	event.preventDefault();
	var valida;
	valida = $("#frmtipoDocumento").valid();
	if (valida == true) {
		let frmtipoDocumento = new FormData(document.querySelector("#frmtipoDocumento"));
		try {
			const url = `${base_url}Tipodocumento/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmtipoDocumento,

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
				$('#TipodocumentoModal').modal('hide');
				$('#frmtipoDocumento')[0].reset();
				tblTipoDoc.ajax.reload(null, false);
			} else if (resultado.status == 'existe') {
				Swal.fire({
					icon: 'error',
					title: 'Atención:',
					text: 'Codigo Existente'
				});
			} else if (resultado.status == 'update_ok') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Actualización Exitosa!',
					showConfirmButton: false,
					timer: 1500
				});
				$('#TipodocumentoModal').modal('hide');
				tblTipoDoc.ajax.reload(null, false);
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

function eliminar(id) {
	Swal.fire({
		title: 'Eliminar Tipo de Documento',
		text: "Confirma que desea eliminar el Tipo de Documento seleccionado?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Eliminar'
	}).then((result) => {
		if (result.isConfirmed) {
			$('#motivoElimina').modal('show');
			$(".modal-header").css("background-color", "#17a2b8");
			$(".modal-header").css("color", "white");
			$(".modal-title").text("Motivo eliminación");
			$('#ideliminacion').val(id);
			$(document).on('submit', '#frmElimina', function (event) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}Tipodocumento/eliminar`,
					method: "POST",
					data: $('#frmElimina').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "delete_ok") {
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Registro Eliminado',
								showConfirmButton: false,
								timer: 1500
							})
							$('#motivoElimina').modal('hide');
							$('#frmElimina')[0].reset();
							tblTipoDoc.ajax.reload(null, false);
						} else if (data.status == "error_delete") {
							alert("mal Eliminada");

						} else if (data.errorvalida == true) {
							toastr.error(data.msg);
						}

					}
				})
			})
		}
	})
}

$(document).on('click', '.TipodocumentoModal', function () {
	$("#txt_codigo").removeClass("is-invalid");
	$("#txt_descripcion").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	$('#TipodocumentoModal').modal('show');
	$('#frmtipoDocumento')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nuevo Tipo Documento");
	$("#operation").val("Add");
});

$("#txt_codigo").keyup(function () {
	var ta = $("#txt_codigo");
	letras = ta.val().replace(/ /g, "");
	ta.val(letras)
});

/*=================================================================================================================
=            									VALIDACION FORMULARIO CARGO 							
==================================================================================================================*/
var validador = $('#frmtipoDocumento').validate({
	rules: {
		txt_codigo: {
			required: true,
		},
		txt_descripcion: {
			required: true,
		},
		sel_estado: {
			required: true,
		},
	},
	messages: {
		txt_codigo: {
			required: "El Codigo es Requerido"

		},
		txt_descripcion: {
			required: "La descripcion es Requerida"
		},
		sel_estado: {
			required: "El Estado es Requerido "
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