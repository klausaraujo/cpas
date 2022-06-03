function listaFichas(URI, Evento_Registro_Numero, LISTA_PAISES, ENCRIPTADO) {

	$(".div-gestante").css("display", "none");

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

	$(document).ready(function () {

		habilitarReniec();

		$('.tableEnfermedades tbody').on('click', 'tr', function () {
			var data = tableEnfermedades.row(this).data();
			$("input[name=Evento_Ficha_Atencion_Detalle_CIE10_Codigo]").val(data[0]);
			$("input[name=Evento_Ficha_Atencion_Detalle_CIE10_Texto]").val(data[1]);
			$('#tableEnfermedadesModal').modal('hide');
		});

		$("#formRegistrar").validate({
			rules: {
				fechaApertura: { required: true }
			},
			messages: {
				fechaApertura: { required: "(*) Campo Requerido" }
			}
		});
		$("#formEditar").validate({
			rules: {
				horaApertura: { required: true }
			},
			messages: {
				horaApertura: { required: "(*) Campo Requerido" }
			}
		});

		var table = $('.tbLista').DataTable(
			{
				dom: '<"html5buttons"B>lTfgitp',
				columns: [
					{ "data": "id" },
					{ "data": "Evento_Ficha_Atencion_Fecha" },
					{ "data": "usuario" },
					{ "data": "Evento_Ficha_Atencion_Hora_Cierre" },
					{ "data": "Numero_Atenciones" },
					{ "data": "Estado" },
					{ "data": "Evento_Ficha_Atencion_Estado" },
					{ "data": "encriptado" }
				],
				columnDefs: [{
					"targets": [6, 7],
					"visible": false,
					"searchable": false
				}],
				"order": [[1, "asc"]],
				buttons: [
					{ extend: 'copy', title: 'Copiar' },
					{ extend: 'csv', title: 'Csv' },
					{ extend: 'excel', title: 'Excel' },
					{ extend: 'pdf', title: 'Pdf', orientation: 'landscape' },

					{
						extend: 'print',
						title: 'Imprimir',
						customize: function (
							win) {
							$(win.document.body).addClass('white-bg');
							$(win.document.body).css('font-size', '10px');

							$(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
						}
					}]

			});

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
		$('body').on('click', '.tbLista tr', function () {

			$("#Tipo_Accion").val("");

			var tr = $(this);
			var row = table.row(tr);

			index = row.index();

			data = row.data();
			var estado = data.Evento_Ficha_Atencion_Estado;
			var usuario = data.usuario;
			var id = data.id;
			var encriptado = data.encriptado;

			$("#btn-editar").removeClass("editar");
			$("#btn-atencion").removeClass("atencion");
			$("#btn-consolidado").removeClass("consolidado");
			$("#btn-eliminar").removeClass("eliminar");
			$("#btn-reportar").removeClass("reportar");
			$("#btn-cerrar").removeClass("cerrar");
			$("#btn-reabrir").removeClass("reabrir");

			if (estado == '1') {
				$("#btn-editar").addClass("editar");
				$("#btn-atencion").addClass("atencion");
				$("#btn-eliminar").addClass("eliminar");
				$("#btn-cerrar").addClass("cerrar");
			}

			if (estado == '2') {
				$("#btn-reabrir").addClass("reabrir");
				$("#btn-reabrir").find("label").attr("rel", encriptado);
			}

			$("#btn-consolidado").addClass("consolidado");
			$("#btn-reportar").addClass("reportar");

			$("#btn-editar").find("label").attr("rel", id);
			$("#btn-editar").find("label").attr("data-user", usuario);

			$("#btn-atencion").find("label").attr("rel", id);
			$("#btn-consolidado").find("label").attr("rel", encriptado);
			$("#btn-eliminar").find("label").attr("rel", id);
			$("#btn-exportar").find("label").attr("rel", id);
			$("#btn-reportar").find("label").attr("rel", encriptado);
			$("#btn-cerrar").find("label").attr("rel", id);

			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}

		});

		$("#btn-exportar a").on("click", function (e) {
			e.preventDefault();
			$("#informeModal").modal("show");

		});

		$('#btn-editar').on('click', function () {
			var id = $(this).find("label").attr("rel");
			var usuario = $(this).find("label").attr("data-user");

			$("#editModal").modal("show");
			$("#editModal").find("input[name='id']").val(id);
			$("#editModal").find("input[name='usuario']").val(usuario);
		});

		$('#btn-atencion').on('click', function () {
			var id = $(this).find("label").attr("rel");
			console.log("tomcat", id);
			$("#atencionModal").modal("show");
			$("#atencionModal").find("input[name='Evento_Ficha_Atencion_ID']").val(id);

		});

		$('#btn-cerrar').on('click', function () {
			var id = $(this).find("label").attr("rel");

			$("#cerrarModal").modal("show");
			$("#cerrarModal").find("input[name='id']").val(id);

		});

		$('#btn-reabrir').on('click', function () {
			var id = $(this).find("label").attr("rel");

			location.href = URI + "ofertamovil/fichas/abrir/" + ENCRIPTADO + "/" + id;
		});

		$('#btn-eliminar').on('click', function () {
			var id = $(this).find("label").attr("rel");

			$("#eliminarModal").modal("show");
			$("#eliminarModal").find("input[name='id']").val(id);

		});

		$('#btn-consolidado').on('click', function () {
			var id = $(this).find("label").attr("rel");

			location.href = URI + "ofertamovil/fichas/consolidado/" + ENCRIPTADO + "/" + id;
		});
		$('#btn-reportar').on('click', function () {
			var id = $(this).find("label").attr("rel");

			location.href = URI + "ofertamovil/fichas/reportarFicha/" + ENCRIPTADO + "/" + id;
		});

		$("#formRegistrarAtencion").validate({
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
				Evento_Ficha_Atencion_Detalle_Responsable: { required: function () { if (parseInt($("select[name=Evento_Ficha_Atencion_Detalle_Destino]").val()) == 1) return true; else return false; } }
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
				Evento_Ficha_Atencion_Detalle_Responsable: { required: "(*) Campo Requerido" }
			}
		});

		$("select[name=Evento_Tipo_Entidad_Atencion]").on("change", function () {

			var Evento_Tipo_Entidad_Atencion_ID = $(this).val();

			var html = "";

			$.ajax({
				type: "POST",
				url: URI + "ofertamovil/fichas/listaOfertasMovilByEntidad",
				dataType: "json",
				data: { Evento_Tipo_Entidad_Atencion_ID: Evento_Tipo_Entidad_Atencion_ID, Evento_Registro_Numero: Evento_Registro_Numero },
				beforeSend: function () {
					$("select[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID]").html("<option>Cargando...</option>");
				},
				success: function (data) {

					count = 0;
					$.each(data.lista, function (i, e) {
						count++;
						html += '<option value="' + e.id + '">' + e.Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre + '</option>';
					});

					if (count > 0) $("select[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID]").html("<option value=''>-- Seleccione --</option>" + html);
					else $("select[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID]").html("<option value=''>-- NO HAY REGISTROS --</option>");
				}
			});

		});

		$("select[name=Evento_Ficha_Atencion_Detalle_Genero]").change(function () {
			var genero = $(this).val();

			if (genero == "2")
				$(this).closest("#formRegistrarAtencion").find(".div-gestante").slideDown();
			else
				$(this).closest("#formRegistrarAtencion").find(".div-gestante").slideUp();

		});

		$("select[name=Evento_Ficha_Atencion_Detalle_Destino]").change(function () {
			var id = $(this).val();

			if (id == "1") {
				$(this).closest("#formRegistrarAtencion").find("input[name=Evento_Ficha_Atencion_Detalle_Lugar_Traslado]").attr("disabled", "disabled");
				$(this).closest("#formRegistrarAtencion").find("input[name=Evento_Ficha_Atencion_Detalle_Responsable]").attr("disabled", "disabled");
			} else {
				$(this).closest("#formRegistrarAtencion").find("input[name=Evento_Ficha_Atencion_Detalle_Lugar_Traslado]").removeAttr("disabled");
				$(this).closest("#formRegistrarAtencion").find("input[name=Evento_Ficha_Atencion_Detalle_Responsable]").removeAttr("disabled");
			}

		});

		$("#btn-buscar").on("click", function () {
			var Evento_Ficha_Atencion_Detalle_DNI = $("input[name=Evento_Ficha_Atencion_Detalle_DNI]").val();

			if (Evento_Ficha_Atencion_Detalle_DNI.length >= 8) {
				var type = "01";
				if (Evento_Ficha_Atencion_Detalle_DNI.length > 8) {
					type = "03";
				}

				$.ajax({
					url: URI + "ofertamovil/main/curl",
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

		$("#btn-oferta-movil").on('click', function () {

			$("#ofertaMovilModal").modal("show");
			$("#ofertaMovilModal").find("#Evento_Registro_Numero").val(Evento_Registro_Numero);

			$.ajax({
				type: "POST",
				url: URI + "ofertamovil/main/EventoTipoEntidadAtencionOfertaMovilLista",
				data: { Evento_Registro_Numero: Evento_Registro_Numero },
				dataType: "json",
				beforeSend: function () {
					$("#tableOfertaMovil tbody").html("<tr><td colspan='2'>Cargando...</td></tr>");
				},
				success: function (data) {

					var html = "";
					var count = 0;

					$.each(data.lista, function (i, e) {
						count++;
						html += '<tr><td class="text-center">' + e.Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre + '</td><td class="text-center">' + e.Evento_Tipo_Entidad_Atencion_Nombre + '</td><td class="delete" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
					});

					if (count == 0) html = "<tr class='sin-registros'><td colspan='3' class='text-center'>No hay registros</td></tr>";

					$("#tableOfertaMovil tbody").html(html);
				}
			});

		});

	});

	$("#formRegistrarOfertaMovil").validate({
		rules: {
			Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre: { required: true },
			Evento_Tipo_Entidad_Atencion_ID: { required: true }
		},
		messages: {
			Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre: { required: "(*) Campo Requerido" },
			Evento_Tipo_Entidad_Atencion_ID: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "ofertamovil/main/EventoTipoEntidadAtencionOfertaMovilRegistrar",
				data: $("#formRegistrarOfertaMovil").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#formRegistrarOfertaMovil button[type=submit]").text("Agregando...");
					$("#formRegistrarOfertaMovil button").addClass("disabled");
				},
				success: function (data) {

					$("#formRegistrarOfertaMovil button[type=submit]").text("Agregar");
					$("#formRegistrarOfertaMovil button").removeClass("disabled");

					var html = "";
					var count = 0;

					sinRegistros = $("#tableOfertaMovil tbody tr.sin-registros").length;

					if (parseInt(data.status) == 200) {

						if (parseInt(data.id) > 0) {

							if (parseInt(sinRegistros) > 0) {
								html = '<tr><td class="text-center">' + $("#formRegistrarOfertaMovil").find("input[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre]").val() + '</td>';
								html += '<td class="text-center">' + $("#formRegistrarOfertaMovil").find("select option:selected").text() + '</td><td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
							}
							else {
								html = $("#tableOfertaMovil tbody").html();
								html += '<tr><td class="text-center">' + $("#formRegistrarOfertaMovil").find("input[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre]").val() + '</td>';
								html += '<td class="text-center">' + $("#formRegistrarOfertaMovil").find("select option:selected").text() + '</td><td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
							}

							$("#formRegistrarOfertaMovil")[0].reset();

						}

						$("#tableOfertaMovil tbody").html(html);

					}
					else {
						$("#duplicate_movil").removeClass("hide");
						setTimeout(function () {
							$("#duplicate_movil").addClass("hide");
						}, 2000);
					}

				}
			});
		}
	});

	$("html").on("click", "#formRegistrarOfertaMovil table tr td.delete", function () {

		var id = $(this).attr("rel");
		$("#deleteOfertaMovilModal").modal("show");
		$("#deleteOfertaMovilModal").find("input[name=id]").val(id);

	});

	$("#deleteOfertaMovilForm").validate({

		rules: {
			id: { required: true }
		},
		messages: {
			id: { required: "(*) Campo Requerido" }
		}

	});

}