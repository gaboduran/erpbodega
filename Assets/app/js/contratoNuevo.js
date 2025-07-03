$(document).ready(function(){
	getTarifaAlmacenamiento();
	getAllTarifaInspeccion();
	getAllTarifaTransporte();
	getAllTarifaManipuelo();
	getTarifaTaller();
	getAllPeriodoFactura();
	getAllMoneda();
	getAllEstado();

  	if ($('#txt_idcontrato').val().length != 0) {
  		$("#btnAddTarifaAlmacenamiento").attr("disabled", false);
		$("#btnAddTarifaInspeccion").attr("disabled", false);
		$("#btnAddTarifaManipuleo").attr("disabled", false);
		$("#btnAddTarifaTaller").attr("disabled", false);
		$("#btnAddTarifaTransporte").attr("disabled", false);
	}
});

async function buscaCliente(){
event.preventDefault();
	$(".modal-header").css("background-color", "#17a2b8");
  	$(".modal-header").css("color", "white" );
  	$(".modal-title").text("Busca Cliente");
	try{
		const url = `${base_url}contrato/buscaCliente`;
		 $.ajax({
			url:url,
			method:"POST",
        	data:$('#frmBuscaCliente').serialize(),
			success:function(data){
				document.getElementById("ResultBuscaCliente").innerHTML = data;
			}
		})
	}catch(err){
		console.log(err);
	}
}


$(document).on('click', '.buscaCliente', function(){
    $('#buscaClienteModal').modal('show');
	document.getElementById("ResultBuscaCliente").innerHTML = "";
	$('#frmBuscaCliente')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Busca Cliente");
});

async function busca(idcliente){
	event.preventDefault();
	try{
		const url = `${base_url}clientes/getClienteByIdecliente`;
			 $.ajax({
				url:url,
			    method:"POST",
		    	data:{idcliente:idcliente},
				    dataType:"json",
			    success:function(data){
					$("#txt_idecliente").val(data.IDECLIENTE);
	 				$("#txt_nomcliente").val(data.NOMCLIENTE);
	 				$("#sel_perfactura ").attr("disabled", false);
		   			$("#sel_moneda ").attr("disabled", false);
		   			$("#sel_estado ").attr("disabled", false);
	 				$('#buscaClienteModal').modal('hide');
			    }
			})
	}catch(err){
		console.log(err);
	}
}

async function getAllPeriodoFactura(){
	var idcontrato = $("#idcontrato").val();
	try{
		const url = `${base_url}contrato/getAllPeriodoFactura`;
		 $.ajax({
			url:url,
			data: {idcontrato:idcontrato},
			method:"POST",
			  success:function(data){
				  $("#sel_perfactura").html(data);
			}
		})
	}catch(err){
		console.log(err);
	}
}

async function getAllMoneda(){
	var idcontrato = $("#idcontrato").val();
	try{
		const url = `${base_url}contrato/getAllMoneda`;
		 $.ajax({
			url:url,
			data: {idcontrato:idcontrato},
			method:"POST",
			  success:function(data){
				  $("#sel_moneda").html(data);
			}
		})
	}catch(err){
		console.log(err);
	}
}

async function getAllEstado(){
	var idcontrato = $("#idcontrato").val();
	try{
		const url = `${base_url}contrato/getAllEstado`;
		 $.ajax({
			url:url,
			data: {idcontrato:idcontrato},
			method:"POST",
			  success:function(data){
				  $("#sel_estado").html(data);
			}
		})
	}catch(err){
		console.log(err);
	}
}

$(document).on('click', '.nuevaTarifaALM', function(){
	$('#TarifaAlmacenajeModal').modal('show');
	$('#frmTarifaAlmacenaje')[0].reset();
	$("#sel_tamano").removeClass("is-invalid");
	$("#txt_taralmacenamiento").removeClass("is-invalid");
	$("#txt_diaslibres").removeClass("is-invalid");
  	validaFormALM.resetForm();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nueva Tarifa Almacenamiento");
    $("#operationALM").val("Add");
});

$(document).on('click', '.nuevaTarifaINS', function(){
	$("#sel_tamanoInspeccion").removeClass("is-invalid");
	$("#sel_movimientoInspeccion").removeClass("is-invalid");
	$("#txt_valorInspeccion").removeClass("is-invalid");
  	validaFormINS.resetForm();
	$('#TarifaInspeccionModal').modal('show');
	$('#frmTarifaInspeccion')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nueva Tarifa Inspecciòn");
    $("#operationINS").val("Add");
});
				

