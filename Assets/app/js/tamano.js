document.addEventListener("DOMContentLoaded",
	function () {
		tblTamano = $('#tblTamano').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Tamano/getAllTamano`,
			},
			columns: [
				{data: "id"},
				{data: "tamano"},
		 		{data: "descripcion"},
		 		{data: "teus"},
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

async function editaTamano(idtamano){
	event.preventDefault();
	$("#txt_tamano").removeClass("is-invalid");
	$("#txt_desctamano").removeClass("is-invalid");
	$("#txt_teus").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  validador.resetForm();
		try{
		const url = `${base_url}Tamano/editaTamano`;
		 $.ajax({
				url:url,
			    method:"POST",
			    data:{idtamano:idtamano},
			    dataType:"json",
			    success:function(data){
			    	$('#TamanoModal').modal('show');
    				$(".modal-header").css("background-color", "#17a2b8");
    				$(".modal-header").css("color", "white" );
    				$(".modal-title").text("Editar Tamaño");
   		 			$("#txt_tamano").val(data.TAMANO);
   		 			$("#txt_desctamano").val(data.DESCRIPCION);
   		 			$("#txt_teus").val(data.TEUS);
   		 			$("#sel_estado").val(data.ESTADO);
    				$("#operation").val("Edit");
   		 			$("#idtamano").val(idtamano);
			    }
			  })
	}catch(err){
		console.log(err);
	}
}

async function procesar(){
	event.preventDefault();
	var valida;
	valida = $("#frmTamano").valid();
	if (valida == true){let frmTamano = new FormData(document.querySelector("#frmTamano"));
		try{
			const url = `${base_url}Tamano/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmTamano,
			});
			const resultado = await respuesta.json();
				if(resultado.status == 'save_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 		'success',
	  					title: 		'Tamaño creado con exito!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#TamanoModal').modal('hide');
					$('#frmTamano')[0].reset();
	        	tblTamano.ajax.reload(null, false);
	    		}else if (resultado.status == 'tamano_existe'){
					Swal.fire({
		  				icon: 	'error',
		  				title: 	'Atención:',
		  				text: 	'El Tamaño ya existe'
					});
				}else if(resultado.status == 'update_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 		'success',
	  					title: 		'Actualización Exitosa!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#TamanoModal').modal('hide');
					$('#frmTamano')[0].reset();
	        		tblTamano.ajax.reload(null, false);
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

function deleteTamano(idtamano){
	Swal.fire({
  			title: 	'Eliminar Tamaño',
  			text: 	"Confirma que desea eliminar la Tamaño seleccionado?",
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
					      url:`${base_url}Tamano/deleteTamano`,
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


$(document).on('click', '#imprimir_listado', function(e){
	Print_Report('Listado');
	e.preventDefault();
});

function Print_Report(Criterio){
    if (Criterio == 'Listado') {
        window.open("views/reportes/tamanoPDF.php",
       'win2',
       'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }
}

$(document).on('click', '#imprimir_excel', function(e){
	window.location.href = `${base_url}views/reportes/tamanoEXCEL.php`;
	e.preventDefault();
});


$(document).on('click', '.TamanoModal', function(){
    $('#TamanoModal').modal('show');
	$("#txt_tamano").removeClass("is-invalid");
	$("#txt_desctamano").removeClass("is-invalid");
	$("#txt_teus").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
	$('#frmTamano')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nuevo Tamaño");
    $("#operation").val("Add");
});

$("#txt_tamano").keyup(function(){              
   var ta      =   $("#txt_tamano");
   letras      =   ta.val().replace(/ /g, "");
   ta.val(letras)
});

/*=================================================================================================================
=            									VALIDACION FORMULARIO DAÑOS 							
==================================================================================================================*/
 var validador = $('#frmTamano').validate({
    rules: {
      txt_tamano: {
        required: true,
      },
      txt_desctamano: {
        required: true,
      },
      txt_teus: {
        required: true,
      },
      sel_estado: {
         required: true,
      },
    },
    messages: {
      txt_tamano: {
        required: "El Tamaño es Requerido"
      },
      txt_desctamano: {
        required: "La Descripcion es Requerida"
      },
      txt_teus: {
        required: "Los Teus son Requeridos"
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