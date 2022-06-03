var lat = "";
var lng = "";

function initMap() {
	var map = new google.maps.Map(document.getElementById('map'), {
		center: {
			lat: EVENTO_LATITUD,
			lng: EVENTO_LONGITUD
		},
		zoom: generalZoom
	});
	var input = document.getElementById('ubicacion');

	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.bindTo('bounds', map);

	var infowindow = new google.maps.InfoWindow();
	var marker = new google.maps.Marker({
		map: map,
		anchorPoint: new google.maps.Point(0, -29),
		draggable: true,
		position: new google.maps.LatLng(EVENTO_LATITUD, EVENTO_LONGITUD)
	});

	var geocoder = new google.maps.Geocoder();

	autocomplete
		.addListener(
			'place_changed',
			function () {
				infowindow.close();
				marker.setVisible(true);
				var place = autocomplete.getPlace();

				if (!place.geometry) {
					window.alert("No se encuentra la ubicaci\xf3n: '" + place.name + "', intente colocando una zona cercana y moviendo el marcador rojo");
					return;
				}

				if (place.geometry.viewport) {
					map.fitBounds(place.geometry.viewport);
				} else {
					map.setCenter(place.geometry.location);
					map.setZoom(17);
				}
				marker.setIcon(({
					url: place.icon,
					size: new google.maps.Size(71, 71),
					origin: new google.maps.Point(0, 0),
					anchor: new google.maps.Point(17, 34),
					scaledSize: new google.maps.Size(35, 35)
				}));
				marker.setPosition(place.geometry.location);
				marker.setVisible(true);

				var address = '';
				if (place.address_components) {
					address = [
						(place.address_components[0]
							&& place.address_components[0].short_name || ''),
						(place.address_components[1]
							&& place.address_components[1].short_name || ''),
						(place.address_components[2]
							&& place.address_components[2].short_name || '')]
						.join(' ');
				}

				infowindow.setContent('<div><strong>' + place.name
					+ '</strong><br>' + address);
				infowindow.open(map, marker);

				lat = marker.getPosition().lat();
				lng = marker.getPosition().lng();

				document.getElementById("latitud").value = lat;
				document.getElementById("longitud").value = lng;

			});

	google.maps.event.addListener(marker, "dragend", function (event) {

		lat = marker.getPosition().lat();
		lng = marker.getPosition().lng();

		document.getElementById("latitud").value = lat;
		document.getElementById("longitud").value = lng;

		geocoder.geocode({
			'latLng': marker.getPosition()
		}, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var address = results[0]['formatted_address'];
			}
		});

	});

	google.maps.event.addListener(map, 'zoom_changed', function () {
		generalZoom = map.getZoom();
	});

	function setupClickListener(id, types) {
		var radioButton = document.getElementById(id);
		radioButton.addEventListener('click', function () {
			autocomplete.setTypes(types);
		});
	}

	var departamento = document.getElementById("departamento");
	var distrito = document.getElementById("distrito");

	google.maps.event.addDomListener(distrito, "change", function () {

		var geocoder = new google.maps.Geocoder();

		var distritoV = distrito.value;
		if (distritoV.length > 1) {
			var departamentoT = document.getElementById('departamento').options[document.getElementById('departamento').selectedIndex].text;
			var distritoT = document.getElementById('distrito').options[document.getElementById('distrito').selectedIndex].text;
			var ubicacion = distritoT + ", " + departamentoT + ", Peru";
			geocoder.geocode({ "address": ubicacion }, function (data) {
				var lat = data[0].geometry.location.lat();
				var lng = data[0].geometry.location.lng();
				var origin = new google.maps.LatLng(lat, lng);
				document.getElementById('latitud').value = lat;
				document.getElementById('longitud').value = lng;
				marker.setPosition(origin);
				map.setCenter(origin);
				map.setZoom(15);

			});
		}

	});

}