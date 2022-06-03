function fichaConsolidado(URI, Evento_Registro_Numero, LISTA_PAISES) {

	var tableEnfermedades = $('.tableEnfermedades').DataTable({
		"pageLength": 7,
		"bLengthChange": false,
		"info": false,
		"ajax": {
			url: URI + "public/js/eventos/enfermedades.txt",
			method: "POST"
		}
	});

	function habilitarReniec() {
		$("input[name=Evento_Ficha_Atencion_Detalle_DNI]").removeAttr("readonly");
		$("input[name=Evento_Ficha_Atencion_Detalle_Paciente]").attr("readonly", "readonly");
		$("input[name=Evento_Ficha_Atencion_Detalle_Edad]").attr("readonly", "readonly");
		$("select[name=Evento_Ficha_Atencion_Detalle_Genero]").attr("readonly", "readonly");

	}
	function deshabilitarReniec() {
		$("input[name=Evento_Ficha_Atencion_Detalle_DNI]").val("");
		$("input[name=Evento_Ficha_Atencion_Detalle_DNI]").attr("readonly", "readonly");
		$("input[name=Evento_Ficha_Atencion_Detalle_Paciente]").removeAttr("readonly");
		$("input[name=Evento_Ficha_Atencion_Detalle_Edad]").removeAttr("readonly");
		$("select[name=Evento_Ficha_Atencion_Detalle_Genero]").removeAttr("readonly");
		$("input[name=Evento_Ficha_Atencion_Detalle_Paciente]").val("");
		$("input[name=Evento_Ficha_Atencion_Detalle_Edad]").val("");
		$("select[name=Evento_Ficha_Atencion_Detalle_Genero]").val("");
	}

	$(".div-gestante").css("display", "none");

	$(".datetimepicker").datetimepicker({
		maxDate: moment()
	});

	$(".dateHour").datetimepicker({
		format: 'LT'
	});

	setTimeout(function () {
		$(".alert").slideUp();
	}, 3500);

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

	function ofertaMovil(Evento_Tipo_Entidad_Atencion_ID, Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID) {

		var html = "";

		$.ajax({
			type: "POST",
			url: URI + "eventos/fichas/listaOfertasMovilByEntidad",
			dataType: "json",
			data: { Evento_Tipo_Entidad_Atencion_ID: Evento_Tipo_Entidad_Atencion_ID, Evento_Registro_Numero: Evento_Registro_Numero },
			beforeSend: function () {
				$("select[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID]").html("<option>Cargando...</option>");
			},
			success: function (data) {

				count = 0;
				$.each(data.lista, function (i, e) {
					count++;
					if (parseInt(Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID) == parseInt(e.id))
						html += '<option value="' + e.id + '" selected>' + e.Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre + '</option>';
					else
						html += '<option value="' + e.id + '">' + e.Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre + '</option>';
				});

				if (count > 0) {
					$("select[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID]").html("<option value>-- Seleccione --</option>" + html);
				}
				else $("select[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID]").html("<option value>-- NO HAY REGISTROS --</option>");
			}
		});

	}

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

	$(document).ready(function () {

		habilitarReniec();

		$('.tableEnfermedades tbody').on('click', 'tr', function () {
			var data = tableEnfermedades.row(this).data();
			$("input[name=Evento_Ficha_Atencion_Detalle_CIE10_Codigo]").val(data[0]);
			$("input[name=Evento_Ficha_Atencion_Detalle_CIE10_Texto]").val(data[1]);
			$('#tableEnfermedadesModal').modal('hide');
		});

		var table = $("#tbFichaConsolidado").DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "fecha" },
				{ "data": "id" },
				{ "data": "Detalle_Paciente" },
				{ "data": "DNI" },
				{ "data": "Edad" },
				{ "data": "Genero" },
				{ "data": "Gestante", title: "Gestante" },
				{ "data": "Personal_Salud", title: "El personal es" },
				{ "data": "Clasificacion" },
				{ "data": "Detalle_Diagnostico", title: "Diagnostico" },
				{ "data": "Detalle_Inicio_Sintomas", title: "Inicio Sintomas" },
				{ "data": "Detalle_CIE10_Codigo", title: "CIE10" },
				{ "data": "Descripcion_CIE10", title: "CIE10_Descripcion" },
				{ "data": "Hora_Atencion", title: "Hora Atencion" },
				{ "data": "Entidad", title: "Entidad" },
				{ "data": "Oferta_Movil_Nombre", title: "Oferta Movil" },
				{ "data": "Vacuna", title: "Detalle_Vacuna" },
				{ "data": "Quimioprofilaxis", title: "Detalle_Quimioprofilaxis" },
				{ "data": "Medicamentos", title: "Detalle_Medicamentos" },
				{ "data": "Detalle_Destino", title: "Destino" },
				{ "data": "Detalle_Lugar_Traslado", title: "Lugar Traslado" },
				{ "data": "Responsable", title: "Responsable" },
				{ "data": "pais", title: 'Pais' },
				{ "data": "editar" },

				{ "data": "Detalle_Gestante" },
				{ "data": "Detalle_Personal_Salud" },
				{ "data": "Detalle_Vacuna", title: "Detalle_Vacuna" },
				{ "data": "Detalle_Quimioprofilaxis", title: "Detalle_Quimioprofilaxis" },
				{ "data": "Detalle_Medicamentos", title: "Detalle_Medicamentos" },
				{ "data": "Ficha_ID", title: "Ficha_ID" },
				{ "data": "Evento_Registro_Numero", title: "Evento_Registro_Numero" },
				{ "data": "Detalle_Genero", title: "Detalle_Genero" },
				{ "data": "Detalle_Procedencia", title: "Detalle_Procedencia" },
				{ "data": "Oferta_Movil_ID", title: "Oferta_Movil_ID" },
				{ "data": "Detalle_Clasificacion", title: "Detalle_Clasificacion" },
				{ "data": "Oferta_Movil_ID", title: "Oferta_Movil_ID" },
				{ "data": "Evento_Tipo_Entidad_Atencion_ID", title: "Evento_Tipo_Entidad_Atencion_ID" },
				{ "data": "Destino", title: "Destino" },
				{ "data": "Hora_Cierre", title: "Hora_Cierre" },
				{ "data": "usuario", title: "usuario" },
				{ "data": "Tipo_Documento_Codigo" },
				{ "data": "Evento_Ficha_Atencion_Pais_Procedencia" },
				{ "data": "Evento_Ficha_Atencion_Lugar_Residencia", title: "Lugar Residencia" },
				{ "data": "delete" },
			],
			"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
			columnDefs: [
				{
					"targets": [5, 6, 7, 9, 10, 11, 13, 14, 16, 17, 18, 19, 20, 21, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42],
					"visible": false,
					"searchable": false
				}
			],
			buttons: [
				{ extend: 'copy', text: 'copy', title: 'Consolidado', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 42] } },
				{ extend: 'csv', title: 'Consolidado', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 42] } },
				{ extend: 'excel', title: 'Consolidado', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 42] } },
				{ extend: 'pdf', title: 'Consolidado', orientation: 'landscape', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 22, 42] } },

				{
					extend: 'print',
					text: 'Imprimir',
					title: 'Imprimir',
					exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] },
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

		$(".regresar").on("click", function () {

			post(URI + "eventos/fichas/lista", { Evento_Registro_Numero: Evento_Registro_Numero });

		});

		$('body').on('click', '.tbLista tr td .edit-detalle', function () {

			$("#Tipo_Accion").val("");

			var tr = $(this).closest("tr");
			var row = table.row(tr);

			index = row.index();

			data = row.data();
			var estado = data.Evento_Ficha_Atencion_Estado;

			var id = $(this).find("label").attr("rel");

			$("#atencionModal").modal("show");
			$("#formEditarAtencion")[0].reset();
			$("input[name=Evento_Ficha_Atencion_Pais_Procedencia]").val("");

			if (parseInt(data.Detalle_Genero) == 2) {
				$(".div-gestante").slideDown();
				setTimeout(function () {
					if (parseInt(data.Detalle_Gestante) == 1) $("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_Gestante']").prop("checked", true);
				}, 100);
			}

			if (parseInt(data.Detalle_Vacuna) == 1) $("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_Vacuna']").prop("checked", true);
			if (parseInt(data.Detalle_Quimioprofilaxis) == 1) $("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_Quimioprofilaxis']").prop("checked", true);
			if (parseInt(data.Detalle_Medicamentos) == 1) $("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_Medicamentos']").prop("checked", true);
			$("#atencionModal").find("select[name='Evento_Ficha_Atencion_Detalle_Personal_Salud']").val(data.Detalle_Personal_Salud);

			$("select[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID]").html('<option value>-- Cargando --</option>');

			$("input[name=Evento_Ficha_Atencion_Detalle_Lugar_Traslado]").attr("disabled", "disabled");
			$("input[name=Evento_Ficha_Atencion_Detalle_Responsable]").attr("disabled", "disabled");

			$("#atencionModal").find("input[name='id']").val(data.id);
			$("#atencionModal").find("input[name='Evento_Ficha_Atencion_ID']").val(data.Ficha_ID);
			$("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_Paciente']").val(data.Detalle_Paciente);
			$("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_DNI']").val(data.DNI);
			$("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_Edad']").val(data.Edad);
			$("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_Hora_Atencion']").val(data.Hora_Atencion);
			$("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_Responsable']").val(data.Responsable);
			$("#atencionModal").find("input[name='Evento_Registro_Numero']").val(data.Evento_Registro_Numero);
			$("#atencionModal").find("select[name='Evento_Ficha_Atencion_Detalle_Genero']").val(data.Detalle_Genero);
			$("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_Procedencia']").val(data.Detalle_Procedencia);
			$("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_Inicio_Sintomas']").val(data.Detalle_Inicio_Sintomas);
			$("#atencionModal").find("textarea[name='Evento_Ficha_Atencion_Detalle_Diagnostico']").val(data.Detalle_Diagnostico);
			$("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_CIE10_Codigo']").val(data.Detalle_CIE10_Codigo);

			$("#atencionModal").find("select[name='Evento_Tipo_Entidad_Atencion']").val(data.Evento_Tipo_Entidad_Atencion_ID);

			ofertaMovil(data.Evento_Tipo_Entidad_Atencion_ID, data.Oferta_Movil_ID);

			$("#atencionModal").find("select[name='Evento_Ficha_Atencion_Detalle_Destino']").val(data.Destino);
			$("#atencionModal").find("input[name='Evento_Ficha_Atencion_Detalle_Lugar_Traslado']").val(data.Detalle_Lugar_Traslado);
			$("#atencionModal").find("select[name='Evento_Ficha_Atencion_Detalle_Clasificacion']").val(data.Detalle_Clasificacion);

			$("input[name=Evento_Ficha_Atencion_Detalle_CIE10_Codigo]").val(data.Detalle_CIE10_Codigo);
			$("input[name=Evento_Ficha_Atencion_Detalle_CIE10_Texto]").val(data.Descripcion_CIE10);

			if (parseInt(data.Destino) == 2) {
				$("input[name=Evento_Ficha_Atencion_Detalle_Lugar_Traslado]").removeAttr("disabled");
				$("input[name=Evento_Ficha_Atencion_Detalle_Responsable]").removeAttr("disabled");
			}
			$("#atencionModal").find("select[name='Tipo_Documento_Codigo']").val(data.Tipo_Documento_Codigo);
			if (data.Evento_Ficha_Atencion_Pais_Procedencia.length > 0) {
				if (parseInt(data.Evento_Ficha_Atencion_Pais_Procedencia) > 0) {
					$("input[name=Evento_Ficha_Atencion_Pais_Procedencia]").val(data.Evento_Ficha_Atencion_Pais_Procedencia);
					var id = parseInt(data.Evento_Ficha_Atencion_Pais_Procedencia);
					var pais = LISTA_PAISES.find(data => data.id == id);
					$("input[name=pais]").val(pais.name);
				}

			}

			$("input[name=Evento_Ficha_Atencion_Lugar_Residencia]").val(data.Evento_Ficha_Atencion_Lugar_Residencia);

		});

		$("#formEditarAtencion").validate({
			rules: {
				Evento_Ficha_Atencion_Detalle_Paciente: { required: true },
				Evento_Ficha_Atencion_Detalle_DNI: {
					required: function () {
						if ($("select[name=Tipo_Documento_Codigo]").val() == '01' || $("select[name=Tipo_Documento_Codigo]").val() == '03') return true; else return false;
					}, digits: true, minlength: 8
				},
				Evento_Ficha_Atencion_Detalle_Edad: { required: false, digits: true, min: 0, max: 120 },
				Evento_Ficha_Atencion_Detalle_Genero: { required: true },
				Evento_Ficha_Atencion_Detalle_Procedencia: { required: true },
				Evento_Ficha_Atencion_Detalle_Clasificacion: { required: true },
				Evento_Ficha_Atencion_Detalle_Inicio_Sintomas: { required: true },
				Evento_Ficha_Atencion_Detalle_Diagnostico: { required: true },
				Evento_Ficha_Atencion_Detalle_CIE10_Codigo: { required: true },
				Evento_Ficha_Atencion_Detalle_Hora_Atencion: { required: true },
				Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID: { required: true },
				Evento_Ficha_Atencion_Detalle_Destino: { required: true },
				Evento_Ficha_Atencion_Detalle_Lugar_Traslado: { required: function () { if (parseInt($("select[name=Evento_Ficha_Atencion_Detalle_Destino]").val()) == 1) return true; else return false; } },
				Evento_Ficha_Atencion_Detalle_Responsable: { required: function () { if (parseInt($("select[name=Evento_Ficha_Atencion_Detalle_Destino]").val()) == 1) return true; else return false; } },
				Tipo_Documento_Codigo: { required: true }
			},
			messages: {
				Evento_Ficha_Atencion_Detalle_Paciente: { required: "(*) Campo Requerido" },
				Evento_Ficha_Atencion_Detalle_DNI: { required: "(*) Campo Requerido", digits: "Solo n\xfameros", minlength: 'Deben ser al menos 8 n\xfameros' },
				Evento_Ficha_Atencion_Detalle_Edad: { required: "(*) Campo Requerido", digits: "Solo n\xfameros", min: "Edad m\xednima 0", max: "Edad muy elevada" },
				Evento_Ficha_Atencion_Detalle_Genero: { required: "(*) Campo Requerido" },
				Evento_Ficha_Atencion_Detalle_Procedencia: { required: "(*) Campo Requerido" },
				Evento_Ficha_Atencion_Detalle_Clasificacion: { required: "(*) Campo Requerido" },
				Evento_Ficha_Atencion_Detalle_Inicio_Sintomas: { required: "(*) Campo Requerido" },
				Evento_Ficha_Atencion_Detalle_Diagnostico: { required: "(*) Campo Requerido" },
				Evento_Ficha_Atencion_Detalle_CIE10_Codigo: { required: "(*) Campo Requerido" },
				Evento_Ficha_Atencion_Detalle_Hora_Atencion: { required: "(*) Campo Requerido" },
				Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID: { required: "(*) Campo Requerido" },
				Evento_Ficha_Atencion_Detalle_Destino: { required: "(*) Campo Requerido" },
				Evento_Ficha_Atencion_Detalle_Lugar_Traslado: { required: "(*) Campo Requerido" },
				Evento_Ficha_Atencion_Detalle_Responsable: { required: "(*) Campo Requerido" },
				Tipo_Documento_Codigo: { required: "(*) Campo Requerido" }
			}
		});

		$("select[name=Evento_Ficha_Atencion_Detalle_Genero]").change(function () {
			var genero = $(this).val();

			if (genero == "2")
				$(this).closest("#formEditarAtencion").find(".div-gestante").slideDown();
			else
				$(this).closest("#formEditarAtencion").find(".div-gestante").slideUp();

		});

		$("select[name=Evento_Ficha_Atencion_Detalle_Destino]").change(function () {
			var id = $(this).val();

			if (id == "1") {
				$(this).closest("#formEditarAtencion").find("input[name=Evento_Ficha_Atencion_Detalle_Lugar_Traslado]").attr("disabled", "disabled");
				$(this).closest("#formEditarAtencion").find("input[name=Evento_Ficha_Atencion_Detalle_Responsable]").attr("disabled", "disabled");
			} else {
				$(this).closest("#formEditarAtencion").find("input[name=Evento_Ficha_Atencion_Detalle_Lugar_Traslado]").removeAttr("disabled");
				$(this).closest("#formEditarAtencion").find("input[name=Evento_Ficha_Atencion_Detalle_Responsable]").removeAttr("disabled");
			}

		});

		$("select[name=Evento_Tipo_Entidad_Atencion]").on("change", function () {

			var Evento_Tipo_Entidad_Atencion_ID = $(this).val();
			ofertaMovil(Evento_Tipo_Entidad_Atencion_ID, 0);

		});

		$("body").on("click", ".actionDelete", function () {
			$("#deleteModal input[name=id]").val("");
			$('#deleteModal').modal('show');

			var tr = $(this).parents('tr');
			var row = table.row(tr);
			data = row.data();

			$("#deleteModal input[name=id]").val(data.id);
			$("#deleteModal input[name=Evento_Ficha_Atencion_ID]").val(data.Ficha_ID);
			$("#deleteModal input[name=Evento_Registro_Numero]").val(data.Evento_Registro_Numero);
			$("#deleteModal #numero").text(data.Detalle_Paciente);

		});

		$("#btn-buscar").on("click", function () {
			var Evento_Ficha_Atencion_Detalle_DNI = $("input[name=Evento_Ficha_Atencion_Detalle_DNI]").val();

			if (Evento_Ficha_Atencion_Detalle_DNI.length >= 8) {
				var type = "01";
				if (Evento_Ficha_Atencion_Detalle_DNI.length > 8) {
					type = "03";
				}

				$.ajax({
					url: URI + "eventos/eventos/curl",
					data: { type: type, document: Evento_Ficha_Atencion_Detalle_DNI },
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

						if (data.data === undefined) {
							$("input[name=Evento_Ficha_Atencion_Detalle_Edad]").val("");
							$("select[name=Evento_Ficha_Atencion_Detalle_Genero]").val("");
							$("input[name=Evento_Ficha_Atencion_Detalle_Paciente]").val("");
							$(".div-gestante").slideUp();
						}
						else {
							if (data.data.attributes.sexo == "2") {
								$(".div-gestante").slideDown();
							}
							else {
								$(".div-gestante").slideUp();
							}
							$("input[name=Evento_Ficha_Atencion_Detalle_Edad]").val(data.data.attributes.edad_anios);
							$("select[name=Evento_Ficha_Atencion_Detalle_Genero]").val(data.data.attributes.sexo);
							$("input[name=Evento_Ficha_Atencion_Detalle_Paciente]").val(data.data.attributes.apellido_paterno + " " + data.data.attributes.apellido_materno + ", " + data.data.attributes.nombres);
						}
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

		$("input[name=pais]").on("keyup", function () {

			var match = $(this).val();
			console.log('key', match);
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

			$("input[name=Evento_Ficha_Atencion_Pais_Procedencia]").val(attr);
			$("input[name=pais]").val(value);
			$("#paises").html("");
			$("#paises").css("display", "none");

		});

	});

}