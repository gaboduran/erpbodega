
document.addEventListener("DOMContentLoaded",
	function () {
		tblPosicion = $('#tblPosicion').DataTable({
			"bProcessing": true,
			"serverSide": true,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			},
			ajax: {
				url: `${base_url}Posicion/getAllPosicion`,
			},
			columns: [
				{ data: "id" },
				{data: "letra"},
		 		{data: "nombrein"},
		 		{data: "nombresp"},
		 		{data: "caracter"},
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



$('#sel_perfil').change(function() {
	event.preventDefault();
	let idperfil = $("#sel_perfil").val();

	alert('el perfil es: ' + idperfil);

 });