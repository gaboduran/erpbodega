document.addEventListener("DOMContentLoaded",
	function () {
		tblDepositos = $('#tblDepositos').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}depositos/getAllDepositos`,
			},
			columns: [
				{ data: "id" },
				{ data: "nombre" },
				{ data: "nomciudad" },
				{ data: "inventario" },
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

async function editar(iddeposito) {
	event.preventDefault();
	try {
		window.location.href = `${base_url}depositos/editar/${iddeposito}`;
	} catch (err) {
		console.log(err);
	}
}

$('#listLineas').multiselect();

async function procesar() {
	$('#listLineas_to option').prop("selected", "");
	$('#listLineas_to option').prop("selected", "selected");
	event.preventDefault();
	let frmDeposito = new FormData(document.querySelector("#frmDeposito"));
	try {
		const url = `${base_url}depositos/procesar`;
		const respuesta = await fetch(url, {
			method: "POST",
			body: frmDeposito,

		});
		const resultado = await respuesta.json();
		if (resultado.status == true) {
			Swal.fire({
				text: "Deposito creado con exito!",
				icon: 'success',
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Aceptar'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = `${base_url}/depositos`;
				}
			})
			$('#frmDeposito')[0].reset();
		} else if (resultado.status == 'deposito_existe') {
			Swal.fire({
				icon: 'error',
				title: 'Atención:',
				text: 'El nombre del Deposito ya exite.'
			});
		} else if (resultado.status == 'update_ok') {
			Swal.fire({
				text: "Actualización exitosa!",
				icon: 'success',
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Aceptar'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = `${base_url}depositos`;
				}
			})
			$('#frmDeposito')[0].reset();
			tblDepositos.ajax.reload(null, false);
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

function deleteDeposito(iddeposito) {
	Swal.fire({
		title: 'Eliminar Deposito',
		text: "Confirma que desea eliminar el Deposito seleccionado?",
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
			$('#ideliminacion').val(iddeposito);
			$(document).on('submit', '#frmElimina', function (event) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}depositos/eliminarDeposito`,
					method: "POST",
					data: $('#frmElimina').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "delete_ok") {
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Deposito Eliminado',
								showConfirmButton: false,
								timer: 1500
							})
							$('#motivoElimina').modal('hide');
							$('#frmElimina')[0].reset();
							tblDepositos.ajax.reload(null, false);
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


$(document).on('click', '.nuevoClienteModal', function () {
	$('#clientesModal').modal('show');
	$('#frmDeposito')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nuevo Cliente");
	$("#operation").val("Add");
});