$(document).on('click', '.nuevaTarifaMNP', function(){
	$('#TarifaManipuleoModal').modal('show');
	$('#frmTarifaManipuleo')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nueva Tarifa Manipuleo");
	$("#operationMNP").val("Add");
});


$(document).on('click', '.nuevaTarifaTLL', function(){
	$("#txt_vlrtardeposito").removeClass("is-invalid");
  	validaFormTLL.resetForm();
	$('#TarifaTallerModal').modal('show');
	$('#frmTarifaTaller')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nueva Tarifa Taller");
    $("#operationTLL").val("Add");

});

$(document).on('click', '.nuevaTarifaTSP', function(){
	$("#sel_tamanoTransporte").removeClass("is-invalid");
	$("#sel_condicion").removeClass("is-invalid");
	$("#txt_vlrcosto").removeClass("is-invalid");
	$("#txt_vlrVenta").removeClass("is-invalid");
  	validaFormTSP.resetForm();
	$('#TarifaTransporteModal').modal('show');
	$('#frmTarifaTransporte')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nueva Tarifa Transporte");
    $("#operationTSP").val("Add");
});

/*=======================================================================================================
=            										CREA CONTRATO NUEVO 
========================================================================================================*/

async function procesarContrato(){
	event.preventDefault();
	var operation 		= $("#operation").val();
	var idcontrato 		= $("#txt_idcontrato").val();
	var idcliente 		= $("#txt_idecliente").val();
	var moneda			= $("#sel_moneda").val();
	var perfactura		= $("#sel_perfactura").val();
	var estado 			= $("#sel_estado").val();	
	try{
		const url = `${base_url}contrato/procesarContrato`;
		 $.ajax({
		 	url:url,
		  	method:"POST",
			data: {operation:operation, idcontrato:idcontrato, idcliente:idcliente, perfactura:perfactura, moneda:moneda, estado:estado},
			dataType:"json",
		    success:function(data){
				if (data.status == "save_ok"){
					$("#txt_idcontrato").val(data.idcontrato);
					$("#btnSavecontrato").attr("disabled", true);
			      	toastr.success('Contrato Creado con Exito');
			      	$("#btnAddTarifaAlmacenamiento").attr("disabled", false);
					$("#btnAddTarifaInspeccion").attr("disabled", false);
					$("#btnAddTarifaManipuleo").attr("disabled", false);
					$("#btnAddTarifaTaller").attr("disabled", false);
					$("#btnAddTarifaTransporte").attr("disabled", false);
			    }else if(data.status == "update_ok"){
					 $('#TarifaAlmacenajeModal').modal('hide');
					 toastr.success('Tarifa Almacenamiento actualizada con Exito')
			 		getTarifaAlmacenamiento();
				}else if (data.status == "existe_tarifa"){
						toastr.error('La Tarifa ya se encuentra creada')
				}else if(data.status == "contrato_inactivo"){
					toastr.error('El contrato se encuentra Inactivo')
				}
			}
		 })
	}catch(err){
		console.log(err);
	}
}

/*===============================================================================================================================================
=            					OBTIENE TODAS LA TARIFAS DE ALMACENAMIENTO  DE UN CONTRATO
================================================================================================================================================*/

async function getTarifaAlmacenamiento(){
	var idcontrato = $("#txt_idcontrato").val();
	try{
		const url = `${base_url}contrato/getAllTarifaAlmacenamiento`;
		 $.ajax({
			url:url,
			method:"POST",
			data:{idcontrato:idcontrato},
			   success:function(data){
				document.getElementById("tblDetalleTarifa").innerHTML = data;
			}
		})
	}catch(err){
		console.log(err);
	}
}

/*===============================================================================================================================================
=            					OBTIENE TODAS LA TARIFAS DE INSPECCION DE UN CONTRATO
================================================================================================================================================*/

async function getAllTarifaInspeccion(){
	var idcontrato = $("#txt_idcontrato").val();
		try{
			const url = `${base_url}contrato/getAllTarifaInspeccion`;
			 $.ajax({
					url:url,
				  method:"POST",
					data:{idcontrato:idcontrato},
				    success:function(data){
						document.getElementById("tblDetalleInspeccion").innerHTML = data;
					  }
				  })
			}catch(err){
			console.log(err);
		}
}

/*===============================================================================================================================================
=            					OBTIENE TODAS LA TARIFAS DE MANIPULEPO DE UN CONTRATO
================================================================================================================================================*/


