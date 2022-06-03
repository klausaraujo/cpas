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
	<?php $titulo = "Lista de Eventos por Oferta movil"; ?>
	<link rel="stylesheet"
	href="<?=base_url()?>public/css/eventos/listaEventos.css?v=<?=date("s")?>" />
	<?php $opciones = $this->session->userdata("Permisos_Opcion"); ?>
</head>
<body>
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
	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
	<?php $this->load->view("inc/nav"); ?>
		<div class="page-wrapper" style="min-height: 710px;">
			<div class="container pt-30">
				<div class="row heading-bg">
					<div class="col-sm-6 col-xs-12">
						<h5 class="txt-dark"><?=$titulo?></h5>
					</div>
					<div class="col-md-6 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="<?=base_url()?>">Inicio</a></li>
							<li><a href="<?=base_url()?>ofertamovil"><span>Oferta Movil</span></a></li>
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
																<?php //if(validarPermisosOpciones(13,$opciones)){ ?>
																<li data-toggle="modal" data-target="#eventosModal" class="oferta-movil"><label rel=""><span>Enlazar Evento</span><i class="fa fa-file-text-o" aria-hidden="true"></i></label></li>
																<?php //} ?>
													</ul>
													<div class="clearfix"></div>
													<hr />
													<div class="col-md-6 col-sm-8 col-xs-12">
                                                      <table class="table table-bordered tableEtiqueta">
														<tbody>
                                                      	<tr>
                                                            <td>Ficha de Atenci&oacute;n <i class="fa fa-file-code-o pull-right mt-5" aria-hidden="true"></i></td>
                                                            <td>Oferta Movil <i class="fa fa-ambulance pull-right mt-5" aria-hidden="true"></i></td>
                                                        </tr>
                                                       </tbody>
                                                      </table>
                                                    </div>
                                                    <div class="clearfix"></div>
													<div class="table-responsive">
														<table class="table table-bordered table-hover tbLista">
															<thead>
																<tr>
																	<th class="text-center">N&deg;</th>
																	<th>Evento Producido</th>
																	<th>Fecha</th>
																	<th>Ubicaci&oacute;n Evento(UBIGEO)</th>
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
																	<th>Estado</th>
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
																	<th>&nbsp;</th>
																</tr>
															</thead>
															<tbody>
                                        			<?php
                                        $n = 1;
                                        foreach ($lista as $row) :
                                            ?>
                                        			<tr>
																	<td align="center"><?=$row["codigo"]?></td>
																	<td><?=$row["evento"]?></td>
																	<td><?=$row["fecha"]?></td>
																	<td><?=$row["ubigeo"]?></td>
																	<td class="text-center">                                    					
        																<?php //if(validarPermisosOpciones(2,$opciones)){ ?>
        																<i class="fa fa-file-code-o fichaAtencion" rel='<?=base64_encode($row["Evento_Registro_Numero"])?>' aria-hidden="true"></i>
        																<?=$row["total"]?><?php /* }*/ ?>
                                        							</td>
                                        							<td class="text-center">
                                    					<?php if($row["Evento_Estado_Codigo"]!="1"){ ?> 
															<?php /*if(validarPermisosOpciones(2,$opciones)){*/?><i class="fa fa-ambulance disabled" aria-hidden="true"></i><?php /*}*/ ?>
                                        				<?php }else{?>
															<?php /*if(validarPermisosOpciones(3,$opciones)){*/?><i class="fa fa-ambulance ofertaMovil" aria-hidden="true"></i><?php /*}*/ ?>
                                        				<?php } ?>
                                        							</td>
																	<td class="text-center">
																	<?php

																		$html = '';
																		switch ($row["Evento_Estado_Codigo"]) {
																			case 1:
																				$html = '<span class="label label-success">Monitoreo</span>';
																				break;
																			case 2:
																				$html = '<span class="label label-default">Cerrado</span>';
																				break;
																		}
																		echo $html;
																		?></td>
																	<td><?=$row["Evento_Registro_Numero"]?></td>
																	<td><?=$row["orden"]?></td>
																	<td><?=$row["Evento_Estado_Codigo"]?></td>
																</tr>
                                    						<?php
                                                                $n++;
                                                                endforeach;
                                                            ?>
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
	<div class="modal fade" id="ofertaMovilModal" tabindex="-1" role="dialog" aria-labelledby="ofertaMovilModal" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
					</button>
					<h4 class="modal-title" id="daniosModalLabel">Oferta Movil</h4>
				</div>
				<form id="formRegistrarOfertaMovil" name="formRegistrarOfertaMovil" method="post" action="">
					<input type="hidden" id="Evento_Registro_Numero" name="Evento_Registro_Numero" />
					<div class="modal-body">
						<div class="col-xs-12">						
    						<div class="form-group">
                                <label for="fechaRegistro">Nombre</label>
                                <input type="text" class="form-control" name="Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre" autocomplete="off" />
                             </div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<label class="">Entidad Atencion</label>
								<select class="form-control" name="Evento_Tipo_Entidad_Atencion_ID">
									<option value="">-- Seleccione --</option>
									<?php foreach($listaEntidadAtencion as $row): ?>
										<option value="<?=$row->id?>"><?=$row->Evento_Tipo_Entidad_Atencion_Nombre?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-12 table-wrapper">
							<table id="tableOfertaMovil" class="table">
								<thead>
									<tr>
										<th class="text-center">Nombre</th>
										<th class="text-center">Entidad</th>
										<th class="text-center">&nbsp;</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
						<button class="btn btn-primary" type="submit">Agregar</button>
						<div class="col-md-12 text-center cargando"></div>
					</div>
					<p id="duplicate_movil" class="text-danger text-center hide">No se pudo registrar, ya existe</p>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="deleteOfertaMovilModal" tabindex="-1" role="dialog" aria-labelledby="deleteOfertaMovilModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form id="deleteOfertaMovilForm" method="post" action="<?=base_url()?>ofertamovil/main/eventoTipoEntidadAtencionOfertaMovilEliminar">
              <div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Eliminar Oferta Movil</h5>
              </div>
              <div class="modal-body">
              	<input type="hidden" name="id" />
              	<p>&iquest;Seguro desea eliminar la oferta movil?</p>
              </div>
              <div class="modal-footer">
              	<button type="submit" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
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
						<label class="col-sm-12 col-form-label">Datos del Ubigeo</label>
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
			<?php $this->load->view("inc/footer"); ?>
		</div>
	</div>
	<script src="<?=base_url()?>public/js/ofertamovil/listaEventosFicha.js?v=<?=date("s")?>"></script>
	<script>
    listaEventos("<?=base_url()?>");
	</script>
</body>
</html>