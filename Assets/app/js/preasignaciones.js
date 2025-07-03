$(document).ready(function () {
	$(document).ajaxStop(function () {
		$("#loadingOverlay").hide();
	});
})

function showLoadingOverlay() {
	document.getElementById('loadingOverlay').style.display = 'flex';
}

function hideLoadingOverlay() {
	document.getElementById('loadingOverlay').style.display = 'none';
}


function carga_datatable(fechaini = '', fechafin = '', sel_linea = '', booking = '') {
	tblPreasignaciones = $('#tblPreasignaciones').DataTable({
		order: [[0, 'desc']],
		"bProcessing": true,
		"serverSide": true,
		language: {
			url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
		},
		ajax: {
			method: "POST",
			url: `${base_url}preasignaciones/getReportePreasignacion`,
			data: { fechaini: fechaini, fechafin: fechafin, sel_linea: sel_linea, booking: booking }
		},
		columns: [
			{ data: "id" },
			{ data: "idreserva" },
			{ data: "nomcliente" },
			{ data: "nombre" },
			{ data: "estado" },
			{ data: "fechacrea" },
			{ data: "options" }
		]
		
	});
}

function filtrar() {
	
	var valida;
	valida = $("#frmFiltrar").valid();
	if (valida == true) {
		var fechaini = $('#fechaini').val();
		var fechafin = $('#fechafin').val();
		var sel_linea = $('#sel_lineaindx').val();
		var booking = $('#txt_bookinkindx').val();
		if (fechaini != '' || fechafin != '' || sel_linea != '' || booking != '') {
			$('#tblPreasignaciones').DataTable().destroy();
			carga_datatable(fechaini, fechafin, sel_linea, booking);
		}
	}
}

