function perfilesModulo(URI) {

	setTimeout(function () { $(".alert").slideUp(); }, 3000);

	$(document).ready(function () {

		var table = $('#tbLista').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "Descripcion_Perfil" },
				{ "data": "idmodulorol" },
				{ "data": "descripcion" },
				{ "data": "editar" },
				{ "data": "eliminar" },
				{ "data": "Codigo_Perfil" },
				{ "data": "idmodulo" }
			],
			columnDefs: [{
				"targets": [5,6],
				"visible": false,
				"searchable": false
			}],
			"order": [[0, "asc"], [1, "asc"]],
			buttons: [
				{ extend: 'copy', title: 'Lista Módulos por Perfil' },
				{ extend: 'csv', title: 'Lista Módulos por Perfil' },
				{ extend: 'excel', title: 'Lista Módulos por Perfil' },
				{ extend: 'pdf', title: 'Lista Módulos por Perfil', orientation: 'landscape' },

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
			console.log("ingrese a boton crear");
			$("#registrarModal").modal("show");
			$("select[name=Codigo_Perfil]").val("")
			$("#formRegistrar select[name=Codigo_Perfil]").removeClass("pointer-events-none");
			$("#formRegistrar")[0].reset();

		});

		$('body').on('click', 'td .actionEdit', function () {
			var tr = $(this).parents('tr');

			var row = table.row(tr);
			var datos = row.data();

			console.log(datos);

			$("#registrarModal").modal("show");

			$("#formRegistrar select[name=Codigo_Perfil]").val(datos.Codigo_Perfil);
			$("#formRegistrar select[name=Codigo_Perfil]").addClass("pointer-events-none");
			$("#formRegistrar select[name=idmodulo]").val(datos.idmodulo);
			$("#formRegistrar input[name=idmodulorol]").val(datos.idmodulorol);

		});

		$('body').on('click', 'td .actionDelete', function () {
			var tr = $(this).parents('tr');

			var row = table.row(tr);
			var datos = row.data();

			console.log(datos);

			$("#deleteModal").modal("show");
			$("#formEliminar input[name=idmodulorol]").val(datos.idmodulorol);
			//$("#formEliminar input[name=Tipo_Accion_Entidad_Codigo]").val(datos.Tipo_Accion_Entidad_Codigo);
			$("#elementoEliminar").text(datos.descripcion);

		});

	});

}