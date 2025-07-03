$(document).ready(function () {
	$('#listacalificacion').multiselect();
	$('#listacategoria').multiselect();

});

document.addEventListener("DOMContentLoaded",
	function () {
		tblPlaneacion = $('#tblPlaneacion').DataTable({
			select : true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Planeacion/getAllPlaneacion`,
			},
			columns: [
				{ data: "id" },
				{ data: "nombre" },
				{ data: "fechaini" },
				{ data: "fechafin" },
				{ data: "estado" },
				{ data: "options" }
			],

		});
	},
	false
);


$('#sel_zona').change(function (e) {
	let idzona = $(this).val()
	event.preventDefault();
	try {
		const url = `${base_url}Planeacion/cargaClasificaCategoria`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idzona: idzona },
			dataType: "json",
			success: function (data) {
				var s = '';
				for (var i = 0; i < data.clasificadispo.length; i++) {
					s += '<option value="' + data.clasificadispo[i].ID + '">' + capitalizarFrase(data.clasificadispo[i].DESCRIPCION) + '</option>';
				}
				$("#listacalificacion").html(s);
				var s1 = '';
				for (var i = 0; i < data.categoriadispo.length; i++) {
					s1 += '<option value="' + data.categoriadispo[i].ID + '">' + capitalizarFrase(data.categoriadispo[i].NOMCATEGORIA) + '</option>';
				}
				$("#listacategoria").html(s1);
			}
		})
	} catch (err) {
		console.log(err);
	}
});

async function editaPlaneacion(id) {
	event.preventDefault();
	validador.resetForm();
	idzona = $("#sel_zona").val();
	try {
		const url = `${base_url}Planeacion/editaPlaneacion`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id:id, idzona:idzona },
			dataType: "json",
			success: function (data) {
				$('#planeacionModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Planeación");
				$("#frmPlaneacion #sel_zona").prop("disabled", true);
				$("#fechaini").val(data.FECHAINICIAL);
				$("#fechafin").val(data.FECHAFINAL);
				$("#sel_estado").val(data.ESTADO);
				$("#sel_zona").val(data.IDZONA);
				$("#operation").val("Edit");
				$("#idplaneacion").val(id);
				var s = '';
				for (var i = 0; i < data.clasiasignada.length; i++) {
					s += '<option value="' + data.clasiasignada[i].ID + '">' + capitalizarFrase(data.clasiasignada[i].DESCRIPCION) + '</option>';
				}
				$("#listacalificacion_to").html(s);
				var s1 = '';
				for (var i = 0; i < data.clasificadisponible.length; i++) {
					s1 += '<option value="' + data.clasificadisponible[i].ID + '">' + capitalizarFrase(data.clasificadisponible[i].DESCRIPCION) + '</option>';
				}
				$("#listacalificacion").html(s1);
				var s3 = '';
				for (var i = 0; i < data.categoriaasignada.length; i++) {
					s3 += '<option value="' + data.categoriaasignada[i].ID + '">' + capitalizarFrase(data.categoriaasignada[i].NOMCATEGORIA) + '</option>';
				}
				$("#listacategoria_to").html(s3);
				var s4 = '';
				for (var i = 0; i < data.categoriadisponible.length; i++) {
					s4 += '<option value="' + data.categoriadisponible[i].ID + '">' + capitalizarFrase(data.categoriadisponible[i].NOMCATEGORIA) + '</option>';
				}
				$("#listacategoria").html(s4);
			}
			
		})
	} catch (err) {
		console.log(err);
	}
}

async function procesar() {
	$('#listacalificacion_to option').prop("selected", "");
	$('#listacalificacion_to option').prop("selected", "selected");
	$('#listacategoria_to option').prop("selected", "");
	$('#listacategoria_to option').prop("selected", "selected");
	event.preventDefault();
	var valida;
	valida = $("#frmPlaneacion").valid();
	if (valida == true) {
		let frmPlaneacion = new FormData(document.querySelector("#frmPlaneacion"));
		try {
			const url = `${base_url}Planeacion/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmPlaneacion,

			});
			const resultado = await respuesta.json();
			if(resultado.status == 'save_ok'){
			 	toastr.success('Planeacion creada con exito!')
			  	$('#planeacionModal').modal('hide');
			  	$('#frmPlaneacion')[0].reset();
			  	tblPlaneacion.ajax.reload(null, false);
		  	}else if(resultado.status == 'update_ok'){
				toastr.success('Planeacion actualizada con exito!')
				$('#planeacionModal').modal('hide');
				$('#frmPlaneacion')[0].reset();
				tblPlaneacion.ajax.reload(null, false);
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
							tblPlaneacion.ajax.reload(null, false);
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
function capitalizarFrase(frase) {
	return frase
		.toLowerCase() // Convierte todo a minúsculas
		.split(' ') // Divide la frase en palabras
		.map(palabra => palabra.charAt(0).toUpperCase() + palabra.slice(1)) // Capitaliza la primera letra de cada palabra
		.join(' '); // Vuelve a unir las palabras en una frase
}

$(document).on('click', '.planeacionModal', function () {
	$('#planeacionModal').modal('show');
	$("#frmPlaneacion #sel_zona").prop("disabled", false);
	$('#frmPlaneacion')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nueva Planeación");
	$("#operation").val("Add");
});


	$(function () {
		$('#fechaini').datetimepicker({
			format: 'DD/MM/YYYY'
		});
		$('#fechafin').datetimepicker({
			format: 'DD/MM/YYYY'
		});
	})

/*=================================================================================================================
=            									VALIDACION FORMULARIO DAÑOS 							
==================================================================================================================*/
var validador = $('#frmPlaneacion').validate({
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