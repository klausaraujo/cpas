function asignacionIndicadorActividadPOI(URI) {

	setTimeout(function () { $(".alert").slideUp(); }, 3500);

	$(document).ready(function () {

		$("#formCambioFecha select[name=Anio]").change(function () {
			var anio = $(this).val();
			if (anio.length > 0) {
				$("#formCambioFecha").submit();
			}

		});

		var tbIndicador = $('.tbIndicador').DataTable({
			pageLength: 10,
			"lengthMenu": [[-1, 10, 20], ["Todos", 10, 20]],
			columns: [
				{ "data": "ID" },
				{ "data": "Anio_Ejecucion" },
				{ "data": "Nombre_Indicador" }
			]
		});

		var tbListar = $('#tbListar').DataTable(
			{
				dom: '<"html5buttons"B>lTfgitp',
				columns: [
					{ "data": "ID" },
					{ "data": "Anio" },
					{ "data": "Actividad_POI" },
					{ "data": "Programado" },
					{ "data": "IDI" },
					{ "data": "Indicador" },
					{ "data": "Agregar" },
					{ "data": "Quitar" },
					{ "data": "Unidad_Medida" },
					{ "data": "Anio_Ejecucion" }
				],
				"lengthMenu": [[-1, 25, 50, 100], ["Todos", 25, 50, 100]],
				columnDefs: [{
					"targets": [8, 9],
					"visible": false,
					"searchable": false
				}],
				buttons: [
					{
						extend: 'copy',
						text: 'Copiar',
						title: 'Copiar',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5]
						}
					},
					{
						extend: 'csv',
						title: 'Csv',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5]
						}
					},
					{
						extend: 'excel',
						title: 'Excel',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5]
						}
					},
					{
						extend: 'pdf',
						title: 'Pdf',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5]
						}
					},

					{
						extend: 'print',
						text: 'Imprimir',
						title: 'Imprimir',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5]
						},
						customize: function (win) {
							$(win.document.body).addClass('white-bg');
							$(win.document.body).css('font-size', '10px');

							$(win.document.body)
								.find('table').addClass('compact').css('font-size', 'inherit');

							var css = '@page { size: landscape; }', head = win.document.head
								|| win.document.getElementsByTagName('head')[0], style = win.document.createElement('style');

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

		$("body").on("click", ".actionDelete", function () {
			$("input[name=asignar]").val("");
			$("input[name=Id_Indicador]").val("");
			$("input[name=Anio_Ejecucion]").val("");
			$('#deleteModal').modal('show');

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();
			console.log("id", data.ID);
			console.log("IDI", data.IDI);
			console.log("Anio_ejecucion", data.Anio_Ejecucion);
			$("input[name=asignar]").val(data.ID);
			$("input[name=Id_Indicador]").val(data.IDI);
			$("input[name=Anio_Ejecucion]").val(data.Anio_Ejecucion);

		});

		$("body").on("click", ".actionAdd", function () {
			$("input[name=asignar]").val("");
			$("input[name=Id_Indicador]").val("");
			$("input[name=Anio_Ejecucion]").val("");
			$('#tbIndicadorModal').modal('show');
			$("#btnAsignar").addClass("disabled");
			$("#textoActividadPOI").html("");
			tbIndicador.$('tr.selected').removeClass('selected');

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();

			$("input[name=asignar]").val(data.ID);
			$("#textoActividadPOI").html(data.Actividad_POI);

		});

		$('.tbIndicador tbody').on('click', 'tr', function () {
			$("input[name=Id_Indicador").val("");
			$("input[name=Anio_Ejecucion").val("");
			var data = tbIndicador.row(this).data();
			$("input[name=Id_Indicador").val(data.ID);
			$("input[name=Anio_Ejecucion").val(data.Anio_Ejecucion);

			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
				$("input[name=Id_Indicador").val("");
				$("input[name=Anio_Ejecucion").val("");
				$("#btnAsignar").addClass("disabled");
			} else {
				tbIndicador.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
				$("#btnAsignar").removeClass("disabled");
			}
		});

		$("#btnAsignar").on("click", function (e) {

			e.preventDefault();

			var actividadPOI = $("input[name=asignar]").val();
			var indicador = $("input[name=Id_Indicador").val();
			var Anio_Ejecucion = $("input[name=Anio_Ejecucion").val();

			if (actividadPOI.length == 0 || indicador.length == 0 || Anio_Ejecucion.length == 0) return;

			$.ajax({
				type: "POST",
				url: URI + "tablero/procesoIndicador/asignarIndicadorActividadPOIAjax",
				data: { Id_Actividad_POI: actividadPOI, IdIndicador: indicador, Anio_Ejecucion: Anio_Ejecucion },
				dataType: "json",
				beforeSend: function () {
					$("#btnAsignar").html('<i class="fa fa-spinner fa-spin"></i>');
					$("#btnAsignar").addClass('disabled');
					$("#btnAsignar").css('pointer-events', 'none');
				},
				success: function (data) {

					location.href = URI + "tablero/procesoIndicador/asignacion";

				}
			});

		});

		$("#btnQuitar").on("click", function (e) {

			e.preventDefault();

			var actividadPOI = $("input[name=asignar]").val();
			var indicador = $("input[name=Id_Indicador").val();
			var Anio_Ejecucion = $("input[name=Anio_Ejecucion").val();

			if (actividadPOI.length == 0 || indicador.length == 0 || Anio_Ejecucion.length == 0) return;

			$.ajax({
				type: "POST",
				url: URI + "tablero/procesoIndicador/quitarIndicadorActividadPOIAjax",
				data: { Id_Actividad_POI: actividadPOI, IdIndicador: indicador, Anio_Ejecucion: Anio_Ejecucion },
				dataType: "json",
				beforeSend: function () {
					$("#btnQuitar").html('<i class="fa fa-spinner fa-spin"></i>');
					$("#btnQuitar").addClass('disabled');
					$("#btnQuitar").css('pointer-events', 'none');
				},
				success: function (data) {

					location.href = URI + "tablero/procesoIndicador/asignacion";

				}
			});

		});
	});

}
