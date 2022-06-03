<!DOCTYPE html>
<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />    
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?=TITULO_PRINCIPAL?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="<?=AUTOR?>">
	<link rel="shortcut icon" href="<?=base_url()?>public/images/favicon.png">
	<link rel="icon" href="<?=base_url()?>public/images/favicon.png" type="image/x-icon">
	<link href="<?=base_url()?>public/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="preloader-it" style="display: none;">
			<div class="la-anim-1 la-animate"></div>
		</div>
		<div class="wrapper  error-page pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="<?=base_url()?>">
						<img class="brand-img error-icon" src="<?=base_url()?>public/images/logo-brand-responsive.jpg" alt="SIGAIN">
						<span class="brand-text full error-icon"><img src="<?=base_url()?>public/images/logo-brand-full.png" alt="SIGAIN"></span>
						<span class="brand-text responsive error-icon"><img src="<?=base_url()?>public/images/logo-brand-responsive.jpg" alt="SIGAIN"></span>
					</a>
				</div>
				<div class="form-group mb-0 pull-right">
					<a class="inline-block btn btn-danger btn-rounded nonecase-font" href="<?=base_url()?>">Regresar al inicio</a>
				</div>
				<div class="clearfix"></div>
			</header>
			<div class="page-wrapper pa-0 ma-0 error-bg-img" style="min-height: 395px;">
				<div class="container">
					<div class="table-struct full-width full-height" style="height: 395px;">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<span class="block error-head text-center txt-danger mb-10">403</span>
											<span class="text-center nonecase-font mb-20 block error-comment">Acceso denegado</span>
											<p class="text-center">Usted no tiene permiso para acceder a esta ubicaci&oacute;n. Para regresar por favor dar click <a href="<?=base_url()?>">aqu&iacute;</a></p>
										</div>	
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</body></html>