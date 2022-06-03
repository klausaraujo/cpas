function paciente(URI, ID_EMERGENCIA) {

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
					{ "data": "IDE" },
					{ "data": "Tipo_Documento" },
					{ "data": "Num_Documento" },
					{ "data": "Apellidos" },
					{ "data": "Nombres" },
					{ "data": "Edad" },
					{ "data": "Genero" },
					{ "data": "Gestante" },
					{ "data": "Peso" },
					{ "data": "Talla" },
					{ "data": "Inicio_Sintomas" },
					{ "data": "Ingreso_Hospital" },
					{ "data": "Ingreso_UCI" },
					{ "data": "DM" },
					{ "data": "HTA" },
					{ "data": "ERC" },
					{ "data": "VIH" },
					{ "data": "LES" },
					{ "data": "ASMA" },
					{ "data": "TBC" },
					{ "data": "NM" },
					{ "data": "Otros" },
					{ "data": "EDAs" },
					{ "data": "Dias_EDAs" },
					{ "data": "Resfrio" },
					{ "data": "Dias_Resfrio" },
					{ "data": "Vacunas" },
					{ "data": "Detalle_Vacunas" },
					{ "data": "Estancia_Horas" },
					{ "data": "Estancia_Dias" },
					{ "data": "VMI" },
					{ "data": "VMI_Horas" },
					{ "data": "VMI_Dias" },
					{ "data": "Dolor_Articular" },
					{ "data": "DFM_Miembros_Superiores" },
					{ "data": "DFM_Miembros_Inferiores" },
					{ "data": "Dificultad_Respiratoria" },
					{ "data": "Dolor_Extremidades" },
					{ "data": "Dificultad_Marcha" },
					{ "data": "Cuadriplejia" },
					{ "data": "Glasgow" },
					{ "data": "UCI_Habitual" },
					{ "data": "Cama_UCIH" },
					{ "data": "UCI_Contingencia" },
					{ "data": "Cama_UCIC" },
					{ "data": "PA" },
					{ "data": "T" },
					{ "data": "Vasopresores_o_Inotropicos" },
					{ "data": "Tipo_Vas_Inot" },
					{ "data": "ROT" },
					{ "data": "Fuerza_Muscular" },
					{ "data": "Escala_Glasgow" },
					{ "data": "Electromiografia" },
					{ "data": "Fecha_Elect" },
					{ "data": "Conclusion_1" },
					{ "data": "Conclusion_2" },
					{ "data": "Velocidad" },
					{ "data": "Puncion_Lumbar" },
					{ "data": "Fecha_PL" },
					{ "data": "PL_Enviado" },
					{ "data": "Tipificacion_Viral" },
					{ "data": "Fecha_TV" },
					{ "data": "TV_Enviado" },
					{ "data": "Tipifacion_Bacteriana" },
					{ "data": "Fecha_PB" },
					{ "data": "PB_Enviado" },
					{ "data": "Isopado_Orofaringia" },
					{ "data": "Fecha_IO" },
					{ "data": "IO_Enviado" },
					{ "data": "Examen_Heces" },
					{ "data": "Fecha_EH" },
					{ "data": "EH_Enviado" },
					{ "data": "CIE10A" },
					{ "data": "CIE10A_Presuntivo" },
					{ "data": "CIE10A_Definitivo" },
					{ "data": "CIE10B" },
					{ "data": "CIE10B_Presuntivo" },
					{ "data": "CIE10B_Definitivo" },
					{ "data": "CIE10C" },
					{ "data": "CIE10C_Presuntivo" },
					{ "data": "CIE10C_Definitivo" },
					{ "data": "Inmunoglobulina" },
					{ "data": "I_Frascos" },
					{ "data": "I_Dias" },
					{ "data": "I_Reacciones_Adversas" },
					{ "data": "Plasmaferesis_Albunina" },
					{ "data": "P_A_Frascos" },
					{ "data": "P_A_Dias" },
					{ "data": "P_A_Reacciones_Adversas" },
					{ "data": "Plasmaferesis_PFC" },
					{ "data": "P_PFC_Frascos" },
					{ "data": "Apache_II" },
					{ "data": "Fecha_CAF" },
					{ "data": "Fecha_Intubacion" },
					{ "data": "Dias_en_UCI" },
					{ "data": "Dias_en_VMI" },
					{ "data": "Modo_Ventilatorio" },
					{ "data": "Fecha_Modo_Ventilatorio" },
					{ "data": "Horas_Destete" },
					{ "data": "Dias_Destete" },
					{ "data": "Traqueostomia" },
					{ "data": "Fecha_Traqueostomia" },
					{ "data": "Fecha_Extubacion" },
					{ "data": "Destino_Alta_UCI" },
					{ "data": "Ultima_Actualizacion" },
					{ "data": "ID" }
				],
				columnDefs: [{
					"targets": [0, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105],
					"visible": false,
					"searchable": false
				}],
				"order": [[1, "asc"]],
				buttons: [
					{
						extend: 'copy', title: 'Lista Pacientes',
						exportOptions: {
							columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
						}
					},
					{
						extend: 'csv', title: 'Lista Pacientes',
						exportOptions: {
							columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
						}
					},
					{
						extend: 'excel', title: 'Lista Pacientes',
						exportOptions: {
							columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105]
						}
					},
					{
						extend: 'pdf', title: 'Lista Pacientes', orientation: 'landscape',
						exportOptions: {
							columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
						}
					},
					{
						extend: 'print',
						title: 'Imprimir',
						exportOptions: {
							columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
						},
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
			var estado = data.estado;
			var id = data.ID;
			console.log("ID: " + id);
			console.log(data);
			$("#btn-editar").addClass("editar");
			$("#btn-editar label").attr("rel", id);
			$("#btn-eliminar").addClass("eliminar");
			$("#deleteForm input[name=id]").val(id);
			$("#deleteForm #paciente").html(data.Nombres + ', ' + data.Apellidos);

			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}

		});

		$("#btn-nuevo").on("click", function () {

			post(URI + "emergencias/paciente/registrar", { id: ID_EMERGENCIA });
		});
		$('#btn-editar').on('click', function () {

			var ID = $("#btn-editar label").attr("rel");
			post(URI + "emergencias/paciente/editar", { id_emergencias_registro_id: ID_EMERGENCIA, ID: ID });
		});
		$('#btn-paciente').on('click', function () {
			var id = $(this).find("label").attr("rel");

			post(URI + "emergencias/paciente", { id: ID });
		});

		$("#deleteForm").validate({
			rules: {
				id: { required: true }
			},
			messages: {
				id: { required: "Ingrese el ID" }
			},
			submitHandler: function (form, event) {

				event.preventDefault();

				$.ajax({
					data: $("#deleteForm").serialize(),
					url: URI + "emergencias/paciente/eliminar",
					method: "POST",
					dataType: "json",
					beforeSend: function () {
						$("#modalCargaGeneral").css("display", "block");
					},
					error: function () {
						$("#modalCargaGeneral").css("display", "none");
						$("#deleteModal").modal("hide");
					},
					success: function (data) {
						$("#modalCargaGeneral").css("display", "none");
						$("#deleteModal").modal("hide");
						$success = '<div class="alert alert-success"><h4 style="margin:0">Paciente eliminado exitosamente</h4></div>';
						$error = '<div class="alert alert-error"><h4 style="margin:0">El paciente no pudo ser eliminado</h4></div>';

						if (parseInt(data.status) == 200) $message = $success;
						else $message = $error;

						$('html, body').animate({ scrollTop: 0 }, 'fast');
						$("#message").html($message);

						setTimeout(function () { location.reload(); }, 2000);
					}
				});

			}
		});

	});

}