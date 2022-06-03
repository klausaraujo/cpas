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

  <?php $titulo = "Registro de Acciones Realizadas"; ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/acciones.css?v=<?=date("his")?>">

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
							<li class="active"><span>Acciones realizadas</span></li>
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
														<li><a href="javascript:;" class="enlaceDanios" rel="danios">Registrar Da&ntilde;os Generales</a><span><i class="fa fa-home"></i></span></li>
														<li><a href="javascript:;" class="enlaceLesionados" rel="lesionados">Registrar Lesionados y Fallecidos</a><span><i class="fa fa-user"></i></span></li>
														<li><a href="javascript:;" class="enlaceEntidades" rel="entidadSalud">Registrar IPRESS Afectadas</a><span><i class="fa fa-hospital-o"></i></span></li>
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
														<a class="a-danios" data-toggle="modal" data-target="#accionesModal">No hay datos de acciones. Haz clic para registrar</a>
													</div>
													<div class="clearfix"></div>
   <?php
} else {

    ?>

       												<div class="col-xs-12">
														<button class="btn btn-primary d-block" data-toggle="modal" data-target="#accionesModal">Registrar nueva acci&oacute;n</button>
													</div>

													<div class="clearfix"></div>
													<br /> <br />
													<div class="row">
                                               <?php
                                            
                                                $n = 1;
                                                $last = $lista->last_row();
                                                $lastID = $last->Evento_Acciones_Numero;
                                                foreach ($lista->result() as $row) :
                                                    ?>
                                            
                                                <div class="col-xs-12 col-sm-6 col-md-4">
															<div class="datos-danio">
																<div class=""
																	style="padding-bottom: 55px; overflow: hidden;">
																	<div class="danios col-xs-12">
																		<input type="hidden" class="d-ID" value="<?=$row->Evento_Acciones_Numero?>" />
																		<div class="col-xs-12 text-left">
																			<br />

    		  																<p>
																				<b>Tipo Acci&oacute;n Realizada: </b><?=$row->Tipo_Accion_Descripcion?></p>
																			<p>
																				<b>Acci&oacute;n Realizada Por: </b><?=$row->Tipo_Accion_Entidad_Nombre?></p>
																			<p>
																				<b>Fecha y Hora de la Acci&oacute;n: </b><?=$row->Evento_Acciones_Fecha?></p>
																			<p>
																				<b>Total Brigadistas Movilizados: </b><?=$row->brigadistas?></p>
																			<p>
																				<b>Total EMT Movilizados: </b><?=$row->EMT?></p>
																			<p>
																				<b>Total Personal Salud Movilizado: </b><?=$row->PersonalSalud?></p>
																			<p>
																				<b>Total Ambulancias Movilizadas: </b><?=$row->ambulancias?></p>
																			<p>
																				<b>Total Medic./Insumos Movilizados: </b><?=$row->medicamentos?></p>
																			<p>
																				<b>Total Equipo T&eacute;cnico Movilizado: </b><?=$row->Equipo_Tecnico?></p>

																			<input type="hidden" id="a-ID" value="<?=$row->Evento_Acciones_Numero?>" />
																			<input type="hidden" id="a-Evento_Registro_Numero" value="<?=$row->Evento_Registro_Numero?>" />
																			<input type="hidden" id="a-Evento_Acciones_Fecha" value="<?=$row->Evento_Acciones_Fecha?>" />
																			<input type="hidden" id="a-Tipo_Accion_Codigo" value="<?=$row->Tipo_Accion_Codigo?>" />
																			<input type="hidden" id="a-Tipo_Accion_Entidad_Codigo" value="<?=$row->Tipo_Accion_Entidad_Codigo?>" />
																			<input type="hidden" id="a-Evento_Acciones_Descripcion" value="<?=$row->Evento_Acciones_Descripcion?>" />
																			<input type="hidden" id="a-Evento_Acciones_Region" value="<?=$row->Evento_Acciones_Region?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Minsa" value="<?=$row->Evento_Acciones_Minsa?>" />

                                                                            <input type="hidden" id="a-Evento_Acciones_Emt_i" value="<?=$row->Evento_Acciones_Emt_i?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Emt_ii" value="<?=$row->Evento_Acciones_Emt_ii?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Emt_iii" value="<?=$row->Evento_Acciones_Emt_iii?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Celula_Especializada" value="<?=$row->Evento_Acciones_Celula_Especializada?>" />

                                                                            <input type="hidden" id="a-Evento_Acciones_Minsa_Samu" value="<?=$row->Evento_Acciones_Minsa_Samu?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Salud_Minsa" value="<?=$row->Evento_Acciones_Salud_Minsa?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Essalud" value="<?=$row->Evento_Acciones_Essalud?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Municipalidades_Gores" value="<?=$row->Evento_Acciones_Municipalidades_Gores?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Voluntarios" value="<?=$row->Evento_Acciones_Voluntarios?>" />

                                                                            <input type="hidden" id="a-Evento_Ambulancias_Minsa_Samu" value="<?=$row->Evento_Ambulancias_Minsa_Samu?>" />
                                                                            <input type="hidden" id="a-Evento_Ambulancias_Minsa" value="<?=$row->Evento_Ambulancias_Minsa?>" />
                                                                            <input type="hidden" id="a-Evento_Ambulancias_Essalud" value="<?=$row->Evento_Ambulancias_Essalud?>" />
                                                                            <input type="hidden" id="a-Evento_Ambulancias_Bomberos" value="<?=$row->Evento_Ambulancias_Bomberos?>" />
                                                                            <input type="hidden" id="a-Evento_Ambulancias_Municipalidades_Gores" value="<?=$row->Evento_Ambulancias_Municipalidades_Gores?>" />
                                                                            <input type="hidden" id="a-Evento_Ambulancias_PNP_FFAA" value="<?=$row->Evento_Ambulancias_PNP_FFAA?>" />
                                                                            <input type="hidden" id="a-Evento_Ambulancianas_Privadas" value="<?=$row->Evento_Ambulancianas_Privadas?>" />

                                                                            <input type="hidden" id="a-Evento_Maletin_Emergencias_Desastres" value="<?=$row->Evento_Maletin_Emergencias_Desastres?>" />
                                                                            <input type="hidden" id="a-Evento_Kit_Medicamentos_Insumos" value="<?=$row->Evento_Kit_Medicamentos_Insumos?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Equipo_Biomedicos" value="<?=$row->Evento_Acciones_Equipo_Biomedicos?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Puesto_Comando" value="<?=$row->Evento_Acciones_Puesto_Comando?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Ac_Victimas" value="<?=$row->Evento_Acciones_Ac_Victimas?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Oferta_Movil_i" value="<?=$row->Evento_Acciones_Oferta_Movil_i?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Oferta_Movil_ii" value="<?=$row->Evento_Acciones_Oferta_Movil_ii?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Oferta_Movil_iii" value="<?=$row->Evento_Acciones_Oferta_Movil_iii?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Hospital_Modular" value="<?=$row->Evento_Acciones_Hospital_Modular?>" />
                                                                            <input type="hidden" id="a-Evento_Banio_Quimico_Portatil" value="<?=$row->Evento_Banio_Quimico_Portatil?>" />
                                                                            
                                                                            <input type="hidden" id="a-Evento_Rescatistas" value="<?=$row->Evento_Rescatistas?>" />
                                                                            <input type="hidden" id="a-Evento_Medicos_Tacticos" value="<?=$row->Evento_Medicos_Tacticos?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_PNP_FFAA" value="<?=$row->Evento_Acciones_PNP_FFAA?>" />
                                                                            
                                                                            <input type="hidden" id="a-Equipo_Tecnico_Movilizado_Diresa" value="<?=$row->Equipo_Tecnico_Movilizado_Diresa?>" />
                                                                            <input type="hidden" id="a-Equipo_Tecnico_Movilizado_Red" value="<?=$row->Equipo_Tecnico_Movilizado_Red?>" />
                                                                            <input type="hidden" id="a-Equipo_Tecnico_Movilizado_Diris" value="<?=$row->Equipo_Tecnico_Movilizado_Diris?>" />
                                                                            <input type="hidden" id="a-Equipo_Tecnico_Movilizado_Ipress" value="<?=$row->Equipo_Tecnico_Movilizado_Ipress?>" />
                                                                            <input type="hidden" id="a-Equipo_Tecnico_Movilizado_Digerd" value="<?=$row->Equipo_Tecnico_Movilizado_Digerd?>" />
                                                                            <input type="hidden" id="a-Equipo_Tecnico_Movilizado_Minsa" value="<?=$row->Equipo_Tecnico_Movilizado_Minsa?>" />
                                                                            <input type="hidden" id="a-Equipo_Tecnico_Movilizado_Otros" value="<?=$row->Equipo_Tecnico_Movilizado_Otros?>" />
                                                                            
                                                                            <input type="hidden" id="a-Evento_Acciones_Personal_Emt_i" value="<?=$row->Evento_Acciones_Personal_Emt_i?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Personal_Emt_ii" value="<?=$row->Evento_Acciones_Personal_Emt_ii?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Personal_Emt_iii" value="<?=$row->Evento_Acciones_Personal_Emt_iii?>" />
                                                                            <input type="hidden" id="a-Evento_Acciones_Mochilas_Emergencia" value="<?=$row->Evento_Acciones_Mochilas_Emergencia?>" />

																		</div>
																	</div>
																	<div class="col-xs-12 historial">
																		<span style="display: inline-block">Acci&oacute;n N&deg; <?=$n?></span>

                                                                		<div class="pull-right">
																			<i class="fa fa-trash actionDelete"
																				aria-hidden="true"
																				style="color: #e67d7d; font-size: 20px; padding: 0 5px;"></i>
																		</div>
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
					<h5 class="modal-title" id="registrarTableroModalLabel">Registrar
						Acci&oacute;n</h5>

				</div>
				<form id="formRegistrar" name="formRegistrar" action="" method="POST" autocomplete="off">
					<div class="modal-body">
						<input type="hidden" name="Evento_Registro_Numero" value="<?=$Evento_Registro_Numero?>" />
						<input type="hidden" name="id" value="0" />
						<div class="row">

							<div class="col-xs-12">
								<h3 style="margin-bottom:5px;">Recursos Humanos y Log&iacute;sticos</h3>
							</div>

    							<div class="col-xs-6 col-sm-4 col-sm-2 input-modal-xl">

        								<strong>1. Brigadistas</strong>
        								<div class="form-group one-line">
        									<label class="">Regi&oacute;n / DIRIS</label>
    										<input type="text" class="form-control" name="Evento_Acciones_Region"
        										value="0" placeholder="#" autocomplete="off" />
        								</div>
        								<div class="form-group one-line">
        									<label class="">MINSA Nivel Central</label> <input type="text"
        										class="form-control"
        										name="Evento_Acciones_Minsa" value="0"
        										placeholder="#" autocomplete="off" />
        								</div>
        								<div class="form-group one-line">
        									<label class="">Rescatistas</label> <input type="text"
        										class="form-control"
        										name="Evento_Rescatistas" value="0"
        										placeholder="#" autocomplete="off" />
        								</div>
        								<div class="form-group one-line">
        									<label class="">M&eacute;dicos T&aacute;cticos FF.AA.</label> <input type="text" class="form-control" name="Evento_Medicos_Tacticos" value="0" placeholder="#" autocomplete="off" />
        								</div>

    							</div>

    							<div class="col-xs-6 col-sm-4 col-sm-2 input-modal-xl">
									<strong>2. Equipos M&eacute;dicos de Emergencia(E.M.T.)</strong>
    								<div class="form-group one-line">
    									<label class="">E.M.T. I</label>
    									<input type="text"
    										class="form-control"
    										name="Evento_Acciones_Emt_i" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="form-group one-line">
    									<label class="">E.M.T. II</label>
    									<input type="text"
    										class="form-control"
    										name="Evento_Acciones_Emt_ii" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="form-group one-line">
    									<label class="">E.M.T. III</label>
    									<input type="text"
    										class="form-control"
    										name="Evento_Acciones_Emt_iii" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="form-group one-line">
    									<label class="">C&eacute;lula Especializada</label>
    									<input type="text"
    										class="form-control"
    										name="Evento_Acciones_Celula_Especializada" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
        					</div>

							<div class="col-xs-6 col-sm-4 col-sm-2 input-modal-xl">
								<strong>3. Personal de Salud</strong>
								<div class="form-group one-line">
									<label class="">SAMU - MINSA</label>
									<input type="text" class="form-control"
										name="Evento_Acciones_Minsa_Samu" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">IPRESS - MINSA</label>
									<input type="text" class="form-control"
										name="Evento_Acciones_Salud_Minsa" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">ESSALUD</label> <input type="text"
										class="form-control"
										name="Evento_Acciones_Essalud" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">Muni./GORES</label>
									<input type="text" class="form-control"
										name="Evento_Acciones_Municipalidades_Gores" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">Otros Voluntarios</label>
									<input type="text" class="form-control"
										name="Evento_Acciones_Voluntarios" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">Sanidad PNP/FF.AA.</label>
									<input type="text" class="form-control"
										name="Evento_Acciones_PNP_FFAA" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">E.M.T. I</label>
									<input type="text" class="form-control" name="Evento_Acciones_Personal_Emt_i" value="0" placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">E.M.T. II</label>
									<input type="text" class="form-control" name="Evento_Acciones_Personal_Emt_ii" value="0" placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">E.M.T. III</label>
									<input type="text" class="form-control" name="Evento_Acciones_Personal_Emt_iii" value="0" placeholder="#" autocomplete="off" />
								</div>
							</div>

							<div class="col-xs-6 col-sm-4 col-sm-2 input-modal-xl">
								<strong>4. Ambulancias</strong>
								<div class="form-group one-line">
									<label class="">SAMU - MINSA</label>
									<input type="text" class="form-control"
										name="Evento_Ambulancias_Minsa_Samu" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">IPRESS - MINSA</label>
									<input type="text" class="form-control"
										name="Evento_Ambulancias_Minsa" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">ESSALUD</label> <input type="text"
										class="form-control"
										name="Evento_Ambulancias_Essalud" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">Muni./GORES</label>
									<input type="text" class="form-control"
										name="Evento_Ambulancias_Municipalidades_Gores" value="0"
										placeholder="#" autocomplete="off" />
								</div>
                                <div class="form-group one-line">
									<label class="">Bomberos</label> <input type="text"
										class="form-control"
										name="Evento_Ambulancias_Bomberos" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								
								<div class="form-group one-line">
									<label class="">Sanidad PNP/FF.AA.</label>
									<input type="text" class="form-control"
										name="Evento_Ambulancias_PNP_FFAA" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">Privadas</label>
									<input type="text" class="form-control"
										name="Evento_Ambulancianas_Privadas" value="0"
										placeholder="#" autocomplete="off" />
								</div>
							</div>
							<div class="col-xs-12 col-sm-8 col-sm-4 input-modal-xl">
								<strong>5. Medicamentos e Insumos</strong>
    							<div class="row">
    								<div class="col-sm-6 col-xs-6">
        								<div class="form-group one-line">
        									<label class="">M.E.D.<a href="#" data-toggle="tooltip"
        										data-placement="top" title="Malet&iacute;n para Emergencias y Desastres"> <i
        											class="fa fa-info-circle" aria-hidden="true"></i></a></label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Maletin_Emergencias_Desastres" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">K.M.I.<a href="#" data-toggle="tooltip"
        										data-placement="top" title="Kits de Medicamentos e Insumos"> <i
        											class="fa fa-info-circle" aria-hidden="true"></i></a></label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Kit_Medicamentos_Insumos" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Equipos Biom&eacute;dicos</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Equipo_Biomedicos" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Puesto de Comando</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Puesto_Comando" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">A.C. V&iacute;ctimas</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Ac_Victimas" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Mochila de Emergencia</label>
        									<input type="text" class="form-control" name="Evento_Acciones_Mochilas_Emergencia" value="0" placeholder="#" autocomplete="off" />
        								</div>
        							</div>

        						<div class="col-sm-6 col-xs-6">
        								<div class="form-group one-line">
        									<label class="">Oferta M&oacute;vil Tipo I</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Oferta_Movil_i" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Oferta M&oacute;vil Tipo II</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Oferta_Movil_ii" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Oferta M&oacute;vil Tipo III</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Oferta_Movil_iii" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Hospital Modular</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Hospital_Modular" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Ba&ntilde;o Qu&iacute;mico Port&aacute;til</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Banio_Quimico_Portatil" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        							</div>
        						</div>
							</div>
							<div class="clearfix"></div>
							<br />
							<div class="col-xs-12 input-modal-xl">
								<strong>6. Equipo t&eacute;cnico movilizado</strong>
								<div class="row">
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">DIRESA - GERESA</label>
    									<input type="text" class="form-control"
    										name="Equipo_Tecnico_Movilizado_Diresa" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">RED</label>
    									<input type="text" class="form-control"
    										name="Equipo_Tecnico_Movilizado_Red" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">DIRIS</label> <input type="text"
    										class="form-control"
    										name="Equipo_Tecnico_Movilizado_Diris" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">IPRESS</label> <input type="text"
    										class="form-control"
    										name="Equipo_Tecnico_Movilizado_Ipress" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">DIGERD</label>
    									<input type="text" class="form-control"
    										name="Equipo_Tecnico_Movilizado_Digerd" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">MINSA Central</label>
    									<input type="text" class="form-control"
    										name="Equipo_Tecnico_Movilizado_Minsa" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">Otros</label>
    									<input type="text" class="form-control"
    										name="Equipo_Tecnico_Movilizado_Otros" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
								</div>
							</div>

							<div class="clearfix"></div>
							<br />
							<div class="col-xs-12 col-sm-6 col-md-4">
								<div class="form-group">
									<label class="">Fecha acci&oacute;n</label>
									<div class="input-group date" data-target-input="nearest">
										<div class="form-group">
											<div class='input-group date datetimepicker'>
												<input type="text" class="form-control" required="required"
													 name="Evento_Acciones_Fecha" />
												<span class="input-group-addon"> <span
													class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4">
								<div class="form-group">
									<label class="">Tipo de acci&oacute;n Realiza:</label>
									<select	class="form-control" name="Tipo_Accion_Codigo"
										style="font-size: 12px;">
										<option value="">-- Seleccione --</option>
            							<?php foreach($tipoaccion->result() as $row): ?>
            							<option value="<?=$row->Tipo_Accion_Codigo?>"><?=$row->Tipo_Accion_Descripcion?></option>
            							<?php endforeach; ?>
            						</select>
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4">
								<div class="form-group">
									<label class="">Acci&oacute;n Realizada Por:</label> <select
										class="form-control" name="Tipo_Accion_Entidad_Codigo"
										style="font-size: 12px;">
										<option value="">-- Seleccione Tipo acci&oacute;n --</option>
									</select>
								</div>
							</div>

							<div class="col-xs-12">
								<div class="form-group">
									<label class="">Detalle de Acciones Realizadas:</label>
									<textarea rows="2" class="form-control"
										name="Evento_Acciones_Descripcion"></textarea>
								</div>
							</div>

						</div>

					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-basic d-block" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary d-block">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

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
					<h5 class="modal-title" id="editarTableroModalLabel">Editar Acci&oacute;n</h5>

				</div>
				<form id="formEditar" name="formEditar" action="" method="POST" autocomplete="off">
					<div class="modal-body">
						<input type="hidden" id="Evento_Registro_Numero" name="Evento_Registro_Numero" value="<?=$Evento_Registro_Numero?>" /> 
						<input type="hidden" id="id" name="id" value="0" />
						<div class="row">

							<div class="col-xs-12">
								<h3 style="margin-bottom:5px;">Recursos Humanos y Log&iacute;sticos</h3>
							</div>

    							<div class="col-xs-6 col-sm-2 input-modal-xl">

        								<strong>1. Brigadistas</strong>
        								<div class="form-group one-line">
        									<label class="">Regi&oacute;n / DIRIS</label>
    										<input type="text" class="form-control" name="Evento_Acciones_Region" id="Evento_Acciones_Region"
        										value="0" placeholder="#" autocomplete="off" />
        								</div>
        								<div class="form-group one-line">
        									<label class="">MINSA Nivel Central</label> <input type="text"
        										class="form-control"
        										name="Evento_Acciones_Minsa" id="Evento_Acciones_Minsa" value="0"
        										placeholder="#" autocomplete="off" />
        								</div>
        								<div class="form-group one-line">
        									<label class="">Rescatistas</label> <input type="text"
        										class="form-control"
        										name="Evento_Rescatistas" id="Evento_Rescatistas" value="0"
        										placeholder="#" autocomplete="off" />
        								</div>
        								<div class="form-group one-line">
        									<label class="">M&eacute;dicos T&aacute;cticos FF.AA.</label> <input type="text"
        										class="form-control"
        										name="Evento_Medicos_Tacticos" id="Evento_Medicos_Tacticos" value="0" placeholder="#" autocomplete="off" />
        								</div>

    							</div>


    							<div class="col-xs-6 col-sm-2 input-modal-xl">
									<strong>2. Equipos M&eacute;dicos de Emergencia(E.M.T.)</strong>
    								<div class="form-group one-line">
    									<label class="">E.M.T. I</label>
    									<input type="text"
    										class="form-control"
    										name="Evento_Acciones_Emt_i" id="Evento_Acciones_Emt_i" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="form-group one-line">
    									<label class="">E.M.T. II</label>
    									<input type="text"
    										class="form-control"
    										name="Evento_Acciones_Emt_ii" id="Evento_Acciones_Emt_ii" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="form-group one-line">
    									<label class="">E.M.T. III</label>
    									<input type="text"
    										class="form-control"
    										name="Evento_Acciones_Emt_iii" id="Evento_Acciones_Emt_iii" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="form-group one-line">
    									<label class="">C&eacute;lula Especializada</label>
    									<input type="text"
    										class="form-control"
    										name="Evento_Acciones_Celula_Especializada" id="Evento_Acciones_Celula_Especializada" value="0"
    										placeholder="#" autocomplete="off" />
    								</div>
        					</div>

							<div class="col-xs-6 col-sm-2 input-modal-xl">
								<strong>3. Personal de Salud</strong>
								<div class="form-group one-line">
									<label class="">SAMU - MINSA</label>
									<input type="text" class="form-control"
										name="Evento_Acciones_Minsa_Samu" id="Evento_Acciones_Minsa_Samu" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">IPRESS MINSA</label>
									<input type="text" class="form-control"
										name="Evento_Acciones_Salud_Minsa" id="Evento_Acciones_Salud_Minsa" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">ESSALUD</label> <input type="text"
										class="form-control"
										name="Evento_Acciones_Essalud" id="Evento_Acciones_Essalud" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">Muni./GORES</label>
									<input type="text" class="form-control"
										name="Evento_Acciones_Municipalidades_Gores" id="Evento_Acciones_Municipalidades_Gores" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">Otros Voluntarios</label>
									<input type="text" class="form-control"
										name="Evento_Acciones_Voluntarios" id="Evento_Acciones_Voluntarios" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">Sanidad PNP/FF.AA.</label>
									<input type="text" class="form-control"
										name="Evento_Acciones_PNP_FFAA" id="Evento_Acciones_PNP_FFAA" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">E.M.T. I</label>
									<input type="text" class="form-control" name="Evento_Acciones_Personal_Emt_i" id="Evento_Acciones_Personal_Emt_i" value="0" placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">E.M.T. II</label>
									<input type="text" class="form-control" name="Evento_Acciones_Personal_Emt_ii" id="Evento_Acciones_Personal_Emt_ii" value="0" placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">E.M.T. III</label>
									<input type="text" class="form-control" name="Evento_Acciones_Personal_Emt_iii" id="Evento_Acciones_Personal_Emt_iii" value="0" placeholder="#" autocomplete="off" />
								</div>

							</div>

							<div class="col-xs-6 col-sm-2 input-modal-xl">
								<strong>4. Ambulancias</strong>
								<div class="form-group one-line">
									<label class="">SAMU - MINSA</label>
									<input type="text" class="form-control"
										name="Evento_Ambulancias_Minsa_Samu" id="Evento_Ambulancias_Minsa_Samu" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">IPRESS - MINSA</label>
									<input type="text" class="form-control"
										name="Evento_Ambulancias_Minsa" value="0" id="Evento_Ambulancias_Minsa"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">ESSALUD</label> <input type="text"
										class="form-control"
										name="Evento_Ambulancias_Essalud" id="Evento_Ambulancias_Essalud" value="0"
										placeholder="#" autocomplete="off" />
								</div>
                                <div class="form-group one-line">
									<label class="">Muni./GORES</label>
									<input type="text" class="form-control"
										name="Evento_Ambulancias_Municipalidades_Gores" id="Evento_Ambulancias_Municipalidades_Gores" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">Bomberos</label> <input type="text"
										class="form-control"
										name="Evento_Ambulancias_Bomberos" id="Evento_Ambulancias_Bomberos" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">Sanidad PNP/FF.AA.</label>
									<input type="text" class="form-control"
										name="Evento_Ambulancias_PNP_FFAA" id="Evento_Ambulancias_PNP_FFAA" value="0"
										placeholder="#" autocomplete="off" />
								</div>
								<div class="form-group one-line">
									<label class="">Privadas</label>
									<input type="text" class="form-control"
										name="Evento_Ambulancianas_Privadas" id="Evento_Ambulancianas_Privadas" value="0"
										placeholder="#" autocomplete="off" />
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 input-modal-xl">
								<strong>5. Medicamentos e Insumos</strong>
    							<div class="row">
    								<div class="col-sm-6 col-xs-6">
        								<div class="form-group one-line">
        									<label class="">M.E.D.<a href="#" data-toggle="tooltip"
        										data-placement="top" title="Malet&iacute;n para Emergencias y Desastres"> <i
        											class="fa fa-info-circle" aria-hidden="true"></i></a></label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Maletin_Emergencias_Desastres" id="Evento_Maletin_Emergencias_Desastres" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">K.M.I.<a href="#" data-toggle="tooltip"
        										data-placement="top" title="Kits de Medicamentos e Insumos"> <i
        											class="fa fa-info-circle" aria-hidden="true"></i></a></label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Kit_Medicamentos_Insumos" id="Evento_Kit_Medicamentos_Insumos" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Equipos Biom&eacute;dicos</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Equipo_Biomedicos" id="Evento_Acciones_Equipo_Biomedicos" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Puesto de Comando</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Puesto_Comando" id="Evento_Acciones_Puesto_Comando" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">A.C. V&iacute;timas</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Ac_Victimas" id="Evento_Acciones_Ac_Victimas" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Mochila de Emergencia</label>
        									<input type="text" class="form-control" name="Evento_Acciones_Mochilas_Emergencia" id="Evento_Acciones_Mochilas_Emergencia" value="0" placeholder="#" autocomplete="off" />
        								</div>
        							</div>

        						<div class="col-sm-6 col-xs-6">
        								<div class="form-group one-line">
        									<label class="">Oferta M&oacute;vil Tipo I</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Oferta_Movil_i" id="Evento_Acciones_Oferta_Movil_i" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Oferta M&oacute;vil Tipo II</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Oferta_Movil_ii" id="Evento_Acciones_Oferta_Movil_ii" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Oferta M&oacute;vil Tipo III</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Oferta_Movil_iii" id="Evento_Acciones_Oferta_Movil_iii" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Hospital Modular</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Acciones_Hospital_Modular" id="Evento_Acciones_Hospital_Modular" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        								<div class="form-group one-line">
        									<label class="">Ba&ntilde;o Qu&iacute;mico Port&aacute;til</label>
        									<div class="col-xs-6"><input type="text" class="form-control"
        										name="Evento_Banio_Quimico_Portatil" id="Evento_Banio_Quimico_Portatil" value="0"
        										placeholder="#" autocomplete="off" /></div>
        								</div>
        							</div>
        						</div>
							</div>
							<div class="clearfix"></div>
							<br />
							<div class="col-xs-12 input-modal-xl">
								<strong>6. Equipo t&eacute;cnico movilizado</strong>
								<div class="row">
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">DIRESA - GERESA</label>
    									<input type="text" class="form-control"
    										name="Equipo_Tecnico_Movilizado_Diresa" value="0" id="Equipo_Tecnico_Movilizado_Diresa"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">RED</label>
    									<input type="text" class="form-control"
    										name="Equipo_Tecnico_Movilizado_Red" value="0" id="Equipo_Tecnico_Movilizado_Red"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">DIRIS</label> <input type="text"
    										class="form-control"
    										name="Equipo_Tecnico_Movilizado_Diris" value="0" id="Equipo_Tecnico_Movilizado_Diris"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">IPRESS</label> <input type="text"
    										class="form-control"
    										name="Equipo_Tecnico_Movilizado_Ipress" value="0" id="Equipo_Tecnico_Movilizado_Ipress"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">DIGERD</label>
    									<input type="text" class="form-control"
    										name="Equipo_Tecnico_Movilizado_Digerd" value="0" id="Equipo_Tecnico_Movilizado_Digerd"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">MINSA Central</label>
    									<input type="text" class="form-control"
    										name="Equipo_Tecnico_Movilizado_Minsa" value="0" id="Equipo_Tecnico_Movilizado_Minsa"
    										placeholder="#" autocomplete="off" />
    								</div>
    								<div class="col-xs-12 col-sm-6 col-md-3 form-group one-line less">
    									<label class="">Otros</label>
    									<input type="text" class="form-control"
    										name="Equipo_Tecnico_Movilizado_Otros" value="0" id="Equipo_Tecnico_Movilizado_Otros" 
    										placeholder="#" autocomplete="off" />
    								</div>
								</div>
							</div>

							<div class="clearfix"></div>
							<br />
							<div class="col-xs-12 col-sm-6 col-md-4">
								<div class="form-group">
									<label class="">Fecha acci&oacute;n</label>
									<div class="input-group date" data-target-input="nearest">
										<div class="form-group">
											<div class='input-group date datetimepicker'>
												<input type="text" class="form-control" required="required"
													id="Evento_Acciones_Fecha" name="Evento_Acciones_Fecha" />
												<span class="input-group-addon"> <span
													class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4">
								<div class="form-group">
									<label class="">Tipo de acci&oacute;n Realizada</label>
									<select	class="form-control" name="Tipo_Accion_Codigo" id="Tipo_Accion_Codigo"
										style="font-size: 12px;">
										<option value="">-- Seleccione --</option>
            							<?php foreach($tipoaccion->result() as $row): ?>
            							<option value="<?=$row->Tipo_Accion_Codigo?>"><?=$row->Tipo_Accion_Descripcion?></option>
            							<?php endforeach; ?>
            						</select>
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4">
								<div class="form-group">
									<label class="">Acci&oacute;n Realizada Por:</label> <select
										class="form-control" name="Tipo_Accion_Entidad_Codigo" id="Tipo_Accion_Entidad_Codigo"
										style="font-size: 12px;">
										<option value="">-- Seleccione Tipo acci&oacute;n --</option>
									</select>
								</div>
							</div>

							<div class="col-xs-12">
								<div class="form-group">
									<label class="">Detalle de Acciones Realizadas:</label>
									<textarea rows="2" class="form-control"
										 name="Evento_Acciones_Descripcion" id="Evento_Acciones_Descripcion"></textarea>
								</div>
							</div>

						</div>

					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-basic d-block" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary d-block">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>


	<input type="hidden" id="idEliminar" />

	<!-- SCRIPTS -->
	<script src="<?=base_url()?>public/js/eventos/acciones.js?v=<?=date("his")?>"></script>
	<script>

	acciones("<?=base_url()?>","<?=$Evento_Registro_Numero?>");

	</script>

</body>

</html>
