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
$titulo = "Actividad POI - Indicador";
$botonCrear = "Registrar Actividad POI - Indicador";
?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/tablero/procesoIndicador.css" />
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
              <li><a href="#"><span>Tablero Control</span></a></li>
              <li class="active"><span>Proceso Indicador</span></li>
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
                          <div class="row">
                            <div class="col-xs-12 col-md-4">
                              <div class="form-group">
                                <form id="formCambioFecha" action="<?=base_url()?>/tablero/procesoIndicador" method="POST">
                                  <div class="col-sm-4 pa-10"><label>Filtrar por A&ntilde;o</label></div>
                                  <div class="col-sm-6"><select class="form-control" name="Anio">
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
                                    </select></div>
                                </form>
                              </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-md-offset-2 pull-right pa-10">
                              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" id="btnRegistrar">
                                <?=$botonCrear?>
                              </button>
                            </div>
                          </div>
                          <div class="table-responsive">
                            <table id="tbListar" class="table table-bordered table-sm">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>A&ntilde;o</th>
                                  <th>&Aacute;rea</th>
                                  <th>Actividad POI</th>
                                  <th>Indicador</th>
                                  <th>Total</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
            if ($lista->num_rows() > 0) {
                $i = 1;
                foreach ($lista->result() as $row) :
									$total = $row->Enero + $row->Febrero + $row->Marzo + $row->Abril + $row->Mayo + $row->Junio + $row->Julio +
									$row->Agosto + $row->Septiembre + $row->Octubre + $row->Noviembre + $row->Diciembre;
              ?>
                                <tr>
                                  <td align="center">
                                    <?=$row->Codigo_Proceso?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Anio_Ejecucion?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Siglas_Area?>
                                  </td>
                                  <td>
                                    <?=$row->Proceso?>
                                  </td>
                                  <td>
                                    <?=$row->Codigo_Indicador." - ".$row->Indicador?>
                                  </td>
                                  <td align="center">
                                    <?=$total?>
                                  </td>
                                  <td align="center">
                                    <button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button">
                                      <i class="fa fa-pencil-square-o"></i>
                                    </button>
                                  </td>
                                  <td>
                                    <button class="btn btn-danger btn-circle actionDelete" title="ELIMINAR" type="button">
                                      <i class="fa fa fa-trash-o"></i>
                                    </button>
                                  </td>
                                  <td>
                                    <?=$row->Enero?>
                                  </td>
                                  <td>
                                    <?=$row->Febrero?>
                                  </td>
                                  <td>
                                    <?=$row->Marzo?>
                                  </td>
                                  <td>
                                    <?=$row->Abril?>
                                  </td>
                                  <td>
                                    <?=$row->Mayo?>
                                  </td>
                                  <td>
                                    <?=$row->Junio?>
                                  </td>
                                  <td>
                                    <?=$row->Julio?>
                                  </td>
                                  <td>
                                    <?=$row->Agosto?>
                                  </td>
                                  <td>
                                    <?=$row->Septiembre?>
                                  </td>
                                  <td>
                                    <?=$row->Octubre?>
                                  </td>
                                  <td>
                                    <?=$row->Noviembre?>
                                  </td>
                                  <td>
                                    <?=$row->Diciembre?>
                                  </td>
                                  <td>
                                    <?=$row->Anio_Ejecucion?>
                                  </td>
                                  <td>
                                    <?=$row->Codigo_Proceso?>
                                  </td>
                                  <td>
                                    <?=$row->Codigo_Indicador?>
                                  </td>
                                  <td>
                                    <?=$row->idindicadorproceso?>
                                  </td>
                                  <td>
                                    <?=$row->Area?>
                                  </td>
                                  <td>
                                    <?=$row->Unidad?>
                                  </td>
                                  <td>
                                    <?=(int)$row->Codigo_Proceso?>
                                  </td>
                                </tr>
                                <?php
                    $i ++;
                endforeach
                ;
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
      <form action="<?=base_url()?>tablero/procesoIndicador/eliminar" method="POST">
        <input type="hidden" name="idindicadorproceso" value="" readonly />
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Borrar Registro</h5>
          </div>
          <div class="modal-body">
            &iquest;Seguro(a) desea Borrar el registro n&uacute;mero <strong id="numero"></strong>?
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-info">Borrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<div class="modal fade" id="registrarModal" tabindex="-1" role="dialog" aria-labelledby="registrarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="registrarTableroModalLabel">Programar Actividad POI</h5>
        </div>
        <form id="formRegistrar" name="formRegistrar" action="<?=base_url()?>tablero/procesoIndicador/registrar" method="POST">
          <div class="modal-body">
            <div id="registroMeses" class="row">
              <div class="col-xs-12">
                <div class="col-xs-4">
                  <div class="form-group">
                    <label class="">A&ntilde;o</label>
                    <select class="form-control" name="Anio_Ejecucion">
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
                <div class="col-xs-4">
                  <div class="form-group">
                    <label class="">&Aacute;rea</label>
                    <input type="text" class="form-control" name="Codigo_Area" value="" disabled>
                  </div>
                </div>
                <div class="col-xs-4">
                  <div class="form-group">
                    <label class="">Unidad Medida</label>
                    <input type="text" class="form-control" name="Codigo_Unidad_Medida" value="" disabled>
                  </div>
                </div>
                <hr style="width: 100%" />
              </div>
              <div id="tbRegistroMeses" class="col-xs-12">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="col-xs-12">
                      <div class="form-group">
                        <label class=""><span style="color: red">* </span>Actividad POI</label>
                        <select class="form-control" name="Codigo_Proceso" required>
                        </select>
                        <option value="">[Seleccione]</option>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="form-group">
                        <label class=""><span style="color: red">* </span>Indicador</label>
                        <select class="form-control" name="Codigo_Indicador" required>
                          <option value="">[Seleccione]</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" style="padding-bottom: 5px;">
                  <div class="col-xs-2">
                    <div class="col-xs-6 text-center label-mes">Ene</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes1" value="0" rel="1" name="enero" autocomplete="off" />
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <div class="col-xs-6 text-center label-mes">Feb</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes2" value="0" rel="2" name="febrero" autocomplete="off" />
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <div class="col-xs-6 text-center label-mes">Mar</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes3" value="0" rel="3" name="marzo" autocomplete="off" />
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <div class="col-xs-6 text-center label-mes">Abr</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes4" value="0" rel="4" name="abril" autocomplete="off" />
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <div class="col-xs-6 text-center label-mes">May</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes5" value="0" rel="5" name="mayo" autocomplete="off" />
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <div class="col-xs-6 text-center label-mes">Jun</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes6" value="0" rel="6" name="junio" autocomplete="off" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-2">
                    <div class="col-xs-6 text-center label-mes">Jul</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes7" value="0" rel="7" name="julio" autocomplete="off" />
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <div class="col-xs-6 text-center label-mes">Ago</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes8" value="0" value="0" rel="8" name="agosto"
                        autocomplete="off" />
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <div class="col-xs-6 text-center label-mes">Sep</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes9" value="0" rel="9" name="septiembre" autocomplete="off" />
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <div class="col-xs-6 text-center label-mes">Oct</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes10" value="0" rel="10" name="octubre" autocomplete="off" />
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <div class="col-xs-6 text-center label-mes">Nov</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes11" value="0" rel="11" name="noviembre" autocomplete="off" />
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <div class="col-xs-6 text-center label-mes">Dic</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes12" value="0" rel="12" name="diciembre" autocomplete="off" />
                    </div>
                  </div>
                </div>
                <hr />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="registrarTableroModalLabel">Actualizar</h5>
        </div>
        <form id="formActualizar" action="<?=base_url()?>tablero/procesoIndicador/actualizar" method="POST">
          <div class="modal-body">
            <input type="hidden" id="idindicadorproceso" name="idindicadorproceso" />
            <input type="hidden" name="hCodigo_Proceso" />
            <input type="hidden" name="hAnio_EJecucion" />
            <div id="actualizarMeses" class="row">
              <div class="row">
                <div class="col-xs-12">
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label class="">A&ntilde;o Ejecuci&oacute;n</label>
                      <select class="form-control" name="Anio_Ejecucion" disabled>
                        <option value="">[Seleccione]</option>
                        <?php foreach($listaAnioEjecucion->result() as $row): ?>
                        <option value="<?=$row->Anio_Ejecucion?>">
                          <?=$row->Anio_Ejecucion?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label class="">&Aacute;rea</label>
                      <input type="text" class="form-control" name="Codigo_Area" value="" disabled>
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label class="">Unidad Medida</label>
                      <input type="text" class="form-control" name="Codigo_Unidad_Medida" value="" disabled>
                    </div>
                  </div>
                  <hr style="width: 100%" />
                </div>
                <div class="col-xs-12">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label class=""><span style="color: red">* </span>Actividad POI</label>
                      <select class="form-control" name="Codigo_Proceso" disabled>
                        <option value="">[Seleccione]</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label class=""><span style="color: red">* </span>Indicador</label>
                      <select class="form-control" name="Codigo_Indicador">
                        <option value="">[Seleccione]</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" style="padding-bottom: 5px;">
                <div class="col-xs-2">
                  <div class="col-xs-6 text-center label-mes">Ene</div>
                  <div class="col-xs-6 field-mes">
                    <input type="text" class="form-control mes1" value="0" rel="1" name="enero" autocomplete="off" />
                  </div>
                </div>
                <div class="col-xs-2">
                  <div class="col-xs-6 text-center label-mes">Feb</div>
                  <div class="col-xs-6 field-mes">
                    <input type="text" class="form-control mes2" value="0" rel="2" name="febrero" autocomplete="off" />
                  </div>
                </div>
                <div class="col-xs-2">
                  <div class="col-xs-6 text-center label-mes">Mar</div>
                  <div class="col-xs-6 field-mes">
                    <input type="text" class="form-control mes3" value="0" rel="3" name="marzo" autocomplete="off" />
                  </div>
                </div>
                <div class="col-xs-2">
                  <div class="col-xs-6 text-center label-mes">Abr</div>
                  <div class="col-xs-6 field-mes">
                    <input type="text" class="form-control mes4" value="0" rel="4" name="abril" autocomplete="off" />
                  </div>
                </div>
                <div class="col-xs-2">
                  <div class="col-xs-6 text-center label-mes">May</div>
                  <div class="col-xs-6 field-mes">
                    <input type="text" class="form-control mes5" value="0" rel="5" name="mayo" autocomplete="off" />
                  </div>
                </div>
                <div class="col-xs-2">
                  <div class="col-xs-6 text-center label-mes">Jun</div>
                  <div class="col-xs-6 field-mes">
                    <input type="text" class="form-control mes6" value="0" rel="6" name="junio" autocomplete="off" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-2">
                  <div class="col-xs-6 text-center label-mes">Jul</div>
                  <div class="col-xs-6 field-mes">
                    <input type="text" class="form-control mes7" value="0" rel="7" name="julio" autocomplete="off" />
                  </div>
                </div>
                <div class="col-xs-2">
                  <div class="col-xs-6 text-center label-mes">Ago</div>
                  <div class="col-xs-6 field-mes">
                    <input type="text" class="form-control mes8" value="0" value="0" rel="8" name="agosto" autocomplete="off" />
                  </div>
                </div>
                <div class="col-xs-2">
                  <div class="col-xs-6 text-center label-mes">Sep</div>
                  <div class="col-xs-6 field-mes">
                    <input type="text" class="form-control mes9" value="0" rel="9" name="septiembre" autocomplete="off" />
                  </div>
                </div>
                <div class="col-xs-2">
                  <div class="col-xs-6 text-center label-mes">Oct</div>
                  <div class="col-xs-6 field-mes">
                    <input type="text" class="form-control mes10" value="0" rel="10" name="octubre" autocomplete="off" />
                  </div>
                </div>
                <div class="col-xs-2">
                  <div class="col-xs-6 text-center label-mes">Nov</div>
                  <div class="col-xs-6 field-mes">
                    <input type="text" class="form-control mes11" value="0" rel="11" name="noviembre" autocomplete="off" />
                  </div>
                </div>
                <div class="col-xs-2">
                  <div class="col-xs-6 text-center label-mes">Dic</div>
                  <div class="col-xs-6 field-mes">
                    <input type="text" class="form-control mes12" value="0" rel="12" name="diciembre" autocomplete="off" />
                  </div>
                </div>
              </div>
              <hr />
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="<?=base_url()?>public/js/tablero/procesoIndicador.js?v=<?=date(" s")?>"></script>
  <script>
    procesoIndicador("<?=base_url()?>");
  </script>
</body>
</html>