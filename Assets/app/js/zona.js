$(document).ready(function () {
	$('#listalinea').multiselect();
	$('.selectTamano').select2();

});

document.addEventListener("DOMContentLoaded",
	function () {
		tblDanos = $('#tblDanos').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Zona/getAllZonas`,
			},
			columns: [
				{ data: "id" },
				{ data: "nombre" },
				{ data: "bahias" },
				{ data: "filas" },
				{ data: "alto" },
				{ data: "estado" },
				{ data: "options" }
			],

		});
	},
	false
)

$('#sel_linea').change(function () {
	event.preventDefault();
	let idlinea = $("#sel_linea").val();
	//console.log(idlinea);
	try {
		$.ajax({
			url: `${base_url}Zona/getTiposDisponibles`,
			method: "POST",
			dataType: "json",
			data: { idlinea: idlinea },
			success: function (data) {
				console.log(data);
				// var s = "";
				// 	for (var i = 0; i < data.length; i++) {
				// 		s += '<option value="' + data[i].ID + '">' + data[i].CODIGO + '</option>';
				// 	}
				// 	$("#listatipocont").html(s);
			}
		})
	} catch (err) {
		console.log(err);
	}
});


async function editaZona(idzona) {
	event.preventDefault();
	$('#listalinea_to option').prop("selected", "");
	$('#listalinea_to option').prop("selected", "selected");
	try {
		const url = `${base_url}zona/editaZona`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idzona: idzona },
			dataType: "json",
			success: function (data) {
				$('#zonaModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Zona");
				$("#txt_nombre").val(data.NOMBRE);
				$(".selectTamano").select2({ dropdownParent: $('#zonaModal') }).val(data.TAMANO).trigger("change");
				$("#txt_bahia").val(data.BAHIA);
				$("#txt_fila").val(data.FILA);
				$("#txt_alto").val(data.ALTO);
				$("#operation").val("Edit");
				$("#txt_idzona").val(idzona);
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
	valida = $("#frmZona").valid();
	if (valida == true) {
		let frmZona = new FormData(document.querySelector("#frmZona"));
		try {
			const url = `${base_url}Zona/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmZona,
			});
			const resultado = await respuesta.json();
			if (resultado.status == 'save_ok') {
				toastr.success('Zona creada con exito!')
				$('#zonaModal').modal('hide');
				$('#frmZona')[0].reset();
				tblDanos.ajax.reload(null, false);
			} else if (resultado.status == 'existe') {
				toastr.error('La zona ya existe')
			} else if (resultado.status == 'update_ok') {
				toastr.success('Zona actualizada con exito!')
				$('#zonaModal').modal('hide');
				$('#frmZona')[0].reset();
				tblDanos.ajax.reload(null, false);
			} else if (resultado.status == "errorPDO") {
				toastr.warning(resultado.msg);
			}
			if (resultado.errorvalida == true) {
				toastr.error(resultado.msg);
			}
		} catch (err) {
			console.log(err);
		}
	}

}

function deleteZona(idzona) {
	Swal.fire({
		title: 'Eliminar Zona Almacenamiento',
		text: "Confirma que desea eliminar la Zona Seleccionada?",
		icon: 'question',
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
			$('#ideliminacion').val(idzona);
			$(document).on('submit', '#frmElimina', function (event) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}Zona/eliminarZona`,
					method: "POST",
					data: $('#frmElimina').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "delete_ok") {
							toastr.success('Tipo de Contenedor eliminado con exito!')
							$('#motivoElimina').modal('hide');
							$('#frmElimina')[0].reset();
							tblDanos.ajax.reload(null, false);
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

//$(function () {('.select2').select2()})


$(function () {
	$('.selectTamano').select2({
		theme: 'bootstrap4'
	})

})

$(document).on('click', '.zonaModal', function () {
	event.preventDefault();
	$("#txt_nombre").removeClass("is-invalid");
	const url = `${base_url}Zona/getLineas`;
	$.ajax({
		url: url,
		method: "POST",
		dataType: "json",
		success: function (data) {
			validador.resetForm();
			$("#listalinea_to").html("");
			$('#zonaModal').modal('show');
			$('#frmZona')[0].reset();
			$(".modal-header").css("background-color", "#17a2b8");
			$(".selectTamano").select2({ dropdownParent: $('#zonaModal') }).val("").trigger("change");
			$(".modal-header").css("color", "white");
			$(".modal-title").text("Editar Zona Almacenamiento");
			$("#operation").val("Add");
			var s = "";
			for (var i = 0; i < data.linea.length; i++) {
				s += '<option value="' + data.linea[i].ID + '">' + capitalizarFrase(data.linea[i].NOMCLIENTE) + '</option>';
			}
			$("#listalinea").html(s);
		}
	});


});


function capitalizarFrase(frase) {
	return frase
		.toLowerCase() // Convierte todo a minúsculas
		.split(' ') // Divide la frase en palabras
		.map(palabra => palabra.charAt(0).toUpperCase() + palabra.slice(1)) // Capitaliza la primera letra de cada palabra
		.join(' '); // Vuelve a unir las palabras en una frase
}

/*=================================================================================================================
=            									VALIDACION FORMULARIO DAÑOS 							
==================================================================================================================*/
var validador = $('#frmZona').validate({
	rules: {
		txt_nombre: {
			required: true,
		},
	},
	messages: {
		txt_nombre: {
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