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
<?php $titulo = "Consolidado IPRESS"; ?>
<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/reporte.css" />

</head>

<body>

	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
	<input type="hidden" id="activar" value="0">
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
							<li class="active"><span>Consolidado IPRESS</span></li>
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
													
													<div class="col-xs-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="">Regi&oacute;n</label> 
																<select class="form-control form-control-sm" name="departamento" required="required" id="departamento">
																	<option value="0">-- TODOS --</option>
                                                    				  <?php foreach($departamentos as $row): ?>
                                                    					  <option value="<?=$row->Codigo_Departamento?>"><?=$row->Nombre?></option>
                                                    				  <?php endforeach; ?>
                                                    			</select>
															</div>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="">Provincia</label> 
																<select class="form-control form-control-sm" name="provincia" id="provincia">
																	<option value="0">-- TODOS --</option>
																</select>
															</div>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="0">Distrito</label>
																<select class="form-control form-control-sm" name="distrito" id="distrito">
																	<option value="0">-- TODOS --</option>
                                                    			</select>
															</div>
														</div>
														
														<div class="col-xs-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="">Nivel</label>
																<select class="form-control form-control-sm" name="nivelEmergencia" id="nivelEmergencia">
																	<option value="0">-- TODOS --</option>
                                                        			<?php foreach($nivel as $row): ?>
                                                        				  <option value="<?=$row->Evento_Nivel_Codigo?>"><?=$row->Evento_Nivel_Nombre?></option>
                                                        			  <?php endforeach; ?>
                                                        			</select>
															</div>
														</div>

													</div>

													<div class="form-group">
													
													<div class="col-xs-12 col-sm-6 col-md-2">
															<div class="form-group">
																<label class="">Tipo de evento</label> 
																<select class="form-control form-control-sm" name="tipoEvento" required="required" id="tipoEvento">
																	<option value="0">-- TODOS --</option>
                                                    				  <?php foreach($tipo as $row): ?>
                                                    					  <option value="<?=$row->Evento_Tipo_Codigo?>"><?=$row->Evento_Tipo_Nombre?></option>
                                                    				  <?php endforeach; ?>
                                                    			</select>
															</div>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-4">
															<div class="form-group">
																<label class="">Evento</label>
																<select class="form-control form-control-sm" name="evento" id="evento">
																	<option value="0">-- TODOS --</option>
																</select>
															</div>
														</div>

														<div class="col-xs-12 col-sm-6 col-md-4">
															<div class="form-group">
																<label class="">Detalle Evento</label>
																<select class="form-control form-control-sm" name="detalle" id="detalle">
																	<option value="0">-- TODOS --</option>
																</select>
															</div>
														</div>													
														<div class="col-xl-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="">Consolidado de Evento</label>
																<select class="form-control form-control-sm" name="eventoConsolidado" id="eventoConsolidado">
																<option value="99">--TODOS--</option>
																<option value="0">Ninguna Espec&iacute;fica</option>
																<option value="1">Temporada de Lluvias</option>
																<option value="2">Temporada de Bajas Temperaturas</option>
																<option value="3">Sismos por Niveles de Intensidad</option>
																<option value="4">Accidentes de Tr&aacute;nsito</option>
																<option value="5">Incendios Forestales</option>
																<option value="6">Indendios Urbanos o Industriales</option>
																<option value="7">Conflictos Sociales</option>
																</select>
															</div>
														</div>	
														<div class="col-xs-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="">Desde</label>
    															<div class='input-group date datetimepicker'>
    																<input type="text" class="form-control"
    																	data-date-format="dd/mm/yyyy" required="required"
    																	id="desde" name="desde" value="<?=date("d/m/Y")?>" /> 
    																	<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
    																</span>
    															</div>
    														</div>
														</div>
														<div class="col-xs-12 col-sm-6 col-md-3">
															<div class="form-group">
																<label class="">Hasta</label>
    															<div class='input-group date datetimepicker'>
    																<input type="text" class="form-control"
    																	data-date-format="dd/mm/yyyy" required="required"
    																	name="hasta" id="hasta" value="<?=date("d/m/Y")?>" /> 
    																	<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
    																</span>
    															</div>
    														</div>
														</div>													
													</div>

													<div class="clearfix"></div>
													<hr />
													<br />
													<div class="col-xs-12">
														<button id="btnObtenerReporte" class="btn btn-primary">Obtener Reporte</button>
													</div>

													<div class="clearfix"></div>
													<br />

													<div class="col-xs-12">
														<div class="table-responsive">
															<table class="table tbLista table-striped table-bordered table-sm" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th>INSTITUCION</th>
																		<th>ESTADO</th>
																		<th>SIREED</th>
																		<th>RENIPRESS</th>
																		<th>CATEGORIA</th>
																		<th>NOMBRE</th>
																		<th>REGION</th>
																		<th>PROVINCIA</th>
																		<th>DISTRITO</th>
																		<th>UBIGEO</th>
																		<th>DESCRIPCION</th>
																		<th>TIPO DE EVENTO</th>
																		<th>FECHA Y HORA</th>
																		<th>RECUPERACIÓN OPERACIÓN</th>
																		<th>FECHA DE INFORME</th>
																		<th>CONTINGENCIA</th>
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
                    <h5 class="modal-title">Seleccione</h5>
                  </div>
                  <div class="modal-body text-center">
            
            				<div class="btn-group">
            			    <a id="aInformeInicial" href="" target="_blank" class="btn btn-primary mr-5">Informe Inicial</a>
            			    <a id="aInformeFinal" href="" target="_blank" class="btn btn-primary">Informe Final</a>
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
	<script src="<?=base_url()?>public/js/eventos/reporteConsolidadoIPRESS.js"></script>
	<script>
		reporteConsolidadoIPRESS("<?=base_url()?>");
	</script>

</body>

</html>
