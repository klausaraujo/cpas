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
    $titulo = "Reporte de Movimientos de Brigadistas";
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

    .warning {
      background-color: #f0ad4e
    }

    .danger {
      background-color: #d9534f
    }

    .success {
      background-color: #5cb85c
    }

    .inf {
      background-color: #5bc0de
    }
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
              <li class="active"><span>Reporte Brigadistas</span></li>
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
                                <form id="formCambioFecha" action="<?=base_url()?>eventos/reportes/movimientobrigadistas"
                                  method="POST">
                                  <div class="row">
                                    <div class="col-xs-12 pa-10">
                                      <div class="form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 pa-10"><label>A&ntilde;o de
                                            Ejecución</label></div>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
                                          <select class="form-control" name="Anio">
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
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-xs-12 pa-10">
                                      <div class="form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 pa-10"><label>Mes</label></div>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
                                          <select class="form-control" name="Mes" id="Mes">
                                            <option value="">-- Seleccione --</option>
                                            <option value="1" selected>Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Setiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>


                            <div class="clearfix"></div>
                            <br>
                            <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12">
                              <h5 class="txt-dark">
                                Movimiento de Brigadistas a Nivel Nacional
                              </h5>
                              <br>
                            </div>
                            <div id="containerNivel" style="height: 400px;width: 400px"></div>
                            <br>
                            <br>
                            <div class="table-responsive">
                              <table id="tbListarNivel" class="table table-bordered table-sm" style="width: 40%;">
                                <thead>
                                  <tr>
                                    <th>A&ntilde;o</th>
                                    <th>Numero</th>
                                    <th>Mes</th>
                                    <th>Region</th>
                                    <th>Minsa</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                            <br>
                            <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12" style="margin-top: 50px;">
                              <h5 class="txt-dark">
                                Movimiento de Brigadistas Minsa a Nivel Nacional
                              </h5>
                              <br>
                            </div>
                            <div id="containerRegion" style="height: 400px;"></div>
                            <br><br><br><br>
                            <div class="table-responsive">
                              <table id="tbListarRegion" class="table table-bordered table-sm" style="width: 100%;">
                                <thead>
                                  <tr>
                                    <th>A&ntilde;o</th>
                                    <th>Mes</th>
                                    <th>Amazonas</th>
                                    <th>Ancash</th>
                                    <th>Apurimac</th>
                                    <th>Arequipa</th>
                                    <th>Ayacucho</th>
                                    <th>Cajamarca</th>
                                    <th>Callao</th>
                                    <th>Cusco</th>
                                    <th>Huancavelica</th>
                                    <th>Huanuco</th>
                                    <th>Ica</th>
                                    <th>Junín</th>
                                    <th>La Libertad</th>
                                    <th>Lambayeque</th>
                                    <th>Lima</th>
                                    <th>Loreto</th>
                                    <th>Madre de Dios</th>
                                    <th>Moquegua</th>
                                    <th>Pasco</th>
                                    <th>Piura</th>
                                    <th>Puno</th>
                                    <th>San Matin</th>
                                    <th>Tacna</th>
                                    <th>Tumbes</th>
                                    <th>Ucayali</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                            <br>
                            <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12" style="margin-top: 50px;">
                              <h5 class="txt-dark">
                                Movimiento de Brigadistas Regionales a Nivel Nacional
                              </h5>
                              <br>
                            </div>
                            <div id="containerRegionDos" style="height: 400px;"></div>
                            <br><br><br><br>
                            <div class="table-responsive">
                              <table id="tbListarRegionDos" class="table table-bordered table-sm" style="width: 100%;">
                                <thead>
                                  <tr>
                                    <th>A&ntilde;o</th>
                                    <th>Mes</th>
                                    <th>Amazonas</th>
                                    <th>Ancash</th>
                                    <th>Apurimac</th>
                                    <th>Arequipa</th>
                                    <th>Ayacucho</th>
                                    <th>Cajamarca</th>
                                    <th>Callao</th>
                                    <th>Cusco</th>
                                    <th>Huancavelica</th>
                                    <th>Huanuco</th>
                                    <th>Ica</th>
                                    <th>Junín</th>
                                    <th>La Libertad</th>
                                    <th>Lambayeque</th>
                                    <th>Lima</th>
                                    <th>Loreto</th>
                                    <th>Madre de Dios</th>
                                    <th>Moquegua</th>
                                    <th>Pasco</th>
                                    <th>Piura</th>
                                    <th>Puno</th>
                                    <th>San Matin</th>
                                    <th>Tacna</th>
                                    <th>Tumbes</th>
                                    <th>Ucayali</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
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
  <script src="<?=base_url()?>public/js/eventos/reporteMovientoBrigadistas.js?v=<?=date(" s")?>"></script>
  <script>
    var grafico = '<?=$grafico?>';
    var graficoRegion = '<?=$graficoRegion?>';
    var graficoRegionDos = '<?=$graficoRegionDos?>';
    var mes = '<?=$mes?>';

    var data = {
      grafico,
      graficoRegion,
      graficoRegionDos
    }
    
    obtenerGrafica("<?=base_url()?>", data)

  </script>

</body>

</html>