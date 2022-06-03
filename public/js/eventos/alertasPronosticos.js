function alertasPronosticos(URI) {

	var listaEventos = [];
	var superEvento = null;

	var zoom = 0;
	var coordenadas = '';

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

	function armarTablaEventosSeleccionados(eventosSeleccionados) {

		$("#tbEventosSeleccionados tbody").html("");
		var html = '';

		if (eventosSeleccionados.length > 0) {
			$.each(eventosSeleccionados, function (i, e) {
				html += '<tr><td align="center">' + e.Ubigeo + '</td>';
				html += '<td align="left">' + e.Region + '</td>';
				html += '<td align="left">' + e.Provincia + '</td>';
				html += '<td align="center" rel="' + e.Ubigeo + '"><i class="fa fa-trash" aria-hidden="true"></i></td>';
				html += '<td style="visibility: hidden">' + e.codigo_departamento + '</td>';
				html += '<td style="visibility: hidden">' + e.codigo_provincia + '</td></tr>';
			});
		}
		$("#tbEventosSeleccionados tbody").html(html);

	}

	function removerElemento(id) {

		var eventosSeleccionados = listaEventos.filter(elemento => elemento.Ubigeo != id);

		if (!eventosSeleccionados) {
			eventosSeleccionados = [];
		}

		return eventosSeleccionados;
	}

	function agregarMarker(id) {

		var ubigeo = id;
		var stop = false;
		mapMarkers.forEach(function (e) {

			if (ubigeo[0] == e.position.lat()) {

				stop = true;
			}

		});

		if (stop) {
			return false;
		}

	}

	function getCoordenadasYzoom() {

		zoom = map.getZoom();

		mapMarkers.forEach(function (e) {
			coordenadas += "|" + e.position.lat() + "," + e.position.lng();
		});

	}

	// function removerMarker(id) {
	// 	mapMarkers[id].setMap(null);

	// 	var temporalMarkers = [];
	// 	if (mapMarkers && mapMarkers.length > 0) {
	// 		mapMarkers.forEach(function (element, index, arra) {
	// 			if (parseInt(index) !== parseInt(id)) {
	// 				temporalMarkers[index] = mapMarkers[index];
	// 			} else {
	// 				mapMarkers[index].setMap(null);
	// 			}
	// 		});
	// 		mapMarkers = temporalMarkers;

	// 	}

	// }

	function removeAllMarker() {

		mapMarkers.forEach(function (e, i, a) {
			mapMarkers[i].setMap(null);
		});
		mapMarkers = [];
	}

	function removeAllSuperEventsMarker() {

		mapSuperEventosMarkers.forEach(function (e, i, a) {
			mapSuperEventosMarkers[i].setMap(null);
		});
		mapSuperEventosMarkers = [];
	}

	function anular(Evento_Estado_Codigo) {

		var id = $("#btn-anular").find("label").attr("rel");
		Evento_Estado_Codigo = $("#Tipo_Accion").val();
		post(URI + "eventos/eventos/cambiarEstadoAlertaPronostico", {
			Evento_Estado_Codigo: Evento_Estado_Codigo,
			id: id
		});

	}

	function cerrar(Evento_Estado_Codigo) {

		var id = $("#btn-cerrar").find("label").attr("rel");
		Evento_Estado_Codigo = $("#Tipo_Accion").val();
		post(URI + "eventos/eventos/cerrarAlertaPronostico", {
			Evento_Estado_Codigo: Evento_Estado_Codigo,
			id: id
		});

	}

	$(document).ready(function () {

		var tbLista = $('#tbLista').DataTable({
			pageLength: 5,
			"paging": false,
			"bFilter": false,
			columns: [
				{ "data": "Ubigeo" },
				{ "data": "Region" },
				{ "data": "Provincia" },
				{ "data": "Ubigeo" },
				{ "data": "codigo_departamento" },
				{ "data": "codigo_provincia" }
			],
			columnDefs: [{
				"targets": [3, 4, 5],
				"visible": false,
				"searchable": false
			}],
			"ajax": {
				url: URI + "eventos/eventos/filtroUbigeo",
				type: "POST",
				data: function (d) {
					d.departamento = document.getElementById("departamento").value

				}
			}
		});

		$(".agregar").on("click", function () {
			$("#tbEventosSeleccionados tbody").html("");
			$("#formRegistrar")[0].reset();
			$("#registroModal").modal("show");

		});

		$(".date").datetimepicker({
			format: "DD/MM/YYYY"

		});

		$(".dateHour").datetimepicker({
			format: 'LT'
		});

		$("#btnBuscar").on("click", function () {

			$("#eventosModal").modal("show");

		});

		var table = $('.tbLista').DataTable({
			"lengthMenu": [[25, 50, 100, -1,], [25, 50, 100, "Todos"]],
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "evento_avisos_numero" },
				{ "data": "tipo_aviso1" },
				{ "data": "titulo" },
				{ "data": "fuente" },
				{ "data": "nivel_peligro1" },
				{ "data": "fecha_inicio" },
				{ "data": "fecha_fin" },
				{ "data": "mapa" },
				{ "data": "accion" },
				{ "data": "recomendar" },
				{ "data": "reportar" },
				{ "data": "id" },
				{ "data": "descripcion_general" },
				{ "data": "asc" },
				{ "data": "desc" },
				{ "data": "enlace_url" },
				{ "data": "imagenmapa" },
				{ "data": "tipo_aviso" },
				{ "data": "nivel_peligro" }
			],
			columnDefs: [{
				"targets": [11, 12, 13, 14, 15, 16, 17, 18],
				"visible": false,
				"searchable": false
			}],
			"order": [[0, "desc"]],
			buttons: [
				{
					extend: 'copy',
					title: 'Lista General de Avisos',
					exportOptions: { columns: [0, 1, 8, 2, 3, 4, 5] },
				},
				{
					extend: 'csv',
					title: 'Lista General de Avisos',
					exportOptions: { columns: [0, 1, 8, 2, 3, 4, 5] },
				},
				{
					extend: 'excel',
					title: 'Lista General de Avisos',
					exportOptions: { columns: [0, 1, 8, 2, 3, 4, 5] },
				},
				{
					extend: 'pdf',
					title: 'Lista General de Avisos',
					orientation: 'landscape',
					exportOptions: { columns: [0, 1, 8, 2, 3, 4, 5] },
				},

				{
					extend: 'print',
					title: 'Lista General de Avisos',
					exportOptions: { columns: [0, 1, 8, 2, 3, 4, 5] },
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

		$(".uploadMapa").on('click', function () {
			var $item = $(this).parents("tr");
			var row = table.row($item);

			index = row.index();
			data = row.data();

			$("#mapaId").val(data.id);

			$("#formRegistrarMapa")[0].reset();
			$("#registroModal1").modal("show");

		});

		$(".acciones").on('click', function () {
			var $item = $(this).parents("tr");
			var row = table.row($item);

			index = row.index();
			data = row.data();

			$("#idaccion").val(data.id);

			$("#formAcciones")[0].reset();
			$("#accionesModal").modal("show");

		});

		$(".recomendaciones").on('click', function () {
			var $item = $(this).parents("tr");
			var row = table.row($item);

			index = row.index();
			data = row.data();

			$("#idrecomendacion").val(data.id);

			$("#formRecomendaciones")[0].reset();
			$("#recomendacionesModal").modal("show");

		});

		$("#formAcciones select[name=id_region]").on("change", function () {

			$id = $(this).val();

			console.log($id);

			if ($id.length > 0) {
				$.ajax({
					type: "POST",
					url: URI + "eventos/eventos/listarejecutoras",
					data: { id: $id },
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
					},
					success: function (data) {
						$("#modalCargaGeneral").css("display", "none");
						$("#accionesModal").modal("show");

						var html = '<option value="">-- Seleccione IPRESS --</option>';

						$.each(data.listarejecutoras, function (i, e) {
							html += '<option value="' + e.codigo_renipress + '">' + e.codigo_renipress + ' - ' + e.nombre + '</option>';
						});

						$("#formAcciones select[name=codigo_renipress]").html(html);
					}
				});
			}

		});

		$('body').on('click', 'td i.acciones', function () {

			var $item = $(this).parents("tr");
			var row = table.row($item);

			index = row.index();
			data = row.data();

			$id = data.id;

			console.log($id);

			if ($id.length > 0) {
				$.ajax({
					type: "POST",
					url: URI + "eventos/eventos/listarregiones",
					data: { id: $id },
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
					},
					success: function (data) {
						$("#modalCargaGeneral").css("display", "none");
						$("#accionesModal").modal("show");

						var html = '<option value="">-- Seleccione Región --</option>';

						$.each(data.listarregiones, function (i, e) {
							html += '<option value="' + e.codigo_departamento + '">' + e.nombre + '</option>';
						});

						$("#formAcciones select[name=id_region]").html(html);
					}
				});

				$.ajax({
					type: "POST",
					url: URI + "eventos/eventos/listaAccionesAlertas",
					data: { id: $id },
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
					},
					success: function (data) {
						$("#modalCargaGeneral").css("display", "none");

						$("#accionesModal").modal("show");

						var html = "";
						var count = 0;

						$.each(data.listaAccionesAlertas, function (i, e) {

							count++;
							html += '<tr><td class="text-center">' + e.Region + '</td>';
							html += '<td class="text-center">' + e.IPRESS + '</td>';
							html += '<td class="text-center">' + e.Tipo_Accion + '</td>';
							html += '<td class="text-center">' + e.Fecha + '</td>';
							html += '<td class="text-center">' + e.Sireed + '</td>';
							html += '<td class="delete" align="center" rel="' + e.evento_avisos_monitoreo_id + '"><i class="fa fa-trash" aria-hidden="true"></i></td></tr>';
						});

						if (count == 0) html = "<tr class='sin-registros'><td colspan='7' class='text-center'>No hay registros</td></tr>";

						$("#tableAcciones tbody").html(html);
					}
				});
			}

		});

		$('body').on('click', 'td i.recomendaciones', function () {

			var $item = $(this).parents("tr");
			var row = table.row($item);

			index = row.index();
			data = row.data();

			$id = data.id;

			console.log($id);

			if ($id.length > 0) {

				$.ajax({
					type: "POST",
					url: URI + "eventos/eventos/listaRecomendacionesAlertas",
					data: { id: $id },
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
					},
					success: function (data) {
						$("#modalCargaGeneral").css("display", "none");

						$("#recomendacionesModal").modal("show");
						$("#formRecomendaciones").find("input[name=idaccion]").val(datos.id);
						var html = "";
						var count = 0;

						$.each(data.listaRecomendacionesAlertas, function (i, e) {

							count++;
							html += '<tr><td class="text-justify">' + e.iddireccion + '</td>';
							html += '<td class="text-justify">' + e.descripcion + '</td>';
							html += '<td class="delete" align="center" rel="' + e.evento_avisos_recomndaciones_id + '"><i class="fa fa-trash" aria-hidden="true"></i></td></tr>';
						});

						if (count == 0) html = "<tr class='sin-registros'><td colspan='7' class='text-center'>No hay registros</td></tr>";

						$("#tableRecomendaciones tbody").html(html);
					}
				});
			}

		});

		$('body').on('click', 'td a.aInformeInicial', function () {

			var $item = $(this).parents("tr");
			var row = table.row($item);

			index = row.index();
			data = row.data();

			$id = data.id;

			console.log({ $id });

			var informeInicial = data.asc;

			$("#aInformeInicial").attr("href", URI + "eventos/eventos/informesalertaavisos/=" + informeInicial);

		});
		$("#agregarEvento").on("click", function () {

			if (mapMarkers && mapMarkers.length > 0) {
				for (var i = 0; i < mapMarkers.length; i++) {
					mapMarkers[i].setMap(null);
				}
			}
			mapMarkers = [];
			marcadores = [];

			$.each(data.registros, function (i, e) {

				var coordenadas = e.Evento_Coordenadas.split(",");
				var posicion = { "latitud": coordenadas[0], "longitud": coordenadas[1] };
				marcadores[i] = [{ id: e.Evento_Registro_Numero, posicion: posicion, nivel: e.Evento_Nivel_Codigo, tipo: e.Evento_Tipo_Codigo }];

			});

			cargarFullMapMarkers(0, marcadores);

		});

		$("#file").change(function (event) {
			RecurFadeIn();
			readURL(this);
		});

		$("#file").on('click', function (event) {
			RecurFadeIn();
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				var filename = $("#file").val();
				filename = filename.substring(filename.lastIndexOf('\\') + 1);
				reader.onload = function (e) {

					$('#blah1').attr('src', e.target.result);
					$('#blah1').hide();
					$('#blah1').fadeIn(500);
					$('.custom-file-label').text(filename);
				}
				reader.readAsDataURL(input.files[0]);
			}
			$(".alert").removeClass("loading").hide();
		}

		function RecurFadeIn() {

			FadeInAlert("Esperando...");
		}

		function FadeInAlert(text) {
			$(".alert").show();
			$(".alert").text(text).addClass("loading");
		}

		$("#formRegistrarMapa").validate({

			submitHandler: function (form, event) {

				var formData = new FormData(document.getElementById("formRegistrarMapa"));
				formData.append("file", document.getElementById("file"));
				formData.append("id", $("#mapaId").val());
				$.ajax({
					data: formData,
					url: URI + "eventos/eventos/registrarmapa",
					method: "POST",
					dataType: "json",
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function () {
						var texto = "";

						var file = $("#formRegistrarMapa input[type=file]").val();
						if (file.length > 0) texto = "Espere, se est&aacute; cargando el archivo adjunto ";
						$("#formRegistrarMapa button[type=submit]").html(texto + '<i class="fa fa-spinner fa-spin"></i>');
						$("#formRegistrarMapa button[type=submit]").addClass('disabled');
						$("#formRegistrarMapa button[type=submit]").css('pointer-events', 'none');
					},
					success: function (data) {
						$('html, body').animate({ scrollTop: 0 }, 'fast');

						var $message = "";
						if (parseInt(data.status) == 200) {
							$message = '<div class="alert alert-success"><h4 style="margin:0">Mapa Cargado exitosamente</h4></div>';
							$("#registroModal1").modal("hide");
						}

						else {
							$message = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar el mapa</h4></div>';
							$("#btnEventoFinal").removeClass("disabled");
							$("#registroModal1").modal("hide");
						}

						$("#message").html($message);
						if (parseInt(data.status) === 200) {
							location.reload();
						}
					}
				});

			}
		});
		$("#formBuscarEventos").validate({
			rules: {
				departamento: { required: true },
			},
			messages: {
				departamento: {
					required: "(*) Campo Requerido"
				}
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				$("#formBuscarEventos button[type=submit]").text("Agregando...").addClass("disabled");

				tbLista.ajax.reload(function () {
					$("#formBuscarEventos button[type=submit]").text("Buscar").removeClass("disabled");
				});
				tbLista.draw();

			}
		});
		$("#formRegistrar").validate({
			rules: {
				titulo: { required: true },
				descripcion_general: { required: true },
				fuente: { required: true },
				nivel_peligro: { required: true },
				fecha_inicio: { required: true },
				hora_inicio: { required: true },
				fecha_fin: { required: true },
				hora_fin: { required: true }
			},
			messages: {
				titulo: {
					required: "(*) Campo Requerido"
				},
				descripcion_general: {
					required: "(*) Campo Requerido"
				},
				fuente: {
					required: "(*) Campo Requerido"
				},
				nivel_peligro: {
					required: "(*) Campo Requerido"
				},
				fecha_inicio: {
					required: "(*) Campo Requerido"
				},
				hora_inicio: {
					required: "(*) Campo Requerido"
				},
				fecha_fin: {
					required: "(*) Campo Requerido"
				},
				hora_fin: {
					required: "(*) Campo Requerido"
				}
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				if (listaEventos.length == 0) {
					return false;
				}
				var titulo = $("#formRegistrar").find("input[name=titulo]").val();
				var descripcion_general = $("#formRegistrar").find("textarea[name=descripcion_general]").val();
				var fuente = $("#formRegistrar").find("input[name=fuente]").val();
				var nivel_peligro = $("#formRegistrar").find("select[name=nivel_peligro]").val();
				var tipo_aviso = $("#formRegistrar").find("select[name=tipo_aviso]").val();
				var nombre_aviso = $("#formRegistrar").find("select[name=tipo_aviso] option:selected").text();
				var fecha_inicio = $("#formRegistrar").find("input[name=fecha_inicio]").val();
				var hora_inicio = $("#formRegistrar").find("input[name=hora_inicio]").val();
				var fecha_fin = $("#formRegistrar").find("input[name=fecha_fin]").val();
				var hora_fin = $("#formRegistrar").find("input[name=hora_fin]").val();
				var enlace_url = $("#formRegistrar").find("input[name=enlace_url]").val();
				var id = $("#formRegistrar").find("input[name=id]").val();

				var eventos = '';
				$.each(listaEventos, function (i, e) {

					if (i == 0) {
						eventos += e.Ubigeo;
					} else {
						eventos += "|" + e.Ubigeo;
					}

				});

				listaUbicacion = listaEventos.reduce((acc, current) => {
					const x = acc.find(item => item.Region === current.Region);
					if (!x) {
						return acc.concat([current]);
					} else {
						return acc;
					}
				}, []).map((item => item.Region)).join();

				var request = {
					titulo: titulo,
					descripcion_general: descripcion_general,
					fuente: fuente,
					nivel_peligro: nivel_peligro,
					tipo_aviso: tipo_aviso,
					nombre_aviso,
					fecha_inicio: fecha_inicio,
					hora_inicio: hora_inicio,
					eventos: eventos,
					fecha_fin: fecha_fin,
					hora_fin: hora_fin,
					enlace_url: enlace_url,
					listaUbicacion,
					id: id
				};
				$.ajax({
					url: URI + "eventos/eventos/alertasPronosticosRegistrar",
					method: "POST",
					data: request,
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
					},
					success: function (data) {
						if (parseInt(data.status) === 200) {
							location.reload();
						}

					}
				});
			}
		});
		$("#formAcciones").validate({
			rules: {
				departamento: { required: true },
				ejecutora: { required: false },
				lsaccion: { required: true },
				fecha_accion: { required: true },
				hora_accion: { required: true },
				descripcion_accion: { required: true },
				num_sireed: { required: true }
			},
			messages: {
				departamento: {
					required: "(*) Campo Requerido"
				},
				lsaccion: {
					required: "(*) Campo Requerido"
				},
				fecha_accion: {
					required: "(*) Campo Requerido"
				},
				hora_accion: {
					required: "(*) Campo Requerido"
				},
				descripcion_accion: {
					required: "(*) Campo Requerido"
				},
				num_sireed: {
					required: "(*) Campo Requerido"
				}
			},
			submitHandler: function (form, event) {
				event.preventDefault();
				var departamento = $("#formAcciones").find("select[name=id_region]").val();
				var ejecutora = $("#formAcciones").find("select[name=codigo_renipress]").val();
				var lsaccion = $("#formAcciones").find("select[name=lsaccion]").val();
				var fecha_accion = $("#formAcciones").find("input[name=fecha_accion]").val();
				var hora_accion = $("#formAcciones").find("input[name=hora_accion]").val();
				var descripcion_accion = $("#formAcciones").find("textarea[name=descripcion_accion]").val();
				var num_sireed = $("#formAcciones").find("input[name=num_sireed]").val();
				var anio_sireed = $("#formAcciones").find("input[name=anio_sireed]").val();
				var idaccion = $("#formAcciones").find("input[name=idaccion]").val();

				$.ajax({
					url: URI + "eventos/eventos/alertasPronosticosRegistrarAccion",
					method: "POST",
					data: {
						departamento: departamento,
						ejecutora: ejecutora,
						lsaccion: lsaccion,
						fecha_accion: fecha_accion,
						hora_accion: hora_accion,
						descripcion_accion: descripcion_accion,
						num_sireed: num_sireed,
						anio_sireed: anio_sireed,
						idaccion: idaccion
					},
					dataType: "JSON",
					beforeSend: function () {
						$("#formAcciones button[type=submit]").text("Agregando...");
						$("#formAcciones button").addClass("disabled");
					},
					success: function (data) {
						console.log(JSON.stringify(data))
						$("#formAcciones button[type=submit]").text("Guardar");
						$("#formAcciones button").removeClass("disabled");

						var html = "";
						var count = 0;

						sinRegistros = $("#tableAcciones tbody tr.sin-registros").length;

						if (parseInt(data.status) === 200) {

							if (parseInt(data.id) > 0) {

								if (parseInt(sinRegistros) > 0) {

									html += '<tr><td class="text-center">' + $("#formAcciones").find("select[name=id_region] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formAcciones").find("select[name=codigo_renipress] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formAcciones").find("select[name=lsaccion] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formAcciones").find("input[name=fecha_accion]").val() + '</td>';
									html += '<td class="text-center">' + $("#formAcciones").find("input[name=num_sireed]").val() + '</td>';
									html += '<td class="delete" align="center" rel="' + data.id + '"><i class="fa fa-trash" aria-hidden="true"></i></td></tr>';
								}
								else {
									html = $("#tableAcciones tbody").html();
									html += '<tr><td class="text-center">' + $("#formAcciones").find("select[name=id_region] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formAcciones").find("select[name=codigo_renipress] option:selected").text().substr(10) + '</td>';
									html += '<td class="text-center">' + $("#formAcciones").find("select[name=lsaccion] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formAcciones").find("input[name=fecha_accion]").val() + '</td>';
									html += '<td class="text-center">' + $("#formAcciones").find("input[name=num_sireed]").val() + '</td>';
									html += '<td class="delete" align="center" rel="' + data.id + '"><i class="fa fa-trash" aria-hidden="true"></i></td></tr>';
								}

								$("#formAcciones")[0].reset();
								$("#formAcciones select[name=id_region]").val("0");

							}

							$("#tableAcciones tbody").html(html);
						}

						else if (parseInt(data.status) == 201) {
							$("#duplicate_accion").removeClass("hide");
							setTimeout(function () {
								$("#duplicate_accion").addClass("hide");
							}, 2000);
						}
						else {
							alert("Error al registrar");
						}

					}
				});

			}
		});
		$("#formRecomendaciones").validate({
			rules: {
				lsrecomendacion: { required: true },
				descripcion_recomendacion: { required: true },
			},
			messages: {
				lsrecomendacion: {
					required: "(*) Campo Requerido"
				},
				descripcion_recomendacion: {
					required: "(*) Campo Requerido"
				}
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				var lsrecomendacion = $("#formRecomendaciones").find("select[name=lsrecomendacion]").val();
				var descripcion_recomendacion = $("#formRecomendaciones").find("textarea[name=descripcion_recomendacion]").val();
				var idrecomendacion = $("#formRecomendaciones").find("input[name=idrecomendacion]").val();

				$.ajax({
					url: URI + "eventos/eventos/alertasPronosticosRegistrarRecomendacion",
					method: "POST",
					data: {
						lsrecomendacion: lsrecomendacion,
						descripcion_recomendacion: descripcion_recomendacion,
						idrecomendacion: idrecomendacion
					},
					dataType: "JSON",
					beforeSend: function () {
						$("#formRecomendaciones button[type=submit]").text("Agregando...");
						$("#formRecomendaciones button").addClass("disabled");
					},
					success: function (data) {

						$("#formRecomendaciones button[type=submit]").text("Guardar");
						$("#formRecomendaciones button").removeClass("disabled");

						var html = "";
						var count = 0;

						sinRegistros = $("#tableRecomendaciones tbody tr.sin-registros").length;

						if (parseInt(data.status) === 200) {

							if (parseInt(data.id) > 0) {

								if (parseInt(sinRegistros) > 0) {

									html += '<tr><td class="text-justify">' + $("#formRecomendaciones").find("select[name=lsrecomendacion] option:selected").text() + '</td>';
									html += '<td class="text-justify">' + $("#formRecomendaciones").find("textarea[name=descripcion_recomendacion]").val() + '</td>';
									html += '<td class="delete" align="center" rel="' + data.id + '"><i class="fa fa-trash" aria-hidden="true"></i></td></tr>';
								}
								else {
									html = $("#tableRecomendaciones tbody").html();
									html += '<tr><td class="text-justify">' + $("#formRecomendaciones").find("select[name=lsrecomendacion] option:selected").text() + '</td>';
									html += '<td class="text-justify">' + $("#formRecomendaciones").find("textarea[name=descripcion_recomendacion]").val() + '</td>';
									html += '<td class="delete" align="center" rel="' + data.id + '"><i class="fa fa-trash" aria-hidden="true"></i></td></tr>';
								}

								$("#formRecomendaciones")[0].reset();
								$("#formRecomendaciones select[name=lsrecomendacion]").val("0");

							}

							$("#tableRecomendaciones tbody").html(html);
						}

						else if (parseInt(data.status) == 201) {
							$("#duplicate_recomendacion").removeClass("hide");
							setTimeout(function () {
								$("#duplicate_recomendacion").addClass("hide");
							}, 2000);
						}
						else {
							alert("Error al registrar");
						}

					}
				});

			}
		});

		$('body').on('click', 'td i.cargarmapa', function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			datos = row.data();
			console.log(datos.imagenmapa);
			$("#registroModal1").modal("show");
			if (datos.imagenmapa != '') {
				$("#registroModal1 img").attr("src", URI + "public/avisos/" + datos.imagenmapa);
			}
			else {
				$("#registroModal1 img").attr("src", URI + "public/images/brigadistas/camera.png");
			}
		});
		$('#tbLista').on('click', 'tbody tr td', function () {

			var tr = $(this).parents('tr');
			var row = tbLista.row(tr);

			var index = row.index();
			var datos = row.data();

			listaEventos = removerElemento(datos.ubigeo);
			listaEventos.push(datos);
			armarTablaEventosSeleccionados(listaEventos);

		});

		$('body').on('click', 'i.fa-trash', function () {
			console.log($(this).parents("td").attr("rel"))
			var ubigeo = $(this).parents("td").attr("rel");

			listaEventos = removerElemento(ubigeo);
			armarTablaEventosSeleccionados(listaEventos);
			removerMarker(ubigeo);

		});

		$("html").on("click", "#formAcciones table tr td.delete", function () {

			var id = $(this).attr("rel");
			$("#deleteAccionModal").modal("show");
			$("#deleteAccionModal").find("input[name=id]").val(id);
			console.log(id);

		});

		$("html").on("click", "#formRecomendaciones table tr td.delete", function () {

			var id = $(this).attr("rel");
			$("#deleteRecomendacionModal").modal("show");
			$("#deleteRecomendacionModal").find("input[name=id]").val(id);
			console.log(id);

		});

		$('body').on('click', '.tbLista tr', function () {

			var tr = $(this);
			var row = table.row(tr);

			index = row.index();

			data = row.data();

			var id = data.id;

			$("#btn-editar").find("label").attr("rel", id);
			$("#btn-cerrar").find("label").attr("rel", id);
			$("#btn-anular").find("label").attr("rel", id);
			$("#btn-editar").removeClass("editar");
			$("#btn-anular").removeClass("anular");
			$("#btn-cerrar").removeClass("cerrar");
			$("#btn-editar").addClass("editar");
			$("#btn-anular").addClass("anular");
			$("#btn-cerrar").addClass("cerrar");
			alertaSelec = data;

			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}

			var informeInicial = data.asc;

			$("#aInformeInicial").attr("href", URI + "eventos/eventos/informesalertaavisos/=" + informeInicial);

		});

		$("#btn-editar").on("click", function () {
			eventosSeleccionados = [];
			listaEventos = [];
			$("#tbEventosSeleccionados tbody").html("");

			var id = $(this).find("label").attr("rel");

			$("#registroModal").modal("show");
			var fechai = (alertaSelec.fecha_inicio).split(" ");
			var fechaf = (alertaSelec.fecha_fin).split(" ");
			console.log(alertaSelec);
			$("#formRegistrar").find("input[name=titulo]").val(alertaSelec.titulo);
			$("#formRegistrar").find("textarea[name=descripcion_general]").val(alertaSelec.descripcion_general);
			$("#formRegistrar").find("select[name=nivel_peligro]").val(alertaSelec.nivel_peligro);
			$("#formRegistrar").find("select[name=tipo_aviso]").val(alertaSelec.tipo_aviso);
			$("#formRegistrar").find("input[name=fuente]").val(alertaSelec.fuente);
			$("#formRegistrar").find("input[name=fecha_inicio]").val(fechai[0]);
			$("#formRegistrar").find("input[name=hora_inicio]").val(fechai[1]);
			$("#formRegistrar").find("input[name=fecha_fin]").val(fechaf[0]);
			$("#formRegistrar").find("input[name=hora_fin]").val(fechaf[1]);
			$("#formRegistrar").find("input[name=enlace_url]").val(alertaSelec.enlace_url);
			$("#formRegistrar").find("input[name=id]").val(alertaSelec.id);

			$.ajax({
				url: URI + "eventos/eventos/filtrarAlertaPronosticoDetalle",
				method: "POST",
				data: {
					id: id
				},
				dataType: "json",
				beforeSend: function () {
					$("#modalCargaGeneral").css("display", "block");
				},
				success: function (data) {

					$.each(data.lista, function (i, e) {
						var evento = {
							Ubigeo: e.Ubigeo,
							Region: e.Region,
							Provincia: e.Provincia,
							Ubigeo: e.Ubigeo,
							codigo_departamento: e.codigo_departamento,
							codigo_provincia: e.codigo_provincia
						};
						listaEventos.push(evento);

					});
					armarTablaEventosSeleccionados(listaEventos);

					$("#modalCargaGeneral").css("display", "none");

				}
			});

		});

		$(".actionMap").on("click", function () {

			var id = $(this).attr("rel");
			$.ajax({
				url: URI + "eventos/eventos/filtrarSuperEventosDetallePorSuperEvento",
				method: "POST",
				data: {
					Super_Evento_Registro_ID: id
				},
				dataType: "json",
				beforeSend: function () {
					$("#modalCargaGeneral").css("display", "block");
				},
				success: function (data) {
					var marcadores = [];

					if (mapSuperEventosMarkers.length > 0) {
						mapSuperEventosMarkers[e.Evento_Registro_Numero].setMap(null);
					}

					$.each(data.lista, function (i, e) {

						var coordenadas = e.Evento_Coordenadas.split(",");
						var posicion = { "latitud": coordenadas[0], "longitud": coordenadas[1] };
						marcadores[i] = [{ id: e.Evento_Registro_Numero, posicion: posicion, nivel: e.Evento_Nivel_Codigo, tipo: e.Evento_Tipo_Codigo }];
					});

					cargarFull(0, marcadores);
					$("#modalCargaGeneral").css("display", "none");

				}
			});

			$("#mapModal").modal("show");

		});

		$('#btn-anular').on('click', function () {

			var id = $(this).find("label").attr("rel");

			$("#Tipo_Accion").val("3");

			$("#decisionModal #btn-decision").text("Anular");
			$("#decisionModal").modal("show");
			$("#decisionModal .modal-title").text("Anular Alerta");
			$("#decisionModal .modal-body p").html("Est\xe1 seguro de anular la Alerta");
		});

		$("#btn-cargar").on("click", function () {
			eventosSeleccionados = [];
			listaEventos = [];
			var id = $(this).find("label").attr("rel");

			$("#mapaModel").modal("show");

		});

		$('#btn-cerrar').on('click', function () {

			var id = $(this).find("label").attr("rel");

			$("#Tipo_Accion").val("2");

			$("#decisionModal #btn-decision").text("Cerrar Alerta");
			$("#decisionModal").modal("show");
			$("#decisionModal .modal-title").text("Cerrar Alerta");
			$("#decisionModal .modal-body p").html("Est\xe1 seguro de cerrar la Alerta");
		});

		$("#btn-decision").on("click", function () {

			var ta = $("#Tipo_Accion").val();

			switch (ta) {
				case "1": extornar(ta); break;
				case "2": cerrar(ta); break;
				case "3": anular(ta); break;
				case "4": cargar(ta); break;
			}

		});

	});

	$("#anio").on("change", function () {

		var anio = $("#anio").val();
		if (anio.length > 0) {

			post(URI + "eventos/alertasPronosticos", { anio });

		}

	});

	$("#formRegistrar select[name=tipo_aviso]").on("change", function () {
		var tipo_aviso = $("#tipo_aviso").val();
		console.log(tipo_aviso);
		if (tipo_aviso == 1) {
		}
		if (tipo_aviso == 0) {
		}

	});

}