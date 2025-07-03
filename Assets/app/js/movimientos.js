document.addEventListener("DOMContentLoaded",
	function () {
		tblMovimientos = $('#tblMovimientos').DataTable({
			select: true,
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}movimientos/getAllMovimientos`,
			},
			columns: [
				{ data: "id" },
		 		{data: "descripcion"},
		 		{data: "nomtipomovi"},
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
async function verDetalle(id) {
	event.preventDefault();
	try {
		const url = `${base_url}movimientos/verDetalle`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id },
			dataType: "json",
			success: function (data) {
				$('#verdetalleModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Detalle Movimiento ");
				$('#tbltext_descripcion').text(data.DESCRIPCION);
				$('#tbltext_tipomov').text(data.NOMTIPOMOV);
				$('#tbltext_estado').text(data.DESCESTADO);
			}
		});
	} catch (err) {
		console.log(err);
	}
}

async function editaMovimiento(idmovimiento){
	event.preventDefault();
	$("#sel_tipomovimiento").removeClass("is-invalid");
	$("#txt_descripcion").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();	
		try{
		const url = `${base_url}movimientos/editaMovimiento`;
		 $.ajax({
				url:url,
			    method:"POST",
			    data:{idmovimiento:idmovimiento},
			    dataType:"json",
			    success:function(data){
			    	$('#movimientosModal').modal('show');
    				$(".modal-header").css("background-color", "#17a2b8");
    				$(".modal-header").css("color", "white" );
    				$(".modal-title").text("Editar Movimiento");
   		 			$("#sel_tipomovimiento").val(data.IDTIPOMOV);
   		 			$("#txt_descripcion").val(data.DESCRIPCION);
   		 			$("#sel_estado").val(data.ESTADO);
    				$("#operation").val("Edit");
   		 			$("#idmovimiento").val(idmovimiento);	
   		 			data.GENERAEDI == 1 ? $("#generaedi").prop("checked", true) : $("#generaedi").prop("checked", false);
   		 			data.APROBACION == 1 ? $("#aprobacion").prop("checked", true) : $("#aprobacion").prop("checked", false);


			    }
			  })
	}catch(err){
		console.log(err);
	}
}

async function procesar(){
	event.preventDefault();
	var valida;
	valida = $("#frmMovimiento").valid();
	if (valida == true){
		let frmMovimiento = new FormData(document.querySelector("#frmMovimiento"));
		try{
			const url = `${base_url}movimientos/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmMovimiento,
			});
			const resultado = await respuesta.json();
				if(resultado.status == 'save_ok'){
	  				Swal.fire({
	  					position: 	'center',
	  					icon: 		'success',
	  					title: 		'Movimiento creado con exito!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    			$('#movimientosModal').modal('hide');
					$('#frmMovimiento')[0].reset();
	        		tblMovimientos.ajax.reload(null, false);
	    		}else if (resultado.status == 'movimiento_exixte'){
					Swal.fire({
		  				icon: 	'error',
		  				title: 	'Atención:',
		  				text: 	'El Movimiento ya existe'
					});
				}else if(resultado.status == 'update_ok'){
	  				Swal.fire({
	  					position: 'center',
	  					icon: 		'success',
	  					title: 		'Actualización Exitosa!',
	  					showConfirmButton: false,
	  					timer: 1500
					});
	    		$('#movimientosModal').modal('hide');
				$('#frmMovimiento')[0].reset();
	        	tblMovimientos.ajax.reload(null, false);
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

function deleteMovimiento(idmovimiento){
	Swal.fire({
  			title: 	'Eliminar Movimiento',
  			text: 	"Confirma que desea eliminar el Movimiento seleccionado?",
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
        	$('#ideliminacion').val(idmovimiento);
        		$(document).on('submit', '#frmElimina', function(event){
    				event.preventDefault();
    				 $.ajax({
					      url:`${base_url}movimientos/deleteMovimiento`,
					      method:"POST",
					      data:$('#frmElimina').serialize(),
					      dataType:"json",
					      success:function(data){
					      	if(data.status=="delete_ok"){
					      		Swal.fire({
  									position: 'center',
  									icon: 'success',
  									title: 'Movimiento Eliminado',
  									showConfirmButton: false,
  									timer: 1500
								})
					      		$('#motivoElimina').modal('hide');
										$('#frmElimina')[0].reset();
        						tblMovimientos.ajax.reload(null, false);
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
        window.open("views/reportes/movimientoPDF.php",
       'win2',
       'status=yes,toolbar=no,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }
}

$(document).on('click', '#imprimir_excel', function(e){
	window.location.href = `${base_url}views/reportes/movimientoEXCEL.php`;
	e.preventDefault();
});


$(document).on('click', '.movimientosModal', function(){
    $('#movimientosModal').modal('show');
	$("#sel_tipomovimiento").removeClass("is-invalid");
	$("#txt_descripcion").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
  	validador.resetForm();	
	$('#frmMovimiento')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nuevo Movimiento");
    $("#operation").val("Add");
});

$("#txt_codigo").keyup(function(){              
   var ta      =   $("#txt_codigo");
   letras      =   ta.val().replace(/ /g, "");
   ta.val(letras)
});

/*=================================================================================================================
=            									VALIDACION FORMULARIO MOVIMIENTOS 							
==================================================================================================================*/
 var validador = $('#frmMovimiento').validate({
    rules: {
      sel_tipomovimiento: {
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
        txt_descripcion: {
        required: "El Nombre Requerido"
      },
      sel_tipomovimiento: {
        required: "El Tiopo de Movimiento es Requerido"
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