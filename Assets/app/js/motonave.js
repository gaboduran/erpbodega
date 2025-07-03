document.addEventListener("DOMContentLoaded",
function () {
	tblMotonave = $('#tblMotonave').DataTable({
		select : true,
		"bProcessing": true,
		"serverSide": true,
		language: {
			url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
		},
		ajax: {
			url: `${base_url}motonave/getAllMotonave`,
		},
		columns: [
			 {data: "id"},
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
	

async function editaMotonave(idmotonave){
		event.preventDefault();
    $("#txt_nommotonave").removeClass("is-invalid");
		$("#sel_linea").removeClass("is-invalid");
		$("#sel_estado").removeClass("is-invalid");
		validador.resetForm();
		try{
		const url = `${base_url}motonave/editaMotonave`;
		 $.ajax({
				url:url,
			    method:"POST",
			    data:{idmotonave:idmotonave},
			    dataType:"json",
			    success:function(data){
			    	$('#MotonaveModal').modal('show');
    				$(".modal-header").css("background-color", "#17a2b8");
    				$(".modal-header").css("color", "white" );
    				$(".modal-title").text("Editar Motonave");
   		 			$("#txt_nommotonave").val(data.DESCRIPCION);
   		 			$("#sel_linea").val(data.ID);
   		 			$("#sel_estado").val(data.ESTADO);
    				$("#operation").val("Edit");
   		 			$("#idmotonave").val(idmotonave);	
			    }
			  })
	}catch(err){
		console.log(err);
	}
}

async function procesar(){
	event.preventDefault();
	var valida;
	valida = $("#frmMotonave").valid();
	if (valida == true){
		let frmMotonave = new FormData(document.querySelector("#frmMotonave"));
		try{
			const url = `${base_url}motonave/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmMotonave,
			});
			const resultado = await respuesta.json();
				if(resultado.status == 'save_ok'){
						toastr.success('Montonave creada con Exito')
	    			$('#MotonaveModal').modal('hide');
						$('#frmMotonave')[0].reset();
	        	tblMotonave.ajax.reload(null, false);
	    		}else if (resultado.status == 'motonave_existe'){
						toastr.error('Montonave existe')
				}else if(resultado.status == 'update_ok'){
	  				toastr.success('Montonave actualizada con Exito')
	    			$('#MotonaveModal').modal('hide');
	        	tblMotonave.ajax.reload(null, false);
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

function deleteMotonave(idmotonave){
	Swal.fire({
  			title: 	'Eliminar Motonave',
  			text: 	"Confirma que desea eliminar el Material seleccionado?",
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
        	$('#ideliminacion').val(idmotonave);
        	$(document).on('submit', '#frmElimina', function(event){
    				event.preventDefault();
    				 $.ajax({
					      url:`${base_url}motonave/deleteMotonave`,
					      method:"POST",
					      data:$('#frmElimina').serialize(),
					      dataType:"json",
					      success:function(data){
					      	if(data.status=="delete_ok"){
										toastr.success('Montonave Eliminada con Exito')
					      		$('#motivoElimina').modal('hide');
										$('#frmElimina')[0].reset();
        						tblMotonave.ajax.reload(null, false);
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

$(document).on('click', '.MotonaveModal', function(){
    $('#MotonaveModal').modal('show');
    $("#txt_nommotonave").removeClass("is-invalid");
	$("#sel_linea").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
		$('#frmMotonave')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Crear Motonave");
    $("#operation").val("Add");
});

$("#txt_codigo").keyup(function(){              
   var ta      =   $("#txt_codigo");
   letras      =   ta.val().replace(/ /g, "");
   ta.val(letras)
});

/*=================================================================================================================
=            									VALIDACION FORMULARIO MOTONAVE 							
==================================================================================================================*/
 var validador = $('#frmMotonave').validate({
    rules: {
      txt_nommotonave: {
        required: true,
      },
      sel_linea: {
        required: true,
      },
      sel_estado: {
         required: true,
      },
    },
    messages: {
      txt_nommotonave: {
        required: "El Nombre de la motonave requerido"

      },
      sel_linea: {
        required: "La linea es requeirda"
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