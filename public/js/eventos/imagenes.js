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

var myDropzone1 = $("div#addUpload")
	.dropzone(
		{
			url: URI + "eventos/eventos/agregarImagen",
			maxFiles: 1,
			acceptedFiles: "image/jpg,image/png,image/jpeg",
			thumbnailWidth: 400,
			thumbnailHeight: 300,
			init: function () {

				this.on("sending", function (file, xhr, formData) {
					formData.append("Evento_Registro_Numero", ID_EVENTO_REGISTRO);

				});

				this.on("success", function (file, response) {

					var resp = JSON.parse(response);
					$("#addModal").modal('hide');

					if (parseInt(resp.status) == 200) $(".alert-success").text(resp.message).css("display", "block");
					else $(".alert-danger").text(resp.message).css("display", "block");

				});

				this.on("error", function (file, response) {
					alert("Error al subir imagen, por favor revise la ruta del servidor");
				});

				this.on("complete", function (file) {
					setTimeout(function () {

						post(URI + "eventos/eventos/imagenes", {
							Evento_Registro_Numero: ID_EVENTO_REGISTRO
						});

					}, 2500);
				});
			}

		});

var myDropzone2 = $("div#editUpload")
	.dropzone(
		{
			url: URI + "eventos/eventos/editarImagen",
			maxFiles: 1,
			thumbnailWidth: 400,
			thumbnailHeight: 300,
			init: function () {

				this.on("sending", function (file, xhr, formData) {
					var id = $("#id").val();
					var imagen = $("#imagen").val();
					var descripcion = $("#descripcion")
						.val();
					formData.append("Evento_Registro_Imagen_Numero", id);
					formData.append("Evento_Registro_Numero", ID_EVENTO_REGISTRO);
					formData.append("imagen", imagen);
					formData.append("descripcion",
						descripcion);
				});

				this.on("success", function (file, response) {
					$("#editModal").modal('hide');

					if (parseInt(response.status) == 200) $(".alert-success").text(response.message).css("display", "block");
					else $(".alert-danger").text(response.message).css("display", "block");
				});

				this.on("error", function (file, response) {
					alert("Error al subir imagen, por favor revise la ruta del servidor");
				});

				this.on("complete", function (file) {
					post(URI + "eventos/eventos/imagenes", {
						Evento_Registro_Numero: ID_EVENTO_REGISTRO
					});
				});
			}

		});

$(document).ready(function () {

	$(".loadImage").on("click", function () {
		var imagen = $(this).css("background-image");

		$("#galleryModal").modal("show");
		imagen = imagen.replace("url(", "");
		imagen = imagen.replace(")", "");
		imagen = imagen.replace('"', '');
		imagen = imagen.replace('"', '');
		console.log(imagen);
		$('.gallery img').attr('src', imagen);
	});

	$(".editButton").on("click", function () {

		var descripcion = $(this).closest(".dataImagen").find("input[name=txtdescripcion]").val();
		var data = $(this).attr("rel");
		data = data.split("|");
		var id = data[0];
		var imagen = data[1];

		$("#editModal").modal("show");

		$("#id").val(id);
		$("#imagen").val(imagen);
		$("#descripcion").val(descripcion);

	});

	$(".descripcionButton").on("click", function () {
		var descripcionButton = $(this);
		var Evento_Registro_Imagen_Numero = descripcionButton
			.attr("rel");
		var descripcion = descripcionButton
			.closest(".dataImagen")
			.find(
				"input[name=txtdescripcion]")
			.val();

		$.ajax({
			type: "POST",
			url: URI
				+ "eventos/eventos/editarImagenDescripcion",
			data: {
				Evento_Registro_Imagen_Numero: Evento_Registro_Imagen_Numero,
				descripcion: descripcion,
				Evento_Registro_Numero: ID_EVENTO_REGISTRO
			},
			dataType: "json",
			beforeSend: function () {
				descripcionButton
					.html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
				descripcionButton
					.addClass("disabled");
			},
			success: function (data) {
				post(
					URI
					+ "eventos/eventos/imagenes",
					{
						Evento_Registro_Numero: ID_EVENTO_REGISTRO
					});
			}
		});

	});

	$(".deleteButton").on("click", function () {
		var deleteButton = $(this);

		var data = deleteButton.attr("rel");
		data = data.split("|");
		var id = data[0];
		var imagen = data[1];

		$.ajax({
			type: "POST",
			url: URI
				+ "eventos/eventos/eliminarImagen",
			data: {
				Evento_Registro_Imagen_Numero: id,
				imagen: imagen,
				Evento_Registro_Numero: ID_EVENTO_REGISTRO
			},
			dataType: "json",
			beforeSend: function () {
				deleteButton
					.html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
				deleteButton
					.addClass("disabled");
			},
			success: function (data) {
				post(URI + "eventos/eventos/imagenes", { Evento_Registro_Numero: ID_EVENTO_REGISTRO });
			}
		});

	});

	$(".enlaceDanios,.enlaceLesionados,.enlaceAcciones,.enlaceFotos,.enlaceEntidades,.enlaceFiles").on("click", function () {

		var url = $(this).attr("rel");

		post(URI + "eventos/eventos/" + url, { Evento_Registro_Numero: ID_EVENTO_REGISTRO });

	});
	$('.addAsignacion').on('click', function () {
		cargarAddAsignacion(ID_EVENTO_REGISTRO);
	});

});