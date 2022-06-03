function tipoAccion(URI) {

	setTimeout(function () { $(".alert").slideUp(); }, 3000);

	$(document).ready(function () {

		var table = $('#tbLista').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "Tipo_Accion_Codigo" },
				{ "data": "Tipo_Accion_Descripcion" },
				{ "data": "editar" },
				{ "data": "eliminar" }
			],
			"order": [[0, "asc"]],
			buttons: [
				{ extend: 'copy', title: 'Lista Tipo Acción' },
				{ extend: 'csv', title: 'Lista Tipo Acción' },
				{ extend: 'excel', title: 'Lista Tipo Acción' },
				{ extend: 'pdf', title: 'Lista Tipo Acción', orientation: 'portrait' },

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
				Tipo_Accion_Descripcion: { required: true }
			},
			messages: {
				Tipo_Accion_Descripcion: { required: "Dato requerido" }
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
			$("#formRegistrar input[name=Tipo_Accion_Codigo]").val(datos.Tipo_Accion_Codigo);
			$("#formRegistrar input[name=Tipo_Accion_Descripcion]").val(datos.Tipo_Accion_Descripcion);

		});

		$('body').on('click', 'td .actionDelete', function () {
			var tr = $(this).parents('tr');

			var row = table.row(tr);
			var datos = row.data();

			$("#deleteModal").modal("show");
			$("#formEliminar input[name=Tipo_Accion_Codigo]").val(datos.Tipo_Accion_Codigo);
			$("#elementoEliminar").text(datos.Tipo_Accion_Descripcion);

		});

	});

}