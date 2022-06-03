<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?=TITULO_PRINCIPAL?></title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="<?=AUTOR?>">

	<?php $this->load->view("inc/resources"); ?>
	<?php $titulo = "Reporte de Mapa de Eventos"; ?>
  <link rel="stylesheet"
	href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet"
	href="<?=base_url()?>public/css/eventos/mapa.css" />

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
							<li><a href="#"><span>Eventos</span></a></li>
							<li class="active"><span>Mapa</span></li>
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



													</div>

													<div class="clearfix"></div>
													<div class="col-xs-12">

													</div>
													<hr />
													<br />
													<div class="clearfix"></div>
													<br />
													<div class="row">
    													<div class="col-xs-12">
    														<div id="divMap">
															<div style="width: 100%; height: 900px;" id="map"></div>
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
					</div>
				</div>
			</div>

			<?php $this->load->view("inc/footer"); ?>
        	<script src="<?=base_url()?>public/js/moment.min.js"></script>
			<script src="<?=base_url()?>public/js/locale.es.js"></script>
			<script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>

		</div>

	</div>


	<div class="modal fade" id="dataMapModal" tabindex="-1"
		role="dialog" aria-labelledby="dataMapModalTitle"
		aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" id="dataMapModalTitle"></h5>
					<input type="hidden" id="departamento" name="departamento" />
				</div>
				<div class="modal-body">

					<div class="col-xs-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-sm-4 col-form-label pt-10">Desde</label>
								<div class="col-sm-8 input-group date" data-target-input="nearest">
									<div class="input-group">

										<div class='input-group date datetimepicker'>
											<input type="text" class="form-control"
												data-date-format="dd/mm/yyyy" required="required"
												id="desde" name="desde" value="<?=date("d/m/Y")?>" />
											<span class="input-group-addon"> <span
												class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-sm-4 col-form-label pt-10">Hasta</label>
								<div class="col-sm-8 input-group date" data-target-input="nearest">
									<div class="input-group">
										<div class='input-group date datetimepicker'>
											<input type="text" class="form-control"
												data-date-format="dd/mm/yyyy" required="required"
												name="hasta" id="hasta" value="<?=date("d/m/Y")?>" />
											<span class="input-group-addon"> <span
												class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>

									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-sm-4 col-form-label pt-10">Tipo Reporte</label>
								<div class="col-sm-8">
									<select id="tipoReporte" class="form-control">
										<option value="0">-- Seleccione --</option>
										<option value="1">General de Eventos</option>
										<option value="2">Poblaci&oacute;n Vulnerable</option>
										<option value="3">EE.SS Afectada</option>
										<option value="4">Recursos Movilizados</option>
										<option value="5">Diagnosticos frecuentes</option>
										<option value="6">Reporte Estad&iacute;stico de Afectados</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<button id="btnObtenerReporte" class="btn btn-primary">Obtener Reporte</button>
						</div>
					</div>


					<div class="clearfix"></div>
							<br />
							<div id="preload" class="col-xs-12 text-center"></div>
							<div class="col-xs-12 text-center font-24 mensaje"><p></p></div>
							<div class="col-sm-8 col-sm-offset-2 col-xs-12">
								<table id="tbEventos"
									class="table table-striped table-bordered table-sm"
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Tipo Evento</th>
											<th>Evento</th>
											<th>Cantidad Total</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<table id="tbVulnerable"
									class="table table-striped table-bordered table-sm"
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Mujeres</th>
											<th>Gestantes</th>
											<th>Ni&ntilde;os</th>
											<th>Adulto Mayor</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<table id="tbEESS"
									class="table table-striped table-bordered table-sm"
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Afectadas Operativas</th>
											<th>Afectadas Inoperativas</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<table id="tbRecursos"
									class="table table-striped table-bordered table-sm"
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Brigadistas</th>
											<th>EME</th>
											<th>Personal Salud</th>
											<th>Ambulancias</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<table id="tbCIE10"
									class="table table-striped table-bordered table-sm"
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>CIE10</th>
											<th>Descripci&oacute;n</th>
											<th>Cantidad</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table><table id="tbRegion"
									class="table table-striped table-bordered table-sm"
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>ALTA</th>
											<th>HOSPITALIZADO</th>
											<th>REFERIDO</th>
											<th>FALLECIDO</th>
											<th>DESAPARECIDO</th>
											<th>EN OBSERVACI&Oacute;N</th>
											<th>PARA EVACUACI&Oacute;N</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="clearfix"></div>
							<br />



				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary"
						data-dismiss="modal">Cerrar</button>

				</div>
			</div>
		</div>
	</div>
	<script>

</script>

	<script src="https://maps.googleapis.com/maps/api/js?key=<?=getenv('MAP_KEY')?>&libraries=drawing"></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_01.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_02.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_03.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_04.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_05.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_06.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_07.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_08.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_09.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_10.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_11.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_12.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_13.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_14.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_15.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_16.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_17.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_18.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_19.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_20.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_21.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_22.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_23.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_24.js'></script>
    <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_25.js'></script>
    <script type="text/javascript" src="<?=base_url()?>public/map/djperu_ind.js"></script>

	<script src="<?=base_url()?>public/js/eventos/dataTableMapa.js"></script>
	<script src="<?=base_url()?>public/js/eventos/initMapMapa.js"></script>
	<script src="<?=base_url()?>public/js/eventos/mapa.js"></script>
	<script>

		mapa("<?=base_url()?>");

	</script>

</body>

</html>
