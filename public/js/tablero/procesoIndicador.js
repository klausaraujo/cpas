function procesoIndicador(URI) {

	setTimeout(function () { $(".alert").slideUp(); }, 3500);

	function anioEjecucion(form, object) {

		var anio = object.val();
		if (anio.length > 0) {

			$.ajax({
				url: URI + 'tablero/procesoIndicador/cargarProcesoIndicador',
				method: 'post',
				type: 'json',
				data: { anio: anio },
				error: function (xhr) { alert(xhr); },
				beforeSend: function () {
					$(form).find("select[name=Codigo_Proceso]").html('<option value="">Cargando...</option>');
					$(form).find("select[name=Codigo_Indicador]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {
					$(form).find("select[name=Codigo_Proceso]").html('<option value="">[Seleccione...]</option>');
					$(form).find("select[name=Codigo_Indicador]").html('<option value="">[Seleccione...]</option>');

					data = JSON.parse(data);
					$.each(data.indicadores, function (i, e) {
						$(form).find("select[name=Codigo_Indicador]").append('<option value="' + e.Codigo_Indicador + '">' + e.Codigo_Indicador + ' - ' + e.Nombre_Indicador + '</option>');
					});
					$.each(data.procesos, function (i, e) {
						$(form).find("select[name=Codigo_Proceso]").append('<option value="' + e.Codigo_Proceso + '">' + e.Codigo_Proceso + ' - ' + e.Descripcion_Proceso + '</option>');
					});
				}
			});
		}

	}

	anioEjecucion("#formRegistrar", $("#formRegistrar select[name=Anio_Ejecucion]"));

	$(document).ready(function () {

		$("#formCambioFecha select[name=Anio]").change(function () {
			var anio = $(this).val();
			if (anio.length > 0) {
				$("#formCambioFecha").submit();
			}

		});
		$("select[name=Anio_Ejecucion]").change(function () {
			anioEjecucion("#formRegistrar", $(this));
		});
		$("#btnRegistrar").on("click", function () {
			$("#registrarModal").modal("show");
		});

		jQuery.validator.addMethod("validarFormato", function (value, element) {
			return this.optional(element) || /^(\d+|\d+.\d{1,2})$/.test(value);
		}, "Formato incorrecto Ej: 12.60");

		$("#formRegistrar").validate({
			rules: {
				Codigo_Proceso: { required: true },
				Codigo_Indicador: { required: true },
				enero: { digits: true, min: 0, max: 99 },
				febrero: { digits: true, min: 0, max: 99 },
				marzo: { digits: true, min: 0, max: 99 },
				abril: { digits: true, min: 0, max: 99 },
				mayo: { digits: true, min: 0, max: 99 },
				junio: { digits: true, min: 0, max: 99 },
				julio: { digits: true, min: 0, max: 99 },
				agosto: { digits: true, min: 0, max: 99 },
				septiembre: { digits: true, min: 0, max: 99 },
				octubre: { digits: true, min: 0, max: 99 },
				noviembre: { digits: true, min: 0, max: 99 },
				diciembre: { digits: true, min: 0, max: 99 }
			},
			messages: {
				Codigo_Proceso: { required: "(*) Campo Requerido" },
				Codigo_Indicador: { required: "(*) Campo Requerido" },
				enero: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
				febrero: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
				marzo: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
				abril: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
				mayo: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
				junio: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
				julio: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
				agosto: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
				septiembre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
				octubre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
				noviembre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
				diciembre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" }
			},
			submitHandler: function (form, event) {

				event.preventDefault();

				form.submit();

			}
		});
	});

	$("#formActualizar").validate({
		rules: {
			Codigo_Proceso: { required: true },
			Codigo_Indicador: { required: true },
			enero: { digits: true, min: 0, max: 99 },
			febrero: { digits: true, min: 0, max: 99 },
			marzo: { digits: true, min: 0, max: 99 },
			abril: { digits: true, min: 0, max: 99 },
			mayo: { digits: true, min: 0, max: 99 },
			junio: { digits: true, min: 0, max: 99 },
			julio: { digits: true, min: 0, max: 99 },
			agosto: { digits: true, min: 0, max: 99 },
			septiembre: { digits: true, min: 0, max: 99 },
			octubre: { digits: true, min: 0, max: 99 },
			noviembre: { digits: true, min: 0, max: 99 },
			diciembre: { digits: true, min: 0, max: 99 },
			Costo_Total: { validarFormato: true }
		},
		messages: {
			Codigo_Proceso: { required: "(*) Campo Requerido" },
			Codigo_Indicador: { required: "(*) Campo Requerido" },
			enero: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
			febrero: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
			marzo: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
			abril: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
			mayo: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
			junio: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
			julio: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
			agosto: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
			septiembre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
			octubre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
			noviembre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" },
			diciembre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 99" }
		},
		submitHandler: function (form, event) {

			event.preventDefault();
			form.submit();
		}

	});

	$("#tbRegistroMeses input[type=text]").keydown(function (e) {
		var keyPress = (e.keyCode ? e.keyCode : e.which);
		if (parseInt(keyPress) == 9) {
			e.preventDefault();
			var indice = $(this).attr("rel");

			var ind = 0;
			$.each($("#tbRegistroMeses").find("input[type=text]"), function (i, e) {
				ind++;
			});
			if (parseInt(indice) == ind) {
				$("#tbRegistroMeses .mes1").focus();
			}
			else {
				var next = parseInt(indice) + 1;
				$("#tbRegistroMeses .mes" + next).focus();
			}
		}

	});

	var tbTablero = $('#tbListar').DataTable({
		dom: '<"html5buttons"B>lTfgitp',
		columns: [
			{ "data": "numero" },
			{ "data": "Anio_Ejecucion" },
			{ "data": "Siglas_Area" },
			{ "data": "Descripcion_Proceso" },
			{ "data": "Nombre_Indicador" },
			{ "data": "Total" },
			{ "data": "editar" },
			{ "data": "eliminar" },
			{ "data": "Enero" },
			{ "data": "Febrero" },
			{ "data": "Marzo" },
			{ "data": "Abril" },
			{ "data": "Mayo" },
			{ "data": "Junio" },
			{ "data": "Julio" },
			{ "data": "Agosto" },
			{ "data": "Septiembre" },
			{ "data": "Octubre" },
			{ "data": "Noviembre" },
			{ "data": "Diciembre" },
			{ "data": "Anio_Ejecucion" },
			{ "data": "Codigo_Proceso" },
			{ "data": "Codigo_Indicador" },
			{ "data": "idindicadorproceso" },
			{ "data": "Area" },
			{ "data": "Unidad" },
			{ "data": "orden" }
		],
		"lengthMenu": [[-1, 25, 50, 10], ["Todos", 25, 50, 100]],
		columnDefs: [
			{
				"targets": [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26],
				"visible": false,
				"searchable": true
			}
		],
		"order": [[25, "asc"]],
		buttons: [
			{ extend: 'copy', text: 'Copiar', title: 'Copiar', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },
			{ extend: 'csv', title: 'Csv', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },
			{ extend: 'excel', title: 'Excel', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },
			{ extend: 'pdf', title: 'Pdf', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },

			{
				extend: 'print',
				text: 'Imprimir',
				title: 'Imprimir',
				exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
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

	$("body").on("click", ".actionEdit", function () {

		$("#actualizarModal").modal("show");

		var tr = $(this).parents('tr');
		var row = tbTablero.row(tr);
		data = row.data();

		var id = data.idindicadorproceso;
		var Anio_Ejecucion = data.Anio_Ejecucion;
		var Codigo_Indicador = data.Codigo_Indicador;
		var Codigo_Proceso = data.Codigo_Proceso;

		$("#formActualizar input[name=Codigo_Area]").val(data.Area);
		$("#formActualizar input[name=Codigo_Unidad_Medida]").val(data.Unidad);

		$("#formActualizar select[name=Anio_Ejecucion]").val(Anio_Ejecucion);

		$.ajax({
			data: { idindicadorproceso: id },
			url: URI + "tablero/procesoIndicador/cargarDataProcesoIndicador",
			method: "POST",
			dataType: "json",
			beforeSend: function () {
				$("#formActualizar select[name=Codigo_Proceso]").html('<option value="">Cargando...</option>');
				$("#formActualizar select[name=Codigo_Indicador]").html('<option value="">Cargando...</option>');
			},
			success: function (data) {
				$("#formActualizar select[name=Codigo_Proceso]").html('<option value="">[Seleccione...]</option>');
				$("#formActualizar select[name=Codigo_Indicador]").html('<option value="">[Seleccione...]</option>');
				$.each(data.indicadores, function (i, e) {
					if (e.Codigo_Indicador == Codigo_Indicador) $("#formActualizar select[name=Codigo_Indicador]").append('<option value="' + e.Codigo_Indicador + '" selected>' + e.Codigo_Indicador + ' - ' + e.Nombre_Indicador + '</option>');
					else $("#formActualizar select[name=Codigo_Indicador]").append('<option value="' + e.Codigo_Indicador + '">' + e.Codigo_Indicador + ' - ' + e.Nombre_Indicador + '</option>');
				});
				$.each(data.procesos, function (i, e) {
					if (e.Codigo_Proceso == Codigo_Proceso) $("#formActualizar select[name=Codigo_Proceso]").append('<option value="' + e.Codigo_Proceso + '" selected>' + e.Codigo_Proceso + ' - ' + e.Descripcion_Proceso + '</option>');
					else $("#formActualizar select[name=Codigo_Proceso]").append('<option value="' + e.Codigo_Proceso + '">' + e.Codigo_Proceso + ' - ' + e.Descripcion_Proceso + '</option>');
				});

				var dato = data.registro;
				$("#formActualizar input[name=enero]").val(dato.Enero);
				$("#formActualizar input[name=febrero]").val(dato.Febrero);
				$("#formActualizar input[name=marzo]").val(dato.Marzo);
				$("#formActualizar input[name=mayo]").val(dato.Mayo);
				$("#formActualizar input[name=abril]").val(dato.Abril);
				$("#formActualizar input[name=junio]").val(dato.Junio);
				$("#formActualizar input[name=julio]").val(dato.Julio);
				$("#formActualizar input[name=agosto]").val(dato.Agosto);
				$("#formActualizar input[name=septiembre]").val(dato.Septiembre);
				$("#formActualizar input[name=octubre]").val(dato.Octubre);
				$("#formActualizar input[name=noviembre]").val(dato.Noviembre);
				$("#formActualizar input[name=diciembre]").val(dato.Diciembre);

				$("#formActualizar input[name=hCodigo_Proceso]").val(Codigo_Proceso);
				$("#formActualizar input[name=hAnio_EJecucion]").val(Anio_Ejecucion);
				$("#formActualizar input[name=idindicadorproceso]").val(dato.idindicadorproceso);
			}
		});

	});

	$("body").on("click", ".actionDelete", function () {
		$("#deleteModal input[name=idindicadorproceso]").val("");
		$('#deleteModal').modal('show');

		var tr = $(this).parents('tr');
		var row = tbTablero.row(tr);
		data = row.data();

		$("#deleteModal input[name=idindicadorproceso]").val(data.idindicadorproceso);
		$("#deleteModal #numero").text(data.numero);

	});

	$("#formRegistrar select[name=Codigo_Proceso]").on("change", function () {

		var id = $(this).val();
		if (id.length > 2) {

			$.ajax({
				data: { Codigo_Proceso: id },
				url: URI + "tablero/procesoIndicador/areaYunidad",
				method: "POST",
				dataType: "json",
				beforeSend: function () {
					$("#formRegistrar select[name=Codigo_Proceso]").attr("disabled", "disabled");
				},
				error: function () {
					$("#formRegistrar select[name=Codigo_Proceso]").removeAttr("disabled");
				},
				success: function (data) {
					$("#formRegistrar select[name=Codigo_Proceso]").removeAttr("disabled");
					console.log(data);

					dato = data.datos;
					$("#formRegistrar input[name=Codigo_Area]").val(dato.Area);
					$("#formRegistrar input[name=Codigo_Unidad_Medida]").val(dato.Unidad);

				}
			});

		}

	});

}
