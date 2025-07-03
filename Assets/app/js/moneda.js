document.addEventListener("DOMContentLoaded",
	function () {
		tblMoneda = $('#tblMoneda').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Moneda/getAllMoneda`,
			},
			columns: [
				{data: "id"},
				{data: "codigo"},
				{data: "descripcion"},
				{data: "estado"},
				{data: "options" }
			],
			"columnDefs": [{
				"targets": [0],
				"visible": false
				}]

		});
	},
	false
)


async function editaMoneda(idmoneda){
	event.preventDefault();
	$("#txt_codigo").removeClass("is-invalid");
	$("#txt_descripcion").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
		try{
		const url = `${base_url}Moneda/editaMoneda`;
		 $.ajax({
				url:url,
			    method:"POST",
			    data:{idmoneda:idmoneda},
			    dataType:"json",
			    success:function(data){
			    	$('#monedaModal').modal('show');
    				$(".modal-header").css("background-color", "#17a2b8");
    				$(".modal-header").css("color", "white" );
    				$(".modal-title").text("Editar Moneda");
   		 			$("#txt_codigo").val(data.CODIGO);
   		 			$("#txt_descripcion").val(data.DESCRIPCION);
   		 			$("#sel_estado").val(data.ESTADO);
    				$("#operation").val("Edit");
   		 			$("#txt_idmoneda").val(idmoneda);
			    }
			  })
	}catch(err){
		console.log(err);
	}
}

async function procesar(){
	event.preventDefault();
	var valida;
	valida = $("#frmMoneda").valid();
	if (valida == true){
	let frmMoneda = new FormData(document.querySelector("#frmMoneda"));
		try{
			const url = `${base_url}Moneda/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmMoneda,

			});
			const resultado = await respuesta.json();
				if(resultado.status == 'save_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 'success',
	  					title: 'Moneda creado con exito!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
		    		$('#monedaModal').modal('hide');
						$('#frmMoneda')[0].reset();
		        tblMoneda.ajax.reload(null, false);
	    		}else if (resultado.status == 'Moneda_existe'){
						Swal.fire({
		  				icon: 'error',
		  				title: 'Atención:',
		  				text: 'Moneda ya existe en el sistema'
					});
					}else if(resultado.status == 'update_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 'success',
	  					title: 'Actualización Exitosa!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    		$('#monedaModal').modal('hide');
					$('#frmMoneda')[0].reset();
	        		tblMoneda.ajax.reload(null, false);
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

function deleteMoneda(idMoneda){
	Swal.fire({
  			title: 	'Eliminar Moneda',
  			text: 	"Confirma que desea eliminar el Moneda seleccionada?",
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
        	$('#ideliminacion').val(idMoneda);
        		$(document).on('submit', '#frmElimina', function(event){
    				event.preventDefault();
    				 $.ajax({
					      url:`${base_url}Moneda/eliminarMoneda`,
					      method:"POST",
					      data:$('#frmElimina').serialize(),
					      dataType:"json",
					      success:function(data){
					      	if(data.status=="delete_ok"){
					      		Swal.fire({
  									position: 'center',
  									icon: 'success',
  									title: 'Moneda Eliminada',
  									showConfirmButton: false,
  									timer: 1500
									})
					      		$('#motivoElimina').modal('hide');
										$('#frmElimina')[0].reset();
        						tblMoneda.ajax.reload(null, false);
					      	}else if(data.status=="error_delete"){
					      		alert("mal Eliminada");

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
        window.open("views/reportes/monedaPDF.php",
       'win2',
       'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }
}

$(document).on('click', '#imprimir_excel', function(e){
	window.location.href = `${base_url}views/reportes/monedaEXCEL.php`;
	e.preventDefault();
});

$(document).on('click', '.monedaModal', function(){
    $('#monedaModal').modal('show');
	$("#txt_codigo").removeClass("is-invalid");
	$("#txt_descripcion").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
	$('#frmMoneda')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nueva Moneda");
    $("#operation").val("Add");
});

$("#txt_codigo").keyup(function(){              
   var ta      =   $("#txt_codigo");
   letras      =   ta.val().replace(/ /g, "");
   ta.val(letras)
}); 

/*=================================================================================================================
=            									VALIDACION FORMULARIO MONEDA 							
==================================================================================================================*/
 var validador = $('#frmMoneda').validate({
    rules: {
      txt_codigo: {
        required: true,
      },
      txt_descripcion: {
        required: true,
      },
      sel_estado: {
         required: true,
      },
    },
    messages: {
      txt_codigo: {
        required: "El Codigo es Requerido"

      },
      txt_descripcion: {
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
  })