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
	$titulo="Gestionar Tareas";
	$botonCrear = "Registrar Tarea";
	?>
	<link rel="stylesheet"
	href="<?=base_url()?>public/css/tablero/gestionarTarea.css?v=<?=date("s")?>" />
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
					<li><a href="#"><span>Tablero Control</span></a></li>
					<li class="active"><span>Tareas</span></li>
				  </ol>
				</div>
			</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-xs-12"><!-- col-sm-8 col-sm-offset-2  -->
								<div class="panel panel-default card-view pa-0">
									<div class="panel-wrapper collapse in">
										<div class="panel-body pa-0">
											<div class="sm-data-box pa-10">
												<div class="container-fluid">
		<?php $message = $this->session->flashdata('mensajeSuccess'); ?>
		<?php if($message){ ?>
			<div class="alert alert-success"><span><?= $message ?></span></div>
		<?php } ?>
		<?php $message = $this->session->flashdata('mensajeError'); ?>
		<?php if($message){ ?>
			<div class="alert alert-danger"><span><?= $message ?></span></div>
		<?php } ?>
		<?php $message = $this->session->flashdata('mensajeWarning'); ?>
		<?php if($message){ ?>
			<div class="alert alert-warning"><span><?= $message ?></span></div>
		<?php } ?>
<div class="row pt-10 pb-10">
			<div class="col-xs-12 col-md-4">
				<div class="form-group">
					<form id="formCambioFecha" action="<?=base_url()?>/tablero/tarea" method="POST">
						<div class="col-sm-4 pt-10"><label>Filtrar por A&ntilde;o</label></div>
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
				<div class="col-xs-12 col-md-6 col-md-offset-2 pull-right pt-10">
					<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#registrarModal">
						 <?=$botonCrear?>
					</button>
				</div>
