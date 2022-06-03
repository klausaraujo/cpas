function generarBarChart(LABEL_TITLE,LABELS,VALUES,BAR_TITLE,DIV_ELEMENT) {
	console.log("Ingresa a la funcion");
	console.log("LABEL_TITLE: "+LABEL_TITLE);
	console.log(LABELS);
	console.log(VALUES);
	console.log("BAR_TITLE: "+BAR_TITLE);
	console.log("DIV_ELEMENT: "+DIV_ELEMENT);
	var color = Chart.helpers.color;
	var barChartData = {
		labels: LABELS,
		datasets: [{
			label: LABEL_TITLE,
			backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
			borderColor: window.chartColors.red,
			borderWidth: 1,
			data: VALUES
		}
		]

	};

		var ctx = document.getElementById(DIV_ELEMENT).getContext('2d');
		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: BAR_TITLE
				}
			}
		});
	
	
}