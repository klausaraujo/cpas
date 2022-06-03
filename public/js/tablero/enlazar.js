function enlazar(URI) {

	setTimeout(function () {
		$(".alert").slideUp();
	}, 2500);

	$(document).ready(function () {

		var tbTablero = $('#tbListar').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "Anio_Ejecucion" },
				{ "data": "Nombre_Area" },
				{ "data": "Codigo_Actividad_POI" },
				{ "data": "Id_Actividad_POI" },
				{ "data": "Descripcion_Actividad" },
				{ "data": "Codigo_Area" },
				{ "data": "eliminar" }
			],
			"lengthMenu": [[-1, 25, 50, 100], ["Todos", 25, 50, 100]],
			columnDefs: [
				{
					"targets": [5, 3],
					"visible": false,
					"searchable": true
				},
				{
					targets: [0, 1, 2, 3],
					className: 'text-center'
				},
				{
					width: "30%",
					targets: 1
				},
				{
					width: "50%",
					targets: 4
				}
			],
			"ajax": {
				url: URI + "tablero/procesoIndicador/listarEnlace",
				type: "POST",
				data: function (d) {
					d.Anio_Ejecucion = document.getElementById("Anio").value;
					d.Codigo_Area = document.getElementById("Codigo_Area").value;
					d.Id_Actividad_POI = document.getElementById("cboActividadPOI").value;
				}
			},
			buttons: [
				{ extend: 'copy', text: 'Copiar', title: 'Enlace', exportOptions: { columns: [0, 1, 2] } },
				{ extend: 'csv', title: 'Enlace', exportOptions: { columns: [0, 1, 2] } },
				{ extend: 'excel', title: 'Enlace', exportOptions: { columns: [0, 1, 2] } },
				{ extend: 'pdf', title: 'Enlace', orientation: 'landscape', exportOptions: { columns: [0, 1, 2] } },
				{
					extend: 'print',
					text: 'Imprimir',
					title: 'Enlace',
					exportOptions: { columns: [0, 1, 2] },
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
				}
			]

		});

		$("select[name=Anio]").on("change", function () {

			var anio = $(this).val();

			if (anio.length > 0) {

				$.ajax({
					url: URI + 'tablero/procesoIndicador/recargarCombosEnlace',
					method: 'post',
					type: 'json',
					data: { anio: anio },
					error: function (xhr) { },
					beforeSend: function () {
						$("select[name=Codigo_Area]").html('<option value="">Cargando...</option>');
						$("select[name=cboActividadPOI]").html('<option value="">Cargando...</option>');
					},
					success: function (data) {
						data = JSON.parse(data);
						$htmlArea = '<option value="">-- Seleccione --</option>';
						$htmlPOI = '<option value="">-- Seleccione --</option>';
						$.each(data.listaAreas, function (i, e) {
							$htmlArea += '<option value="' + e.Codigo_Area + '">' + e.Nombre_Area + '</option>'

						});
						$("select[name=Codigo_Area]").html($htmlArea);

						$.each(data.listaActividadesPOI, function (i, e) {
							$htmlPOI += '<option value="' + e.Id_Actividad_POI + '">' + e.Codigo_Actividad_POI + ' ' + e.Descripcion_Actividad + '</option>'
						});
						$("select[name=cboActividadPOI]").html($htmlPOI);
					}

				});

			}
		});

		$("select[name=Codigo_Area]").on("change", function () {

			var anio = $("#Anio").val();
			var Codigo_Area = $(this).val();

			if (anio.length > 0 && Codigo_Area.length > 0) {
				tbTablero.ajax.reload();
			}
		});

		$("#formRegistrarEnlace").validate({
			rules: {
				Anio_Ejecucion: { required: true },
				Codigo_Area: { required: true },
				cboActividadPOI: { required: true },
			},
			messages: {
				Anio_Ejecucion: { required: "(*) Campo Requerido" },
				Codigo_Area: { required: "(*) Campo Requerido" },
				cboActividadPOI: { required: "(*) Campo Requerido" },
			},
			submitHandler: function (form, event) {

				event.preventDefault();

				$.ajax({
					url: URI + "tablero/procesoIndicador/registrarEnlace",
					data: $("#formRegistrarEnlace").serialize(),
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
						$("#message").html("");
						$("#message").slideDown();
					},
					error: function () {
						$("#modalCargaGeneral").css("display", "none");
					},
					success: function (data) {
						$("#modalCargaGeneral").css("display", "none");

						var $message = "";
						if (parseInt(data.status) == 200) $message = '<div class="alert alert-success"><h4 style="margin:0">Enlace registrado exitosamente</h4></div>';
						else if (parseInt(data.status) == 201) $message = '<div class="alert alert-warning"><h4 style="margin:0">No se registro el enlace, ya existe</h4></div>';
						else $message = '<div class="alert alert-danger"><h4 style="margin:0">No se pudo registrar, vuelva a intentar</h4></div>';

						$('html, body').animate({ scrollTop: 0 }, 'fast');

						$("#message").html($message);
						setTimeout(function () { $("#message").slideUp(); $("#message").html(""); }, 2500);
						tbTablero.ajax.reload();

					}
				});

			}
		});

		$('body').on('click', 'td .delete', function () {
			var tr = $(this).parents('tr');
			var row = tbTablero.row(tr);

			index = row.index();
			datos = row.data();

			$("#formDelete input[name=Anio_Ejecucion]").val(datos.Anio_Ejecucion);
			$("#formDelete input[name=Codigo_Area]").val(datos.Codigo_Area);
			$("#formDelete input[name=Id_Actividad_POI]").val(datos.Id_Actividad_POI);

			$("#deleteModal").modal("show");

		});

	});

}
