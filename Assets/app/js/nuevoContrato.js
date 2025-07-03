$(document).ready(function() {
    $('.js-example-basic-single').select2();

    $('#detAlamacenamiento').DataTable( {
    	 "searching": false,
    	 "paging": false,
  		 "bInfo" : false
  		});
	});

document.addEventListener("DOMContentLoaded",
	
	function(){
	   tblContrato = $('#tblContrato').DataTable({
	   	paging: 	true,
	   	aProcessing:true,
	   	aserverSide: true,
	    language: {
	        url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
	      },  
	   	 	ajax : {
		 		url: `${base_url}Contrato/getAllContrato`,
		 		dataSrc: "",
		 	},
		 	columns: [
		 		{data: "nomcliente"},
		 		{data: "periodofactura"},
		 		{data: "moneda"},
		 		{data: "estado"},
		 		{data: "options" }
		 	],
        dom: "Bfrtip",
        buttons: {
          buttons: [
            {
              extend: "collection",
	          text: "<i class='fa fa-download'></i>",
              className: 'btn-info btn-sm',
              buttons: [
                {
          			text: "<i class='fas fa-copy'>Copiar</i>",
                	extend: "copyHtml5",
            	},
                {
          			text: "<i class='far fa-file-excel'> Excel</i>",
                	extend: "excelHtml5",
                	exportOptions: { 
					columns: [ 0, 1, 2, 3 ] }

            	},
                {
          			text: "<i class='fas fa-file-pdf'> PDF</i>",
                	extend: "pdfHtml5",
	              	orientation: "portrait",
                  	pageSize: "A4",
                  	title: "Users List PDF",
                  	exportOptions: {
                  		columns: [ 0, 1, 2, 3 ],
	                    modifier: {
	                      page: "current",
	                    },
                  },
                },
              ],
            },
           {
	          extend: "colvis",
	          text: "<i class='fa fa-eye-slash'></i>",
	          titleAttr: "Ver",
	          className: "btn btn-info btn-sm",
        	},
          ],
        },
	 });
	}, 
	false
	)

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
							document.getElementById("resultHtml").innerHTML = data;
			    }
			  })
	}catch(err){
		console.log(err);
	}
}

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
		 					$('#buscaClienteModal').modal('hide');
				    }
				  })
			}catch(err){
			console.log(err);
		}
};



async function saveContrato(){
	event.preventDefault();
	let frmDatosContrato = new FormData(document.querySelector("#frmDatosContrato"));
	try{
		const url = `${base_url}contrato/save`;
		const respuesta = await fetch(url,{
			method: "POST",
			body: frmDatosContrato,
		});
		const resultado = await respuesta.json();
		if(resultado.status == true){
			Swal.fire({
			  text: "Contrato creado con exito!",
			  icon: 'success',
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Aceptar'
			}).then((result) => {
			  
			})
		}else if (resultado.status == 'activo_vigente'){
			Swal.fire({
			  title: 'Error:',
			  text: "Existe un contrato en estado Activo y Vigente ",
			  icon: 'error',
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Aceptar'
			}).then((result) => {
			  if (result.isConfirmed) {
			  	$('#txt_idecliente').focus()
			  }
			})
		}else if (resultado.status == "activo"){	
			Swal.fire({
			  title: 'Contrato Activo',
			  text: "Atención: Existe un contrato en estado Activo",
			  icon: 'error',
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Aceptar'
			}).then((result) => {
			  if (result.isConfirmed) {
			  	$('#txt_idecliente').focus()
			  }
			})
		}else if (resultado.status == "vigente"){	
			Swal.fire({
			  title: 'Contrato Vigente',
			  text: "Atención: Existe un contrato Vigente",
			  icon: 'error',
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Aceptar'
			}).then((result) => {
			  if (result.isConfirmed) {
			  	$('#txt_idecliente').focus()
			  }
			})
		}else if (resultado.status == "cliente_noexiste"){	
			Swal.fire({
			  title: 'Cliente no existe',
			  text: "Atención: El cliente no existe",
			  icon: 'error',
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Aceptar'
			}).then((result) => {
			  if (result.isConfirmed) {
			  	$('#txt_idecliente').focus()
			  }
			})
		}

		if(resultado.errorvalida == true){
  			toastr.error(resultado.msg);
		}
	}catch(err){
		console.log(err);
	}
}



$(document).on('click', '.buscaCliente', function(){
    $('#buscaClienteModal').modal('show');
	document.getElementById("resultHtml").innerHTML = "";
	$('#frmBuscaCliente')[0].reset();
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Busca Cliente");
});