
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
				url: `${base_url}Plantillas/getAllPlantillas`,
			},
			columns: [
				{ data: "id" },
				{ data: "nombre" },
				{ data: "nomcliente" },
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

async function configurarDano(id) {
	event.preventDefault();
	try {
		const url = `${base_url}plantillas/getdetallePlantilla`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id },
			dataType: "json",
			success: function (data) {
				$('#danoPlantillaModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Clasificación Contenedor");
				$("#txt_idlinea").val(data.IDLINEA);
				$("#operation").val("Edit");
				$("#txt_idplantilla").val(id);
				$("#operation").val("Edit");
				
			}
		})
	} catch (err) {
		console.log(err);
	}
}

$("#txt_componente").autocomplete({
	minLength: 3,
	source: function (request, response) {
		var idlinea 	= $("#txt_idlinea").val();
		$.ajax({
			url: `${base_url}plantillas/getComponente`,
			dataType: "json",
			data: {
				search1: request.term,
				search2: idlinea
			},
			success: function (data) {
				response($.map(data, function (item) {
					// Validar que los campos no sean undefined o null
					var codcomponente = item.CODCOMPONENTE || '';
					var codrepara = item.CODREPARA || '';
					var descripcion = item.DESCRIPCION || '';
					// Evitar devolver elementos vacíos
					if (codcomponente && codrepara && descripcion) {
						return {
							label: `${codcomponente} - ${descripcion} (${codrepara})`,
							value: `${codcomponente} - ${descripcion} (${codrepara})`, // Esto agrega el valor correcto
							codcomponente: item.CODCOMPONENTE,
							codrepara: item.CODREPARA,
							descrepara: item.CODREPARA + ' - ' + item.NOMBREIN,
							iditem: item.ID,
							tipoliquida: item.TIPOLIQUIDA,
							codrepara: item.CODREPARA,


						};
					}
				}));

			}
		});
	},
	select: function (event, values) {
		$("#codcomponente").val(values.item.codcomponente);
		$("#txt_componente").val(values.item.value);
		$("#txt_codrepara").val(values.item.codrepara);
		$("#txt_reparacion").val(values.item.descrepara);
		//$("#txt_localiza").val(values.item.localiza);
		$("#txt_iditem").val(values.item.iditem);
		cargueSelectLocaliza();
		cargueSelectDano();
		removeInvalid();
		if ((values.item.tipoliquida) == 'AREA' || (values.item.tipoliquida) == 'LINEAL') {
			$("#frmdetalledano #txt_cantidad").prop("readonly", true);
			$("#frmdetalledano #txt_ancho").prop("readonly", false);
			$("#frmdetalledano #txt_largo").prop("readonly", false);
			$("#frmdetalledano #btn_liquidadUnd").prop("disabled", true);
			$("#frmdetalledano #btn_liquidadArea").prop("disabled", false);
			$("#txt_cantidad").val(0.00);
			$("#txt_chh").val(0.00);
			$("#txt_cm").val(0.00);
			$("#txt_ct").val(0.00);
		} else if ((values.item.tipoliquida) == 'UNIDAD') {
			$("#frmdetalledano #txt_cantidad").prop("readonly", false);
			$("#frmdetalledano #txt_ancho").prop("readonly", true);
			$("#frmdetalledano #txt_largo").prop("readonly", true);
			$("#frmdetalledano #btn_liquidadArea").prop("disabled", true);
			$("#frmdetalledano #btn_liquidadUnd").prop("disabled", false);
			$("#txt_largo").val(0.00);
			$("#txt_ancho").val(0.00);
			$("#txt_hh").val(0.00);
			$("#txt_chh").val(0.00);
			$("#txt_cm").val(0.00);
			$("#txt_ct").val(0.00);
		}
	},
	change: function (event, ui) {
		if (ui.item == null || ui.item == undefined) {
			$("#codcomponente").val("");
			$("#txt_componente").val("");
			toastr.error('Item no encontrado.');
		}
	}
});

function cargueSelectLocaliza() {
	event.preventDefault();
	let codcomponente = $("#codcomponente").val();
	try {
		const url = `${base_url}Ctn_inspecciondanos/carga_localiza`;
		$.ajax({
			url: url,
			method: "POST",
			data: { codcomponente: codcomponente},
			dataType: "json",
			success: function (data) {
				var s = '<option value="" Selected>Seleccione Localización</option>';
				for (var i = 0; i < data.length; i++) {
					s += '<option value="' + data[i].LOCALIZA + '">' + data[i].LOCALIZA + '</option>';
				}
				$("#sel_localiza").html(s);
			}
		})
	} catch (err) {
		console.log(err);
	}
}

