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
$titulo = "Tablero de Control de Gesti&oacute;n - DIGERD";
$botonCrear = "Registro y Carga de Data en el Tablero de Control";
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
              <li><a href="#"><span>Tablero de Control</span></a></li>
              <li class="active"><span>Gestionar Tablero</span></li>
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
                                <form id="formCambioFecha" action="<?=base_url()?>tablero/gestionar" method="POST">
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

                            <div class="col-xs-12 col-md-5 col-md-offset-1 pull-right pa-10">
                              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" id="btnRegistrar">
                                <?=$botonCrear?>
                              </button>
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
                                      <p class="lead">Acciones Operativas (Tareas)</p>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="box danger">
                                      <i class="fa fa-users" aria-hidden="true"></i>
                                      <h3>
                                        <?=$totalUnidadesFuncionales?>
                                      </h3>
                                      <p class="lead">Unidades Funcionales (Áreas)</p>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="box warning">
                                      <i class="fa fa-shopping-cart"></i>
                                      <h3>
                                        <?=$totalActividadPresupuestal?>
                                      </h3>
                                      <p class="lead">Actividades Presupuestales</p>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="box inf">
                                      <i class="fa fa-money" aria-hidden="true"></i>
                                      <h3>
                                        <?=$totalProductos?>
                                      </h3>
                                      <p class="lead">Productos Presupuestales</p>
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
                                Programación Actual por Año de Ejecución de Activadades Presupuestales - DIGERD
                              </h5>
                              <br>
                            </div>
                            <div id="container" style="height: 400px;"></div>
                            <br>
                            <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12" style="margin-top: 50px;">
                              <h5 class="txt-dark">
                                Ejecución Actual por Año de Ejecución de Activadades Presupuestales - DIGERD
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
                          <div class="row">
                            <div class="col-xs-12 pa-10">
                              <div class="form-group">
                                <form id="formCambioFecha" action="<?=base_url()?>tablero/gestionar" method="POST">
                                  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 pa-10"><label>Seleccione Unidad Operativa y/o
                                      &Aacute;rea</label></div>
                                  <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
                                    <select class="form-control" name="Area">
                                      <?php foreach ($listaAreas->result() as $row): ?>
                                      <option value="<?=$row->Codigo_Area?>">
                                        <?=$row->Nombre_Area?>
                                      </option>
                                      <?php endforeach;?>
                                    </select>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12 pa-10">
                              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 pa-10"><label>Seleccione Mes a Filtrar en el Listado</label></div>
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
                            <table id="tbListar" class="table table-bordered table-sm">
                              <thead>
                                <tr>
                                  <th>A&ntilde;o</th>
                                  <th>Tarea</th>
                                  <th>Acción Operativa</th>
                                  <th>&Aacute;rea</th>
                                  <th>Unidad Medida</th>
                                  <th>Mes</th>
                                  <th>Cantidad</th>
                                  <th>C. Act. Proyecto</th>
                                  <th>C. Actividad</th>
                                  <th>C. Prog. Presupuestal</th>
                                  <th>C. Finalidad</th>
                                  <th>Archivo</th>
                                  <th>N&deg; Documento</th>
                                  <th>Estado</th>
                                  <th>Anular</th>
                                  <th>Editar</th>
                                  <th>Borrar</th>
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
if ($listaTablero->num_rows() > 0) {
    $i = 1;
    foreach ($listaTablero->result() as $row):

    ?>
                                <tr>
                                  <td align="center">
                                    <?=$row->Anio_Ejecucion?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Codigo_Actividad_POI?>
                                  </td>
                                  <td>
                                    <?=$row->descripcion_actividad?>
                                  </td>
                                  <td align="left">
                                    <?=$row->Nombre_Area?>
                                  </td>
                                  <td align="center">
                                    <?=$row->nombre_unidad_medida?>
                                  </td>
                                  <td align="center">
                                    <?=$row->nombre_mes?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Cantidad?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Codigo_Actividad_proyecto?>
                                  </td>
                                  <td align="center">
                                    <?=$row->codigo_actividad?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Codigo_Programa_presupuestal?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Codigo_Finalidad?>
                                  </td>
                                  <td align="center">
                                    <?php if (strlen($row->Archivo) > 0) {?>
                                    <a href='<?=base_url() . "public/tablero/" . $row->Archivo?>' target="_blank" class="btn btn-default btn-circle">
                                      <i class="fa fa-file-code-o" aria-hidden="true"></i></a>
                                    <?php }?>
                                  </td>
                                  <td align="left">
                                    <?=$row->Numero_Documento?>
                                  </td>
                                  <td align="center">
                                    <?php if ($row->Activo == "1") {?>
                                    <span class="badge badge-success">ACTIVO</span>
                                    <?php } else {?>
                                    <span class="badge badge-warning">ANULADO</span>
                                    <?php }?>
                                  </td>
                                  <td>
                                    <?php if ($row->Activo == "1") {?>
                                    <button class="btn btn-primary btn-circle actionDisable" title="ANULAR" type="button">
                                      <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                    <?php } else {?>
                                    <button class="btn btn-success btn-circle actionEnable" title="ACTIVAR" type="button">
                                      <i class="fa fa-check" aria-hidden="true"></i>
                                    </button>
                                    <?php }?>
                                  </td>
                                  <td>
                                    <?php if ($row->Activo == "1") {?>
                                    <button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button">
                                      <i class="fa fa-pencil-square-o"></i>
                                    </button>
                                    <?php } else {?>
                                    <button class="btn btn-default btn-circle disabled" title="EDITAR" type="button">
                                      <i class="fa fa-pencil-square-o"></i>
                                    </button>
                                    <?php }?>
                                  </td>
                                  <td>
                                    <button class="btn btn-danger btn-circle actionDelete" title="ELIMINAR" type="button">
                                      <i class="fa fa fa-trash-o"></i>
                                    </button>
                                  </td>
                                  <td align="center">
                                    <?=$row->id?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Codigo_Unidad_Medida?>
                                  </td>
                                  <td align="center">
                                    <?=$row->codigo_mes?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Codigo_Area?>
                                  </td>
                                  <td align="center">
                                    <?=$row->costo?>
                                  </td>
                                  <td>
                                    <?=$row->Nombre_Archivo?>
                                  </td>
                                  <td>
                                    <?=$row->Observaciones?>
                                  </td>
                                  <td>
                                    <?=$row->Logros?>
                                  </td>
                                  <td>
                                    <?=$row->Id_Actividad_POI?>
                                  </td>
                                </tr>
                                <?php
$i++;
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

      <?php $this->load->view("inc/footer");?>
      <script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>
    </div>

  </div>

  <div class="modal fade" id="disableModal" tabindex="-1" role="dialog" aria-labelledby="activateModal">
    <div class="modal-dialog" role="document">
      <form action="<?=base_url()?>tablero/desactivar" method="POST">
        <input type="hidden" name="id" value="" />
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Desactivar Tablero</h5>

          </div>
          <div class="modal-body">
            &iquest;Seguro(a) desea Desactivar el tablero?
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-info">Desactivar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="enableModal" tabindex="-1" role="dialog" aria-labelledby="activateModal">
    <div class="modal-dialog" role="document">
      <form action="<?=base_url()?>tablero/activar" method="POST">
        <input type="hidden" name="id" value="" />
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Activar Tablero</h5>

          </div>
          <div class="modal-body">
            &iquest;Seguro(a) desea Activar el tablero?
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-info">Activar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTablero">
    <div class="modal-dialog" role="document">
      <form action="<?=base_url()?>tablero/eliminar" method="POST">
        <input type="hidden" name="id" value="" readonly />
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Borrar Tablero</h5>

          </div>
          <div class="modal-body">
            &iquest;Seguro(a) desea Borrar el tablero?
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-info">Borrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="registrarModal" tabindex="-1" role="dialog" aria-labelledby="registrarTableroModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="registrarTableroModalLabel">Registrar Tablero</h5>
        </div>
        <form id="formRegistrar" autocomplete="off" name="formRegistrar" action="<?=base_url()?>tablero/registrar"
          method="POST" enctype="multipart/form-data">
          <div class="modal-body">

            <input type="hidden" name="anioEjecucion" />
            <input type="hidden" name="nombreProyecto" />
            <div class="row">
              <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                  <label class="">A&ntilde;o de Ejecución</label>
                  <select class="form-control" name="Anio_Ejecucion" style="font-size: 12px;" required>
                    <option value="">[A&ntilde;o]</option>
                    <?php foreach ($listaAnioEjecucion->result() as $row): ?>
                    <option value="<?=$row->Anio_Ejecucion?>" <?=($anio==$row->Anio_Ejecucion) ? "selected" : ""?>>
                      <?=$row->Anio_Ejecucion?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <input type="hidden" id="Nombre_Area" name="Nombre_Area"/>
              <input type="hidden" id="Nombre_Actividad_POI" name="Nombre_Actividad_POI"/>
              <input type="hidden" id="Nombre_Medida" name="Nombre_Medida"/>
              <input type="hidden" id="Nombre_Indicador" name="Nombre_Indicador"/>

              <div class="col-xs-12 col-sm-8">
                <div class="form-group">
                  <label class="">Unidad Funcional y/o &Aacute;rea</label>
                  <select class="form-control" name="Codigo_Area" style="font-size: 12px;" required id="Codigo_Area_Registro">
                    <option value="">[ -- Seleccione -- ]</option>
                    <?php foreach ($listaAreasByUser->result() as $row): ?>
                    <option value="<?=$row->Codigo_Area?>">
                      <?=$row->Nombre_Area?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-8">
                <div class="form-group">
                  <label class="">Acción Operativa (Tarea)</label>
                  <select class="form-control" name="Id_Actividad_POI" style="font-size: 12px;" required id="Id_Actividad_POI">
                    <option value="">[ -- Seleccione -- ]</option>
                    <?php foreach ($listaActividadPoi->result() as $row): ?>
                    <option value="<?=$row->Id_Actividad_POI?>">
                      <?=$row->Codigo_Actividad_POI . ' - ' . $row->Descripcion_Actividad?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                  <label class="">Unidad Medida</label>
                  <input class="form-control" name="Codigo_Unidad_Medida" disabled />
                </div>
              </div>

            </div>
            <hr style="width: 100%" />

            <div class="row">
              <div class="col-xs-12 col-sm-3">
                <div class="form-group">
                  <label class="">Cargar Documento</label>
                  <div class="box">
                    <input type="file" name="file" id="file-mes" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"
                      multiple />
                    <label for="file-mes"><i class="fa fa-upload" aria-hidden="true"></i> <span>Escoger archivo&hellip;</span></label></div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-3">
                <label class="">Cantidad</label>
                <input type="number" min="0" value="0" class="form-control" name="cantidad" />
              </div>
              <div class="col-xs-12 col-sm-3">
                <label class="">Costo</label>
                <input type="number" min="0" value="0" class="form-control" name="costo" />
              </div>
              <div class="col-xs-12 col-sm-3">
                <div class="form-group">
                  <label class="">Mes ejecuci&oacute;n</label>
                  <select class="form-control" name="codigo_mes" style="font-size: 12px;" required>
                    <option value="">[ -- Seleccione -- ]</option>
                    <?php foreach ($listaMeses->result() as $row): ?>
                    <option value="<?=$row->id?>">
                      <?=$row->nombre_mes?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                  <label class="">Producto Presupuestal</label>
                  <input type="text" class="form-control" name="proyecto" value="" style="font-size: 12px;" disabled>
                </div>
              </div>
              <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                  <label class="">Actividad Presupuestal</label>
                  <input type="text" class="form-control" name="actividad" value="" style="font-size: 12px;" disabled>
                </div>
              </div>
              <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                  <label class="">Finalidad Presupuestal</label>
                  <input type="text" class="form-control" name="finalidad" value="" style="font-size: 12px;" disabled>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Indicador Asignado</label>
                  <input type="text" class="form-control" name="indicador" value="" style="font-size: 12px;" disabled>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">N&uacute;mero de Documento</label>
                  <input type="text" class="form-control" name="Numero_Documento" value="" style="font-size: 12px; text-transform:uppercase;">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Descripci&oacute;n General de la Carga</label>
                  <input type="text" class="form-control" name="Observaciones" value="" style="font-size: 12px; text-transform:uppercase;">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Logro obtenido</label>
                  <input type="text" class="form-control" name="Logro" value="" style="font-size: 12px; text-transform:uppercase;">
                </div>
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

  <div class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarTableroModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="actualizarTableroModalLabel">Actualizar Tablero</h5>
        </div>
        <form id="formActualizar" action="<?=base_url()?>tablero/actualizar" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="id" />
            <div class="row">
              <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                  <label class="">A&ntilde;o de Ejecución</label>
                  <select class="form-control" name="Anio_Ejecucion" style="font-size: 12px;" required>
                    <option value="">[A&ntilde;o]</option>
                    <?php foreach ($listaAnioEjecucion->result() as $row): ?>
                    <option value="<?=$row->Anio_Ejecucion?>" <?=($anio==$row->Anio_Ejecucion) ? "selected" : ""?>>
                      <?=$row->Anio_Ejecucion?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>

              <div class="col-xs-12 col-sm-8">
                <div class="form-group">
                  <label class="">Unidad Funcional y/o &Aacute;rea</label>
                  <select class="form-control" name="Codigo_Area" style="font-size: 12px;" required>
                    <option value="">[ -- Seleccione -- ]</option>
                    <?php foreach ($listaAreasByUser->result() as $row): ?>
                    <option value="<?=$row->Codigo_Area?>">
                      <?=$row->Nombre_Area?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-8">
                <div class="form-group">
                  <label class="">Acción Operativa (Tarea)</label>
                  <select class="form-control" name="Id_Actividad_POI" style="font-size: 12px;" required>
                    <option value="">[ -- Seleccione -- ]</option>
                    <?php foreach ($listaActividadPoi->result() as $row): ?>
                    <option value="<?=$row->Id_Actividad_POI?>">
                      <?=$row->Descripcion_Actividad?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                  <label class="">Unidad Medida</label>
                  <input class="form-control" name="Codigo_Unidad_Medida" disabled />
                </div>
              </div>

            </div>
            <hr style="width: 100%" />

            <div class="row">
              <div class="col-xs-12 col-sm-3">
                <div class="form-group">
                  <label id="editFile" class="">Cargar Documento</label>
                  <div class="box">
                    <input type="file" name="file" id="file-mes-update" class="inputfile inputfile-1"
                      data-multiple-caption="{count} files selected" multiple />
                    <label for="file-mes-update"><i class="fa fa-upload" aria-hidden="true"></i> <span>Escoger
                        archivo&hellip;</span></label></div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-3">
                <label class="">Cantidad</label>
                <input type="number" class="form-control" name="cantidad" />
              </div>
              <div class="col-xs-12 col-sm-3">
                <label class="">Costo</label>
                <input type="number" min="0" class="form-control" name="costo" />
              </div>
              <div class="col-xs-12 col-sm-3">
                <div class="form-group">
                  <label class="">Mes ejecuci&oacute;n</label>
                  <select class="form-control" name="codigo_mes" style="font-size: 12px;" required>
                    <option value="">[ -- Seleccione -- ]</option>
                    <?php foreach ($listaMeses->result() as $row): ?>
                    <option value="<?=$row->id?>">
                      <?=$row->nombre_mes?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                  <label class="">Producto Presupuestal</label>
                  <input type="text" class="form-control" name="proyecto" value="" style="font-size: 12px;" disabled>
                </div>
              </div>
              <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                  <label class="">Actividad Presupuestal</label>
                  <input type="text" class="form-control" name="actividad" value="" style="font-size: 12px;" disabled>
                </div>
              </div>
              <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                  <label class="">Finalidad Presupuestal</label>
                  <input type="text" class="form-control" name="finalidad" value="" style="font-size: 12px;" disabled>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Indicador Asignado</label>
                  <input type="text" class="form-control" name="indicador" value="" style="font-size: 12px;" disabled>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">N&uacute;mero de Documento</label>
                  <input type="text" class="form-control" name="Numero_Documento" value="" style="font-size: 12px; text-transform:uppercase;">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Descripci&oacute;n General de la Carga</label>
                  <input type="text" class="form-control" name="Observaciones" value="" style="font-size: 12px; text-transform:uppercase;">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Logro Obtenido</label>
                  <input type="text" class="form-control" name="Logro" value="" style="font-size: 12px; text-transform:uppercase;">
                </div>
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

  <script src="<?=base_url()?>public/js/tablero/gestionarTablero.js?v=<?=date(" s")?>"></script>
  <script>
    var grafico = '<?=$grafico?>';
    gestionarTablero("<?=base_url()?>", grafico);

    obtenerGrafica("<?=base_url()?>", grafico)

  </script>

</body>

</html>