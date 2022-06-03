function grandesEventos(URI) {

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
				html += '<tr><td>' + e.Numero + '</td>';
				html += '<td>' + e.TipoEvento + '</td>';
				html += '<td>' + e.Evento + '</td>';
				html += '<td>' + e.Ubigeo + '</td>';
				html += '<td rel="' + e.Evento_Registro_Numero + '"><i class="fa fa-trash" aria-hidden="true"></i></td></tr>';
			});
		}
		$("#tbEventosSeleccionados tbody").html(html);

	}

	function removerElemento(id) {

		var eventosSeleccionados = listaEventos.filter(elemento => elemento.Evento_Registro_Numero != id);

		if (!eventosSeleccionados) {
			eventosSeleccionados = [];
		}

		return eventosSeleccionados;
	}

	function agregarMarker(id, coordenadas) {

		var latLong = coordenadas.split(",");
		var stop = false;
		mapMarkers.forEach(function (e) {

			if (latLong[0] == e.position.lat() && latLong[1] == e.position.lng()) {

				stop = true;
			}

		});

		if (stop) {
			return false;
		}

		var marker = new google.maps.Marker({
			map: map,
			position: new google.maps.LatLng(latLong[0], latLong[1])
		});

		mapMarkers[id] = marker;

	}

	function getCoordenadasYzoom() {

		zoom = map.getZoom();

		mapMarkers.forEach(function (e) {
			coordenadas += "|" + e.position.lat() + "," + e.position.lng();
		});

	}

	function removerMarker(id) {
		mapMarkers[id].setMap(null);

		var temporalMarkers = [];
		if (mapMarkers && mapMarkers.length > 0) {
			mapMarkers.forEach(function (element, index, arra) {
				if (parseInt(index) !== parseInt(id)) {
					temporalMarkers[index] = mapMarkers[index];
				} else {
					mapMarkers[index].setMap(null);
				}
			});
			mapMarkers = temporalMarkers;

		}

	}

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

		var Super_Evento_Registro_ID = $("#btn-anular").find("label").attr("rel");
		Evento_Estado_Codigo = $("#Tipo_Accion").val();
		post(URI + "eventos/eventos/cambiarEstadoSuperEvento", {
			Evento_Estado_Codigo: Evento_Estado_Codigo,
			Super_Evento_Registro_ID: Super_Evento_Registro_ID
		});

	}

	$(document).ready(function () {

		var tbLista = $('#tbLista').DataTable({
			pageLength: 5,
			"paging": false,
			"bFilter": false,
			columns: [
				{ "data": "Numero" },
				{ "data": "TipoEvento" },
				{ "data": "Evento" },
				{ "data": "Ubigeo" },
				{ "data": "Coordenadas" },
				{ "data": "Evento_Registro_Numero" },
				{ "data": "status" }
			],
			columnDefs: [{
				"targets": [4, 5],
				"visible": false,
				"searchable": false
			}],
			"ajax": {
				url: URI + "eventos/eventos/filtroEventos",
				type: "POST",
				data: function (d) {
					d.departamento = document.getElementById("departamento").value,
						d.provincia = document.getElementById("provincia").value,
						d.distrito = document.getElementById("distrito").value,
						d.nivelEmergencia = document.getElementById("nivelEmergencia").value,
						d.tipoEvento = document.getElementById("tipoEvento").value,
						d.evento = document.getElementById("evento").value,
						d.desde = document.getElementById("desde").value,
						d.hasta = document.getElementById("hasta").value
				}
			}
		});

		$(".agregar").on("click", function () {
			removeAllMarker();
			removeAllSuperEventsMarker();
			$("#tbEventosSeleccionados tbody").html("");
			$("#formRegistrar")[0].reset();
			$("#registroModal").modal("show");

		});

		$(".date").datetimepicker({
			maxDate: moment()
		});

		$(".dateHour").datetimepicker({
			format: 'LT'
		});

		var table = $('.tbLista').DataTable({
			"lengthMenu": [[25, 50, 100, -1,], [25, 50, 100, "Todos"]],
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "titulo" },
				{ "data": "nombre" },
				{ "data": "fecha" },
				{ "data": "descripcion" },
				{ "data": "mapa" },
				{ "data": "estado" },
				{ "data": "id" },
				{ "data": "asc" },
				{ "data": "desc" }
			],
			columnDefs: [{
				"targets": [6, 7, 8],
				"visible": false,
				"searchable": false
			}],
			"order": [[0, "asc"], [1, "asc"]],
			buttons: [
				{
					extend: 'copy',
					title: 'lista Grandes Eventos',
					exportOptions: { columns: [0, 1, 2, 3] },
				},
				{
					extend: 'csv',
					title: 'lista Grandes Eventos',
					exportOptions: { columns: [0, 1, 2, 3] },
				},
				{
					extend: 'excel',
					title: 'lista Grandes Eventos',
					exportOptions: { columns: [0, 1, 2, 3] },
				},
				{
					extend: 'pdf',
					title: 'lista Grandes Eventos',
					orientation: 'landscape',
					exportOptions: { columns: [0, 1, 2, 3] },
				},

				{
					extend: 'print',
					title: 'lista Grandes Eventos',
					exportOptions: { columns: [0, 1, 2, 3] },
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
						$("#distrito").html('<option value="0">-- TODOS --</option>');
					},
					success: function (data) {

						var $html = '<option value="">-- Seleccione --</option>';
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

						var $html = '<option value="0">-- TODOS --</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="' + e.Codigo_Distrito + '">' + e.Nombre + '</option>';

						});
						$("#distrito").html($html);

					}
				});

			}
		});

		$("#tipoEvento").change(function () {

			id = $(this).val();

			if (id.length > 0) {

				$.ajax({
					data: {
						tipoEvento: id
					},
					url: URI
						+ "eventos/eventos/cargarEvento",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#evento")
							.html(
								'<option value="">Cargando...</option>');
					},
					success: function (
						data) {

						var $html = '<option value="0">-- TODOS --</option>';
						$.each(data.lista, function (i, e) {

							$html += '<option value="' + e.Evento_Codigo + '">' + e.Evento_Nombre + '</option>';

						});
						$("#evento").html($html);

					}
				});

			}

		});
		$("#formBuscarEventos").validate({
			rules: {
				departamento: { required: true },
				provincia: { required: true },
				distrito: { required: true },
				nivelEmergencia: { required: false },
				tipoEvento: { required: false },
				evento: { required: false },
				desde: { required: true },
				hasta: { required: true }
			},
			messages: {
				departamento: {
					required: "(*) Campo Requerido"
				},
				provincia: {
					required: "(*) Campo Requerido"
				},
				distrito: {
					required: "(*) Campo Requerido"
				},
				desde: {
					required: "(*) Campo Requerido"
				},
				hasta: {
					required: "(*) Campo Requerido"
				}
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				var desde = $("#desde").val();
				var hasta = $("#hasta").val();

				if (desde.length != 10 || hasta.length != 10) {
					$("#alertaModal").modal("show");
					$("#alertaModal #tituloalerta").text("Error");
					$("#alertaModal #mensajealerta").html("Verifique las fechas");
					return false;

				} else {
					$("#activar").val(1);
				}

				$("#formBuscarEventos button[type=submit]").text("Agregando...").addClass("disabled");

				tbLista.ajax.reload(function () {
					$("#formBuscarEventos button[type=submit]").text("Buscar").removeClass("disabled");
				});
				tbLista.draw();

			}
		});
		$("#formRegistrar").validate({
			rules: {
				Super_Evento_Registro_Titulo: { required: true },
				Super_Evento_Registro_Nombre: { required: true },
				Super_Evento_Registro_Descripcion: { required: true }
			},
			messages: {
				Super_Evento_Registro_Titulo: {
					required: "(*) Campo Requerido"
				},
				Super_Evento_Registro_Nombre: {
					required: "(*) Campo Requerido"
				},
				Super_Evento_Registro_Descripcion: {
					required: "(*) Campo Requerido"
				}
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				if (listaEventos.length == 0) {
					return false;
				}

				getCoordenadasYzoom();

				var Super_Evento_Registro_Titulo = $("#formRegistrar").find("input[name=Super_Evento_Registro_Titulo]").val();
				var Super_Evento_Registro_Nombre = $("#formRegistrar").find("input[name=Super_Evento_Registro_Nombre]").val();
				var fecha = $("#formRegistrar").find("input[name=fecha]").val();
				var hora = $("#formRegistrar").find("input[name=hora]").val();
				var Super_Evento_Registro_Descripcion = $("#formRegistrar").find("textarea[name=Super_Evento_Registro_Descripcion]").val();
				var id = $("#formRegistrar").find("input[name=id]").val();

				var eventos = '';

				$.each(listaEventos, function (i, e) {

					if (i == 0) {
						eventos += e.Evento_Registro_Numero;
					} else {
						eventos += "|" + e.Evento_Registro_Numero;
					}

				});

				$.ajax({
					url: URI + "eventos/eventos/grandesEventosRegistrar",
					method: "POST",
					data: {
						Super_Evento_Registro_Titulo: Super_Evento_Registro_Titulo,
						Super_Evento_Registro_Nombre: Super_Evento_Registro_Nombre,
						fecha: fecha,
						hora: hora,
						Super_Evento_Registro_Descripcion: Super_Evento_Registro_Descripcion,
						eventos: eventos,
						zoom: zoom,
						coordenadas: coordenadas,
						latitud: map.getCenter().lat(),
						longitud: map.getCenter().lng(),
						id: id

					},
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

		$('#tbLista').on('click', 'tbody tr td', function () {

			var tr = $(this).parents('tr');
			var row = tbLista.row(tr);

			var index = row.index();
			var datos = row.data();

			listaEventos = removerElemento(datos.Evento_Registro_Numero);
			listaEventos.push(datos);
			console.log(datos.Evento_Registro_Numero, datos.Coordenadas);
			agregarMarker(datos.Evento_Registro_Numero, datos.Coordenadas);

			armarTablaEventosSeleccionados(listaEventos);

		});

		$('body').on('click', 'i.fa-trash', function () {

			var Evento_Registro_Numero = $(this).parents("td").attr("rel");

			listaEventos = removerElemento(Evento_Registro_Numero);
			armarTablaEventosSeleccionados(listaEventos);
			removerMarker(Evento_Registro_Numero);

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
			$("#btn-exportar").find("label").attr("rel", id);

			$("#btn-editar").removeClass("editar");
			$("#btn-anular").removeClass("anular");
			$("#btn-exportar").removeClass("exportar");

			$("#btn-editar").addClass("editar");
			$("#btn-anular").addClass("anular");
			$("#btn-exportar").addClass("exportar");

			superEvento = data;

			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}

			var informeInicial = data.asc;

			$("#aInformeInicial").attr("href", URI + "eventos/eventos/informesuperevento/=" + informeInicial);

		});

		$("#btn-editar").on("click", function () {
			removeAllMarker();
			removeAllSuperEventsMarker();
			eventosSeleccionados = [];
			listaEventos = [];
			$("#tbEventosSeleccionados tbody").html("");

			var Super_Evento_Registro_ID = $(this).find("label").attr("rel");

			$("#registroModal").modal("show");

			var fecha = (superEvento.fecha).split(" ");

			$("#formRegistrar").find("input[name=Super_Evento_Registro_Titulo]").val(superEvento.titulo);
			$("#formRegistrar").find("input[name=Super_Evento_Registro_Nombre]").val(superEvento.nombre);
			$("#formRegistrar").find("input[name=fecha]").val(fecha[0]);
			$("#formRegistrar").find("input[name=hora]").val(fecha[1]);
			$("#formRegistrar").find("textarea[name=Super_Evento_Registro_Descripcion]").val(superEvento.descripcion);
			$("#formRegistrar").find("input[name=id]").val(Super_Evento_Registro_ID);

			$.ajax({
				url: URI + "eventos/eventos/filtrarSuperEventosDetallePorSuperEvento",
				method: "POST",
				data: {
					Super_Evento_Registro_ID: Super_Evento_Registro_ID
				},
				dataType: "json",
				beforeSend: function () {
					$("#modalCargaGeneral").css("display", "block");
				},
				success: function (data) {

					$.each(data.lista, function (i, e) {
						var evento = { Numero: e.Evento_Registro_Numero, TipoEvento: e.eventoDetalle, Evento: e.evento, Ubigeo: e.ubigeo, Evento_Registro_Numero: e.Evento_Registro_Numero };
						listaEventos.push(evento);
						agregarMarker(e.Evento_Registro_Numero, e.Evento_Coordenadas);
					});
					armarTablaEventosSeleccionados(listaEventos);

					$("#modalCargaGeneral").css("display", "none");

				}
			});

		});

		$(".actionMap").on("click", function () {

			var id = $(this).attr("rel");

			removeAllSuperEventsMarker();

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

			var Evento_Registro_Numero = $(this).find("label").attr("rel");

			$("#Tipo_Accion").val("3");

			$("#decisionModal #btn-decision").text("Anular");
			$("#decisionModal").modal("show");
			$("#decisionModal .modal-title").text("Anular Super Evento");
			$("#decisionModal .modal-body p").html("Est\xe1 seguro de anular el super evento");
		});

		$("#btn-decision").on("click", function () {

			var ta = $("#Tipo_Accion").val();

			switch (ta) {
				case "1": extornar(ta); break;
				case "2": cerrar(ta); break;
				case "3": anular(ta); break;
			}

		});

	});
}