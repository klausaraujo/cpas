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
	href="<?=base_url()?>public/css/eventos/registroEvento.css?v=<?=date("his")?>" />

  <?php $titulo = "Registrar nuevo evento"; ?>
	<style type="text/css">
</style>

</head>

<body>

	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">

	<?php $this->load->view("inc/navsireed"); ?>

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
							<li><a href="<?=base_url()?>eventos/eventos/lista"><span>Eventos</span></a></li>
							<li class="active"><span>Nuevo Evento</span></li>
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


													<div class="col-12 col-md-offset-2 col-md-8 margin-auto">
														<div class="stepwizard">
															<div class="stepwizard-row setup-panel">
																<div class="stepwizard-step">
																	<a href="#step-1" type="button"
																		class="btn btn-circle active">1</a>
																	<p>Paso 1</p>
																</div>
																<div class="stepwizard-line"></div>
																<div class="stepwizard-step">
																	<a href="#step-2" type="button"
																		class="btn btn-circle disable">2</a>
																	<p>Paso 2</p>
																</div>
															</div>
														</div>
													</div>

													<div class="clearfix"></div>
													<br /> <br />
													<form id="formEvento" name="formEvento" method="POST" action="" autocomplete="off">

														<div class="col-12 col-md-offset-3 col-md-6 margin-auto">
															<input type="hidden" name="Evento_Registro_Numero"
																value="0" />
															<div class="setup-content" id="step-1">

																<div class="form-group row">
																	<label for="tipoEvento" class="col-sm-4 col-form-label">Tipo
																		de Evento</label>
																	<div class="col-sm-8">
																		<select class="form-control" name="tipoEvento"
																			required="required" id="tipoEvento">
																			<option value="">-- Seleccione --</option>
																			  <?php foreach($tipo as $row): ?>
																			  <option value="<?=$row->Evento_Tipo_Codigo?>"><?=$row->Evento_Tipo_Nombre?></option>
																			  <?php endforeach; ?>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="evento" class="col-sm-4 col-form-label">Evento</label>
																	<div class="col-sm-8">
																		<select class="form-control" name="evento" id="evento">
																			<option value="">-- Seleccione Tipo de Evento --</option>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="evento" class="col-sm-4 col-form-label">Detalle
																		Evento</label>
																	<div class="col-sm-8">
																		<select class="form-control" name="eventoDetalle"
																			id="eventoDetalle">
																			<option value="">-- Seleccione Detalle de Evento --</option>
																		</select>
																	</div>
																</div>
																<div class="seismo form-group row">
																	<label class="col-sm-12 col-form-label">Evento
																		Sismo/Terremoto</label>
																	<div>
																		<div class="col-xs-12 col-sm-4" style="margin-bottom: 2px;">
																			<input type="text" class="form-control"
																				name="latitudsismo" id="latitudsismo"
																				placeholder="Latitud" />
																		</div>
																		<div class="col-xs-12 col-sm-4" style="margin-bottom: 2px;">
																			<input type="text" class="form-control"
																				name="longitudsismo" id="longitudsismo"
																				placeholder="Longitud" />
																		</div>
																		<div class="col-xs-12 col-sm-4" style="margin-bottom: 2px;">
																			<input type="text" class="form-control"
																				name="profundidad" id="profundidad"
																				placeholder="Profundidad" />
																		</div>
																	</div>
																	<div>
																		<div class="col-xs-12 col-sm-4" style="margin-bottom: 2px;">
																			<input type="text" class="form-control"
																				name="magnitud" id="magnitud" placeholder="Magnitud" />
																		</div>
																		<div class="col-xs-12 col-sm-8" style="margin-bottom: 2px;">
																			<input type="text" class="form-control"
																				name="intensidad" id="intensidad"
																				placeholder="Intensidad" />
																		</div>
																	</div>
																	<div>
																		<div class="col-xs-12">
																			<input type="text" class="form-control"
																				name="referencia" id="referencia"
																				placeholder="Referencia" />
																		</div>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="fechaEvento"
																		class="col-sm-4 col-form-label">Fecha del Evento</label>
																	<div class="col-sm-8">

																		<div class="form-group">
																			<div class='input-group date' id='datetimepicker'>
																				<input type="text" class="form-control"
																					required="required" name="fechaEvento"
																					id="fechaEvento" onclick="salir()"
																					onkeydown="salir()" /> <span
																					class="input-group-addon"> <span
																					class="glyphicon glyphicon-calendar"></span>
																				</span>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="nivelEmergencia"
																		class="col-sm-4 col-form-label">Nivel de Emergencia</label>
																	<div class="col-sm-8">
																		<select class="form-control" name="nivelEmergencia"
																			id="nivelEmergencia">
																			<option value="">-- Seleccione --</option>
																		  <?php foreach($nivel as $row): ?>
																		  <option value="<?=$row->Evento_Nivel_Codigo?>"><?=$row->Evento_Nivel_Nombre?></option>
																		  <?php endforeach; ?>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="fuenteInicial"
																		class="col-sm-4 col-form-label">Fuente Inicial</label>
																	<div class="col-sm-8">
																		<select class="form-control" name="fuenteInicial"
																			id="fuenteInicial">
																			<option value="">-- Seleccione --</option>
								  <?php foreach($fuente as $row): ?>
								  <option value="<?=$row->Evento_Fuente_Codigo?>"><?=$row->Evento_Fuente_Descripcion?></option>
								  <?php endforeach; ?>
								</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="fuenteInicial"
																		class="col-sm-4 col-form-label">Consolidado de Evento</label>
																	<div class="col-sm-8">
																		<select class="form-control" name="evento_consolidado"
																			id="evento_consolidado">
                                        								  <option value="0">Ninguna Espec&iacute;fica</option>
                                        								  <option value="1">Temporada de Lluvias</option>
                                        								  <option value="2">Temporada de Bajas Temperaturas</option>
                                        								  <option value="3">Sismos de Gran Intensidad</option>
                                        								  <option value="4">Accidentes de Tr&aacute;nsito</option>
                                        								  <option value="5">Incendios Forestales</option>
                                        								  <option value="6">Indendios Urbanos o Industriales</option>
                                        								  <option value="7">Conflictos Sociales</option>
                                        								</select>
																	</div>
																</div>
															<div class="form-group row">
																	<label for="eventoAsociado" class="col-sm-4 col-form-label">Evento Asociado</label>
																	<div class="col-sm-8">
																		<select class="form-control" name="eventoAsociado"
																			required="required" id="eventoAsociado">
																			<option value="0">Ninguna Espec&iacute;fica</option>
																			  <?php foreach($eventoasociado as $row): ?>
																			  <option value="<?=$row->evento_asociado_id?>"><?=$row->evento_asociado_descripcion?></option>
																			  <?php endforeach; ?>
																		</select>
																	</div>
																</div>
															</div>
														</div>

			<?php
                $region = $this->session->userdata("Codigo_Region");
                $idrol = $this->session->userdata("idrol");
                $listaDepartamento = array();
                if ($idrol == "01") {
                    foreach ($departamentos as $row) :
                        $listaDepartamento[] = array(
                            "Codigo_Departamento" => $row->Codigo_Departamento,
                            "Nombre" => $row->Nombre
                        );
                    endforeach
                    ;
                }
                else{
                    foreach ($departamentos as $row) :
                        if ($region == $row->Codigo_Departamento) {
                            $listaDepartamento[] = array(
                                "Codigo_Departamento" => $row->Codigo_Departamento,
                                "Nombre" => $row->Nombre
                            );
                        }
                    endforeach;
                }
                ?>
			<div class="col-12 col-md-offset-2 col-md-8 margin-auto">
															<div class="setup-content" id="step-2"style="display: none">
																<input type="hidden" name="zoom" />
																<input type="hidden" name="hDepartamento" />
																<input type="hidden" name="hProvincia" />
																<input type="hidden" name="hDistrito" />
																<div class="margin-auto">
																	<input id="ubicacion" name="ubicacion"
																		class="controls form-control" type="text"
																		placeholder="direcci&oacute;n, ciudad, departamento" />
																	<div id="map"></div>
																	<input type="hidden" class="" name="latitud"
																		id="latitud" value="" />
                                  <input type="hidden" class=""
																		name="longitud" id="longitud" value="" /> <br />
																	<div class="form-group row">
																		<label class="col-sm-12 col-form-label">Datos del
																			Ubigeo</label>
																		<div class="col-sm-4">
																			<select class="form-control" name="departamento"
																				id="departamento">
																				<option value="">-- Regi&oacute;n --</option>
                      								  <?php foreach($listaDepartamento as $row): ?>
                      								  <option value="<?=$row["Codigo_Departamento"]?>"
                      								        <?=($region==$row["Codigo_Departamento"])?'selected':''?>><?=$row["Nombre"]?></option>
                      								  <?php endforeach; ?>
                      								</select>
																		</div>
																		<div class="col-sm-4">
																			<select class="form-control" name="provincia"
																				id="provincia">
																				<option value="">-- Elija Regi&oacute;n --</option>
																			</select>
																		</div>
																		<div class="col-sm-4">
																			<select class="form-control" name="distrito"
																				id="distrito">
																				<option value="">-- Elija Provincia --</option>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3">Lugar</label>
																		<div class="col-sm-9">
																			<input id="lugar" name="lugar"
																				class="form-control" type="text"
																				placeholder="Ingrese el lugar" />
																		</div>
																	</div>
																	<div class="clearfix"></div>
																	<br />
																	<div class="form-group row">
																		<label for="descripcionGeneral"
																			class="col-sm-3 col-form-label">Descripci&oacute;n
																			General</label>
																		<div class="col-sm-9">
																			<textarea class="form-control" required="required"
																				name="descripcionGeneral" id="descripcionGeneral"
																				rows="3"></textarea>
																		</div>
																	</div>
																	<div class="clearfix"></div>
																	<br />
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
	<script>
		var generalZoom = 13;
	</script>
	<script src="<?=base_url()?>public/js/eventos/initMapRegistro.js"></script>
	<script src="<?=base_url()?>public/js/eventos/registroEvento.js?v=<?=date("his")?>"></script>
	<script>
		registroEvento("<?=base_url()?>","<?=$region?>");
	</script>

	<script src="https://maps.googleapis.com/maps/api/js?key=<?=getenv('MAP_KEY')?>&libraries=places&callback=initMap" async defer></script>

</body>

</html>
