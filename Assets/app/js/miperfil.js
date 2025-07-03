async function processUpdate() {
	event.preventDefault();
	var valida;
	valida = $("#frmUpdatePassword").valid();
	if (valida == true) {
		try{
            const url = `${base_url}miPerfil/procesaCambiarPassowrd`;
			$.ajax({
				url:url,
				method:"POST",
				data:$('#frmUpdatePassword').serialize(),
				dataType:"json",
				success:function(data){
					if(data.status == 'update_ok'){
						Swal.fire({
							text: "Password actualizado con exito!",
							icon: 'success',
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Aceptar'
						  }).then((result) => {
							if (result.isConfirmed) {
								   window.location.href = `${base_url}`;
							}
						  })
					}else if(data.status == 'pass_no'){
						toastr.error('Las contraseñas no coiciden');
					} 
				}
			})
		}catch(err){
			console.log(err);
		}
	}
}
/*=================================================================================================================
=            									VALIDACION FORMULARIO DAÑOS 							
==================================================================================================================*/
var validador = $('#frmUpdatePassword').validate({
	rules: {
		txt_pass1: {
			required: true,
			minlength: 6,
			
		},
		txt_pass2: {
			required: true,
			equalTo: "#txt_pass1",
			minlength: 6,
		},
	},
	messages: {
		txt_pass1: {
			required: "El campo es Requerido",
			minlength: "Logitud minima 6 Caracteres"

		},
		txt_pass2: {
			required: "El campo Requerido",
			minlength: "Logitud minima 6 Caracteres",
			equalTo: "Las contraseñas no coinciden"
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