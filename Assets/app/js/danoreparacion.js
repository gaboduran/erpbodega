$(document).ready(function(){
    $('#listrepara').multiselect();
  });


$('#sel_dano').change(function() {
	event.preventDefault();
	let dano = $("#sel_dano").val();
		try{
		 $.ajax({
				url:`${base_url}Danoreparacion/getReparaDisponible`,
			    method:"POST",
			    data:{dano:dano},
			    success:function(data){
					$("#listrepara").html(data);
				}
			  })
			  $.ajax({
				url:`${base_url}Danoreparacion/getReparaAsig`,
			    method:"POST",
			    data:{dano:dano},
			    success:function(data){
					$("#listrepara_to").html(data);
				}
			  })
	}catch(err){
		console.log(err);
	}
 });

 async function procesar(){
	event.preventDefault();
	$('#listrepara_to option').prop("selected", "");
	$('#listrepara_to option').prop("selected", "selected");
	valida = $("#frmDanoReparacion").valid();
	if (valida == true){
		let frmDanoReparacion = new FormData(document.querySelector("#frmDanoReparacion"));
		try{
			const url = `${base_url}Danoreparacion/procesar`;
			const respuesta = await fetch(url,{
				method: "POST",
				body: frmDanoReparacion,
			});
			const resultado = await respuesta.json();
			if(resultado.status == 'save_ok'){
				toastr.success('Relacion establecida con exito');
				$("#listrepara_to").html(data);
				$("#listrepara").html(data);
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