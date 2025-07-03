document.addEventListener("DOMContentLoaded",
	function () {
		tblMaterial = $('#tblMaterial').DataTable( {
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}material/getAllMaterial`,
			},
			columns: [
				{data: "id"},
				{data: "codigo"},
		 		{data: "nommaterial"},
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

async function editaMaterial(idmaterial){
	event.preventDefault();
    $("#txt_codigo").removeClass("is-invalid");
		$("#txt_nommaterial").removeClass("is-invalid");
		$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
		try{
		const url = `${base_url}material/editaMaterial`;
		 $.ajax({
				url:url,
			    method:"POST",
			    data:{idmaterial:idmaterial},
			    dataType:"json",
			    success:function(data){
			    	$('#materialModal').modal('show');
    				$(".modal-header").css("background-color", "#17a2b8");
    				$(".modal-header").css("color", "white" );
    				$(".modal-title").text("Editar Material");
   		 			$("#txt_codigo").val(data.CODIGO);
   		 			$("#txt_nommaterial").val(data.NOMMATERIAL);
   		 			$("#txt_descripcion").val(data.DESCRIPCION);
   		 			$("#sel_estado").val(data.ESTADO);
    				$("#operation").val("Edit");
   		 			$("#idmaterial").val(idmaterial);	
			    }
			  })
	}catch(err){
		console.log(err);
	}
}

async function procesar(){
	event.preventDefault();
	var valida;
	valida = $("#frmMaterial").valid();
	if (valida == true){
		let frmMaterial = new FormData(document.querySelector("#frmMaterial"));
		try{
			const url = `${base_url}material/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmMaterial,
			});
			const resultado = await respuesta.json();
				if(resultado.status == 'save_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 		'success',
	  					title: 		'Material creado con exito!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#materialModal').modal('hide');
					$('#frmMaterial')[0].reset();
	        	tblMaterial.ajax.reload(null, false);
	    		}else if (resultado.status == 'material_existe'){
					Swal.fire({
		  				icon: 	'error',
		  				title: 	'Atención:',
		  				text: 	'El Material ya existe'
					});
				}else if(resultado.status == 'update_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 		'success',
	  					title: 		'Actualización Exitosa!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#materialModal').modal('hide');
						$('#frmMaterial')[0].reset();
	        	tblMaterial.ajax.reload(null, false);
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

function deleteMaterial(idmaterial){
	Swal.fire({
  			title: 	'Eliminar Material',
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
        	$('#ideliminacion').val(idmaterial);
        	$(document).on('submit', '#frmElimina', function(event){
    				event.preventDefault();
    				 $.ajax({
					      url:`${base_url}material/deleteMaterial`,
					      method:"POST",
					      data:$('#frmElimina').serialize(),
					      dataType:"json",
					      success:function(data){
					      	if(data.status=="delete_ok"){
					      		Swal.fire({
  									position: 'center',
  									icon: 'success',
  									title: 'Material Eliminado',
  									showConfirmButton: false,
  									timer: 1500
								})
					      		$('#motivoElimina').modal('hide');
										$('#frmElimina')[0].reset();
        						tblMaterial.ajax.reload(null, false);
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
        window.open("views/reportes/materialPDF.php",
       'win2',
       'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }
}

$(document).on('click', '#imprimir_excel', function(e){
	window.location.href = `${base_url}views/reportes/materialEXCEL.php`;
	e.preventDefault();
});

$(document).on('click', '.MaterialModal', function(){
    $('#materialModal').modal('show');
    $("#txt_codigo").removeClass("is-invalid");
	$("#txt_nommaterial").removeClass("is-invalid");
	$("#txt_descripcion").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
	$('#frmMaterial')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nuevo Material");
    $("#operation").val("Add");
});

$("#txt_codigo").keyup(function(){              
   var ta      =   $("#txt_codigo");
   letras      =   ta.val().replace(/ /g, "");
   ta.val(letras)
});

/*=================================================================================================================
=            									VALIDACION FORMULARIO MATERIAL 							
==================================================================================================================*/
 var validador = $('#frmMaterial').validate({
    rules: {
      txt_codigo: {
        required: true,
      },
      txt_nommaterial: {
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
      txt_nommaterial: {
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