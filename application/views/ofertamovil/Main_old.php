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
	<link rel="stylesheet" href="<?=base_url()?>public/css/ofertamovil/main.css?v=<?=date("s")?>" />
	<?php $opciones = $this->session->userdata("Permisos_Opcion"); ?>
</head>

<?php
    $months = array(
        array("id"=>1,"name"=>"Enero"),
        array("id"=>2,"name"=>"Febrero"),
        array("id"=>3,"name"=>"Marzo"),
        array("id"=>4,"name"=>"Abril"),
        array("id"=>5,"name"=>"Mayo"),
        array("id"=>6,"name"=>"Junio"),
        array("id"=>7,"name"=>"Julio"),
        array("id"=>8,"name"=>"Agosto"),
        array("id"=>9,"name"=>"Septiembre"),
        array("id"=>10,"name"=>"Octubre"),
        array("id"=>11,"name"=>"Noviembre"),
        array("id"=>12,"name"=>"Diciembre")
    );
?>

<body>

	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
	
	<?php $this->load->view("inc/nav"); ?>
		
        <!-- Main Content -->
		<div class="page-wrapper" style="min-height: 710px;">
			<div class="container pt-30">
				<div class="row heading-bg">
					<div class="col-md-8 col-xs-12">
						<h5 class="txt-dark"></h5>
					</div>					
				</div>
				<!-- Row -->
				<div class="row">
				
				<div class="col-xs-12">
				
					<div class="row flex flex-middle">
					
						<div class="col-sm-5">
							<label class="full-width txt-dark">Opciones</label>
							<div class="" style="display: inline-block;">							
                				<ul class="botones-evento opacity-8">    													
                    				<?php //if(validarPermisosOpciones(13,$opciones)){ ?>

										<?php if(validarPermisosOpciones(33,$opciones)){ ?>
											<li data-toggle="modal" data-target="#eventosBuscarModal" class="oferta-movil agregar bg-white"><label rel=""><span>Enlazar Evento</span><i class="fa fa-file-text-o" aria-hidden="true"></i></label></li>
										<?php } ?>

										<?php if(validarPermisosOpciones(34,$opciones)){ ?>
											<li id="nuevo" class="oferta-movil editar bg-white"><label rel=""><span>Ficha de Atenci&oacute;n</span><i class="fa fa-file-text-o" aria-hidden="true"></i></label></li>
										<?php } ?>

										<?php if(validarPermisosOpciones(35,$opciones)){ ?>
											<li class="oferta-movil exportar bg-white" id="consolidado"><label rel=""><span>Reportes COE</span><i class="fa fa-file-text-o" aria-hidden="true"></i></label></li>
										<?php } ?>
      				
                    				<?php //} ?>
                				</ul>
            				</div>	
						</div>
						<div class="col-sm-7 d-flex flex-middle flex-direction-column text-left">
							<label class="full-width txt-dark">Seleccione Evento</label>
							<select class="form-control" id="combo">
								<?php 
								    foreach($lista->result() as $row):
								?>
									<option value="<?=$row->Evento_Registro_Numero?>" <?=($row->prioridad)?'selected':''?>><?=$row->descripcion?></option>
								<?php 
								    endforeach;
								?>
							</select>
						</div>
					
					</div>
				<br />
				</div>
				<?php
				$total = 1;
    				if ($datosDashBoard->total > 0) {
    				    $total = $datosDashBoard->total;
    				}
				?>	
				<div class="row">										
					<div class="col-sm-4 col-xs-12 opacity-8">
						<div class="panel panel-default card-view pa-0 bg-success txt-light">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 data-wrap-left">
													<span class="capitalize-font block">Total</span>
													<span class="txt-light block"><span class="counter inline-block"><span class="counter-anim" id="t_total"><?=$datosDashBoard->total?></span></span><span class="trand-icon inline-block txt-success"><i class="fa fa-chevron-up"></i></span></span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right font-50">
													<i class="fa fa-users" aria-hidden="true"></i>
												</div>
											</div>
											<div class="progress-anim">
												<div class="progress">
													<div id="p_total" class="progress-bar wow animated progress-animated bg-success dark" role="progressbar" aria-valuenow="<?=ceil(($datosDashBoard->total/$total)*100)?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-4 col-xs-12 opacity-8">
						<div class="panel panel-default card-view pa-0 bg-blue txt-light">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 data-wrap-left">
													<span class="capitalize-font block">Hombres</span>
													<span class="txt-light block"><span class="counter inline-block"><span class="counter-anim" id="t_hombres"><?=$datosDashBoard->hombres?></span></span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right font-50">
													<i class="fa fa-mars" aria-hidden="true"></i>
												</div>
											</div>
											<div class="progress-anim">
												<div class="progress">
													<div id="p_hombres" class="progress-bar bg-blue dark wow animated progress-animated" role="progressbar" aria-valuenow="<?=ceil(($datosDashBoard->hombres/$total)*100)?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-4 col-xs-12 opacity-8">
						<div class="panel panel-default card-view pa-0 bg-pink txt-light">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 data-wrap-left">
													<span class="capitalize-font block">Mujeres</span>
													<span class="txt-light block"><span class="counter inline-block"><span class="counter-anim" id="t_mujeres"><?=$datosDashBoard->mujeres?></span></span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right font-50">
													<i class="fa fa-venus" aria-hidden="true"></i>
												</div>
											</div>
											<div class="progress-anim">
												<div class="progress">
													<div id="p_mujeres" class="progress-bar bg-pink dark wow animated progress-animated" role="progressbar" aria-valuenow="<?=ceil(($datosDashBoard->mujeres/$total)*100)?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					<!-- ------------------------------------------------------------ -->
					<div class="row">
					<div class="col-sm-4 col-xs-12 opacity-8">
						<div class="panel panel-default card-view pa-0 bg-red txt-light">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 data-wrap-left">
													<span class="capitalize-font block">Gestantes</span>
													<span class="txt-light block"><span class="counter inline-block"><span class="counter-anim" id="t_gestantes"><?=$datosDashBoard->gestantes?></span></span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right font-50">
													<i class="fa fa-heartbeat" aria-hidden="true"></i>
												</div>
											</div>
											<div class="progress-anim">
												<div class="progress">
													<div id="p_gestantes" class="progress-bar bg-red dark wow animated progress-animated" role="progressbar" aria-valuenow="<?=ceil(($datosDashBoard->gestantes/$total)*100)?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-4 col-xs-12 opacity-8">
						<div class="panel panel-default card-view pa-0 bg-orange txt-light">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 data-wrap-left">
													<span class="capitalize-font block">Adulto mayor</span>
													<span class="txt-light block"><span class="counter inline-block"><span class="counter-anim" id="t_adulto_mayor"><?=$datosDashBoard->adulto_mayor?></span></span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right font-50">
													<i class="fa fa-blind" aria-hidden="true"></i>
												</div>
											</div>
											<div class="progress-anim">
												<div class="progress">
													<div id="p_adulto_mayor" class="progress-bar bg-orange dark wow animated progress-animated" role="progressbar" aria-valuenow="<?=ceil(($datosDashBoard->adulto_mayor/$total)*100)?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-4 col-xs-12 opacity-8">
						<div class="panel panel-default card-view pa-0 bg-purple txt-light">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 data-wrap-left">
													<span class="capitalize-font block">Menor de edad</span>
													<span class="txt-light block"><span class="counter inline-block"><span class="counter-anim" id="t_menor_edad"><?=$datosDashBoard->menor_edad?></span></span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right font-50">
													<i class="fa fa-child" aria-hidden="true"></i>
												</div>
											</div>
											<div class="progress-anim">
												<div class="progress">
													<div id="p_menor_edad" class="progress-bar bg-purple dark wow animated progress-animated" role="progressbar" aria-valuenow="<?=ceil(($datosDashBoard->menor_edad/$total)*100)?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					<br />
					<div class="row">
						<div class="col-xs-12 mb-3" id="line" style="opacity: 0;height: 1px;">
							<div class="card-view opacity-8 pb-10">
								<canvas id="lineChart"></canvas>
							</div>
						</div>
    					<div class="col-xs-12 col-sm-6" id="bar" style="opacity: 0;height: 1px;">
    						<div class="card-view opacity-8 pb-10">
    							<canvas id="myChart"></canvas>
    						</div>
    					</div>
    					<div class="col-xs-12 col-sm-6" id="pie" style="opacity: 0;height: 1px;">
    						<div class="card-view opacity-8 pb-10">
    							<canvas id="chart_pie"></canvas>
    						</div>
    					</div>
    					<div class="col-xs-12" id="polar" style="opacity: 0;height: 1px;">
    						<div class="card-view opacity-8 pb-10">
    							<canvas id="polarChart"></canvas>
    						</div>
    					</div>
					</div>
				
			</div>

		</div>
			<!-- /container -->

    <div class="modal fade" id="eventosBuscarModal" tabindex="-1" role="dialog" aria-labelledby="eventosBuscarModalLabel" style="margin-top: -15px;">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Buscar Evento</h5>
          </div>
    	<form id="formBuscarEvento" name="formBuscarEvento" method="post" action="">
          <div class="modal-body over-hidden">
    		<div class="col-xs-12 col-sm-4">
					<input type="hidden" name="id" />
					<input type="hidden" name="Registro_Evento_Numero" />
						<div class="row"><h5>Eventos SIREED</h5></div>
						<div class="row">
    						<div class="col-xs-12 mb-10">
    							<div class="form-group">
    								<label class="col-xs-4 pa-10">C&oacute;digo</label>
    								<div class="col-xs-8">
        								<input type="text" class="form-control" name="correlativo" disabled />
        							</div>
    							</div>
    						</div>
    						<div class="col-xs-12">
    							<div class="form-group">
    								<label class="col-xs-4 pa-10">Fecha</label>
    								<div class="col-xs-8">
        								<input type="text" class="form-control" name="fecha" disabled />
        							</div>
    							</div>
    						</div>

    						<div class="col-xs-12 text-right">
    							<div class="form-group pa-10">
    								<button type="button" id="btnBuscar" class="btn btn-default">Buscar</button>
    							</div>
    						</div>						
    						
							<div class="row" id="datos" style="display: none;">
        						
        						<div class="col-xs-12">
        							<div class="form-group text-left">
        								<label class="col-xs-4"><strong>Tipo Evento</strong></label>
        								<div class="col-xs-8">
            								<label id="tipo"></label>
            							</div>
        							</div>
        						</div>
        						
        						<div class="col-xs-12">
        							<div class="form-group text-left">
        								<label class="col-xs-4"><strong>Evento</strong></label>
        								<div class="col-xs-8">
            								<label id="evento"></label>
            							</div>
        							</div>
        						</div>
    
        						<div class="col-xs-12">
        							<div class="form-group text-left">
        								<label class="col-xs-4"><strong>Detalle</strong></label>
        								<div class="col-xs-8">
            								<label id="detalle"></label>
            							</div>
        							</div>
        						</div>
        						
        						<div class="col-xs-12">
        							<div class="form-group text-left">
        								<label class="col-xs-4"><strong>Descripci&oacute;n</strong></label>
        								<div class="col-xs-8">
            								<label id="descripcion"></label>
            							</div>
        							</div>
        						</div>
    						</div>
    					</div>    					
						<hr />
						<div class="row"><h5>Registro de Actividad</h5></div>
    					<div class="row">
    					<div class="clearfix"></div>						
						<div class="col-xs-12">
							<div class="form-group">
								<label class="col-xs-12">Descripci&oacute;n</label>
								<div class="col-xs-12">
    								<input type="text" class="form-control" name="descripcion" />
    							</div>
    							<div class="clearfix"></div>
							</div>
						</div>
						</div>
				</div>
				<div class="col-xs-12 col-sm-8">				

					<table class="tableAtencion table table-striped table-bordered table-sm" width="100%">
						<thead>
							<tr>								
								<th class="text-center">N&deg;</th>
								<th>Evento Producido</th>
								<th>Fecha</th>
								<th>Ubicaci&oacute;n Evento(UBIGEO)</th>
								<th>Descripci&oacute;n</th>
								<th>Estado</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>

							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				
				</div>
          </div>
			<div class="modal-footer text-left">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
				<button class="btn btn-primary" type="submit" id="btnEvento" disabled>Gestionar</button>
				<div class="col-md-12 text-center cargando"></div>
			</div>
			<p id="duplicate_evento" class="text-danger text-center hide">No se pudo registrar, ya existe</p>
		</form>
        </div>
      </div>
    </div>
    
        <!-- MODAL BUSQUEDA -->
	<div class="modal fade" id="eventosModal" tabindex="-1" role="dialog" aria-labelledby="eventosModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document"
			style="padding-top: 10px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" id="eventosModalLabel">Seleccionar El evento</h5>

				</div>
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Filtros</label>
						<div class="col-sm-3">
							<select class="form-control" name="Anio_Ejecucion" id="Anio_Ejecucion">
								  <?php foreach($listaAnioEjecucion->result() as $row): ?>
								  <option value="<?=$row->Anio_Ejecucion?>" <?=($row->Anio_Ejecucion==date("Y"))?"selected":""?>><?=$row->Anio_Ejecucion?></option>
								  <?php endforeach; ?>
								</select>
						</div>
						<div class="col-sm-3">
							<select class="form-control" name="mes" id="mes">
							  <?php foreach($months as $row): ?>
							  <option value="<?=$row["id"]?>" <?=($row["id"]==date("m"))?"selected":""?>><?=$row["name"]?></option>
							  <?php endforeach; ?>
							</select>
						</div>

					</div>
					<table class="tableEventos table table-striped table-bordered table-sm" width="100%">
						<thead>
							<tr>								
								<th class="text-center">N&deg;</th>
								<th>Evento Producido</th>
								<th>Fecha</th>
								<th>Ubicaci&oacute;n Evento(UBIGEO)</th>
								<th>Estado</th>
								<th>&nbsp;</th>
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

    <div class="modal fade" id="deleteAtencionModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form id="formEliminar" method="post" action="">
              <div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Eliminar Atenci&oacute;n</h5>
              </div>
              <div class="modal-body">
              	<input type="hidden" name="id" />
              	<p>&iquest;Seguro desea eliminar la atenci&oacute;n <span id="eventoCodigo"></span>?</p>
              </div>
              <div class="modal-footer">
              	<button type="submit" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
	<!-- Footer -->
	<?php $this->load->view("inc/footer"); ?>
    <!-- /Footer -->

		</div>
		<!-- /Main content -->

	</div>
	<!-- /#wrapper -->
	<script src="<?=base_url()?>public/js/ofertamovil/main_old.js?v=<?=date("s")?>"></script>
	<script>

		var labelCie = '<?=json_encode($labelCie)?>';
		var dataCie = '<?=json_encode($dataCie)?>';
		var labelPie = '<?=json_encode($labelPie)?>';
		var dataPie = '<?=json_encode($dataPie)?>';
		
		var ofertaMovilLines = '<?=json_encode($ofertaMovilLines)?>';
		var fechaLines = '<?=json_encode($fechaLines)?>';
		var cantidadLines = '<?=json_encode($cantidadLines)?>';
		
		var labelPolar = '<?=json_encode($labelPolar)?>';
		var dataPolar = '<?=json_encode($dataPolar)?>';
	
		main('<?=base_url()?>', labelCie, dataCie, labelPie, dataPie, ofertaMovilLines, fechaLines, cantidadLines, labelPolar, dataPolar);
	</script>

</body>

</html>