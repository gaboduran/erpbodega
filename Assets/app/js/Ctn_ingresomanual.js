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


$('#sel_linea').change(function (e) {
	event.preventDefault();
	let idlinea = $(this).val();
	$("#txt_desvio_motdev").val("");
	$("#txt_des_desvio_motdev").val("");
	document.getElementById('myLabel').innerHTML = '.';

	try {
		const url = `${base_url}ctn_ingresomanual/carga_tipocont`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idlinea: idlinea },
			dataType: "json",
			success: function (data) {
				var s = '<option value="">Seleccione Tipo</option>';
				for (var i = 0; i < data.length; i++) {
					s += '<option value="' + data[i].ID + '">' + data[i].CODIGO + '</option>';
				}
				$("#sel_tipocont").html(s);
			}
		})
	} catch (err) {
		console.log(err);
	}
});




async function seleccionar(id, nombre) {
	event.preventDefault();
	$("#txt_desvio_motdev").val(id);
	$("#txt_des_desvio_motdev").val(nombre);
	$('#devolucionModal').modal('hide');
}


$('#sel_movimiento').change(function (e) {
	event.preventDefault();
	let idmovimiento = $(this).val();
	let idlinea = $("#sel_linea").val();
	if (idmovimiento == 20) {
		document.getElementById('myLabel').innerHTML = 'MOTIVO DEVOLUCION';

		try {
			const url = `${base_url}ctn_ingresomanual/cargaTipoDevolucion`;
			$.ajax({
				url: url,
				method: "POST",
				data: { idmovimiento: idmovimiento, idlinea: idlinea },
				success: function (data) {
					$('#devolucionModal').modal('show');
					$(".modal-header").css("background-color", "#17a2b8");
					$(".modal-header").css("color", "white");
					$(".modal-title").text("Editar Componente");
					document.getElementById("HTMLdetalleDocumentos").innerHTML = data;

				}
			})
		} catch (err) {
			console.log(err);
		}
	} else if (idmovimiento == 13) {

		document.getElementById('myLabel').innerHTML = 'SITIO DESVIO';

		try {
			const url = `${base_url}ctn_ingresomanual/cargaSitioDesvio`;
			$.ajax({
				url: url,
				method: "POST",
				data: { idmovimiento: idmovimiento, idlinea: idlinea },
				success: function (data) {
					$('#devolucionModal').modal('show');
					$(".modal-header").css("background-color", "#17a2b8");
					$(".modal-header").css("color", "white");
					$(".modal-title").text("Editar Componente");
					document.getElementById("HTMLdetalleDocumentos").innerHTML = data;

				}
			})
		} catch (err) {
			console.log(err);
		}
	} else {
		document.getElementById('myLabel').innerHTML = '.';
		$("#txt_desvio_motdev").val("");
		$("#txt_des_desvio_motdev").val("");

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


$("#txt_clienteimpo").autocomplete({
	minLength: 3,
	source: function (request, response) {
		$.ajax({
			url: `${base_url}Ctn_ingresomanual/getClientesImpo`,
			dataType: "json",
			data: {
				search1: request.term,
				search2: ""
			},
			success: function (data) {
				response($.map(data, function (item) {
					return {
						label: item.IDECLIENTE + " | " + item.NOMCLIENTE,
						value: item.NOMCLIENTE,
						txt_idclienteimpo: item.ID
					}
				},
				))
			}
		});
	},
	select: function (event, values) {
		$("#txt_idclienteimpo").val(values.item.txt_idclienteimpo);
		$("#txt_clienteimpo").val(values.item.value);
	},
	change: function (event, ui) {
		if (ui.item == null || ui.item == undefined) {
			$("#txt_idclienteimpo").val("");
			$("#txt_clienteimpo").val("");
			$("#txt_clienteimpo").focus();
			toastr.error('Atención: El Cliente no existe.');
		}
	}
});


$("#txt_nomconductor").autocomplete({
	minLength: 3,
	source: function (request, response) {
		$.ajax({
			url: `${base_url}Ctn_ingresomanual/getConductor`,
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
						txt_idconductor: item.ID,
						txt_telefono: item.TELEFONO
					}
				},
				))
			}
		});
	},
	select: function (event, values) {
		$("#txt_telefono").val(values.item.txt_telefono);
		$("#txt_idconductor").val(values.item.txt_idconductor);
		$("#txt_nomconductor").val(values.item.value);

	},
	change: function (event, ui) {
		if (ui.item == null || ui.item == undefined) {
			$("#txt_idconductor").val("");
			$("#txt_nomconductor").val("");
			$("#txt_telefono").val("");
			$("#txt_nomconductor").focus();
			toastr.error('Atención: El Conductor no existe.');
		}
	}
});


