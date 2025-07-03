$(document).ready(function () {
   carga_datatable();

})

function carga_datatable(fechaini = '', fechafin = '', sel_linea = '', ti_ingreso = '', grupocont = '',  tercero = '', contenedor = '',
     tipocont = '', blcomodato = '') {
	tblIngresos = $('#tblIngresos').DataTable({
		order: [[0, 'desc']],
		"bProcessing": true,
		"serverSide": true,
		language: {
			url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
		},
		ajax: {
			method: "POST",
			url: `${base_url}Ctn_consultaingreso/getReporteIngreso`,
			data: { fechaini: fechaini, fechafin: fechafin, sel_linea: sel_linea, ti_ingreso: ti_ingreso, 
                grupocont: grupocont,  tercero: tercero, contenedor:contenedor, tipocont: tipocont, blcomodato:blcomodato }
		},
		columns: [
			{ data: "id" },
			{ data: "fecchaingreso" },
			{ data: "nomlinea" },
			{ data: "contenedor" },
			{ data: "tipocont" },
			{ data: "tipoingreso" },
			{ data: "comodato" },
			{ data: "nomtercero" },
			{ data: "options" },
		],
	});
}

function filtrar() {
	var valida;
	valida = $("#frmFiltrar").valid();
	if (valida == true) {
		var fechaini = $('#fechaini').val();
		var fechafin = $('#fechafin').val();
		var sel_linea = $('#sel_linea').val();
		var ti_ingreso = $('#sel_tipoingreso').val();
		var grupocont = $('#sel_grupocont').val();
		var tercero = $('#sel_tercero').val();
		var idtransporte = $('#sel_transporte').val();
		var contenedor = $('#txt_contenedor').val();
		var tipocont = $('#sel_tipocont').val();
		var blcomodato = $('#txt_blcomodato').val();
		if (fechaini != '' || fechafin != '' || sel_linea != '' || ti_ingreso != '' || grupocont != '' || tercero != '' ||  contenedor != '' || 
            tipocont != '' || blcomodato != '') {
			$('#tblIngresos').DataTable().destroy();
			carga_datatable(fechaini, fechafin, sel_linea, ti_ingreso, grupocont, tercero, contenedor, tipocont, blcomodato);
		}
	}
}


$("#txt_cliente").autocomplete({
	minLength: 2,
	source: function (request, response) {
		$.ajax({
			url: `${base_url}reserva/getClientes`,
			dataType: "json",
			data: {
				search1: request.term,
				search2: ""
			},
			success: function (data) {
				response($.map(data, function (item) {
					return {
						label: item.NOMCLIENTE,
						value: item.NOMCLIENTE,
						txt_idcliente: item.ID
					}
				},
				))
			}
		});
	},
	select: function (event, values) {
		$("#txt_idcliente").val(values.item.txt_idcliente);
		$("#txt_cliente").val(values.item.value);
	},
	change: function (event, ui) {
		if (ui.item == null || ui.item == undefined) {
			$("#txt_idcliente").val("");
			$("#txt_cliente").val("");
			$("#txt_idcliente").val("");
			$("#txt_cliente").focus();
			toastr.error('Atención: El cliente no existe.');
		}
	}
});

$("#txt_nomtransporte").autocomplete({
	minLength: 2,
	source: function (request, response) {
		$.ajax({
			url: `${base_url}reserva/getTransporte`,
			dataType: "json",
			data: {
				search1: request.term,
				search2: ""
			},
			success: function (data) {
				response($.map(data, function (item) {
					return {
						label: item.NROIDE + " | " + item.NOMBRE,
						value: item.NOMBRE,
						txt_idtransporte: item.ID
					}
				},
				))
			}
		});
	},
	select: function (event, values) {
		$("#txt_idtransporte").val(values.item.txt_idtransporte);
		$("#txt_nomtransporte").val(values.item.value);
	},
	change: function (event, ui) {
		if (ui.item == null || ui.item == undefined) {
			$("#txt_idtransporte").val("");
			$("#txt_nomtransporte").val("");
			$("#txt_idtransporte").val("");
			$("#txt_nomtransporte").focus();
			toastr.error('Atención: El transporte no existe.');
		}
	}
});


$("#txt_orden").autocomplete({
	minLength: 2,
	source: function (request, response) {
		$.ajax({
			url: `${base_url}reserva/getOrdentransporte`,
			dataType: "json",
			data: {
				search1: request.term,
				search2: ""
			},
			success: function (data) {
				response($.map(data, function (item) {
					return {
						label: item.ID + " | " + item.NOMCLIENTE,
						value: item.ID + " | " + item.NOMCLIENTE,
						txt_idorden: item.ID
					}
				},
				))
			}
		});
	},
	select: function (event, values) {
		$("#txt_idorden").val(values.item.txt_idorden);
		$("#txt_orden").val(values.item.value);
	},
	change: function (event, ui) {
		if (ui.item == null || ui.item == undefined) {
			$("#txt_idorden").val("");
			$("#txt_orden").val("");
			$("#txt_idorden").val("");
			$("#txt_orden").focus();
			toastr.error('Atención: La Orden de Transporte No Existe');
		}
	}
});

$('#sel_linea').change(function (e) {
	let idlinea = $(this).val()
	event.preventDefault();
	try {
		const url = `${base_url}reserva/cargaSalidas`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idlinea: idlinea },
			dataType: "json",
			success: function (data) {
				var s = '<option value="">Seleccione Movimiento</option>';
				for (var i = 0; i < data.length; i++) {
					s += '<option value="' + data[i].IDMOVIMIENTO + '">' + data[i].DESCRIPCION + '</option>';
				}
				$("#sel_tisalida").html(s);
			}
		})
	} catch (err) {
		console.log(err);
	}
});

