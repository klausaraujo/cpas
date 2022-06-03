function listaEventos(URI) {

	setTimeout(function () {
		$(".alert").slideUp();
	}, 3500);

	function post(path, params, method) {
		method = method || "post";

		var form = document.createElement("form");
		form.setAttribute("method", method);
		form.setAttribute("action", path);

		for (var key in params) {
			if (params.hasOwnProperty(key)) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", key);
				hiddenField.setAttribute("value", params[key]);

				form.appendChild(hiddenField);
			}
		}

		document.body.appendChild(form);
		form.submit();
	}

	$(document).ready(function () {

		var tableEventosModal = $('.tableEventos').DataTable({
			"length": 25,
			columns: [
				{ "data": "correlativo" },
				{ "data": "evento" },
				{ "data": "fecha" },
				{ "data": "ubicacion" },
				{ "data": "estado" },
				{ "data": "seleccionar" },
				{ "data": "orden" }
			],
			columnDefs: [{
				"targets": [6],
				"visible": false,
				"searchable": false
			}],
			"order": [[6, "asc"]],
			"ajax": {
				url: URI + "ofertamovil/main/eventosAjax",
				type: "POST",
				data: function (d) {
					d.Anio_Ejecucion = document.getElementById("Anio_Ejecucion").value,
						d.mes = document.getElementById("mes").value
				}
			}

		});

		var table = $('.tbLista').DataTable({
			"lengthMenu": [[25, 50, 100, -1,], [25, 50, 100, "Todos"]],
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "correlativo" },
				{ "data": "evento" },
				{ "data": "fecha" },
				{ "data": "ubicacion" },
				{ "data": "fichas" },
				{ "data": "oferta_movil" },
				{ "data": "estado" },
				{ "data": "Evento_Registro_Numero" },
				{ "data": "orden" },
				{ "data": "Evento_Estado_Codigo" }
			],
			columnDefs: [{
				"targets": [7, 8, 9],
				"visible": false,
				"searchable": false
			}],
			"order": [[8, "asc"]],
			buttons: [
				{
					extend: 'copy',
					title: 'lista-Eventos',
					exportOptions: { columns: [0, 1, 2, 3, 11, 14, 15, 16, 17, 18] },
				},
				{
					extend: 'csv',
					title: 'lista Eventos',
					exportOptions: { columns: [0, 1, 2, 3, 11, 14, 15, 16, 17, 18] },
				},
				{
					extend: 'excel',
					title: 'lista Eventos',
					exportOptions: { columns: [0, 1, 2, 3, 11, 14, 15, 16, 17, 18] },
				},
				{
					extend: 'pdf',
					title: 'lista Eventos',
					orientation: 'landscape',
					exportOptions: { columns: [0, 1, 2, 3, 11, 14, 15, 16, 17, 18] },
				},

				{
					extend: 'print',
					title: 'lista Eventos',
					exportOptions: { columns: [0, 1, 2, 3, 11] },
					customize: function (win) {
						$(win.document.body).addClass('white-bg');
						$(win.document.body).css('font-size', '10px');

						$(win.document.body).find('table')
							.addClass('compact')
							.css('font-size', 'inherit');

						var css = '@page { size: landscape; }',
							head = win.document.head || win.document.getElementsByTagName('head')[0],
							style = win.document.createElement('style');

						style.type = 'text/css';
						style.media = 'print';

						if (style.styleSheet) {
							style.styleSheet.cssText = css;
						}
						else {
							style.appendChild(win.document.createTextNode(css));
						}

						head.appendChild(style);
					}
				}
			]

		});

		$("#Anio_Ejecucion, #mes").on("change", function () {

			tableEventosModal.ajax.reload();

		});

		$('body').on('click', 'td i.fichaAtencion', function () {

			var code = $(this).attr('rel');
			location.href = URI + "ofertamovil/fichas/lista/" + code;
		});

		$('body').on('click', 'td i.ofertaMovil', function () {

			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			data = row.data();

			var Evento_Registro_Numero = data.Evento_Registro_Numero;
			$("#ofertaMovilModal").modal("show");
			$("#ofertaMovilModal").find("#Evento_Registro_Numero").val(Evento_Registro_Numero);

			$.ajax({
				type: "POST",
				url: URI + "ofertamovil/main/EventoTipoEntidadAtencionOfertaMovilLista",
				data: { Evento_Registro_Numero: Evento_Registro_Numero },
				dataType: "json",
				beforeSend: function () {
					$("#tableOfertaMovil tbody").html("<tr><td>Cargando...</td></tr>");
				},
				success: function (data) {

					var html = "";
					var count = 0;

					$.each(data.lista, function (i, e) {
						count++;
						html += '<tr><td class="text-center">' + e.Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre + '</td><td class="text-center">' + e.Evento_Tipo_Entidad_Atencion_Nombre + '</td><td class="delete" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
					});

					if (count == 0) html = "<tr class='sin-registros'><td colspan='3' class='text-center'>No hay registros</td></tr>";

					$("#tableOfertaMovil tbody").html(html);
				}
			});

		});

	});

	$("#formRegistrarOfertaMovil").validate({
		rules: {
			Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre: { required: true },
			Evento_Tipo_Entidad_Atencion_ID: { required: true }
		},
		messages: {
			Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre: { required: "(*) Campo Requerido" },
			Evento_Tipo_Entidad_Atencion_ID: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "ofertamovil/main/EventoTipoEntidadAtencionOfertaMovilRegistrar",
				data: $("#formRegistrarOfertaMovil").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#formRegistrarOfertaMovil button[type=submit]").text("Agregando...");
					$("#formRegistrarOfertaMovil button").addClass("disabled");
				},
				success: function (data) {

					$("#formRegistrarOfertaMovil button[type=submit]").text("Agregar");
					$("#formRegistrarOfertaMovil button").removeClass("disabled");

					var html = "";
					var count = 0;

					sinRegistros = $("#tableOfertaMovil tbody tr.sin-registros").length;

					if (parseInt(data.status) == 200) {

						if (parseInt(data.id) > 0) {

							if (parseInt(sinRegistros) > 0) {
								html = '<tr><td class="text-center">' + $("#formRegistrarOfertaMovil").find("input[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre]").val() + '</td>';
								html += '<td class="text-center">' + $("#formRegistrarOfertaMovil").find("select option:selected").text() + '</td><td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
							}
							else {
								html = $("#tableOfertaMovil tbody").html();
								html += '<tr><td class="text-center">' + $("#formRegistrarOfertaMovil").find("input[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre]").val() + '</td>';
								html += '<td class="text-center">' + $("#formRegistrarOfertaMovil").find("select option:selected").text() + '</td><td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
							}

							$("#formRegistrarOfertaMovil")[0].reset();

						}

						$("#tableOfertaMovil tbody").html(html);

					}
					else {
						$("#duplicate_movil").removeClass("hide");
						setTimeout(function () {
							$("#duplicate_movil").addClass("hide");
						}, 2000);
					}

				}
			});
		}
	});

	$("html").on("click", "#formRegistrarOfertaMovil table tr td.delete", function () {

		var id = $(this).attr("rel");
		$("#deleteOfertaMovilModal").modal("show");
		$("#deleteOfertaMovilModal").find("input[name=id]").val(id);

	});

	$("#deleteOfertaMovilForm").validate({

		rules: {
			id: { required: true }
		},
		messages: {
			id: { required: "(*) Campo Requerido" }
		}

	});

}