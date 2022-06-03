

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

	$(".agregar").on("click", function () {

		location.href = URI + "eventos/nuevo";

	});

	var table = $('.tbLista').DataTable({
		"lengthMenu": [[25, 50, 100, -1,], [25, 50, 100, "Todos"]],
		dom: '<"html5buttons"B>lTfgitp',

		columns: [
			{ "data": "correlativo" },
			{ "data": "evento" },
			{ "data": "fecha" },
			{ "data": "ubicacion" },
			{ "data": "nivel" },
			{ "data": "danios" },
			{ "data": "mapa" },
			{ "data": "imagen" },
			{ "data": "asignacion" },
			{ "data": "Estado_Codigo" },
			{ "data": "Evento_Registro_Numero" },
			{ "data": "Evento_Estado_Codigo" },
			{ "data": "orden" },
			{ "data": "Evento_Coordenadas" },
			{ "data": "orden_asc" },
			{ "data": "orden_desc" },
			{ "data": "danios_h" },
			{ "data": "lesionados" },
			{ "data": "acciones" },
			{ "data": "eess" },
			{ "data": "estado" }
		],
		columnDefs: [{
			"targets": [7, 8, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20],
			"visible": false,
			"searchable": false
		}],
		"order": [[11, "asc"]],

		buttons: [
			{
				extend: 'copy',
				title: 'lista-Eventos',
				exportOptions: { columns: [0, 1, 2, 3, 4, 16, 17, 18, 19, 20] },
			},
			{
				extend: 'csv',
				title: 'lista Eventos',
				exportOptions: { columns: [0, 1, 2, 3, 4, 16, 17, 18, 19, 20] },
			},
			{
				extend: 'excel',
				title: 'lista Eventos',
				exportOptions: { columns: [0, 1, 2, 3, 4, 16, 17, 18, 19, 20] },
			},
			{
				extend: 'pdf',
				title: 'lista Eventos',
				orientation: 'landscape',
				exportOptions: { columns: [0, 1, 2, 3, 4, 16, 17, 18, 19, 20] },
			},

			{
				extend: 'print',
				title: 'lista Eventos',
				exportOptions: { columns: [0, 1, 2, 3, 4, 16, 17, 18, 19, 20] },
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
			}/*,
				{
				  extend:    'pageLength',
				  titleAttr: 'Registros a mostrar',
				  className: 'selectTable'
				}*/
		]
	});

	$('body').on('click', 'td i.addDanios', function () {
		var tr = $(this).parents('tr');
		var row = table.row(tr);

		index = row.index();
		data = row.data();

		post(URI + "eventos/eventos/danios",
			{
				Evento_Registro_Numero: data.Evento_Registro_Numero
			});

	});

	$('body').on('click', 'td i.addLesionados', function () {
		var tr = $(this).parents('tr');
		var row = table.row(tr);

		index = row.index();
		data = row.data();

		post(URI + "eventos/eventos/lesionados", { Evento_Registro_Numero: data.Evento_Registro_Numero });

	});

	$('body').on('click', 'td i.addAcciones',
		function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			data = row.data();

			post(URI + "eventos/eventos/acciones", { Evento_Registro_Numero: data.Evento_Registro_Numero });

		});

	$('body').on('click', 'td i.addEESS', function () {
		var tr = $(this).parents('tr');
		var row = table.row(tr);

		index = row.index();
		data = row.data();

		post(URI + "eventos/eventos/entidadSalud", { Evento_Registro_Numero: data.Evento_Registro_Numero });

	});

	$('body').on('click', 'td i.addPhotos', function () {
		var tr = $(this).parents('tr');
		var row = table.row(tr);

		index = row.index();
		data = row.data();

		post(URI + "eventos/eventos/imagenes", { Evento_Registro_Numero: data.Evento_Registro_Numero });

	});

	$('body').on('click', '.tbLista tr', function () {
		$("#Tipo_Accion").val("");

		var tr = $(this);
		var row = table.row(tr);

		index = row.index();

		data = row.data();
		var estado = data.Evento_Estado_Codigo;
		var id = data.Evento_Registro_Numero;
		var informeInicial = data.orden_asc;
		var informeFinal = data.orden_desc;

		$("#btn-editar").removeClass("editar");
		$("#btn-extornar").removeClass("extornar");
		$("#btn-exportar").addClass("exportar");
		$("#btn-cerrar").removeClass("cerrar");
		$("#btn-anular").removeClass("anular");
		$("#btn-exportar a").attr("href", "");
		$("#btn-ficha").removeClass("ficha");
		$("#btn-oferta-movil").removeClass("oferta-movil");
		$("#btn-eliminar").removeClass("eliminar");
		$("#btn-restaurar").removeClass("restaurar");
		if (estado == '3') {
			$("#btn-eliminar").addClass("eliminar");
			$("#btn-restaurar").addClass("restaurar");
		}

		if (estado == '1') {
			$("#btn-editar").addClass("editar");
			$("#btn-exportar").addClass("exportar");
			$("#btn-cerrar").addClass("cerrar");
			$("#btn-anular").addClass("anular");
			$("#btn-ficha").addClass("ficha");
			$("#btn-oferta-movil").addClass("oferta-movil");

		}

		$("#aInformeInicial").attr("href", URI + "eventos/eventos/informe/=" + informeInicial);
		$("#aInformeFinal").attr("href", URI + "eventos/eventos/informe/=" + informeFinal);

		if (estado == '2')
			$("#btn-extornar").addClass("extornar");

		$("#btn-editar").find("label").attr("rel", id);
		$("#btn-extornar").find("label").attr("rel", id);
		$("#btn-exportar").find("label").attr("rel", id);
		$("#btn-eliminar").find("label").attr("rel", id);
		$("#btn-restaurar").find("label").attr("rel", id);
		$("#btn-cerrar").find("label").attr("rel", id);
		$("#btn-anular").find("label").attr("rel", id);
		$("#btn-ficha").find("label").attr("rel", id);
		$("#btn-oferta-movil").find("label").attr("rel", id);

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

	$("#btn-eliminar").on("click", function (e) {
		e.preventDefault();
		var Evento_Registro_Numero = $(this).find("label").attr("rel");
		console.log('here eliminar', { Evento_Registro_Numero })

		$("#Tipo_Accion").val("4");

		$("#decisionModal #btn-decision").text("Eliminar");
		$("#decisionModal").modal("show");
		$("#decisionModal .modal-title").text("Eliminar Evento");
		$("#decisionModal .modal-body p").html("Est\xe1 seguro de querer eliminar el evento");
	});

	$("#btn-restaurar").on("click", function (e) {
		var Evento_Registro_Numero = $(this).find("label").attr("rel");
		console.log('here restaurar', { Evento_Registro_Numero })

		$("#Tipo_Accion").val("5");

		$("#decisionModal #btn-decision").text("Restaurar");
		$("#decisionModal").modal("show");
		$("#decisionModal .modal-title").text("Restaurar Evento");
		$("#decisionModal .modal-body p").html("Est\xe1 seguro de querer restaurar el evento");
	});

	$('#btn-editar').on('click', function () {

		var Evento_Registro_Numero = $(this).find("label").attr("rel");
		post(URI + "eventos/eventos/editar", { Evento_Registro_Numero: Evento_Registro_Numero });
	});

	$('#btn-extornar').on('click', function () {

		var Evento_Registro_Numero = $(this).find("label").attr("rel");

		$("#Tipo_Accion").val("1");

		$("#decisionModal #btn-decision").text("Extornar");
		$("#decisionModal").modal("show");
		$("#decisionModal .modal-title").text("Extornar Evento");
		$("#decisionModal .modal-body p").html("Est\xe1 seguro de querer extornar el evento");
	});

	$('#btn-cerrar').on('click', function () {

		var Evento_Registro_Numero = $(this).find("label").attr("rel");

		$("#Tipo_Accion").val("2");

		$("#decisionModal #btn-decision").text("Cerrar");
		$("#decisionModal").modal("show");
		$("#decisionModal .modal-title").text("Cerrar Evento");
		$("#decisionModal .modal-body p").html("Est\xe1 seguro de querer cerrar el evento");
	});

	$('#btn-anular').on('click', function () {

		var Evento_Registro_Numero = $(this).find("label").attr("rel");

		$("#Tipo_Accion").val("3");

		$("#decisionModal #btn-decision").text("Anular");
		$("#decisionModal").modal("show");
		$("#decisionModal .modal-title").text("Anular Evento");
		$("#decisionModal .modal-body p").html("Est\xe1 seguro de anular el evento");
	});

	$("#btn-decision").on("click", function () {

		var ta = $("#Tipo_Accion").val();

		switch (ta) {
			case "1": extornar(ta); break;
			case "2": cerrar(ta); break;
			case "3": anular(ta); break;
			case "4": eliminar(ta); break;
			case "5": restaurar(ta); break;
		}

	});

	$('#btn-ficha').on('click', function () {

		var Evento_Registro_Numero = $(this).find("label").attr("rel");
		post(URI + "eventos/fichas/lista", { Evento_Registro_Numero: Evento_Registro_Numero });
	});

	$('#btn-grandes-eventos').on('click', function () {
		location.href = URI + "eventos/grandes-eventos";
	});

	$('#btn-alertas-pronos').on('click', function () {
		location.href = URI + "eventos/alertasPronosticos";
	});

	$("html").on("click", ".actionMap", function () {

		var centro = $(this).attr("rel");
		centro = centro.split(",");
		var punto = new google.maps.LatLng(centro[0], centro[1]);

		$("#mapModal").modal("show");
		console.log("punto: " + punto);
		var mapDiv = document.getElementById('map');
		map = new google.maps.Map(mapDiv, {
			center: punto,
			zoom: 12,
			mapTypeId: google.maps.MapTypeId.TERRAIN,
			minZoom: 6,
			scrollwheel: true,
			disableDefaultUI: false,
			streetViewControl: false,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,

			},
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL
			}

		});

		var marker = new google.maps.Marker({
			map: map,
			anchorPoint: new google.maps.Point(0, -29),
			draggable: false,
			position: new google.maps.LatLng(centro[0], centro[1])
		});
	});

	$('body').on('click', 'td i.addAsignacion', function () {

		var tr = $(this).parents('tr');
		var row = table.row(tr);

		index = row.index();
		datos = row.data();
		cargarAddAsignacion(datos.Evento_Registro_Numero);

	});

});

