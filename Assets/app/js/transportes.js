document.addEventListener("DOMContentLoaded",
	function () {
		tblEmpresas = $('#tblEmpresas').DataTable({
			select: {
				style: 'single'
			},
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}transportes/getAllEmpresas`,
			},
			columns: [
				{ data: "id" },
				{ data: "tipodoc" },
				{ data: "nombre" },
				{ data: "nomciudad" },
				{ data: "estado" },
				{ data: "options" }
			],
			"columnDefs": [{
				"targets": [0],
				"visible": false
			}]

		});
	},
	false
)

async function editar(id) {
	event.preventDefault();
	$("#sel_tipodoc").removeClass("is-invalid");
	$("#txt_nroide").removeClass("is-invalid");
	$("#txt_nombre").removeClass("is-invalid");
	$("#txt_email").removeClass("is-invalid");
	$("#sel_ciudad").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	$("#sel_respofiscal").removeClass("is-invalid");
	$("#sel_regifiscal").removeClass("is-invalid");
	try {
		const url = `${base_url}transportes/editarEmpresa`;
		$.ajax({
			url: url,
			method: "POST",
			data: { id: id },
			dataType: "json",
			success: function (data) {
				$('#empresasModal').modal('show');
				$(".modal-header").css("background-color", "#17a2b8");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Empresa Transporte");
				$('#tarifas-tab').removeClass('disabled');
				$('#documentos-tab').removeClass('disabled');
				$("#myTab a:first").parent("li").show();
				$("#myTab a:first").tab('show');
				$("#txt_idtransporte").val(id);
				$("#operation").val("Edit");
				$("#sel_tipodoc").val(data.TIPODOC);
				$("#txt_nroide").val(data.NROIDE);
				$("#txt_nombre").val(data.NOMBRE);
				$("#txt_direccion").val(data.DIRECCION);
				$("#txt_contacto").val(data.CONTACTO);
				$("#txt_email").val(data.EMAIL);
				$("#txt_emailfe").val(data.EMAILFE);
				$("#txt_telefono").val(data.TELEFONO);
				$("#sel_ciudad").val(data.IDCIUDAD);
				$("#sel_estado").val(data.ESTADO);
				$("#sel_respofiscal").val(data.RESPOFISCAL);
				$("#sel_regifiscal").val(data.REGIFISCAL);
				getDetalledocumentos();

			}
		})
	} catch (err) {
		console.log(err);
	}
}

async function procesar() {
	event.preventDefault();
	var valida;
	valida = $("#frmEmpresas").valid();
	if (valida == true) {
		let frmEmpresas = new FormData(document.querySelector("#frmEmpresas"));
		try {
			const url = `${base_url}transportes/procesar`;
			const respuesta = await fetch(url, {
				method: "POST",
				body: frmEmpresas,
			});
			const resultado = await respuesta.json();
			if (resultado.status == 'save_ok') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Registro creado con exito!',
					showConfirmButton: false,
					timer: 1500
				});
				$("#txt_idtransporte").val(resultado.idtransporte);
				$("#operation").val("Edit");
				getDetalledocumentos();
				$('#tarifas-tab').removeClass('disabled');
				$('#documentos-tab').removeClass('disabled');
				tblEmpresas.ajax.reload(null, false);
			} else if (resultado.status == 'empresa_existe') {
				Swal.fire({
					icon: 'error',
					title: 'Atención:',
					text: 'Empresa transporte ya existe'
				});
			} else if (resultado.status == 'update_ok') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Actualización Exitosa!',
					showConfirmButton: false,
					timer: 1500
				});
				$("#operation").val("Edit");
				tblEmpresas.ajax.reload(null, false);
			} else if (resultado.status == "errorPDO") {
				toastr.error(resultado.msg);
			}
			if (resultado.errorvalida == true) {
				toastr.error(resultado.msg);
			}
		} catch (err) {
			console.log(err);
		}
	}
}

async function procesarContable() {
	event.preventDefault();
	
	var operation = $("#operation").val();
	var idtransporte = $("#txt_idtransporte").val();
	var respofiscal = $("#sel_respofiscal").val();
	var regifiscal = $("#sel_regifiscal").val();
	var emailfe = $("#txt_emailfe").val();
	var valida;
	valida = $("#frmContable").valid();
	if (valida == true) {
	try {
		const url = `${base_url}transportes/procesarContable`;
		$.ajax({
			url: url,
			method: "POST",
			data: { operation: operation, idtransporte: idtransporte, respofiscal: respofiscal, regifiscal: regifiscal, emailfe: emailfe },
			dataType: "json",
			success: function (data) {
				if (data.status == 'update_ok') {
					toastr.success('Registro procesado con exito!')
				}
			}
		})
	} catch (err) {
		console.log(err);
	}
}

}

async function getDetalledocumentos() {
	var idtransporte = $("#txt_idtransporte").val();
	try {
		const url = `${base_url}transportes/getDetalledocumentos`;
		$.ajax({
			url: url,
			method: "POST",
			data: { idtransporte: idtransporte },
			success: function (data) {
				document.getElementById("HTMLdetalleDocumentos").innerHTML = data;
			}
		})
	} catch (err) {
		console.log(err);
	}
}


function adjuntarDocumento(idtransporte, iddocumento) {
    var inputFile = $('<input type="file" accept=".pdf">');
    $("#iddocumento").val(iddocumento);
	var idproceso = 'emptransporte';
    inputFile.on('change', function () {
        var file = this.files[0];
        var nombreArchivo = 'transporte_' + idtransporte + '_' + iddocumento + '.pdf';
        var formData = new FormData();
        formData.append('file', file, nombreArchivo);
        formData.append('iddocumento', iddocumento);
        formData.append('idtransporte', idtransporte);
        formData.append('idproceso', idproceso);
        $.ajax({
            url: `${base_url}transportes/subirArchivo`,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {
				getDetalledocumentos();
              	toastr.success('Documento adjuntado con Extio');
            },
            error: function (error) {
                console.error('Error al adjuntar el documento', error);
            }
        });
    });
    inputFile.click();
}


function deleteDocumento(iddocumento){
	Swal.fire({
  			title: 	'Eliminar Documento',
  			text: 	"Confirma que desea eliminar el Documento seleccionado?",
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
        	$('#ideliminacion').val(iddocumento);
        		$(document).on('submit', '#frmElimina', function(event){
    				event.preventDefault();
    				 $.ajax({
					      url:`${base_url}transportes/eliminarDocumento`,
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
								getDetalledocumentos();
        						tblEmpresas.ajax.reload(null, false);
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

$(document).on('click', '#imprimir_listado', function (e) {
	Print_Report('Listado');
	e.preventDefault();
});


$(document).on('click', '.empresasModal', function () {
	$('#empresasModal').modal('show');
	$("#sel_tipodoc").removeClass("is-invalid");
	$("#txt_nroide").removeClass("is-invalid");
	$("#txt_nombre").removeClass("is-invalid");
	$("#txt_email").removeClass("is-invalid");
	$("#sel_ciudad").removeClass("is-invalid");
	$("#sel_estado").removeClass("is-invalid");
	$("#sel_respofiscal").removeClass("is-invalid");
	$("#sel_regifiscal").removeClass("is-invalid");
	validador.resetForm();
	$("#myTab a:first").parent("li").show();
	$("#myTab a:first").tab('show');
	$('#tarifas-tab').addClass('disabled');
	$('#documentos-tab').addClass('disabled');
	$('#frmEmpresas')[0].reset();
	$(".modal-header").css("background-color", "#17a2b8");
	$(".modal-header").css("color", "white");
	$(".modal-title").text("Nueva Empresa de Transporte");
	$("#operation").val("Add");
});


/*=================================================================================================================
=            									VALIDACION FORMULARIO CATEGORIA CONTENEDOR 							
==================================================================================================================*/
var validador = $('#frmEmpresas').validate({
	rules: {
		sel_tipodoc: {
			required: true,
		},
		txt_nroide: {
			required: true,
		},
		txt_nombre: {
			required: true,
		},
		txt_email: {
			required: true,
		},
		sel_ciudad: {
			required: true,
		},
		sel_estado: {
			required: true,
		},
	},
	messages: {
		sel_tipodoc: {
			required: "Tipo Doc requerido"

		},
		txt_nroide: {
			required: "Nro. Doc Requerido"
		},
		txt_nombre: {
			required: "Nombre empresa requerido"
		},
		txt_email: {
			required: "Email requerido"
		},
		sel_ciudad: {
			required: "Ciudad requerido"
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


var validador = $('#frmContable').validate({
	rules: {
		sel_respofiscal: {
			required: true,
		},
		sel_regifiscal: {
			required: true,
		},
	},
	messages: {
		sel_respofiscal: {
			required: "Responsabilidad Fiscal Requerida"

		},
		sel_regifiscal: {
			required: "Regimen Fiscal Requerida"
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