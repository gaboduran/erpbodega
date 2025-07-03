
$(document).ready(function(){
    $('#listalinea').multiselect();
  });


document.addEventListener("DOMContentLoaded",
	function () {
		tblTipoContenedor = $('#tblTipoContenedor').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Tipocontenedor/getAllTipocontenedor`,
			},
			columns: [
				{data: "codigo"},
				{data: "grupocont"},
				{data: "isocode"},
				{data: "estado"},
		 		{data: "options" }
			],

		});
	},
	false
)

async function editaTipo(idtipocont){
	event.preventDefault();
	$("#txt_codtipocont").removeClass("is-invalid");
	$("#txt_codtipocont").removeClass("invalid-feedback");
	$("#sel_linea").removeClass("is-invalid");
	$("#sel_grupotipo").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();
		try{
		const url = `${base_url}Tipocontenedor/editaTipo`;
		 $.ajax({
				url:url,
			    method:"POST",
			    data:{idtipocont:idtipocont},
			    dataType:"json",
			    success:function(data){
			    	$('#tipoContenedorModal').modal('show');
    				$(".modal-header").css("background-color", "#17a2b8");
    				$(".modal-header").css("color", "white" );
    				$(".modal-title").text("Editar Tipo de Contenedor");
   		 			$("#txt_codtipocont").val(data.CODIGO);
   		 			$("#sel_grupotipo").val(data.GRUPOCONT);
   		 			$("#sel_isocode").val(data.ISOCODE);
   		 			$("#sel_linea").val(data.IDLINEA);
   		 			$("#sel_estado").val(data.ESTADO);
    				$("#operation").val("Edit");
   		 			$("#txt_idcont").val(idtipocont);
					var s = '';
					for (var i = 0; i < data.lineadispo.length; i++) {
						s += '<option value="' + data.lineadispo[i].ID + '">' + capitalizarFrase(data.lineadispo[i].NOMCLIENTE) + '</option>';
					}
					$("#listalinea").html(s);
					var s1 = '';
					for (var i = 0; i < data.lineaasig.length; i++) {
						s1 += '<option value="' + data.lineaasig[i].IDLINEA + '">' + capitalizarFrase(data.lineaasig[i].NOMCLIENTE) + '</option>';
					}
					$("#listalinea_to").html(s1);
			    }
			  })
	}catch(err){
		console.log(err);
	}
}

async function procesar(){
	event.preventDefault();
	$('#listalinea_to option').prop("selected", "");
	$('#listalinea_to option').prop("selected", "selected");
	var valida;
	valida = $("#frmTipo").valid();
	if (valida == true){
	let frmTipo = new FormData(document.querySelector("#frmTipo"));
		try{
			const url = `${base_url}Tipocontenedor/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmTipo,

			});
			const resultado = await respuesta.json();
				if(resultado.status == 'save_ok'){
					toastr.success('Tipo de Contenedor creado con exito!')
	    			$('#tipoContenedorModal').modal('hide');
					$('#frmTipo')[0].reset();
	        		tblTipoContenedor.ajax.reload(null, false);
	    		}else if (resultado.status == 'tipo_existe'){
					toastr.error('El Tipo de Contenedor ya existe')
				}else if(resultado.status == 'update_ok'){
						toastr.success('Tipo de Contenedor actualizado con exito!')
	    			$('#tipoContenedorModal').modal('hide');
					$('#frmTipo')[0].reset();
	        		tblTipoContenedor.ajax.reload(null, false);
				}else if (resultado.status == "errorPDO"){	
					toastr.warning(resultado.msg);
				}		
			if(resultado.errorvalida == true){
	  			toastr.error(resultado.msg);
			}
		}catch(err){
			console.log(err);
		}
	}
}

function deleteTipoContenedor(idtipocont){
	Swal.fire({
  			title: 	'Eliminar Tipo de Contenedor',
  			text: 	"Confirma que desea eliminar el Tipo de Contenedor seleccionado?",
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
        	$('#ideliminacion').val(idtipocont);
        		$(document).on('submit', '#frmElimina', function(event){
    				event.preventDefault();
    				 $.ajax({
					      url:`${base_url}Tipocontenedor/deleteTipoContenedor`,
					      method:"POST",
					      data:$('#frmElimina').serialize(),
					      dataType:"json",
					      success:function(data){
					      	if(data.status=="delete_ok"){
										toastr.success('Tipo de Contenedor eliminado con exito!')
					      		$('#motivoElimina').modal('hide');
										$('#frmElimina')[0].reset();
        						tblTipoContenedor.ajax.reload(null, false);
					      	}else if(data.status=="delete_error"){
										toastr.warning('Se ha presnetado un error interno durante la eliminacion')
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
        window.open("views/reportes/tipoContenedorPDF.php",
       'win2',
       'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }
}

$(document).on('click', '#imprimir_excel', function(e){
	window.location.href = `${base_url}views/reportes/tipoContenedorEXCEL.php`;
	e.preventDefault();
});



$(document).on('click', '.tipoContenedorModal', function(){
	event.preventDefault();
	
	try{
		const url = `${base_url}Tipocontenedor/getLineas`;
		 $.ajax({
				url:url,
			    method:"POST",
			    dataType:"json",
			    success:function(data){
			    	$('#tipoContenedorModal').modal('show');
					$('#frmTipo')[0].reset();
					$("#listalinea_to").html("");
					$("#txt_codtipocont").removeClass("is-invalid");
					$("#txt_codtipocont").removeClass("is-invalid");
					$("#txt_desctipocont").removeClass("is-invalid");
					$("#sel_grupotipo").removeClass("is-invalid");
					$("#sel_estado").removeClass("is-invalid");
					validador.resetForm();
					
					$(".modal-header").css("background-color", "#17a2b8");
					$(".modal-header").css("color", "white" );
					$(".modal-title").text("Nuevo Tipo Contenedor");
					$("#operation").val("Add");
					var s = "";
					for (var i = 0; i < data.linea.length; i++) {
						s += '<option value="' + data.linea[i].ID + '">' + capitalizarFrase(data.linea[i].NOMCLIENTE) + '</option>';
					}
					$("#listalinea").html(s);
			    }
			  });
	}catch(err){
		console.log(err);
	}
});

$(function () {('.select2').select2()})


function capitalizarFrase(frase) {
    return frase
        .toLowerCase() // Convierte todo a minúsculas
        .split(' ') // Divide la frase en palabras
        .map(palabra => palabra.charAt(0).toUpperCase() + palabra.slice(1)) // Capitaliza la primera letra de cada palabra
        .join(' '); // Vuelve a unir las palabras en una frase
}


$("#txt_codtipocont").keyup(function(){              
   var ta      =   $("#txt_codtipocont");
   letras      =   ta.val().replace(/ /g, "");
   ta.val(letras)
}); 


/*=================================================================================================================
=            									VALIDACION FORMULARIO TIPO CONTENEDOR 							
==================================================================================================================*/
 var validador = $('#frmTipo').validate({
    rules: {
      txt_codtipocont: {
        required: true,
      },
      sel_grupotipo: {
        required: true,
      },
      txt_desctipocont: {
         required: true,
      },
      sel_estado: {
         required: true,
      },
    },
    messages: {
      txt_codtipocont: {
        required: "El Codigo es Requerido"

      },
      sel_grupotipo: {
        required: "El Grupo Es Requerido"
      },
      txt_desctipocont: {
		required: "El Nombre es Requerido "      
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
