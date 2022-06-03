function usuarios(URI, ANIO_EJECUCION) {

	setTimeout(function () { $(".alert").slideUp(); }, 3500);
	function areasByUser(Anio_Ejecucion, Codigo_Sector, Codigo_Pliego, Codigo_Ejecutora, Codigo_Centro_Costos, Codigo_Sub_Centro_Costos, Codigo_Usuario) {

		$.ajax({
			url: URI + 'usuarios/usuario/areasUsuario',
			method: 'post',
			type: 'json',
			data: {
				Anio_Ejecucion: Anio_Ejecucion, Codigo_Sector: Codigo_Sector, Codigo_Pliego: Codigo_Pliego, Codigo_Ejecutora: Codigo_Ejecutora,
				Codigo_Centro_Costos: Codigo_Centro_Costos, Codigo_Sub_Centro_Costos: Codigo_Sub_Centro_Costos, Codigo_Usuario: Codigo_Usuario
			},
			error: function (xhr) { alert(xhr); },
			beforeSend: function () {
				$("#areasModal table tbody").html("");
			},
			success: function (data) {
				data = JSON.parse(data);
				$.each(data, function (i, e) {
					$check = '<input type="checkbox" name="chk_areas[]" value="' + e.Codigo_Area + '">';
					if (parseInt(e.Codigo_Usuario) > 0) $check = '<input type="checkbox" name="chk_areas[]" value="' + e.Codigo_Area + '" checked="true">';
					$("#areasModal table tbody").append('<tr><td>' + e.Codigo_Area + '</td><td>' + e.Nombre_Area + '</td><td>' + $check + '</td></tr>');
				});
			}
		});

	}

	$(document).ready(function () {

		$("#btn-buscar2").on("click", function () {
			var Evento_Ficha_Atencion_Detalle_DNI = $("#formActualizar input[name=DNI]").val();

			if (Evento_Ficha_Atencion_Detalle_DNI.length == 8) {

				$.ajax({
					url: URI + "eventos/eventos/curl",
					data: { type: '01', document: Evento_Ficha_Atencion_Detalle_DNI },
					method: 'post',
					dataType: 'json',
					error: function (xhr) {
						$("#btn-buscar2").removeAttr("disabled");
						$("#btn-buscar2").html('<i class="fa fa-search" aria-hidden="true"></i>');
					},
					beforeSend: function () {
						$("#btn-buscar2").html('<i class="fa fa-spinner fa-pulse"></i>');
						$("#btn-buscar2").attr("disabled", "disabled");
					},
					success: function (data) {
						$("#btn-buscar2").removeAttr("disabled");
						$("#btn-buscar2").html('<i class="fa fa-search" aria-hidden="true"></i>');

						$("#formActualizar input[name=Apellidos]").val(data.data.attributes.apellido_paterno + " " + data.data.attributes.apellido_materno);
						$("#formActualizar input[name=Nombres]").val(data.data.attributes.nombres);
					}
				});

			}

		});

		$("#btn-buscar").on("click", function () {
			var DNI = $("#formRegistrar input[name=DNI]").val();

			if (DNI.length == 8) {

				$.ajax({
					url: URI + "eventos/eventos/curl",
					data: { type: '01', document: DNI },
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

						$("#formRegistrar input[name=Apellidos]").val(data.data.attributes.apellido_paterno + " " + data.data.attributes.apellido_materno);
						$("#formRegistrar input[name=Nombres]").val(data.data.attributes.nombres);
					}
				});

			}

		});

		$("#btnRegistrarModal").on("click", function () {
			var validator = $("#formRegistrar").validate();
			validator.resetForm();
			$("#formRegistrar")[0].reset();
			$("#registrarModal").modal("show");
		});
		$("#formInsertarAreas").validate({
			rules: {
				Anio_Ejecucion: { required: true },
				Codigo_Sector: { required: true },
				Codigo_Pliego: { required: true },
				Codigo_Ejecutora: { required: true },
				Codigo_Centro_Costos: { required: true },
				Codigo_Sub_Centro_Costos: { required: true }
			},
			messages: {
				Anio_Ejecucion: { required: "(*) Campo Requerido" },
				Codigo_Sector: { required: "(*) Campo Requerido" },
				Codigo_Pliego: { required: "(*) Campo Requerido" },
				Codigo_Ejecutora: { required: "(*) Campo Requerido" },
				Codigo_Centro_Costos: { required: "(*) Campo Requerido" },
				Codigo_Sub_Centro_Costos: { required: "(*) Campo Requerido" }
			}
		});
		$("#formPassword").validate({
			rules: {
				password: { required: true, minlength: 6 },
				re_password: { required: true, equalTo: "#password" }
			},
			messages: {
				password: { required: "Ingrese la contrase\xf1a", minlength: "Por lo menos 6 caracteres" },
				re_password: { required: "Ingrese nuevamente la contrase\xf1a", equalTo: "Las contrase\xf1as deben ser iguales" }
			}
		});

		/****************AJAX***************/
		$("body").on("click", ".areasEdit", function () {

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();

			var anio = data.Anio_Ejecucion;
			var sector = data.Codigo_Sector;
			var pliego = data.Codigo_Pliego;
			var ejecutora = data.Codigo_Ejecutora;
			var centro_costos = data.Codigo_Centro_Costos;
			var sub_centro_costos = data.Codigo_Sub_Centro_Costos;

			if (anio.length > 0 && sector.length > 0 && pliego.length > 0 && ejecutora.length > 0 && centro_costos.length > 0) {

				$("select[name=Anio_Ejecucion]").val(anio);

				$.ajax({
					url: URI + 'general/cargarSelectUsuarioEditar',
					method: 'post',
					type: 'json',
					data: { anio: anio, sector: sector, pliego: pliego, ejecutora: ejecutora, centroCostos: centro_costos },
					error: function (xhr) { alert(xhr); },
					beforeSend: function () {
						$("#Codigo_Sector").html('<option value="">Cargando...</option>');
						$("#Codigo_Pliego").html('<option value="">Cargando...</option>');
						$("#Codigo_Ejecutora").html('<option value="">Cargando...</option>');
						$("#Codigo_Centro_Costos").html('<option value="">Cargando...</option>');
						$("#Codigo_Sub_Centro_Costos").html('<option value="">Cargando...</option>');
					},
					success: function (data) {
						$("#Codigo_Sector").html('<option value="">[Seleccione...]</option>');
						$("#Codigo_Pliego").html('<option value="">[Seleccione...]</option>');
						$("#Codigo_Ejecutora").html('<option value="">[Seleccione...]</option>');
						$("#Codigo_Centro_Costos").html('<option value="">[Seleccione...]</option>');
						$("#Codigo_Sub_Centro_Costos").html('<option value="">[Seleccione...]</option>');

						data = JSON.parse(data);
						$.each(data["sector"], function (i, e) {
							if (e.Codigo_Sector == sector) $("#Codigo_Sector").append('<option value="' + e.Codigo_Sector + '" selected>' + e.Codigo_Sector + ' - ' + e.Nombre_Sector + '</option>');
							else $("#Codigo_Sector").append('<option value="' + e.Codigo_Sector + '">' + e.Codigo_Sector + ' - ' + e.Nombre_Sector + '</option>');

						});
						$.each(data["pliego"], function (i, e) {
							if (e.Codigo_Pliego == pliego) $("#Codigo_Pliego").append('<option value="' + e.Codigo_Pliego + '" selected>' + e.Codigo_Pliego + ' - ' + e.Nombre_Pliego + '</option>');
							else $("#Codigo_Pliego").append('<option value="' + e.Codigo_Pliego + '">' + e.Codigo_Pliego + ' - ' + e.Nombre_Pliego + '</option>');

						});
						$.each(data["ejecutora"], function (i, e) {
							if (e.Codigo_Ejecutora == ejecutora) $("#Codigo_Ejecutora").append('<option value="' + e.Codigo_Ejecutora + '" selected>' + e.Codigo_Ejecutora + ' - ' + e.Nombre_Ejecutora + '</option>');
							else $("#Codigo_Ejecutora").append('<option value="' + e.Codigo_Ejecutora + '">' + e.Codigo_Ejecutora + ' - ' + e.Nombre_Ejecutora + '</option>');

						});
						$.each(data["centroCostos"], function (i, e) {
							if (e.Codigo_Centro_Costos == centro_costos) $("#Codigo_Centro_Costos").append('<option value="' + e.Codigo_Centro_Costos + '" selected>' + e.Codigo_Centro_Costos + ' - ' + e.Nombre_Centro_Costos + '</option>');
							else $("#Codigo_Centro_Costos").append('<option value="' + e.Codigo_Centro_Costos + '">' + e.Codigo_Centro_Costos + ' - ' + e.Nombre_Centro_Costos + '</option>');

						});
						$.each(data["subCentroCostos"], function (i, e) {
							if (e.Codigo_Sub_Centro_Costos = sub_centro_costos) $("#Codigo_Sub_Centro_Costos").append('<option value="' + e.Codigo_Sub_Centro_Costos + '" selected>' + e.Codigo_Sub_Centro_Costos + ' - ' + e.Nombre_Sub_Centro_Costos + '</option>');
							else $("#Codigo_Sub_Centro_Costos").append('<option value="' + e.Codigo_Sub_Centro_Costos + '">' + e.Codigo_Sub_Centro_Costos + ' - ' + e.Nombre_Sub_Centro_Costos + '</option>');

						});
					}
				});
			}

			var $anio = ANIO_EJECUCION;
			areasByUser($anio, sector, pliego, ejecutora, centro_costos, sub_centro_costos, data.Codigo_Usuario);

			$("#areasModal").modal("show");

			$("#areasModal input[name=Codigo_Usuario]").val(data.Codigo_Usuario);

		});

		$("#Anio_Ejecucion,#Codigo_Sector,#Codigo_Pliego,#Codigo_Ejecutora,#Codigo_Centro_Costos,#Codigo_Sub_Centro_Costos").change(function () {

			$("#tbAreas tbody").html("");
			setTimeout(function () {
				var Anio_Ejecucion = $("#Anio_Ejecucion").val();
				var Codigo_Sector = $("#Codigo_Sector").val();
				var Codigo_Pliego = $("#Codigo_Pliego").val();
				var Codigo_Ejecutora = $("#Codigo_Ejecutora").val();
				var Codigo_Centro_Costos = $("#Codigo_Centro_Costos").val();
				var Codigo_Sub_Centro_Costos = $("#Codigo_Sub_Centro_Costos").val();
				var Codigo_Usuario = $("#areasModal input[name=Codigo_Usuario]").val();
				if (Anio_Ejecucion.length > 0 && Codigo_Sector.length > 0 && Codigo_Pliego.length > 0 && Codigo_Ejecutora.length > 0 && Codigo_Centro_Costos.length > 0 &&
					Codigo_Sub_Centro_Costos.length > 0 && Codigo_Usuario.length > 0) {
					$("#tbAreas tbody").html("<tr><td colspan='3' align='center'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i></td></tr>");
					areasByUser(Anio_Ejecucion, Codigo_Sector, Codigo_Pliego, Codigo_Ejecutora, Codigo_Centro_Costos, Codigo_Sub_Centro_Costos, Codigo_Usuario);
				}
				else {
					$("#tbAreas tbody").html("");
				}
			}, 500);
		});

		$(".datepicker").datepicker({
			language: "es"
		});

		$("#formRegistrar").validate({
			rules: {
				Usuario: { required: true },
				DNI: { required: true, minlength: 8, maxlength: 8, digits: true },
				Apellidos: { required: true },
				Nombres: { required: true },
				Codigo_Perfil: { required: true },
				Codigo_Region: { required: function () { if ($("#formRegistrar select[name=Codigo_Perfil]").val() != "02") return true; else return false; } }
			},
			messages: {
				Usuario: { required: "(*) Campo Requerido" },
				DNI: { required: "Campo requirido", minlength: 'Deben ser 8 n\xfameros ', maxlength: 'Deben ser 8 n\xfameros', digits: 'Solo puede ingresar n\xfameros' },
				Apellidos: { required: "(*) Campo Requerido" },
				Nombres: { required: "(*) Campo Requerido" },
				Codigo_Perfil: { required: "(*) Campo Requerido" },
				Codigo_Region: { required: "(*) Campo Requerido" }
			}
		});

		$("#formActualizar").validate({
			rules: {
				Usuario: { required: true },
				DNI: { required: true, minlength: 8, maxlength: 8, digits: true },
				Apellidos: { required: true },
				Nombres: { required: true },
				Codigo_Perfil: { required: function () { if ($("#formActualizar #Codigo_Usuario").val() != "0001") return true; else return false; } },
				Codigo_Region: { required: function () { if ($("#formActualizar select[name=Codigo_Perfil]").val() != "02") return true; else return false; } }
			},
			messages: {
				Usuario: { required: "(*) Campo Requerido" },
				DNI: { required: "Campo requirido", minlength: 'Deben ser 8 n\xfameros ', maxlength: 'Deben ser 8 n\xfameros', digits: 'Solo puede ingresar n\xfameros' },
				Apellidos: { required: "(*) Campo Requerido" },
				Nombres: { required: "(*) Campo Requerido" },
				Codigo_Perfil: { required: "(*) Campo Requerido" },
				Codigo_Region: { required: "(*) Campo Requerido" }
			}
		});

		var tbListar = $('#tbListar').DataTable({
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
				{ "data": "Numero" },
				{ "data": "Codigo_Usuario" },
				{ "data": "DNI" },
				{ "data": "Apellidos" },
				{ "data": "Nombres" },
				{ "data": "Usuario" },
				{ "data": "Descripcion_Perfil" },
				{ "data": "Nombre_Region" },
				{ "data": "Areas" },
				{ "data": "Password" },
				{ "data": "Condicion" },
				{ "data": "Editar" },
				{ "data": "permisos" },
				{ "data": "Codigo_Perfil" },
				{ "data": "Codigo_Region" },
				{ "data": "Anio_Ejecucion" },
				{ "data": "Codigo_Sector" },
				{ "data": "Codigo_Pliego" },
				{ "data": "Codigo_Ejecutora" },
				{ "data": "Codigo_Centro_Costos" },
				{ "data": "Codigo_Sub_Centro_Costos" }
			],
			"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
			columnDefs: [
				{
					"targets": [13, 14, 15, 16, 17, 18, 19, 20],
					"visible": false,
					"searchable": false
				}
			],
			buttons: [
				{ extend: 'copy', text: 'Copiar', title: 'Copiar', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },
				{ extend: 'csv', title: 'Csv', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },
				{ extend: 'excel', title: 'Excel', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },
				{ extend: 'pdf', title: 'Pdf', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] } },

				{
					extend: 'print',
					text: 'Imprimir',
					title: 'Imprimir',
					exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
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
			$("#deleteModal input[name=Anio_Ejecucion]").val("");
			$("#deleteModal input[name=Codigo_Proceso]").val("");
			$('#deleteModal').modal('show');

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();

			$("#deleteModal input[name=Anio_Ejecucion]").val(data.Anio_Ejecucion);
			$("#deleteModal input[name=Codigo_Proceso]").val(data.Codigo_Proceso);
			$("#deleteModal #eliminar_proceso").text(data.Descripcion_Proceso);

		});

		$("body").on("click", ".passwordEdit", function () {

			$("#passwordModal").modal("show");

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();
			var Codigo_Usuario = data.Codigo_Usuario;

			$("#passwordModal input[name=Codigo_Usuario]").val(Codigo_Usuario);

		});

		$("body").on("click", ".actionEdit", function () {

			$("#actualizarModal").modal("show");

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();

			var Codigo_Usuario = data.Codigo_Usuario;

			var Usuario = data.Usuario;
			var DNI = data.DNI;
			var Apellidos = data.Apellidos;
			var Nombres = data.Nombres;
			var Codigo_Perfil = data.Codigo_Perfil;
			var Codigo_Region = data.Codigo_Region;

			$("#actualizarModal #Codigo_Usuario").val(Codigo_Usuario);
			$("#Usuario").val(Usuario);
			$("#DNI").val(DNI);
			$("#Apellidos").val(Apellidos);
			$("#Nombres").val(Nombres);
			$("#Codigo_Perfil").val(Codigo_Perfil);

			if (Codigo_Perfil == '01') {
				$("#ocultar").addClass("ocultar");
			}
			else $("#ocultar").removeClass("ocultar");

			$("#Codigo_Region").val(Codigo_Region);

		});
		$("body").on("click", ".actionDisable", function () {
			$("#disableModal input[name=Codigo_Usuario]").val("");
			$('#disableModal').modal('show');

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();

			$("#disableModal input[name=Codigo_Usuario]").val(data.Codigo_Usuario);
			$("#disableModal #usuario").text(data.Usuario);

		});
		$("body").on("click", ".actionEnable", function () {
			$("#enableModal input[name=Codigo_Usuario]").val("");
			$('#enableModal').modal('show');

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			data = row.data();

			$("#enableModal input[name=Codigo_Usuario]").val(data.Codigo_Usuario);
			$("#enableModal #usuario").text(data.Usuario);

		});
		/****************AJAX***************/

		$("#Anio_Ejecucion").change(function () {
			anioEjecucion("#formInsertarAreas", $(this));
		});

		$("#Codigo_Sector").change(function () {
			codigoSector("#formInsertarAreas", $(this));
		});

		$("#Codigo_Pliego").change(function () {
			codigoPliego("#formInsertarAreas", $(this));
		});

		$("#Codigo_Ejecutora").change(function () {
			codigoEjecutora("#formInsertarAreas", $(this));
		});

		$("#Codigo_Centro_Costos").change(function () {
			codigoCentroCostos("#formInsertarAreas", $(this));
		});
		$("[id*=chkMenu]").on("click", function () {

			var $status = $(this).prop("checked");
			var $id = $(this).attr("id");
			$id = $id.replace("chkMenu", "");

			if ($status == false) {

				$.each($(".subMenu"), function (i, e) {
					var rel = $(this).attr("rel");
					console.log("recorrido:" + rel + " ,id: " + $id);
					if (parseInt(rel) == parseInt($id)) {
						$(this).prop("checked", false);
					}

				});

			}

		});

		$("[id*=chkSubMenu]").on("click", function () {

			$status = $(this).prop("checked");
			$id = $(this).val();
			$attr = $(this).attr("rel");

			if ($status) {

				$chk = "#chkMenu" + $attr;
				$($chk).prop("checked", true);

			}

		});

		$("body").on("click", ".actionPermisos", function () {

			var tr = $(this).parents('tr');
			var row = tbListar.row(tr);
			var data = row.data();

			var id = data.Codigo_Usuario;

			$(".menuUsuario").prop("checked", false);
			$(".subMenu").prop("checked", false);
			$(".menuPermiso").prop("checked", false);

			if (id.length > 0) {

				$("#permisosModal").modal("show");
				$("#hIdUsuario").val(id);

				$.ajax({
					url: URI + 'usuarios/usuario/permisos',
					method: 'post',
					type: 'json',
					data: { idusuario: id },
					error: function (xhr) { alert(xhr); },
					beforeSend: function () {
					},
					success: function (data) {

						data = JSON.parse(data);

						$.each(data.eventos, function (i, e) {

							if (parseInt(e.Activo) == 1) {

								$.each($(".menuUsuario"), function (f, g) {
									$id = $(this).val();
									if (parseInt(e.idmenu) == parseInt($id)) {
										$(this).prop("checked", true);
										console.log(e.subMenu);
										if (e.subMenu != null) {
											$.each(e.subMenu, function (f, g) {

												if (parseInt(g.Activo) == 1) {

													$.each($(".subMenu"), function (h, i) {
														$id = $(this).val();
														if (parseInt(g.idmenudetalle) == parseInt($id)) {
															$(this).prop("checked", true);
														}

													});
												}

											});
										}

									}

								});
							}

						});

						$.each(data.tablero, function (i, e) {

							if (parseInt(e.Activo) == 1) {

								$.each($(".menuUsuario"), function (f, g) {
									$id = $(this).val();
									if (parseInt(e.idmenu) == parseInt($id)) {
										$(this).prop("checked", true);

										if (e.subMenu != null) {
											$.each(e.subMenu, function (f, g) {

												if (parseInt(g.Activo) == 1) {

													$.each($(".subMenu"), function (h, i) {
														$id = $(this).val();
														if (parseInt(g.idmenudetalle) == parseInt($id)) {
															$(this).prop("checked", true);
														}

													});
												}

											});
										}

									}

								});
							}

						});

						$.each(data.brigadistas, function (i, e) {

							if (parseInt(e.Activo) == 1) {

								$.each($(".menuUsuario"), function (f, g) {
									$id = $(this).val();
									if (parseInt(e.idmenu) == parseInt($id)) {
										$(this).prop("checked", true);
										console.log(e.subMenu);
										if (e.subMenu != null) {
											$.each(e.subMenu, function (f, g) {

												if (parseInt(g.Activo) == 1) {

													$.each($(".subMenu"), function (h, i) {
														$id = $(this).val();
														if (parseInt(g.idmenudetalle) == parseInt($id)) {
															$(this).prop("checked", true);
														}

													});
												}

											});
										}

									}

								});

							}

						});

						$.each(data.usuarios, function (i, e) {

							if (parseInt(e.Activo) == 1) {

								$.each($(".menuUsuario"), function (f, g) {
									$id = $(this).val();
									if (parseInt(e.idmenu) == parseInt($id)) {
										$(this).prop("checked", true);
										console.log(e.subMenu);
										if (e.subMenu != null) {
											$.each(e.subMenu, function (f, g) {

												if (parseInt(g.Activo) == 1) {

													$.each($(".subMenu"), function (h, i) {
														$id = $(this).val();
														if (parseInt(g.idmenudetalle) == parseInt($id)) {
															$(this).prop("checked", true);
														}

													});
												}

											});
										}

									}

								});
							}

						});

						$.each(data.inventarios, function (i, e) {

							if (parseInt(e.Activo) == 1) {

								$.each($(".menuUsuario"), function (f, g) {
									$id = $(this).val();
									if (parseInt(e.idmenu) == parseInt($id)) {
										$(this).prop("checked", true);
										console.log(e.subMenu);
										if (e.subMenu != null) {
											$.each(e.subMenu, function (f, g) {

												if (parseInt(g.Activo) == 1) {

													$.each($(".subMenu"), function (h, i) {
														$id = $(this).val();
														if (parseInt(g.idmenudetalle) == parseInt($id)) {
															$(this).prop("checked", true);
														}

													});
												}

											});
										}

									}

								});
							}

						});

						$.each(data.contingencias, function (i, e) {

							if (parseInt(e.Activo) == 1) {

								$.each($(".menuUsuario"), function (f, g) {
									$id = $(this).val();
									if (parseInt(e.idmenu) == parseInt($id)) {
										$(this).prop("checked", true);
										console.log(e.subMenu);
										if (e.subMenu != null) {
											$.each(e.subMenu, function (f, g) {

												if (parseInt(g.Activo) == 1) {

													$.each($(".subMenu"), function (h, i) {
														$id = $(this).val();
														if (parseInt(g.idmenudetalle) == parseInt($id)) {
															$(this).prop("checked", true);
														}

													});
												}

											});
										}

									}

								});
							}

						});

						$.each(data.permisos, function (i, e) {

							if (parseInt(e.Activo) == 1) {

								$.each($(".menuPermiso"), function (f, g) {
									$id = $(this).val();
									if (parseInt(e.idpermiso) == parseInt($id)) {
										$(this).prop("checked", true);
									}

								});
							}

						});

					}

				});
			}
		});

		$("#btnPermisos").on("click", function () {

			var $menu = [];
			var $subMenu = [];
			var $permisos = [];

			$.each($(".menuUsuario"), function (f, g) {
				var $id = $(this).val();
				var $status = $(this).prop("checked");
				var $estado = ($status) ? "1" : "0";
				$menu.push({ "idmenu": $id, "status": $estado });

			});

			$.each($(".subMenu"), function (f, g) {
				var $id = $(this).val();
				var $status = $(this).prop("checked");
				var $estado = ($status) ? "1" : "0";
				$subMenu.push({ "idmenudetalle": $id, "status": $estado });

			});

			$.each($(".menuPermiso"), function (f, g) {
				var $id = $(this).val();
				var $status = $(this).prop("checked");
				var $estado = ($status) ? "1" : "0";
				$permisos.push({ "idpermiso": $id, "status": $estado });

			});

			var usuario = $("#hIdUsuario").val();

			$.ajax({
				url: URI + 'usuarios/usuario/otorgarPermisos',
				method: 'post',
				type: 'json',
				data: { idusuario: usuario, menu: $menu, subMenu: $subMenu, permisos: $permisos },
				error: function (xhr) { alert(xhr); },
				beforeSend: function () {
					$("#btnPermisos").addClass("disabled");
				},
				success: function (data) {
					$("#btnPermisos").removeClass("disabled");
					data = JSON.parse(data);

					$("#permisosModal").modal("hide");
					if (parseInt(data.status) == 200) {
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						$("#div-alerta-success").removeClass("d-none");
						setTimeout(function () { $("#div-alerta-success").slideUp(); }, 2000);
					}

				}
			});
		});

	});
	function anioEjecucion(form, object) {

		var anio = object.val();
		if (anio.length > 0) {

			$.ajax({
				url: URI + 'general/cargarSectores',
				method: 'post',
				type: 'json',
				data: { anio: anio },
				error: function (xhr) { alert(xhr); },
				beforeSend: function () {
					$(form).find("select[name=Codigo_Sector]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {
					$(form).find("select[name=Codigo_Sector]").html('<option value="">[Seleccione...]</option>');

					data = JSON.parse(data);
					$.each(data, function (i, e) {
						$(form).find("select[name=Codigo_Sector]").append('<option value="' + e.Codigo_Sector + '">' + e.Codigo_Sector + ' - ' + e.Nombre_Sector + '</option>');
					});
				}
			});
		}

	}
	function codigoSector(form, object) {

		var anio = $(form).find("select[name=Anio_Ejecucion]").val();
		var sector = object.val();
		var select = $(form).find("select[name=Codigo_Pliego]");
		if (sector.length > 0) {

			$.ajax({
				url: URI + 'general/cargarPliegos',
				method: 'post',
				type: 'json',
				data: { anio: anio, sector: sector },
				error: function (xhr) { alert(xhr); },
				beforeSend: function () {
					select.html('<option value="">Cargando...</option>');
				},
				success: function (data) {
					select.html('<option value="">[Seleccione...]</option>');

					data = JSON.parse(data);
					$.each(data, function (i, e) {
						select.append('<option value="' + e.Codigo_Pliego + '">' + e.Codigo_Pliego + ' - ' + e.Nombre_Pliego + '</option>');
					});
				}
			});
		}

	}

	function codigoPliego(form, object) {

		var anio = $(form).find("select[name=Anio_Ejecucion]").val();
		var sector = $(form).find("select[name=Codigo_Sector]").val();
		var pliego = object.val();
		var select = $(form).find("select[name=Codigo_Ejecutora]");
		if (sector.length > 0) {

			$.ajax({
				url: URI + 'general/cargarEjecutoras',
				method: 'post',
				type: 'json',
				data: { anio: anio, sector: sector, sector: sector, pliego: pliego },
				error: function (xhr) { alert(xhr); },
				beforeSend: function () {
					select.html('<option value="">Cargando...</option>');
				},
				success: function (data) {
					select.html('<option value="">[Seleccione...]</option>');

					data = JSON.parse(data);
					$.each(data, function (i, e) {
						select.append('<option value="' + e.Codigo_Ejecutora + '">' + e.Codigo_Ejecutora + ' - ' + e.Nombre_Ejecutora + '</option>');
					});
				}
			});
		}
	}
	function codigoEjecutora(form, object) {

		var anio = $(form).find("select[name=Anio_Ejecucion]").val();
		var sector = $(form).find("select[name=Codigo_Sector]").val();
		var pliego = $(form).find("select[name=Codigo_Pliego]").val();
		var ejecutora = object.val();
		var select = $(form).find("select[name=Codigo_Centro_Costos]");
		if (ejecutora.length > 0) {

			$.ajax({
				url: URI + 'general/cargarCentroCostos',
				method: 'post',
				type: 'json',
				data: { anio: anio, sector: sector, sector: sector, pliego: pliego, ejecutora: ejecutora },
				error: function (xhr) { alert(xhr); },
				beforeSend: function () {
					select.html('<option value="">Cargando...</option>');
				},
				success: function (data) {
					select.html('<option value="">[Seleccione...]</option>');

					data = JSON.parse(data);
					$.each(data, function (i, e) {
						select.append('<option value="' + e.Codigo_Centro_Costos + '">' + e.Codigo_Centro_Costos + ' - ' + e.Nombre_Centro_Costos + '</option>');
					});
				}
			});
		}

	}

	function codigoCentroCostos(form, object) {

		var anio = $(form).find("select[name=Anio_Ejecucion]").val();
		var sector = $(form).find("select[name=Codigo_Sector]").val();
		var pliego = $(form).find("select[name=Codigo_Pliego]").val();
		var ejecutora = $(form).find("select[name=Codigo_Ejecutora]").val();
		var centroCostos = object.val();
		var select = $(form).find("select[name=Codigo_Sub_Centro_Costos]");
		if (centroCostos.length > 0) {

			$.ajax({
				url: URI + 'general/cargarSubCentroCostos',
				method: 'post',
				type: 'json',
				data: { anio: anio, sector: sector, sector: sector, pliego: pliego, ejecutora: ejecutora, centroCostos: centroCostos },
				error: function (xhr) { alert(xhr); },
				beforeSend: function () {
					select.html('<option value="">Cargando...</option>');
				},
				success: function (data) {
					console.log({ data })

					select.html('<option value="">[Seleccione...]</option>');

					data = JSON.parse(data);
					$.each(data, function (i, e) {
						select.append('<option value="' + e.Codigo_Sub_Centro_Costos + '">' + e.Codigo_Sub_Centro_Costos + ' - ' + e.Nombre_Sub_Centro_Costos + '</option>');
					});
				}
			});
		}

	}
}
