function eventos(URI) {

	setTimeout(function () { $(".alert").slideUp(); }, 3000);

	$(document).ready(function () {

		var table = $('#tbLista').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "Evento_Tipo_Nombre" },
				{ "data": "Evento_Codigo" },
				{ "data": "Evento_Nombre" },
				{ "data": "editar" },
				{ "data": "eliminar" },
				{ "data": "Evento_Tipo_Codigo" }
			],
			columnDefs: [{
				"targets": [5],
				"visible": false,
				"searchable": false
			}],
			"order": [[0, "asc"], [1, "asc"]],
			buttons: [
				{ extend: 'copy', title: 'Lista Eventos' },
				{ extend: 'csv', title: 'Lista Eventos' },
				{ extend: 'excel', title: 'Lista Eventos' },
				{ extend: 'pdf', title: 'Lista Eventos', orientation: 'landscape' },

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
				Evento_Tipo_Codigo: { required: true },
				Evento_Nombre: { required: true }
			},
			messages: {
				Evento_Tipo_Codigo: { required: "Dato requerido" },
				Evento_Nombre: { required: "(*) Campo Requerido" }
			}
		});

		$("#btn-crear").on('click', function () {
			$("#registrarModal").modal("show");
			$("select[name=Codigo_Tipo_Evento]").val("")
			$("#formRegistrar select[name=Codigo_Tipo_Evento]").removeAttr("disabled");
			$("#formRegistrar")[0].reset();

		});

		$('body').on('click', 'td .actionEdit', function () {
			var tr = $(this).parents('tr');

			var row = table.row(tr);
			var datos = row.data();

			$("#registrarModal").modal("show");
			$("#formRegistrar input[name=Evento_Tipo_Codigo]").val(datos.Evento_Tipo_Codigo);
			$("#formRegistrar select[name=Codigo_Tipo_Evento]").val(datos.Evento_Tipo_Codigo);
			$("#formRegistrar select[name=Codigo_Tipo_Evento]").attr("disabled", "disabled");
			$("#formRegistrar input[name=Evento_Codigo]").val(datos.Evento_Codigo);
			$("#formRegistrar input[name=Evento_Nombre]").val(datos.Evento_Nombre);

		});

		$('body').on('click', 'td .actionDelete', function () {
			var tr = $(this).parents('tr');

			var row = table.row(tr);
			var datos = row.data();

			$("#deleteModal").modal("show");
			console.log("datos.Evento_Tipo_Codigo", datos.Evento_Tipo_Codigo);
			$("#formEliminar input[name=Evento_Tipo_Codigo]").val(datos.Evento_Tipo_Codigo);
			$("#formEliminar input[name=Evento_Codigo]").val(datos.Evento_Codigo);
			$("#elementoEliminar").text(datos.Evento_Nombre);

		});

	});

}