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
	<?php $titulo = "Grandes Eventos"; ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/grandes-eventos.css?v=<?=date("s")?>" />
	<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
	<?php $opciones = $this->session->userdata("Permisos_Opcion"); ?>	

</head>

<body>

	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">

	<?php $this->load->view("inc/navsireed"); ?>

        <!-- Main Content -->
		<div class="page-wrapper" style="min-height: 710px;">
			<div class="container pt-30">

				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark"><?=$titulo?></h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="<?=base_url()?>">Inicio</a></li>
							<li><a href="<?=base_url()?>eventos/eventos/lista"><span>Eventos</span></a></li>
							<li class="active"><span>Registro General de Grandes Eventos</span></li>
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
                                                <input type="hidden"
														id="Tipo_Accion" />
													<ul class="botones-evento">
																<li id="" class="agregar"><label rel=""><span>Registrar Gran Evento</span><i class="fa fa-file-text-o" aria-hidden="true"></i></label></li>
																<li id="btn-editar" class=""><label rel=""><span>Editar Gran Evento</span><i class="fa fa-check" aria-hidden="true"></i></label></li>
																<li id="btn-anular" class=""><label rel=""><span>Anular Gran Evento</span><i class="fa fa-trash" aria-hidden="true"></i></label></li>
																<li id="btn-cerrar" class=""><label rel=""><span>Cerrar Gran Evento</span><i class="fa fa-times" aria-hidden="true"></i></label></li>
																<li id="btn-exportar" class=""><a id="aInformeInicial" href="javascript:;" target="_blank"><label rel=""><span>Generar Informe</span><i class="fa fa-file-pdf-o" aria-hidden="true"></i></label></a></li>
													</ul>
                                                    <div class="clearfix"></div>
                                                    <hr />
													<div class="row">
														<div class="col-xs-12">
														
														<div class="form-group row">
                                    						<label class="col-sm-12 col-form-label">Periodo</label>
                                    						<div class="col-sm-3">
                                    							<select class="form-control" name="anio" id="anio">
								  								  <?php foreach($listaAnioEjecucion->result() as $row): ?>
                                								  <option value="<?=$row->Anio_Ejecucion?>"><?=$row->Anio_Ejecucion?></option>
                                								  <?php endforeach; ?>
								  								</select>
                                    						</div>
                                    
                                    					</div>
														
														</div>
													</div>

													<div class="table-responsive">

														<table class="table table-bordered table-hover tbLista">
															<!-- dataTables-example -->
															<thead>
																<tr>
																	<th class="text-center">T&iacute;tulo General</th>
																	<th class="text-center">N&uacute;mero</th>
																	<th class="text-center">Fecha</th>
																	<th class="text-center">Descripci&oacute;n General</th>
																	<th class="text-center">Ver Mapa</th>
																	<th class="text-center">&nbsp;</th>	
																	<th class="text-center">&nbsp;</th>
																	<th class="text-center">&nbsp;</th>
																	<th class="text-center">&nbsp;</th>												
																</tr>
															</thead>
															<tbody>
																<?php if ($listar->num_rows() > 0){
																        foreach($listar->result() as $row):
																?>
																<tr>
																	<td class="text-center"><?=$row->Super_Evento_Registro_Titulo?></td>
																	<td class="text-center"><?=$row->Super_Evento_Registro_Nombre?></td>
																	<td class="text-center"><?=$row->Super_Evento_Registro_Fecha_Registro?></td>
																	<td class="text-center"><?=(strlen($row->Super_Evento_Registro_Descripcion) > 50 ) ? substr($row->Super_Evento_Registro_Descripcion, 0, 50).'...':$row->Super_Evento_Registro_Descripcion?></td>
																	<td class="text-center"><i class="fa fa-globe actionMap" rel="<?=$row->id?>"></i></td>
																	<td class="text-center">
																	<?php
                                                                        $html = '';
                                                                        switch ($row->estado) {
                                                                            case 1:
                                                                                $html = '<span class="label label-success">Monitoreo</span>';
                                                                                break;
                                                                            case 2:
                                                                                $html = '<span class="label label-default">Cerrado</span>';
                                                                                break;
                                                                            case 3:
                                                                                $html = '<span class="label label-danger">Anulado</span>';
                                                                                break;
                                                                        }
                                                                        echo $html;
                                                                ?></td>
																	<td><?=$row->id?></td>
																	<td><?=encriptarInforme($row->id,"ASC")?></td>
																	<td><?=encriptarInforme($row->id,"DESC")?></td>
																	
																</tr>
																<?php
    																    endforeach;
    																} 
    															?>
															</tbody>
															<tbody>
                              								</tbody>
														</table>

													</div>
													<!-- table -->

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

