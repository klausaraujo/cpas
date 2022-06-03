function registrar(URI) {

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

	function changeStep(href) {

		if (href == "#step1") {

			$("#step-1").css("display", "block");
			$("#step-2").css("display", "none");
			$("#step-3").css("display", "none");
			$("#step-4").css("display", "none");
			$(".stepwizard-step a:eq(0)").removeClass("disable").addClass("active");
			$(".stepwizard-step a:eq(1)").removeClass("active").addClass("disable");
			$(".stepwizard-step a:eq(2)").removeClass("active").addClass("disable");
			$(".stepwizard-step a:eq(3)").removeClass("active").addClass("disable");

			$("#btnPrevious").addClass("disabled");
			$("#btnPrevious").attr("previous", "");
			$("#btnEventoFinal").html("Siguiente >");

			return false;

		}

		if (href == "#step2") {

			$("#step-2").css("display", "block");
			$("#step-1").css("display", "none");
			$("#step-3").css("display", "none");
			$("#step-4").css("display", "none");
			$(".stepwizard-step a:eq(0)").removeClass("active").addClass("disable");
			$(".stepwizard-step a:eq(1)").removeClass("disable").addClass("active");
			$(".stepwizard-step a:eq(2)").removeClass("active").addClass("disable");
			$(".stepwizard-step a:eq(3)").removeClass("active").addClass("disable");
			$("#btnPrevious").removeClass("disabled");
			$("#btnPrevious").attr("previous", "#step1");
			$("#btnEventoFinal").html("Siguiente >");
			return false;

		}

		if (href == "#step3") {

			$("#step-3").css("display", "block");
			$("#step-1").css("display", "none");
			$("#step-2").css("display", "none");
			$("#step-4").css("display", "none");
			$(".stepwizard-step a:eq(0)").removeClass("active").addClass("disable");
			$(".stepwizard-step a:eq(1)").removeClass("active").addClass("disable");
			$(".stepwizard-step a:eq(2)").removeClass("disable").addClass("active");
			$(".stepwizard-step a:eq(3)").removeClass("active").addClass("disable");
			$("#btnPrevious").removeClass("disabled");
			$("#btnPrevious").attr("previous", "#step2");
			$("#btnEventoFinal").html("Siguiente >");
			return false;

		}

		if (href == "#step4") {

			$("#step-4").css("display", "block");
			$("#step-1").css("display", "none");
			$("#step-2").css("display", "none");
			$("#step-3").css("display", "none");
			$(".stepwizard-step a:eq(0)").removeClass("active").addClass("disable");
			$(".stepwizard-step a:eq(1)").removeClass("active").addClass("disable");
			$(".stepwizard-step a:eq(2)").removeClass("active").addClass("disable");
			$(".stepwizard-step a:eq(3)").removeClass("disable").addClass("active");
			$("#btnPrevious").removeClass("disabled");
			$("#btnPrevious").attr("previous", "#step3");
			$("#btnEventoFinal").html("Guardar");
			return false;

		}
	}

	function habilitarReniec() {
		$("input[name=apellidos]").attr("readonly", "readonly");
		$("input[name=nombres]").attr("readonly", "readonly");
		$("input[name=edad]").attr("readonly", "readonly");
		$("input[name=sexo_v]").attr("readonly", "readonly");

	}
	function deshabilitarReniec() {
		$("input[name=apellidos]").removeAttr("readonly");
		$("input[name=nombres]").removeAttr("readonly");
		$("input[name=edad]").removeAttr("readonly");
		$("input[name=sexo_v]").removeAttr("readonly");
	}

	$(document).ready(function () {

		$('.datetimepicker').datepicker({
			format: 'dd/mm/yyyy',
			maxDate: moment(),
			language: "es",
			autoclose: true
		});
		$("#formPaciente").validate({
			rules: {
				Documento_Numero: { required: function () { if ($("select[name=Tipo_Documento_Codigo]").val() != "06") return true; else return false; } },
				apellidos: { required: function () { if ($("select[name=Tipo_Documento_Codigo]").val() == "01" || $("select[name=Tipo_Documento_Codigo]").val() == "03") return true; else return false; } },
				nombres: { required: function () { if ($("select[name=Tipo_Documento_Codigo]").val() == "01" || $("select[name=Tipo_Documento_Codigo]").val() == "03") return true; else return false; } }
			},
			messages: {
				Documento_Numero: { required: "Ingrese el documento" },
				apellidos: { required: "(*) Campo Requerido" },
				nombres: { required: "(*) Campo Requerido" }
			},
			submitHandler: function (form, event) {

				event.preventDefault();

				var step1 = $("#step-1").css("display");
				var step2 = $("#step-2").css("display");
				var step3 = $("#step-3").css("display");
				var step4 = $("#step-4").css("display");

				if (step1 != "none" && step2 == "none" && step3 == "none" && step4 == "none") {

					$("#step-1").css("display", "none");
					$("#step-2").css("display", "block");
					$("#step-3").css("display", "none");
					$("#step-4").css("display", "none");
					$(".stepwizard-step a:eq(0)").removeClass("active").addClass("disable");
					$(".stepwizard-step a:eq(1)").removeClass("disable").addClass("active");
					$("#btnPrevious").removeClass("disabled");
					$("#btnPrevious").attr("previous", "#step1");
					$("#btnEventoFinal").html("Siguiente >");
					return false;

				}

				if (step1 == "none" && step2 != "none" && step3 == "none" && step4 == "none") {

					$("#step-1").css("display", "none");
					$("#step-2").css("display", "none");
					$("#step-3").css("display", "block");
					$("#step-4").css("display", "none");
					$(".stepwizard-step a:eq(1)").removeClass("active").addClass("disable");
					$(".stepwizard-step a:eq(2)").removeClass("disable").addClass("active");
					$("#btnPrevious").removeClass("disabled");
					$("#btnPrevious").attr("previous", "#step2");
					$("#btnEventoFinal").html("Siguiente >");
					return false;

				}

				if (step1 == "none" && step2 == "none" && step3 != "none" && step4 == "none") {

					$("#step-1").css("display", "none");
					$("#step-2").css("display", "none");
					$("#step-3").css("display", "none");
					$("#step-4").css("display", "block");
					$(".stepwizard-step a:eq(2)").removeClass("active").addClass("disable");
					$(".stepwizard-step a:eq(3)").removeClass("disable").addClass("active");
					$("#btnPrevious").removeClass("disabled");
					$("#btnPrevious").attr("previous", "#step3");
					$("#btnEventoFinal").html("Guardar");
					return false;

				}

				$.ajax({
					data: $("#formPaciente").serialize(),
					url: URI + "emergencias/registrarAjax",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
						$("#btnEventoFinal").addClass("disabled");
						$("#message").html("");

					},
					success: function (data) {
						$("#cargando").html("<i></i>");
						$("#message").slideDown();
						var $message = "";

						var id = $("#formPaciente input[name=id]").val();

						var $success = '<div class="alert alert-success"><h4 style="margin:0">Atenci\xf3n registrada exitosamente</h4></div>';
						var $error = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar la atenci\xf3n</h4></div>';

						if (parseInt(id) > 0) {
							$success = '<div class="alert alert-success"><h4 style="margin:0">Atenci\xf3n editada exitosamente</h4></div>';
							$error = '<div class="alert alert-error"><h4 style="margin:0">No se pudo editar la atenci\xf3n</h4></div>';
						}

						if (parseInt(data.status) == 200) {
							$message = $success;

						} else if (parseInt(data.status) == 201) {
							$message = '<div class="alert alert-warning"><h4 style="margin:0">El paciente ya existe</h4></div>';

						} else {
							$("#btnEventoFinal").removeClass("disabled");
							$message = $error;
						}

						$('html, body').animate({ scrollTop: 0 }, 'fast');
						$("#message").html($message);
						var id = $("#emergencias_registro_id").val();

						if (parseInt(data.status) == 201 || parseInt(data.status) == 500) {
							$("#formPaciente input[name=apellidos").val("");
							$("#formPaciente input[name=nombres").val("");
							$("#formPaciente input[name=sexo_v").val("");
							$("#formPaciente input[name=sexo").val("");
							$("#formPaciente input[name=edad").val("");
							$("#btnEventoFinal").removeClass("disabled");
							setTimeout(function () { $("#message").slideUp(); }, 3000);

						} else {
							setTimeout(function () { $("#message").slideUp(); post(URI + "emergencias/paciente", { id: id }); }, 3000);
						}
					}
				});

			}
		});

		$(".list-pacientes").on("click", function () {
			id = $(this).attr("rel");
			post(URI + "emergencias/paciente", { id: id });
		});

		$("#btnPrevious").on("click", function () {

			var href = $(this).attr("previous");
			changeStep(href);

		});

		$("#btn-buscar").on("click", function () {
			var Documento_Numero = $("input[name=Documento_Numero]").val();

			if (Documento_Numero.length >= 8) {
				var type = "01";
				if (Documento_Numero.length > 8) {
					type = "03";
				}
				$.ajax({
					url: URI + "emergencias/curl",
					data: { type: type, document: Documento_Numero },
					method: 'post',
					dataType: 'json',
					error: function (xhr) {
						$("#btn-buscar").removeAttr("disabled");
						$("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></i>');
					},
					beforeSend: function () {
						$("#btn-buscar").html('<i class="fa fa-spinner fa-pulse"></i>');
						$("#btn-buscar").attr("disabled", "disabled");
					},
					success: function (data) {
						$("#btn-buscar").removeAttr("disabled");
						$("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></i>');

						if (parseInt(data.data.attributes.sexo) != 1) {
							$(".div-gestante").slideDown();
						}
						else {
							$(".div-gestante").slideUp();
						}
						var genero = "Femenino";
						if (parseInt(data.data.attributes.sexo) === 1) {
							genero = "Masculino";
						}

						$("input[name=sexo_v]").val(genero);
						$("input[name=sexo]").val(data.data.attributes.sexo);
						$("input[name=apellidos]").val(data.data.attributes.apellido_paterno + " " + data.data.attributes.apellido_materno);
						$("input[name=edad]").val(data.data.attributes.edad_anios);
						$("input[name=nombres]").val(data.data.attributes.nombres);
					}
				});

			}

		});

		var navListItems = $('div.setup-panel div a');
		var allWells = $(".setup-content");

		navListItems.on("click", function (e) {
			e.preventDefault();
			var $target = $($(this).attr('href')),
				$item = $(this);

			if (!$item.hasClass('disabled')) {
				navListItems.removeClass('active');
				$item.addClass('active');
				allWells.hide();
				$target.show();
			}
		});

		$("#btnCancelar").on("click", function () {

			location.href = URI + "emergencias";

		});

		$("select[name=Tipo_Documento_Codigo]").on("change", function () {

			var select = $(this).val();

			if (select === "01" || select === "03") {
				habilitarReniec();
			} else {
				deshabilitarReniec();
			}

		});

	});

}
