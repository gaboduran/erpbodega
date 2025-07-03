
document.addEventListener("DOMContentLoaded",
	function () {
		tblReparacion = $('#tblReparacion').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}reparacion/getAllReparaciones`,
			},
			columns: [
				{ data: "codrepara" },
				{ data: "nombresp" },
				{ data: "nombrein" },
				{ data: "estado" },
				{ data: "options" }
			],

		});
	},
	false
)


async function editaReparacion(idrepara) {
	event.preventDefault();
	$("#txt_codrepara").removeClass("is-invalid");
	$("#txt_nombresp").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	try {
		const url = `${base_url}reparacion/editaReparacion`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idrepara: idrepara },
			dataType: "json",
			success: function (data) {
				$('#reparacionModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Reparacion");
				$("#txt_codrepara").val(data.CODREPARA);
				$("#txt_nombresp").val(data.NOMBRESP);
				$("#txt_nombrein").val(data.NOMBREIN);
				$("#sel_estado").val(data.ESTADO);
				$("#operation").val("Edit");
				$("#txt_idrepara").val(idrepara);
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function procesar() {
	event.preventDefault();
	var valida;
	valida = $("#frmReparacion").valid();
	if (valida == true) {
		let frmReparacion = new FormData(document.querySelector("#frmReparacion"));
		try {
			const url = `${base_url}reparacion/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmReparacion,
			});
			const resultado = await respuesta.json();
			if (resultado.status == 'save_ok') {
				toastr.success('Reparacion creada con exito!')
				$('#reparacionModal').modal('hide');
				$('#frmReparacion')[0].reset();
				tblReparacion.ajax.reload(null, false);
			} else if (resultado.status == 'repara_existe') {
				toastr.error('Atención: Codigo de Repacion existe')
				$('#reparacionModal').modal('hide');
				$('#frmReparacion')[0].reset();
				tblReparacion.ajax.reload(null, false);
			} else if (resultado.status == 'update_ok') {
				toastr.success('Reparación actualizada con exito!')
				$('#reparacionModal').modal('hide');
				$('#frmReparacion')[0].reset();
				tblReparacion.ajax.reload(null, false);
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

function deleteReparacaion(idrepara) {
	Swal.fire({
		title: 'Eliminar Reparación',
		text: "Confirma que desea eliminar la Reparación seleccionado?",
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
			$('#ideliminacion').val(idrepara);
			$(document).on('submit', '#frmElimina', function (event) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}reparacion/deleteReparacaion`,
					method: "POST",
					data: $('#frmElimina').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "delete_ok") {
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Reparación Eliminada',
								showConfirmButton: false,
								timer: 1500
							})
							$('#motivoElimina').modal('hide');
							$('#frmElimina')[0].reset();
							tblReparacion.ajax.reload(null, false);
						} else if (data.status == "error_delete") {
							alert("mal eliminado");
						} else if (data.errorvalida == true) {
							toastr.error(data.msg);
						}

					}
				})
			})
		}
	})
}


$(document).on('click', '#imprimir_listado', function(e){
	Print_Report('Listado');
	e.preventDefault();
});

function Print_Report(Criterio){
    if (Criterio == 'Listado') {
        window.open("views/reportes/reparacionPDF.php",
       'win2',
       'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }
}

$(document).on('click', '#imprimir_excel', function(e){
	window.location.href = `${base_url}views/reportes/reparacionEXCEL.php`;
	e.preventDefault();
});

$(document).on('click', '.reparacionModal', function () {
	$('#reparacionModal').modal('show');
	$("#txt_codrepara").removeClass("is-invalid");
	$("#txt_nombresp").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	$('#frmReparacion')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nueva Reparación");
	$("#operation").val("Add");
});

$("#txt_codrepara").keyup(function () {
	var ta = $("#txt_codrepara");
	letras = ta.val().replace(/ /g, "");
	ta.val(letras)
});

/*=================================================================================================================
=            									VALIDACION FORMULARIO REPARACION 							
==================================================================================================================*/
var validador = $('#frmReparacion').validate({
	rules: {
		txt_codrepara: {
			required: true,
		},
		txt_nombresp: {
			required: true,
		},
		sel_estado: {
			required: true,
		},
	},
	messages: {
		txt_codrepara: {
			required: "El Codigo es Requerido"

		},
		txt_nombresp: {
			required: "El Nombre Requerido"
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