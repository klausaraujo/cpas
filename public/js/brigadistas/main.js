function listaBrigadistas(URI) {

	setTimeout(function () {
		$(".alert").slideUp();
	}, 3500);

	function condicionLaboral(id) {

		var condicion = "[N/A]";

		switch (parseInt(id)) {
			case 1: condicion = "NOMBRADO 276"; break;
			case 2: condicion = "NOMBRADO 278"; break;
			case 3: condicion = "D.L. 10578(CAS)"; break;
			case 4: condicion = "LOCADOR"; break;
		}

		return condicion;

	}

	function certificacion(id) {

		var certificacion = "";

		switch (parseInt(id)) {
			case 1: certificacion = "BRIGADISTA"; break;
			case 2: certificacion = "E.M.T. I"; break;
			case 3: certificacion = "E.M.T. II"; break;
			case 4: certificacion = "E.M.T. III"; break;
			case 5: certificacion = "CELULA ESPECIALIZADA"; break;
		}

		return certificacion;

	}

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

	$.fn.dataTable.ext.errMode = 'none';

	var tableEvento = "";
	var tableEntidadesSalud = "";

	$(document).ready(function () {

		$("#evento_fecha").datetimepicker({
			format: "DD/MM/YYYY",
			maxDate: moment()
		});
		tableEntidadesSalud = $('.tableEntidadesSalud').DataTable(
			{
				pageLength: 5,
				columns: [{
					"data": "CodEESS"
				}, {
					"data": "Nombre"
				}, {
					"data": "Clasificacion"
				}],
				"ajax": {
					url: URI + "brigadistas/entidadesSaludAjax",
					type: "POST",
					data: function (d) {
						d.departamento = document
							.getElementById("departamento").value,
							d.provincia = document
								.getElementById("provincia").value,
							d.distrito = document
								.getElementById("distrito").value
					}
				}
			});
		setTimeout(function () {
			tableEvento = $('.tableEvento').DataTable(

				{
					pageLength: 25,
					columns: [
						{ "data": "evento" },
						{ "data": "eventoDetalle" },
						{ "data": "fecha" },
						{ "data": "ubigeo" },
						{ "data": "Evento_Estado_Codigo" },
						{ "data": "id" }
					],
					columnDefs: [{
						"targets": [5],
						"visible": false,
						"searchable": false
					}],
					"ajax": {
						url: URI + "brigadistas/eventosAjax",
						type: "POST",
						data: function (d) {
							d.evento_tipo = document.getElementById("evento_tipo").value,
								d.evento_fecha = document.getElementById("evento_fecha").value
						}
					}
				});

		}, 300);

		$("#btnBuscarEventoModal").on("click", function () {
			$("#btnBuscarEventoModal").html("Buscando...");
			$("#btnBuscarEventoModal").addClass("disabled");
			setTimeout(function () {
				tableEvento.ajax.reload();
				if (tableEvento.draw()) {
					$("#btnBuscarEventoModal").html("Buscar");
					$("#btnBuscarEventoModal").removeClass("disabled");
				}
			}, 300);

		})

		$('.tableEvento tbody').on('click', 'tr', function () {
			var data = tableEvento.row(this).data();

			$(".evento_content").css("display", "block");
			var evento_fecha = $("#evento_fecha").val();
			$(".evento_datos").html(data.evento + "- " + data.eventoDetalle + " - " + data.fecha + "<br />" + data.ubigeo);
			$(".idevento").val(data.id);
			$('#busquedaEventoModal').modal('hide');
		});

		$("#datetimepicker,#datetimepicker2,#datetimepicker3").datetimepicker({
			format: "DD/MM/YYYY"
		});

		$(".agregar").on("click", function () {

			location.href = URI + "brigadistas/nuevo";

		});

		var table = $('.tbLista').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
			columns: [
				{ "data": "id" },
				{ "data": "brigadistas" },
				{ "data": "numero_documento" },
				{ "data": "genero" },
				{ "data": "fecha_nacimiento" },
				{ "data": "grado_estudio" },
				{ "data": "informacion_laboral" },
				{ "data": "certificaciones" },
				{ "data": "capacitaciones" },
				{ "data": "emergrencias" },
				{ "data": "contingencias" },
				{ "data": "foto" },
				{ "data": "informe" },
				{ "data": "fotocheck" },
				{ "data": "accion" },
				{ "data": "imagen" }

			],
			columnDefs: [{
				"targets": [15],
				"visible": false,
				"searchable": false
			}],
			"order": [[0, "asc"]],
			buttons: [
				{
					extend: 'copy',
					title: 'lista-Eventos',
					exportOptions: { columns: [0, 1, 2, 3] },
				},
				{
					extend: 'csv',
					title: 'lista Eventos',
					exportOptions: { columns: [0, 1, 2, 3] },
				},
				{
					extend: 'excel',
					title: 'lista Eventos',
					exportOptions: { columns: [0, 1, 2, 3] },
				},
				{
					extend: 'pdf',
					title: 'lista Eventos',
					orientation: 'landscape',
					exportOptions: { columns: [0, 1, 2, 3] },
				},

				{
					extend: 'print',
					title: 'lista Eventos',
					exportOptions: { columns: [0, 1, 2, 3] },
					customize: function (win) {
						$(win.document.body).addClass('white-bg');
						$(win.document.body).css('font-size', '10px');

						$(win.document.body).find('table')
							.addClass('compact')
							.css('font-size', 'inherit');

						var css = '@page { size: landscape; }',
							head = win.document.head || win.document.getElementsByTagName('head')[0],
							style = win.document.createElement('style');

						style.type = 'text/css';
						style.media = 'print';

						if (style.styleSheet) {
							style.styleSheet.cssText = css;
						}
						else {
							style.appendChild(win.document.createTextNode(css));
						}

						head.appendChild(style);
					}
				}
			]

		});

		var table = "";

		$('body').on('click', 'td i.foto', function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			data = row.data();

		});
		$('body').on('click', '.tbLista tr', function () {

			$("#Tipo_Accion").val("");

			var tr = $(this);
			var row = table.row(tr);

			index = row.index();

			data = row.data();
			var id = data.id;

			$("#btn-editar").removeClass("editar");
			$("#btn-anular").removeClass("anular");
			$("#btn-editar").addClass("editar");
			$("#btn-anular").addClass("anular");
			$("#btn-editar").find("label").attr("rel", id);
			$("#btn-anular").find("label").attr("rel", id);

			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}

		});
		$('#btn-editar').on('click', function () {

			var id = $(this).find("label").attr("rel");
			post(URI + "brigadistas/edicion", { id: id });
		});

		$('#btn-anular').on('click', function () {

			var Evento_Registro_Numero = $(this).find("label").attr("rel");

			$("#Tipo_Accion").val("3");

			$("#decisionModal #btn-decision").text("Anular");
			$("#decisionModal").modal("show");
			$("#decisionModal .modal-title").text("Anular Evento");
			$("#decisionModal .modal-body p").html("Est\xe1 seguro de anular el evento");
		});

		$('body').on('click', 'td i.foto', function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			datos = row.data();
			$("#fotoModal").modal("show");
			$("#fotoModal img").attr("src", URI + "public/images/brigadistas/" + datos.imagen);

		});

		$("#formRegistrarEspecialidad select[name=brigadistas_profesiones_id]").on("change", function () {

			$id = $(this).val();

			if ($id.length > 0) {
				$.ajax({
					type: "POST",
					url: URI + "brigadistas/listaEspecialidades",
					data: { id: $id },
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
					},
					success: function (data) {
						$("#modalCargaGeneral").css("display", "none");
						$("#instruccionModal").modal("show");

						var html = '<option value="">- Seleccione -</option>';

						$.each(data.especialidades, function (i, e) {
							html += '<option value="' + e.brigadistas_especialidad_id + '">' + e.especialidad + '</option>';
						});

						$("#formRegistrarEspecialidad select[name=brigadistas_especialidad_id]").html(html);
					}
				});
			}

		});

		$("#formRegistrarTrabajo").validate({
			rules: {
				email_institucional: { email: true }
			},
			messages: {
				email_institucional: { email: "Email inv\xe1lido" }
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				$.ajax({
					type: "POST",
					url: URI + "brigadistas/registrarTrabajo",
					data: $("#formRegistrarTrabajo").serialize(),
					dataType: "json",
					beforeSend: function () {
						$("#formRegistrarTrabajo button[type=submit]").text("Agregando...");
						$("#formRegistrarTrabajo button").addClass("disabled");
					},
					success: function (data) {

						$("#formRegistrarTrabajo button[type=submit]").text("Agregar");
						$("#formRegistrarTrabajo button").removeClass("disabled");

						var html = "";
						var count = 0;

						sinRegistros = $("#tableTrabajo tbody tr.sin-registros").length;

						if (parseInt(data.status) == 200) {

							if (parseInt(data.id) > 0) {

								if (parseInt(sinRegistros) > 0) {
									html = '<tr><td class="text-center">' + $("#formRegistrarTrabajo").find("select[name=DIRESA] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarTrabajo").find("input[name=Red]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarTrabajo").find("input[name=MicroRed]").val() + '</td>';
									html += '<td class="text-center">' + condicionLaboral($("#formRegistrarTrabajo").find("select[name=condicion_laboral]").val()) + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarTrabajo").find("input[name=cargo]").val() + '</td><td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}
								else {
									html = $("#tableTrabajo tbody").html();
									html += '<tr><td class="text-center">' + $("#formRegistrarTrabajo").find("select[name=DIRESA] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarTrabajo").find("input[name=Red]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarTrabajo").find("input[name=MicroRed]").val() + '</td>';
									html += '<td class="text-center">' + condicionLaboral($("#formRegistrarTrabajo").find("select[name=condicion_laboral]").val()) + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarTrabajo").find("input[name=cargo]").val() + '</td><td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}

								$("#formRegistrarTrabajo")[0].reset();

							}

							$("#tableTrabajo tbody").html(html);

						}
						else if (parseInt(data.status) == 201) {
							$("#duplicate_trabajo").removeClass("hide");
							setTimeout(function () {
								$("#duplicate_trabajo").addClass("hide");
							}, 2000);
						}
						else {
							alert("Error al registrar");
						}

					}
				});
			}
		});

		$('body').on('click', 'td i.trabajo', function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			datos = row.data();

			$.ajax({
				type: "POST",
				url: URI + "brigadistas/listaTrabajos",
				data: { id: datos.id },
				dataType: "json",
				beforeSend: function () {
					$("#modalCargaGeneral").css("display", "block");
				},
				success: function (data) {
					$("#modalCargaGeneral").css("display", "none");
					$("#trabajoModal").modal("show");

					var html = "";
					var count = 0;

					$("#formRegistrarTrabajo").find("input[name=idBrigadistaTrabajo]").val(datos.id);

					$.each(data.trabajos, function (i, e) {
						count++;
						html += '<tr><td class="text-center">' + e.DIRESA + '</td><td class="text-center">' + e.Red + '</td><td class="text-center">' + e.MicroRed + '</td>';
						html += '<td class="text-center">' + condicionLaboral(e.condicion_laboral) + '</td><td class="text-center">' + e.cargo + '</td>';
						html += '<td class="delete" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
					});

					if (count == 0) html = "<tr class='sin-registros'><td colspan='6' class='text-center'>No hay registros</td></tr>";

					$("#tableTrabajo tbody").html(html);
				}
			});

		});

		$("html").on("click", "#formRegistrarTrabajo table tbody tr td.delete", function () {
			console.log("Ingresa");
			var id = $(this).attr("rel");
			$("#deleteTrabajoModal").modal("show");
			$("#deleteTrabajoModal").find("input[name=id]").val(id);

		});

		$('body').on('click', 'td i.instruccion', function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			datos = row.data();

			$.ajax({
				type: "POST",
				url: URI + "brigadistas/profesiones",
				data: { id: datos.id },
				dataType: "json",
				beforeSend: function () {
					$("#modalCargaGeneral").css("display", "block");
				},
				success: function (data) {
					$("#modalCargaGeneral").css("display", "none");
					$("#instruccionModal").modal("show");

					$("#formRegistrarEspecialidad").find("input[name=id]").val(datos.id);
					var html = "";
					var count = 0;

					$.each(data.profesiones, function (i, e) {
						count++;
						html += '<tr><td class="text-center">' + e.profesion + '</td><td class="text-center">' + e.especialidad + '</td><td class="delete" rel="' + e.brigadistas_detalle_especialidades_id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
					});

					if (count == 0) html = "<tr class='sin-registros'><td colspan='3' class='text-center'>No hay registros</td></tr>";

					$("#tableInstruccion tbody").html(html);
				}
			});

		});

		$("#formRegistrarEspecialidad").validate({
			rules: {
				brigadistas_profesiones_id: { required: true },
				brigadistas_especialidad_id: { required: true }
			},
			messages: {
				brigadistas_profesiones_id: { required: "(*) Campo Requerido" },
				brigadistas_especialidad_id: { required: "(*) Campo Requerido" }
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				$.ajax({
					type: "POST",
					url: URI + "brigadistas/registrarEspecialidad",
					data: $("#formRegistrarEspecialidad").serialize(),
					dataType: "json",
					beforeSend: function () {
						$("#formRegistrarEspecialidad button[type=submit]").text("Agregando...");
						$("#formRegistrarEspecialidad button").addClass("disabled");
					},
					success: function (data) {

						$("#formRegistrarEspecialidad button[type=submit]").text("Agregar");
						$("#formRegistrarEspecialidad button").removeClass("disabled");

						var html = "";
						var count = 0;

						sinRegistros = $("#tableInstruccion tbody tr.sin-registros").length;

						if (parseInt(data.status) == 200) {

							if (parseInt(data.id) > 0) {

								if (parseInt(sinRegistros) > 0) {
									html = '<tr><td class="text-center">' + $("#formRegistrarEspecialidad").find("select[name=brigadistas_profesiones_id] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarEspecialidad").find("select[name=brigadistas_especialidad_id] option:selected").text() + '</td><td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}
								else {
									html = $("#tableInstruccion tbody").html();
									html += '<tr><td class="text-center">' + $("#formRegistrarEspecialidad").find("select[name=brigadistas_profesiones_id] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarEspecialidad").find("select[name=brigadistas_especialidad_id] option:selected").text() + '</td><td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}

								$("#formRegistrarEspecialidad")[0].reset();

							}

							$("#tableInstruccion tbody").html(html);

						}
						else if (parseInt(data.status) == 201) {
							$("#duplicate_especialidad").removeClass("hide");
							setTimeout(function () {
								$("#duplicate_especialidad").addClass("hide");
							}, 2000);
						}
						else {
							alert("Error al registrar");
						}

					}
				});
			}
		});

		$("html").on("click", "#formRegistrarEspecialidad table tr td.delete", function () {

			var id = $(this).attr("rel");
			$("#deleteEspecialidadModal").modal("show");
			$("#deleteEspecialidadModal").find("input[name=id]").val(id);

		});
		$('body').on('click', 'td i.certificado', function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			datos = row.data();

			$.ajax({
				type: "POST",
				url: URI + "brigadistas/listaCertificacion",
				data: { id: datos.id },
				dataType: "json",
				beforeSend: function () {
					$("#modalCargaGeneral").css("display", "block");
				},
				success: function (data) {
					$("#modalCargaGeneral").css("display", "none");

					$("#certificadoModal").modal("show");
					$("#idBrigadistaCertificacion").val(datos.id);
					var html = "";
					var count = 0;

					$.each(data.certificaciones, function (i, e) {
						count++;
						html += '<tr><td class="text-center">' + certificacion(e.tipo_certificacion) + '</td><td class="text-center">' + e.fecha_reconocimiento + '</td>';
						html += '<td class="text-center">' + e.resolucion + '</td><td class="text-center">' + e.fecha_inicio + '</td><td class="text-center">' + e.fecha_vencimiento + '</td>';

						if (e.archivo.length > 0) html += '<td><a href="' + URI + 'public/certificados/' + e.archivo + '"><i class="fa fa-file-code-o" aria-hidden="true"></i></a></td>'; else html += '<td>&nbsp;</td>';
						html += '<td class="delete" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
					});

					if (count == 0) html = "<tr class='sin-registros'><td colspan='7' class='text-center'>No hay registros</td></tr>";

					$("#tableCertificacion tbody").html(html);
				}
			});

		});

		$("#formRegistrarCertificacion").validate({
			rules: {
				tipo_certificacion: { required: true },
				fecha_reconocimiento: { required: true },
				resolucion: { required: true },
				fecha_inicio: { required: true },
				fecha_vencimiento: { required: true }
			},
			messages: {
				tipo_certificacion: { required: "(*) Campo Requerido" },
				fecha_reconocimiento: { required: "(*) Campo Requerido" },
				resolucion: { required: "(*) Campo Requerido" },
				fecha_inicio: { required: "(*) Campo Requerido" },
				fecha_vencimiento: { required: "(*) Campo Requerido" }
			},
			errorPlacement: function (error, element) {
				if (element.attr("name") == "fecha_reconocimiento") {
					error.insertAfter("#error_fecha_reconocimiento");
				}
				else if (element.attr("name") == "fecha_inicio") {
					error.insertAfter("#error_fecha_inicio");
				}
				else if (element.attr("name") == "fecha_vencimiento") {
					error.insertAfter("#error_fecha_vencimiento");
				}
				else {
					error.insertAfter(element);
				}
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				var formData = new FormData(document.getElementById("formRegistrarCertificacion"));
				formData.append("id", document.getElementById("idBrigadistaCertificacion").value);
				formData.append("file", document.getElementById("file"));

				formData.append("tipo_certificacion", document.getElementById("tipo_certificacion").value);
				formData.append("fecha_reconocimiento", document.getElementById("fecha_reconocimiento").value);
				formData.append("resolucion", document.getElementById("resolucion").value);
				formData.append("fecha_inicio", document.getElementById("fecha_inicio").value);
				formData.append("fecha_vencimiento", document.getElementById("fecha_vencimiento").value);

				$.ajax({
					url: URI + "brigadistas/registrarCertificacion",
					data: formData,
					method: "POST",
					dataType: "json",
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function () {
						$("#formRegistrarCertificacion button[type=submit]").text("Agregando...");
						$("#formRegistrarCertificacion button").addClass("disabled");
					},
					success: function (data) {

						$("#formRegistrarCertificacion button[type=submit]").text("Agregar");
						$("#formRegistrarCertificacion button").removeClass("disabled");

						var html = "";
						var count = 0;

						sinRegistros = $("#tableCertificacion tbody tr.sin-registros").length;

						if (parseInt(data.status) == 200) {

							if (parseInt(data.id) > 0) {

								if (parseInt(sinRegistros) > 0) {
									html = '<tr><td class="text-center">' + $("#formRegistrarCertificacion").find("select[name=tipo_certificacion] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCertificacion").find("input[name=fecha_reconocimiento]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCertificacion").find("input[name=resolucion]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCertificacion").find("input[name=fecha_inicio]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCertificacion").find("input[name=fecha_vencimiento]").val() + '</td>';

									if (data.archivo.length > 0) html += '<td><a href="' + URI + 'public/certificados/' + data.archivo + '"><i class="fa fa-file-code-o" aria-hidden="true"></i></a></td>'; else html += '<td>&nbsp;</td>';
									html += '<td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true" rel="' + data.id + '"></i></span></td></tr>';
								}
								else {
									html = $("#tableCertificacion tbody").html();
									html += '<tr><td class="text-center">' + $("#formRegistrarCertificacion").find("select[name=tipo_certificacion] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCertificacion").find("input[name=fecha_reconocimiento]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCertificacion").find("input[name=resolucion]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCertificacion").find("input[name=fecha_inicio]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCertificacion").find("input[name=fecha_vencimiento]").val() + '</td>';

									if (data.archivo.length > 0) html += '<td><a href="' + URI + 'public/certificados/' + data.archivo + '"><i class="fa fa-file-code-o" aria-hidden="true"></i></a></td>'; else html += '<td>&nbsp;</td>';
									html += '<td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}

								$("#formRegistrarCertificacion")[0].reset();
								$(".inputfile").next('label').html('<i class="fa fa-upload" aria-hidden="true"></i> <span>Escoger archivo…</span>');

							}

							$("#tableCertificacion tbody").html(html);

						}
						else if (parseInt(data.status) == 201) {
							$("#duplicate_certificacion").removeClass("hide");
							setTimeout(function () {
								$("#duplicate_certificacion").addClass("hide");
							}, 2000);
						}
						else {
							alert("Error al registrar");
						}

					}
				});
			}
		});

		$("html").on("click", "#formRegistrarCertificacion table tr td.delete", function () {

			var id = $(this).attr("rel");
			$("#deleteCertificacionModal").modal("show");
			$("#deleteCertificacionModal").find("input[name=id]").val(id);

		});

		var $input = $(".inputfile");
		var $label = $input.next('label');
		var labelVal = $label.html();

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

		$('body').on('click', 'td i.capacitacion', function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			datos = row.data();
			$.ajax({
				type: "POST",
				url: URI + "brigadistas/listaCapacitacion",
				data: { id: datos.id },
				dataType: "json",
				beforeSend: function () {
					$("#modalCargaGeneral").css("display", "block");
				},
				success: function (data) {
					$("#modalCargaGeneral").css("display", "none");

					$("#capacitacionModal").modal("show");
					$("#formRegistrarCapacitacion").find("input[name=id]").val(datos.id);
					var html = "";
					var count = 0;

					$.each(data.capacitaciones, function (i, e) {
						count++;
						html += '<tr><td class="text-center">' + e.curso_capacitacion + '</td><td class="text-center">' + e.entidad + '</td>';
						html += '<td class="text-center">' + e.fecha_inicio + '</td><td class="text-center">' + e.fecha_fin + '</td><td class="text-center">' + e.horas + '</td>';
						html += '<td class="delete" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
					});

					if (count == 0) html = "<tr class='sin-registros'><td colspan='7' class='text-center'>No hay registros</td></tr>";

					$("#tableCapacitacion tbody").html(html);
				}
			});

		});

		$("#formRegistrarCapacitacion").validate({
			rules: {
				brigadistas_cursos_id: { required: true },
				entidad: { required: true },
				fecha_inicio: { required: true },
				fecha_fin: { required: true },
				duracion: { required: true }
			},
			messages: {
				brigadistas_cursos_id: { required: "(*) Campo Requerido" },
				entidad: { required: "(*) Campo Requerido" },
				fecha_inicio: { required: "(*) Campo Requerido" },
				fecha_fin: { required: "(*) Campo Requerido" },
				duracion: { required: "(*) Campo Requerido" }
			},
			errorPlacement: function (error, element) {
				if (element.attr("name") == "fecha_inicio") {
					error.insertAfter("#error_capcitacion_fecha_inicio");
				}
				else if (element.attr("name") == "fecha_fin") {
					error.insertAfter("#error_capcitacion_fecha_fin");
				}
				else {
					error.insertAfter(element);
				}
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				$.ajax({
					url: URI + "brigadistas/registrarCapacitacion",
					data: $("#formRegistrarCapacitacion").serialize(),
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#formRegistrarCapacitacion button[type=submit]").text("Agregando...");
						$("#formRegistrarCapacitacion button").addClass("disabled");
					},
					success: function (data) {

						$("#formRegistrarCapacitacion button[type=submit]").text("Agregar");
						$("#formRegistrarCapacitacion button").removeClass("disabled");

						var html = "";
						var count = 0;

						sinRegistros = $("#tableCapacitacion tbody tr.sin-registros").length;

						if (parseInt(data.status) == 200) {

							if (parseInt(data.id) > 0) {

								if (parseInt(sinRegistros) > 0) {
									html = '<tr><td class="text-center">' + $("#formRegistrarCapacitacion").find("select[name=brigadistas_cursos_id] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCapacitacion").find("input[name=entidad]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCapacitacion").find("input[name=fecha_inicio]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCapacitacion").find("input[name=fecha_fin]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCapacitacion").find("input[name=duracion]").val() + '</td>';
									html += '<td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}
								else {
									html = $("#tableCapacitacion tbody").html();
									html += '<tr><td class="text-center">' + $("#formRegistrarCapacitacion").find("select[name=brigadistas_cursos_id] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCapacitacion").find("input[name=entidad]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCapacitacion").find("input[name=fecha_inicio]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCapacitacion").find("input[name=fecha_fin]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarCapacitacion").find("input[name=duracion]").val() + '</td>';
									html += '<td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}

								$("#formRegistrarCapacitacion")[0].reset();

							}

							$("#tableCapacitacion tbody").html(html);

						}
						else if (parseInt(data.status) == 201) {
							$("#duplicate_capacitacion").removeClass("hide");
							setTimeout(function () {
								$("#duplicate_capacitacion").addClass("hide");
							}, 2000);
						}
						else {
							alert("Error al registrar");
						}

					}
				});
			}
		});

		$("html").on("click", "#formRegistrarCapacitacion table tr td.delete", function () {

			var id = $(this).attr("rel");
			$("#deleteCapacitacionesModal").modal("show");
			$("#deleteCapacitacionesModal").find("input[name=id]").val(id);

		});

		$('body').on('click', 'td i.emergencia', function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			datos = row.data();

			$.ajax({
				type: "POST",
				url: URI + "brigadistas/listaEmergencias",
				data: { id: datos.id },
				dataType: "json",
				beforeSend: function () {
					$("#modalCargaGeneral").css("display", "block");
				},
				success: function (data) {
					$("#modalCargaGeneral").css("display", "none");

					$(".evento_content").css("display", "none");
					$(".idevento").val("");
					$(".evento_datos").html("");

					$("#emergenciaModal").modal("show");
					$("#formRegistrarEmergencia").find("input[name=id]").val(datos.id);
					var html = "";
					var count = 0;

					$.each(data.emergencias, function (i, e) {
						count++;
						var lider = (e.lider) ? "Sí" : "No";
						var fuerza_tarea = (e.fuerza_tarea) ? "Sí" : "No";
						var calificacion = "[N/A]";
						switch (parseInt(e.calificacion)) {
							case 1: calificacion = "EXCELENTE"; break;
							case 2: calificacion = "ACEPTABLE"; break;
							case 3: calificacion = "REGULAR/MALO"; break;
						}
						html += '<tr><td class="text-center">' + lider + '</td>';
						html += '<td class="text-center">' + fuerza_tarea + '</td>';
						html += '<td class="text-center">' + calificacion + '</td>';
						html += '<td class="delete" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';;
					});

					if (count == 0) html = "<tr class='sin-registros'><td colspan='7' class='text-center'>No hay registros</td></tr>";

					$("#tableEmergencia tbody").html(html);
				}
			});

		});

		$("#formRegistrarEmergencia").validate({
			rules: {
				calificacion: { required: true },
				acciones_realizadas: { required: true },
				idevento: { required: true }
			},
			messages: {
				calificacion: { required: "(*) Campo Requerido" },
				acciones_realizadas: { required: "(*) Campo Requerido" },
				idevento: { required: "Seleccione un evento" }
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				var idevento = $("#formRegistrarEmergencia").find("input[name=idevento]").val();

				if (idevento.length == 0) {
					$("#formRegistrarEmergencia").find(".btn-danger").after('<p class="mensaje_evento text-danger text-center">Seleccione un evento</p>');
					setTimeout(function () {
						$(".mensaje_evento").remove();
					}, 2000);

					return;
				}

				$.ajax({
					url: URI + "brigadistas/registrarEmergencia",
					data: $("#formRegistrarEmergencia").serialize(),
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#formRegistrarEmergencia button[type=submit]").text("Agregando...");
						$("#formRegistrarEmergencia button").addClass("disabled");
					},
					success: function (data) {

						$("#formRegistrarEmergencia button[type=submit]").text("Agregar");
						$("#formRegistrarEmergencia button").removeClass("disabled");

						var html = "";
						var count = 0;

						sinRegistros = $("#tableEmergencia tbody tr.sin-registros").length;

						if (parseInt(data.status) == 200) {

							if (parseInt(data.id) > 0) {

								var lider = ($("#formRegistrarEmergencia").find("input[name=lider]").prop("checked")) ? "Sí" : "No";
								var fuerza_tarea = ($("#formRegistrarEmergencia").find("input[name=fuerza_tarea]").prop("checked")) ? "Sí" : "No";

								if (parseInt(sinRegistros) > 0) {

									html = '<tr><td class="text-center">' + lider + '</td>';
									html += '<td class="text-center">' + fuerza_tarea + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarEmergencia").find("select[name=calificacion] option:selected").text() + '</td>';
									html += '<td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}
								else {
									html = $("#tableEmergencia tbody").html();
									html += '<tr><td class="text-center">' + lider + '</td>';
									html += '<td class="text-center">' + fuerza_tarea + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarEmergencia").find("select[name=calificacion] option:selected").text() + '</td>';
									html += '<td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}

								$("#formRegistrarEmergencia")[0].reset();
								$(".idevento").val("");
								$(".evento_datos").html("");
								$(".evento_content").css("display", "none");
							}

							$("#tableEmergencia tbody").html(html);

						}
						else if (parseInt(data.status) == 201) {
							$("#duplicate_emergencia").removeClass("hide");
							setTimeout(function () {
								$("#duplicate_emergencia").addClass("hide");
							}, 2000);
						}
						else {
							alert("Error al registrar");
						}

					}
				});
			}
		});

		$("html").on("click", "#formRegistrarEmergencia table tr td.delete", function () {

			var id = $(this).attr("rel");
			$("#deleteEmergenciaModal").modal("show");
			$("#deleteEmergenciaModal").find("input[name=id]").val(id);

		});

		$('body').on('click', 'td i.contingencia', function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			datos = row.data();

			$.ajax({
				type: "POST",
				url: URI + "brigadistas/listaContingencias",
				data: { id: datos.id },
				dataType: "json",
				beforeSend: function () {
					$("#modalCargaGeneral").css("display", "block");
				},
				success: function (data) {
					$("#modalCargaGeneral").css("display", "none");

					$(".evento_content").css("display", "none");
					$(".idevento").val("");
					$(".evento_datos").html("");

					$("#contingenciaModal").modal("show");
					$("#formRegistrarContingencia").find("input[name=id]").val(datos.id);
					var html = "";
					var count = 0;

					$.each(data.contingencias, function (i, e) {
						count++;
						var lider = (e.lider) ? "Sí" : "No";
						var fuerza_tarea = (e.fuerza_tarea) ? "Sí" : "No";
						var calificacion = "[N/A]";
						switch (parseInt(e.calificacion)) {
							case 1: calificacion = "EXCELENTE"; break;
							case 2: calificacion = "ACEPTABLE"; break;
							case 3: calificacion = "REGULAR/MALO"; break;
						}
						html += '<tr><td class="text-center">' + lider + '</td>';
						html += '<td class="text-center">' + fuerza_tarea + '</td>';
						html += '<td class="text-center">' + calificacion + '</td>';
						html += '<td class="delete" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';;
					});

					if (count == 0) html = "<tr class='sin-registros'><td colspan='7' class='text-center'>No hay registros</td></tr>";

					$("#tableContingencia tbody").html(html);
				}
			});

		});

		$("#formRegistrarContingencia").validate({
			rules: {
				calificacion: { required: true },
				acciones_realizadas: { required: true },
				idevento: { required: true }
			},
			messages: {
				calificacion: { required: "(*) Campo Requerido" },
				acciones_realizadas: { required: "(*) Campo Requerido" },
				idevento: { required: "Seleccione un evento" }
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				var idevento = $("#formRegistrarContingencia").find("input[name=idevento]").val();

				if (idevento.length == 0) {
					$("#formRegistrarContingencia").find(".btn-danger").after('<p class="mensaje_evento text-danger text-center">Seleccione un evento</p>');
					setTimeout(function () {
						$(".mensaje_evento").remove();
					}, 2000);

					return;
				}

				$.ajax({
					url: URI + "brigadistas/registrarContingencia",
					data: $("#formRegistrarContingencia").serialize(),
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#formRegistrarContingencia button[type=submit]").text("Agregando...");
						$("#formRegistrarContingencia button").addClass("disabled");
					},
					success: function (data) {

						$("#formRegistrarContingencia button[type=submit]").text("Agregar");
						$("#formRegistrarContingencia button").removeClass("disabled");

						var html = "";
						var count = 0;

						sinRegistros = $("#tableContingencia tbody tr.sin-registros").length;

						if (parseInt(data.status) == 200) {

							if (parseInt(data.id) > 0) {

								var lider = ($("#formRegistrarContingencia").find("input[name=lider]").prop("checked")) ? "Sí" : "No";
								var fuerza_tarea = ($("#formRegistrarContingencia").find("input[name=fuerza_tarea]").prop("checked")) ? "Sí" : "No";

								if (parseInt(sinRegistros) > 0) {

									html = '<tr><td class="text-center">' + lider + '</td>';
									html += '<td class="text-center">' + fuerza_tarea + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarContingencia").find("select[name=calificacion] option:selected").text() + '</td>';
									html += '<td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}
								else {
									html = $("#tableContingencia tbody").html();
									html += '<tr><td class="text-center">' + lider + '</td>';
									html += '<td class="text-center">' + fuerza_tarea + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarContingencia").find("select[name=calificacion] option:selected").text() + '</td>';
									html += '<td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}

								$("#formRegistrarContingencia")[0].reset();
								$(".idevento").val("");
								$(".evento_datos").html("");
								$(".evento_content").css("display", "none");
							}

							$("#tableContingencia tbody").html(html);

						}
						else if (parseInt(data.status) == 201) {
							$("#duplicate_contingencia").removeClass("hide");
							setTimeout(function () {
								$("#duplicate_contingencia").addClass("hide");
							}, 2000);
						}
						else {
							alert("Error al registrar");
						}

					}
				});
			}
		});

		$("html").on("click", "#formRegistrarContingencia table tr td.delete", function () {

			var id = $(this).attr("rel");
			$("#deleteContingenciaModal").modal("show");
			$("#deleteContingenciaModal").find("input[name=id]").val(id);

		});

		$("#btnFiltrarUbigeo").on("click", function () {

			var departamento = $("#departamento").val();
			var provincia = $("#provincia").val();
			var distrito = $("#distrito").val();

			if (departamento.length > 0
				&& provincia.length > 0
				&& distrito.length > 0) {
				tableEntidadesSalud.ajax.reload();
				tableEntidadesSalud.draw();
			} else {
				$("#alertaModal").modal("show");
				$("#alertaModal #tituloalerta").text("Error");
				$("#alertaModal #mensajealerta").html("Debe seleccionar el ubigeo");
				return false;

			}

		});

		$('.tableEntidadesSalud tbody').on('click', 'tr', function () {
			var data = tableEntidadesSalud.row(this).data();

			$("input[name=CodEESS]").val(data.CodEESS);
			$("input[name=CodEESS_Nombre").val(data.Nombre);
			$('#tableEntidadesSaludModal').modal('hide');
		});

		$("#departamento").change(function () {

			var id = $(this).val();
			if (id.length > 0) {

				$.ajax({
					data: {
						departamento: id
					},
					url: URI + "brigadistas/cargarProvincias",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#provincia").html('<option value="">Cargando...</option>');
						$("#distrito").html('<option value="">--Elija Provincia--</option>');
					},
					success: function (data) {

						var $html = '<option value="">--Seleccione--</option>';
						$.each(data.lista, function (i, e) {
							$html += '<option value="' + e.Codigo_Provincia + '">' + e.Nombre + '</option>';
						});
						$("#provincia").html($html);

					}
				});

			}
		});

		$("#provincia").change(function () {

			var id = $(this).val();
			var departamento = $("#departamento").val();

			if (id.length > 0 && departamento.length > 0) {

				$.ajax({
					data: {
						departamento: departamento,
						provincia: id
					},
					url: URI + "brigadistas/cargarDistritos",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#distrito").html('<option value="">Cargando...</option>');
					},
					success: function (data) {

						var $html = '<option value="">--Seleccione--</option>';
						$.each(data.lista, function (i, e) {
							$html += '<option value="' + e.Codigo_Distrito + '">' + e.Nombre + '</option>';
						});
						$("#distrito").html($html);

					}
				});

			}
		});

		$("#formRegistrarFotocheck").validate({
			rules: {
				brigadistas_profesiones_id: { required: true },
				brigadistas_especialidad_id: { required: true },
				fecha_emision: { required: true },
				fecha_vencimiento: { required: true },
				brigadistas_certificacion_id: { required: true }
			},
			messages: {
				brigadistas_profesiones_id: { required: "(*) Campo Requerido" },
				brigadistas_especialidad_id: { required: "(*) Campo Requerido" },
				fecha_emision: { required: "(*) Campo Requerido" },
				fecha_vencimiento: { required: "(*) Campo Requerido" },
				brigadistas_certificacion_id: { required: "(*) Campo Requerido" }
			},
			errorPlacement: function (error, element) {
				if (element.attr("name") == "fecha_emision") {
					error.insertAfter("#error_fecha_emision_f");
				}
				else if (element.attr("name") == "fecha_vencimiento") {
					error.insertAfter("#error_fecha_vencimiento_f");
				}
				else {
					error.insertAfter(element);
				}
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				$.ajax({
					type: "POST",
					url: URI + "brigadistas/registrarFotocheck",
					data: $("#formRegistrarFotocheck").serialize(),
					dataType: "json",
					beforeSend: function () {
						$("#formRegistrarFotocheck button[type=submit]").text("Agregando...");
						$("#formRegistrarFotocheck button").addClass("disabled");
					},
					success: function (data) {

						$("#formRegistrarFotocheck button[type=submit]").text("Agregar");
						$("#formRegistrarFotocheck button").removeClass("disabled");

						var html = "";
						var count = 0;

						sinRegistros = $("#tableFotocheck tbody tr.sin-registros").length;

						if (parseInt(data.status) == 200) {

							if (parseInt(data.id) > 0) {

								if (parseInt(sinRegistros) > 0) {
									html = '<tr><td class="text-center">' + $("#formRegistrarFotocheck").find("select[name=brigadistas_profesiones_id] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarFotocheck").find("select[name=brigadistas_especialidad_id] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarFotocheck").find("input[name=fecha_emision]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarFotocheck").find("input[name=fecha_vencimiento]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarFotocheck").find("select[name=brigadistas_certificacion_id] option:selected").text() + '</td>';
									html += '<td class="fotocheck" ><a href="' + URI + 'brigadistas/fotocheck/' + data.id + '" target="_blank"><i class="fa fa-user" aria-hidden="true"></i></a></td>';
									html += '<td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}
								else {
									html = $("#tableFotocheck tbody").html();
									html += '<tr><td class="text-center">' + $("#formRegistrarFotocheck").find("select[name=brigadistas_profesiones_id] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarFotocheck").find("select[name=brigadistas_especialidad_id] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarFotocheck").find("input[name=fecha_emision]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarFotocheck").find("input[name=fecha_vencimiento]").val() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarFotocheck").find("select[name=brigadistas_certificacion_id] option:selected").text() + '</td>';
									html += '<td class="fotocheck"><a href="' + URI + 'brigadistas/fotocheck/' + data.id + '" target="_blank"><i class="fa fa-user" aria-hidden="true"></i></a></td>';
									html += '<td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}

								$("#formRegistrarFotocheck")[0].reset();
								$("#formRegistrarFotocheck select[name=brigadistas_certificacion_id]").val("0");

							}

							$("#tableFotocheck tbody").html(html);

						}
						else if (parseInt(data.status) == 201) {
							$("#duplicate_fotocheck").removeClass("hide");
							setTimeout(function () {
								$("#duplicate_fotocheck").addClass("hide");
							}, 2000);
						}
						else {
							alert("Error al registrar");
						}

					}
				});
			}
		});

		$("html").on("click", "#formRegistrarFotocheck table tr td.delete", function () {

			var id = $(this).attr("rel");
			$("#deleteFotocheckModal").modal("show");
			$("#deleteFotocheckModal").find("input[name=id]").val(id);

		});

		$('body').on('click', 'td i.fotocheck', function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			datos = row.data();
			var id = datos.id;

			$("#formRegistrarFotocheck #nombres").html(datos.brigadistas);
			$("#formRegistrarFotocheck input[name=id]").val(datos.id);

			$.ajax({
				type: "POST",
				url: URI + "brigadistas/profesionesBrigadistaAjax",
				data: { id: datos.id },
				dataType: "json",
				beforeSend: function () {

				},
				success: function (data) {
					var html = "";
					html += '<option value="">-- Seleccione --</option>';
					$.each(data.profesiones, function (i, e) {
						html += '<option value="' + e.id + '">' + e.profesion + '</option>';

					});
					$("#formRegistrarFotocheck select[name=brigadistas_profesiones_id]").html(html);

					var html = "";
					html += '<option value="0">[N/A]</option>';
					$.each(data.certificaciones, function (i, e) {
						html += '<option value="' + e.id + '">' + certificacion(e.tipo_certificacion) + '</option>';

					});
					$("#formRegistrarFotocheck select[name=brigadistas_certificacion_id]").html(html);

				}
			});

			$.ajax({
				type: "POST",
				url: URI + "brigadistas/listaFotocheck",
				data: { id: datos.id },
				dataType: "json",
				beforeSend: function () {
					$("#modalCargaGeneral").css("display", "block");
				},
				success: function (data) {
					$("#modalCargaGeneral").css("display", "none");

					$("#fotocheckModal").modal("show");
					$("#formRegistrarFotocheck").find("input[name=id]").val(datos.id);
					var html = "";
					var count = 0;

					$.each(data.fotocheck, function (i, e) {
						count++;

						html += '<tr><td class="text-center">' + e.profesion + '</td>';
						html += '<td class="text-center">' + e.especialidad + '</td>';
						html += '<td class="text-center">' + e.fecha_emision + '</td>';
						html += '<td class="text-center">' + e.fecha_vencimiento + '</td>';
						html += '<td class="text-center">' + certificacion(e.tipo_certificacion) + '</td>';
						html += '<td class="fotocheck"><a href="' + URI + 'brigadistas/fotocheck/' + e.id + '" target="_blank"><i class="fa fa-user" aria-hidden="true"></i></a></td>';
						html += '<td class="delete" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
					});

					if (count == 0) html = "<tr class='sin-registros'><td colspan='7' class='text-center'>No hay registros</td></tr>";

					$("#tableFotocheck tbody").html(html);
				}
			});

		});

		$("#formRegistrarFotocheck select[name=brigadistas_profesiones_id]").on("change", function () {

			var brigadistas_profesiones_id = $(this).val();
			var id = $("#formRegistrarFotocheck input[name=id]").val();

			if (brigadistas_profesiones_id.length > 0) {
				$.ajax({
					type: "POST",
					url: URI + "brigadistas/especialidadesProfesionesBrigadistaAjax",
					data: { id: id, brigadistas_profesiones_id: brigadistas_profesiones_id },
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
					},
					success: function (data) {
						$("#modalCargaGeneral").css("display", "none");

						var html = '<option value="">- Seleccione -</option>';

						$.each(data.especialidades, function (i, e) {
							html += '<option value="' + e.brigadistas_especialidad_id + '">' + e.especialidad + '</option>';
						});

						$("#formRegistrarFotocheck select[name=brigadistas_especialidad_id]").html(html);
					}
				});
			}

		});

		$("#formRegistrarEventos select[name=brigadistas_evento_id]").on("change", function () {

			$id = $(this).val();

			if ($id.length > 0) {
				$.ajax({
					type: "POST",
					url: URI + "brigadistas/main/listaSedesFiltro",
					data: { id: $id, type: 1 },
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
						$("#formRegistrarEventos select[name=brigadistas_clusters_id]").html('<option value="">Cargando</option>');
						$("#formRegistrarEventos select[name=brigadistas_sedes_id]").html('<option value="">-- Seleccione cluster --</option>');
					},
					success: function (data) {
						$("#modalCargaGeneral").css("display", "none");

						var html = '<option value="">-- Seleccione --</option>';

						$.each(data, function (i, e) {
							html += '<option value="' + e.id + '">' + e.descripcion + '</option>';
						});

						$("#formRegistrarEventos select[name=brigadistas_clusters_id]").html(html);
					}
				});
			}

		});

		$('body').on('click', 'td i.sede', function () {
			var tr = $(this).parents('tr');
			var row = table.row(tr);

			index = row.index();
			datos = row.data();
			var id = datos.id;
			$("#formRegistrarEventos input[name=id]").val(id);
			$.ajax({
				type: "POST",
				url: URI + "brigadistas/main/listaSedesBrigadista",
				data: { id: id },
				dataType: "json",
				beforeSend: function () {
					$("#modalCargaGeneral").css("display", "block");
				},
				success: function (data) {
					$("#modalCargaGeneral").css("display", "none");

					$("#eventosModal").modal("show");
					var html = "";
					var count = 0;

					$.each(data.sedes, function (i, e) {
						count++;

						html += '<tr><td class="text-center">' + e.evento + '</td>';
						html += '<td class="text-center">' + e.cluster + '</td>';
						html += '<td class="text-center">' + e.sede + '</td>';
						html += '<td class="delete" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
					});

					if (count == 0) html = "<tr class='sin-registros'><td colspan='7' class='text-center'>No hay registros</td></tr>";

					$("#tableEvento tbody").html(html);
				}
			});

		});

		$("#formRegistrarEventos").validate({
			rules: {
				brigadistas_evento_id: { required: true },
				brigadistas_clusters_id: { required: true },
				brigadistas_sedes_id: { required: true }
			},
			messages: {
				brigadistas_evento_id: { required: "(*) Campo Requerido" },
				brigadistas_clusters_id: { required: "(*) Campo Requerido" },
				brigadistas_sedes_id: { required: "(*) Campo Requerido" }
			},
			submitHandler: function (form, event) {
				event.preventDefault();

				$.ajax({
					type: "POST",
					url: URI + "brigadistas/main/registrarSede",
					data: $("#formRegistrarEventos").serialize(),
					dataType: "json",
					beforeSend: function () {
						$("#formRegistrarEventos button[type=submit]").text("Agregando...");
						$("#formRegistrarEventos button").addClass("disabled");
					},
					success: function (data) {

						$("#formRegistrarEventos button[type=submit]").text("Agregar");
						$("#formRegistrarEventos button").removeClass("disabled");

						var html = "";
						var count = 0;

						sinRegistros = $("#tableEvento tbody tr.sin-registros").length;

						if (parseInt(data.status) == 200) {

							if (parseInt(data.id) > 0) {

								if (parseInt(sinRegistros) > 0) {
									html += '<tr><td class="text-center">' + $("#formRegistrarEventos").find("select[name=brigadistas_evento_id] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarEventos").find("select[name=brigadistas_clusters_id] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarEventos").find("select[name=brigadistas_sedes_id] option:selected").text() + '</td>';
									html += '<td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}
								else {
									html = $("#tableEvento tbody").html();
									html += '<tr><td class="text-center">' + $("#formRegistrarEventos").find("select[name=brigadistas_evento_id] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarEventos").find("select[name=brigadistas_clusters_id] option:selected").text() + '</td>';
									html += '<td class="text-center">' + $("#formRegistrarEventos").find("select[name=brigadistas_sedes_id] option:selected").text() + '</td>';
									html += '<td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
								}

								$("#formRegistrarEventos")[0].reset();

							}

							$("#tableEvento tbody").html(html);

						}
						else if (parseInt(data.status) == 201) {
							$("#duplicate_evento").removeClass("hide");
							setTimeout(function () {
								$("#duplicate_evento").addClass("hide");
							}, 2000);
						}
						else {
							alert("Error al registrar");
						}

					}
				});
			}
		});

		$("#formRegistrarEventos select[name=brigadistas_clusters_id]").on("change", function () {

			$id = $(this).val();

			if ($id.length > 0) {
				$.ajax({
					type: "POST",
					url: URI + "brigadistas/main/listaSedesFiltro",
					data: { id: $id, type: 2 },
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
					},
					success: function (data) {
						$("#modalCargaGeneral").css("display", "none");

						var html = '<option value="">-- Seleccione --</option>';

						$.each(data, function (i, e) {
							html += '<option value="' + e.id + '">' + e.descripcion + '</option>';
						});

						$("#formRegistrarEventos select[name=brigadistas_sedes_id]").html(html);
					}
				});
			}

		});

		$("html").on("click", "#formRegistrarEventos table tbody tr td.delete", function () {

			var id = $(this).attr("rel");
			$("#deleteSedeModal").modal("show");
			$("#deleteSedeModal").find("input[name=id]").val(id);

		});

	});

}