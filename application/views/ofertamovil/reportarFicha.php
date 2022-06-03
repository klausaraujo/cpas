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
<?php $titulo = "Reportar Ficha"; ?>
<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/reportarFicha.css?v=<?=date("s")?>" />
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
							<li><a href="<?=base_url()?>ofertamovil"><span>Eventos Oferta Movil</span></a></li>
							<li><a href="<?=base_url()?>ofertamovil/fichas/lista/<?=base64_encode($Evento_Registro_Numero)?>"><span>Ficha</span></a></li>
							<li class="active"><span>Reporte</span></li>
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
													<div class="col-xs-12 col-sm-8 col-sm-offset-2">
														<canvas id="myChart" width="400" height="250"></canvas>
													</div>
													<div class="clearfix"></div>
													<div class="clearfix"></div>
													<br />													
													<div class="col-xs-12 col-sm-6 col-sm-offset-3">
														<div class="table-responsive">
															<table id="tbFichaConsolidado" class="table tbLista table-striped table-bordered table-sm" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th class="text-center">Entidad</th>
																		<th class="text-center">Oferta Movil</th>
																		<th class="text-center">Atenciones</th>
																	</tr>
																</thead>
																<tbody>
																	<?php 
																	$label = array();
																	$data = array();
																	$i=0;
																	if($listaCantidadesAtencionesOfertaMovil->num_rows()>0){
																	    foreach($listaCantidadesAtencionesOfertaMovil->result() as $row): 
																	    $label[$i]=$row->Oferta_Movil;
																	    $data[$i]=$row->Atenciones;
																	    $i++;
																	?>
																		<tr>
																		<td class="text-center"><?=$row->Entidad?></td>
                                                                        <td class="text-center"><?=$row->Oferta_Movil?></td>
                                                                        <td class="text-center"><?=$row->Atenciones?></td>
                                                                        </tr>
																	<?php endforeach; 
																	}
																	else{
																	?>
																		<tr>
																			<td colspan="3" class="text-center">No hay registros</td>
																		</tr>
																	<?php 
																	}
																	?>
																</tbody>
															</table>
														</div>
													</div>
													<div class="clearfix"></div>
													<br />
													<br />
													<hr />
													<br />												
													<div class="col-xs-12 col-sm-8 col-sm-offset-2">
													<canvas id="myChart2" width="400" height="250"></canvas>
													</div>
													<div class="clearfix"></div>
													<br />
													<div class="col-xs-12 col-sm-8 col-sm-offset-2">
														<div class="table-responsive">
															<table id="tbFichaConsolidado" class="table tbLista table-striped table-bordered table-sm" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th class="text-center">CIE10</th>
																		<th>Cie10 Descripci&oacute;n</th>
																		<th class="text-center">Cantidad</th>
																	</tr>
																</thead>
																<tbody>
																	<?php 
																	    $labelCie = array();
																	    $dataCie = array();
																	    $i=0;
																	if($listarCantidadesAtencionesDiagnosticos->num_rows()>0){
																	    foreach($listarCantidadesAtencionesDiagnosticos->result() as $row):
																	    $labelCie[$i]=$row->CIE10;
																	    $dataCie[$i]=$row->Cantidad;
																	    $i++;
																	?>
																		<tr>
																		<td class="text-center"><?=$row->CIE10?></td>
                                                                        <td><?=$row->CIE10_Descripcion?></td>
                                                                        <td class="text-center"><?=$row->Cantidad?></td>
                                                                        </tr>
																	<?php endforeach; 
																	}
																	else{
																	    ?>
																		<tr>
																			<td colspan="3" class="text-center">No hay registros</td>
																		</tr>
																	<?php 
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
	</div>
	<script src="<?=base_url()?>public/js/eventos/reportarFicha.js?v=<?=date("s")?>"></script>
	<script>
		reportarFicha("<?=base_url()?>","<?=$Evento_Registro_Numero?>",'<?=json_encode($label)?>','<?=json_encode($data)?>','<?=json_encode($labelCie)?>','<?=json_encode($dataCie)?>');
	</script>
</body>
</html>