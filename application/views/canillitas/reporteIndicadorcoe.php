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
$titulo = "Reporte de Indicador COE Salud - Registro Oportuno de Eventos";
// $botonCrear = "Registro y Carga de Data en el Tablero de Control";
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
              <li><a href="#"><span>Reporte</span></a></li>
              <li class="active"><span>Reporte Indicador COE</span></li>
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

                          <div class="row pa-10">
                            <div class="col-xs-12 col-md-5 pa-10">
                              <div class="form-group">
                                <form id="formCambioFecha" action="<?=base_url()?>eventos/reportes/indicadorcoe" method="POST">
                                  <div class="col-xs-12 col-sm-6 col-md-4 pa-10"><label>A&ntilde;o de Ejecución</label></div>
                                  <div class="col-xs-12 col-sm-6 col-md-4"><select class="form-control" name="Anio">
                                      <option value="">[Seleccione]</option>
                                      <?php foreach ($listaAnioEjecucion->result() as $row): ?>
                                      <?php if ($row->Anio_Ejecucion == $anio) {?>
                                      <option value="<?=$row->Anio_Ejecucion?>" selected>
                                        <?=$row->Anio_Ejecucion?>
                                      </option>
                                      <?php
                                      } else {?>
                                      <option value="<?=$row->Anio_Ejecucion?>">
                                        <?=$row->Anio_Ejecucion?>
                                      </option>
                                      <?php }?>
                                      <?php endforeach;?>
                                    </select></div>
                                </form>
                              </div>
                            </div>


                            <div class="clearfix"></div>
                            <br>
                            <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12" >
                              <h5 class="txt-dark">
                                Reporte de Indicador COE Salud - Registro Oportuno de Eventos (Expresado en Número de Eventos Registrados)
                              </h5>
                              <br>
                            </div>
                            <div id="container" style="height: 400px;"></div>
                            <br />
                            <br />
                            <br />
                            <br />
                            <div class="table-responsive">
                              <table id="tbListar" class="table table-bordered table-sm" style="width: 100%;" >
                                <thead>
                                  <tr>
                                  <th>A&ntilde;o</th>
                                  <th>Indicador</th>
                                  <th>Enero</th>
                                  <th>Febrero</th>
                                  <th>Marzo</th>
                                  <th>Abril</th>
                                  <th>Mayo</th>
                                  <th>Junio</th>
                                  <th>Julio</th>
                                  <th>Agosto</th>
                                  <th>Septiembre</th>
                                  <th>Octubre</th>
                                  <th>Noviembre</th>
                                  <th>Diciembre</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                            <br>
                            <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12" style="margin-top: 50px;">
                              <h5 class="txt-dark">
                                Reporte de Indicador COE Salud - Registro Oportuno de Eventos (En Porcentajes) del Total de Eventos Registrados
                              </h5>
                              <br>
                            </div>
                            <div id="containerEjecucion" style="height: 400px"></div>
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <div class="table-responsive">
                              <table id="tbListarEjecucion" class="table table-bordered table-sm" style="width: 100%;">
                                <thead>
                                  <tr>
                                  <th>A&ntilde;o</th>
                                  <th>Indicador</th>
                                  <th>Enero</th>
                                  <th>Febrero</th>
                                  <th>Marzo</th>
                                  <th>Abril</th>
                                  <th>Mayo</th>
                                  <th>Junio</th>
                                  <th>Julio</th>
                                  <th>Agosto</th>
                                  <th>Setiembre</th>
                                  <th>Octubre</th>
                                  <th>Noviembre</th>
                                  <th>Diciembre</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                            <br />               
                            <hr class="half-rule" />
                           
                          </div>
                          <div class="clearfix"></div>
                          <br />
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
    </div>

  </div>
  <script src="<?=base_url()?>public/js/eventos/reporteIndicadorcoe.js?v=<?=date(" s")?>"></script>
  <script>
    var grafico = '<?=$grafico?>';
    var graficoPorcentual = '<?=$graficoPorcentual?>';
    obtenerGrafica("<?=base_url()?>", grafico, graficoPorcentual);
    generateTables(grafico, graficoPorcentual)
  </script>

</body>

</html>