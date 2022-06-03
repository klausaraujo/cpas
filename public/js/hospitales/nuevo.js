function nuevo(URI) {
	function calculatetab1sec1() {

		const hospitalizacion_convencionales_h = Number($('#hospitalizacion_convencionales_h').val() || 0);
		const hospitalizacion_covid_h = Number($('#hospitalizacion_covid_h').val() || 0);
		const hospitalizacion_e_interna_h = Number($('#hospitalizacion_e_interna_h').val() || 0);
		const hospitalizacion_e_externa_h = Number($('#hospitalizacion_e_externa_h').val() || 0);

		const hospitalizacion_convencionales_u = Number($('#hospitalizacion_convencionales_u').val() || 0);
		const hospitalizacion_covid_u = Number($('#hospitalizacion_covid_u').val() || 0);
		const hospitalizacion_e_interna_u = Number($('#hospitalizacion_e_interna_u').val() || 0);
		const hospitalizacion_e_externa_u = Number($('#hospitalizacion_e_externa_u').val() || 0);

		const hospitalizacion_total_h = hospitalizacion_convencionales_h + hospitalizacion_covid_h + hospitalizacion_e_interna_h + hospitalizacion_e_externa_h;

		const hospitalizacion_total_u = hospitalizacion_convencionales_u + hospitalizacion_covid_u + hospitalizacion_e_interna_u + hospitalizacion_e_externa_u;

		$('#hospitalizacion_total_h').val(hospitalizacion_total_h);

		$('#hospitalizacion_total_u').val(hospitalizacion_total_u);

		$('#hospitalizacion_e_interna_h_covid').val(hospitalizacion_e_interna_h);
		$('#hospitalizacion_e_interna_u_covid').val(hospitalizacion_e_interna_u);
		$('#hospitalizacion_e_externa_h_covid').val(hospitalizacion_e_externa_h);
		$('#hospitalizacion_e_externa_u_covid').val(hospitalizacion_e_externa_u);

		$('#hospitalizacion_disponibles').val(hospitalizacion_total_h - hospitalizacion_total_u);
		$('#hospitalizacion_porcentaje_01').val(Math.round(hospitalizacion_total_u / hospitalizacion_convencionales_u * 100 || 0));
		$('#hospitalizacion_porcentaje_01_5').val(Math.round(hospitalizacion_total_u / hospitalizacion_convencionales_u * 100 || 0));

	};

	function calculatetab1sec2() {

		const hospitalizacion_sospechosos_h_covid = Number($('#hospitalizacion_sospechosos_h_covid').val() || 0);
		const hospitalizacion_sospechosos_u_covid = Number($('#hospitalizacion_sospechosos_u_covid').val() || 0);
		const hospitalizacion_e_interna_h_covid = Number($('#hospitalizacion_e_interna_h_covid').val() || 0);
		const hospitalizacion_e_interna_u_covid = Number($('#hospitalizacion_e_interna_u_covid').val() || 0);

		const hospitalizacion_e_externa_h_covid = Number($('#hospitalizacion_e_externa_h_covid').val() || 0);
		const hospitalizacion_e_externa_u_covid = Number($('#hospitalizacion_e_externa_u_covid').val() || 0);

		const hospitalizacion_total_h_covid = hospitalizacion_sospechosos_h_covid + hospitalizacion_e_interna_h_covid + hospitalizacion_e_externa_h_covid;

		const hospitalizacion_total_u_covid = hospitalizacion_sospechosos_u_covid + hospitalizacion_e_interna_u_covid + hospitalizacion_e_externa_u_covid;

		$('#hospitalizacion_total_h_covid').val(hospitalizacion_total_h_covid);

		$('#hospitalizacion_total_u_covid').val(hospitalizacion_total_u_covid);

		$('#emergencia_e_interna_h_covid').val(emergencia_e_interna_h);
		$('#emergencia_e_interna_u_covid').val(emergencia_e_interna_u);
		$('#emergencia_e_externa_h_covid').val(emergencia_e_externa_h);
		$('#emergencia_e_externa_u_covid').val(emergencia_e_externa_u);

		$('#hospitalizacion_disponibles_covid').val(hospitalizacion_total_h_covid - hospitalizacion_total_u_covid);
		$('#hospitalizacion_porcentaje_02').val(Math.round(hospitalizacion_total_u_covid / hospitalizacion_sospechosos_u_covid * 100 || 0));
		$('#hospitalizacion_porcentaje_02_5').val(Math.round(hospitalizacion_total_u_covid / hospitalizacion_sospechosos_u_covid * 100 || 0));

	};

	function calculatetab2sec1() {

		const emergencia_convencionales_h = Number($('#emergencia_convencionales_h').val() || 0);
		const emergencia_convencionales_u = Number($('#emergencia_convencionales_u').val() || 0);
		const emergencia_covid_h = Number($('#emergencia_covid_h').val() || 0);
		const emergencia_covid_u = Number($('#emergencia_covid_u').val() || 0);

		const emergencia_e_interna_h = Number($('#emergencia_e_interna_h').val() || 0);
		const emergencia_e_interna_u = Number($('#emergencia_e_interna_u').val() || 0);
		const emergencia_e_externa_h = Number($('#emergencia_e_externa_h').val() || 0);
		const emergencia_e_externa_u = Number($('#emergencia_e_externa_u').val() || 0);

		const emergencia_espera_u = Number($('#emergencia_espera_u').val() || 0);

		const emergencia_total_h = emergencia_convencionales_h + emergencia_covid_h + emergencia_e_interna_h + emergencia_e_externa_h;

		const emergencia_total_u = emergencia_convencionales_u + emergencia_covid_u + emergencia_e_interna_u + emergencia_e_externa_u + emergencia_espera_u;

		$('#emergencia_total_h').val(emergencia_total_h);

		$('#emergencia_total_u').val(emergencia_total_u);

		$('#emergencia_e_interna_h_covid').val(emergencia_e_interna_h);
		$('#emergencia_e_interna_u_covid').val(emergencia_e_interna_u);
		$('#emergencia_e_externa_h_covid').val(emergencia_e_externa_h);
		$('#emergencia_e_externa_u_covid').val(emergencia_e_externa_u);

		$('#emergencia_disponibles').val(emergencia_total_h - emergencia_total_u);
		$('#emergencia_porcentaje_01').val(Math.round(emergencia_total_u / emergencia_convencionales_u * 100 || 0));
		$('#emergencia_porcentaje_01_5').val(Math.round(emergencia_total_u / emergencia_convencionales_u * 100 || 0));

	};

	function calculatetab2sec2() {

		const emergencia_sospechosos_h_covid = Number($('#emergencia_sospechosos_h_covid').val() || 0);
		const emergencia_sospechosos_u_covid = Number($('#emergencia_sospechosos_u_covid').val() || 0);
		const emergencia_e_interna_h_covid = Number($('#emergencia_e_interna_h_covid').val() || 0);
		const emergencia_e_interna_u_covid = Number($('#emergencia_e_interna_u_covid').val() || 0);

		const emergencia_e_externa_h_covid = Number($('#emergencia_e_externa_h_covid').val() || 0);
		const emergencia_e_externa_u_covid = Number($('#emergencia_e_externa_u_covid').val() || 0);

		const emergencia_espera_u_covid = Number($('#emergencia_espera_u_covid').val() || 0);

		const emergencia_total_h_covid = emergencia_sospechosos_h_covid + emergencia_e_interna_h_covid + emergencia_e_externa_h_covid;

		const emergencia_total_u_covid = emergencia_sospechosos_u_covid + emergencia_e_interna_u_covid + emergencia_e_externa_u_covid + emergencia_espera_u_covid;

		$('#emergencia_total_h_covid').val(emergencia_total_h_covid);

		$('#emergencia_total_u_covid').val(emergencia_total_u_covid);

		$('#emergencia_disponibles_covid').val(emergencia_total_h_covid - emergencia_total_u_covid);
		$('#emergencia_porcentaje_02').val(Math.round(emergencia_total_u_covid / emergencia_sospechosos_u_covid * 100 || 0));
		$('#emergencia_porcentaje_02_5').val(Math.round(emergencia_total_u_covid / emergencia_sospechosos_u_covid * 100 || 0));

	};

	function calculatetab3sec1() {

		const criticos_convencionales_h = Number($('#criticos_convencionales_h').val() || 0);
		const criticos_convencionales_u = Number($('#criticos_convencionales_u').val() || 0);
		const criticos_covid_h = Number($('#criticos_covid_h').val() || 0);
		const criticos_covid_u = Number($('#criticos_covid_u').val() || 0);

		const criticos_e_interna_h = Number($('#criticos_e_interna_h').val() || 0);
		const criticos_e_interna_u = Number($('#criticos_e_interna_u').val() || 0);
		const criticos_e_externa_h = Number($('#criticos_e_externa_h').val() || 0);
		const criticos_e_externa_u = Number($('#criticos_e_externa_u').val() || 0);

		const criticos_espera_u = Number($('#criticos_espera_u').val() || 0);

		const criticos_total_h = criticos_convencionales_h + criticos_covid_h + criticos_e_interna_h + criticos_e_externa_h;

		const criticos_total_u = criticos_convencionales_u + criticos_covid_u + criticos_e_interna_u + criticos_e_externa_u + criticos_espera_u;

		$('#criticos_total_h').val(criticos_total_h);

		$('#criticos_total_u').val(criticos_total_u);

		$('#criticos_e_interna_h_covid').val(criticos_e_interna_h);
		$('#criticos_e_interna_u_covid').val(criticos_e_interna_u);
		$('#criticos_e_externa_h_covid').val(criticos_e_externa_h);
		$('#criticos_e_externa_u_covid').val(criticos_e_externa_u);

		$('#criticos_disponibles').val(criticos_total_h - criticos_total_u);
		$('#criticos_porcentaje_01').val(Math.round(criticos_total_u / criticos_convencionales_u * 100 || 0));
		$('#criticos_porcentaje_01_5').val(Math.round(criticos_total_u / criticos_convencionales_u * 100 || 0));

	};

	function calculatetab3sec2() {

		const criticos_sospechosos_h_covid = Number($('#criticos_sospechosos_h_covid').val() || 0);
		const criticos_sospechosos_u_covid = Number($('#criticos_sospechosos_u_covid').val() || 0);
		const criticos_e_interna_h_covid = Number($('#criticos_e_interna_h_covid').val() || 0);
		const criticos_e_interna_u_covid = Number($('#criticos_e_interna_u_covid').val() || 0);

		const criticos_e_externa_h_covid = Number($('#criticos_e_externa_h_covid').val() || 0);
		const criticos_e_externa_u_covid = Number($('#criticos_e_externa_u_covid').val() || 0);

		const criticos_espera_u_covid = Number($('#criticos_espera_u_covid').val() || 0);

		const criticos_total_h_covid = criticos_sospechosos_h_covid + criticos_e_interna_h_covid + criticos_e_externa_h_covid;

		const criticos_total_u_covid = criticos_sospechosos_u_covid + criticos_e_interna_u_covid + criticos_e_externa_u_covid + criticos_espera_u_covid;

		$('#criticos_total_h_covid').val(criticos_total_h_covid);

		$('#criticos_total_u_covid').val(criticos_total_u_covid);

		$('#criticos_disponibles_covid').val(criticos_total_h_covid - criticos_total_u_covid);
		$('#criticos_porcentaje_02').val(Math.round(criticos_total_u_covid / criticos_sospechosos_u_covid * 100 || 0));
		$('#criticos_porcentaje_02_5').val(Math.round(criticos_total_u_covid / criticos_sospechosos_u_covid * 100 || 0));

	};

	function calculatetab4sec1() {

		const pediatricos_convencionales_h = Number($('#pediatricos_convencionales_h').val() || 0);
		const pediatricos_convencionales_u = Number($('#pediatricos_convencionales_u').val() || 0);
		const pediatricos_covid_h = Number($('#pediatricos_covid_h').val() || 0);
		const pediatricos_covid_u = Number($('#pediatricos_covid_u').val() || 0);

		const pediatricos_e_interna_h = Number($('#pediatricos_e_interna_h').val() || 0);
		const pediatricos_e_interna_u = Number($('#pediatricos_e_interna_u').val() || 0);
		const pediatricos_e_externa_h = Number($('#pediatricos_e_externa_h').val() || 0);
		const pediatricos_e_externa_u = Number($('#pediatricos_e_externa_u').val() || 0);

		const pediatricos_espera_u = Number($('#pediatricos_espera_u').val() || 0);

		const pediatricos_total_h = pediatricos_convencionales_h + pediatricos_covid_h + pediatricos_e_interna_h + pediatricos_e_externa_h;

		const pediatricos_total_u = pediatricos_convencionales_u + pediatricos_covid_u + pediatricos_e_interna_u + pediatricos_e_externa_u + pediatricos_espera_u;

		$('#pediatricos_total_h').val(pediatricos_total_h);

		$('#pediatricos_total_u').val(pediatricos_total_u);

		$('#pediatricos_e_interna_h_covid').val(pediatricos_e_interna_h);
		$('#pediatricos_e_interna_u_covid').val(pediatricos_e_interna_u);
		$('#pediatricos_e_externa_h_covid').val(pediatricos_e_externa_h);
		$('#pediatricos_e_externa_u_covid').val(pediatricos_e_externa_u);

		$('#pediatricos_disponibles').val(pediatricos_total_h - pediatricos_total_u);
		$('#pediatricos_porcentaje_01').val(Math.round(pediatricos_total_u / pediatricos_convencionales_u * 100 || 0));
		$('#pediatricos_porcentaje_01_5').val(Math.round(pediatricos_total_u / pediatricos_convencionales_u * 100 || 0));

	};

	function calculatetab4sec2() {

		const pediatricos_sospechosos_h_covid = Number($('#pediatricos_sospechosos_h_covid').val() || 0);
		const pediatricos_sospechosos_u_covid = Number($('#pediatricos_sospechosos_u_covid').val() || 0);
		const pediatricos_e_interna_h_covid = Number($('#pediatricos_e_interna_h_covid').val() || 0);
		const pediatricos_e_interna_u_covid = Number($('#pediatricos_e_interna_u_covid').val() || 0);

		const pediatricos_e_externa_h_covid = Number($('#pediatricos_e_externa_h_covid').val() || 0);
		const pediatricos_e_externa_u_covid = Number($('#pediatricos_e_externa_u_covid').val() || 0);

		const pediatricos_espera_u_covid = Number($('#pediatricos_espera_u_covid').val() || 0);

		const pediatricos_total_h_covid = pediatricos_sospechosos_h_covid + pediatricos_e_interna_h_covid + pediatricos_e_externa_h_covid;

		const pediatricos_total_u_covid = pediatricos_sospechosos_u_covid + pediatricos_e_interna_u_covid + pediatricos_e_externa_u_covid + pediatricos_espera_u_covid;

		$('#pediatricos_total_h_covid').val(pediatricos_total_h_covid);

		$('#pediatricos_total_u_covid').val(pediatricos_total_u_covid);

		$('#pediatricos_disponibles_covid').val(pediatricos_total_h_covid - pediatricos_total_u_covid);
		$('#pediatricos_porcentaje_02').val(Math.round(pediatricos_total_u_covid / pediatricos_sospechosos_u_covid * 100 || 0));
		$('#pediatricos_porcentaje_02_5').val(Math.round(pediatricos_total_u_covid / pediatricos_sospechosos_u_covid * 100 || 0));

	};
	$("#formHospital").validate({
		rules: {
			ipress: { required: true },
			region: { required: true },
			ocupacion_responsable_reporte: { required: true },
			ocupacion_jefe_guardia: { required: true },
			fechaRegistro: { required: true },

			hospitalizacion_convencionales_h: { required: true },
			hospitalizacion_convencionales_u: { required: true },
			hospitalizacion_covid_h: { required: true },
			hospitalizacion_covid_u: { required: true },
			hospitalizacion_e_interna_h: { required: true },
			hospitalizacion_e_interna_u: { required: true },
			hospitalizacion_e_externa_h: { required: true },
			hospitalizacion_e_externa_u: { required: true },
			hospitalizacion_sospechosos_h_covid: { required: true },
			hospitalizacion_sospechosos_u_covid: { required: true },
			hospitalizacion_e_interna_h_covid: { required: true },
			hospitalizacion_e_interna_u_covid: { required: true },
			hospitalizacion_e_externa_h_covid: { required: true },
			hospitalizacion_e_externa_u_covid: { required: true },
			emergencia_convencionales_h: { required: true },
			emergencia_convencionales_u: { required: true },
			emergencia_covid_h: { required: true },
			emergencia_covid_u: { required: true },
			emergencia_e_interna_h: { required: true },
			emergencia_e_interna_u: { required: true },
			emergencia_e_externa_h: { required: true },
			emergencia_e_externa_u: { required: true },
			emergencia_espera_u: { required: true },
			emergencia_sospechosos_h_covid: { required: true },
			emergencia_sospechosos_u_covid: { required: true },
			emergencia_e_interna_h_covid: { required: true },
			emergencia_e_interna_u_covid: { required: true },
			emergencia_e_externa_h_covid: { required: true },
			emergencia_e_externa_u_covid: { required: true },
			emergencia_espera_u_covid: { required: true },
			criticos_convencionales_h: { required: true },
			criticos_convencionales_u: { required: true },
			criticos_covid_h: { required: true },
			criticos_covid_u: { required: true },
			criticos_e_interna_h: { required: true },
			criticos_e_interna_u: { required: true },
			criticos_e_externa_h: { required: true },
			criticos_e_externa_u: { required: true },
			criticos_espera_u: { required: true },
			criticos_sospechosos_h_covid: { required: true },
			criticos_sospechosos_u_covid: { required: true },
			criticos_e_interna_h_covid: { required: true },
			criticos_e_interna_u_covid: { required: true },
			criticos_e_externa_h_covid: { required: true },
			criticos_e_externa_u_covid: { required: true },
			criticos_espera_u_covid: { required: true },
			pediatricos_convencionales_h: { required: true },
			pediatricos_convencionales_u: { required: true },
			pediatricos_covid_h: { required: true },
			pediatricos_covid_u: { required: true },
			pediatricos_e_interna_h: { required: true },
			pediatricos_e_interna_u: { required: true },
			pediatricos_e_externa_h: { required: true },
			pediatricos_e_externa_u: { required: true },
			pediatricos_espera_u: { required: true },
			pediatricos_sospechosos_h_covid: { required: true },
			pediatricos_sospechosos_u_covid: { required: true },
			pediatricos_e_interna_h_covid: { required: true },
			pediatricos_e_interna_u_covid: { required: true },
			pediatricos_e_externa_h_covid: { required: true },
			pediatricos_e_externa_u_covid: { required: true },
			pediatricos_espera_u_covid: { required: true }

		},
		messages: {
			ipress: { required: "(*) Campo Requerido" },
			region: { required: "(*) Campo Requerido" },
			ocupacion_responsable_reporte: { required: "(*) Campo Requerido" },
			ocupacion_jefe_guardia: { required: "(*) Campo Requerido" },
			atencionInterna: { required: "(*) Campo Requerido" },
			atencionExterna: { required: "(*) Campo Requerido" },
			fechaRegistro: { required: "(*) Campo Requerido" },

			hospitalizacion_convencionales_h: { required: "Campo requerido" },
			hospitalizacion_convencionales_u: { required: "Campo requerido" },
			hospitalizacion_covid_h: { required: "Campo requerido" },
			hospitalizacion_covid_u: { required: "Campo requerido" },
			hospitalizacion_e_interna_h: { required: "Campo requerido" },
			hospitalizacion_e_interna_u: { required: "Campo requerido" },
			hospitalizacion_e_externa_h: { required: "Campo requerido" },
			hospitalizacion_e_externa_u: { required: "Campo requerido" },
			hospitalizacion_sospechosos_h_covid: { required: "Campo requerido" },
			hospitalizacion_sospechosos_u_covid: { required: "Campo requerido" },
			hospitalizacion_e_interna_h_covid: { required: "Campo requerido" },
			hospitalizacion_e_interna_u_covid: { required: "Campo requerido" },
			hospitalizacion_e_externa_h_covid: { required: "Campo requerido" },
			hospitalizacion_e_externa_u_covid: { required: "Campo requerido" },
			emergencia_convencionales_h: { required: "Campo requerido" },
			emergencia_convencionales_u: { required: "Campo requerido" },
			emergencia_covid_h: { required: "Campo requerido" },
			emergencia_covid_u: { required: "Campo requerido" },
			emergencia_e_interna_h: { required: "Campo requerido" },
			emergencia_e_interna_u: { required: "Campo requerido" },
			emergencia_e_externa_h: { required: "Campo requerido" },
			emergencia_e_externa_u: { required: "Campo requerido" },
			emergencia_espera_u: { required: "Campo requerido" },
			emergencia_sospechosos_h_covid: { required: "Campo requerido" },
			emergencia_sospechosos_u_covid: { required: "Campo requerido" },
			emergencia_e_interna_h_covid: { required: "Campo requerido" },
			emergencia_e_interna_u_covid: { required: "Campo requerido" },
			emergencia_e_externa_h_covid: { required: "Campo requerido" },
			emergencia_e_externa_u_covid: { required: "Campo requerido" },
			emergencia_espera_u_covid: { required: "Campo requerido" },
			criticos_convencionales_h: { required: "Campo requerido" },
			criticos_convencionales_u: { required: "Campo requerido" },
			criticos_covid_h: { required: "Campo requerido" },
			criticos_covid_u: { required: "Campo requerido" },
			criticos_e_interna_h: { required: "Campo requerido" },
			criticos_e_interna_u: { required: "Campo requerido" },
			criticos_e_externa_h: { required: "Campo requerido" },
			criticos_e_externa_u: { required: "Campo requerido" },
			criticos_espera_u: { required: "Campo requerido" },
			criticos_sospechosos_h_covid: { required: "Campo requerido" },
			criticos_sospechosos_u_covid: { required: "Campo requerido" },
			criticos_e_interna_h_covid: { required: "Campo requerido" },
			criticos_e_interna_u_covid: { required: "Campo requerido" },
			criticos_e_externa_h_covid: { required: "Campo requerido" },
			criticos_e_externa_u_covid: { required: "Campo requerido" },
			criticos_espera_u_covid: { required: "Campo requerido" },
			pediatricos_convencionales_h: { required: "Campo requerido" },
			pediatricos_convencionales_u: { required: "Campo requerido" },
			pediatricos_covid_h: { required: "Campo requerido" },
			pediatricos_covid_u: { required: "Campo requerido" },
			pediatricos_e_interna_h: { required: "Campo requerido" },
			pediatricos_e_interna_u: { required: "Campo requerido" },
			pediatricos_e_externa_h: { required: "Campo requerido" },
			pediatricos_e_externa_u: { required: "Campo requerido" },
			pediatricos_espera_u: { required: "Campo requerido" },
			pediatricos_sospechosos_h_covid: { required: "Campo requerido" },
			pediatricos_sospechosos_u_covid: { required: "Campo requerido" },
			pediatricos_e_interna_h_covid: { required: "Campo requerido" },
			pediatricos_e_interna_u_covid: { required: "Campo requerido" },
			pediatricos_e_externa_h_covid: { required: "Campo requerido" },
			pediatricos_e_externa_u_covid: { required: "Campo requerido" },
			pediatricos_espera_u_covid: { required: "Campo requerido" }

		},
		errorPlacement: function (error, element) {
			if (element.attr("name") == "fecha") {
				error.insertAfter("#error_fecha");
			}
			else {
				error.insertAfter(element);
			}
		}, submitHandler: function (form, event) {
			event.preventDefault();
			$.ajax({
				type: "POST",
				url: URI + "hospitales/main/gestionarDemanda",
				data: $("#formHospital").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
					$("#btnRegistrar").addClass("disabled");
					$("#message").html("");
				},
				error: function (xhr) {
					$("#cargando").html("<i></i>");
					$("#btnRegistrar").removeClass("disabled");
					$message = '<div class="alert alert-warning"><h4 style="margin:0">Error en el proceso</h4></div>';
					$("#message").html($message);
					$('html, body').animate({ scrollTop: 0 }, 'fast');
					setTimeout(function () { $("#message").slideUp(); }, 3000);
				},
				success: function (data) {
					$("#cargando").html("<i></i>");
					$('html, body').animate({ scrollTop: 0 }, 'fast');

					var $message = "";

					if (parseInt(data.status) == 200) $message = '<div class="alert alert-success"><h4 style="margin:0">' + data.message + '</h4></div>';
					else {
						$message = '<div class="alert alert-warning"><h4 style="margin:0">' + data.message + '</h4></div>';
						$("#btnRegistrar").removeClass("disabled");
					}

					$("#message").html($message);

					if (parseInt(data.status) == 200) setTimeout(function () { $("#message").slideUp(); location.href = URI + "hospitales"; }, 3000);
				}
			});

		}
	});

	$("select[name=emed_tipo_documento]").on("change", function () {

		var select = $(this).val();
		if (select == "06") deshabilitarReniec();
		else habilitarReniec();

	});

	function habilitarReniec() {
		$("input[name=dni_responsable_reporte]").removeAttr("readonly");
		$("input[name=responsable_reporte]").attr("readonly", "readonly");
	}
	function deshabilitarReniec() {

		$("input[name=dni_responsable_reporte]").attr("readonly", "readonly");
		$("input[name=responsable_reporte]").removeAttr("readonly");
	}

	$("select[name=supervidor_tipo_documento]").on("change", function () {

		var select = $(this).val();
		if (select == "06") deshabilitarReniec1();
		else habilitarReniec1();

	});

	function habilitarReniec1() {
		$("input[name=dni_jefe_guardia]").removeAttr("readonly");
		$("input[name=jefe_guardia]").attr("readonly", "readonly");
	}
	function deshabilitarReniec1() {

		$("input[name=dni_jefe_guardia]").attr("readonly", "readonly");
		$("input[name=jefe_guardia]").removeAttr("readonly");
	}

	$(document).ready(function () {

		$("#datetimepicker").datetimepicker({
			format: "DD/MM/YYYY",
			maxDate: moment()
		});

		$(".datetimepicker").datetimepicker({
			format: "DD/MM/YYYY H:m",
			maxDate: moment()
		});

		$("#btnCancelar").on("click", function () {

			location.href = URI + "hospitales";

		});

		$("#btn-buscarr").on("click", function () {
			var documento_numero = $("input[name=dni_responsable_reporte]").val();

			if (documento_numero.length >= 8) {
				var type = "01";
				$.ajax({
					url: URI + "hospitales/main/curl",
					data: { type: type, document: documento_numero },
					method: 'post',
					dataType: 'json',
					error: function (xhr) {
						$("#btn-buscarr").removeAttr("disabled");
						$("#btn-buscarr").html('<i class="fa fa-search" aria-hidden="true"></i>');
					},
					beforeSend: function () {

						$("#btn-buscarr").html('<i class="fa fa-spinner fa-pulse"></i>');
						$("#btn-buscarr").attr("disabled", "disabled");
					},
					success: function (data) {
						$("#btn-buscarr").removeAttr("disabled");
						$("#btn-buscarr").html('<i class="fa fa-search" aria-hidden="true"></i>');

						$("input[name=responsable_reporte]").val(data.data.attributes.nombres + " " + data.data.attributes.apellido_paterno + " " + data.data.attributes.apellido_materno);

					}
				});

			}

		});

		$("#btn-buscarj").on("click", function () {
			var documento_numero = $("input[name=dni_jefe_guardia]").val();

			if (documento_numero.length >= 8) {
				var type = "01";
				$.ajax({
					url: URI + "hospitales/main/curl",
					data: { type: type, document: documento_numero },
					method: 'post',
					dataType: 'json',
					error: function (xhr) {
						$("#btn-buscarj").removeAttr("disabled");
						$("#btn-buscarj").html('<i class="fa fa-search" aria-hidden="true"></i>');
					},
					beforeSend: function () {

						$("#btn-buscarj").html('<i class="fa fa-spinner fa-pulse"></i>');
						$("#btn-buscarj").attr("disabled", "disabled");
					},
					success: function (data) {
						$("#btn-buscarj").removeAttr("disabled");
						$("#btn-buscarj").html('<i class="fa fa-search" aria-hidden="true"></i>');

						$("input[name=jefe_guardia]").val(data.data.attributes.nombres + " " + data.data.attributes.apellido_paterno + " " + data.data.attributes.apellido_materno);

					}
				});

			}

		});

		$("#btn-ocurrencia").on("click", function () {

			var fecha = $("#formOcurrencia input[name=fecha-ocurrencia]").val();
			var ocurrencia = $("#formOcurrencia textarea[name=ocurrencia]").val();

			if (fecha.length >= 14 && fecha.length <= 16 && ocurrencia.length > 0) {

				var rows = $("#table-ocurrencia tbody").html();

				var html = '';

				if (ocurrencia.length > 60) {
					html = '<tr class="ocurrencia"><td class="ocu-fecha">' + fecha + '</td><td class="tool"><span class="toolt ocu-ocu">' + ocurrencia + '</span>' + ocurrencia.substring(0, 59) + '...</td><td><i class="fa fa-times"></i></td></tr>';
				} else {
					html = '<tr class="ocurrencia"><td class="ocu-fecha">' + fecha + '</td><td class="ocu-ocu">' + ocurrencia + '</td><td><i class="fa fa-times"></i></td></tr>';
				}
				$("#table-ocurrencia tbody").append(html);

				$("#formOcurrencia input[name=fecha-ocurrencia]").val('');
				$("#formOcurrencia textarea[name=ocurrencia]").val('');

			}

		});
		$("#btn-calcular").on("click", function () {

			var A1 =
				parseInt($("input[name=nedocs_camas_emergencia_ocupadas_pasillos]").val()) +
				parseInt($("input[name=nedocs_camas_emergencia_ocupadas_areas_contigencia]").val()) +
				parseInt($("input[name=nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres]").val()) +
				parseInt($("input[name=nedocs_capacidad_expansion_emergencias_desastres]").val());

			var A2 = parseInt($("input[name=nedocs_shock_trauma]").val()) +
				parseInt($("input[name=nedocs_medicina]").val()) +
				parseInt($("input[name=nedocs_cirugia]").val()) +
				parseInt($("input[name=nedocs_gineco_obstetricia]").val()) +
				parseInt($("input[name=nedocs_pedriatria]").val()) +
				parseInt($("input[name=nedocs_observacion_medicina]").val()) +
				parseInt($("input[name=nedocs_observacion_cirugia]").val()) +
				parseInt($("input[name=nedocs_observacion_gineco_obstetricia]").val()) +
				parseInt($("input[name=nedocs_observacion_pediatria]").val());

			var B1 = parseInt($("input[name=nedocs_pacientes_espera_cama_internamiento]").val());
			var B2 = parseInt($("input[name=nedocs_cantidad_total_camas_hospital]").val());
			var C = parseFloat($("input[name=nedocs_tiempo_espera_ensala_ultimo_paciente_llamado]").val());
			var D = parseFloat($("input[name=nedocs_tiempo_espera_mas_largo_por_cama_de_internacion]").val());
			var E = parseInt($("input[name=nedocs_cantidad_total_pacientes_ventilacion]").val());

			if (E >= 2) { E = 2; }
			else { E = 0; }

			var NEDOCS = (-20) + 85.8 * (A1 / A2) + 600 * (B1 / B2) + 5.64 * C + 0.93 * D + 13.4 * E;

			var redondeado = Math.round(NEDOCS);

			if (redondeado >= 200) {
				redondeado = 200;
			}
			else { redondeado = redondeado; }
			document.getElementById("nedocs_resultado").value = redondeado;
			console.log("Calculando Nedocs sin redondeo: " + redondeado);

		});
		$("#btn-calcular-ejemplo").on("click", function () {

			document.getElementById("nedocs_shock_trauma").value = 3;
			document.getElementById("nedocs_medicina").value = 20;
			document.getElementById("nedocs_cirugia").value = 10;
			document.getElementById("nedocs_gineco_obstetricia").value = 10;
			document.getElementById("nedocs_pedriatria").value = 10;
			document.getElementById("nedocs_observacion_medicina").value = 36;
			document.getElementById("nedocs_observacion_cirugia").value = 8;
			document.getElementById("nedocs_observacion_gineco_obstetricia").value = 5;
			document.getElementById("nedocs_observacion_pediatria").value = 5;

			document.getElementById("nedocs_camas_emergencia_ocupadas_pasillos").value = 60;
			document.getElementById("nedocs_camas_emergencia_ocupadas_areas_contigencia").value = 10;
			document.getElementById("nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres").value = 10;
			document.getElementById("nedocs_capacidad_expansion_emergencias_desastres").value = 0;

			document.getElementById("nedocs_tiempo_espera_ensala_ultimo_paciente_llamado").value = 0.25;
			document.getElementById("nedocs_tiempo_espera_mas_largo_por_cama_de_internacion").value = 6;
			document.getElementById("nedocs_pacientes_espera_cama_internamiento").value = 40;
			document.getElementById("nedocs_cantidad_total_pacientes_ventilacion").value = 6;
			document.getElementById("nedocs_cantidad_total_camas_hospital").value = 462;

			alert("Se ha Cargado una Data de Ejemplo Real, Haga Click en el Botón Calcular Indice para Medir el Indice de Nedocs");

		});

		$('html, body').on("click", ".fa-times", function () {
			$(this).closest('tr').remove();
		});
		$("input[name=hospitalizacion_convencionales_h]").on("keyup", function () { calculatetab1sec1(); });
		$("input[name=hospitalizacion_convencionales_u]").on("keyup", function () { calculatetab1sec1(); });
		$("input[name=hospitalizacion_covid_h]").on("keyup", function () { calculatetab1sec1(); });
		$("input[name=hospitalizacion_covid_u]").on("keyup", function () { calculatetab1sec1(); });
		$("input[name=hospitalizacion_e_interna_h]").on("keyup", function () { calculatetab1sec1(); });
		$("input[name=hospitalizacion_e_interna_u]").on("keyup", function () { calculatetab1sec1(); });
		$("input[name=hospitalizacion_e_externa_h]").on("keyup", function () { calculatetab1sec1(); });
		$("input[name=hospitalizacion_e_externa_u]").on("keyup", function () { calculatetab1sec1(); });

		$("input[name=hospitalizacion_sospechosos_h_covid]").on("keyup", function () { calculatetab1sec2(); });
		$("input[name=hospitalizacion_sospechosos_u_covid]").on("keyup", function () { calculatetab1sec2(); });
		$("input[name=hospitalizacion_e_interna_h_covid]").on("keyup", function () { calculatetab1sec2(); });
		$("input[name=hospitalizacion_e_interna_u_covid]").on("keyup", function () { calculatetab1sec2(); });
		$("input[name=hospitalizacion_e_externa_h_covid]").on("keyup", function () { calculatetab1sec2(); });
		$("input[name=hospitalizacion_e_externa_u_covid]").on("keyup", function () { calculatetab1sec2(); });

		$("input[name=emergencia_convencionales_h]").on("keyup", function () { calculatetab2sec1(); });
		$("input[name=emergencia_convencionales_u]").on("keyup", function () { calculatetab2sec1(); });
		$("input[name=emergencia_covid_h]").on("keyup", function () { calculatetab2sec1(); });
		$("input[name=emergencia_covid_u]").on("keyup", function () { calculatetab2sec1(); });
		$("input[name=emergencia_e_interna_h]").on("keyup", function () { calculatetab2sec1(); });
		$("input[name=emergencia_e_interna_u]").on("keyup", function () { calculatetab2sec1(); });
		$("input[name=emergencia_e_externa_h]").on("keyup", function () { calculatetab2sec1(); });
		$("input[name=emergencia_e_externa_u]").on("keyup", function () { calculatetab2sec1(); });
		$("input[name=emergencia_espera_u]").on("keyup", function () { calculatetab2sec1(); });

		$("input[name=emergencia_sospechosos_h_covid]").on("keyup", function () { calculatetab2sec2(); });
		$("input[name=emergencia_sospechosos_u_covid]").on("keyup", function () { calculatetab2sec2(); });
		$("input[name=emergencia_e_interna_h_covid]").on("keyup", function () { calculatetab2sec2(); });
		$("input[name=emergencia_e_interna_u_covid]").on("keyup", function () { calculatetab2sec2(); });
		$("input[name=emergencia_e_externa_h_covid]").on("keyup", function () { calculatetab2sec2(); });
		$("input[name=emergencia_e_externa_u_covid]").on("keyup", function () { calculatetab2sec2(); });
		$("input[name=emergencia_espera_u_covid]").on("keyup", function () { calculatetab2sec2(); });

		$("input[name=criticos_convencionales_h]").on("keyup", function () { calculatetab3sec1(); });
		$("input[name=criticos_convencionales_u]").on("keyup", function () { calculatetab3sec1(); });
		$("input[name=criticos_covid_h]").on("keyup", function () { calculatetab3sec1(); });
		$("input[name=criticos_covid_u]").on("keyup", function () { calculatetab3sec1(); });
		$("input[name=criticos_e_interna_h]").on("keyup", function () { calculatetab3sec1(); });
		$("input[name=criticos_e_interna_u]").on("keyup", function () { calculatetab3sec1(); });
		$("input[name=criticos_e_externa_h]").on("keyup", function () { calculatetab3sec1(); });
		$("input[name=criticos_e_externa_u]").on("keyup", function () { calculatetab3sec1(); });
		$("input[name=criticos_espera_u]").on("keyup", function () { calculatetab3sec1(); });

		$("input[name=criticos_sospechosos_h_covid]").on("keyup", function () { calculatetab3sec2(); });
		$("input[name=criticos_sospechosos_u_covid]").on("keyup", function () { calculatetab3sec2(); });
		$("input[name=criticos_e_interna_h_covid]").on("keyup", function () { calculatetab3sec2(); });
		$("input[name=criticos_e_interna_u_covid]").on("keyup", function () { calculatetab3sec2(); });
		$("input[name=criticos_e_externa_h_covid]").on("keyup", function () { calculatetab3sec2(); });
		$("input[name=criticos_e_externa_u_covid]").on("keyup", function () { calculatetab3sec2(); });
		$("input[name=criticos_espera_u_covid]").on("keyup", function () { calculatetab3sec2(); });

		$("input[name=pediatricos_convencionales_h]").on("keyup", function () { calculatetab4sec1(); });
		$("input[name=pediatricos_convencionales_u]").on("keyup", function () { calculatetab4sec1(); });
		$("input[name=pediatricos_covid_h]").on("keyup", function () { calculatetab4sec1(); });
		$("input[name=pediatricos_covid_u]").on("keyup", function () { calculatetab4sec1(); });
		$("input[name=pediatricos_e_interna_h]").on("keyup", function () { calculatetab4sec1(); });
		$("input[name=pediatricos_e_interna_u]").on("keyup", function () { calculatetab4sec1(); });
		$("input[name=pediatricos_e_externa_h]").on("keyup", function () { calculatetab4sec1(); });
		$("input[name=pediatricos_e_externa_u]").on("keyup", function () { calculatetab4sec1(); });
		$("input[name=pediatricos_espera_u]").on("keyup", function () { calculatetab4sec1(); });

		$("input[name=pediatricos_sospechosos_h_covid]").on("keyup", function () { calculatetab4sec2(); });
		$("input[name=pediatricos_sospechosos_u_covid]").on("keyup", function () { calculatetab4sec2(); });
		$("input[name=pediatricos_e_interna_h_covid]").on("keyup", function () { calculatetab4sec2(); });
		$("input[name=pediatricos_e_interna_u_covid]").on("keyup", function () { calculatetab4sec2(); });
		$("input[name=pediatricos_e_externa_h_covid]").on("keyup", function () { calculatetab4sec2(); });
		$("input[name=pediatricos_e_externa_u_covid]").on("keyup", function () { calculatetab4sec2(); });
		$("input[name=pediatricos_espera_u_covid]").on("keyup", function () { calculatetab4sec2(); });
	});

}