function gestionarTablero(URI, grafico) {

	var colorGeneral = ["#FF0000", "#0000FF", "#ffcc00", "#046b7a", "#b6ddaa", "#400000", "#5e3e00", "#d66363", "#00919c", "	#000000", "#8b0000", "#8bd9f0", "#b86565", "#a79a8f", "#ca326b", "#ff9900", "#66ccff", "#ffcc00"];

	var barChart;

	function recortar(texto) {
		return (texto.length > 50) ? texto.substring(0, 50) + "..." : texto;
	}

	function generateBarChart(graffic) {

		if (barChart !== undefined) barChart.destroy();

		var obj = JSON.parse(graffic);
		if (obj.length > 0) {
			var fObj = obj[0];

			var barData = {
				labels: ["I Trimestre", "II Trimestre", "III Trimestre", "IV Trimestre"],
				datasets: [
					{
						backgroundColor: '#046b7a',
						borderColor: '#046b7a',
						fill: false,
						label: "Programado",
						data: [fObj.P_I_Trim, fObj.P_II_Trim, fObj.P_III_Trim, fObj.P_IV_Trim]
					},
					{
						backgroundColor: '#00ff00',
						borderColor: '#00ff00',
						fill: false,
						label: "Ejecutado",
						data: [fObj.E_I_Trim, fObj.E_II_Trim, fObj.E_III_Trim, fObj.E_IV_Trim]
					}
				]
			}

			$("#barChart").removeClass("d-none");
			var ctx = document.getElementById("barChart").getContext('2d');
			ctx.height = 400;
			barChart = new Chart(ctx, {
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
						text: ''
					}
				}
			});

		}

	}

	function cargarProcesos(anio, form, select, Id_Actividad_POI, area) {
		var id_act = Id_Actividad_POI;
		$.ajax({
			url: URI + 'tablero/tableroControl/cargarActividadPorArea',
			method: 'post',
			type: 'json',
			data: { Id_Actividad_POI: Id_Actividad_POI, anio: anio, area },
			error: function (xhr) { },
			beforeSend: function () {
				$(form).find("select[name=Id_Actividad_POI]").html('<option value="">Cargando...</option>');
			},
			success: function (data) {
				console.log('here', data)
				$(form).find("select[name=Id_Actividad_POI]").html('<option value="">[Seleccionar]</option>');
				data = JSON.parse(data);
				$.each(data, function (i, e) {
					if (parseInt(Id_Actividad_POI) > 0) { $(form).find("select[name=Id_Actividad_POI]").append('<option value="' + e.Id_Actividad_POI + '"' + (id_act == e.Id_Actividad_POI ? 'selected' : "") + '>' + e.Codigo_Actividad_POI + ' - ' + e.Descripcion_Actividad + '</option>'); }
					else { $(form).find("select[name=Id_Actividad_POI]").append('<option value="' + e.Id_Actividad_POI + '">' + e.Codigo_Actividad_POI + ' - ' + e.Descripcion_Actividad + '</option>'); }
				});

			}
		});

	}

	function cargarProcesoIndicador(proceso, anio, form) {
		$.ajax({
			url: URI + 'tablero/tableroControl/cargarUnidadMedida',
			method: 'post',
			type: 'json',
			data: { Id_Actividad_POI: proceso, anio: anio },
			error: function (xhr) { },
			beforeSend: function () {
			},
			success: function (data) {
				data = JSON.parse(data);
				datos = data.data;

				var areaText = $("#Codigo_Area_Registro option:selected").text();
				var actividadText = $("#Id_Actividad_POI option:selected").text();

				$("#Nombre_Area").val(areaText);
				$("#Nombre_Actividad_POI").val(actividadText);
				$("#Nombre_Medida").val(datos.Nombre_Unidad_Medida);
				$("#Nombre_Indicador").val(data.indicador);

				$(form).find("input[name=Codigo_Unidad_Medida]").val(datos.Nombre_Unidad_Medida);
				$(form).find("input[name=proyecto]").val(datos.Codigo_Actividad_Proyecto);
				$(form).find("input[name=nombreProyecto]").val(datos.Nombre_Actividad_Proyecto);
				$(form).find("input[name=actividad]").val(datos.Codigo_Actividad);
				$(form).find("input[name=finalidad]").val(datos.Codigo_Finalidad);
				$(form).find("input[name=indicador]").val(data.indicador);

			}
		});
	}

	setTimeout(function () { $(".alert").slideUp(); }, 3500);

	function filterAreaByYear(form, year) {
		$.ajax({
			url: URI + "tablero/tableroControl/filterAreaByYear",
			method: 'post',
			type: 'json',
			data: { year: year },
			error: function (xhr) { },
			beforeSend: function () {
				$(form).find("select[name=Codigo_Area]").html('<option>Cargando...</option>');
			},
			success: function (data) {
				console.log('here', { data })
				data = JSON.parse(data);
				$(form).find("select[name=Codigo_Area]").html('');

				$.each(data.areas, function (i, e) {
					$(form).find("select[name=Codigo_Area]").append('<option value="' + e.Codigo_Area + '">' + e.Nombre_Area + '</option>');
				});

			}
		});
	}

	$(document).ready(function () {
		var $input = $(".inputfile"),
			$label = $input.next('label'),
			labelVal = $label.html();

		$("select[name=cboActividadPOI]").on("change", function () {

			var anio = $("select[name=Anio]").val();
			var idActividadPOI = $(this).val();
			$("#title").text("");

			if (idActividadPOI.length > 0) {
				var text = $(this).text();
				$.ajax({
					url: URI + 'tablero/tableroControl/grafficReport',
					method: 'post',
					type: 'json',
					data: { anio: anio, cboActividadPOI: idActividadPOI },
					error: function (xhr) { },
					beforeSend: function () {
					},
					success: function (data) {
						console.log('here', { data })

						$("#title").text($("select[name=cboActividadPOI] option:selected").text());
						generateBarChart(data);

					}

				});

			}
		});

		$input.on('change', function (e) {
			var fileName = '';

			if (this.files && this.files.length > 1)
				fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
			else if (e.target.value)
				fileName = e.target.value.split('\\').pop();

			if (fileName)
				$label.find('span').html(fileName);
			else
				$label.html(labelVal);
		});
		$input.on('focus', function () { $input.addClass('has-focus'); }).on('blur', function () { $input.removeClass('has-focus'); });

		$("#btnRegistrar").on("click", function () {
			$("#registrarModal").modal("show");
		});

		jQuery.validator.addMethod("validarFormato", function (value, element) {
			return this.optional(element) || /^(\d+|\d+.\d{1,2})$/.test(value);
		}, "Formato incorrecto Ej: 12.60");
		$("#formRegistrar").validate({
			rules: {
				Anio_Ejecucion: { required: true },
				Codigo_Area: { required: true },
				Id_Actividad_POI: { required: true },
				cantidad: { required: true, min: 0 },
				costo: { min: 0 },
				codigo_mes: { required: true },
				file: { required: true }
			},
			messages: {
				Anio_Ejecucion: { required: "(*) Campo Requerido" },
				Codigo_Area: { required: "(*) Campo Requerido" },
				Id_Actividad_POI: { required: "(*) Campo Requerido" },
				cantidad: { required: "(*) Campo Requerido", min: "Valor m\xednimo 0" },
				costo: { min: "Valor m\xednimo 0" },
				codigo_mes: { required: "(*) Campo Requerido" },
				file: { required: "(*) Campo Requerido" }
			},
			submitHandler: function (form, event) {
				var texto = "";
				var file = $("#formRegistrar input[type=file]").val();
				if (file.length > 0) texto = "Espere, se est&aacute; cargando el archivo adjunto ";
				$("#formRegistrar button[type=submit]").html(texto + '<i class="fa fa-spinner fa-spin"></i>');
				$("#formRegistrar button[type=submit]").addClass('disabled');
				$("#formRegistrar button[type=submit]").css('pointer-events', 'none');
				form.submit();

			}
		});
	});

	$("#formActualizar").validate({
		rules: {
			Anio_Ejecucion: { required: true },
			Codigo_Area: { required: true },
			Id_Actividad_POI: { required: true },
			cantidad: { required: true, min: 0 },
			costo: { min: 0 },
			codigo_mes: { required: true }
		},
		messages: {
			Anio_Ejecucion: { required: "(*) Campo Requerido" },
			Codigo_Area: { required: "(*) Campo Requerido" },
			Id_Actividad_POI: { required: "(*) Campo Requerido" },
			cantidad: { required: "(*) Campo Requerido", min: "Valor m\xednimo 0" },
			costo: { min: "Valor m\xednimo 0" },
			codigo_mes: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {

			var texto = "";
			if (file.length > 0) texto = "Espere, se est&aacute; cargando el archivo adjunto ";
			$("#formActualizar button[type=submit]").html(texto + '<i class="fa fa-spinner fa-spin"></i>');
			$("#formActualizar button[type=submit]").addClass('disabled');
			$("#formActualizar button[type=submit]").css('pointer-events', 'none');
			form.submit();

		}
	});

	var tbTablero = $('#tbListar').DataTable({
		dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',

		language: languageDatatable,
		autoWidth: true,
		columns: [
			{
				"data": null,
				"render": function (data, type, row, meta) {
					const btnDisabled = data.Activo == '1' ? `<button class="btn btn-primary btn-circle actionDisable" title="ANULAR" type="button">
				<i class="fa fa-times" aria-hidden="true"></i>
				</button>` : `<button class="btn btn-success btn-circle actionEnable" title="ACTIVAR" type="button">
				<i class="fa fa-check" aria-hidden="true"></i>
				</button>`;
					const btnEdit = data.Activo == '1' ? `<button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button">
				<i class="fa fa-pencil-square-o"></i>
				</button>` : `<button class="btn btn-warning btn-circle disabled" title="EDITAR" type="button">
				<i class="fa fa-pencil-square-o"></i>
				</button>`;
					return `
					<div>
					${btnDisabled}
					</div>
					<div>
						${btnEdit}
					</div>
					<div>
						<button class="btn btn-danger btn-circle actionDelete" title="ELIMINAR" type="button">
						<i class="fa fa fa-trash-o"></i>
						</button>
					</div>
				`
				}
			},
			{ "data": "Anio_Ejecucion" },
			{ "data": "Codigo_Actividad_POI" },
			{ "data": "descripcion_actividad" },
			{ "data": "Nombre_Area" },
			{ "data": "nombre_unidad_medida" },
			{ "data": "nombre_mes" },
			{ "data": "Cantidad" },
			{ "data": "Codigo_Actividad_proyecto" },
			{ "data": "codigo_actividad" },
			{ "data": "Codigo_Programa_presupuestal" },
			{ "data": "Codigo_Finalidad" },
			{
				data: "Archivo",
				"render": function (data, type, row, meta) {

					return (data ? `<a href='${URI}public/tablero/${data}' target="_blank" class="btn btn-default btn-circle">
					<i class="fa fa-file-code-o" aria-hidden="true"></i></a>` : '');
				}
			},
			{ "data": "Numero_Documento" },
			{
				data: "Activo",
				"render": function (data, type, row, meta) {
					return `<span class="badge badge-${data == "1" ? 'success' : 'warning'}">${data == "1" ? 'ACTIVO' : 'ANULADO'}</span>`
				}
			},
			{ "data": "id" },
			{ "data": "Codigo_Unidad_Medida" },
			{ "data": "codigo_mes" },
			{ "data": "Codigo_Area" },
			{ "data": "costo" },
			{ "data": "Nombre_Archivo" },
			{ "data": "Observaciones" },
			{ "data": "Logros" },
			{ "data": "Id_Actividad_POI" }
		],
		"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
		columnDefs: [
			{
				"targets": [1, 8, 9, 10, 11, 15, 16, 17, 18, 19, 20, 21, 22, 23],
				"visible": false,
				"searchable": true
			}
		],
		buttons: {
			dom: {
				container: {
					tag: 'div',
					className: 'flexcontent'
				},
				buttonLiner: {
					tag: null
				}
			},
			buttons: [
				{ extend: 'copy', text: 'Copiar', title: 'Tablero Control', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] } },
				{ extend: 'csv', title: 'Tablero Control', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] } },
				{ extend: 'excel', title: 'Tablero Control', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] } },
				{ extend: 'pdf', title: 'Tablero Control', orientation: 'landscape', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] } },
				{
					extend: 'print',
					text: 'Imprimir',
					title: 'Tablero Control',
					exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] },
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
				},
				{
					extend: 'pageLength',
					titleAttr: 'Registros a mostrar',
					className: 'selectTable'
				}
			]
		}
	});
	$("body").on("click", ".actionDisable", function () {
		$('#anularModal').modal('show');

		var tr = $(this).parents('tr');
		var row = tbTablero.row(tr);
		data = row.data();

		$("#anularModal input[name=id]").val(data.id);

	});

	$("body").on("click", ".actionEnable", function () {
		$("#activarModal input[name=Codigo_Proceso]").val("");
		$('#activarModal').modal('show');

		var tr = $(this).parents('tr');
		var row = tbTablero.row(tr);
		data = row.data();

		$("#activarModal input[name=id]").val(data.id);

	});

	$("body").on("click", ".actionDelete", function () {
		$("#deleteModal input[name=Codigo_Proceso]").val("");
		$('#deleteModal').modal('show');

		var tr = $(this).parents('tr');
		var row = tbTablero.row(tr);
		data = row.data();

		$("#deleteModal input[name=id]").val(data.id);

	});

	$("body").on("click", ".actionEdit", function () {

		$("#actualizarModal").modal("show");
		$("#formActualizar")[0].reset();

		var tr = $(this).parents('tr');
		var row = tbTablero.row(tr);
		data = row.data();

		var index = row.index();

		$("#editFile").text("Cargar Documento");

		var Codigo_Indicador = data.Codigo_Indicador;
		$("#formActualizar").find("select[name=Anio_Ejecucion]").val(data.Anio_Ejecucion);
		$("#formActualizar").find("select[name=Codigo_Area]").val(data.Codigo_Area);
		$("#formActualizar").find("select[name=Id_Actividad_POI]").val(data.Id_Actividad_POI);
		$("#formActualizar").find("select[name=codigo_mes]").val(data.codigo_mes);
		$("#formActualizar").find("input[name=cantidad]").val(data.Cantidad);
		$("#formActualizar").find("input[name=id]").val(data.id);
		$("#formActualizar").find("input[name=costo]").val(data.costo);

		$("#formActualizar").find("input[name=Nombre_Archivo]").val(data.Nombre_Archivo);
		$("#formActualizar").find("input[name=Numero_Documento]").val(data.Numero_Documento);
		$("#formActualizar").find("input[name=Observaciones]").val(data.Observaciones);
		$("#formActualizar").find("input[name=Logro]").val(data.Logros);

		var archivo = data.Archivo;
		if (archivo.length > 0) {
			$("#editFile").html("Ya existe, &iquest;reemplazar?");
		}

		cargarProcesos(data.Anio_Ejecucion, $("#formActualizar"), 2, data.Id_Actividad_POI, data.Codigo_Area);
		setTimeout(function () { cargarProcesoIndicador(data.Id_Actividad_POI, data.Anio_Ejecucion, $("#formActualizar")); }, 1200);

	});

	$("#formRegistrar select[name=Anio_Ejecucion]").on("change", function () {
		var id = $(this).val();
		if (id.length > 0) {
			console.log("id: " + id);
			$("#formRegistrar").find("select[name=Id_Actividad_POI]").html('<option value="">Cargando...</option>');
			filterAreaByYear("#formRegistrar", id);
		}
	});
	$("#formActualizar select[name=Anio_Ejecucion]").on("change", function () {

		var id = $(this).val();
		if (id.length > 0) {
			$("#formActualizar").find("select[name=Id_Actividad_POI]").html('<option value="">Cargando...</option>');
			filterAreaByYear("#formActualizar", id);
		}
	});

	$("#formRegistrar select[name=Codigo_Area]").on("change", function () {
		var id = $(this).val();

		var anio = $("#formRegistrar").find("select[name=Anio_Ejecucion]").val();
		if (id.length > 0 && anio) {
			cargarProcesos(anio, $("#formRegistrar"), 1, 0, id);

		}
	});

	$("#formActualizar select[name=Codigo_Area]").on("change", function () {
		var id = $(this).val();
		var anio = $("#formRegistrar").find("select[name=Anio_Ejecucion]").val();
		if (id.length > 0 && anio) {
			cargarProcesos(anio, $("#formActualizar"), 1, 0, id);

		}
	});

	$("#formRegistrar select[name=Id_Actividad_POI]").on("change", function () {

		var id = $(this).val();
		var anio = $("#formRegistrar select[name=Anio_Ejecucion]").val();

		if (anio.length > 0) {
			cargarProcesoIndicador(id, anio, $("#formRegistrar"));
		}
	});

	$("#formActualizar select[name=Id_Actividad_POI]").on("change", function () {

		var id = $(this).val();
		var anio = $("#formActualizar select[name=Anio_Ejecucion]").val();
		if (anio.length > 0) {
			cargarProcesoIndicador(id, anio, $("#formActualizar"));
		}
	});

	$("#formCambioFecha select[name=Anio]").on("change", function () {

		var anio = $(this).val();
		if (anio.length > 0) {
			$("#formCambioFecha").submit();
		}

	});

	$("#formCambioFecha select[name=Codigo_Area], #formCambioFecha select[name=mes]").on("change", function () {
		var value = $(this).val();

		$.ajax({
			type: "POST",
			url: URI + "tablero/tableroControl/obtenerFiltro",
			data: $("#formCambioFecha").serialize(),
			dataType: "json",
			beforeSend: function () {
			},
			success: function (data) {
				tbTablero.clear();
				tbTablero.rows.add(data).draw();
			}
		});
	});

	$('input#cantidad')
	.keypress(function (event) {
	  if (event.which < 48 || event.which > 57) {
		return false;
	  }
	});

	$('input#costo')
	.keypress(function (event) {
	  if (event.which < 48 || event.which > 57) {
		return false;
	  }
	});

}

