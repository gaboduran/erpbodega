document.addEventListener("DOMContentLoaded",
	function () {
		tblDanos = $('#tblDanos').DataTable({
			select : true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}danos/getAllDanos`,
			},
			columns: [
				{ data: "coddano" },
				{ data: "nombresp" },
				{ data: "nombrein" },
				{ data: "estado" },
				{ data: "options" }
			],

		});
	},
	false
)

async function editaDano(coddano) {
	event.preventDefault();
	$("#txt_coddano").removeClass("is-invalid");
	$("#txt_nombresp").removeClass("is-invalid");
	$("#txt_nombrein").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	try {
		const url = `${base_url}danos/editaDano`;
		$.ajax({
			url: url,
			method: "POST",
			data: { coddano: coddano },
			dataType: "json",
			success: function (data) {
				$('#danoModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Daño");
				$("#txt_coddano").val(data.CODDANO);
				$("#txt_nombresp").val(data.NOMBRESP);
				$("#txt_nombrein").val(data.NOMBREIN);
				$("#sel_estado").val(data.ESTADO);
				$("#operation").val("Edit");
				$("#txt_iddano").val(coddano);
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function seleccionar(id) {
	event.preventDefault();
	alert(id);
}

async function procesar() {
	event.preventDefault();
	var valida;
	valida = $("#frmDano").valid();
	if (valida == true) {
		let frmDano = new FormData(document.querySelector("#frmDano"));
		try {
			const url = `${base_url}danos/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmDano,

			});
			const resultado = await respuesta.json();
			if (resultado.status == 'save_ok') {
				toastr.success('Daño creado con exito!')
				$('#danoModal').modal('hide');
				$('#frmDano')[0].reset();
				tblDanos.ajax.reload(null, false);
			} else if (resultado.status == 'dano_existe') {
				toastr.error('Daño creado  existe')
			} else if (resultado.status == 'update_ok') {
				toastr.success('Daño actualizdo con exito!')
				$('#danoModal').modal('hide');
				$('#frmDano')[0].reset();
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

function deleteDano(iddano) {
	Swal.fire({
		title: 'Eliminar Daño',
		text: "Confirma que desea eliminar el Daño seleccionado?",
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
			$('#ideliminacion').val(iddano);
			$(document).on('submit', '#frmElimina', function (event) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}danos/eliminarDano`,
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

$(document).on('click', '#imprimir_listado', function(e){
	Print_Report('Listado');
	e.preventDefault();
});

function Print_Report(Criterio){
    if (Criterio == 'Listado') {
        window.open("views/reportes/danoPDF.php",
       'win2',
       'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }
}

$(document).on('click', '#imprimir_excel', function(e){
	window.location.href = `${base_url}views/reportes/danoEXCEL.php`;
	e.preventDefault();
});

$(document).on('click', '.DanoModal', function () {
	$("#txt_coddano").removeClass("is-invalid");
	$("#txt_nombresp").removeClass("is-invalid");
	$("#txt_nombrein").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	$('#danoModal').modal('show');
	$('#frmDano')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nuevo Daño");
	$("#operation").val("Add");
});

$("#txt_coddano").keyup(function () {
	var ta = $("#txt_coddano");
	letras = ta.val().replace(/ /g, "");
	ta.val(letras)
});

/*=================================================================================================================
=            									VALIDACION FORMULARIO DAÑOS 							
==================================================================================================================*/
var validador = $('#frmDano').validate({
	rules: {
		txt_coddano: {
			required: true,
		},
		txt_nombresp: {
			required: true,
		},
		sel_estado: {
			required: true,
		},
	},
	messages: {
		txt_coddano: {
			required: "El Codigo es Requerido"

		},
		txt_nombresp: {
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