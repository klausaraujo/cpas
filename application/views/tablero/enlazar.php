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
		<?php
			$titulo = "Enlazar &Aacute;reas con Acciones Operativas (Tareas)";
			$botonCrear = "Generar Enlace de Unidad Funcional (Área) con Acción Operativa (Tarea)";
		?>
  	<link rel="stylesheet" href="<?=base_url()?>public/css/tablero/gestionarTablero.css?v=<?=date("s")?>" />
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
								<li><a href="#"><span>Tablero de Control</span></a></li>
								<li class="active"><span>Enlazar &Aacute;rea con Tareas</span></li>
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
												<?php $message = $this->session->flashdata('mensajeSuccess'); ?>
                                                <?php if($message){ ?>
                                                    <div
														class="alert alert-success">
														<p><?= $message ?></p>
													</div>
                                                <?php } ?>
                                                <?php $message = $this->session->flashdata('mensajeError'); ?>
                                                <?php if($message){ ?>
                                                    <div
														class="alert alert-danger">
														<p><?= $message ?></p>
													</div>
                                                <?php } ?>
													<div class="col-xs-12" id="message"></div>
												<div class="clearfix"></div>
												<div class="row pa-10">
													<form id="formRegistrarEnlace" action="" method="POST">
													<div class="col-xs-12 col-md-5 pa-10">
														<div class="form-group">
																<div class="col-xs-12 col-sm-6 col-md-4 pa-10"><label>A&ntilde;o de Ejecución</label></div>
																<div class="col-xs-12 col-sm-6 col-md-4">
																	<select class="form-control" id="Anio" name="Anio">
        																<option value="">[Seleccione]</option>
        																<?php foreach($listaAnioEjecucion->result() as $row): ?>
        																<?php if($row->Anio_Ejecucion==$anio){ ?><option value="<?=$row->Anio_Ejecucion?>" selected><?=$row->Anio_Ejecucion?></option><?php
        																}else{ ?><option value="<?=$row->Anio_Ejecucion?>"><?=$row->Anio_Ejecucion?></option><?php } ?>
        																<?php endforeach; ?>
        															</select>
																</div>
													</div>
												</div>
												<div class="clearfix"></div>												
												<div class="form-group">
    												<div class="col-xs-12">
                                                        <div class="form-group">
                                                            <div class="col-sm-2 pa-10"><label>&Aacute;rea / Unidad Operativa</label></div>
                                                            <div class="col-xs-10 col-sm-8">
                                                            <select class="form-control" id="Codigo_Area" name="Codigo_Area" style="font-size: 12px;" required>
                                                            	<option value="">[ -- Seleccione -- ]</option>
                                                        		<?php foreach($listaAreasByUser->result() as $row): ?>
                            	    							<option value="<?=$row->Codigo_Area?>"><?=$row->Nombre_Area?></option>
                            	    							<?php endforeach; ?>
                        									</select>
                        									</div>
                        								</div>
                    								</div>
												</div>
												<div class="clearfix"></div>	
                								<br />
                								<div class="form-group">
                    								<div class="col-xs-12">
    													<div class="form-group">
    														<div class="col-sm-2 pa-10"><label>Acción Operativa (Tarea)</label></div>
    														<div class="col-xs-10 col-sm-8">
    															<select class="form-control" id="cboActividadPOI" name="cboActividadPOI" style="font-size:12px;">
    																<option value="">[ -- Seleccione -- ]</option>
                                									<?php foreach($listaActividadesPOI->result() as $row): ?>
                                	    							<option value="<?=$row->Id_Actividad_POI?>"><?=$row->Codigo_Actividad_POI.' - '.$row->Descripcion_Actividad?></option>
                                	    							<?php endforeach; ?>
    															</select>
    														</div>
    													</div>
    												</div>	
												</div>			
												<div class="clearfix"></div>
												<div class="form-group">												
    												<div class="col-xs-12 col-md-5 col-md-offset-1 pull-right pa-10">
    													<button type="submit" class="btn btn-primary pull-right" data-toggle="modal" id="btnRegistrar">
    														<?=$botonCrear?>
    													</button>
    												</div>
												</div>
												</form>
											</div>
											<div class="clearfix"></div>
											<br />
											<div class="table-responsive">
												<table id="tbListar" class="table table-bordered table-sm" style="width: 100%;">
													<thead>
														<tr>
															<th>A&ntilde;o</th>
															<th>&Aacute;rea</th>
															<th>Codigo Tarea</th>
															<th>C&oacute;digo Act. POI</th>
															<th>Acción Operativa (Tarea)</th>
															<th>&nbsp;</th>
															<th>Borrar</th>
															<th>&nbsp;</th>
															<th>&nbsp;</th>
														</tr>
													</thead>
													<tbody>
                                                  	</tbody>
												</table>
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
			</div>
			<?php $this->load->view("inc/footer"); ?>
		</div>
	</div>
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
		aria-labelledby="deleteTablero">
		<div class="modal-dialog" role="document">
			<form id="formDelete" action="<?=base_url()?>tablero/procesoIndicador/eliminarEnlace" method="POST">
				<input type="hidden" name="Anio_Ejecucion" value="" readonly />
				<input type="hidden" name="Codigo_Area" value="" readonly />
				<input type="hidden" name="Id_Actividad_POI" value="" readonly />
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h5 class="modal-title">Borrar Registro</h5>
					</div>
					<div class="modal-body">
						&iquest;Seguro(a) desea Borrar el enlace?
					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-info">Borrar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="<?=base_url()?>public/js/tablero/enlazar.js?v=<?=date("s")?>"></script>
	<script>
    	enlazar("<?=base_url()?>");    
    </script>
</body>
</html>