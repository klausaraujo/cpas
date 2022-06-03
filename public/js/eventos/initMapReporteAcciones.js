$.each(registros, function (i, e) {

	var coordenadas = e.Evento_Coordenadas.split(",");
	var posicion = { "latitud": coordenadas[0], "longitud": coordenadas[1] };
	marcadores[i] = [{ id: e.Evento_Registro_Numero, posicion: posicion, tipo: e.Evento_Tipo_Codigo, nivel: e.Evento_Nivel_Codigo, brigadistas: e.brigadistas, EMT: e.EMT, PersonalSalud: e.PersonalSalud, ambulancias: e.ambulancias, medicamentos: e.medicamentos }];

});

var escAncho = screen.width;
var escAlto = screen.height;

var escala = 6;

if (escAncho == 1920 && escAlto == 1080) var escala = 6;
if (escAncho == 1680 && escAlto == 1050) var escala = 6;
if (escAncho == 1600 && escAlto == 900) var escala = 6;
if (escAncho == 1440 && escAlto == 900) var escala = 6;
if (escAncho == 1400 && escAlto == 1050) var escala = 6;
if (escAncho == 1360 && escAlto == 768) var escala = 5;
if (escAncho == 1280 && escAlto == 1024) var escala = 6;
if (escAncho == 1024 && escAlto == 768) var escala = 5;
if (escAncho == 800 && escAlto == 600) var escala = 5;

var map;
var mapMarkers = new Array();
var mapMarkersFullPolygon = new Array();
var djperu;

var polygonFill = ["#4CAF50", "#f3eb2c", "#ee2cf3", "#2c3ef3", "#2cacf3",
	"#2cf3de", "#2cf367", "#f32c2c", "#f3a12c", "#f36a2c", "#a7694d",
	"#60a74d", "#4d9ca7", "#4d55a7", "#834da7", "#a74d84", "#a74d4d",
	"#fba1a1", "#fbc5a1", "#a1f8fb", "#a1b5fb", "#e0a1fb", "#8e1010",
	"#bfd20f", "#fba1a1"];

