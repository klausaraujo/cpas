function gestionarIndicador() {

	setTimeout(function () { $(".alert").slideUp(); }, 3500);

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

		$(".datepicker").datepicker({
			language: "es",
			autoclose: true
		});

		$("#formCambioFecha select[name=Anio]").change(function () {
			var anio = $(this).val();
			if (anio.length > 0) {
				$("#formCambioFecha").submit();
			}

		});

		jQuery.validator.addMethod("validarFormato", function (
			value, element) {
			return this.optional(element)
				|| /^(\d+|\d+.\d{1,2})$/.test(value);
		}, "Formato incorrecto Ej: 12.60");

		$("#formRegistrar").validate({
			rules: {
				Anio_Ejecucion: { required: true },
				Nombre_Indicador: { required: true },
				IdDimension: { required: true }

			},
			messages: {
				Anio_Ejecucion: { required: "(*) Campo Requerido" },
				Nombre_Indicador: { required: "(*) Campo Requerido" },
				IdDimension: { required: "(*) Campo Requerido" }
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
				Anio_Ejecucion: { required: true },
				Nombre_Indicador: { required: true },
				IdDimension: { required: true }

			},
			messages: {
				Anio_Ejecucion: { required: "(*) Campo Requerido" },
				Nombre_Indicador: { required: "(*) Campo Requerido" },
				IdDimension: { required: "(*) Campo Requerido" }
			},
			submitHandler: function (form, event) {

				var texto = "";
				var file = $("#formActualizar input[type=file]").val();
				if (file.length > 0) texto = "Espere, se est&aacute; cargando el archivo adjunto ";
				$("#formActualizar button[type=submit]").html(texto + '<i class="fa fa-spinner fa-spin"></i>');
				$("#formActualizar button[type=submit]").addClass('disabled');
				$("#formActualizar button[type=submit]").css('pointer-events', 'none');
				form.submit();

			}
		});

		var tbListar = $('#tbListar').DataTable(
			{
				dom: '<"html5buttons"B>lTfgitp',
				columns: [
					{ "data": "id" },
					{ "data": "Nombre_Indicador" },
					{ "data": "Nombre_Dimension" },
					{ "data": "Formula" },
					{ "data": "Ficha_Tecnica" },
					{ "data": "status" },
					{ "data": "edit" },
					{ "data": "delete" },
					{ "data": "Comentarios" },
					{ "data": "IdDimension" },
					{ "data": "Activo" },
					{ "data": "Justificacion" },
					{ "data": "Anio_Ejecucion" }
				],
				"lengthMenu": [[-1, 25, 50, 100], ["Todos", 25, 50, 100]],
				columnDefs: [{
					"targets": [3, 8, 9, 10, 11, 12],
					"visible": false,
					"searchable": false
				}],
				buttons: [
					{
						extend: 'copy',
						text: 'Copiar',
						title: 'Copiar',
						exportOptions: {
							columns: [0, 12, 1, 2, 3, 4, 5, 11]
						}
					},
					{
						extend: 'csv',
						title: 'Csv',
						exportOptions: {
							columns: [0, 12, 1, 2, 3, 4, 5, 11]
						}
					},
					{
						extend: 'excel',
						title: 'Excel',
						exportOptions: {
							columns: [0, 12, 1, 2, 3, 4, 5, 11]
						}
					},
					{
						extend: 'pdf',
						title: 'Pdf',
						exportOptions: {
							columns: [0, 12, 1, 2, 3, 4, 5, 11]
						}
					},

					{
						extend: 'print',
						text: 'Imprimir',
						title: 'Imprimir',
						exportOptions: {
							columns: [0, 12, 1, 2, 3, 4, 5, 11]
						},
						customize: function (win) {
							$(win.document.body).addClass('white-bg');
							$(win.document.body).css('font-size', '10px');

							$(win.document.body)
								.find('table').addClass('compact').css('font-size', 'inherit');

							var css = '@page { size: landscape; }', head = win.document.head
								|| win.document.getElementsByTagName('head')[0], style = win.document.createElement('style');

							style.type = 'text/css';
							style.media = 'print';

							if (style.styleSheet) {
								style.styleSheet.cssText = css;
							} else {
								style.appendChild(win.document.createTextNode(css));
							}

							head.appendChild(style);
						}
					}]

			});

		$("body").on("click", ".actionDelete", function () {
			$("#deleteModal input[name=id]").val("");
			$('#deleteModal').modal('show');

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();

			$("#deleteModal input[name=id]").val(data.id);
			$("#deleteModal #numero").text(data.id);

		});

		$("body").on("click", ".actionEdit", function () {

			$("#actualizarModal").modal("show");

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();

			var index = row.index();

			$("#actualizarModal input[name=id]").val(data.id);
			$("#actualizarModal select[name=Anio_Ejecucion]").val(data.Anio_Ejecucion);
			$("#actualizarModal select[name=IdDimension]").val(data.IdDimension);
			$("#actualizarModal input[name=Formula]").val(data.Formula);
			$("#actualizarModal input[name=Justificacion]").val(data.Justificacion);
			$("#actualizarModal textarea[name=Nombre_Indicador]").val(data.Nombre_Indicador);
			$("#actualizarModal textarea[name=Comentarios]").val(data.Comentarios);
			$("#actualizarModal select[name=Activo]").val(data.Activo);

			$("#Activo").val(data.Activo);

		});

	});

}
