<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?=TITULO_PRINCIPAL?></title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="<?=AUTOR?>">

	<?php $this->load->view("inc/resources");?>
	<?php $titulo = "Lista General de Eventos";?>
	<link rel="stylesheet"
	href="<?=base_url()?>public/css/eventos/listaEventos.css?v=<?=date("s")?>" />
	<?php $opciones = $this->session->userdata("Permisos_Opcion");?>
	<?php
$months = array(
    array("id" => 0, "name" => "TODOS"),
    array("id" => 1, "name" => "Enero"),
    array("id" => 2, "name" => "Febrero"),
    array("id" => 3, "name" => "Marzo"),
    array("id" => 4, "name" => "Abril"),
    array("id" => 5, "name" => "Mayo"),
    array("id" => 6, "name" => "Junio"),
    array("id" => 7, "name" => "Julio"),
    array("id" => 8, "name" => "Agosto"),
    array("id" => 9, "name" => "Septiembre"),
    array("id" => 10, "name" => "Octubre"),
    array("id" => 11, "name" => "Noviembre"),
    array("id" => 12, "name" => "Diciembre"),
);
?>

</head>

<body>

	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">

	<?php $this->load->view("inc/navsireed");?>

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
							<li class="active"><span>Lista de eventos</span></li>
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
											<div class="sm-data-box pt-20">
												<div class="container-fluid">

												<?php $message = $this->session->flashdata('messageOK');?>
                                                <?php if ($message) {?>
                                                    <div
														class="alert alert-success">
														<p><?=$message?></p>
													</div>
                                                <?php }?>

                                                <?php $message = $this->session->flashdata('messageError');?>
                                                <?php if ($message) {?>
                                                    <div
														class="alert alert-danger">
														<p><?=$message?></p>
													</div>
                                                <?php }?>
                                                <?php $idrol = $this->session->userdata("idrol");?>
                                                <input type="hidden" id="Tipo_Accion" />
													<ul class="botones-evento">
																<?php if (validarPermisosOpciones(12, $opciones)) {?>
																<li id="btn-nuevo" class="agregar"><label rel=""><span>Agregar Nuevo Evento</span><i class="fa fa-file-text-o" aria-hidden="true"></i></label></li>
																<?php }?>
																<?php if (validarPermisosOpciones(1, $opciones)) {?>
																<li id="btn-editar" class=""><label rel=""><span>Corregir Evento Seleccionado</span><i class="fa fa-check" aria-hidden="true"></i></label></li>
																<?php }?>
																<?php if (validarPermisosOpciones(7, $opciones)) {?>
																<li id="btn-extornar" class=""><label rel=""><span>Reabrir Evento Seleccionado</span><i class="fa fa-backward" aria-hidden="true"></i></label></li>
																<?php }?>
																<?php if (validarPermisosOpciones(8, $opciones)) {?>
																<li id="btn-cerrar" class=""><label rel=""><span>Cerrar Evento Seleccionado</span><i class="fa fa-times" aria-hidden="true"></i></label></li>
																<?php }?>
																<?php if (validarPermisosOpciones(9, $opciones)) {?>
																<li id="btn-exportar" class=""><a href="javascript:;"><label rel=""><span>Descargar Informe Evento</span><i class="fa fa-file-pdf-o" aria-hidden="true"></i></label></a></li>
																<?php }?>
															<?php if ($idrol == "01") {?>
																<?php if (validarPermisosOpciones(10, $opciones)) {?>
																<li id="btn-anular" class=""><label rel=""><span>Anular Evento Seleccionado</span><i class="fa fa-trash" aria-hidden="true"></i></label></li>
																<?php }?>
															<?php }?>
															<?php if ($idrol == "01") {?>
																<?php if (validarPermisosOpciones(4, $opciones)) {?>
																	<li id="btn-eliminar" class=""><label rel=""><span>Eliminar Evento Seleccionado</span><i class="fa fa-lock" aria-hidden="true"></i></label></li>
																<?php }?>
															<?php }?>
															<?php if (validarPermisosOpciones(26, $opciones)) {?>
															<li id="btn-oferta-movil" class=""><label rel=""><span>Registro de Ofertas M&oacute;viles</span><i class="fa fa-ambulance" aria-hidden="true"></i></label></li>																<?php }?>
															<?php if (validarPermisosOpciones(28, $opciones)) {?>
															<li id="btn-alertas-pronos" class="alertas-pronos"><label rel=""><span>Alertas y Pronósticos</span><i class="fa fa-phone" aria-hidden="true"></i></label></li>
															<?php }?>
															<?php if (validarPermisosOpciones(29, $opciones)) {?>
															<li id="btn-eventos-asociados" class="eventos-asociados"><span>Eventos Asociados</span><i class="fa fa-calendar" aria-hidden="true"></i></label></li>
															<?php }?>
															<?php if ($idrol == "01") {?>
															<?php if (validarPermisosOpciones(3, $opciones)) {?>
																<li id="btn-restaurar" class=""><label rel=""><span>Restaurar Evento</span><i class="fa fa-refresh" aria-hidden="true"></i></label></li>
															<?php }?>
															<?php }?>
													</ul>
													<div class="clearfix"></div>
                                                    <div class="row">
														<div class="col-xs-12">

														<div class="form-group row">
                                    						<label class="col-sm-12 col-form-label">Aplicar Filtros por Año y Mes del Evento</label>
                                    						<div class="col-sm-3">
                                    							<select class="form-control" name="anio" id="anio">
								  								  <?php foreach ($listaAnioEjecucion->result() as $row): ?>
                                								  <option value="<?=$row->Anio_Ejecucion?>" <?=($row->Anio_Ejecucion == $anio) ? "selected" : ""?>><?=$row->Anio_Ejecucion?></option>
                                								  <?php endforeach;?>
								  								</select>
                                    						</div>
                                                              <div class="col-sm-3">
                                    							<select class="form-control" name="mes" id="mes">
        							  							  <?php foreach ($months as $row): ?>
                                    							  <option value="<?=$row["id"]?>" <?=($row["id"] == $mes) ? "selected" : ""?>><?=$row["name"]?></option>
                                    							  <?php endforeach;?>
        							  							</select>
                                    						</div>

                                    					</div>


														</div>
													</div>

													<div class="table-responsive">

														<table class="table table-bordered table-hover tbLista">
															<!-- dataTables-example -->
															<thead>
																<tr>
																	<th class="text-center" >N&uacute;mero</th>
																	<th>Evento Producido</th>
																	<th style="width: 84px;">Fecha y Hora</th>
																	<th>Ubicaci&oacute;n del Evento (UBIGEO)</th>
																	<th class="text-center" style="width: 80px;">Nivel</th>
																	<th class="text-center" style="width: 40px;">Men&uacute;</th>
																	<th class="text-center" ><span data-toggle="tooltip" data-placement="top" title="Mapa" >Mapa</span></th>
																	<th><span data-toggle="tooltip" data-placement="top" title="Galeria">Fotos</span></th>
																	<th><span data-toggle="tooltip" data-placement="top" title="Requerimientos">Req.</span></th>
																	<th class="text-center">Estado</th>
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
																	<th>Coordenadas</th>
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
																	<th>Danios</th>
																	<th>Lesionados</th>
																	<th>Acciones</th>
																	<th>EE.SS.</th>
																	<th>&nbsp;</th>
																	<th>Estado</th>
																</tr>
															</thead>
															<tbody>
                                        			<?php
