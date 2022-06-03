function registroEvento(URI, EVENTO_CODIGO_REGION) {

	$(document).ready(function () {

		$("#datetimepicker").datetimepicker({
			locale: 'ru',
			maxDate: moment(),
			keepOpen: false
		});
		$("#formEvento").validate({
			rules: {
				tipoEvento: { required: function () { if ($("#tipoEvento").css("display") != "none") return true; else return false; } },
				evento: { required: function () { if ($("#evento").css("display") != "none") return true; else return false; } },
				eventoDetalle: { required: function () { if ($("#eventoDetalle").css("display") != "none") return true; else return false; } },
				fechaEvento: { required: function () { if ($("#fechaEvento").css("display") != "none") return true; else return false; } },
				nivelEmergencia: { required: function () { if ($("#nivelEmergencia").css("display") != "none") return true; else return false; } },
				fuenteInicial: { required: function () { if ($("#fuenteInicial").css("display") != "none") return true; else return false; } },

				descripcionGeneral: { required: function () { if ($("#descripcionGeneral").css("display") != "none") return true; else return false; } },
				departamento: { required: function () { if ($("#departamento").css("display") != "none") return true; else return false; } },
				provincia: { required: function () { if ($("#provincia").css("display") != "none") return true; else return false; } },
				distritio: { required: function () { if ($("#distritio").css("display") != "none") return true; else return false; } },
				latitudsismo: { required: function () { if ($(".seismo").css("display") != "none") return true; else return false; } },
				longitudsismo: { required: function () { if ($(".seismo").css("display") != "none") return true; else return false; } },
				referencia: { required: function () { if ($(".seismo").css("display") != "none") return true; else return false; } },
				profundidad: { required: function () { if ($(".seismo").css("display") != "none") return true; else return false; } },
				magnitud: { required: function () { if ($(".seismo").css("display") != "none") return true; else return false; } },
				intensidad: { required: function () { if ($(".seismo").css("display") != "none") return true; else return false; } },
				eventoAsociado: { required: function () { if ($("#eventoAsociado").css("display") != "none") return true; else return false; } }
			},
			messages: {
				tipoEvento: { required: "(*) Campo Requerido" },
				evento: { required: "(*) Campo Requerido" },
				eventoDetalle: { required: "(*) Campo Requerido" },
				fechaEvento: { required: "(*) Campo Requerido" },
				nivelEmergencia: { required: "(*) Campo Requerido" },
				fuenteInicial: { required: "(*) Campo Requerido" },
				descripcionGeneral: { required: "(*) Campo Requerido" },
				departamento: { required: "(*) Campo Requerido" },
				provincia: { required: "(*) Campo Requerido" },
				distritio: { required: "(*) Campo Requerido" },
				latitudsismo: { required: "(*) Campo Requerido" },
				longitudsismo: { required: "(*) Campo Requerido" },
				referencia: { required: "(*) Campo Requerido" },
				profundidad: { required: "(*) Campo Requerido" },
				magnitud: { required: "(*) Campo Requerido" },
				intensidad: { required: "(*) Campo Requerido" },
				eventoAsociado: { required: "(*) Campo Requerido" }
			},
			submitHandler: function (form, event) {

				event.preventDefault();
				var step1 = $("#step-1").css("display");
				var step2 = $("#step-2").css("display");
				if (step1 != "none" && step2 == "none") {

					$("#step-1").css("display", "none");
					$("#step-2").css("display", "block");
					$(".stepwizard-step a:eq(0)").removeClass("active").addClass("disable");
					$(".stepwizard-step a:eq(1)").removeClass("disable").addClass("active");
					$("#btnEventoFinal").text("Registrar Evento");
					return false;

				}

				var latitud = $("#latitud").val();
				var longitud = $("#longitud").val();

				if (latitud.length < 1 || longitud.length < 1) {

					$("#alertaModal").modal("show");
					$("#alertaModal #tituloalerta").text("Error");
					$("#alertaModal #mensajealerta").html("Escoga la ubicaci\xf3n del evento en el mapa");
					return false;

				}

				$("input[name=zoom]").val(generalZoom);
				var formData = ($("#formEvento").serializeArray());
				var data = {};
				formData.forEach((item, index) => {
					data[item.name] = item.value;
				});

				data = {
					...data,
					nombreTipoEvento: $("#tipoEvento option:selected").text(),
					nombreEvento: $("#evento option:selected").text(),
					nombreEventoDetalle: $("#eventoDetalle option:selected").text(),
					nombreNivelEmergencia: $("#nivelEmergencia option:selected").text(),
					nombreFuenteInicial: $("#fuenteInicial option:selected").text()
				}

				const toQueryString = (params) => {
					const query = Object.keys(params).map(key => key + '=' + params[key]).join('&');
					return query;
				};

				$.ajax({
					data: toQueryString(data),
					url: URI + "eventos/eventos/registrar",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
						$("#btnEventoFinal").addClass("disabled");
						$("#message").html("");

					},
					success: function (data) {
						$("#cargando").html("<i></i>");
						var $message = "";
						if (parseInt(data.status) == 200) $message = '<div class="alert alert-success"><h4 style="margin:0">Evento Registrado exitosamente</h4></div>';
						else $message = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar el Evento</h4></div>';

						$('html, body').animate({ scrollTop: 0 }, 'fast');
						$("#message").html($message);
						setTimeout(function () { $("#message").slideUp(); location.href = URI + "eventos/lista"; }, 3500);
					}
				});

			}
		});

		var ejecutarDepa = EVENTO_CODIGO_REGION;

		if (ejecutarDepa.length > 0) {

			$.ajax({
				data: { departamento: ejecutarDepa },
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

						$html += '<option value="' + e.Codigo_Provincia + '">' + e.Nombre + '</option>';

					});
					$("#provincia").html($html);

				}
			});

		}

		$("#departamento").change(function () {

			var id = $(this).val();

			if (id.length > 0) {

				$.ajax({
					data: { departamento: id },
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
					data: { departamento: departamento, provincia: id },
					url: URI + "eventos/main/cargarDistritos",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#distrito").html('<option value="">Cargando...</option>');
					},
					success: function (data) {

						var $html = '<option value="">--Seleccione--</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="' + e.Codigo_Distrito + '">' + e.Nombre + '</option>';

						});
						$("#distrito").html($html);

					}
				});

			}
		});

		$("#distrito").change(function () {

			var id = $(this).val();

			if (id.length > 0) {

				$("input[name=hDepartamento]").val($("#departamento option:selected").text());
				$("input[name=hProvincia]").val($("#provincia option:selected").text());
				$("input[name=hDistrito]").val($("#distrito option:selected").text());

			}

		});

		$("#tipoEvento").change(function () {

			id = $(this).val();

			if (id.length > 0) {

				$.ajax({
					data: { tipoEvento: id },
					url: URI + "eventos/eventos/cargarEvento",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#evento").html('<option value="">Cargando...</option>');
						$("#eventoDetalle").html('<option value="">-- Seleccione Detalle de Evento --</option>');
					},
					success: function (data) {

						var $html = '<option value="">--Seleccione--</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="' + e.Evento_Codigo + '">' + e.Evento_Nombre + '</option>';

						});
						$("#evento").html($html);

					}
				});

			}

		});

		$("#evento").change(function () {

			var id = $(this).val();
			var tipoEvento = $("#tipoEvento").val();

			if (id.length > 0 && tipoEvento.length) {

				if (id == "26" && (tipoEvento == "01" || tipoEvento == "04")) $(".seismo").css("display", "inline-block");
				else $(".seismo").css("display", "none");

				$.ajax({
					data: { evento: id, tipoEvento: tipoEvento },
					url: URI + "eventos/eventos/cargarEventoDetalle",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#eventoDetalle").html('<option value="">Cargando...</option>');
					},
					success: function (data) {

						var $html = '<option value="">--Seleccione--</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="' + e.Evento_Detalle_Codigo + '">' + e.Evento_Detalle_Nombre + '</option>';

						});
						$("#eventoDetalle").html($html);

					}
				});

			}

		});

		var navListItems = $('div.setup-panel div a');
		var allWells = $(".setup-content");

		navListItems.on("click", function (e) {
			e.preventDefault();
			var $target = $($(this).attr('href')),
				$item = $(this);

			if (!$item.hasClass('disabled')) {
				navListItems.removeClass('active');
				$item.addClass('active');
				allWells.hide();
				$target.show();
			}
		});

		$("#btnCancelar").on("click", function () {

			location.href = URI + "eventos/lista";

		});

	});

}
