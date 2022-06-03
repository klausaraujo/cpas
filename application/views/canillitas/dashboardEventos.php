<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>
    <?=TITULO_PRINCIPAL?>
  </title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="<?=AUTOR?>">
  <?php $this->load->view("inc/resources");?>
  <?php
// $titulo = "Ingreso de Data al Tablero de Control de Gesti&oacute;n";
$titulo = "Tablero de Control de Gesti&oacute;n";
$botonCrear = "Registro en el Tablero de Control";
?>
<?php
	$months = array(
	    array("id"=>0,"name"=>"TODOS"),
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

  <link rel="stylesheet" href="<?=base_url()?>public/css/tablero/gestionarTablero.css?v=<?=date(" s")?>" />
  <style>
    .half-rule {
    margin-left: 0;
    text-align: left;
    width: 50%;
 }
  .statis {
    color: #EEE;
    margin-top: 15px;
  }
  h3 {
    color: #EEE;
    font-size: 20px;
  }
  .statis .box {
    position: relative;
    padding: 15px;
    overflow: hidden;
    border-radius: 3px;
    margin-bottom: 25px;
  }
  .statis .box h3:after {
    content: "";
    height: 2px;
    width: 70%;
    margin: auto;
    background-color: rgba(255, 255, 255, 0.12);
    display: block;
    margin-top: 10px;
  }
  .statis .box i {
    position: absolute;
    height: 70px;
    width: 70px;
    font-size: 22px;
    padding: 15px;
    top: -25px;
    left: -25px;
    background-color: rgba(255, 255, 255, 0.15);
    line-height: 60px;
    text-align: right;
    border-radius: 50%;
  }
    .warning {background-color: #f0ad4e}
    .danger {background-color: #d9534f}
    .success {background-color: #5cb85c}
    .inf {background-color: #5bc0de}
  </style>
</head>

<body>
  <div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
    <?php $this->load->view("inc/nav");?>
    <!-- Main Content -->
    <div class="page-wrapper" style="min-height: 710px;">
      <div class="container pt-30">
        <div class="row heading-bg">
          <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">
              <?=$titulo?>
            </h5>
          </div>
          <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="<?=base_url()?>">Inicio</a></li>
              <li><a href="#"><span>Tablero Control</span></a></li>
              <li class="active"><span>Tablero</span></li>
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
                          <?php $message = $this->session->flashdata('mensajeSuccess');?>
                          <?php if ($message) {?>
                          <div class="alert alert-success">
                            <span>
                              <?=$message?></span>
                          </div>
                          <?php }?>

                          <?php $message = $this->session->flashdata('mensajeError');?>
                          <?php if ($message) {?>
                          <div class="alert alert-danger">
                            <span>
                              <?=$message?></span>
                          </div>
                          <?php }?>

                          <?php $message = $this->session->flashdata('mensajeWarning');?>
                          <?php if ($message) {?>
                          <div class="alert alert-warning">
                            <span>
                              <?=$message?></span>
                          </div>
                          <?php }?>

                          <div class="clearfix"></div>

                                                    <div class="row">
														<div class="col-xs-12">
														
														<div class="form-group row">
                                    						<label class="col-sm-12 col-form-label">Aplicar Filtros por Año y Mes del Evento</label> 
                                    						<div class="col-sm-3">
                                    							<select class="form-control" name="anio" id="anio">
								  								  <?php foreach($listaAnioEjecucion->result() as $row): ?>
                                								  <option value="<?=$row->Anio_Ejecucion?>" <?=($row->Anio_Ejecucion==$anio)?"selected":""?>><?=$row->Anio_Ejecucion?></option>
                                								  <?php endforeach; ?>
								  								</select>
                                    						</div>
                                                             <div class="col-sm-3">
                                    							<select class="form-control" name="mes" id="mes">
        							  							  <?php foreach($months as $row): ?>
                                    							  <option value="<?=$row["id"]?>" <?=($row["id"]==$mes)?"selected":""?>><?=$row["name"]?></option>
                                    							  <?php endforeach; ?>
        							  							</select>
                                    						</div>
                                    
                                    					</div>
														
														
														</div>
													</div>

                            <div class="clearfix"></div>
                            <br>
                            <section class='statis text-center'>
                              <div class="container-fluid">
                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="box success">
                                      <i class="fa fa-map-marker" aria-hidden="true"></i>
                                      <h3>
                                        <?=$totalActividadPoi?>
                                      </h3>
                                      <p class="lead">Actividades POI</p>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="box danger">
                                      <i class="fa fa-users" aria-hidden="true"></i>
                                      <h3>
                                        <?=$totalUnidadesFuncionales?>
                                      </h3>
                                      <p class="lead">Unidades Funcionales</p>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="box warning">
                                      <i class="fa fa-shopping-cart"></i>
                                      <h3>
                                        <?=$totalActividadPresupuestal?>
                                      </h3>
                                      <p class="lead">Actividad Presupuestales</p>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="box inf">
                                      <i class="fa fa-money" aria-hidden="true"></i>
                                      <h3>
                                        <?=$totalProductos?>
                                      </h3>
                                      <p class="lead">Productos</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                            <!-- here -->
                            <!-- <div class="col-xs-12 col-sm-8 col-sm-offset-2 text-center">
                          <div class="text-default"><label id="title"></label></div>
                          <canvas class="d-none" id="barChart" width="400" height="300"></canvas>
                        </div> -->
                            <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12">
                              <h5 class="txt-dark">
                                Programación de Activadades Presupuestales - DIGERD
                              </h5>
                              <br>
                            </div>
                            <div id="container" style="height: 400px;"></div>
                            <br>
                            <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12" style="margin-top: 50px;">
                                <h5 class="txt-dark">
                                  Programación de Activadades Presupuestales - DIGERD
                                </h5>
                                <br>
                              </div>
                            <div id="containerEjecucion" style="height: 400px"></div>

                            <hr class="half-rule" />
                            <!-- <div class="col-xs-12 col-md-9 pa-10">
                              <div class="form-group">
                                <div class="col-sm-2 pa-10"><label>Actividad POI</label></div>
                                <div class="col-sm-10">
                                  <select class="form-control" name="cboActividadPOI" style="font-size:12px;">
                                    <option value="">[ -- Seleccione -- ]</option>
                                    <?php foreach ($listaActividadPoi->result() as $row): ?>
                                    <option value="<?=$row->Id_Actividad_POI?>" <?=($firstActividadPOI==$row->Id_Actividad_POI)
                                      ?
                                      "selected" : ""?>>
                                      <?=$row->Id_Actividad_POI . ' - ' . $row->Descripcion_Actividad?>
                                    </option>
                                    <?php endforeach;?>
                                  </select>
                                </div>
                              </div>
                            </div> -->
                          </div>
                          <div class="clearfix"></div>


                          <div class="clearfix"></div>
                          <br />
                          <hr />
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

      <?php $this->load->view("inc/footer");?>
      <script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>
    </div>

  </div>

  <script src="<?=base_url()?>public/js/tablero/gestionarTablero.js?v=<?=date(" s")?>"></script>
  <script>
    var grafico = '<?=$grafico?>';
    gestionarTablero("<?=base_url()?>",grafico);

    obtenerGrafica("<?=base_url()?>", grafico)

  </script>

</body>

</html>
