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
</head>
<body>
	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
		<?php $this->load->view("inc/nav"); ?>
		<div class="page-wrapper" style="min-height: 710px;">
			<div class="container pt-30">
				<div class="row heading-bg">
					<div class="col-md-8 col-xs-12">
						<h5 class="txt-dark"></h5>
					</div>					
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-xs-12">
								<div class="panel panel-default card-view pa-0">
									<div class="panel-wrapper collapse in">
										<div class="panel-body pa-10">
											<div class="sm-data-box">
												<div class="container-fluid">
													<div class=" col-md-4 col-md-offset-4 col-sm-offset-3 col-sm-6 col-xs-12"><img class="one-hundred" src="<?=base_url()?>public/images/construccion.jpg" /></div>
													<div class="col-xs-12"><h1 class="text-center nonecase-font mb-20 block error-comment font-32">Esta secci&oacute;n a&uacute;n se encuentra en construcci&oacute;n</h1></div>
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
	<script>
	</script>
</body>
</html>