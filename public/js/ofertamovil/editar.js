function editar(URI, LISTA_PAISES, PROFESION_ID, ESPECIALIDAD_ID, PAIS, Evento_Tipo_Entidad_Atencion_Registro_ID, Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID, GENERO, REFERIDO, LISTA_PROFESIONALES) {

	function replaceSpecial(palabra) {

		palabra = palabra.replace('ñ', 'n');
		palabra = palabra.replace('Ñ', 'n');
		palabra = palabra.replace('á', 'a');
		palabra = palabra.replace('á', 'i');
		palabra = palabra.replace('é', 'e');
		palabra = palabra.replace('É', 'e');
		palabra = palabra.replace('í', 'i');
		palabra = palabra.replace('Í', 'i');
		palabra = palabra.replace('ó', 'o');
		palabra = palabra.replace('Ó', 'o');
		palabra = palabra.replace('ú', 'u');
		palabra = palabra.replace('Ú', 'u');

		return palabra.toLowerCase();
	}

	function habilitarReniec() {
		$("select[name=Genero]").attr("readonly", "readonly");
		$("input[name=Paciente]").attr("readonly", "readonly");
		$("input[name=Edad]").attr("readonly", "readonly");
		$("input[name=Nacimiento]").attr("readonly", "readonly");

	}
	function deshabilitarReniec() {
		$("input[name=Tipo_Documento_Numero]").val("");
		$("select[name=Genero]").removeAttr("readonly");
		$("input[name=Paciente]").removeAttr("readonly");
		$("input[name=Edad]").removeAttr("readonly");
		$("input[name=Nacimiento]").removeAttr("readonly");
	}

	function especialidades(id, value) {

		if (id.length > 0) {
			$.ajax({
				type: "POST",
				url: URI + "ofertamovil/main/listaEspecialidades",
				data: { id: id },
				dataType: "json",
				beforeSend: function () {
					$("#modalCargaGeneral").css("display", "block");
				},
				success: function (data) {
					$("#modalCargaGeneral").css("display", "none");

					var html = '<option value="">- Seleccione -</option>';

					$.each(data.especialidades, function (i, e) {
						if (parseInt(value) == parseInt(e.brigadistas_especialidad_id)) {
							html += '<option value="' + e.brigadistas_especialidad_id + '" selected>' + e.especialidad + '</option>';
						} else {
							html += '<option value="' + e.brigadistas_especialidad_id + '">' + e.especialidad + '</option>';
						}

					});

					$("select[name=brigadistas_especialidad_id]").html(html);
				}
			});
		}

	}

	function ofertaMovil(id, value) {
		$.ajax({
			url: URI + "ofertamovil/main/EventoTipoEntidadAtencionOfertaMovilListaEvento",
			data: { id: id },
			method: 'post',
			dataType: 'json',
			error: function (xhr) {
				$("#modalCargaGeneral").css("display", "none");
			},
			beforeSend: function () {
				$("#modalCargaGeneral").css("display", "block");
			},
			success: function (data) {
				$("#modalCargaGeneral").css("display", "none");

				var html = '<option value=""> -- Seleccione -- </option>';

				$.each(data.lista, function (i, e) {
					if (value == e.id) {
						html += '<option value="' + e.id + '" selected>' + e.Evento_Tipo_Entidad_Atencion_Nombre + ' - ' + e.Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre + '</option>';
					} else {
						html += '<option value="' + e.id + '">' + e.Evento_Tipo_Entidad_Atencion_Nombre + ' - ' + e.Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre + '</option>';
					}
				});

				$("select[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID]").html(html);

			}
		});
	}

	function discapacitado(elemento) {

		console.log(elemento.prop("checked"));
		if (elemento.prop("checked")) {
			$("#comboDiscapacitado").css("display", "block");
		} else {
			$("#comboDiscapacitado").css("display", "none");
		}
	}

	function gestante(genero) {

		if (parseInt(genero) === 2) {
			$("#Gestante").attr("style", "display: block");
		} else {
			$("#Gestante").attr("style", "display: none!important");
		}
	}

	function referido(valor) {

		if (parseInt(valor) === 2) {
			$("#Condicion_Alta").css("display", "block");
			$("#Responsable_Traslado").css("display", "block");
		} else {
			$("#Condicion_Alta").css("display", "none");
			$("#Responsable_Traslado").css("display", "none");
		}

	}

	$("#backStep1").on("click", function () {

		var step1 = $("#step-1").css("display");
		var step2 = $("#step-2").css("display");
		if (step1 == "none" && step2 != "none") {

			$("#step-2").css("display", "none");
			$("#step-1").css("display", "block");

			$(".stepwizard-step a:eq(0)").removeClass("step1-disable").addClass("active");
			$(".stepwizard-step a:eq(1)").removeClass("active").addClass("disable");

			$("#btnEventoFinal").text("Siguiente >");
			return false;

		}

	});

	var tableEnfermedades = $('.tableEnfermedades').DataTable({
		"pageLength": 7,
		"bLengthChange": false,
		"info": false,
		"ajax": {
			url: URI + "public/js/eventos/enfermedades.txt",
			method: "POST"
		}
	});

	$(document).ready(function () {

		console.log(PROFESION_ID);
		console.log(ESPECIALIDAD_ID);

		especialidades(PROFESION_ID, ESPECIALIDAD_ID);
		ofertaMovil(Evento_Tipo_Entidad_Atencion_Registro_ID, Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID);

		discapacitado($("input[name=Discapacidad]"));
		gestante(GENERO);

		referido(REFERIDO);

		if (PAIS && PAIS.length > 0) {

			var nombrePais = LISTA_PAISES.find(data => parseInt(data.id) === parseInt(PAIS));

			if (nombrePais) {
				$("input[name=Pais_Procedencia]").val(nombrePais.name);
			}
		}

		var tableMedicamentos = $('.tableMedicamentos').DataTable({
			"length": 10,
			columns: [
				{ "data": "id" },
				{ "data": "descripcion" },
				{ "data": "unidad" }
			]

		});

		$.validator.addMethod("regex",
			function (value, element, regexp) {
				return this.optional(element) || regexp.test(value);
			},
			"Formato Incorrecto XX/XX"
		);

		$("input[name=tipoAtencion]").on("change", function () {

			var id = $("input[name=tipoAtencion]:checked").val();

			if (id && id.length > 0) {
				$("#showPre").css("display", "none");
				$("#showPMA").css("display", "none");
				if (parseInt(id) === 1) {
					$("#showPre").css("display", "block");
					$("#showPMA").css("display", "none");
				} else {
					$("#showPre").css("display", "none");
					$("#showPMA").css("display", "block");
				}
			}

		});

		$("#formRegistrar").validate({
			rules: {
				Evento_Tipo_Entidad_Atencion_Registro_ID: { required: function () { if ($("#Evento_Tipo_Entidad_Atencion_Registro_ID").css("display") != "none") return true; else return false; } },
				Documento_Numero: { required: function () { if ($("input[name=Documento_Numero]").css("display") != "none") return true; else return false; }, digits: true },
				Nombre: { required: function () { if ($("input[name=Nombre]").css("display") != "none") return true; else return false; } },
				profesion: { required: function () { if ($("select[name=profesion]").css("display") != "none") return true; else return false; } },
				Clasificacion: { required: function () { if ($("select[name=Clasificacion]").css("display") != "none") return true; else return false; } },
				tipoAtencion: { required: function () { if ($("select[name=tipoAtencion]").css("display") != "none") return true; else return false; } },
				PreHospitalario_Entidad: { required: function () { if (parseInt($("input[name=tipoAtencion]:checked").val()) === 1) return true; else return false; } },
				Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID: { required: function () { if (parseInt($("input[name=tipoAtencion]:checked").val()) === 2) return true; else return false; } },
				brigadistas_especialidad_id: { required: function () { if ($("select[name=brigadistas_especialidad_id]").css("display") != "none") return true; else return false; } },
				RNE: { required: function () { if ($("input[name=RNE]").css("display") != "none") return true; else return false; } },
				Tipo_Documento_Numero: { required: function () { if ($("select[name=Tipo_Documento_Codigo]").val == "01" && $("input[name=Tipo_Documento_Numero]").css("display") != "none") return true; else return false; }, digits: true },
				Paciente: { required: function () { if ($("input[name=Paciente]").css("display") != "none") return true; else return false; } },
				Genero: { required: function () { if ($("select[name=Genero]").css("display") != "none") return true; else return false; } },
				cie10_1_texto: { required: function () { if ($("input[name=cie10_1_texto]").css("display") != "none") return true; else return false; } },
				PA: { regex: /^([0-9]{1,3})[//]([0-9]{1,3})$/ },
				Fecha_Hora_Atencion: { required: function () { if ($("input[name=Fecha_Hora_Atencion]").css("display") != "none") return true; else return false; } }
			},
			messages: {
				Evento_Tipo_Entidad_Atencion_Registro_ID: { required: "(*) Campo Requerido" },
				Documento_Numero: { required: "(*) Campo Requerido", digits: "solo n\xfameros" },
				Nombre: { required: "(*) Campo Requerido" },
				profesion: { required: "(*) Campo Requerido" },
				Clasificacion: { required: "(*) Campo Requerido" },
				tipoAtencion: { required: "Seleccionar tipo de atenci\xf3n" },
				PreHospitalario_Entidad: { required: "(*) Campo Requerido" },
				Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID: { required: "(*) Campo Requerido" },
				brigadistas_especialidad_id: { required: "(*) Campo Requerido" },
				RNE: { required: "(*) Campo Requerido" },
				Tipo_Documento_Numero: { required: "(*) Campo Requerido", digits: "solo n\xfameros" },
				Paciente: { required: "(*) Campo Requerido" },
				Genero: { required: "(*) Campo Requerido" },
				cie10_1_texto: { required: "(*) Campo Requerido" }
			},
			errorPlacement: function (error, element) {
				if (element.attr("name") == "Documento_Numero") {
					error.insertAfter("#error_Documento_Numero");
				}
				else if (element.attr("name") == "Tipo_Documento_Numero") {
					error.insertAfter("#error_Tipo_Documento_Numero");
				}
				else if (element.attr("name") == "PA") {
					error.insertAfter("#error_PA");
				}
				else {
					error.insertAfter(element);
				}
			},
			submitHandler: function (form, event) {
				console.log("Ingresa");
				event.preventDefault();
				var step1 = $("#step-1").css("display");
				var step2 = $("#step-2").css("display");
				if (step1 != "none" && step2 == "none") {

					$("#step-1").css("display", "none");
					$("#step-2").css("display", "block");
					$(".stepwizard-step a:eq(0)").removeClass("active").addClass("step1-disable");
					$(".stepwizard-step a:eq(1)").removeClass("disable").addClass("active");
					$("#btnEventoFinal").text("Actualizar Atención");
					return false;

				}

				var pa = $("input[name=PA]").val();
				var PAS = "";
				var PAD = "";

				if (pa.length > 0) {
					var t_pa = pa.split("/");
					PAS = t_pa[0];
					PAD = t_pa[1];
				}
				var dataTratamiento = [];
				if ($("#table-tratamiento tbody tr").length > 0) {
					$.each($("#table-tratamiento tbody tr"), function (i, e) {
						var elements = $(this).attr("rel");
						dataTratamiento.push(elements);
					});
				}

				var PreHospitalario = "";
				var PMA_Oferta_Movil = "";
				var PreHospitalario_Entidad = "";
				var Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID = "";
				var tipoAtencion = $("input[name=tipoAtencion]:checked").val();
				if (tipoAtencion == "1") {
					PreHospitalario = "1";
					PreHospitalario_Entidad = $("select[name=PreHospitalario_Entidad]").val();
				} else {
					PMA_Oferta_Movil = "1";
					Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID = $("select[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID]").val();
				}

				$.ajax({
					data: {
						Evento_Tipo_Entidad_Atencion_Registro_Atenciones_ID: $("input[name=Evento_Tipo_Entidad_Atencion_Registro_Atenciones_ID]").val(),
						Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID: $("input[name=Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID]").val(),
						PreHospitalario: PreHospitalario,
						PreHospitalario_Entidad: PreHospitalario_Entidad,
						PMA_Oferta_Movil: PMA_Oferta_Movil,
						Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID: Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID,
						Tipo_Documento_Codigo: $("select[name=Tipo_Documento_Codigo]").val(),
						Tipo_Documento_Numero: $("input[name=Tipo_Documento_Numero]").val(),
						Paciente: $("input[name=Paciente]").val(),
						Nacimiento: $("input[name=Nacimiento]").val(),
						Edad: $("input[name=Edad]").val(),
						Genero: $("select[name=Genero]").val(),
						Gestante: ($("input[name=Gestante]")) ? ($("input[name=Gestante]").prop("checked") ? "1" : "0") : "0",
						Discapacidad: ($("input[name=Discapacidad]").prop("checked") ? "1" : "0"),
						Discapacidad_Tipo: $("input[name=Discapacidad_Tipo]").val(),
						Apoderado: $("input[name=Apoderado]").val(),
						Pais_Procedencia: $("input[name=Pais_Procedencia_Codigo]").val(),
						Lugar_Residencia: $("input[name=Lugar_Residencia]").val(),
						Enfermedad_Dias: $("input[name=Enfermedad_Dias]").val(),
						Enfermedad_Meses: $("input[name=Enfermedad_Meses]").val(),
						Fecha_Hora_Sintomas: $("input[name=Fecha_Hora_Sintomas]").val(),
						Fecha_Hora_Atencion: $("input[name=Fecha_Hora_Atencion]").val(),
						PAS: PAS,
						PAD: PAD,
						FC: $("input[name=FC]").val(),
						FR: $("input[name=FR]").val(),
						SO2: $("input[name=SO2]").val(),
						FIO2: $("input[name=FIO2]").val(),
						Dificultad_Respiratoria: ($("input[name=Dificultad_Respiratoria]").prop("checked") ? "1" : "0"),
						Tos: ($("input[name=Tos]").prop("checked") ? "1" : "0"),
						Rinorrea: ($("input[name=Rinorrea]").prop("checked") ? "1" : "0"),

						alteracion_conciencia: ($("input[name=alteracion_conciencia]").prop("checked") ? "1" : "0"),
						dolor_pecho: ($("input[name=dolor_pecho]").prop("checked") ? "1" : "0"),

						Fiebre: ($("input[name=Fiebre]").prop("checked") ? "1" : "0"),
						Nauseas: ($("input[name=Nauseas]").prop("checked") ? "1" : "0"),
						Vomitos: ($("input[name=Vomitos]").prop("checked") ? "1" : "0"),
						Dolor_Abdominal: ($("input[name=Dolor_Abdominal]").prop("checked") ? "1" : "0"),
						Diarrea: ($("input[name=Diarrea]").prop("checked") ? "1" : "0"),
						Otros: $("input[name=Otros]").val(),
						Vac_Influenza: ($("input[name=Vac_Influenza]").prop("checked") ? "1" : "0"),
						Vac_Fiebre: ($("input[name=Vac_Fiebre]").prop("checked") ? "1" : "0"),
						Vac_Sarampion: ($("input[name=Vac_Sarampion]").prop("checked") ? "1" : "0"),
						Vac_Hepatitis: ($("input[name=Vac_Hepatitis]").prop("checked") ? "1" : "0"),
						Vac_Tetanos: ($("input[name=Vac_Tetanos]").prop("checked") ? "1" : "0"),
						Vac_Otros: ($("input[name=Vac_Otros]").prop("checked") ? "1" : "0"),
						Vac_Otros_Detalle: $("input[name=Vac_Otros_Detalle]").val(),
						Lab_Fecha_Toma: $("input[name=Lab_Fecha_Toma]").val(),
						Lab_Fecha_Envio: $("input[name=Lab_Fecha_Envio]").val(),
						Lab_Fecha_Recepcion: $("input[name=Lab_Fecha_Recepcion]").val(),
						Lab_Resultados: $("input[name=Lab_Resultados]").val(),
						Destino: $("select[name=Destino]").val(),
						Lugar_Referencia: ($("input[name=Lugar_Referencia]")) ? $("input[name=Lugar_Referencia]").val() : "",
						Responsable_Traslado: ($("input[name=Responsable_Traslado]")) ? $("input[name=Responsable_Traslado]").val() : "",
						Condicion_Alta: $("select[name=Condicion_Alta]").val(),
						cie10_1_codigo: $("input[name=cie10_1_codigo]").val(),
						cie10_1_texto: $("input[name=cie10_1_texto]").val(),
						cie10_2_codigo: $("input[name=cie10_2_codigo]").val(),
						cie10_2_texto: $("input[name=cie10_2_texto]").val(),
						cie10_3_codigo: $("input[name=cie10_3_codigo]").val(),
						cie10_3_texto: $("input[name=cie10_3_texto]").val(),
						Documento_Numero: $("input[name=Documento_Numero]").val(),
						Nombre: $("input[name=Nombre]").val(),
						Colegiatura: $("input[name=Colegiatura]").val(),
						RNE: $("input[name=RNE]").val(),
						Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID: $("input[name=Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID]").val(),
						brigadistas_especialidad_id: $("select[name=brigadistas_especialidad_id]").val(),
						dataTratamiento: dataTratamiento,
						Clasificacion: $("select[name=Clasificacion]").val(),
						Tipo_Discapacidad: ($("select[name=Tipo_Discapacidad]")) ? $("select[name=Tipo_Discapacidad]").val() : "",
						Observaciones: $("textarea[name=Observaciones]").val(),

						dx1_covid_01: ($("input[name=dx1_covid_01]").prop("checked") ? "1" : "0"),
						dx1_covid_02: ($("input[name=dx1_covid_02]").prop("checked") ? "1" : "0"),
						dx1_covid_03: ($("input[name=dx1_covid_03]").prop("checked") ? "1" : "0"),

						dx2_insuficiencia: ($("input[name=dx2_insuficiencia]").prop("checked") ? "1" : "0"),
						dx2_neumonia: ($("input[name=dx2_neumonia]").prop("checked") ? "1" : "0"),
						dx2_faringitis: ($("input[name=dx2_faringitis]").prop("checked") ? "1" : "0"),
						dx2_shock: ($("input[name=dx2_shock]").prop("checked") ? "1" : "0"),

						dx3_hta: ($("input[name=dx3_hta]").prop("checked") ? "1" : "0"),
						dx3_dm: ($("input[name=dx3_dm]").prop("checked") ? "1" : "0"),
						dx3_obesidad: ($("input[name=dx3_obesidad]").prop("checked") ? "1" : "0"),
						dx3_insuficiencia_renal: ($("input[name=dx3_insuficiencia_renal]").prop("checked") ? "1" : "0"),
						dx3_otros: ($("input[name=dx3_otros]").prop("checked") ? "1" : "0"),

						aislamiento: ($("input[name=aislamiento]").prop("checked") ? "1" : "0"),

						hospitalizacion: ($("input[name=hospitalizacion]").prop("checked") ? "1" : "0"),
						area_interna_01: ($("input[name=area_interna_01]").prop("checked") ? "1" : "0"),
						area_externa_01: ($("input[name=area_externa_01]").prop("checked") ? "1" : "0"),

						shock_trauma: ($("input[name=shock_trauma]").prop("checked") ? "1" : "0"),

						uci: ($("input[name=uci]").prop("checked") ? "1" : "0"),
						area_interna_02: ($("input[name=area_interna_02]").prop("checked") ? "1" : "0"),
						area_externa_02: ($("input[name=area_externa_02]").prop("checked") ? "1" : "0"),

						observacion: ($("input[name=observacion]").prop("checked") ? "1" : "0"),
						area_interna_03: ($("input[name=area_interna_03]").prop("checked") ? "1" : "0"),
						area_externa_03: ($("input[name=area_externa_03]").prop("checked") ? "1" : "0")

					},
					url: URI + "ofertamovil/main/actualizarEventoAtencion",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
						$("#btnEventoFinal").addClass("disabled");
						$("#message").html("");

					},
					success: function (data) {
						$("#cargando").html("<i></i>");
						$('html, body').animate({ scrollTop: 0 }, 'fast');

						var $message = "";

						if (parseInt(data.status) == 200) $message = '<div class="alert alert-success"><h4 style="margin:0">Atención actualizada exitosamente</h4></div>';
						else if (parseInt(data.status) == 201) {
							$message = '<div class="alert alert-warning"><h4 style="margin:0">No se pudo actualizar, la atención ya existe</h4></div>';
							$("#btnEventoFinal").removeClass("disabled");
						}
						else {
							$message = '<div class="alert alert-error"><h4 style="margin:0">No se pudo actualizar la antención</h4></div>';
							$("#btnEventoFinal").removeClass("disabled");
						}

						$("#message").html($message);

						if (parseInt(data.status) == 200) setTimeout(function () { $("#message").slideUp(); location.href = URI + "ofertamovil"; }, 3000);
					}
				});

			}
		});

		habilitarReniec();

		$(".search-cie").on("click", function () {
			var attr = $(this).attr("rel");
			$("input[name=cie10-number]").val(attr);
			$("#tableEnfermedadesModal").modal("show");

		});

		$(".clear-cie").on("click", function () {
			var attr = $(this).attr("rel");

			switch (parseInt(attr)) {
				case 1: { $("input[name=cie10_1_codigo]").val(""); $("input[name=cie10_1_texto]").val(""); } break;
				case 2: { $("input[name=cie10_2_codigo]").val(""); $("input[name=cie10_2_texto]").val(""); } break;
				case 3: { $("input[name=cie10_3_codigo]").val(""); $("input[name=cie10_3_texto]").val(""); } break;
			}

		});

		$(".fechanacimiento").datetimepicker({ format: 'DD/MM/YYYY' });
		$(".datetimepicker").datetimepicker({ format: 'DD/MM/YYYY HH:mm' });

		$(".timepicker").datetimepicker({
			format: 'LT'
		});

		$("#btnCancelar").on("click", function () {

			location.href = URI + "ofertamovil";

		});

		$('.tableEnfermedades tbody').on('click', 'tr', function () {
			var data = tableEnfermedades.row(this).data();

			var cie = $("input[name=cie10-number]").val();

			switch (parseInt(cie)) {
				case 1: { $("input[name=cie10_1_codigo]").val(data[0]); $("input[name=cie10_1_texto]").val(data[1]); } break;
				case 2: { $("input[name=cie10_2_codigo]").val(data[0]); $("input[name=cie10_2_texto]").val(data[1]); } break;
				case 3: { $("input[name=cie10_3_codigo]").val(data[0]); $("input[name=cie10_3_texto]").val(data[1]); } break;
			}

			$('#tableEnfermedadesModal').modal('hide');
		});
		$("select[name=Evento_Tipo_Entidad_Atencion_Registro_ID]").on("click", function () {
			id = $(this).val();
			ofertaMovil(id, "");

		});
		$("#btn-profesional").on("click", function () {
			var documento_numero = $("input[name=Documento_Numero]").val();

			if (documento_numero.length >= 8) {
				var type = "01";

				$.ajax({
					url: URI + "ofertamovil/main/buscarProfesional",
					data: { type: type, document: documento_numero },
					method: 'post',
					dataType: 'json',
					error: function (xhr) {
						$("#btn-profesional").removeAttr("disabled");
						$("#btn-profesional").html('<i class="fa fa-search" aria-hidden="true"></i>');
					},
					beforeSend: function () {

						$("#btn-profesional").html('<i class="fa fa-spinner fa-pulse"></i>');
						$("#btn-profesional").attr("disabled", "disabled");
					},
					success: function (data) {
						$("#btn-profesional").removeAttr("disabled");
						$("#btn-profesional").html('<i class="fa fa-search" aria-hidden="true"></i>');

						$("input[name=Nombre]").val(data.Nombre);
						$("input[name=Colegiatura]").val(data.Colegiatura);
						$("input[name=RNE]").val(data.RNE);
						$("select[name=profesion]").val(data.profesion);
						$("input[name=Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID]").val(data.id);

						var profesion = data.profesion;
						if (profesion.length > 0) {
							especialidades(profesion, data.brigadistas_especialidad_id);
						}

					}
				});

			}

		});
		$("select[name=profesion]").on("change", function () {

			var id = $(this).val();
			especialidades(id, "");

		});

		$("#btn-buscar").on("click", function () {
			var documento_numero = $("input[name=Tipo_Documento_Numero]").val();

			if (documento_numero.length >= 8) {
				var type = "01";
				if (documento_numero.length > 8) {
					type = "03";
				}
				$.ajax({
					url: URI + "ofertamovil/main/curl",
					data: { type: type, document: documento_numero },
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

						var fecha = (data.data.attributes.fecha_nacimiento).split("-");

						$("input[name=Nacimiento]").val(fecha[2] + "/" + fecha[1] + "/" + fecha[0]);

						$("input[name=Edad]").val(data.data.attributes.edad_anios);
						$("select[name=Genero]").val(data.data.attributes.sexo);
						$("select[name=Genero]").attr("rel", data.data.attributes.sexo);

						gestante(data.data.attributes.sexo);

						$("input[name=Paciente]").val(data.data.attributes.nombres + ", " + data.data.attributes.apellido_paterno + " " + data.data.attributes.apellido_materno);
					}
				});

			}

		});

		$("select[name=Tipo_Documento_Codigo]").on("change", function () {

			var select = $(this).val();
			if (select == "06") deshabilitarReniec();
			else habilitarReniec();

		});

		$("select[name=Genero]").change(function (e) {
			var select = $("select[name=Tipo_Documento_Codigo]").val();
			var defaultValue = $(this).attr("rel");
			if (select == "01" || select == "03") {
				$("select[name=Genero]").val(function () {
					return defaultValue;
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

		$("input[name=Pais_Procedencia]").on("keyup", function () {

			var match = $(this).val();

			$("#paises").html("");
			if (match.length < 3) {
				$("#paises").html("");
				$("#paises").css("display", "none");
			} else {
				var lista = LISTA_PAISES;

				var filtrado = lista.filter(data => replaceSpecial(data.name).match(replaceSpecial(match)));

				if (filtrado.length > 0) {
					var html = '<ul>';
					$("#paises").css("display", "block");
					$.each(filtrado, function (i, e) {
						html += '<li class="select-country" rel="' + e.id + '">' + e.name + '</li>';
					});
					html += '</ul>';
					$("#paises").html(html);
				} else {
					$("#paises").css("display", "none");
				}

			}
		});

		$("body").on("click", ".select-country", function () {

			var attr = $(this).attr("rel");
			var value = $(this).html();

			$("input[name=Pais_Procedencia_Codigo]").val(attr);
			$("input[name=Pais_Procedencia]").val(value);
			$("#paises").html("");
			$("#paises").css("display", "none");

		});

		$("input[name=Nombre]").on("keyup", function () {

			var match = $(this).val();
			//console.log('key', match);
			$("#profesionales").html("");
			if (match.length < 3) {
				$("#profesionales").html("");
				$("#profesionales").css("display", "none");
			} else {
				var lista = LISTA_PROFESIONALES;

				var filtrado = lista.filter(data => replaceSpecial(data.name).match(replaceSpecial(match)));

				if (filtrado.length > 0) {
					var html = '<ul>';
					$("#profesionales").css("display", "block");
					$.each(filtrado, function (i, e) {
						html += '<li class="select-professional" rel="' + e.id + '">' + e.name + '</li>';
					});
					html += '</ul>';
					$("#profesionales").html(html);
				} else {
					$("#profesionales").css("display", "none");
				}

			}
		});

		$("body").on("click", ".select-professional", function () {

			var attr = $(this).attr("rel");
			var value = $(this).html();
			console.log("attr: " + attr);
			console.log("value: " + value);

			$("input[name=Nombre_Codigo]").val(attr);
			$("input[name=Nombre]").val(value);
			$("#profesionales").html("");
			$("#profesionales").css("display", "none");

			//if(documento_numero.length>=8){
			var type = "01";

			$.ajax({
				url: URI + "ofertamovil/main/buscarProfesional2",
				data: { type: type, document: attr },
				method: 'post',
				dataType: 'json',
				error: function (xhr) {
					$("#btn-profesional").removeAttr("disabled");
					$("#btn-profesional").html('<i class="fa fa-search" aria-hidden="true"></i>');
				},
				beforeSend: function () {

					$("#btn-profesional").html('<i class="fa fa-spinner fa-pulse"></i>');
					$("#btn-profesional").attr("disabled", "disabled");
				},
				success: function (data) {
					$("#btn-profesional").removeAttr("disabled");
					$("#btn-profesional").html('<i class="fa fa-search" aria-hidden="true"></i>');

					//$("input[name=Nombre]").val(data.Nombre);
					$("input[name=Documento_Numero]").val(data.Documento_Numero1);
					$("input[name=Colegiatura]").val(data.Colegiatura);
					$("input[name=RNE]").val(data.RNE);
					$("select[name=profesion]").val(data.profesion);
					$("input[name=Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID]").val(data.id);

					var profesion = data.profesion;
					if (profesion.length > 0) {
						especialidades(profesion, data.brigadistas_especialidad_id);
					}

				}
			});

			//}
		});

		$('.tableMedicamentos tbody').on('click', 'tr', function () {
			var data = tableMedicamentos.row(this).data();

			$("#formRegistrarMedicamento").find("input[name=id]").val(data.id);
			$("#formRegistrarMedicamento").find("input[name=nombre_medicamento]").val(data.descripcion);
			$("#formRegistrarMedicamento").find("input[name=unidad_medida]").val(data.unidad);

			$('#tableMedicamentosModal').modal('hide');
		});

		$("#formRegistrarMedicamento").validate({
			rules: {
				nombre_medicamento: { required: true },
				unidad_medida: { required: true },
				Total: { required: true },
				Cantidad: { required: true },
				Frecuencia: { required: true },
				Via: { required: true }
			},
			messages: {
				nombre_medicamento: { required: "(*) Campo Requerido" },
				unidad_medida: { required: "(*) Campo Requerido" },
				Total: { required: "(*) Campo Requerido" },
				Cantidad: { required: "(*) Campo Requerido" },
				Frecuencia: { required: "(*) Campo Requerido" },
				Via: { required: "(*) Campo Requerido" }
			},
			submitHandler: function (form, event) {

				event.preventDefault();

				var id = $("#formRegistrarMedicamento").find("input[name=id]").val();
				var nombre_medicamento = $("#formRegistrarMedicamento").find("[name=nombre_medicamento]").val();
				var unidad_medida = $("#formRegistrarMedicamento").find("[name=unidad_medida]").val();
				var Total = $("#formRegistrarMedicamento").find("[name=Total]").val();
				var Cantidad = $("#formRegistrarMedicamento").find("[name=Cantidad]").val();
				var Frecuencia = $("#formRegistrarMedicamento").find("[name=Frecuencia]").val();
				var Via = $("#formRegistrarMedicamento").find("[name=Via]").val();
				var Observaciones = $("#formRegistrarMedicamento").find("[name=Observaciones]").val();

				var data = id + '||' + nombre_medicamento + '||' + unidad_medida + '||' + Total + '||' + Cantidad + '||' + Frecuencia + '||' + Via + '||' + Observaciones;
				var html = '<tr id="medicamento' + id + '" rel="' + data + '">';
				html += '<td>' + nombre_medicamento + '</td>';
				html += '<td>' + unidad_medida + '</td>';
				html += '<td>' + Total + '</td>';
				html += '<td>' + Cantidad + '</td>';
				html += '<td>' + $("#formRegistrarMedicamento").find("[name=Frecuencia] option:selected").text() + '</td>';
				html += '<td>' + $("#formRegistrarMedicamento").find("[name=Via] option:selected").text() + '</td>';
				html += '<td>' + Observaciones + '</td><td class="d-flex flex-middle"><i class="fa fa-times deleteMedicamento"></i></td></tr>';

				if (($("#table-tratamiento").css("display") == "none")) {
					$("#table-tratamiento").slideDown();
				}

				$("#table-tratamiento tbody").append(html);
				$("#formRegistrarMedicamento")[0].reset();
				$("#tratamientoModal").modal("hide");

			}
		});

		$("body").on("click", ".deleteMedicamento", function () {

			var id = $(this).closest("tr").attr("id");
			var remover = "#" + id;
			$(remover).remove();

			if (($("#table-tratamiento").css("display") == "table") && $("#table-tratamiento tbody").html().trim() == 0) {
				$("#table-tratamiento").slideUp();
			}

		});

		$("input[name=Discapacidad]").on("change", function () {
			discapacitado($(this));
		});

		$("select[name=Destino]").on("change", function () {

			referido($(this).val());
		});

		$("select[name=Genero]").on("change", function () {
			var id = $(this).val();
			if (id.length > 0) {
				gestante($(this).val());
			} else {
				gestante(0);
			}

		});

		$("select[name=Genero]").on("change", function () {
			var id = $(this).val();
			if (id.length > 0) {
				gestante($(this).val());
			} else {
				gestante(0);
			}

		});

	});//ready

}