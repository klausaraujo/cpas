<footer class="footer hidden-xs pl-30 pr-30">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<p>
					<?=date("Y")?>
					<?=COPY_RIGHT?>
				</p>
			</div>
			<div class="col-sm-6 text-right">
				<p>Estamos en</p>
				<a href="https://es-la.facebook.com/digerd.minsa/" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="https://twitter.com/digerd_minsa?lang=es" target="_blank"><i class="fa fa-twitter"></i></a>
			</div>
		</div>
	</div>
</footer>

<div class="modal fade" id="alertaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	style="margin-top: -15px;">
	<div class="modal-dialog" role="document" style="width: 400px!important;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="tituloalerta"></h4>
			</div>
			<div class="modal-body" style="margin-bottom:10px;">
				<p id="mensajealerta"></p>
				<div class="clearfix"></div>

			</div>
			<div class="clearfix"></div>

			<div class="modal-footer">
				<button type="reset" class="btn btn-warning" data-dismiss="modal">Aceptar</button>
			</div>

			<div class="col-md-12 text-center" id="cargando"></div>

		</div>
	</div>
</div>

<div class="modal fade" id="decisionModal" tabindex="-1" role="dialog" aria-labelledby="decisionModalLabel"
	style="margin-top: -15px; z-index: 2600;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title">Confirmaci&oacute;n</h5>
			</div>
			<div class="modal-body">
				<p></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" id="btn-decision">Eliminar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
			<div class="col-md-12 text-center cargando"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="condicionModal" tabindex="-1" role="dialog" aria-labelledby="condicionModalLabel"
	style="margin-top: -15px;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title">Confirmaci&oacute;n</h5>
			</div>
			<div class="modal-body">
				<p></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" id="btn-proceder">Proceder</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
			<div class="col-md-12 text-center cargando"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="ofertaMovilModal" tabindex="-1" role="dialog" aria-labelledby="ofertaMovilModal"
	aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
				</button>
				<h4 class="modal-title" id="ofertaMovilModalLabel">Oferta Movil</h4>
			</div>
			<form id="formRegistrarOfertaMovil" name="formRegistrarOfertaMovil" method="post" action="">
				<input type="hidden" id="Evento_Registro_Numero" name="Evento_Registro_Numero" />
				<div class="modal-body">

					<div class="col-xs-12">
						<div class="form-group">
							<label for="fechaRegistro">Nombre</label>
							<input type="text" class="form-control"
								name="Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre" autocomplete="off" />
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<label class="">Entidad Atencion</label>
							<select class="form-control" name="Evento_Tipo_Entidad_Atencion_ID">
								<option value="">-- Seleccione --</option>
								<?php
if (isset($listaEntidadAtencion)) {
    foreach ($listaEntidadAtencion as $row): ?>
								<option value="<?=$row->id?>">
									<?=$row->Evento_Tipo_Entidad_Atencion_Nombre?>
								</option>
								<?php endforeach;
}
?>
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

<div class="modal fade" id="deleteOfertaMovilModal" tabindex="-1" role="dialog"
	aria-labelledby="deleteOfertaMovilModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="deleteOfertaMovilForm" method="post">
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

<div class="modal fade" id="eventosAsociadosModal" tabindex="-1" role="dialog" aria-labelledby="eventosAsociadosModal"
	aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
				</button>
				<h4 class="modal-title" id="eventosAsociadosModalLabel">Eventos Asociados</h4>
			</div>
			<form id="formRegistrarEventosAsociados" name="formRegistrarEventosAsociados" method="post" action="">
				<input type="hidden" id="Evento_Registro_Numero" name="Evento_Registro_Numero" />
				<div class="modal-body">

					<div class="col-xs-12">
						<div class="form-group">
							<label for="desceventoasociado">Descripción del Evento Asociado</label>
							<input type="text" class="form-control"
							id="Evento_Asociado_Descripcion" name="Evento_Asociado_Descripcion" autocomplete="off" style="text-transform:uppercase;"/>
						</div>
					</div>

					<div class="col-xs-12 table-wrapper">
						<table id="tableEventoAsociado" class="table">
							<thead>
								<tr>
									<th class="text-center">Evento Asociado</th>
									<th class="text-center">Estado</th>
									<th class="text-left">Activar</th>
									<th class="text-left">Desactivar</th>
									<th class="text-left">Anular</th>
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