<div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="registroModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="registroModalLabel">Registro de Grandes Eventos</h5>
      </div>
      <div class="modal-body">

		<form id="formRegistrar" name="formRegistrar" method="post" action="" autocomplete="off">
				<input type="hidden" name="id" />
				<div class="modal-body">
					<div class="row">
					
						<div class="col-xs-12 col-sm-6">						
						
							<div class="row">							
							
            					<div class="col-xs-12">
            						<div class="form-group">
            							<label class="">T&iacute;tulo General</label>
            							<input type="text" class="form-control input-sm" name="Super_Evento_Registro_Titulo">
            						</div>
            					</div>
							
							</div>
							
							<div class="row">
							
    							<div class="col-xs-12 col-sm-6">
        							<div class="form-group">
        								<label class="">Fecha Evento</label>
        								<div class='input-group date'>
        									<input type="text" class="form-control input-sm" required="required" name="fecha" value="<?=date("d/m/Y")?>" data-date-format="DD/MM/YYYY" /> 
        										<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
        									</span>
        								</div>
        							</div>
        						</div>
        						<div class="col-xs-12 col-sm-6">
        							<div class="form-group">
        								<label class="">Hora Evento</label>
        								<div class='input-group'>
        									<input type="text" class="form-control dateHour input-sm" required="required" name="hora" value="<?=date("H:i")?>" /> 
        										<span class="input-group-addon"> <i class="fa fa-clock-o" aria-hidden="true"></i>
        									</span>
        								</div>
        							</div>
        						</div>
							
							</div>

							<div class="row">							
							
            					<div class="col-xs-12">
            						<div class="form-group">
            							<label class="">Nombre del Gran Evento</label>
            							<input type="text" class="form-control input-sm" name="Super_Evento_Registro_Nombre">
            						</div>
            					</div>
							
							</div>

							<div class="row">							
							
            					<div class="col-xs-12">
            						<div class="form-group">
            							<label class="">Descripci&oacute;n General</label>
            							<textarea name="Super_Evento_Registro_Descripcion" class="form-control"></textarea>
            						</div>
            					</div>
							
							</div>
							<div class="row mb-10">
								<div class="col-xs-12">								
									<button class="btn btn-success" type="button" data-toggle="modal" data-target="#buscarEventosModal">Agregar Evento</button>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-12 table-max-height-overflow">
								
									<table id="tbEventosSeleccionados" class="table">
										<thead>
											<tr>
												<th>N&uacute;mero</th>
												<th>Tipo Evento</th>
												<th>Evento</th>
												<th>Ubigeo</th>
												<th>&nbsp;</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
								
								</div>
							</div>		
						
						</div>

						<div class="col-xs-12 col-sm-6">

							<div class="row">

    							<div class="col-xs-12 map-content">
                					<div id="map" style="height: 600px;"></div>
                				</div>

							</div>

						</div>

					</div>

				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
					<button class="btn btn-primary" id="btnAgregar" type="submit">Guardar</button>
				</div>
			</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="buscarEventosModal" tabindex="-1" role="dialog" aria-labelledby="buscarEventosModalLabel" aria-hidden="true" style="margin-top: -15px;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Buscar Eventos</h5>
      </div>
      	<div class="modal-body">
      	
      		<div class="row">
	  			<form name="formBuscarEventos" id="formBuscarEventos" method="post">

    				<div class="col-xs-12">
    													
    					<div class="col-xs-12 col-sm-6 col-md-3">
    						<div class="form-group">
    							<label class="">Regi&oacute;n</label> 
    							<select class="form-control form-control-sm" name="departamento" required="required" id="departamento">
    								<option value="">-- Seleccione --</option>
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
    								<option value="">-- Seleccione --</option>
    							</select>
    						</div>
    					</div>
    					<div class="col-xs-12 col-sm-6 col-md-3">
    						<div class="form-group">
    							<label class="0">Distrito</label>
    							<select class="form-control form-control-sm" name="distrito" id="distrito">
    								<option value="">-- Seleccione --</option>
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
    
    				<div class="col-xs-12">
    					
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
    						
    						
    						<div class="col-xs-12 col-sm-6 col-md-3">
    							<div class="form-group">
    								<label class="">Desde</label>
    								<div class='input-group date'>
    									<input type="text" class="form-control"
    										data-date-format="DD/MM/YYYY" required="required"
    										id="desde" name="desde" value="<?=date("d/m/Y")?>" /> 
    										<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
    									</span>
    								</div>
    							</div>
    						</div>
    						<div class="col-xs-12 col-sm-6 col-md-3">
    							<div class="form-group">
    								<label class="">Hasta</label>
    								<div class='input-group date'>
    									<input type="text" class="form-control"
    										data-date-format="DD/MM/YYYY" required="required"
    										name="hasta" id="hasta" value="<?=date("d/m/Y")?>" /> 
    										<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
    									</span>
    								</div>
    							</div>
    						</div>
    						
    				</div>
					<div class="col-xs-12">
						<button type="submit" class="btn btn-success">Buscar</button>
					</div>
            				
            		</form>
    		</div>
    				
			<div class="row">
				<div class="col-xs-12 table-max-height-overflow">
    				<div class="table-responsive">
    
    					<table id="tbLista" class="table table-bordered table-hover" style="width: 100%">
    						<!-- dataTables-example -->
    						<thead>
    							<tr>
    								<th class="text-center">Numero</th>
                                    <th class="text-center">TipoEvento</th>
                                    <th class="text-center">Evento</th>
                                    <th class="text-center">Ubigeo</th>
                                    <th class="text-center">Coordenadas</th>
                                    <th class="text-center">&nbsp;</th>
                                    <th>&nbsp;</th>
    							</tr>
    						</thead>
    						<tbody>
    						</tbody>
    					</table>
    				</div>
				</div>
				
			</div>

		</div>
		<div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
		</div>
      </div>
    </div>
  </div>
    
    <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="condicionModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Mapa del Super Evento</h5>
          </div>
          <div class="modal-body">
            <div id="mapSuperEvento" style="height: 500px;"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    
    <input id="Tipo_Accion" type="hidden" />
	
	<script src="https://maps.googleapis.com/maps/api/js?key=<?=getenv('MAP_KEY')?>&libraries=drawing"></script>
    
    <script>
		var URI_MAP = "<?=base_url()?>";
		var registros = [];
		var marcadores = [];		

	</script>
	<script src="<?=base_url()?>public/js/moment.min.js"></script>
	<script src="<?=base_url()?>public/js/locale.es.js"></script>
	<script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?=base_url()?>/public/js/eventos/initMapGrandesEventos.js?v=<?=date("s")?>"></script>

	<script src="<?=base_url()?>public/js/eventos/grandes-eventos.js?v=<?=date("s")?>"></script>
	
	<script>
    grandesEventos("<?=base_url()?>");
	</script>

</body>

</html>