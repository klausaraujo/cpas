function obtenerGrafica(URI, grafico, graficoPorcentual) {
	try {

		var dom = document.getElementById("container");
		var domEjecucion = document.getElementById("containerEjecucion");
		var myChart = echarts.init(dom);
		var myChartEjecucion = echarts.init(domEjecucion);
		var listGrafic = JSON.parse(grafico) || [];
		var listGraficPorcentual = JSON.parse(graficoPorcentual) || [];
		var app = {};
		option = null;
		optionEjecucion = null;

		var graficData = [];
		var graficDataPorcentual = [];
		var seriesData = [];
		var seriesEjecucionData = [];

		listGrafic.forEach((item, index) => {
			graficData.push(item.Indicador);
			seriesData.push({
				name: item.Indicador,
				type: 'line',
				stack: '',
				areaStyle: index == 0 ? { normal: {} } : {},
				data: [item.R_ENE, item.R_FEB, item.R_MAR, item.R_ABR, item.R_MAY, item.R_JUN, item.R_JUL, item.R_AGO, item.R_SEP, item.R_OCT, item.R_NOV, item.R_DIC]
			});
		})

		listGraficPorcentual.forEach((item, index) => {
			graficDataPorcentual.push(item.Indicador);
			seriesEjecucionData.push({
				name: item.Indicador,
				type: 'line',
				stack: '',
				areaStyle: index == 0 ? { normal: {} } : {},
				data: [item.R_ENE, item.R_FEB, item.R_MAR, item.R_ABR, item.R_MAY, item.R_JUN, item.R_JUL, item.R_AGO, item.R_SEP, item.R_OCT, item.R_NOV, item.R_DIC]
			});
		})
		option = {
			title: {

			},
			tooltip: {
				trigger: 'axis',
				axisPointer: {
					type: 'cross',
					label: {
						backgroundColor: '#6a7985'
					}
				}
			},
			legend: {
				data: graficData
			},
			grid: {
				left: '3%',
				right: '4%',
				bottom: '3%',
				containLabel: true
			},
			xAxis: [
				{
					type: 'category',
					boundaryGap: false,
					data: [
						'ENERO',
						'FEBRERO',
						'MARZO',
						'ABRIL',
						'MAYO',
						'JUNIO',
						'JULIO',
						'AGOSTO',
						'SETIEMBRE',
						'OCTUBRE',
						'NOVIEMBRE',
						'DICIEMBRE'
					]
				}
			],
			yAxis: [
				{
					type: 'value'
				}
			],
			series: seriesData
		};

		optionEjecucion = {
			title: {

			},
			tooltip: {
				trigger: 'axis',
				axisPointer: {
					type: 'cross',
					label: {
						backgroundColor: '#6a7985'
					}
				}
			},
			legend: {
				data: graficDataPorcentual
			},
			grid: {
				left: '3%',
				right: '4%',
				bottom: '3%',
				containLabel: true
			},
			xAxis: [
				{
					type: 'category',
					boundaryGap: false,
					data: [
						'ENERO',
						'FEBRERO',
						'MARZO',
						'ABRIL',
						'MAYO',
						'JUNIO',
						'JULIO',
						'AGOSTO',
						'SETIEMBRE',
						'OCTUBRE',
						'NOVIEMBRE',
						'DICIEMBRE'
					]
				}
			],
			yAxis: [
				{
					type: 'value'
				}
			],
			series: seriesEjecucionData
		};
		if (option && typeof option === "object") {
			myChart.setOption(option, true);
			myChartEjecucion.setOption(optionEjecucion, true);
		}
	} catch (error) {
		console.log(error)
	}
}
function generateTables(grafico, graficoPorcentual) {
	const graficoData = JSON.parse(grafico) || [];

	var tbTablero = $('#tbListar').DataTable({
		dom: '<"html5buttons"B>lTfgitp',
		columns: [
			{ "data": "Anio_Ejecucion" },
			{ "data": "Indicador" },
			{ "data": "R_ENE" },
			{ "data": "R_FEB" },
			{ "data": "R_MAR" },
			{ "data": "R_ABR" },
			{ "data": "R_MAY" },
			{ "data": "R_JUN" },
			{ "data": "R_JUL" },
			{ "data": "R_AGO" },
			{ "data": "R_SEP" },
			{ "data": "R_OCT" },
			{ "data": "R_NOV" },
			{ "data": "R_DIC" }

		],
		"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
		columnDefs: [
			{
				"targets": [0, 4, 5, 9, 10, 11, 12],
				"visible": true,
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
				targets: [0, 1, 4, 5, 6, 7, 8, 11],
				className: 'text-center'
			},
			{
				targets: 3,
				className: 'text-left'
			}
		],
		data: graficoData,
		buttons: [
			{ extend: 'copy', text: 'Copiar', title: 'Reporte Indicador COE', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
			{ extend: 'csv', title: 'Reporte Indicador COE', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
			{ extend: 'excel', title: 'Reporte Indicador COE', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
			{ extend: 'pdf', title: 'Reporte Indicador COE', orientation: 'landscape', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },

			{
				extend: 'print',
				text: 'Imprimir',
				title: 'Reporte Indicador COE',
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

	const graficoDataPorcentual = JSON.parse(graficoPorcentual) || [];
	var tbTableroEjecucion = $('#tbListarEjecucion').DataTable({
		dom: '<"html5buttons"B>lTfgitp',
		columns: [
			{ "data": "Anio_Ejecucion" },
			{ "data": "Indicador" },
			{ "data": "R_ENE" },
			{ "data": "R_FEB" },
			{ "data": "R_MAR" },
			{ "data": "R_ABR" },
			{ "data": "R_MAY" },
			{ "data": "R_JUN" },
			{ "data": "R_JUL" },
			{ "data": "R_AGO" },
			{ "data": "R_SEP" },
			{ "data": "R_OCT" },
			{ "data": "R_NOV" },
			{ "data": "R_DIC" }

		],
		"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
		columnDefs: [
			{
				"targets": [0, 4, 5, 9, 10, 11, 12],
				"visible": true,
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
				targets: [0, 1, 4, 5, 6, 7, 8, 11],
				className: 'text-center'
			},
			{
				targets: 3,
				className: 'text-left'
			}
		],
		data: graficoDataPorcentual,
		buttons: [
			{ extend: 'copy', text: 'Copiar', title: 'Reporte Indicador COE', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
			{ extend: 'csv', title: 'Reporte Indicador COE', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
			{ extend: 'excel', title: 'Reporte Indicador COE', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
			{ extend: 'pdf', title: 'Reporte Indicador COE', orientation: 'landscape', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },

			{
				extend: 'print',
				text: 'Imprimir',
				title: 'Reporte Indicador COE',
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
}

$(document).ready(function () {
	$("#formCambioFecha select[name=Anio]").on("change", function () {

		var anio = $(this).val();
		if (anio.length > 0) {
			$("#formCambioFecha").submit();
		}

	});

})