$n = 1;
foreach ($lista as $row):
?>
                                        			<tr>
																	<td align="center"><?=$row["codigo"]?></td>
																	<td><?=$row["evento"]?></td>
																	<td><?=$row["fecha"]?></td>
																	<td><?=$row["ubigeo"]?></td>
																	<td align="center"><?=$row["nivel"]?></td>
																	<td class="text-center">
                                    					<?php if ($row["Evento_Estado_Codigo"] != "1") {?>
                                        					<i class="fa fa-home disabled" aria-hidden="true"></i>
															<!--<i class="fa fa-user disabled" aria-hidden="true"></i>
															<i class="fa fa-share-square disabled" aria-hidden="true"></i>
															<i class="fa fa-hospital-o disabled" aria-hidden="true"></i>-->
                                        				<?php } else {?>
															<?php if (validarPermisosOpciones(2, $opciones)) {?><span class="inline-block"><i class="fa fa-home addDanios" aria-hidden="true"></i></span><?php }?>

                                        				<?php }?>
                                        				</td>
																	<td class="text-center">
														<?php if ($row["Evento_Estado_Codigo"] != "1") {?>
															<a href="javascript:;"><i class="fa fa-globe disabled" rel="<?=$row["Evento_Coordenadas"]?>"></i></a>
														<?php } else {?>
															<?php if (validarPermisosOpciones(5, $opciones)) {?>
																	<a href="javascript:;"><i	class="fa fa-globe actionMap" rel="<?=$row["Evento_Coordenadas"]?>"></i></a><?php }?>
																	</td>
														<?php }?>
																	<td class="text-center">
                                    					<?php if ($row["Evento_Estado_Codigo"] != "1") {?>
                                    								<a href="javascript:;"><i class="fa fa-file-photo-o disabled"></i></a>
                                        					<?php } else {?>
    																<?php if (validarPermisosOpciones(6, $opciones)) {?>
                                        								<a href="javascript:;"><i class="fa fa-file-photo-o addPhotos"></i></a>
                                        							<?php }?>
                                        					<?php }?>
                                    						</td>
                                    						<td class="text-center">
                                    						<?php if ($row["Evento_Estado_Codigo"] != "1") {?>
                                    								<a href="javascript:;"><i class="fa fa-list-alt disabled"></i></a>
                                        					<?php } else {?>
    																<?php if (validarPermisosOpciones(27, $opciones)) {?>
                                        								<a href="javascript:;"><i class="fa fa-list-alt addAsignacion"></i></a>
                                        							<?php }?>
                                        					<?php }?>
                                    						</td>
																	<td class="text-center"><?php