function polyBorderColor(x, val, estado) {
	var color = '#AD4545';
	var anchoBorde = 1;
	var borde = 2;
	var colorFondo = '#FFF';
	var opacidad = 0;
	var numOpacity = 0.4;
	switch (x) {
		case 1:
			if (val == 6 || val == 42) {
				colorFondo = '#F0CEBC';
				color = '#F09291';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 2:
			if (val == 32) {
				colorFondo = '#92F5BC';
				color = '#37D791';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 3:
			if (val == 32) {
				colorFondo = '#D8C0F1';
				color = '#C294CA';
				opacidad = numOpacity
			}
			break;
		case 4:
			if (val == 32) {
				colorFondo = '#92F5BC';
				color = '#37D791';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 5:
			if (val == 5 || val == 32) {
				colorFondo = '#C1C0EB';
				color = '#9594ED';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 6:
			if (val == 6 || val == 32) {
				colorFondo = '#F4EE90';
				color = '#EFEC3E';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 7:
			break;
		case 8:
			if (val == 5 || val == 9 || val == 14 || val == 25 || val == 28 || val == 32 || val == 46) {
				colorFondo = '#96A989';
				color = '#426932';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 9:
			if (val == 32) {
				colorFondo = '#CCC';
				color = '#424242';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 10:
			if (val == 5 || val == 19 || val == 32 || val == 37 || val == 45) {
				colorFondo = '#89BB94';
				color = '#529A6C';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 11:
			break;
		case 12:
			if (val == 5 || val == 32 || val == 9 || val == 29 || val == 45) {
				colorFondo = '#C1C0C7';
				color = '#9392A8';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 13:
			break;
		case 14:
			if (val == 32) {
				colorFondo = '#CCC';
				color = '#424242';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 15:
			if (val == 10 || val == 18 || val == 32) {
				colorFondo = '#969CEA';
				color = '#4250EE';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 16:
			if (val == 1 || val == 4 || val == 6 || val == 7 || val == 8 || val == 11 || val == 16 || val == 20 || val == 22
				|| val == 23 || val == 24 || val == 26 || val == 27 || val == 30 || val == 31 || val == 33 || val == 34
				|| val == 36 || val == 37 || val == 38 || val == 39 || val == 40 || val == 41 || val == 42 || val == 43 || val == 46) {
				colorFondo = '#92C7BC';
				color = '#3CE293';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 17:
			if (val == 2 || val == 3 || val == 13 || val == 14 || val == 15 || val == 25 || val == 37 || val == 46) {
				colorFondo = '#F0EF94';
				color = '#F0EF43';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 18:
			if (val == 2 || val == 32) {
				colorFondo = '#F0C0F1';
				color = '#F093FA';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 19:
			if (val == 5 || val == 32 || val == 45) {
				colorFondo = '#C191BC';
				color = '#933691';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 20:
			break;
		case 21:
			if (val == 2 || val == 32) {
				colorFondo = '#F0EF94';
				color = '#F0EF43';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 22:
			if (val == 8 || val == 6 || val == 36) {
				colorFondo = '#D3A894';
				color = '#B86342';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 23:
			if (val == 2) {
				colorFondo = '#CCC';
				color = '#424242';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 24:
			break;
		case 25:
			if (val == 3 || val == 5 || val == 12 || val == 17 || val == 19 || val == 21 || val == 35 || val == 37 || val == 44 || val == 46 || val == 47) {
				colorFondo = '#E48D90';
				color = '#D85942';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
	}
	color = '#AD4545';
	if (estado == 'fondo')
		return colorFondo;
	if (estado == 'color')
		return color;
	if (estado == 'opacity')
		return opacidad;
	if (estado == 'borde')
		return anchoBorde;

}

function cargarPoligonos(val) {

	cont = 0;
	for (x = 1; x <= 25; x++) {
		var coordenadas_peru = djperu[x].coord;
		var ubicacion = djperu[x].desc;
		var departamento = djperu[x].id;

		for (i = 0; i < coordenadas_peru.length; i++) {

			var polydj = new google.maps.Polygon({
				paths: coordenadas_peru[i],
				fillColor: polygonFill[x - 1],
				fillOpacity: 0.35,
				strokeColor: polyBorderColor(x, val, 'color'),
				strokeOpacity: 1,
				strokeWeight: polyBorderColor(x, val, 'borde'),
				visible: true,
				clickable: true
			});

			polydj.setMap(map);
			mapMarkersFullPolygon[cont] = polydj;
			cont++;

		}
	}
}

function cargarFull(val, marcadores) {
	cont = 0;

	if (val == 0) {
		ini = 1;
		fin = 20;
	} else {
		ini = val;
		fin = val;
	}

	if (marcadores === undefined || marcadores === null) {
		return false;
	}

	for (x = 0; x < marcadores.length; x++) {

		for (var i = 0, j = marcadores[x].length; i < j; i++) {

			var tipo = marcadores[x][i].tipo;
			var icono = "";

			switch (tipo) {
				case "01": icono = URI_MAP + "public/map/natural.png"; break;
				case "02": icono = URI_MAP + "public/map/antropico.png"; break;
				case "03": icono = URI_MAP + "public/map/sanitario.png"; break;
			}

			var icon = {
				url: icono,
				scaledSize: new google.maps.Size(32, 32),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(0, 0)
			};

			if (val == 0)
				var anime = google.maps.Animation.DROP;
			else
				var anime = '';

			var marker = new google.maps.Marker({
				animation: anime,
				position: new google.maps.LatLng(
					marcadores[x][i].posicion.latitud,
					marcadores[x][i].posicion.longitud),
				map: map,
				scaledSize: new google.maps.Size(20, 20),
				icon: icon
			});

			mapMarkers[i] = marker;
			cont++;
			var marcador = marcadores[x][i];
			if (val == 0) {
				(function (marcador, i) {
					google.maps.event.addListener(marker, "click", function () {
						var scope = this;
						var iw = new google.maps.InfoWindow();
						html = infoWindowContent(marcador);
						iw.setContent(html);
						iw.open(map, scope);
					});
				})(marcador, i);
			}
		}

	}

}

function infoWindowContent(data) {
	$("#Evento_Registro_Numero").val(data.id);
	html = '<div class="bg-white pa-10 infoWindow">';
	html += '<div class="col-sm-12 div_element"><p><img class="img_icon" src="' + URI_MAP + 'public/images/iconos/icon_brigadistas.png" /><span>Brigadistas</span></p><span>' + data.brigadistas + '</span></div>';
	html += '<div class="col-sm-12 div_element"><p><img class="img_icon" src="' + URI_MAP + 'public/images/iconos/icon_emt.png" /><span>EMT</span></p><span>' + data.EMT + '</span></div>';
	html += '<div class="col-sm-12 div_element"><p><img class="img_icon" src="' + URI_MAP + 'public/images/iconos/icon_personal_salud.png" /><span>Personal Salud</span></p><span>' + data.PersonalSalud + '</span></div>';
	html += '<div class="col-sm-12 div_element"><p><img class="img_icon" src="' + URI_MAP + 'public/images/iconos/icon_ambulancias.png" /><span>Ambulancias</span></p><span>' + data.ambulancias + '</span></div>';
	html += '<div class="col-sm-12 div_element"><p><img class="img_icon" src="' + URI_MAP + 'public/images/iconos/icon_medicamentos_insumos.png" /><span>Medicamentos</span></p><span>' + data.medicamentos + '</span></div>';
	html += '<div class="col-sm-12" style="padding: 0;"><hr /></div>';
	html += '<div class="col-sm-12 text-center"><a class="verDetalleAcciones" rel="' + data.id + '" href="javascript:;">Detalle de acciones</a></div>';
	html += '</div>';
	return html;
}

var lat = -9.318990;
var lon = -75.234375;

function initMap(marcadores) {
	var vlat = lat;
	var vlon = lon;
	var vesc = escala;
	initialize(vlat, vlon, vesc, 0, marcadores);

}

function initialize(lat, lon, esc, val, marcadores) {

	var peru = new google.maps.LatLng(lat, lon);

	var mapDiv = document.getElementById('divMap');
	map = new google.maps.Map(mapDiv, {
		center: peru,
		zoom: esc,
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

	var strictBounds = new google.maps.LatLngBounds(new google.maps.LatLng(
		-18.309, -81.342), new google.maps.LatLng(-0.08, -68.704));

	var control = document.getElementById('floating-panel');
	control.style.display = 'block';
	map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(control);

	google.maps.event
		.addListener(
			map,
			'dragend',
			function () {
				if (strictBounds.contains(map.getCenter()))
					return;

				var c = map.getCenter(), x = c.lng(), y = c.lat(), maxX = strictBounds
					.getNorthEast().lng(), maxY = strictBounds
						.getNorthEast().lat(), minX = strictBounds
							.getSouthWest().lng(), minY = strictBounds
								.getSouthWest().lat();

				if (x < minX) x = minX;
				if (x > maxX) x = maxX;
				if (y < minY) y = minY;
				if (y > maxY) y = maxY;

				map.setCenter(new google.maps.LatLng(y, x));
			});

	cargarFull(val, marcadores);
	cargarPoligonos(val);

}

initMap(marcadores);

var tbDetalleAcciones = $("#tbDetalleAcciones").DataTable({

	"pageLength": 5,
	"bLengthChange": false,
	columns: [
		{
			"className": 'details-control',
			"orderable": false,
			"data": null,
			"defaultContent": ''
		},
		{ "data": "Tipo_Accion_Descripcion" },
		{ "data": "Tipo_Accion_Entidad_Nombre" },
		{ "data": "Evento_Acciones_Descripcion" },
		{ "data": "Evento_Acciones_Fecha" },
		{ "data": "brigadistas" },
		{ "data": "EMT" },
		{ "data": "PersonalSalud" },
		{ "data": "ambulancias" },
		{ "data": "medicamentos" },
		{ "data": "Evento_Acciones_Numero" }
	],
	columnDefs: [{
		"targets": [5, 6, 7, 8, 9, 10],
		"visible": false,
		"searchable": false
	}],
	"ajax": {
		url: URI_MAP + "eventos/reportes/mapaAccionesDetalle",
		type: "POST",
		data: function (d) {
			d.Evento_Registro_Numero = document.getElementById("Evento_Registro_Numero").value
		}
	},
	"order": [[10, "asc"]]
});

$('tbody').on('click', 'td.details-control', function () {
	var tr = $(this).closest('tr');
	var row = tbDetalleAcciones.row(tr);

	if (row.child.isShown()) {
		row.child.hide();
		tr.removeClass('shown');
	}
	else {
		row.child(format(row.data())).show();
		tr.addClass('shown');
	}
});

function format(d) {

	html = '<div class="col-xs-12 dataTable_acciones">';
	html += '<div class="col-sm-12 div_element"><p><img class="img_icon" src="' + URI_MAP + 'public/images/iconos/icon_brigadistas.png" /><span>Brigadistas</span></p><span>' + d.brigadistas + '</span></div>';
	html += '<div class="col-sm-12 div_element"><p><img class="img_icon" src="' + URI_MAP + 'public/images/iconos/icon_emt.png" /><span>EMT</span></p><span>' + d.EMT + '</span></div>';
	html += '<div class="col-sm-12 div_element"><p><img class="img_icon" src="' + URI_MAP + 'public/images/iconos/icon_personal_salud.png" /><span>Personal Salud</span></p><span>' + d.PersonalSalud + '</span></div>';
	html += '<div class="col-sm-12 div_element"><p><img class="img_icon" src="' + URI_MAP + 'public/images/iconos/icon_ambulancias.png" /><span>Ambulancias</span></p><span>' + d.ambulancias + '</span></div>';
	html += '<div class="col-sm-12 div_element"><p><img class="img_icon" src="' + URI_MAP + 'public/images/iconos/icon_medicamentos_insumos.png" /><span>Medicamentos</span></p><span>' + d.medicamentos + '</span></div>';
	html += '</div>';
	return html;
}

$("html").on("click", ".verDetalleAcciones", function () {
	$("#dataMapModal").modal("show");
	tbDetalleAcciones.clear().draw();
	tbDetalleAcciones.ajax.reload();
});