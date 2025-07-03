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