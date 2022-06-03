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
  
   <link rel="stylesheet"
	href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css">
  
  <?php $titulo = "Registro Da&ntilde;os a Personas e IPRESS Afectadas"; ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/danios.css?v=<?=date("his")?>">

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
							<li class="active"><span>Da&ntilde;os</span></li>
						</ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-xs-12">
								<div class="panel panel-default card-view pa-0">
									<div class="panel-wrapper collapse in">
										<div class="panel-body pa-10">
											<div class="sm-data-box">
												<div class="container-fluid">


													<div id="message" class="col-xs-12"></div>  											
												
<?php
$dateTime = explode(" ", $danios->fecha);
?>
<div class="clearfix"></div>  
<div class="table-responsive">
	<table id="tabla" class="table table-striped table-bordered table-response" style="margin: auto; margin-top: 25px;">
		<thead>
			<tr>
				<th class="text-center" >N&uacute;mero</th>
				<th>Lugar(Ubigeo)</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Tipo de Evento</th>
				<th>Evento</th>
				<th>Detalle del Evento</th>															
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?=$danios->ANIO." - ".addCeros5($danios->Evento_Secuencia)?></td>
				<td><?=$danios->distrito." ,".$danios->provincia." ,".$danios->departamento?></td>
				<td><?=$dateTime[0]?></td>
				<td><?=$dateTime[1]?></td>
				<td><?=$danios->Evento_Tipo_Nombre?></td>
				<td><?=$danios->Evento_Nombre?></td>
				<td><?=$danios->Evento_Detalle_Nombre?></td>
			</tr>
		</tbody>
	</table>
