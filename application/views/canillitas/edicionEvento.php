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
  <?php $titulo = "Editar Evento"; ?>
	<link rel="stylesheet"
	href="<?=base_url()?>public/css/eventos/edicionEvento.css?v=<?=date("his")?>" />

</head>

<body>


	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">

	<?php $this->load->view("inc/navsireed"); ?>

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
							<li><a href="<?=base_url()?>eventos/eventos/lista"><span>Eventos</span></a></li>
							<li class="active"><span>Evento</span></li>
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
										<div class="panel-body pa-25">
											<div class="sm-data-box">
												<div class="container-fluid">


													<div id="message" class="col-xs-12"></div>


													<!--stepwizard-->
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
													<form id="formEvento" name="formEvento" method="POST"
														action="">
														<div class="col-12 col-md-offset-3 col-md-6 margin-auto">
															<input type="hidden" name="Evento_Registro_Numero" value="<?=$eventoregistro->Evento_Registro_Numero?>" />


															<div class="setup-content" id="step-1">

																<div class="form-group row">
																	<label for="tipoEvento" class="col-sm-4 col-form-label">Tipo
																		de Evento</label>
																	<div class="col-sm-8">
																		<select class="form-control" name="tipoEvento"
																			required="required" id="tipoEvento">
																			<option value="">-- Seleccione --</option>
								  <?php

        foreach ($tipo as $row) :
            if ($row->Evento_Tipo_Codigo == $eventoregistro->Evento_Tipo_Codigo) {
                ?>
								  		<option value="<?=$row->Evento_Tipo_Codigo?>" selected><?=$row->Evento_Tipo_Nombre?></option>
								  <?php }else{ ?>
								  		<option value="<?=$row->Evento_Tipo_Codigo?>"><?=$row->Evento_Tipo_Nombre?></option>
								  <?php
            }
        endforeach
        ;
        ?>
								</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="evento" class="col-sm-4 col-form-label">Evento</label>
																	<div class="col-sm-8">
																		<select class="form-control" name="evento" id="evento">
																			<option value="">-- Seleccione --</option>
								   <?php

        foreach ($evento as $row) :
            if ($row->Evento_Codigo == $eventoregistro->Evento_Codigo) {
                ?>
								  		<option value="<?=$row->Evento_Codigo?>" selected><?=$row->Evento_Nombre?></option>
								  <?php }else{ ?>
								  		<option value="<?=$row->Evento_Codigo?>"><?=$row->Evento_Nombre?></option>
								  <?php
            }
        endforeach
        ;
        ?>
								</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="evento" class="col-sm-4 col-form-label">Detalle
																		Evento</label>
																	<div class="col-sm-8">
																		<select class="form-control" name="eventoDetalle"
																			id="eventoDetalle">
																			<option value="">-- Seleccione --</option>
								  <?php

        foreach ($eventodetalle as $row) :
            if ($row->Evento_Detalle_Codigo == $eventoregistro->Evento_Detalle_Codigo) {
                ?>
								  		<option value="<?=$row->Evento_Detalle_Codigo?>" selected><?=$row->Evento_Detalle_Nombre?></option>
								  <?php }else{ ?>
								  		<option value="<?=$row->Evento_Detalle_Codigo?>"><?=$row->Evento_Detalle_Nombre?></option>
								  <?php
            }
        endforeach
        ;
        ?>
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
																				value="<?=$eventoregistro->Evento_Latitud_Sismo?>"
																				placeholder="Latitud" />
																		</div>
																		<div class="col-xs-12 col-sm-4" style="margin-bottom: 2px;">
																			<input type="text" class="form-control"
																				name="longitudsismo" id="longitudsismo"
																				value="<?=$eventoregistro->Evento_Longitud_Sismo?>"
																				placeholder="Longitud" />
																		</div>
																		<div class="col-xs-12 col-sm-4" style="margin-bottom: 2px;">
																			<input type="text" class="form-control"
																				name="profundidad" id="profundidad"
																				value="<?=$eventoregistro->Evento_Profundidad?>"
																				placeholder="Profundidad" />
																		</div>
																	</div>
																	<div>
																		<div class="col-xs-12 col-sm-4" style="margin-bottom: 2px;">
																			<input type="text" class="form-control"
																				name="magnitud" id="magnitud"
																				value="<?=$eventoregistro->Evento_Magnitud?>"
																				placeholder="Magnitud" />
																		</div>
																		<div class="col-xs-12 col-sm-8" style="margin-bottom: 2px;">
																			<input type="text" class="form-control"
																				name="intensidad" id="intensidad"
																				value="<?=$eventoregistro->Evento_Intensidad?>"
																				placeholder="Intensidad" />
																		</div>
																	</div>
																	<div>
																		<div class="col-xs-12">
																			<input type="text" class="form-control"
																				name="referencia" id="referencia"
																				value="<?=$eventoregistro->Evento_Referencia?>"
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
																					id="fechaEvento" /> <span class="input-group-addon">
																					<span class="glyphicon glyphicon-calendar"></span>
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
								  <?php if($row->Evento_Nivel_Codigo==$eventoregistro->Evento_Nivel_Codigo){ ?>
								  <option value="<?=$row->Evento_Nivel_Codigo?>" selected><?=$row->Evento_Nivel_Nombre?></option>
								  <?php }else{ ?>
								  <option value="<?=$row->Evento_Nivel_Codigo?>"><?=$row->Evento_Nivel_Nombre?></option>
								  <?php
            }
        endforeach
        ;
        ?>
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
								  <?php

        foreach ($fuente as $row) :
            if ($row->Evento_Fuente_Codigo == $eventoregistro->Evento_Fuente_Codigo) {
                ?>
								  <option value="<?=$row->Evento_Fuente_Codigo?>" selected><?=$row->Evento_Fuente_Descripcion?></option>
								  <?php }else{ ?>
								  <option value="<?=$row->Evento_Fuente_Codigo?>"><?=$row->Evento_Fuente_Descripcion?></option>
								  <?php
            }
        endforeach
        ;
        ?>
								</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="fuenteInicial"
																		class="col-sm-4 col-form-label">Consolidado de Evento</label>
																	<div class="col-sm-8">
																		<select class="form-control" name="evento_consolidado"
																			id="evento_consolidado">
                                        								  <option value="0" <?=($eventoregistro->evento_consolidado=='0')?'selected':''?>>Ninguna Espec&iacute;fica</option>
                                        								  <option value="1" <?=($eventoregistro->evento_consolidado=='1')?'selected':''?>>Temporada de Lluvias</option>
                                        								  <option value="2" <?=($eventoregistro->evento_consolidado=='2')?'selected':''?>>Temporada de Bajas Temperaturas</option>
                                        								  <option value="3" <?=($eventoregistro->evento_consolidado=='3')?'selected':''?>>Sismos de Gran Intensidad</option>
                                        								  <option value="4" <?=($eventoregistro->evento_consolidado=='4')?'selected':''?>>Accidentes de Tr&aacute;nsito</option>
                                        								  <option value="5" <?=($eventoregistro->evento_consolidado=='5')?'selected':''?>>Incendios Forestales</option>
                                        								  <option value="6" <?=($eventoregistro->evento_consolidado=='6')?'selected':''?>>Indendios Urbanos o Industriales</option>
                                        								  <option value="7" <?=($eventoregistro->evento_consolidado=='7')?'selected':''?>>Conflictos Sociales</option>
                                        								</select>
																	</div>
																</div>
																<div class="form-group row">
																<label for="eventoAsociado" class="col-sm-4 col-form-label">Evento Asociado</label>
																	<div class="col-sm-8">
																		<select class="form-control" name="eventoAsociado"
																			required="required" id="eventoAsociado">
																			<option value="0">Ninguna Espec&iacute;fica</option>
								  <?php

        foreach ($eventoasociado as $row) :
            if ($row->evento_asociado_id == $eventoregistro->evento_asociado_id) {
                ?>
								  		<option value="<?=$row->evento_asociado_id?>" selected><?=$row->evento_asociado_descripcion?></option>
								  <?php }else{ ?>
								  		<option value="<?=$row->evento_asociado_id?>"><?=$row->evento_asociado_descripcion?></option>
								  <?php
            }
        endforeach
        ;
        ?>
								</select>
																	</div>
																</div>
																	</div>
																
															</div>
															

			<?php    $region = $this->session->userdata("Codigo_Region"); 
        			 $idrol = $this->session->userdata("idrol");
        			
        			$listaDepartamento = array();
        			if ($idrol == "01") {
        			    foreach ($departamentos as $row) :
        			    $listaDepartamento[] = array("Codigo_Departamento" => $row->Codigo_Departamento,"Nombre" => $row->Nombre);
        			    endforeach;
        			}
        			else{
        			    foreach ($departamentos as $row) :
        			    
        			    if ($region == $row->Codigo_Departamento) {
        			        $listaDepartamento[] = array("Codigo_Departamento" => $row->Codigo_Departamento,"Nombre" => $row->Nombre);
        			    }
        			    endforeach;
        			}
			
			?>
			<div class="col-12 col-md-offset-2 col-md-8 margin-auto">
				<div class="setup-content" id="step-2" style="display: none">
						<?php
					    $coordenadas = explode(",", $eventoregistro->Evento_Coordenadas);
					  ?>
						<input type="hidden" name="zoom" value="<?=$eventoregistro->zoom?>" />
						<input type="hidden" name="hDepartamento" />
						<input type="hidden" name="hProvincia" />
						<input type="hidden" name="hDistrito" />

					<div class="margin-auto">
						<input id="ubicacion" name="ubicacion"
						class="controls form-control" type="text"
						placeholder="direcci&oacute;n, ciudad, departamento" />
																	<div id="map"></div>
																	<input type="hidden" class="" name="latitud" id="latitud" value="<?=$coordenadas[0]?>" /> 
																	<input type="hidden" class="" name="longitud" id="longitud" value="<?=$coordenadas[1]?>" /> <br />
																	<div class="form-group row">
																		<label class="col-sm-12 col-form-label">Datos del
																			Ubigeo</label>
																		<div class="col-sm-4">
																			<select class="form-control" name="departamento"
																				id="departamento">
																				<option value="">-- Regi&oacute;n --</option>
								  <?php foreach($listaDepartamento as $row): ?>
								  <option value="<?=$row["Codigo_Departamento"]?>" <?=(substr($eventoregistro->Evento_Ubigeo,0,2)==$row["Codigo_Departamento"])?'selected':''?>><?=$row["Nombre"]?></option>
								  <?php endforeach; ?>
								</select>
																		</div>
																		<div class="col-sm-4">
																			<select class="form-control" name="provincia"
																				id="provincia">
																				<option value="">-- Provincia --</option>
								   <?php foreach($provincias as $row): ?>
								  			<option value="<?=$row->Codigo_Provincia?>"<?=(substr($eventoregistro->Evento_Ubigeo,2,2)==$row->Codigo_Provincia)?'selected':''?>><?=$row->Nombre?></option>
								  <?php endforeach; ?>
								</select>
																		</div>

																		<div class="col-sm-4">
																			<select class="form-control" name="distrito"
																				id="distrito">
																				<option value="">-- Distrito --</option>
								   <?php foreach($distritos as $row): ?>
								  <option value="<?=$row->Codigo_Distrito?>" <?=(substr($eventoregistro->Evento_Ubigeo,4,2)==$row->Codigo_Distrito)?'selected':''?>><?=$row->Nombre?></option>
								  <?php endforeach; ?>
								</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-3">Ubicaci&oacute;n</label>
																		<div class="col-sm-9">
																			<input id="lugar" name="lugar"
																				class="form-control" type="text" value="<?=$eventoregistro->Evento_Lugar?>"
																				placeholder="direcci&oacute;n, ciudad, departamento" />
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
																				rows="3"><?=$eventoregistro->Evento_Descripcion?></textarea>
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
														</div>
														<div class="col-md-12 text-center" id="cargando"></div>
													</form>
													<div class="clearfix"></div>


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
			<script
				src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>

		</div>

	</div>

	<script>
		var generalZoom = <?=$eventoregistro->zoom?>;
	</script>
	<script src="<?=base_url()?>public/js/eventos/edicionEvento.js?v=<?=date("his")?>"></script>
	<script>

	var EVENTO_LATITUD = parseFloat("<?=$coordenadas[0]?>");
	var EVENTO_LONGITUD = parseFloat("<?=$coordenadas[1]?>");

	edicionEvento("<?=$eventoregistro->Evento_Formateado?>","<?=base_url()?>","<?=$eventoregistro->Evento_Codigo?>");
		</script>
	<script src="<?=base_url()?>public/js/eventos/initMapEdicion.js"></script>
	<script
		src="https://maps.googleapis.com/maps/api/js?key=<?=getenv('MAP_KEY')?>&libraries=places&callback=initMap"
		async defer></script>

</body>

</html>
