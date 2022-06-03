function main(URI, Evento_Registro_Numero) {

	function clearMap() {

		selected = [];
		searching = [];
		$("#listMap").css("display", "none");
		$("#listMap").html("");
		$("#mapa").val("");

		if (polydj.length > 0) {
			for (x = 1; x <= 25; x++) {
				if (polydj[x] !== undefined) {
					polydj[x].setOptions({
						fillOpacity: 0.20
					});
				}
			}
		}

	}

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

	$(document).ready(function () {

		var table = $('.tbLista').DataTable(
			{
				dom: '<"html5buttons"B>lTfgitp',
				columns: [
					{ "data": "titulo" },
					{ "data": "resolucion" },
					{ "data": "descripcion" },
					{ "data": "fecha_registro" },
					{ "data": "dgosV" },
					{ "data": "digerdV" },
					{ "data": "cdcV" },
					{ "data": "digesaV" },
					{ "data": "archivo" },
					{ "data": "Estado" },
					{ "data": "id" },
					{ "data": "region_nombres" },
					{ "data": "dgos" },
					{ "data": "digerd" },
					{ "data": "cdc" },
					{ "data": "digesa" },
					{ "data": "descripcion" },
					{ "data": "status" }
				],
				columnDefs: [{
					"targets": [2, 10, 11, 12, 13, 14, 15, 16, 17],
					"visible": false,
					"searchable": false
				}],
				"order": [[1, "asc"]],
				buttons: [
					{ extend: 'copy', title: 'Lista Emergencias' },
					{ extend: 'csv', title: 'Lista Emergencias' },
					{ extend: 'excel', title: 'Lista Emergencias' },
					{ extend: 'pdf', title: 'Lista Emergencias', orientation: 'landscape' },

					{
						extend: 'print',
						title: 'Imprimir',
						customize: function (
							win) {
							$(win.document.body).addClass('white-bg');
							$(win.document.body).css('font-size', '10px');

							$(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
						}
					}]

			});

		$('body').on('click', '.tbLista tr', function () {

			var tr = $(this);
			var row = table.row(tr);

			index = row.index();

			data = row.data();
			var estado = data.status;
			var id = data.id;

			$("#btn-editar").removeClass("disabled");
			$("#btn-editar label").attr("rel", JSON.stringify(data));
			$("#btn-paciente").removeClass("disabled");
			$("#btn-paciente label").attr("rel", id);

			if (parseInt(estado) == 1) {
				$("#btn-cerrar").removeClass("disabled");
				$("#btn-cerrar label").attr("rel", id);
			} else {
				$("#btn-cerrar").addClass("disabled");
				$("#btn-cerrar label").attr("rel", null);
			}

			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}

		});

		$("#formRegistrar").validate({
			rules: {
				titulo: { required: true },
				resolucion: { required: true },
				descripcion: { required: true },
				mapa: { required: true }
			},
			messages: {
				titulo: { required: "(*) Campo Requerido" },
				resolucion: { required: "(*) Campo Requerido" },
				descripcion: { required: "(*) Campo Requerido" },
				mapa: { required: "Elija al menos una regi\xf3n" }
			},
			errorPlacement: function (error, element) {
				if (element.attr("name") == "mapa") {
					error.insertAfter("#error_mapa");
				}
				else {
					error.insertAfter(element);
				}
			},
			submitHandler: function (form, event) {

				event.preventDefault();

				var regionCodigos = "";
				var regionNombres = "";
				$.each($("#listMap ul li"), function (i, e) {
					console.log($(this).attr('rel') + ' - ' + $(this).html());
					regionCodigos += "," + $(this).attr('rel');
					regionNombres += "," + $(this).html();
				});

				if (regionCodigos.length < 1 || regionNombres.length < 1) {
					alert("Seleccione al menos una regi\xf3n");
					return false;
				}

				var regionCodigos = regionCodigos.replace(",", "");
				var regionNombres = regionNombres.replace(",", "");

				var formData = new FormData(document.getElementById("formRegistrar"));
				formData.append("file", document.getElementById("file"));
				formData.append("region_codigos", regionCodigos);
				formData.append("region_nombres", regionNombres);

				$.ajax({
					data: formData,
					url: URI + "emergencias/registrar",
					method: "POST",
					dataType: "json",
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
						$("#btnAgregar").addClass("disabled");
						$("#message").html("");

					},
					error: function () {
						$("#registroModal").modal("hide");
						$("#modalCargaGeneral").css("display", "none");
					},
					success: function (data) {
						$("#modalCargaGeneral").css("display", "none");
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						$("#registroModal").modal("hide");
						$("#message").slideDown();
						var $message = "";

						$success = '<div class="alert alert-success"><h4 style="margin:0">Emergencia registrada exitosamente</h4></div>';
						$alert = '<div class="alert alert-warning"><h4 style="margin:0">No se pudo registrar, la emergencia ya existe</h4></div>';
						$error = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar la emergencia</h4></div>';

						var id = $("#formRegistrar input[name=id]").val();

						if (parseInt(id) > 0) {
							$success = '<div class="alert alert-success"><h4 style="margin:0">Emergencia actualizada exitosamente</h4></div>';
							$error = '<div class="alert alert-error"><h4 style="margin:0">No se pudo actualizar la emergencia</h4></div>';
						}

						if (parseInt(data.status) == 200) $message = $success;
						else if (parseInt(data.status) == 201) {
							$message = $alert;
							$("#btnEventoFinal").removeClass("disabled");
						}
						else {
							$message = $error;
							$("#btnEventoFinal").removeClass("disabled");
						}

						$("#message").html($message);

						if (parseInt(data.status) == 200) {
							setTimeout(function () { $("#message").slideUp(); location.href = URI + "emergencias"; }, 3500);
						}
						else {
							setTimeout(function () { $("#message").slideUp(); }, 3000);
						}
					}
				});

			}
		});

		$("#btn-nuevo").on('click', function () {

			clearMap();

		});

		$('#btn-editar').on('click', function () {
			clearMap();
			var data = $(this).find("label").attr("rel");
			data = JSON.parse(data);
			$("#registroModal").modal("show");
			$("#registroModal").find("input[name='id']").val(data.id);
			$("#registroModal").find("input[name='titulo']").val(data.titulo);
			$("#registroModal").find("input[name='resolucion']").val(data.resolucion);
			$("#registroModal").find("textarea[name='descripcion']").val(data.descripcion);
			if (parseInt(data.dgos) > 0) {
				$("#registroModal").find("input[name='dgos']").prop("checked", "checked");
			}
			if (parseInt(data.digerd) > 0) {
				$("#registroModal").find("input[name='digerd']").prop("checked", "checked");
			}
			if (parseInt(data.cdc) > 0) {
				$("#registroModal").find("input[name='cdc']").prop("checked", "checked");
			}
			if (parseInt(data.digesa) > 0) {
				$("#registroModal").find("input[name='digesa']").prop("checked", "checked");
			}

			var departamentos = data.region_nombres;

			searching = departamentos.split(",");
			fillMap();
		});
		$('#btn-paciente').on('click', function () {
			var id = $(this).find("label").attr("rel");

			post(URI + "emergencias/paciente", { id: id });
		});

		$('#btn-cerrar').on('click', function () {

			$("#decisionModal #btn-decision").text("Cerrar");
			$("#decisionModal").modal("show");
			$("#decisionModal .modal-title").text("Cerrar Emergencia");
			$("#decisionModal .modal-body p").html("Est\xe1 seguro de querer cerrar la Emergencia");
		});

		$("#btn-decision").on("click", function () {

			var id = $('#btn-cerrar').find("label").attr("rel");
			post(URI + "emergencias/cerrar", { id: id });

		});

		var $input = $(".inputfile"),
			$label = $input.next('label'),
			labelVal = $label.html();

		$input.on('change', function (e) {
			var fileName = '';

			if (this.files && this.files.length > 1)
				fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
			else if (e.target.value)
				fileName = e.target.value.split('\\').pop();

			if (fileName)
				$label.find('span').html(fileName);
			else
				$label.html(labelVal);
		});
		$input.on('focus', function () { $input.addClass('has-focus'); }).on('blur', function () { $input.removeClass('has-focus'); });

	});

}