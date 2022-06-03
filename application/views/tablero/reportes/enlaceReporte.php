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
  <?php $this->load->view("inc/resources"); ?>
  <?php
			$titulo = "Reporte de Ejecución de Acciones Operativas por Unidades";
		?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/tablero/gestionarTablero.css?v=<?=date(" s")?>" />
</head>
<body>
  <div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
    <?php $this->load->view("inc/nav"); ?>
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
              <li><a href="#"><span>Tablero de Control</span></a></li>
              <li class="active"><span>Reporte por Unidades</span></li>
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
                          <div class="col-xs-12" id="message">
                          </div>
                          <div class="clearfix"></div>
                          <div class="row pa-10">
                            <form id="formRegistrarEnlace" action="" method="POST">
                              <div class="col-xs-12 pa-10">
                                <div class="form-group">
                                  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 pa-10"><label>Seleecionar Año de Ejecución</label></div>
                                  <div class="col-xs-12 col-sm-6 col-md-4">
                                    <select class="form-control" id="Anio" name="Anio">
                                      <option value="">[Seleccione]</option>
                                      <?php foreach($listaAnioEjecucion->result() as $row): ?>
                                      <?php if($row->Anio_Ejecucion==$anio){ ?>
                                      <option value="<?=$row->Anio_Ejecucion?>" selected>
                                        <?=$row->Anio_Ejecucion?>
                                      </option>
                                      <?php
        																}else{ ?>
                                      <option value="<?=$row->Anio_Ejecucion?>">
                                        <?=$row->Anio_Ejecucion?>
                                      </option>
                                      <?php } ?>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                <div class="col-xs-12 pa-10">
                                  <div class="form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 pa-10"><label>Seleccionar Unidad Operativa y/o Área</label></div>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
                                      <select class="form-control" id="Codigo_Area" name="Codigo_Area" style="font-size: 12px;"
                                        required>
                                        <option value="">[ -- Seleccione -- ]</option>
                                        <?php foreach($listaAreasByUser->result() as $row): ?>
                                        <option value="<?=$row->Codigo_Area?>">
                                          <?=$row->Nombre_Area?>
                                        </option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <br />
                              <div class="form-group">
                                <div class="col-xs-12 pa-10">
                                  <div class="form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-2 col-lg-3 pa-10"><label>Seleccionar Acción Operativa (Tarea)</label></div>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
                                      <select class="form-control" id="cboActividadPOI" name="cboActividadPOI" style="font-size:12px;">
                                        <option value="">[ -- Seleccione -- ]</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <br />
                              <div class="form-group">
                                <div class="col-xs-12 pa-10">
                                  <div class="form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 pa-10"><label>Seleccionar el Mes a Evaluar</label></div>
                                    <div class="col-xs-10 col-sm-4">
                                      <select class="form-control" id="mes" name="mes" style="font-size:12px;">
                                        <option value="">[ -- Seleccione -- ]</option>
                                        <option value="1">Enero</option>
                                        <option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
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
                          <div class="col-xs-12 col-sm-6 text-center">
                            <canvas class="d-none" id="barChart1" width="400" height="300"></canvas>
                          </div>
                          <div class="col-xs-12 col-sm-6 text-center">
                            <canvas class="d-none" id="barChart2" width="400" height="300"></canvas>
                          </div>
                          <br />
                          <div class="clearfix"></div>
                          <div class="row pa-10">
                            <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12 ">
                              <h5 class="txt-dark">
                                Filtros Adicionales al Listado de Documentos Adjuntos
                              </h5>
                              <br>
                            </div>
                            <div class="col-xs-12 pa-10">
                              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 pa-10"><label>Seleccionar el Mes a Filtrar o Visualizar</label></div>
                              <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
                                <select class="form-control" name="mes" id="textSearch">
                                  <option value="">-- Seleccione --</option>
                                  <option value="Enero">Enero</option>
                                  <option value="Febrero">Febrero</option>
                                  <option value="Marzo">Marzo</option>
                                  <option value="Abril">Abril</option>
                                  <option value="Mayo">Mayo</option>
                                  <option value="Junio">Junio</option>
                                  <option value="Julio">Julio</option>
                                  <option value="Agosto">Agosto</option>
                                  <option value="Setiembre">Setiembre</option>
                                  <option value="Octubre">Octubre</option>
                                  <option value="Noviembre">Noviembre</option>
                                  <option value="Diciembre">Diciembre</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <br />
                          <div class="table-responsive">
                            <table id="tbListar" class="table table-bordered table-sm" style="width: 100%;">
                              <thead>
                                <tr>
                                  <th>A&ntilde;o</th>
                                  <th>Tarea</th>
                                  <th>N&deg; Documento</th>
                                  <th>Observaciones</th>
                                  <th>Actividad</th>
                                  <th>&Aacute;rea</th>
                                  <th>Unidad Medida</th>
                                  <th>Cant.</th>
                                  <th>Mes</th>
                                  <th>C. Act. Proyecto</th>
                                  <th>C. Actividad</th>
                                  <th>C. Prog. Presupuestal</th>
                                  <th>C. Finalidad</th>
                                  <th>Archivo</th>
                                  <th>Nombre Documento</th>
                                  <th>Estado</th>
                                </tr>
                              </thead>
                              <tbody>
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
  <script src="<?=base_url()?>public/js/tablero/enlaceReporte.js?v=<?=date(" s")?>"></script>
  <script>
    enlazar("<?=base_url()?>");    
  </script>
</body>
</html>