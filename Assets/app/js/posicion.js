
document.addEventListener("DOMContentLoaded",
	function () {
		tblPosicion = $('#tblPosicion').DataTable({
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Posicion/getAllPosicion`,
			},
			columns: [
				{ data: "id" },
				{data: "letra"},
		 		{data: "nombrein"},
		 		{data: "nombresp"},
		 		{data: "caracter"},
		 		{data: "estado"},
		 		{data: "options" }
			],
			"columnDefs": [ {
				"targets": [0],
				"visible": false
				} ]

		});
	},
	false
)

async function editaPosicion(idposicion){
	event.preventDefault();
	$("#txt_letra").removeClass("is-invalid");
	$("#sel_caracter").removeClass("is-invalid");
	$("#txt_nombrein").removeClass("is-invalid");
	$("#txt_nombrees").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  validador.resetForm();
		try{
		const url = `${base_url}Posicion/editaPosicion`;
		 $.ajax({
				url:url,
			    method:"POST",
			    data:{idposicion:idposicion},
			    dataType:"json",
			    success:function(data){
			    	$('#PosicionModal').modal('show');
    				$(".modal-header").css("background-color", "#17a2b8");
    				$(".modal-header").css("color", "white" );
    				$(".modal-title").text("Editar Posicion");
   		 			$("#txt_letra").val(data.LETRA);
   		 			$("#sel_caracter").val(data.CARACTER);
   		 			$("#txt_nombrein").val(data.NOMBREIN);
   		 			$("#txt_nombrees").val(data.NOMBRESP);
   		 			$("#sel_estado").val(data.ESTADO);
    				$("#operation").val("Edit");
   		 			$("#idposicion").val(idposicion);
			    }
			  })
	}catch(err){
		console.log(err);
	}
}

async function procesar(){
	event.preventDefault();
	var valida;
	valida = $("#frmPosicion").valid();
	if (valida == true){
		let frmPosicion = new FormData(document.querySelector("#frmPosicion"));
		try{
			const url = `${base_url}Posicion/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmPosicion,
			});
			const resultado = await respuesta.json();
				if(resultado.status == 'save_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 'success',
	  					title: 'Posicion creada con exito!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#PosicionModal').modal('hide');
						$('#frmPosicion')[0].reset();
	        		tblPosicion.ajax.reload(null, false);
	    		}else if (resultado.status == 'Posicion_existe'){
					Swal.fire({
		  				icon: 'error',
		  				title: 'Atención:',
		  				text: 'El Codigo de la Posicion ya existe'
					});
				}else if(resultado.status == 'update_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 'success',
	  					title: 'Actualización Exitosa!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#PosicionModal').modal('hide');
						$('#frmPosicion')[0].reset();
	        	tblPosicion.ajax.reload(null, false);
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

function deletePosicion(idestadocont){
	Swal.fire({
  			title: 	'Eliminar Posicion',
  			text: 	"Confirma que desea eliminar la Posicion seleccionada?",
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
					      url:`${base_url}Posicion/eliminarPosicion`,
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
        						tblPosicion.ajax.reload(null, false);
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


$(document).on('click', '#imprimir_listado', function(e){
	Print_Report('Listado');
	e.preventDefault();
});

function Print_Report(Criterio){
    if (Criterio == 'Listado') {
        window.open("views/reportes/posicionPDF.php",
       'win2',
       'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }
}

$(document).on('click', '#imprimir_excel', function(e){
	window.location.href = `${base_url}views/reportes/posicionEXCEL.php`;
	e.preventDefault();
});

$(document).on('click', '.PosicionModal', function(){
    $('#PosicionModal').modal('show');
		$("#txt_letra").removeClass("is-invalid");
		$("#sel_caracter").removeClass("is-invalid");
		$("#txt_nombrein").removeClass("is-invalid");
		$("#txt_nombrees").removeClass("is-invalid");
		$("#sel_estado").removeClass("is-invalid");
		$('#frmPosicion')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nueva Posicion");
    $("#operation").val("Add");
});


$("#txt_letra").keyup(function(){              
   var ta      =   $("#txt_letra");
   letras      =   ta.val().replace(/ /g, "");
   ta.val(letras)
});

/*=================================================================================================================
=            									VALIDACION FORMULARIO MATERIAL 							
==================================================================================================================*/
 var validador = $('#frmPosicion').validate({
    rules: {
      txt_letra: {
        required: true,
      },
      sel_caracter: {
        required: true,
      },
      txt_nombrein: {
        required: true,
      },
      txt_nombrees: {
        required: true,
      },
      sel_estado: {
         required: true,
      },
    },
    messages: {
      txt_letra: {
        required: "El Letra es Requerida"

      },
      sel_caracter: {
        required: "El Caracter es Requerido"
      },
      txt_nombrees: {
        required: "El nombre en Español es Requerido"
      },
      txt_nombrein: {
        required: "El nombre en Ingles es Requerido"
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