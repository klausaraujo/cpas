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
	<?php $titulo = "Lista de Planes"; ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="<?=base_url()?>public/css/friaje/main.css?v=<?=date("s")?>" />
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
							<li><a href="<?=base_url()?>friaje"><span>Friaje</span></a></li>
							<li class="active"><span>Lista de Planes</span></li>
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
																<?php if(validarPermisosOpciones(23,$opciones)){ ?>
																<li id="btn-nuevo" class="agregar"><label rel=""><span>Agregar Plan</span><i class="fa fa-file-text-o" aria-hidden="true"></i></label></li>
																<?php } ?>
																<?php if(validarPermisosOpciones(24,$opciones)){ ?>
																<li id="btn-editar" class=""><label rel=""><span>Editar Plan</span><i class="fa fa-check" aria-hidden="true"></i></label></li>
																<?php } ?>
													</ul>
													<div class="clearfix"></div>
													<hr />													
													
                            						<div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
                            							<div class="form-group row ">
                            								<label class="col-sm-4">Año de Ejecución</label>
                            								<div class="col-sm-8">
                                								<select class="form-control" name="Anio">
                                									<option value="">-- Seleccione --</option>
                                									<?php foreach($listaAnioEjecucion->result() as $row): ?>
                                									<?php if($row->Anio_Ejecucion==$anio){ ?><option value="<?=$row->Anio_Ejecucion?>" selected><?=$row->Anio_Ejecucion?></option><?php
                                									}else{ ?><option value="<?=$row->Anio_Ejecucion?>"><?=$row->Anio_Ejecucion?></option><?php } ?>
                                									<?php endforeach; ?>
                                								</select>
                                							</div>
                            							</div>
                            						</div>
													<input type="hidden" id="Anio_Ejecucion" value="<?=$anio?>" />
                                                    <div class="clearfix"></div>
													<hr />					

													<div class="table-responsive">

														<table class="table table-bordered table-hover tbLista">
															<!-- dataTables-example -->
															<thead>
																<tr>
																	<th class="text-center">ID</th>
																	<th>Tipo Plan</th>
																	<th class="text-center">Fecha Inicio</th>
																	<th class="text-center">Fecha Fin</th>
																	<th class="text-center">Avance</th>
																	<th class="text-center">Archivo</th>
																	<th class="text-center">Estado</th>
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
															</thead>
															<tbody>
                                        						<?php
                                                                    $n = 1;
                                                                    if($lista->num_rows()>0){
                                                                        foreach ($lista->result() as $row) :
                                                                 ?>
                                        						<tr>
																	<td class="text-center"><?=$row->id?></td>
																	<td class="text-center"><?=$row->planes_registro_tipo?></td>
																	<td class="text-center"><?=$row->planes_fecha_inicio?></td>
																	<td class="text-center"><?=$row->planes_fecha_fin?></td>
																	<td class="text-center"><?=$row->id?>%</td>
																	<td align="center">
                                                                    	<?php if(strlen($row->Archivo)>0){ ?>
                                                                    		<a href='<?=base_url()."public/friaje/".$row->planes_archivo?>' target="_blank" class="btn btn-default btn-circle">
                                                                    		<i class="fa fa-file-code-o" aria-hidden="true"></i></a>
                                                                    	<?php } ?>
        															</td>
																	<td><?=$row->Activo?></td>
																	<td><?=$row->Activo?></td>
																	<td><?=$row->planes_archivo?></td>
																	<td><?=$row->planes_descripcion?></td>
																	<td><?=$row->id?></td>
																</tr>
                                    							<?php
                                            
                                                                    endforeach;
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

	<div class="modal fade" id="modal-registrar" tabindex="-1" role="dialog" aria-labelledby="estudiosModalLabel" style="margin-top: -15px;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Registrar Plan</h5>
          </div>
          <div class="modal-body text-center">
    
    		<form id="formRegistrar" name="formRegistrar" method="post" action="">
					<input type="hidden" name="id" />
					<div class="modal-body">
						
						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Año de Ejecución</label>
								<div class="col-sm-8">
    								<select class="form-control" name="planes_registro_anio_ejecucion">
    									<?php foreach($listaAnioEjecucion->result() as $row): ?>
    									<?php if($row->Anio_Ejecucion==$anio){ ?><option value="<?=$row->Anio_Ejecucion?>" selected><?=$row->Anio_Ejecucion?></option><?php
    									}else{ ?><option value="<?=$row->Anio_Ejecucion?>"><?=$row->Anio_Ejecucion?></option><?php } ?>
    									<?php endforeach; ?>
    								</select>
								</div>
							</div>
						</div>

						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Tipo de Plan</label>
								<div class="col-sm-8">
    								<select class="form-control" name="planes_registro_tipo">
    									<option value="0">-- Seleccione --</option>
    									<option value="1">De heladas y friaje</option>
    									<option value="2">De lluvias</option>
    								</select>
								</div>
							</div>
						</div>

						<div class="col-xs-12">
        					<div class="form-group row">
        					<label class="col-sm-4">Descripción</label>
        					<div class="col-sm-8">
        						<textarea class="form-control" name="Nombre_Tarea"></textarea>
        					</div>
        					</div>
        				</div>

						<div class="col-xs-12">
            				<div class="form-group row">
    							<label class="col-sm-4">Fecha de Inicio</label>
    							<div class="col-sm-8">
        							<div class="form-group" id="error_planes_fecha_inicio">
        								<div class="input-group date datetimepicker">
        									<input type="text" class="form-control" name="planes_fecha_inicio"> 
        									<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
        								</div>
        							</div>
        						</div>
    						</div>
						</div>

						<div class="col-xs-12">
            				<div class="form-group row">
    							<label class="col-sm-4">Fecha de Fin</label>
    							<div class="col-sm-8">
        							<div class="form-group" id="error_planes_fecha_fin">
        								<div class="input-group date datetimepicker">
        									<input type="text" class="form-control" name="planes_fecha_fin"> 
        									<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
        								</div>
        							</div>
        						</div>
    						</div>
						</div>

    					<div class="col-xs-12">
    						<div class="form-group row">
    							<label class="col-sm-4">Indicador Asignado</label>
    							<div class="col-sm-8">
    								<div class="input-group">
										<input type="hidden" name="IdIndicador" />
    									<input type="text" name="Nombre_Indicador" class="form-control detalle-size" autocomplete="off" readonly />
    									<span class="input-group-btn">
    										<button type="button" class="btn btn-info detalle-size" data-toggle="modal" data-target="#tableIndicadorModal" style="color: white">
    											<i class="fa fa-search" aria-hidden="true"></i>
    										</button>
    									</span>
    								</div>
    							</div>
    						</div>
    					</div>

						<div class="col-xs-12">
							<div class="form-group row">
								<label class="col-sm-4">Cargar Documento</label>
								<div class="col-sm-8">
    								<div class="box">
        								<input type="file" name="file" id="file-plan" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
        								<label for="file-plan"><i class="fa fa-upload" aria-hidden="true"></i> <span>Escoger archivo&hellip;</span></label>
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
	<script src="<?=base_url()?>public/js/friaje/main.js?v=<?=date("s")?>"></script>
	<script>
	main("<?=base_url()?>");
	</script>

</body>

</html>