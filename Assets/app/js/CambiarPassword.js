function cierraSesion() {
	try {
		const url = `${base_url}cambioPassword/cierraSesion`;
		$.ajax({
			url: url,
			method: "POST",
			dataType: "json",
			success: function (data){
				if (data.status == 'logoutok') { 
					window.location.href = `${base_url}`;
				}
			}
		})

	} catch (err) {
		console.log(err);
	}
}

async function CambiarPassword() {
	event.preventDefault();
	var valida;
	let frmCambiarPassword = new FormData(document.querySelector("#frmCambiarPassword"));
	try {
		const url = `${base_url}cambioPassword/actualizaPassword`;
		const respuesta = await fetch(url, {
			method: "POST",
			body: frmCambiarPassword,

		});
		const resultado = await respuesta.json();
		if (resultado.status == 'update_ok') {
			swal({
				title: "Password Actualizado",
				text: "Debe iniciar sesión nuevamente.",
				icon: "success",
				button: "Aceptar",
			}).then((value) => {
				cierraSesion();
			});;
		}
	} catch (err) {
		console.log(err);
	}
}


