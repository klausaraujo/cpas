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
	<?php $titulo = "Consolidado General de Atenciones del Evento"; ?>
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
							<li><a href="<?=base_url()?>ofertamovil"><span>Dashboard</span></a></li>
							<li class="active"><span>Consolidado Atenciones</span></li>
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
												<br />
													<form id="formConsolidado" method="post" action="<?=base_url()?>ofertamovil/main/consolidado">
                                                        <div class="col-xs-12 col-sm-6">
                                                            <label class="">Seleccione Evento</label> 
                                                            <select class="form-control" id="combo" name="evento">
                            						    		<?php 
                            						    		    foreach($lista->result() as $row):
                            						    		?>
                            						    			<option value="<?=$row->id?>" <?=($primero == $row->id)?'selected':''?>><?=$row->descripcion?></option>
                            						    		<?php 
                            						    		    endforeach;
                            						    		?>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-2">
                                                            <div class="form-group"> 
                                                                    <label class="">Fecha Inicial</label>
									                                <div class='input-group date datetimepicker'>
									                                	<input type="text" class="form-control input" required="required" name="fecha_inicial" 
									                                		   value="<?=date("d/m/Y")?>" data-date-format="DD/MM/YYYY" /> 
									                                		<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
									                                	</span>
									                                </div>
                                                            </div>    
                                                        </div>
                                                        <div class="col-xs-12 col-sm-2">  
                                                            <div class="form-group">
                                                                    <label class="">Fecha Final</label>
									                                <div class='input-group date datetimepicker'>
									                                	<input type="text" class="form-control input" required="required" name="fecha_final" 
									                                		   value="<?=date("d/m/Y")?>" data-date-format="DD/MM/YYYY" /> 
									                                		<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
									                                	</span>
									                                </div>
                                                            </div>        
                                                        </div>
                                                        <div class="col-xs-12 col-sm-2">  
                                                            <div class="form-group">
                                                                <label class="">&nbsp;&nbsp;</label> 
                                                                <div class='input-group date ejecutar'>
                                                                    <button type="submit" id="btnejecutar" class="btn btn-primary">Ejecutar</button>
                                                                </div>
                                                            </div>        
                                                        </div>
                        							</form>                                          
													<div class="clearfix"></div>
													<br />
													<div class="col-xs-12">
														<div class="table-responsive">
															<table id="tbConsolidado" class="table tbLista table-striped table-bordered table-sm" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th>F_Atencion</th>
                                                                        <th>Paciente</th>
                                                                        <th>Edad</th>
                                                                        <th>Clasificacion</th>
                                                                        <th>Diagnosticos</th>
                                                                        <th>PMA_Oferta_Movil</th>
                                                                        <th>Pais</th>
                                                                        <th>&nbsp;</th>
                                                                        <th>&nbsp;</th>      
                                                                        <th>ID</th>
                                                                        <th>IDR</th>
                                                                        <th>IDP</th>
                                                                        <th>Medico</th>
                                                                        <th>PreHospitalario</th>
                                                                        <th>Entidad</th>
                                                                        <th>Atencion_PMA</th>
                                                                        <th>Tipo_Documento</th>
                                                                        <th>Num_Documento</th>
                                                                        <th>F_Nacimiento</th>
                                                                        <th>Genero</th>
                                                                        <th>Gestante</th>
                                                                        <th>Discapacidad</th>
                                                                        <th>T_Discapacidad</th>
                                                                        <th>Apoderado</th>
                                                                        <th>Residencia</th>
                                                                        <th>Dias</th>
                                                                        <th>Meses</th>
                                                                        <th>F_Sintomas</th>
                                                                        <th>H_Sintomas</th>
                                                                        <th>H_Atencion</th>
                                                                        <th>PA</th>
                                                                        <th>FC</th>
                                                                        <th>FR</th>
                                                                        <th>SO2</th>
                                                                        <th>FIO2</th>
                                                                        <th>Dif_Respiratoria</th>
                                                                        <th>Tos</th>
                                                                        <th>Rinorrea</th>
                                                                        <th>Fiebre</th>
                                                                        <th>Nauseas</th>
                                                                        <th>Vomitos</th>
                                                                        <th>D_Abdominal</th>
                                                                        <th>Diarrea</th>
                                                                        <th>Otros</th>
                                                                        <th>V_Influenza</th>
                                                                        <th>V_Fiebre</th>
                                                                        <th>V_Sarampion</th>
                                                                        <th>V_Hepatitis</th>
                                                                        <th>V_Tetanos</th>
                                                                        <th>OtrasVacunas</th>
                                                                        <th>Detalle</th>
                                                                        <th>F_Toma</th>
                                                                        <th>F_Envio</th>
                                                                        <th>F_Recepcion</th>
                                                                        <th>Resultados</th>
                                                                        <th>Destino</th>
                                                                        <th>Lugar_Traslado</th>
                                                                        <th>Responsable</th>
                                                                        <th>Condicion</th>
                                                                        <th>Observaciones</th>
                                                                        <th>Tratamiento</th>
                                                                        <th>Alteracion_Mental</th>
                                                                        <th>Dolor_Pecho</th>
																	</tr>
																</thead>
																<tbody>
																	<?php 
																	if ($atenciones->num_rows() > 0) {
																	   foreach($atenciones->result() as $row):
																	?>
																	<tr>
																		<td class="text-center"><?=$row->F_Atencion?></td>
                                                                        <td><?=$row->Paciente?></td>
                                                                        <td class="text-center"><?=$row->Edad?></td>
                                                                        <td class="text-center"><?=$row->Clasificacion?></td>
                                                                        <td><?=$row->Diagnosticos?></td>
                                                                        <td class="text-center"><?=$row->PMA_Oferta_Movil?></td>
                                                                        <td class="text-center"><?=$row->Pais?></td>
                                                                        <td class="text-center"><a href="<?=base_url()?>ofertamovil/main/editar/<?=base64_encode($row->ID)?>"><i class="fa fa-edit"></i></a></td>
                                                                        <td class="text-center"><a href="javascript:;"><i class="fa fa-times actionDelete text-danger" rel="<?=$row->ID?>"></i></a></td>  
                                                                        <td><?=$row->ID?></td>
                                                                        <td><?=$row->IDR?></td>
                                                                        <td><?=$row->IDP?></td>
                                                                        <td><?=$row->Medico?></td>
                                                                        <td><?=$row->PreHospitalario?></td>
                                                                        <td><?=$row->Entidad?></td>
                                                                        <td><?=$row->Atencion_PMA?></td>
                                                                        <td><?=$row->Tipo_Documento?></td>
                                                                        <td><?=$row->Num_Documento?></td>
                                                                        <td><?=$row->F_Nacimiento?></td>
                                                                        <td><?=$row->Genero?></td>
                                                                        <td><?=$row->Gestante?></td>
                                                                        <td><?=$row->Discapacidad?></td>
                                                                        <td><?=$row->T_Discapacidad?></td>
                                                                        <td><?=$row->Apoderado?></td>
                                                                        <td><?=$row->Residencia?></td>
                                                                        <td><?=$row->Dias?></td>
                                                                        <td><?=$row->Meses?></td>
                                                                        <td><?=$row->F_Sintomas?></td>
                                                                        <td><?=$row->H_Sintomas?></td>
                                                                        <td><?=$row->H_Atencion?></td>
                                                                        <td><?=$row->PA?></td>
                                                                        <td><?=$row->FC?></td>
                                                                        <td><?=$row->FR?></td>
                                                                        <td><?=$row->SO2?></td>
                                                                        <td><?=$row->FIO2?></td>
                                                                        <td><?=$row->Dif_Respiratoria?></td>
                                                                        <td><?=$row->Tos?></td>
                                                                        <td><?=$row->Rinorrea?></td>
                                                                        <td><?=$row->Fiebre?></td>
                                                                        <td><?=$row->Nauseas?></td>
                                                                        <td><?=$row->Vomitos?></td>
                                                                        <td><?=$row->D_Abdominal?></td>
                                                                        <td><?=$row->Diarrea?></td>
                                                                        <td><?=$row->Otros?></td>
                                                                        <td><?=$row->V_Influenza?></td>
                                                                        <td><?=$row->V_Fiebre?></td>
                                                                        <td><?=$row->V_Sarampion?></td>
                                                                        <td><?=$row->V_Hepatitis?></td>
                                                                        <td><?=$row->V_Tetanos?></td>
                                                                        <td><?=$row->OtrasVacunas?></td>
                                                                        <td><?=$row->Detalle?></td>
                                                                        <td><?=$row->F_Toma?></td>
                                                                        <td><?=$row->F_Envio?></td>
                                                                        <td><?=$row->F_Recepcion?></td>
                                                                        <td><?=$row->Resultados?></td>
                                                                        <td><?=$row->Destino?></td>
                                                                        <td><?=$row->Lugar_Traslado?></td>
                                                                        <td><?=$row->Responsable?></td>
                                                                        <td><?=$row->Condicion?></td>
                                                                        <td><?=$row->Observaciones?></td>
                                                                        <td><?=$row->Indicaciones?></td>
                                                                        <td><?=$row->alteracion_conciencia?></td>
                                                                        <td><?=$row->dolor_pecho?></td>
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
			<?php $this->load->view("inc/footer"); ?>
		</div>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"aria-labelledby="deleteTablero">
            	<div class="modal-dialog" role="document">
            		<form action="<?=base_url()?>ofertamovil/main/EliminarRe" method="POST">
            			<input type="hidden" name="id" value="" readonly />
            			<div class="modal-content">
            				<div class="modal-header">
            					<button type="button" class="close" data-dismiss="modal"
            							aria-label="Close">
            						<span aria-hidden="true">&times;</span>
            					</button>
            					<h5 class="modal-title">Borrar Registro</h5>
            				</div>
            				<div class="modal-body">
            						&iquest;Seguro(a) desea Borrar el Registro?
            					</div>
            				<div class="modal-footer">
            					<button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            					<button type="submit" class="btn btn-info">Borrar</button>
            				</div>
            			</div>
            		</form>
            	</div>
            </div>
	</div>
    <script src="<?=base_url()?>public/js/ofertamovil/consolidado.js?v=<?=date("s")?>"></script>
    <script src="<?=base_url()?>public/js/moment.min.js"></script>
	<script src="<?=base_url()?>public/js/locale.es.js"></script>
    <script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
	<script>
		consolidado("<?=base_url()?>");
	</script>
</body>
</html>