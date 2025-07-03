$(document).ready(function() {
    $('.js-example-basic-single').select2();
});


document.addEventListener("DOMContentLoaded",
	function () {
		tblLocalizacion = $('#tblLocalizacion').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Localizacion/getAllLocalizacion`,
			},
			columns: [
				{ data: "id" },
				{data: "componente"},
		 		{data: "localiza"},
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

async function editarLocalizacion(idlocalizacion){
		event.preventDefault();
	 	$("#sel_componente").removeClass("is-invalid");
		$("#sel_primercaracter").removeClass("is-invalid");
		$("#sel_segundocaracter").removeClass("is-invalid");
		$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
		try{
		const url = `${base_url}Localizacion/editarLocalizacion`;
		 $.ajax({
				url:url,
			    method:"POST",
			    data:{idlocalizacion:idlocalizacion},
			    dataType:"json",
			    success:function(data){
			    	$('#localizaModal').modal('show');
    				$(".modal-header").css("background-color", "#17a2b8");
    				$(".modal-header").css("color", "white" );
    				$(".modal-title").text("Editar Localizacion");
   		 			$("#sel_componente").select2({dropdownParent: $('#localizaModal')}).val(data.COMPONENTE).trigger("change");
   		 			$("#sel_primercaracter").val(data.PRIMERCARACTER);
   		 			$("#sel_segundocaracter").val(data.SEGUNDOCARACTER);
   		 			$("#sel_estado").val(data.ESTADO);
    				$("#operation").val("Edit");
   		 			$("#idlocalizacion").val(idlocalizacion);	
			    }
			  })
	}catch(err){
		console.log(err);
	}
}

async function procesar(){
	event.preventDefault();
	var valida;
	valida = $("#frmLocaliza").valid();
	if (valida == true){
	let frmLocaliza = new FormData(document.querySelector("#frmLocaliza"));
		try{
			const url = `${base_url}Localizacion/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmLocaliza,
			});
			const resultado = await respuesta.json();
				if(resultado.status == 'save_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 		'success',
	  					title: 		'Localizacion creado con exito!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#localizaModal').modal('hide');
						$('#frmLocaliza')[0].reset();
	        	tblLocalizacion.ajax.reload(null, false);
	    		}else if (resultado.status == 'localizacion_existe'){
					Swal.fire({
		  				icon: 	'error',
		  				title: 	'Atención:',
		  				text: 	'El Localizacion ya existe'
					});
				}else if(resultado.status == 'update_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 		'success',
	  					title: 		'Actualización Exitosa!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#localizaModal').modal('hide');
						$('#frmLocaliza')[0].reset();
	        	tblLocalizacion.ajax.reload(null, false);
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

function deletelocalizacion(idLocalizacion){
	Swal.fire({
  			title: 	'Eliminar Localizacion',
  			text: 	"Confirma que desea eliminar la Localizacion seleccionada?",
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
        	$('#ideliminacion').val(idLocalizacion);
        	$(document).on('submit', '#frmElimina', function(event){
    				event.preventDefault();
    				 $.ajax({
					      url:`${base_url}Localizacion/deletelocalizacion`,
					      method:"POST",
					      data:$('#frmElimina').serialize(),
					      dataType:"json",
					      success:function(data){
					      	if(data.status=="delete_ok"){
					      		Swal.fire({
  									position: 'center',
  									icon: 'success',
  									title: 'Localizacion Eliminado',
  									showConfirmButton: false,
  									timer: 1500
								})
					      		$('#motivoElimina').modal('hide');
								$('#frmElimina')[0].reset();
        						tblLocalizacion.ajax.reload(null, false);
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
        window.open("views/reportes/localizacionPDF.php",
       'win2',
       'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }
}

$(document).on('click', '#imprimir_excel', function(e){
	window.location.href = `${base_url}views/reportes/localizacionEXCEL.php`;
	e.preventDefault();
});


$(document).on('click', '.nuevoLocalizaModal', function(){
    $('#localizaModal').modal('show');
	$('#frmLocaliza')[0].reset();
	$("#sel_componente").val("");
	$("#sel_componente").removeClass("is-invalid");
	$("#sel_primercaracter").removeClass("is-invalid");
	$("#sel_segundocaracter").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nueva Localización");
    $("#operation").val("Add");
});

$("#txt_codigo").keyup(function(){              
   var ta      =   $("#txt_codigo");
   letras      =   ta.val().replace(/ /g, "");
   ta.val(letras)
});

$(function () {
		$('#sel_componente').select2({
      dropdownParent: $('#localizaModal')
  });
})


/*=================================================================================================================
=            									VALIDACION FORMULARIO LOCALIZACION 							
==================================================================================================================*/
 var validador = $('#frmLocaliza').validate({
    rules: {
      sel_componente: {
        required: true,
      },
      sel_primercaracter: {
        required: true,
      },
     	sel_segundocaracter: {
        required: true,
      },
      sel_estado: {
         required: true,
      },
    },
    messages: {
      sel_componente: {
        required: "El Codigo es Requerido"

      },
      sel_primercaracter: {
        required: "El Primer Caracter es Requerido"
      },
       sel_segundocaracter: {
        required: "El Segundo Caracter es Requerido"
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