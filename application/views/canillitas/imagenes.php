<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?=TITULO_PRINCIPAL?></title>
<link rel="shortcut icon" type="image/png"
	href="<?=base_url()?>public/images/favicon.png" />
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="<?=AUTOR?>">

	<?php $this->load->view("inc/resources"); ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/dropzone.css" />
    <?php $titulo = "Cargar Im&aacute;genes"; ?>
	<link href="<?=base_url()?>public/css/eventos/imagenes.css?v=<?=date("s")?>" rel="stylesheet" />

</head>

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
							<li class="active"><span>Im&aacute;genes</span></li>
						</ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-xs-12">
								<div class="panel panel-default card-view pa-0">
									<div class="panel-wrapper collapse in">
										<div class="panel-body pa-0">
											<div class="sm-data-box pa-10">
												<div class="container-fluid">
												
												<div class="alert alert-success"><h4 style="margin:0"></h4></div>
												<div class="alert alert-danger"><h4 style="margin:0"></h4></div>

													<div class="row">
														<div class="col-xs-12 pull-right">
						<?php //if($lista->num_rows()<3){	?>
							<div class="clearfix"></div>  

<?php
$dateTime = explode(" ", $danios->fecha);
?>
<div class="clearfix"></div>  
	<table id="tabla" class="table table-striped table-bordered table-response" style="margin: auto; margin-top: 25px;">
		<thead>
			<tr>
				<th class="text-center" >N&uacute;mero</th>
				<th>Lugar(Ubigeo)</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Tipo de Evento</th>
				<th>Evento</th>
				<th>Detalle del Evento</th>															
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?=$danios->ANIO." - ".addCeros5($danios->Evento_Secuencia)?></td>
				<td><?=$danios->distrito." ,".$danios->provincia." ,".$danios->departamento?></td>
				<td><?=$dateTime[0]?></td>
				<td><?=$dateTime[1]?></td>
				<td><?=$danios->Evento_Tipo_Nombre?></td>
				<td><?=$danios->Evento_Nombre?></td>
				<td><?=$danios->Evento_Detalle_Nombre?></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="clearfix"></div>  <br>						
							<button type="button" data-toggle="modal" class="btn btn-primary pull-right" data-target="#addModal">Agregar Imagen</button>
						<?php //} ?>
				</div>
													</div>

													<div class="row">

    			<?php
					
    if ($lista->num_rows() > 0) {
        $n = 1;
        foreach ($lista->result() as $row) :
            ?>
    			    <div class="col-xs-12 col-sm-4 dataImagen">
						<h3>Imagen <?=$n?></h3>
						<div class="img loadImage" style="background-image:url('<?=base_url()?>public/images/eventos/<?=$row->imagen?>');"></div>
						<div class="row">
							<div class="col-xs-12"><input class="form-control text-center" name="txtdescripcion" placeholder="Ingresar descripci&oacute;n" value="<?=$row->descripcion?>"></div>
						</div>
						<div class="clearfix"></div>
						<br />
						<div class="col-xs-12 text-center">
						<button class="btn btn-info editButton"
							rel="<?=$row->Evento_Registro_Imagen_Numero?>|<?=$row->imagen?>">Cambiar Imagen</button>
							<button class="btn btn-dark descripcionButton"
							rel="<?=$row->Evento_Registro_Imagen_Numero?>">Guardar Descripci&oacute;n</button>
						<button class="btn btn-danger deleteButton mt-10"
							rel="<?=$row->Evento_Registro_Imagen_Numero?>|<?=$row->imagen?>">Eliminar</button>
						</div>
					</div>
    			<?php
            $n ++;
        endforeach
        ;
    }
    ?>

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
            <script src="<?=base_url()?>public/js/dropzone.js"></script>
		</div>
		</div>
													<ul class="enlaces-otros">
														<li><a href="javascript:;" class="enlaceDanios" rel="danios">Registrar Da&ntilde;os Generales</a><span><i class="fa fa-home"></i></span></li>
														<li><a href="javascript:;" class="enlaceLesionados" rel="lesionados">Registrar Lesionados y Fallecidos</a><span><i class="fa fa-user"></i></span></li>
														<li><a href="javascript:;" class="enlaceEntidades" rel="entidadSalud">Registrar IPRESS Afectadas</a><span><i class="fa fa-hospital-o"></i></span></li>
														<li><a href="javascript:;" class="enlaceAcciones" rel="acciones">Registrar Acciones Realizadas</a><span><i class="fa fa-share-square"></i></span></li>
														<li class="addAsignacion"><a href="javascript:;">Gesti&oacute;n de Requerimientos</a><span class="requerimientos"><i class="fa fa-list-alt addAsignacion"></i></span></li>
														<li class="oferta-movil-aside"><a href="javascript:;">Registro de Oferta M&oacute;vil<label rel="<?=$Evento_Registro_Numero?>"></label></a><span class="oferta-movil"><i class="fa fa-ambulance"></i></span></li>
														<li><a href="javascript:;" class="enlaceFiles" rel="fileseventos">Repositorio de Archivos por Evento</a><span><i class="fa fa-file-o addFiles"></i></span></li>
														<li><a href="<?=base_url()?>eventos/eventos/informe/<?=encriptarInforme($Evento_Registro_Numero, "ASC")?>" target="_blank">Descargar Informe Inicial</a><span class="informe-inicial"><i class="fa fa-file-pdf-o"></i></span></li>
														<li><a href="<?=base_url()?>eventos/eventos/informe/<?=encriptarInforme($Evento_Registro_Numero, "DESC")?>" target="_blank">Descargar Informe Final</a><span class="informe-final"><i class="fa fa-file-pdf-o"></i></span></li>
													</ul>
													<div class="clearfix"></div>

	</div>

	<div class="modal fade" id="galleryModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Imagen</h4>
				</div>
				<div class="modal-body" style="overflow: hidden;">
					<div class="col-sm-12 gallery">
						<img src="" />
					</div>


				</div>
				<div class="clearfix"></div>

				<div class="modal-footer"></div>

				<div class="col-md-12 text-center" id="cargando"></div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="addModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Cargar Imagen</h4>
				</div>
				<div class="modal-body" style="overflow: hidden;">
					<div class="col-sm-12">

						<div class="dropzone needsclick dz-clickable" id="addUpload">

							<div class="dz-message needsclick">Arrastre o haga click</div>

						</div>

					</div>


				</div>
				<div class="clearfix"></div>

				<div class="modal-footer"></div>

				<div class="col-md-12 text-center" id="cargando"></div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-md" role="document">
			<input type="hidden" id="id" name="id" />
			<input type="hidden" id="imagen" name="imagen" />
			<input type="hidden" id="descripcion" name="descripcion" />

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Cargar Imagen</h4>
				</div>
				<div class="modal-body" style="overflow: hidden;">
					<div class="col-sm-12">

						<div class="dropzone needsclick dz-clickable" id="editUpload">

							<div class="dz-message needsclick">Arrastre o haga click</div>
						</div>
					</div>

				</div>
				<div class="clearfix"></div>

				<div class="modal-footer"></div>

				<div class="col-md-12 text-center" id="cargando"></div>
			</div>
		</div>
	</div>

	<script>
var URI = "<?=base_url()?>";
var ID_EVENTO_REGISTRO = "<?=$Evento_Registro_Numero?>";
</script>

	<script src="<?=base_url()?>public/js/eventos/imagenes.js?version=<?=date("Ymdihs")?>"></script>
</body>

</html>