async function getAllTarifaManipuelo(){
	var idcontrato = $("#txt_idcontrato").val();
		try{
			const url = `${base_url}contrato/getAllTarifaManipuleo`;
			 $.ajax({
					url:url,
				  method:"POST",
					data:{idcontrato:idcontrato},
				    success:function(data){
						document.getElementById("tblDetalleManipuleo").innerHTML = data;
					  }
				  })
			}catch(err){
			console.log(err);
		}
}


/*===============================================================================================================================================
=            					OBTIENE TODAS LA TARIFAS DE TALLER DE UN CONTRATO
================================================================================================================================================*/

async function getTarifaTaller(){
	var idcontrato = $("#txt_idcontrato").val();
		try{
			const url = `${base_url}contrato/getTarifaTaller`;
			 $.ajax({
				url:url,
				method:"POST",
				data:{idcontrato:idcontrato},
				   success:function(data){
					document.getElementById("tblDetalleTaller").innerHTML = data;
				}
			})
		}catch(err){
			console.log(err);
		}
}

/*===============================================================================================================================================
=            					OBTIENE TODAS LA TARIFAS DE TRANSPORTE DE UN CONTRATO
================================================================================================================================================*/

async function getAllTarifaTransporte(){
	var idcontrato = $("#txt_idcontrato").val();
		try{
			const url = `${base_url}contrato/getAllTarifaTransporte`;
			 $.ajax({
					url:url,
				  method:"POST",
					data:{idcontrato:idcontrato},
				    success:function(data){
						document.getElementById("tblDetalleTransporte").innerHTML = data;
					}
				  })
			}catch(err){
			console.log(err);
		}
}

