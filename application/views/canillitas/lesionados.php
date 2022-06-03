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

    <?php $titulo = "Registro de Lesionados o Fallecidos"; ?>
	<link rel="stylesheet"
	href="<?=base_url()?>public/css/eventos/lesionados.css?v=<?=date("his")?>">
</head>

<body>

	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">

	<?php $this->load->view("inc/navsireed"); ?>

        <!-- Main Content -->
		<div class="page-wrapper" style="min-height: 710px;">
			<div class="container pt-30">
				<div class="row heading-bg">
					<div class="col-md-8 col-xs-12">
						<h5 class="txt-dark"><?=$titulo?></h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-md-4 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="<?=base_url()?>">Inicio</a></li>
							<li><a href="<?=base_url()?>eventos/eventos/lista"><span>Eventos</span></a></li>
							<li class="active"><span>Lesionados</span></li>
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
													<input type="hidden" id="hNumeroHistorial" />
													<div id="message" class="col-xs-12 pt-10"></div>
												<div class="clearfix"></div>
												<?php
                                                    $dateTime = explode(" ", $danios->fecha);
                                                ?>
            								<div class="table-responsive">
                                            	<table id="tabla" class="table table-striped table-bordered" style="margin: auto; margin-top: 25px;">
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
												<div class="clearfix"></div>
											</div>			
													<ul class="enlaces-otros">
														<li><a href="javascript:;" class="enlaceDanios" rel="danios">Registrar Da&ntilde;os Generales</a><span><i class="fa fa-home"></i></span></li>
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
													<div class="table-responsive tb-responsive">

														<table id="tbListar" class="table table-bordered">
															<thead>
																<tr>
																	<th>Fecha Atenci&oacute;n</th>
																	<th>Documento</th>
																	<th>Apellidos</th>
																	<th>Nombres</th>
																	<th>Edad</th>
																	<th>Gravedad</th>
																	<th>Situaci&oacute;n</th>
																	<th>CIE 10</th>
																	<th>Opciones</th>
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
																	<th>Lugar de Atención o Traslado</th>
																	<th>&nbsp;</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>

														<div class="clearfix"></div>
														<br />
														<div class="row">
															<div class="col-xs-12">
																<button id="btnRegistrarCambios" class="btn btn-info d-block">Registrar Cambios</button>
																<button class="btn btn-primary d-block" id="btnClearFields">Agregar Lesionado</button>
																<button id="btnCancel" class="btn btn-default d-block">Cancelar</button>
															</div>
														</div>

													</div>
													<!-- table-responsive -->
													<div class="clearfix"></div>
													<br />
   <?php if($contar->num_rows()<1){ ?>
	<div class="row">
														<div class="col-xs-12">
															<a class="a-danios active-tb-responsive" rel="0">No hay datos de lesionados. Haz clic para registrar</a>
														</div>
													</div>
													<div class="clearfix"></div>

   <?php }else{ ?>
         <div class="row">
														<div class="col-xs-12">
															<button class="btn btn-warning generar-historia d-block">Registrar Nueva actualizaci&oacute;n</button>
														</div>
													</div>

													<div class="clearfix"></div>
													<br />

													<div class="row pb-25">
       <?php
    $n = 0;
    $last = $contar->last_row();
    $lastID = $last->Evento_Danios_Lesionados_ID;
    foreach ($contar->result() as $row) :
        $n ++;
        ?>

        <div class="col-xs-12 col-sm-4 col-md-3 datos-danio" rel="<?=$row->Evento_Danios_Lesionados_ID?>" rel2="<?=$n?>">
															<div class="col-xs-12">
																<div class="danios col-xs-12">
																	<div class="row">
																		<div class="elemento p-damnificadas">

																			<div class="row">
																				<div class="col-xs-4">
																					<i class="fa fa-user" aria-hidden="true"></i>
																				</div>
																				<div class="col-xs-8">
																					<p><?=$row->lesionados?></p>
																					<span>Registros</span>
																				</div>
																			</div>
																		</div>
																	</div>

																</div>


																<div class="col-xs-12 historial">
																	<span style="display: inline-block">Actualizaci&oacute;n N&deg; <?=$n?></span>

            		<?php if($lastID==$row->Evento_Danios_Lesionados_ID){ ?>
            		<div class="pull-right">
																		<i class="fa fa-trash actionDelete" aria-hidden="true"
																			style="color: #e67d7d; font-size: 20px; padding: 0 5px;"></i>
																	</div>
            		<?php } ?>
                	<div class="pull-right">
																		<i class="fa fa-pencil-square-o active-tb-responsive"
																			aria-hidden="true"
																			style="color: #6d6b6b; font-size: 20px; padding: 0 5px;"></i>
																	</div>

																</div>
															</div>
														</div>
														<!-- registro danios-->


	<?php
    endforeach
    ;
}
?>
    </div>
													<!-- row -->



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
			<!-- /container -->



			<!-- Modal Registrar -->
			<div class="modal fade" id="lesionadosModal" tabindex="-1" role="dialog" aria-labelledby="lesionadosModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h5 class="modal-title" id="registrarTableroModalLabel">Registrar Lesionado</h5>

						</div>
						<form id="formRegistrar" name="formRegistrar" action=""
							method="POST">
							<div class="modal-body">
								<input type="hidden" name="Evento_Danios_Lesionados_Numero" value="0" />
								<input type="hidden" name="Evento_Danios_Lesionados_ID" value="0" /> 
								<input type="hidden" name="index" value="0" />
								<input type="hidden" name="editar" value="0" />
								<div class="row">

									<div class="col-xs-12 col-md-3 col-sm-6">
										<div class="form-group" style="margin-bottom: 5px;">
											<label class="">Fecha Atenci&oacute;n</label>
											<div class="input-group date" data-target-input="nearest">
												<div class="form-group" style="margin-bottom: 5px;">
													<div class='input-group date datetimepicker'>
														<input type="text" class="form-control"
															required="required"
															id="Evento_Danios_Lesionados_Fecha_Atencion"
															name="Evento_Danios_Lesionados_Fecha_Atencion" /> <span
															class="input-group-addon"> <span
															class="glyphicon glyphicon-calendar"></span>
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-xs-12 col-md-3 col-sm-6">
										<div class="form-group" style="margin-bottom: 5px;">
											<label class="">Tipo Documento</label> 
											<select class="form-control" name="Tipo_Documento_Codigo" style="font-size: 12px;">
                							<?php foreach($tipodocumento->result() as $row): ?>
                    							<option value="<?=$row->Tipo_Documento_Codigo?>"><?=$row->Tipo_Documento_Nombre?></option>
                    							<?php endforeach; ?>
                    						</select>
										</div>
									</div>
									<div class="col-xs-12 col-md-3 col-sm-6">
										<label class="">Nro. Documento</label> 
										<div class="input-group" style="margin-bottom: 5px;">
											<input type="text" class="form-control" name="Lesionado_Documento_Numero" autocomplete="off">
											<span class="input-group-btn">
												<button type="button" id="btn-buscar" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
											</span>
										</div>
									</div>
									<div class="col-xs-12 col-md-3 col-sm-6">
										<div class="form-group" style="margin-bottom: 5px;">
											<label class="">G&eacute;nero</label> 
											<select class="form-control" name="Lesionado_Genero" readonly>
												<option value="">-- Seleccione --</option>
												<option value="1">MASCULINO</option>
												<option value="2">FEMENINO</option>
											</select>
										</div>
									</div>
									
									<div class="clearfix"></div>

									<div class="col-xs-12 text-right div-gestante">
										<input type="checkbox" class="form-check-input"
											id="Lesionado_Gestante" name="Lesionado_Gestante" value="1">
										<label class="form-check-label" for="">Gestante</label>
									</div>
									<div class="clearfix"></div>
									<hr />

									<div class="col-xs-12 col-sm-5">
										<div class="form-group">
											<label class="">Apellidos</label> 
											<input type="text" class="form-control text-uppercase" name="Lesionado_Apellidos" value="" autocomplete="off" readonly />
										</div>
									</div>
									<div class="col-xs-12 col-sm-5">
										<div class="form-group">
											<label class="">Nombre(s)</label> 
											<input type="text" class="form-control text-uppercase" name="Lesionado_Nombres" value="" autocomplete="off" readonly />
										</div>
									</div>

									<div class="col-xs-12 col-sm-2">
										<div class="form-group">
											<label class="">Edad</label> 
											<input type="number" class="form-control" name="Lesionado_Edad" value="" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-xs-12">
										<div class="form-group">
											<label class="">Observaciones</label>
											<textarea rows="2" class="form-control"
												name="Lesionado_Observaciones"></textarea>
										</div>
									</div>
									<div class="clearfix"></div>
									<hr />

									<div class="col-xs-12 col-sm-3">
										<div class="form-group">
											<label class="">Nivel de Gravedad</label> <select
												class="form-control" name="Nivel_Gravedad_Codigo"
												style="font-size: 12px;">
							<?php foreach($nivelgravedad->result() as $row): ?>
							<option value="<?=$row->Nivel_Gravedad_Codigo?>"><?=$row->Nivel_Gravedad_Descripcion?></option>
							<?php endforeach; ?>
						</select>
										</div>
									</div>

									<div class="col-xs-12 col-sm-3">
										<div class="form-group">
											<label class="">Situaci&oacute;n actual</label> <select
												class="form-control" name="Situacion_Codigo"
												style="font-size: 12px;">
												<option value="">-- Seleccione --</option>
							<?php foreach($situacion->result() as $row): ?>
							<option value="<?=$row->Situacion_Codigo?>"><?=$row->Situacion_Descripcion?></option>
							<?php endforeach; ?>
						</select>
										</div>
									</div>

									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											<label class="">Diagn&oacute;stico - CIE10</label>
											<div class="input-group">
												<input type="hidden" class="cLesionado_CIE10_Codigo" name="Lesionado_CIE10_Codigo" /> <input
													type="text" name="Lesionado_CIE10_Texto"
													class="form-control detalle-size" autocomplete="off"
													readonly /> <span class="input-group-btn">
													<button type="button" class="btn btn-info detalle-size"
														data-toggle="modal" data-target="#tableEnfermedadesModal"
														style="color: white">
														<i class="fa fa-search" aria-hidden="true"></i>
													</button>
												</span>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<hr />
									<div class="col-xs-12 col-sm-4">
										<div class="form-group">
											<label class="">Lugar de Atenci&oacute;n</label>
											<div class="input-group">
												<select class="form-control"
													name="Lesionado_Entidad_Salud_Codigo">
													<option value="0">-- Seleccione --</option>
													<option value="1">Atendido en Foco</option>
													<option value="2">IPRESS</option>
													<option value="3">Cl&iacute;nicas</option>
													<option value="4">Otros</option>
												</select>

											</div>
										</div>
									</div>

									<div class="col-xs-12 col-sm-4">
										<div class="form-group">
    										<label>El Paciente Registrado es</label>
    										<div class="input-group">
        										<select class="form-control" name="Lesionado_Personal_Salud" id="Lesionado_Personal_Salud">
        											<option value="0">-- Ninguno --</option>
        											<option value="1">Personal del Ministerio de Salud</option>
        											<option value="2">Personal de las FF.AA. o PNP</option>
        											<option value="3">Personal de EsSalud</option>
        										</select>
        									</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4">
										<div class="form-group">
    										<label>Responsable del traslado</label>
    										<div class="input-group">
        										<select class="form-control" name="Evento_Tipo_Entidad_Atencion_ID" id="Evento_Tipo_Entidad_Atencion_ID" disabled="disabled">
        											<option value="0" selected>-- Ninguno --</option>
        											<?php foreach($listaEntidadAtencion as $row): ?>
        											<option value="<?=$row->id?>"><?=$row->Evento_Tipo_Entidad_Atencion_Nombre?></option>
        											<?php endforeach; ?>
        										</select>
        									</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-xs-12 entidad-salud">
										<div class="form-group">
											<label class="">Lugar de Atenci&oacute;n o Traslado</label> <input
												type="text" name="Lesionado_Entidad_Salud_Nombre"
												class="form-control detalle-size" autocomplete="off" />
										</div>

									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-basic btn-clear-form d-block" data-dismiss="modal">Cerrar</button>
								<button type="submit" class="btn btn-primary d-block">Guardar</button>
							</div>
						</form>
					</div>
				</div>
			</div>


			<!-- MODAL BUSQUEDA -->
			<div class="modal fade" id="tableEnfermedadesModal" tabindex="-1"
				role="dialog" aria-labelledby="tableEnfermedadesModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-md" role="document"
					style="padding-top: 10px;">
					<div class="modal-content">
						<div class="modal-body">
							<div class="table-responsive">
    							<table class="tableEnfermedades table table-striped table-bordered table-sm"
    								cellspacing="0" width="100%">
    								<thead>
    									<tr>
    										<th>C&oacute;digo</th>
    										<th>Descripci&oacute;n</th>
    
    									</tr>
    								</thead>
    							</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- MODAL -->

			<!-- MODAL BUSQUEDA -->
			<div class="modal fade" id="tableEntidadesSaludModal" tabindex="-1"
				role="dialog" aria-labelledby="tableEntidadesSaludModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document"
					style="padding-top: 10px;">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-group row">
								<label class="col-sm-12 col-form-label">Datos del Ubigeo</label>
								<div class="col-sm-3">
									<select class="form-control" name="departamento"
										id="departamento">
										<option value="">-- Departamento --</option>
								  <?php foreach($departamentos as $row): ?>
								  <option value="<?=$row->Codigo_Departamento?>"><?=$row->Nombre?></option>
								  <?php endforeach; ?>
								</select>
								</div>
								<div class="col-sm-3">
									<select class="form-control" name="provincia" id="provincia">
										<option value="">-- Elija Departamento --</option>
									</select>
								</div>
								<div class="col-sm-3">
									<select class="form-control" name="distrito" id="distrito">
										<option value="">-- Elija Provincia --</option>
									</select>
								</div>
								<div class="col-sm-3">
									<button id="btnFiltrarUbigeo" class="btn btn-info">Buscar Entidad</button>
								</div>

							</div>
							<table
								class="tableEntidadesSalud table table-striped table-bordered table-sm"
								cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>C&oacute;digo</th>
										<th>Nombre</th>
										<th>Clasificaci&oacute;n</th>

									</tr>
								</thead>
							</table>

						</div>
					</div>
				</div>
			</div>
			<!-- MODAL -->

			<input type="hidden" name="Evento_Registro_Numero" value="<?=$Evento_Registro_Numero?>" />
			<input type="hidden" id="idEliminar" />


	<!-- Footer -->
	<?php $this->load->view("inc/footer"); ?>

	<script src="<?=base_url()?>public/js/moment.min.js"></script>
			<script src="<?=base_url()?>public/js/locale.es.js"></script>
			<script
				src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
			<script src="<?=base_url()?>public/js/eventos/lesionados.js?v=<?=date("his")?>"></script>
			<!-- /Footer -->



		</div>
		<!-- /Main content -->


	</div>
	<!-- /#wrapper -->

	<script>
		lesionados("<?=base_url()?>","<?=$Evento_Registro_Numero?>", <?=$contar->num_rows()?>);
	</script>

</body>

</html>
