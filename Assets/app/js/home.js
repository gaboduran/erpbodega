async function seleccionaBodega(){
	event.preventDefault();
	idbodega = $('#sel_bodega').val();
	try{
	const url = `${base_url}home/sesionBodega`;
	 $.ajax({
		url:url,
	    method:"POST",
		dataType: "json",
	    data:{idbodega:idbodega},
	    success:function(data){
			window.location.href = data.url;
	    }
		});
	}catch(err){
		console.log(err);
	}
}