/*============================================================================================================================================
=            					MUESTRA EL DETALLE DE UNA TARIFA DE ALMACENAMIENTO DE UN CONTRATO ESPECIFICO 
==============================================================================================================================================*/
async function detalleTarAlmacenamiento(idtarifa){
	event.preventDefault();
	$("#sel_tamano").removeClass("is-invalid");
	$("#txt_taralmacenamiento").removeClass("is-invalid");
	$("#txt_diaslibres").removeClass("is-invalid");
  	validaFormALM.resetForm();
	try{
		const url = `${base_url}contrato/verTarifaAlmacenamiento`;
		 $.ajax({
			url:url,
			method:"POST",
			data:{idtarifa:idtarifa},
			dataType:"json",
		    success:function(data){
				$('#TarifaAlmacenajeModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white" );
				$(".modal-title").text("Editar Tarifa Almacenamiento");
				$("#sel_tamano").val(data.TAMANO);
				$("#txt_taralmacenamiento").val(data.VALOR);
				$("#txt_diaslibres").val(data.DIASLIBRES);
				$("#txt_diasdespues").val(data.DIASDESPUES);
				$("#txt_cobrodespues").val(data.COBRARDESPUES);
				$("#txt_idtarifa").val(data.ID);
				$("#operationALM").val("Edit");
			}
		})
	}catch(err){
		console.log(err);
	}
}

/*============================================================================================================================================
=            					MUESTRA EL DETALLE DE UNA TARIFA DE INSPECCION DE UN CONTRATO ESPECIFICO 
==============================================================================================================================================*/


async function detalleTarifaInspeccion(idtarifa){
	event.preventDefault();
	$("#sel_tamanoInspeccion").removeClass("is-invalid");
	$("#sel_movimientoInspeccion").removeClass("is-invalid");
	$("#txt_valorInspeccion").removeClass("is-invalid");
  	validaFormINS.resetForm();
	try{
		const url = `${base_url}contrato/verTarifaInspeccion`;
		 $.ajax({
			url:url,
			method:"POST",
			data:{idtarifa:idtarifa},
			dataType:"json",
		    success:function(data){
				$('#TarifaInspeccionModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white" );
				$(".modal-title").text("Editar Tarifa Inspeccion");
				$("#sel_tamanoInspeccion").val(data.TAMANO);
				$("#sel_movimientoInspeccion").val(data.IDMOVIMIENTO);
				$("#txt_DescripcionMovimiento").val(data.DESCRIPCION);
				$("#txt_valorInspeccion").val(data.VALOR);
				$("#txt_idtarifaInspeccion").val(data.ID);
				$("#operationINS").val("Edit");
			}
		})
	}catch(err){
		console.log(err);
	}
}
/*============================================================================================================================================
=            					MUESTRA EL DETALLE DE UNA TARIFA DE MANIPULEO DE UN CONTRATO ESPECIFICO 
==============================================================================================================================================*/

async function detalleTarifaManipuleo(idtarifa){
	event.preventDefault();
	$("#sel_tamanoManipuleo").removeClass("is-invalid");
	$("#sel_movimientoManipuleo").removeClass("is-invalid");
	$("#txt_valorManipuleo").removeClass("is-invalid");
  	validaFormMNP.resetForm()
	try{
		const url = `${base_url}contrato/verTarifaManipuleo`;
		 $.ajax({
			url:url,
			method:"POST",
			data:{idtarifa:idtarifa},
			dataType:"json",
		    success:function(data){
				$('#TarifaManipuleoModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white" );
				$(".modal-title").text("Editar Tarifa Maipuleo");
				$("#sel_tamanoManipuleo").val(data.TAMANO);
				$("#sel_movimientoManipuleo").val(data.IDMOVIMIENTO);
				$("#txt_DescripcionMovimientoMnpl").val(data.DESCRIPCION);
				$("#txt_valorManipuleo").val(data.VALOR);
				$("#txt_idtarifaManipuleo").val(data.ID);
				$("#operationMNP").val("Edit");
			}
		})
	}catch(err){
		console.log(err);
	}
}

/*============================================================================================================================================
=            					MUESTRA EL DETALLE DE UNA TARIFA DE TALLER DE UN CONTRATO ESPECIFICO 
==============================================================================================================================================*/

async function detalleTaller(idtarifa){
	$("#txt_vlrtardeposito").removeClass("is-invalid");
  	validaFormTLL.resetForm();
	try{
		const url = `${base_url}contrato/verTarifaTaller`;
		 $.ajax({
			url:url,
			method:"POST",
			data:{idtarifa:idtarifa},
			dataType:"json",
		    success:function(data){
				$('#TarifaTallerModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white" );
				$(".modal-title").text("Editar Tarifa Taller");
				$("#txt_vlrtardeposito").val(data.VLRDEPOSITO);
				$("#txt_vlrtarcliente").val(data.VLRCLIENTE);
				$("#txt_idtarifaTaller").val(data.ID);
				$("#operationTLL").val("Edit");
			}
		})
	}catch(err){
		console.log(err);
	}
}

/*============================================================================================================================================
=            					MUESTRA EL DETALLE DE UNA TARIFA DE TRANSPORTE DE UN CONTRATO ESPECIFICO 
==============================================================================================================================================*/

async function detalleTarifaTransporte(idtarifa){
	event.preventDefault();
	$("#sel_tamanoTransporte").removeClass("is-invalid");
	$("#sel_condicion").removeClass("is-invalid");
	$("#txt_vlrcosto").removeClass("is-invalid");
	$("#txt_vlrVenta").removeClass("is-invalid");
  	validaFormTSP.resetForm()
			try{
				const url = `${base_url}contrato/verTarifaTransporte`;
				 $.ajax({
					url:url,
					method:"POST",
					data:{idtarifa:idtarifa},
					dataType:"json",
				    success:function(data){
						$('#TarifaTransporteModal').modal('show');
						$(".modal-header").css("background-color", "#17a2b8");
						$(".modal-header").css("color", "white" );
						$(".modal-title").text("Editar Tarifa Transporte");
						$("#sel_tamanoTransporte").val(data.TAMANO);
						$("#sel_condicion").val(data.CONDICION);
						$("#txt_vlrcosto").val(data.VALORCOSTO);
						$("#txt_vlrVenta").val(data.VALORVENTA);
						$("#txt_idtarifaTransporte").val(data.ID);
						$("#operationTSP").val("Edit");
					}
				})
			}catch(err){
				console.log(err);
			}
	}

/*====================================================================================================================================================
=            										CREA / EDITA TARIFA DE ALMACENAMIENTO NUEVA
=====================================================================================================================================================*/

async function procesarTarifaALM(){
	event.preventDefault();
	var valida;
	var idcontrato 		= $("#txt_idcontrato").val();
	var tamano 			= $("#sel_tamano").val();
	var valor			= $("#txt_taralmacenamiento").val();
	var diaslibres		= $("#txt_diaslibres").val();
	var diasdespues		= $("#txt_diasdespues").val();
	var cobrodespues	= $("#txt_cobrodespues").val();
	var idtarifa		= $("#txt_idtarifa").val();
	var operationalm	= $("#operationALM").val();
	valida = $("#frmTarifaAlmacenaje").valid();
	if (valida == true){
		try{
			const url = `${base_url}contrato/procesarTarifaALM`;
			 $.ajax({
				url:url,
				method:"POST",
				data:{idcontrato:idcontrato, tamano:tamano, valor:valor, diaslibres:diaslibres,diasdespues:diasdespues,cobrodespues:cobrodespues, operationalm:operationalm, idtarifa:idtarifa },
				dataType:"json",
				    success:function(data){
						if (data.status == "save_ok"){
							$("#frmTarifaAlmacenaje")[0].reset();
							getTarifaAlmacenamiento();
					      	toastr.success('Tarifa Almacenamiento creada con Exito');
					    }else if(data.status == "update_ok"){
							 $('#TarifaAlmacenajeModal').modal('hide');
							 toastr.success('Tarifa Almacenamiento actualizada con Exito')
					 		getTarifaAlmacenamiento();
						}else if (data.status == "existe_tarifa"){
      						toastr.error('La Tarifa ya se encuentra creada')
						}else if(data.status == "contrato_inactivo"){
							toastr.error('El contrato se encuentra Inactivo')
						}
				    }
				  })
			}catch(err){
			console.log(err);
		}

	}
}


/*====================================================================================================================================================
=            										CREA / EDITA TARIFA DE INSPECCION NUEVA
=====================================================================================================================================================*/

async function procesarTarifaINS(){
	event.preventDefault();
	var valida;
	var idcontrato 		= $("#txt_idcontrato").val();
	var tamano 			= $("#sel_tamanoInspeccion").val();
	var idmovimiento	= $("#sel_movimientoInspeccion").val();
	var valor			= $("#txt_valorInspeccion").val();
	var idtarifa		= $("#txt_idtarifaInspeccion").val();
	var operationins	= $("#operationINS").val();
	valida = $("#frmTarifaInspeccion").valid();
	if (valida == true){
		try{
			const url = `${base_url}contrato/procesarTarifaINS`;
			 $.ajax({
				url:url,
				method:"POST",
				data:{idcontrato:idcontrato, tamano:tamano, idmovimiento:idmovimiento, valor:valor, operationins:operationins, idtarifa:idtarifa },
				dataType:"json",
				    success:function(data){
						if (data.status == "save_ok"){
							$("#frmAddTarifaInspeccion")[0].reset();
							getAllTarifaInspeccion();
					      	toastr.success('Tarifa Inspección creada con Exito');
					    }else if(data.status == "update_ok"){
							 $('#TarifaInspeccionModal').modal('hide');
							 toastr.success('Tarifa Inspección actualizada con Exito')
					 		getAllTarifaInspeccion();
						}else if (data.status == "existe_tarifa"){
      						toastr.error('El tamaño y movimiento ya cuenta con una tarifa creada')
						}else if(data.status == "contrato_inactivo"){
							toastr.error('El contrato se encuentra Inactivo')
						}
				    }
				  })
			}catch(err){
			console.log(err);
		}

	}
}

/*====================================================================================================================================================
=            										CREA / EDITA TARIFA DE MANIPUELO NUEVA
=====================================================================================================================================================*/

async function procesarTarifaMNP(){
	event.preventDefault();
	var idcontrato 		= $("#txt_idcontrato").val();
	var tamano			= $("#sel_tamanoManipuleo").val();
	var idmovimiento	= $("#sel_movimientoManipuleo").val();
	var valor 			= $("#txt_valorManipuleo").val();
	var idtarifa		= $("#txt_idtarifaManipuleo").val();
	var operationmnp	= $("#operationMNP").val();
	var valida;	
	valida = $("#frmTarifaManipuleo").valid();
		if (valida == true){
			try{
			const url = `${base_url}contrato/procesarTarifaMNP`;
			 $.ajax({
				url:url,
				method:"POST",
				data:{idcontrato:idcontrato, tamano:tamano, idmovimiento:idmovimiento, valor:valor, idtarifa:idtarifa, operationmnp:operationmnp },
				dataType:"json",
				    success:function(data){
						if (data.status == "save_ok"){
							$("#frmTarifaManipuleo")[0].reset();
							$('#TarifaManipuleoModal').modal('hide');
							getAllTarifaManipuelo();
					      	toastr.success('Tarifa Manipuleo creada con Exito');
					    }else if(data.status == "update_ok"){
							$('#TarifaManipuleoModal').modal('hide');
							 toastr.success('Tarifa Inspección actualizada con Exito')
					 		getAllTarifaManipuelo();
						}else if (data.status == "existe_tarifa"){
      						toastr.error('El tamaño y movimiento ya cuenta con una tarifa creada')
						}else if(data.status == "contrato_inactivo"){
							toastr.error('El contrato se encuentra Inactivo')
						}
				    }
				  })
					}catch(err){
				console.log(err);
			}
		}
}

/*====================================================================================================================================================
=            										CREA / EDITA TARIFA DE TALLER NUEVA
=====================================================================================================================================================*/

async function procesarTarifaTLL(){
	event.preventDefault();
	var idcontrato 		= $("#txt_idcontrato").val();
	var tardeposito		= $("#txt_vlrtardeposito").val();
	var tarcliente		= $("#txt_vlrtarcliente").val();
	var idtarifa		= $("#txt_idtarifaTaller").val();
	var operationtll	= $("#operationTLL").val();
	var valida;	
	valida = $("#frmTarifaTaller").valid();
		if (valida == true){
			try{
			const url = `${base_url}contrato/procesarTarifaTLL`;
			 $.ajax({
				url:url,
				method:"POST",
				data:{idcontrato:idcontrato, idtarifa:idtarifa, tardeposito:tardeposito, tarcliente:tarcliente, operationtll:operationtll},
				dataType:"json",
				    success:function(data){
						if (data.status == "save_ok"){
							$("#frmTarifaTaller")[0].reset();
							$('#TarifaTallerModal').modal('hide');
							getTarifaTaller();
					      	toastr.success('Tarifa Taller creada con Exito');
					    }else if(data.status == "update_ok"){
							$('#TarifaTallerModal').modal('hide');
							getTarifaTaller();
					      	toastr.success('Tarifa Taller actualizada con Exito');
						}else if (data.status == "existe_tarifa"){
      						toastr.error('La Tarifa ya esta creada')
						}else if(data.status == "contrato_inactivo"){
							toastr.error('El contrato se encuentra Inactivo')
						}
				    }
				  })
					}catch(err){
				console.log(err);
			}
		}
}

/*====================================================================================================================================================
=            										CREA / EDITA TARIFA DE TRANSPORTE NUEVA
=====================================================================================================================================================*/

async function procesarTarifaTSP(){
	event.preventDefault();
	var idcontrato 		= $("#txt_idcontrato").val();
	var tamano 			= $("#sel_tamanoTransporte").val();
	var condicion		= $("#sel_condicion").val();
	var vlrcosto		= $("#txt_vlrcosto").val();
	var vlrventa		= $("#txt_vlrVenta").val();
	var idtarifa 		= $("#txt_idtarifaTransporte").val();
	var operationtsp	= $("#operationTSP").val();
	var valida;	
	valida = $("#frmTarifaTransporte").valid();
		if (valida == true){
			try{
			const url = `${base_url}contrato/procesarTarifaTSP`;
			 $.ajax({
				url:url,
				method:"POST",
				data:{idcontrato:idcontrato,idtarifa:idtarifa, tamano:tamano, condicion:condicion, vlrcosto:vlrcosto, vlrventa:vlrventa, operationtsp:operationtsp},
				dataType:"json",
				    success:function(data){
						if (data.status == "save_ok"){
							toastr.success('Tarifa Transporte creada con Exito')
							getAllTarifaTransporte();
							$("#frmAddTarifaTransporte")[0].reset();
						}else if(data.status == "update_ok"){
							$('#TarifaTransporteModal').modal('hide');
							toastr.success('Tarifa Transporte Actualizada con Exito')
							getAllTarifaTransporte();
						}else if (data.status == "existe_tarifa"){
							toastr.error('El Tamaño y la Codición ya cuentan con una tarifa creada')
						}else if(data.status == "contrato_inactivo"){
							toastr.error('El contrato se encuentra Inactivo')
						}
				    }

				  })
					}catch(err){
				console.log(err);
			}
		}
}


/*====================================================================================================================================================
=            										ELIMINA TARIFA DE ALMACENIMAINETO 
=====================================================================================================================================================*/

async function eliminarTarAlmacenamiento(idtarifa){
	Swal.fire({
  			title: 	'Eliminar Tarifa',
  			text: 	"Confirma eliminar la Tarifa seleccionada?",
  			icon: 	'warning',
  			showCancelButton: true,
  			confirmButtonColor: '#3085d6',
  			cancelButtonColor: '#d33',
  			confirmButtonText: 'Eliminar'
		}).then((result) => {
			if (result.isConfirmed) {
		try{
			const url = `${base_url}contrato/eliminarTarifaAlmacenamiento`;
			 $.ajax({
				url:url,
				  method:"POST",
					data:{idtarifa:idtarifa},
					dataType:"json",
				    success:function(data){
	    				if(data.status=="delete_ok"){
							toastr.success('Tarifa eliminada con Exito');
							getTarifaAlmacenamiento();
						}
				 	}
				 })
			}catch(err){
				console.log(err);
			}
		}
	})
}


/*=====================================================================================================================================================
=            				ELIMINA TARIFA DE UN CONTRATO DE INSPECCION ESPECIFICO 
======================================================================================================================================================*/

async function eliminarTarifaInspeccion(idtarifa){
	Swal.fire({
  			title: 	'Eliminar Tarifa',
  			text: 	"Confirma eliminar la Tarifa seleccionada?",
  			icon: 	'warning',
  			showCancelButton: true,
  			confirmButtonColor: '#3085d6',
  			cancelButtonColor: '#d33',
  			confirmButtonText: 'Eliminar'
		}).then((result) => {
			if (result.isConfirmed) {
		try{
			const url = `${base_url}contrato/eliminarTarifaInspeccion`;
			
			 $.ajax({
				url:url,
				  method:"POST",
					data:{idtarifa:idtarifa},
					dataType:"json",
				    success:function(data){
	    				if(data.status=="delete_ok"){
							toastr.success('Tarifa eliminada con Exito');
							getAllTarifaInspeccion();
						}
				 	}
				 })
			}catch(err){
				console.log(err);
			}
		}
	})
}

/*=====================================================================================================================================================
=            				ELIMINA TARIFA DE UN CONTRATO DE MANIPULEO ESPECIFICO 
======================================================================================================================================================*/

async function eliminarTarifaManipuleo(idtarifa){
	Swal.fire({
  			title: 	'Eliminar Tarifa',
  			text: 	"Confirma eliminar la Tarifa seleccionada?",
  			icon: 	'warning',
  			showCancelButton: true,
  			confirmButtonColor: '#3085d6',
  			cancelButtonColor: '#d33',
  			confirmButtonText: 'Eliminar'
		}).then((result) => {
			if (result.isConfirmed) {
		try{
			const url = `${base_url}contrato/eliminarTarifaManipuleo`;
			 $.ajax({
				url:url,
				  method:"POST",
					data:{idtarifa:idtarifa},
					dataType:"json",
				    success:function(data){
	    				if(data.status=="delete_ok"){
							toastr.success('Tarifa eliminada con Exito');
							getAllTarifaManipuelo();
						}
				 	}
				 })
			}catch(err){
				console.log(err);
			}
		}
	})
}

/*=====================================================================================================================================================
=            				ELIMINA TARIFA DE UN CONTRATO DE TALLER ESPECIFICO 
======================================================================================================================================================*/

async function eliminarTarifaTaller(idtarifa){
	Swal.fire({
  			title: 	'Eliminar Tarifa',
  			text: 	"Confirma eliminar la Tarifa seleccionada?",
  			icon: 	'warning',
  			showCancelButton: true,
  			confirmButtonColor: '#3085d6',
  			cancelButtonColor: '#d33',
  			confirmButtonText: 'Eliminar'
		}).then((result) => {
			if (result.isConfirmed) {
		try{
			const url = `${base_url}contrato/eliminarTarifaTaller`;
			
			 $.ajax({
				url:url,
				  method:"POST",
					data:{idtarifa:idtarifa},
					dataType:"json",
				    success:function(data){
	    				if(data.status=="delete_ok"){
							toastr.success('Tarifa eliminada con Exito');
							getTarifaTaller();
						}
				 	}
				 })
			}catch(err){
				console.log(err);
			}
		}
	})
}

/*====================================================================================================================================================
=            				ELIMINA TARIFA TRASPORTE DE UN CONTRATO ESPECIFICO
=====================================================================================================================================================*/

async function eliminarTarifaTransporte(idtarifa){
	Swal.fire({
  			title: 	'Eliminar Tarifa',
  			text: 	"Confirma eliminar la Tarifa seleccionada?",
  			icon: 	'warning',
  			showCancelButton: true,
  			confirmButtonColor: '#3085d6',
  			cancelButtonColor: '#d33',
  			confirmButtonText: 'Eliminar'
		}).then((result) => {
			if (result.isConfirmed) {
		try{
			const url = `${base_url}contrato/eliminarTarifaTransporte`;
			
			 $.ajax({
				url:url,
				  method:"POST",
					data:{idtarifa:idtarifa},
					dataType:"json",
				    success:function(data){
	    				if(data.status=="delete_ok"){
							toastr.success('Tarifa eliminada con Exito');
							getAllTarifaTransporte();
						}
				 	}
				 })
			}catch(err){
				console.log(err);
			}
		}
	})
}

/*====================================================================================================================================================
=            											FUNCIONES VARIAS
=====================================================================================================================================================*/


$("#sel_movimientoManipuleo").change(function(){
	event.preventDefault();
	var idmovimiento = $("#sel_movimientoManipuleo").val();
 	try{
		const url = `${base_url}contrato/descMovimiento`;
		 $.ajax({
			url:url,
			  method:"POST",
				data:{idmovimiento:idmovimiento},
				dataType:"json",
			    success:function(data){
					$("#txt_DescripcionMovimientoMnpl").val(data.DESCRIPCION);
				  }
			  })
	}catch(err){
		console.log(err);
	}
})

$("#sel_movimientoInspeccion").change(function(){
	event.preventDefault();
	var idmovimiento = $("#sel_movimientoInspeccion").val();
 	try{
		const url = `${base_url}contrato/descMovimiento`;
		 $.ajax({
			url:url,
			  method:"POST",
				data:{idmovimiento:idmovimiento},
				dataType:"json",
			    success:function(data){
					$("#txt_DescripcionMovimiento").val(data.DESCRIPCION);
				  }
			  })
	}catch(err){
		console.log(err);
	}
});


$(function() {
    $('.custom4').maskMoney();
  })

/*==================================================================================================================================================
=            									VALIDACION TARIFAS DE ALAMACENAMIENTO 							
===================================================================================================================================================*/
$(function (){
 validaFormALM =  $('#frmTarifaAlmacenaje').validate({
    rules: {
      sel_tamano_modal: {
        required: true,
      },
      txt_taralmacenamiento: {
        required: true,
      },
      txt_diaslibres: {
        maxlength: 5
      },
    },
    messages: {
      sel_tamano: {
        required: "El Tamaño es Requerido"

      },
      txt_taralmacenamiento: {
        required: "El Valor es Requerido "
      },
      txt_diaslibres: {
        maxlength: "Menor igual a 5 Caracteres"
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
});

/*==================================================================================================================================================
=            									VALIDACION TARIFAS DE INSPECCION 							
===================================================================================================================================================*/

$(function (){
  validaFormINS = $('#frmTarifaInspeccion').validate({
    rules: {
      sel_tamanoInspeccion: {
        required: true,
      },
      sel_movimientoInspeccion: {
        required: true,
      },
      txt_valorInspeccion: {
         required: true,
      },
    },
    messages: {
      sel_tamanoInspeccion: {
        required: "El Tamaño es Requerido"

      },
      sel_movimientoInspeccion: {
        required: "El Movimiento es Requerido "
      },
      txt_valorInspeccion: {
		required: "El valor es Requerido "      
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
});

/*==================================================================================================================================================
=            									VALIDACION TARIFAS DE MANIPULEO 							
===================================================================================================================================================*/
$(function (){
  validaFormMNP = $('#frmTarifaManipuleo').validate({
    rules: {
      sel_tamanoManipuleo: {
        required: true,
      },
      sel_movimientoManipuleo: {
        required: true,
      },
      txt_valorManipuleo: {
         required: true,
      },
    },
    messages: {
      sel_tamanoManipuleo: {
        required: "El Tamaño es Requerido"

      },
      sel_movimientoManipule: {
        required: "El Movimiento es Requerido "
      },
      txt_valorManipuleo: {
		required: "El valor es Requerido "      
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
});

/*=====================================================================================================================================================
=            									VALIDACION TARIFAS DE TALLER 							
======================================================================================================================================================*/
$(function (){
  validaFormTLL = $('#frmTarifaTaller').validate({
    rules: {
      txt_vlrtardeposito: {
        required: true,
      },
    },
    messages: {
      txt_vlrtardeposito: {
        required: "La Tarifa del Deposito es Requerida"

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
});
/*===================================================================================================================================================
=            									VALIDACION TARIFAS DE MANIPULEO 							
====================================================================================================================================================*/
$(function (){
  validaFormTLL = $('#frmTarifaTaller').validate({
    rules: {
      txt_vlrtardeposito: {
        required: true,
      },
    },
    messages: {
      txt_vlrtardeposito: {
        required: "El Tamaño es Requerido"

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
  }
});
});
/*===================================================================================================================================================
=            									VALIDACION TARIFAS DE TRANPORTE 							
====================================================================================================================================================*/
$(function (){
  validaFormTSP = $('#frmTarifaTransporte').validate({
    rules: {
      sel_tamanoTransporte: {
        required: true,
      },
      sel_condicion: {
        required: true,
      },
      txt_vlrcosto: {
         required: true,
      },
      txt_vlrventa: {
         required: true,
      },
    },
    messages: {
      sel_tamanoTransporte: {
        required: "El Tamaño es Requerido"

      },
      sel_condicion: {
        required: "La condición es Requerida"
      },
      txt_vlrcosto: {
		required: "El valor es Requerido "      
		},
	  txt_vlrventa: {
		required: "El valor es Requerido "      
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
});
