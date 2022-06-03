<!doctype html>
<html lang="en">
   <head>
       <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?=TITULO_PRINCIPAL?></title>
      <meta name="author" content="<?=AUTOR?>">
      <link rel="shortcut icon" href="<?=base_url()?>public/images/favicon.jpg">
      <link rel="icon" href="<?=base_url()?>public/images/favicon.jpg" type="image/x-icon">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/typography.css">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/style.css">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/responsive.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css"/>
      <?php
      $titulo = "Tablero de Control de Gesti&oacute;n - DIGERD";
      $botonCrear = "Registro y Carga de Data en el Tablero de Control";
      ?>
      <?php $opciones = $this->session->userdata("Permisos_Opcion");?>
      <style>
            #canvas .circle
            {
               display: inline-block;
               margin: 1em;
            }
            .circles-decimals
            {
               font-size: .4em;
            }
      </style>
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
      <link rel="stylesheet" href="<?=base_url()?>public/css/tablero/gestionarTablero.css?v=<?=date(" s")?>" />
   </head>
   <body>
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <div class="wrapper">
        <?php $this->load->view("inc/nav-template");?>
         <div id="content-page" class="content-page">
            <?php $this->load->view("inc/nav-top-template");?>
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                    <?php //echo "<pre>"; echo $lista; echo '<br>'.$pacientes;//echo "<pre>"; echo var_dump($lista); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-bg-primary rounded">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-user-fill"></i></div>
                              <div class="text-right">

                                 <h2 class="mb-0"> <?=$totalActividadPoi?></h2>
                                 <h5 class="">Acc. Operativas</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-bg-warning rounded">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="rounded-circle iq-card-icon bg-warning"><i class="ri-women-fill"></i></div>
                              <div class="text-right">
                                 <h2 class="mb-0"> <?=$totalUnidadesFuncionales?> </h2>
                                 <h5 class="">Áreas/Unidades</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-bg-danger rounded">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="rounded-circle iq-card-icon bg-danger"><i class="ri-group-fill"></i></div>
                              <div class="text-right">
                                 <h2 class="mb-0"><?=$totalActividadPresupuestal?></h2>
                                 <h5 class="">Act.Presupuestal</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-bg-info rounded">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="rounded-circle iq-card-icon bg-info"><i class="ri-hospital-line"></i></div>
                              <div class="text-right">
                                 <h2 class="mb-0">  <?=$totalProductos?></h2>
                                 <h5 class="">Pro.Presupuestal</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                           <h4 class="card-title"><p><center>Resumen de Ejecución de Metas Físicas por Áreas y/o Unidades Operativas Expresado en Porcentajes (%)</center></p></h4>
                              <center>
                                 <div id="canvas">
                                    <?php foreach ($listaGraficoAreas->result() as $row): ?>
                                       <div class="circle" id="circles-<?=$row->Codigo_Area?>"></div>
                                    <?php endforeach;?>
                                 </div>
                              </center>
                              <center>
                                 <div>
                                    <?php foreach ($listaGraficoAreas->result() as $row): ?>
                                       <label style="width:13%"><?=$row->Siglas_Area?></label>
                                    <?php endforeach;?>
                                 </div>
                              </center>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title"><p><center>Reporte de Ejecución del Presupuesto por Áreas y/o Unidades Operativas (En Porcentajes (%))</center></p></h4>
                           </div>
                        </div>
                        <div class="iq-card-body" style="position: relative;height: 400px;">
                           <div id="graficoPastel"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title"><p><center>Reporte de Ejecución del Presupuesto por Áreas y/o Unidades Operativas (Monto en Soles)</center></p></h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div id="graficoBarra"></div>
                        </div>
                     </div>
                  </div>
                  
                  <?php if (validarPermisosOpciones(54, $opciones)) {?>
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title">Detalle</h4>
                              </div>
                        </div>
                        <div class="iq-card-body">
                          <div>
                           <form id="formCambioFecha" action="<?=base_url()?>tablero/gestionar" method="POST">
                                 <div class="form-group row">
                                    <label class="control-label col-sm-5 align-self-center mb-0" for="email">Seleccione el año de Ejecucion:</label>
                                    <div class="col-sm-7">
                                    <select class="form-control" id="Anio" name="Anio">
                                       <option value="">[Seleccione]</option>
                                       <?php foreach ($listaAnioEjecucion->result() as $row): ?>
                                       <?php if ($row->Anio_Ejecucion == $anio) {?>
                                       <option value="<?=$row->Anio_Ejecucion?>" selected>
                                          <?=$row->Anio_Ejecucion?>
                                       </option>
                                       <?php } else {?>
                                       <option value="<?=$row->Anio_Ejecucion?>">
                                          <?=$row->Anio_Ejecucion?>
                                       </option>
                                       <?php }?>
                                       <?php endforeach;?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="control-label col-sm-5 align-self-center mb-0" for="pwd1">Seleccione la unidad operativa y/o area:</label>
                                    <div class="col-sm-7">
                                    <select class="form-control" id="Codigo_Area" name="Codigo_Area" style="font-size: 12px;"
                                          required>
                                          <option value="">[ -- Seleccione -- ]</option>
                                          <?php foreach ($listaAreasByUser->result() as $row): ?>
                                          <option value="<?=$row->Codigo_Area?>">
                                             <?=$row->Nombre_Area?>
                                          </option>
                                          <?php endforeach;?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="control-label col-sm-5 align-self-center mb-0" for="pwd1">Seleccione un mes:</label>
                                    <div class="col-sm-7">
                                    <select class="form-control" name="mes" id="textSearch">
                                       <option value="">-- Seleccione --</option>
                                       <option value="01">Enero</option>
                                       <option value="02">Febrero</option>
                                       <option value="03">Marzo</option>
                                       <option value="04">Abril</option>
                                       <option value="05">Mayo</option>
                                       <option value="06">Junio</option>
                                       <option value="07">Julio</option>
                                       <option value="08">Agosto</option>
                                       <option value="09">Setiembre</option>
                                       <option value="10">Octubre</option>
                                       <option value="11">Noviembre</option>
                                       <option value="12">Diciembre</option>
                                    </select>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-xs-12 col-md-5 col-md-offset-5 pa-10">
                                       <?php if (validarPermisosOpciones(53, $opciones)) {?>
                                       <button type="button" class="btn btn-primary" data-toggle="modal" id="btnRegistrar">
                                       <?=$botonCrear?>
                                       </button>
                                       <?php }?>
                                    </div>
                                 </div>
                              </form>
                          </div>
                           <div class="table-responsive">
                              <table id="tbListar" class="table table-striped table-bordered">
                                 <thead>
                                 <tr>
                                    <th>Acciones</th>
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
                                    <th>Acciones</th>
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
                                                                     <td>
                                                                        <div>
                                                                           <?php if ($row->Activo == "1") {?>
                                                                           <button class="btn btn-primary btn-circle actionDisable" title="ANULAR" type="button">
                                                                           <i class="fa fa-times" aria-hidden="true"></i>
                                                                           </button>
                                                                           <?php } else {?>
                                                                           <button class="btn btn-success btn-circle actionEnable" title="ACTIVAR" type="button">
                                                                           <i class="fa fa-check" aria-hidden="true"></i>
                                                                           </button>
                                                                           <?php }?>
                                                                        </div>
                                                                        <div>
                                                                           <?php if ($row->Activo == "1") {?>
                                                                           <button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button">
                                                                           <i class="fa fa-pencil-square-o"></i>
                                                                           </button>
                                                                           <?php } else {?>
                                                                           <button class="btn btn-warning btn-circle disabled" title="EDITAR" type="button">
                                                                           <i class="fa fa-pencil-square-o"></i>
                                                                           </button>
                                                                           <?php }?>
                                                                        </div>
                                                                        <div>
                                                                           <button class="btn btn-danger btn-circle actionDelete" title="ELIMINAR" type="button">
                                                                           <i class="fa fa fa-trash-o"></i>
                                                                           </button>
                                                                        </div>
                                                                     </td>
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
                                                                        <?//=$row->Codigo_Actividad_proyecto?>
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
                                                                     <?=$row->Archivo?>
                                                                     </td>
                                                                     <td align="left">
                                                                        <?=$row->Numero_Documento?>
                                                                     </td>
                                                                     <td align="center">
                                                                        <?=$row->Activo?>
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
                  <?php }?>

               </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTablero">
               <div class="modal-dialog" role="document">
                  <form action="<?=base_url()?>tablero/eliminar" method="POST">
                  <input type="hidden" name="id" value="" readonly />
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Borrar Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        &iquest;Seguro(a) desea Borrar el Registro Seleccionado?
                     </div>
                     <div class="modal-footer">
                        <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-info">Borrar</button>
                     </div>
                  </div>
                  </form>
               </div>
            </div>
            <div class="modal fade" id="anularModal" tabindex="-1" role="dialog" aria-labelledby="anularTablero">
               <div class="modal-dialog" role="document">
                  <form action="<?=base_url()?>tablero/desactivar" method="POST">
                  <input type="hidden" name="id" value="" readonly />
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Anular Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        &iquest;Seguro(a) desea Anular el Registro Seleccionado?
                     </div>
                     <div class="modal-footer">
                        <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-info">Anular</button>
                     </div>
                  </div>
                  </form>
               </div>
            </div>
            <div class="modal fade" id="activarModal" tabindex="-1" role="dialog" aria-labelledby="activarTablero">
               <div class="modal-dialog" role="document">
                  <form action="<?=base_url()?>tablero/activar" method="POST">
                  <input type="hidden" name="id" value="" readonly />
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Activar Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        &iquest;Seguro(a) desea Activar el Registro Seleccionado?
                     </div>
                     <div class="modal-footer">
                        <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-info">Activar</button>
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
                     <h5 class="modal-title" id="registrarTableroModalLabel">Registrar Tablero</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
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
                              <input type="file" name="file" id="file-mes" accept=".pdf" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"
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
                        <div class="col-sm-12">
                           <div class="form-group">
                              <label class="">Indicador Asignado</label>
                              <input type="text" class="form-control" name="indicador" value="" style="font-size: 12px;" disabled>
                           </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-12">
                           <div class="form-group">
                              <label class="">N&uacute;mero de Documento</label>
                              <input type="text" class="form-control" name="Numero_Documento" value="" style="font-size: 12px; text-transform:uppercase;">
                           </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-12">
                           <div class="form-group">
                              <label class="">Descripci&oacute;n General de la Carga</label>
                              <input type="text" class="form-control" name="Observaciones" value="" style="font-size: 12px; text-transform:uppercase;">
                           </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-12">
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
            <div class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarTableroModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="actualizarTableroModalLabel">Actualizar Tablero</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
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
                           <input type="number" class="form-control" name="cantidad" id="cantidad" />
                        </div>
                        <div class="col-xs-12 col-sm-3">
                           <label class="">Costo</label>
                           <input type="number" min="0" class="form-control" name="costo" id="costo"/>
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
                           <div class="col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label class="">Indicador Asignado</label>
                                 <input type="text" class="form-control" name="indicador" value="" style="font-size: 12px;" disabled>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                        <div class="col-xs-12 col-sm-12">
                           <div class="form-group">
                              <label class="">N&uacute;mero de Documento</label>
                              <input type="text" class="form-control" name="Numero_Documento" value="" style="font-size: 12px; text-transform:uppercase;">
                           </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-xs-12 col-sm-12">
                           <div class="form-group">
                              <label class="">Descripci&oacute;n General de la Carga</label>
                              <input type="text" class="form-control" name="Observaciones" value="" style="font-size: 12px; text-transform:uppercase;">
                           </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-xs-12 col-sm-12">
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
            <?php $this->load->view("inc/footer-template");?>
         </div>
      </div>
      <?php $this->load->view("inc/resource-template");?>
      <script src="<?=base_url()?>public/js/tablero/gestionarTablero.js?v=<?=date(" s")?>"></script>
      <script>
         var grafico = '<?=$grafico?>';
         var dataGraficoAreas = '<?=$dataGraficoAreas?>';
         gestionarTablero("<?=base_url()?>", grafico);
         generarGraficaCircular(dataGraficoAreas);
         generarBarras(dataGraficoAreas);
         generarPastel(dataGraficoAreas);
         // obtenerGrafica("<?=base_url()?>", grafico);
         const canDelete = "1";
         const canEdit = "1";
         const canTracking = "1";
         const canHistory = "1";
         const lista = "";
      </script>
   </body>
</html>