</div>
													<ul class="enlaces-otros">
														<li><a href="javascript:;" class="enlaceLesionados" rel="lesionados">Registrar Lesionados y Fallecidos</a><span><i class="fa fa-user"></i></span></li>
														<li><a href="javascript:;" class="enlaceEntidades" rel="entidadSalud">Registrar IPRESS Afectadas</a><span><i class="fa fa-hospital-o"></i></span></li>
														<li><a href="javascript:;" class="enlaceAcciones" rel="acciones">Registrar Acciones Realizadas</a><span><i class="fa fa-share-square"></i></span></li>
														<li><a href="javascript:;" class="enlaceFotos" rel="imagenes">Galería de Fotos</a><span><i class="fa fa-file-photo-o addPhotos"></i></span></li>
														<li class="addAsignacion"><a href="javascript:;">Gesti&oacute;n de Requerimientos</a><span class="requerimientos"><i class="fa fa-list-alt addAsignacion"></i></span></li>
														<li class="oferta-movil-aside"><a href="javascript:;">Registro de Oferta M&oacute;vil<label rel="<?=$Evento_Registro_Numero?>"></label></a><span class="oferta-movil"><i class="fa fa-ambulance"></i></span></li>
														<li><a href="javascript:;" class="enlaceFiles" rel="fileseventos">Repositorio de Archivos por Evento</a><span><i class="fa fa-file-o addFiles"></i></span></li>
														<li><a href="<?=base_url()?>eventos/eventos/informe/<?=encriptarInforme($Evento_Registro_Numero, "ASC")?>" target="_blank">Descargar Informe Inicial</a><span class="informe-inicial"><i class="fa fa-file-pdf-o"></i></span></li>
														<li><a href="<?=base_url()?>eventos/eventos/informe/<?=encriptarInforme($Evento_Registro_Numero, "DESC")?>" target="_blank">Descargar Informe Final</a><span class="informe-final"><i class="fa fa-file-pdf-o"></i></span></li>
													</ul>
													<div class="clearfix"></div>
													<br />
   <?php if($historial->num_rows()<1){ ?>
	
   <div class="col-xs-12">
														<a class="a-danios" data-toggle="modal"
															data-target="#daniosModal">No hay datos de da&ntilde;os.
															Clic para registrar da&ntilde;os</a>
													</div>
													<div class="clearfix"></div> 	
   <?php

} else {
    
    ?>
       
       <div class="col-xs-12">
														<button class="btn btn-primary" data-toggle="modal"
															data-target="#daniosModal">Registrar nueva
															actualizaci&oacute;n</button>
													</div>
       
       <?php
    
    $n = 0;
    $last = $historial->last_row();
    $lastID = $last->Evento_Danios_ID;
    
    foreach ($historial->result() as $row) :
        $n ++;
        ?>       
		
	<div class="clearfix"></div>
	<br />

													<div class="row datos-danio">
														<div class="danios col-xs-12">
															<input type="hidden" class="d-ultimo" value="<?=($lastID==$row->Evento_Danios_ID)?"1":"0"?>" />
															<input type="hidden" class="d-ID"
																value="<?=$row->Evento_Danios_ID?>" />
															<div class="row">
																<div class="danios col-lg-1_5 col-sm-2">
																	<div class="elemento lesionados">
																		<i class="fa fa-user" aria-hidden="true"></i>
																		<p class="d-Evento_Lesionados"><?=$row->Evento_Lesionados?></p>
																		<span>Lesionados</span>
																	</div>
																</div>
																<div class="danios col-lg-1_5 col-sm-2">
																	<div class="elemento fallecidos">
																		<i class="fa fa-user" aria-hidden="true"></i>
																		<p class="d-Evento_Fallecidos"><?=$row->Evento_Fallecidos?></p>
																		<span>Fallecidos</span>
																	</div>
																</div>
																<div class="danios col-lg-1_5 col-sm-2">
																	<div class="elemento desaparecidos">
																		<i class="fa fa-user" aria-hidden="true"></i>
																		<p class="d-Evento_Desaparecidos"><?=$row->Evento_Desaparecidos?></p>
																		<span>Desaparecidos</span>
																	</div>
																</div>
																<div class="danios col-lg-1_5 col-sm-2">
																	<div class="elemento inhabilitadas">
																		<i class="fa fa-hospital-o" aria-hidden="true"></i>
																		<p class="d-Evento_Viv_Inhabitables"><?=$row->Evento_Viv_Inhabitables?></p>
																		<span>Operativas</span>
																	</div>
																</div>
																<div class="danios col-lg-1_5 col-sm-2">
																	<div class="elemento colpasadas">
																		<i class="fa fa-hospital-o" aria-hidden="true"></i>
																		<p class="d-Evento_Viv_Colapsadas"><?=$row->Evento_Viv_Colapsadas?></p>
																		<span>Inoperativas</span>
																	</div>
																</div>

															</div>
														</div>
														<div class="danios col-xs-12">
															<div class="row">
																<div class="col-xs-12 col-md-4 datos">
																	<table class="table table-bordered">
																		<tr>
																			<th class="table-light">Fecha</th>
																			<td class="d-fecha" colspan="2"><?=$row->fecha?></td>
																		</tr>
																		<tr>
																			<th ROWSPAN=4 class="table-light">Fuente</th>
																			<td class="d-Evento_Danios_Nombre_">Nombre</td>
																			<td class="d-Evento_Danios_Nombre"><?=$row->Evento_Danios_Nombre?></td>
																		</tr>
																		<tr>
																		<td class="d-Evento_Danios_Institucion_">Institución</td>
																			<td class="d-Evento_Danios_Institucion"><?=$row->Evento_Danios_Institucion?></td>
																		</tr>
																		<tr>
																		<td class="d-Evento_Danios_Telefono_">Teléfono</td>
																			<td class="d-Evento_Danios_Telefono"><?=$row->Evento_Danios_Telefono?></td>
																		</tr>																																				
																		<tr>
																			<td class="d-Evento_Danios_Correo_">Correo</td>
																			<td class="d-Evento_Danios_Correo"><?=$row->Evento_Danios_Correo?></td>
																		</tr>																		
																		<tr>
																			<th class="table-light">Registrado por</th>
																			<td colspan="2"><?=$row->usuario?></td>
																		</tr>
																	</table>
																</div>
																<!--<div class="col-xs-12 col-md-8 datos last text-left">
																	<h4>Descripci&oacute;n</h4>
																	<p class="d-Evento_Danios_Descripcion"><?=$row->Evento_Danios_Descripcion?></p>
																</div>-->
															</div>

														</div>


														<div class="col-xs-12 historial">
															<span style="display: inline-block">Actualizaci&oacute;n N&deg; <?=$n?></span>

                                        		<?php if($lastID==$row->Evento_Danios_ID){ ?>
                                        		<div class="pull-right">
																<i class="fa fa-trash actionDelete" aria-hidden="true"
																	style="color: #e67d7d; font-size: 20px; padding: 0 5px;"></i>
															</div>
                                        		<?php } ?>
                                            	<div class="pull-right">
																<i class="fa fa-pencil-square-o actionEdit"
																	aria-hidden="true"
																	style="color: #6d6b6b; font-size: 20px; padding: 0 5px;"></i>
															</div>

														</div>

													</div>
	
    	<?php
            endforeach;
        }
        ?>												

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
			<script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
        
        		</div>
	</div>

	<div class="modal fade" id="daniosModal" tabindex="-1" role="dialog"
		aria-labelledby="daniosModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
					</button>
					<h4 class="modal-title" id="daniosModalLabel">Ingresar Datos de
						Da&ntilde;os Generales</h4>
				</div>
				<form id="formRegistrar" name="formRegistrar" method="post"
					action="" autocomplete="off">
					<input type="hidden" name="Evento_Registro_Numero"
						value="<?=$danios->Evento_Registro_Numero?>" />
					<div class="modal-body">

						<table class="table table-bordered table-sm">
							<tr>
								<td class="table-light"><label for="fecha"
									class="col-sm-2 alinear">Fecha</label></td>
								<td class="table-light"><div class="col-sm-10 input-group date"
										data-target-input="nearest">
										<div class="form-group" style="margin-bottom: 0;">
											<div class='input-group date datetimepicker'>
												<input type="text" class="form-control" required="required"
													name="fechaEvento" /> <span class="input-group-addon"> <span
													class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div></td><!--
								<td class="table-light"><label for="fuente"
									class="col-sm-2 alinear">Fuente de Informaci&oacute;n</label></td>
								<td class="table-light"><input type="text"
									class="form-control form-control-sm" name="fuente"
									placeholder="Fuente" /></td>-->
							</tr>
							<tr> <th ROWSPAN=4> Fuente de Informaci&oacute;n </th>
							<!--<td class="table-light"><label for="nombre_f" class="col-sm-3 alinear">Nombre</label></td>-->
							<td class="table-light"><input type="text" class="form-control form-control-sm" name="nombre_f" placeholder="Nombre" /></td>
							</tr>
							<tr>
							<!--<td class="table-light"><label for="institucion_f" class="col-sm-3 alinear">Instituci&oacute;n</label></td>-->
							<td class="table-light"><input type="text" class="form-control form-control-sm" name="institucion_f" placeholder="Instituci&oacute;n" /></td>
							</tr>
							<tr>
							<!--<td class="table-light"><label for="telefono_f" class="col-sm-3 alinear">Tel&eacute;fono</label></td>-->
							<td class="table-light"><input type="text" class="form-control form-control-sm" name="telefono_f" placeholder="Tel&eacute;fono" /></td>
							</tr>
							<tr>
							<!--<td class="table-light"><label for="correo_f" class="col-sm-3 alinear">Correo</label></td>-->
							<td class="table-light"><input type="text" class="form-control form-control-sm" name="correo_f" placeholder="Correo" /></td>
							</tr>
							<!--
							<tr>
								<td class="table-light"><label for="inputEmail3"
									class="col-sm-2 alinear">Descripci&oacute;n</label></td>
								<td class="table-light" colspan="4"><textarea
										class="form-control form-control-sm" required="required"
										name="descripcion" rows="2"></textarea></td>
							</tr>-->
						</table>
						<br />
						<h5>Da&ntilde;os a la Salud de las Personas</h5>
						<table class="table table-bordered table-sm">
							<tr>
								<td class="table-light">
									<div class="row alinear">
										<div class="col-xs-6">Lesionados</div>
										<div class="col-xs-6">
											<input type="text" name="lesionados"
												class="form-control form-control-sm" value="0" />
										</div>
									</div>
								</td>
								<td class="table-light">
									<div class="row alinear">
										<div class="col-xs-6">Fallecidos</div>
										<div class="col-xs-6">
											<input type="text" name="fallecidos"
												class="form-control form-control-sm" value="0" />
										</div>
									</div>
								</td>
								<td class="table-light">
									<div class="row alinear">
										<div class="col-xs-6">Desaparecidos</div>
										<div class="col-xs-6">
											<input type="text" name="desaparecidos"
												class="form-control form-control-sm" value="0" />
										</div>
									</div>
								</td>
							</tr>
						</table>
						<br />
						<h5>Da&ntilde;os a la Infraestructura de Salud (IPRESS)</h5>
						<table class="table table-bordered table-sm">
							<tr>
								<td class="table-light">
									<div class="row alinear">
										<div class="col-xs-6">Afectado Operativo</div>
										<div class="col-xs-6">
											<input type="text" name="inhabitables"
												class="form-control form-control-sm" value="0" />
										</div>
									</div>
								</td>
								<td class="table-light">
									<div class="row alinear">
										<div class="col-xs-6">Afectado Inoperativo</div>
										<div class="col-xs-6">
											<input type="text" name="colapsadas"
												class="form-control form-control-sm" value="0" />
										</div>
									</div>
								</td>
                            </tr>
						</table>

					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button"
							data-dismiss="modal">Cancelar</button>
						<button class="btn btn-primary" type="submit">Registrar</button>
						<div class="col-md-12 text-center cargando"></div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div class="modal fade" id="editModal" tabindex="-1" role="dialog"
		aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
					</button>
					<h4 class="modal-title" id="daniosModalLabel">Ingresar Datos de
						Da&ntilde;os Generales</h4>
				</div>
				<form id="formActualizar" name="formActualizar" method="post"
					action="" autocomplete="off">
					<input type="hidden" name="dUltimo" id="dUltimo" />
					<input type="hidden" name="Evento_Registro_Numero"
						value="<?=$danios->Evento_Registro_Numero?>" /> <input
						type="hidden" id="danioID" name="danioID" />
					<div class="modal-body">

						<table class="table table-bordered table-sm">
							<tr>
								<td class="table-light"><label for="fecha"
									class="col-sm-2 alinear">Fecha</label></td>
								<td class="table-light"><div class="col-sm-10 input-group date"
										data-target-input="nearest">
										<div class="form-group">
											<div class='input-group date datetimepicker'>
												<input type="text" class="form-control" required="required"
													name="fechaEvento" id="fechaEvento" /> <span
													class="input-group-addon"> <span
													class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div></td>
							<!--	<td class="table-light"><label for="fuente"
									class="col-sm-2 alinear">Fuente de Informaci&oacute;n</label></td>
								<td class="table-light"><input type="text"
									class="form-control form-control-sm" id="fuente" name="fuente"
									placeholder="Fuente" /></td>-->
							</tr>
							</tr>
							<tr> <th ROWSPAN=4> Fuente de Informaci&oacute;n </th>
							<!--<td class="table-light"><label for="nombre_f" class="col-sm-3 alinear">Nombre</label></td>-->
							<td class="table-light"><input type="text" class="form-control form-control-sm" id="nombre_f" name="nombre_f" placeholder="Nombre" /></td>
							</tr>
							<tr>
							<!--<td class="table-light"><label for="institucion_f" class="col-sm-3 alinear">Instituci&oacute;n</label></td>-->
							<td class="table-light"><input type="text" class="form-control form-control-sm" id="institucion_f" name="institucion_f" placeholder="Instituci&oacute;n" /></td>
							</tr>
							<tr>
							<!--<td class="table-light"><label for="telefono_f" class="col-sm-3 alinear">Tel&eacute;fono</label></td>-->
							<td class="table-light"><input type="text" class="form-control form-control-sm" id="telefono_f" name="telefono_f" placeholder="Tel&eacute;fono" /></td>
							</tr>
							<tr>
							<!--<td class="table-light"><label for="correo_f" class="col-sm-3 alinear">Correo</label></td>-->
							<td class="table-light"><input type="text" class="form-control form-control-sm" id="correo_f" name="correo_f" placeholder="Correo" /></td>
							</tr>							
							<!--<tr>
								<td class="table-light"><label for="inputEmail3"
									class="col-sm-2 alinear">Descripci&oacute;n</label></td>
								<td class="table-light" colspan="4"><textarea
										class="form-control form-control-sm" required="required"
										name="descripcion" id="descripcion" rows="2"></textarea></td>
							</tr>-->
						</table>
						<br />
						<h5>Da&ntilde;os a la Salud de las Personas</h5>
						<table class="table table-bordered table-sm">
							<tr>
								<td class="table-light">
									<div class="row alinear">
										<div class="col-xs-6">Lesionados</div>
										<div class="col-xs-6">
											<input type="text" name="lesionados" id="lesionados"
												class="form-control form-control-sm" />
										</div>
									</div>
								</td>
								<td class="table-light">
									<div class="row alinear">
										<div class="col-xs-6 alinear">Fallecidos</div>
										<div class="col-xs-6">
											<input type="text" name="fallecidos" id="fallecidos"
												class="form-control form-control-sm" />
										</div>
									</div>
								</td>
								<td class="table-light">
									<div class="row alinear">
										<div class="col-xs-6 alinear">Desaparecidos</div>
										<div class="col-xs-6">
											<input type="text" name="desaparecidos" id="desaparecidos"
												class="form-control form-control-sm" />
										</div>
									</div>
								</td>
							</tr>
						</table>
						<br />
						<h5>Da&ntilde;os a la Infraestructura de Salud (IPRESS)</h5>
						<table class="table table-bordered table-sm">
							<tr>
								<td class="table-light">
									<div class="row alinear">
										<div class="col-xs-6">Afectado Operativo</div>
										<div class="col-xs-6">
											<input type="text" name="inhabitables" id="inhabitables"
												class="form-control form-control-sm" />
										</div>
									</div>
								</td>
								<td class="table-light">
									<div class="row alinear">
										<div class="col-xs-6" style="font-size: 11px;">Afectado
											Inoperativo</div>
										<div class="col-xs-6">
											<input type="text" name="colapsadas" id="colapsadas"
												class="form-control form-control-sm" />
										</div>
									</div>
								</td>
							</tr>
						</table>

					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button"
							data-dismiss="modal">Cancelar</button>
						<button class="btn btn-primary" type="submit">Actualizar</button>
						<div class="col-md-12 text-center cargando"></div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<input type="hidden" id="idEliminar" />

	<script src="<?=base_url()?>public/js/eventos/danios.js?v=<?=date("his")?>"></script>
	<script>

	danios("<?=base_url()?>","<?=$Evento_Registro_Numero?>");

	</script>
</body>

</html>