$html = '';
$status = '';
switch ($row["Evento_Estado_Codigo"]) {
    case 1:
        $html = '<span class="label label-success">Monitoreo</span>';
        $status = 'Monitoreo';
        break;
    case 2:
        $html = '<span class="label label-default">Cerrado</span>';
        $status = 'Cerrado';
        break;
    case 3:
        $html = '<span class="label label-danger">Anulado</span>';
        $status = 'Anulado';
        break;
}
echo $html;
?></td>
																	<td><?=$row["Evento_Registro_Numero"]?></td>
																	<td><?=$row["Evento_Estado_Codigo"]?></td>
																	<td><?=$row["orden"]?></td>
																	<td><?=$row["Evento_Coordenadas"]?></td>
																	<td><?=encriptarInforme($row["Evento_Registro_Numero"], "ASC")?></td>
																	<td><?=encriptarInforme($row["Evento_Registro_Numero"], "DESC")?></td>

																	<td><?=$row["danios"]?></td>
																	<td><?=$row["lesionados"]?></td>
																	<td><?=$row["acciones"]?></td>
																	<td><?=$row["salud"]?></td>
																	<td><?=$status?></td>

																</tr>
                                    				<?php
$n++;
endforeach
;
?>
                              								</tbody>
														</table>

													</div>
													<!-- table -->

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

<div class="modal fade" id="informeModal" tabindex="-1" role="dialog" aria-labelledby="condicionModalLabel" style="margin-top: -15px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Seleccione</h5>
      </div>
      <div class="modal-body text-center">

				<div class="btn-group">
			    <a id="aInformeInicial" href="" target="_blank" class="btn btn-primary">Informe Inicial</a>
			    <a id="aInformeFinal" href="" target="_blank" class="btn btn-primary">Informe Final</a>
			  </div>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="condicionModalLabel" style="margin-top: -15px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Mapa del Evento</h5>
      </div>
      <div class="modal-body">
        <div id="map"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

			<?php $this->load->view("inc/footer");?>
		</div>
	</div>

	<script src="<?=base_url()?>public/js/eventos/listaEventos.js?v=<?=date("s")?>"></script>
<script
		src="https://maps.googleapis.com/maps/api/js?key=<?=getenv('MAP_KEY')?>&libraries=places"
		async defer></script>
	<script>
    listaEventos("<?=base_url()?>");
	</script>

</body>

</html>
