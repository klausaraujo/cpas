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

   <link rel="stylesheet"
	href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet"
	href="<?=base_url()?>public/css/emergencias/registrar.css?v=<?=date("his")?>" />

  <?php $titulo = "Registrar nuevo paciente"; ?>
	<style type="text/css">
</style>

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
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="<?=base_url()?>">Inicio</a></li>
							<li><a href="<?=base_url()?>emergencias"><span>Emergencias</span></a></li>
							<li><a href="javascript:;" class="list-pacientes" rel="<?=$emergencias_registro_id?>"><span>Pacientes</span></a></li>
							<li class="active"><span>Nuevo Paciente</span></li>
						</ol>
					</div>

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

													<div class="col-xs-12 col-md-offset-2 col-md-8 margin-auto">
														<div class="stepwizard">
															<div class="stepwizard-row setup-panel">
																<div class="stepwizard-step">
																	<a href="#step-1" type="button" class="btn btn-circle active">1</a>
																	<p>Paso 1</p>
																</div>
																<div class="stepwizard-line"></div>
																<div class="stepwizard-step">
																	<a href="#step-2" type="button" class="btn btn-circle disable">2</a>
																	<p>Paso 2</p>
																</div>
																<div class="stepwizard-line"></div>
																<div class="stepwizard-step">
																	<a href="#step-3" type="button" class="btn btn-circle disable">3</a>
																	<p>Paso 3</p>
																</div>
																<div class="stepwizard-line"></div>
																<div class="stepwizard-step">
																	<a href="#step-4" type="button" class="btn btn-circle disable">4</a>
																	<p>Paso 4</p>
																</div>
															</div>
														</div>
													</div>

													<div class="clearfix"></div>
													<br /> <br />
													<form id="formPaciente" name="formPaciente" method="POST" action="" autocomplete="off">
														<input type="hidden" id="emergencias_registro_id" name="emergencias_registro_id" value="<?=$emergencias_registro_id?>">
														<div class="col-xs-12 col-md-offset-3 col-md-6 margin-auto">
															<input type="hidden" name="id" value="0" />
															<div class="setup-content" id="step-1">
																<p class="h3">FILIACI&Oacute;N</p>															
																
																<div class="form-group row">
																	<label for="fechaEvento"
																		class="col-sm-4 col-form-label">Inicio de s&iacute;ntomas</label>
																	<div class="col-sm-8">

																		<div class="form-group">
																			<div class='input-group date datetimepicker'>
																				<input type="text" class="form-control" name="fecha_inicio_sintomas" id="fecha_inicio_sintomas"/>
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																		</div>
																	</div>
																</div>															

																<div class="form-group row">
																	<label for="fechaEvento"
																		class="col-sm-4 col-form-label">Ingreso al Hospital</label>
																	<div class="col-sm-8">

																		<div class="form-group">
																			<div class='input-group date datetimepicker'>
																				<input type="text" class="form-control" name="fecha_ingreso_hospital" id="fecha_ingreso_hospital"/>
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																		</div>
																	</div>
																</div>																
																
																<div class="form-group row">
																	<label for="fechaEvento"
																		class="col-sm-4 col-form-label">Ingreo a U.C.I</label>
																	<div class="col-sm-8">

																		<div class="form-group">
																			<div class='input-group date datetimepicker'>
																				<input type="text" class="form-control" name="fecha_ingreso_uci" id="fecha_ingreso_uci"/>
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="form-group row">
    																<div class="col-xs-12 col-sm-5">
                                										<div class="form-group" style="margin-bottom: 5px;">
                                											<label class="">Tipo Documento</label> 
                                											<select class="form-control" name="Tipo_Documento_Codigo" style="font-size: 12px;" aria-invalid="false">
    						                    								<option value="01">D.N.I.</option>
    							                    							<option value="02">R.U.C.</option>
    							                    							<option value="03">CARNET EXT.</option>
    							                    							<option value="04">PASAPORTE</option>
    							                    							<option value="05">P.T.P.</option>
    							                    							<option value="06">[N/A]</option>
    							                    						</select>
                                										</div>
                                									</div>
                            										<div class="col-xs-12 col-sm-7">
                            											<div class="form-group" style="margin-bottom: 5px;">
    																		<label class="">Nro. Documento</label>
                                    										<div class="input-group" style="margin-bottom: 5px;">
                                    											<input type="text" class="form-control" name="Documento_Numero" autocomplete="off">
                                    											<span class="input-group-btn">
                                    												<button type="button" id="btn-buscar" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    											</span>
                                        									</div>
                                    									</div>
                                    								</div>
																</div>																																	
																<div class="form-group row">
																	<label class="col-sm-4">Apellidos</label>
																	<div class="col-sm-8">
																		<input id="lugar" name="apellidos" class="form-control" type="text" readonly>
																	</div>
																</div>
																																																
																<div class="form-group row">
																	<label class="col-sm-4">Nombres</label>
																	<div class="col-sm-8">
																		<input id="lugar" name="nombres" class="form-control" type="text" readonly>
																	</div>
																</div>
																
																<div class="form-group row flex-center">
																	<div class="col-xs-12 col-sm-6">																	
    																	<label>G&eacute;nero</label>
    																	<input class="form-control" name="sexo_v" readonly>
    																	<input type="hidden" name="sexo">                   											
    																	<div class="col-xs-12 col-sm-6 text-right div-gestante" style="display: none;">
                                    										<input type="checkbox" class="form-check-input" id="gestante" name="gestante" value="1">
                                    										<label class="form-check-label" for="">Gestante</label>
                                    									</div>                      											
																	</div>
																	<div class="col-xs-12 col-sm-6">																	
    																	<div class="form-group">
                                											<label class="">Edad</label> 
                                											<input type="number" class="form-control" name="edad" value="" readonly>
                                										</div>  											
																	</div>
																</div>
																
																<div class="form-group row">
																	<div class="col-xs-12 col-sm-6">
    																	<div class="form-group">
                                											<label class="">Peso</label> 
                                											<input type="text" class="form-control" name="peso" value="">
                                										</div>
																	</div>
																	<div class="col-xs-12 col-sm-6">
    																	<div class="form-group">
                                											<label class="">Talla</label> 
                                											<input type="text" class="form-control" name="talla" value="">
                                										</div>
																	</div>
																</div>
																
																<br />
																<p class="h3">ANTECEDENTES</p>
																<p class="h4">Patol&oacute;gicos</p>
																<div class="form-group row flex-center">
																	<div class="check">
                            											<label class=""><input type="checkbox" class="form-control" name="DM" value="1"><span class="space">DM</span></label>
                            										</div>
																	<div class="check">
                            											<label class=""><input type="checkbox" class="form-control" name="HTA" value="1"><span class="space">HTA</span></label>
                            										</div>
																	<div class="check">
                            											<label class=""><input type="checkbox" class="form-control" name="ERC" value="1"><span class="space">ERC</span></label>
                            										</div>
																	<div class="check">
                            											<label class=""><input type="checkbox" class="form-control" name="VIH" value="1"><span class="space">VIH</span></label>
                            										</div>
																	<div class="check">
                            											<label class=""><input type="checkbox" class="form-control" name="LES" value="1"><span class="space">LES</span></label>
                            										</div>
																	<div class="check">
                            											<label class=""><input type="checkbox" class="form-control" name="asma" value="1"><span class="space">Asma</span></label>
                            										</div>
																	<div class="check">
                            											<label class=""><input type="checkbox" class="form-control" name="TBC" value="1"><span class="space">TBC</span></label>
                            										</div>
																	<div class="check">
                            											<label class=""><input type="checkbox" class="form-control" name="NM" value="1"><span class="space">NM</span></label>
                            										</div>
																	<div class="col-xs-12">
                            											<label class="">Otros</label> 
                            											<input type="text" class="form-control" name="otros" value="">
                            										</div>
																</div>
																<br />
																<p class="h4">Enfermedades agudas 3 semanas previas</p>
																<div class="form-group row flex-center vertical-column">
																	<div class="flex-center col-xs-12 col-sm-6">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="EDAs" value="1"><span class="space">EDAS: </span></label>                                											
                            											<label class="flex-center"><span class="space-2">D&iacute;as</span><input class="space number form-control" name="EDAs_dias" type="number" min="0" value="0"></label>
																	</div>
																	<div class="flex-center col-xs-12 col-sm-6">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="resfrio" value="1"><span class="space">Resfrio: </span></label>                                											
                            											<label class="flex-center"><span class="space-2">D&iacute;as</span><input class="space number form-control" name="resfrio_dias" type="number" min="0" value="0"></label>
																	</div>
																	
																	<div class="flex-center col-xs-12 mt-2">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="vacunas" value="1"><span class="space">Vacunas: </span></label>                                											
                            											<label class="flex-center"><span class="space-2">Nombres</span><input class="space fc-3 form-control" name="vacunas_nombres" type="text"></label>
																	</div>
																</div>
																<br />
																<p class="h4">Estancia Previa en Emergencia o &Aacute;rea de Expansi&oacute;n</p>
																<div class="form-group vertical-column">
    																<div class="row">   
    																	<div class="flex-center col-xs-12 col-sm-4 mt-1"><span>Tiempo de estancia:</span></div>
    																	<div class="flex-center col-xs-12 col-sm-4 mt-1">
    																		<input type="number" class="space number form-control" name="emergencia_horas" min="0">
    																		<span class="space-2">Horas</span>
    																	</div>
    																	<div class="flex-center col-xs-12 col-sm-4 mt-1">
    																		<input type="number" class="space number form-control" name="emergencia_dias" min="0">
    																		<span class="space-2">D&iacute;as</span>
    																	</div>
																	</div>
    																<div class="row">    																	
    																	<div class="flex-center col-xs-12 col-sm-8 mt-4">
    																		<span>VMI</span>
    																		<select name="VMI" class="form-control fc-3 space-2">
    																			<option value="0">No</option>
    																			<option value="1">S&iacute;</option>
    																		</select>
    																	</div>
																	</div>
    																<div class="row mt-1">
    																	<div class="flex-center col-xs-12 col-sm-4 mt-1"><span>Tiempo en VMI</span></div>
    																	<div class="flex-center col-xs-12 col-sm-4 mt-1">
    																		<input type="number" class="number form-control" name="VMI_horas" min="0">
    																		<span class="space-2">Horas</span>
    																	</div>
    																	<div class="flex-center col-xs-12 col-sm-4 mt-1">
    																		<input type="number" class="number form-control" name="VMI_dias" min="0">
    																		<span class="space-2">D&iacute;as</span>
    																	</div>
																	</div>
																</div>
																<br/>
																<p class="h3">S&Iacute;NTOMAS PRINCIPALES AL INGRESO AL HOSPITAL CONSIGNADO DE LA HC</p>																
																<div class="form-group row flex-center mb-0">
																	<div class="col-xs-12 col-sm-6">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="dolor_articular" value="1"><span class="space">Dolor Articular</span></label>
                            										</div>
                            										<div class="col-xs-12 col-sm-6">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="dolor_extremidades" value="1"><span class="space">Dolor en Extremidades</span></label>
                            										</div>
                            									</div>
																<div class="form-group row flex-center mb-0">
                            										<div class="col-xs-12 col-sm-6">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="dificultad_respiratoria" value="1"><span class="space">Dificultad Respiratoria</span></label>
                            										</div>
																	<div class="col-xs-12 col-sm-6">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="dificultad_marcha" value="1"><span class="space">Dificultad para la marcha</span></label>
                            										</div>
                            									</div>
                            									<div class="form-group row flex-center">
																	<div class="col-xs-12">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="dismunicion_fuerza_inferior" value="1"><span class="space">Disminuci&oacute; de fuerza muscular miembros inferiores</span></label>
                            										</div>
                            									</div>
																<div class="form-group row flex-center">
																	<div class="col-xs-12">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="dismunicion_fuerza_superior" value="1"><span class="space">Disminuci&oacute; de fuerza muscular miembros superiores</span></label>
                            										</div>
                            									</div>
																<div class="form-group row flex-center">
                            										<div class="col-xs-12 col-sm-6">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="cuadriplejia" value="1"><span class="space">Cuadriplejia</span></label>
                            										</div>
                            									</div>
                            									<br />
																<p class="h3">EXAMEN F&Iacute;SICO AL INGRESO AL HOSPITAL CONSIGNADO EN LA HC</p>
																<div class="form-group row">
																	<label class="col-sm-4">Escala de Hughes</label>
																	<div class="col-sm-8">
																		<select id="escala_hughes" name="escala_hughes" class="form-control">
																			<option>-- Seleccione --</option>
																			<option value="1">I. El paciente deambula en forma ilimitada, tiene capacidad para correr y presenta signos menores de compromiso motor.</option>
																			<option value="2">II. Capacidad de caminar por lo menos 5 metros sin ayudas externas pero con incapacidad para correr</option>
																			<option value="3">III. Capacidad de realizar marcha de por lo menos 5 metros con ayudas externas. (Caminador o asistencia de otra persona)</option>
																			<option value="4">IV. Paciente en cama o en silla sin capacidad para realizar marcha</option>
																			<option value="5">V. Apoyo ventilatorio permanente o por algunas horas al d&iacute;a</option>
																			<option value="6">VI. Muerte</option>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-4">Escala de Glasgow</label>
																	<div class="col-sm-8">
																		<select id="escala_glasgow" name="escala_glasgow" class="form-control">
																			<option value="">-- Elija --</option>
																			<option value="1">1</option>
																			<option value="2">2</option>
																			<option value="3">3</option>
																			<option value="4">4</option>
																			<option value="5">5</option>
																			<option value="6">6</option>
																			<option value="7">7</option>
																			<option value="8">8</option>
																			<option value="9">9</option>
																			<option value="10">10</option>
																			<option value="11">11</option>
																			<option value="12">12</option>
																			<option value="13">13</option>
																			<option value="14">14</option>
																			<option value="15">15</option>
																		</select>
																	</div>
																</div>

															</div>
														</div>

														<div class="col-xs-12 col-md-offset-3 col-md-6 margin-auto">
															<div class="setup-content" id="step-2" style="display: none">
															
																<p class="h3">INGRESO A LA UCI</p>
																<div class="form-group row flex-center vertical-column">
																	<div class="flex-center col-xs-12 col-sm-6">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="uci_habitual" value="1"><span class="space">UCI Habitual</span></label>                                											
                            											<label class="flex-center"><span>N&deg; de Cama</span><input class="space form-control" name="uci_habitual_cama" type="text" min="0" value="0"></label>
																	</div>
																	<div class="flex-center col-xs-12 col-sm-6">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="uci_contingencia" value="1"><span class="space">UCI Contingencia</span></label>                                											
                            											<label class="flex-center"><span>N&deg; de Cama</span><input class="space form-control" name="uci_contingencia_cama" type="text" min="0" value="0"></label>
																	</div>
																</div>

                            									<br />
																<p class="h3">FUNCIONES VITALES AL INGRESO A LA UCI</p>
																<div class="form-group row flex-center vertical-column">
																	<div class="flex-center col-xs-6">
                                											<label class="flex-center text">PAS:</label>                                											
                                											<label class="flex-center"><input type="text" class="space number form-control" name="PAS" value="1"></label>
																	</div>
																	<div class="flex-center col-xs-6">
                                											<label class="flex-center text">PAD:</label>                                											
                                											<label class="flex-center"><input type="text" class="space number form-control" name="PAD" value="1"></label>
																	</div>
																	<div class="flex-center col-xs-6 mt-2">
                                											<label class="flex-center text">FC:</label>                                											
                                											<label class="flex-center"><input class="space number form-control" name="FC" type="text"></label>
																	</div>
																	<div class="flex-center col-xs-6 mt-2">
                                											<label class="flex-center text">FR:</label>                                											
                                											<label class="flex-center"><input class="space number form-control" name="FR" type="text"></label>
																	</div>
																	<div class="flex-center col-xs-6 mt-2">
                                											<label class="flex-center text">SO2:</label>                                											
                                											<label class="flex-center"><input class="space number form-control" name="SO2" type="number" min="0" value="0">%</label>
																	</div>
																	<div class="flex-center col-xs-6 mt-2">
                                											<label class="flex-center text">FIO2:</label>                                											
                                											<label class="flex-center"><input class="space number form-control" name="FIO2" type="number" min="0" value="0">%</label>
																	</div>
																	<div class="flex-center col-xs-6 mt-2">
                                											<label class="flex-center text">T:</label>                                											
                                											<label class="flex-center"><input class="space number form-control" name="T" type="number" min="0" value="0">%</label>
																	</div>
																	<div class="flex-center col-xs-12">
                            											<label class="flex-center"><input type="checkbox" class="form-control" name="vasopresores_inotropicos" value="1"><span class="space">Vasopresores y/o Inotr&oacute;tipos: </span></label>                                											
                            											<label class="flex-center space-2">
                                											<select class="space form-control" name="vasopresores_inotropicos_tipo">
                                												<option value="0">-- Tipos --</option>
                                												<option value="1">Noradrenalina</option>
                                												<option value="2">Adrenalina</option>
                                												<option value="3">Dopamina</option>
                                												<option value="4">Vasopresina</option>
                                												<option value="5">Dobutamina</option>
                                												<option value="6">Desmedetomedina</option>
                                											</select>
                            											</label>
																	</div>
																</div>
                            									<br />
																<p class="h3">EXAMEN F&Iacute;SICO</p>
																<div class="form-group row">
																	<label class="col-sm-4">ROT</label>
																	<div class="col-sm-8">
																		<select id="ROT" name="ROT" class="form-control">
																			<option>-- Seleccione --</option>
																			<option value="1">Arreflexia</option>
																			<option value="2">Iporeflexia</option>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-4">Fuerza Muscular</label>
																	<div class="col-sm-8">
																		<select id="fuerza_muscular" name="fuerza_muscular" class="form-control">
																			<option>-- Seleccione --</option>
																			<option value="1">Disminuido</option>
																			<option value="2">Conservado</option>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-4">Glasgow</label>
																	<div class="col-sm-8">
																		<select id="glasgow" name="glasgow" class="form-control">
																			<option value="">-- Elija --</option>
																			<option value="1">1</option>
																			<option value="2">2</option>
																			<option value="3">3</option>
																			<option value="4">4</option>
																			<option value="5">5</option>
																			<option value="6">6</option>
																			<option value="7">7</option>
																			<option value="8">8</option>
																			<option value="9">9</option>
																			<option value="10">10</option>
																			<option value="11">11</option>
																			<option value="12">12</option>
																			<option value="13">13</option>
																			<option value="14">14</option>
																			<option value="15">15</option>
																		</select>
																	</div>
																</div>
                            									<br />
																<p class="h3">EXAMENES AUXILIARES</p>
																<div class="form-group row mb-0">
																		<div class="col-xs-12 col-sm-5">
    																		<label class="col-sm-9 h4 m-0">Electromiograf&iacute;a</label>
        																	<div class="col-sm-3">
        																		<input type="checkbox" name="electromiografia" value="1">
        																	</div>
																		</div>
    																	<div class="col-xs-12 col-sm-7">
        																	<div class="flex-center form-group">
                                    											<label class="">Fecha</label>
        																		<div class="space-2">
        																			<div class='input-group date datetimepicker'>
        																				<input type="text" name="electromiografia_fecha" class="form-control">
        																				<span class="input-group-addon">
        																					<span class="glyphicon glyphicon-calendar"></span>
        																				</span>
        																			</div>
        																		</div>
                                    										</div>
    																	</div>
    																	<div class="col-xs-12 col-sm-6">
        																	<div class="form-group">
                                    											<label class="">Conclusi&oacute;n 1</label> 
                                    											<input type="text" class="form-control" name="electromiografia_conclusion_1" value="">
                                    										</div>
    																	</div>
    																	<div class="col-xs-12 col-sm-6">
        																	<div class="form-group">
                                    											<label class="">Conclusi&oacute;n 2</label> 
                                    											<input type="text" class="form-control" name="electromiografia_conclusion_2" value="">
                                    										</div>
    																	</div>
																</div>
																
																<div class="form-group row mt-3">
																	<label class="col-xs-12 col-sm-9">Valocidad de conducci&oacute;n nerviosa sensitivo motora</label> 
																	<div class="col-xs-12 col-sm-4">
                                										<input type="number" class="numero form-control" name="electromiografia_velocidad" min="0">
																	</div>
																</div>
																<div class="form-group row">
																	<div class="flex-center col-xs-12 col-sm-4">
                            											<label class="flex-center">Punci&oacute;n lumbar:</label>                                											
                            											<label class="flex-center"><input class="space form-control" name="puncion_lumbar" type="checkbox" value="1"></label>
																	</div>
																	<div class="col-xs-12 col-sm-4">
																		<div class="form-group">
																			<div class='input-group date datetimepicker'>
																				<input type="text" name="puncion_lumbar_fecha" class="form-control">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																		</div>
																	</div>
																	<div class="flex-center col-xs-12 col-sm-4">                                											
                            											<label class="flex-center"><input class="form-control" name="puncion_lumbar_envio" type="checkbox" value="1"></label>
                            											<label class="flex-center space">Enviado INS</label>
																	</div>
																</div>
																
																<div class="form-group row">
																	<div class="flex-center col-xs-12 col-sm-4">
                            											<label class="flex-center">Tipificaci&oacute;n Viral:</label>                                											
                            											<label class="flex-center"><input class="space form-control" name="tipificacion_viral" type="checkbox" value="1"></label>
																	</div>
																	<div class="col-xs-12 col-sm-4">
																		<div class="form-group">
																			<div class='input-group date datetimepicker'>
																				<input type="text" name="tipificacion_viral_fecha" class="form-control">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																		</div>
																	</div>
																	<div class="flex-center col-xs-12 col-sm-4">                                											
                            											<label class="flex-center"><input class="form-control" name="tipificacion_viral_envio" type="checkbox" value="1"></label>
                            											<label class="flex-center space">Enviado INS</label>
																	</div>
																</div>
																
																<div class="form-group row">
																	<div class="flex-center col-xs-12 col-sm-4">
                            											<label class="flex-center">Tipificaci&oacute;n Bacteriana:</label>                                											
                            											<label class="flex-center"><input class="space form-control" name="tipificacion_bacteriana" type="checkbox" value="1"></label>
																	</div>
																	<div class="col-xs-12 col-sm-4">
																		<div class="form-group">
																			<div class='input-group date datetimepicker'>
																				<input type="text" name="tipificacion_bacteriana_fecha" class="form-control">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																		</div>
																	</div>
																	<div class="flex-center col-xs-12 col-sm-4">                                											
                            											<label class="flex-center"><input class="form-control" name="tipificacion_bacteriana_envio" type="checkbox" value="1"></label>
                            											<label class="flex-center space">Enviado INS</label>
																	</div>
																</div>
																
																<div class="form-group row">
																	<div class="flex-center col-xs-12 col-sm-4">
                            											<label class="flex-center">Isopado Orofaringia:</label>                                											
                            											<label class="flex-center"><input class="space form-control" name="isopado_orofaringia" type="checkbox" value="1"></label>
																	</div>
																	<div class="col-xs-12 col-sm-4">
																		<div class="form-group">
																			<div class='input-group date datetimepicker'>
																				<input type="text" name="isopado_orofaringia_fecha" class="form-control">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																		</div>
																	</div>
																	<div class="flex-center col-xs-12 col-sm-4">                                											
                            											<label class="flex-center"><input class="form-control" name="isopado_orofaringia_envio" type="checkbox" value="1"></label>
                            											<label class="flex-center space">Enviado INS</label>
																	</div>
																</div>
																
																<div class="form-group row">
																	<div class="flex-center col-xs-12 col-sm-4">
                            											<label class="flex-center">Examen heces:</label>                                											
                            											<label class="flex-center"><input class="space form-control" name="examen_heces" type="checkbox" value="1"></label>
																	</div>
																	<div class="col-xs-12 col-sm-4">
																		<div class="form-group">
																			<div class='input-group date datetimepicker'>
																				<input type="text" name="examen_heces_fecha" class="form-control">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																		</div>
																	</div>
																	<div class="flex-center col-xs-12 col-sm-4">                                											
                            											<label class="flex-center"><input class="form-control" name="examen_heces_envio" type="checkbox" value="1"></label>
                            											<label class="flex-center space">Enviado INS</label>
																	</div>
																</div>

																<div class="form-group row flex-center">
    																<div class="form-group flex-center col-xs-6 col-sm-4">                               											
                            											<label class="flex-center"><span class="w30">Na</span><input name="Na" class="space number form-control" type="number" min="0" value="1"></label>
    																</div>
    																<div class="form-group flex-center col-xs-6 col-sm-4">                               											
                            											<label class="flex-center"><span class="w30">K</span><input name="K" class="space number form-control" type="number" min="0" value="1"></label>
    																</div>
    																<div class="form-group flex-center col-xs-6 col-sm-4">                               											
                            											<label class="flex-center"><span class="w30">Cl</span><input name="Cl" class="space number form-control" type="number" min="0" value="1"></label>
    																</div>
    																<div class="form-group flex-center col-xs-6 col-sm-4">                               											
                            											<label class="flex-center"><span class="w30">P</span><input name="P" class="space number form-control" type="number" min="0" value="1"></label>
    																</div>
    																<div class="form-group flex-center col-xs-6 col-sm-4">                               											
                            											<label class="flex-center"><span class="w30">Ca+</span><input name="Ca" class="space number form-control" type="number" min="0" value="1"></label>
    																</div>
    															</div>

															</div>
														</div>

														<div class="col-xs-12 col-md-offset-3 col-md-6 margin-auto">
															<div class="setup-content" id="step-3" style="display: none">
															
																<p class="h3">DIAGN&Oacute;STICO (Cie 10)</p>
																<div class="form-group row">
																	<div class="col-xs-12 col-sm-6">
																		<input type="text" class="form-control" name="cie10_1" placeholder="Cie10">
																	</div>
																	<div class="col-xs-6 col-sm-3">
																		<label class="flex-center"><input type="checkbox" class="form-control" name="cie10_1_presuntivo" value="1"><span class="space w30">Presuntivo: </span></label> 
																	</div>
																	<div class="col-xs-6 col-sm-3">
																		<label class="flex-center"><input type="checkbox" class="form-control" name="cie10_1_definitivo" value="1"><span class="space w30">Definitivo: </span></label> 
																	</div>
																</div>
																<div class="form-group row">
																	<div class="col-xs-12 col-sm-6">
																		<input type="text" class="form-control" name="cie10_2" placeholder="Cie10">
																	</div>
																	<div class="col-xs-6 col-sm-3">
																		<label class="flex-center"><input type="checkbox" class="form-control" name="cie10_2_presuntivo" value="1"><span class="space w30">Presuntivo: </span></label> 
																	</div>
																	<div class="col-xs-6 col-sm-3">
																		<label class="flex-center"><input type="checkbox" class="form-control" name="cie10_2_definitivo" value="1"><span class="space w30">Definitivo: </span></label> 
																	</div>
																</div>
																<div class="form-group row">
																	<div class="col-xs-12 col-sm-6">
																		<input type="text" class="form-control" name="cie10_3" placeholder="Cie10">
																	</div>
																	<div class="col-xs-6 col-sm-3">
																		<label class="flex-center"><input type="checkbox" class="form-control" name="cie10_3_presuntivo" value="1"><span class="space w30">Presuntivo: </span></label> 
																	</div>
																	<div class="col-xs-6 col-sm-3">
																		<label class="flex-center"><input type="checkbox" class="form-control" name="cie10_3_definitivo" value="1"><span class="space w30">Definitivo: </span></label> 
																	</div>
																</div>
																<br />

																<p class="h3">TRATAMIENTO</p>
																<div class="form-group">
																	<div class="row">
    																	<div class="col-xs-12  mt-2 col-sm-4">
        																	<label class="col-sm-9">Inmunoglobulina</label>
        																	<div class="col-sm-3">
        																		<input type="checkbox" name="inmunoglobulina" value="1">
        																	</div>
    																	</div>
																		<div class="form-group flex-center col-xs-6 col-sm-4">
                                											<label class="flex-center"><span class="w80">N&deg; Frascos</span><input name="inmunoglobulina_frascos" class="space number form-control" type="number" min="0" value="0"></label>
        																</div>
        																<div class="form-group flex-center col-xs-6 col-sm-4">
                                											<label class="flex-center"><span class="w80">N&deg; D&iacute;as</span><input name="inmunoglobulina_dias" class="space number form-control" type="number" min="0" value="0"></label>
        																</div>
        																<div class="form-group col-xs-12">
        																	<input type="text" class="form-control" name="inmunoglobulina_reacciones" placeholder="Reacciones adversas">
        																</div>
																	</div>
																</div>
																<div class="form-group mt-4">
																	<div class="row">
    																	<div class="col-xs-12  mt-2 col-sm-4">
        																	<label class="col-sm-9">Plasmaf&eacute;resis - Alb&uacute;mica</label>
        																	<div class="col-sm-3">
        																		<input type="checkbox" name="plasmaferesis_albumina" value="1">
        																	</div>
    																	</div>
																		<div class="form-group flex-center col-xs-6 col-sm-4">
                                											<label class="flex-center"><span class="w80">N&deg; Frascos</span><input name="plasmaferesis_albumina_frascos" class="space number form-control" type="number" min="0" value="0"></label>
        																</div>
        																<div class="form-group flex-center col-xs-6 col-sm-4">
                                											<label class="flex-center"><span class="w80">N&deg; Sesiones</span><input name="plasmaferesis_albumina_dias" class="space number form-control" type="number" min="0" value="0"></label>
        																</div>
        																<div class="form-group col-xs-12">
        																	<input type="text" class="form-control" name="plasmaferesis_albumina_reacciones" placeholder="Reacciones adversas">
        																</div>
																	</div>
																</div>
																<div class="form-group mt-4">
																	<div class="row">
																	<div class="col-xs-12 mt-2 col-sm-4">
    																	<label class="col-sm-9">Plasmaf&eacute;resis - PFC</label>
    																	<div class="col-sm-3">
    																		<input type="checkbox" name="plasmaferesis_PFC" value="1">
    																	</div>
																	</div>
																		<div class="form-group flex-center col-xs-6 col-sm-4">
                                											<label class="flex-center"><span class="w80">N&deg; Frascos</span><input name="plasmaferesis_PFC_frascos" class="space number form-control" type="number" min="0" value="0"></label>
        																</div>
        																<div class="form-group flex-center col-xs-6 col-sm-4">
                                											<label class="flex-center"><span class="w80">N&deg; Sesiones</span><input name="plasmaferesis_PFC_dias" class="space number form-control" type="number" min="0" value="0"></label>
        																</div>
        																<div class="form-group col-xs-12">
        																	<input type="text" class="form-control" name="plasmaferesis_PFC_reacciones" placeholder="Reacciones adversas">
        																</div>
																	</div>
																</div>													
															
															</div>
														</div>

														<div class="col-xs-12 col-md-offset-3 col-md-6 margin-auto">
															<div class="setup-content" id="step-4"style="display: none">	
																<p class="h3">ESCALAS Y PROCEDIMIENTOS</p>
																<div class="form-group row">
																	<div class="col-xs-12 col-sm-6">
    																	<div class="form-group">
                                											<label class="">Apache II</label> 
                                											<input type="text" id="Apache_II" name="Apache_II" class="form-control">
                                										</div>
																	</div>
																	<div class="col-xs-12 col-sm-6">
    																	<div class="form-group">
                                											<label class="">SOFA</label> 
																			<select id="SOFA" name="SOFA" class="form-control">
    																			<option value="0">0</option>
    																			<option value="1">1</option>
    																			<option value="2">2</option>
    																			<option value="3">3</option>
    																			<option value="4">4</option>
    																		</select>
                                										</div>
																	</div>
																</div>
																
																<div class="form-group row">
																	<div class="col-xs-12 col-sm-6">
    																	<div class="form-group">
                                											<label class="">Fecha de colocaci&oacute;n CAF</label> 
                                											<div class="form-group">
    																			<div class='input-group date datetimepicker'>
    																				<input type="text" name="fecha_caf" class="form-control">
    																				<span class="input-group-addon">
    																					<span class="glyphicon glyphicon-calendar"></span>
    																				</span>
    																			</div>
																			</div>
                                										</div>
																	</div>
																	<div class="col-xs-12 col-sm-6">
    																	<div class="form-group">
                                											<label class="">Fecha de intubaci&oacute;n</label> 
																			<div class="form-group">
    																			<div class='input-group date datetimepicker'>
    																				<input type="text" name="fecha_intubacion" class="form-control">
    																				<span class="input-group-addon">
    																					<span class="glyphicon glyphicon-calendar"></span>
    																				</span>
    																			</div>
																		</div>
                                										</div>
																	</div>
																</div>
																<br>
																<p class="h3">ESTANCIA EN UCI</p>
																
																<div class="form-group row">
																	<div class="col-xs-12 col-sm-6">
    																	<div class="form-group">
                                											<label class="">N&deg; d&iacute;as UCI</label> 
                                											<input type="number" class="form-control" name="dias_uci" value="">
                                										</div>
																	</div>
																	<div class="col-xs-12 col-sm-6">
    																	<div class="form-group">
                                											<label class="">N&deg; d&iacute;as VMI</label> 
                                											<input type="number" class="form-control" name="dias_VMI" value="">
                                										</div>
																	</div>
																</div>
																
																															
																<div class="form-group row">
																	<div class="col-xs-12 col-sm-6">
    																	<div class="form-group">
                                											<label class="">Modo Ventilatorio</label> 
                                											<select class="form-control" name="modo_ventilatorio">
                                												<option>-- Elija --</option>
                                												<option value="1">SIMV</option>
                                												<option value="2">CPAP</option>
																				<option value="3">PCV</option>
																				<option value="4">SIMV-V</option>
																				<option value="5">SIMV-P</option>
																				<option value="6">Otro</option>
                                											</select>
                                										</div>
																	</div>
																	<div class="col-xs-12 col-sm-6">
    																	<div class="form-group">
                                											<label class="">Fecha</label> 
																			<div class="form-group">
    																			<div class='input-group date datetimepicker'>
    																				<input type="text" class="form-control" name="modo_ventilatorio_fecha">
    																				<span class="input-group-addon">
    																					<span class="glyphicon glyphicon-calendar"></span>
    																				</span>
    																			</div>
    																		</div>
                                										</div>
																	</div>
																</div>
																
																<div class="form-group row">
																	<div class="row">
    																	<label class="col-xs-12 col-sm-4 mt-2">Tiempo de destete</label>
																		<div class="form-group flex-center col-xs-6 col-sm-4">
                                											<label class="flex-center"><span class="w80">Horas</span><input name="destete_horas" class="space number form-control" type="number" min="0" value="0"></label>
        																</div>
        																<div class="form-group flex-center col-xs-6 col-sm-4">
                                											<label class="flex-center"><span class="w80">D&iacute;as</span><input name="destete_dias" class="space number form-control" type="number" min="0" value="0"></label>
        																</div>
																	</div>
																</div>
																
																<div class="form-group row">
																	<div class="flex-center form-group col-xs-12 col-sm-6">
																		<input type="checkbox" name="traqueostomia" value="1"><span class="space">Traqueostomia: </span>
                        												<div class="space-2">
																			<div class='input-group date datetimepicker'>
																				<input type="text" class="form-control" name="traqueostomia_fecha">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																		</div>
																	</div>
																	<div class="flex-center form-group col-xs-12 col-sm-6">
                            											<span>Fecha Extubaci&oacute;n</span>
                        												<div class="space-2">
																			<div class='input-group date datetimepicker'>
																				<input type="text" class="form-control" name="fecha_extubacion">
																				<span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																		</div>
																	</div>
																</div>
																																														
																<div class="form-group row">
																	<label class="col-sm-4">Destino alta UCI</label>
																	<div class="col-sm-8">
																		<select id="destino_alta_uci" name="destino_alta_uci" class="form-control">
																			<option>-- Seleccione --</option>
																			<option value="1">UCIN</option>
																			<option value="2">Hospitalizaci&oacute;n</option>
																		</select>
																	</div>
																</div>
																																																
																<div class="form-group row">
																	<label class="col-sm-4">Condici&oacute;n Paciente</label>
																	<div class="col-sm-8">
																		<select id="condicion_paciente" name="condicion_paciente" class="form-control">
																			<option>-- Seleccione --</option>
																			<option value="1">Fallecido</option>
																			<option value="2">Recuperado</option>
																			<option value="3">Curado</option>
																		</select>
																	</div>
																</div>
																
															</div>
														</div>
														
														<div class="col-xs-12 text-center">
															<button type="submit" id="btnEventoFinal" class="btn btn-primary">Siguiente ></button>
															<button type="button" id="btnPrevious" previous="#step1" class="btn btn-warning disabled">Anterior</button>
															<button type="button" id="btnCancelar" class="btn btn-default">Cancelar</button>
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

			<?php $this->load->view("inc/footer"); ?>
			<script src="<?=base_url()?>public/js/moment.min.js"></script>
			<script src="<?=base_url()?>public/js/locale.es.js"></script>
			<script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>

		</div>

	</div>
	<script src="<?=base_url()?>public/js/emergencias/registrar.js?v=<?=date("his")?>"></script>
	<script>
		registrar("<?=base_url()?>");
	</script>

</body>

</html>