function obtenerGrafica(URI, grafico) {
	try {

		var dom = document.getElementById("container");
		var domEjecucion = document.getElementById("containerEjecucion");
		var myChart = echarts.init(dom);
		var myChartEjecucion = echarts.init(domEjecucion);
		var listGrafic = JSON.parse(grafico) || [];
		var app = {};
		option = null;
		optionEjecucion = null;

		var graficData = [];
		var seriesData = [];
		var seriesEjecucionData = [];

		listGrafic.forEach((item, index) => {
			graficData.push(item.Codigo_Actividad);
			seriesData.push({
				name: item.Codigo_Actividad,
				type: 'line',
				stack: '',
				areaStyle: index == 0 ? { normal: {} } : {},
				data: [item.P_ENE, item.P_FEB, item.P_MAR, item.P_ABR, item.P_MAY, item.P_JUN, item.P_JUL, item.P_AGO, item.P_SEP, item.P_OCT, item.P_NOV, item.P_DIC]
			});

			seriesEjecucionData.push({
				name: item.Codigo_Actividad,
				type: 'line',
				stack: '',
				areaStyle: index == 0 ? { normal: {} } : {},
				data: [item.E_ENE, item.E_FEB, item.E_MAR, item.E_ABR, item.E_MAY, item.E_JUN, item.E_JUL, item.E_AGO, item.E_SEP, item.E_OCT, item.E_NOV, item.E_DIC]
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

function getWidth() {
	return window.innerWidth / 26;
}

function getRandomColor() {
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}

function generarGraficaCircular(data) {
	const circlesData = JSON.parse(data) || [];

	var colors = [
		['#D3B6C6', '#4B253A'], ['#FCE6A4', '#EFB917'], ['#BEE3F7', '#45AEEA'], ['#F8F9B6', '#D2D558'], ['#F4BCBF', '#D43A43'],
		['#D3B6C6', '#4B253A'], ['#FCE6A4', '#EFB917'], ['#BEE3F7', '#45AEEA'], ['#F8F9B6', '#D2D558'], ['#F4BCBF', '#D43A43']
	],
		circles = [];

	circlesData.forEach((item, index) => {
		const circle = Circles.create({
			id: `circles-${item.Codigo_Area}`,
			radius: getWidth(),
			value: Number(item.P_Ejecutado),
			maxValue: 100,
			width: 10,

			colors: colors[index],
			duration: 400,
			styleWrapper: true,
			styleText: true
		});
		circles.push(circle);
	})

	window.onresize = function (e) {
		for (var i = 0; i < circles.length; i++) {
			circles[i].updateRadius(getWidth());
		}
	};

}

function generarBarras(data) {
	const graphicData = JSON.parse(data) || [];
	let grafico_labels = [], seriesData = [];

	graphicData.forEach((item) => {
		grafico_labels.push(item.Siglas_Area);
		seriesData.push(Number(item.Invertido));
	});

	var options = {
		chart: {
			height: 350,
			type: 'bar',
		},
		colors: ['#089bab'],
		plotOptions: {
			bar: {
				vertical: true,
			}
		},
		dataLabels: {
			enabled: false
		},
		series: [{
			name: 'Invertido/Gastado',
			data: seriesData,
		}],
		xaxis: {
			categories: grafico_labels,
			title: {
				text: 'Areas y/o Unidades Operativas DIGERD'
			}
		},
		yaxis: {
			title: {
				text: 'Monto Invertido/Gastado en Soles (S/.)'
			}
		},
	}

	var chart = new ApexCharts(
		document.querySelector("#graficoBarra"),
		options
	);

	chart.render();

}

function generarPastel(data) {
	const graphicData = JSON.parse(data) || [];
	let grafico_labels = [], dataInvertido = [], dataTotal = [];

	graphicData.forEach((item) => {
		grafico_labels.push(item.Siglas_Area);
		dataInvertido.push(Number(item.P_Invertido));
		dataTotal.push(100);
	});

	console.log(grafico_labels,
		dataInvertido)

	var options = {
		chart: {
			height: 350,
			type: 'bar',
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '55%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		colors: ['#FC9F5B', '#e64141'],
		series: [{
			name: 'Invertido/Gastado',
			data: dataInvertido
		}
		],
		xaxis: {
			categories: grafico_labels,
			title: {
				text: 'Areas y/o Unidades Operativas DIGERD'
			}
		},
		yaxis: {
			title: {
				text: 'Porcentaje (%)'
			}
		},
		fill: {
			opacity: 1

		},
		tooltip: {
			y: {
				formatter: function (val) {
					return val + '%'
				}
			}
		}
	}

	var chart = new ApexCharts(
		document.querySelector("#graficoPastel"),
		options
	);

	chart.render();
}
