document.addEventListener("DOMContentLoaded",
	function () {
		tblGrupotipo = $('#tblGrupotipo').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}grupotipocontenedor/getAllGrupoTipoContenedor`,
			},
			columns: [
				{data: "codigo"},
		 		{data: "descripcion"},
		 		{data: "estado"},
		 		{data: "options" }
			],

		});
	},
	false
)

async function editaGrupoTipoContenedor(idgrupoticont){
	event.preventDefault();
	 	$("#txt_codigo").removeClass("is-invalid");
		$("#txt_descripcion").removeClass("is-invalid");
		$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
		try{
		const url = `${base_url}grupotipocontenedor/editaGrupoTipoContenedor`;
		 $.ajax({
				url:url,
			    method:"POST",
			    data:{idgrupoticont:idgrupoticont},
			    dataType:"json",
			    success:function(data){
			    	$('#GrupoTipoContModal').modal('show');
    				$(".modal-header").css("background-color", "#17a2b8");
    				$(".modal-header").css("color", "white" );
    				$(".modal-title").text("Editar Grupo Tipo Contenedor");
   		 			$("#txt_codigo").val(data.CODIGO);
   		 			$("#txt_descripcion").val(data.DESCRIPCION);
   		 			$("#sel_estado").val(data.ESTADO);
    				$("#operation").val("Edit");
   		 			$("#idgrupoticont").val(idgrupoticont);
			    }
			  })
	}catch(err){
		console.log(err);
	}
}

async function procesar(){
	event.preventDefault();
	var valida;
	valida = $("#frmgrupotipocont").valid();
	if (valida == true){
	let frmgrupotipocont = new FormData(document.querySelector("#frmgrupotipocont"));
		try{
			const url = `${base_url}grupotipocontenedor/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmgrupotipocont,
			});
			const resultado = await respuesta.json();
				if(resultado.status == 'save_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 		'success',
	  					title: 		'Registro creado con exito!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#GrupoTipoContModal').modal('hide');
					$('#frmgrupotipocont')[0].reset();
	        	tblGrupotipo.ajax.reload(null, false);
	    		}else if (resultado.status == 'existe'){
					Swal.fire({
		  				icon: 	'error',
		  				title: 	'Atención:',
		  				text: 	'Codigo Existente'
					});
				}else if(resultado.status == 'update_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 		'success',
	  					title: 		'Actualización Exitosa!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#GrupoTipoContModal').modal('hide');
					$('#frmgrupotipocont')[0].reset();
	        	tblGrupotipo.ajax.reload(null, false);
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

function deleteGrupoTipoContenedor(idgrupoticont){
	Swal.fire({
  			title: 	'Eliminar Grupo Tipo Contenedor',
  			text: 	"Confirma que desea eliminar el Grupo seleccionado?",
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
        		$('#ideliminacion').val(idgrupoticont);
        		$(document).on('submit', '#frmElimina', function(event){
    				event.preventDefault();
    				 $.ajax({
					      url:`${base_url}grupotipocontenedor/eliminarGrupoTipoContenedor`,
					      method:"POST",
					      data:$('#frmElimina').serialize(),
					      dataType:"json",
					      success:function(data){
					      	if(data.status=="delete_ok"){
					      		Swal.fire({
  									position: 'center',
  									icon: 'success',
  									title: 'Grupo Eliminado',
  									showConfirmButton: false,
  									timer: 1500
								})
					      		$('#motivoElimina').modal('hide');
								$('#frmElimina')[0].reset();
        						tblGrupotipo.ajax.reload(null, false);
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
        window.open("views/reportes/grupotipcontPDF.php",
       'win2',
       'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }
}

$(document).on('click', '#imprimir_excel', function(e){
	window.location.href = `${base_url}views/reportes/grupotipcontEXCEL.php`;
	e.preventDefault();
});


$(document).on('click', '.grupoTipoModal', function(){
    $('#GrupoTipoContModal').modal('show');
	$("#txt_codigo").removeClass("is-invalid");
	$("#txt_descripcion").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
	$('#frmgrupotipocont')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nuevo Tipo Contenedor");
    $("#operation").val("Add");
});

$("#txt_codigo").keyup(function(){              
   var ta      =   $("#txt_codigo");
   letras      =   ta.val().replace(/ /g, "");
   ta.val(letras)
}); 

/*=================================================================================================================
=            									VALIDACION FORMULARIO GRUPO TIPO DE CONTENEDOR  							
==================================================================================================================*/
 var validador = $('#frmgrupotipocont').validate({
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
        required: "La descripcion es Requerida"
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