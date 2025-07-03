document.addEventListener("DOMContentLoaded",
	function () {
		tbltablaRepara = $('#tbltablaRepara').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}tablareparacion/getAlltablaRepara`,
			},
			columns: [
				{ data: "idcliente" },
				{ data: "nomcliente" },
				{ data: "estado" },
				{ data: "options" }
			],
			"columnDefs": [{
				"targets": [0],
				"visible": false
			}]

		});
	},
	false
)


async function procesar() {
	event.preventDefault();
	var valida;
	valida = $("#frmTablarepara").valid();
	if (valida == true) {
		let frmTablarepara = new FormData(document.querySelector("#frmTablarepara"));
		try {
			const url = `${base_url}tablareparacion/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmTablarepara,
			});
			const resultado = await respuesta.json();
			if (resultado.status == 'save_ok') {
				toastr.success('Tabla de Reparación creada con Exito')
				$('#tablaReparaModal').modal('hide');
				$('#frmTablarepara')[0].reset();
				tbltablaRepara.ajax.reload(null, false);
			} else if (resultado.status == 'tablarepera_existe') {
				toastr.error('Tabla de Reparacion Existente')
			} else if (resultado.status == 'update_ok') {
				toastr.success('tabla actualizada con Exito')
				$('#tablaReparaModal').modal('hide');
				tbltablaRepara.ajax.reload(null, false);
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

async function verTablaRepara(idtablarepara) {
	event.preventDefault();
	$("#sel_cliente").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	validador.resetForm();
	try {
		const url = `${base_url}tablareparacion/verTablaRepara`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idtablarepara: idtablarepara },
			dataType: "json",
			success: function (data) {
				$('#tablaReparaModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Tabla de Reparación");
				$("#sel_cliente").attr("disabled", true);
				$("#sel_cliente").val(data.IDCLIENTE);
				$("#sel_estado").val(data.ESTADO);
				$("#operation").val("Edit");
				$("#idtablarepara").val(idtablarepara);
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function duplicarTabla() {
	event.preventDefault();
	var valida;
	valida = $("#frmDuplicaTablarepara").valid();
	if (valida == true) {
		let frmDuplicaTablarepara = new FormData(document.querySelector("#frmDuplicaTablarepara"));
		try {
			const url = `${base_url}tablareparacion/duplicarTabla`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmDuplicaTablarepara,
			});
			const resultado = await respuesta.json();
			if (resultado.status == 'save_ok') {
				toastr.success('Tabla de Reparacion Duplicacda con Exito!')
				$('#duplicaTablaRepModal').modal('hide');
				$('#frmDuplicaTablarepara')[0].reset();
				tbltablaRepara.ajax.reload(null, false);
			}

		} catch (err) {
			console.log(err);
		}
	}
}

function deleteTabla(idtamano){
	Swal.fire({
  			title: 	'Eliminar Tabla de Reparacion',
  			text: 	"Confirma que desea eliminar la Tabla Seleccionada",
  			icon: 	'warning',
  			showCancelButton: true,
  			confirmButtonColor: '#3085d6',
  			cancelButtonColor: '#d33',
  			confirmButtonText: 'Eliminar'
		}).then((result) => {
			if (result.isConfirmed) {
    			$('#motivoElimina').modal('show');
    			$(".modal-header").css("background-color", "#17a2b8");
    			$(".modal-header").css("color", "white" );
    			$(".modal-title").text("Motivo eliminación");
        	$('#ideliminacion').val(idtamano);
        		$(document).on('submit', '#frmElimina', function(event){
    				event.preventDefault();
    				 $.ajax({
					      url:`${base_url}tablareparacion/eliminarTabla`,
					      method:"POST",
					      data:$('#frmElimina').serialize(),
					      dataType:"json",
					      success:function(data){
					      	if(data.status=="delete_ok"){
					      		Swal.fire({
  									position: 'center',
  									icon: 'success',
  									title: 'Tamano Eliminado',
  									showConfirmButton: false,
  									timer: 1500
								})
					      		$('#motivoElimina').modal('hide');
										$('#frmElimina')[0].reset();
        						tblTamano.ajax.reload(null, false);
					      	}else if(data.status=="error_delete"){
					      		alert("mal eliminado");
					      	}else if(data.errorvalida==true){
					      		toastr.error(data.msg);
					      	}

					      }
    				})
    			})
  			}
		})
}

$(document).on('click', '.tablaReparaModal', function () {
	event.preventDefault();
	$('#tablaReparaModal').modal('toggle');
	$('#frmTablarepara')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Crear Tabla de Reparación");
	$("#operation").val("Add");
});


$(document).on('click', '.duplicaTablaRepara', function () {
	$('#duplicaTablaRepModal').modal('show');
	$('#frmDuplicaTablarepara')[0].reset();
	$("#sel_cliente").attr("disabled", false);
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Duplicar Tabla de Reparación");
});



/*=================================================================================================================
=            									VALIDACION FORMULARIO CREAR TABLA DE REPARACION  							
==================================================================================================================*/
var validador = $('#frmTablarepara').validate({
	rules: {
		sel_cliente: {
			required: true,
		},
		sel_estado: {
			required: true,
		},
	},
	messages: {
		sel_cliente: {
			required: "El Cliente es Requerido"

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