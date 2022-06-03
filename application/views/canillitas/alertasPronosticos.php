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
	<?php $titulo = "Alertas y Pronósticos"; ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/alertas-pronosticos.css?v=<?=date("s")?>" />
	<link rel="stylesheet" href="<?=base_url()?>public/css/brigadistas/nuevo.css?v=<?=date("his")?>" />
	<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
	<?php $opciones = $this->session->userdata("Permisos_Opcion"); ?>
</head>

<?php
    $months = array(
        array("id"=>1,"name"=>"Enero"),
        array("id"=>2,"name"=>"Febrero"),
        array("id"=>3,"name"=>"Marzo"),
        array("id"=>4,"name"=>"Abril"),
        array("id"=>5,"name"=>"Mayo"),
        array("id"=>6,"name"=>"Junio"),
        array("id"=>7,"name"=>"Julio"),
        array("id"=>8,"name"=>"Agosto"),
        array("id"=>9,"name"=>"Septiembre"),
        array("id"=>10,"name"=>"Octubre"),
        array("id"=>11,"name"=>"Noviembre"),
        array("id"=>12,"name"=>"Diciembre")
    );
?>

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
							<li class="active"><span>Registro General de Alertas y Pronósticos</span></li>
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
                                                <?php $idrol = $this->session->userdata("idrol"); ?>
                                                <input type="hidden"
														id="Tipo_Accion" />
													<ul class="botones-evento">
																<li id="" class="agregar"><label rel=""><span>Agregar Aviso</span><i class="fa fa-file-text-o" aria-hidden="true"></i></label></li>
																<li id="btn-editar" class=""><label rel=""><span>Corregir Aviso Seleccionado</span><i class="fa fa-check" aria-hidden="true"></i></label></li>
																<li id="btn-anular" class=""><label rel=""><span>Anular Aviso Seleccionado</span><i class="fa fa-trash" aria-hidden="true"></i></label></li>
																<li id="btn-cerrar" class=""><label rel=""><span>Cerrar Aviso Seleccionado</span><i class="fa fa-times" aria-hidden="true"></i></label></li>
																<!--<li id="btn-exportar" class="informe"><a id="aInformeInicial" href="javascript:;" target="_blank"><label rel=""><span>Reportar Aviso</span><i class="fa fa-file-pdf-o" aria-hidden="true"></i></label></a></li>-->

													</ul>
                                                    <div class="clearfix"></div>
                                                	<div class="row">
														<div class="col-xs-12">

														                  <div class="form-group row">
                                    						<label class="col-sm-12 col-form-label">Periodo</label>
                                    						<div class="col-sm-3">
                    															<select class="form-control" name="anio" id="anio" style="font-size: 12px;" required>
                                                    <option value="">[A&ntilde;o]</option>
                                                    <?php foreach ($listaAnioEjecucion->result() as $row): ?>
                                                    <option value="<?=$row->Anio_Ejecucion?>" <?=($anio==$row->Anio_Ejecucion) ? "selected" : ""?>>
                                                      <?=$row->Anio_Ejecucion?>
                                                    </option>
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
																<th align="center">Número</th>
																<th align="center">Tipo</th>
																<th align="center">Titulo</th>
																<th align="center">Fuente</th>
																<th align="center">Nivel</th>
																<th align="center">Inicio</th>
																<th align="center">Fin</th>
																<th class="text-center">MAP.</th>
																<th class="text-center">MON.</th>
																<th class="text-center">REC.</th>
																<th class="text-center">PDF</th>
																<!--<th align="center">Archivo</th>-->
																<th class="text-center">&nbsp;</th>
																<th class="text-center">Descripción</th>
																<th class="text-center">&nbsp;</th>
																<th class="text-center">&nbsp;</th>
																<th class="text-center">&nbsp;</th>
																<th class="text-center">&nbsp;</th>
																<th class="text-center">&nbsp;</th>
																<th class="text-center">&nbsp;</th>
																</tr>
															</thead>
															<tbody>
																<?php if ($listar->num_rows() > 0){
																        foreach($listar->result() as $row):
																?>
																<tr>
																	<td class="evento_avisos_numero" align="center"><?=$row->evento_avisos_anio?> - <?=addCeros4($row->evento_avisos_numero)?></td>
																	<td align="center"><?=$row->tipo_aviso1?></td>
																	<td align="left"><?=$row->titulo?></td>
																	<td><?=$row->fuente?></td>
																	<td align="center">Nivel <?=$row->nivel_peligro1?></td>
																	<td align="center"><?=$row->fecha_inicio?></td>
																	<td align="center"><?=$row->fecha_fin?></td>
																	<td align="center" class="uploadMapa"><i class="fa fa-globe cargarmapa"></i></td>
																	<td align="center" class="acciones"><i class="fa fa-wrench acciones"></i></td>
																	<td align="center" class="recomendaciones"><i class="fa fa-file-text-o recomendaciones"></i></td>
																	<?php if(strlen($row->id>0)){?><td align="center" class="reporte"><a href='<?=base_url()."eventos/eventos/informesalertaavisos/=".encriptarInforme($row->id,"ASC")?>' id="aInformeInicial" class="aInformeInicial" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td><?php } ?>
																	<td class="id"><?=$row->id?></td>
																	<td align="left"><?=$row->descripcion_general?></td>
																	<td><?=encriptarInforme($row->id,"ASC")?></td>
																	<td><?=encriptarInforme($row->id,"DESC")?></td>
																	<td><?=$row->enlace_url?></td>
																	<td align="left"><?=$row->imagenmapa?></td>
																	<td align="center"><?=$row->tipo_aviso?></td>
																	<td align="center"><?=$row->nivel_peligro?></td>
																</tr>
																<?php
    																    endforeach;
    																}
    															?>
															</tbody>
															<tbody>
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

			<?php $this->load->view("inc/footer"); ?>
		</div>
	</div>

