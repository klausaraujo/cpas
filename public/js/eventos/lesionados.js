function lesionados(URI, ID_EVENTO_REGISTRO, CANTIDAD_HISTORIAL) {

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

	function habilitarReniec() {
		$("input[name=Lesionado_Documento_Numero]").removeAttr("readonly");
		$("select[name=Lesionado_Genero]").attr("readonly", "readonly");
		$("input[name=Lesionado_Apellidos]").attr("readonly", "readonly");
		$("input[name=Lesionado_Nombres]").attr("readonly", "readonly");
		$("input[name=Lesionado_Edad]").attr("readonly", "readonly");

	}
	function deshabilitarReniec() {
		$("input[name=Lesionado_Documento_Numero]").val("");
		$("select[name=Lesionado_Genero]").removeAttr("readonly");
		$("input[name=Lesionado_Apellidos]").removeAttr("readonly");
		$("input[name=Lesionado_Nombres]").removeAttr("readonly");
		$("input[name=Lesionado_Edad]").removeAttr("readonly");
	}

	function habilitarCampos() {
		$("#Evento_Danios_Lesionados_Fecha_Atencion").removeAttr("readonly");
		$("input[name=Situacion_Codigo]").removeAttr("readonly");
		$("input[name=Lesionado_Observaciones]").removeAttr("readonly");
		$("input[name=Lesionado_Entidad_Salud_Codigo]").removeAttr("readonly");
		$("select[name=Lesionado_Personal_Salud]").removeAttr("readonly");
	}
	function validarHistorial() {

		var hNumeroHistorial = $("#hNumeroHistorial").val();

		if (hNumeroHistorial.length > 0) {
			if (parseInt(hNumeroHistorial) > 0) {

				$("#Evento_Danios_Lesionados_Fecha_Atencion").attr("readonly", "readonly");
				$("input[name=Situacion_Codigo]").attr("readonly", "readonly");
				$("select[name=Lesionado_Genero]").attr("readonly", "readonly");
				$("input[name=Lesionado_Apellidos]").attr("readonly", "readonly");
				$("input[name=Lesionado_Nombres]").attr("readonly", "readonly");
				$("input[name=Lesionado_Edad]").attr("readonly", "readonly");
				$("input[name=Lesionado_Observaciones]").attr("readonly", "readonly");
				$("input[name=Lesionado_Entidad_Salud_Codigo]").attr("readonly", "readonly");
				$("select[name=Lesionado_Personal_Salud]").attr("readonly", "readonly");

			}

		}

	}

	var tableEnfermedades = $('.tableEnfermedades').DataTable({
		"pageLength": 7,
		"bLengthChange": false,
		"info": false,
		"ajax": {
			url: URI + "public/js/eventos/enfermedades.txt",
			method: "POST"
		}
	});

	var tableEntidadesSalud = $('.tableEntidadesSalud').DataTable(
		{
			pageLength: 5,
			columns: [{
				"data": "CodEESS"
			}, {
				"data": "Nombre"
			}, {
				"data": "Clasificacion"
			}],
			"ajax": {
				url: URI + "eventos/eventos/entidadesSaludAjax",
				type: "POST",
				data: function (d) {
					d.departamento = document
						.getElementById("departamento").value,
						d.provincia = document
							.getElementById("provincia").value,
						d.distrito = document
							.getElementById("distrito").value
				}
			}
		});

	$("#btnFiltrarUbigeo").on(
		"click",
		function () {

			var departamento = $("#departamento").val();
			var provincia = $("#provincia").val();
			var distrito = $("#distrito").val();

			if (departamento.length > 0 && provincia.length > 0
				&& distrito.length > 0) {
				tableEntidadesSalud.ajax.reload();
				tableEntidadesSalud.draw();
			} else {
				$("#alertaModal").modal("show");
				$("#alertaModal #tituloalerta").text("Error");
				$("#alertaModal #mensajealerta").html(
					"Debe seleccionar el ubigeo");
				return false;

			}

		});

	$("#departamento")
		.change(
			function () {

				var id = $(this).val();

				if (id.length > 0) {

					$
						.ajax({
							data: {
								departamento: id
							},
							url: URI
								+ "eventos/main/cargarProvincias",
							method: "POST",
							dataType: "json",
							beforeSend: function () {
								$("#provincia")
									.html(
										'<option value="">Cargando...</option>');
								$("#distrito")
									.html(
										'<option value="">--Elija Provincia--</option>');
							},
							success: function (data) {

								var $html = '<option value="">--Seleccione--</option>';
								$.each(data.lista, function (i, e) {

									$html += '<option value="'
										+ e.Codigo_Provincia
										+ '">' + e.Nombre
										+ '</option>';

								});
								$("#provincia").html($html);

							}
						});

				}
			});

	$("#provincia")
		.change(
			function () {

				var id = $(this).val();
				var departamento = $("#departamento").val();

				if (id.length > 0 && departamento.length > 0) {

					$
						.ajax({
							data: {
								departamento: departamento,
								provincia: id
							},
							url: URI
								+ "eventos/main/cargarDistritos",
							method: "POST",
							dataType: "json",
							beforeSend: function () {
								$("#distrito")
									.html(
										'<option value="">Cargando...</option>');
							},
							success: function (data) {

								var $html = '<option value="">--Seleccione--</option>';
								$.each(data.lista, function (i, e) {

									$html += '<option value="'
										+ e.Codigo_Distrito
										+ '">' + e.Nombre
										+ '</option>';

								});
								$("#distrito").html($html);

							}
						});

				}
			});

	var table = $('#tbListar').DataTable(
		{
			dom: '<"html5buttons"B>lTfgitp',
			columns: [{
				"data": "Evento_Danios_Lesionados_Fecha_Atencion"
			},
			{
				"data": "Lesionado_Documento_Numero"
			},
			{
				"data": "Lesionado_Apellidos"
			},
			{
				"data": "Lesionado_Nombres"
			},
			{
				"data": "Lesionado_Edad"
			},
			{
				"data": "Gravedad"
			},
			{
				"data": "Situacion"
			},
			{
				"data": "CIE"
			},
			{
				"data": "editar"
			},
			{
				"data": "Lesionado_Observaciones"
			},
			{
				"data": "Nivel_Gravedad_Codigo"
			},
			{
				"data": "Situacion_Codigo"
			},
			{
				"data": "Lesionado_CIE10_Codigo"
			},
			{
				"data": "Evento_Danios_Lesionados_ID"
			},
			{
				"data": "Tipo_Documento_Codigo"
			},
			{
				"data": "Evento_Danios_Lesionados_Numero"
			},
			{
				"data": "Evento_Registro_Numero"
			},
			{
				"data": "activarEditar"
			},
			{
				"data": "Lesionado_Genero"
			},
			{
				"data": "Lesionado_Entidad_Salud_Codigo"
			},
			{
				"data": "Lesionado_Personal_Salud"
			},
			{
				"data": "Lesionado_Entidad_Salud_Nombre"
			},
			{
				"data": "Lesionado_Gestante"
			},
			{
				"data": "Evento_Tipo_Entidad_Atencion_ID"
			}
			],
			columnDefs: [{
				"targets": [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
				"visible": false,
				"searchable": false
			}],
			order: [[0, "desc"]],
			buttons: [
				{
					extend: 'copy',
					title: 'Lista de Personas Lesionadas',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7, 21]
					}
				},
				{
					extend: 'csv',
					title: 'Lista de Personas Lesionadas',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7, 21]
					}
				},
				{
					extend: 'excel',
					title: 'Lista de Personas Lesionadas',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7, 21]
					}
				},
				{
					extend: 'pdf',
					title: 'Lista de Personas Lesionadas',
					orientation: 'landscape',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7, 21]
					}
				},

				{
					extend: 'print',
					title: 'Lista de Personas Lesionadas',
					customize: function (win) {
						$(win.document.body).addClass('white-bg');
						$(win.document.body).css('font-size', '10px');

						$(win.document.body).find('table').addClass(
							'compact').css('font-size', 'inherit');
					}
				}]

		});

	$(document).ready(function () {

		if ($(".datos-danio").length == 0) {
			$(".tb-responsive").css("display", "block");
			$(".a-danios").css("display", "none");
		}

		if ($(".datos-danio").length == 0) $("#accionesModal").modal("show");

		$('.datetimepicker').datetimepicker({
			locale: 'ru',
			maxDate: moment()
		});

		$('.tableEnfermedades tbody').on(
			'click',
			'tr',
			function () {
				var data = tableEnfermedades.row(this)
					.data();
				$("input[name=Lesionado_CIE10_Codigo]")
					.val(data[0]);
				$("input[name=Lesionado_CIE10_Texto]").val(
					data[1]);
				$('#tableEnfermedadesModal').modal('hide');
			});

		$("#btnRegistrarCambios")
			.on("click", function () {

				var listado = [];

				table.rows().iterator('row', function (context, index) {
					var data = this.row(index).data();

					var lesionado = [];

					if (parseInt(data.activarEditar)) {

						if (data.Lesionado_Entidad_Salud_Codigo == "1") {
							data.Evento_Tipo_Entidad_Atencion_ID = "0";
						}

						lesionado.push({
							"Evento_Danios_Lesionados_Fecha_Atencion": data.Evento_Danios_Lesionados_Fecha_Atencion,
							"Lesionado_Documento_Numero": data.Lesionado_Documento_Numero,
							"Lesionado_Apellidos": data.Lesionado_Apellidos,
							"Lesionado_Nombres": data.Lesionado_Nombres,
							"Lesionado_Edad": data.Lesionado_Edad,
							"Lesionado_Observaciones": data.Lesionado_Observaciones,
							"Nivel_Gravedad_Codigo": data.Nivel_Gravedad_Codigo,
							"Situacion_Codigo": data.Situacion_Codigo,
							"Lesionado_CIE10_Codigo": data.Lesionado_CIE10_Codigo,
							"Tipo_Documento_Codigo": data.Tipo_Documento_Codigo,
							"Evento_Danios_Lesionados_Numero": data.Evento_Danios_Lesionados_Numero,
							"Evento_Danios_Lesionados_ID": data.Evento_Danios_Lesionados_ID,
							"Evento_Registro_Numero": ID_EVENTO_REGISTRO,
							"activarEditar": data.activarEditar,
							"Lesionado_Genero": data.Lesionado_Genero,
							"Lesionado_Entidad_Salud_Codigo": data.Lesionado_Entidad_Salud_Codigo,
							"Lesionado_Personal_Salud": data.Lesionado_Personal_Salud,
							"Lesionado_Entidad_Salud_Nombre": data.Lesionado_Entidad_Salud_Nombre,
							"Lesionado_Gestante": data.Lesionado_Gestante,
							"Evento_Tipo_Entidad_Atencion_ID": data.Evento_Tipo_Entidad_Atencion_ID
						});
						listado.push(lesionado);

					}

				});

				if (listado.length > 0) {
					$("#btnRegistrarCambios").text("Cargando...");
					$("#btnRegistrarCambios").addClass("disabled");
					var Evento_Registro_Numero = $("input[name=Evento_Registro_Numero]").val();
					$.ajax({
						data: {
							lesionados: listado, Evento_Registro_Numero: Evento_Registro_Numero
						},
						url: URI
							+ "eventos/eventos/agregarLesionadosHistorial",
						method: "POST",
						dataType: "json",
						error: function () {
							$("#btnRegistrarCambios").text("Registrar Cambios");
							$("#btnRegistrarCambios").removeClass("disabled");
						},
						beforeSend: function () {
							$(".cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
							$("#message").html("");

						},
						success: function (data) {

							$(".cargando").html("<i></i>");
							var $message = "";
							$("#decisionModal").modal("hide");

							$('html, body').animate({ scrollTop: 0 }, 'fast');

							$("#btnRegistrarCambios").text("Registrar Cambios");
							$("#btnRegistrarCambios").removeClass("disabled");

							if (parseInt(data.status) == 200)
								$message = '<div class="alert alert-success"><h4 style="margin:0">'
									+ data.message
									+ '</h4></div>';
							else
								$message = '<div class="alert alert-error"><h4 style="margin:0">'
									+ data.message
									+ '</h4></div>';

							$("#message")
								.html(
									$message);
							setTimeout(
								function () {
									$(
										"#message")
										.slideUp();
									location
										.reload();
								}, 2000);
						}
					});
				}
			});

		$("#btnCancel").on("click", function () {

			$(".active-tb-responsive").closest(".datos-danio").removeClass("active");

			$(".tb-responsive").css("display", "none");
			$(".a-danios").css("display", "block");

		});

		$(".active-tb-responsive").on("click", function () {
			var Evento_Danios_Lesionados_ID = $(this).closest(".datos-danio").attr("rel");

			var Numero_Historial = $(this).closest(".datos-danio").attr("rel2");

			var disabled = (Numero_Historial > parseInt(1)) ? "disabled" : "";

			$("#formRegistrar input[name=Evento_Danios_Lesionados_ID]").val(Evento_Danios_Lesionados_ID);

			$("#hNumeroHistorial").val(Numero_Historial);

			$(".active-tb-responsive").closest(".datos-danio").removeClass("active");
			$(this).closest(".datos-danio").addClass("active");

			$(".tb-responsive").css("display", "block");
			$(".a-danios").css("display", "none");

			table.clear().draw();

			$.ajax({
				data: {
					Evento_Danios_Lesionados_ID: Evento_Danios_Lesionados_ID,
					Evento_Registro_Numero: ID_EVENTO_REGISTRO
				},
				url: URI
					+ "eventos/eventos/listaDaniosLesionados",
				method: "POST",
				dataType: "json",
				beforeSend: function () {
					$(".cargando")
						.html(
							"<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
					$("#message").html(
						"");

				},
				success: function (data) {
					$(".cargando").html("<i></i>");

					var filas = [];

					$.each(data.lesionados, function (i, e) {
						var editar = '<div class="flex-buttons"><button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-danger btn-circle actionDeleteL" title="ELIMINAR" type="button"><i class="fa fa-trash"></i></button></div>';
						var cadena = {
							"Evento_Danios_Lesionados_Fecha_Atencion": e.Fecha,
							"Lesionado_Documento_Numero": e.Lesionado_Documento_Numero,
							"Lesionado_Apellidos": e.Lesionado_Apellidos,
							"Lesionado_Nombres": e.Lesionado_Nombres,
							"Lesionado_Edad": e.Lesionado_Edad,
							"Gravedad": e.Gravedad,
							"Situacion": e.Situacion,
							"CIE": e.CIE,
							"editar": editar,
							"Lesionado_Observaciones": e.Lesionado_Observaciones,
							"Nivel_Gravedad_Codigo": e.Nivel_Gravedad_Codigo,
							"Situacion_Codigo": e.Situacion_Codigo,
							"Lesionado_CIE10_Codigo": e.Lesionado_CIE10_Codigo,
							"Evento_Danios_Lesionados_ID": e.Evento_Danios_Lesionados_ID,
							"Tipo_Documento_Codigo": e.Tipo_Documento_Codigo,
							"Evento_Danios_Lesionados_Numero": e.Evento_Danios_Lesionados_Numero,
							"Evento_Registro_Numero": ID_EVENTO_REGISTRO,
							"activarEditar": '0',
							"Lesionado_Genero": e.Lesionado_Genero,
							"Lesionado_Entidad_Salud_Codigo": e.Lesionado_Entidad_Salud_Codigo,
							"Lesionado_Personal_Salud": e.Lesionado_Personal_Salud,
							"Lesionado_Entidad_Salud_Nombre": e.Lesionado_Entidad_Salud_Nombre,
							"Lesionado_Gestante": e.Lesionado_Gestante,
							"Evento_Tipo_Entidad_Atencion_ID": e.Evento_Tipo_Entidad_Atencion_ID
						};

						filas.push(cadena);

					});

					table.rows.add(filas).draw();

				}
			});

		});

		$(".generar-historia").on("click", function () {

			$("#condicionModal").modal("show");
			$("#condicionModal .modal-title").html("Nueva actualizaci\xf3n");
			$("#condicionModal .modal-body p").html("Se generar\xe1 una nueva actualizaci\xf3n en base a la anterior, \xbfseguro desea continuar?");

		});

		$("#btn-proceder").on("click", function () {

			var Evento_Danios_Lesionados_ID = $(".datos-danio").last().attr("rel");

			$.ajax({
				data: {
					Evento_Danios_Lesionados_ID: Evento_Danios_Lesionados_ID,
					Evento_Registro_Numero: ID_EVENTO_REGISTRO
				},
				url: URI
					+ "eventos/eventos/clonarHistorialLesionados",
				method: "POST",
				dataType: "json",
				beforeSend: function () {
					$(".cargando")
						.html(
							"<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
					$("#message").html(
						"");

				},
				success: function (data) {
					$(".cargando")
						.html(
							"<i></i>");
					var $message = "";
					$("#condicionModal")
						.modal(
							"hide");

					if (parseInt(data.status) == 200)
						$message = '<div class="alert alert-success"><h4 style="margin:0">'
							+ data.message
							+ '</h4></div>';
					else
						$message = '<div class="alert alert-error"><h4 style="margin:0">'
							+ data.message
							+ '</h4></div>';

					$('html, body')
						.animate(
							{
								scrollTop: 0
							},
							'fast');
					$("#message").html(
						$message);
					setTimeout(
						function () {
							$(
								"#message")
								.slideUp();
							location
								.reload();
						}, 2000);
				}
			});

		});

		$("html,body").on("click", ".actionEdit", function () {
			habilitarCampos();
			validarHistorial();
			$("#lesionadosModal").modal("show");
			$("#registrarTableroModalLabel").html("Editar Lesionado");

			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			data = row.data();

			$("#formRegistrar .div-gestante input").prop("checked", false);
			$("#formRegistrar .div-gestante").css("display", "none");

			$("#formRegistrar input[name=Evento_Danios_Lesionados_Fecha_Atencion]").val(data.Evento_Danios_Lesionados_Fecha_Atencion);
			$("#formRegistrar select[name=Tipo_Documento_Codigo]").val(data.Tipo_Documento_Codigo);
			if (data.Tipo_Documento_Codigo === "01" || data.Tipo_Documento_Codigo === "03") {
				habilitarReniec();
			} else {
				deshabilitarReniec();
			}

			$("#formRegistrar input[name=Lesionado_Documento_Numero]").val(data.Lesionado_Documento_Numero);
			$("#formRegistrar input[name=Lesionado_Apellidos]").val(data.Lesionado_Apellidos);
			$("#formRegistrar input[name=Lesionado_Nombres]").val(data.Lesionado_Nombres);
			$("#formRegistrar input[name=Lesionado_Edad]").val(data.Lesionado_Edad);
			$("#formRegistrar textarea[name=Lesionado_Observaciones]").val(data.Lesionado_Observaciones);
			$("#formRegistrar select[name=Nivel_Gravedad_Codigo]").val(data.Nivel_Gravedad_Codigo);
			$("#formRegistrar select[name=Situacion_Codigo]").val(data.Situacion_Codigo);
			$("#formRegistrar input[name=Lesionado_CIE10_Texto]").val(data.CIE);
			$("#formRegistrar input[name=Lesionado_CIE10_Codigo]").val(data.Lesionado_CIE10_Codigo);
			$("#formRegistrar input[name=Evento_Danios_Lesionados_ID]").val(data.Evento_Danios_Lesionados_ID);
			$("#formRegistrar input[name=Evento_Danios_Lesionados_Numero]").val(data.Evento_Danios_Lesionados_Numero);
			$("#formRegistrar input[name=editar]").val('0');
			$("#formRegistrar input[name=index]").val(index);
			$("#formRegistrar select[name=Lesionado_Genero]").val(data.Lesionado_Genero);
			$("#formRegistrar select[name=Lesionado_Entidad_Salud_Codigo]").val(data.Lesionado_Entidad_Salud_Codigo);

			if (parseInt(data.Lesionado_Entidad_Salud_Codigo) > 1) {
				$("#formRegistrar .entidad-salud").css("display", "block");
				$("#formRegistrar select[name=Evento_Tipo_Entidad_Atencion_ID]").removeAttr("disabled");
			} else {
				$("#formRegistrar .entidad-salud").css("display", "none");
				$("#formRegistrar select[name=Evento_Tipo_Entidad_Atencion_ID]").attr("disabled", "disabled");
			}

			$("#formRegistrar input[name=Lesionado_Entidad_Salud_Nombre]").val(data.Lesionado_Entidad_Salud_Nombre);
			$("#formRegistrar select[name=Lesionado_Personal_Salud]").val(data.Lesionado_Personal_Salud);

			if (data.Lesionado_Genero == "2") {
				$("#formRegistrar .div-gestante").slideDown();
				if (data.Lesionado_Gestante == "1") {
					$("#formRegistrar .div-gestante input").prop("checked", "checked");
				}
			}

			if (data.Evento_Tipo_Entidad_Atencion_ID) {
				$("#formRegistrar select[name=Evento_Tipo_Entidad_Atencion_ID]").val(data.Evento_Tipo_Entidad_Atencion_ID);
			}
		});

		$("html, body").on("click", ".actionDeleteL", function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);
			data = row.data();

			$("#idEliminar").val("D|" + data.Evento_Danios_Lesionados_Numero);
			$("#decisionModal").modal("show");
			$("#decisionModal .modal-title").text("Eliminar lesionado");
			$("#decisionModal .modal-body p").html("Est\xe1 seguro de querer eliminar a <b>" + data.Lesionado_Nombres + ", " + data.Lesionado_Apellidos + "</b>");

		});

		$(".actionDelete").on("click", function () {

			var historial = $(this).closest(".datos-danio").find(".historial span").text();
			var Evento_Danios_Lesionados_ID = $(this).closest(".datos-danio").attr("rel");
			$("#idEliminar").val(Evento_Danios_Lesionados_ID);
			$("#decisionModal").modal("show");
			$("#decisionModal .modal-title").text("Eliminar actualizaci\xf3n");
			$("#decisionModal .modal-body p").html("Est\xe1 seguro de querer eliminar <b>" + historial + "</b>");

		});

		$("#btn-decision").on("click", function () {

			var LINK = "eliminarDanioLesionado";
			var Evento_Danios_Lesionados_ID = $("#idEliminar").val();
			var condition = Evento_Danios_Lesionados_ID.substring(0, 1);

			if (condition == 'D') {
				LINK = "eliminarDanioLesionadoPaciente";
				var separate = Evento_Danios_Lesionados_ID.split("|");
				Evento_Danios_Lesionados_ID = separate[1];
			}

			$.ajax({
				data: {
					Evento_Danios_Lesionados_ID: Evento_Danios_Lesionados_ID,
					Evento_Registro_Numero: ID_EVENTO_REGISTRO,
					CANTIDAD_HISTORIAL: CANTIDAD_HISTORIAL
				},
				url: URI
					+ "eventos/eventos/" + LINK,
				method: "POST",
				dataType: "json",
				beforeSend: function () {
					$(".cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
					$("#message").html("");

				},
				success: function (data) {
					$(".cargando").html("<i></i>");
					var $message = "";
					$("#decisionModal").modal("hide");

					if (parseInt(data.status) == 200)
						$message = '<div class="alert alert-success"><h4 style="margin:0">'
							+ data.message
							+ '</h4></div>';
					else
						$message = '<div class="alert alert-error"><h4 style="margin:0">'
							+ data.message
							+ '</h4></div>';

					$('html, body').animate({ scrollTop: 0 }, 'fast');
					$("#message").html($message);
					setTimeout(
						function () {
							$("#message").slideUp();
							location.reload();
						}, 2000);
				}
			});

		});

		$.validator.addMethod("lettersonly", function (value, element) {
			return this.optional(element) || /^[a-z," ",ÑñÁÉÍÓÚáéíóúÜü]+$/i.test(value);
		}, "Solo letras");

		$("#formRegistrar")
			.validate(
				{
					rules: {
						Evento_Danios_Lesionados_Fecha_Atencion: {
							required: true
						},
						Tipo_Documento_Codigo: {
							required: false
						},
						Lesionado_Documento_Numero: {
							digits: true
						},
						Lesionado_Apellidos: {
							required: true,
							lettersonly: true
						},
						Lesionado_Nombres: {
							required: true,
							lettersonly: true
						},
						Lesionado_Edad: {
							required: false,
							digits: true
						},
						Lesionado_Observaciones: {
							required: true
						},
						Nivel_Gravedad_Codigo: {
							required: true
						},
						Situacion_Codigo: {
							required: true
						},
						Lesionado_CIE10_Codigo: {
							required: true
						},
						Lesionado_Genero: {
							required: true
						},
						Lesionado_Entidad_Salud_Codigo: {
							min: 1
						},
						Lesionado_Entidad_Salud_Nombre: {
							required: function () { if ($("select[name=Lesionado_Entidad_Salud_Codigo]").val() == "1") return false; else return true; }
						}

					},
					messages: {
						Evento_Danios_Lesionados_Fecha_Atencion: {
							required: "(*) Campo Requerido"
						},
						Tipo_Documento_Codigo: {
							required: "(*) Campo Requerido"
						},
						Lesionado_Documento_Numero: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros"
						},
						Lesionado_Apellidos: {
							required: "(*) Campo Requerido"
						},
						Lesionado_Nombres: {
							required: "(*) Campo Requerido"
						},
						Lesionado_Edad: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros"
						},
						Lesionado_Observaciones: {
							required: "(*) Campo Requerido"
						},
						Nivel_Gravedad_Codigo: {
							required: "(*) Campo Requerido"
						},
						Situacion_Codigo: {
							required: "(*) Campo Requerido"
						},
						Lesionado_CIE10_Codigo: {
							required: "(*) Campo Requerido"
						},
						Lesionado_Genero: {
							required: "(*) Campo Requerido"
						},
						Lesionado_Entidad_Salud_Codigo: {
							min: "(*) Campo Requerido"
						},
						Lesionado_Entidad_Salud_Nombre: {
							required: "(*) Campo Requerido"
						}
					},
					submitHandler: function (form,
						event) {
						event.preventDefault();

						var Evento_Danios_Lesionados_Fecha_Atencion = $("#formRegistrar input[name=Evento_Danios_Lesionados_Fecha_Atencion]").val();
						var Tipo_Documento_Codigo = $("#formRegistrar select[name=Tipo_Documento_Codigo]").val();
						var Lesionado_Documento_Numero = $("#formRegistrar input[name=Lesionado_Documento_Numero]").val();
						var Lesionado_Apellidos = $("#formRegistrar input[name=Lesionado_Apellidos]").val();
						var Lesionado_Nombres = $("#formRegistrar input[name=Lesionado_Nombres]").val();
						var Lesionado_Edad = $("#formRegistrar input[name=Lesionado_Edad]").val();
						var Lesionado_Observaciones = $("#formRegistrar textarea[name=Lesionado_Observaciones]").val();
						var Nivel_Gravedad_Texto = $("#formRegistrar select[name=Nivel_Gravedad_Codigo] option:selected").text();
						var Nivel_Gravedad_Codigo = $("#formRegistrar select[name=Nivel_Gravedad_Codigo]").val();
						var Situacion_Texto = $("#formRegistrar select[name=Situacion_Codigo] option:selected").text();
						var Situacion_Codigo = $("#formRegistrar select[name=Situacion_Codigo]").val();
						var Lesionado_CIE10_Texto = $("#formRegistrar input[name=Lesionado_CIE10_Texto]").val();
						var Lesionado_CIE10_Codigo = $("#formRegistrar input[name=Lesionado_CIE10_Codigo]").val();
						var Evento_Danios_Lesionados_ID = $("#formRegistrar input[name=Evento_Danios_Lesionados_ID]").val();
						var Evento_Danios_Lesionados_Numero = $("#formRegistrar input[name=Evento_Danios_Lesionados_Numero]").val();

						var Lesionado_Genero = $("#formRegistrar select[name=Lesionado_Genero]").val();
						var Lesionado_Entidad_Salud_Codigo = $("#formRegistrar select[name=Lesionado_Entidad_Salud_Codigo]").val();
						var personalSalud = $("#formRegistrar select[name=Lesionado_Personal_Salud]").val();
						var Lesionado_Personal_Salud = personalSalud;
						var Lesionado_Entidad_Salud_Nombre = $("#formRegistrar input[name=Lesionado_Entidad_Salud_Nombre]").val();

						var Lesionado_Gestante = "0";
						if ($(
							"#formRegistrar input[name=Lesionado_Gestante]")
							.prop("checked"))
							Lesionado_Gestante = "1";

						var editar = "";
						if (parseInt(Evento_Danios_Lesionados_Numero) > 0)
							editar = '<button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button"><i class="fa fa-pencil-square-o"></i></button>';

						if (Lesionado_Entidad_Salud_Codigo == "1") Lesionado_Entidad_Salud_Nombre = "";

						var Evento_Tipo_Entidad_Atencion_ID = ($("#formRegistrar select[name=Evento_Tipo_Entidad_Atencion_ID]").prop("disabled")) ? "0" : $("#formRegistrar select[name=Evento_Tipo_Entidad_Atencion_ID]").val();

						var datos = {
							"Evento_Danios_Lesionados_Fecha_Atencion": Evento_Danios_Lesionados_Fecha_Atencion,
							"Lesionado_Documento_Numero": Lesionado_Documento_Numero,
							"Lesionado_Apellidos": Lesionado_Apellidos,
							"Lesionado_Nombres": Lesionado_Nombres,
							"Lesionado_Edad": Lesionado_Edad,
							"Gravedad": Nivel_Gravedad_Texto,
							"Situacion": Situacion_Texto,
							"CIE": Lesionado_CIE10_Texto,
							"Lesionado_Observaciones": Lesionado_Observaciones,
							"Nivel_Gravedad_Codigo": Nivel_Gravedad_Codigo,
							"Situacion_Codigo": Situacion_Codigo,
							"Lesionado_CIE10_Codigo": Lesionado_CIE10_Codigo,
							"Tipo_Documento_Codigo": Tipo_Documento_Codigo,
							"Evento_Danios_Lesionados_Numero": Evento_Danios_Lesionados_Numero,
							"Evento_Danios_Lesionados_ID": Evento_Danios_Lesionados_ID,
							"Evento_Registro_Numero": ID_EVENTO_REGISTRO,
							"editar": editar,
							"activarEditar": '1',
							"Lesionado_Genero": Lesionado_Genero,
							"Lesionado_Entidad_Salud_Codigo": Lesionado_Entidad_Salud_Codigo,
							"Lesionado_Personal_Salud": Lesionado_Personal_Salud,
							"Lesionado_Entidad_Salud_Nombre": Lesionado_Entidad_Salud_Nombre,
							"Lesionado_Gestante": Lesionado_Gestante,
							"Evento_Tipo_Entidad_Atencion_ID": Evento_Tipo_Entidad_Atencion_ID
						};

						if (parseInt(Evento_Danios_Lesionados_Numero) > 0) {

							table.row(index)
								.data(datos).draw();

						} else {
							table.row.add(datos).draw();
						}

						$("#formRegistrar")[0].reset();
						$("#formRegistrar input[name=Evento_Danios_Lesionados_Fecha_Atencion]").val(Evento_Danios_Lesionados_Fecha_Atencion);
						$("#formRegistrar input[name=Evento_Danios_Lesionados_Numero]").val("0");
						$("#formRegistrar input[name=Evento_Danios_Lesionados_ID]").val(Evento_Danios_Lesionados_ID);
						$("#formRegistrar input[name=index]").val("0");
						$("#formRegistrar input[name=editar]").val("0");
						$("#formRegistrar input[name=Lesionado_CIE10_Codigo]").val("");
						$("#formRegistrar select[name=Lesionado_Entidad_Salud_Codigo]").val("");

						$("#formRegistrar input[name=Lesionado_Entidad_Salud_Nombre]").val("");

						$("#lesionadosModal").modal("hide");

					}

				});

		$(".enlaceDanios,.enlaceLesionados,.enlaceAcciones,.enlaceFotos,.enlaceEntidades,.enlaceFiles").on("click", function () {

			var url = $(this).attr("rel");
			post(URI + "eventos/eventos/" + url, { Evento_Registro_Numero: ID_EVENTO_REGISTRO });

		});

		$("select[name=Lesionado_Genero]").change(function () {
			var genero = $(this).val();
			if (genero == "2")
				$(this).closest("#formRegistrar").find(
					".div-gestante").slideDown();
			else
				$(this).closest("#formRegistrar").find(
					".div-gestante").slideUp();

		});

		$("select[name=Lesionado_Entidad_Salud_Codigo]").change(function () {
			var id = $(this).val();
			id = parseInt(id);
			if (id > 1) {
				$(this).closest("form").find(".entidad-salud").css("display", "block");
				$("#formRegistrar select[name=Evento_Tipo_Entidad_Atencion_ID]").removeAttr("disabled");
			} else {
				$(this).closest("form").find(".entidad-salud").css("display", "none");
				$("#formRegistrar select[name=Evento_Tipo_Entidad_Atencion_ID]").attr("disabled", "disabled");
			}
		});

		$(".btn-clear-form").on("click", function () {

			$("#formRegistrar")[0].reset();
			$("input[name=Evento_Danios_Lesionados_Numero]").val("0");
			$("input[name=index]").val("0");

		});

	});

	$("#btnClearFields").on("click", function () {
		habilitarCampos();
		$("#lesionadosModal").modal("show");
		$("#registrarTableroModalLabel").html("Registrar Lesionado");

		setTimeout(function () {
			$("#formRegistrar")[0].reset();
			$("input[name=Evento_Danios_Lesionados_Numero]").val("0");

			$("input[name=index]").val("0");
			$("input[name=editar]").val("0");
			$('.datetimepicker input').val(moment().format("DD/MM/YYYY HH:mm"));
			$("#formRegistrar .div-gestante input").prop("checked", false);
			$("#formRegistrar .div-gestante").css("display", "none");
			var elemento = document.getElementsByClassName("cLesionado_CIE10_Codigo");
			elemento[0].value = "";
			$(".entidad-salud").slideUp();
			$("#formRegistrar select[name=Evento_Tipo_Entidad_Atencion_ID]").attr("disabled", "disabled");
		}, 100);

	});

	$("#btn-buscar").on("click", function () {
		var Lesionado_Documento_Numero = $("input[name=Lesionado_Documento_Numero]").val();

		if (Lesionado_Documento_Numero.length >= 8) {
			var type = "01";
			if (Lesionado_Documento_Numero.length > 8) {
				type = "03";
			}
			$.ajax({
				url: URI + "eventos/eventos/curl",
				data: { type: type, document: Lesionado_Documento_Numero },
				method: 'post',
				dataType: 'json',
				error: function (xhr) {
					$("#btn-buscar").removeAttr("disabled");
					$("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></i>');
				},
				beforeSend: function () {
					$("#btn-buscar").html('<i class="fa fa-spinner fa-pulse"></i>');
					$("#btn-buscar").attr("disabled", "disabled");
				},
				success: function (data) {
					$("#btn-buscar").removeAttr("disabled");
					$("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></i>');

					$("input[name=Lesionado_Edad]").val(data.data.attributes.edad_anios);
					if (data.data.attributes.sexo == "2") {
						$("#formRegistrar .div-gestante").slideDown();
					}
					else {
						$("#formRegistrar .div-gestante").slideUp();
					}
					$("select[name=Lesionado_Genero]").val(data.data.attributes.sexo);
					$("input[name=Lesionado_Apellidos]").val(data.data.attributes.apellido_paterno + " " + data.data.attributes.apellido_materno);
					$("input[name=Lesionado_Nombres]").val(data.data.attributes.nombres);
				}
			});

		}

	});

	$("select[name=Tipo_Documento_Codigo]").on("change", function () {

		var select = $(this).val();

		if (select === "01" || select === "03") {
			habilitarReniec();
		} else {
			deshabilitarReniec();
		}

	});

	$("select[name=Lesionado_Genero]").change(function (e) {
		var select = $("select[name=Tipo_Documento_Codigo]").val();

		if (select != "06") {
			$("select[name=Lesionado_Genero]").val(function () {
				return this.defaultValue;
			});
		}
	});

	$('.addAsignacion').on('click', function () {
		cargarAddAsignacion(ID_EVENTO_REGISTRO);

	});

}