<div class="modal fade" id="deleteEventoAsociadoModal" tabindex="-1" role="dialog"
	aria-labelledby="deleteEventoAsociadoModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="deleteEventoAsociadoForm" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Anular Evento Asociado</h5>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" />
					<input type="hidden" name="estado" value='2'/>
					<p>&iquest;Seguro que desea Anular el Evento Asociado?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">Anular</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="activarEventoAsociadoModal" tabindex="-1" role="dialog"
	aria-labelledby="activarEventoAsociadoModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="activarEventoAsociadoForm" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Activar Evento Asociado</h5>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" />
					<input type="hidden" name="estado" value='1'/>
					<p>&iquest;Seguro desea Activar el Evento Asociado?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Activar</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="desactivarEventoAsociadoModal" tabindex="-1" role="dialog"
	aria-labelledby="desactivarEventoAsociadoModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="desactivarEventoAsociadoForm" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Desactivar Evento Asociado</h5>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" />
					<input type="hidden" name="estado" value='0'/>
					<p>&iquest;Seguro desea Desactivar el Evento Asociado?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">Desactivar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="asignacionModal" tabindex="-1" role="dialog" aria-labelledby="activateModal">
	<div class="modal-dialog modal-xl" role="document">

		<input type="hidden" id="hIdUsuario" value="" />
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title">Asignaci&oacute;n Sedes autorizadas</h5>
			</div>
			<div class="modal-body">
				<div class="row">

					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#opcion1">Medicamentos e insumos</a></li>
						<li><a data-toggle="tab" href="#opcion2">Equipos, Mobiliario y oferta movil</a></li>
						<li><a data-toggle="tab" href="#opcion3">Recursos Humanos</a></li>
					</ul>

					<div class="tab-content">
						<div id="opcion1" class="tab-pane fade in active">

							<br />
							<div class="clearfix"></div>
							<div class="col-xs-12 col-sm-6">

								<form id="formMedicamentos" method="post" autocomplete="off">
									<input type="hidden" name="id" />
									<div class="form-group row">
										<label for="tipoEvento" class="col-sm-4 col-form-label">Art&iacute;culo</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" name="evento_medicamentos_articulo">
										</div>
									</div>
									<div class="form-group row">
										<label for="tipoEvento"
											class="col-sm-4 col-form-label">Presentaci&oacute;n</label>
										<div class="col-sm-8">
											<select class="form-control" name="evento_medicamentos_presentacion_id">
												<option value="">-- Seleccione --</option>
												<?php
if (isset($medicamentos)) {
    foreach ($medicamentos->result() as $row): ?>
												<option value="<?=$row->id?>">
													<?=$row->evento_medicamentos_presentacion?>
												</option>
												<?php endforeach;}
