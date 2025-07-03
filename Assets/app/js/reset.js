$(document).ready(function () {
	token = getVariableUrl('token');
	const url = `${base_url}login/validaToken`;
	$.ajax({
		url: url,
		method: "POST",
		data: { token: token },
		dataType: "json",
		success(data) {
			if (data.status == 2){
				Swal.fire({
					title: "Token Vencido",
					text: "El tiempo para cambiar el password, genere un nuevo cambio",
					icon: "error"
				  });
				  $("#txt_pass1").prop( "disabled", true );
				  $("#txt_pass2").prop( "disabled", true );
				  $("#btn_procesar").prop( "disabled", true );
			}else if (data.status == 3){
				Swal.fire({
					title: "Token no existe",
					text: "El token ingresado no existe",
					icon: "error"
				  });
				  $("#txt_pass1").prop( "disabled", true );
				  $("#txt_pass2").prop( "disabled", true );
				  $("#btn_procesar").prop( "disabled", true );
			}
		}
	})

});


function getVariableUrl(name) {
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}