function reportarFicha(URI, Evento_Registro_Numero, ofertaLabel, ofertaData, cie10Label, cie10Data) {

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

	ofertaLabel = JSON.parse(ofertaLabel);
	ofertaData = JSON.parse(ofertaData);

	cie10Label = JSON.parse(cie10Label);
	cie10Data = JSON.parse(cie10Data);

	Array.prototype.max = function () {
		return Math.max.apply(null, this);
	};

	max = Math.max.apply(null, ofertaData);

	var ctx = document.getElementById("myChart").getContext('2d');
	var ctx2 = document.getElementById("myChart2").getContext('2d');

	var step = 0;

	if (max < 11) {
		step = 1;
	}
	else if (max < 101) {
		step = 10;
	}
	else if (max < 1001) {
		step = 100;
	}
	else if (max < 10001) {
		step = 1000;
	}
	console.log("step", step);
	function recortar(indicador) {
		return (indicador.length > 70) ? indicador.substring(1, 70) + "..." : indicador;
	}

	$(document).ready(function () {

		var newCtx = document.getElementById("myChart").getContext('2d');
		newCtx.height = 350;
		window.myHorizontalBar = new Chart(newCtx, {
			type: 'bar',
			data: {
				labels: ofertaLabel,
				datasets: [{
					label: "Anteciones",
					backgroundColor: "rgba(255, 0, 0, 0.5)",
					borderColor: "#F00",
					borderWidth: 1,
					data: ofertaData
				}]

			},
			options: {
				scales: {
					xAxes: [{
						barPercentage: 0.5,
						ticks: {
							beginAtZero: true
						}
					}],
					yAxes: [{
						ticks: {
							min: 0,
							stepSize: step,
							precision: 0
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
					position: 'top',
				},
				title: {
					display: true,
					text: "Resumen Atenciones por oferta Movil",
					fontSize: 20
				}
			}
		});

		var newCtx2 = document.getElementById("myChart2").getContext('2d');
		newCtx2.height = 350;
		window.myHorizontalBar = new Chart(newCtx2, {
			type: 'bar',
			data: {
				labels: cie10Label,
				datasets: [{
					label: "Anteciones",
					backgroundColor: "#117eff",
					borderColor: "#006dee",
					borderWidth: 1,
					data: cie10Data
				}]

			},
			options: {
				scales: {
					xAxes: [{
						barPercentage: 0.5,
						ticks: {
							beginAtZero: true
						}
					}],
					yAxes: [{
						ticks: {
							min: 0,
							stepSize: 1,
							precision: 0
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
					position: 'top',
				},
				title: {
					display: true,
					text: "Resumen de Diagnosticos",
					fontSize: 20
				}
			}
		});

		$(".regresar").on("click", function () {

			post(URI + "eventos/fichas/lista", { Evento_Registro_Numero: Evento_Registro_Numero });

		});

		$(".regresar").on("click", function () {

			post(URI + "eventos/fichas/lista", { Evento_Registro_Numero: Evento_Registro_Numero });

		});

	});

}