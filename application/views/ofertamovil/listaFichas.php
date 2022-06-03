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
	<?php $titulo = "Lista de Fichas"; ?><link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/listaFichas.css?v=<?=date("s")?>" />
	<?php $opciones = $this->session->userdata("Permisos_Opcion"); ?>
</head>
<body>
	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
	<?php $this->load->view("inc/nav"); ?>
		<div class="page-wrapper" style="min-height: 710px;">
			<div class="container">
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark"><?=$titulo?></h5>
					</div>
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="<?=base_url()?>">Inicio</a></li>
							<li><a href="<?=base_url()?>ofertamovil"><span>Eventos Oferta movil</span></a></li>
							<li class="active"><span>Lista de Fichas</span></li>
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
                                                <?php $message = $this->session->flashdata('messageWarning'); ?>
                                                <?php if($message){ ?>
                                                    <div
														class="alert alert-warning">
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
													<ul class="botones-evento">
																<?php //if(validarPermisosOpciones(12,$opciones)){ ?>
																<li id="btn-nuevo" class="agregar" data-toggle="modal" data-target="#addModal"><label rel=""><span>Crear nueva ficha</span><i class="fa fa-folder" aria-hidden="true"></i></label></li>
																<?php //} ?>
																<?php //if(validarPermisosOpciones(1,$opciones)){ ?>
																<li id="btn-editar" class=""><label rel=""><span>Editar Cabecera</span><i class="fa fa-edit" aria-hidden="true"></i></label></li>
																<?php //} ?>
																<?php //if(validarPermisosOpciones(13,$opciones)){ ?>
																<li id="btn-oferta-movil" class="oferta-movil"><label rel=""><span>Ofertas M&oacute;viles</span><i class="fa fa-ambulance" aria-hidden="true"></i></label></li>
																<?php //} ?>
																<?php //if(validarPermisosOpciones(7,$opciones)){ ?>
																<li id="btn-atencion" class=""><label rel=""><span>Agregar Atenci&oacute;n</span><i class="fa fa-plus-square" aria-hidden="true"></i></label></li>
																<?php //} ?>
																<?php //if(validarPermisosOpciones(8,$opciones)){ ?>
																<li id="btn-consolidado" class=""><label rel=""><span>Ver Consolidado</span><i class="fa fa-external-link-square" aria-hidden="true"></i></label></li>
																<?php //} ?>
																<?php //if(validarPermisosOpciones(9,$opciones)){ ?>
																<li id="btn-eliminar" class=""><label rel=""><span>Eliminar la Ficha</span><i class="fa fa-trash" aria-hidden="true"></i></label></li>
																<?php //} ?>
																<?php //if(validarPermisosOpciones(10,$opciones)){ ?>
																<li id="btn-reportar" class=""><label rel=""><span>Reportar la Ficha</span><i class="fa fa-line-chart" aria-hidden="true"></i></label></li>
																<?php //} ?>
																<?php //if(validarPermisosOpciones(10,$opciones)){ ?>
																<li id="btn-cerrar" class=""><label rel=""><span>Cerrar la Ficha</span><i class="fa fa-times" aria-hidden="true"></i></label></li>
																<?php //} ?>
																<?php //if(validarPermisosOpciones(10,$opciones)){ ?>
																<li id="btn-reabrir" class=""><label rel=""><span>Re-abrir la Ficha</span><i class="fa fa-folder-open" aria-hidden="true"></i></label></li>
																<?php //} ?>
													</ul>
													<div class="clearfix"></div>
													<hr />
													<div class="table-responsive">
														<table class="table table-bordered table-hover tbLista">
															<thead>
																<tr>
																	<th class="text-center">ID</th>
																	<th class="text-center">Fecha Apertura</th>
																	<th class="text-center">Usuario Apertura</th>
																	<th class="text-center">Hora Cierre</th>
																	<th class="text-center">Nro. Atenciones</th>
																	<th class="text-center">Estado</th>
																	<th class="text-center">&nbsp;</th>
																	<th class="text-center">&nbsp;</th>
																</tr>
															</thead>
															<?php if($fichas->num_rows()>0){ ?>
															<tbody>
															<?php foreach($fichas->result() as $row): ?>
																<tr>
																	<td class="text-center"><?=$row->id?></td>
																	<td class="text-center"><?=$row->Evento_Ficha_Atencion_Fecha?></td>
																	<td class="text-center"><?=$row->usuario?></td>
																	<td class="text-center"><?=$row->Evento_Ficha_Atencion_Hora_Cierre?></td>
																	<td class="text-center"><?=$row->Numero_Atenciones?></td>
																	<td class="text-center">
																	<?php
																	if($row->Evento_Ficha_Atencion_Estado=="1"){
																	?>
																	    <span class="label label-success">Abierto</span>
																	<?php
																	}else{
																	?>
																		<span class="label label-danger">Cerrado</span>
																	<?php
                                                                    }
																	?></td>
																	<td class="text-center"><?=$row->Evento_Ficha_Atencion_Estado?></td>
																	<td class="text-center"><?=base64_encode($row->id)?></td>
																</tr>
															<?php endforeach; ?>
															</tbody>
															<?php } ?>
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
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
					</button>
					<h4 class="modal-title" id="daniosModalLabel">Registrar Ficha Antenci&oacute;n</h4>
				</div>
				<form id="formRegistrar" name="formRegistrar" method="post" action="<?=base_url()?>ofertamovil/fichas/registrar">
					<input type="hidden" name="Evento_Registro_Numero" value="<?=$Evento_Registro_Numero?>" />
					<div class="modal-body">
						<div class="col-xs-12">
    						<div class="form-group">
                                <label for="fechaRegistro">Fecha y hora de Apertura</label>
                                <input type="text" class="form-control datetimepicker" name="fechaApertura" id="fechaApertura" placeholder="dd/mm/aaaa hh:mm" autocomplete="off" />
                            </div>
                         <div class="form-group">
                            <label>Usuario</label>
                            <input type="text" class="form-control" disabled="disabled" value="<?=$this->session->userdata("nombre")?>" />
                          </div>
						</div>
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
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
					</button>
					<h4 class="modal-title" id="daniosModalLabel">Editar Ficha Antenci&oacute;n</h4>
				</div>
				<form id="formRegistrar" name="formRegistrar" method="post" action="<?=base_url()?>ofertamovil/fichas/editar" autocomplete="off">
					<input type="hidden" name="Evento_Registro_Numero" value="<?=$Evento_Registro_Numero?>" />
					<input type="hidden" id="id" name="id" />
					<div class="modal-body">
						<div class="col-xs-12">
						<div class="form-group">
                            <label for="fechaRegistro">hora de Apertura</label>
                            <input type="text" class="form-control dateHour" name="horaApertura" id="horaApertura" placeholder="hh:mm" autocomplete="off" />
                          </div>
                         <div class="form-group">
                            <label>Usuario</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" disabled="disabled" />
                          </div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button"
							data-dismiss="modal">Cancelar</button>
						<button class="btn btn-primary" type="submit">Editar</button>
						<div class="col-md-12 text-center cargando"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
			<div class="modal fade" id="atencionModal" tabindex="-1" role="dialog" aria-labelledby="lesionadosModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h5 class="modal-title" id="registrarTableroModalLabel">Agregar Atenci&oacute;n</h5>
						</div>
						<form id="formRegistrarAtencion" name="formRegistrarAtencion" action="<?=base_url()?>ofertamovil/fichas/registrarAtencion" method="POST" autocomplete="off">
							<div class="modal-body">
								<input type="hidden" name="Evento_Registro_Numero" value="<?=$Evento_Registro_Numero?>" />
								<input type="hidden" name="Evento_Ficha_Atencion_ID" value="" />
								<div class="row">
								
									<div class="col-xs-12 col-sm-6 col-md-3">
										<div class="form-group" style="margin-bottom: 5px;">
											<label class="">Tipo Documento</label> 
											<select class="form-control" name="Tipo_Documento_Codigo" style="font-size: 12px;">
                							<?php foreach($tipodocumento->result() as $row): ?>
                    							<option value="<?=$row->Tipo_Documento_Codigo?>"><?=$row->Tipo_Documento_Nombre?></option>
                    							<?php endforeach; ?>
                    						</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-3">
										<label class="">N&deg; Documento</label> 
										<div class="input-group" style="margin-bottom: 5px;">
											<input type="text" class="form-control" name="Evento_Ficha_Atencion_Detalle_DNI" autocomplete="off">
											<span class="input-group-btn">
												<button type="button" id="btn-buscar" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
											</span>
										</div>
									</div>							
									<div class="col-xs-12 col-sm-12 col-md-6">
										<div class="form-group">
											<label class="">Paciente</label> 
											<input type="text" class="form-control text-uppercase" name="Evento_Ficha_Atencion_Detalle_Paciente" value="" autocomplete="off" />
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-xs-12 col-sm-3">
										<div class="form-group">
											<label class="">Edad</label> 
											<input type="text" class="form-control" name="Evento_Ficha_Atencion_Detalle_Edad" value="" autocomplete="off" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-3">
										<div class="form-group">
											<label class="">G&eacute;nero</label>
											<select class="form-control" name="Evento_Ficha_Atencion_Detalle_Genero">
												<option value="">-- Seleccione --</option>
												<option value="1">MASCULINO</option>
												<option value="2">FEMENINO</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-3 div-gestante">
										<div class="form-check pt-30">
    										<input type="checkbox" class="form-check-input" name="Evento_Ficha_Atencion_Detalle_Gestante" id="Evento_Ficha_Atencion_Detalle_Gestante" value="1">
    										<label class="form-check-label" for="Evento_Ficha_Atencion_Detalle_Gestante">Gestante</label>
    									</div>
									</div>									
									<div class="col-xs-12 col-sm-3">
											<div class="form-group">
    										<label>El Paciente Registrado es</label>
    										<div class="input-group">
        										<select class="form-control" name="Evento_Ficha_Atencion_Detalle_Personal_Salud" id="Evento_Ficha_Atencion_Detalle_Personal_Salud">
        											<option value="0">-- Ninguno --</option>
        											<option value="1">Personal del Ministerio de Salud</option>
        											<option value="2">Personal de las FF.AA. o PNP</option>
        											<option value="3">Personal de EsSalud</option>
        										</select>
        									</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-xs-12">
										<div class="form-group">
											<label class="">Diagn&oacute;stico</label>
											<textarea rows="2" class="form-control" name="Evento_Ficha_Atencion_Detalle_Diagnostico"></textarea>
										</div>
									</div>
									<div class="clearfix"></div>									
									<div class="col-xs-12 col-sm-6 col-md-3">
										<div class="form-group">
											<label class="">Clasificaci&oacute;n</label>
											<select class="form-control" name="Evento_Ficha_Atencion_Detalle_Clasificacion">
												<option value="">-- Seleccione --</option>
												<option value="1">Rojo</option>
												<option value="2">Amarillo</option>
												<option value="3">Verde</option>
												<option value="4">Negro</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-3">
										<div class="form-group">
											<label class="">Fecha Inicio Sintomas</label>
											<div class="input-group date" data-target-input="nearest">
												<div class="form-group mb-5">
													<div class='input-group date datetimepicker'>
														<input type="text" class="form-control" required="required" 	name="Evento_Ficha_Atencion_Detalle_Inicio_Sintomas" />
														<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
													</div>
												</div>
											</div>
										</div>
									</div>								
									<div class="col-xs-12 col-sm-12 col-md-6">
										<div class="form-group">
											<label class="">CIE10</label>
											<div class="input-group">
												<input type="hidden" class="cLesionado_CIE10_Codigo" name="Evento_Ficha_Atencion_Detalle_CIE10_Codigo" /> 
												<input type="text" name="Evento_Ficha_Atencion_Detalle_CIE10_Texto" class="form-control detalle-size" autocomplete="off" readonly />
												<span class="input-group-btn">
													<button type="button" class="btn btn-info detalle-size" data-toggle="modal" data-target="#tableEnfermedadesModal" style="color: white">
														<i class="fa fa-search" aria-hidden="true"></i>
													</button>
												</span>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-xs-12 col-sm-4">
										<div class="form-group">
											<label class="">Hora Atenci&oacute;n</label>
											<div class="input-group date" data-target-input="nearest">
												<div class="form-group mb-5">
													<div class='input-group date dateHour'>
														<input type="text" class="form-control" required="required" name="Evento_Ficha_Atencion_Detalle_Hora_Atencion" />
														<span class="input-group-addon"><span class="glyphicon glyphicon-dashboard"></span></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4">
										<div class="form-group">
											<label class="">Entidad</label>
											<select class="form-control" name="Evento_Tipo_Entidad_Atencion">
												<option value="">-- Seleccione --</option>
												<?php foreach($listaEntidadAtencion as $row): ?>
            										<option value="<?=$row->id?>"><?=$row->Evento_Tipo_Entidad_Atencion_Nombre?></option>
            									<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4">
										<div class="form-group">
											<label class="">Oferta Movil</label>
											<select class="form-control" name="Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID">
												<option value="">-- Seleccione Entidad --</option>
											</select>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<input type="checkbox" class="form-check-input" id="Evento_Ficha_Atencion_Detalle_Vacuna" name="Evento_Ficha_Atencion_Detalle_Vacuna" value="1">
										<label class="form-check-label" for="Evento_Ficha_Atencion_Detalle_Vacuna">Vacunas</label>
									</div>
									
									<div class="col-xs-12 col-sm-6 col-md-4">
										<input type="checkbox" class="form-check-input" id="Evento_Ficha_Atencion_Detalle_Quimioprofilaxis" name="Evento_Ficha_Atencion_Detalle_Quimioprofilaxis" value="1">
										<label class="form-check-label" for="Evento_Ficha_Atencion_Detalle_Quimioprofilaxis">Quimioprofilaxsis</label>
									</div>
									
									<div class="col-xs-12 col-sm-6 col-md-4">
										<input type="checkbox" class="form-check-input" id="Evento_Ficha_Atencion_Detalle_Medicamentos" name="Evento_Ficha_Atencion_Detalle_Medicamentos" value="1">
										<label class="form-check-label" for="Evento_Ficha_Atencion_Detalle_Medicamentos">Medicamentos</label>
									</div>
									<div class="clearfix"></div>
									<div class="col-xs-12 col-sm-4">
										<div class="form-group">
											<label class="">Destino</label>
											<select class="form-control" name="Evento_Ficha_Atencion_Detalle_Destino">
												<option value="">-- Seleccione --</option>
												<option value="1">Alta</option>
												<option value="2">Referido</option>
												<option value="3">Fuga</option>
												<option value="4">Retiro con Aviso</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-8">
										<div class="form-group">
											<label class="">Lugar de Traslado</label>
											<input class="form-control disabled" name="Evento_Ficha_Atencion_Detalle_Lugar_Traslado" disabled="disabled" />
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-xs-12">
										<div class="form-group">
											<label class="">Responsable</label>
											<input class="form-control disabled" name="Evento_Ficha_Atencion_Detalle_Responsable" disabled="disabled" />
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group paises">
											<input type="hidden" class="form-control disabled" name="Evento_Ficha_Atencion_Pais_Procedencia" />
											<label class="">Pa&iacute;s de procedencia</label>
											<input type="text" class="form-control" name="pais" />
											<div id="paises"></div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											<label class="">Lugar de residencia</label>
											<input type="text" class="form-control" name="Evento_Ficha_Atencion_Lugar_Residencia" />
										</div>
									</div>							
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn-resposive btn btn-basic btn-clear-form" data-dismiss="modal">Cerrar</button>
								<button type="submit" class="btn-resposive btn btn-primary">Guardar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal fade" id="tableEnfermedadesModal" tabindex="-1"
				role="dialog" aria-labelledby="tableEnfermedadesModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-md" role="document"
					style="padding-top: 10px;">
					<div class="modal-content">
						<div class="modal-body">
							<table
								class="tableEnfermedades table table-striped table-bordered table-sm"
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
	<div class="modal fade" id="cerrarModal" tabindex="-1" role="dialog" aria-labelledby="cerrarModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
					</button>
					<h4 class="modal-title">Cerrar Ficha Antenci&oacute;n</h4>
				</div>
				<form id="formRegistrar" name="formRegistrar" method="post" action="<?=base_url()?>ofertamovil/fichas/cerrar" autocomplete="off">
					<input type="hidden" name="Evento_Registro_Numero" value="<?=$Evento_Registro_Numero?>" />
					<input type="hidden" id="id" name="id" />
					<div class="modal-body">
						<div class="col-xs-12">
						<div class="form-group">
                            <label for="fechaRegistro">hora de Cierre</label>
                            <input type="text" class="form-control dateHour" name="horaCierre" id="horaCierre" placeholder="hh:mm" autocomplete="off" />
                         </div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
						<button class="btn btn-primary" type="submit">Cerrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
					</button>
					<h4 class="modal-title">Eliminar Ficha Antenci&oacute;n</h4>
				</div>
				<form id="formEliminar" name="formEliminar" method="post" action="<?=base_url()?>ofertamovil/fichas/eliminar" autocomplete="off">
					<input type="hidden" name="Evento_Registro_Numero" value="<?=$Evento_Registro_Numero?>" />
					<input type="hidden" id="id" name="id" />
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
						<button class="btn btn-primary" type="submit">Eliminar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="ofertaMovilModal" tabindex="-1" role="dialog" aria-labelledby="ofertaMovilModal" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
					</button>
					<h4 class="modal-title" id="daniosModalLabel">Oferta Movil</h4>
				</div>
				<form id="formRegistrarOfertaMovil" name="formRegistrarOfertaMovil" method="post" action="" autocomplete="off">
					<input type="hidden" id="Evento_Registro_Numero" name="Evento_Registro_Numero" />
					<div class="modal-body">
						<div class="col-xs-12">						
    						<div class="form-group">
                                <label for="fechaRegistro">Nombre</label>
                                <input type="text" class="form-control" name="Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre" autocomplete="off" />
                             </div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<label class="">Entidad Atencion</label>
								<select class="form-control" name="Evento_Tipo_Entidad_Atencion_ID">
									<option value="">-- Seleccione --</option>
									<?php foreach($listaEntidadAtencion as $row): ?>
										<option value="<?=$row->id?>"><?=$row->Evento_Tipo_Entidad_Atencion_Nombre?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-12 table-wrapper">
							<table id="tableOfertaMovil" class="table">
								<thead>
									<tr>
										<th class="text-center">Nombre</th>
										<th class="text-center">Entidad</th>
										<th class="text-center">&nbsp;</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
						<button class="btn btn-primary" type="submit">Agregar</button>
						<div class="col-md-12 text-center cargando"></div>
					</div>
					<p id="duplicate_movil" class="text-danger text-center hide">No se pudo registrar, ya existe</p>
				</form>
			</div>
		</div>
	</div>
<div class="modal fade" id="deleteOfertaMovilModal" tabindex="-1" role="dialog" aria-labelledby="deleteOfertaMovilModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form id="deleteOfertaMovilForm" method="post" action="<?=base_url()?>ofertamovil/eventoTipoEntidadAtencionOfertaMovilEliminar" autocomplete="off">
              <div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Eliminar Oferta Movil</h5>
              </div>
              <div class="modal-body">
              	<input type="hidden" name="id" />
              	<input type="hidden" name="Evento_Registro_Numero" value="<?=$Evento_Registro_Numero?>" />
              	<p>&iquest;Seguro desea eliminar la oferta movil?</p>
              </div>
              <div class="modal-footer">
              	<button type="submit" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
			<?php $this->load->view("inc/footer"); ?>
		</div>
	</div>
	<script src="<?=base_url()?>public/js/moment.min.js"></script>
	<script src="<?=base_url()?>public/js/locale.es.js"></script>
	<script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?=base_url()?>public/js/ofertamovil/listaFichas.js?v=<?=date("s")?>"></script>
	<script>
	var paises = '<?=$paises?>';
    listaFichas("<?=base_url()?>","<?=$Evento_Registro_Numero?>", JSON.parse(paises),"<?=base64_encode($Evento_Registro_Numero)?>");
	</script>
</body>
</html>