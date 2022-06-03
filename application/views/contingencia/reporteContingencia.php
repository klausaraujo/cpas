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
<?php $titulo = "Reporte Contingencia"?>
<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/reporte.css" />
</head>
<body>
	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
	<input type="hidden" id="activar" value="0">
	<?php $this->load->view("inc/navsireed"); ?>
		<div class="page-wrapper" style="min-height: 710px;">
			<div class="container pt-30">
				<div class="row heading-bg">
					<div class="col-lg-8 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark"><?=$titulo?></h5>
					</div>
					<div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="<?=base_url()?>">Inicio</a></li>
							<li><a href="<?=base_url()?>eventos/eventos/lista"><span>Contingencia</span></a></li>
							<li class="active"><span>Reporte Contingencia</span></li>
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
											<div class="sm-data-box pa-10">
												<div class="container-fluid">
													<div class="form-group">
													<label class="">Origen del Plan</label>
        												<div class="form-group">
                                        				    <label class=""><input type="radio" name="tipoAtencion" id="tipoAtencion" value="1"> Natural</label>									
															<label class=""><input type="radio" name="tipoAtencion" id="tipoAtencion" value="2"> Antrópico</label>
														</div>
														<div class="col-xs-12" id="showPre" style="display: none">
                                    						<div class="form-group">
                                            					<select class="form-control" name="contingencias_peligros_detalle_id_natural" id="contingencias_peligros_detalle_id_natural">
																<option value="0">-- Seleccione --</option>
                                            					</select> 
																<br/>
                                            					<select class="form-control" name="contingencias_peligros_detalle_items_id_natural" id="contingencias_peligros_detalle_items_id_natural">
																<option value="0">-- Seleccione --</option>
                                            					</select> 													
                                            				</div>
                                						</div>  
														<div class="col-xs-12" id="showPMA" style="display: none">
                                    						<div class="form-group">
                                            					<select class="form-control" name="contingencias_peligros_detalle_id_antropico" id="contingencias_peligros_detalle_id_antropico">
                                            						<option value="0">-- Seleccione --</option>
                                            					</select>
																<br/>
																<select class="form-control" name="contingencias_peligros_detalle_items_id_antropico" id="contingencias_peligros_detalle_items_id_antropico">
                                            						<option value="0">-- Seleccione --</option>
                                            					</select> 
                                            				</div>
                                						</div>															
													</div>
													<div class="form-group">
													<div class="col-xs-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="">Institución</label> 
 																<select class="form-control" name="codigo_institucion" id="codigo_institucion">
    																<option value="0">-- Seleccione --</option>
                    												<?php foreach ($listarInstitucion as $row): ?>
                    													<option value="<?=$row->codigo_institucion?>"><?=$row->nombre_institucion?>
                    												</option>
                    												<?php endforeach;?>
    															</select>
															</div>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="">Regi&oacute;n</label> 
																<select class="form-control form-control-sm" name="codigo_region" required="required" id="codigo_region">
																	<option value="0">-- Seleccione --</option>
                                                    				  <?php foreach($listarRegion as $row): ?>
                                                    					  <option value="<?=$row->codigo_region?>"><?=$row->nombre_region?></option>
                                                    				  <?php endforeach; ?>
                                                    			</select>
															</div>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="">DISA/DIRESA</label>
																<select class="form-control form-control-sm" name="codigo_disa" id="codigo_disa">
																<option value="0">-- Seleccione --</option>
																</select>
															</div>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="0">Red</label>
																<select class="form-control form-control-sm" name="codigo_red" id="codigo_red">
																	<option value="0">-- Seleccione --</option>
                                                    			</select>
															</div>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="0">Micro Red</label>
																<select class="form-control form-control-sm" name="codigo_micro_red" id="codigo_micro_red">
																	<option value="0">-- Seleccione --</option>
                                                    			</select>
															</div>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="0">IPRESS</label>
																<select class="form-control form-control-sm" name="codigo_renipress" id="codigo_renipress">
																	<option value="0">-- Seleccione --</option>
                                                    			</select>
															</div>
														</div>			
													</div>
													<div class="clearfix"></div>
													<hr />
													<br />
													<div class="col-xs-12">
														<button id="btnObtenerReporte" class="btn btn-primary">Filtrar</button>
													</div>
													<div class="clearfix"></div>
													<br />
													<div class="col-xs-12">
														<div class="table-responsive">
															<table class="table tbLista table-striped table-bordered table-sm" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th>ID</th>
																		<th>TÍTULO</th>
																		<th>PRESUPUESTO</th>
																		<th>ARCHIVO <p> (R) &nbsp; (P)</th>
																		<th>ORIGEN DEL PLAN</th>
																		<th>INICIO VIGENCIA</th>
																		<th>FIN VIGENCIA</th>
																		<th>INSTITUCIÓN</th>
																		<th>REGIÓN</th>
																		<th>ESTADO</th>
																		<th>CALIFICACIÓN</th>
																		<th>&nbsp;</th>
																		<th>&nbsp;</th>
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
															</tbody>
														</table>
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
			<div class="modal fade" id="informeModal" tabindex="-1" role="dialog" aria-labelledby="condicionModalLabel" style="margin-top: -15px;">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title">Seleccione el Archivo a Descargar</h5>
                  </div>
                  <div class="modal-body text-center">
            				<div class="btn-group">
            			    <a id="aInformeInicial" href="" target="_blank" class="btn btn-primary mr-5">Archivo Plan</a>
            			    <a id="aInformeFinal" href="" target="_blank" class="btn btn-primary">Archivo Resolución</a>
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
	<script src="<?=base_url()?>public/js/contingencia/reporteContingencia.js"></script>
	<script>
		reporteContingencia("<?=base_url()?>");
	</script>
</body>
</html>