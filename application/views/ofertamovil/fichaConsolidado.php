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
	<?php $titulo = "Consolidado de Atenci&oacute;n"; ?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/fichaConsolidado.css?v=<?=date("s")?>" />
</head>
<body>
	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
	<?php $this->load->view("inc/nav"); ?>
		<div class="page-wrapper" style="min-height: 710px;">
			<div class="container pt-30">
				<div class="row heading-bg">
					<div class="col-lg-8 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark"><?=$titulo?></h5>
					</div>
					<div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="<?=base_url()?>">Inicio</a></li>
							<li><a href="<?=base_url()?>ofertamovil"><span>Eventos</span></a></li>
							<li class="regresar"><a href="<?=base_url()?>ofertamovil/fichas/lista/<?=base64_encode($Evento_Registro_Numero)?>"><span>Ficha</span></a></li>
							<li class="active"><span>Consolidado</span></li>
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
											<div class="sm-data-box pa-10">
												<div class="container-fluid">
												<?php $message = $this->session->flashdata('messageOK'); ?>
                                                <?php if($message){ ?>
                                                    <div
														class="alert alert-success">
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
													<div class="clearfix"></div>
													<br />
													<div class="col-xs-12">
														<div class="table-responsive">
															<table id="tbFichaConsolidado" class="table tbLista table-striped table-bordered table-sm" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th>Fecha</th>
																		<th>ID</th>
																		<th>Paciente</th>
																		<th>DNI</th>
																		<th>Edad</th>
																		<th>G&eacute;nero</th>
																		<th>Gestante</th>
																		<th>EL PACIENTE ES</th>
																		<th>Clasificaci&oacute;n</th>
																		<th>Diagnostico</th>																		
																		<th>Inicio Sintomas</th>
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
																	</tr>
																</thead>
																<tbody>
																	<?php 
																	if($lista->num_rows()>0){
																	foreach($lista->result() as $row): 
																	$Detalle_Clasificacion="";
																	$genero = "MASCULINO";
																	if($row->Evento_Ficha_Atencion_Detalle_Genero=="2") $genero = "FEMENINO";
																	$gestante = "NO";
																	if($row->Evento_Ficha_Atencion_Detalle_Gestante=="1") $gestante = "SI";
																	$personalSalud="NINGUNO";
                                                                    switch($row->Evento_Ficha_Atencion_Detalle_Personal_Salud){
                                                                        case "1":$personalSalud="Personal del Ministerio de Salud";break;
                                                                        case "2":$personalSalud="Personal de las FF.AA. o PNP";break;
                                                                        case "3":$personalSalud="Personal de EsSalud";break;
																	    
																	}
																	$vacuna = "NO";
																	if($row->Evento_Ficha_Atencion_Detalle_Vacuna=="1") $vacuna = "SI";
																	$quimioprofilaxis = "NO";
																	if($row->Evento_Ficha_Atencion_Detalle_Quimioprofilaxis=="1") $quimioprofilaxis = "SI";
                                                                    $medicamentos = "NO";
                                                                    if($row->Evento_Ficha_Atencion_Detalle_Medicamentos=="1") $medicamentos = "SI";
																	switch($row->Evento_Ficha_Atencion_Detalle_Clasificacion){
																	    case "1":$Detalle_Clasificacion="I-ROJO";break;
																	    case "2":$Detalle_Clasificacion="II-AMARILLO";break;
																	    case "3":$Detalle_Clasificacion="III y IV - VERDE";break;
																	    case "4":$Detalle_Clasificacion="0 - FALLECIDO";break;
																	}
																	?>
																		<tr>
																		<td><?=$row->Evento_Ficha_Atencion_Fecha?></td>
																		<td><?=$row->id?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_Paciente?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_DNI?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_Edad?></td>
                                                                        <td><?=$genero?></td>
                                                                        <td><?=$gestante?></td>
                                                                        <td><?=$personalSalud?></td>
                                                                        <td><?=$Detalle_Clasificacion?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_Diagnostico?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_Inicio_Sintomas?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_CIE10_Codigo?></td>
                                                                        <td><?=$row->Descripcion_CIE10?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_Hora_Atencion?></td>
                                                                    	<td><?=$row->Entidad?></td>                                                                        
																		<td><?=$row->Oferta_Movil_Nombre?></td>
																		<td><?=$vacuna?></td>
																		<td><?=$quimioprofilaxis?></td>
																		<td><?=$medicamentos?></td>
                                                                        <td><?=($row->Evento_Ficha_Atencion_Detalle_Destino==1)?"Alta":"Referido"?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_Lugar_Traslado?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_Responsable?></td>
                                                                        <td><?=$row->pais?></td>
                                                                        <td class="text-center"><a href="javascript:;"><i class="fa fa-edit edit-detalle" rel="<?=$row->id?>"></i></a></td><!-- 23 -->
                     													<td><?=$row->Evento_Ficha_Atencion_Detalle_Gestante?></td>
                     													<td><?=$row->Evento_Ficha_Atencion_Detalle_Personal_Salud?></td>
                     													<td><?=$row->Evento_Ficha_Atencion_Detalle_Vacuna?></td>
                     													<td><?=$row->Evento_Ficha_Atencion_Detalle_Quimioprofilaxis?></td>
                     													<td><?=$row->Evento_Ficha_Atencion_Detalle_Medicamentos?></td>
                                                                    	<td><?=$row->Evento_Ficha_Atencion_ID?></td>
                                                                    	<td><?=$row->Evento_Registro_Numero?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_Genero?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_Procedencia?></td>
                                                                        <td><?=$row->Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_Clasificacion?></td>
                                                                        <td><?=$row->Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID?></td>
                                                                        <td><?=$row->Evento_Tipo_Entidad_Atencion_ID?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Detalle_Destino?></td>
                                                                        <td><?=$row->Hora_Cierre?></td>
                                                                        <td><?=$row->usuario?></td>
                                                                        <td><?=$row->Tipo_Documento_Codigo?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Pais_Procedencia?></td>
                                                                        <td><?=$row->Evento_Ficha_Atencion_Lugar_Residencia?></td><!-- 42 -->
                     													<td class="text-center"><a href="javascript:;"><i class="fa fa-times actionDelete text-danger" rel="<?=$row->id?>"></i></a></td>
                                                                        </tr>
																	<?php endforeach; 
																	}
																	?>
																</tbody>
															</table>
														</div>
													</div>
													<div class="clearfix"></div>
													<br />
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
			<div class="modal fade" id="atencionModal" tabindex="-1" role="dialog" aria-labelledby="lesionadosModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h5 class="modal-title" id="registrarTableroModalLabel">Editar Atenci&oacute;n</h5>
						</div>
						<form id="formEditarAtencion" name="formEditarAtencion" action="<?=base_url()?>eventos/fichas/editarAtencion" method="POST" autocomplete="off">
							<div class="modal-body">
								<input type="hidden" name="Evento_Registro_Numero" value="<?=$Evento_Registro_Numero?>" />
								<input type="hidden" name="Evento_Ficha_Atencion_ID" value="" />
								<input type="hidden" name="id" value="" />
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
									<div class="col-xs-12 col-sm-3">
										<div class="form-group">
											<label class="">N&deg; Documento</label>
											<div class="input-group" style="margin-bottom: 5px;">
											<input type="text" class="form-control" name="Evento_Ficha_Atencion_Detalle_DNI" autocomplete="off">
											<span class="input-group-btn">
												<button type="button" id="btn-buscar" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
											</span>
										</div>
										</div>
									</div>							
									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											<label class="">Paciente</label> 
											<input type="text" class="form-control text-uppercase" name="Evento_Ficha_Atencion_Detalle_Paciente" value="" autocomplete="off" />
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-xs-12 col-sm-6 col-md-3">
										<div class="form-group">
											<label class="">Edad</label> 
											<input type="text" class="form-control" name="Evento_Ficha_Atencion_Detalle_Edad" value="" autocomplete="off" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-3">
										<div class="form-group">
											<label class="">G&eacute;nero</label>
											<select class="form-control" name="Evento_Ficha_Atencion_Detalle_Genero">
												<option value="">-- Seleccione --</option>
												<option value="1">MASCULINO</option>
												<option value="2">FEMENINO</option>
											</select>
										</div>
									</div>								
									<div class="col-xs-12 col-sm-6 col-md-3">
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
									<div class="col-xs-12 col-sm-6 col-md-3 div-gestante">
										<div class="form-check pt-30">
    										<input type="checkbox" class="form-check-input" name="Evento_Ficha_Atencion_Detalle_Gestante" id="Evento_Ficha_Atencion_Detalle_Gestante" value="1">
    										<label class="form-check-label" for="Evento_Ficha_Atencion_Detalle_Gestante">Gestante</label>
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
									<div class="col-xs-12 col-sm-6">
										<div class="form-group paises">
											<input type="hidden" class="form-control" name="Evento_Ficha_Atencion_Pais_Procedencia" />
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
			<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
		aria-labelledby="deleteTablero">
		<div class="modal-dialog" role="document">
			<form action="<?=base_url()?>eventos/fichas/eliminarAtencion" method="POST">
				<input type="hidden" name="id" value="" readonly />
				<input type="hidden" name="Evento_Registro_Numero" value="" readonly />
				<input type="hidden" name="Evento_Ficha_Atencion_ID" value="" readonly />
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h5 class="modal-title">Borrar Registro</h5>
					</div>
					<div class="modal-body">
						&iquest;Seguro(a) desea Borrar a <strong id="numero"></strong>?
					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-info">Borrar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
			<?php $this->load->view("inc/footer"); ?>
        	<script src="<?=base_url()?>public/js/moment.min.js"></script>
			<script src="<?=base_url()?>public/js/locale.es.js"></script>
			<script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
			<script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>
		</div>
	</div>
	<script src="<?=base_url()?>public/js/ofertamovil/fichaConsolidado.js?v=<?=date("s")?>"></script>
	<script>
		var paises = '<?=$paises?>';
		fichaConsolidado("<?=base_url()?>","<?=$Evento_Registro_Numero?>", JSON.parse(paises));
	</script>
</body>
</html>