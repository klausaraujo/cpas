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
<?php
$titulo = "Reporte de Acciones Operativas (Tareas) - Ejecuci&oacute;n Trimestral";
?>
  	<link rel="stylesheet" href="<?=base_url()?>public/css/tablero/actividadPOI.css" />
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
							<li><a href="<?=base_url()?>tablero/gestionar"><span>Tablero de Control</span></a></li>
							<li class="active"><span>Reporte Tareas Trimestral</span></li>
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
		                  					<div class="clearfix"></div>
											<div class="row pa-10">
													<div class="col-xs-12 col-md-3 pa-10">
														<div class="form-group">
															<form id="formCambioFecha" action="<?=base_url()?>tablero/ReportesBasicos/actividadpoi" method="POST">
																<div class="col-sm-4 pa-10"><label>A&ntilde;o de Ejecución</label></div>
																<div class="col-sm-6"><select class="form-control" name="Anio">
																<option value="">[Seleccione]</option>
																<?php foreach($listaAnioEjecucion->result() as $row): ?>
																<?php if($row->Anio_Ejecucion==$anio){ ?><option value="<?=$row->Anio_Ejecucion?>" selected><?=$row->Anio_Ejecucion?></option><?php
																}else{ ?><option value="<?=$row->Anio_Ejecucion?>"><?=$row->Anio_Ejecucion?></option><?php } ?>
																<?php endforeach; ?>
															</select></div>
														</form>
													</div>
												</div>		
												<div class="col-xs-12 col-md-9 pa-10">
													<div class="form-group">
														<div class="col-sm-2 pa-10"><label>Acción Operativa (Tarea)</label></div>
														<div class="col-sm-10">
															<select class="form-control" name="cboActividadPOI" style="font-size:12px;">
																<option value="">[ -- Seleccione -- ]</option>
                            									<?php foreach($listaActividadPoi->result() as $row): ?>
                            	    							<option value="<?=$row->Id_Actividad_POI?>" <?=($firstActividadPOI==$row->Id_Actividad_POI)?"selected":""?>><?=$row->Codigo_Actividad_POI.' - '.$row->Descripcion_Actividad?></option>
                            	    							<?php endforeach; ?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="col-xs-12 col-sm-8 col-sm-offset-2 text-center">
												<div class="text-default"><label id="title"></label></div>
												<canvas class="d-none" id="barChart" width="400" height="300"></canvas>
											</div>
											<div class="clearfix"></div>
											<br />
											<hr />
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
        	<script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>
		</div>
	</div>
	<script src="<?=base_url()?>public/js/tablero/reporteactividadpoi.js?v=<?=date("s")?>"></script>
	<script>
	var grafico = '<?=$grafico?>';
  	reporteActividadPOI("<?=base_url()?>",grafico);
</script>
</body>
</html>