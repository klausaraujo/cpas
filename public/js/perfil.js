$(document).ready(function () {
	/*	
		$(".imagen").on("click", function () {

			$("#imagenModal").modal('show');

		});
		//console.log("URI: " + URI);
		/*
		var myDropzone = $("div#imagenUpload")
			.dropzone(
				{
					url: URI + "usuario/editarImagen",
					maxFiles: 1,
					acceptedFiles: "image/jpg,image/png,image/jpeg",
					thumbnailWidth: 300,
					thumbnailHeight: 150,
					init: function () {

						this.on("success", function (file, response) {
							$("#imagenModal").modal('hide');
							$(".alert span").html("");
							var obj = JSON.parse(response);

							if (parseInt(obj.estado) == 0) {
								$(".imagen img").attr("src", URI + "public/images/perfil/" + obj.imagen);
								$(".alert-success").removeClass("hide");
								$(".alert-success span").html(obj.mensaje);
								setTimeout(function () { $(".alert-success").addClass("hide"); }, 3000);
							}
							else {
								$(".alert-danger").removeClass("hide");
								$(".alert-danger span").html(obj.mensaje);
								setTimeout(function () { $(".alert-danger").addClass("hide"); }, 3000);
							}
						});

						this.on("error", function (file, response) {
							$(".alert span").html("");
							var obj = JSON.parse(response);
							$(".alert-danger").removeClass("hide");
							$(".alert-danger span").html(obj.mensaje);
							setTimeout(function () { $(".alert-danger").addClass("hide"); }, 3000);
						});

						this.on("complete", function (file, response) {
						});
					}

				});

				*/
	$("#formPassword").validate({
		rules: {
			old_password: { required: true },
			password: { required: true, minlength: 6 },
			re_password: { required: true, equalTo: "#password" }
		},
		messages: {
			old_password: { required: "Ingrese la contrase\xf1a actual" },
			password: { required: "Ingrese la nueva contrase\xf1a", minlength: "Por lo menos 6 caracteres" },
			re_password: { required: "Ingrese nuevamente la contrase\xf1a", equalTo: "Las contrase\xf1as deben ser iguales" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				data: $("#formPassword").serialize(),
				url: URI + "usuario/password",
				method: "POST",
				dataType: "json",
				beforeSend: function () {
					$("#formPassword .cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
					$("#formPassword button[type=submit]").addClass("disabled");
					$(".alert span").html("");

				},
				success: function (data) {
					$("#formPassword .cargando").html("<i></i>");
					$("#formPassword button[type=submit]").removeClass("disabled");

					$('html, body').animate({ scrollTop: 0 }, 'fast');

					if (parseInt(data.status) == 200) {
						createAlert('', '', '  Se cambió la clave correctamente.', 'success', false, true, 'pageMessages');

						//$(".alert-success").removeClass("hide");
						$(".alert-success span").html(data.message);
						$("#formPassword")[0].reset();
						setTimeout(function () { $(".alert-success").addClass("hide"); }, 3000);
					}
					else {
						createAlert('', '', '  Hubo algún error al actualizar la clave, intentar nuevamente.', 'warning', false, true, 'pageMessages');

						//$(".alert-danger").removeClass("hide");
						$(".alert-danger span").html(data.message);
						setTimeout(function () { $(".alert-danger").addClass("hide"); }, 3000);
					}

				}
			});

		}
	});
});