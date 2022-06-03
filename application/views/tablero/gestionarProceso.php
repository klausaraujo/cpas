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
$titulo = "Gestionar Acciones Operativas (Tareas)";
$botonCrear = "Registrar Acción Operativa (Tarea)";
?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/tablero/gestionarProceso.css?v=<?=date(" s")?>" />
</head>
<body>
  <div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
    <?php $this->load->view("inc/nav");?>
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
              <li class="active"><span>Acciones Operativas (Tareas)</span></li>
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
                          <div class="alert alert-success"><span>
                              <?=$message?></span></div>
                          <?php }?>
                          <?php $message = $this->session->flashdata('mensajeError');?>
                          <?php if ($message) {?>
                          <div class="alert alert-danger"><span>
                              <?=$message?></span></div>
                          <?php }?>
                          <?php $message = $this->session->flashdata('mensajeWarning');?>
                          <?php if ($message) {?>
                          <div class="alert alert-warning"><span>
                              <?=$message?></span></div>
                          <?php }?>
                          <div class="clearfix"></div>
                          <div class="row pa-10">
                            <div class="col-xs-12 col-md-5 pa-10">
                              <div class="form-group">
                                <form id="formCambioFecha" action="<?=base_url()?>tablero/proceso" method="POST"
                                  autocomplete="off">
                                  <div class="col-xs-12 col-sm-6 col-md-4 pa-10"><label>Filtrar por A&ntilde;o de Ejecución</label></div>
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
                            <div class="col-xs-12 col-md-6 col-offset-2 pull-right pa-10">
                              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#registrarModal">
                                <?=$botonCrear?>
                              </button>
                            </div>
                          </div>
                          <div class="table-responsive">
                            <table id="tbListar" class="table table-bordered table-sm">
                              <thead>
                                <tr>
                                  <th>C&oacute;d.</th>
                                  <th>A&ntilde;o</th>
                                  <th>Acciones Operativas (Tareas)</th>
                                  <th>Producto Presupuestal</th>
                                  <th>Actividad Presupuestal</th>
                                  <th>Meta Física</th>
                                  <th>Meta Financiera</th>
                                  <th>Unidad Medida</th>
                                  <th>Editar</th>
                                  <th>Borrar</th>
                                  <th>Codigo_Sector</th>
                                  <th>Codigo_Pliego</th>
                                  <th>Codigo_Ejecutora</th>
                                  <th>Codigo_Centro_Costos</th>
                                  <th>Codigo_Sub_Centro_Costos</th>
                                  <th>Codigo_Programa_Presupuestal</th>
                                  <th>Codigo_Finalidad</th>
                                  <th>Codigo_Unidad_Medida</th>
                                  <th>Codigo_Actividad_Proyecto</th>
                                  <th>Codigo_Actividad</th>
                                  <th>ID</th>
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
                                  <th>Activo</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
