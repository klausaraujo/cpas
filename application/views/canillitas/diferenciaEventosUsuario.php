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
	<?php $titulo = "Eventos usuario"; ?>
	<link rel="stylesheet"
	href="<?=base_url()?>public/css/eventos/diferenciaEventosUsuario.css?v=<?=date("his")?>" />
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
							<li><a href="#"><span>Reportes</span></a></li>
							<li class="active"><span>Usuario Eventos</span></li>
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

													<div class="table-responsive">

														<table class="table table-bordered table-hover tbLista">
															<!-- dataTables-example -->
															<thead>
																<tr>
																	<th class="text-center">C&oacute;digo</th>
																	<th class="text-center">Usuario</th>
																	<th class="text-center">Apellidos</th>
																	<th class="text-center">Nombre</th>
																	<th class="text-center">Eventos</th>
																	<th>&nbsp;</th>

																</tr>
															</thead>
															<tbody>
                                        			<?php

													if($lista->num_rows()>0){
														foreach($lista->result() as $row):
													?>
														<tr>
															<td align="center"><?=$row->Codigo_Usuario?></td>
															<td align="center"><?=$row->Usuario?></td>
															<td align="center"><?=$row->Apellidos?></td>
															<td align="center"><?=$row->Nombres?></td>
															<td align="center"><?=$row->total?></td>
															<td align="center"><?=$row->Codigo_Usuario?></td>
														</tr>
                                    				<?php
														endforeach;
													}
													?>
                                        			</tbody>
														</table>

													</div>
													<!-- table -->

													<div class="clearfix"></div>
													<br />
													<hr />
													<br />

													<input type="hidden" id="hIdUsuario" />
													<div class="table-responsive">

														<table class="table table-bordered table-hover tbListaDiferencia">
															<!-- dataTables-example -->
															<thead>
																<tr>
																	<th width="20%" class="text-center">Evento</th>
																	<th width="20%" class="text-center">Ubicaci&oacute;n</th>
																	<th class="text-center">F. Evento<br />Usuario</th>
																	<th class="text-center">F. Registro<br />Sistema</th>
																	<th width="15%" class="text-center">Horas<br />Transcurridas</th>
																	<th class="text-center">Estado</th>
																</tr>
															</thead>
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

	<script src="<?=base_url()?>public/js/eventos/diferenciaEventosUsuario.js?v=<?=date("his")?>"></script>
	<script>
    diferenciaEventosUsuario("<?=base_url()?>");
	</script>

</body>

</html>
