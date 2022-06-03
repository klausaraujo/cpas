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
  <?php
$this->load->view("inc/resources");
$titulo = "Gesti&oacute;n de Tablas Padre";
?>
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
              <li><a href="<?=base_url()?>tablas/main"><span>Tablas padre</span></a></li>
              <li class="active"><span>Lista</span></li>
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
                        <br />
                        <div class="row">
                        	<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
							                <div class="table-responsive">
                                <table id="tbListar" class="table table-bordered table-striped table-sm">
								                  <thead>
                                    <tr>
                                      <th class="text-center">N&uacute;mero</th>
                                      <th class="text-center">Tabla</th>
                                      <th>&nbsp;</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                  					<tr>
                                      <td align="center">01</td>
                                      <td align="center">Evento</td>    							
                                      <td align="center">
                                        <a href="<?=base_url()?>tablas/main/evento" class="btn btn-warning btn-circle d-flex justify-content-center align-items-center">
                                          <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                      </td>  
                                    </tr>
                  					<tr>
                                      <td align="center">02</td>
                                      <td align="center">Evento Detalle</td>    							
                                      <td align="center">
                                        <a href="<?=base_url()?>tablas/main/evento-detalle" class="btn btn-warning btn-circle d-flex justify-content-center align-items-center">
                                          <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                      </td>  
                                    </tr>
                  					<tr>
                                      <td align="center">03</td>
                                      <td align="center">Evento Fuente</td>    							
                                      <td align="center">
                                        <a href="<?=base_url()?>tablas/main/evento-fuente" class="btn btn-warning btn-circle d-flex justify-content-center align-items-center">
                                          <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                      </td>  
                                    </tr>
                  					<tr>
                                      <td align="center">04</td>
                                      <td align="center">Evento Tipo Entidad Atenci&oacute;n</td>    							
                                      <td align="center">
                                        <a href="<?=base_url()?>tablas/main/tipo-accion" class="btn btn-warning btn-circle d-flex justify-content-center align-items-center">
                                          <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                      </td>  
                                    </tr>
                  					<tr>
                                      <td align="center">05</td>
                                      <td align="center">Tipo Acci&oacute;n</td>    							
                                      <td align="center">
                                        <a href="<?=base_url()?>tablas/main/tipo-accion" class="btn btn-warning btn-circle d-flex justify-content-center align-items-center">
                                          <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                      </td>  
                                    </tr>
                  					        <tr>
                                      <td align="center">06</td>
                                      <td align="center">Tipo Acci&oacute;n Entidad</td>    							
                                      <td align="center">
                                        <a href="<?=base_url()?>tablas/main/tipo-accion-entidad" class="btn btn-warning btn-circle d-flex justify-content-center align-items-center">
                                          <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                      </td>  
                                    </tr>
                  					        <tr>
                                      <td align="center">07</td>
                                      <td align="center">Brigadistas Especialidad</td>    							
                                      <td align="center">
                                        <a href="<?=base_url()?>tablas/main/brigadistasEspecialidad" class="btn btn-warning btn-circle d-flex justify-content-center align-items-center">
                                          <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                      </td>  
                                    </tr>
                                    <tr>
                                      <td align="center">08</td>
                                      <td align="center">Perfiles</td>    							
                                      <td align="center">
                                        <a href="<?=base_url()?>tablas/main/perfiles" class="btn btn-warning btn-circle d-flex justify-content-center align-items-center">
                                          <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                      </td>  
                                    </tr>
                                    <tr>
                                      <td align="center">09</td>
                                      <td align="center">Módulo / Perfil</td>    							
                                      <td align="center">
                                        <a href="<?=base_url()?>tablas/main/perfilModulos" class="btn btn-warning btn-circle d-flex justify-content-center align-items-center">
                                          <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                      </td>  
                                    </tr>                                    
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
        </div>
      </div>
      <?php $this->load->view("inc/footer"); ?>
    </div>
  </div>
</body>
</html>