function extornar(Evento_Estado_Codigo) {

	var Evento_Registro_Numero = $("#btn-extornar").find("label").attr(
		"rel");

	post(URI + "eventos/eventos/cambiarEstado", {
		Evento_Estado_Codigo: Evento_Estado_Codigo,
		Evento_Registro_Numero: Evento_Registro_Numero
	});

}

function cerrar(Evento_Estado_Codigo) {

	var Evento_Registro_Numero = $("#btn-extornar").find("label").attr(
		"rel");

	post(URI + "eventos/eventos/cambiarEstado", {
		Evento_Estado_Codigo: Evento_Estado_Codigo,
		Evento_Registro_Numero: Evento_Registro_Numero
	});

}

function anular(Evento_Estado_Codigo) {

	var Evento_Registro_Numero = $("#btn-extornar").find("label").attr(
		"rel");

	post(URI + "eventos/eventos/cambiarEstado", {
		Evento_Estado_Codigo: Evento_Estado_Codigo,
		Evento_Registro_Numero: Evento_Registro_Numero
	});

}

function eliminar(Evento_Estado_Codigo) {

	var Evento_Registro_Numero = $("#btn-eliminar").find("label").attr(
		"rel");

	post(URI + "eventos/eventos/modificarEvento", {
		Evento_Estado_Codigo: Evento_Estado_Codigo,
		Evento_Registro_Numero: Evento_Registro_Numero
	});

}

function restaurar(Evento_Estado_Codigo) {

	var Evento_Registro_Numero = $("#btn-restaurar").find("label").attr(
		"rel");

	post(URI + "eventos/eventos/cambiarEstado", {
		Evento_Estado_Codigo: 1,
		Evento_Registro_Numero: Evento_Registro_Numero
	});

}

$("#anio, #mes").on("change", function () {

	var anio = $("#anio").val();
	var mes = $("#mes").val();

	if (anio.length > 0 && mes.length > 0) {

		post(URI + "eventos/lista", { anio, mes });

	}

});
