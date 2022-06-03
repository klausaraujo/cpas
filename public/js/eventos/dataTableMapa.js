var tbEventos = $('#tbEventos').DataTable(
	{
		dom: '<"html5buttons"B>lTfgitp',
		"pageLength": 5,
		"bLengthChange": false,
		columns: [{
			"data": "tipoEvento"
		}, {
			"data": "evento"
		}, {
			"data": "total"
		}

		],
		columnDefs: [{
			className: 'dt-center',
			targets: [0, 1, 2]
		}],
		"order": [[0, "asc"], [1, "asc"]],
		buttons: [
			{
				extend: 'copy',
				title: 'Reporte de Mapa de Eventos',
				exportOptions: {
					columns: [0, 1, 2]
				}
			},
			{
				extend: 'csv',
				title: 'Reporte de Mapa de Eventos',
				exportOptions: {
					columns: [0, 1, 2]
				}
			},
			{
				extend: 'excel',
				title: 'Reporte de Mapa de Eventos',
				exportOptions: {
					columns: [0, 1, 2]
				}
			},
			{
				extend: 'pdf',
				title: 'Reporte de Mapa de Eventos',
				exportOptions: {
					columns: [0, 1, 2]
				}
			},

			{
				extend: 'print',
				title: 'Reporte de Mapa de Eventos',
				exportOptions: {
					columns: [0, 1, 2]
				},
				customize: function (win) {
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');

					$(win.document.body).find('table').addClass(
						'compact').css('font-size', 'inherit');
				}
			}]

	});

var tbVulnerable = $('#tbVulnerable').DataTable(
	{
		dom: '<"html5buttons"B>lTfgitp',
		"pageLength": 5,
		"bLengthChange": false,
		columns: [{
			"data": "mujeres"
		}, {
			"data": "gestantes"
		}, {
			"data": "menor_edad"
		}, {
			"data": "adulto_mayor"
		}],
		columnDefs: [{
			className: 'dt-center',
			targets: [0, 1, 2, 3]
		}],
		buttons: [
			{
				extend: 'copy',
				title: 'Población Vulnerable',
				exportOptions: {
					columns: [0, 1, 2, 3]
				}
			},
			{
				extend: 'csv',
				title: 'Población Vulnerable',
				exportOptions: {
					columns: [0, 1, 2, 3]
				}
			},
			{
				extend: 'excel',
				title: 'Población Vulnerable',
				exportOptions: {
					columns: [0, 1, 2, 3]
				}
			},
			{
				extend: 'pdf',
				title: 'Población Vulnerable',
				exportOptions: {
					columns: [0, 1, 2, 3]
				}
			},

			{
				extend: 'print',
				title: 'Población Vulnerable',
				exportOptions: {
					columns: [0, 1, 2, 3]
				},
				customize: function (win) {
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');

					$(win.document.body).find('table').addClass(
						'compact').css('font-size', 'inherit');
				}
			}]

	});

var tbEESS = $('#tbEESS').DataTable(
	{
		dom: '<"html5buttons"B>lTfgitp',
		"pageLength": 5,
		"bLengthChange": false,
		columns: [{
			"data": "operativas"
		}, {
			"data": "inoperativas"
		},

		],
		columnDefs: [{
			className: 'dt-center',
			targets: [0, 1]
		}],
		buttons: [
			{
				extend: 'copy',
				title: 'Entidades de Salud Afectadas',
				exportOptions: {
					columns: [0, 1]
				}
			},
			{
				extend: 'csv',
				title: 'Entidades de Salud Afectadas',
				exportOptions: {
					columns: [0, 1]
				}
			},
			{
				extend: 'excel',
				title: 'Entidades de Salud Afectadas',
				exportOptions: {
					columns: [0, 1]
				}
			},
			{
				extend: 'pdf',
				title: 'Entidades de Salud Afectadas',
				exportOptions: {
					columns: [0, 1]
				}
			},

			{
				extend: 'print',
				title: 'Entidades de Salud Afectadas',
				exportOptions: {
					columns: [0, 1]
				},
				customize: function (win) {
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');

					$(win.document.body).find('table').addClass(
						'compact').css('font-size', 'inherit');
				}
			}]

	});

