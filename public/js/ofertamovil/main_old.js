function main(URI, grafficLabel, grafficData, labelPie, dataPie, ofertaMovilLines, fechaLines, cantidadesLines, labelPolar, dataPolar) {

	var colorGeneral = ["#FF0000", "#0000FF", "#ffcc00", "#046b7a", "#b6ddaa", "#400000", "#5e3e00", "#d66363", "#00919c", "#000000", "#8b0000", "#8bd9f0", "#b86565", "#a79a8f",
		"#ca326b", "#ff9900", "#66ccff", "#ffcc00", "#AA8F39", "#FFEBAA", "#AA7039", "#AA5F39", "#AA4B39", "#9E354A", "#872D62", "#652770"
		, "#210439", "#3F3075", "#080B3B", "#2C4770", "#27586B", "#103E50", "#022735", "#257059", "#70A897", "#003827", "#2B803E", "#106022", "#50A162", "#F1FAA6", "#9AA637"];
	var barChart;
	var color;
	var pieChart;
	var lineChart;
	var polarChart;

	function selectColors(elements, opacity) {
		var selected = [];
		var colors = colorGeneral.filter(x => x == x);

		var opa = Chart.helpers.color;

		var color_length = colorGeneral.length;
		for (var element of elements) {

			color = colors[Math.floor(Math.random() * color_length)];
			if (opacity === 1) {
				selected.push(opa(color).alpha(0.5).rgbString());
			} else {
				selected.push(color);
			}

			colors = colors.filter(c => c != color);
			color_length--;
		}
		return selected;

	}

	function armarGrafico(grafficLabel, grafficData) {

		if (barChart !== undefined) barChart.destroy();
		colors = selectColors(grafficLabel, 0);
		var ctx = document.getElementById("myChart").getContext('2d');
		border = 0.2;

		if (grafficData.length > 1 && grafficData.length < 4) {
			border = 0.25;
		} else if (grafficData.length > 4 && grafficData.length < 8) {
			border = 0.35;
		} else if (grafficData.length > 8 && grafficData.length < 11) {
			border = 0.45;
		} else {
			border = 0.55;
		}

		barChart = new Chart(ctx, {
			type: 'horizontalBar',
			data: {
				labels: grafficLabel,
				datasets: [{
					label: "Atenciones",
					backgroundColor: colors,
					borderColor: colors,
					borderWidth: 1,
					data: grafficData
				}]

			},
			options: {
				scales: {
					xAxes: [{
						barPercentage: border,
						ticks: {
							beginAtZero: true
						}
					}],
					yAxes: [{
						barPercentage: border,
						ticks: {
							min: 0,
							stepSize: 1,
							precision: 0
						}
					}]
				},
				elements: {
					rectangle: {
						borderWidth: border,
					}
				},
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: "Resumen de Diagnosticos",
					fontSize: 20
				}
			}
		});

	}

	function dataSet(label, data, color) {

		return {
			label: label,
			backgroundColor: color,
			borderColor: color,
			data: data,
			fill: false,
			spanGaps: true
		};
	}

	function armarLines(oferta_movil, fecha_lines, cantidades) {

		var dataSets = [];
		var i = 0;
		var colors = colorGeneral.filter(x => x == x);
		var color_length = colorGeneral.length;

		for (cantidad of cantidades) {
			color = colors[Math.floor(Math.random() * color_length)];
			colors = colors.filter(c => c != color);
			color_length--;
			dataSets.push(dataSet(oferta_movil[i], cantidad, color));
			i++;

			if (color_length === 0) {
				colors = colorGeneral.filter(x => x == x);
				color_length = colorGeneral.length;
			}

		}

		if (lineChart !== undefined) lineChart.destroy();
		var ctx = document.getElementById('lineChart').getContext('2d');
		var config = {
			type: 'line',
			data: {
				labels: fecha_lines,
				datasets: dataSets
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Atenciones en Oferta Movil(últimos 15 días)'/*,
						fontColor: "white"*/
				},
				tooltips: {
					backgroundColor: 'rgba(33,33,33,0.5)',
					cornerRadius: 0,
					footerFontFamily: "'Roboto'"
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,

						scaleLabel: {
							display: true,
							labelString: 'Fechas'/*,
								fontColor:'#FFFFFF'*/
						}/*,
							ticks: {
                                fontColor: "white",
                                fontSize: 14
                          }*/
					}],
					yAxes: [{
						display: true,

						scaleLabel: {
							display: true,
							labelString: 'Cantidades'/*,
								fontColor:'#FFFFFF'*/
						},/*
							ticks: {
                                fontColor: "white",
                                fontSize: 14
                          }*/
					}]
				}/*,
					legend: {
			            labels: {
			                fontColor: 'white'
			            }
			        }*/
			}
		};

		lineChart = new Chart(ctx, config);

	}

	function armarPie(grafficLabel, grafficData) {

		if (pieChart !== undefined) pieChart.destroy();

		var ctx = document.getElementById("chart_pie").getContext("2d");

		var data = {
			labels: grafficLabel,
			datasets: [
				{
					data: grafficData,
					backgroundColor: ["#f83f37", "#efeb2f", "#22af47", "#0d441c"],
					hoverBackgroundColor: ["#f83f37", "#efeb2f", "#22af47", "#0d441c"]
				}]
		};

		pieChart = new Chart(ctx, {
			type: 'doughnut',
			data: data,
			options: {
				animation: {
					duration: 3000
				},
				responsive: true,
				legend: {
					labels: {
						fontFamily: "Roboto",
						fontColor: "#878787"
					}
				},
				tooltip: {
					backgroundColor: 'rgba(33,33,33,1)',
					cornerRadius: 0,
					footerFontFamily: "'Roboto'"
				},
				elements: {
					arc: {
						borderWidth: 0
					}
				}
			}
		});
	}

	function armarRadar(grafficLabel, grafficData) {

		if (polarChart !== undefined) polarChart.destroy();
		colors = selectColors(grafficLabel, 1);
		var ctx = document.getElementById('polarChart');
		var position = 'right';

		if (grafficData.length > 20) {
			position = 'bottom';
		}

		var config = {
			data: {
				datasets: [{
					data: grafficData,
					backgroundColor: colors,
					label: 'Oferta movil'
				}],
				labels: grafficLabel
			},
			options: {
				startAngle: -1 * Math.PI,
				responsive: true,
				legend: {
					position: position,
					labels: {
						fontSize: 11,
						usePointStyle: false,
						padding: 7,
						fullWidth: true

					}
				},
				title: {
					display: true,
					text: 'Total de Atenciones por Oferta Movil'
				},
				scale: {
					ticks: {
						beginAtZero: true
					},
					reverse: false
				},
				animation: {
					animateRotate: false,
					animateScale: true
				}
			}
		};
		polarChart = Chart.PolarArea(ctx, config);

	}

	function reloadCombo() {
		$.ajax({
			type: "POST",
			url: URI + "ofertamovil/main/listaEventosOfertaMovilAjax",
			dataType: "json",
			beforeSend: function () {
				$("#combo").html('<option>Cargando...</option>');
			},
			error: function () {
			},
			success: function (data) {

				html = "";

				$.each(data.lista, function (i, e) {
					if (e.prioridad) {
						html += '<option value="' + e.id + '" selected>' + e.descripcion + '</option>';
					} else {
						html += '<option value="' + e.id + '">' + e.descripcion + '</option>';
					}

				});
				$("#combo").html(html);
			}
		});
	}

	function limpiarFormulario() {
		$("#formBuscarEvento")[0].reset();
		$("#formBuscarEvento").find("#tipo").text("");
		$("#formBuscarEvento").find("#evento").text("");
		$("#formBuscarEvento").find("#detalle").text("");
		$("#formBuscarEvento").find("#descripcion").text("");
		$("#modalCargaGeneral").css("display", "none");
		$("#datos").css("display", "none");
		$("#btnEvento").attr("disabled", true);
	}

	$(document).ready(function () {

		$.fn.dataTable.ext.errMode = 'none';

		try {

			if (grafficLabel) {

				grafficLabel = JSON.parse(grafficLabel);
				grafficData = JSON.parse(grafficData);

				if (grafficLabel.length > 0) {
					$("#bar").css("opacity", 1);
					$("#bar").css("height", "auto");
					armarGrafico(grafficLabel, grafficData);
				}

			}

			if (labelPie) {
				dataPie = JSON.parse(dataPie);
				labelPie = JSON.parse(labelPie);

				if (labelPie.length > 0) {
					$("#pie").css("opacity", 1);
					$("#pie").css("height", "auto");
					armarPie(labelPie, dataPie);
				}
			}

			if (ofertaMovilLines) {
				ofertaMovilLines = JSON.parse(ofertaMovilLines);
				fechaLines = JSON.parse(fechaLines);
				cantidadLines = JSON.parse(cantidadLines);

				if (ofertaMovilLines.length > 0) {
					$("#line").css("opacity", 1);
					$("#line").css("height", "auto");
					armarLines(ofertaMovilLines, fechaLines, cantidadLines);
				}
			}
			labelPolar, dataPolar
			if (labelPolar) {
				labelPolar = JSON.parse(labelPolar);
				dataPolar = JSON.parse(dataPolar);
				if (labelPolar.length > 0) {
					$("#polar").css("opacity", 1);
					$("#polar").css("height", "auto");
					armarRadar(labelPolar, dataPolar);
				}
			}
		} catch (e) {
			console.log('error en graficos', e);
		}

		var listaTable = $('.tableAtencion').DataTable({
			dom: 'lTfgitp',
			"length": 10,
			columns: [
				{ "data": "correlativo" },
				{ "data": "evento" },
				{ "data": "fecha" },
				{ "data": "ubicacion" },
				{ "data": "descripcionAtencion" },
				{ "data": "estado" },
				{ "data": "orden" },
				{ "data": "Evento_Registro_Numero" },
				{ "data": "tipo" },
				{ "data": "detalle" },
				{ "data": "descripcion" },
				{ "data": "id" },
				{ "data": "editar" },
				{ "data": "eliminar" }
			],
			columnDefs: [{
				"targets": [3, 6, 7, 8, 9, 10, 11, 12, 13],
				"visible": false,
				"searchable": false
			}],
			"order": [[5, "asc"]],
			"ajax": {
				url: URI + "ofertamovil/main/listaAjax",
				type: "POST",
				data: function (d) { }
			}

		});

		var tableEventosModal = $('.tableEventos').DataTable({
			"length": 25,
			columns: [
				{ "data": "correlativo" },
				{ "data": "evento" },
				{ "data": "fecha" },
				{ "data": "ubicacion" },
				{ "data": "estado" },
				{ "data": "orden" },
				{ "data": "id" },
				{ "data": "tipo" },
				{ "data": "detalle" },
				{ "data": "descripcion" }
			],
			columnDefs: [{
				"targets": [5, 6, 7, 8, 9],
				"visible": false,
				"searchable": false
			}],
			"order": [[5, "asc"]],
			"ajax": {
				url: URI + "ofertamovil/main/eventosAjax",
				type: "POST",
				data: function (d) {
					d.Anio_Ejecucion = document.getElementById("Anio_Ejecucion").value,
						d.mes = document.getElementById("mes").value
				}
			}

		});

		$("#btnBuscar").on("click", function () {

			$("#eventosModal").modal("show");

		});

		$("#Anio_Ejecucion, #mes").on("change", function () {

			tableEventosModal.ajax.reload();

		});

		$('body').on('click', '.tableEventos tbody tr td', function () {

			var tr = $(this).parents('tr');
			var row = tableEventosModal.row(tr);

			index = row.index();
			data = row.data();

			$("#datos").css("display", "block");
			$("#formBuscarEvento").find("input[name=correlativo]").val(data.correlativo);
			$("#formAcciones").find("input[name=num_sireed]").val(data.correlativo);
			$("#formAcciones").find("input[name=anio_sireed]").val(data.fecha);
			$("#formBuscarEvento").find("#tipo").text(data.tipo);
			$("#formBuscarEvento").find("#evento").text(data.evento);
			$("#formBuscarEvento").find("#detalle").text(data.detalle);
			$("#formBuscarEvento").find("#descripcion").text(data.descripcion);
			$("#formBuscarEvento").find("input[name=fecha]").val(data.fecha);
			$("#formBuscarEvento").find("input[name=Registro_Evento_Numero]").val(data.id);
			$("#eventosModal").modal('hide');
			$("#btnEvento").removeAttr("disabled");

		});

		$("#formBuscarEvento").validate({
			rules: {
				Registro_Evento_Numero: { required: true },
				descripcion: { required: true }
			},
			messages: {
				descripcion: { required: 'Ingrese una descripci\xf3n' }
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				$.ajax({
					type: "POST",
					url: URI + "ofertamovil/main/gestionarAtencionEvento",
					data: $("#formBuscarEvento").serialize(),
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
					},
					error: function () {
						$("#modalCargaGeneral").css("display", "none");
					},
					success: function (data) {
						console.log(data);
						if (parseInt(data.status) == 200) {

							limpiarFormulario();
							listaTable.ajax.reload();
							reloadCombo();
						}
						else if (parseInt(data.status) == 201) {
							$("#duplicate_evento").removeClass("hide");
							setTimeout(function () {
								$("#duplicate_evento").addClass("hide");
							}, 2000);
						}
						else {
							alert("Error al gestionar, vuelva a intentar");
						}

						$("#modalCargaGeneral").css("display", "none");
					}
				});

			}
		});

		$("#combo").on("change", function () {

			var id = $(this).val();

			if (id.length > 0) {
				$("#pie").css("opacity", 0);
				$("#pie").css("height", "1px");
				$("#bar").css("opacity", 0);
				$("#bar").css("height", "1px");
				$("#line").css("opacity", 0);
				$("#line").css("height", "1px");
				$("#polar").css("opacity", 0);
				$("#polar").css("height", "1px");

				if (barChart !== undefined) barChart.destroy();
				if (pieChart !== undefined) pieChart.destroy();
				if (lineChart !== undefined) lineChart.destroy();
				if (polarChart !== undefined) polarChart.destroy();

				$.ajax({
					type: "POST",
					url: URI + "ofertamovil/main/recargarDataDashboard",
					data: { id: id },
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
						$("#p_total").removeAttr("style");
						$("#p_hombres").removeAttr("style");
						$("#p_mujeres").removeAttr("style");
						$("#p_gestantes").removeAttr("style");
						$("#p_adulto_mayor").removeAttr("style");
						$("#p_menor_edad").removeAttr("style");
					},
					error: function () {
						$("#modalCargaGeneral").css("display", "none");
					},
					success: function (data) {

						var t_total = 0;
						var p_total = 0;
						var t_hombres = 0;
						var p_hombres = 0;
						var t_mujeres = 0;
						var p_mujeres = 0;
						var t_gestantes = 0;
						var p_gestantes = 0;
						var t_adulto_mayor = 0;
						var p_adulto_mayor = 0;
						var t_menor_edad = 0;
						var p_menor_edad = 0;
						if (parseInt(data.status) == 200) {

							t_total = data.t_total;
							p_total = (parseInt(t_total) > 0) ? 100 : 0;
							var total = 1;
							if (parseInt(t_total) > 0) {
								total = data.t_total;
							}
							t_hombres = data.t_hombres;
							p_hombres = Math.round((data.t_hombres / total) * 100);
							t_mujeres = data.t_mujeres;
							p_mujeres = Math.round((data.t_mujeres / total) * 100);
							t_gestantes = data.t_gestantes;
							p_gestantes = Math.round((data.t_gestantes / total) * 100);
							t_adulto_mayor = data.t_adulto_mayor;
							p_adulto_mayor = Math.round((data.t_adulto_mayor / total) * 100);
							t_menor_edad = data.t_menor_edad;
							p_menor_edad = Math.round((data.t_menor_edad / total) * 100);

						}

						$("#t_total").html(t_total);
						$("#t_hombres").html(t_hombres);
						$("#t_mujeres").html(t_mujeres);
						$("#t_gestantes").html(t_gestantes);
						$("#t_adulto_mayor").html(t_adulto_mayor);
						$("#t_menor_edad").html(t_menor_edad);

						$("#p_total").attr("aria-valuenow", p_total);
						$("#p_hombres").attr("aria-valuenow", p_hombres);
						$("#p_hombres").attr("aria-valuenow", p_hombres);
						$("#p_mujeres").attr("aria-valuenow", p_mujeres);
						$("#p_gestantes").attr("aria-valuenow", p_gestantes);
						$("#p_adulto_mayor").attr("aria-valuenow", p_adulto_mayor);
						$("#p_menor_edad").attr("aria-valuenow", p_menor_edad);

						$("#p_total").css("width", p_total + '%');
						$("#p_hombres").css("width", p_hombres + '%');
						$("#p_mujeres").css("width", p_mujeres + '%');
						$("#p_gestantes").css("width", p_gestantes + '%');
						$("#p_adulto_mayor").css("width", p_adulto_mayor + '%');
						$("#p_menor_edad").css("width", p_menor_edad + '%');

						$("#modalCargaGeneral").css("display", "none");

						if (data.dataCie && data.dataCie.length > 0) {
							$("#bar").css("opacity", 1);
							$("#bar").css("height", "auto");
							armarGrafico(data.labelCie, data.dataCie);

						}

						if (data.labelPie && data.labelPie.length > 0) {
							$("#pie").css("opacity", 1);
							$("#pie").css("height", "auto");
							armarPie(data.labelPie, data.dataPie);
						}

						if (data.ofertaMovilLines && data.ofertaMovilLines.length > 0) {
							$("#line").css("opacity", 1);
							$("#line").css("height", "auto");
							armarLines(data.ofertaMovilLines, data.fechaLines, data.cantidadLines);
						}

						if (data.labelPolar && data.dataPolar.length > 0) {
							$("#polar").css("opacity", 1);
							$("#polar").css("height", "auto");
							armarRadar(data.labelPolar, data.dataPolar);
						}

					}
				});

			}

		});

		$('body').on('click', '.tableAtencion tbody tr td i.actionEdit', function () {

			var tr = $(this).parents('tr');
			var row = listaTable.row(tr);

			index = row.index();
			data = row.data();
			limpiarFormulario();

			$("#datos").css("display", "block");
			$("#formBuscarEvento").find("input[name=correlativo]").val(data.correlativo);
			$("#formBuscarEvento").find("#tipo").text(data.tipo);
			$("#formBuscarEvento").find("#evento").text(data.evento);
			$("#formBuscarEvento").find("#detalle").text(data.detalle);
			$("#formBuscarEvento").find("#descripcion").text(data.descripcion);
			$("#formBuscarEvento").find("input[name=fecha]").val(data.fecha);
			$("#formBuscarEvento").find("input[name=Registro_Evento_Numero]").val(data.Evento_Registro_Numero);
			$("#formBuscarEvento").find("input[name=id]").val(data.id);
			$("#formBuscarEvento").find("input[name=descripcion]").val(data.descripcionAtencion);
			$("#eventosModal").modal('hide');
			$("#btnEvento").removeAttr("disabled");
		});

		$('body').on('click', '.tableAtencion tbody tr td i.actionDelete', function () {

			var tr = $(this).parents('tr');
			var row = listaTable.row(tr);

			index = row.index();
			data = row.data();
			limpiarFormulario();
			$("#formEliminar").find("input[name=id]").val(data.id);
			$("#formEliminar").find("#eventoCodigo").html('<strong>' + data.correlativo + '</strong>');
			$("#deleteAtencionModal").modal("show");
		});

		$("#formEliminar").validate({
			rules: {
				id: { required: true }
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				$.ajax({
					type: "POST",
					url: URI + "ofertamovil/main/eliminarAtencion",
					data: $("#formEliminar").serialize(),
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
					},
					error: function () {
						$("#modalCargaGeneral").css("display", "none");
					},
					success: function (data) {
						console.log(data);
						if (parseInt(data.status) == 200) {

							limpiarFormulario();
							listaTable.ajax.reload();
							reloadCombo();
						}
						else {
							alert("Error al eliminar");
						}

						$("#deleteAtencionModal").modal("hide");
						$("#modalCargaGeneral").css("display", "none");
					}
				});

			}
		});

		$("#nuevo").on("click", function () {
			location.href = URI + "ofertamovil/main/nuevo";
		});

		$("#consolidado").on("click", function () {
			location.href = URI + "ofertamovil/main/consolidado";
		});

	});

}