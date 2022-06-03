$.each(registros, function (i, e) {

	var coordenadas = e.Evento_Coordenadas.split(",");
	var posicion = { "latitud": coordenadas[0], "longitud": coordenadas[1] };
	marcadores[i] = [{ id: e.Evento_Registro_Numero, posicion: posicion, nivel: e.Evento_Nivel_Codigo, tipo: e.Evento_Tipo_Codigo }];

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

var polygonFill = ["#7FDF83", "#f6fE5F", "#FF5Ff6", "#5F6FF6", "#5FDFf6",
	"#5Ff6FF", "#6FF69A", "#F65F5F", "#F6D45F", "#F69D5F", "#DA9C7F",
	"#93DA7F", "#7FCFDA", "#7F88DA", "#B67FDA", "#DA7FB7", "#DA7F7F",
	"#FED4D4", "#FEF8D4", "#D4FBFE", "#D4E8FE", "#F3D4FE", "#BF4343",
	"#EFF53F", "#FED4D4"];

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

function setMapOnAll(map) {
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	}
}

function clearMarkers() {
	setMapOnAll(null);
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

	mapMarkers = [];

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

			mapMarkers[x] = new google.maps.Marker({
				animation: anime,
				position: new google.maps.LatLng(
					marcadores[x][i].posicion.latitud,
					marcadores[x][i].posicion.longitud),
				map: map,
				scaledSize: new google.maps.Size(20, 20),
				icon: icon
			});
			cont++;
			var marcador = marcadores[x][i];

			if (val == 0) {
				(function (marcador, i) {
					google.maps.event.addListener(mapMarkers[i], "click", function () {
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
				})(marcador, i);
			}
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
	html += '<br />';
	html += '<h4>INFORME DE DAÑOS</h4>';
	html += '<ul>';
	html += '<li><strong>Lesionados:</strong> ' + ((data.Evento_Lesionados != null) ? data.Evento_Lesionados : ' Sin datos') + '</li>';
	html += '<li><strong>Fallecidos:</strong> ' + ((data.Evento_Fallecidos != null) ? data.Evento_Fallecidos : ' Sin datos') + '</li>';
	html += '<li><strong>Desaparecidos:</strong> ' + ((data.Evento_Desaparecidos != null) ? data.Evento_Desaparecidos : ' Sin datos') + '</li>';
	html += '<li><strong>IPRESS afectadas operativas:</strong> ' + ((data.Evento_Viv_Inhabitables != null) ? data.Evento_Viv_Inhabitables : ' Sin datos') + '</li>';
	html += '<li><strong>IPRESS afectadas inoperativas:</strong> ' + ((data.Evento_Viv_Colapsadas != null) ? data.Evento_Viv_Colapsadas : ' Sin datos') + '</li>';
	html += '</ul>';
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