$(document).ready(function () {
	let idingreso = $("#idingreso").val();
	getDanos(idingreso);
	getImagendano();
	const url = `${base_url}Ctn_inspecciondanos/cargaIngreso`;
	try {
		$.ajax({
			url: url,
			method: "POST",
			data: { idingreso: idingreso },
			dataType: "json",
			success: function (data) {
				$("#txt_contenedor").text(data.CONTENEDOR);
				$("#txt_tipocontenedor").text(data.TIPOCONT);
				$("#txt_nomlinea").text(data.NOMLINEA);
				$("#txt_fechaingreso").text(data.FECHAINGRESO);
				$("#txt_fabricacion").text(data.FABRICACION);
				$("#txt_payload").text(data.PAYLOAD);
				$("#txt_tara").text(data.TARA);
				$("#txt_movimiento").text(data.TIPOINGRESO);
				$("#txt_comodato").text(data.COMODATO);
				$("#txt_cliente").text(data.NOMTERCERO);
				$("#txt_transporte").text(data.TRANSPORTE);
				$("#txt_nomconductor").text(data.NOMCONDUCTOR);
				$("#txt_placa").text(data.PLACA);
				$("#txt_telefono").text(data.TELEFONO);
				$("#txt_inspector").text(data.INSPECTOR);
				$("#txt_deposito").text(data.DEPOSITO);
				$("#sel_clasificacion").val(data.CLASIFICACION);
				$("#sel_categoria").val(data.CATEGORIA);
				$("#sel_condiciongral").val(data.CONDICIONGRAL);
			}
		})
	} catch (err) {
		console.log(err);
	}


});