var tbRecursos = $('#tbRecursos').DataTable(
	{
		dom: '<"html5buttons"B>lTfgitp',
		"pageLength": 5,
		"bLengthChange": false,
		columns: [{
			"data": "brigadistas"
		}, {
			"data": "eme"
		}, {
			"data": "personal_salud"
		}, {
			"data": "ambulancias"
		}

		],
		columnDefs: [{
			className: 'dt-center',
			targets: [0, 1, 2, 3]
		}],
		buttons: [
			{
				extend: 'copy',
				title: 'Recursos Movilizados',
				exportOptions: {
					columns: [0, 1, 2, 3]
				}
			},
			{
				extend: 'csv',
				title: 'Recursos Movilizados',
				exportOptions: {
					columns: [0, 1, 2, 3]
				}
			},
			{
				extend: 'excel',
				title: 'Recursos Movilizados',
				exportOptions: {
					columns: [0, 1, 2, 3]
				}
			},
			{
				extend: 'pdf',
				title: 'Recursos Movilizados',
				exportOptions: {
					columns: [0, 1, 2, 3]
				}
			},

			{
				extend: 'print',
				title: 'Recursos Movilizados',
				exportOptions: {
					columns: [0, 1, 2, 3]
				},
				customize: function (win) {
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');

					$(win.document.body).find('table').addClass(
						'compact').css('font-size', 'inherit');
				}
			}]

	});

var tbCIE10 = $('#tbCIE10').DataTable(
	{
		dom: '<"html5buttons"B>lTfgitp',
		"pageLength": 5,
		"bLengthChange": false,
		columns: [{
			"data": "cie"
		}, {
			"data": "descripcion"
		}, {
			"data": "cantidad"
		}

		],
		columnDefs: [{
			className: 'dt-center',
			targets: [0, 1, 2]
		}],
		"order": [[0, "asc"]],
		buttons: [
			{
				extend: 'copy',
				title: 'Diagnósticos Frecuentes',
				exportOptions: {
					columns: [0, 1, 2]
				}
			},
			{
				extend: 'csv',
				title: 'Diagnósticos Frecuentes',
				exportOptions: {
					columns: [0, 1, 2]
				}
			},
			{
				extend: 'excel',
				title: 'Diagnósticos Frecuentes',
				exportOptions: {
					columns: [0, 1, 2]
				}
			},
			{
				extend: 'pdf',
				title: 'Diagnósticos Frecuentes',
				exportOptions: {
					columns: [0, 1, 2]
				}
			},

			{
				extend: 'print',
				title: 'Diagnósticos Frecuentes',
				exportOptions: {
					columns: [0, 1, 2]
				},
				customize: function (win) {
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');

					$(win.document.body).find('table').addClass(
						'compact').css('font-size', 'inherit');
				}
			}]

	});

var tbRegion = $('#tbRegion').DataTable(
	{
		dom: '<"html5buttons"B>lTfgitp',
		"pageLength": 5,
		"bLengthChange": false,
		columns: [{
			"data": "alta"
		}, {
			"data": "hospitalizado"
		}, {
			"data": "referido"
		}, {
			"data": "fallecido"
		}, {
			"data": "desaparecido"
		}, {
			"data": "observacion"
		}, {
			"data": "evacuacion"
		}

		],
		columnDefs: [{
			className: 'dt-center',
			targets: [0, 1, 2, 3, 4, 5, 6]
		}],
		"order": [[0, "asc"]],
		buttons: [
			{
				extend: 'copy',
				title: 'Reporte Estadístico de Afectados',
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 5, 6]
				}
			},
			{
				extend: 'csv',
				title: 'Reporte Estadístico de Afectados',
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 5, 6]
				}
			},
			{
				extend: 'excel',
				title: 'Reporte Estadístico de Afectados',
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 5, 6]
				}
			},
			{
				extend: 'pdf',
				title: 'Reporte Estadístico de Afectados',
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 5, 6]
				}
			},

			{
				extend: 'print',
				title: 'Reporte Estadístico de Afectados',
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 5, 6]
				},
				customize: function (win) {
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');

					$(win.document.body).find('table').addClass(
						'compact').css('font-size', 'inherit');
				}
			}]

	});
