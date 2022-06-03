<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?=TITULO_PRINCIPAL?></title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="<?=AUTOR?>">

	<?php $this->load->view("inc/resources"); ?>
	<?php $titulo = "Reportes estad&iacute;sticos"; ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/reporte.css" />

</head>

<body>

	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">

	<?php $this->load->view("inc/navsireed"); ?>

        <!-- Main Content -->
		<div class="page-wrapper" style="min-height: 710px;">
			<div class="container pt-30">
				<div class="row heading-bg">
					<div class="col-lg-8 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark"><?=$titulo?></h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="<?=base_url()?>">Inicio</a></li>
							<li><a href="<?=base_url()?>eventos/eventos/lista"><span>Eventos</span></a></li>
							<li class="active"><span>Reporte</span></li>
						</ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-xs-12">
								<!-- col-sm-8 col-sm-offset-2  -->
								<div class="panel panel-default card-view pa-0">
									<div class="panel-wrapper collapse in">
										<div class="panel-body pa-0">
											<div class="sm-data-box pa-10">
												<div class="container-fluid">






													<div class="form-group">

														<div class="col-xs-2">
															<div class="form-group">
																<label class="">Tipo de evento</label> <select
																	class="form-control form-control-sm" name="tipoEvento"
																	required="required" id="tipoEvento">
																	<option value="">-- Seleccione --</option>
				  <?php foreach($tipo as $row): ?>
					  <option value="<?=$row->Evento_Tipo_Codigo?>"><?=$row->Evento_Tipo_Nombre?></option>
				  <?php endforeach; ?>
			</select>
															</div>
														</div>
														<div class="col-xs-4">
															<div class="form-group">
																<label class="">Evento</label> <select
																	class="form-control form-control-sm" name="evento"
																	id="evento">
																	<option value="">-- Seleccione Tipo Evento --</option>
																</select>
															</div>
														</div>
														<div class="col-xs-2">
															<div class="form-group">
																<label class="">Nivel</label> <select
																	class="form-control form-control-sm"
																	name="nivelEmergencia" id="nivelEmergencia">
																	<option value="0">-- TODOS --</option>
			<?php foreach($nivel as $row): ?>
				  <option value="<?=$row->Evento_Nivel_Codigo?>"><?=$row->Evento_Nivel_Nombre?></option>
			  <?php endforeach; ?>
			</select>
															</div>
														</div>
														<div class="col-xs-4">
															<div class="form-group">
																<label class="">Desde / Hasta</label>
																<div class="input-group date"
																	data-target-input="nearest">
																	<div class="input-group">
																		<div class='input-group date datetimepicker'>
																			<input type="text" class="form-control"
																				data-date-format="dd/mm/yyyy" required="required"
																				id="desde" name="desde" value="<?=date("d/m/Y")?>" /> <span
																				class="input-group-addon"> <span
																				class="glyphicon glyphicon-calendar"></span>
																			</span>
																		</div>
																		<span class="input-group-btn" style="width: 1px;"></span>
																		<div class='input-group date datetimepicker'>
																			<input type="text" class="form-control"
																				data-date-format="dd/mm/yyyy" required="required"
																				name="hasta" id="hasta" value="<?=date("d/m/Y")?>" /> <span
																				class="input-group-addon"> <span
																				class="glyphicon glyphicon-calendar"></span>
																			</span>
																		</div>
																	</div>
																</div>
															</div>
														</div>

													</div>

													<div class="clearfix"></div>
													<hr />

													<div class="col-xs-12">
														<div class="col-xs-12">
															<h3 class="">
																<span style="color: red">* </span>REGIONES
															</h3>
														</div>
            <?php
            foreach ($departamentos as $row) :
                ?>
        	<div class="col-xs-6 col-md-3 departamento departamentosStatus">
															<p>
																<label><input type="checkbox" name="departamento[]"
																	value="<?=$row->Codigo_Departamento?>" required /><?=$row->Nombre?></label>
															</p>
														</div>
            <?php endforeach; ?>
            <div class="col-xs-6 col-md-3 departamento">
															<p>
																<label><input type="checkbox" name="todos" value="" checked="checked"
																	required />TODOS</label>
															</p>
														</div>

													</div>

													<div class="clearfix"></div>
													<br />
													<div class="col-xs-12">
														<button id="btnObtenerReporte"
															class="btn btn-primary disabled">Obtener Reporte</button>
													</div>

													<div class="clearfix"></div>
													<br />

													<div class="col-xs-12">
														<div class="table-responsive">
															<table
																class="table tbLista table-striped table-bordered table-sm"
																cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th>N&deg;</th>
																		<th>Fecha</th>
																		<th>Hora</th>
																		<th>Departamento</th>
																		<th>Provincia</th>
																		<th>Distrito</th>
																		<th>L&nbsp;<i class="fa fa-user" aria-hidden="true"></i></th>
																		<th>F&nbsp;<i class="fa fa-user" aria-hidden="true"></i></th>
																		<th>D&nbsp;<i class="fa fa-user" aria-hidden="true"></i></th>
																		<th>O&nbsp;<i class="fa fa-home" aria-hidden="true"></i></th>
																		<th>I&nbsp;<i class="fa fa-home" aria-hidden="true"></i></th>
																		<!--<th>C&nbsp;<i class="fa fa-home" aria-hidden="true"></i></th>
																		<th>A&nbsp;<i class="fa fa-user" aria-hidden="true"></i></th>
																		<th>D&nbsp;<i class="fa fa-user" aria-hidden="true"></i></th>-->
																	</tr>
																</thead>
																<tbody>
																</tbody>
															</table>
														</div>
													</div>
													<div class="clearfix"></div>
													<div class="col-xs-12">

														<table class="table table-bordered tableEtiqueta">
															<tbody>
                              	<tr>
                                    <td>Lesionados <span class="pull-right">L&nbsp;<i class="fa fa-user mt-5" aria-hidden="true"></i></span></td>
                                    <td>Fallecidos <span class="pull-right">F&nbsp;<i class="fa fa-user mt-5" aria-hidden="true"></i></span></td>
                                    <td>Desaparecidos <span class="pull-right">D&nbsp;<i class="fa fa-user mt-5" aria-hidden="true"></i></span></td>
                                    <td>EESS Afectado Operativo <span class="pull-right">O&nbsp;<i class="fa fa-home mt-5" aria-hidden="true"></i></span></td>
                                    <td>EESS Afectado Inoperativo <span class="pull-right">I&nbsp;<i class="fa fa-home mt-5" aria-hidden="true"></i></span></td>
                                </tr>
                               </tbody>
                              </table>

													</div>
													<br />
													<div class="col-xs-12">

														<div class="col-xs-12" id="divMap">
															<div style="width: 100%; height: 900px;" id="map"></div>
														</div>

													</div>
													<div class="clearfix"></div>
													<br />

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php $this->load->view("inc/footer"); ?>
        	<script src="<?=base_url()?>public/js/moment.min.js"></script>
			<script src="<?=base_url()?>public/js/locale.es.js"></script>
			<script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>

		</div>

	</div>


	<div class="modal fade" id="exampleModalCenter" tabindex="-1"
		role="dialog" aria-labelledby="exampleModalCenterTitle"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" id="exampleModalLongTitle">Evento</h5>

				</div>
				<div class="modal-body">
					<p id="texto"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary"
						data-dismiss="modal">Cerrar</button>

				</div>
			</div>
		</div>
	</div>
	<script>
		var URI_MAP = "<?=base_url()?>";
	</script>

	<script src="<?=base_url()?>public/js/eventos/initMapReporte.js"></script>
	<script src="<?=base_url()?>public/js/eventos/reporte.js"></script>
	<script>
		reporte("<?=base_url()?>");
	</script>
	<script
		src="https://maps.googleapis.com/maps/api/js?key=<?=getenv('MAP_KEY')?>&libraries=places&callback=initMap"
		async defer></script>

</body>

</html>
