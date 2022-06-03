function gestionarTarea() {

	setTimeout(function () { $(".alert").slideUp(); }, 3500);

	function calcularRango(objeto) {

		var diferencia = 0;

		setTimeout(function () {
			var fechaInicial = $(objeto).find("input[name=Fecha_Inicio]").val();
			var fechaFinal = $(objeto).find("input[name=Fecha_Fin]").val();

			if (fechaInicial.length > 0 && fechaFinal.length > 0) {

				fia = fechaInicial.split("/");
				ffa = fechaFinal.split("/");
				fechaInicial = moment(fia[2] + "-" + fia[1] + "-" + fia[0]);
				fechaFinal = moment(ffa[2] + "-" + ffa[1] + "-" + ffa[0]);
				diferencia = fechaFinal.diff(fechaInicial, 'days');

				$(objeto).find("input[name=Duracion_Dias]").val(diferencia);
			}
		}, 500);

	}

	$(document).ready(function () {

		$(".datepicker").datepicker({
			language: "es",
			autoclose: true
		});
		$("#formCambioFecha select[name=Anio]").change(function () {
			var anio = $(this).val();
			if (anio.length > 0) {
				$("#formCambioFecha").submit();
			}

		});

		$("#formRegistrar input[name=Fecha_Inicio],#formRegistrar input[name=Fecha_Fin]").focusout(function () {

			calcularRango("#formRegistrar");

		});

		$("#Fecha_Inicio,#Fecha_Fin").focusout(function () {

			calcularRango("#formActualizar");

		});

		jQuery.validator.addMethod("validarFormato", function (value, element) {
			return this.optional(element) || /^(\d+|\d+.\d{1,2})$/.test(value);
		}, "Formato incorrecto Ej: 12.60");

		$("#formRegistrar").validate({
			rules: {
				Anio_Ejecucion: { required: true },
				Codigo_Indicador: { required: true },
				Nombre_Tarea: { required: true },
				Costo_Tarea: { validarFormato: true }
			},
			messages: {
				Anio_Ejecucion: { required: "(*) Campo Requerido" },
				Codigo_Indicador: { required: "(*) Campo Requerido" },
				Nombre_Tarea: { required: "(*) Campo Requerido" }
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				var fecha1 = $("#formRegistrar input[name=Fecha_Inicio]").val();
				var fecha2 = $("#formRegistrar input[name=Fecha_Fin]").val();

				var diferencia = 0;

				if (fecha1.length > 0 && fecha2.length > 0) {
					fia = fecha1.split("/");
					ffa = fecha2.split("/");
					fecha1 = moment(fia[2] + "-" + fia[1] + "-" + fia[0]);
					fecha2 = moment(ffa[2] + "-" + ffa[1] + "-" + ffa[0]);
					diferencia = fecha2.diff(fecha1, 'days');

				}

				if (diferencia < 1) {
					$("#alertaModal").modal("show");
					$("#alertaModal #tituloalerta").text("Error en Fechas");
					$("#alertaModal #mensajealerta").text("La fecha inicial no puede ser mayor o igual a la fecha final");
					return false;
				}
				else {
					form.submit();
				}

			}
		});

		$("#formActualizar").validate({
			rules: {
				Codigo_Indicador: { required: true },
				Nombre_Tarea: { required: true },
				Costo_Tarea: { validarFormato: true }
			},
			messages: {
				Codigo_Indicador: { required: "(*) Campo Requerido" },
				Nombre_Tarea: { required: "(*) Campo Requerido" },
				Costo_Tarea: { validarFormato: "(*) Campo Requerido" }
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				var fecha1 = $("#formActualizar input[name=Fecha_Inicio]").val();
				var fecha2 = $("#formActualizar input[name=Fecha_Fin]").val();

				var diferencia = 0;

				if (fecha1.length > 0 && fecha2.length > 0) {
					fia = fecha1.split("/");
					ffa = fecha2.split("/");
					fecha1 = moment(fia[2] + "-" + fia[1] + "-" + fia[0]);
					fecha2 = moment(ffa[2] + "-" + ffa[1] + "-" + ffa[0]);
					diferencia = fecha2.diff(fecha1, 'days');

				}

				if (diferencia < 1) {
					$("#alertaModal").modal("show");
					$("#alertaModal #tituloalerta").text("Error en Fechas");
					$("#alertaModal #mensajealerta").text("La fecha inicial no puede ser mayor o igual a la fecha final");
					return false;
				}
				else {
					form.submit();
				}

			}
		});

		var tbListar = $('#tbListar').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "numero" },
				{ "data": "Nombre_Tarea" },
				{ "data": "Costo_Tarea" },
				{ "data": "Duracion_Dias" },
				{ "data": "Fecha_Inicio" },
				{ "data": "Fecha_Fin" },
				{ "data": "Estado" },
				{ "data": "Editar" },
				{ "data": "Eliminar" },
				{ "data": "Anio_Ejecucion" },
				{ "data": "Codigo_Indicador" },
				{ "data": "Codigo_Tarea" },
				{ "data": "Activo" }
			],
			"lengthMenu": [[-1, 25, 50, 100], ["Todos", 25, 50, 100]],
			columnDefs: [
				{
					"targets": [9, 10, 11, 12],
					"visible": false,
					"searchable": false
				}
			],
			buttons: [
				{ extend: 'copy', text: 'Copiar', title: 'Copiar', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] } },
				{ extend: 'csv', title: 'Csv', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] } },
				{ extend: 'excel', title: 'Excel', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] } },
				{ extend: 'pdf', title: 'Pdf', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] } },

				{
					extend: 'print',
					text: 'Imprimir',
					title: 'Imprimir',
					exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
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
		$("body").on("click", ".actionDelete", function () {
			$("#deleteModal input[name=Anio_Ejecucion]").val("");
			$("#deleteModal input[name=Codigo_Indicador]").val("");
			$("#deleteModal input[name=Codigo_Tarea]").val("");
			$('#deleteModal').modal('show');

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();

			$("#deleteModal input[name=Anio_Ejecucion]").val(data.Anio_Ejecucion);
			$("#deleteModal input[name=Codigo_Indicador]").val(data.Codigo_Indicador);
			$("#deleteModal input[name=Codigo_Tarea]").val(data.Codigo_Tarea);
			$("#deleteModal #numero").text(data.numero);

		});
		$("body").on("click", ".actionEdit", function () {

			$("#actualizarModal").modal("show");

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();

			var index = row.index();
			$("#actualizarModal input[name=Codigo_Tarea]").val(data.Codigo_Tarea);
			$("#actualizarModal input[name=Anio_Ejecucion]").val(data.Anio_Ejecucion);
			$("#Anio_Ejecucion").val(data.Anio_Ejecucion);
			$("#Nombre_Tarea").val(data.Nombre_Tarea);
			$("#Costo_Tarea").val(data.Costo_Tarea);
			$("#Duracion_Dias").val(data.Duracion_Dias);
			$("#Fecha_Inicio").val(data.Fecha_Inicio);
			$("#Fecha_Fin").val(data.Fecha_Fin);
			$("#Codigo_Indicador").val(data.Codigo_Indicador);
			$("#actualizarModal input[name=Codigo_Indicador]").val(data.Codigo_Indicador);
			$("#Activo").val(data.Activo);
		});
	});

}
