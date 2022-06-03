function obtenerGrafica(URI, data) {
	try {
		$("#Mes").val(mes)
		initBar(JSON.parse(data.nivelGrafico), 'containerNivel');
		generateTable(JSON.parse(data.nivelGrafico), 'tbListarNivel')
		initBar(jsonToArray(data.regionGrafico), 'containerRegion');
		generateTable(JSON.parse(data.regionGrafico), 'tbListarRegion', 'Numero')
		initBar(jsonToArray(data.regionUnoGrafico), 'containerRegionUno');
		generateTable(JSON.parse(data.regionUnoGrafico), 'tbListarRegionUno', 'Numero')
		initBar(jsonToArray(data.regionDosGrafico), 'containerRegionDos');
		generateTable(JSON.parse(data.regionDosGrafico), 'tbListarRegionDos', 'Numero')
		initBar(jsonToArray(data.regionTresGrafico), 'containerRegionTres');
		generateTable(JSON.parse(data.regionTresGrafico), 'tbListarRegionTres', 'Numero')
	} catch (error) {
		console.log(error)
	}
}

function generateTable(data = [], tableName, noText = '') {
	var columns = [], idColumns = [];

	const column = Object.keys(data[0] || {});
	var count = 0;
	column.forEach((item, index) => {
		if (item !== noText) {
			columns = [...columns, { 'data': item }];
			idColumns = [...idColumns, count];
			count++;
		}
	})

	$('#' + tableName).DataTable({
		dom: '<"html5buttons"B>lTfgitp',
		columns,
		"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
		columnDefs: [
			{
				"targets": idColumns,
				"visible": true,
				"searchable": true
			},
			{
				targets: idColumns,
				className: 'text-center'
			}
		],
		data,
		buttons: [
			{ extend: 'copy', text: 'Copiar', title: 'Movimiento Evento', exportOptions: { columns: idColumns } },
			{ extend: 'csv', title: 'Movimiento Evento', exportOptions: { columns: idColumns } },
			{ extend: 'excel', title: 'Movimiento Evento', exportOptions: { columns: idColumns } },
			{ extend: 'pdf', title: 'Movimiento Evento', orientation: 'landscape', exportOptions: { columns: idColumns } },
			{
				extend: 'print',
				text: 'Imprimir',
				title: 'Movimiento Evento',
				exportOptions: { columns: idColumns },
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

function jsonToArray(data) {
	var value, row, detail = [];
	value = JSON.parse(data) || [];
	row = value.length > 0 ? value[0] : {};

	for (const key in row) {
		if (!['Anio', 'Numero', 'Mes', 'Nivel'].find(item => item === key)) {
			detail.push({
				Nivel: key,
				Eventos: Number(row[key])
			})
		}
	}

	return detail;
}

function initBar(data, divName) {
	var dom = document.getElementById(divName);
	var myChart = echarts.init(dom);
	var title = [], detail = [];
	data.forEach((item, index) => {
		title.push(item.Nivel);
		detail.push(Number(item.Eventos));
	})
	var option = {
		color: ['#3398DB'],
		tooltip: {
			trigger: 'axis',
			axisPointer: {
				type: 'shadow'
			}
		},
		grid: {
			left: '6%',
			right: '8%',

			containLabel: true

		},
		xAxis: [
			{
				type: 'category',
				data: title,
				scale: true,
				axisTick: {
					alignWithLabel: true
				},
				axisLabel: {
					rotate: 45,
					width: 10,
					fontSize: 12,
				}
			}
		],
		yAxis: [
			{
				type: 'value',
				axisLabel: {
					inside: false
				}
			}
		],
		series: [
			{
				name: 'Cantidad',
				type: 'bar',
				label: {
					show: true,
					position: 'inside'
				},
				data: detail
			}
		]
	};

	if (option && typeof option === "object") {
		myChart.setOption(option, true);
	}

}

$(document).ready(function () {
	$("#formCambioFecha select[name=Anio]").on("change", function () {

		var anio = $(this).val();
		if (anio.length > 0) {
			$("#formCambioFecha").submit();
		}

	});

	$("#formCambioFecha select[name=Mes]").on("change", function () {

		var mes = $(this).val();
		if (mes.length > 0) {
			$("#formCambioFecha").submit();
		}

	});
})

