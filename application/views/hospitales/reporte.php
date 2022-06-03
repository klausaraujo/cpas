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
	<?php $titulo = "Lista de fichas de evaluación de situación de los servicios de Emergencia"; ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="<?=base_url()?>public/css/hospitales/main.css" type="text/css"/>
	<?php $opciones = $this->session->userdata("Permisos_Opcion"); ?>
</head>

<body>

	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">

	<?php $this->load->view("inc/nav"); ?>

        <!-- Main Content -->
		<div class="page-wrapper" style="min-height: 710px;">
		<div class="container data__container pt-30">
				<div class="row heading-bg">
					<div class="col-md-8 col-sm-6 col-xs-12">
						<h5 class="txt-dark"><?=$titulo?></h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-md-4 col-sm-6 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="<?=base_url()?>">Inicio</a></li>
							<li><a href="<?=base_url()?>hospitales"><span>Fichas</span></a></li>
							<li class="active"><span>Lista de Hospitales</span></li>
						</ol>
					</div>

				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-xs-12">
								<div class="panel panel-default card-view pa-0">
									<div class="panel-wrapper collapse in">
										<div class="panel-body pa-0">
											<div class="sm-data-box pt-20">
												<div class="container-fluid">
												<?php $message = $this->session->flashdata('messageOK'); ?>
                                                <?php if($message){ ?>
                                                    <div
														class="alert alert-success">
														<p><?= $message ?></p>
													</div>
                                                <?php } ?>

                                                <?php $message = $this->session->flashdata('messageError'); ?>
                                                <?php if($message){ ?>
                                                    <div
														class="alert alert-danger">
														<p><?= $message ?></p>
													</div>
                                                <?php } ?>
                                                <?php $idrol = $this->session->userdata("idrol"); ?>
                                                	<input type="hidden" id="Tipo_Accion" />
													<div class="botones-evento">
														
													</div>
													<form id="formTable">
														<div class="row">
															<!-- <div class="form-group col-sm-3">
																<label class="col-sm-12 pl-0">FECHA REGISTRO</label>
																<div class='input-group date' id="datetimepicker">
																	<input type="text" class="form-control" name="fechaRegistro" id="fechaRegistro" />
																	<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
																</div>
															</div> -->
															<div class='col-sm-3'>
																<div class="form-group">
																	<label class="col-sm-12 pl-0">FECHA REGISTRO</label>
																	<div class='input-group date' id='fechaRegistro'>
																		<input type='text' class="form-control" name="fechaRegistro"/>
																		<span class="input-group-addon">
																			<span class="glyphicon glyphicon-calendar"></span>
																		</span>
																	</div>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="checkbox checkbox-primary">
																	<br>
																	<input id="reporteLima" type="radio" name="reporte" value="0" checked>
																	<label for="reporteLima">
																		Reportes Lima
																	</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="checkbox checkbox-primary">
																	<br>
																	<input id="reporteRegio" type="radio" name="reporte" value="1">
																	<label for="reporteRegio">
																		Reportes Región
																	</label>
																</div>
															</div>
															<div class="col-sm-3">
																<br>
																<button type="submit" class="btn btn-primary col-sm-12" id="btn-buscar">Buscar</button>
															</div>
														</div>
													</form>
													<div class="clearfix"></div>
													
													<div class="table-responsive">
														<table id="tableReporte" class="table tableReporte table-bordered table-hover" style="width: 100%">
														</table>

													</div>
													<!-- table -->
													<div class="reporte__canvas" hidden>
														<h4 class="mt-0 header-title">Casos Reportados por fecha</h4>
														<div id="morris-bar-example" style="height: 450px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
															<div id="container" style="height: 400px;"></div>  
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
		</div>
	</div>
	
    <script src="<?=base_url()?>public/js/moment.min.js"></script>
	<script src="<?=base_url()?>public/js/locale.es.js"></script>
	<script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?=base_url()?>public/js/hospitales/main.js"></script>
	<script>
	main("<?=base_url()?>");
	</script>

</body>

</html>