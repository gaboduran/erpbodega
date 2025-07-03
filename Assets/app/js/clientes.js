document.addEventListener("DOMContentLoaded",
	function () {
		tblClientes = $('#tblClientes').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Clientes/getAllClientes`,
			},
			columns: [
				{ data: "idecliente" },
				{ data: "nomcliente" },
				{ data: "email" },
				{ data: "estado" },
				{ data: "options" }
			],

		});
	},
	false
)

$('#listIngreso').multiselect();
$('#listSalida').multiselect();

async function procesar() {
	event.preventDefault();
	var tipoide 		= $('#sel_tipodoc').val();
	var nroidecliente 	= $('#txt_idecliente').val();
	var nomcliente 		= $('#txt_nomcliente').val();
	var contacto 		= $('#txt_contacto').val();
	var telefono 		= $('#txt_telefono').val();
	var email 			= $('#txt_email').val();
	var estado 			= $('#sel_estado').val();
	var lineanav 		= $('#lineanav').is(':checked') ? 1 : 0;
	var liquidadano 	= $('#liquidadano').is(':checked') ? 1 : 0;
	var consignee 		= $('#consignee').is(':checked') ? 1 : 0;
	var operation 		= $('#operation').val();
	var idcliente 		= $('#idcliente').val();
	try {
		$.ajax({
			url: `${base_url}clientes/procesar`,
			method: "POST",
			data: { tipoide: tipoide, nroidecliente: nroidecliente, nomcliente: nomcliente, contacto: contacto, telefono: telefono, 
				email: email, estado: estado, lineanav: lineanav, liquidadano:liquidadano, consignee: consignee, operation: operation, idcliente: idcliente },
			dataType: "json",
			success: function(data) {
				if(data.status == 'save_ok'){
					Swal.fire({
						position: 	'center',
						icon: 		'success',
						title: 		'Atención:',
						text: 		'Cliente creado con Satisfactoriamente!',
						showConfirmButton: true
					});
					$('#operation').val("Edit");
					$('#idcliente').val(data.idcliente);
					$('#movimientos-tab').removeClass('disabled');
					$('#sellos-tab').removeClass('disabled');
				}else if (data.status == 'update_ok'){
					Swal.fire({
						position: 	'center',
						icon: 		'success',
						title: 		'Atención:',
						text: 		'Cliente actualizado Satisfactoriamente!',
						showConfirmButton: true
					});
					$('#idcliente').val(data.idcliente);
				}	
			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function procesarMovimiento() {
	event.preventDefault();
	$('#listIngreso_to option').prop("selected", "");
	$('#listIngreso_to option').prop("selected", "selected");
	$('#listSalida_to option').prop("selected", "");
	$('#listSalida_to option').prop("selected", "selected");
	var mov_ingreso = $("#listIngreso_to :selected").map((_, e) => e.value).get();
	var mov_salida = $("#listSalida_to :selected").map((_, e) => e.value).get();
	var operation = $('#operation').val();
	var idcliente = $('#idcliente').val();
	try {
		$.ajax({
			url: `${base_url}clientes/procesarMovimiento`,
			method: "POST",
			data: { mov_ingreso: mov_ingreso, mov_salida: mov_salida, idcliente:idcliente, operation: operation },
			dataType: "json",
			success: function (data) {
				if(data.status == 'save_ok'){
					toastr.success('Movimientos creados con exito!');
				}else if(data.status == 'update_ok'){
					toastr.success('Movimientos actualizados con exito!');
				}
			}
		})
	} catch (err) {
		console.log(err);
	}
}



async function procesarSellos() {
	event.preventDefault();
	var sellofunda 			= $('#chk_sellofunda').is(':checked') ? 1 : 0;
	var viajenave 			= $('#chk_viajenave').is(':checked') ? 1 : 0;
	var sellovacio 			= $('#chk_sellovacio').is(':checked') ? 1 : 0;
	var selloventilacion 	= $('#chk_selloventilacion').is(':checked') ? 1 : 0;
	var operation 			= $('#operation').val();
	var idcliente 			= $('#idcliente').val();
	try {
		$.ajax({
			url: `${base_url}clientes/procesarSellos`,
			method: "POST",
			data: { sellofunda: sellofunda, viajenave: viajenave, sellovacio:sellovacio, selloventilacion:selloventilacion, operation: operation, idcliente:idcliente },
			dataType: "json",
			success: function (data) {
				if(data.status == 'update_ok'){
					toastr.success('Registros actualizados con exito!');
				}
			}
		})
	} catch (err) {
		console.log(err);
	}
}

function deleteCliente(idcliente) {
	Swal.fire({
		title: 'Eliminar Cliente',
		text: "Confirma que desea eliminar el Cliente seleccionado?",
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
			$('#ideliminacion').val(idcliente);
			$(document).on('submit', '#frmElimina', function (event) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}clientes/eliminarCliente`,
					method: "POST",
					data: $('#frmElimina').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "delete_ok") {
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Cliente Eliminado',
								showConfirmButton: false,
								timer: 1500
							})
							$('#motivoElimina').modal('hide');
							$('#frmElimina')[0].reset();
							tblClientes.ajax.reload(null, false);
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
	$('#clientesModal1').modal('show');
	$('#frmCliente')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nuevo Cliente");
	$("#operation").val("Add");
});