?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="tipoEvento" class="col-sm-4 col-form-label">Cantidad</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" name="evento_medicamentos_cantidad">
										</div>
									</div>
									<div class="form-group row">
										<label for="tipoEvento" class="col-sm-4 col-form-label">Prioridad</label>
										<div class="col-sm-8">
											<select class="form-control" name="evento_medicamentos_prioridad">
												<option value="">-- Seleccione --</option>
												<option value="1">Muy Alta</option>
												<option value="2">Alta</option>
												<option value="3">Media</option>
												<option value="4">Baja</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Agregar</button>
									</div>

								</form>

							</div>

							<div class="col-xs-12 col-sm-6 table-wrapper">
								<table id="tableMedicamentos" class="table">
									<thead>
										<tr>
											<th class="text-center">Art&iacute;culo</th>
											<th class="text-center">Presentaci&oacute;n</th>
											<th class="text-center">Cantidad</th>
											<th class="text-center">&nbsp;</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
								<p id="duplicate_medicamento" class="text-danger text-center hide">No se pudo registrar,
									ya existe</p>
							</div>
						</div>
						<div id="opcion2" class="tab-pane fade in">

							<br />
							<div class="clearfix"></div>

							<div class="col-xs-12 col-sm-6">

								<form id="formEquipos" method="post" autocomplete="off">
									<input type="hidden" name="id" />
									<div class="form-group row">
										<label for="tipoEvento" class="col-sm-4 col-form-label">Equipo</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" name="evento_equipos_descripcion">
										</div>
									</div>
									<div class="form-group row">
										<label for="tipoEvento" class="col-sm-4 col-form-label">Fuente de
											Energ&iacute;a</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" name="evento_equipos_fuente">
										</div>
									</div>
									<div class="form-group row">
										<label for="tipoEvento" class="col-sm-4 col-form-label">Cantidad</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" name="evento_equipos_cantidad">
										</div>
									</div>
									<div class="form-group row">
										<label for="tipoEvento" class="col-sm-4 col-form-label">Prioridad</label>
										<div class="col-sm-8">
											<select class="form-control" name="evento_equipos_prioridad">
												<option value="">-- Seleccione --</option>
												<option value="1">Muy Alta</option>
												<option value="2">Alta</option>
												<option value="3">Media</option>
												<option value="4">Baja</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Agregar</button>
									</div>

								</form>

							</div>

							<div class="col-xs-12 col-sm-6 table-wrapper">
								<table id="tableEquipos" class="table">
									<thead>
										<tr>
											<th class="text-center">Equipo</th>
											<th class="text-center">Fuente Energ&iacute;a</th>
											<th class="text-center">Cantidad</th>
											<th class="text-center">&nbsp;</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
								<p id="duplicate_equipo" class="text-danger text-center hide">No se pudo registrar, ya
									existe</p>
							</div>

						</div>
						<div id="opcion3" class="tab-pane fade in">

							<br />
							<div class="clearfix"></div>
							<div class="col-xs-12 col-sm-6">

								<form id="formRecursos" method="post" autocomplete="off">
									<input type="hidden" name="id" />
									<div class="form-group row">
										<label for="tipoEvento" class="col-sm-4 col-form-label">Profesi&oacute;n</label>
										<div class="col-sm-8">
											<input class="form-control" type="text"
												name="evento_recursos_humanos_profesion">
										</div>
									</div>
									<div class="form-group row">
										<label for="tipoEvento" class="col-sm-4 col-form-label">Especialidad</label>
										<div class="col-sm-8">
											<input class="form-control" type="text"
												name="evento_recursos_humanos_especialidad">
										</div>
									</div>
									<div class="form-group row">
										<label for="tipoEvento" class="col-sm-4 col-form-label">Cantidad</label>
										<div class="col-sm-8">
											<input class="form-control" type="text"
												name="evento_recursos_humanos_cantidad">
										</div>
									</div>
									<div class="form-group row">
										<label for="tipoEvento" class="col-sm-4 col-form-label">Prioridad</label>
										<div class="col-sm-8">
											<select class="form-control" name="evento_recursos_humanos_prioridad">
												<option value="">-- Seleccione --</option>
												<option value="1">Muy Alta</option>
												<option value="2">Alta</option>
												<option value="3">Media</option>
												<option value="4">Baja</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Agregar</button>
									</div>

								</form>

							</div>

							<div class="col-xs-12 col-sm-6 table-wrapper">
								<table id="tableRecursos" class="table">
									<thead>
										<tr>
											<th class="text-center">Profesi&oacute;n</th>
											<th class="text-center">Especialidad</th>
											<th class="text-center">Cantidad</th>
											<th class="text-center">&nbsp;</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
								<p id="duplicate_recurso" class="text-danger text-center hide">No se pudo registrar, ya
									existe</p>
							</div>

						</div>
					</div>
						<div class="clearfix"></div>
					<br />

				</div>
			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteMedicamentoModal" tabindex="-1" role="dialog" aria-labelledby="">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="deleteMedicamentoForm" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Eliminar Medicamentos e Insumos</h5>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" />
					<p>&iquest;Seguro desea eliminar el registro?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">Eliminar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteEquipoModal" tabindex="-1" role="dialog" aria-labelledby="">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="deleteEquipoForm" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Eliminar Equipo, Mobiliario y Oferta movil</h5>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" />
					<p>&iquest;Seguro desea eliminar el registro?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">Eliminar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteRecursoModal" tabindex="-1" role="dialog" aria-labelledby="">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="deleteRecursoForm" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Eliminar Recurso Humano</h5>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" />
					<p>&iquest;Seguro desea eliminar el registro?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">Eliminar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $uuid = $this->session->userdata("uuid");?>

