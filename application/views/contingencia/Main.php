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
	<?php $titulo = "Planes de Contingencia"; ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="<?=base_url()?>public/css/friaje/main.css?v=<?=date("s")?>" />
	<?php $opciones = $this->session->userdata("Permisos_Opcion"); ?>
</head>
<body>
	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
	<?php $this->load->view("inc/nav"); ?>
		<div class="page-wrapper" style="min-height: 710px;">
			<div class="container pt-30">

				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark"><?=$titulo?></h5>
					</div>
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="<?=base_url()?>">Inicio</a></li>
							<li><a href="<?=base_url()?>contingencia"><span>Contingencia</span></a></li>
							<li class="active"><span>Planes de Contingencia</span></li>
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
																<?php if(validarPermisosOpciones(46,$opciones)){ ?>
																<li id="btn-nuevo" class="agregar"><label rel=""><span>Registrar Nuevo Plan</span><i class="fa fa-file-text-o" aria-hidden="true"></i></label></li>
																<?php } ?>
																<?php if(validarPermisosOpciones(47,$opciones)){ ?>
																<li id="btn-editar" class="editarplan"><label rel=""><span>Editar Plan Seleccionado</span><i class="fa fa-check" aria-hidden="true"></i></label></li>
																<?php } ?>
													</ul>
													<div class="clearfix"></div>
													<hr />													
                                                    <div class="clearfix"></div>
													<hr />					
													<div class="table-responsive">
														<table class="table table-bordered table-hover tbLista">
															<thead>
																<tr>
																	<th class="text-center">ID</th>
																	<th>Titulo del Plan</th>
																	<th>Nro. Resolución</th>
																	<th class="text-center">Presupuesto</th>
																	<th class="text-center">Archivo (Plan)</th>
																	<th class="text-center">Tipo de peligro</th>
																	<th class="text-center">Institución</th>
																	<th class="text-center">Región</th>
																	<th class="text-center">Estado</th>
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
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
																	<th>Calificación</th>
																	<th>&nbsp;</th>
															</thead>
															<tbody>
                                        						<?php
                                                                    $n = 1;
                                                                    if($listarPlanesContingencia->num_rows()>0){
                                                                        foreach ($listarPlanesContingencia->result() as $row) :
                                                                 ?>
                                        						<tr>
																	<td class="text-center"><?=$row->id?></td>
																	<td class="text-center"><?=$row->titulo?></td>
																	<td class="text-center"><?=$row->resolplan?></td>
																	<td class="text-center"><?=$row->presupuesto?></td>
																	<td align="center">
																	<?php if(strlen($row->plan_file)>0){ ?>
                                                                    		<a href='<?=base_url()."public/planes/planes/".$row->plan_file?>' target="_blank">
                                                                    		<i class="fa fa-file-code-o" aria-hidden="true"></i></a>
                                                                    	<?php } ?>
        															</td>																	
																	<!--<td class="text-center"><?=$row->plan_file?></td>-->
																	<td class="text-center"><?=$row->origen?></td>
																	<!--
																	<td><?=$row->vigencia_inicio?></td>
																	<td><?=$row->vigencia_fin?></td>
																	-->
																	<td><?=$row->institucion?></td>
																	<td><?=$row->region?></td>
																	<td><?=$row->estado?></td>
																	<td><?=$row->resolucion_file?></td>
																	<td><?=$row->calificacion?></td>
																	<td><?=$row->origen1?></td>
																	<td><?=$row->contingencias_peligros_detalle_id_natural?></td>
																	<td><?=$row->contingencias_peligros_detalle_items_id_natural?></td>
																	<td><?=$row->contingencias_peligros_detalle_id_antropico?></td>
																	<td><?=$row->contingencias_peligros_detalle_items_id_antropico?></td>
																	<td><?=$row->vigencia_inicio?></td>
																	<td><?=$row->vigencia_fin?></td>
																	<td><?=$row->codigo_institucion?></td>
																	<td><?=$row->codigo_region?></td>
																	<td><?=$row->codigo_disa?></td>
																	<td><?=$row->codigo_red?></td>
																	<td><?=$row->codigo_micro_red?></td>
																	<td><?=$row->codigo_renipress?></td>
																	<td><?=$row->fecha_publicacion?></td>
																	<td>
                                								    <?php if($row->calificacion<=0){ ?>
																	<button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button" class="reporte">
                                								      <i class="fa fa-pencil-square-o"></i>
                                								    </button>
																	<?php }  
																	else { ?>
																	  Calificación: <?=$row->calificacion?> </br>
																	  Reporte: <a href='<?=base_url()."contingencia/reportes/informecontingencia/".$row->id?>' id="aInformeInicial" class="aInformeInicial" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
																	<?php } ?>
                                								  </td>	
																  <td><?=$row->idevento?></td>																
																</tr>
                                    							<?php
                                                                    endforeach;
                                                                }
                                                                ?>
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

			<?php $this->load->view("inc/footer"); ?>
		</div>
	</div>

	<div class="modal fade" id="modal-registrar" tabindex="-1" role="dialog" aria-labelledby="estudiosModalLabel" style="margin-top: -15px;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Registro de Planes de Contingencia</h5>
          </div>
          <div class="modal-body text-left">
    		<form id="formRegistrar" name="formRegistrar" method="post" action="<?=base_url()?>contingencia/registrar" enctype="multipart/form-data">
					<input type="hidden" name="id" />
					<div class="modal-body">
						
					<div class="col-xs-12 col-sm-10 col-sm-offset-1">
						<div class="col-xs-12">
        					<div class="form-group row">
        					<label class="col-sm-4">Título del Plan</label>
        					<div class="col-sm-8">
							<input type="text" class="form-control" name="titulo" value="" style="font-size: 12px; text-transform:uppercase;">
        					</div>
        					</div>
        				</div>
						<div class="col-xs-12">
        					<div class="form-group row">
        					<label class="col-sm-4">Resolución del Plan</label>
        					<div class="col-sm-8">
							<input type="text" class="form-control" name="resolplan" value="" style="font-size: 12px; text-transform:uppercase;">
        					</div>
        					</div>
        				</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Resolución</label>
								<div class="col-sm-8">
    								<div class="box">
        								<input type="file" name="file" id="resolucion-file" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
        								<label for="resolucion-file"><i class="fa fa-upload" aria-hidden="true"></i> <span>Escoger archivo&hellip;</span></label>
    								</div>
    							</div>
							</div>
						</div>
						<div class="col-xs-12">
            				<div class="form-group row">
    							<label class="col-sm-4">Fecha de Publicación</label>
    							<div class="col-sm-8">
        							<div class="form-group">
									<div class='input-group date datetimepicker'>
										<input type="text" class="form-control input" required="required" name="fecha_publicacion" id="fecha_publicacion"/> 
											<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
        							</div>
        						</div>
    						</div>
						</div>
						<div class="col-xs-12">
        					<div class="form-group row">
        					<label class="col-sm-4">Presupuesto</label>
        					<div class="col-sm-8">
							<input type="text" class="form-control" name="presupuesto" value="" style="font-size: 12px; text-transform:uppercase;">
        					</div>
        					</div>
        				</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Archivo Plan</label>
								<div class="col-sm-8">
    								<div class="box">
        								<input type="file" name="filep" id="plan_file" class="inputfile1 inputfile-1" data-multiple-caption="{count} files selected" multiple />
        								<label for="plan_file"><i class="fa fa-upload" aria-hidden="true"></i> <span>Escoger archivo&hellip;</span></label>
    								</div>
    							</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Tipo de peligro</label>
								<div class="col-sm-8">
    								<div class="box">
        								<div class="form-group">
                                            <label class=""><input type="radio" name="tipoAtencion" value="1"> Natural</label>									
											<label class=""><input type="radio" name="tipoAtencion" value="2"> Antrópico</label>
										</div>
										<div class="form-group">                                            
											<div class="col-xs-12" id="showPre" style="display: none">
                                    			<div class="form-group">
                                            		<select class="form-control" name="contingencias_peligros_detalle_id_natural">
													<option value="0">-- Seleccione --</option>
                                            		</select> 
													<br/>
                                            		<select class="form-control" name="contingencias_peligros_detalle_items_id_natural">
													<option value="0">-- Seleccione --</option>
                                            		</select> 													
                                            	</div>
                                			</div>  
											<div class="col-xs-12" id="showPMA" style="display: none">
                                    			<div class="form-group">
                                            		<select class="form-control" name="contingencias_peligros_detalle_id_antropico">
                                            			<option value="0">-- Seleccione --</option>
                                            		</select>
													<br/>
													<select class="form-control" name="contingencias_peligros_detalle_items_id_antropico">
                                            			<option value="0">-- Seleccione --</option>
                                            		</select> 
                                            	</div>
                                			</div>											                                      
										</div>				
    								</div>
    							</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Tipo de Evento</label>
								<div class="col-sm-8">
    								<select class="form-control" name="idevento">
    									<option value="0">-- Seleccione --</option>
                    					<?php foreach ($listarTipevento->result() as $row): ?>
                    					<option value="<?=$row->idevento?>">
                    					  <?=$row->descripcion?>
                    					</option>
                    					<?php endforeach;?>
    								</select>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Institución</label>
								<div class="col-sm-8">
    								<select class="form-control" name="codigo_institucion">
    									<option value="0">-- Seleccione --</option>
                    					<?php foreach ($listarInstitucion->result() as $row): ?>
                    					<option value="<?=$row->codigo_institucion?>">
                    					  <?=$row->nombre_institucion?>
                    					</option>
                    					<?php endforeach;?>
    								</select>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Región</label>
								<div class="col-sm-8">
    								<select class="form-control" name="codigo_region">
    									<option value="0">-- Seleccione --</option>
                    					<?php foreach ($listarRegion->result() as $row): ?>
                    					<option value="<?=$row->codigo_region?>">
                    					  <?=$row->nombre_region?>
                    					</option>
                    					<?php endforeach;?>
    								</select>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">DISA/DIRESA</label>
								<div class="col-sm-8">
    								<select class="form-control" name="codigo_disa">
    									<option value="0">-- Seleccione --</option>
    								</select>
								</div>
							</div>
						</div>												
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Red</label>
								<div class="col-sm-8">
    								<select class="form-control" name="codigo_red">
    									<option value="0">-- Seleccione --</option>
    								</select>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Micro Red</label>
								<div class="col-sm-8">
    								<select class="form-control" name="codigo_micro_red">
    									<option value="0">-- Seleccione --</option>
    								</select>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">IPRESS</label>
								<div class="col-sm-8">
    								<select class="form-control" name="codigo_renipress">
    									<option value="0">-- Seleccione --</option>
    								</select>
								</div>
							</div>
						</div>	
					</div>																		
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
						<button class="btn btn-primary" type="submit">Agregar</button>
						<div class="col-md-12 text-center cargando"></div>
					</div>
					<p id="duplicate_especialidad" class="text-danger text-center hide">No se pudo registrar, ya existe</p>
				</form>
          </div>
        </div>
      </div>
    </div>
	<div class="modal fade" id="modal-actualizar" tabindex="-1" role="dialog" aria-labelledby="estudiosModalLabel" style="margin-top: -15px;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Actualizar Plan de Contingencia</h5>
          </div>
          <div class="modal-body text-left">
    		<form id="formActualizar" name="formActualizar" method="post" action="<?=base_url()?>contingencia/actualizar" enctype="multipart/form-data">
					<input type="hidden" name="id" />
					<div class="modal-body">
					<div class="col-xs-12 col-sm-10 col-sm-offset-1">
						<div class="col-xs-12">
        					<div class="form-group row">
        					<label class="col-sm-4">Título del Plan</label>
        					<div class="col-sm-8">
							<input type="text" class="form-control" name="titulo" value="" style="font-size: 12px; text-transform:uppercase;">
        					</div>
        					</div>
        				</div>
						<div class="col-xs-12">
        					<div class="form-group row">
        					<label class="col-sm-4">Resolución del Plan</label>
        					<div class="col-sm-8">
							<input type="text" class="form-control" name="resolplan" value="" style="font-size: 12px; text-transform:uppercase;">
        					</div>
        					</div>
        				</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label id="editFiler" class="col-sm-4">Resolución</label>
								<div class="col-sm-8">
    								<div class="box">
        								<input type="file" name="file" id="resolucion-file" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
        								<label for="resolucion-file"><i class="fa fa-upload" aria-hidden="true"></i> <span>Escoger archivo&hellip;</span></label>
    								</div>
    							</div>
							</div>
						</div>
						<div class="col-xs-12">
            				<div class="form-group row">
    							<label class="col-sm-4">Fecha de Aprobación</label>
    							<div class="col-sm-8">
        							<div class="form-group">
									<div class='input-group date datetimepicker'>
										<input type="text" class="form-control input" required="required" name="fecha_publicacion" id="fecha_publicacion"/> 
											<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
        							</div>
        						</div>
    						</div>
						</div>
						<div class="col-xs-12">
        					<div class="form-group row">
        					<label class="col-sm-4">Presupuesto</label>
        					<div class="col-sm-8">
							<input type="text" class="form-control" name="presupuesto" value="" style="font-size: 12px; text-transform:uppercase;">
        					</div>
        					</div>
        				</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label id="editFilep" class="col-sm-4">Archivo Plan</label>
								<div class="col-sm-8">
    								<div class="box">
        								<input type="file" name="filep" id="plan_file" class="inputfile1 inputfile-1" data-multiple-caption="{count} files selected" multiple />
        								<label for="plan_file"><i class="fa fa-upload" aria-hidden="true"></i> <span>Escoger archivo&hellip;</span></label>
    								</div>
    							</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Tipo de Peligro</label>
								<div class="col-sm-8">
    								<div class="box">
        								<div class="form-group">
                                            <label class=""><input type="radio" name="tipoAtencionU" value="1"> Natural</label>									
											<label class=""><input type="radio" name="tipoAtencionU" value="2"> Antrópico</label>
										</div>
										<div class="form-group">                                            
											<div class="col-xs-12" id="showPreU" style="display: none">
                                    			<div class="form-group">
                                            		<select class="form-control" name="contingencias_peligros_detalle_id_natural">
                                            		</select> 
													<br/>
                                            		<select class="form-control" name="contingencias_peligros_detalle_items_id_natural">
                                            		</select> 													
                                            	</div>
                                			</div>  
											<div class="col-xs-12" id="showPMAU" style="display: none">
                                    			<div class="form-group">
                                            		<select class="form-control" name="contingencias_peligros_detalle_id_antropico">
                                            		</select>
													<br/>
													<select class="form-control" name="contingencias_peligros_detalle_items_id_antropico">
                                            		</select> 
                                            	</div>
                                			</div>											                                      
										</div>				
    								</div>
    							</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Tipo de Evento</label>
								<div class="col-sm-8">
    								<select class="form-control" name="idevento">
                    					<?php foreach ($listarTipevento->result() as $row): ?>
                    					<option value="<?=$row->idevento?>">
                    					  <?=$row->descripcion?>
                    					</option>
                    					<?php endforeach;?>
    								</select>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Institución</label>
								<div class="col-sm-8">
    								<select class="form-control" name="codigo_institucion">
                    					<?php foreach ($listarInstitucion->result() as $row): ?>
                    					<option value="<?=$row->codigo_institucion?>">
                    					  <?=$row->nombre_institucion?>
                    					</option>
                    					<?php endforeach;?>
    								</select>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Región</label>
								<div class="col-sm-8">
    								<select class="form-control" name="codigo_region">
                    					<?php foreach ($listarRegion->result() as $row): ?>
                    					<option value="<?=$row->codigo_region?>">
                    					  <?=$row->nombre_region?>
                    					</option>
                    					<?php endforeach;?>
    								</select>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">DISA/DIRESA</label>
								<div class="col-sm-8">
    								<select class="form-control" name="codigo_disa">
    								</select>
								</div>
							</div>
						</div>												
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Red</label>
								<div class="col-sm-8">
    								<select class="form-control" name="codigo_red">
    								</select>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Micro Red</label>
								<div class="col-sm-8">
    								<select class="form-control" name="codigo_micro_red">
    								</select>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">IPRESS</label>
								<div class="col-sm-8">
    								<select class="form-control" name="codigo_renipress">
    								</select>
								</div>
							</div>
						</div>	
					</div>																		
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
						<button class="btn btn-primary" type="submit">Agregar</button>
						<div class="col-md-12 text-center cargando"></div>
					</div>
					<p id="duplicate_especialidad" class="text-danger text-center hide">No se pudo registrar, ya existe</p>
				</form>
          </div>
        </div>
      </div>
    </div>
	<script>
	function validateForm() {
	for (i = 1; i < 36; i++) { 
		var x = document.forms["formRegistrarCuestionario"]["codigo_pregunta_"+i].value;
	  if (x == "") {
	    alert("Debe responder todas las Preguntas!");
	    return false;
	  }
	}
	}
	</script>
	<div class="modal fade" id="modal-cuestionario" tabindex="-1" role="dialog" aria-labelledby="estudiosModalLabel" style="margin-top: -15px;">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Evaluación del Plan de Contingencia</h5>
          </div>
          <div class="modal-body text-left">
    		<form id="formRegistrarCuestionario" name="formRegistrarCuestionario" method="post" onsubmit="return validateForm()" action="<?=base_url()?>contingencia/registrarcuestionario">
					<input type="hidden" name="id" />
					<input type="hidden" name="idregistroplan" />
					<div class="modal-body">
					<div class="col-xs-12 col-sm-11 col-sm-offset-1">
						<div class="col-xs-12">
        					<div class="form-group row">
        					<label class="col-sm-4">Título del Plan</label>
        					<div class="col-sm-8">
							<input type="text" class="form-control" name="titulo" value="" style="font-size: 12px; text-transform:uppercase;" readonly>
        					</div>
        					</div>
        				</div>
						<div class="col-xs-12">
        					<div class="form-group row">
        					<label class="col-sm-4">Institución</label>
        					<div class="col-sm-8">
							<input type="text" class="form-control" name="institucion" value="" style="font-size: 12px; text-transform:uppercase;" readonly>
        					</div>
        					</div>
        				</div>
						<div class="col-xs-12">
        					<div class="form-group row">
        					<label class="col-sm-4">Región</label>
        					<div class="col-sm-8">
							<input type="text" class="form-control" name="region" value="" style="font-size: 12px; text-transform:uppercase;" readonly>
        					</div>
        					</div>
        				</div>
						<?php foreach ($listarCuestionario->result() as $row):  ?>							
							<div class="col-xs-12">
								<div class="form-group row">
									<label class="col-sm-10"><?=$row->contingencias_estructura_cuestionario_id?>.- <?=$row->contingencias_estructura_cuestionario_descripcion?></label>
									<div class="col-sm-2">
										<select class="form-control" name="codigo_pregunta_<?=$row->contingencias_estructura_cuestionario_id?>" id="codigo_pregunta_<?=$row->contingencias_estructura_cuestionario_id?>" >
											<option value="">SELECCIONE</option>
											<option value="0">NO</option>
											<option value="1">SI</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-xs-12">
        					<div class="form-group row">
        					<label class="col-sm-1">Comentario: </label>
        					<div class="col-sm-12">
							<input type="text" class="form-control" name="comentario_pregunta_<?=$row->contingencias_estructura_cuestionario_id?>" value="" style="font-size: 10px; text-transform:uppercase;" >
        					</div>
        					</div>
        				</div>
							<input type="hidden" value="<?=$row->contingencias_estructura_cuestionario_valoracion?>" name="valoracion_pregunta_<?=$row->contingencias_estructura_cuestionario_id?>" />
							<?php endforeach; ?>
					</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
						<button class="btn btn-primary" type="submit">Guardar</button>
						<div class="col-md-12 text-center cargando"></div>
					</div>
					<p id="duplicate_especialidad" class="text-danger text-center hide">No se pudo registrar, ya existe</p>
				</form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="deleteEspecialidadModal" tabindex="-1" role="dialog" aria-labelledby="deleteEspecialidadModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?=base_url()?>brigadistas/eliminarEspecialidad">
              <div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Eliminar Especialidad</h5>
              </div>
              <div class="modal-body">
              	<input type="hidden" name="id" />
              	<p>&iquest;Seguro desea eliminar especialidad?</p>
              </div>
              <div class="modal-footer">
              	<button type="submit" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="tableIndicadorModal" tabindex="-1" role="dialog" aria-labelledby="tableIndicadorModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" id="registrarTableroModalLabel">Seleccionar Indicador</h5>
				</div>
				<div class="modal-body">
					<table class="tbIndicador table table-striped table-bordered table-sm" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>ID</th>
								<th>Indicador</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
    <script src="<?=base_url()?>public/js/moment.min.js"></script>
	<script src="<?=base_url()?>public/js/locale.es.js"></script>
	<script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?=base_url()?>public/js/contingencia/main.js?v=<?=date("s")?>"></script>
	<script>
	main("<?=base_url()?>");
	</script>
</body>
</html>