function enlazar(URI) {

	var colorGeneral = ["#FF0000", "#0000FF", "#ffcc00", "#046b7a", "#b6ddaa", "#400000", "#5e3e00", "#d66363", "#00919c", "	#000000", "#8b0000", "#8bd9f0", "#b86565", "#a79a8f", "#ca326b", "#ff9900", "#66ccff", "#ffcc00"];

	var semestre_1 = 0;
	var semestre_2 = 0;

	var barChart1;
	var barChart2;

	function sumarSemaforo(codigo) {

		var total_p = 0;
		var total_e = 0;
		var s_1 = semestre_1;
		var s_2 = semestre_2;

		var ts1_p = 0;
		var ts1_e = 0;
		var ts2_p = 0;
		var ts2_e = 0;

		switch (parseInt(codigo)) {
			case 1: {
				ts1_p = parseInt(s_1.P_ENE);
				ts1_e = parseInt(s_1.E_ENE);
			}; break;
			case 2: {
				ts1_p = parseInt(s_1.P_ENE) + parseInt(s_1.P_FEB);
				ts1_e = parseInt(s_1.E_ENE) + parseInt(s_1.E_FEB);
			}; break;
			case 3: {
				ts1_p = parseInt(s_1.P_ENE) + parseInt(s_1.P_FEB) + parseInt(s_1.P_MAR);
				ts1_e = parseInt(s_1.E_ENE) + parseInt(s_1.E_FEB) + parseInt(s_1.E_MAR);
			}; break;
			case 4: {
				ts1_p = parseInt(s_1.P_ENE) + parseInt(s_1.P_FEB) + parseInt(s_1.P_MAR) + parseInt(s_1.P_ABR);
				ts1_e = parseInt(s_1.E_ENE) + parseInt(s_1.E_FEB) + parseInt(s_1.E_MAR) + parseInt(s_1.E_ABR);
			}; break;
			case 5: {
				ts1_p = parseInt(s_1.P_ENE) + parseInt(s_1.P_FEB) + parseInt(s_1.P_MAR) + parseInt(s_1.P_ABR) + parseInt(s_1.P_MAY);
				ts1_e = parseInt(s_1.E_ENE) + parseInt(s_1.E_FEB) + parseInt(s_1.E_MAR) + parseInt(s_1.E_ABR) + parseInt(s_1.E_MAY);
			}; break;
			case 6: {
				ts1_p = parseInt(s_1.P_ENE) + parseInt(s_1.P_FEB) + parseInt(s_1.P_MAR) + parseInt(s_1.P_ABR) + parseInt(s_1.P_MAY) + parseInt(s_1.P_JUN);
				ts1_e = parseInt(s_1.E_ENE) + parseInt(s_1.E_FEB) + parseInt(s_1.E_MAR) + parseInt(s_1.E_ABR) + parseInt(s_1.E_MAY) + parseInt(s_1.E_JUN);
			}; break;

		}
		if (parseInt(codigo) > 6) {
			ts2_p = parseInt(s_1.P_ENE) + parseInt(s_1.P_FEB) + parseInt(s_1.P_MAR) + parseInt(s_1.P_ABR) + parseInt(s_1.P_MAY) + parseInt(s_1.P_JUN);
			ts2_e = parseInt(s_1.E_ENE) + parseInt(s_1.E_FEB) + parseInt(s_1.E_MAR) + parseInt(s_1.E_ABR) + parseInt(s_1.E_MAY) + parseInt(s_1.E_JUN);
			switch (parseInt(codigo)) {
				case 7: {
					ts2_p += parseInt(s_2.P_JUL);
					ts2_e += parseInt(s_2.E_JUL);
				}; break;
				case 8: {
					ts2_p += parseInt(s_2.P_JUL) + parseInt(s_2.P_AGO);
					ts2_e += parseInt(s_2.E_JUL) + parseInt(s_2.E_AGO);
				}; break;
				case 9: {
					ts2_p += parseInt(s_2.P_JUL) + parseInt(s_2.P_AGO) + parseInt(s_2.P_SEP);
					ts2_e += parseInt(s_2.E_JUL) + parseInt(s_2.E_AGO) + parseInt(s_2.E_SEP);
				}; break;
				case 10: {
					ts2_p += parseInt(s_2.P_JUL) + parseInt(s_2.P_AGO) + parseInt(s_2.P_SEP) + parseInt(s_2.P_OCT);
					ts2_e += parseInt(s_2.E_JUL) + parseInt(s_2.E_AGO) + parseInt(s_2.E_SEP) + parseInt(s_2.E_OCT);
				}; break;
				case 11: {
					ts2_p += parseInt(s_2.P_JUL) + parseInt(s_2.P_AGO) + parseInt(s_2.P_SEP) + parseInt(s_2.P_OCT) + parseInt(s_2.P_NOV);
					ts2_e += parseInt(s_2.E_JUL) + parseInt(s_2.E_AGO) + parseInt(s_2.E_SEP) + parseInt(s_2.E_OCT) + parseInt(s_2.E_NOV);
				}; break;
				case 12: {
					ts2_p += parseInt(s_2.P_JUL) + parseInt(s_2.P_AGO) + parseInt(s_2.P_SEP) + parseInt(s_2.P_OCT) + parseInt(s_2.P_NOV) + parseInt(s_2.P_DIC);
					ts2_e += parseInt(s_2.E_JUL) + parseInt(s_2.E_AGO) + parseInt(s_2.E_SEP) + parseInt(s_2.E_OCT) + parseInt(s_2.E_NOV) + parseInt(s_2.E_DIC);
				}; break;
			}

		}

		var total_p = ts1_p + ts2_p;
		var total_e = ts1_e + ts2_e;

		if (parseInt(total_p) == 0) total_p = 1;
		var porcentaje = Math.round((total_e * 100) / total_p);

		var color = '';
		if (porcentaje <= 50) {
			color = '#e94141';
		} else if (porcentaje > 50 && porcentaje <= 75) {
			color = '#e9e541';
		} else {
			color = '#49c848';

		}

		return color;
	}

	function recortar(texto) {
		return (texto.length > 50) ? texto.substring(0, 50) + "..." : texto;
	}

	function generateBarChart(graffic1, graffic2) {

		if (barChart1 !== undefined) barChart1.destroy();
		if (barChart2 !== undefined) barChart2.destroy();

		var obj1 = JSON.parse(graffic1);
		var obj2 = JSON.parse(graffic2);

		if (obj1.length > 0) {
			var fObj = obj1[0];

			var barData = {
				labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
				datasets: [
					{
						backgroundColor: '#046b7a',
						borderColor: '#046b7a',
						fill: false,
						label: "Programado",
						data: [fObj.P_ENE, fObj.P_FEB, fObj.P_MAR, fObj.P_ABR, fObj.P_MAY, fObj.P_JUN]
					},
					{
						backgroundColor: '#00ff00',
						borderColor: '#00ff00',
						fill: false,
						label: "Ejecutado",
						data: [fObj.E_ENE, fObj.E_FEB, fObj.E_MAR, fObj.E_ABR, fObj.E_MAY, fObj.E_JUN]
					}
				]
			}

			$("#barChart1").removeClass("d-none");
			var ctx = document.getElementById("barChart1").getContext('2d');
			ctx.height = 400;
			barChart1 = new Chart(ctx, {
				type: 'bar',
				data: barData,
				options: {
					responsive: true,
					maintainAspectRatio: false,
					legend: {
						position: 'bottom',
					},
					hover: {
						mode: 'index'
					},
					scales: {
						xAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: ''
							}
						}],
						yAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: ''
							},
							ticks: {
								beginAtZero: true
							}
						}]
					},
					title: {
						display: true,
						text: 'Primer Semestre'
					}
				}
			});

		}

		if (obj2.length > 0) {
			var fObj = obj2[0];

			var barData = {
				labels: ["Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
				datasets: [
					{
						backgroundColor: '#046b7a',
						borderColor: '#046b7a',
						fill: false,
						label: "Programado",
						data: [fObj.P_JUL, fObj.P_AGO, fObj.P_SEP, fObj.P_OCT, fObj.P_NOV, fObj.P_DIC]
					},
					{
						backgroundColor: '#00ff00',
						borderColor: '#00ff00',
						fill: false,
						label: "Ejecutado",
						data: [fObj.E_JUL, fObj.E_AGO, fObj.E_SEP, fObj.E_OCT, fObj.E_NOV, fObj.E_DIC]
					}
				]
			}

			$("#barChart2").removeClass("d-none");
			var ctx = document.getElementById("barChart2").getContext('2d');
			ctx.height = 400;
			barChart2 = new Chart(ctx, {
				type: 'bar',
				data: barData,
				options: {
					responsive: true,
					maintainAspectRatio: false,
					legend: {
						position: 'bottom',
					},
					hover: {
						mode: 'index'
					},
					scales: {
						xAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: ''
							}
						}],
						yAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: ''
							},
							ticks: {
								beginAtZero: true
							}
						}]
					},
					title: {
						display: true,
						text: 'Segundo Sementre'
					}
				}
			});

		}

	}

	function randOneToTen() {
		var rand = Math.round(Math.random() * (10 - 1)) + 1;
		return rand;
	}

	function recortar(indicador) {
		return (indicador.length > 70) ? indicador.substring(1, 70) + "..." : indicador;
	}

	function addData(chart, label, color, data, pointRadius) {
		chart.data.datasets.push({
			fill: false,
			backgroundColor: color,
			borderColor: color,
			label: label,
			borderWidth: 1,
			data: data,
			pointRadius: pointRadius
		});
		chart.update();
	}

	function addDataDotted(chart, label, color, data) {
		chart.data.datasets.push({
			fill: false,
			backgroundColor: color,
			borderColor: color,
			label: label,
			borderWidth: 1,
			borderDash: [5, 5],
			data: data,
			pointHoverRadius: 20,
			pointHitRadius: 15
		});
		chart.update();
	}

	function semaforo(id) {

		var Anio_Ejecucion = $("#Anio").val();
		var Codigo_Area = $("#Codigo_Area").val();
		var Id_Actividad_POI = $("select[name=cboActividadPOI]").val();

		if (id > 0 && Anio_Ejecucion.length > 0 && Codigo_Area.length > 0 && Id_Actividad_POI.length > 0) {

			var color = sumarSemaforo(parseInt(id));
			if (color.length > 0) {
				var html = '<div class="semaforo" style="background-color:' + color + '"></div>';
				$("#semaforo").html(html);
			}
		} else {
			$("#semaforo").html('');

		}
	}

	$(document).ready(function () {

		var tbTablero = $('#tbListar').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "Anio_Ejecucion" },
				{ "data": "Id_Actividad_POI" },
				{ "data": "Numero_Documento" },
				{ "data": "Observaciones" },
				{ "data": "descripcion_actividad" },
				{ "data": "Nombre_Area" },
				{ "data": "nombre_unidad_medida" },
				{ "data": "Cantidad" },
				{ "data": "nombre_mes" },
				{ "data": "Codigo_Actividad_proyecto" },
				{ "data": "codigo_actividad" },
				{ "data": "Codigo_Programa_presupuestal" },
				{ "data": "Codigo_Finalidad" },
				{ "data": "Archivo" },
				{ "data": "Nombre_Archivo" },
				{ "data": "estado" },

			],
			"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
			columnDefs: [
				{
					"targets": [0, 4, 5, 9, 10, 11, 12, 14],
					"visible": false,
					"searchable": true
				},
				{
					width: "20%",
					targets: 2
				},
				{
					width: "5%",
					targets: [7, 13]
				},
				{
					targets: [0, 1, 4, 5, 6, 7, 8, 11, 13, 14, 15],
					className: 'text-center'
				},
				{
					targets: 3,
					className: 'text-left'
				}
			],
			"ajax": {
				url: URI + "tablero/procesoIndicador/cargarListarEnlace",
				type: "POST",
				data: function (d) {
					d.Anio_Ejecucion = document.getElementById("Anio").value,
						d.Codigo_Area = document.getElementById("Codigo_Area").value,
						d.Id_Actividad_POI = document.getElementById("cboActividadPOI").value
				}
			},
			buttons: [
				{ extend: 'copy', text: 'Copiar', title: 'Tablero Control', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
				{ extend: 'csv', title: 'Tablero Control', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
				{ extend: 'excel', title: 'Tablero Control', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
				{ extend: 'pdf', title: 'Tablero Control', orientation: 'landscape', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },

				{
					extend: 'print',
					text: 'Imprimir',
					title: 'Tablero Control',
					exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] },
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

		$("#textSearch").change(function () {
			console.log('text search for: ' + $(this).val());
			tbTablero.search($(this).val()).draw();
		});

		$("select[name=Anio]").on("change", function () {

			var anio = $(this).val();

			if (anio.length > 0) {

				$.ajax({
					url: URI + 'tablero/procesoIndicador/recargarCombosEnlace',
					method: 'post',
					type: 'json',
					data: { anio: anio },
					error: function (xhr) { },
					beforeSend: function () {
						$("select[name=Codigo_Area]").html('<option value="">Cargando...</option>');
						$("select[name=cboActividadPOI]").html('<option value="">-- Seleccione --</option>');
						$("select[name=mes]").val('');
						$("#semaforo").html('');
						if (barChart1 !== undefined) barChart1.destroy();
						if (barChart2 !== undefined) barChart2.destroy();
					},
					success: function (data) {
						data = JSON.parse(data);

						$htmlArea = '<option value="">-- Seleccione --</option>';
						$htmlPOI = '<option value="">-- Seleccione --</option>';
						$.each(data.listaAreas, function (i, e) {
							$htmlArea += '<option value="' + e.Codigo_Area + '">' + e.Nombre_Area + '</option>'

						});
						$("select[name=Codigo_Area]").html($htmlArea);
					}

				});

			}
		});

		$("select[name=Codigo_Area]").on("change", function () {

			var Anio_Ejecucion = $("#Anio").val();
			var Codigo_Area = $(this).val();

			if (Anio_Ejecucion.length > 0 && Codigo_Area.length > 0) {

				$.ajax({
					url: URI + 'tablero/procesoIndicador/listarEnlace',
					method: 'post',
					type: 'json',
					data: { Anio_Ejecucion: Anio_Ejecucion, Codigo_Area: Codigo_Area },
					error: function (xhr) { },
					beforeSend: function () {
						$("select[name=cboActividadPOI]").html('<option value="">Cargando...</option>');
						$("select[name=mes]").val('');
						$("#semaforo").html('');
					},
					success: function (data) {
						data = JSON.parse(data);
						if (parseInt(data.data.length) > 0) {
							$htmlPOI = '<option value="">-- Seleccione --</option>';
						} else {
							$htmlPOI = '<option value="">-- Sin Registros --</option>';
						}

						$.each(data.data, function (i, e) {
							$htmlPOI += '<option value="' + e.Id_Actividad_POI + '">' + e.Codigo_Actividad_POI + ' - ' + e.Descripcion_Actividad + '</option>'
						});
						$("select[name=cboActividadPOI]").html($htmlPOI);
					}

				});

			}
		});

		$("select[name=cboActividadPOI]").on("change", function () {

			var Anio_Ejecucion = $("#Anio").val();
			var Codigo_Area = $("#Codigo_Area").val();
			var Id_Actividad_POI = $(this).val();

			if (Anio_Ejecucion.length > 0 && Codigo_Area.length > 0 && Id_Actividad_POI.length > 0) {

				$.ajax({
					url: URI + 'tablero/procesoIndicador/cargarReporteEnlace',
					method: 'post',
					type: 'json',
					data: { Anio_Ejecucion: Anio_Ejecucion, Codigo_Area: Codigo_Area, Id_Actividad_POI: Id_Actividad_POI },
					error: function (xhr) {
						$("#modalCargaGeneral").css("display", "none");
					},
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
						$("select[name=mes]").val('');
						$("#semaforo").html('');
					},
					success: function (data) {
						$("#modalCargaGeneral").css("display", "none");
						data = JSON.parse(data);
						semestre_1 = data.grafico1[0];
						semestre_2 = data.grafico2[0];

						generateBarChart(JSON.stringify(data.grafico1), JSON.stringify(data.grafico2));
						tbTablero.ajax.reload();

						setTimeout(function () {
							var fecha = new Date();
							var mes = fecha.getMonth();
							var actual = parseInt(mes) + 1;
							$("#mes").val(actual);
							semaforo(actual);
						}, 1500);

					}

				});

			}
		});

		$("#mes").on("change", function () {

			var id = $(this).val();
			if (id.length > 0) {
				semaforo(parseInt(id));
			}
		});

	});

}