<div id="modalCargaGeneral">
	<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
</div>

<script>
	var URI = "<?=base_url()?>";
	var uuid = '<?=$uuid?>'
	var pubnubUtil = new PubNub({
		publishKey: 'pub-c-0c02c6e7-3e26-4a0c-ad95-d3e65041d04d',
		subscribeKey: 'sub-c-e13ed710-2d20-11ea-a5fd-f6d34a0dd71d'
	});
</script>

<script src="<?=base_url()?>public/js/jquery.min.js"></script>

<script src="<?=base_url()?>public/js/bootstrap.min.js"></script>

<script src="<?=base_url()?>public/js/datatables.min.js"></script>

<script src="<?=base_url()?>public/js/jquery.slimscroll.js"></script>

<script src="<?=base_url()?>public/js/jquery.waypoints.min.js"></script>

<script src="<?=base_url()?>public/js/jquery.counterup.min.js"></script>

<script src="<?=base_url()?>public/js/dropdown-bootstrap-extended.js"></script>

<script src="<?=base_url()?>public/js/jquery.sparkline.min.js"></script>

<script src="<?=base_url()?>public/js/owl.carousel.min.js"></script>

<script src="<?=base_url()?>public/js/switchery.min.js"></script>

<script src="<?=base_url()?>public/js/jquery-jvectormap-2.0.2.min.js"></script>

<script src="<?=base_url()?>public/js/jquery-jvectormap-us-aea-en.js"></script>

<script src="<?=base_url()?>public/js/jquery-jvectormap-world-mill-en.js"></script>

<script src="<?=base_url()?>public/js/vectormap-data.js"></script>

<script src="<?=base_url()?>public/js/jquery.toast.min.js"></script>

<script src="<?=base_url()?>public/js/jquery.peity.min.js"></script>

<script src="<?=base_url()?>public/js/peity-data.js"></script>

<script src="<?=base_url()?>public/js/echarts-en.min.js"></script>

<script src="<?=base_url()?>public/js/raphael.min.js"></script>

<script src="<?=base_url()?>public/js/morris.min.js"></script>

<script src="<?=base_url()?>public/js/jquery.toast.min.js"></script>

<script src="<?=base_url()?>public/js/Chart.min.js"></script>

<script src="<?=base_url()?>public/js/init.js"></script>

<script src="<?=base_url()?>public/js/dashboard-data.js"></script>

<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>

<script>

	$("#busquedaEvento").keyup(function () {

		var evento = $(this).val();

		$.ajax({
			type: "POST",
			url: "<?=base_url()?>",
			data: { nombre: nombre },
			beforeSend: function () {
				$("#search-box").css("background", "#FFF url('<?=base_url()?>img/LoaderIcon.gif') no-repeat 165px");
			},
			success: function (data) {
				$("#suggesstion-box").show();
				$("#suggesstion-box").html(data);
				$("#search-box").css("background", "#FFF");
			}
		});
	});

	pubnubUtil.subscribe({
		channels: [`channel-${uuid}`]
	});

	pubnubUtil.addListener({
		message: function (message) {
			const { message: { msg = "", orden = 0, user = "" }, channel } = message;

			$.toast({
				heading: `Nuevo mensaje de ${user}`,
				text: `Tiene un nuevo mensaje en la bandeja <br> <a href="${URI}usuario/inbox">ver mensajes</a>.`,
				hideAfter: 4000,
				loaderBg: '#337ab7',
				icon: 'success'
			})

		}
	})

</script>