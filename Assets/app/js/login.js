document.addEventListener("DOMContentLoaded", function () {

}, false)


async function LoginIN() {
	event.preventDefault();
	let formLogin = new FormData(document.querySelector("#formLogin"));
	try {
		const url = `${base_url}login/LoginIN`;
		const respuesta = await fetch(url, {
			method: "POST",
			body: formLogin,
		});
		const resultado = await respuesta.json();
		if (resultado.status == "ok1") {
			window.location.href = `${base_url}cambioPassword`;
		}else if (resultado.status == "ok") {
			window.location.href = `${base_url}home`;
		} else if (resultado.status == "inactivo") {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: resultado.msg
			});
		} else if (resultado.status == "no_existe") {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: resultado.msg
			});
		}
		console.log(resultado);
	} catch (err) {
		console.log(err);
	}
}


async function CambiarPassword(){
	event.preventDefault();
	var valida;
	valida = $("#frmCambiarPassword").valid();
	if (valida == true){
		let frmCambiarPassword = new FormData(document.querySelector("#frmCambiarPassword"));
		try{
			const url = `${base_url}login/actualizaPassword`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmCambiarPassword,

			});
			const resultado = await respuesta.json();
			if(resultado.status == "errorpass"){
				toastr.error('Los Password no coinciden');
			}else if(resultado.status == "token_novigente"){
				toastr.error('Token no se encuentra Vigente');
			}else if(resultado.status == "update_ok"){
				Swal.fire({
					text: "El Password ha sido Actualizado con Exito",
					icon: 'success',
					showCancelButton: false,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Regresar al Login'
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = `${base_url}`;
					}
				})					
			}
		}catch{

		}
	}
}


