
$(document).ready(function () {
	getAlldetalleReserva();
	getAlldetalleSalidaByTipo(idreserva = '', iddetreserva = '', idtipocont = '');
	var operation = $("#operation").val();
	if (operation == 'Edit') {
		$("#Btn_nuevodetalleReservaModal").attr("disabled", false);
	}
});

function getAlldetalleSalidaByTipo(idreserva, iddetreserva, idtipocont) {
	try {
		const url = `${base_url}reserva/getAlldetalleSalidaByTipo`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idreserva: idreserva, iddetreserva: iddetreserva, idtipocont: idtipocont },
			success: function (data) {
				document.getElementById("tblDetallesalida").innerHTML = data;
			}
		})
	} catch (err) {
		console.log(err);
	}

}


function carga_datatable(idreserva = '', iddetreserva = '', idtipocont = '') {
	tblDetallesalida = $('#tblDetallesalida').DataTable({
		paging: true,
		language: {
			url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
		},
		ajax: {
			method: "POST",
			url: `${base_url}reserva/getAlldetalleSalidaByTipo`,
			data: { idreserva: idreserva, iddetreserva: iddetreserva, idtipocont: idtipocont },
			dataSrc: "",
		},
		columns: [
			{ data: "id" },
			{ data: "idcir" },
			{ data: "ncont" },
			{ data: "tipocont" },
			{ data: "options" },
		],
	});
}


async function procesarReserva() {
	event.preventDefault();
	var operation = $("#operation").val();
	var idreserva = $("#txt_idreserva").val();
	var nroreserva = $("#txt_nroreserva").val();
	var idcliente = $("#txt_idcliente").val();
	var idtercero = $("#txt_idetercero").val();
	var fvence = $("#txt_fvence").val();
	var valida;
	valida = $("#frmDatosReserva").valid();
	if (valida == true) {
		try {
			const url = `${base_url}reserva/procesarReserva`;
			$.ajax({
				url: url,
				method: "POST",
				data: { operation: operation, nroreserva: nroreserva, idcliente: idcliente, idtercero: idtercero, fvence: fvence, idreserva: idreserva },
				dataType: "json",
				success: function (data) {
					if (data.status == "save_ok") {
						toastr.success('Reserva creada con exito');
						$("#txt_idreserva").val(data.idreserva);
						$("#Btn_nuevodetalleReservaModal").attr("disabled", false);
					} else if (data.status == "update_ok") {
						Swal.fire({
							title: 'Reserva Actualizada con Exito!',
							confirmButtonText: 'Aceptar',
						}).then((result) => {
							/* Read more about isConfirmed, isDenied below */
							if (result.isConfirmed) {
								location.href = base_url + "reserva/editar/" + idreserva;
							}
						})
					} else if (data.status == "reserva_existe") {
						toastr.error('El Nro. de Reserva Existe!');
					}
				}
			});
		} catch (err) {
			console.log(err);
		}
	}
}


async function procesardetalleReserva() {
	event.preventDefault();
	var operation = $("#txt_operation").val();
	var idreserva = $("#txt_idreserva").val();
	var iddetreserva = $("#txt_iddetReserva").val();
	var tipocont = $("#sel_tipocont").val();
	var cantidad = $("#txt_cantidad").val();
	var estado = $("#sel_estado").val();
	var valida;
	valida = $("#frmdetReserva").valid();
	if (valida == true) {
		try {
			const url = `${base_url}reserva/procesardetalleReserva`;
			$.ajax({
				url: url,
				method: "POST",
				data: { operation: operation, idreserva: idreserva, iddetreserva: iddetreserva, tipocont: tipocont, cantidad: cantidad, estado: estado },
				dataType: "json",
				success: function (data) {
					if (data.status == "save_ok") {
						$('#detalleReservaModal').modal('hide');
						toastr.success('Detalle agregado con exito');
						getAlldetalleReserva();
					} else if (data.status == "update_ok") {
						$('#detalleReservaModal').modal('hide');
						toastr.success('Actualizacion exitosa');
						getAlldetalleReserva();
					} else if (data.status == "detalle_existe") {
						toastr.error('El Tamaño y el Tipo ya estan creados');
					}
				}
			});
		} catch (err) {
			console.log(err);
		}
	}
}