</div>
   	<div class="table-responsive">
          <table id="tbListar" class="table table-bordered table-sm">
          	<thead>
	          	<tr>
	          		<th>#</th>
	          		<th>Tarea</th>
	          		<th>Costo</th>
	          		<th>Duraci&oacute;n D&iacute;as</th>
	          		<th>F. Inicio</th>
	          		<th>F. Fin</th>
	          		<th>Estado</th>
	          		<th>&nbsp;</th>
	          		<th>&nbsp;</th>
	          	</tr>
          	</thead>
          	<tbody>
          		<?php
          			if($lista->num_rows()>0){
          			$i=1;
          			foreach($lista->result() as $row):
          		?>
	          	<tr>
	          		<td align="center"><?=$i?></td>
	          		<td><?=$row->Nombre_Tarea?></td>
	          		<td align="center"><?=$row->Costo_Tarea?></td>
	          		<td align="center"><?=$row->Duracion_Dias?></td>
	          		<td align="center"><?=formatearFechaParaVista($row->Fecha_Inicio)?></td>
	          		<td align="center"><?=formatearFechaParaVista($row->Fecha_Fin)?></td>
	          		<td align="center">
	          			<?php if($row->Activo=="1"){ ?>
	          				<span class="badge badge-success">Activo</span>
	          		<?php }else{ ?>
	          				<span class="badge badge-warning">Inactivo</span>
	          		<?php } ?>
	          		</td>
	          		<td align="center">
	          			<button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button"><i class="fa fa-pencil-square-o"></i></button>
	          		</td>
	          		<td align="center">
	          			<button class="btn btn-danger btn-circle actionDelete" title="ELIMINAR" type="button"><i class="fa fa fa-trash-o"></i></button>
	          		</td>
	          		<td><?=$row->Anio_Ejecucion?></td>
	          		<td><?=$row->Codigo_Indicador?></td>
	          		<td><?=$row->Codigo_Tarea?></td>
	          		<td><?=$row->Activo?></td>
	          	</tr>
	          	<?php
	          		$i++;
	          		endforeach;
          			}
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
			<?php $this->load->view("inc/footer"); ?>
        	<script src="<?=base_url()?>public/js/moment.min.js"></script>
			<script src="<?=base_url()?>public/js/locale.es.js"></script>
        	<script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>
		</div>
    </div>
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTablero">
    <div class="modal-dialog" role="document">
        <form action="<?=base_url()?>tablero/tarea/eliminar" method="POST">
            <input type="hidden" name="Anio_Ejecucion" value="" readonly />
            <input type="hidden" name="Codigo_Indicador" value="" readonly />
            <input type="hidden" name="Codigo_Tarea" value="" readonly />
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Borrar Tarea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    &iquest;Seguro(a) desea Borrar la tarea n&uacute;mero <strong id="numero"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info">Borrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="registrarModal" tabindex="-1" role="dialog" aria-labelledby="registrarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="registrarTableroModalLabel">Registrar Tarea</h5>
      </div>
		<form id="formRegistrar" name="formRegistrar" action="<?=base_url()?>tablero/tarea/registrar" method="POST">
      <div class="modal-body" style="margin-bottom:30px">
	    	<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
					<label class=""><span style="color:red">* </span>Indicador</label>
						<select class="form-control" name="Codigo_Indicador" style="font-size:12px;" required>
							<option value="">[Seleccione Proceso]</option>
							<?php foreach($listaIndicador->result() as $row): ?>
							<option value="<?=$row->Codigo_Indicador?>"><?=$row->Codigo_Indicador." - ".$row->Nombre_Indicador?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group">
						<label class="">A&ntilde;o</label>
						<select class="form-control" name="Anio_Ejecucion"
							style="font-size: 12px;" required>
							<option value="">[A&ntilde;o]</option>
							<?php foreach($listaAnioEjecucion->result() as $row): ?>
							<option value="<?=$row->Anio_Ejecucion?>"><?=$row->Anio_Ejecucion?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group">
					<label class="">Costo Tarea</label>
						<input type="text" class="form-control" name="Costo_Tarea" value="" placeholder="Ej. 1200.50" />
					</div>
				</div>
	    		<div class="col-xs-4">
					<div class="form-group">
					<label class="">Duraci&oacute;n D&iacute;as</label>
						<input type="text" class="form-control" name="Duracion_Dias" value="" readonly />
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group">
					<label class="">Fecha inicio</label>
						<input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="Fecha_Inicio" value="" autocomplete="off" />
					</div>
				</div>
	    		<div class="col-xs-4">
					<div class="form-group">
					<label class="">Fecha Fin</label>
						<input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="Fecha_Fin" value="" autocomplete="off" />
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group">
					<label class=""><span style="color:red">* </span>Estado</label>
						<select class="form-control" name="Activo" style="font-size:12px;" required>
							<option value="1">Activo</option>
							<option value="0">Inactivo</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
					<label class="">Nombre Tarea</label>
						<textarea class="form-control" name="Nombre_Tarea"></textarea>
					</div>
				</div>
			</div>
      </div>
      <div class="modal-footer">
        	<button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<div class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registrarTableroModalLabel">Editar Tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	<form id="formActualizar" action="<?=base_url()?>tablero/tarea/actualizar" method="POST">
      <div class="modal-body" style="margin-bottom:30px">
           <input type="hidden" name="Codigo_Indicador" value="" />
		       <input type="hidden" name="Anio_Ejecucion" value="" />
           <input type="hidden" name="Codigo_Tarea" value="" />
    	<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
					<label class=""><span style="color:red">* </span>Indicador</label>
						<select class="form-control" id="Codigo_Indicador" style="font-size:12px;" disabled>
							<option value="">[Seleccione Proceso]</option>
							<?php foreach($listaIndicador->result() as $row): ?>
							<option value="<?=$row->Codigo_Indicador?>"><?=$row->Codigo_Indicador." - ".$row->Nombre_Indicador?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group">
						<label class="">A&ntilde;o</label>
						<input type="text" class="form-control" id="Anio_Ejecucion" readonly />
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group">
					<label class="">Costo Tarea</label>
						<input type="text" class="form-control" name="Costo_Tarea" id="Costo_Tarea" value="" placeholder="Ej. 12.50"  />
					</div>
				</div>
	    		<div class="col-xs-4">
					<div class="form-group">
					<label class="">Duraci&oacute;n D&iacute;as</label>
						<input type="text" class="form-control" name="Duracion_Dias" id="Duracion_Dias" value="" readonly />
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group">
					<label class="">Fecha inicio</label>
						<input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="Fecha_Inicio" id="Fecha_Inicio" value="" autocomplete="off" />
					</div>
				</div>
	    		<div class="col-xs-4">
					<div class="form-group">
					<label class="">Fecha Fin</label>
						<input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="Fecha_Fin" id="Fecha_Fin" value="" autocomplete="off" />
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group">
					<label class=""><span style="color:red">* </span>Estado</label>
						<select class="form-control" name="Activo" id="Activo" style="font-size:12px;" required>
							<option value="1">Activo</option>
							<option value="0">Inactivo</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
					<label class="">Nombre Tarea</label>
						<textarea class="form-control" name="Nombre_Tarea" id="Nombre_Tarea"></textarea>
					</div>
				</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
       </form>
    </div>
  </div>
</div>
<script src="<?=base_url()?>public/js/tablero/gestionarTarea.js?v=<?=date("s")?>"></script>
<script>
gestionarTarea();
</script>
</body>
</html>