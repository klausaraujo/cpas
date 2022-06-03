function fuente(URI) {

	setTimeout(function () { $(".alert").slideUp(); }, 3000);

	$(document).ready(function () {

		var table = $('#tbLista').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "Evento_Fuente_Codigo" },
				{ "data": "Evento_Fuente_Descripcion" },
				{ "data": "editar" },
				{ "data": "eliminar" }
			],
			"order": [[0, "asc"]],
			buttons: [
				{ extend: 'copy', title: 'Lista Eventos Fuente' },
				{ extend: 'csv', title: 'Lista Eventos Fuente' },
				{ extend: 'excel', title: 'Lista Eventos Fuente' },
				{ extend: 'pdf', title: 'Lista Eventos Fuente', orientation: 'portrait' },

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
				Evento_Fuente_Descripcion: { required: true }
			},
			messages: {
				Evento_Fuente_Descripcion: { required: "Dato requerido" }
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
			$("#formRegistrar input[name=Evento_Fuente_Codigo]").val(datos.Evento_Fuente_Codigo);
			$("#formRegistrar input[name=Evento_Fuente_Descripcion]").val(datos.Evento_Fuente_Descripcion);

		});

		$('body').on('click', 'td .actionDelete', function () {
			var tr = $(this).parents('tr');

			var row = table.row(tr);
			var datos = row.data();

			$("#deleteModal").modal("show");
			$("#formEliminar input[name=Evento_Fuente_Codigo]").val(datos.Evento_Fuente_Codigo);
			$("#elementoEliminar").text(datos.Evento_Fuente_Descripcion);

		});

	});

}