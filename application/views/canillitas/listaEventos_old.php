<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?=TITULO_PRINCIPAL?></title>
	<meta name="author" content="<?=AUTOR?>">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?=base_url()?>public/images/favicon.jpg">
	<link rel="icon" href="<?=base_url()?>public/images/favicon.jpg" type="image/x-icon">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=base_url()?>public/template/css/bootstrap.min.css">
	<!-- Typography CSS -->
	<link rel="stylesheet" href="<?=base_url()?>public/template/css/typography.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="<?=base_url()?>public/template/css/style.css">
	<!-- Responsive CSS -->
	<link rel="stylesheet" href="<?=base_url()?>public/template/css/responsive.css">


	<!-- Data table CSS -->
	<!-- <link href="<?=base_url()?>public/css/datatables.min.css" rel="stylesheet" type="text/css"> -->
	<link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	<link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet"
		type="text/css">
		<style>
         .half-rule {
         margin-left: 0;
         text-align: left;
         width: 50%;
         }
         .statis {
            color: #EEE;
            margin-top: 15px;
         }
         h3 {
            color: #EEE;
            font-size: 20px;
         }
         .statis .box {
            position: relative;
            padding: 15px;
            overflow: hidden;
            border-radius: 3px;
            margin-bottom: 25px;
         }
         .statis .box h3:after {
            content: "";
            height: 2px;
            width: 70%;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.12);
            display: block;
            margin-top: 10px;
         }
         .statis .box i {
            position: absolute;
            height: 70px;
            width: 70px;
            font-size: 22px;
            padding: 15px;
            top: -25px;
            left: -25px;
            background-color: rgba(255, 255, 255, 0.15);
            line-height: 60px;
            text-align: right;
            border-radius: 50%;
         }
         .warning {background-color: #f0ad4e}
         .danger {background-color: #d9534f}
         .success {background-color: #5cb85c}
         .inf {background-color: #5bc0de}
      </style>
	<!-- Data table CSS -->
	<!--<link href="<?=base_url()?>public/css/datatables.min.css" rel="stylesheet" type="text/css">-->
	<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/listaEventos.css?v=<?=date("s")?>" />
	<?php $opciones = $this->session->userdata("Permisos_Opcion");?>
</head>

<body>
	<!-- loader Start -->
	<div id="loading">
		<div id="loading-center">
		</div>
	</div>
	<!-- loader END -->
	<!-- Wrapper Start -->
	<div class="wrapper">

		<!-- Sidebar  -->
		<?php $this->load->view("inc/nav-template"); ?>


		<!-- Page Content  -->
		<div id="content-page" class="content-page">
			<!-- TOP Nav Bar -->
			<?php $this->load->view("inc/nav-top-template"); ?>
			<!-- TOP Nav Bar END -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<?php //echo "<pre>"; echo $lista; echo '<br>'.$pacientes;//echo "<pre>"; echo var_dump($lista); ?>
					</div>
				</div>
				<div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title">LISTADO GENERAL DE EVENTOS</h4>
                              </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="form-group row">
                            <div class="col-xs-12 col-md-5 col-md-offset-5 pa-10">
                                <button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal" id="btnRegistrar">
                                  Registrar Nuevo Evento
                                </button>
                            </div>
                           </div>
                           <div class="table-responsive">
									<table class="tbLista table table-hover mb-0">
										<thead>
											<tr>
												<th class="text-center">N&uacute;mero</th>
												<th>Evento Producido</th>
												<th style="width: 84px;">Fecha y Hora</th>
												<th>Ubicaci&oacute;n del Evento (UBIGEO)</th>
												<th class="text-center" style="width: 80px;">Nivel</th>
												<th class="text-center" style="width: 40px;">Men&uacute;</th>
												<th class="text-center"><span data-toggle="tooltip" data-placement="top"
														title="Mapa">Mapa</span></th>
												<th><span data-toggle="tooltip" data-placement="top"
														title="Galeria">Fotos</span></th>
												<th><span data-toggle="tooltip" data-placement="top"
														title="Requerimientos">Req.</span></th>
												<th class="text-center">Estado</th>
												<th>&nbsp;</th>
												<th>&nbsp;</th>
												<th>Coordenadas</th>
												<th>&nbsp;</th>
												<th>&nbsp;</th>
												<th>Danios</th>
												<th>Lesionados</th>
												<th>Acciones</th>
												<th>EE.SS.</th>
												<th>&nbsp;</th>
												<th>Estado</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$n = 1;
												foreach ($lista as $row):
												?>
											<tr>
												<td align="center"><?=$row["codigo"]?></td>
												<td><?=$row["evento"]?></td>
												<td><?=$row["fecha"]?></td>
												<td><?=$row["ubigeo"]?></td>
												<td align="center"><?=$row["nivel"]?></td>
												<td class="text-center">
													<?php if ($row["Evento_Estado_Codigo"] != "1") {?>
													<i class="fa fa-home disabled" aria-hidden="true"></i>
													<!--<i class="fa fa-user disabled" aria-hidden="true"></i>
															<i class="fa fa-share-square disabled" aria-hidden="true"></i>
															<i class="fa fa-hospital-o disabled" aria-hidden="true"></i>-->
													<?php } else {?>
													<?php if (validarPermisosOpciones(2, $opciones)) {?><span
														class="inline-block"><i class="fa fa-home addDanios"
															aria-hidden="true"></i></span><?php }?>

													<?php }?>
												</td>
												<td class="text-center">
													<?php if ($row["Evento_Estado_Codigo"] != "1") {?>
													<a href="javascript:;"><i class="fa fa-globe disabled"
															rel="<?=$row["Evento_Coordenadas"]?>"></i></a>
													<?php } else {?>
													<?php if (validarPermisosOpciones(5, $opciones)) {?>
													<a href="javascript:;"><i class="fa fa-globe actionMap"
															rel="<?=$row["Evento_Coordenadas"]?>"></i></a><?php }?>
												</td>
												<?php }?>
												<td class="text-center">
													<?php if ($row["Evento_Estado_Codigo"] != "1") {?>
													<a href="javascript:;"><i
															class="fa fa-file-photo-o disabled"></i></a>
													<?php } else {?>
													<?php if (validarPermisosOpciones(6, $opciones)) {?>
													<a href="javascript:;"><i
															class="fa fa-file-photo-o addPhotos"></i></a>
													<?php }?>
													<?php }?>
												</td>
												<td class="text-center">
													<?php if ($row["Evento_Estado_Codigo"] != "1") {?>
													<a href="javascript:;"><i class="fa fa-list-alt disabled"></i></a>
													<?php } else {?>
													<?php if (validarPermisosOpciones(27, $opciones)) {?>
													<a href="javascript:;"><i
															class="fa fa-list-alt addAsignacion"></i></a>
													<?php }?>
													<?php }?>
												</td>
												<td class="text-center">
													<?php
														$html = '';
														$status = '';
														switch ($row["Evento_Estado_Codigo"]) {
														    case 1:
														        $html = '<span class="label label-success">Monitoreo</span>';
														        $status = 'Monitoreo';
														        break;
														    case 2:
														        $html = '<span class="label label-default">Cerrado</span>';
														        $status = 'Cerrado';
														        break;
														    case 3:
														        $html = '<span class="label label-danger">Anulado</span>';
														        $status = 'Anulado';
														        break;
														}
														echo $html;?>
												</td>
												<td><?=$row["Evento_Registro_Numero"]?></td>
												<td><?=$row["Evento_Estado_Codigo"]?></td>
												<td><?=$row["orden"]?></td>
												<td><?=$row["Evento_Coordenadas"]?></td>
												<td><?=encriptarInforme($row["Evento_Registro_Numero"], "ASC")?></td>
												<td><?=encriptarInforme($row["Evento_Registro_Numero"], "DESC")?></td>
												<td><?=$row["danios"]?></td>
												<td><?=$row["lesionados"]?></td>
												<td><?=$row["acciones"]?></td>
												<td><?=$row["salud"]?></td>
												<td><?=$status?></td>

											</tr>
											<?php
											$n++;
											endforeach
											;
											?>
										</tbody>
									</table>
								</div>
                        </div>
                     </div>
                  </div>
               </div>
			</div>
			<!-- Footer -->
			<?php $this->load->view("inc/footer-template"); ?>
			<script src="<?=base_url()?>public/js/moment.min.js"></script>
            <script src="<?=base_url()?>public/js/locale.es.js"></script>
			<!-- Footer END -->
		</div>
	</div>
	<!-- Wrapper END -->
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?=base_url()?>public/template/js/jquery.min.js"></script>
	<script src="<?=base_url()?>public/template/js/popper.min.js"></script>
	<script src="<?=base_url()?>public/template/js/bootstrap.min.js"></script>
	<!-- Appear JavaScript -->
	<script src="<?=base_url()?>public/template/js/jquery.appear.js"></script>
	<!-- Countdown JavaScript -->
	<script src="<?=base_url()?>public/template/js/countdown.min.js"></script>
	<!-- Counterup JavaScript -->
	<script src="<?=base_url()?>public/template/js/waypoints.min.js"></script>
	<script src="<?=base_url()?>public/template/js/jquery.counterup.min.js"></script>
	<!-- Wow JavaScript -->
	<script src="<?=base_url()?>public/template/js/wow.min.js"></script>
	<!-- Apexcharts JavaScript -->
	<script src="<?=base_url()?>public/template/js/apexcharts.js"></script>
	<!-- Slick JavaScript -->
	<script src="<?=base_url()?>public/template/js/slick.min.js"></script>
	<!-- Select2 JavaScript -->
	<script src="<?=base_url()?>public/template/js/select2.min.js"></script>
	<!-- Owl Carousel JavaScript -->
	<script src="<?=base_url()?>public/template/js/owl.carousel.min.js"></script>
	<!-- Magnific Popup JavaScript -->
	<script src="<?=base_url()?>public/template/js/jquery.magnific-popup.min.js"></script>
	<!-- Smooth Scrollbar JavaScript -->
	<script src="<?=base_url()?>public/template/js/smooth-scrollbar.js"></script>
	<!-- lottie JavaScript -->
	<script src="<?=base_url()?>public/template/js/lottie.js"></script>
	<!-- Chart Custom JavaScript -->
	<script src="<?=base_url()?>public/template/js/chart-custom.js"></script>
	<!-- Custom JavaScript -->
	<script src="<?=base_url()?>public/template/js/custom.js"></script>
	<script src="<?=base_url()?>public/template/js/chart.min.js"></script>
	<script src="<?=base_url()?>public/js/echarts-en.min.js"></script>
	<!-- Data table JavaScript -->
	<script src="<?=base_url()?>public/js/datatables.min.js"></script>
	<script src="<?=base_url()?>public/js/circles.js"></script>
	<!-- Data table JavaScript -->
	<!-- <script src="<?=base_url()?>public/js/datatables.min.js"></script>                                     -->
	<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js "></script>
	<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js "></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js "></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script>
	<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js "></script>


	<!--
    <script>
        //const URI_MAP = "<?=base_url()?>";
        const canDelete = "1";
        const canEdit = "1";
        const canIdioma = "1";
        const canTracking = "1";
        const canHistory = "1";
        var URI = "<?=base_url()?>";
        const lista = <?= $lista ?>;

    </script>

    <script>
        $(document).ready(function () {
            console.log(lista);
            let table = $('.tablaRegied').DataTable({
                pageLength: 5,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                data: lista,
                //dom: '<"html5buttons"B>lTfgitp',
                columns: [
                    {
                        data: null,
                        render: function (data, type, row) {

                            const btnIdioma = `
                  <button class="btn btn-success btn-circle actionIdioma" title="Agregar más Detalles" type="button" style="margin-right: 5px;">
                     <i class="fa fa-user-plus" aria-hidden="true"></i>
                  </button>`;
                            const btnEdit = `
                  <button class="btn btn-warning btn-circle actionEdit" title="Editar Registro" type="button" style="margin-right: 5px;">
                     <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </button>`;
                            const btnDelete = `
                  <button class="btn btn-primary btn-circle actionDelete" title="Eliminar Registro" type="button style="margin-right: 5px;">
                     <i class="fa fa-times" aria-hidden="true"></i>
                  </button>`;
                            return `<div style="display: flex">
                           ${canIdioma ? btnIdioma : ''} 
                           ${canEdit ? btnEdit : ''} 
                           ${canDelete ? btnDelete : ''}
                           </div>`;
                        }
                    },
                    {
                        data: "idrenarhed"
                    },
                    {
                        data: "concatenado_nombre"
                    },
                    {
                        data: "numero_documento"
                    },
                    {
                        data: "sexo"
                    },
                    {
                        data: "fecha_nacimiento"
                    },

                    {
                        data: "Activo",
                        render: function (data, type, row, meta) {
                            return `<span class="badge ${data === 'Activo' ? 'badge-info' : 'badge-default'}">${data}</span>`
                        }
                    },
                ],
                order: [],
                columnDefs: [],
                dom: 'Bfrtip',
                select: true,
                buttons: [{
                    extend: 'copy',
                    title: 'Lista General de Pacientes',
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                },
                {
                    extend: 'csv',
                    title: 'Lista General de Pacientes',
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                },
                {
                    extend: 'excel',
                    title: 'Lista General de Pacientes',
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                },
                {
                    extend: 'pdf',
                    title: 'Lista General de Pacientes',
                    orientation: 'landscape',
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                },

                {





                    extend: 'print',
                    title: 'Lista General de Brigadistas',
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
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
                }],

                language:
                {
                    search: "Buscar:",
                    lengthMenu: "Mostrando _MENU_ registros por página",
                    zeroRecords: "Sin registros",
                    info: "Mostrando página  _PAGE_ de _PAGES_",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(filrado de _MAX_ registros totales)",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                }


            });


            //funcion para acceder al boton o envento
            $('.tablaRegied tbody').on('click', 'td .actionIdioma', function () {
                //   var data = table.row(this).data();
                var data = table.row($(this).parents('tr')).data();
                post(URI + "brigadistas/formAdditional", { id: data.idrenarhed });
            });

            $('.tablaRegied tbody').on('click', 'td .actionEdit', function () {
                //   var data = table.row(this).data();
                var data = table.row($(this).parents('tr')).data();
                post(URI + "brigadistas/formEdit", { id: data.idrenarhed });

            });



        });

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

	</script>
	-->
	<?php $this->load->view("inc/resource-template");?>
	<script src="<?=base_url()?>public/js/eventos/listaEventos.js?v=<?=date("s")?>"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?=getenv('MAP_KEY')?>&libraries=places" async defer>
	</script>
	<script>
		//listaEventos("<?=base_url()?>");
	</script>
</body>

</html>