<div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="registroModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="registroModalLabel">Alertas y Avisos</h5>
      </div>
      <div class="modal-body">

		<form id="formRegistrar" name="formRegistrar" method="post" action="" autocomplete="off">
				<input type="hidden" name="id" id="id" />
				<div class="modal-body">
					<div class="row">

						<div class="col-xs-12 col-sm-12">

							<div class="row">
            					<div class="col-xs-12">
            						<div class="form-group">
            							<label class="">T&iacute;tulo de Aviso</label>
            							<input type="text" class="form-control input-sm" name="titulo">
            						</div>
            					</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<label class="">Descripci&oacute;n General del Aviso</label>
										<textarea name="descripcion_general" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="row">

            					<div class="col-xs-12">
            						<div class="form-group">
            							<label class="">Fuente del Aviso</label>
            							<input type="text" class="form-control input-sm" name="fuente">
            						</div>
            					</div>

							</div>

							<div class="row">

							<div class="col-xs-12">
								<div class="form-group">
									<label class="">Nivel de Peligro del Aviso</label>
											<select class="form-control" name="nivel_peligro" id="nivel_peligro">
                                        		<option value="1">Nivel 1</option>
                                        		<option value="2">Nivel 2</option>
                                        		<option value="3">Nivel 3</option>
                                        		<option value="4">Nivel 4</option>
                                        	</select>
								</div>
							</div>
							</div>
							<div class="col-xs-12">
								<button class="btn btn-success" type="button" data-toggle="modal" data-target="#buscarEventosModal">Agregar Ubicación</button>
							</div>

							<div class="row">
								<div class="col-xs-12 table-max-height-overflow">

									<table id="tbEventosSeleccionados" class="table">
										<thead>
											<tr>
											<th class="text-center">Ubigeo</th>
											<th class="text-left">Región</th>
											<th class="text-left">Provincia</th>
											<th class="text-center">&nbsp;</th>
											<th class="text-center">&nbsp;</th>
											<th class="text-center">&nbsp;</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>

								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-6">
						<div class="row">
						<div class="col-xs-12 col-sm-12">
						<div class="form-group">
									<label class="">Tipo de Aviso</label>
											<select class="form-control" name="tipo_aviso" id="tipo_aviso">
                                        		<option value="0">METEOROLOGICO</option>
                                        		<option value="1">HIDROLOGICO</option>
                                        	</select>
						</div>
						</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="">Fecha Inicio</label>
									<div class='input-group date datetimepicker'>
										<input type="text" class="form-control input" required="required" name="fecha_inicio"
											   value="<?=date("d/m/Y")?>" data-date-format="DD/MM/YYYY" />
											<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="">Hora Inicio</label>
									<div class='input-group'>
										<input type="text" class="form-control dateHour input-sm" required="required" id="hora_inicio" name="hora_inicio" value="<?=date("H:i")?>" />
											<span class="input-group-addon"> <i class="fa fa-clock-o" aria-hidden="true"></i>
										</span>
									</div>
								</div>
							</div>

						</div>
						<div class="row">

							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="">Fecha Fin</label>
									<div class='input-group date'>
										<input type="text" class="form-control input" required="required" id="fecha_fin"  name="fecha_fin"
											   value="<?=date("d/m/Y")?>" data-date-format="DD/MM/YYYY" />
											<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="">Hora Fin</label>
									<div class='input-group'>
										<input type="text" class="form-control dateHour input-sm" required="required" id="hora_fin" name="hora_fin" value="<?=date("H:i")?>" />
											<span class="input-group-addon"> <i class="fa fa-clock-o" aria-hidden="true"></i>
										</span>
									</div>
								</div>
							</div>

						</div>
						<div class="row">

						<div class="col-xs-12">
							<div class="form-group">
								<label class="">Enlace URL del Aviso</label>
								<input type="text" class="form-control input-sm" name="enlace_url">
							</div>
						</div>

						</div>
						</div>

					</div>

				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
					<button class="btn btn-primary" id="btnAgregar" type="submit">Guardar</button>
				</div>
			</form>
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="accionesModal" tabindex="-1" role="dialog" aria-labelledby="accionesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="accionesModalLabel">Registro de Acciones de Avisos</h5>
      </div>
      <div class="modal-body">

		<form id="formAcciones" name="formAcciones" method="post" action="" autocomplete="off">
				<input type="hidden" name="idaccion" id="idaccion" />

				<div class="modal-body">
					<div class="row">

						<div class="col-xs-12 col-sm-4">

							<div class="row">

								<div class="col-xs-12">

							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<label class="">Regi&oacute;n</label>
										<select class="form-control" name="id_region" required="required" id="id_region">
											<option value="">-- Seleccione Región --</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<label class="">IPRESS</label>
										<select class="form-control" name="codigo_renipress">
											<option value="">-- Seleccione IPRESS --</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
            					<div class="col-xs-12">
            						<div class="form-group">
									<label class="">Tipo de Acción</label>
    								<select class="form-control form-control-sm" name="lsaccion" required="required" id="lsaccion">
    									<option value="">-- Seleccione --</option>
                    					  <?php foreach($listartipacciones as $row): ?>
                    						  <option value="<?=$row->codigoaccion?>"><?=$row->nombre?></option>
                    					  <?php endforeach; ?>
                    				</select>

									</div>
            					</div>
							</div>
							<div class="row">
            					<div class="col-xs-12">
            						<div class="form-group">
									<label class="">Fecha Accion</label>
									<div class='input-group date datetimepicker'>
										<input type="text" class="form-control input" required="required" name="fecha_accion"
											   value="<?=date("d/m/Y")?>" data-date-format="DD/MM/YYYY" />
											<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>

									</div>
            					</div>
							</div>
							<div class="row">
            					<div class="col-xs-12">
            						<div class="form-group">
									<label class="">Hora Accion</label>
									<div class='input-group'>
										<input type="text" class="form-control dateHour input-sm" required="required" name="hora_accion" value="<?=date("H:i")?>" />
											<span class="input-group-addon"> <i class="fa fa-clock-o" aria-hidden="true"></i>
										</span>
									</div>
									</div>
            					</div>
							</div>
							<div class="row">
            					<div class="col-xs-12">
            						<div class="form-group">
									<div class="form-group">
										<label class="">Descripci&oacute;n Acción</label>
										<textarea name="descripcion_accion" class="form-control"></textarea>
									</div>
									</div>
            					</div>
							</div>

							<div class="row">
            					<div class="col-xs-12">
            						<div class="form-group">
									<div class="form-group">
										<label class="">Número Sireed</label>
										<input type="hidden" name="anio_sireed" id="anio_sireed" />
										<input type="text" class="form-control input-sm" name="num_sireed" id="num_sireed" disabled>
									</div>
									</div>
            					</div>
							</div>
									<div class="col-xs-12">
										<button class="btn btn-success" type="button" data-toggle="modal" data-target="#eventosModal">Buscar Evento Sireed</button>
									</div>

								</div>
							</div>

						</div>

						<div class="col-xs-12 col-sm-8">

							<table id="tableAcciones" class="table table-striped table-bordered table-sm" width="100%">
								<thead>
									<tr>
										<th class="text-center">Región</th>
										<th class="text-center">IPRESS</th>
										<th class="text-center">Tipo de Acción</th>
										<th class="text-center">Fecha de Acción</th>
										<th class="text-center">Número Sireed</th>
										<th class="text-center">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>

						</div>

					</div>

				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
					<button class="btn btn-primary" id="btnAgregar" type="submit">Guardar</button>
				</div>
				<p id="duplicate_accion" class="text-danger text-center hide">No se pudo registrar la acción.</p>
			</form>
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="deleteAccionModal" tabindex="-1" role="dialog" aria-labelledby="deleteContingenciaModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?=base_url()?>eventos/eliminarAccionAviso">
              <div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Eliminar Acción</h5>
              </div>
              <div class="modal-body">
              	<input type="hidden" name="id" />
              	<p>&iquest;Seguro desea eliminar la Acción?</p>
              </div>
              <div class="modal-footer">
              	<button type="submit" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
	</div>

