document.addEventListener("DOMContentLoaded",
	function () {
		tblTipocarga = $('#tblTipocarga').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}tipoCarga/getAllTipoCarga`,
			},
			columns: [
				{ data: "id" },
				{ data: "nombre" },
				{ data: "estado" },
				{ data: "options" }
			],

		});
	},
	false
)


async function editatipoCarga(id) {
	event.preventDefault();
	$("#txt_nombre").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	try {
		const url = `${base_url}tipoCarga/editatipoCarga`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id },
			dataType: "json",
			success: function (data) {
				$('#tipoCargaModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Tipo de Carga");
				$("#txt_nombre").val(data.DESCRIPCION);
				$("#sel_estado").val(data.ESTADO);
				$("#operation").val("Edit");
				$("#txt_idtipocarga").val(id);
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function procesar() {
	event.preventDefault();
	var valida;
	valida = $("#frmtipoCarga").valid();
	if (valida == true) {
		let frmtipoCarga = new FormData(document.querySelector("#frmtipoCarga"));
		try {
			const url = `${base_url}tipoCarga/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmtipoCarga,
			});
			const resultado = await respuesta.json();
			if (resultado.status == 'save_ok') {
				toastr.success('Iscocode creado con Exito');
				$('#tipoCargaModal').modal('hide');
				$('#frmtipoCarga')[0].reset();
				tblTipocarga.ajax.reload(null, false);
			} else if (resultado.status == 'iso_existe') {
				toastr.error('Iscocode Existe')
			} else if (resultado.status == 'update_ok') {
				toastr.success('Iscocode actualizado con Exito');
				$('#tipoCargaModal').modal('hide');
				$('#frmtipoCarga')[0].reset();
				tblTipocarga.ajax.reload(null, false);
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

function deleteTipocarga(id) {
	Swal.fire({
		title: 'Eliminar Tipo Carga',
		text: "Confirma que desea eliminar el Tipo Carga seleccionado?",
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
			$('#ideliminacion').val(id);
			$(document).on('submit', '#frmElimina', function (event) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}tipoCarga/eliminarTipocarga`,
					method: "POST",
					data: $('#frmElimina').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "delete_ok") {
							toastr.success('IsoCode eliminado con exito!')
							$('#motivoElimina').modal('hide');
							$('#frmElimina')[0].reset();
							tblTipocarga.ajax.reload(null, false);
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

function procesarDuplica() {
	event.preventDefault();
	var valida;
	valida = $("#frmDuplica").valid();
	if (valida == true) {

		Swal.fire({
			text: "Atención solo se duplicaran los IsoCodes no existentes en la Linea Destino",
			icon: 'info',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar'
		}).then((result) => {
			if (result.isConfirmed) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}isoCodes/procesarDuplica`,
					method: "POST",
					data: $('#frmDuplica').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "save_ok") {
							$('#duplicaModal').modal('hide');
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Registros Creados Satisfactoriamente',
								showConfirmButton: true
							})
							tblCategoria.ajax.reload(null, false);
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

$(document).on('click', '#imprimir_listado', function(e){
	Print_Report('Listado');
	e.preventDefault();
});

function Print_Report(Criterio){
    if (Criterio == 'Listado') {
        window.open("views/reportes/isocodePDF.php",
       'win2',
       'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }
}

$(document).on('click', '#imprimir_excel', function(e){
	window.location.href = `${base_url}views/reportes/isocodeEXCEL.php`;
	e.preventDefault();
});


$(document).on('click', '.tipoCargaModal', function () {
	$('#tipoCargaModal').modal('show');
	$("#txt_nombre").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	$('#frmtipoCarga')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nuevo Tipo de Carga");
	$("#operation").val("Add");
});


$(document).on('click', '.duplicaModal', function () {
	$('#duplicaModal').modal('show');
	$("#sel_linea_origen").removeClass("is-invalid");
	$("#sel_linea_destino").removeClass("is-invalid");
	validador.resetForm();
	$('#frmDuplica')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Duplicar IsoCode");
	$("#operation").val("Add");
});

$("#txt_codiso").keyup(function () {
	var ta = $("#txt_codiso");
	letras = ta.val().replace(/ /g, "");
	ta.val(letras)
})


/*=================================================================================================================
=            									VALIDACION FORMULARIO ISOCODE 							
==================================================================================================================*/
var validador = $('#frmtipoCarga').validate({
	rules: {
		txt_codiso: {
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
		txt_codiso: {
			required: "El Codigo es Requerido"

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