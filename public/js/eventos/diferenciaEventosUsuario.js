function diferenciaEventosUsuario(URI) {
	$(document)
		.ready(
			function () {

				$(".agregar").on("click", function () {

					location.href = URI + "eventos/nuevo";

				});

				var table = $('.tbLista')
					.DataTable(
						{
							dom: '<"html5buttons"B>lTfgitp',
							columns: [
								{
									"data": "Codigo_Usuario"
								},
								{
									"data": "Usuario"
								},
								{
									"data": "Apellidos"
								},
								{
									"data": "Nombres"
								},
								{
									"data": "total"
								},
								{
									"data": "Codigo_Usuario"
								}],
							columnDefs: [{
								"targets": [1, 5],
								"visible": false,
								"searchable": false
							}],
							"order": [[0, "asc"]],
							buttons: [
								{
									extend: 'copy',
									title: 'Eventos usuario',
									exportOptions: {
										columns: [0, 2, 3, 4]
									}
								},
								{
									extend: 'csv',
									title: 'Eventos usuario',
									exportOptions: {
										columns: [0, 2, 3, 4]
									}
								},
								{
									extend: 'excel',
									title: 'Eventos usuario',
									exportOptions: {
										columns: [0, 2, 3, 4]
									}
								},
								{
									extend: 'pdf',
									title: 'Eventos usuario',
									exportOptions: {
										columns: [0, 2, 3, 4]
									}
								},

								{
									extend: 'print',
									title: 'Eventos usuario',
									exportOptions: {
										columns: [0, 2, 3, 4]
									},
									customize: function (
										win) {
										$(win.document.body)
											.addClass(
												'white-bg');
										$(win.document.body)
											.css(
												'font-size',
												'10px');

										$(win.document.body)
											.find(
												'table')
											.addClass(
												'compact')
											.css(
												'font-size',
												'inherit');
									}
								}]

						});
				var tbListaDiferencia = $('.tbListaDiferencia').DataTable(
					{
						dom: '<"html5buttons"B>lTfgitp',
						pageLength: 10,
						columns: [{
							"data": "eventoDetalle"
						}, {
							"data": "ubigeo"
						}, {
							"data": "fecha_evento"
						}, {
							"data": "fecha_registro"
						}, {
							"data": "diferencia"
						}, {
							"data": "rango"
						}],
						columnDefs: [{
							className: 'dt-center',
							targets: [0, 1, 2, 3, 4, 5]
						}],
						"ajax": {
							url: URI + "eventos/reportes/listaDiferenciaEventosUsuarioAjax",
							type: "POST",
							data: function (d) {
								d.idusuario = document
									.getElementById("hIdUsuario").value
							}
						},
						buttons: [
							{
								extend: 'copy',
								title: 'Copiar'
							},
							{
								extend: 'csv',
								title: 'Csv'
							},
							{
								extend: 'excel',
								title: 'Excel'
							},
							{
								extend: 'pdf',
								title: 'Pdf'
							},

							{
								extend: 'print',
								title: 'Imprimir',
								customize: function (
									win) {
									$(win.document.body)
										.addClass(
											'white-bg');
									$(win.document.body)
										.css(
											'font-size',
											'10px');

									$(win.document.body)
										.find(
											'table')
										.addClass(
											'compact')
										.css(
											'font-size',
											'inherit');
								}
							}]
					});

				$('body').on('click', '.tbLista tbody tr', function () {
					var tr = $(this);
					var row = table.row(tr);
					index = row.index();
					data = row.data();

					if ($(this).hasClass('selected')) {
						$(this).removeClass('selected');
					} else {
						table.$('tr.selected').removeClass('selected');
						$(this).addClass('selected');
					}

					$("#hIdUsuario").val(data.Codigo_Usuario);

					tbListaDiferencia.ajax.reload();
					tbListaDiferencia.draw();

				});

			});
}