$('#sel_lineaindx').change(function (e) {
	let idlinea = $(this).val()
	event.preventDefault();
	try {
		const url = `${base_url}reserva/cargaSalidas`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idlinea: idlinea },
			dataType: "json",
			success: function (data) {
				var s = '<option value="">Seleccione Movimiento</option>';
				for (var i = 0; i < data.length; i++) {
					s += '<option value="' + data[i].IDMOVIMIENTO + '">' + data[i].DESCRIPCION + '</option>';
				}
				$("#sel_tisalidaindx").html(s);
			}
		})
	} catch (err) {
		console.log(err);
	}
});

async function editarReserva(damageDataString) {
	event.preventDefault();
	const damageData = JSON.parse(damageDataString);
	let reserva = damageData.IDRESERVA
	let id = damageData.ID
	$("#txt_booking").removeClass("is-invalid");
	$("#sel_linea").removeClass("is-invalid");
	$("#txt_cliente").removeClass("is-invalid");
	$("#sel_tisalida").removeClass("is-invalid");
	$("#fecvence").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	try {
		const url = `${base_url}reserva/verReserva`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id },
			dataType: "json",
			success: function (data) {
				$('#reservaModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Reserva " + reserva);
				$("#txt_booking").val(data.IDRESERVA);
				$("#sel_linea").val(data.IDLINEA);
				$("#txt_idcliente").val(data.IDTERCERO);
				$("#txt_cliente").val(data.NOMTERCERO);
				$("#fecvence").val(data.FECHAVENCE);
				$("#sel_estado").val(data.ESTADO);
				$("#txt_observaciones").val(data.OBSERVACIONES);
				$("#txt_idorden").val(data.IDOTRASPORTE);
				if (data.IDOTRASPORTE == "") {
					$("#txt_orden").val("");
				} else {
					$("#txt_orden").val(data.IDOTRASPORTE + " | " + data.CLIENTEOT);
				}
				$("#operation").val("Edit");
				$("#idreserva").val(id);
				var s = '<option value="' + data.TIPOSALIDA + '" seleted>' + data.DESMOVIMIENTO + '</option>';
				for (var i = 0; i < data.dataSalidas.length; i++) {
					s += '<option value="' + data.dataSalidas[i].IDMOVIMIENTO + '">' + data.dataSalidas[i].DESCRIPCION + '</option>';
				}
				$("#sel_tisalida").html(s);
			}
		})
	} catch (err) {
		console.log(err);
	}
}


async function procesarReserva() {
	event.preventDefault();
	var valida;
	valida = $("#frmReserva").valid();
	if (valida == true) {
		let frmReserva = new FormData(document.querySelector("#frmReserva"));
		try {
			const url = `${base_url}reserva/procesarReserva`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmReserva,
			});
			const resultado = await respuesta.json();
			if (resultado.status == "save_ok") {
				$('#reservaModal').modal('hide');
				toastr.success('Reserva creada con exito');
				tblIngresos.ajax.reload(null, false);

			} else if (resultado.status == "update_ok") {
				$('#reservaModal').modal('hide');
				toastr.success('Reserva Actualizada con exito');
				tblIngresos.ajax.reload(null, false);
			}
		} catch (err) {
			console.log(err);
		}
	}
}

function deleteReserva(damageDataString) {
	event.preventDefault();
	const damageData = JSON.parse(damageDataString);
	let reserva = damageData.IDRESERVA
	Swal.fire({
		title: 'Eliminar Reserva',
		text: `¿Confirma que desea Eliminar la Reserva: ${damageData.IDRESERVA}?`,
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
					url: `${base_url}reserva/eliminarReserva`,
					method: "POST",
					data: $('#frmElimina').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "delete_ok") {
							toastr.success('Reserva eliminada con exito!')
							$('#motivoElimina').modal('hide');
							$('#frmElimina')[0].reset();
							tblIngresos.ajax.reload(null, false);
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










$(document).on('click', '.reservaModal', function () {
	$("#txt_booking").removeClass("is-invalid");
	$("#sel_linea").removeClass("is-invalid");
	$("#txt_cliente").removeClass("is-invalid");
	$("#sel_tisalida").removeClass("is-invalid");
	$("#fecvence").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	$('#reservaModal').modal('show');
	$('#operation').val('Add');
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nueva Reserva");
});

$(document).on('click', '.detalleReservaModal', function () {
	$('#detalleReservaModal').modal('show');
	$('#operation').val('Add');
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nueva Reserva");
});

$(function () {
	$('#sel_tercero').select2();
    
    $('.selectGrupo').select2({
		theme: 'bootstrap4'
	})
})

$(function () {
})

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
=            									VALIDACION FORMULARIO FILTROS BUSQUEDA 							
==================================================================================================================*/

var validador = $('#frmReserva').validate({
	rules: {
		txt_booking: {
			required: true,
		},
		sel_linea: {
			required: true,
		},
		txt_cliente: {
			required: true,
		},
		sel_tisalida: {
			required: true,
		},
		fecvence: {
			required: true,
		},
		sel_estado: {
			required: true,
		}
	},
	messages: {
		txt_booking: {
			required: "El No. de Reserva es obligatorio"

		},
		sel_linea: {
			required: "Debe Seleccionar una Linea"
		},
		txt_cliente: {
			required: "El Cliente de la Reserva es obligatorio"
		},
		sel_tisalida: {
			required: "El Tipo de salida es requerido"
		},
		fecvence: {
			required: "Fecha de vencimiento requerida"
		},
		sel_estado: {
			required: "El Estado es requerido"
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
