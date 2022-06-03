function danios(URI, ID_EVENTO_REGISTRO) {

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

		if ($(".datos-danio").length == 0) $("#daniosModal").modal("show");

		$('.datetimepicker').datetimepicker({
			locale: 'ru',
			maxDate: moment()
		});
		$(".actionEdit")
			.on(
				"click",
				function () {

					$("#editModal").modal("show");

					$("#dUltimo").val($(this).closest(".datos-danio").find(".d-ultimo").val());

					$("#danioID").val(
						$(this).closest(".datos-danio")
							.find(".d-ID").val());
					$("#fechaEvento").val(
						$(this).closest(".datos-danio")
							.find(".d-fecha")
							.text());
					$("#fuente")
						.val(
							$(this)
								.closest(
									".datos-danio")
								.find(
									".d-Evento_Danios_Fuente")
								.text());
					$("#descripcion")
						.val(
							$(this)
								.closest(
									".datos-danio")
								.find(
									".d-Evento_Danios_Descripcion")
								.text());
					$("#lesionados")
						.val(
							$(this)
								.closest(
									".datos-danio")
								.find(
									".d-Evento_Lesionados")
								.text());
					$("#fallecidos")
						.val(
							$(this)
								.closest(
									".datos-danio")
								.find(
									".d-Evento_Fallecidos")
								.text());
					$("#desaparecidos")
						.val(
							$(this)
								.closest(
									".datos-danio")
								.find(
									".d-Evento_Desaparecidos")
								.text());
					$("#inhabitables")
						.val(
							$(this)
								.closest(
									".datos-danio")
								.find(
									".d-Evento_Viv_Inhabitables")
								.text());
					$("#colapsadas")
						.val(
							$(this)
								.closest(
									".datos-danio")
								.find(
									".d-Evento_Viv_Colapsadas")
								.text());
					$("#nombre_f")
						.val(
							$(this)
								.closest(
									".datos-danio")
								.find(
									".d-Evento_Danios_Nombre")
								.text());
					$("#institucion_f")
						.val(
							$(this)
								.closest(
									".datos-danio")
								.find(
									".d-Evento_Danios_Institucion")
								.text());
					$("#telefono_f")
						.val(
							$(this)
								.closest(
									".datos-danio")
								.find(
									".d-Evento_Danios_Telefono")
								.text());
					$("#correo_f")
						.val(
							$(this)
								.closest(
									".datos-danio")
								.find(
									".d-Evento_Danios_Correo")
								.text());
				});
		$(".actionDelete").on(
			"click",
			function () {

				var historial = $(this).closest(".datos-danio")
					.find(".historial span").text();
				var id = $(this).closest(".datos-danio").find(
					".d-ID").val();
				$("#idEliminar").val(id);
				$("#decisionModal").modal("show");
				$("#decisionModal .modal-title").html(
					"Eliminar actualizaci\xf3n");
				$("#decisionModal .modal-body p").html(
					"Est\xe1 seguro de querer eliminar el <b>"
					+ historial + "</b>");

			});

		$("#btn-decision")
			.on(
				"click",
				function () {

					var danioID = $("#idEliminar").val();

					$
						.ajax({
							data: {
								danioID: danioID, Evento_Registro_Numero: ID_EVENTO_REGISTRO
							},
							url: URI + "eventos/eventos/eliminarDanio",
							method: "POST",
							dataType: "json",
							beforeSend: function () {
								$(".cargando")
									.html(
										"<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
								$("#message").html("");

							},
							success: function (data) {
								$(".cargando").html(
									"<i></i>");
								var $message = "";
								$("#decisionModal")
									.modal("hide");

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
								setTimeout(function () {
									$("#message")
										.slideUp();
									location.reload();
								}, 2000);
							}
						});

				});
		$("#formRegistrar")
			.validate(
				{
					rules: {
						fechaEvento: {
							required: false
						},

						lesionados: {
							required: false,
							digits: true
						},
						fallecidos: {
							required: false,
							digits: true
						},
						desaparecidos: {
							required: false,
							digits: true
						},
						inhabitables: {
							required: false,
							digits: true,
							max: 15000
						},
						colapsadas: {
							required: false,
							digits: true,
							max: 15000
						},
						nombre_f: {
							required: true
						},
						institucion_f: {
							required: true
						},
						telefono_f: {
							required: true,
							digits: true
						},
						correo_f: {
							required: true
						}

					},
					messages: {
						fechaEvento: {
							required: "(*) Campo Requerido"
						},

						lesionados: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros"
						},
						fallecidos: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros"
						},
						desaparecidos: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros"
						},
						inhabitables: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros",
							max: 'valor muy grande'
						},
						colapsadas: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros",
							max: 'valor muy grande'
						},
						nombre_f: {
							required: "(*) Campo Requerido"
						},
						institucion_f: {
							required: "(*) Campo Requerido"
						},
						telefono_f: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros",
						},
						correo_f: {
							required: "(*) Campo Requerido"
						}
					},
					submitHandler: function (form, event) {
						event.preventDefault();

						var fechaEvento = $("#formRegistrar input[name=fechaEvento]");
						var lesionados = $("#formRegistrar input[name=lesionados]");
						var fallecidos = $("#formRegistrar input[name=fallecidos]");
						var desaparecidos = $("#formRegistrar input[name=desaparecidos]");
						var inhabitables = $("#formRegistrar input[name=inhabitables]");
						var colapsadas = $("#formRegistrar input[name=colapsadas]");
						var nombre_f = $("#formRegistrar input[name=nombre_f]");
						var institucion_f = $("#formRegistrar input[name=institucion_f]");
						var telefono_f = $("#formRegistrar input[name=telefono_f]");
						var correo_f = $("#formRegistrar input[name=correo_f]");

						if (fechaEvento.length < 1
							&& lesionados.length < 1
							&& fallecidos.length < 1
							&& desaparecidos.length < 1
							&& inhabitables.length < 1
							&& colapsadas.length < 1) {
							$("#alertaModal").modal("show");
							$("#alertaModal #tituloalerta").text("Error");
							$("#alertaModal #mensajealerta").html("Debes ingresar por lo menos alg\xfan da\f1o");
							return false;
						}

						$
							.ajax({
								data: $(
									"#formRegistrar")
									.serialize(),
								url: URI + "eventos/eventos/registrarDanio",
								method: "POST",
								dataType: "json",
								beforeSend: function () {
									$(".cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
									$("#message").html("");

								},
								success: function (data) {
									$(".cargando").html("<i></i>");
									var $message = "";
									$("#daniosModal").modal("hide");

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

					}

				});
		$("#formActualizar")
			.validate(
				{
					rules: {
						fechaEvento: {
							required: false
						},

						lesionados: {
							required: false,
							digits: true
						},
						fallecidos: {
							required: false,
							digits: true
						},
						desaparecidos: {
							required: false,
							digits: true
						},
						inhabitables: {
							required: false,
							digits: true,
							max: 15000
						},
						colapsadas: {
							required: false,
							digits: true,
							max: 15000
						},
						nombre_f: {
							required: true
						},
						institucion_f: {
							required: true
						},
						telefono_f: {
							required: true,
							digits: true
						},
						correo_f: {
							required: true
						}

					},
					messages: {
						fechaEvento: {
							required: "(*) Campo Requerido"
						},

						lesionados: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros"
						},
						fallecidos: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros"
						},
						desaparecidos: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros"
						},
						inhabitables: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros",
							max: 'valor muy grande'
						},
						colapsadas: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros",
							max: 'valor muy grande'
						},
						nombre_f: {
							required: "(*) Campo Requerido"
						},
						institucion_f: {
							required: "(*) Campo Requerido"
						},
						telefono_f: {
							required: "(*) Campo Requerido",
							digits: "Solo n\xfameros",
						},
						correo_f: {
							required: "(*) Campo Requerido"
						}
					},
					submitHandler: function (form, event) {
						event.preventDefault();

						var fechaEvento = $("#formActualizar input[name=fechaEvento]");
						var lesionados = $("#formActualizar input[name=lesionados]");
						var fallecidos = $("#formActualizar input[name=fallecidos]");
						var desaparecidos = $("#formActualizar input[name=desaparecidos]");
						var inhabitables = $("#formActualizar input[name=inhabitables]");
						var colapsadas = $("#formActualizar input[name=colapsadas]");
						var nombre_f = $("#formRegistrar input[name=nombre_f]");
						var institucion_f = $("#formRegistrar input[name=institucion_f]");
						var telefono_f = $("#formRegistrar input[name=telefono_f]");
						var correo_f = $("#formRegistrar input[name=correo_f]");

						if (fechaEvento.length < 1
							&& lesionados.length < 1
							&& fallecidos.length < 1
							&& desaparecidos.length < 1
							&& inhabitables.length < 1
							&& colapsadas.length < 1) {
							$("#alertaModal").modal("show");
							$("#alertaModal #tituloalerta").text("Error");
							$("#alertaModal #mensajealerta").html("Debes ingresar por lo menos alg\xfan da\f1o");
							return false;
						}

						$.ajax({
							data: $("#formActualizar").serialize(),
							url: URI + "eventos/eventos/actualizarDanio",
							method: "POST",
							dataType: "json",
							beforeSend: function () {
								$(".cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
								$("#message").html("");

							},
							success: function (data) {
								$(".cargando").html("<i></i>");
								var $message = "";
								$("#editModal").modal("hide");

								if (parseInt(data.status) == 200)
									$message = '<div class="alert alert-success"><h4 style="margin:0">' + data.message + '</h4></div>';
								else
									$message = '<div class="alert alert-error"><h4 style="margin:0">' + data.message + '</h4></div>';

								$('html, body').animate({ scrollTop: 0 }, 'fast');
								$("#message").html($message);
								setTimeout(function () { $("#message").slideUp(); location.reload(); }, 2000);
							}
						});

					}

				});

		$(".enlaceDanios,.enlaceLesionados,.enlaceAcciones,.enlaceFotos,.enlaceEntidades,.enlaceFiles").on("click", function () {

			var url = $(this).attr("rel");
			console.log(url);
			post(
				URI + "eventos/eventos/"
				+ url,
				{
					Evento_Registro_Numero: ID_EVENTO_REGISTRO
				});

		});

		$('.addAsignacion').on('click', function () {
			cargarAddAsignacion(ID_EVENTO_REGISTRO);
		});

	});

}