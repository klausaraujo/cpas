function consolidado(URI, ID) {

	$(document).ready(function () {

		var table = $("#tbConsolidado").DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "F_Atencion" },
				{ "data": "Paciente" },
				{ "data": "Edad" },
				{ "data": "Clasificacion" },
				{ "data": "Diagnosticos" },
				{ "data": "PMA_Oferta_Movil" },
				{ "data": "Pais" },
				{ "data": "editar" },
				{ "data": "eliminar" },
				{ "data": "ID" },
				{ "data": "IDR" },
				{ "data": "IDP" },
				{ "data": "Medico" },
				{ "data": "PreHospitalario" },
				{ "data": "Entidad" },
				{ "data": "Atencion_PMA" },
				{ "data": "Tipo_Documento" },
				{ "data": "Num_Documento" },
				{ "data": "F_Nacimiento" },
				{ "data": "Genero" },
				{ "data": "Gestante" },
				{ "data": "Discapacidad" },
				{ "data": "T_Discapacidad" },
				{ "data": "Apoderado" },
				{ "data": "Residencia" },
				{ "data": "Dias" },
				{ "data": "Meses" },
				{ "data": "F_Sintomas" },
				{ "data": "H_Sintomas" },
				{ "data": "H_Atencion" },
				{ "data": "PA" },
				{ "data": "FC" },
				{ "data": "FR" },
				{ "data": "SO2" },
				{ "data": "FIO2" },
				{ "data": "Dif_Respiratoria" },
				{ "data": "Tos" },
				{ "data": "Rinorrea" },
				{ "data": "Fiebre" },
				{ "data": "Nauseas" },
				{ "data": "Vomitos" },
				{ "data": "D_Abdominal" },
				{ "data": "Diarrea" },
				{ "data": "Otros" },
				{ "data": "V_Influenza" },
				{ "data": "V_Fiebre" },
				{ "data": "V_Sarampion" },
				{ "data": "V_Hepatitis" },
				{ "data": "V_Tetanos" },
				{ "data": "OtrasVacunas" },
				{ "data": "Detalle" },
				{ "data": "F_Toma" },
				{ "data": "F_Envio" },
				{ "data": "F_Recepcion" },
				{ "data": "Resultados" },
				{ "data": "Destino" },
				{ "data": "Lugar_Traslado" },
				{ "data": "Responsable" },
				{ "data": "Condicion" },
				{ "data": "ObservacionesAtencion" },
				{ "data": "Tratamiento" },
				{ "data": "alteracion_conciencia" },
				{ "data": "dolor_pecho" }
			],
			"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
			columnDefs: [
				{
					"targets": [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62],
					"visible": false,
					"searchable": false
				}
			],
			buttons: [
				{ extend: 'copy', text: 'copy', title: 'Consolidado', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] } },
				{ extend: 'csv', title: 'Consolidado', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] } },
				{ extend: 'excel', title: 'Consolidado', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62] } },
				{ extend: 'pdf', title: 'Consolidado', orientation: 'landscape', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] } },

				{
					extend: 'print',
					text: 'Imprimir',
					title: 'Imprimir',
					exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
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
		$("body").on("click", ".actionDelete", function () {
			$("#deleteModal input[name=id]").val("");
			$('#deleteModal').modal('show');

			var tr = $(this).parents('tr');
			var row = table.row(tr);
			data = row.data();
			console.log(data.ID);
			$("#deleteModal input[name=id]").val(data.ID);
		});

		$(".date").datetimepicker({
			format: "DD/MM/YYYY"
		});
	});
	$("#combo").on("change", function () {

		$("#form").submit();

	});
}