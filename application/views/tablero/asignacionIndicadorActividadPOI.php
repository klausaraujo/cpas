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
    $titulo = "Asignar Indicadores a Acciones Operativas (Tareas)";
  ?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/tablero/asignacionIndicadorActividadPOI.css?v=<?=date(" s")?>"
  />
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
              <li class="active"><span>Asignación Indicadores</span></li>
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
                          <?php $message = $this->session->flashdata('mensajeSuccess'); ?>
                          <?php if($message){ ?>
                          <div class="alert alert-success"><span>
                              <?= $message ?></span></div>
                          <?php } ?>
                          <?php $message = $this->session->flashdata('mensajeError'); ?>
                          <?php if($message){ ?>
                          <div class="alert alert-danger"><span>
                              <?= $message ?></span></div>
                          <?php } ?>
                          <?php $message = $this->session->flashdata('mensajeWarning'); ?>
                          <?php if($message){ ?>
                          <div class="alert alert-warning"><span>
                              <?= $message ?></span></div>
                          <?php } ?>
                          <input type="hidden" name="asignar" />
                          <input type="hidden" name="Id_Indicador" />
                          <input type="hidden" name="Anio_Ejecucion" />
                          <div class="row pa-10">
                            <div class="col-xs-12 col-md-5 pa-10">
                              <div class="form-group">
                                <form id="formCambioFecha" action="<?=base_url()?>tablero/procesoIndicador/asignacion" method="POST"
                                  autocomplete="off">
                                  <div class="col-xs-12 col-sm-6 col-md-4 pa-10"><label>Filtrar por A&ntilde;o</label></div>
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
                          </div>
                          <div class="table-responsive">
                            <table id="tbListar" class="table table-bordered table-sm">
                              <thead>
                                <tr>
                                  <th>Tarea</th>
                                  <th>A&ntilde;o</th>
                                  <th>Acción Operativa (Tarea)</th>
                                  <th>Programado</th>
                                  <th>IDI</th>
                                  <th>Indicador</th>
                                  <th>Asignar</th>
                                  <th>Quitar</th>
                                  <th>Unidad Medida</th>
                                  <th>Anio_Ejecucion</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                                            if ($lista->num_rows() > 0) {
                                                                foreach ($lista->result() as $row) :
                                                                    ?>
                                <tr>
                                  <td align="center">
                                    <?=$row->codigo_actividad_poi?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Anio?>
                                  </td>
                                  <td>
                                    <?=$row->Actividad_POI?>
                                  </td>
                                  <td align="center">
                                    <?=$row->CP?>
                                  </td>
                                  <td align="center">
                                    <?=$row->IDI?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Indicador?>
                                  </td>
                                  <td align="center">
                                    <?php if($row->IDI=="NA"){ ?>
                                    <button class="btn btn-success btn-circle actionAdd" title="AGREGAR" type="button">
                                      <i class="fa fa-plus"></i>
                                    </button>
                                    <?php }else{ ?>
                                    <button class="btn btn-default btn-circle" title="AGREGAR" type="button">
                                      <i class="fa fa-plus"></i>
                                    </button>
                                    <?php } ?>
                                  </td>
                                  <td align="center">
                                    <?php if($row->IDI!="NA"){ ?>
                                    <button class="btn btn-danger btn-circle actionDelete" title="QUITAR" type="button">
                                      <i class="fa fa fa-trash-o"></i>
                                    </button>
                                    <?php }else{ ?>
                                    <button class="btn btn-default btn-circle" title="QUITAR" type="button">
                                      <i class="fa fa fa-trash-o"></i>
                                    </button>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <?=$row->Unidad_Medida?>
                                  </td>
                                  <td>
                                    <?=$row->anio_ejecucion?>
                                  </td>
                                </tr>
                                <?php
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
      <script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>
    </div>
  </div>
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTablero">
    <div class="modal-dialog" role="document">
      <input type="hidden" name="id" value="" readonly />
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Quitar Indicador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          &iquest;Seguro(a) desea quitar el indicador?
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
          <button type="button" id="btnQuitar" class="btn btn-info">Quitar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="tbIndicadorModal" tabindex="-1" role="dialog" aria-labelledby="tbIndicadorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title">Asignar Indicador</h5>
        </div>
        <div class="modal-body">
          <p id="textoActividadPOI"></p>
          <hr>
          <br>
          <table class="tbIndicador table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>C&oacute;digo</th>
                <th>A&ntilde;o</th>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody>
              <?php
					if ($listaIndicador->num_rows() > 0) {
					    foreach ($listaIndicador->result() as $row) :
                        ?>
              <tr>
                <td align="center">
                  <?=$row->ID?>
                </td>
                <td align="center">
                  <?=$row->Anio_Ejecucion?>
                </td>
                <td>
                  <?=(strlen($row->Nombre_Indicador)>=80)?substr($row->Nombre_Indicador,0,79).'...':$row->Nombre_Indicador?>
                </td>
              </tr>
              <?php
                            endforeach;
                        }
                        ?>
            </tbody>
          </table>
          <br />
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
          <button type="button" id="btnAsignar" class="btn btn-primary disabled">Asignar</button>
        </div>
      </div>
    </div>
  </div>
  <script src="<?=base_url()?>public/js/tablero/asignacionIndicadorActividadPOI.js?v=<?=date(" s")?>"></script>
  <script>
    asignacionIndicadorActividadPOI("<?=base_url()?>");
  </script>
</body>
</html>