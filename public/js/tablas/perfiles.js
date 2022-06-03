function perfiles(URI) {

	setTimeout(function () { $(".alert").slideUp(); }, 3000);

	$(document).ready(function () {

		var table = $('#tbLista').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "Codigo_Perfil" },
				{ "data": "Descripcion_Perfil" },
				{ "data": "editar" },
				{ "data": "eliminar" }
			],
			"order": [[0, "asc"]],
			buttons: [
				{ extend: 'copy', title: 'Lista Perfil' },
				{ extend: 'csv', title: 'Lista Perfil' },
				{ extend: 'excel', title: 'Lista Perfil' },
				{ extend: 'pdf', title: 'Lista Perfil', orientation: 'portrait' },

				{
					extend: 'print',
					title: 'Imprimir',
					customize: function (
						win) {
						$(win.document.body).addClass('white-bg');
						$(win.document.body).css('font-size', '10px');

						$(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
					}
				}]

		});

		$("#formRegistrar").validate({
			rules: {
				Descripcion_Perfil: { required: true }
			},
			messages: {
				Descripcion_Perfil: { required: "Dato requerido" }
			}
		});

		$("#btn-crear").on('click', function () {
			$("#registrarModal").modal("show");
			$("#formRegistrar")[0].reset();

		});

		$('body').on('click', 'td .actionEdit', function () {
			var tr = $(this).parents('tr');

			var row = table.row(tr);
			var datos = row.data();

			$("#registrarModal").modal("show");
			$("#formRegistrar input[name=Codigo_Perfil]").val(datos.Codigo_Perfil);
			$("#formRegistrar input[name=Descripcion_Perfil]").val(datos.Descripcion_Perfil);

		});

		$('body').on('click', 'td .actionDelete', function () {
			var tr = $(this).parents('tr');

			var row = table.row(tr);
			var datos = row.data();

			$("#deleteModal").modal("show");
			$("#formEliminar input[name=Codigo_Perfil]").val(datos.Codigo_Perfil);
			$("#elementoEliminar").text(datos.Descripcion_Perfil);

		});

	});

}