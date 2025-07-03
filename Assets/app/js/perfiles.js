document.addEventListener("DOMContentLoaded",
    function(){
       tblPerfiles = $('#tblPerfiles').DataTable( {
        select: true,
        paging: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
        },
            ajax : {
                url: `${base_url}perfiles/getAllPerfiles`,
                dataSrc: "",
            },
            columns: [
                {data: "id"},
                {data: "nomperfil"},
                {data: "estado"},
                {data: "options" }
            ],

         });
    }, 
    false
    )

$(document).ready(function() {
	const idPerfil = $("#txt_idperfil").val(); 
	tblPerfilesdet = $('#tblPerfilesdet').DataTable({
		"processing": false,
		"serverSide": false,
		"ajax": {
			"url": `${base_url}perfiles/getAllModulosPerfil/${idPerfil}`,
			"type": "GET",
			"dataSrc": function(json) {
				return json;
			}
		},
         "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
         },
         "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "Todos"]],
		"pageLength": 100, // Valor por defecto
		"columns": [
			{ "data": "ID" },
			{ "data": "NOMBRE" },
			{ "data": "C" },
			{ "data": "R" },
			{ "data": "U" },
			{ "data": "D" }
		]
	});
});


$(document).on('change', '#tblPerfilesdet input[type="checkbox"]', function (event) {
    const checkbox = event.target;
    const idPerfil = document.getElementById("txt_idperfil").value;
    const idModulo = checkbox.getAttribute("data-modulo");
    const action = checkbox.getAttribute("data-action");
    const state = checkbox.checked ? 1 : 0;
    $.ajax({
        url: `${base_url}perfiles/actualizarPermiso`,
        method: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            idPerfil: idPerfil,
            idModulo: idModulo,
            action: action,
            state: state
        }),
        success: function (response) {
            if (response.success) {
                toastr.success('Permiso actualizado correctamente.');
                tblPerfilesdet.ajax.reload(null, false);
            } else {
                console.error("Error actualizando permiso:", response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });
});


async function procesar(){
    event.preventDefault();
    let frmPerfil = new FormData(document.querySelector("#frmPerfil"));
    try{
        const url = `${base_url}perfiles/procesar`;
        const respuesta = await fetch(url,{
            method: "POST",
            body: frmPerfil,
        });
        const resultado = await respuesta.json();
            if(resultado.status == "save_ok"){
                toastr.success('Perfil creado con exito!');
                $('#perfilModal').modal('hide');
                tblPerfiles.ajax.reload(null, false);
            }else if(resultado.status == "update_ok"){
                toastr.success('Perfil actualizado con exito!');
                $('#perfilModal').modal('hide');
                tblPerfiles.ajax.reload(null, false);
             }else if(resultado.status == "perfil_existe"){
                toastr.error('Atención: Nombre de perfil ya existe');
            }else{
                toastr.error('Atención: Se ha presentado un error. Contacte al Administrador');
            }

        if(resultado.errorvalida == true){
            toastr.error(resultado.msg);
        }
    }catch(err){
        console.log(err);
    }
}

async function editNomPerfil(idperfil){
    event.preventDefault();
    try{
		const url = `${base_url}perfiles/verPerfil`;
		 $.ajax({
				url:url,
			    method:"POST",
			    data:{idperfil:idperfil},
			    dataType:"json",
			    success:function(data){
			    	$('#perfilModal').modal('show');
    				$(".modal-header").css("background-color", "#17a2b8");
    				$(".modal-header").css("color", "white" );
    				$(".modal-title").text("Editar perfil");
    				$("#txt_nomperfil").val(data.NOMBRE);
    				$("#sel_estado").val(data.ESTADO);
    				$("#operation").val("Edit");
   		 			$("#idperfil").val(idperfil);
			    }
			  })
	}catch(err){
		console.log(err);
	}
}

function deletePerfil(dataPerfilString){
  const dataPerfil = JSON.parse(dataPerfilString);
	Swal.fire({
  			title: 	'Eliminar Perfil',
            html:   `Confirma que desea eliminar el perfil <b>${capitalizarTexto(dataPerfil.NOMPERFIL)}</b>`,
  			icon: 	'question',
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
        	    $('#ideliminacion').val(dataPerfil.ID);
        	    $(document).on('submit', '#frmElimina', function(event){
    			event.preventDefault();
                    $.ajax({
                        url:`${base_url}perfiles/eliminarPerfil`,
                        method:"POST",
                        data:$('#frmElimina').serialize(),
                        dataType:"json",
                        success:function(data){
                        if(data.status=="delete_ok"){
                            toastr.success('Perfil eliminado con exito')
                            $('#motivoElimina').modal('hide');
                            $('#frmElimina')[0].reset();
                            tblPerfiles.ajax.reload(null, false);
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

function capitalizarTexto(texto) {
    return texto
        .toLowerCase()
        .split(' ')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
}
$(document).on('click', '.perfilModal', function(){
    $('#perfilModal').modal('show');
    $('#frmPerfil')[0].reset();
    $('#operation').val('Add');
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Nuevo Perfil");
});


async function buscanombre(id){
    var resultado = '';
    const url = `${base_url}perfiles/getOnePerfil`;
    await $.ajax({
        url:url,
        method:"POST",
        data:{id:id},
        dataType:"json",
        success(data){
            resultado =  data.NOMPERFIL;
      }
    });
  return resultado;    
}



