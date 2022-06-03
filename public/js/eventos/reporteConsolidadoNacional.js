function reporteConsolidadoNacional(URI) {

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
	$(document).ready(function () {

		$("html").on("click", ".exportar", function (e) {
			e.preventDefault();
			var data = $(this).attr("rel");
			data = data.split("|");
			var informeInicial = data[0];
			var informeFinal = data[0];

			$("#aInformeInicial").attr("href", URI + "eventos/eventos/informe/=" + informeInicial);
			$("#aInformeFinal").attr("href", URI + "eventos/eventos/informe/=" + informeFinal);

			$("#informeModal").modal("show");

		});
		var table = $('.tbLista').DataTable(
			{
				dom: '<"html5buttons"B>lTfgitp',
				pageLength: 10,
				columns: [
					{
						"data": "Region"
					},
					{
						"data": "Provincia"
					},
					{
						"data": "Distrito"
					},
					{
						"data": "Lesionados_01"
					},
					{
						"data": "Fallecidos_01"
					},
					{
						"data": "Desaparecidos_01"
					},
					{
						"data": "Lesionados_02"
					},
					{
						"data": "Fallecidos_02"
					},
					{
						"data": "Desaparecidos_02"
					},
					{
						"data": "IPRESS_AO"
					},
					{
						"data": "IPRESS_AI"
					},
					{
						"data": "ESSALUD_A"
					},
					{
						"data": "Acciones"
					},
					{
						"data": "Brigadistas_Region"
					},
					{
						"data": "Brigadistas_Minsa"
					},
					{
						"data": "psPersonal_Saludalud"
					},
					{
						"data": "Oferta_Movil_I"
					},
					{
						"data": "Oferta_Movil_II"
					},
					{
						"data": "Oferta_Movil_III"
					},
					{
						"data": "Kit_Medicamentos"
					},
					{
						"data": "Mochila_Emergencia"
					}
				],
				"ajax": {
					url: URI + "eventos/reportes/listaEventosConsolidadoNacional",
					type: "POST",
					data: function (d) {
						d.departamento = document.getElementById("departamento").value,
							d.provincia = document.getElementById("provincia").value,
							d.distrito = document.getElementById("distrito").value,
							d.tipoEvento = document.getElementById("tipoEvento").value,
							d.evento = document.getElementById("evento").value,
							d.detalle = document.getElementById("detalle").value,
							d.eventoConsolidado = document.getElementById("eventoConsolidado").value,
							d.nivel = document.getElementById("nivelEmergencia").value,
							d.desde = document.getElementById("desde").value,
							d.hasta = document.getElementById("hasta").value,
							d.activar = document.getElementById("activar").value
					}
				},
				"drawCallback": function (settings) {
					$("#btnObtenerReporte").html("Obtener Reporte");
					$("#btnObtenerReporte").removeClass("disabled");
				},
				buttons: [
					{
						extend: 'copy',
						text: 'Copiar',
						title: 'Reporte Consolidado Nacional',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]
						}
					},
					{
						extend: 'csv',
						title: 'Reporte Consolidado Nacional',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]
						}
					},
					{
						extend: 'excel',
						title: 'Reporte Consolidado Nacional',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]
						}
					},
					{
						extend: 'pdf',
						title: 'Reporte Consolidado Nacional',
						orientation: 'landscape',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]
						}
					},

					{
						extend: 'print',
						text: 'Imprimir',
						title: 'Reporte Consolidado Nacional',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]
						},
						customize: function (win) {
							$(win.document.body).addClass('white-bg');
							$(win.document.body).css('font-size', '8px');

							$(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');

							var css = '@page { size: landscape; }', head = win.document.head
								|| win.document.getElementsByTagName('head')[0],
								style = win.document.createElement('style');

							style.type = 'text/css';
							style.media = 'print';

							if (style.styleSheet) {
								style.styleSheet.cssText = css;
							} else {
								style.appendChild(win.document.createTextNode(css));
							}

							head.appendChild(style);
						}
					}]
			});

		$("#departamento").change(function () {

			var id = $(this).val();

			if (id.length > 0) {

				$.ajax({
					data: {
						departamento: id
					},
					url: URI + "eventos/main/cargarProvincias",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#provincia").html('<option value="">Cargando...</option>');
						$("#distrito").html('<option value="0">-- TODOS --</option>');
					},
					success: function (data) {

						var $html = '<option value="0">-- TODOS --</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="' + e.Codigo_Provincia + '">' + e.Nombre + '</option>';

						});
						$("#provincia").html($html);

					}
				});

			}
		});

		$("#provincia").change(function () {

			var id = $(this).val();
			var departamento = $("#departamento").val();

			if (id.length > 0 && departamento.length > 0) {

				$.ajax({
					data: {
						departamento: departamento,
						provincia: id
					},
					url: URI + "eventos/main/cargarDistritos",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#distrito").html('<option value="">Cargando...</option>');
					},
					success: function (data) {

						var $html = '<option value="0">-- TODOS --</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="' + e.Codigo_Distrito + '">' + e.Nombre + '</option>';

						});
						$("#distrito").html($html);

					}
				});

			}
		});

		$("#tipoEvento").change(function () {

			id = $(this).val();

			if (id.length > 0) {

				$.ajax({
					data: {
						tipoEvento: id
					},
					url: URI +
						"eventos/eventos/cargarEvento",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#evento")
							.html(
								'<option value="">Cargando...</option>');
					},
					success: function (
						data) {

						var $html = '<option value="0">-- TODOS --</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="' + e.Evento_Codigo + '">' + e.Evento_Nombre + '</option>';

						});
						$("#evento").html($html);

					}
				});

			}

		}); // Change Evento

		$("#evento").change(function () {

			var id = $(this).val();
			var tipoEvento = $("#tipoEvento").val();

			if (id.length > 0 && tipoEvento.length) {

				if (id == "26" && tipoEvento == "01") $(".seismo").css("display", "inline-block");
				else $(".seismo").css("display", "none");

				$.ajax({
					data: {
						evento: id,
						tipoEvento: tipoEvento
					},
					url: URI + "eventos/eventos/cargarEventoDetalle",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#detalle").html('<option value="">Cargando...</option>');
					},
					success: function (data) {

						var $html = '<option value="0">-- TODOS --</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="' + e.Evento_Detalle_Codigo + '">' + e.Evento_Detalle_Nombre + '</option>';

						});
						$("#detalle").html($html);

					}
				});

			}

		});

		$("#btnObtenerReporte").on("click", function () {

			var tipoEvento = $("#departamento").val();
			var tipoEvento = $("#tipoprovincia").val();
			var tipoEvento = $("#tipodistrito").val();
			var tipoEvento = $("#tipoEvento").val();
			var evento = $("#evento").val();
			var detalle = $("#detalle").val();
			var nivel = $("#nivelEmergencia").val();
			var desde = $("#desde").val();
			var hasta = $("#hasta").val();

			if (desde.length != 10 || hasta.length != 10) {
				$("#alertaModal").modal("show");
				$("#alertaModal #tituloalerta").text("Error");
				$("#alertaModal #mensajealerta").html("Verifique las fechas");
				return false;

			} else {
				$("#activar").val(1);
			}

			$("#btnObtenerReporte").text("Cargando...");
			$("#btnObtenerReporte").addClass("disabled");
			$("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
			table.ajax.reload();

		});

	});

}