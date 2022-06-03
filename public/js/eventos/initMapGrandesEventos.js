marcadores = null;
var map;
var mapSupereventos;
var mapMarkers = new Array();
var mapSuperEventosMarkers = new Array();

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

function setMapOnAll(map) {
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	}
}

function clearMarkers() {
	setMapOnAll(null);
}

function cargarFullMapMarker(val, marcadores) {

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

		if (val == 0)
			var anime = google.maps.Animation.DROP;
		else
			var anime = '';

		mapMarkers[x] = new google.maps.Marker({
			animation: anime,
			position: new google.maps.LatLng(
				marcadores[x][0].posicion.latitud,
				marcadores[x][0].posicion.longitud),
			map: map,
			scaledSize: new google.maps.Size(20, 20)
		});

		cont++;

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

		if (val == 0)
			var anime = google.maps.Animation.DROP;
		else
			var anime = '';

		mapSuperEventosMarkers[x] = new google.maps.Marker({
			animation: anime,
			position: new google.maps.LatLng(
				marcadores[x][0].posicion.latitud,
				marcadores[x][0].posicion.longitud),
			map: mapSupereventos,
			scaledSize: new google.maps.Size(20, 20)
		});

		cont++;
		var marcador = marcadores[x][0];

		if (val == 0) {
			(function (marcador, i) {
				google.maps.event.addListener(mapSuperEventosMarkers[x], "click", function () {

					var scope = this;
					var iw = new google.maps.InfoWindow();
					$.ajax({
						url: URI_MAP + 'eventos/reportes/infoWindowEventos',
						data: {
							id: marcador.id,
							estado: "1"
						},
						method: "post",
						dataType: "json",
						success: function (data) {
							html = infoWindowContent(data);
							iw.setContent(html);
							iw.open(map, scope);
						}
					});
				});
			})(marcador, 0);
		}

	}

}

function infoWindowContent(data) {

	html = '<div class="bg-white pa-20">';
	html += '<h4>DATOS DEL EVENTO</h4>';
	html += '<ul>';
	html += '<li><strong>Tipo de Evento:</strong> ' + data.eventoTipo + '</li>';
	html += '<li><strong>Evento:</strong> ' + data.evento + '</li>';
	html += '<li><strong>Detalle del Evento:</strong> ' + data.eventoDetalle + '</li>';
	html += '<li><strong>Fecha:</strong> ' + data.fecha + '</li>';
	html += '<li><strong>Lugar:</strong> ' + data.Evento_Ubigeo_Descripcion + '</li>';
	html += '<li><strong>Descripción:</strong> ' + data.Evento_Descripcion + '</li>';
	html += '</ul>';
	html += '</div>';
	return html;

}

var lat = -9.318990;
var lon = -75.234375;

function initMap(elementMapName, marcadores) {
	initialize('map', lat, lon, escala, 0, marcadores);
}

function initialize(elementMapName, lat, lon, esc, val, marcadores) {

	var peru = new google.maps.LatLng(lat, lon);

	var mapDiv = document.getElementById(elementMapName);

	if (elementMapName == 'map') {
		map = createMap(mapDiv, peru, esc);
		cargarFullMapMarker(val, marcadores);
		strictBounds(map);
	} else {
		mapSupereventos = createMap(mapDiv, peru, esc);
		strictBounds(mapSupereventos);
	}
}

function createMap(divOfMap, peru, esc) {

	return new google.maps.Map(divOfMap, {
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

}

function strictBounds(generalMap) {

	var strictBounds = new google.maps.LatLngBounds(new google.maps.LatLng(-18.309, -81.342), new google.maps.LatLng(-0.08, -68.704));

	google.maps.event.addListener(generalMap, 'dragend', function () {
		if (strictBounds.contains(generalMap.getCenter()))
			return;

		var c = generalMap.getCenter(), x = c.lng(), y = c.lat(),
			maxX = strictBounds.getNorthEast().lng(),
			maxY = strictBounds.getNorthEast().lat(),
			minX = strictBounds.getSouthWest().lng(),
			minY = strictBounds.getSouthWest().lat();

		if (x < minX) x = minX;
		if (x > maxX) x = maxX;
		if (y < minY) y = minY;
		if (y > maxY) y = maxY;

		generalMap.setCenter(new google.maps.LatLng(y, x));
	});

}

initialize('map', lat, lon, escala, 0, null);
initialize('mapSuperEvento', lat, lon, escala, 0, null);