<div class="modal fade" id="recomendacionesModal" tabindex="-1" role="dialog" aria-labelledby="recomendacionesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="recomendacionesModal">Registro de Recomendaciones</h5>
      </div>
      <div class="modal-body">

		<form id="formRecomendaciones" name="formRecomendaciones" method="post" action="" autocomplete="off">
				<input type="hidden" name="idrecomendacion" id="idrecomendacion" />
				<div class="modal-body">
					<div class="row">

						<div class="col-xs-12 col-sm-4">


						<div class="row">

							<div class="col-xs-12">
								<div class="form-group">
									<label class="">Dirigido a: </label>
											<select class="form-control" name="lsrecomendacion" id="lsrecomendacion">
                                        		<option value="1">LOS ESPACIOS DE MONITOREO</option>
                                        		<option value="2">LOS ESTABLECIMIENTOS DE SALUD</option>
                                        	</select>
								</div>
							</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<label class="">Recomendación:</label>
										<textarea style="height: 150px" name="descripcion_recomendacion" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>


						<div class="col-xs-12 col-sm-8">

							<table id="tableRecomendaciones" class="table table-striped table-bordered table-sm" width="100%">
								<thead>
									<tr>
										<th class="text-center">Dirigido</th>
										<th class="text-center">Recomendación</th>
										<th class="text-center">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>

							</div>
						</div>

						</div>

				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
					<button class="btn btn-primary" id="btnAgregar" type="submit">Guardar</button>
				</div>
				<p id="duplicate_recomendacion" class="text-danger text-center hide">No se pudo registrar la Recomendación.</p>
			</form>
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="deleteRecomendacionModal" tabindex="-1" role="dialog" aria-labelledby="deleteContingenciaModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form method="post" action="<?=base_url()?>eventos/eliminarRecomendacionAviso">
              <div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Eliminar Recomendación</h5>
              </div>
              <div class="modal-body">
              	<input type="hidden" name="id" />
              	<p>&iquest;Seguro desea eliminar la Recomendación?</p>
              </div>
              <div class="modal-footer">
              	<button type="submit" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
	</div>