$('#sel_linea').change(function (e) {
	let idlinea = $(this).val()
	event.preventDefault();
	try {
		const url = `${base_url}ctn_ingresomanual/cargaIngresos`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idlinea: idlinea },
			dataType: "json",
			success: function (data) {
				var s = '<option value="">Seleccione Movimiento</option>';
				for (var i = 0; i < data.length; i++) {
					s += '<option value="' + data[i].IDMOVIMIENTO + '">' + capitalizarPrimeraLetra(data[i].DESCRIPCION) + '</option>';
				}
				$("#sel_movimiento").html(s);
			}
		})
	} catch (err) {
		console.log(err);
	}
});

async function procesar() {
	event.preventDefault();
	var valida;
	valida = $("#frmIngresoCont").valid();
	if (valida == true) {
		let frmIngresoCont = new FormData(document.querySelector("#frmIngresoCont"));
		try {
			const url = `${base_url}Ctn_ingresomanual/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmIngresoCont,

			});
			const resultado = await respuesta.json();
			if (resultado.status == 'ingreso_ok') {
				toastr.success('Ingreso Satisfactorio');
				$("#idingreso").val(resultado.idingreso);
				$("#operation").val("Edit");
				$("#btn_Uploadfotos").prop('disabled', false);
				$("#btn_inspeccion").prop('disabled', false);

			}else if (resultado.status == 'update_ok'){
				toastr.success('Actualización exitosa');
				$("#operation").val("Edit");
			}else if (resultado.status == 'existe'){
				Swal.fire({
					title: "Error: ",
					text: "El contenedor existe en el inventario",
					icon: "error"
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


async function deleteImage(idimage, idingreso) {
	event.preventDefault();
	Swal.fire({
		title: 'Eliminar Imagen',
		text: "Confirma que desea eliminar la Imagen seleccionada?",
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Eliminar'
	}).then((result) => {
		if (result.isConfirmed) {
			try {
				$.ajax({
					url: `${base_url}Ctn_ingresomanual/eliminarImage`,
					method: "POST",
					data: { idimage: idimage, idingreso: idingreso },
					dataType: "json",
					success: function (data) {
						console.log(data);
						if (data.status == true) {
							toastr.success('Imagen Eliminada');
							Uploadfotos();
						} else if (data.status == false) {
							toastr.error('Se ha presnetado un error interno durante la eliminacion')
						} else if (data.status == 'no_exite') {
							toastr.error('Atención: La imagen no existe')
						}
					}
				})
			} catch (err) {
				console.log(err);
			}
		}
	})
}

async function Uploadfotos() {
	event.preventDefault();
	var idingreso = $("#idingreso").val();
	const url = `${base_url}Ctn_ingresomanual/getImages/${idingreso}`;
	try {
		var elemento = document.getElementById('result');
		$.ajax({
			url: url,
			method: "POST",
			dataType: "json",
			success: function (data) {
				document.getElementById("result").innerHTML = data.html;
				$('.thumbnail').viewbox({
					template: '<div class="viewbox-container"><div class="viewbox-body"><div class="viewbox-header"></div><div class="viewbox-content"></div><div class="viewbox-footer"></div></div></div>',
					loader: '<div class="loader"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>',
					setTitle: true,
					margin: 20,
					resizeDuration: 300,
					openDuration: 200,
					closeDuration: 200,
					closeButton: true,
					navButtons: true,
					closeOnSideClick: true,
					nextOnContentClick: true,
					useGestures: true,
					imageExt: ['png', 'jpg', 'jpeg', 'webp', 'gif']
				});
				$('#UploadfotosModal').modal('show');
			}
		})
	} catch (err) {
		console.log(err);
	}
}

$('#uploadForm').on('submit', function (e) {
	event.preventDefault();
	var inputFile = $('<input type="file" accept=".jpg, .jpeg, .png" multiple>');
	var idingreso = $("#idingreso").val();
	inputFile.on('change', function () {
		var formData = new FormData();
		formData.append('idingreso', idingreso);
		$.each(inputFile[0].files, function (i, file) {
			formData.append('files[]', file); // Agregar cada archivo al formData
		});
		try {
			showLoadingOverlay();
			$.ajax({
				url: `${base_url}Upload/subirImagen`,
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				enctype: 'multipart/form-data',
				success: function (response) {
					Uploadfotos();
				},
				error: function (error) {
					console.error('Error al adjuntar el documento', error);
				}
			});
		} catch (err) {
			console.log(err);
		} finally {
			hideLoadingOverlay();
		}

	});
	inputFile.click();
})

async function IngresoDanos() {
	event.preventDefault();
	var idingreso = $("#idingreso").val()
	window.location.href = `${base_url}ctn_ingresomanual/inspeccion/`+idingreso;
}


$(document).on('click', '.danosModal', function () {
	$('#danoModal').modal({backdrop: 'static', keyboard: false},"show");
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nuevo Daño");
});


$('#datetimepicker_fabricacion').datetimepicker({
	format: 'MM-YYYY',
	viewMode: 'years'
});

$(function () {
	$('#sel_linea').select2({});

})

function capitalizarPrimeraLetra(str) {
	return str.charAt(0).toUpperCase() + str.slice(1);
}


$(function () {
	$('#datetimepicker_fabricacion').datetimepicker({
		viewMode: 'years',
		format: 'YYYY/MM'
	});
});


function validaNumericos(event) {
	if (event.charCode >= 48 && event.charCode <= 57) {
		return true;
	}
	return false;
}

$("#txt_ncont").blur(function () {
	var sigla = document.getElementById("txt_sigla").value;
	var ncont = document.getElementById("txt_ncont").value;
	var idcont = sigla + ncont;
	digito = calculaDigito(idcont);
	$('#txt_digito').val(digito);
});

$(document).on('click', '.Uploadfotos', function () {
	$('#UploadfotosModal').modal('show');
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Cargar Fotos");
});


function calculaDigito(idcont) {
	var lnSuma1 = 0;
	for (var i = 0; i < 10; i++) {
		if (i >= 4) {
			lnDigito = idcont.substr(i, 1);
		} else {
			lnDigito = idcont.substr(i, 1);
			lnDigito = lnDigito.charCodeAt(0) - 55;
			lnDigito = lnDigito + parseInt((lnDigito - 1) / 10);
		}
		lnSuma1 = lnSuma1 + lnDigito * Math.pow(2, i);
	}
	lnDigVer = lnSuma1 - parseInt(lnSuma1 / 11) * 11;
	if (lnDigVer == 10) {
		lnDigVer = 0;
	}
	if (isNaN(lnDigVer) || lnDigVer < 0) {
		lnDigVer = "";
	}

	return lnDigVer;
}

/*=================================================================================================================
=            									VALIDACION FORMULARIO DAÑOS
==================================================================================================================*/
var validador = $('#frmIngresoCont').validate({
	rules: {
		sel_linea: {
			required: true,
		},
		txt_sigla: {
			required: true,
			minlength: 4
		},
		txt_ncont: {
			required: true,
			minlength: 6
		},
		sel_tipocont: {
			required: true,
		},
		fabricacion: {
			required: true,
		},
		txt_bl: {
			required: true,
		},
		sel_movimiento: {
			required: true,
		},
		txt_bl: {
			required: true,
		},
		txt_clienteimpo: {
			required: true,
		},
		txt_nomtransporte: {
			required: true,
		},
		txt_nomconductor: {
			required: true,
		},
		txt_placa: {
			required: true,
		},



	},
	messages: {
		sel_linea: {
			required: "Campo Requerido"

		},
		txt_sigla: {
			required: "El Campo Requerido",
			minlength: "Ingrese la información completa"
		},
		txt_ncont: {
			required: "El Campo Requerido",
			minlength: "Ingrese la información completa"
		},
		sel_tipocont: {
			required: "El Campo Requerido"
		},
		fabricacion: {
			required: "El Campo Requerido"
		},
		txt_bl: {
			required: "El Campo Requerido"
		},
		sel_movimiento: {
			required: "El Campo Requerido"
		},
		txt_clienteimpo: {
			required: "El Campo Requerido"
		},
		txt_nomtransporte: {
			required: "El Campo Requerido"
		},
		txt_nomconductor: {
			required: "El Campo Requerido"
		},
		txt_placa: {
			required: "El Campo Requerido"
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