$("#txt_componente").autocomplete({
	minLength: 3,
	source: function (request, response) {
		var idlinea 	= $("#txt_idlinea").val();
		var idingreso 	= $("#txt_idingreso").val();
		$.ajax({
			url: `${base_url}Ctn_inspecciondanos/getComponente`,
			dataType: "json",
			data: {
				search1: request.term,
				search2: idlinea,
				search3: idingreso
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

$("#txt_dano").autocomplete({
	minLength: 2,
	source: function (request, response) {
		var idcomponente = $("#codcomponente").val();

		$.ajax({
			url: `${base_url}Ctn_inspecciondanos/getDano`,
			dataType: "json",
			data: {
				search1: request.term,
				search2: idcomponente
			},
			success: function (data) {
				response($.map(data, function (item) {
					var coddano = item.CODDANO || '';
					var nombresp = item.NOMBRESP || '';
					var nombrein = item.NOMBREIN || '';
					if (coddano && nombresp) {
						return {
							label: item.NOMBREIN + " (" + item.CODDANO + ") " + item.NOMBRESP,
							value: item.CODDANO,
							txt_iddano: item.IDDANO
						}
					}
				},
				))
			}
		});
	},
	select: function (event, values) {
		$("#txt_iddano").val(values.item.txt_iddano);
		$("#txt_dano").val(values.item.value);
	},
	change: function (event, ui) {
		if (ui.item == null || ui.item == undefined) {
			$("#txt_iddano").val("");
			$("#txt_dano").val("");
			$("#txt_iddano").val("");
			$("#txt_dano").focus();
			toastr.error('Atención: La Orden de Transporte No Existe');
		}
	}
});


async function editaDano(iddano) {
	event.preventDefault();
	const url = `${base_url}Ctn_inspecciondanos/editaDano`;
	try {
		$.ajax({
			url: url,
			method: "POST",
			data: { iddano: iddano },
			dataType: "json",
			success: function (data) {
				$('#frmdetalledano')[0].reset();

				$('#danoModal').modal({ backdrop: 'static', keyboard: false }, "show");
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Daño " + data.CONTENEDOR);
				let ingreso = $("#idingreso").val();
				$("#operation_item").val("Edit");
				$("#btn_procesaDano").html("<i class='fa fa-floppy-o'></i> Editar");
				$("#txt_idingreso").val(ingreso);
				$("#txt_iddano").val(data.ID);
				$("#sel_cargo").val(data.CARGO);
				$("#codcomponente").val(data.CODOMPONENTE);
				$("#txt_componente").val(data.NOMCOMPONENTE);
				$("#txt_codrepara").val(data.REPARACION);
				$("#txt_reparacion").val(data.NOMREPARA);
				$("#txt_largo").val(data.LARGO);
				$("#txt_ancho").val(data.ANCHO);
				$("#txt_cantidad").val(data.CANTIDAD);
				$("#txt_thh").val(data.THH);
				$("#txt_chh").val(data.CHH);
				$("#txt_cm").val(data.CM);
				$("#txt_ct").val(data.CTT);
				$("#txt_descripcion2").val(data.OBSERVACIONES);
				$("#txt_iditem").val(data.IDITEM);
				$("#btn_Uploadfotos").val(iddano);
				$("#frmdetalledano #btn_Uploadfotos").prop("disabled", false);
				if (data.TIPOLIQUIDA == 'AREA' || data.TIPOLIQUIDA == 'LINEAL') {
					$("#frmdetalledano #txt_cantidad").prop("readonly", true);
					$("#frmdetalledano #txt_ancho").prop("readonly", false);
					$("#frmdetalledano #txt_largo").prop("readonly", false);
					$("#frmdetalledano #btn_liquidadUnd").prop("disabled", true);
					$("#frmdetalledano #btn_liquidadArea").prop("disabled", false);
				} else if (data.TIPOLIQUIDA == 'UNIDAD') {
					$("#frmdetalledano #txt_cantidad").prop("readonly", false);
					$("#frmdetalledano #txt_ancho").prop("readonly", true);
					$("#frmdetalledano #txt_largo").prop("readonly", true);
					$("#frmdetalledano #btn_liquidadArea").prop("disabled", true);
					$("#frmdetalledano #btn_liquidadUnd").prop("disabled", false);
				}
				var s = '<option value="' + data.DANO + '" seleted>' + data.NOMDANO + '</option>';
				for (var i = 0; i < data.dataDanos.length; i++) {
					s += '<option value="' + data.dataDanos[i].CODDANO + '">' + data.dataDanos[i].CODDANO + ' - ' + data.dataDanos[i].NOMBREIN + '</option>';
				}
				$("#sel_dano").html(s);
				var sl = '<option value="' + data.LOCALIZA + '" seleted>' + data.LOCALIZA + '</option>';
				for (var i = 0; i < data.dataLocaliza.length; i++) {
					sl += '<option value="' + data.dataLocaliza[i].LOCALIZA + '">' + data.dataLocaliza[i].LOCALIZA + '</option>';
				}
				$("#sel_localiza").html(sl);
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

async function saveDano() {
	event.preventDefault();
	let idingreso = $("#idingreso").val();
	valida = $("#frmdetalledano").valid();
	if (valida == true){
		try {
			const url = `${base_url}Ctn_inspecciondanos/saveDano`;
			$.ajax({
				url: url,
				method: "POST",
				dataType: "json",
				data: $('#frmdetalledano').serialize(),
				success: function (data) {
					getDanos(idingreso);
					$("#txt_idingreso").val(idingreso);
					$("#txt_iddano").val(data.iddano);
					$("#txt_componente").focus();
					$("#operation_item").val("Edit");
					$("#frmdetalledano #btn_Uploadfotos").prop("disabled", false);
					$("#btn_procesaDano").html("<i class='fa fa-floppy-o'></i> Editar");
					if (data.status == 'save_ok'){
						toastr.success('Daño agregado con Exito');

					}else if (data.status == 'update_ok'){
						toastr.success('Daño Actualiazdo con Exito');
					}
				}
			});
		} catch (err) {
			console.log(err);
		}
	}
}


async function getDanos(idingreso) {
	try {
		const url = `${base_url}Ctn_inspecciondanos/getDanos`;
		$.ajax({
			url: url,
			method: "POST",
			dataType: "json",
			data: { idingreso: idingreso },
			success: function (data) {
				document.getElementById("detelleDanos").innerHTML = data.html;
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function getImagendano() {
	event.preventDefault();
	var consulta = 1;
	var iddano = $("#txt_iddano").val();
	var idingreso = $("#idingreso").val();
	//alert(iddano+' - '+idingreso);
	const url = `${base_url}Ctn_inspecciondanos/getImagendano`;
	try {
		$.ajax({
			url: url,
			method: "POST",
			data: { idingreso: idingreso, iddano: iddano, consulta:consulta},
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
	var iddano = $("#txt_iddano").val();
	inputFile.on('change', function () {
		var formData = new FormData();
		formData.append('idingreso', idingreso);
		formData.append('iddano', iddano);
		$.each(inputFile[0].files, function (i, file) {
			formData.append('files[]', file); // Agregar cada archivo al formData
		});
		try {
			$.ajax({
				url: `${base_url}Upload/subirImagendano`,
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				enctype: 'multipart/form-data',
				success: function (response) {
					getImagendano();
				},
				error: function (error) {
					console.error('Error al adjuntar el documento', error);
				}
			});
		} catch (err) {
			console.log(err);
		}

	});
	inputFile.click();
})


async function actualizaEstado() {
	event.preventDefault();
	var categoria = document.getElementById("sel_categoria").value;
	var clasificacion = document.getElementById("sel_clasificacion").value;
	var condiciongral = document.getElementById("sel_condiciongral").value;
	let idingreso = $("#idingreso").val();
	const url = `${base_url}Ctn_inspecciondanos/actualizaEstado`;
	if (clasificacion == "" || categoria == ""){
		Swal.fire({
				text: 	"Complete todos los campos",
				icon: 	"error"
			});
	}else{
		try {
			$.ajax({
				url: url,
				method: "POST",
				data: { idingreso: idingreso, categoria:categoria, clasificacion:clasificacion, condiciongral:condiciongral},
				dataType: "json",
				success: function (data) {
					Swal.fire({
					//	title: 	"success",
						text: 	"Actualización Exitosa",
						icon: 	"success"
					});;
				}
			})
		} catch (err) {
			console.log(err);
		}
	}
}


function deleteDano(id) {
	event.preventDefault();
	let idingreso = $("#idingreso").val();
	Swal.fire({
		title:	'Eliminar Daño',
		text: 	"Confirma que desea eliminar el daño seleccionado?",
		icon: 	'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Eliminar'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: `${base_url}Ctn_inspecciondanos/deleteDano`,
				method: "POST",
				data: {id:id, idingreso:idingreso},
				dataType: "json",
				success: function (data) {
					if (data.status == "delete_ok") {
						toastr.success('Daños eliminado con exito!')
						getDanos(idingreso);
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


async function getImagendanoModal(iddano) {
	event.preventDefault();
	var consulta = 0;
	var idingreso = $("#idingreso").val();
	const url = `${base_url}Ctn_inspecciondanos/getImagendano`;
	try {
		$.ajax({
			url: url,
			method: "POST",
			data: { idingreso: idingreso, iddano: iddano, consulta:consulta},
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

async function IngresoDanos() {
	event.preventDefault();
	var idingreso = $("#idingreso").val()
	window.location.href = `${base_url}Ctn_inspecciondanos/inspeccion/` + idingreso;
}


$(document).on('click', '.danosModal', function () {
	let ingreso = $("#idingreso").val();
	$('#frmdetalledano')[0].reset();
	$("#txt_idingreso").val(ingreso);
	$("#txt_componente").focus();
	$("#operation_item").val("Add");
	$("#sel_localiza").empty();
	$("#sel_dano").empty();
	$("#btn_procesaDano").html("<i class='fa fa-floppy-o'></i> Guardar");
	$("#frmdetalledano #btn_Uploadfotos").prop("disabled", true);
	$('#danoModal').modal({ backdrop: 'static', keyboard: false }, "show");
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nuevo Daño");
});


$(document).on('click', '.Uploadfotos', function () {
	$('#UploadfotosModal').modal('show');
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Cargar Fotos");
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
=            									VALIDACION FORMULARIO DAÑOS
==================================================================================================================*/
var validador = $('#frmdetalledano').validate({
	rules: {
		txt_componente: {
			required: true,
		},
		txt_reparacion: {
			required: true,
			minlength: 4
		},
		sel_localiza: {
			required: true
		},
		txt_ubica: {
			required: true,
		},
		sel_dano: {
			required: true,
		},
		txt_largo: {
			required: true,
		},
		txt_ancho: {
			required: true,
		},
		txt_cantidad: {
			required: true,
		},
		sel_cargo: {
			required: true,
		},
	},
	messages: {
		txt_componente: {
			required: ""

		},
		txt_reparacion: {
			required: ""
		},
		sel_localiza: {
			required: ""
		},
		txt_ubica: {
			required: ""
		},
		sel_dano: {
			required: ""
		},
		txt_largo: {
			required: ""
		},
		txt_ancho: {
			required: ""
		},
		txt_cantidad: {
			required: ""
		},
		sel_cargo: {
			required: ""
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
