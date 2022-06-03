function main(URI) {

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

		var $input1 = $(".inputfile1"),
			$label1 = $input1.next('label'),
			labelVal1 = $label1.html();

		$input1.on('change', function (e) {
			var fileName1 = '';

			if (this.files && this.files.length > 1)
				fileName1 = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
			else if (e.target.value)
				fileName1 = e.target.value.split('\\').pop();

			if (fileName1)
				$label1.find('span').html(fileName1);
			else
				$label1.html(labelVal1);
		});
		$("#formRegistrar").validate({
			rules: {
				titulo: { required: true },
				resolplan: { required: true },
				fecha_publicacion: { required: true },
				presupuesto: { required: true, min: 0 },
				idevento: { required: true },
				codigo_institucion: { required: true },
				codigo_region: { required: true },
				codigo_disa: { required: true },
				codigo_red: { required: true }
			},
			messages: {
				titulo: { required: "(*) Campo Requerido" },
				resolplan: { required: "(*) Campo Requerido" },
				fecha_publicacion: { required: "(*) Campo Requerido" },
				presupuesto: { required: "(*) Campo Requerido" },
				idevento: { required: "(*) Campo Requerido" },
				codigo_institucion: { required: "(*) Campo Requerido" },
				codigo_region: { required: "(*) Campo Requerido" },
				codigo_disa: { required: "(*) Campo Requerido" },
				codigo_red: { required: "(*) Campo Requerido" }
			},
			submitHandler: function (form, event) {
				var texto = "";
				var file = $("#formRegistrar input[type=file]").val();
				if (file.length > 0) texto = "Espere, se est&aacute; cargando el archivo adjunto ";
				$("#formRegistrar button[type=submit]").html(texto + '<i class="fa fa-spinner fa-spin"></i>');
				$("#formRegistrar button[type=submit]").addClass('disabled');
				$("#formRegistrar button[type=submit]").css('pointer-events', 'none');
				form.submit();

			}
		});
		$("#formActualizar").validate({
			rules: {
				titulo: { required: true },
				resolplan: { required: true },
				fecha_publicacion: { required: true },
				presupuesto: { required: true, min: 0 },
				idevento: { required: true },
				codigo_institucion: { required: true },
				codigo_region: { required: true },
				codigo_disa: { required: true },
				codigo_red: { required: true }
			},
			messages: {
				titulo: { required: "(*) Campo Requerido" },
				resolplan: { required: "(*) Campo Requerido" },
				fecha_publicacion: { required: "(*) Campo Requerido" },
				presupuesto: { required: "(*) Campo Requerido" },
				idevento: { required: "(*) Campo Requerido" },
				codigo_institucion: { required: "(*) Campo Requerido" },
				codigo_region: { required: "(*) Campo Requerido" },
				codigo_disa: { required: "(*) Campo Requerido" },
				codigo_red: { required: "(*) Campo Requerido" }
			},
			submitHandler: function (form, event) {

				var texto = "";
				var file = $("#formActualizar input[type=file]").val();
				var filep = $("#formActualizar input[type=file]").val();
				if (file.length > 0) texto = "Espere, se est&aacute; cargando el archivo adjunto ";
				if (filep.length > 0) texto = "Espere, se est&aacute; cargando el archivo adjunto ";
				$("#formActualizar button[type=submit]").html(texto + '<i class="fa fa-spinner fa-spin"></i>');
				$("#formActualizar button[type=submit]").addClass('disabled');
				$("#formActualizar button[type=submit]").css('pointer-events', 'none');
				form.submit();

			}
		});

		$("select[name=Anio]").on("change", function () {

			var anio = $(this).val();

			if (anio.length > 1) {
				post(URI + "friaje", { Anio: anio });
			}

		});

		var table = "";

		$(".date").datetimepicker({
			format: "DD/MM/YYYY"

		});

		$("input[name=tipoAtencion]").on("change", function () {

			var id = $("input[name=tipoAtencion]:checked").val();

			console.log(id);

			if (id && id.length > 0) {
				$("#showPre").css("display", "none");
				$("#showPMA").css("display", "none");
				if (parseInt(id) === 1) {
					$("#showPre").css("display", "block");
					$("#showPMA").css("display", "none");
					cargaNatural();
				} else {
					$("#showPre").css("display", "none");
					$("#showPMA").css("display", "block");
					cargaAntropico();
				}
			}

		});

		$("input[name=tipoAtencionU]").on("change", function () {

			var id = $("input[name=tipoAtencionU]:checked").val();

			console.log(id);

			if (id && id.length > 0) {
				$("#showPreU").css("display", "none");
				$("#showPMAU").css("display", "none");
				if (parseInt(id) === 1) {
					$("#showPreU").css("display", "block");
					$("#showPMAU").css("display", "none");
					cargaNatural_U();
				} else {
					$("#showPreU").css("display", "none");
					$("#showPMAU").css("display", "block");
					cargaAntropico_U();
				}
			}

		});

		setTimeout(function () {
			table = $('.tbLista').DataTable(
				{
					dom: '<"html5buttons"B>lTfgitp',
					pageLength: 25,
					columns: [
						{ "data": "id" },
						{ "data": "titulo" },
						{ "data": "resolplan" },
						{ "data": "presupuesto" },
						{ "data": "plan_file" },
						{ "data": "origen" },
						{ "data": "institucion" },
						{ "data": "region" },
						{ "data": "estado" },
						{ "data": "resolucion_file" },
						{ "data": "calificacion" },
						{ "data": "origen1" },
						{ "data": "contingencias_peligros_detalle_id_natural" },
						{ "data": "contingencias_peligros_detalle_items_id_natural" },
						{ "data": "contingencias_peligros_detalle_id_antropico" },
						{ "data": "contingencias_peligros_detalle_items_id_antropico" },
						{ "data": "vigencia_inicio" },
						{ "data": "vigencia_fin" },
						{ "data": "codigo_institucion" },
						{ "data": "codigo_region" },
						{ "data": "codigo_disa" },
						{ "data": "codigo_red" },
						{ "data": "codigo_micro_red" },
						{ "data": "codigo_renipress" },
						{ "data": "fecha_publicacion" },
						{ "data": "id2" },
						{ "data": "idevento" }

					],
					columnDefs: [{
						"targets": [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 26],
						"visible": false,
						"searchable": false
					}],
					"order": [[0, "asc"]],
					buttons: [
						{
							extend: 'copy',
							title: 'lista-planes',
							exportOptions: { columns: [0, 1, 2, 3] },
						},
						{
							extend: 'csv',
							title: 'lista planes',
							exportOptions: { columns: [0, 1, 2, 3] },
						},
						{
							extend: 'excel',
							title: 'lista planes',
							exportOptions: { columns: [0, 1, 2, 3] },
						},
						{
							extend: 'pdf',
							title: 'lista planes',
							orientation: 'landscape',
							exportOptions: { columns: [0, 1, 2, 3] },
						},

						{
							extend: 'print',
							title: 'lista planes',
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

		}, 300);

		$("#btn-nuevo").on("click", function () {
			$("#modal-registrar").modal("show");
		});

		$('.tbIndicador tbody').on('click', 'tr', function () {

			var data = tableIndicador.row(this).data();

			$("#formRegistrar input[name=IdIndicador]").val(data.id);
			$("#formRegistrar input[name=Nombre_Indicador").val(data.Indicador);
			$('#tableIndicadorModal').modal('hide');
		});

		$('body').on('click', '.tbLista tr', function () {

			$("#Tipo_Accion").val("");
			var tr = $(this);
			var row = table.row(tr);

			index = row.index();

			data = row.data();

			var id = data.id;

			console.log(data);

			$("#btn-editar").removeClass("editar");
			$("#btn-anular").removeClass("anular");
			$("#btn-reportar").removeClass("reportar");
			$("#btn-editar").addClass("editar");
			$("#btn-anular").addClass("anular");
			$("#btn-reportar").addClass("reportar");
			$("#btn-editar").find("label").attr("rel", id);
			$("#btn-anular").find("label").attr("rel", id);
			$("#btn-reportar").find("label").attr("rel", id);

			planes = data;

			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}

		});

		$("body").on("click", ".editarplan", function () {

			$("#modal-actualizar").modal("show");
			var id = $(this).find("label").attr("rel");

			$("#editFiler").text("Cargar Documento");
			$("#editFilep").text("Cargar Documento");
			$("#formActualizar").find("input[name=id]").val(planes.id);

			$("#formActualizar").find("input[name=titulo]").val(planes.titulo);
			$("#formActualizar").find("input[name=resolplan]").val(planes.resolplan);

			$("#formActualizar").find("input[name=fecha_publicacion]").val(planes.fecha_publicacion);

			$("#formActualizar").find("input[name=presupuesto]").val(planes.presupuesto);
			$("#formActualizar").find("input[name=tipoAtencionU][value='" + planes.origen1 + "']").prop('checked', true);

			var origen1 = planes.origen1;

			if (origen1 && origen1.length > 0) {
				$("#showPreU").css("display", "none");
				$("#showPMAU").css("display", "none");
				if (parseInt(origen1) === 1) {
					$("#showPreU").css("display", "block");
					$("#showPMAU").css("display", "none");
					cargaNatural_U(planes.origen1, planes.contingencias_peligros_detalle_items_id_natural, origen1, planes.contingencias_peligros_detalle_id_natural);
				} else {
					$("#showPreU").css("display", "none");
					$("#showPMAU").css("display", "block");
					cargaAntropico_U(planes.origen1, planes.contingencias_peligros_detalle_items_id_antropico, origen1, planes.contingencias_peligros_detalle_id_antropico);
				}
			}

			$("#formActualizar").find("select[name=contingencias_peligros_detalle_id_natural]").val(planes.contingencias_peligros_detalle_id_natural);
			$("#formActualizar").find("select[name=contingencias_peligros_detalle_items_id_natural]").val(planes.contingencias_peligros_detalle_items_id_natural);

			$("#formActualizar").find("select[name=contingencias_peligros_detalle_id_antropico]").val(planes.contingencias_peligros_detalle_id_antropico);
			$("#formActualizar").find("select[name=contingencias_peligros_detalle_items_id_antropico]").val(planes.contingencias_peligros_detalle_items_id_antropico);
			$("#formActualizar").find("select[name=idevento]").val(planes.idevento);
			$("#formActualizar").find("select[name=codigo_institucion]").val(planes.codigo_institucion);
			$("#formActualizar").find("select[name=codigo_region]").val(planes.codigo_region);
			$("#formActualizar").find("select[name=codigo_disa]").val(planes.codigo_disa);
			$("#formActualizar").find("select[name=codigo_red]").val(planes.codigo_red);
			$("#formActualizar").find("select[name=codigo_micro_red]").val(planes.codigo_micro_red);
			$("#formActualizar").find("select[name=codigo_renipress]").val(planes.codigo_renipress);

			cargarDISA_U($("#formActualizar"), 2, planes.codigo_disa, planes.codigo_region);
			cargarRed_U($("#formActualizar"), 2, planes.codigo_red, planes.codigo_disa);
			cargarMicroRed_U($("#formActualizar"), 2, planes.codigo_micro_red, planes.codigo_red, planes.codigo_disa);
			cargarIPRESS_U($("#formActualizar"), 2, planes.codigo_renipress, planes.codigo_micro_red, planes.codigo_institucion, planes.codigo_region, planes.codigo_disa, planes.codigo_red);
			var archivo = planes.resolucion_file;
			if (archivo.length > 0) {
				$("#editFiler").html("Ya existe, &iquest;Reemplazar?");
			}

			var archivo1 = planes.plan_file;
			if (archivo1.length > 0) {
				$("#editFilep").html("Ya existe, &iquest;Reemplazar?");
			}
		});

		$("#formRegistrar select[name=codigo_region]").on("change", function () {
			var id = $(this).val();
			cargarDISA($("#formRegistrar"), 1, 0, id);
		});
		function cargarDISA(form, select, codigo_disa, codigo_region) {
			var id_disa = codigo_disa;
			$.ajax({
				url: URI + 'contingencia/Main/cargarDISA',
				method: 'post',
				type: 'json',
				data: { codigo_disa: codigo_disa, codigo_region },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=codigo_disa]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$(form).find("select[name=codigo_disa]").html('<option value="0">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_disa) > 0) { $(form).find("select[name=codigo_disa]").append('<option value="' + e.codigo_disa + '"' + (id_disa == e.codigo_disa ? 'selected' : "") + '>' + e.codigo_disa + ' - ' + e.nombre_disa + '</option>'); }
						else { $(form).find("select[name=codigo_disa]").append('<option value="' + e.codigo_disa + '">' + e.codigo_disa + ' - ' + e.nombre_disa + '</option>'); }
					});

				}
			});

		}

		$("#formRegistrar select[name=codigo_disa]").on("change", function () {
			var id = $(this).val();
			cargarRed($("#formRegistrar"), 1, 0, id);
		});

		function cargarRed(form, select, codigo_red, codigo_disa) {
			var id_red = codigo_red;
			$.ajax({
				url: URI + 'contingencia/Main/cargarRed',
				method: 'post',
				type: 'json',
				data: { codigo_red: codigo_red, codigo_disa },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=codigo_red]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$(form).find("select[name=codigo_red]").html('<option value="0">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_red) > 0) { $(form).find("select[name=codigo_red]").append('<option value="' + e.codigo_red + '"' + (id_red == e.codigo_red ? 'selected' : "") + '>' + e.codigo_red + ' - ' + e.nombre_red + '</option>'); }
						else { $(form).find("select[name=codigo_red]").append('<option value="' + e.codigo_red + '">' + e.codigo_red + ' - ' + e.nombre_red + '</option>'); }
					});

				}
			});

		}

		$("#formRegistrar select[name=codigo_red]").on("change", function () {
			var id = $(this).val();
			var disa = $("#formRegistrar").find("select[name=codigo_disa]").val();
			cargarMicroRed($("#formRegistrar"), 1, 0, id, disa);
		});

		function cargarMicroRed(form, select, codigo_micro_red, codigo_red, codigo_disa) {
			var id_microred = codigo_micro_red;
			$.ajax({
				url: URI + 'contingencia/Main/cargarMicroRed',
				method: 'post',
				type: 'json',
				data: { codigo_micro_red: codigo_micro_red, codigo_red, codigo_disa: codigo_disa },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=codigo_micro_red]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$(form).find("select[name=codigo_micro_red]").html('<option value="0">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_micro_red) > 0) { $(form).find("select[name=codigo_micro_red]").append('<option value="' + e.codigo_micro_red + '"' + (id_microred == e.codigo_micro_red ? 'selected' : "") + '>' + e.codigo_micro_red + ' - ' + e.nombre_micro_red + '</option>'); }
						else { $(form).find("select[name=codigo_micro_red]").append('<option value="' + e.codigo_micro_red + '">' + e.codigo_micro_red + ' - ' + e.nombre_micro_red + '</option>'); }
					});

				}
			});

		}

		$("#formRegistrar select[name=codigo_micro_red]").on("change", function () {
			var id = $(this).val();
			var institucion = $("#formRegistrar").find("select[name=codigo_institucion]").val();
			var region = $("#formRegistrar").find("select[name=codigo_region]").val();
			var disa = $("#formRegistrar").find("select[name=codigo_disa]").val();
			var red = $("#formRegistrar").find("select[name=codigo_red]").val();

			cargarIPRESS($("#formRegistrar"), 1, 0, id, institucion, region, disa, red);
		});

		function cargarIPRESS(form, select, codigo_renipress, codigo_micro_red, codigo_institucion, codigo_region, codigo_disa, codigo_red) {
			var id_renipress = codigo_renipress;
			$.ajax({
				url: URI + 'contingencia/Main/cargarIPRESS',
				method: 'post',
				type: 'json',
				data: { codigo_renipress: codigo_renipress, codigo_micro_red, codigo_institucion, codigo_region, codigo_disa, codigo_red },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=codigo_renipress]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$(form).find("select[name=codigo_renipress]").html('<option value="0">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_renipress) > 0) { $(form).find("select[name=codigo_renipress]").append('<option value="' + e.codigo_renipress + '"' + (id_renipress == e.codigo_renipress ? 'selected' : "") + '>' + e.codigo_renipress + ' - ' + e.nombre + '</option>'); }
						else { $(form).find("select[name=codigo_renipress]").append('<option value="' + e.codigo_renipress + '">' + e.codigo_renipress + ' - ' + e.nombre + '</option>'); }
					});

				}
			});

		}
		function cargaNatural() {
			var idnat = $("input[name=tipoAtencion]:checked").val();
			var id_naturalp = $("#formRegistrar").find("select[name=contingencias_peligros_detalle_id_natural]").val();
			$.ajax({
				url: URI + 'contingencia/Main/cargarPeligros',
				method: 'post',
				type: 'json',
				data: { idnat },
				error: function (xhr) { },
				beforeSend: function () {
					$("#formRegistrar").find("select[name=contingencias_peligros_detalle_id_natural]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$("#formRegistrar").find("select[name=contingencias_peligros_detalle_id_natural]").html('<option value="0">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(id_naturalp) > 0) { $("#formRegistrar").find("select[name=contingencias_peligros_detalle_id_natural]").append('<option value="' + e.contingencias_peligros_detalle_id + '"' + (id_naturalp == e.contingencias_peligros_detalle_id ? 'selected' : "") + '>' + e.contingencias_peligros_detalle_id + ' - ' + e.contingencias_peligros_detalle_nombre + '</option>'); }
						else { $("#formRegistrar").find("select[name=contingencias_peligros_detalle_id_natural]").append('<option value="' + e.contingencias_peligros_detalle_id + '">' + e.contingencias_peligros_detalle_id + ' - ' + e.contingencias_peligros_detalle_nombre + '</option>'); }
					});

				}
			});

		}

		$("#formRegistrar select[name=contingencias_peligros_detalle_id_natural]").on("change", function () {
			var id = $(this).val();

			cargarDetallePeligros($("#formRegistrar"), 1, 0, id);
		});

		function cargarDetallePeligros(form, select, codigo_detalle_peligro, codigo_peligro) {
			var codigo_detalle_peligro = codigo_detalle_peligro;
			$.ajax({
				url: URI + 'contingencia/Main/cargarPeligrosDetalle',
				method: 'post',
				type: 'json',
				data: { codigo_detalle_peligro: codigo_detalle_peligro, codigo_peligro },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=contingencias_peligros_detalle_items_id_natural]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$(form).find("select[name=contingencias_peligros_detalle_items_id_natural]").html('<option value="0">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_detalle_peligro) > 0) { $(form).find("select[name=contingencias_peligros_detalle_items_id_natural]").append('<option value="' + e.contingencias_peligros_detalle_items_id + '"' + (codigo_detalle_peligro == e.contingencias_peligros_detalle_items_id ? 'selected' : "") + '>' + e.contingencias_peligros_detalle_items_id + ' - ' + e.contingencias_peligros_detalle_items_nombre + '</option>'); }
						else { $(form).find("select[name=contingencias_peligros_detalle_items_id_natural]").append('<option value="' + e.contingencias_peligros_detalle_items_id + '">' + e.contingencias_peligros_detalle_items_id + ' - ' + e.contingencias_peligros_detalle_items_nombre + '</option>'); }
					});

				}
			});

		}
		function cargaAntropico() {
			var idnat = $("input[name=tipoAtencion]:checked").val();
			var id_antropicop = $("#formRegistrar").find("select[name=contingencias_peligros_detalle_id_antropico]").val();
			$.ajax({
				url: URI + 'contingencia/Main/cargarPeligros',
				method: 'post',
				type: 'json',
				data: { idnat },
				error: function (xhr) { },
				beforeSend: function () {
					$("#formRegistrar").find("select[name=contingencias_peligros_detalle_id_antropico]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$("#formRegistrar").find("select[name=contingencias_peligros_detalle_id_antropico]").html('<option value="0">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(id_antropicop) > 0) { $("#formRegistrar").find("select[name=contingencias_peligros_detalle_id_antropico]").append('<option value="' + e.contingencias_peligros_detalle_id + '"' + (id_antropicop == e.contingencias_peligros_detalle_id ? 'selected' : "") + '>' + e.contingencias_peligros_detalle_id + ' - ' + e.contingencias_peligros_detalle_nombre + '</option>'); }
						else { $("#formRegistrar").find("select[name=contingencias_peligros_detalle_id_antropico]").append('<option value="' + e.contingencias_peligros_detalle_id + '">' + e.contingencias_peligros_detalle_id + ' - ' + e.contingencias_peligros_detalle_nombre + '</option>'); }
					});

				}
			});

		}

		$("#formRegistrar select[name=contingencias_peligros_detalle_id_antropico]").on("change", function () {
			var id = $(this).val();

			cargarDetallePeligros1($("#formRegistrar"), 1, 0, id);
		});

		function cargarDetallePeligros1(form, select, codigo_detalle_peligro, codigo_peligro) {
			var codigo_detalle_peligro = codigo_detalle_peligro;
			$.ajax({
				url: URI + 'contingencia/Main/cargarPeligrosDetalle',
				method: 'post',
				type: 'json',
				data: { codigo_detalle_peligro: codigo_detalle_peligro, codigo_peligro },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=contingencias_peligros_detalle_items_id_antropico]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$(form).find("select[name=contingencias_peligros_detalle_items_id_antropico]").html('<option value="0">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_detalle_peligro) > 0) { $(form).find("select[name=contingencias_peligros_detalle_items_id_antropico]").append('<option value="' + e.contingencias_peligros_detalle_items_id + '"' + (codigo_detalle_peligro == e.contingencias_peligros_detalle_items_id ? 'selected' : "") + '>' + e.contingencias_peligros_detalle_items_id + ' - ' + e.contingencias_peligros_detalle_items_nombre + '</option>'); }
						else { $(form).find("select[name=contingencias_peligros_detalle_items_id_antropico]").append('<option value="' + e.contingencias_peligros_detalle_items_id + '">' + e.contingencias_peligros_detalle_items_id + ' - ' + e.contingencias_peligros_detalle_items_nombre + '</option>'); }
					});

				}
			});

		}
		$("#formActualizar select[name=codigo_region]").on("change", function () {
			var id = $(this).val();
			cargarDISA_U($("#formActualizar"), 1, 0, id);
		});
		function cargarDISA_U(form, select, codigo_disa, codigo_region) {
			var id_disa = codigo_disa;
			$.ajax({
				url: URI + 'contingencia/Main/cargarDISA',
				method: 'post',
				type: 'json',
				data: { codigo_disa: codigo_disa, codigo_region },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=codigo_disa]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$(form).find("select[name=codigo_disa]").html('<option value="999">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_disa) != NaN) { $(form).find("select[name=codigo_disa]").append('<option value="' + e.codigo_disa + '"' + (id_disa == e.codigo_disa ? 'selected' : "") + '>' + e.codigo_disa + ' - ' + e.nombre_disa + '</option>'); }
						else { $(form).find("select[name=codigo_disa]").append('<option value="' + e.codigo_disa + '">' + e.codigo_disa + ' - ' + e.nombre_disa + '</option>'); }
					});

				}
			});

		}

		$("#formActualizar select[name=codigo_disa]").on("change", function () {
			var id = $(this).val();
			cargarRed_U($("#formActualizar"), 1, 0, id);
		});

		function cargarRed_U(form, select, codigo_red, codigo_disa) {
			var id_red = codigo_red;
			$.ajax({
				url: URI + 'contingencia/Main/cargarRed',
				method: 'post',
				type: 'json',
				data: { codigo_red: codigo_red, codigo_disa },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=codigo_red]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$(form).find("select[name=codigo_red]").html('<option value="999">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_red) != NaN) { $(form).find("select[name=codigo_red]").append('<option value="' + e.codigo_red + '"' + (id_red == e.codigo_red ? 'selected' : "") + '>' + e.codigo_red + ' - ' + e.nombre_red + '</option>'); }
						else { $(form).find("select[name=codigo_red]").append('<option value="' + e.codigo_red + '">' + e.codigo_red + ' - ' + e.nombre_red + '</option>'); }
					});

				}
			});

		}

		$("#formActualizar select[name=codigo_red]").on("change", function () {
			var id = $(this).val();
			var disa = $("#formActualizar").find("select[name=codigo_disa]").val();
			cargarMicroRed_U($("#formActualizar"), 1, 0, id, disa);
		});

		function cargarMicroRed_U(form, select, codigo_micro_red, codigo_red, codigo_disa) {
			var id_microred = codigo_micro_red;
			$.ajax({
				url: URI + 'contingencia/Main/cargarMicroRed',
				method: 'post',
				type: 'json',
				data: { codigo_micro_red: codigo_micro_red, codigo_red, codigo_disa: codigo_disa },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=codigo_micro_red]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {
					console.log('here-microred', data);
					console.log('here-codigo_micro_red', codigo_micro_red);
					$(form).find("select[name=codigo_micro_red]").html('<option value="999">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_micro_red) != NaN) { console.log('entra al if de microred'); $(form).find("select[name=codigo_micro_red]").append('<option value="' + e.codigo_micro_red + '"' + (id_microred === e.codigo_micro_red ? 'selected' : "") + '>' + e.codigo_micro_red + ' - ' + e.nombre_micro_red + '</option>'); }
						else { console.log('entra al else de microred'); $(form).find("select[name=codigo_micro_red]").append('<option value="' + e.codigo_micro_red + '">' + e.codigo_micro_red + ' - ' + e.nombre_micro_red + '</option>'); }
					});

				}
			});

		}

		$("#formActualizar select[name=codigo_micro_red]").on("change", function () {
			var id = $(this).val();
			var institucion = $("#formActualizar").find("select[name=codigo_institucion]").val();
			var region = $("#formActualizar").find("select[name=codigo_region]").val();
			var disa = $("#formActualizar").find("select[name=codigo_disa]").val();
			var red = $("#formActualizar").find("select[name=codigo_red]").val();

			cargarIPRESS_U($("#formActualizar"), 1, 0, id, institucion, region, disa, red);
		});

		function cargarIPRESS_U(form, select, codigo_renipress, codigo_micro_red, codigo_institucion, codigo_region, codigo_disa, codigo_red) {
			var id_renipress = codigo_renipress;
			$.ajax({
				url: URI + 'contingencia/Main/cargarIPRESS',
				method: 'post',
				type: 'json',
				data: { codigo_renipress: codigo_renipress, codigo_micro_red, codigo_institucion, codigo_region, codigo_disa, codigo_red },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=codigo_renipress]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$(form).find("select[name=codigo_renipress]").html('<option value="999">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_renipress) != NaN) { $(form).find("select[name=codigo_renipress]").append('<option value="' + e.codigo_renipress + '"' + (id_renipress == e.codigo_renipress ? 'selected' : "") + '>' + e.codigo_renipress + ' - ' + e.nombre + '</option>'); }
						else { $(form).find("select[name=codigo_renipress]").append('<option value="' + e.codigo_renipress + '">' + e.codigo_renipress + ' - ' + e.nombre + '</option>'); }
					});

				}
			});

		}
		function cargaNatural_U(idnat, idedet, origen, combo1) {
			console.log("idnat: " + idnat);
			console.log("idedet: " + idedet);
			if (idnat == undefined) {
				var idnat = $("input[name=tipoAtencionU]:checked").val();
			}
			var id_naturalp = idnat;
			$.ajax({
				url: URI + 'contingencia/Main/cargarPeligros',
				method: 'post',
				type: 'json',
				data: { idnat, origen, combo1 },
				error: function (xhr) { },
				beforeSend: function () {
					$("#formActualizar").find("select[name=contingencias_peligros_detalle_id_natural]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$("#formActualizar").find("select[name=contingencias_peligros_detalle_id_natural]").html('<option value="999">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(id_naturalp) > 0) {
							console.log("entro al if");
							$("#formActualizar").find("select[name=contingencias_peligros_detalle_id_natural]").append('<option value="' + e.contingencias_peligros_detalle_id + '"' + (combo1 == e.contingencias_peligros_detalle_id ? 'selected' : "") + '>' + e.contingencias_peligros_detalle_id + ' - ' + e.contingencias_peligros_detalle_nombre + '</option>');

							cargarDetallePeligros_U($("#formActualizar"), 1, idedet, combo1, origen);
						}

						else {
							console.log("entro al else");
							$("#formActualizar").find("select[name=contingencias_peligros_detalle_id_natural]").append('<option value="' + e.contingencias_peligros_detalle_id + '">' + e.contingencias_peligros_detalle_id + ' - ' + e.contingencias_peligros_detalle_nombre + '</option>');
						}
					});

				}
			});

		}

		$("#formActualizar select[name=contingencias_peligros_detalle_id_natural]").on("change", function () {
			var id = $(this).val();

			cargarDetallePeligros_U($("#formActualizar"), 1, 2, id);
		});

		function cargarDetallePeligros_U(form, select, codigo_detalle_peligro, codigo_peligro, origen) {
			var codigo_detalle_peligro = codigo_detalle_peligro;
			$.ajax({
				url: URI + 'contingencia/Main/cargarPeligrosDetalle',
				method: 'post',
				type: 'json',
				data: { codigo_detalle_peligro: codigo_detalle_peligro, codigo_peligro, origen: origen },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=contingencias_peligros_detalle_items_id_natural]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$(form).find("select[name=contingencias_peligros_detalle_items_id_natural]").html('<option value="999">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_detalle_peligro) > 0) { $(form).find("select[name=contingencias_peligros_detalle_items_id_natural]").append('<option value="' + e.contingencias_peligros_detalle_items_id + '"' + (codigo_detalle_peligro == e.contingencias_peligros_detalle_items_id ? 'selected' : "") + '>' + e.contingencias_peligros_detalle_items_id + ' - ' + e.contingencias_peligros_detalle_items_nombre + '</option>'); }
						else { $(form).find("select[name=contingencias_peligros_detalle_items_id_natural]").append('<option value="' + e.contingencias_peligros_detalle_items_id + '">' + e.contingencias_peligros_detalle_items_id + ' - ' + e.contingencias_peligros_detalle_items_nombre + '</option>'); }
					});

				}
			});

		}
		function cargaAntropico_U(idnat, idedet, origen, combo1) {
			console.log("idnat: " + idnat);
			console.log("idedet: " + idedet);
			if (idnat == undefined) {
				var idnat = $("input[name=tipoAtencionU]:checked").val();
			}

			var id_antropicop = idnat;
			$.ajax({
				url: URI + 'contingencia/Main/cargarPeligros',
				method: 'post',
				type: 'json',
				data: { idnat, origen, combo1 },
				error: function (xhr) { },
				beforeSend: function () {
					$("#formActualizar").find("select[name=contingencias_peligros_detalle_id_antropico]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {
					console.log('here carga peligros-antropico', data)
					$("#formActualizar").find("select[name=contingencias_peligros_detalle_id_antropico]").html('<option value="999">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(id_antropicop) > 0) {
							$("#formActualizar").find("select[name=contingencias_peligros_detalle_id_antropico]").append('<option value="' + e.contingencias_peligros_detalle_id + '"' + (combo1 == e.contingencias_peligros_detalle_id ? 'selected' : "") + '>' + e.contingencias_peligros_detalle_id + ' - ' + e.contingencias_peligros_detalle_nombre + '</option>');
							cargarDetallePeligros1_U($("#formActualizar"), 1, idedet, combo1, origen);
						}
						else { $("#formActualizar").find("select[name=contingencias_peligros_detalle_id_antropico]").append('<option value="' + e.contingencias_peligros_detalle_id + '">' + e.contingencias_peligros_detalle_id + ' - ' + e.contingencias_peligros_detalle_nombre + '</option>'); }
					});

				}
			});

		}

		$("#formActualizar select[name=contingencias_peligros_detalle_id_antropico]").on("change", function () {
			var id = $(this).val();

			cargarDetallePeligros1_U($("#formActualizar"), 1, 0, id);
		});

		function cargarDetallePeligros1_U(form, select, codigo_detalle_peligro, codigo_peligro, origen) {
			var codigo_detalle_peligro = codigo_detalle_peligro;
			$.ajax({
				url: URI + 'contingencia/Main/cargarPeligrosDetalle',
				method: 'post',
				type: 'json',
				data: { codigo_detalle_peligro: codigo_detalle_peligro, codigo_peligro, origen: origen },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=contingencias_peligros_detalle_items_id_antropico]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {

					$(form).find("select[name=contingencias_peligros_detalle_items_id_antropico]").html('<option value="999">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_detalle_peligro) > 0) { $(form).find("select[name=contingencias_peligros_detalle_items_id_antropico]").append('<option value="' + e.contingencias_peligros_detalle_items_id + '"' + (codigo_detalle_peligro == e.contingencias_peligros_detalle_items_id ? 'selected' : "") + '>' + e.contingencias_peligros_detalle_items_id + ' - ' + e.contingencias_peligros_detalle_items_nombre + '</option>'); }
						else { $(form).find("select[name=contingencias_peligros_detalle_items_id_antropico]").append('<option value="' + e.contingencias_peligros_detalle_items_id + '">' + e.contingencias_peligros_detalle_items_id + ' - ' + e.contingencias_peligros_detalle_items_nombre + '</option>'); }
					});

				}
			});

		}
		$("body").on("click", ".actionEdit", function () {

			$("#modal-cuestionario").modal("show");
			$("#formRegistrarCuestionario")[0].reset();

			var tr = $(this).parents('tr');
			var row = table.row(tr);
			data = row.data();

			var index = row.index();
			console.log(data.id);

			$("#formRegistrarCuestionario").find("input[name=idregistroplan]").val(data.id);
			$("#formRegistrarCuestionario").find("input[name=titulo]").val(data.titulo);
			$("#formRegistrarCuestionario").find("input[name=institucion]").val(data.institucion);
			$("#formRegistrarCuestionario").find("input[name=region]").val(data.region);
		});

		$('body').on('click', 'td a.aInformeInicial', function () {

			var $item = $(this).parents("tr");
			var row = table.row($item);

			index = row.index();
			data = row.data();

			$id = data.id;

			console.log({ $id });

			var informeInicial = data.id;

			$("#aInformeInicial").attr("href", URI + "contingencia/reportes/informecontingencia/" + informeInicial);

		});

	});

}