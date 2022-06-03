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
			url: URI + "inventario/main/agregarFile",
			maxFiles: 1,
			acceptedFiles: "application/pdf",
			thumbnailWidth: 400,
			thumbnailHeight: 300,
			init: function () {

				this.on("sending", function (file, xhr, formData) {
					formData.append("idingreso", ID_INGRESO);
				});

				this.on("success", function (file, response) {

					var resp = JSON.parse(response);
					$("#addModal").modal('hide');

					if (parseInt(resp.status) == 200) $(".alert-success").text(resp.message).css("display", "block");
					else $(".alert-danger").text(resp.message).css("display", "block");

				});

				this.on("error", function (file, response) {
					alert("Error al subir PDF, por favor revise la ruta del servidor");
				});

				this.on("complete", function (file) {
					setTimeout(function () {

						post(URI + "inventario/main/filesinventario", {
							idingreso: ID_INGRESO
						});

					}, 2500);
				});
			}

		});

var myDropzone2 = $("div#editUpload")
	.dropzone(
		{
			url: URI + "inventario/main/editarFile",
			maxFiles: 1,
			thumbnailWidth: 400,
			thumbnailHeight: 300,
			init: function () {

				this.on("sending", function (file, xhr, formData) {
					var id = $("#id").val();
					var idingreso = $("#idingreso").val();
					var files = $("#files").val();
					var descripcion = $("#descripcion")
						.val();
					formData.append("idingreso", idingreso);
					//formData.append("idingreso", idingreso);
					//formData.append("idingreso", ID_INGRESO);
					formData.append("files", files);
					formData.append("descripcion", descripcion);
				});

				this.on("success", function (file, response) {
					$("#editModal").modal('hide');

					if (parseInt(response.status) == 200) $(".alert-success").text(response.message).css("display", "block");
					else $(".alert-danger").text(response.message).css("display", "block");
				});

				this.on("error", function (file, response) {
					alert("Error al subir archivo, por favor revise la ruta del servidor");
				});

				this.on("complete", function (file) {
					post(URI + "eventos/eventos/fileseventos", {
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

		console.log("Entre");
		var descripcion = $(this).closest(".dataFile").find("input[name=txtdescripcion]").val();
		var data = $(this).attr("rel");
		data = data.split("|");
		var id = data[0];
		var idingreso = data[0];
		var files = data[1];
		console.log("Entre");
		$("#editModal").modal("show");

		$("#id").val(id);
		$("#idingreso").val(idingreso);
		$("#files").val(files);
		$("#descripcion").val(descripcion);

	});

	$(".descripcionButton").on("click", function () {
		var descripcionButton = $(this);
		var Evento_Registro_File_Numero = descripcionButton.attr("rel");
		var descripcion = descripcionButton.closest(".dataFile").find("input[name=txtdescripcion]").val();

		$.ajax({
			type: "POST",
			url: URI
				+ "inventario/main/editarFileDescripcion",
			data: {
				Evento_Registro_File_Numero: Evento_Registro_File_Numero,
				descripcion: descripcion,
				Evento_Registro_Numero: ID_EVENTO_REGISTRO
			},
			dataType: "json",
			beforeSend: function () {
				descripcionButton.html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
				descripcionButton.addClass("disabled");
			},
			success: function (data) {
				post(
					URI
					+ "inventario/main/filesinventario",
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
		var files = data[1];

		$.ajax({
			type: "POST",
			url: URI
				+ "inventario/main/eliminarFile",
			data: {
				Evento_Registro_File_Numero: id,
				files: files,
				idingreso: ID_INGRESO
			},
			dataType: "json",
			beforeSend: function () {
				deleteButton.html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
				deleteButton.addClass("disabled");
			},
			success: function (data) {
				post(URI + "inventario/main/filesinventario", { idingreso: ID_INGRESO });
			}
		});

	});

	$(".enlaceDanios,.enlaceLesionados,.enlaceAcciones,.enlaceFotos,.enlaceEntidades,.enlaceFiles").on("click", function () {

		var url = $(this).attr("rel");

		post(URI + "inventario/main/" + url, { idingreso: ID_INGRESO });

	});
	$('.addAsignacion').on('click', function () {
		cargarAddAsignacion(ID_INGRESO);
	});

});