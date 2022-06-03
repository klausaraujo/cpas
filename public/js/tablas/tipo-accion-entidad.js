function tipoAccionEntidad(URI) {

	setTimeout(function () { $(".alert").slideUp(); }, 3000);

	$(document).ready(function () {

		var table = $('#tbLista').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "Tipo_Accion_Descripcion" },
				{ "data": "Tipo_Accion_Entidad_Codigo" },
				{ "data": "Tipo_Accion_Entidad_Nombre" },
				{ "data": "editar" },
				{ "data": "eliminar" },
				{ "data": "Tipo_Accion_Codigo" }
			],
			columnDefs: [{
				"targets": [5],
				"visible": false,
				"searchable": false
			}],
			"order": [[0, "asc"], [1, "asc"]],
			buttons: [
				{ extend: 'copy', title: 'Lista Tipo Acción Entidad' },
				{ extend: 'csv', title: 'Lista Tipo Acción Entidad' },
				{ extend: 'excel', title: 'Lista Tipo Acción Entidad' },
				{ extend: 'pdf', title: 'Lista Tipo Acción Entidad', orientation: 'landscape' },

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
				Tipo_Accion_Codigo: { required: true },
				Tipo_Accion_Entidad_Nombre: { required: true }
			},
			messages: {
				Tipo_Accion_Codigo: { required: "Dato requerido" },
				Tipo_Accion_Entidad_Nombre: { required: "(*) Campo Requerido" }
			}
		});

		$("#btn-crear").on('click', function () {
			$("#registrarModal").modal("show");
			$("select[name=Tipo_Accion_Codigo]").val("")
			$("#formRegistrar select[name=Tipo_Accion_Codigo]").removeClass("pointer-events-none");
			$("#formRegistrar")[0].reset();

		});

		$('body').on('click', 'td .actionEdit', function () {
			var tr = $(this).parents('tr');

			var row = table.row(tr);
			var datos = row.data();

			$("#registrarModal").modal("show");

			$("#formRegistrar select[name=Tipo_Accion_Codigo]").val(datos.Tipo_Accion_Codigo);
			$("#formRegistrar select[name=Tipo_Accion_Codigo]").addClass("pointer-events-none");
			$("#formRegistrar input[name=Tipo_Accion_Entidad_Codigo]").val(datos.Tipo_Accion_Entidad_Codigo);
			$("#formRegistrar input[name=Tipo_Accion_Entidad_Nombre]").val(datos.Tipo_Accion_Entidad_Nombre);

		});

		$('body').on('click', 'td .actionDelete', function () {
			var tr = $(this).parents('tr');

			var row = table.row(tr);
			var datos = row.data();

			$("#deleteModal").modal("show");
			$("#formEliminar input[name=Tipo_Accion_Codigo]").val(datos.Tipo_Accion_Codigo);
			$("#formEliminar input[name=Tipo_Accion_Entidad_Codigo]").val(datos.Tipo_Accion_Entidad_Codigo);
			$("#elementoEliminar").text(datos.Tipo_Accion_Entidad_Nombre);

		});

	});

}