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
	<link rel="stylesheet" href="<?=base_url()?>public/css/brigadistas/nuevo.css?v=<?=date("his")?>" />
  <?php $titulo = "Registrar nuevo Brigadista"; ?>
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
							<li><a href="<?=base_url()?>brigadistas"><span>Brigadistas</span></a></li>
							<li class="active"><span>Nuevo Brigadista</span></li>
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
												<div class="col-xs-12 col-sm-10 col-sm-offset-1">
													<div id="message" class="col-xs-12"></div>
													<div class="col-xs-12 col-md-offset-2 col-md-8 margin-auto">
														<div class="stepwizard">
															<div class="stepwizard-row setup-panel">
																<div class="stepwizard-step">
																	<a href="#step-1" id="backStep1" type="button" class="btn btn-circle active">1</a>
																	<p>Paso 1</p>
																</div>
																<div class="stepwizard-line"></div>
																<div class="stepwizard-step">
																	<a href="#step-2" type="button" class="btn btn-circle disable">2</a>
																	<p>Paso 2</p>
																</div>
															</div>
														</div>
													</div>
													<div class="clearfix"></div>
													<br /> <br />
													<form id="formBrigadista" name="formBrigadista" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
													<div class="row" class="setup-content" id="step-1">
														<div class="col-xs-12 col-md-6">
																<div class="form-group row">
																	<label for="Tipo_Documento_Codigo" class="col-sm-5 col-form-label">Tipo Documento</label>
																	<div class="col-sm-7">
																		<select class="form-control" name="Tipo_Documento_Codigo" id="Tipo_Documento_Codigo">
																		<?php foreach($tipodocumento->result() as $row): ?>
                                                							<option value="<?=$row->Tipo_Documento_Codigo?>"><?=$row->Tipo_Documento_Nombre?></option>
                                                							<?php endforeach; ?>
                                                						</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Número Documento</label>
																	<div class="col-sm-7">
																		<div class="input-group" id="error_numero_documento">
                                											<input id="documento_numero" name="documento_numero" class="form-control" type="text" />
                                											<span class="input-group-btn">
                                												<button type="button" id="btn-buscar" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
                                											</span>
                                										</div>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Apellidos</label>
																	<div class="col-sm-7">
																		<input id="apellidos" name="apellidos" class="form-control" type="text" placeholder="Apellidos" readonly />
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Nombres</label>
																	<div class="col-sm-7">
																		<input id="nombres" name="nombres" class="form-control" type="text" placeholder="Nombres" readonly />
																	</div>
																</div>
																<div class="form-group row">
																	<label for="fechaEvento" class="col-sm-5 col-form-label">Fecha de Nacimiento</label>
																	<div class="col-sm-7">
																		<div class="form-group" id="error_fecha_nacimiento">
																			<div class='input-group date' id='datetimepicker'>
																				<input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" readonly />
																				<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Edad</label>
																	<div class="col-sm-7">
																		<input id="edad" name="edad" class="form-control" type="text" readonly />
																	</div>
																</div>
																<div class="form-group row">
																	<label for="genero" class="col-sm-5 col-form-label">Género</label>
																	<div class="col-sm-7">
																		<select class="form-control" name="genero" id="genero" readonly>
																			<option value="">-- Seleccione --</option>
																			<option value="1">MASCULINO</option>
																			<option value="2">FEMENINO</option>
                                        								</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="estado_civil" class="col-sm-5 col-form-label">Estado Civil</label>
																	<div class="col-sm-7">
																		<select class="form-control" name="estado_civil" id="estado_civil" readonly>
																			<option value="">-- Seleccione --</option>
																			<option value="1">Soltero(a)</option>
																			<option value="2">Casado(a)</option>
																			<option value="3">Viudo(a)</option>
																			<option value="4">Divorciado(a)</option>
																			<option value="5">Conviviente</option>
                                        								</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Email</label>
																	<div class="col-sm-7">
																		<input id="email" name="email" class="form-control" type="email" placeholder="Email" />
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Teléfono fijo</label>
																	<div class="col-sm-7">
																		<input id="telefono_01" name="telefono_01" class="form-control" type="text" />
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Celular</label>
																	<div class="col-sm-7">
																		<input id="telefono_02" name="telefono_02" class="form-control" type="text" />
																	</div>
																</div>
																<div class="form-group row">
																	<label for="estado_civil" class="col-sm-5 col-form-label">Categor&iacute;a</label>
																	<div class="col-sm-7">
																		<select class="form-control" name="Categoria" id="Categoria">
																			<option value="0">[N/A]</option>
																			<option value="1">EQUIPO T&Eacute;NICO</option>
																			<option value="2">BRIGADISTA</option>
																			<option value="3">EQUIPO M&Eacute;DICO DE EMERGENCIA</option>
																			<option value="4">BRIGADISTA / EMT</option>
                                        								</select>
																	</div>
																</div>
														</div>
														<div class="col-xs-12 col-md-6">
																<div class="form-group row">
                                                                    <div id='img_contain'>
                                                                    	<img id="blah" align='middle' src="<?=base_url()?>public/images/brigadistas/camera.png" alt="your image" title=''/>
                                                                    </div>
                                                                    <div class="input-group group-img">
                                                                        <div class="custom-file">
                                                                            <input type="file" id="file" name="file" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon01">
                                                                            <label class="custom-file-label" for="foto">Escoger imagen</label>
                                                                      	</div>
																	</div>
																</div>
																<hr />
																<div class="form-group row">
																	<label for="brigadistas_banco_id" class="col-sm-5 col-form-label">Banco</label>
																	<div class="col-sm-7">
																		<select class="form-control" name="brigadistas_banco_id" id="brigadistas_banco_id">
																		<?php foreach($listaBancos->result() as $row): ?>
                                                							<option value="<?=$row->id?>"><?=$row->banco?></option>
                                                							<?php endforeach; ?>
                                                						</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Número de cuenta</label>
																	<div class="col-sm-7">
																		<input id=numero_cuenta name="numero_cuenta" class="form-control" type="text" />
																	</div>
																</div>
																<hr />
																<div class="form-group row">
    																<label class="col-xs-12">Domicilio</label>
    																<div class="col-xs-12">
    																	<textarea id="domicilio" name="domicilio" class="form-control"></textarea>
    																</div>
    															</div>
																<div class="form-group row">
																	<label class="col-sm-5 col-form-label">Región</label>
																	<div class="col-sm-7">
																		<select class="form-control" name="departamento" id="departamento">
																			<option value="">-- Regi&oacute;n --</option>
                                        								  	<?php foreach($departamentos as $row): ?>
                                        								  	<option value="<?=$row->Codigo_Departamento?>"><?=$row->Nombre?></option>
                                        								  	<?php endforeach; ?>
                                        								</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5 col-form-label">Provincia</label>
																	<div class="col-sm-7">
																		<select class="form-control" name="provincia" id="provincia">
																			<option value="">-- Elija Regi&oacute;n --</option>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5 col-form-label">Distrito</label>
																	<div class="col-sm-7">
																		<select class="form-control" name="distrito" id="distrito">
																			<option value="">-- Elija Provincia --</option>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<h4 class="col-xs-12">Idiomas</h4>
																	<div class="col-xs-12">
																		<div class="row">
																			<div class="col-xs-12 col-sm-4">
    																			<div class="form-check">
                                                                                  <input class="form-check-input" type="checkbox" value="1" name="idioma_ingles" id="idioma_ingles">
                                                                                  <label class="form-check-label" for="idioma_ingles">
                                                                                    INGLÉS
                                                                                  </label>
                                                                                </div>
																			</div>
																			<div class="col-xs-12 col-sm-4">
    																			<div class="form-check">
                                                                                  <input class="form-check-input" type="checkbox" value="1" name="idioma_quechua" id="idioma_quechua">
                                                                                  <label class="form-check-label" for="idioma_quechua">
                                                                                    QUECHUA
                                                                                  </label>
                                                                                </div>
																			</div>
																			<div class="col-xs-12 col-sm-4">
    																			<div class="form-check">
                                                                                  <input class="form-check-input" type="checkbox" value="1" name="idioma_aimara" id="idioma_aimara">
                                                                                  <label class="form-check-label" for="idioma_aimara">
                                                                                    AIMARA
                                                                                  </label>
                                                                                </div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="form-group row">
    																<label class="col-xs-12">Otros idiomas, especifíque</label>
    																<div class="col-xs-12">
    																	<textarea id="idioma_otros" name="idioma_otros" class="form-control"></textarea>
    																</div>
    															</div>
														</div>
														<div class="clearfix"></div>
														<div class="col-xs-12 col-md-10 col-md-offset-1">
															<hr />
															<div class="form-group row">
																<label class="col-xs-12 col-sm-5 col-md-3">Datos Contacto Emergencia</label>
																<div class="col-xs-12 col-sm-7 col-md-9">
																	<input id="contacto_emergencia" name="contacto_emergencia" class="form-control" type="text" placeholder="Nombre" />
																</div>
															</div>
															<div class="form-group row">
																<div class="col-xs-12 col-sm-4">
																	<div class="form-group row">
    																	<label class="col-xs-12 col-sm-5 col-md-5">Teléfono 1</label>
    																	<div class="col-xs-12 col-sm-7 col-md-7">
    																		<input id="telefono_emergencia_01" name="telefono_emergencia_01" class="form-control" type="text" placeholder="Teléfono 1" />
    																	</div>
    																</div>
																</div>
																<div class="col-xs-12 col-sm-4">
																	<div class="form-group row">
    																	<label class="col-xs-12 col-sm-5 col-md-5">Teléfono 2</label>
    																	<div class="col-xs-12 col-sm-7 col-md-7">
    																		<input id="telefono_emergencia_02" name="telefono_emergencia_02" class="form-control" type="text" placeholder="Teléfono 2" />
    																	</div>
    																</div>
																</div>
																<div class="col-xs-12 col-sm-4">
																	<div class="form-group row">
    																	<label class="col-xs-12 col-sm-5 col-md-4">Parentesco</label>
    																	<div class="col-xs-12 col-sm-7 col-md-8">
    																		<select id="parentesco" name="parentesco" class="form-control">
                                                                              <option value="0">[N/A]</option>
                                                                              <option value="1">MADRE</option>
                                                                              <option value="2">PADRE</option>
                                                                              <option value="3">HIJO (A)</option>
                                                                              <option value="4">HERMANO (A)</option>
                                                                              <option value="5">PRIMO (A)</option>
                                                                              <option value="6">ABUELO (A)</option>
                                                                              <option value="7">CONYUGUE</option>
                                                                              <option value="8">AMIGO (A)</option>
                                                                              <option value="9">OTROS</option>
                                                                            </select>
    																	</div>
    																</div>
																</div>
															</div>
														</div>
													</div>
													<div class="setup-content" id="step-2"style="display: none">
														<div class="row">
															<div class="col-xs-12 col-md-6">
																<div class="form-group row">
																	<h4 class="col-xs-12">Vacunas</h4>
																	<div class="col-xs-12">
																		<div class="row">
																			<div class="col-xs-12 col-sm-6">
    																			<div class="form-check">
                                                                                  <input class="form-check-input" type="checkbox" value="1" name="vacuna_tetano" id="vacuna_tetano">
                                                                                  <label class="form-check-label" for="vacuna_tetano">
                                                                                    TÉTANO
                                                                                  </label>
                                                                                </div>
																			</div>
																			<div class="col-xs-12 col-sm-6">
    																			<div class="form-check">
                                                                                  <input class="form-check-input" type="checkbox" value="1" name="vacuna_fiebre_amarilla" id="vacuna_fiebre_amarilla">
                                                                                  <label class="form-check-label" for="vacuna_fiebre_amarilla">
                                                                                    FIEBRE AMARILLA
                                                                                  </label>
                                                                                </div>
																			</div>
																			<div class="col-xs-12 col-sm-6">
    																			<div class="form-check">
                                                                                  <input class="form-check-input" type="checkbox" value="1" name="vacuna_hepatitis_b" id="vacuna_hepatitis_b">
                                                                                  <label class="form-check-label" for="vacuna_hepatitis_b">
                                                                                    HEPATÍTIS B
                                                                                  </label>
                                                                                </div>
																			</div>
																			<div class="col-xs-12 col-sm-6">
    																			<div class="form-check">
                                                                                  <input class="form-check-input" type="checkbox" value="1" name="vacuna_influenza" id="vacuna_influenza">
                                                                                  <label class="form-check-label" for="vacuna_influenza">
                                                                                    INFLUENZA
                                                                                  </label>
                                                                                </div>
																			</div>
																			<div class="col-xs-12 col-sm-6">
    																			<div class="form-check">
                                                                                  <input class="form-check-input" type="checkbox" value="1" name="vacuna_sarampion" id="vacuna_sarampion">
                                                                                  <label class="form-check-label" for="vacuna_sarampion">
                                                                                    SARAMPIÓN
                                                                                  </label>
                                                                                </div>
																			</div>
																			<div class="col-xs-12 col-sm-6">
    																			<div class="form-check">
                                                                                  <input class="form-check-input" type="checkbox" value="1" name="vacuna_papiloma" id="vacuna_papiloma">
                                                                                  <label class="form-check-label" for="vacuna_papiloma">
                                                                                    PAPILOMA HUMANO
                                                                                  </label>
                                                                                </div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="form-group row">
    																<label class="col-xs-12">Otras vacunas, especifíque</label>
    																<div class="col-xs-12">
    																	<textarea id="vacunas_otras" name="vacunas_otras" class="form-control"></textarea>
    																</div>
    															</div>
    															<hr />
																<div class="form-group row">
    																<label class="col-xs-12">Intervenciones quirurgicas</label>
    																<div class="col-xs-12">
    																	<textarea id="intervenciones_quirurgica" name="intervenciones_quirurgica" class="form-control"></textarea>
    																</div>
    															</div>
																<div class="form-group row">
    																<label class="col-xs-12">Alergias a medicamentos y otros</label>
    																<div class="col-xs-12">
    																	<textarea id="alergias" name="alergias" class="form-control"></textarea>
    																</div>
    															</div>
																<div class="form-group row">
    																<label class="col-xs-12">Atencedentes Médicos</label>
    																<div class="col-xs-12">
    																	<textarea id="antecedentes_medicos" name="antecedentes_medicos" class="form-control"></textarea>
    																</div>
    															</div>
															</div>
															<div class="col-xs-12 col-md-6">
																<div class="form-group row">
																	<label for="grupo_sanguineo" class="col-sm-5 col-form-label">Grupo sanguíneo</label>
																	<div class="col-sm-7">
																		<select class="form-control" name="grupo_sanguineo" id="grupo_sanguineo">
																			<option value="0">[N/A]</option>
																			<option value="1">O-</option>
																			<option value="2">O+</option>
																			<option value="3">A-</option>
																			<option value="4">A+</option>
																			<option value="5">B-</option>
																			<option value="6">B+</option>
																			<option value="7">AB-</option>
																			<option value="8">AB+</option>
                                        								</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Talla(mt.)</label>
																	<div class="col-sm-7">
																		<input id="talla" name="talla" class="form-control" type="text" />
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Peso(kg.)</label>
																	<div class="col-sm-7">
																		<input id="peso" name="peso" class="form-control" type="text" />
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Talla casaca</label>
																	<div class="col-sm-7">
																		<input id="talla_casaca" name="talla_casaca" class="form-control" type="text" />
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Talla calzado</label>
																	<div class="col-sm-7">
																		<input id="talla_calzado" name="talla_calzado" class="form-control" type="text" />
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Talla polo</label>
																	<div class="col-sm-7">
																		<input id="talla_polo" name="talla_polo" class="form-control" type="text" />
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-5">Talla pantalón</label>
																	<div class="col-sm-7">
																		<input id="talla_pantalon" name="talla_pantalon" class="form-control" type="text" />
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-xs-12 text-center">
														<button type="submit" id="btnEventoFinal"
															class="btn btn-primary">Siguiente ></button>
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
			<?php $this->load->view("inc/footer"); ?>
			<script src="<?=base_url()?>public/js/moment.min.js"></script>
			<script src="<?=base_url()?>public/js/locale.es.js"></script>
			<script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
		</div>
	</div>
	<script src="<?=base_url()?>public/js/brigadistas/nuevo.js?v=<?=date("his")?>"></script>
	<script>
		nuevo("<?=base_url()?>");
	</script>
</body>
</html>