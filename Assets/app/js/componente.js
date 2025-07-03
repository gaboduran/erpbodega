document.addEventListener("DOMContentLoaded",
	function () {
		tblComponente = $('#tblComponente').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Componente/getAllComponente`,
			},
			columns: [
				{ data: "codigo" },
				{ data: "descripcion" },
				{ data: "estado" },
				{ data: "options" }
			],
		});
	},
	false
)



async function editaComponente(idcomponente) {
	event.preventDefault();
	$("#txt_codigo").removeClass("is-invalid");
	$("#txt_descripcion").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	try {
		const url = `${base_url}Componente/editaComponente`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idcomponente: idcomponente },
			dataType: "json",
			success: function (data) {
				$('#componenteModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Componente");
				$("#txt_codigo").val(data.CODIGO);
				$("#txt_descripcion").val(data.DESCRIPCION);
				$("#txt_descripcion2").val(data.DESCRIPCION2);
				$("#sel_estado").val(data.ESTADO);
				$("#operation").val("Edit");
				$("#txt_idcomponente").val(idcomponente);
				data.MAQUINARIA == 1 ? $("#maquinaria").prop("checked", true) : $("#maquinaria").prop("checked", false);
				data.ESTRUCTURA == 1 ? $("#estructura").prop("checked", true) : $("#estructura").prop("checked", false);
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function procesar() {
	event.preventDefault();
	valida = $("#frmComponente").valid();
	if (valida == true) {
		let frmComponente = new FormData(document.querySelector("#frmComponente"));
		try {
			const url = `${base_url}Componente/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmComponente,

			});
			const resultado = await respuesta.json();
			if (resultado.status == 'save_ok') {
				toastr.success('Componente creado con exito!')
				$('#componenteModal').modal('hide');
				$('#frmComponente')[0].reset();
				tblComponente.ajax.reload(null, false);
			} else if (resultado.status == 'componente_existe') {
				toastr.error('Componente Existe')
			} else if (resultado.status == 'update_ok') {
				toastr.success('Componente Actualizado con exito!')
				$('#componenteModal').modal('hide');
				$('#frmComponente')[0].reset();
				tblComponente.ajax.reload(null, false);
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

function deleteComponente(idcomponente) {
	Swal.fire({
		title: 'Eliminar Componente',
		text: "Confirma que desea eliminar el Componente seleccionado?",
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
			$('#ideliminacion').val(idcomponente);
			$(document).on('submit', '#frmElimina', function (event) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}Componente/deleteComponente`,
					method: "POST",
					data: $('#frmElimina').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "delete_ok") {
							toastr.success('Componente eliminado con exito!')
							$('#motivoElimina').modal('hide');
							$('#frmElimina')[0].reset();
							tblComponente.ajax.reload(null, false);
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


$(document).on('click', '#imprimir_listado', function (e) {
	Print_Report('Listado');
	e.preventDefault();
});

function Print_Report(Criterio) {
	if (Criterio == 'Listado') {
		window.open("views/reportes/componentePDF.php",
			'win2',
			'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,' +
			'resizable=yes,width=800,height=800,directories=no,location=no' +
			'fullscreen=yes');
	}
}

$(document).on('click', '#imprimir_excel', function (e) {
	window.location.href = `${base_url}views/reportes/componenteEXCEL.php`;
	e.preventDefault();
});


$(document).on('click', '.componenteModal', function () {
	$('#componenteModal').modal('show');
	$("#txt_codigo").removeClass("is-invalid");
	$("#txt_descripcion").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	$('#frmComponente')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nuevo Componente");
	$("#operation").val("Add");
});

$("#txt_codigo").keyup(function () {
	var ta = $("#txt_codigo");
	letras = ta.val().replace(/ /g, "");
	ta.val(letras)
});

/*=================================================================================================================
=            									VALIDACION FORMULARIO COMPONENTES

==================================================================================================================*/
var validador = $('#frmComponente').validate({
	rules: {
		txt_codigo: {
			required: true,
		},
		txt_descripcion: {
			required: true,
		},
		sel_estado: {
			required: true,
		},
	},
	messages: {
		txt_codigo: {
			required: "El Codigo es Requerido"
		},
		txt_descripcion: {
			required: "El Nombre Requerido"
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