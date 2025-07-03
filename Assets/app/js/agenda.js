document.addEventListener("DOMContentLoaded",
	function(){
	   tblCategoria = $('#tblCategoria').DataTable( {
	   	paging: 	true,
	   	aProcessing:true,
	   	aSererSide: true,
	    language: {
	        url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
	      },  
	   	 	ajax : {
		 				url: `${base_url}Agenda/getAllAgenda`,
		 				dataSrc: "",
		 	},
		 	columns: [
		 		{data: "fecha"},
		 		{data: "horainicial"},
		 		{data: "horafinal"},
		 		{data: "cantcitas"},
		 		{data: "estado"},
		 		{data: "options" }
		 	],
  	 });
	}, 
	false
	)

async function verCategoria(idcategoria){
	event.preventDefault();
	$("#txt_codcategoria").removeClass("is-invalid");
	$("#txt_nomcategoria").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  validador.resetForm();
		try{
		const url = `${base_url}Categoria/verCategoria`;
		 $.ajax({
				url:url,
			    method:"POST",
			    data:{idcategoria:idcategoria},
			    dataType:"json",
			    success:function(data){
			    	$('#categoriaModal').modal('show');
    				$(".modal-header").css("background-color", "#17a2b8");
    				$(".modal-header").css("color", "white" );
    				$(".modal-title").text("Editar Categoria");
   		 			$("#txt_codcategoria").val(data.CODIGO);
   		 			$("#txt_nomcategoria").val(data.NOMCATEGORIA);
   		 			$("#sel_estado").val(data.ESTADO);
    				$("#operation").val("Edit");
   		 			$("#idcategoria").val(idcategoria);
			    }
			  })
	}catch(err){
		console.log(err);
	}
}

async function procesar(){
	event.preventDefault();
	var valida;
	valida = $("#frmCategoria").valid();
	if (valida == true){
	let frmCategoria = new FormData(document.querySelector("#frmCategoria"));
		try{
			const url = `${base_url}Categoria/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmCategoria,
			});
			const resultado = await respuesta.json();
				if(resultado.status == 'save_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 'success',
	  					title: 'Categoria creada con exito!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#categoriaModal').modal('hide');
						$('#frmCategoria')[0].reset();
	        		tblCategoria.ajax.reload(null, false);
	    		}else if (resultado.status == 'categoria_existe'){
					Swal.fire({
		  				icon: 'error',
		  				title: 'Atención:',
		  				text: 'El Codigo de la Categoria ya existe'
					});
				}else if(resultado.status == 'update_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 'success',
	  					title: 'Actualización Exitosa!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#categoriaModal').modal('hide');
						$('#frmCategoria')[0].reset();
	        	tblCategoria.ajax.reload(null, false);
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

function deleteCategoria(idestadocont){
	Swal.fire({
  			title: 	'Eliminar Categoria',
  			text: 	"Confirma que desea eliminar la Categoria seleccionada?",
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
					      url:`${base_url}Categoria/eliminarCategoria`,
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
        						tblCategoria.ajax.reload(null, false);
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

$(document).on('click', '.nuevoCategoriaModal', function(){
    $('#categoriaModal').modal('show');
    $("#txt_codcategoria").removeClass("is-invalid");
		$("#txt_nomcategoria").removeClass("is-invalid");
		$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
		$('#frmCategoria')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nueva Categoria");
    $("#operation").val("Add");
});

$("#txt_codcategoria").keyup(function(){              
   var ta      =   $("#txt_codcategoria");
   letras      =   ta.val().replace(/ /g, "");
   ta.val(letras)
});

/*=================================================================================================================
=            									VALIDACION FORMULARIO CATEGORIA CONTENEDOR 							
==================================================================================================================*/
 var validador = $('#frmCategoria').validate({
    rules: {
      txt_codcategoria: {
        required: true,
      },
      txt_nomcategoria: {
        required: true,
      },
      sel_estado: {
         required: true,
      },
    },
    messages: {
      txt_codcategoria: {
        required: "El Codigo es Requerido"

      },
      txt_nomcategoria: {
        required: "El Nombre Requerido"
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