<div class="modal fade" id="registroModal1" tabindex="-1" role="dialog" aria-labelledby="registroModal1Label" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="registroModal1Label">Cargar Mapa</h5>
      </div>
      <div class="modal-body">

	  <form id="formRegistrarMapa" name="formRegistrarMapa" method="post" action="" autocomplete="off" enctype="multipart/form-data">
					<input type="hidden" name="mapaId" id ="mapaId" >
					<div class="modal-body">
						<div class="form-group row">
							<div class="input-group group-img">
                                <div class="custom-file">
                                    <input type="file" id="file" name="file" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="foto">Escoger imagen</label>
                              	</div>
							</div>
							</br>
                            <div id='img_contain1'>
							<img id="blah1" src="" alt="Mapa">
                            	<!--<img id="blah1" align='middle' src="<?=base_url()?>public/images/brigadistas/camera.png" alt="imagen" title=''/>-->
                            </div>

						</div>
					</div>

					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
						<button class="btn btn-primary" type="submit" id="btnAgregarMapa">Agregar</button>
						<div class="col-md-12 text-center cargando"></div>
					</div>

				</form>
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="buscarEventosModal" tabindex="-1" role="dialog" aria-labelledby="buscarEventosModalLabel" aria-hidden="true" style="margin-top: -15px;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Buscar Ubigeos</h5>
      </div>
      	<div class="modal-body">

      		<div class="row">
	  			<form name="formBuscarEventos" id="formBuscarEventos" method="post">

    				<div class="col-xs-12">

    					<div class="col-xs-12 col-sm-6 col-md-3">
    						<div class="form-group">
    							<label class="">Regi&oacute;n</label>
    							<select class="form-control form-control-sm" name="departamento" required="required" id="departamento">
    								<option value="">-- Seleccione --</option>
                    				  <?php foreach($departamentos as $row): ?>
                    					  <option value="<?=$row->Codigo_Departamento?>"><?=$row->Nombre?></option>
                    				  <?php endforeach; ?>
                    			</select>
    						</div>
						</div>
    				</div>

					<div class="col-xs-12">
						<button type="submit" class="btn btn-success">Buscar</button>
					</div>

            		</form>
    		</div>

			<div class="row">
				<div class="col-xs-12 table-max-height-overflow">
    				<div class="table-responsive">

    					<table id="tbLista" class="table table-bordered table-hover" style="width: 100%">
    						<thead>
    							<tr>
									<th class="text-center">Ubigeo</th>
									<th class="text-center">Región</th>
									<th class="text-center">Provincia</th>
									<th class="text-center">&nbsp;</th>
									<th class="text-center">&nbsp;</th>
									<th class="text-center">&nbsp;</th>
    							</tr>
    						</thead>
    						<tbody>
    						</tbody>
    					</table>
    				</div>
				</div>

			</div>

		</div>
		<div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
		</div>
      </div>
