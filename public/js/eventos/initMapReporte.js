var escAncho = screen.width;
var escAlto = screen.height;

var escala = 6;

if (escAncho == 1920 && escAlto == 1080)
	var escala = 6;
if (escAncho == 1680 && escAlto == 1050)
	var escala = 6;
if (escAncho == 1600 && escAlto == 900)
	var escala = 6;
if (escAncho == 1440 && escAlto == 900)
	var escala = 6;
if (escAncho == 1400 && escAlto == 1050)
	var escala = 6;
if (escAncho == 1360 && escAlto == 768)
	var escala = 5;
if (escAncho == 1280 && escAlto == 1024)
	var escala = 6;
if (escAncho == 1024 && escAlto == 768)
	var escala = 5;
if (escAncho == 800 && escAlto == 600)
	var escala = 5;

var map;
var mapMarkers = new Array();

function mostrarModal(nombre, ubicacion, fecha) {

	html = "<p>Evento: " + nombre + "</p>";
	html += "<p>Ubicaci&oacute;n: " + ubicacion + "</p>"
	html += "<p>Fecha: " + fecha + "</p>";

	$('#exampleModalCenter').modal();
	$("#texto").html(html);

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
			var contenido = marcadores[x][i].info;
			var cat = marcadores[x][i].idcat;

			var nombre = marcadores[x][i].nombre;
			var ubicacion = marcadores[x][i].ubicacion;
			var fecha = marcadores[x][i].fecha;

			var icons = new google.maps.MarkerImage(URI_MAP
				+ "public/map/marker-red.png");

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
				icon: icons,
				nombre: marcadores[x][i].nombre,
				ubicacion: marcadores[x][i].ubicacion,
				fecha: marcadores[x][i].fecha
			});

			mapMarkers[i] = marker;
			cont++;

			if (val == 0) {
				(function (marker, contenido, cat) {
					google.maps.event.addListener(marker, 'click', function () {

						mostrarModal(marker.nombre, marker.ubicacion,
							marker.fecha);
					});
				})(marker, contenido, cat);
			}
		}

	}

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

	var mapDiv = document.getElementById('map');
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

				if (x < minX)
					x = minX;
				if (x > maxX)
					x = maxX;
				if (y < minY)
					y = minY;
				if (y > maxY)
					y = maxY;

				map.setCenter(new google.maps.LatLng(y, x));
			});

	cargarFull(val, marcadores);

}