function Procesos(URI, grafico1, grafico2) {

	var colorGeneral = ["#FF0000", "#0000FF", "#ffcc00", "#046b7a", "#b6ddaa", "#400000", "#5e3e00", "#d66363", "#00919c", "	#000000", "#8b0000", "#8bd9f0", "#b86565", "#a79a8f", "#ca326b", "#ff9900", "#66ccff", "#ffcc00"];
	var barChart1;
	var barChart2;

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

	function cargar_graficos() {
		var id = 1;
		$(".reporte_canvas").html("");

		tbLista.rows().iterator(
			'row',
			function (context, index) {
				var data = this.row(index).data();
				var idName = "canvas" + id;
				$(".reporte_canvas").append(
					'<div class="col-xs-12"><canvas id="' + idName + '"></canvas></div>');

				var newCtx = document.getElementById(idName).getContext('2d');
				newCtx.height = 350;
				window.myHorizontalBar = new Chart(newCtx, {
					type: 'bar',
					data: {
						labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
						datasets: [{
							label: "Programado",
							backgroundColor: "rgba(255, 0, 0, 0.5)",
							borderColor: "#F00",
							borderWidth: 1,
							data: [data.pEnero,
							data.pFebrero,
							data.pMarzo,
							data.pAbril,
							data.pMayo,
							data.pJunio,
							data.pJulio,
							data.pAgosto,
							data.pSeptiembre,
							data.pOctubre,
							data.pNoviembre,
							data.pDiciembre]
						},
						{
							label: "Ejecutado",
							backgroundColor: "rgba(0, 255, 0, 0.5)",
							borderColor: "#0F0",
							borderWidth: 1,
							data: [data.eEnero,
							data.eFebrero,
							data.eMarzo,
							data.eAbril,
							data.eMayo,
							data.eJunio,
							data.eJulio,
							data.eAgosto,
							data.eSeptiembre,
							data.eOctubre,
							data.eNoviembre,
							data.eDiciembre]
						}]

					},
					options: {
						scales: {
							xAxes: [{
								ticks: {
									beginAtZero: true
								}
							}]
						},
						elements: {
							rectangle: {
								borderWidth: 2,
							}
						},
						responsive: true,
						legend: {
							position: 'right',
						},
						title: {
							display: true,
							text: recortar(data.Descripcion_Proceso)
						}
					}
				});

				id++;

			});

	}

	$(document).ready(function () {

		$("#formCambioFecha select[name=Anio]").on("change", function () {

			var anio = $(this).val();
			if (anio.length > 0) {
				$("#formCambioFecha").submit();
			}

		});

		$("#title").text($("select[name=cboActividadPOI] option:selected").text());
		generateBarChart(grafico1, grafico2);

		$("select[name=cboActividadPOI]").on("change", function () {

			var anio = $("select[name=Anio]").val();
			var idActividadPOI = $(this).val();
			$("#title").text("");

			if (idActividadPOI.length > 0) {
				var text = $(this).text();
				$.ajax({
					url: URI + 'tablero/tableroControl/grafficReportMensual',
					method: 'post',
					type: 'json',
					data: { anio: anio, cboActividadPOI: idActividadPOI },
					error: function (xhr) { },
					beforeSend: function () {
					},
					success: function (data) {
						$("#title").text($("select[name=cboActividadPOI] option:selected").text());
						data = JSON.parse(data);
						console.log(data.grafico1);
						console.log(data.grafico2);
						generateBarChart(JSON.stringify(data.grafico1), JSON.stringify(data.grafico2));

					}

				});

			}
		});
	});

}