async function getAlldetalleReserva() {
	var idreserva = $("#txt_idreserva").val();
	try {
		const url = `${base_url}reserva/getAlldetalleReserva`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idreserva: idreserva },
			success: function (data) {
				document.getElementById("detalleReserva").innerHTML = data;
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function editarDetallereserva(iddetreserva) {
	event.preventDefault();
	$("#sel_estado").removeClass("is-invalid");
	$("#sel_tipocont").removeClass("is-invalid");
	$("#txt_cantidad").removeClass("is-invalid");
	validador.resetForm();
	try {
		const url = `${base_url}reserva/verOneDetalleReserva`;
		$.ajax({
			url: url,
			method: "POST",
			data: { iddetreserva: iddetreserva },
			dataType: "json",
			success: function (data) {
				$('#detalleReservaModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Detalle Reserva");
				$("#sel_estado").val(data.ESTADO);
				$("#sel_tipocont").val(data.TIPOCONT);
				$("#txt_cantidad").val(data.CANTIDAD);
				$("#txt_operation").val("Edit");
				$("#txt_iddetReserva").val(data.ID);
			}
		})
	} catch (err) {
		console.log(err);
	}
}


async function getAlldetalleReservaByTipo(iddetreserva, idtipocont) {
	var idreserva = $("#txt_idreserva").val();
	try {
		const url = `${base_url}reserva/getAlldetalleReservaByTipo`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idreserva: idreserva, iddetreserva: iddetreserva, idtipocont: idtipocont },
			success: function (data) {
				document.getElementById("detalleReservabyTipo").innerHTML = data;
			}
		})
	} catch (err) {
		console.log(err);
	}

}

async function detalleSalida(id) {
	event.preventDefault();
	try {
		const url = `${base_url}reserva/getdetalleSalida`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id },
			dataType: "json",
			success: function (data) {
				$('#detalleSalidaModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Detalle Salida " + data.NCONT);
				
			}
		})
	} catch (err) {
		console.log(err);
	}
}

function gereraPDF(Criterio){
	event.preventDefault();
	alert('Aqui se genera un PDF');
}



	$(document).on('click', '.getClienteModal', function () {
		$('#buscaClienteModal').modal('show');
		document.getElementById("ResultBuscaCliente").innerHTML = "";
		$('#frmBuscaCliente')[0].reset();
		$(".modal-header").css("background-color", "#17a2b8");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Busca Cliente");
	});

	$(document).on('click', '.getTerceroModal', function () {
		$('#buscaTerceroModal').modal('show');
		document.getElementById("ResultBuscaTercero").innerHTML = "";
		$('#frmBuscaCliente')[0].reset();
		$(".modal-header").css("background-color", "#17a2b8");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Busca Tercero");
	});

	$(document).on('click', '.detalleReservaModal', function () {
		$('#detalleReservaModal').modal('show');
		$("#sel_tipocont").removeClass("is-invalid");
		$("#txt_cantidad").removeClass("is-invalid");
		$('#frmdetReserva')[0].reset();
		validador.resetForm();
		$("#txt_operation").val("Add");
		$(".modal-header").css("background-color", "#17a2b8");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Agregar Detalle Reserva");
	});


	//Date picker
	$('#maskfecha').datetimepicker({
		//  format: 'L',
		format: 'DD/MM/YYYY'

	});

	/*=================================================================================================================
	=            									VALIDACION FORMULARIO CATEGORIA CONTENEDOR 							
	==================================================================================================================*/
	var validador = $('#frmdetReserva').validate({
		rules: {
			sel_estado: {
				required: true,
			},
			sel_tipocont: {
				required: true,
			},
			txt_cantidad: {
				required: true,
			},
		},
		messages: {
			sel_estado: {
				required: "El Estado es Requerido"

			},
			sel_tipocont: {
				required: "El Tipo de Contenedor es Requerido"
			},
			txt_cantidad: {
				required: "La Cantidad es Requerido "
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