function cargueSelectDano() {
	event.preventDefault();
	let codrepara = $("#txt_codrepara").val();
	try {
		const url = `${base_url}Ctn_inspecciondanos/carga_dano`;
		$.ajax({
			url: url,
			method: "POST",
			data: { codrepara: codrepara },
			dataType: "json",
			success: function (data) {
				var s = '<option value="">Seleccione Dano</option>';
				for (var i = 0; i < data.length; i++) {
					s += '<option value="' + data[i].CODDANO + '">' + data[i].CODDANO + ' - ' + data[i].NOMBREIN + '</option>';
				}
				$("#sel_dano").html(s);
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function liquidarArea() {
	event.preventDefault();
	let idingreso = $("#idingreso").val();
	let idlinea = $("#txt_idlinea").val();
	let largo = $("#txt_largo").val();
	let ancho = $("#txt_ancho").val();
	let idtem = $("#txt_iditem").val();
	const url = `${base_url}Ctn_inspecciondanos/liquidarMedidaArea`;
	try {
		$.ajax({
			url: url,
			method: "POST",
			data: { idingreso: idingreso, idlinea: idlinea, largo: largo, ancho: ancho, iditem: idtem },
			dataType: "json",
			success: function (data) {
				if (data.status != false) {
					$("#txt_hh").val(devuelve_float(data.hh, ''));
					$("#txt_chh").val(devuelve_float(data.vlrhh, ''));
					$("#txt_cm").val(devuelve_float(data.vlrcm, ''));
					$("#txt_ct").val(devuelve_float(data.vctot, ''));
				} else {
					Swal.fire({
						title: "Error",
						text: "Tarifa no definida",
						icon: "error"
					});
					$("#lbl_vlrhh").text("$ 0.00");
					$("#lbl_vlrmt").text("$ 0.00");
					document.getElementById("lbl_vlrhh").style.color = "#4e6f8b"; // Color verde
					document.getElementById("lbl_vlrmt").style.color = "#4e6f8b"; // Color verde
				}
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function liquidarUnidad() {
	event.preventDefault();
	let idingreso = $("#idingreso").val();
	let idlinea = $("#txt_idlinea").val();
	let cantidad = $("#txt_cantidad").val();
	let idtem = $("#txt_iditem").val();
	const url = `${base_url}Ctn_inspecciondanos/liquidarMedidaUnidad`;
	try {
		$.ajax({
			url: url,
			method: "POST",
			data: { idingreso: idingreso, idlinea: idlinea, cantidad: cantidad, iditem: idtem },
			dataType: "json",
			success: function (data) {
				if (data.status != false) {
					$("#txt_hh").val(devuelve_float(data.hh, ''));
					$("#txt_chh").val(devuelve_float(data.vlrhh, ''));
					$("#txt_cm").val(devuelve_float(data.vlrcm, ''));
					$("#txt_ct").val(devuelve_float(data.vctot, ''));
				} else {
					Swal.fire({
						title: "Error",
						text: "Tarifa no definida",
						icon: "error"
					});
					$("#lbl_vlrhh_und").text("$ 0.00");
					$("#lbl_vlrmt_und").text("$ 0.00");
					document.getElementById("lbl_vlrhh_und").style.color = "#4e6f8b"; // Color verde
					document.getElementById("lbl_vlrmt_und").style.color = "#4e6f8b"; // Color verde
				}
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function procesar() {
	event.preventDefault();
	valida = $("#frmdetalledano").valid();
	if (valida == true) {
		let frmdetalledano = new FormData(document.querySelector("#frmdetalledano"));
		try {
			const url = `${base_url}plantillas/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmdetalledano,
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

function removeInvalid(){
	$("#txt_componente").removeClass("is-invalid");
	$("#txt_reparacion").removeClass("is-invalid");
	$("#sel_localiza").removeClass("is-invalid");
	$("#txt_ubica").removeClass("is-invalid");
	$("#sel_dano").removeClass("is-invalid");
	$("#txt_largo").removeClass("is-invalid");
	$("#txt_ancho").removeClass("is-invalid");
	$("#txt_cantidad").removeClass("is-invalid");
	$("#sel_cargo").removeClass("is-invalid");
}

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