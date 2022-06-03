function eventosDetalle(URI) {

	setTimeout(function () { $(".alert").slideUp(); }, 3000);

	function cargarEvento(id, selected) {
		if (id.length > 0) {

			$.ajax({
				data: { tipoEvento: id },
				url: URI + "tablas/main/cargarEvento",
				method: "POST",
				dataType: "json",
				beforeSend: function () {
					$("select[name=Codigo_Evento]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					var $html = '<option value="">--Seleccione--</option>';
					$.each(data, function (i, e) {
						if (selected === e.Evento_Codigo) {
							$html += '<option value="' + e.Evento_Codigo + '" selected>' + e.Evento_Nombre + '</option>';
						} else {
							$html += '<option value="' + e.Evento_Codigo + '">' + e.Evento_Nombre + '</option>';
						}

					});
					$("select[name=Codigo_Evento]").html($html);
					if (selected.length > 1) {
						$("#formRegistrar select[name=Codigo_Evento]").attr("disabled", "disabled");
					}

				}
			});

		}
	}

	$(document).ready(function () {

		var table = $('#tbLista').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "Evento_Tipo_Nombre" },
				{ "data": "Evento_Nombre" },
				{ "data": "Evento_Detalle_Codigo" },
				{ "data": "Evento_Detalle_Nombre" },
				{ "data": "editar" },
				{ "data": "eliminar" },
				{ "data": "Evento_Tipo_Codigo" },
				{ "data": "Evento_Codigo" }
			],
			columnDefs: [{
				"targets": [6, 7],
				"visible": false,
				"searchable": false
			}],
			"order": [[0, "asc"], [1, "asc"], [2, "asc"]],
			buttons: [
				{ extend: 'copy', title: 'Lista Eventos Detalle' },
				{ extend: 'csv', title: 'Lista Eventos Detalle' },
				{ extend: 'excel', title: 'Lista Eventos Detalle' },
				{ extend: 'pdf', title: 'Lista Eventos Detalle', orientation: 'landscape' },

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
				Evento_Codigo: { required: true },
				Evento_Nombre: { required: true }
			},
			messages: {
				Evento_Tipo_Codigo: { required: "Dato requerido" },
				Evento_Codigo: { required: "Dato requerido" },
				Evento_Nombre: { required: "(*) Campo Requerido" }
			}
		});

		$("select[name=Codigo_Tipo_Evento]").change(function () {

			id = $(this).val();
			cargarEvento(id, "0");
		});

		$("#btn-crear").on('click', function () {
			$("#registrarModal").modal("show");
			$("select[name=Codigo_Tipo_Evento]").val("");
			$("#formRegistrar select[name=Codigo_Tipo_Evento]").removeAttr("disabled");
			$("#formRegistrar select[name=Codigo_Evento]").removeAttr("disabled");
			$("select[name=Codigo_Evento]").html('<option value="">[Seleccione Tipo Evento]</option>');
			$("#formRegistrar")[0].reset();

		});

		$('body').on('click', 'td .actionEdit', function () {
			var tr = $(this).parents('tr');

			var row = table.row(tr);
			var datos = row.data();

			$("#registrarModal").modal("show");
			$("#formRegistrar input[name=Evento_Detalle_Codigo]").val(datos.Evento_Detalle_Codigo);
			$("#formRegistrar input[name=Evento_Tipo_Codigo]").val(datos.Evento_Tipo_Codigo);
			$("#formRegistrar input[name=Evento_Codigo]").val(datos.Evento_Codigo);
			$("#formRegistrar select[name=Codigo_Tipo_Evento]").val(datos.Evento_Tipo_Codigo);
			$("#formRegistrar select[name=Codigo_Tipo_Evento]").attr("disabled", "disabled");
			cargarEvento(datos.Evento_Tipo_Codigo, datos.Evento_Codigo);
			$("#formRegistrar input[name=Evento_Detalle_Nombre]").val(datos.Evento_Detalle_Nombre);

		});

		$('body').on('click', 'td .actionDelete', function () {
			var tr = $(this).parents('tr');

			var row = table.row(tr);
			var datos = row.data();

			$("#deleteModal").modal("show");

			$("#formEliminar input[name=Evento_Tipo_Codigo]").val(datos.Evento_Tipo_Codigo);
			$("#formEliminar input[name=Evento_Codigo]").val(datos.Evento_Codigo);
			$("#formEliminar input[name=Evento_Detalle_Codigo]").val(datos.Evento_Detalle_Codigo);
			$("#elementoEliminar").text(datos.Evento_Detalle_Nombre);

		});

		$("select[name=Codigo_Evento]").change(function () {

			id = $(this).val();
			$("#formRegistrar input[name=Evento_Codigo]").val(id);
		});

	});

}