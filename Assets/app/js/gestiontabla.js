$(document).ready(function () {
	$('.selectGrupo').select2();
	$('.selectTamano').select2();
	getAllunidadMedida();
	getAllLocaliza();
});

document.addEventListener("DOMContentLoaded",
	function () {
		var idtabla = $("#txt_idtabla").val();
		tblDetatablaReparacion = $('#tblDetatablaReparacion').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}gestiontabla/getAlldetalleTabla`,
				method: "POST",
				data: { idtabla: idtabla },
			},
			columns: [
				{ data: "iditem" },
				{ data: "componente" },
				{ data: "reparacion" },
				{ data: "tipoliquida" },
				{ data: "tiporepara" },
				{ data: "grupotipcont" },
				{ data: "material" },
				{ data: "localiza" },
				{ data: "estado" },
				{ data: "options" }
			],
		});
	},
	false
)


/*=================================================================================================================
=            				OBTIENE TODOS LOS VALORES DE UN ITEM ESPECIFICO DE UNA TABLA DE REPARACION
==================================================================================================================*/

async function getDatosValores(iditem) {
	event.preventDefault();
	try {
		const url = `${base_url}gestiontabla/getDatosValores`;
		$.ajax({
			url: url,
			method: "POST",
			data: { iditem: iditem },
			success: function (data) {
				document.getElementById("detalleValoresbyItem").innerHTML = data;
			}
		})
	} catch (err) {
		console.log(err);
	}
}


async function getDetalleTablaValores(iditem) {
	event.preventDefault();
	try {
		const url = `${base_url}gestiontabla/getDatosValores`;
		$.ajax({
			url: url,
			method: "POST",
			data: { iditem: iditem },
			success: function (data) {
				document.getElementById("detalleValoresbyItem").innerHTML = data;
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function getDetalleTablaValoresUnidad(iditem) {
	event.preventDefault();
	try {
		const url = `${base_url}gestiontabla/getDatosValores`;
		$.ajax({
			url: url,
			method: "POST",
			data: { iditem: iditem },
			success: function (data) {
				document.getElementById("detalleValoresbyItemUnd").innerHTML = data;
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function getAllunidadMedida() {
	try {
		const url = `${base_url}gestiontabla/getAllunidadMedida`;
		$.ajax({
			url: url,
			method: "POST",
			success: function (data) {
				$("#sel_unidad").html(data);
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function getAllLocaliza() {
	try {
		const url = `${base_url}gestiontabla/getAllLocaliza`;
		$.ajax({
			url: url,
			method: "POST",
			success: function (data) {
				$("#sel_localiza").html(data);
			}
		})
	} catch (err) {
		console.log(err);
	}
}


$("#sel_tipoliquida").change(function () {
	idtipoliquida = $(this).val();
	try {
		const url = `${base_url}gestiontabla/getAllUniMedidaByTipoLiquida`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idtipoliquida: idtipoliquida },
			success: function (data) {
				$("#sel_unidad").html(data);
			}
		})
	} catch (err) {
		console.log(err);
	}
});


$("#sel_componente").change(function () {
	idcomponente = $(this).val();
	try {
		const url = `${base_url}gestiontabla/getLocalizabyComponente`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idcomponente: idcomponente },
			success: function (data) {
				$("#sel_localiza").html(data);
			}
		})
	} catch (err) {
		console.log(err);
	}
});

async function procesarItem() {
	event.preventDefault();
	try {
		const url = `${base_url}gestiontabla/addtarifa`;
		$.ajax({
			url: url,
			method: "POST",
			data: $('#frmnuevoItemTabla').serialize(),
			dataType: "json",
			success: function (data) {
				if (data.status == "save_ok") {
					toastr.success('Item Creado con Exito')
					$("#txt_iditem").val(data.iditem);
					tblDetatablaReparacion.ajax.reload(null, false);
					$('#tarifas-tab').removeClass('disabled');
				} else if (data.status == "update_ok") {
					toastr.success('Item Actualizado con Exito');
					tblDetatablaReparacion.ajax.reload(null, false);
					$('#ItemTablaModal').modal('hide');
				} else if (data.status == "error") {
					toastr.error('Error Interno')
				}
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function verItemTabla(iditemtabla, codcomponente) {
	event.preventDefault();
	document.getElementById("detalleValoresbyItem").innerHTML = "";
	document.getElementById("detalleValoresbyItemUnd").innerHTML = "";
	try {
		const url = `${base_url}gestiontabla/verItemTabla`;
		$.ajax({
			url: url,
			method: "POST",
			data: { iditemtabla: iditemtabla },
			dataType: "json",
			success: function (data) {
				$('#ItemTablaModal').modal('show');
				if (data.TIPOLIQUIDA == 'UNIDAD') {
					getDetalleTablaValoresUnidad(iditemtabla);
					$('#unidad-tab').removeClass('disabled');
					$('#tarifas-tab').addClass('disabled');
				}
				if (data.TIPOLIQUIDA == 'AREA' || data.TIPOLIQUIDA == 'LINEAL') {
					getDetalleTablaValores(iditemtabla);
					$('#tarifas-tab').removeClass('disabled');
					$('#unidad-tab').addClass('disabled');
				}
				$("#myTab a:first").parent("li").show();
				$("#myTab a:first").tab('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Item Tabla " + iditemtabla);
				$(".selectTamano").select2({ dropdownParent: $('#ItemTablaModal') }).val(data.TAMANO).trigger("change");
				$(".selectGrupo").select2({ dropdownParent: $('#ItemTablaModal') }).val(data.GRUPOTIPOCONT).trigger("change");
				$("#sel_componente").select2({ dropdownParent: $('#ItemTablaModal') }).val(data.CODCOMPONENTE).trigger("change");
				$("#sel_reparacion").select2({ dropdownParent: $('#ItemTablaModal') }).val(data.CODREPARA).trigger("change");
				$("#sel_material").val(data.CODMATERIAL);
				$("#sel_tipoliquida").val(data.TIPOLIQUIDA);
				$("#sel_tiporepara").val(data.TIPOREPARA);
				$("#sel_localiza").val(data.LOCALIZA);
				$("#sel_unidad").val(data.UNIDADMED);
				$("#txt_id").val("");
				$("#txt_idund").val("");
				$("#operation_item").val("Add");
				$("#operation_itemund").val("Add");
				$("#operation").val("Edit");
				$("#txt_iditem").val(iditemtabla);
				$("#txt_largo").val("");
				$("#txt_ancho").val("");
				$("#txt_hh").val("");
				$("#txt_vlrmaterial").val("");
				$("#btn_actionItem").val("Agregar");
				$("#btn_actionItemund").val("Agregar");

			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function addValoresItem() {
	event.preventDefault();
	var operation = $("#operation").val();
	var operation_item = $("#operation_item").val();
	var iditemvalor = $("#txt_id").val();
	var idtabla = $("#txt_idtabla").val();
	var itemtabla = $("#txt_iditem").val();
	var tipoliquida = $("#sel_tipoliquida").val();
	var largo = $("#txt_largo").val();
	var ancho = $("#txt_ancho").val();
	var vlrmaterial = $("#txt_vlrmaterial").val();
	var tiempo = $("#txt_hh").val();
	try {
		const url = `${base_url}gestiontabla/addValorItemTabla`;
		$.ajax({
			url: url,
			method: "POST",
			data: {
				operation: operation, operation_item: operation_item, itemtabla: itemtabla, idtabla: idtabla, iditemvalor: iditemvalor,
				largo: largo, ancho: ancho, vlrmaterial: vlrmaterial, tiempo: tiempo, tipoliquida: tipoliquida
			},
			dataType: "json",
			success: function (data) {
				console.log(data);
				if (data.status == "save_ok") {
					getDetalleTablaValores(itemtabla);
					$('#form_valores')[0].reset();
					$('#txt_largo').focus()
					$("#operation_item").val("Add");
					$("#btn_actionItem").val("Agregar");
					toastr.success('Item Valorizado con Exito')
				}else if (data.status == "update_ok") {
					getDetalleTablaValores(itemtabla);
					$('#form_valores')[0].reset();
					$("#operation_item").val("Add");
					$("#btn_actionItem").val("Agregar");
					$('#txt_largo').focus()
					toastr.success('Item Actualizado con Exito')
				}else if (data.status == "rango_existe") {
					toastr.error('Rango Existe')

				}
			}
		})
	} catch (err) {
		console.log(err);
	}

}

async function verDetalleValorItem(id) {
	event.preventDefault();
	try {
		const url = `${base_url}gestiontabla/verDetalleValorItem`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id },
			dataType: "json",
			success: function (data) {
				$("#txt_id").val(data.ID);
				$("#operation_item").val("Edit");
				$("#btn_actionItem").val("Editar");
				$("#txt_largo").val(data.LARGO);
				$("#txt_ancho").val(data.ANCHO);
				$("#txt_vlrmaterial").val(data.CTOMATDEPOT);
				$("#txt_hh").val(data.TMPHORDEPOT);

			}
		})
	} catch (err) {
		console.log(err);
	}

}


async function verDetalleValorItemUnd(id) {
	event.preventDefault();
	try {
		const url = `${base_url}gestiontabla/verDetalleValorItem`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id },
			dataType: "json",
			success: function (data) {
				$("#txt_idund").val(data.ID);
				$("#operation_itemund").val("Edit");
				$("#btn_actionItemund").val("Editar");
				$("#txt_cantidad").val(data.CANTIDAD);
				$("#txt_vlrmaterialund").val(data.CTOMATDEPOT);
				$("#txt_hhund").val(data.TMPHORDEPOT);

			}
		})
	} catch (err) {
		console.log(err);
	}

}

function eliminarItem(iditem) {
	var iditem;
	Swal.fire({
		title: 'Eliminar Item Tabla',
		text: "Confirma que desea eliminar el Item seleccionado?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Eliminar'
	}).then((result) => {
		if (result.isConfirmed) {
			event.preventDefault();
			$.ajax({
				url: `${base_url}gestiontabla/eliminarItem`,
				method: "POST",
				data: { iditem: iditem },
				dataType: "json",
				success: function (data) {
					if (data == true) {
						toastr.success('Item Eliminado con Exito')
						tblDetatablaReparacion.ajax.reload(null, false);

					}

				}
			})

		}
	})
}

async function deleteItemValor(id) {
	event.preventDefault();
	try {
		const url = `${base_url}gestiontabla/deleteItemvalor`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id },
			dataType: "json",
			success: function (data) {
				if (data.status == "delete_ok") {
					toastr.success('Item Eliminado con Exito')
					getDetalleTablaValores();
				} else if (data.status == "delete_error") {
					toastr.warning('Se ha presnetado un error interno durante la eliminacion')
				}
			}
		});
	} catch (err) {
		console.log(err);
	}

}

async function duplicaItem(id) {
	event.preventDefault();
	var idtabla = $("#txt_idtabla").val();
	try {
		const url = `${base_url}gestiontabla/duplicaItem`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id, idtabla: idtabla },
			dataType: "json",
			success: function (data) {
				$('#duplicaItemModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Duplicar Item Tabla " + id);
				$("#txt_idtabladup").val(idtabla);
				$("#txt_iditemdup").val(id);
				sale = '<select id="listLineas" name="listLineas[]" multiple class="form-control" size="8" style="font-size:14px;" >';
				for (i = 0; i < data.length; i++) {
					sale += '<option value="' + data[i]['ID'] + '">' + data[i]['NOMCLIENTE'].toUpperCase() + '</option>';
				};
				sale += '</select>';
				$("#selectB").html(sale);
			}
		})
	} catch (err) {
		console.log(err);
	}
}


async function procesarduplicarItem() {
	event.preventDefault();
	var valida;
	valida = $("#frmDuplicaItem").valid();
	if (valida == true) {
		try {
			const url = `${base_url}gestiontabla/procesarduplicarItem`;
			$.ajax({
				url: url,
				method: "POST",
				data: $('#frmDuplicaItem').serialize(),
				dataType: "json",
				success: function (data) {
					if (data.status == "save_ok") {
						toastr.success('Item Duplicado con Exito');
						$('#duplicaItemModal').modal('hide');
					} else if (data.status == "VACIO") {
						toastr.error('Debe seleccionar al menos una linea para completar proceso');
					}
				}
			})
		} catch (err) {
			console.log(err);
		}
	}
}


async function addValoresItemUnidad() {
	event.preventDefault();
	var operation = $("#operation").val();
	var operation_itemund = $("#operation_itemund").val();
	var itemtabla = $("#txt_iditem").val();
	var idtabla = $("#txt_idtabla").val();
	var iditemvalor = $("#txt_idund").val();
	var tipoliquida = $("#sel_tipoliquida").val();
	var cantidad = $("#txt_cantidad").val();
	var vlrmaterial = $("#txt_vlrmaterialund").val();
	var tiempo = $("#txt_hhund").val();
	try {
		const url = `${base_url}gestiontabla/addValorItemTablaUnidad`;
		$.ajax({
			url: url,
			method: "POST",
			data: {
				operation: operation, operation_itemund: operation_itemund, itemtabla: itemtabla, idtabla: idtabla,
				iditemvalor: iditemvalor, cantidad: cantidad, vlrmaterial: vlrmaterial, tiempo: tiempo, tipoliquida: tipoliquida
			},
			dataType: "json",
			success: function (data) {
				if (data.status == 'save_ok') {
					toastr.success('Tarifa Creada con Exito!');
					getDetalleTablaValoresUnidad(itemtabla);
				} else if (data.status == 'update_ok') {
					toastr.success('Tarifa Actualizada con Exito!');
					$('#form_valores')[0].reset();
					$("#operation_item").val("Add");
					$("#btn_actionItemund").val("Agregar");
					getDetalleTablaValoresUnidad(itemtabla);
				} else if (data.status == 'und_existe') {
					Swal.fire({
						title: "Error",
						text: "Atención la tarifa ya esta configurar. Editela si fuese el necesario",
						icon: "error"
					});
				}

			}
		})
	} catch (err) {
		console.log(err);
	}

}

$(document).on('click', '.ItemTablaModal', function () {
	$('#ItemTablaModal').modal('show');
	$("#txt_largo").val("");
	$("#txt_ancho").val("");
	$("#txt_hh").val("");
	$("#txt_vlrmaterial").val("");
	$("#txt_id").val("");
	$("#txt_idund").val("");
	document.getElementById("detalleValoresbyItem").innerHTML = "";
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nuevo Item Tabla de Reparación");
	$('#frmnuevoItemTabla')[0].reset();
	$("#sel_componente").select2({ dropdownParent: $('#ItemTablaModal') }).val("").trigger("change");
	$("#sel_reparacion").select2({ dropdownParent: $('#ItemTablaModal') }).val("").trigger("change");
	$(".selectTamano").select2({ dropdownParent: $('#ItemTablaModal') }).val("").trigger("change");
	$(".selectGrupo").select2({ dropdownParent: $('#ItemTablaModal') }).val("").trigger("change");
	$("#operation").val("Add");
	$("#operation_item").val("Add");
	$("#operation_itemund").val("Add");
	$("#btn_actionItem").val("Agregar");
	$("#btn_actionItemund").val("Agregar");
	$('#tarifas-tab').addClass('disabled');
	$('#unidad-tab').addClass('disabled');
	$("#myTab a:first").parent("li").show();
	$("#myTab a:first").tab('show');
	getDetalleTablaValores();
});


$(function () {
	$('#sel_componente').select2({
		dropdownParent: $('#ItemTablaModal')
	});
})

$(function () {
	$('#sel_reparacion').select2({
		dropdownParent: $('#ItemTablaModal')
	});
})


$(function () {
	$('.selectGrupo').select2({
		theme: 'bootstrap4'
	})
	$('.selectTamano').select2({
		theme: 'bootstrap4'
	})
})


function LimpiarForm() {
	$('#form_valores')[0].reset();
	$("#operation_item").val("Add");
	$('#txt_largo').focus();
	$("#btn_actionItem").val("Agregar");

}

function trim(myString) {
	return myString.replace(/^\s+/g, '').replace(/\s+$/g, '')
}

function devuelve_float(num, prefix) {
	num = Math.round(parseFloat(num) * Math.pow(10, 2)) / Math.pow(10, 2)
	prefix = prefix || '';
	num += '';
	var splitStr = num.split('.');
	var splitLeft = splitStr[0];
	var splitRight = splitStr.length > 1 ? '.' + splitStr[1] : '.00';
	splitRight = splitRight + '00';
	splitRight = splitRight.substr(0, 3);
	var regx = /(\d+)(\d{3})/;
	var mmdev = trim(prefix + ' ' + splitLeft + splitRight);
	if (mmdev == "NaN.00" || mmdev == "NaN")
		mmdev = "0.00";
	return mmdev;
}


/*=================================================================================================================
=            									VALIDACION FORMULARIO DUPLICA ITEM 							
==================================================================================================================*/
var validador = $('#frmDuplicaItem').validate({
	rules: {
		listLineas: {
			required: true,
		},

	},
	messages: {
		listLineas: {
			required: "El Codigo es Requerido"

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