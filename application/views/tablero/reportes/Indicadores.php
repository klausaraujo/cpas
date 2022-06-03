<!DOCTYPE html>
<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?=TITULO_PRINCIPAL?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="<?=AUTOR?>">
	<?php $this->load->view("inc/resources");
	$titulo="Reporte de Indicadores";
	?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/tablero/indicadores.css?v=<?=date("s")?>" />
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
					<li><a href="<?=base_url()?>tablero/gestionar"><span>Tablero Control</span></a></li>
					<li class="active"><span>POI Porcentual</span></li>
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
													<div class="col-xs-12 col-md-4 pa-10">
														<div class="form-group">
															<form id="formCambioFecha" action="<?=base_url()?>tablero/ReportesBasicos/indicadores" method="POST">
																<div class="col-sm-4 pa-10"><label>Filtrar por A&ntilde;o</label></div>
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
											</div>
											<div class="clearfix"></div>
											<div class="col-xs-12 col-sm-8 col-sm-offset-2 text-center canvas-content">
												<div class="text-default"><label id="title"></label></div>
												<canvas class="d-none" id="barChart" width="400" height="300"></canvas>
											</div>
											<div class="clearfix"></div>
											<hr />

<div class="table-responsive">
          <table id="tbListar" class="table table-bordered table-sm">
          	<thead>
	          	<tr>
	          		<th>A&ntilde;o</th>
	          		<th>Indicador</th>
	          		<th>Dimensi&oacute;n</th>
	          		<th>P-I</th>
	          		<th>E-I</th>
	          		<th>P-II</th>
	          		<th>E-II</th>
	          		<th>P-III</th>
	          		<th>E-III</th>
	          		<th>P-IV</th>
	          		<th>E-IV</th>
	          		<th>&nbsp;</th>
	          	</tr>
          	</thead>
          	<tbody>
          		<?php
          			if($lista->num_rows()>0){
          			$i=0;
          			foreach($lista->result() as $row):
          		?>
	          	<tr class="<?=($i==0)?'selected':''?>">
	          		<td><?=$row->Anio?></td>
	          		<td><?=$row->Indicador?></td>
	          		<td><?=$row->Dimension?></td>
	          		<td><?=$row->P_I_Trim?></td> 
	          		<td><?=$row->E_I_Trim?></td>   		
	          		<td><?=$row->P_II_Trim?></td>
	          		<td><?=$row->E_II_Trim?></td>
	          		<td><?=$row->P_III_Trim?></td>
	          		<td><?=$row->E_III_Trim?></td>
	          		<td><?=$row->P_IV_Trim?></td>
	          		<td><?=$row->E_IV_Trim?></td>
	          		<td><?=$i?></td>
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
		</div>
    </div>
    <script src="<?=base_url()?>public/js/tablero/indicadores.js?v=<?=date("s")?>"></script>
    <script>
        var grafico = '<?=$grafico?>';
        Indicadores("<?=base_url()?>",grafico);
    </script>
</body>
</html>