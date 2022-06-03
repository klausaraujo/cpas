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
	<?php $titulo = "Lista de Emergencias"; ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/emergencias/main.css?v=<?=date("s")?>" />
	<?php $opciones = $this->session->userdata("Permisos_Opcion"); ?>

</head>

<body>

	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">

	<?php $this->load->view("inc/nav"); ?>

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
							<li><a href="<?=base_url()?>emergencias"><span>Emergencias</span></a></li>
							<li class="active"><span>Lista de Emergencias</span></li>
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

													<div id="message" class="col-xs-12 pt-10"></div>
													<div class="clearfix"></div>
                                                	<?php $idrol = $this->session->userdata("idrol"); ?>
													<ul class="botones-evento">
																<?php if(validarPermisosOpciones(36,$opciones)){ ?>
																<li id="btn-nuevo" class="agregar" data-toggle="modal" data-target="#registroModal"><label rel="">
																	<span>Agregar Emergencia</span><i class="fa fa-file-text-o" aria-hidden="true"></i></label></li>
																<?php } ?>
																<?php if(validarPermisosOpciones(37,$opciones)){ ?>
																<li id="btn-editar" class="editar disabled">
																	<label rel=""><span>Editar Emergencia</span><i class="fa fa-check" aria-hidden="true"></i></label>
																</li>
																<?php } ?>
																<?php if(validarPermisosOpciones(38,$opciones)){ ?>
																<li id="btn-paciente" class="atencion disabled">
																	<label rel=""><span>Gestionar Pacientes</span><i class="fa fa-check" aria-hidden="true"></i></label>
																</li>
																<?php } ?>
																<?php if(validarPermisosOpciones(39,$opciones)){ ?>
																<li id="btn-cerrar" class="cerrar disabled">
																	<label rel=""><span>Cerrar Emergencia</span><i class="fa fa-times" aria-hidden="true"></i></label>
																</li>
																<?php } ?>
													</ul>
                                                    <div class="clearfix"></div>

													<div class="table-responsive">

														<table class="table table-bordered table-hover tbLista">
															<!-- dataTables-example -->
															<thead>
																<tr>
																	<th>Emergencia</th>
																	<th>N&deg; Resolucion</th>
																	<th>descripcion</th>
																	<th>Fecha Registro</th>
																	<th>DGOS</th>
																	<th>DIGERD</th>
																	<th>CDC</th>
																	<th>DIGESA</th>
																	<th>&nbsp;</th>
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
																<?php 
																if ($lista->num_rows() > 0) {

																foreach($lista->result() as $row): ?>
																<tr>
																	<td align="center"><?=$row->titulo?></td>
																	<td align="center"><?=$row->resolucion?></td>
																	<td><?=$row->descripcion?></td>
																	<td align="center"><?=$row->fecha_registro?></td>
																	<td align="center"><?=($row->dgos=="1")?"S&iacute;":"No"?></td>
																	<td align="center"><?=($row->digerd=="1")?"S&iacute;":"No"?></td>
																	<td align="center"><?=($row->cdc=="1")?"S&iacute;":"No"?></td>
																	<td align="center"><?=($row->digesa=="1")?"S&iacute;":"No"?></td>
																	<td align="center">
																	<?php if(strlen($row->archivo)>0){ ?>
                                                            		<a href='<?=base_url()."public/emergencias/".$row->archivo?>' target="_blank" class="btn btn-default btn-circle">
                                                                		<i class="fa fa-file-code-o" aria-hidden="true"></i></a>
                                                                	<?php } ?>
                                                                	</td>
																	<td>
																	<?php																	
    																	$html = '';
    																	$status = '';
    																	switch ($row->estado) {
    																	    case 1:
    																	        $html = '<span class="label label-success">Activo</span>';
    																	        $status = 'Activo';
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
    																	echo $html;
																	?></td>
																	<td><?=$row->id?></td>
																	<td><?=$row->region_nombres?></td>
																	<td><?=$row->dgos?></td>
																	<td><?=$row->digerd?></td>
																	<td><?=$row->cdc?></td>
																	<td><?=$row->digesa?></td>
																	<td><?=$row->descripcion?></td>
																	<td><?=$row->estado?></td>
																</tr>
																<?php endforeach;
                                                                      }
                                                                ?>
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
	
	<div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="registroModalLabel" style="margin-top: -15px;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Emergencia Sanitaria</h5>
          </div>
          <div class="modal-body text-center">
    
    		<form id="formRegistrar" name="formRegistrar" method="post" action="" autocomplete="off" enctype="multipart/form-data">
					<input type="hidden" name="id" />
					<div class="modal-body">

						<div class="col-xs-12">
							<div class="form-group">
								<label class="">T&iacute;tulo</label>
								<input type="text" class="form-control" name="titulo">
							</div>
						</div>

						<div class="col-xs-12">
							<div class="form-group">
								<label class="">N&deg; Resoluci&oacute;n</label>
								<input type="text" class="form-control" name="resolucion">
							</div>
						</div>
						
						<div class="col-xs-12">
							<div class="form-group">
								<label class="">Cargar Documento</label>
								<div class="box">
								<input type="file" name="file" id="file" accept=".pdf" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
								<label for="file"><i class="fa fa-upload" aria-hidden="true"></i> <span>Escoger archivo&hellip;</span></label></div>
							</div>
						</div>

						<div class="col-xs-12 map-content">
							<div id="map"></div>
							<div id="listMap"></div>
							<div class="col-xs-12" id="error_mapa">
								<input type="text" id="mapa" name="mapa">
							</div>
						</div>

						<div class="col-xs-12">
							<div class="form-group">
								<label class="">Motivo de la Emergencia</label>
								<textarea class="form-control" name="descripcion"></textarea>
							</div>
						</div>
						
						<div class="col-xs-12">
    						<div class="form-group">
    							<div class="row">
        							<div class="col-12"><label>Direcciones Involucradas</label></div> 
        							<div class="col-sm-offset-1 col-sm-4">
        								<div class="">
        									<label><input type="checkbox" name="dgos" value="1"> DGOS</label>
        								</div>
        							</div>
        							 
        							<div class="col-sm-offset-2 col-sm-4">
        								<div class="">
        									<label><input type="checkbox" name="digerd" value="1"> DIGERD</label>
        								</div>
        							</div>
        							 
        							<div class="col-sm-offset-1 col-sm-4">
        								<div class="">
        									<label><input type="checkbox" name="cdc" value="1">CDC</label>
        								</div>
        							</div>
        							 
        							<div class="col-sm-offset-2 col-sm-4">
        								<div class="">
        									<label><input type="checkbox" name="digesa" value="1"> DIGESA</label>
        								</div>
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
    <script>
    	var polydj = [];
    	var selected = [];
    	var searching = [];
    </script>
	<script src="<?=base_url()?>public/js/emergencias/initMap.js"></script>
	<script src="<?=base_url()?>public/js/moment.min.js"></script>
	<script src="<?=base_url()?>public/js/locale.es.js"></script>
	<script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?=base_url()?>public/js/emergencias/main.js?v=<?=date("s")?>"></script>
    <script>
    main("<?=base_url()?>");
	</script>

</body>

</html>