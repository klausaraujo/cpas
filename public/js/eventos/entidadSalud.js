function entidadSalud(URI, ID_EVENTO_REGISTRO, EVENTO_FECHA) {

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

	$(document).ready(function () {

		var tableEntidadesSalud;

		if ($(".datos-danio").length == 0) $("#accionesModal").modal("show");

		setTimeout(() => {
			tableEntidadesSalud = $('.tableEntidadesSalud').DataTable(
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
						url: URI
							+ "eventos/eventos/entidadesSaludAjax",
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
		}, 1000);

		$("#btnFiltrarUbigeo").on("click", function () {

			var departamento = $("#departamento").val();
			var provincia = $("#provincia").val();
			var distrito = $("#distrito").val();

			if (departamento.length > 0
				&& provincia.length > 0
				&& distrito.length > 0) {
				tableEntidadesSalud.ajax
					.reload();
				tableEntidadesSalud.draw();
			} else {
				$("#alertaModal").modal("show");
				$("#alertaModal #tituloalerta").text("Error");
				$("#alertaModal #mensajealerta").html("Debe seleccionar el ubigeo");
				return false;

			}

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
						$("#distrito").html('<option value="">--Elija Provincia--</option>');
					},
					success: function (data) {

						var $html = '<option value="">--Seleccione--</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="'
								+ e.Codigo_Provincia
								+ '">'
								+ e.Nombre
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

								var $html = '<option value="">--Seleccione--</option>';
								$.each(data.lista, function (i, e) {

									$html += '<option value="'
										+ e.Codigo_Distrito
										+ '">'
										+ e.Nombre
										+ '</option>';

								});
								$("#distrito").html($html);

							}
						});

					}
				});

		var fecha_minima = EVENTO_FECHA.split("/");
		fecha_minima = "-" + fecha_minima[2] + "/" + fecha_minima[1] + "/" + fecha_minima[0];
		fecha_minima2 = "-" + fecha_minima[1] + "/" + fecha_minima[0] + "/" + fecha_minima[2];

		$('.datetimepicker').datetimepicker({
			locale: 'ru',
			maxDate: moment(),
			minDate: fecha_minima,
			keepOpen: true
		});
		$('.datetimepicker2').datepicker({
			format: "dd/mm/yyyy",
			startDate: EVENTO_FECHA,
			autoclose: true
		});

		$('[data-toggle="tooltip"]').tooltip();
		$(".actionEdit").on("click", function () {

			$("#formEditar")[0].reset();

			$("#editarModal").modal("show");
			$("#formEditar input[name=id]").val($(this).closest(".datos-danio").find("#a-id").val());
			$("#formEditar input[name=fecha]").val($(this).closest(".datos-danio").find("#a-fecha").val());
			$("#formEditar select[name=Evento_Entidad_Estado]").val($(this).closest(".datos-danio").find("#a-Evento_Entidad_Estado").val());
			$("#formEditar input[name=CodEESS]").val($(this).closest(".datos-danio").find("#a-CodEESS").val());
			$("#formEditar input[name=CodEESS_Nombre]").val($(this).closest(".datos-danio").find("#a-CodEESS_Nombre").val());
			$("#formEditar input[name=agua]").val($(this).closest(".datos-danio").find("#a-agua").val());
			$("#formEditar input[name=desague]").val($(this).closest(".datos-danio").find("#a-desague").val());
			$("#formEditar input[name=energia_electrica]").val($(this).closest(".datos-danio").find("#a-energia_electrica").val());
			$("#formEditar input[name=conectividad]").val($(this).closest(".datos-danio").find("#a-conectividad").val());
			$("#formEditar input[name=radio]").val($(this).closest(".datos-danio").find("#a-radio").val());
			$("#formEditar input[name=fija]").val($(this).closest(".datos-danio").find("#a-fija").val());
			$("#formEditar input[name=celular]").val($(this).closest(".datos-danio").find("#a-celular").val());
			$("#formEditar input[name=internet]").val($(this).closest(".datos-danio").find("#a-internet").val());

			if ($(this).closest(".datos-danio").find("#a-techos").val() == "1") $("#formEditar input[name=techos]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-paredes").val() == "1") $("#formEditar input[name=paredes]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-pisos").val() == "1") $("#formEditar input[name=pisos]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-cercos").val() == "1") $("#formEditar input[name=cercos]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-otros_lugares").val() == "1") $("#formEditar input[name=otros_lugares]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-inundacion").val() == "1") $("#formEditar input[name=inundacion]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-colapso").val() == "1") $("#formEditar input[name=colapso]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-caida").val() == "1") $("#formEditar input[name=caida]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-goteras").val() == "1") $("#formEditar input[name=goteras]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-fisuras").val() == "1") $("#formEditar input[name=fisuras]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-otros_consecuencias").val() == "1") $("#formEditar input[name=otros_consecuencias]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-emergencia").val() == "1") $("#formEditar input[name=emergencia]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-banco").val() == "1") $("#formEditar input[name=banco]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-obstetrico").val() == "1") $("#formEditar input[name=obstetrico]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-quirurgico").val() == "1") $("#formEditar input[name=quirurgico]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-uci").val() == "1") $("#formEditar input[name=uci]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-diagnostico").val() == "1") $("#formEditar input[name=diagnostico]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-esterilizacion").val() == "1") $("#formEditar input[name=esterilizacion]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-laboratorio").val() == "1") $("#formEditar input[name=laboratorio]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-ambulancias").val() == "1") $("#formEditar input[name=ambulancias]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-farmacia").val() == "1") $("#formEditar input[name=farmacia]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-consultorios").val() == "1") $("#formEditar input[name=consultorios]").prop("checked", true);
			if ($(this).closest(".datos-danio").find("#a-otros").val() == "1") $("#formEditar input[name=otros]").prop("checked", true);

			$("#formEditar input[name=recuperacion_operatividad]").val($(this).closest(".datos-danio").find("#a-recuperacion_operatividad").val());
			if ($(this).closest(".datos-danio").find("#a-continuidad_operativa").val() == "1") $("#formEditar input[name=continuidad_operativa]").prop("checked", true);
			$("#formEditar input[name=lugar]").val($(this).closest(".datos-danio").find("#a-lugar").val());

			$("#Evento_Banio_Quimico_Portatil").val($(this).closest(".datos-danio").find("#a-Evento_Banio_Quimico_Portatil").val());
			$("#formEditar textarea[name=observaciones]").val($(this).closest(".datos-danio").find("#a-observaciones").val());

			$("#")

		});
		$(".actionDelete").on("click", function () {

			var historial = $(this).closest(".datos-danio").find(".historial span").text();
			var id = $(this).closest(".datos-danio").find(".d-ID").val();
			$("#idEliminar").val(id);
			$("#decisionModal").modal("show");
			$("#decisionModal .modal-title").text("Eliminar Entidad");
			$("#decisionModal .modal-body p").html("Est\xe1 seguro de querer eliminar la <b>" + historial + "</b>");

		});
		$("#btn-decision").on("click", function () {

			var idEliminar = $("#idEliminar").val();

			$.ajax({
				data: {
					idEliminar: idEliminar,
					Evento_Registro_Numero: ID_EVENTO_REGISTRO
				},
				url: URI
					+ "eventos/eventos/eliminarEntidadSalud",
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
					$("#decisionModal")
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
		$("#formRegistrar")
			.validate(
				{
					rules: {
						fecha: {
							required: true
						},
						Evento_Entidad_Estado: {
							min: 1
						},
						CodEESS_Nombre: {
							required: true
						},
						recuperacion_operatividad: {
							required: false
						}
					},
					messages: {
						fecha: {
							required: "(*) Campo Requerido"
						},
						Evento_Entidad_Estado: {
							min: "(*) Campo Requerido"
						},
						CodEESS_Nombre: {
							required: "(*) Campo Requerido"
						}
					},
					submitHandler: function (form,
						event) {
						event.preventDefault();

						$
							.ajax({
								data: $(
									"#formRegistrar")
									.serialize(),
								url: URI
									+ "eventos/eventos/registrarEntidadSalud",
								method: "POST",
								dataType: "json",
								beforeSend: function () {
									$(".cargando")
										.html(
											"<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
									$("#message")
										.html(
											"");

								},
								success: function (
									data) {
									$(".cargando")
										.html(
											"<i></i>");
									var $message = "";
									$(
										"#accionesModal")
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
		$("#formEditar")
			.validate(
				{
					rules: {
						fecha: {
							required: true
						},
						Evento_Entidad_Estado: {
							min: 1
						},
						CodEESS_Nombre: {
							required: true
						},
						recuperacion_operatividad: {
							required: false
						}
					},
					messages: {
						fecha: {
							required: "(*) Campo Requerido"
						},
						Evento_Entidad_Estado: {
							min: "(*) Campo Requerido"
						},
						CodEESS_Nombre: {
							required: "(*) Campo Requerido"
						}
					},
					submitHandler: function (form,
						event) {
						event.preventDefault();

						$
							.ajax({
								data: $(
									"#formEditar")
									.serialize(),
								url: URI
									+ "eventos/eventos/editarEntidadSalud",
								method: "POST",
								dataType: "json",
								beforeSend: function () {
									$(".cargando")
										.html(
											"<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
									$("#message")
										.html(
											"");

								},
								success: function (
									data) {
									$(".cargando")
										.html(
											"<i></i>");
									var $message = "";
									$(
										"#editarModal")
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

		$(".enlaceDanios,.enlaceLesionados,.enlaceAcciones,.enlaceFotos,.enlaceEntidades,.enlaceFiles")
			.on(
				"click",
				function () {

					var url = $(this).attr("rel");

					post(
						URI + "eventos/eventos/"
						+ url,
						{
							Evento_Registro_Numero: ID_EVENTO_REGISTRO
						});

				});
		$('.tableEntidadesSalud tbody').on('click', 'tr', function () {
			var data = tableEntidadesSalud.row(this).data();

			$("input[name=CodEESS]").val(data.CodEESS);
			$("input[name=CodEESS_Nombre").val(data.Nombre);
			$('#tableEntidadesSaludModal').modal('hide');
		});

		$('.addAsignacion').on('click', function () {
			cargarAddAsignacion(ID_EVENTO_REGISTRO);
		});

	});

}