</div> <!--fin model buscar ubigeo-->

</div>
<div class="modal fade" id="eventosBuscarModal" tabindex="-1" role="dialog" aria-labelledby="eventosBuscarModalLabel" style="margin-top: -15px;">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Buscar Evento</h5>
          </div>
    	<form id="formBuscarEvento" name="formBuscarEvento" method="post" action="">
          <div class="modal-body over-hidden">
    		<div class="col-xs-12 col-sm-4">
					<input type="hidden" name="id" />
					<input type="hidden" name="Registro_Evento_Numero" />
						<div class="row"><h5>Eventos SIREED</h5></div>
						<div class="row">
    						<div class="col-xs-12 mb-10">
    							<div class="form-group">
    								<label class="col-xs-4 pa-10">C&oacute;digo</label>
    								<div class="col-xs-8">
        								<input type="text" class="form-control" name="correlativo" disabled />
        							</div>
    							</div>
    						</div>
    						<div class="col-xs-12">
    							<div class="form-group">
    								<label class="col-xs-4 pa-10">Fecha</label>
    								<div class="col-xs-8">
        								<input type="text" class="form-control" name="fecha" disabled />
        							</div>
    							</div>
    						</div>

    						<div class="col-xs-12 text-right">
    							<div class="form-group pa-10">
    								<button type="button" id="btnBuscar" class="btn btn-default">Buscar</button>
    							</div>
    						</div>

							<div class="row" id="datos" style="display: none;">

        						<div class="col-xs-12">
        							<div class="form-group text-left">
        								<label class="col-xs-4"><strong>Tipo Evento</strong></label>
        								<div class="col-xs-8">
            								<label id="tipo"></label>
            							</div>
        							</div>
        						</div>

        						<div class="col-xs-12">
        							<div class="form-group text-left">
        								<label class="col-xs-4"><strong>Evento</strong></label>
        								<div class="col-xs-8">
            								<label id="evento"></label>
            							</div>
        							</div>
        						</div>

        						<div class="col-xs-12">
        							<div class="form-group text-left">
        								<label class="col-xs-4"><strong>Detalle</strong></label>
        								<div class="col-xs-8">
            								<label id="detalle"></label>
            							</div>
        							</div>
        						</div>

        						<div class="col-xs-12">
        							<div class="form-group text-left">
        								<label class="col-xs-4"><strong>Descripci&oacute;n</strong></label>
        								<div class="col-xs-8">
            								<label id="descripcion"></label>
            							</div>
        							</div>
        						</div>
    						</div>
    					</div>
						<hr />
						<div class="row"><h5>Registro de Actividad</h5></div>
    					<div class="row">
    					<div class="clearfix"></div>
						<div class="col-xs-12">
							<div class="form-group">
								<label class="col-xs-12">Descripci&oacute;n</label>
								<div class="col-xs-12">
    								<input type="text" class="form-control" name="descripcion" />
    							</div>
    							<div class="clearfix"></div>
							</div>
						</div>
						</div>
				</div>
				<div class="col-xs-12 col-sm-8">

					<table class="tableAtencion table table-striped table-bordered table-sm" width="100%">
						<thead>
							<tr>
								<th class="text-center">N&deg;</th>
								<th>Evento Producido</th>
								<th>Fecha</th>
								<th>Ubicaci&oacute;n Evento(UBIGEO)</th>
								<th>Descripci&oacute;n</th>
								<th>Estado</th>
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

						</tbody>
					</table>

				</div>
          </div>
			<div class="modal-footer text-left">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
				<button class="btn btn-primary" type="submit" id="btnEvento" disabled>Gestionar</button>
				<div class="col-md-12 text-center cargando"></div>
			</div>
			<p id="duplicate_evento" class="text-danger text-center hide">No se pudo registrar, ya existe</p>
		</form>
        </div>
      </div>
    </div>

        <!-- MODAL BUSQUEDA -->
	<div class="modal fade" id="eventosModal" tabindex="-1" role="dialog" aria-labelledby="eventosModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document"
			style="padding-top: 10px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" id="eventosModalLabel">Seleccionar El evento</h5>

				</div>
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Filtros</label>
						<div class="col-sm-3">
							<select class="form-control" name="Anio_Ejecucion" id="Anio_Ejecucion">
								  <?php foreach($listaAnioEjecucion->result() as $row): ?>
								  <option value="<?=$row->Anio_Ejecucion?>" <?=($row->Anio_Ejecucion==date("Y"))?"selected":""?>><?=$row->Anio_Ejecucion?></option>
								  <?php endforeach; ?>
								</select>
						</div>
						<div class="col-sm-3">
							<select class="form-control" name="mes" id="mes">
							  <?php foreach($months as $row): ?>
							  <option value="<?=$row["id"]?>" <?=($row["id"]==date("m"))?"selected":""?>><?=$row["name"]?></option>
							  <?php endforeach; ?>
							</select>
						</div>

					</div>
					<table class="tableEventos table table-striped table-bordered table-sm" width="100%">
						<thead>
							<tr>
								<th class="text-center">N&deg;</th>
								<th>Evento Producido</th>
								<th>Fecha</th>
								<th>Ubicaci&oacute;n Evento(UBIGEO)</th>
								<th>Estado</th>
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
    <input id="Tipo_Accion" type="hidden" />


	<script src="<?=base_url()?>public/js/moment.min.js"></script>
	<script src="<?=base_url()?>public/js/locale.es.js"></script>
	<script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?=base_url()?>public/js/eventos/alertasPronosticos.js?v=<?=date("s")?>"></script>
	<script src="<?=base_url()?>public/js/ofertamovil/main.js?v=<?=date("s")?>"></script>

	<script>
	alertasPronosticos("<?=base_url()?>");
	main("<?=base_url()?>");
	</script>

</body>

</html>
