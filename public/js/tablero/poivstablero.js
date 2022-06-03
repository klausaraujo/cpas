function Poivstablero(URI, grafico) {

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
						label: "Porcentaje Avance",
						data: [fObj.I_Trim, fObj.II_Trim, fObj.III_Trim, fObj.IV_Trim]
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
		generateBarChart(grafico);

		$("select[name=cboActividadPOI]").on("change", function () {

			var anio = $("select[name=Anio]").val();
			var idActividadPOI = $(this).val();
			$("#title").text("");

			if (idActividadPOI.length > 0) {
				var text = $(this).text();
				$.ajax({
					url: URI + 'tablero/tableroControl/grafficReportPorcentaje',
					method: 'post',
					type: 'json',
					data: { anio: anio, cboActividadPOI: idActividadPOI },
					error: function (xhr) { },
					beforeSend: function () {
					},
					success: function (data) {
						$("#title").text($("select[name=cboActividadPOI] option:selected").text());
						generateBarChart(data);

					}

				});

			}
		});
	});

}