document.addEventListener("DOMContentLoaded",
	function () {
		tblIsoCodes = $('#tblIsoCodes').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}OrdenTransporte/getAllOrdenesTransporte`,
			},
			columns: [
				{ data: "id" },
				{ data: "nomcliente" },
				{ data: "codigo" },
				{ data: "fvence" },
				{ data: "estado" },
				{ data: "options" }
			],
			"columnDefs": [{
				"targets": [0],
				"visible": true
			}]

		});
	},
	false
)

async function verDetalleOrden(idorden) {
	event.preventDefault();
	try {
		const url = `${base_url}OrdenTransporte/verDetalleOrden`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idorden: idorden },
			dataType: "json",
			success: function (data) {
				$('#empresas-tab').removeClass('disabled');
				$('#ordenTransporteModal').modal('show');
				$("#txt_idorden").val(idorden);
				$("#myTab a:first").parent("li").show();
				$("#myTab a:first").tab('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Orden de Transporte " + idorden);
				$("#sel_cliente").select2({ dropdownParent: $('#ordenTransporteModal') }).val(data.IDCLIENTE).trigger("change");
				$("#sel_tiorden").val(data.TIPOORDEN);
				$("#operation").val("Edit");
				$("#operation_item").val("Add");
				$("#btn_actionItem").val("Agregar");
				getTransporteOrden();
			}
		})
	} catch (err) {
		console.log(err);
	}
}


async function procesar() {
	event.preventDefault();
	var valida;
	valida = $("#frmOrdenTransporte").valid();
	if (valida == true) {
		let frmOrdenTransporte = new FormData(document.querySelector("#frmOrdenTransporte"));
		try {
			const url = `${base_url}OrdenTransporte/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmOrdenTransporte,
			});
			const data = await respuesta.json();
			if (data.status == "save_ok") {
				$("#txt_idorden").val(data.idorden);
				tblIsoCodes.ajax.reload(null, false);
				$('#empresas-tab').removeClass('disabled');

			}
		} catch (err) {
			console.log(err);
		}
	}
}

async function procesarTransporte() {
	event.preventDefault();
	var operation = $("#operation").val();
	var operation_item = $("#operation_item").val();
	var idorden = $("#txt_idorden").val();
	var idtransporte = $("#txt_idtransporte").val();
	var cantidad = $("#txt_cantidad").val();
	var iddetalle = $("#txt_id").val();
	var valida;
	valida = $("#form_valores").valid();
	if (valida == true) {
		try {
			const url = `${base_url}OrdenTransporte/procesarTransporte`;
			$.ajax({
				url: url,
				method: "POST",
				data: { operation: operation, operation_item : operation_item, idorden: idorden, idtransporte: idtransporte, cantidad: cantidad, iddetalle : iddetalle },
				dataType: "json",
				success: function (data) {
					if (data.status == "save_ok") {
						getTransporteOrden()
						$('#form_valores')[0].reset();
						$('#txt_nomtransporte').focus()
						toastr.success('Item Valorizado con Exito')
					} else if (data.status == "update_ok") {
						getTransporteOrden()
						$('#form_valores')[0].reset();
						$("#operation_item").val("Add");
						$('#txt_nomtransporte').focus()
						$("#btn_actionItem").val("Agregar");
						toastr.success('Item Actualizado con Exito')
					} else if (data.status == "errorvalida") {
						toastr.error('Atencion: Complete todos los Campos')
					}
				}
			})
		} catch (err) {
			console.log(err);
		}
	}
}


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

async function getTransporteOrden() {
	var idorden = $("#txt_idorden").val();
	try {
		const url = `${base_url}OrdenTransporte/getTransporteOrden`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idorden: idorden },
			success: function (data) {
				document.getElementById("detalleTransporteOrden").innerHTML = data;
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function verDetalleTransporte(id) {
	event.preventDefault();
	try {
		const url = `${base_url}OrdenTransporte/verDetalleTransporte`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id },
			dataType: "json",
			success: function (data) {
				$("#txt_id").val(data.ID);
				$("#operation_item").val("Edit");
				$("#btn_actionItem").val("Editar");
				$("#txt_idtransporte").val(data.IDTRANSPORTE);
				$("#txt_nomtransporte").val(data.NOMBRE);
				$("#txt_cantidad").val(data.CANTIDAD);
			}
		})
	} catch (err) {
		console.log(err);
	}

}

function eliminarTransporteOrden(id) {
	var id;
	Swal.fire({
		title: 	'Eliminar Transporte Orden ',
		text: 	"Confirma que desea eliminar el transporte seleccionado de la orden?",
		icon: 	'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Eliminar'
	}).then((result) => {
		if (result.isConfirmed) {
			event.preventDefault();
			$.ajax({
				url: `${base_url}OrdenTransporte/eliminartransporteorden`,
				method: "POST",
				data: { id: id },
				dataType: "json",
				success: function (data) {
					if (data.status == "delete_ok") {
						toastr.success('Transporte eliminado con Exito')
						getTransporteOrden()
					}
				}
			})
		}
	})
}


function eliminarOrden(id) {
	var id;
	Swal.fire({
		title: 	'Eliminar Orden de Transporte ',
		text: 	"Confirma que desea eliminar la Orden de Transporte?",
		icon: 	'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Eliminar'
	}).then((result) => {
		if (result.isConfirmed) {
			event.preventDefault();
			$.ajax({
				url: `${base_url}OrdenTransporte/eliminarorden`,
				method: "POST",
				data: { id: id },
				dataType: "json",
				success: function (data) {
					if (data.status == "delete_ok") {
						toastr.success('Orden de Transporte eliminada con Exito')
						tblIsoCodes.ajax.reload(null, false);
					}
				}
			})
		}
	})
}


$(function () {
	$('#sel_cliente').select2({
	});
})


$(document).on('click', '.Ordentransporte', function () {
	$('#ordenTransporteModal').modal('show');
	$('#frmOrdenTransporte')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nuevo Orden de Transporte");
	$("#operation").val("Add");
	$("#operation_item").val("Add");
	$('#empresas-tab').addClass('disabled');
	$("#myTab a:first").parent("li").show();
	$("#myTab a:first").tab('show');
});





/*=================================================================================================================
=            									VALIDACION FORMULARIO ISOCODE 							
==================================================================================================================*/
var validador = $('#form_valores').validate({
	rules: {
		txt_cantidad: {
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
		txt_cantidad: {
			required: "La cantidad es Requerida"

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