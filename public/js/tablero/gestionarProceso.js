function gestionarProceso(URI, Anio_Ejecucion) {

	setTimeout(function () { $(".alert").slideUp(); }, 3500);

	function cboAnio(form, anio, sector, proyecto, actividad, programa, finalidad) {

		$.ajax({
			url: URI + 'general/cargarVariosPorAnio',
			method: 'post',
			type: 'json',
			data: { anio: anio },
			error: function (xhr) { alert(xhr); },
			beforeSend: function () {

				$(form).find("input[name=cboSector]").val("Cargando...");
				$(form).find("input[name=cboPliego]").val("Cargando...");
				$(form).find("input[name=cboEjecutora]").val("Cargando...");
				$(form).find("input[name=cboCentroCostos]").val("Cargando...");
				$(form).find("input[name=cboSubCentroCostos]").val("Cargando...");
				$(form).find("input[name=cboProgramaPresupuestal]").val("Cargando...");

				$(form).find("select[name=cbActividadProyecto]").html('<option value="">Cargando...</option>');
				$(form).find("select[name=cboActividad]").html('<option value="">Cargando...</option>');
				$(form).find("select[name=cboFinalidad]").html('<option value="">Cargando...</option>');
			},
			success: function (data) {
				$(form).find("select[name=cbActividadProyecto]").html('<option value="">[Seleccione...]</option>');
				$(form).find("select[name=cboActividad]").html('<option value="">[Seleccione...]</option>');
				$(form).find("select[name=cboFinalidad]").html('<option value="">[Seleccione...]</option>');

				data = JSON.parse(data);

				$(form).find("input[name=cboSector]").val(data["cadenaPresupuestal"]["cadena"].Nombre_Sector);
				$(form).find("input[name=cboPliego]").val(data["cadenaPresupuestal"]["cadena"].Nombre_Pliego);
				$(form).find("input[name=cboEjecutora]").val(data["cadenaPresupuestal"]["cadena"].Nombre_Ejecutora);
				$(form).find("input[name=cboCentroCostos]").val(data["cadenaPresupuestal"]["cadena"].Nombre_Centro_Costos);
				$(form).find("input[name=cboSubCentroCostos]").val(data["cadenaPresupuestal"]["cadena"].Nombre_Sub_Centro_Costos);
				$(form).find("input[name=cboProgramaPresupuestal]").val(data["cadenaPresupuestal"]["programa"].Nombre_Programa_Presupuestal);

				$.each(data["proyecto"], function (i, e) {
					if (proyecto == e.Codigo_Actividad_Proyecto) $(form).find("select[name=cbActividadProyecto]").append('<option value="' + e.Codigo_Actividad_Proyecto + '" selected>' + e.Codigo_Actividad_Proyecto + ' - ' + e.Nombre_Actividad_Proyecto + '</option>');
					else $(form).find("select[name=cbActividadProyecto]").append('<option value="' + e.Codigo_Actividad_Proyecto + '">' + e.Codigo_Actividad_Proyecto + ' - ' + e.Nombre_Actividad_Proyecto + '</option>');
				});
				$.each(data["actividad"], function (i, e) {
					if (actividad == e.Codigo_Actividad) $(form).find("select[name=cboActividad]").append('<option value="' + e.Codigo_Actividad + '" selected>' + e.Codigo_Actividad + ' - ' + e.Nombre_Actividad + '</option>');
					else $(form).find("select[name=cboActividad]").append('<option value="' + e.Codigo_Actividad + '">' + e.Codigo_Actividad + ' - ' + e.Nombre_Actividad + '</option>');
				});
				$.each(data["finalidad"], function (i, e) {
					if (finalidad == e.Codigo_Finalidad) $(form).find("select[name=cboFinalidad]").append('<option value="' + e.Codigo_Finalidad + '" selected>' + e.Codigo_Finalidad + ' - ' + e.Nombre_Finalidad + '</option>');
					else $(form).find("select[name=cboFinalidad]").append('<option value="' + e.Codigo_Finalidad + '">' + e.Codigo_Finalidad + ' - ' + e.Nombre_Finalidad + '</option>');
				});
			}
		});

	}

	function cboSector(form, anio, sector, pliego) {

		$.ajax({
			url: URI + 'general/cargarPliegos',
			method: 'post',
			type: 'json',
			data: { anio: anio, sector: sector },
			error: function (xhr) { alert(xhr); },
			beforeSend: function () {
				$(form).find("select[name=cboPliego]").html('<option value="">Cargando...</option>');
			},
			success: function (data) {
				$(form).find("select[name=cboPliego]").html('<option value="">[Seleccione...]</option>');

				data = JSON.parse(data);
				$.each(data, function (i, e) {
					if (pliego == e.Codigo_Pliego) $(form).find("select[name=cboPliego]").append('<option value="' + e.Codigo_Pliego + '" selected>' + e.Codigo_Pliego + ' - ' + e.Nombre_Pliego + '</option>');
					else $(form).find("select[name=cboPliego]").append('<option value="' + e.Codigo_Pliego + '">' + e.Codigo_Pliego + ' - ' + e.Nombre_Pliego + '</option>');
				});
			}
		});

	}

	function cboPliego(form, anio, sector, pliego, ejecutora) {

		$.ajax({
			url: URI + 'general/cargarEjecutoras',
			method: 'post',
			type: 'json',
			data: { anio: anio, sector: sector, pliego: pliego },
			error: function (xhr) { alert(xhr); },
			beforeSend: function () {
				$(form).find("select[name=cboEjecutora]").html('<option value="">Cargando...</option>');
			},
			success: function (data) {
				$(form).find("select[name=cboEjecutora]").html('<option value="">[Seleccione...]</option>');

				data = JSON.parse(data);
				$.each(data, function (i, e) {
					if (ejecutora == e.Codigo_Ejecutora) $(form).find("select[name=cboEjecutora]").append('<option value="' + e.Codigo_Ejecutora + '" selected>' + e.Codigo_Ejecutora + ' - ' + e.Nombre_Ejecutora + '</option>');
					else $(form).find("select[name=cboEjecutora]").append('<option value="' + e.Codigo_Ejecutora + '">' + e.Codigo_Ejecutora + ' - ' + e.Nombre_Ejecutora + '</option>');
				});
			}
		});

	}

	function cboEjecutora(form, anio, sector, pliego, ejecutora, centroCostos) {

		$.ajax({
			url: URI + 'general/cargarCentroCostos',
			method: 'post',
			type: 'json',
			data: { anio: anio, sector: sector, pliego: pliego, ejecutora: ejecutora },
			error: function (xhr) { alert(xhr); },
			beforeSend: function () {
				$(form).find("select[name=cboCentroCostos]").html('<option value="">Cargando...</option>');
			},
			success: function (data) {
				$(form).find("select[name=cboCentroCostos]").html('<option value="">[Seleccione...]</option>');

				data = JSON.parse(data);
				$.each(data, function (i, e) {
					if (centroCostos == e.Codigo_Centro_Costos) $(form).find("select[name=cboCentroCostos]").append('<option value="' + e.Codigo_Centro_Costos + '" selected>' + e.Codigo_Centro_Costos + ' - ' + e.Nombre_Centro_Costos + '</option>');
					else $(form).find("select[name=cboCentroCostos]").append('<option value="' + e.Codigo_Centro_Costos + '">' + e.Codigo_Centro_Costos + ' - ' + e.Nombre_Centro_Costos + '</option>');
				});
			}
		});

	}

	function cboCentroCostos(form, anio, sector, pliego, ejecutora, centroCostos, subCentroCostos) {

		$.ajax({
			url: URI + 'general/cargarSubCentroCostos',
			method: 'post',
			type: 'json',
			data: { anio: anio, sector: sector, pliego: pliego, ejecutora: ejecutora, centroCostos: centroCostos },
			error: function (xhr) { alert(xhr); },
			beforeSend: function () {
				$(form).find("select[name=cboSubCentroCostos]").html('<option value="">Cargando...</option>');
			},
			success: function (data) {
				$(form).find("select[name=cboSubCentroCostos]").html('<option value="">[Seleccione...]</option>');

				data = JSON.parse(data);
				$.each(data, function (i, e) {
					if (subCentroCostos == e.Codigo_Centro_Costos) $(form).find("select[name=cboSubCentroCostos]").append('<option value="' + e.Codigo_Sub_Centro_Costos + '" selected>' + e.Codigo_Sub_Centro_Costos + ' - ' + e.Nombre_Sub_Centro_Costos + '</option>');
					else $(form).find("select[name=cboSubCentroCostos]").append('<option value="' + e.Codigo_Sub_Centro_Costos + '">' + e.Codigo_Sub_Centro_Costos + ' - ' + e.Nombre_Sub_Centro_Costos + '</option>');
				});
			}
		});

	}

	$(document).ready(function () {

		cboAnio("#formRegistrar", Anio_Ejecucion, "", "", "", "", "");

		$("#formCambioFecha select[name=Anio]").change(function () {
			var anio = $(this).val();
			if (anio.length > 0) {
				$("#formCambioFecha").submit();
			}

		});

		$("#formRegistrar select[name=cboAnio]").change(function () {
			var anio = $(this).val();
			if (anio.length > 0) {
				cboAnio("#formRegistrar", anio, "", "", "", "", "");
			}
		});
		$("#formActualizar select[name=cboAnio]").change(function () {
			var anio = $(this).val();
			if (anio.length > 0) {
				cboAnio("#formActualizar", anio, "", "", "", "", "");
			}
		});

		$("#formRegistrar select[name=cboSector]").change(function () {
			var anio = $("#formRegistrar select[name=cboAnio]").val();
			var sector = $(this).val();
			if (sector.length > 0) {
				cboSector("#formRegistrar", anio, sector, "");
			}
		});

		$("#formActualizar select[name=cboSector]").change(function () {
			var anio = $("#formActualizar select[name=cboAnio]").val();
			var sector = $(this).val();
			if (sector.length > 0) {
				cboSector("#formActualizar", anio, sector, "");
			}
		});

		$("#formRegistrar select[name=cboPliego]").change(function () {
			var anio = $("#formRegistrar select[name=cboAnio]").val();
			var sector = $("#formRegistrar select[name=cboSector]").val();
			var pliego = $(this).val();
			if (sector.length > 0) {
				cboPliego("#formRegistrar", anio, sector, pliego, "");
			}
		});

		$("#formActualizar select[name=cboPliego]").change(function () {
			var anio = $("#formActualizar select[name=cboAnio]").val();
			var sector = $("#formActualizar select[name=cboSector]").val();
			var pliego = $(this).val();
			if (sector.length > 0) {
				cboPliego("#formActualizar", anio, sector, pliego, "");
			}
		});

		$("#formRegistrar select[name=cboEjecutora").change(function () {
			var anio = $("#formRegistrar select[name=cboAnio]").val();
			var sector = $("#formRegistrar select[name=cboSector]").val();
			var pliego = $("#formRegistrar select[name=cboPliego]").val();
			var ejecutora = $(this).val();
			if (ejecutora.length > 0) {
				cboEjecutora("#formRegistrar", anio, sector, pliego, ejecutora, "");
			}
		});

		$("#formActualizar select[name=cboEjecutora").change(function () {
			var anio = $("#formActualizar select[name=cboAnio]").val();
			var sector = $("#formActualizar select[name=cboSector]").val();
			var pliego = $("#formActualizar select[name=cboPliego]").val();
			var ejecutora = $(this).val();
			if (ejecutora.length > 0) {
				cboEjecutora("#formActualizar", anio, sector, pliego, ejecutora, "");
			}
		});

		$("#formRegistrar select[name=cboCentroCostos]").change(function () {
			var anio = $("#formRegistrar select[name=cboAnio]").val();
			var sector = $("#formRegistrar select[name=cboSector]").val();
			var pliego = $("#formRegistrar select[name=cboPliego]").val();
			var ejecutora = $("#formRegistrar select[name=cboEjecutora]").val();
			var centroCostos = $(this).val();
			if (centroCostos.length > 0) {
				cboCentroCostos("#formRegistrar", anio, sector, pliego, ejecutora, centroCostos, "");
			}
		});

		$("#formActualizar select[name=cboCentroCostos]").change(function () {
			var anio = $("#formActualizar select[name=cboAnio]").val();
			var sector = $("#formActualizar select[name=cboSector]").val();
			var pliego = $("#formActualizar select[name=cboPliego]").val();
			var ejecutora = $("#formActualizar select[name=cboEjecutora]").val();
			var centroCostos = $(this).val();
			if (centroCostos.length > 0) {
				cboCentroCostos("#formActualizar", anio, sector, pliego, ejecutora, centroCostos, "");
			}
		});

		$(".datepicker").datepicker({
			language: "es"
		});

		jQuery.validator.addMethod("validarFormato", function (value, element) {
			return this.optional(element) || /^(\d+|\d+.\d{1,2})$/.test(value);
		}, "Formato incorrecto Ej: 12000.60");

		$("#formRegistrar").validate({
			rules: {
				cboAnio: { required: true },
				cboSector: { required: true },
				cboPliego: { required: true },
				cboEjecutora: { required: true },
				cboCentroCostos: { required: true },
				cboSubCentroCostos: { required: true },
				cboProgramaPresupuestal: { required: true },
				cbActividadProyecto: { required: true },
				cboActividad: { required: true },
				cboFinalidad: { required: true },
				cboUnidadMedida: { required: true },
				Costo_Programa: { required: true, validarFormato: true },
				enero: { digits: true, min: 0, max: 1000 },
				febrero: { digits: true, min: 0, max: 1000 },
				marzo: { digits: true, min: 0, max: 1000 },
				abril: { digits: true, min: 0, max: 1000 },
				mayo: { digits: true, min: 0, max: 1000 },
				junio: { digits: true, min: 0, max: 1000 },
				julio: { digits: true, min: 0, max: 1000 },
				agosto: { digits: true, min: 0, max: 1000 },
				septiembre: { digits: true, min: 0, max: 1000 },
				octubre: { digits: true, min: 0, max: 1000 },
				noviembre: { digits: true, min: 0, max: 1000 },
				diciembre: { digits: true, min: 0, max: 1000 },
				Nombre: { required: true }
			},
			messages: {
				cboAnio: { required: "(*) Campo Requerido" },
				cboSector: { required: "(*) Campo Requerido" },
				cboPliego: { required: "(*) Campo Requerido" },
				cboEjecutora: { required: "(*) Campo Requerido" },
				cboCentroCostos: { required: "(*) Campo Requerido" },
				cboSubCentroCostos: { required: "(*) Campo Requerido" },
				cboProgramaPresupuestal: { required: "(*) Campo Requerido" },
				cbActividadProyecto: { required: "(*) Campo Requerido" },
				cboActividad: { required: "(*) Campo Requerido" },
				cboFinalidad: { required: "(*) Campo Requerido" },
				cboUnidadMedida: { required: "(*) Campo Requerido" },
				Costo_Programa: { required: "(*) Campo Requerido" },
				enero: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				febrero: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				marzo: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				abril: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				mayo: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				junio: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				julio: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				agosto: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				septiembre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				octubre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				noviembre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				diciembre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				Nombre: { required: "(*) Campo Requerido" }
			}
		});

		$("#formActualizar").validate({
			rules: {
				cboAnio: { required: true },
				cboSector: { required: true },
				cboPliego: { required: true },
				cboEjecutora: { required: true },
				cboCentroCostos: { required: true },
				cboSubCentroCostos: { required: true },
				cboProgramaPresupuestal: { required: true },
				cbActividadProyecto: { required: true },
				cboActividad: { required: true },
				cboFinalidad: { required: true },
				cboUnidadMedida: { required: true },
				Costo_Programa: { required: true, validarFormato: true },
				enero: { digits: true, min: 0, max: 1000 },
				febrero: { digits: true, min: 0, max: 1000 },
				marzo: { digits: true, min: 0, max: 1000 },
				abril: { digits: true, min: 0, max: 1000 },
				mayo: { digits: true, min: 0, max: 1000 },
				junio: { digits: true, min: 0, max: 1000 },
				julio: { digits: true, min: 0, max: 1000 },
				agosto: { digits: true, min: 0, max: 1000 },
				septiembre: { digits: true, min: 0, max: 1000 },
				octubre: { digits: true, min: 0, max: 1000 },
				noviembre: { digits: true, min: 0, max: 1000 },
				diciembre: { digits: true, min: 0, max: 1000 },
				Nombre: { required: true }
			},
			messages: {
				cboAnio: { required: "(*) Campo Requerido" },
				cboSector: { required: "(*) Campo Requerido" },
				cboPliego: { required: "(*) Campo Requerido" },
				cboEjecutora: { required: "(*) Campo Requerido" },
				cboCentroCostos: { required: "(*) Campo Requerido" },
				cboSubCentroCostos: { required: "(*) Campo Requerido" },
				cboProgramaPresupuestal: { required: "(*) Campo Requerido" },
				cbActividadProyecto: { required: "(*) Campo Requerido" },
				cboActividad: { required: "(*) Campo Requerido" },
				cboFinalidad: { required: "(*) Campo Requerido" },
				cboUnidadMedida: { required: "(*) Campo Requerido" },
				Costo_Programa: { required: "(*) Campo Requerido" },
				enero: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				febrero: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				marzo: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				abril: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				mayo: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				junio: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				julio: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				agosto: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				septiembre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				octubre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				noviembre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				diciembre: { digits: "Solo n\xfameros", min: "M\xednimo 1", max: "M\xe1ximo 1000" },
				Nombre: { required: "(*) Campo Requerido" }
			}
		});

		var tbListar = $('#tbListar').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "Codigo_Actividad_POI" },
				{ "data": "Anio_Ejecucion" },
				{ "data": "Actividad_POI" },
				{ "data": "Proyecto" },
				{ "data": "Actividad" },
				{ "data": "Cantidad" },
				{ "data": "Costo" },
				{ "data": "Unidad_Medida" },
				{ "data": "Editar" },
				{ "data": "Eliminar" },
				{ "data": "Codigo_Sector" },
				{ "data": "Codigo_Pliego" },
				{ "data": "Codigo_Ejecutora" },
				{ "data": "Codigo_Centro_Costos" },
				{ "data": "Codigo_Sub_Centro_Costos" },
				{ "data": "Codigo_Programa_Presupuestal" },
				{ "data": "Codigo_Finalidad" },
				{ "data": "Codigo_Unidad_Medida" },
				{ "data": "Codigo_Actividad_Proyecto" },
				{ "data": "Codigo_Actividad" },
				{ "data": "ID" },
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
				{ "data": "Activo" }

			],
			"lengthMenu": [[-1, 25, 50, 100], ["Todos", 25, 50, 100]],
			columnDefs: [
				{
					"targets": [10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33],
					"visible": false,
					"searchable": false
				}
			],
			buttons: [
				{ extend: 'copy', text: 'Copiar', title: 'Acciones Operativas (Tareas),Productos, Actividades Presupuestales, Metas Físicas, Financieras y Unidad de Medida', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },
				{ extend: 'csv', title: 'Acciones Operativas (Tareas),Productos, Actividades Presupuestales, Metas Físicas, Financieras y Unidad de Medida', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },
				{ extend: 'excel', title: 'Acciones Operativas (Tareas),Productos, Actividades Presupuestales, Metas Físicas, Financieras y Unidad de Medida', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },
				{ extend: 'pdf', title: 'Acciones Operativas (Tareas),Productos, Actividades Presupuestales, Metas Físicas, Financieras y Unidad de Medida', orientation: 'landscape', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },

				{
					extend: 'print',
					text: 'Imprimir',
					title: 'Acciones Operativas (Tareas) Enlazadas',
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
			$("#deleteModal input[name=id]").val("");
			$('#deleteModal').modal('show');

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();

			$("#deleteModal input[name=id]").val(data.ID);
			$("#deleteModal #eliminar_proceso").text(data.Codigo_Actividad_POI);

		});
		$("body").on("click", ".actionEdit", function () {

			$("#actualizarModal").modal("show");

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();

			var id = data.ID;

			var Anio_Ejecucion = data.Anio_Ejecucion;
			var Actividad_POI = data.Actividad_POI;
			var Costo_Programado = data.Costo;
			var Cantidad_Programada = data.Cantidad_Programada;
			var Codigo_Sector = data.Codigo_Sector;
			var Codigo_Actividad_Proyecto = data.Codigo_Actividad_Proyecto;
			var Codigo_Actividad = data.Codigo_Actividad;
			var Codigo_Programa_Presupuestal = data.Codigo_Programa_Presupuestal;
			var Codigo_Pliego = data.Codigo_Pliego;
			var Codigo_Ejecutora = data.Codigo_Ejecutora;
			var Codigo_Centro_Costos = data.Codigo_Centro_Costos;
			var Codigo_Sub_Centro_Costos = data.Codigo_Sub_Centro_Costos;
			var Codigo_Unidad_Medida = data.Codigo_Unidad_Medida;
			var Codigo_Finalidad = data.Codigo_Finalidad;

			$("#formActualizar input[name=id]").val(id);
			$("#formActualizar select[name=cboAnio]").val(Anio_Ejecucion);
			$("#formActualizar select[name=cboUnidadMedida]").val(Codigo_Unidad_Medida);

			cboAnio("#formActualizar", Anio_Ejecucion, Codigo_Sector, Codigo_Actividad_Proyecto, Codigo_Actividad, Codigo_Programa_Presupuestal, Codigo_Finalidad);
			setTimeout(function () { cboSector("#formActualizar", Anio_Ejecucion, Codigo_Sector, Codigo_Pliego); }, 500);
			setTimeout(function () { cboPliego("#formActualizar", Anio_Ejecucion, Codigo_Sector, Codigo_Pliego, Codigo_Ejecutora); }, 1000);
			setTimeout(function () { cboEjecutora("#formActualizar", Anio_Ejecucion, Codigo_Sector, Codigo_Pliego, Codigo_Ejecutora, Codigo_Centro_Costos); }, 1500);
			setTimeout(function () { cboCentroCostos("#formActualizar", Anio_Ejecucion, Codigo_Sector, Codigo_Pliego, Codigo_Ejecutora, Codigo_Centro_Costos, Codigo_Sub_Centro_Costos); }, 2000);

			var nombre_poi = Actividad_POI.replace(data.Codigo_Actividad_POI + " - ", "");
			$("#formActualizar textarea[name=Nombre]").val(nombre_poi);
			$("#Costo_Programa").val(Costo_Programado);
			$("#Cantidad_Programada").val(Cantidad_Programada);

			$("#formActualizar input[name=enero]").val(data.Enero);
			$("#formActualizar input[name=febrero]").val(data.Febrero);
			$("#formActualizar input[name=marzo]").val(data.Marzo);
			$("#formActualizar input[name=abril]").val(data.Abril);
			$("#formActualizar input[name=mayo]").val(data.Mayo);
			$("#formActualizar input[name=junio]").val(data.Junio);
			$("#formActualizar input[name=julio]").val(data.Julio);
			$("#formActualizar input[name=agosto]").val(data.Agosto);
			$("#formActualizar input[name=septiembre]").val(data.Septiembre);
			$("#formActualizar input[name=octubre]").val(data.Octubre);
			$("#formActualizar input[name=noviembre]").val(data.Noviembre);
			$("#formActualizar input[name=diciembre]").val(data.Diciembre);

		});

		$(".tbRegistroMeses input[type=text]").keydown(function (e) {
			var keyPress = (e.keyCode ? e.keyCode : e.which);
			if (parseInt(keyPress) == 9) {
				e.preventDefault();
				var indice = $(this).attr("rel");

				var ind = 0;
				$.each($(".tbRegistroMeses").find("input[type=text]"), function (i, e) {
					ind++;
				});
				if (parseInt(indice) == ind) {
					$(".tbRegistroMeses .mes1").focus();
				}
				else {
					var next = parseInt(indice) + 1;
					$(".tbRegistroMeses .mes" + next).focus();
				}
			}

		});

	});
}