if ($lista->num_rows() > 0) {
    $i = 1;
    foreach ($lista->result() as $row):
    ?>
                                <tr>
                                  <td align="center">
                                    <?=$row->Codigo_Actividad_POI?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Anio?>
                                  </td>
                                  <td>
                                    <?=$row->Actividad_POI?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Proyecto?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Actividad?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Cantidad?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Costo?>
                                  </td>
                                  <td align="center">
                                    <?=$row->Unidad_Medida?>
                                  </td>
                                  <td align="center"><button class="btn btn-warning btn-circle actionEdit" title="EDITAR"
                                      type="button"><i class="fa fa-pencil-square-o"></i></button></td>
                                  <td align="center"><button class="btn btn-danger btn-circle actionDelete" title="ELIMINAR"
                                      type="button"><i class="fa fa fa-trash-o"></i></button></td>
                                  <td>
                                    <?=$row->Codigo_Sector?>
                                  </td>
                                  <td>
                                    <?=$row->Codigo_Pliego?>
                                  </td>
                                  <td>
                                    <?=$row->Codigo_Ejecutora?>
                                  </td>
                                  <td>
                                    <?=$row->Codigo_Centro_Costos?>
                                  </td>
                                  <td>
                                    <?=$row->Codigo_Sub_Centro_Costos?>
                                  </td>
                                  <td>
                                    <?=$row->Codigo_Programa_Presupuestal?>
                                  </td>
                                  <td>
                                    <?=$row->Codigo_Finalidad?>
                                  </td>
                                  <td>
                                    <?=$row->Codigo_Unidad_Medida?>
                                  </td>
                                  <td>
                                    <?=$row->Codigo_Actividad_Proyecto?>
                                  </td>
                                  <td>
                                    <?=$row->Codigo_Actividad?>
                                  </td>
                                  <td>
                                    <?=$row->ID?>
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
                                    <?=$row->Activo?>
                                  </td>
                                </tr>
                                <?php
$i++;
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
       <?php $this->load->view("inc/footer");?>
      <script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>
       </div>
  </div>
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteActividadPOI">
    <div class="modal-dialog" role="document">
      <form action="<?=base_url()?>tablero/proceso/eliminar" method="POST" autocomplete="off">
        <input type="hidden" name="id" value="" readonly />
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h5 class="modal-title">Borrar Acción Operativa (Tarea)</h5>

          </div>
          <div class="modal-body">
            &iquest;Seguro(a) desea Borrar la Acción Operativa (Tarea) <strong id="eliminar_proceso"></strong>?
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
          <h5 class="modal-title" id="registrarTableroModalLabel">Registrar Acción Operativa (Tarea)</h5>
        </div>
        <form id="formRegistrar" name="formRegistrar" action="<?=base_url()?>tablero/proceso/registrar" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cboAnio">A&ntilde;o de Ejecución</label>
                  <select name="cboAnio" id="cboAnio" class="form-control">
                    <option value="">[Seleccione...]</option>
                    <?php foreach ($listaAnioEjecucion->result() as $row): ?>
                    <option value="<?=$row->Anio_Ejecucion?>" <?=($anio==$row->Anio_Ejecucion) ? "selected" : ""?>>
                      <?=$row->Anio_Ejecucion?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="cboSector">Sector</label>
                  <input name="cboSector" id="cboSector" class="form-control" disabled />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cboPliego">Pliego</label>
                  <input name="cboPliego" id="cboPliego" class="form-control" disabled />
                </div>
                <div class="form-group col-md-6">
                  <label for="cboEjecutora">Ejecutora</label>
                  <input name="cboEjecutora" id="cboEjecutora" class="form-control" disabled />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cboCentroCostos">Centro de Costos</label>
                  <input name="cboCentroCostos" id="cboCentroCostos" class="form-control detalle-size" disabled />
                </div>
                <div class="form-group col-md-6">
                  <label for="cboSubCentroCostos">Sub Centro de Costos</label>
                  <input name="cboSubCentroCostos" id="cboSubCentroCostos" class="form-control detalle-size" disabled />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cboProgramaPresupuestal">Programa Presupuestal</label>
                  <input name="cboProgramaPresupuestal" id="cboProgramaPresupuestal" class="form-control detalle-size"
                    disabled>
                </div>
                <div class="form-group col-md-6">
                  <label for="cbActividadProyecto">Producto Presupuestal</label>
                  <select name="cbActividadProyecto" id="cbActividadProyecto" class="form-control detalle-size">
                    <option value="">[Seleccione A&ntilde;o...]</option>

                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cboActividad">Actividad Presupuestal</label>
                  <select name="cboActividad" id="cboActividad" class="form-control detalle-size">
                    <option value="">[Seleccione A&ntilde;o...]</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="cboFinalidad">Finalidad Presupuestal</label>
                  <select name="cboFinalidad" id="cboFinalidad" class="form-control detalle-size">
                    <option value="">[Seleccione A&ntilde;o...]</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cboUnidadMedida">Unidad Medida</label>
                  <select name="cboUnidadMedida" id="cboUnidadMedida" class="form-control detalle-size">
                    <option value="">[Seleccione...]</option>
                    <?php foreach ($listaUnidadMedida->result() as $row): ?>
                    <option value="<?=$row->Codigo_Unidad_Medida?>">
                      <?=$row->Codigo_Unidad_Medida . " - " . $row->Nombre_Unidad_Medida?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label class="">Costo Programado</label>
                  <input type="text" class="form-control" name="Costo_Programa" value="" placeholder="####.##" />
                </div>
                <div class="clearfix"></div>
                <div class="tbRegistroMeses">
                  <div class="row" style="padding-bottom: 5px;">
                    <div class="col-xs-6 col-sm-4 col-md-2">
                      <div class="col-xs-6 text-center label-mes">Ene</div>
                      <div class="col-xs-6 field-mes">
                        <input type="text" class="form-control mes1" rel="1" name="enero" value="0" />
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2">
                      <div class="col-xs-6 text-center label-mes">Feb</div>
                      <div class="col-xs-6 field-mes">
                        <input type="text" class="form-control mes2" rel="2" name="febrero" value="0" />
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2">
                      <div class="col-xs-6 text-center label-mes">Mar</div>
                      <div class="col-xs-6 field-mes">
                        <input type="text" class="form-control mes3" rel="3" name="marzo" value="0" />
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2">
                      <div class="col-xs-6 text-center label-mes">Abr</div>
                      <div class="col-xs-6 field-mes">
                        <input type="text" class="form-control mes4" rel="4" name="abril" value="0" />
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2">
                      <div class="col-xs-6 text-center label-mes">May</div>
                      <div class="col-xs-6 field-mes">
                        <input type="text" class="form-control mes5" rel="5" name="mayo" value="0" />
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2">
                      <div class="col-xs-6 text-center label-mes">Jun</div>
                      <div class="col-xs-6 field-mes">
                        <input type="text" class="form-control mes6" rel="6" name="junio" value="0" />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-4 col-md-2">
                      <div class="col-xs-6 text-center label-mes">Jul</div>
                      <div class="col-xs-6 field-mes">
                        <input type="text" class="form-control mes7" rel="7" name="julio" value="0" />
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2">
                      <div class="col-xs-6 text-center label-mes">Ago</div>
                      <div class="col-xs-6 field-mes">
                        <input type="text" class="form-control mes8" rel="8" name="agosto" value="0" />
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2">
                      <div class="col-xs-6 text-center label-mes">Sep</div>
                      <div class="col-xs-6 field-mes">
                        <input type="text" class="form-control mes9" rel="9" name="septiembre" value="0" />
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2">
                      <div class="col-xs-6 text-center label-mes">Oct</div>
                      <div class="col-xs-6 field-mes">
                        <input type="text" class="form-control mes10" rel="10" name="octubre" value="0" />
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2">
                      <div class="col-xs-6 text-center label-mes">Nov</div>
                      <div class="col-xs-6 field-mes">
                        <input type="text" class="form-control mes11" rel="11" name="noviembre" value="0" />
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-2">
                      <div class="col-xs-6 text-center label-mes">Dic</div>
                      <div class="col-xs-6 field-mes">
                        <input type="text" class="form-control mes12" rel="12" name="diciembre" value="0" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Descripci&oacute;n de Acción Operativa (Tarea)</label>
                  <textarea class="form-control" name="Nombre"></textarea>
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
  <div class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="registrarTableroModalLabel">Editar Acción Operativa (Tarea)</h5>
        </div>
        <form id="formActualizar" action="<?=base_url()?>tablero/proceso/actualizar" method="POST" autocomplete="off">
          <div class="modal-body">
            <input type="hidden" name="id" />
            <div class="row">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cboAnio">A&ntilde;o de Ejecución</label>
                  <select name="cboAnio" id="cboAnio" class="form-control">
                    <option value="">[Seleccione...]</option>
                    <?php foreach ($listaAnioEjecucion->result() as $row): ?>
                    <option value="<?=$row->Anio_Ejecucion?>">
                      <?=$row->Anio_Ejecucion?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="cboSector">Sector</label>
                  <input name="cboSector" id="cboSector" class="form-control" disabled />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cboPliego">Pliego</label>
                  <input name="cboPliego" id="cboPliego" class="form-control" disabled />
                </div>
                <div class="form-group col-md-6">
                  <label for="cboEjecutora">Ejecutora</label>
                  <input name="cboEjecutora" id="cboEjecutora" class="form-control" disabled />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cboCentroCostos">Centro de Costos</label>
                  <input name="cboCentroCostos" id="cboCentroCostos" class="form-control detalle-size" disabled />
                </div>
                <div class="form-group col-md-6">
                  <label for="cboSubCentroCostos">Sub Centro de Costos</label>
                  <input name="cboSubCentroCostos" id="cboSubCentroCostos" class="form-control detalle-size" disabled />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cboProgramaPresupuestal">Programa Presupuestal</label>
                  <input name="cboProgramaPresupuestal" id="cboProgramaPresupuestal" class="form-control detalle-size"
                    disabled />
                </div>
                <div class="form-group col-md-6">
                  <label for="cbActividadProyecto">Producto Presupuestal</label>
                  <select name="cbActividadProyecto" id="cbActividadProyecto" class="form-control detalle-size">
                    <option value="">[Seleccione A&ntilde;o...]</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="cboActividad">Actividad Presupuestal</label>
                  <select name="cboActividad" id="cboActividad" class="form-control detalle-size">
                    <option value="">[Seleccione A&ntilde;o...]</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="cboFinalidad">Finalidad Presupuestal</label>
                  <select name="cboFinalidad" id="cboFinalidad" class="form-control detalle-size">
                    <option value="">[Seleccione A&ntilde;o...]</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="">Unidad Medida</label>
                  <select name="cboUnidadMedida" id="cboUnidadMedida" class="form-control detalle-size">
                    <option value="">[Seleccione...]</option>
                    <?php foreach ($listaUnidadMedida->result() as $row): ?>
                    <option value="<?=$row->Codigo_Unidad_Medida?>">
                      <?=$row->Codigo_Unidad_Medida . " - " . $row->Nombre_Unidad_Medida?>
                    </option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label class="">Costo Programado</label>
                  <input type="text" class="form-control" name="Costo_Programa" id="Costo_Programa" value=""
                    placeholder="####.##" />
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="tbRegistroMeses">
                <div class="row" style="padding-bottom: 5px;">
                  <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="col-xs-6 text-center label-mes">Ene</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes1" rel="1" name="enero" />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="col-xs-6 text-center label-mes">Feb</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes2" rel="2" name="febrero" />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="col-xs-6 text-center label-mes">Mar</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes3" rel="3" name="marzo" />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="col-xs-6 text-center label-mes">Abr</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes4" rel="4" name="abril" />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="col-xs-6 text-center label-mes">May</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes5" rel="5" name="mayo" />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="col-xs-6 text-center label-mes">Jun</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes6" rel="6" name="junio" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="col-xs-6 text-center label-mes">Jul</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes7" rel="7" name="julio" />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="col-xs-6 text-center label-mes">Ago</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes8" rel="8" name="agosto" />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="col-xs-6 text-center label-mes">Sep</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes9" rel="9" name="septiembre" />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="col-xs-6 text-center label-mes">Oct</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes10" rel="10" name="octubre" />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="col-xs-6 text-center label-mes">Nov</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes11" rel="11" name="noviembre" />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-4 col-md-2">
                    <div class="col-xs-6 text-center label-mes">Dic</div>
                    <div class="col-xs-6 field-mes">
                      <input type="text" class="form-control mes12" rel="12" name="diciembre" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Descripci&oacute;n de Acción Operativa (Tarea)</label>
                  <textarea class="form-control" name="Nombre" id="Nombre"></textarea>
                </div>
              </div>
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
  <script src="<?=base_url()?>public/js/tablero/gestionarProceso.js?v=<?=date(" s")?>"></script>
  <script>
    gestionarProceso("<?=base_url()?>", "<?=$anio?>");
  </script>
</body>
</html>