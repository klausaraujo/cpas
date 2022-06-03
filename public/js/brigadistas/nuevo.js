function nuevo(URI) {
	$("#file").change(function (event) {
		RecurFadeIn();
		readURL(this);
	}); $("#file").on('click', function (event) {
		RecurFadeIn();
	}); function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			var filename = $("#file").val();
			filename = filename.substring(filename.lastIndexOf('\\') + 1);
			reader.onload = function (e) {
				debugger;
				$('#blah').attr('src', e.target.result);
				$('#blah').hide();
				$('#blah').fadeIn(500);
				$('.custom-file-label').text(filename);
			}
			reader.readAsDataURL(input.files[0]);
		}
		$(".alert").removeClass("loading").hide();
	} function RecurFadeIn() {
		FadeInAlert("Esperando...");
	} function FadeInAlert(text) {
		$(".alert").show();
		$(".alert").text(text).addClass("loading");
	} function habilitarReniec() {
		$("input[name=apellidos]").attr("readonly", "readonly");
		$("input[name=nombres]").attr("readonly", "readonly");
		$("input[name=fecha_nacimiento]").attr("readonly", "readonly");
		$("input[name=edad]").attr("readonly", "readonly");
		$("select[name=genero]").attr("readonly", "readonly");
		$("select[name=estado_civil]").attr("readonly", "readonly");
	}
	function deshabilitarReniec() {
		$("input[name=apellidos]").removeAttr("readonly");
		$("input[name=nombres]").removeAttr("readonly");
		$("input[name=fecha_nacimiento]").removeAttr("readonly");
		$("input[name=edad]").removeAttr("readonly");
		$("select[name=genero]").removeAttr("readonly");
		$("select[name=estado_civil").removeAttr("readonly");
	} $("#formBrigadista").validate({
		rules: {
			Tipo_Documento_Codigo: { required: function () { if ($("#Tipo_Documento_Codigo").css("display") != "none") return true; else return false; } },
			documento_numero: { required: function () { if ($("#documento_numero").css("display") != "none") return true; else return false; }, digits: true },
			apellidos: { required: function () { if ($("#apellidos").css("display") != "none") return true; else return false; } },
			nombres: { required: function () { if ($("#nombres").css("display") != "none") return true; else return false; } },
			fecha_nacimiento: { required: function () { if ($("#fechaEvento").css("display") != "none") return true; else return false; } },
			edad: { required: function () { if ($("#edad").css("display") != "none") return true; else return false; } },
			genero: { required: function () { if ($("#genero").css("display") != "none") return true; else return false; } },
			estado_civil: { required: function () { if ($("#estado_civil").css("display") != "none") return true; else return false; } },
			grupo_sanguineo: { min: 1 },
			departamento: { required: function () { if ($("#departamento").css("display") != "none") return true; else return false; } },
			provincia: { required: function () { if ($("#provincia").css("display") != "none") return true; else return false; } },
			distrito: { required: function () { if ($("#distrito").css("display") != "none") return true; else return false; } },
		},
		messages: {
			Tipo_Documento_Codigo: { required: "(*) Campo Requerido" },
			documento_numero: { required: "(*) Campo Requerido", digits: "solo n\xfameros" },
			apellidos: { required: "(*) Campo Requerido" },
			nombres: { required: "(*) Campo Requerido" },
			fecha_nacimiento: { required: "(*) Campo Requerido" },
			edad: { required: "(*) Campo Requerido" },
			genero: { required: "(*) Campo Requerido" },
			estado_civil: { required: "(*) Campo Requerido" },
			grupo_sanguineo: { min: "(*) Campo Requerido" },
			departamento: { required: "(*) Campo Requerido" },
			provincia: { required: "(*) Campo Requerido" },
			distrito: { required: "(*) Campo Requerido" }
		},
		errorPlacement: function (error, element) {
			if (element.attr("name") == "documento_numero") {
				error.insertAfter("#error_numero_documento");
			}
			else if (element.attr("name") == "fecha_nacimiento") {
				error.insertAfter("#error_fecha_nacimiento");
			}
			else {
				error.insertAfter(element);
			}
		},
		submitHandler: function (form, event) {
			event.preventDefault();
			var step1 = $("#step-1").css("display");
			var step2 = $("#step-2").css("display");
			if (step1 != "none" && step2 == "none") {
				$("#step-1").css("display", "none");
				$("#step-2").css("display", "block");
				$(".stepwizard-step a:eq(0)").removeClass("active").addClass("step1-disable");
				$(".stepwizard-step a:eq(1)").removeClass("disable").addClass("active");
				$("#btnEventoFinal").text("Registrar Brigadista");
				return false;
			} var formData = new FormData(document.getElementById("formBrigadista"));
			formData.append("file", document.getElementById("file")); $.ajax({
				data: formData,
				url: URI + "brigadistas/registrar",
				method: "POST",
				dataType: "json",
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
					$("#btnEventoFinal").addClass("disabled");
					$("#message").html("");
				},
				success: function (data) {
					$("#cargando").html("<i></i>");
					$('html, body').animate({ scrollTop: 0 }, 'fast'); var $message = ""; if (parseInt(data.status) == 200) $message = '<div class="alert alert-success"><h4 style="margin:0">Brigadista registrado exitosamente</h4></div>';
					else if (parseInt(data.status) == 201) {
						$message = '<div class="alert alert-warning"><h4 style="margin:0">No se pudo registrar, el brigadista ya existe</h4></div>';
						$("#btnEventoFinal").removeClass("disabled");
					}
					else {
						$message = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar el brigadista</h4></div>';
						$("#btnEventoFinal").removeClass("disabled");
					} $("#message").html($message); if (parseInt(data.status) == 200) setTimeout(function () { $("#message").slideUp(); location.href = URI + "brigadistas"; }, 3500);
				}
			});
		}
	}); $("#backStep1").on("click", function () {
		var step1 = $("#step-1").css("display");
		var step2 = $("#step-2").css("display");
		if (step1 == "none" && step2 != "none") {
			$("#step-2").css("display", "none");
			$("#step-1").css("display", "block"); $(".stepwizard-step a:eq(0)").removeClass("step1-disable").addClass("active");
			$(".stepwizard-step a:eq(1)").removeClass("active").addClass("disable"); $("#btnEventoFinal").text("Siguiente >");
			return false;
		}
	});
	$(document).ready(function () {
		$("#datetimepicker").datetimepicker({
			format: "DD/MM/YYYY",
			maxDate: moment()
		}); setTimeout(function () { $("#fecha_nacimiento").val("") }, 100);
		$("#departamento").change(function () {
			var id = $(this).val();
			console.log("departamento: ", id);
			if (id.length > 0) {
				$.ajax({
					data: { departamento: id },
					url: URI + "eventos/main/cargarProvincias",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#provincia").html('<option value="">Cargando...</option>');
						$("#distrito").html('<option value="">--Elija Provincia--</option>');
					},
					success: function (data) {
						var $html = '<option value="">--Seleccione--</option>';
						$.each(data.lista, function (i, e) { $html += '<option value="' + e.Codigo_Provincia + '">' + e.Nombre + '</option>'; });
						$("#provincia").html($html);
					}
				});
			}
		}); $("#provincia").change(function () {
			var id = $(this).val();
			var departamento = $("#departamento").val(); if (id.length > 0 && departamento.length > 0) {
				$.ajax({
					data: { departamento: departamento, provincia: id },
					url: URI + "eventos/main/cargarDistritos",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#distrito").html('<option value="">Cargando...</option>');
					},
					success: function (data) {
						var $html = '<option value="">--Seleccione--</option>';
						$.each(data.lista, function (i, e) { $html += '<option value="' + e.Codigo_Distrito + '">' + e.Nombre + '</option>'; });
						$("#distrito").html($html);
					}
				});
			}
		}); $("#btnCancelar").on("click", function () { location.href = URI + "brigadistas"; }); $("#btn-buscar").on("click", function () {
			var documento_numero = $("input[name=documento_numero]").val(); if (documento_numero.length >= 8) {
				var type = "01";
				if (documento_numero.length > 8) {
					type = "03";
				}
				$.ajax({
					url: URI + "brigadistas/curl",
					data: { type: type, document: documento_numero },
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
						$("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></i>'); var fecha = (data.data.attributes.fecha_nacimiento).split("-"); $("input[name=fecha_nacimiento]").val(fecha[2] + "/" + fecha[1] + "/" + fecha[0]); $("input[name=edad]").val(data.data.attributes.edad_anios);
						$("select[name=estado_civil]").val(data.data.attributes.estado_civil);
						$("select[name=estado_civil]").attr("rel", data.data.attributes.estado_civil);
						$("select[name=genero]").val(data.data.attributes.sexo);
						$("select[name=genero]").attr("rel", data.data.attributes.sexo);
						$("input[name=apellidos]").val(data.data.attributes.apellido_paterno + " " + data.data.attributes.apellido_materno);
						$("input[name=nombres]").val(data.data.attributes.nombres);
					}
				});
			}
		}); $("select[name=Tipo_Documento_Codigo]").on("change", function () {
			var select = $(this).val();
			if (select == "06") deshabilitarReniec();
			else habilitarReniec();
		}); $("select[name=genero]").change(function (e) {
			var select = $("select[name=Tipo_Documento_Codigo]").val();
			var defaultValue = $(this).attr("rel");
			if (select != "06") {
				$("select[name=genero]").val(function () {
					return defaultValue;
				});
			}
		}); $("select[name=estado_civil]").change(function (e) {
			var select = $("select[name=Tipo_Documento_Codigo]").val();
			var defaultValue = $(this).attr("rel");
			if (select != "06") {
				$("select[name=estado_civil]").val(function () {
					return defaultValue;
				});
			}
		});
	});
}