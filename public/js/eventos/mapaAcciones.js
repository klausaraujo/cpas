function mapa(URI) {

	function cargarDataTablaTipo(departamento, tipo) {

		var desde = $("#desde").val();
		var hasta = $("#hasta").val();

		$.ajax({
			type: "POST",
			url: URI + "eventos/reportes/dataMapaAjax",
			data: {
				desde: desde,
				hasta: hasta,
				departamento: departamento,
				tipo: tipo
			},
			dataType: "json",
			beforeSend: function () {
				$("#preload").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
				$(".mensaje p").html("");
			},
			success: function (data) {
				$("#preload").html("");

				switch (parseInt(tipo)) {
					case 1:
						if (data.length > 0) {
							$("#tbEventos_wrapper").css("display", "block");
							setTimeout(function () {
								$.each(data, function (i, e) {
									tbEventos.rows.add([{
										"tipoEvento": e.tipoEvento,
										"evento": e.evento,
										"total": e.total
									}]).draw();
								});
							}, 100);
						} else {
							$(".mensaje p").html("No hay registros");
						}
						break;
					case 2:
						if (data.length > 0) {
							$("#tbVulnerable_wrapper").css("display", "block");
							setTimeout(function () {
								$.each(data, function (i, e) {
									tbVulnerable.rows.add([{
										"mujeres": e.mujeres,
										"gestantes": e.gestantes,
										"menor_edad": e.menor_edad,
										"adulto_mayor": e.adulto_mayor
									}]).draw();
								});
							}, 100);
						} else {
							$(".mensaje p").html("No hay registros");
						}
						break;
					case 3:
						if (data.length > 0) {
							$("#tbEESS_wrapper").css("display", "block");
							setTimeout(function () {
								$.each(data, function (i, e) {
									tbEESS.rows.add([{
										"operativas": e.operativas,
										"inoperativas": e.inoperativas
									}]).draw();
								});
							}, 100);
						} else {
							$(".mensaje p").html("No hay registros");
						}
						;
						break;
					case 4:
						if (data.length > 0) {
							$("#tbRecursos_wrapper").css("display", "block");
							setTimeout(function () {
								$.each(data, function (i, e) {
									tbRecursos.rows.add(
										[{
											"brigadistas": e.brigadistas,
											"eme": e.eme,
											"personal_salud": e.personal_salud,
											"ambulancias": e.ambulancias
										}]).draw();
								});
							}, 100);
						} else {
							$(".mensaje p").html("No hay registros");
						}
						;
						break;
					case 5:
						if (data.length > 0) {
							$("#tbCIE10_wrapper").css("display", "block");
							setTimeout(function () {
								$.each(data, function (i, e) {
									tbCIE10.rows.add([{
										"cie": e.cie,
										"descripcion": e.descripcion,
										"cantidad": e.cantidad
									}]).draw();
								});
							}, 100);
						} else {
							$(".mensaje p").html("No hay registros");
						}
						;
						break;
					case 6:
						if (data.length > 0) {
							$("#tbRegion_wrapper").css("display", "block");
							setTimeout(function () {
								$.each(data, function (i, e) {
									tbRegion.rows.add([{
										"alta": e.ALTA,
										"hospitalizado": e.HOSPITALIZADO,
										"referido": e.REFERIDO,
										"fallecido": e.FALLECIDO,
										"desaparecido": e.DESAPARECIDO,
										"observacion": e.OBSERVACION,
										"evacuacion": e.EVACUACION
									}]).draw();
								});
							}, 100);
						} else {
							$(".mensaje p").html("No hay registros");
						}
						;
						break;
				}

			}
		});

	}

	$(document).ready(function () {

		$.fn.datepicker.dates['es'] = {
			days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
			daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
			daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
			months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
			monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
			today: "Hoy",
			clear: "Limpiar",
			format: "mm/dd/yyyy",
			titleFormat: "MM yyyy",
			weekStart: 0
		};

		$('.datetimepicker').datepicker({
			format: 'dd/mm/yyyy',
			maxDate: moment(),
			language: "es",
			autoclose: true
		});

		$("#btnObtenerReporte").on("click", function () {

			var id = $("#tipoReporte").val();
			var departamento = $("#departamento").val();

			tbEventos.rows().remove().draw();
			tbVulnerable.rows().remove().draw();
			tbEESS.rows().remove().draw();
			tbRecursos.rows().remove().draw();
			tbCIE10.rows().remove().draw();
			tbRegion.rows().remove().draw();
			$("#tbEventos_wrapper,#tbVulnerable_wrapper,#tbEESS_wrapper,#tbRecursos_wrapper,#tbCIE10_wrapper,#tbRegion_wrapper").css("display", "none");
			$(".mensaje p").html("No hay registros");
			if (parseInt(id) > 0) {
				cargarDataTablaTipo(departamento, id);
			}

		});

	});

}
