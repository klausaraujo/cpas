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
		
   <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css">

  <?php $titulo = "Registro de IPRESS Afectadas"; ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/entidadSalud.css?v=<?=date("his")?>">

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
							<li class="active"><span>IPRESS</span></li>
						</ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-xs-12">
								<!-- col-sm-8 col-sm-offset-2  -->
								<div class="panel panel-default card-view pa-0">
									<div class="panel-wrapper collapse in">
										<div class="panel-body pa-0">
											<div class="sm-data-box pa-10">
												<div class="container-fluid">

													<div id="message" class="col-xs-12 pt-10"></div>
												
   <?php
$dateTime = explode(" ", $danios->fecha);
?>
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
														<li><a href="javascript:;" class="enlaceDanios" rel="danios">Registrar Da&ntilde;os Generales</a><span><i class="fa fa-home"></i></span></li>
														<li><a href="javascript:;" class="enlaceLesionados" rel="lesionados">Registrar Lesionados y Fallecidos</a><span><i class="fa fa-user"></i></span></li>
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

   <?php if($lista->num_rows()<1){ ?>

   <div class="col-xs-12">
														<a class="a-danios" data-toggle="modal" data-target="#accionesModal">No hay datos de IPRESS afectadas. Haz clic para registrar</a>
													</div>
													<div class="clearfix"></div>
   <?php
} else {
    
    ?>

       <div class="col-xs-12">
														<button class="btn btn-primary" data-toggle="modal"
															data-target="#accionesModal">Registrar nueva IPRESS Afectada</button>
													</div>

													<div class="clearfix"></div>
													<br /> <br />
													<div class="row">
       <?php
    
    $n = 1;
    $last = $lista->last_row();
    $lastID = $last->Evento_Entidad_Salud;
    foreach ($lista->result() as $row) :
        ?>

    <div class="col-xs-4">
															<div class="datos-danio">
																<div class=""
																	style="padding-bottom: 55px; overflow: hidden;">
																	<div class="danios col-xs-12">
																		<input type="hidden" id="a-id" class="d-ID"
																			value="<?=$row->Evento_Entidad_Salud?>" />
																		<div class="col-xs-12 text-left">
																			<br />
																			<?php 
    																			$estado = "Afectado Inoperativo";
    																			if($row->Evento_Entidad_Estado==1) $estado="Afectado Operativo";
																			?>
																			
																			<p><b>Fecha:</b> <?=$row->fechaEES?></p>
																			<p><b>Estado:</b> <?=$estado?></p>
																			<p><b>IPRESS:</b> <?=$row->Nombre?></p>
																			
																			<input type="hidden" id="a-Evento_Registro_Numero" value="<?=$row->Evento_Registro_Numero?>" />
																			<input type="hidden" id="a-fecha" value="<?=$row->fechaEES?>" />
																			<input type="hidden" id="a-Evento_Entidad_Estado" value="<?=$row->Evento_Entidad_Estado?>" />
																			<input type="hidden" id="a-CodEESS" value="<?=$row->CodEESS?>" />
																			<input type="hidden" id="a-CodEESS_Nombre" value="<?=$row->Nombre?>" />																				
																			<input type="hidden" id="a-agua" value="<?=$row->agua?>" />
																			<input type="hidden" id="a-desague" value="<?=$row->desague?>" />
																			<input type="hidden" id="a-energia_electrica" value="<?=$row->energia_electrica?>" />
																			<input type="hidden" id="a-radio" value="<?=$row->radio?>" />
																			<input type="hidden" id="a-conectividad" value="<?=$row->conectividad?>" />
																			<input type="hidden" id="a-fija" value="<?=$row->fija?>" />
																			<input type="hidden" id="a-celular" value="<?=$row->celular?>" />
																			<input type="hidden" id="a-internet" value="<?=$row->internet?>" />
																			<input type="hidden" id="a-techos" value="<?=$row->techos?>" />
																			<input type="hidden" id="a-paredes" value="<?=$row->paredes?>" />
																			<input type="hidden" id="a-pisos" value="<?=$row->pisos?>" />
																			<input type="hidden" id="a-cercos" value="<?=$row->cercos?>" />
																			<input type="hidden" id="a-otros_lugares" value="<?=$row->otros_lugares?>" />
																			<input type="hidden" id="a-inundacion" value="<?=$row->inundacion?>" />
																			<input type="hidden" id="a-colapso" value="<?=$row->colapso?>" />
																			<input type="hidden" id="a-caida" value="<?=$row->caida?>" />
																			<input type="hidden" id="a-goteras" value="<?=$row->goteras?>" />
																			<input type="hidden" id="a-fisuras" value="<?=$row->fisuras?>" />
																			<input type="hidden" id="a-otros_consecuencias" value="<?=$row->otros_consecuencias?>" />
																			<input type="hidden" id="a-emergencia" value="<?=$row->emergencia?>" />
																			<input type="hidden" id="a-banco" value="<?=$row->banco?>" />
																			<input type="hidden" id="a-obstetrico" value="<?=$row->obstetrico?>" />
																			<input type="hidden" id="a-quirurgico" value="<?=$row->quirurgico?>" />
																			<input type="hidden" id="a-uci" value="<?=$row->uci?>" />
																			<input type="hidden" id="a-diagnostico" value="<?=$row->diagnostico?>" />
																			<input type="hidden" id="a-esterilizacion" value="<?=$row->esterilizacion?>" />
																			<input type="hidden" id="a-laboratorio" value="<?=$row->laboratorio?>" />
																			<input type="hidden" id="a-ambulancias" value="<?=$row->ambulancias?>" />
																			<input type="hidden" id="a-farmacia" value="<?=$row->farmacia?>" />
																			<input type="hidden" id="a-consultorios" value="<?=$row->consultorios?>" />
																			<input type="hidden" id="a-otros" value="<?=$row->otros?>" />
																			<input type="hidden" id="a-recuperacion_operatividad" value="<?=$row->fechaRO?>" />
																			<input type="hidden" id="a-continuidad_operativa" value="<?=$row->continuidad_operativa?>" />
																			<input type="hidden" id="a-lugar" value="<?=$row->lugar?>" />
																			<input type="hidden" id="a-observaciones" value="<?=str_replace("\\r\\n", "\n", $row->observaciones)?>" />

																		</div>
																	</div>
																	<div class="col-xs-12 historial">
																		<span style="display: inline-block">Ipress N&deg; <?=$n?></span>

    		<?php //if($lastID==$row->Evento_Entidad_Salud){ ?>
    		<div class="pull-right">
																			<i class="fa fa-trash actionDelete"
																				aria-hidden="true"
																				style="color: #e67d7d; font-size: 20px; padding: 0 5px;"></i>
																		</div>
    		<?php //} ?>
        	<div class="pull-right">
																			<i class="fa fa-pencil-square-o actionEdit"
																				aria-hidden="true"
																				style="color: #6d6b6b; font-size: 20px; padding: 0 5px;"></i>
																		</div>

																	</div>
																</div>
															</div>
															<!-- datos-danio -->
														</div>
														<!-- row registro danios-->

	<?php
        if ($n > 0) {
            if ($n % 3 == 0)
                echo "<div class='clearfix'></div>";
        }
        $n ++;
    endforeach
    ;
}
?>
    </div>
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
			<!-- /container -->

			<!-- Footer -->
			<?php $this->load->view("inc/footer"); ?>
	<script src="<?=base_url()?>public/js/moment.min.js"></script>
			<script src="<?=base_url()?>public/js/locale.es.js"></script>
			<script
				src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
			<!-- /Footer -->


		</div>
		<!-- /Main content -->


	</div>
	<!-- /#wrapper -->


	<!-- Modal Registrar -->
	<div class="modal fade" id="accionesModal" tabindex="-1" role="dialog"
		aria-labelledby="accionesModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" id="registrarTableroModalLabel">Registrar IPRESS Afectadas</h5>

				</div>
				<form id="formRegistrar" name="formRegistrar" action=""
					method="POST" autocomplete="off">
					<div class="modal-body">
						<input type="hidden" name="Evento_Registro_Numero"
							value="<?=$Evento_Registro_Numero?>" /> <input type="hidden"
							id="id" name="id" value="0" />
						<div class="row">

							<div class="col-xs-12 col-sm-3">
								<div class="form-group">
									<label class="">Fecha</label>
									<div class="input-group date" data-target-input="nearest">
										<div class="form-group">
											<div class='input-group date datetimepicker'>
												<input type="text" class="form-control" required="required"
													name="fecha" /> <span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-12 col-sm-3">
								<div class="form-group">
									<label class="">Estado</label> <select class="form-control"
										name="Evento_Entidad_Estado" style="font-size: 12px;">
										<option value="0">-- Seleccione Estado --</option>
										<option value="1">Afectado Operativo</option>
										<option value="2">Afectado Inoperativo</option>
									</select>
								</div>
							</div>

							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="">IPRESS</label>
									<div class="input-group">
										<input type="hidden" name="CodEESS" />
										<input type="text" name="CodEESS_Nombre"
											class="form-control detalle-size" autocomplete="off" readonly />
										<span class="input-group-btn">
											<button type="button" class="btn btn-info detalle-size"
												data-toggle="modal" data-target="#tableEntidadesSaludModal"
												style="color: white">
												<i class="fa fa-search" aria-hidden="true"></i>
											</button>
										</span>
									</div>
								</div>
							</div>

							<div class="col-xs-12">
								<h3 style="margin-bottom: 5px;">Recursos Humanos y
									Log&iacute;sticos</h3>
							</div>

							<div class="col-xs-6 input-modal-xl">
								<strong>1. Servicios B&aacute;sicos de la IPRESS (% Afectado)</strong>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label class="">Agua</label> <input type="text"
												class="form-control" name="agua" value="0" placeholder="#"
												autocomplete="off" />
										</div>
										<div class="form-group one-line">
											<label class="">Desag&uuml;e</label> <input type="text"
												class="form-control" name="desague" value="0" placeholder="#"
												autocomplete="off" />
										</div>
										<div class="form-group one-line">
											<label class="">Energ&iacute;a El&eacute;ctrica</label> <input
												type="text" class="form-control" name="energia_electrica" value="0"
												placeholder="#" autocomplete="off" />
										</div>
										<div class="form-group one-line">
											<label class="">Conectividad</label> <input type="text"
												class="form-control" name="conectividad" value="0" placeholder="#"
												autocomplete="off" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label class="">Radio HF/VHF</label> <input type="text"
												class="form-control" name="radio" value="0" placeholder="#"
												autocomplete="off" />
										</div>
										<div class="form-group one-line">
											<label class="">Telefon&iacute;a Fija</label> <input
												type="text" class="form-control" name="fija" value="0"
												placeholder="#" autocomplete="off" />
										</div>
										<div class="form-group one-line">
											<label class="">Telefon&iacute;a celular</label> <input
												type="text" class="form-control" name="celular" value="0"
												placeholder="#" autocomplete="off" />
										</div>
										<div class="form-group one-line">
											<label class="">Internet</label> <input type="text"
												class="form-control" name="internet" value="0" placeholder="#"
												autocomplete="off" />
										</div>
									</div>
								</div>
							</div>


							<div class="col-xs-12 col-sm-6 input-modal-xl">
								<strong>2. Da&ntilde;os de la Infraestructura de la IPRESS</strong>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label class="">Techos</label> <input type="checkbox" name="techos"
												value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Paredes</label> <input type="checkbox"
												name="paredes" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Pisos</label> <input type="checkbox" name="pisos"
												value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Cercos Perim&eacute;tricos</label> <input
												type="checkbox" name="cercos" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Otros</label> <input type="checkbox" name="otros_lugares"
												value="1" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label class="">Inundaci&oacute;n/Anegamiento</label> <input
												type="checkbox" name="inundacion" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Colapso de estructuras</label> <input
												type="checkbox" name="colapso" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Ca&iacute;da de Elementos</label> <input
												type="checkbox" name="caida" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Goteras/Filtraciones</label> <input
												type="checkbox" name="goteras" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Fisuras</label> <input type="checkbox"
												name="fisuras" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Otros</label> <input type="checkbox" name="otros_consecuencias"
												value="1" />
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>

							<div class="col-xs-12 col-sm-7 input-modal-xl">
								<strong>3. Areas y Servicios Afectados de la IPRESS</strong>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label class="">Emergencia</label> <input type="checkbox"
												name="emergencia" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Banco de Sangre</label> <input
												type="checkbox" name="banco" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Centro Obstetrico</label> <input
												type="checkbox" name="obstetrico" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Centro Quirugico</label> <input
												type="checkbox" name="quirurgico" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">UCI</label> <input type="checkbox" name="uci"
												value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Diagn&oacute;stico po Im&aacute;genes</label>
											<input type="checkbox" name="diagnostico" value="1" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label class="">Esterilizaci&oacute;n</label> <input
												type="checkbox" name="esterilizacion" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Laboratorio</label> <input type="checkbox"
												name="laboratorio" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Servico de Ambulancias</label> <input
												type="checkbox" name="ambulancias" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Farmacia</label> <input type="checkbox"
												name="farmacia" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Consultorios</label> <input type="checkbox"
												name="consultorios" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="otros">Otros</label> <input type="checkbox" name="otros"
												value="1" />
										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-12 col-sm-5 input-modal-xl">
								<strong>4. Fecha de Recuperaci&oacute;n de la Operatividad de la IPRESS</strong>
								<div class="row">
									<div class="col-xs-12">
										<div class="input-group date" data-target-input="nearest">
											<div class="form-group">
												<div class='input-group date datetimepicker2'>
													<input type="text" class="form-control full-with"
														required="required" name="recuperacion_operatividad" /> <span
														class="input-group-addon"> <span
														class="glyphicon glyphicon-calendar"></span>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<br /> <strong>5. Lugar de Contingencia y de Continuidad Operativa de la IPRESS</strong>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label>Continuidad Operativa</label> <input type="checkbox" name="continuidad_operativa" value="1" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											<div class="row">
    											<div class="col-xs-12 col-sm-4 col-md-3"><label class="shortLabel">Lugar</label></div>
    											<div class="col-xs-12 col-sm-8 col-md-9"><input type="text" class="form-control" style="width:100%; height: auto" name="lugar" /></div>
											</div>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<br /> <strong>6. Observaciones</strong>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<textarea class="form-control" id="observaciones" name="observaciones"></textarea>
										</div>
									</div>
								</div>
							</div>


							<div class="clearfix"></div>
							<br />

						</div>

					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</form>
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

	<!-- MODAL BUSQUEDA -->
	<div class="modal fade" id="tableEntidadesSaludModal" tabindex="-1"
		role="dialog" aria-labelledby="tableEntidadesSaludModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document"
			style="padding-top: 10px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" id="registrarTableroModalLabel">Seleccionar Entidad de Salud</h5>

				</div>
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Datos del Ubigeo</label>
						<div class="col-sm-3">
							<select class="form-control" name="departamento" id="departamento" disabled>
								<option value="">-- Regi&oacute;n --</option>
								  <?php foreach($listaDepartamento as $row): ?>
								  <option value="<?=$row["Codigo_Departamento"]?>" <?=($danios->COD_DEPA==$row["Codigo_Departamento"])?"selected":""?>><?=$row["Nombre"]?></option>
								  <?php endforeach; ?>
								</select>
						</div>
						<div class="col-sm-3">
							<select class="form-control" name="provincia" id="provincia" disabled>
								<option value="">-- Provincia --</option>
								<?php foreach($provincias as $row): ?>
								  <option value="<?=$row->Codigo_Provincia?>" <?=($danios->COD_PROV==$row->Codigo_Provincia)?"selected":""?>><?=$row->Nombre?></option>
								  <?php endforeach; ?>
							</select>
						</div>
						<div class="col-sm-3">
							<select class="form-control" name="distrito" id="distrito" enabled>
								<option value="">-- Distrito --</option>
								<?php foreach($distritos as $row): ?>
								  <option value="<?=$row->Codigo_Distrito?>" <?=($danios->COD_DIST==$row->Codigo_Distrito)?"selected":""?>><?=$row->Nombre?></option>
								  <?php endforeach; ?>
							</select>
						</div>
						<div class="col-sm-3">
							<button id="btnFiltrarUbigeo" class="btn btn-info" style="display: show">Buscar IPRESS</button>
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
						<tbody>

						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
	<!-- MODAL -->
	
	<!-- Modal Editar -->
	<div class="modal fade" id="editarModal" tabindex="-1" role="dialog"
		aria-labelledby="editarModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" id="registrarTableroModalLabel">Editar IPRESS</h5>

				</div>
				<form id="formEditar" name="formEditar" action="" method="POST" autocomplete="off">
					<div class="modal-body">
						<input type="hidden" id="Evento_Registro_Numero" name="Evento_Registro_Numero" value="<?=$Evento_Registro_Numero?>" /> 
							<input type="hidden" id="id" name="id" value="0" />
						<div class="row">
						
							<div class="col-xs-3">
								<div class="form-group">
									<label class="">Fecha</label>
									<div class="input-group date" data-target-input="nearest">
										<div class="form-group">
											<div class='input-group date datetimepicker'>
												<input type="text" class="form-control" required="required"
													name="fecha" /> <span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-3">
								<div class="form-group">
									<label class="">Estado</label> <select class="form-control"
										name="Evento_Entidad_Estado" style="font-size: 12px;">
										<option value="0">-- Seleccione Estado --</option>
										<option value="1">Afectado Operativo</option>
										<option value="2">Afectado Inoperativo</option>
									</select>
								</div>
							</div>

							<div class="col-xs-6">
								<div class="form-group">
									<label class="">IPRESS</label>
									<div class="input-group">
										<input type="hidden" name="CodEESS" />
										<input type="text" name="CodEESS_Nombre"
											class="form-control detalle-size" autocomplete="off" readonly />
										<span class="input-group-btn">
											<button type="button" class="btn btn-info detalle-size"
												data-toggle="modal" data-target="#tableEntidadesSaludModal"
												style="color: white">
												<i class="fa fa-search" aria-hidden="true"></i>
											</button>
										</span>
									</div>
								</div>
							</div>

							<div class="col-xs-12">
								<h3 style="margin-bottom: 5px;">Recursos Humanos y
									Log&iacute;sticos</h3>
							</div>

							<div class="col-xs-6 input-modal-xl">
								<strong>1. Servicios B&aacute;sicos (% Afectado)</strong>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label class="">Agua</label> <input type="text"
												class="form-control" name="agua" value="0" placeholder="#"
												autocomplete="off" />
										</div>
										<div class="form-group one-line">
											<label class="">Desag&uuml;e</label> <input type="text"
												class="form-control" name="desague" value="0" placeholder="#"
												autocomplete="off" />
										</div>
										<div class="form-group one-line">
											<label class="">Energ&iacute;a El&eacute;ctrica</label> <input
												type="text" class="form-control" name="energia_electrica" value="0"
												placeholder="#" autocomplete="off" />
										</div>
										<div class="form-group one-line">
											<label class="">Conectividad</label> <input type="text"
												class="form-control" name="conectividad" value="0" placeholder="#"
												autocomplete="off" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label class="">Radio HF/VHF</label> <input type="text"
												class="form-control" name="radio" value="0" placeholder="#"
												autocomplete="off" />
										</div>
										<div class="form-group one-line">
											<label class="">Telefon&iacute;a Fija</label> <input
												type="text" class="form-control" name="fija" value="0"
												placeholder="#" autocomplete="off" />
										</div>
										<div class="form-group one-line">
											<label class="">Telefon&iacute;a celular</label> <input
												type="text" class="form-control" name="celular" value="0"
												placeholder="#" autocomplete="off" />
										</div>
										<div class="form-group one-line">
											<label class="">Internet</label> <input type="text"
												class="form-control" name="internet" value="0" placeholder="#"
												autocomplete="off" />
										</div>
									</div>
								</div>
							</div>


							<div class="col-xs-12 col-sm-6 input-modal-xl">
								<strong>2. Da&ntilde;os de la Infraestructura</strong>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label class="">Techos</label> <input type="checkbox" name="techos"
												value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Paredes</label> <input type="checkbox"
												name="paredes" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Pisos</label> <input type="checkbox" name="pisos"
												value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Cercos Perim&eacute;tricos</label> <input
												type="checkbox" name="cercos" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Otros</label> <input type="checkbox" name="otros_lugares"
												value="1" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label class="">Inundaci&oacute;n/Anegamiento</label> <input
												type="checkbox" name="inundacion" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Colapso de estructuras</label> <input
												type="checkbox" name="colapso" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Ca&iacute;da de Elementos</label> <input
												type="checkbox" name="caida" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Goteras/Filtraciones</label> <input
												type="checkbox" name="goteras" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Fisuras</label> <input type="checkbox"
												name="fisuras" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Otros</label> <input type="checkbox" name="otros_consecuencias"
												value="1" />
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>

							<div class="col-xs-12 col-sm-7 input-modal-xl">
								<strong>3. Areas y Servicios Afectados</strong>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label class="">Emergencia</label> <input type="checkbox"
												name="emergencia" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Banco de Sangre</label> <input
												type="checkbox" name="banco" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Centro Obstetrico</label> <input
												type="checkbox" name="obstetrico" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Centro Quirugico</label> <input
												type="checkbox" name="quirurgico" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">UCI</label> <input type="checkbox" name="uci"
												value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Diagn&oacute;stico po Im&aacute;genes</label>
											<input type="checkbox" name="diagnostico" value="1" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label class="">Esterilizaci&oacute;n</label> <input
												type="checkbox" name="esterilizacion" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Laboratorio</label> <input type="checkbox"
												name="laboratorio" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Servico de Ambulancias</label> <input
												type="checkbox" name="ambulancias" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Farmacia</label> <input type="checkbox"
												name="farmacia" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="">Consultorios</label> <input type="checkbox"
												name="consultorios" value="1" />
										</div>
										<div class="form-group one-line">
											<label class="otros">Otros</label> <input type="checkbox" name="otros"
												value="1" />
										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-12 col-sm-5 input-modal-xl">
								<strong>4. Recuperaci&oacute;n de Operatividad</strong>
								<div class="row">
									<div class="col-xs-12">
										<div class="input-group date" data-target-input="nearest">
											<div class="form-group">
												<div class='input-group date datetimepicker2'>
													<input type="text" class="form-control full-with"
														required="required" name="recuperacion_operatividad" /> <span
														class="input-group-addon"> <span
														class="glyphicon glyphicon-calendar"></span>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<br /> <strong>5. Lugar de Contingencia y de Continuidad Operativa de la IPRESS</strong>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<label>Continuidad Operativa</label> <input type="checkbox" name="continuidad_operativa" value="1" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group one-line">
											<div class="row">
    											<div class="col-xs-12 col-sm-4 col-md-3"><label class="shortLabel">Lugar</label></div>
    											<div class="col-xs-12 col-sm-8 col-md-9"><input type="text" class="form-control" style="width:100%" name="lugar" /></div>
											</div>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<br /> <strong>6. Observaciones</strong>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<textarea class="form-control" id="observaciones" name="observaciones"></textarea>
										</div>
									</div>
								</div>
							</div>


							<div class="clearfix"></div>
							<br />

						</div>

					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>


	<input type="hidden" id="idEliminar" />

	<!-- SCRIPTS -->
	<script src="<?=base_url()?>public/js/eventos/entidadSalud.js?v=<?=date("his")?>"></script>
	<script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>
	<script>
	entidadSalud("<?=base_url()?>","<?=$Evento_Registro_Numero?>","<?=$dateTime[0]?>");

	</script>

</body>

</html>