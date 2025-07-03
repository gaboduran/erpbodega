$(document).ready(function(){
    $('#listcomponente').multiselect();
  });


$('#sel_componente').change(function() {
	event.preventDefault();
	let componente = $("#sel_componente").val();
		try{
		 $.ajax({
				url:`${base_url}Componentedano/getComponente`,
			    method:"POST",
			    data:{componente:componente},
			    success:function(data){
					$("#listcomponente").html(data);
				}
			  })
			  $.ajax({
				url:`${base_url}Componentedano/getComponenteAsig`,
			    method:"POST",
			    data:{componente:componente},
			    success:function(data){
					$("#listcomponente_to").html(data);
				}
			  })
	}catch(err){
		console.log(err);
	}
 });

 async function procesar(){
	event.preventDefault();
	$('#listcomponente_to option').prop("selected", "");
	$('#listcomponente_to option').prop("selected", "selected");
	valida = $("#frmComponentedano").valid();
	if (valida == true){
		let frmComponentedano = new FormData(document.querySelector("#frmComponentedano"));
		try{
			const url = `${base_url}Componentedano/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmComponentedano,

			});
			const resultado = await respuesta.json();
			if(resultado.status == 'save_ok'){
				toastr.success('Relacion establecida con exito');
				$("#sel_componente").select2({dropdownParent: $('#localizaModal')}).val("").trigger("change");

				$("#listcomponente_to").html(data);
				$("#listcomponente").html(data);
			}	
			if(resultado.errorvalida == true){
	  			toastr.error(resultado.msg);
			}
		}catch(err){
			console.log(err);
		}
	}
}


$(function () {
    $('.select2').select2()

})