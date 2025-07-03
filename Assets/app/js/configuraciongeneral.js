async function procesarTaller1() {
	event.preventDefault();
	
	let frmsecTaller = new FormData(document.querySelector("#frmsecTaller"));
	try {
		const url = `${base_url}configuraciongeneral/seccionTaller`;
		const respuesta = await fetch(url, {
			method: "POST",
			body: frmsecTaller,
		});
		console.log(respuesta.info);

	} catch (err) {
		console.log(err);
	}

}


async function procesarTaller(){
	event.preventDefault();
		try{
			const url = `${base_url}configuraciongeneral/seccionTaller`;
			$.ajax({
				url:url,
			    method:"POST",
			    dataType:"json",
				data:$('#frmsecTaller').serialize(),
			    success:function(data){
			    	console.log(data)
			    }
			  })
	}catch(err){
		console.log(err);
	}
}
