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
	<?php echo link_tag("public/css/mapa.css"); ?>
   <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="<?=base_url()?>public/css/ofertamovil/nuevo.css?v=<?=date("his")?>" />
  <?php $titulo = "Edición"; ?>
</head>
<body>
	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
	<?php $this->load->view("inc/nav"); ?>
		<div class="page-wrapper" style="min-height: 710px;">
			<div class="container pt-30">
				<div class="row heading-bg">
					<div class="col-sm-6 col-xs-12">
						<h5 class="txt-dark"><?=$titulo?></h5>
					</div>
   					<div class="col-md-6 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="<?=base_url()?>">Inicio</a></li>
							<li><a href="<?=base_url()?>ofertamovil"><span>Dashboard</span></a></li>
							<li class="active"><span>Editar Atenci&oacute;n</span></li>
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-xs-12">
								<div class="panel panel-default card-view pa-0">
									<div class="panel-wrapper collapse in">
										<div class="panel-body pa-10">
											<div class="container-fluid">
												<form id="formRegistrar" name="formRegistrar" method="post" autocomplete="off">
                                        			<input type="hidden" name="Evento_Tipo_Entidad_Atencion_Registro_Atenciones_ID" value="<?=($atencion->id)?>">
                                        			<input type="hidden" name="Pais_Procedencia_Codigo" value="<?=$atencion->Pais_Procedencia?>">
													<input type="hidden" name="Nombre_Codigo">
                                        			<input type="hidden" name="Evento_Tipo_Entidad_Atencion_Registro_ID" value="<?=$atencion->evento_tipo_entidad_atencion_registro_id?>">
                                        			<input type="hidden" name="Evento_Tipo_Entidad_Atencion_Registro_Profesionales_ID" value="<?=($atencion->evento_tipo_entidad_atencion_registro_profesionales_id)?>">
													<div id="message" class="col-xs-12"></div>
													<div class="col-xs-12 col-sm-10 col-sm-offset-1">
													<div class="setup-content" id="step-1">
													<div class="clearfix"></div>
													<br />
													<br />
														<div  class="row">
        													<div class="col-xs-12">
        														<div class="form-group">
            														<label class="col-xs-12 col-sm-2">Evento</label>
            														<div class="col-xs-12 col-sm-10">        														
                														<select class="form-control" name="Evento_Tipo_Entidad_Atencion_Registro_ID">
                															<option value=""> -- Seleccione -- </option>
                                            								<?php 
                                            								    foreach($lista->result() as $row):
                                            								?>
                                            									<option value="<?=$row->id?>" <?=($atencion->evento_tipo_entidad_atencion_registro_id == $row->id)?"selected":""?>><?=$row->descripcion?></option>
                                            								<?php 
                                            								    endforeach;
                                            								?>
                                            							</select>
            														</div>
            													</div>
																<div class="clearfix"></div>
																<br />
																<br />
																<h4>Profesional de Salud</h4>
																<br />
																<div class="row">
    																<div class="col-xs-12 col-sm-6">
                    													<div class="form-group">            														
                                    										<label class="">Nro. Documento (*)</label> 
                                    										<div class="input-group" id="error_Documento_Numero">
                                    											<input type="text" class="form-control" name="Documento_Numero" autocomplete="off" value="<?=$profesional->Documento_Numero?>">
                                    											<span class="input-group-btn">
                                    												<button type="button" id="btn-profesional" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    											</span>
                                    										</div>     													
                    													</div>
    																</div>
                                    								<div class="col-xs-12 col-sm-6">
                                    									<div class="form-group profesionales">
                                    										<label class="">Nombre</label>
                                    										<input type="text" class="form-control text-uppercase" name="Nombre" value="<?=$profesional->Nombre?>" /> 
																			<div id="profesionales"></div>
                                    									</div>
                                									</div>
                            									</div>
                            									<div class="row">
                                									<div class="col-xs-12 col-sm-6">
                                										<div class="row">
                                											<div class="col-xs-12 col-sm-6">
                                    											<div class="form-group">
                                            										<label class="">Profesión</label>
                                            										<select class="form-control" name="profesion">
                                            											<option value=""> -- Seleccione -- </option>
                                            											<?php foreach($listaProfesiones->result() as $row): ?>
                                                    										<option value="<?=$row->brigadistas_profesiones_id?>" <?=($profesional->brigadistas_profesiones_id == $row->brigadistas_profesiones_id)?"selected":""?>><?=$row->profesion?></option>
                                                    									<?php endforeach; ?>
                                            										</select> 
                                            									</div>
                                											</div>
                                											<div class="col-xs-12 col-sm-6">
                                    											<div class="form-group">
                                            										<label class="">Nro. Colegiatura</label>
                                            										<input type="text" class="form-control" name="Colegiatura" value="<?=$profesional->Colegiatura?>" /> 
                                            									</div>
                                											</div>
                                										</div>
                                									</div>
                                									<div class="col-xs-12 col-sm-6">
                                										<div class="row">
                                											<div class="col-xs-12 col-sm-6">
                                    											<div class="form-group">
                                            										<label class="">Especialidad</label>
                                            										<select class="form-control" name="brigadistas_especialidad_id">
                                            											<option value=""> -- Seleccione Profesión -- </option>
                                            										</select> 
                                            									</div>
                                											</div>
                                											<div class="col-xs-12 col-sm-6">
                                    											<div class="form-group">
                                            										<label class="">R.N.E.</label>
                                            										<input type="text" class="form-control" name="RNE" value="<?=$profesional->RNE?>" /> 
                                            									</div>
                                											</div>
                                										</div>
                                									</div>
                            									</div>
                            									<div class="clearfix"></div>
																<br />
																<br />
																<h4>Tipo de Atención</h4>
																<br />
                            									<div class="row">
                                									<div class="col-xs-12 col-sm-6">
                                										<div class="row flex flex-middle">
                                											<div class="col-xs-12 col-sm-5">
                                    											<div class="form-group">
                                            										<label class=""><input type="radio" name="tipoAtencion" value="1" <?=($atencion->PreHospitalario=="1")?"checked":""?>> Ambulancia</label>
                                            									</div>
                                											</div>
                                											<div class="col-xs-12 col-sm-7" id="showPre" style="<?=($atencion->PreHospitalario=="1")?"display: block":"display: none"?>">
                                    											<div class="form-group">
                                            										<select class="form-control" name="PreHospitalario_Entidad">
                                            											<option value="0" <?=($atencion->PreHospitalario_Entidad=="0")?"selected":""?>>[N/A]</option>
                                            											<option value="1" <?=($atencion->PreHospitalario_Entidad=="1")?"selected":""?>>SAMU</option>
                                            											<option value="2" <?=($atencion->PreHospitalario_Entidad=="2")?"selected":""?>>ESSALUD</option>
                                            											<option value="3" <?=($atencion->PreHospitalario_Entidad=="3")?"selected":""?>>BOMBEROS</option>
                                            											<option value="4" <?=($atencion->PreHospitalario_Entidad=="4")?"selected":""?>>FF. AA.</option>
                                            											<option value="5" <?=($atencion->PreHospitalario_Entidad=="5")?"selected":""?>>PNP</option>
                                            											<option value="6" <?=($atencion->PreHospitalario_Entidad=="6")?"selected":""?>>OTROS</option>
                                            										</select> 
                                            									</div>
                                											</div>
                                										</div>
                                									</div>
                                									<div class="col-xs-12 col-sm-6">
                                										<div class="row flex flex-middle">
                                											<div class="col-xs-12 col-sm-5">
                                    											<div class="form-group">
                                            										<label class=""><input type="radio" name="tipoAtencion" value="2" <?=($atencion->PMA_Oferta_Movil=="1")?"checked":""?>> PMA/Oferta Movil</label>
                                            									</div>
                                											</div>
                                											<div class="col-xs-12 col-sm-7" id="showPMA" style="<?=($atencion->PMA_Oferta_Movil=="1")?"display: block":"display: none"?>">
                                    											<div class="form-group">
                                            										<select class="form-control" name="Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID">
                                            											<option value=""> -- Seleccione Atención -- </option>
                                            										</select> 
                                            									</div>
                                											</div>
                                										</div>
                                									</div>
                            									</div>
																<div class="clearfix"></div>
																<br />
																<br />
																<h4>Datos del Paciente</h4>
																<br />
																<div class="row">
    																<div class="col-xs-12 col-sm-6">
                                										<div class="row flex flex-middle flex-direction-xs-column">
                                											<div class="col-xs-12 col-sm-6">
                                    											<div class="form-group">
                                        											<label class="">Tipo Documento</label> 
                                        											<select class="form-control" name="Tipo_Documento_Codigo">
                                                        							<?php foreach($tipodocumento->result() as $row): ?>
                                                            							<option value="<?=$row->Tipo_Documento_Codigo?>"><?=$row->Tipo_Documento_Nombre?></option>
                                                            							<?php endforeach; ?>
                                                            						</select>
                                        										</div>
                                											</div>
                                											<div class="col-xs-12 col-sm-6">
                                												<div class="form-group">
                                													<label class="">Nro. Documento</label> 
                                            										<div class="input-group" id="error_Tipo_Documento_Numero">
                                            											<input type="text" class="form-control" name="Tipo_Documento_Numero" autocomplete="off" value="<?=($atencion->Tipo_Documento_Numero)?>">
                                            											<span class="input-group-btn">
                                            												<button type="button" id="btn-buscar" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            											</span>
                                            										</div>
                                												</div>
                                											</div>
                                										</div>
                                									</div>
                                									<div class="col-xs-12 col-sm-6">
                                										<div class="row flex flex-middle">                                											
                                											<div class="col-xs-12">
                                    											<div class="form-group">
                                            										<label>Nombres y Apellidos</label>
                                            										<input type="text" class="form-control" name="Paciente" value="<?=($atencion->Paciente)?>" />
                                            									</div>
                                											</div>
                                										</div>
                                									</div>
																</div>
																<div class="row">
																	<div class="col-xs-12 col-sm-6">
																		<div class="row flex flex-middle flex-direction-xs-column">
                                											<div class="col-xs-12 col-sm-6">
                                    											<div class="form-group ma-0">
                                        											<label class="">Fecha Nacimiento</label>
                                        											<div class="input-group date" data-target-input="nearest">
                                        												<div class="form-group">
                                        													<div class='input-group date fechanacimiento'>
                                        														<input type="text" class="form-control"name="Nacimiento" value="<?=$atencion->Nacimiento?>" />
                                        														<span class="input-group-addon">
																									<span class="glyphicon glyphicon-calendar"></span>
                                        														</span>
                                        													</div>
                                        												</div>
                                        											</div>
                                        										</div>
                                											</div>
                                											<div class="col-xs-12 col-sm-6">
                                												<div class="form-group">
                                													<label class="">Edad</label> 
                                            										<input type="text" class="form-control" name="Edad" value="<?=($atencion->Edad)?>">
                                												</div>
                                											</div>
                                										</div>
																		
																	</div>
																	<div class="col-xs-12 col-sm-6">
																		<div class="row flex flex-middle flex-direction-xs-column">
                                											<div class="col-xs-12 col-sm-6">
                                    											<div class="form-group">
                                        											<label class="">Género</label> 
                                        											<select class="form-control" name="Genero">
                                        												<option value="">-- Seleccione --</option>
                                        												<option value="1" <?=($atencion->Genero=="1")?"selected":""?>>Masculino</option>
                                        												<option value="2" <?=($atencion->Genero=="2")?"selected":""?>>Femenino</option>
                                        											</select>
                                        										</div>
                                											</div>
                                											<div class="col-xs-12 col-sm-6">
                                												<div class="form-group flex flex-middle ma-0">
                                            										<label class="flex flex-middle mr-20"><input type="checkbox" class="ma-0" name="Discapacidad" value="1" <?=($atencion->Discapacidad=="1")?"checked":""?>> <span>Discapacitado</span></label>  
                                													<label class="flex flex-middle" id="Gestante" style="display: none!important;"><input type="checkbox" class="ma-0" name="Gestante" value="1" <?=($atencion->Gestante=="1")?"checked":""?>> <span>Gestante</span></label>                                           											
                                												</div>
                                											</div>
                                											<div class="col-xs-12 col-sm-6" id="comboDiscapacitado" style="display: none;">
                                												<label class="">T. Discapacidad</label> 
                                    											<select class="form-control" name="Tipo_Discapacidad">
                                    												<option value="0" <?=($atencion->Discapacidad_Tipo == "0")?"selected":""?>>[N/A]</option>
                                    												<option value="1" <?=($atencion->Discapacidad_Tipo == "1")?"selected":""?>>Intelectual</option>
                                    												<option value="2" <?=($atencion->Discapacidad_Tipo == "2")?"selected":""?>>Visual</option>
                                    												<option value="3" <?=($atencion->Discapacidad_Tipo == "3")?"selected":""?>>Auditiva</option>
                                    												<option value="4" <?=($atencion->Discapacidad_Tipo == "4")?"selected":""?>>Motora</option>
                                    												<option value="5" <?=($atencion->Discapacidad_Tipo == "5")?"selected":""?>>Otros</option>
                                    											</select>
                                											</div>
                                										</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xs-12 col-sm-6">
																		<div class="row flex flex-middle">
                                											<div class="col-xs-12">
                                    											<div class="form-group">
                                        											<label class="">Apoderado</label> 
                                        											<input type="text" class="form-control" name="Apoderado" value="<?=$atencion->Apoderado?>">
                                        										</div>
                                											</div>
                                										</div>
																</div>
                        											<div class="col-xs-12 col-sm-6">
																		<div class="row flex flex-middle flex-direction-xs-column">
                                											<div class="col-xs-12 col-sm-6">
                                    											<div class="form-group paises">
                                        											<label class="">País Procedencia</label>
                                        											<input type="text" class="form-control" name="Pais_Procedencia" >
																					<div id="paises"></div>
                                        										</div>
                                											</div>
                                											<div class="col-xs-12 col-sm-6">
                                												<div class="form-group">
                                													<label class="">L. Residencia</label> 
                                            										<input type="text" class="form-control" name="Lugar_Residencia" value="<?=$atencion->Lugar_Residencia?>">
                                												</div>
                                											</div>
                                										</div>
																	</div>
																</div>
																<div class="clearfix"></div>
																<br />
																<br />
																<h4>EVALUACIÓN DEL PACIENTE</h4>
																<br />
																<div class="row">
																	<div class="col-xs-12">
																	<h4>TE</h4>
																		<div class="row">
																			<div class="col-xs-12 d-flex flex-middle justify-content-between">
    																			<div class="form-group mr-10">
        																			<label class="">Días</label>
        																			<input type="number" class="form-control" min="0" name="Enfermedad_Dias" value="<?=$atencion->Enfermedad_Dias?>" />
        																		</div>
        																		<div class="form-group mr-10">
        																			<label class="">Meses</label>
        																			<input type="number" class="form-control" min="0" name="Enfermedad_Meses" value="<?=$atencion->Enfermedad_Meses?>" />
        																		</div>
        																		<div class="form-group ma-0 mr-10">
        																			<label class="">Fecha y hora inicio de síntomas</label>
        																			<div class="input-group date" data-target-input="nearest">
                                        												<div class="form-group">
                                        													<div class='input-group date datetimepicker'>
                                        														<input type="text" class="form-control"name="Fecha_Hora_Sintomas" value="<?=$atencion->Fecha_Hora_Sintomas?>" />
                                        														<span class="input-group-addon">
																									<span class="glyphicon glyphicon-calendar"></span>
                                        														</span>
                                        													</div>
                                        												</div>
                                        											</div>
        																		</div>
        																		<div class="form-group ma-0 mr-10">
        																			<label class="">Fecha y hora de atención</label>
        																			<div class="input-group date" data-target-input="nearest">
                                        												<div class="form-group">
                                        													<div class='input-group date datetimepicker'>
                                        														<input type="text" class="form-control"name="Fecha_Hora_Atencion" value="<?=$atencion->Fecha_Hora_Atencion?>" />
                                        														<span class="input-group-addon">
																									<span class="glyphicon glyphicon-calendar"></span>
                                        														</span>
                                        													</div>
                                        												</div>
                                        											</div>
        																		</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xs-12">
																		<div class="row">
																			<div class="col-xs-12 col-sm-6 col-md-2 mb-10">
																				<span class="d-flex" id="error_PA">																				
    																				<label class="d-flex flex-middle mr-10">P.A.</label>
    																				<input type="text" class="form-control" name="PA" placeholder="/" value="<?=$atencion->PAS."/".$atencion->PAD?>" />
																				</span>
																			</div>
																			<div class="col-xs-12 col-sm-6 col-md-2 d-flex mb-10">
																				<label class="d-flex flex-middle mr-10">F.C.</label>
																				<input type="text" class="form-control" name="FC" value="<?=$atencion->FC?>" />
																			</div>
																		<div class="col-xs-12 col-sm-6 col-md-2 d-flex mb-10">
																				<label class="d-flex flex-middle mr-10">F.R.</label>
																				<input type="text" class="form-control" name="FR" value="<?=$atencion->FR?>" />
																			</div>
																		<div class="col-xs-12 col-sm-6 col-md-2 d-flex flex-middle mb-10">
																				<label class="d-flex flex-middle mr-10">SO2</label>
																				<input type="text" class="form-control" name="SO2" value="<?=$atencion->SO2?>" /><span class="ml-10">%</span>
																			</div>
																		<div class="col-xs-12 col-sm-6 col-md-2 d-flex flex-middle mb-10">
																				<label class="d-flex flex-middle mr-10">FIO2</label>
																				<input type="text" class="form-control" name="FIO2" value="<?=$atencion->FIO2?>" /><span class="ml-10">%</span>
																			</div>
																		</div>
																	</div>
																</div>
																<br />
																<div class="row">
																<div class="col-xs-12 col-sm-6">
																		<h4>Síntomas Respiratorios</h4>
																		<div class="row flex flex-middle">
                                											<div class="col-xs-12">
                                    											<div class="form-group d-flex flex-middle flex-direction-xs-column">
                                        											<label class="d-flex flex-middle mr-20 w-100-xs"><input type="checkbox" class="ma-0" name="Dificultad_Respiratoria" value="1" <?=($atencion->Dificultad_Respiratoria=="1")?"checked":""?> />Dificultad respiratoria</label>
                                        											<label class="d-flex flex-middle mr-20 w-100-xs"><input type="checkbox" class="ma-0" name="Tos" value="1" <?=($atencion->Tos=="1")?"checked":""?> />Tos</label>
                                        											<label class="d-flex flex-middle mr-20 w-100-xs"><input type="checkbox" class="ma-0" name="Congestión Nasal" value="1" <?=($atencion->Rinorrea=="1")?"checked":""?> />Rinorrea</label>
                                        											<label class="d-flex flex-middle mr-10 w-100-xs"><input type="checkbox" class="ma-0" name="Fiebre" value="1" <?=($atencion->Fiebre=="1")?"checked":""?> />Fiebre</label>
                                        										</div>
                                											</div>
                                										</div>																	
																		<div class="row flex flex-middle">
                                											<div class="col-xs-12">
                                    											<div class="form-group d-flex flex-middle flex-direction-xs-column">
                                        											<label class="d-flex flex-middle mr-20 w-100-xs"><input type="checkbox" class="ma-0" name="alteracion_conciencia" value="1" <?=($atencion->alteracion_conciencia=="1")?"checked":""?> />Alteración de Conciencia</label>
                                        											<label class="d-flex flex-middle mr-10 w-100-xs"><input type="checkbox" class="ma-0" name="dolor_pecho" value="1" <?=($atencion->dolor_pecho=="1")?"checked":""?>/>Dolor de Pecho</label>
                                        										</div>
                                											</div>
                                										</div>	
																	</div>
																<div class="col-xs-12 col-sm-6">
																		<h4>Síntomas Gastrointestinales</h4>
																		<br />
																		<div class="row flex flex-middle">
                                											<div class="col-xs-12">
                                    											<div class="form-group d-flex flex-middle flex-direction-xs-column">
                                        											<label class="d-flex flex-middle mr-20 w-100-xs"><input type="checkbox" class="ma-0" name="Nauseas" value="1" <?=($atencion->Nauseas=="1")?"checked":""?> />Nauseas</label>
                                        											<label class="d-flex flex-middle mr-20 w-100-xs"><input type="checkbox" class="ma-0" name="Vomitos" value="1" <?=($atencion->Vomitos=="1")?"checked":""?> />Vómitos</label>
                                        											<label class="d-flex flex-middle mr-20 w-100-xs"><input type="checkbox" class="ma-0" name="Dolor_Abdominal" value="1" <?=($atencion->Dolor_Abdominal=="1")?"checked":""?> />Dolor abdominal</label>
                                        											<label class="d-flex flex-middle mr-10 w-100-xs"><input type="checkbox" class="ma-0" name="Diarrea" value="1" <?=($atencion->Diarrea=="1")?"checked":""?> />Diarrea</label>
                                        										</div>
                                											</div>
                                										</div>
																	</div>
																
																</div>
																<div class="row mb-10">
																	<div class="col-xs-12">
																		<h4>Síntomas otros</h4>
																		<label>Especificar</label>
																		<input type="text" class="form-control" name="Otros" value="<?=$atencion->Otros?>" />
																	</div>
																</div>
        													</div>
        												</div>
													</div>
													<div class="clearfix"></div>
													<br /> <br />
													</div>
													<div class="col-xs-12 col-sm-10 col-sm-offset-1">
														<div class="row">
															<div class="col-xs-12">
																<div class="row mb-20">														
																	<div class="col-xs-12 col-sm-12">
																		<h4>Laboratorio (RESULTADO SALE POR PAGINA  LA PAGINA OFICIAL DE INS)</h4>
																		<div class="row flex flex-middle">
																			<div class="col-xs-12">
																				<div class="form-group d-flex flex-middle ">
    																				<div class="mt-10 mr-10">
                                            											<label class="">F. Toma muestra</label>
                                            											<div class='input-group date datetimepicker'>
                                    														<input type="text" class="form-control font-12" name="Lab_Fecha_Toma" value="<?=$atencion->Lab_Fecha_Toma?>" />
                                    														<span class="input-group-addon">
																								<span class="glyphicon glyphicon-calendar"></span>
                                    														</span>
                                    													</div>
                                        											</div>
    																				<div class="mt-10 mr-10">
                                            											<label class="">F. Envío Lab.</label>
                                            											<div class='input-group date datetimepicker'>
                                    														<input type="text" class="form-control font-12" name="Lab_Fecha_Envio" value="<?=$atencion->Lab_Fecha_Envio?>" />
                                    														<span class="input-group-addon">
																								<span class="glyphicon glyphicon-calendar"></span>
                                    														</span>
                                    													</div>
                                        											</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<br />
																<div class="row">
																	<div class="col-xs-12 col-sm-12">
																		<h4>DIAGNÓSTICO</h4>
																		<br />
																		<div class="row">
																			<div class="col-xs-12 col-sm-4">
																				<h4>DIAGNÓSTICO 01</h4>
																				<div class="form-group d-flex flex-middle ">
																					<div class="form-group d-flex flex-middle flex-direction-column">
                                    													<div class="w-100">
                                            												<label class=""><input type="checkbox" class="ma-0" name="dx1_covid_01" value="1" <?=($atencion->dx1_covid_01=="1")?"checked":""?>/>NO SOSPECHOSO DE COVID 19</label>
                                            												<label class=""><input type="checkbox" class="ma-0" name="dx1_covid_02" value="1" <?=($atencion->dx1_covid_02=="1")?"checked":""?>/>SOSPECHOSO DE COVID 19 (U 07.2)</label>
                                            												<label class=""><input type="checkbox" class="ma-0" name="dx1_covid_03" value="1" <?=($atencion->dx1_covid_03=="1")?"checked":""?>/>COVID 19 (U 07.1)</label>
                                        												</div>
                                        											</div>
																				</div>
																			</div>
																			<div class="col-xs-12 col-sm-4">
																				<h4>DIAGNÓSTICO 02</h4>
																				<div class="form-group">
																					<div class="form-group">
                                    													<div class="w-100">
                                            												<label class=""><input type="checkbox" class="ma-0" name="dx2_insuficiencia" value="1" <?=($atencion->dx2_insuficiencia=="1")?"checked":""?>/>INSUFICIENCIA RESPIRATORIA</label><br/>
                                            												<label class=""><input type="checkbox" class="ma-0" name="dx2_neumonia" value="1" <?=($atencion->dx2_neumonia=="1")?"checked":""?>/>NEUMONÍA</label><br/>
																							<label class=""><input type="checkbox" class="ma-0" name="dx2_faringitis" value="1" <?=($atencion->dx2_faringitis=="1")?"checked":""?>/>FARINGITIS</label><br/>
																							<label class=""><input type="checkbox" class="ma-0" name="dx2_shock" value="1" <?=($atencion->dx2_shock=="1")?"checked":""?>/>SHOCK</label>
                                        												</div>
                                        											</div>
																				</div>
																			</div>
																			<div class="col-xs-12 col-sm-4">
																				<h4>DIAGNÓSTICO 03</h4>
																				<div class="form-group d-flex flex-middle ">
																					<div class="form-group d-flex flex-middle flex-direction-column">
                                    													<div class="w-100">
                                            												<label class=""><input type="checkbox" class="ma-0" name="dx3_hta" value="1" <?=($atencion->dx3_hta=="1")?"checked":""?>/>HTA</label><br/>
                                            												<label class=""><input type="checkbox" class="ma-0" name="dx3_dm" value="1" <?=($atencion->dx3_dm=="1")?"checked":""?>/>DM</label><br/>
																							<label class=""><input type="checkbox" class="ma-0" name="dx3_obesidad" value="1" <?=($atencion->dx3_obesidad=="1")?"checked":""?>/>OBESIDAD</label><br/>
																							<label class=""><input type="checkbox" class="ma-0" name="dx3_insuficiencia_renal" value="1" <?=($atencion->dx3_insuficiencia_renal=="1")?"checked":""?>/>INSUFICIENCIA RENAL</label><br/>
																							<label class=""><input type="checkbox" class="ma-0" name="dx3_otros" value="1" <?=($atencion->dx3_otros=="1")?"checked":""?>/>OTROS</label>
                                        												</div>
                                        											</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xs-12 col-sm-12">
																		<h4>DESTINO DE ALTA</h4>
																		<br />
																		<div class="row">
																			<div class="col-xs-12 col-sm-3">
																				<div class="form-group d-flex flex-middle ">
																					<div class="form-group d-flex flex-middle flex-direction-column">
                                    													<div class="w-100">
                                            												<label class=""><input type="checkbox" class="ma-0" name="aislamiento" value="1" <?=($atencion->aislamiento=="1")?"checked":""?>/>AISLAMIENTO DOMICILIARIO</label>
                                        												</div>
                                        											</div>
																				</div>
																			</div>
																			<div class="col-xs-12 col-sm-3">
																				<h4>HOSPITALIZACIÓN</h4>
																				<div class="form-group">
																					<div class="form-group">
                                    													<div class="w-100">
                                            												<label class=""><input type="checkbox" class="ma-0" name="hospitalizacion" value="1" <?=($atencion->hospitalizacion=="1")?"checked":""?>/>HOSPITALIZACIÓN</label><br/>
                                            												<label class=""><input type="checkbox" class="ma-0" name="area_interna_01" value="1" <?=($atencion->area_interna_01=="1")?"checked":""?>/>AREA DE EXPANSIÓN INTERNA</label><br/>
																							<label class=""><input type="checkbox" class="ma-0" name="area_externa_01" value="1" <?=($atencion->area_externa_01=="1")?"checked":""?>/>AREA DE EXPANSIÓN EXTERNA</label><br/>
                                        												</div>
                                        											</div>
																				</div>
																			</div>
																			<div class="col-xs-12 col-sm-3">
																				<div class="form-group d-flex flex-middle ">
																					<div class="form-group d-flex flex-middle flex-direction-column">
                                    													<div class="w-100">
                                            												<label class=""><input type="checkbox" class="ma-0" name="shock_trauma" value="1" <?=($atencion->shock_trauma=="1")?"checked":""?>/>SHOCK TRAUMA</label><br/>
                                        												</div>
                                        											</div>
																				</div>
																			</div>
																			<div class="col-xs-12 col-sm-3">
																				<h4>UCI</h4>
																				<div class="form-group d-flex flex-middle ">
																					<div class="form-group d-flex flex-middle flex-direction-column">
                                    													<div class="w-100">
                                            												<label class=""><input type="checkbox" class="ma-0" name="uci" value="1" <?=($atencion->uci=="1")?"checked":""?>/>UCI</label><br/>
                                            												<label class=""><input type="checkbox" class="ma-0" name="area_interna_02" value="1" <?=($atencion->area_interna_02=="1")?"checked":""?>/>AREA DE EXPANSIÓN INTERNA</label><br/>
																							<label class=""><input type="checkbox" class="ma-0" name="area_externa_02" value="1" <?=($atencion->area_externa_02=="1")?"checked":""?>/>AREA DE EXPANSIÓN EXTERNA</label><br/>
                                        												</div>
                                        											</div>
																				</div>
																			</div>
																			<div class="col-xs-12 col-sm-4">
																				<h4>OBSERV. DE EMERGENCIA</h4>
																				<div class="form-group d-flex flex-middle ">
																					<div class="form-group d-flex flex-middle flex-direction-column">
                                    													<div class="w-100">
                                            												<label class=""><input type="checkbox" class="ma-0" name="observacion" value="1" <?=($atencion->observacion=="1")?"checked":""?>/>OBSERVACIÓN</label><br/>
                                            												<label class=""><input type="checkbox" class="ma-0" name="area_interna_03" value="1" <?=($atencion->area_interna_03=="1")?"checked":""?>/>AREA DE EXPANSIÓN INTERNA</label><br/>
																							<label class=""><input type="checkbox" class="ma-0" name="area_externa_03" value="1" <?=($atencion->area_externa_03=="1")?"checked":""?>/>AREA DE EXPANSIÓN EXTERNA</label><br/>
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
													<div class="col-xs-12 text-center">
														<button type="submit" id="btnEventoFinal"
															class="btn btn-primary">Registrar</button>
														<button type="button" id="btnCancelar"
															class="btn btn-default">Cancelar</button>
													</div>
													<div class="col-md-12 text-center" id="cargando"></div>
													</form>
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
			<div class="modal fade" id="tableEnfermedadesModal" tabindex="-1" role="dialog" aria-labelledby="tableEnfermedadesModalLabel" aria-hidden="true">
				<input type="hidden" name="cie10-number">
				<div class="modal-dialog modal-md pt-10" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<div class="table-responsive">
    							<table class="tableEnfermedades table table-striped table-bordered table-sm" cellspacing="0" width="100%">
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
			<div class="modal fade" id="tratamientoModal" tabindex="-1" role="dialog" aria-labelledby="tratamientoModalLabel" style="margin-top: -15px;">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title">Medicamentos</h5>
                  </div>
                  <div class="modal-body text-center">
            		<form id="formRegistrarMedicamento" name="formRegistrarMedicamento" method="post" action="">
        					<input type="hidden" name="id" />
        					<div class="modal-body">
        						<h4 class="text-left">Medicamento</h4>
        						<div class="col-xs-12">
        							<div class="form-group">
        								<label class="col-xs-4 pa-10">Nombre</label>
        								<div class="col-xs-8">
            								<input type="text" class="form-control" name="nombre_medicamento" readonly>
        								</div>
        								<div class="clearfix"></div>
        							</div>
        						</div>
        						<div class="col-xs-12">
        							<div class="form-group">
        								<label class="col-xs-4 pa-10">Und. Med.</label>
        								<div class="col-xs-8">
            								<input type="text" class="form-control" name="unidad_medida" readonly>
        								</div>
        								<div class="clearfix"></div>
        							</div>
        						</div>
        						<div class="col-xs-12">
        							<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#tableMedicamentosModal">Buscar</button>
        						</div>
								<div class="clearfix"></div>
								<br />								
        						<h4 class="text-left">Dosificación</h4>
        						<div class="col-xs-12">
        							<div class="form-group">
        								<label class="col-xs-4 pa-10">Total receta</label>
        								<div class="col-xs-8">
            								<input type="text" class="form-control" name="Total">
        								</div>
        								<div class="clearfix"></div>
        							</div>
        						</div>
        						<div class="col-xs-12">
        							<div class="form-group">
        								<label class="col-xs-4 pa-10">Cantidad</label>
        								<div class="col-xs-8">
            								<input type="text" class="form-control" name="Cantidad">
        								</div>
        								<div class="clearfix"></div>
        							</div>
        						</div>
        						<div class="col-xs-12">
        							<div class="form-group">
        								<label class="col-xs-4 pa-10">Frecuencia</label>
        								<div class="col-xs-8">
            								<select class="form-control" name="Frecuencia">
            									<option value="0">[N/A]</option>
            									<option value="1">C/4H</option>
            									<option value="2">C/6H</option>
            									<option value="3">C/8H</option>
            									<option value="4">C/12H</option>
            									<option value="5">C/24H</option>
            								</select>
        								</div>
        								<div class="clearfix"></div>
        							</div>
        						</div>
        						<div class="col-xs-12">
        							<div class="form-group">
        								<label class="col-xs-4 pa-10">Via</label>
        								<div class="col-xs-8">
            								<select class="form-control" name="Via">
            									<option value="0">[N/A]</option>
            									<option value="1">Oral</option>
            									<option value="2">Sublingual</option>
            									<option value="3">Topica</option>
            									<option value="4">Transdermica</option>
            									<option value="5">Oftalmica</option>
            									<option value="6">Otica</option>
            									<option value="7">Intranasal</option>
            									<option value="8">Inhalatoria</option>
            									<option value="9">Rectal</option>
            									<option value="10">Vaginal</option>
            									<option value="11">Parental</option>
            									<option value="12">Intravenosa</option>
            									<option value="13">Intramuscular</option>
            									<option value="14">Subcutanea</option>
            								</select>
            							</div>
            							<div class="clearfix"></div>
        							</div>
        						</div>
        						<div class="col-xs-12">
        							<div class="form-group">
        								<label class="col-xs-4 pa-10">Observaciones</label>
        								<div class="col-xs-8">
            								<textarea class="form-control" name="Observaciones"></textarea>
            							</div>
            							<div class="clearfix"></div>
        							</div>
        						</div>
        					</div>
        					<div class="modal-footer">
        						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
        						<button class="btn btn-primary" type="submit">Agregar</button>
        					</div>
        				</form>
                  </div>
                </div>
              </div>
            </div>
			<div class="modal fade" id="tableMedicamentosModal" tabindex="-1" role="dialog" aria-labelledby="tableMedicamentosModalLabel" aria-hidden="true">
				<input type="hidden" name="cie10-number">
				<div class="modal-dialog modal-md pt-10" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<div class="table-responsive">
    							<table class="tableMedicamentos table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    								<thead>
    									<tr>
    										<th>C&oacute;digo</th>
    										<th>Descripci&oacute;n</th>
    										<th>Unidad</th>
    									</tr>
    								</thead>
    								<tbody>
    								<?php foreach($medicamentos->result() as $row): ?>
    									<tr>
    										<td><?=$row->id?></td>
    										<td><?=$row->descripcion?></td>
    										<td><?=$row->unidad?></td>
    									</tr>
    								<?php endforeach; ?>
    								</tbody>
    							</table>
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
	<script src="<?=base_url()?>public/js/ofertamovil/editar.js?v=<?=date("his")?>"></script>
	<script>
		var paises = '<?=$paises?>';
		var profesionales = '<?=$profesionales?>';
		editar("<?=base_url()?>", JSON.parse(paises), "<?=$profesional->brigadistas_profesiones_id?>", "<?=$profesional->brigadistas_especialidad_id?>","<?=$atencion->Pais_Procedencia?>", "<?=$atencion->evento_tipo_entidad_atencion_registro_id?>", "<?=$atencion->Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID?>", "<?=$atencion->Genero?>", "<?=$atencion->Destino?>", JSON.parse(profesionales));
	</script>
</body>
</html>