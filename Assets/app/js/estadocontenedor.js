document.addEventListener("DOMContentLoaded",
	function () {
		tblEstadoContenedor = $('#tblEstadoContenedor').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Estadocontenedor/getAllEstadocontenedor`,
			},
			columns: [
				{data: "codigo"},
		 		{data: "nomestado"},
		 		{data: "estado"},
		 		{data: "options" }
			],

		});
	},
	false
)

async function editaEstado(idestadocont){
	event.preventDefault();
	$("#txt_codestadocont").removeClass("is-invalid");
	$("#txt_descestadocont").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  validador.resetForm();
		try{
		const url = `${base_url}Estadocontenedor/editaEstado`;
		 $.ajax({
				url:url,
			    method:"POST",
			    data:{idestadocont:idestadocont},
			    dataType:"json",
			    success:function(data){
			    	$('#estadoContenedorModal').modal('show');
    				$(".modal-header").css("background-color", "#17a2b8");
    				$(".modal-header").css("color", "white" );
    				$(".modal-title").text("Editar Estado Contenedor");
   		 			$("#txt_codestadocont").val(data.CODIGO);
   		 			$("#txt_descestadocont").val(data.NOMESTADO);
   		 			$("#sel_estado").val(data.ESTADO);
    				$("#operation").val("Edit");
   		 			$("#idestadocont").val(idestadocont);
			    }
			  })
	}catch(err){
		console.log(err);
	}
}

async function procesar(){
	event.preventDefault();
	var valida;
	valida = $("#frmEstado").valid();
		if (valida == true){
		let frmEstado = new FormData(document.querySelector("#frmEstado"));
		try{
			const url = `${base_url}Estadocontenedor/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmEstado,
			});
			const resultado = await respuesta.json();
				if(resultado.status == 'save_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 'success',
	  					title: 'Estado creado con exito!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#estadoContenedorModal').modal('hide');
						$('#frmEstado')[0].reset();
	        		tblEstadoContenedor.ajax.reload(null, false);
	    		}else if (resultado.status == 'estado_existe'){
					Swal.fire({
		  				icon: 'error',
		  				title: 'Atención:',
		  				text: 'El Codigo del Estado ya existe en el sistema'
					});
				}else if(resultado.status == 'update_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 'success',
	  					title: 'Actualización Exitosa!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#estadoContenedorModal').modal('hide');
						$('#frmEstado')[0].reset();
	        	tblEstadoContenedor.ajax.reload(null, false);
				}else if (resultado.status == "errorPDO"){	
				toastr.error(resultado.msg);
			}
			if(resultado.errorvalida == true){
	  			toastr.error(resultado.msg);
			}
		}catch(err){
			console.log(err);
		}
	}
}

function deleteEstadoContenedor(idestadocont){
	Swal.fire({
  			title: 	'Eliminar Estado Contenedor',
  			text: 	"Confirma que desea eliminar el Estado Contenedor seleccionado?",
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
        	$('#ideliminacion').val(idestadocont);
        		$(document).on('submit', '#frmElimina', function(event){
    				event.preventDefault();
    				 $.ajax({
					      url:`${base_url}Estadocontenedor/deleteEstadoContenedor`,
					      method:"POST",
					      data:$('#frmElimina').serialize(),
					      dataType:"json",
					      success:function(data){
					      	if(data.status=="delete_ok"){
					      		Swal.fire({
  									position: 'center',
  									icon: 'success',
  									title: 'Estado Eliminado',
  									showConfirmButton: false,
  									timer: 1500
								})
					      		$('#motivoElimina').modal('hide');
										$('#frmElimina')[0].reset();
        						tblEstadoContenedor.ajax.reload(null, false);
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

$(document).on('click', '.estadoContenedorModal', function(){
    $('#estadoContenedorModal').modal('show');
	$("#txt_codestadocont").removeClass("is-invalid");
	$("#txt_descestadocont").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
	$('#frmEstado')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nuevo Estado Contenedor");
    $("#operation").val("Add");
});


  $("#txt_codestadocont").keyup(function(){              
   var ta      =   $("#txt_codestadocont");
   letras      =   ta.val().replace(/ /g, "");
   ta.val(letras)
});

/*=================================================================================================================
=            									VALIDACION FORMULARIO ESTADO CONTENEDOR 							
==================================================================================================================*/
 var validador = $('#frmEstado').validate({
    rules: {
      txt_codestadocont: {
        required: true,
      },
      txt_descestadocont: {
        required: true,
      },
      sel_estado: {
         required: true,
      },
    },
    messages: {
      txt_codestadocont: {
        required: "El Codigo es Requerido"

      },
      txt_descestadocont: {
        required: "La Descripcion es Requerida"
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