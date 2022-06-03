
function loadGraphicData(grafico) {
	let data = [], serieData = {}, series = [];
	for (const key in grafico[0]) {
		if (key !== 'Hospital' && key !== 'Region')
			data = [...data, key];
	}
	grafico.forEach((item) => {
		const name = item['Hospital'] || item['Region'];
		delete item.Hospital;
		delete item.Region;
		for (const key in item) {
			serieData[name] = [...(serieData[name] || []), item[key]];
		}
	})
	for (const key in serieData) {
		series = [...series, {
			name: key,
			type: 'line',
			data: serieData[key]
		}];
	}

	return { data, serieData, series };
}

function obtenerGrafica(grafico = []) {
	try {
		var dom = document.getElementById("container");
		var myChartLeft = echarts.init(dom);

		let { data, serieData, series } = loadGraphicData(grafico);

		const optionLeft = {
			title: {
			},
			tooltip: {
				trigger: 'axis'
			},
			legend: {
				data: Object.keys(serieData)
			},
			grid: {
				left: '3%',
				right: '4%',
				bottom: '3%',
				containLabel: true
			},
			toolbox: {
				feature: {
					saveAsImage: {}
				}
			},
			xAxis: {
				type: 'category',
				boundaryGap: false,
				data
			},
			yAxis: {
				type: 'value'
			},
			series
		};

		if (optionLeft && typeof optionLeft === "object") {

			myChartLeft.setOption(optionLeft, true);
		}
	} catch (error) {

	}
}

