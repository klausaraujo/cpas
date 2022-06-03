function reporte(URI) {

	$.fn.datepicker.dates['es'] = {
		days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
		daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
		daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
		months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		today: "Hoy",
		clear: "Limpiar",
		format: "mm/dd/yyyy",
		titleFormat: "MM yyyy",
		weekStart: 0
	};

	$('.datetimepicker').datepicker({
		format: 'dd/mm/yyyy',
		maxDate: moment(),
		language: "es",
		autoclose: true
	});

	function salir() {
		elemento = document.getElementById("desde");
		elemento.blur();

		elemento2 = document.getElementById("hasta");
		elemento2.blur();

	}

	function departamentos() {
		var cboxes = document.getElementsByName('departamento[]');
		var len = cboxes.length;
		var elementos = [];
		for (var i = 0; i < len; i++) {
			if (cboxes[i].checked)
				elementos.push(cboxes[i].value);
		}
		return elementos;
	}

	var table = $('.tbLista')
		.DataTable(
			{
				dom: '<"html5buttons"B>lTfgitp',
				pageLength: 10,
				columns: [{
					"data": "numero"
				},
				{
					"data": "fecha"
				},
				{
					"data": "hora"
				},
				{
					"data": "departamento"
				},
				{
					"data": "provincia"
				},
				{
					"data": "distrito"
				},
				{
					"data": "lesionados"
				},
				{
					"data": "fallecidos"
				},
				{
					"data": "desaparecidos"
				},
				{
					"data": "vinhabilitadas"
				},
				{
					"data": "vcolapsadas"
				}
				],
				"ajax": {
					url: URI + "eventos/reportes/cargarListaEventos",
					type: "POST",
					data: function (d) {
						d.tipoEvento = document
							.getElementById("tipoEvento").value,
							d.evento = document
								.getElementById("evento").value,
							d.nivel = document
								.getElementById("nivelEmergencia").value,
							d.desde = document
								.getElementById("desde").value,
							d.hasta = document
								.getElementById("hasta").value,
							d.departamentos = departamentos()
					}
				},
				buttons: [
					{
						extend: 'copy',
						text: 'Copiar',
						title: 'Reportes estadísticos',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
						}
					},
					{
						extend: 'csv',
						title: 'Reportes estadísticos',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
						}
					},
					{
						extend: 'excel',
						title: 'Reportes estadísticos',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
						}
					},
					{
						extend: 'pdf',
						title: 'Reportes estadísticos',
						orientation: 'landscape',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
						}
					},

					{
						extend: 'print',
						text: 'Imprimir',
						title: 'Reportes estadísticos',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
						},
						customize: function (win) {
							$(win.document.body).addClass('white-bg');
							$(win.document.body).css('font-size', '10px');

							$(win.document.body).find('table')
								.addClass('compact').css('font-size', 'inherit');

							var css = '@page { size: landscape; }', head = win.document.head
								|| win.document
									.getElementsByTagName('head')[0], style = win.document
										.createElement('style');

							style.type = 'text/css';
							style.media = 'print';

							if (style.styleSheet) {
								style.styleSheet.cssText = css;
							} else {
								style.appendChild(win.document
									.createTextNode(css));
							}

							head.appendChild(style);
						}
					}]
			});

	$(document)
		.ready(
			function () {

				$("input[type=checkbox]").prop("checked", "checked");

				$("input[name=todos]").on(
					"click",
					function () {
						if ($(this).prop("checked")) {
							$("input[type=checkbox]").prop("checked", "checked");
							$(".departamentosStatus").slideUp();
						}
						else {
							$("input[type=checkbox]").prop("checked", false);
							$(".departamentosStatus").slideDown();
						}
					});

				$("#tipoEvento")
					.change(
						function () {

							id = $(this).val();

							if (id.length > 0) {

								$
									.ajax({
										data: {
											tipoEvento: id
										},
										url: URI
											+ "eventos/eventos/cargarEvento",
										method: "POST",
										dataType: "json",
										beforeSend: function () {
											$("#evento")
												.html(
													'<option value="">Cargando...</option>');
										},
										success: function (
											data) {

											var $html = '<option value="">--Seleccione--</option>';
											$
												.each(
													data.lista,
													function (
														i,
														e) {

														$html += '<option value="'
															+ e.Evento_Codigo
															+ '">'
															+ e.Evento_Nombre
															+ '</option>';

													});
											$("#evento")
												.html(
													$html);

										}
									});

							}

						});

				$("#btnObtenerReporte")
					.on(
						"click",
						function () {

							var tipoEvento = $("#tipoEvento")
								.val();
							var evento = $("#evento").val();
							var nivel = $("#nivelEmergencia")
								.val();
							var desde = $("#desde").val();
							var hasta = $("#hasta").val();
							var departamentos = [];
							var todos = $("input[name=todos]").prop("checked");
							var $count = 0;

							var $count = 0;
							$.each($("input[name='departamento[]']"), function (i, e) {
								$status = $(this).prop("checked");
								if ($status) {
									departamentos.push($(this).val());
									$count++;
								}
							});
							if ($count == 0 && todos == false) {
								$("#alertaModal").modal("show");
								$("#alertaModal #tituloalerta")
									.text("Error");
								$("#alertaModal #mensajealerta")
									.html(
										"Seleccione al menos una regi&oacute;n");
								return false;

							}
							table.ajax.reload();

							$
								.ajax({
									data: {
										tipoEvento: tipoEvento,
										evento: evento,
										nivel: nivel,
										departamentos: departamentos,
										desde: desde,
										hasta: hasta
									},
									url: URI
										+ "eventos/reportes/cargarListaEventosCoordenadas",
									method: "POST",
									dataType: "json",
									beforeSend: function () {
										$(
											"#btnObtenerReporte")
											.text(
												"Cargando...");
										$(
											"#btnObtenerReporte")
											.addClass(
												"disabled");
										$("#cargando")
											.html(
												"<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
									},
									success: function (data) {
										$(
											"#btnObtenerReporte")
											.text(
												"Obtener Reporte");
										$(
											"#btnObtenerReporte")
											.removeClass(
												"disabled");

										marcadores = [];

										var count = 0;
										$
											.each(
												data.lista,
												function (
													i,
													e) {

													marcadores[i] = [{
														idcat: '1',
														info: '1',
														nombre: e.Evento_Descripcion,
														ubicacion: e.departamento
															+ ', '
															+ e.provincia
															+ ', '
															+ e.distrito,
														fecha: e.fecha,
														color: '#098',
														posicion: {
															latitud: e.Evento_Latitud,
															longitud: e.Evento_Longitud
														}
													}];

													count++;

												});

										if (count > 0)
											initMap(marcadores);
										else
											console
												.log("Sin registros");

									}
								});

						});

				$("#tipoEvento,#evento,#nivelEmergencia").change(
					function () {

						var tipoEvento = $("#tipoEvento").val();
						var evento = $("#evento").val();

						if (tipoEvento.length > 0
							&& evento.length > 0) {

							$("#btnObtenerReporte").removeClass(
								"disabled");

						}

					});

			});

}
