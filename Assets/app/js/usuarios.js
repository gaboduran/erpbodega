document.addEventListener("DOMContentLoaded",
	function () {
		let tblUsuarios = new DataTable("#tblUsuarios", {
			select: {
				style: 'single'
			},
			paging: true,
			lengthChange: true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}usuarios/getAllUser`,
				dataSrc: "",
			},
			columns: [
				{ data: "id" },
				{ data: "usuario" },
				{ data: "nombres" },
				{ data: "email" },
				{ data: "nomperfil" },
				{ data: "estado" },
				{ data: "options" }
			],
		}

		);
	},

	false
);


$('#listLineas').multiselect();
$('#listDepositos').multiselect();

async function procesar() {
	event.preventDefault();
	$('#listLineas_to option').prop("selected", "");
	$('#listLineas_to option').prop("selected", "selected");
	$('#listDepositos_to option').prop("selected", "");
	$('#listDepositos_to option').prop("selected", "selected");
	let frmUsuario = new FormData(document.querySelector("#frmUsuario"));
	try {
		const url = `${base_url}usuarios/procesar`;
		const respuesta = await fetch(url, {
			method: "POST",
			body: frmUsuario,
		});
		const resultado = await respuesta.json();
		if (resultado.status == 'save_ok') {
			swal({
				title: "Usuario Creado",
				icon: "success",
				button: "Aceptar",
			});
		} else if (resultado.status == 'update_ok') {
			swal({
				title: "Actualización Exitosa!",
				icon: "success",
				button: "Aceptar",
			});

		} else if (resultado.error == true) {
			Swal.fire({
				title: 'Usuario Existe',
				text: "Atención: El nombre de usuario esta en siendo utilizado",
				icon: 'error',
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Aceptar'
			}).then((result) => {
				if (result.isConfirmed) {
					$('#txt_usuario').focus()
				}
			})
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

function verResetPassword(idusuario) {
	event.preventDefault();
	const url = `${base_url}usuarios/verUsuario`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idusuario: idusuario },
			dataType: "json",
			success: function (data) {
				$('#resetPassword').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$('#txt_idusuario').val(data.ID);
				document.getElementById('mensaje').innerHTML = data.MENSAJE;
			}
		})

}


function confirmaEmail() {
	document.getElementById("ocultar-y-mostrar").style.display = "none";
	Swal.fire({
		text: "Confirma que desea enviar el email de restauración de paswword?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonText: 'Cancelar',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Enviar'
	}).then((result) => {
		idusuario = $("#txt_idusuario").val();
		if (result.isConfirmed) {
			const url = `${base_url}cambioPassword/cambiaPasswordByMEmail`;
			$.ajax({
				url: url,
				method: "POST",
				data: {idusuario:idusuario},
				dataType: "json",
				success: function (data) {
					
				}
			})
			Swal.fire(
				'Correo Enviado',
				'Se ha enviado un correo con los parametros requeridos para reestablcer la contraseña',
				'success'
			)
		}
	})
}

async function procesarCambio() {
	event.preventDefault();
	let frmCambioManual = new FormData(document.querySelector("#frmCambioManual"));
	try {
		const url = `${base_url}usuarios/procesarCambio`;
		const respuesta = await fetch(url, {
			method: "POST",
			body: frmCambioManual,
		});
		const resultado = await respuesta.json();
		if (resultado.status == 'update_ok') {
			swal({
				title: "Usuario Creado",
				icon: "success",
				button: "Aceptar",
			});		
		}
	}catch(err) {
		console.log(err);
	}
}

function myFunction() {
	var x = document.getElementById("ocultar-y-mostrar");
	if (x.style.display === "none") {
		x.style.display = "block";
	} else {
		x.style.display = "none";
	}
}

function deleteUsuario(idusuario) {
	Swal.fire({
		title: 'Eliminar usuario',
		text: "Atención: Confirma que desea eliminar el usuario?",
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
			$('#ideliminacion').val(idusuario);
			$(document).on('submit', '#frmElimina', function (event) {
				event.preventDefault();
				$.ajax({
					url: `${base_url}usuarios/eliminarUsuario`,
					method: "POST",
					data: $('#frmElimina').serialize(),
					dataType: "json",
					success: function (data) {
						if (data.status == "delete_ok") {
							$('#motivoElimina').modal('hide');
							Swal.fire({
								text: "Usuario eliminado con exito!",
								icon: 'success',
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Aceptar'
							}).then((result) => {
								if (result.isConfirmed) {
									window.location.href = `${base_url}/usuarios`;
								}
							})
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
