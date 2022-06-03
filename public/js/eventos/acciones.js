function acciones(URI, ID_EVENTO_REGISTRO) {

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

	function cargarTipoAccionEntidad(form, Tipo_Accion_Codigo, selected) {

		$.ajax({
			data: {
				Tipo_Accion_Codigo: Tipo_Accion_Codigo
			},
			url: URI + "eventos/eventos/listarAccionEntidad",
			method: "POST",
			dataType: "json",
			beforeSend: function () {
				$(form).find("select[id=Tipo_Accion_Entidad_Codigo]").html(
					'<option value="">Cargando...</option>');
			},
			success: function (data) {
				$(form).find("select[name=Tipo_Accion_Entidad_Codigo]").html(
					'<option value="">-- Seleccione --</option>');

				$.each(data.lista, function (i, e) {
					if (selected.length > 0
						&& e.Tipo_Accion_Entidad_Codigo == selected)
						$(form).find("select[name=Tipo_Accion_Entidad_Codigo]")
							.append(
								'<option value="'
								+ e.Tipo_Accion_Entidad_Codigo
								+ '" selected>'
								+ e.Tipo_Accion_Entidad_Nombre
								+ '</option>');
					else
						$(form).find("select[name=Tipo_Accion_Entidad_Codigo]")
							.append(
								'<option value="'
								+ e.Tipo_Accion_Entidad_Codigo
								+ '">'
								+ e.Tipo_Accion_Entidad_Nombre
								+ '</option>');
				});
			}
		});

	}

	$(document).ready(function () {

		if ($(".datos-danio").length == 0) $("#accionesModal").modal("show");

		$(".btn-basic").on("click", function () {
			$("#formRegistrar")[0].reset();
		});

		$('.datetimepicker').datetimepicker({
			locale: 'ru',
			maxDate: moment()
		});

		$('[data-toggle="tooltip"]').tooltip();
		$("select[name=Tipo_Accion_Codigo]").change(
			function () {

				var form = "#"
					+ $(this).closest("form")
						.attr("id");

				var Tipo_Accion_Codigo = $(this).val();

				if (Tipo_Accion_Codigo.length > 0) {

					cargarTipoAccionEntidad(form,
						Tipo_Accion_Codigo, "");

				}

			});
		$(".actionEdit").on("click", function () {

			$("#editarModal").modal("show");

			var Tipo_Accion_Codigo = $(this).closest(".datos-danio").find("#a-Tipo_Accion_Codigo").val();
			var Tipo_Accion_Entidad_Codigo = $(this).closest(".datos-danio").find("#a-Tipo_Accion_Entidad_Codigo").val();
			console.log($(this).closest(".datos-danio").find("#a-ID").val());
			$("#id").val($(this).closest(".datos-danio").find("#a-ID").val());
			$("#Evento_Registro_Numero").val($(this).closest(".datos-danio").find("#a-Evento_Registro_Numero").val());
			$("#Evento_Acciones_Fecha").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Fecha").val());

			$("#Tipo_Accion_Codigo").val(Tipo_Accion_Codigo);
			$("#Tipo_Accion_Entidad_Codigo").val(Tipo_Accion_Entidad_Codigo);
			$("#Evento_Acciones_Descripcion").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Descripcion").val());

			$("#Evento_Acciones_Region").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Region").val());
			$("#Evento_Acciones_Minsa").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Minsa").val());

			$("#Evento_Acciones_Emt_i").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Emt_i").val());
			$("#Evento_Acciones_Emt_ii").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Emt_ii").val());
			$("#Evento_Acciones_Emt_iii").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Emt_iii").val());
			$("#Evento_Acciones_Celula_Especializada").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Celula_Especializada").val());

			$("#Evento_Acciones_Minsa_Samu").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Minsa_Samu").val());
			$("#Evento_Acciones_Salud_Minsa").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Salud_Minsa").val());
			$("#Evento_Acciones_Essalud").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Essalud").val());
			$("#Evento_Acciones_Municipalidades_Gores").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Municipalidades_Gores").val());
			$("#Evento_Acciones_Voluntarios").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Voluntarios").val());

			$("#Evento_Ambulancias_Minsa_Samu").val($(this).closest(".datos-danio").find("#a-Evento_Ambulancias_Minsa_Samu").val());
			$("#Evento_Ambulancias_Minsa").val($(this).closest(".datos-danio").find("#a-Evento_Ambulancias_Minsa").val());
			$("#Evento_Ambulancias_Essalud").val($(this).closest(".datos-danio").find("#a-Evento_Ambulancias_Essalud").val());
			$("#Evento_Ambulancias_Bomberos").val($(this).closest(".datos-danio").find("#a-Evento_Ambulancias_Bomberos").val());
			$("#Evento_Ambulancias_Municipalidades_Gores").val($(this).closest(".datos-danio").find("#a-Evento_Ambulancias_Municipalidades_Gores").val());
			$("#Evento_Ambulancias_PNP_FFAA").val($(this).closest(".datos-danio").find("#a-Evento_Ambulancias_PNP_FFAA").val());
			$("#Evento_Ambulancianas_Privadas").val($(this).closest(".datos-danio").find("#a-Evento_Ambulancianas_Privadas").val());

			$("#Evento_Maletin_Emergencias_Desastres").val($(this).closest(".datos-danio").find("#a-Evento_Maletin_Emergencias_Desastres").val());
			$("#Evento_Kit_Medicamentos_Insumos").val($(this).closest(".datos-danio").find("#a-Evento_Kit_Medicamentos_Insumos").val());
			$("#Evento_Acciones_Equipo_Biomedicos").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Equipo_Biomedicos").val());
			$("#Evento_Acciones_Puesto_Comando").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Puesto_Comando").val());
			$("#Evento_Acciones_Ac_Victimas").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Ac_Victimas").val());
			$("#Evento_Acciones_Oferta_Movil_i").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Oferta_Movil_i").val());
			$("#Evento_Acciones_Oferta_Movil_ii").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Oferta_Movil_ii").val());
			$("#Evento_Acciones_Oferta_Movil_iii").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Oferta_Movil_iii").val());
			$("#Evento_Acciones_Hospital_Modular").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Hospital_Modular").val());
			$("#Evento_Banio_Quimico_Portatil").val($(this).closest(".datos-danio").find("#a-Evento_Banio_Quimico_Portatil").val());

			$("#Evento_Rescatistas").val($(this).closest(".datos-danio").find("#a-Evento_Rescatistas").val());
			$("#Evento_Medicos_Tacticos").val($(this).closest(".datos-danio").find("#a-Evento_Medicos_Tacticos").val());
			$("#Evento_Acciones_PNP_FFAA").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_PNP_FFAA").val());

			$("#Equipo_Tecnico_Movilizado_Diresa").val($(this).closest(".datos-danio").find("#a-Equipo_Tecnico_Movilizado_Diresa").val());
			$("#Equipo_Tecnico_Movilizado_Red").val($(this).closest(".datos-danio").find("#a-Equipo_Tecnico_Movilizado_Red").val());
			$("#Equipo_Tecnico_Movilizado_Diris").val($(this).closest(".datos-danio").find("#a-Equipo_Tecnico_Movilizado_Diris").val());
			$("#Equipo_Tecnico_Movilizado_Ipress").val($(this).closest(".datos-danio").find("#a-Equipo_Tecnico_Movilizado_Ipress").val());
			$("#Equipo_Tecnico_Movilizado_Digerd").val($(this).closest(".datos-danio").find("#a-Equipo_Tecnico_Movilizado_Digerd").val());
			$("#Equipo_Tecnico_Movilizado_Minsa").val($(this).closest(".datos-danio").find("#a-Equipo_Tecnico_Movilizado_Minsa").val());
			$("#Equipo_Tecnico_Movilizado_Otros").val($(this).closest(".datos-danio").find("#a-Equipo_Tecnico_Movilizado_Otros").val());

			$("#Evento_Acciones_Personal_Emt_i").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Personal_Emt_i").val());
			$("#Evento_Acciones_Personal_Emt_ii").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Personal_Emt_ii").val());
			$("#Evento_Acciones_Personal_Emt_iii").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Personal_Emt_iii").val());
			$("#Evento_Acciones_Mochilas_Emergencia").val($(this).closest(".datos-danio").find("#a-Evento_Acciones_Mochilas_Emergencia").val());

			cargarTipoAccionEntidad(
				"#formEditar",
				Tipo_Accion_Codigo,
				Tipo_Accion_Entidad_Codigo);
		});
		$(".actionDelete").on(
			"click",
			function () {

				var historial = $(this).closest(
					".datos-danio").find(
						".historial span").text();
				var id = $(this).closest(".datos-danio")
					.find(".d-ID").val();
				$("#idEliminar").val(id);
				$("#decisionModal").modal("show");
				$("#decisionModal .modal-title").text(
					"Eliminar acci\xf3n");
				$("#decisionModal .modal-body p").html(
					"Est\xe1 seguro de querer eliminar la <b>"
					+ historial + "</b>");

			});
		$("#btn-decision").on("click", function () {

			var idEliminar = $("#idEliminar").val();

			$.ajax({
				data: {
					idEliminar: idEliminar,
					Evento_Registro_Numero: ID_EVENTO_REGISTRO
				},
				url: URI + "eventos/eventos/eliminarAccion",
				method: "POST",
				dataType: "json",
				beforeSend: function () {
					$(".cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
					$("#message").html("");

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

					$('html, body').animate({ scrollTop: 0 }, 'fast');
					$("#message").html($message);
					setTimeout(function () { $("#message").slideUp(); location.reload(); }, 2000);
				}
			});

		});
		$("#formRegistrar")
			.validate(
				{
					rules: {
						Evento_Acciones_Fecha: {
							required: true
						},
						Tipo_Accion_Codigo: {
							required: true
						},
						Tipo_Accion_Entidad_Codigo: {
							required: true
						},
						Evento_Acciones_Descripcion: {
							required: false
						}
					},
					messages: {
						Evento_Acciones_Fecha: {
							required: "(*) Campo Requerido"
						},
						Tipo_Accion_Codigo: {
							required: "(*) Campo Requerido"
						},
						Tipo_Accion_Entidad_Codigo: {
							required: "(*) Campo Requerido"
						},
						Evento_Acciones_Descripcion: {
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
									+ "eventos/eventos/registrarAccion",
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
									$("#accionesModal").modal("hide");

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
									setTimeout(function () { $("#message").slideUp(); location.reload(); }, 2000);
								}
							});

					}

				});
		$("#formEditar").validate(
			{
				rules: {
					Evento_Acciones_Fecha: {
						required: true
					},
					Tipo_Accion_Codigo: {
						required: true
					},
					Tipo_Accion_Entidad_Codigo: {
						required: true
					},
					Evento_Acciones_Descripcion: {
						required: false
					}

				},
				messages: {
					Evento_Acciones_Fecha: {
						required: "(*) Campo Requerido"
					},
					Tipo_Accion_Codigo: {
						required: "(*) Campo Requerido"
					},
					Tipo_Accion_Entidad_Codigo: {
						required: "(*) Campo Requerido"
					},
					Evento_Acciones_Descripcion: {
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
								+ "eventos/eventos/editarAccion",
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

								$('html, body').animate({ scrollTop: 0 }, 'fast');
								$("#message").html($message);
								setTimeout(function () { $("#message").slideUp(); location.reload(); }, 2000);
							}
						});

				}

			});

		$(".enlaceDanios,.enlaceLesionados,.enlaceAcciones,.enlaceFotos,.enlaceEntidades,.enlaceFiles").on("click", function () {

			var url = $(this).attr("rel");

			post(URI + "eventos/eventos/" + url, { Evento_Registro_Numero: ID_EVENTO_REGISTRO });

		});
		$('.addAsignacion').on('click', function () {
			cargarAddAsignacion(ID_EVENTO_REGISTRO);
		});

	});

}