function main(URI) {

	setTimeout(function () {
		$(".alert").slideUp();
	}, 3500);
	function certificacion(id) {

		var certificacion = "";
		switch (parseInt(id)) {
			case 1: certificacion = "BRIGADISTA"; break;
			case 2: certificacion = "E.M.T. I"; break;
			case 3: certificacion = "E.M.T. II"; break;
			case 4: certificacion = "E.M.T. III"; break;
			case 5: certificacion = "CELULA ESPECIALIZADA"; break;
		}
		return certificacion;

	}

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

		var table = "";

		$("#evento_fecha").datetimepicker({
			format: "DD/MM/YYYY",
			maxDate: moment()
		});

		$("#fechaRegistro").datetimepicker({
			format: "DD/MM/YYYY",
			maxDate: moment(),
			widgetPositioning: {
				horizontal: 'left',
				vertical: 'bottom'
			}
		});

		setTimeout(function () {
			table = $('#tbLista').DataTable(
				{
					pageLength: 25,
					columns: [
						{ "data": "responsable_reporte" },
						{ "data": "jefe_guardia" },
						{ "data": "hospital_nombre" },
						{ "data": "region" },
						{ "data": "telefono" },
						{ "data": "fecha" },
						{ "data": "estado" },
						{ "data": "id" },
						{ "data": "order" },
						{ "data": "id2" }
					],
					columnDefs: [{
						"targets": [7, 8],
						"visible": false,
						"searchable": false
					}],
					"order": [[8, "desc"]]
				});

		}, 300);

		$('body').on('click', 'td i.editar', function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			data = row.data();
			var id = data.id;
			post(URI + "hospitales/edicion", { id: id });

		});

		$('body').on('click', '#tbLista tr', function () {

			var tr = $(this);
			var row = table.row(tr);

			index = row.index();

			data = row.data();
			var id = data.id;

			$("#btn-editar").removeClass("editar");
			$("#btn-eliminar").removeClass("anular");
			$("#btn-editar").addClass("editar");
			$("#btn-eliminar").addClass("anular");
			$("#btn-editar").find("label").attr("rel", id);
			$("#btn-eliminar").find("label").attr("rel", id);

			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}

		});

		$(".agregar").on("click", function () {
			post(URI + "hospitales/nuevo", { type: 0 });
		});

		$(".agregarLocal").on("click", function () {
			post(URI + "hospitales/nuevo", { type: 1 });
		});

		$("#btn-data").on("click", function () {
			$(".hospital__option").hide();
			$(".data__container").show();
		});

		$("#btn-gestor").on("click", function () {
			post(URI + "hospitales/reporte", {});
		});

		$('#btn-editar').on('click', function () {
			var id = $(this).find("label").attr("rel");
			post(URI + "hospitales/edicion", { id: id });
		});

		$('#btn-eliminar').on('click', function () {
			$("#idHospital").val("");
			var id = $(this).find("label").attr("rel");

			$("#idHospital").val(id);
			$("#deleteHospitalModal").modal("show");

		});
	});

	var tableReporte = $('.tableReporte').DataTable(
		{
			pageLength: 5,
			lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			data: [],
			columns: [
				{ title: "Fecha", data: "Fecha" },
				{
					title: "Region", data: "Region", render: function (data, type, row) {
						return data || '';
					}
				},
				{
					title: "Hospital", data: "Hospital", render: function (data, type, row) {
						return data || '';
					}
				},
				{ title: "HOSPITALIZACION", data: "Hospitalizacion_01" },
				{ title: "HOSPITALIZACION COVID-19", data: "Hospitalizacion_02" },
				{ title: "EMERGENCIA", data: "Emergencia_01" },
				{ title: "EMERGENCIA COVID-19", data: "Emergencia_02" },
				{ title: "UCI ADULTOS", data: "Criticos_01" },
				{ title: "UCI ADULTOS COVID-19", data: "Criticos_02" },
				{ title: "UCI PEDIATRICO", data: "Pediatricos_01" },
				{ title: "UCI PEDIATRICO COVID-19", data: "Pediatricos_02" }/*,
				{ title: "Camas_Covid_UCI_P_EE", data: "Camas_Covid_UCI_P_EE" },
				{ title: "Camas_Covid_UCI_P_EI", data: "Camas_Covid_UCI_P_EI" },
				{ title: "Camas_Totales_UCI", data: "Camas_Totales_UCI" },
				{ title: "Camas_Totales_UCI_Adultos", data: "Camas_Totales_UCI_Adultos" },
				{ title: "Camas_Totales_UCI_Pediatrico", data: "Camas_Totales_UCI_Pediatrico" }*/
			],
			dom: 'Bflrtip',
			select: true,
			buttons: [{
				extend: 'copy',
				title: 'Lista General de Reporte de Camas',
				exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] },
			},
			{
				extend: 'csv',
				title: 'Lista General de Reporte de Camas',
				exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] },
			},
			{
				extend: 'excel',
				title: 'Lista General de Reporte de Camas',
				exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] },
			},
			{
				extend: 'pdf',
				title: 'Lista General de Reporte de Camas',
				orientation: 'landscape',
				exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] },
			},
			{
				extend: 'print',
				title: 'Lista General de Reporte de Camas',
				exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] },
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
			}]
		});

	$("#formTable").validate({
		rules: {
			fechaRegistro: { required: true },
			reporte: { required: true }
		},
		messages: {
			fechaRegistro: { required: "(*) Campo Requerido" },
			reporte: { required: "(*) Campo Requerido" }
		},
		errorPlacement: function (error, element) {
			if (element.attr("name") == "fecha") {
				error.insertAfter("#error_fecha");
			}
			else {
				error.insertAfter(element);
			}
		}, submitHandler: function (form, event) {
			event.preventDefault();
			$.ajax({
				type: "POST",
				url: URI + "hospitales/main/obtenerReporte",
				data: $("#formTable").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
					$("#btnRegistrar").addClass("disabled");
					$("#message").html("");
				},
				error: function (xhr) {
					$("#cargando").html("<i></i>");
					$("#btnRegistrar").removeClass("disabled");
					$message = '<div class="alert alert-warning"><h4 style="margin:0">Error en el proceso</h4></div>';
					$("#message").html($message);
					$('html, body').animate({ scrollTop: 0 }, 'fast');
					setTimeout(function () { $("#message").slideUp(); }, 3000);
				},
				success: function (response) {
					const { data: { lista } } = response;
					tableReporte.clear();
					tableReporte.rows.add(lista).draw();
				}
			});

			$(".reporte__canvas").removeAttr('hidden');

			$.ajax({
				type: "POST",
				url: URI + "hospitales/main/obtenerGrafica",
				data: $("#formTable").serialize(),
				dataType: "json",
				beforeSend: function () {
				},
				error: function (xhr) {

				},
				success: function (response) {
					const { data: { lista } } = response;
					obtenerGrafica(lista);
				}
			});
		}
	});

}
