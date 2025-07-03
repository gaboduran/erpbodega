
$(document).ready(function () {
	$('#listalinea').multiselect();
});

document.addEventListener("DOMContentLoaded",
	function () {
		tblClasificacion = $('#tblClasificacion').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Clasificacion/getAllClasificacion`,
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

async function editaClasificacion(idclasificacion) {
	event.preventDefault();
	$("#txt_codclasificacion").removeClass("is-invalid");
	$("#txt_desclasificacion").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	$("#sel_linea").removeClass("is-invalid");
	validador.resetForm();
	try {
		const url = `${base_url}clasificacion/editaClasificacion`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idclasificacion: idclasificacion },
			dataType: "json",
			success: function (data) {
				$('#ClasificacionModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Clasificación Contenedor");
				$("#txt_codclasificacion").val(data.CODIGO);
				$("#txt_desclasificacion").val(data.DESCRIPCION);
				$("#sel_estado").val(data.ESTADO);
				$("#sel_linea").val(data.IDLINEA);
				$("#operation").val("Edit");
				$("#idclasificacion").val(idclasificacion);
				var s = '';
				for (var i = 0; i < data.lineadispo.length; i++) {
					s += '<option value="' + data.lineadispo[i].ID + '">' + capitalizarFrase(data.lineadispo[i].NOMCLIENTE) + '</option>';
				}
				$("#listalinea").html(s);
				var s1 = '';
				for (var i = 0; i < data.lineaasig.length; i++) {
					s1 += '<option value="' + data.lineaasig[i].IDLINEA + '">' + capitalizarFrase(data.lineaasig[i].NOMCLIENTE) + '</option>';
				}
				$("#listalinea_to").html(s1);
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function procesar() {
	event.preventDefault();
	$('#listalinea_to option').prop("selected", "");
	$('#listalinea_to option').prop("selected", "selected");
	var valida;
	valida = $("#frmClasificacion").valid();
	if (valida == true) {
		let frmClasificacion = new FormData(document.querySelector("#frmClasificacion"));
		try {
			const url = `${base_url}clasificacion/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmClasificacion,
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
				$('#ClasificacionModal').modal('hide');
				$('#frmClasificacion')[0].reset();
				tblClasificacion.ajax.reload(null, false);
			} else if (resultado.status == 'clasificacion_existe') {
				Swal.fire({
					icon: 'error',
					title: 'Atención:',
					text: 'El codigo de la Clasificación ya existe'
				});
			} else if (resultado.status == 'update_ok') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Actualización Exitosa!',
					showConfirmButton: false,
					timer: 1500
				});
				$('#ClasificacionModal').modal('hide');
				$('#frmClasificacion')[0].reset();
				tblClasificacion.ajax.reload(null, false);
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

function deleteClasificacion(idclasificacion) {
	Swal.fire({
		title: 'Eliminar Clasificación',
		text: "Confirma que desea eliminar la clasificación seleccionado?",
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
			$('#ideliminacion').val(idclasificacion);
			$(document).on('submit', '#frmElimina', function (event) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}clasificacion/eliminarClasificacion`,
					method: "POST",
					data: $('#frmElimina').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "delete_ok") {
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Clasificiacion Eliminado',
								showConfirmButton: false,
								timer: 1500
							})
							$('#motivoElimina').modal('hide');
							$('#frmElimina')[0].reset();
							tblClasificacion.ajax.reload(null, false);
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

function procesarDuplica() {
	event.preventDefault();
	var valida;
	valida = $("#frmDuplica").valid();
	if (valida == true) {

		Swal.fire({
			text: "Atención solo se duplicaran las clasificaciones no existentes en la Linea Destino",
			icon: 'info',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar'
		}).then((result) => {
			if (result.isConfirmed) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}clasificacion/procesarDuplica`,
					method: "POST",
					data: $('#frmDuplica').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "save_ok") {
							$('#duplicaModal').modal('hide');
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Clasificiacion Eliminado',
								showConfirmButton: true
							})
							tblClasificacion.ajax.reload(null, false);
						} else if (data.status == "error_delete") {
							alert("mal eliminado");
						} else if (data.errorvalida == true) {
							toastr.error(data.msg);
						}

					}
				})
			}
		})

	}
}


$(document).on('click', '#imprimir_listado', function (e) {
	Print_Report('Listado');
	e.preventDefault();
});

function Print_Report(Criterio) {
	if (Criterio == 'Listado') {
		window.open("views/reportes/clasificacionPDF.php",
			'win2',
			'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,' +
			'resizable=yes,width=800,height=800,directories=no,location=no' +
			'fullscreen=yes');
	}
}

$(document).on('click', '#imprimir_excel', function (e) {
	window.location.href = `${base_url}views/reportes/clasificacionEXCEL.php`;
	e.preventDefault();
});

$(document).on('click', '.ClasificacionModal', function () {
	event.preventDefault();
	const url = `${base_url}clasificacion/getLineas`;
	$.ajax({
		url: url,
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#listalinea_to").html("");
			$('#ClasificacionModal').modal('show');
			$("#txt_codclasificacion").removeClass("is-invalid");
			$("#txt_desclasificacion").removeClass("is-invalid");
			$("#sel_estado").removeClass("is-invalid");
			$("#sel_linea").removeClass("is-invalid");
			$('#frmClasificacion')[0].reset();
			validador.resetForm();
			$(".modal-header").css("background-color", "#17a2b8");
			$(".modal-header").css("color", "white");
			$(".modal-title").text("Nueva Clasificación Contenedor");
			$("#operation").val("Add");
			var s = "";
			for (var i = 0; i < data.linea.length; i++) {
				s += '<option value="' + data.linea[i].ID + '">' + capitalizarFrase(data.linea[i].NOMCLIENTE) + '</option>';
			}
			$("#listalinea").html(s);
		}
	})
});

function capitalizarFrase(frase) {
    return frase
        .toLowerCase() // Convierte todo a minúsculas
        .split(' ') // Divide la frase en palabras
        .map(palabra => palabra.charAt(0).toUpperCase() + palabra.slice(1)) // Capitaliza la primera letra de cada palabra
        .join(' '); // Vuelve a unir las palabras en una frase
}


$("#txt_codclasificacion").keyup(function () {
	var ta = $("#txt_codclasificacion");
	letras = ta.val().replace(/ /g, "");
	ta.val(letras)
});

/*=================================================================================================================
=            									VALIDACION FORMULARIO CLASIFICACION CONTENEDOR 							
==================================================================================================================*/
var validador = $('#frmClasificacion').validate({
	rules: {
		txt_codclasificacion: {
			required: true,
		},
		txt_desclasificacion: {
			required: true,
		},
		sel_estado: {
			required: true,
		},
	},
	messages: {
		txt_codclasificacion: {
			required: "El Codigo es Requerido"

		},
		txt_desclasificacion: {
			required: "La Descripción es Requerida"
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