async function editarPreasigna(damageDataString) {
	event.preventDefault();
	const damageData = JSON.parse(damageDataString);
	let reserva = damageData.IDRESERVA
	let id = damageData.ID
	$("#txt_idreserva").removeClass("is-invalid");
	$("#sel_linea").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	try {
		const url = `${base_url}preasignaciones/verPreasigna`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id },
			dataType: "json",
			success: function (data) {
				$('#preasignacionesModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Reserva " + reserva);
				$("#txt_idreserva").val(data.IDRESERVA);
				$("#sel_linea").select2({dropdownParent: $('#preasignacionesModal')}).val(data.IDLINEA).trigger("change");
				$("#sel_estado").val(data.ESTADO);
				$("#txt_observaciones").val(data.OBSERVACIONES);
				$("#operation").val("Edit");
				$("#idreserva").val(damageData.ID);
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function adjuntarDocumento() {
	event.preventDefault();
	try {
		var inputFile = $('<input type="file" accept=".csv">');
		var idpreasigna = $("#txt_idpreasignacion").val();
		var idlinea = $("#idlinea").val();
		inputFile.on('change', function () {
			var file = this.files[0];
			var nombreArchivo = 'transporte_' + idpreasigna + '.pdf';
			var formData = new FormData();
			formData.append('file', file, nombreArchivo);
			formData.append('idpreasigna', idpreasigna);
			formData.append('idlinea', idlinea);
			showLoadingOverlay();
			$.ajax({
				url: `${base_url}Preasignaciones/subirArchivo`,
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				enctype: 'multipart/form-data',
				dataType:"json",
				success: function (response) {
					Swal.fire({
						icon: "info",
						title: "Resultado:",
						text: response.statusok,
						footer: response.statuserror +'<a href="'+response.link +'">Aqui</a>'
					});
					 tblContenedores.ajax.reload(null, false);

				},
				error: function (error) {
					console.error('Error al adjuntar el documento', error);
				}
			});
		});
		inputFile.click();
	} catch (err) {
		console.log(err);
	} finally {
		hideLoadingOverlay();
	}
}

document.addEventListener("DOMContentLoaded",
	function () {
		tblPreasignaciones = $('#tblPreasignaciones').DataTable({
			order: [[5, 'desc']],
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Preasignaciones/getAllPreasignaciones`,
			},
			columns: [
				{ data: "id" },
				{ data: "idreserva" },
				{ data: "nomcliente" },
				{ data: "nombre" },
				{ data: "estado" },
				{ data: "fechacrea" },
				{ data: "options" }
			],

		});
	},
	false
)


function verContenedores(damageDataString) {
	event.preventDefault();
	const damageData = JSON.parse(damageDataString);
	let reserva = damageData.IDRESERVA
	let id = damageData.ID;
	let idlinea = damageData.IDLINEA;
	$('#tblContenedores').DataTable().destroy();
	$('#frmContenedores')[0].reset();
	$("#idlinea").val(idlinea);
	$("#txt_idpreasignacion").val(id);
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Preasignación " + reserva );
	$('#contenedoresPreasignadosModal').modal('show');
	tblContenedores = $('#tblContenedores').DataTable({
		select: true,
		scrollY: '300px',
		scrollCollapse: true,
		paging: false,
		language: {
			url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
		},
		ajax: {
			url: `${base_url}Preasignaciones/verContenedores`,
			method: "POST",
			data: { id: id },
			dataSrc: "",
		},
		columns: [
			{ data: "id" },
			{ data: "contenedor" },
			{ data: "tipo" },
			{ data: "dias" },
			{ data: "options" }
		],

	});
}



async function procesar() {
	event.preventDefault();
	var valida;
	valida = $("#frmPreasignacion").valid();
	if (valida == true) {
		let frmPreasignacion = new FormData(document.querySelector("#frmPreasignacion"));
		try {
			const url = `${base_url}Preasignaciones/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmPreasignacion,
			});
			const resultado = await respuesta.json();
			if (resultado.status == 'save_ok') {
				toastr.success('Pre-Asignación creada con exito!')
				$('#preasignacionesModal').modal('hide');
				$('#frmPreasignacion')[0].reset();
				tblPreasignaciones.ajax.reload(null, false);
			} else if (resultado.status == 'reserva_existe') {
				toastr.error('Atención: Codigo de la Reserva existe')
				$('#preasignacionesModal').modal('show');
				tblPreasignaciones.ajax.reload(null, false);
			} else if (resultado.status == 'update_ok') {
				toastr.success('Preasignación actualizada con exito!')
				$('#preasignacionesModal').modal('hide');
				$('#frmPreasignacion')[0].reset();
				tblPreasignaciones.ajax.reload(null, false);
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

$("#txt_ncontenedor").autocomplete({
	minLength: 6,
	source: function (request, response) {
		var idlinea = $("#idlinea").val();
		$.ajax({
			url: `${base_url}Preasignaciones/getContenedor`,
			dataType: "json",
			data: {
				search1: request.term,
				search2: idlinea
			},
			success: function (data) {
				response($.map(data, function (item) {
					return {
						label: item.NCONT,
						value: item.NCONT,
						txt_tipocont: item.CODIGO,
						txt_diaspatio: item.DIASPATIO,
						txt_idtipocont: item.TIPO
					}
				},
				))
			}
		});
	},
	select: function (event, values) {
		$("#txt_tipocont").val(values.item.txt_tipocont);
		$("#txt_diaspatio").val(values.item.txt_diaspatio);
		$("#txt_idtipocont").val(values.item.txt_idtipocont);
		$("#txt_ncontenedor").val(values.item.value);
	},
	change: function (event, ui) {
		if (ui.item == null || ui.item == undefined) {
			$("#txt_ncontenedor").val("");
			$("#txt_tipocont").val("");
			$("#txt_idtipocont").val("");
			$("#txt_diaspatio").val("");
			$("#txt_ncontenedor").focus();
			toastr.error('Atención: El contenedor no existe.');
		}
	}
});


async function saveContenedor() {
	event.preventDefault();
	var valida;
	valida = $("#frmContenedores").valid();
	if (valida == true) {
		let frmContenedores = new FormData(document.querySelector("#frmContenedores"));
		try {
			const url = `${base_url}Preasignaciones/saveContenedor`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmContenedores,
			});
			const resultado = await respuesta.json();
			if (resultado.status == 'save_ok') {
				toastr.success('Pre-Asignación creada con exito!');
				limpiarForm();
				tblContenedores.ajax.reload(null, false);
			}else if (resultado.status == 'asignado'){
				Swal.fire({
				  icon: "error",
				  title: "Pre-Asignación Vigente",
				  text: "El contenedor tiene una Preasignacion vigente",
				});
			}
			if (resultado.errorvalida == true) {
				toastr.error(resultado.msg);
			}
		} catch (err) {
			console.log(err);
		}
	}

}

function deletePreasigna(damageDataString) {
	event.preventDefault();
	const damageData = JSON.parse(damageDataString);
	let reserva = damageData.IDRESERVA
	Swal.fire({
		title: 'Eliminar Pre-Asignación',
		text: `¿Confirma que desea Eliminar la Pre-Asignación: ${damageData.IDRESERVA}?`,
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Eliminar',
		footer: 'Se genera un LOG de eliminación con su información'
	}).then((result) => {
		if (result.isConfirmed) {
			$('#motivoElimina').modal('show');
			$(".modal-header").css("background-color", "#17a2b8");
			$(".modal-header").css("color", "white");
			$(".modal-title").text("Motivo eliminación Reserva: " + reserva);
			$('#ideliminacion').val(damageData.ID);
			$(document).on('submit', '#frmElimina', function (event) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}Preasignaciones/eliminarPreasigna`,
					method: "POST",
					data: $('#frmElimina').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "delete_ok") {
							toastr.success('Reserva eliminada con exito!')
							$('#motivoElimina').modal('hide');
							$('#frmElimina')[0].reset();
							tblReserva.ajax.reload(null, false);
						} else if (data.status == "delete_error") {
							toastr.warning('Se ha presnetado un error interno durante la eliminacion')
						} else if (data.errorvalida == true) {
							toastr.error(data.msg);
						}

					}
				})
			})
		}
	})
}

function deleteContenedor(jsonDataString) {
	event.preventDefault();
	const jasonData = JSON.parse(jsonDataString);
	let id = jasonData.ID
	Swal.fire({
		title: 'Eliminar Contenedor',
		text: `¿Confirma que desea Eliminar el Contenedor: ${jasonData.CONTENEDOR}?`,
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Eliminar',
	}).then((result) => {
		if (result.isConfirmed) {
			$('#ideliminacion').val(jasonData.ID);
				event.preventDefault();
				$.ajax({
					url: `${base_url}Preasignaciones/eliminarContenedor`,
					method: "POST",
					data: {id:id},
					dataType: "json",
					success: function (data) {
						if (data.status == "delete_ok") {
							toastr.success('Contenedor Eliminado con Exito!')
							tblContenedores.ajax.reload(null, false);
						} else if (data.status == "delete_error") {
							toastr.warning('Se ha presnetado un error interno durante la eliminacion')
						} else if (data.errorvalida == true) {
							toastr.error(data.msg);
						}

					}
				})
		}
	})
}

$(document).on('click', '.preasignacionesModal', function () {
	$("#txt_idreserva").removeClass("is-invalid");
	$("#sel_linea").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validadorPreasigna.resetForm();
	$('#preasignacionesModal').modal('show');
	$('#frmPreasignacion')[0].reset();
	$("#sel_linea").select2({dropdownParent: $('#preasignacionesModal')}).val("").trigger("change");
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nueva Preasignación");
	$("#operation").val("Add");
});


$(function () {
	$('#sel_linea').select2();
})


$(document).on('click', '#imprimir_excel', function(e){
	var idpreasigna = $("#txt_idpreasignacion").val();
	window.location.href = `${base_url}views/reportes/preasignacionEXCEL.php?idpreasigna=`+idpreasigna;
	e.preventDefault();
});

function limpiarForm() {
	$("#txt_tipocont").val("");
	$("#txt_diaspatio").val("");
	$("#txt_idtipocont").val("");
	$("#txt_ncontenedor").val("");

}


$(function () {
	$('#fecvence').datetimepicker({
		format: 'DD/MM/YYYY'
	});
	$('#fechaini').datetimepicker({
		format: 'DD/MM/YYYY'
	});
	$('#fechafin').datetimepicker({
		format: 'DD/MM/YYYY'
	});
});


/*=================================================================================================================
=            									VALIDACION FORMULARIO FILTROS BUSQUEDA 							
==================================================================================================================*/

var validador = $('#frmFiltrar').validate({
	rules: {
		fechaini: {
			required: true,
		},
		fechafin: {
			required: true,
		}
	},
	messages: {
		fechaini: {
			required: "Fecha inicial es obligatoria"

		},
		fechafin: {
			required: "Fecha final es obligatoria"
		}
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

/*=================================================================================================================
=            									VALIDACION FORMULARIO RESERVA 							
==================================================================================================================*/

var validadorPreasigna = $('#frmPreasignacion').validate({
	rules: {
		txt_idreserva: {
			required: true,
		},
		sel_linea: {
			required: true,
		},
		sel_estado: {
			required: true,
		}
	},
	messages: {
		txt_idreserva: {
			required: "Campo Obligatorio"
		},
		sel_linea: {
			required: "Campo Obligatorio"
		},
		sel_estado: {
			required: "Campo Obligatorio"
		}
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