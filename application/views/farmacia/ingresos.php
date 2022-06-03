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
      <?php $titulo = "Registro de Ingresos de PF - EPP - MM"; ?>
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
      <link rel="stylesheet" href="<?=base_url()?>public/css/farmacia/main.css" />
      <link rel="stylesheet" href="<?=base_url()?>public/css/farmacia/modal.css" />
      <!-- <link rel="stylesheet" href="<?=base_url()?>public/css/tablero/gestionarTablero.css?v=<?=date(" s")?>" /> -->
      <?php $opciones = $this->session->userdata("Permisos_Opcion");?>
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
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title"><?=$titulo?></h4>
                              </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="form-group row">
                            <div class="col-sm-12 col-md-5 col-md-offset-5 pa-10">
                                <button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal" id="btnRegistrar">
                                  Nuevo Guía Ingreso
                                </button>
                            </div>
                           </div>
                           <div class="table-responsive main-table">
                              <table id="tableArticuloInventariado" class="table table-striped table-bordered">
                                 <thead>
                                  <tr>
                                    <th>EDITAR</th>
                                    <th>AÑO</th>
                                    <th>NÚMERO</th>
                                    <th>EMISIÓN</th>
                                    <th>TIPO DE INGRESO</th>
                                    <th>ALMACÉN ASIGNADO</th>
                                    <th>ADJUNTO</th>
                                    <th>OBSERVACIONES</th>
                                    <th>ESTADO</th>
                                  </tr>
                                 </thead>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal fade modal-fullscreen" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="editarModalLabel"></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="formRegistrar" method="post" action="" autocomplete="off" enctype="multipart/form-data">
                      <div class="modal-body">
                        <input type="hidden" name="idingreso" id ="idingreso" >
                        <div class="alert alert-warning ingresos__alert" role="alert" hidden>
                          <span class="alert__span"></span>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label class="modal-label col-sm-5 col-form-label py-10">Año de Ejecución</label>
                              <div class="col-sm-7">
                                <select class="form-control" name="anio" id="anio">
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
                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label class="modal-label col-sm-5 col-form-label py-10">Fecha de Emision</label>
                              <div class="col-sm-7">
                                <div class="form-group">
                                  <div class='input-group'>
                                    <input type="date" class="form-control" name="fechaEmision" id="fechaEmision"  max="<?= date("Y-m-d") ?>"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label class="modal-label col-sm-5 col-form-label py-10">Tipo de Ingreso</label>
                              <div class="col-sm-7">
                                <select class="form-control" name="tipoIngreso" id="tipoIngreso">
                                <option value="">-- Tipos de Ingreso --</option>
                                <?php foreach($listaTipoIngreso as $row): ?>
                                <option value="<?=$row->id?>"><?=$row->descripcion?></option>
                                <?php endforeach; ?>
                              </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group row">
                            <label class="modal-label col-sm-5 col-form-label py-10">Almacén de Destino</label>
                              <div class="col-sm-7">
                                <select class="form-control" name="almacen" id="almacen">
                                  <option value="">-- Almacén --</option>
                                  <?php foreach($listaAlmacenes as $row): ?>
                                  <option value="<?=$row->idalmacen?>"><?=$row->nombre?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label class="modal-label col-sm-5 col-form-label py-10">Observaciones</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="observaciones" id="observaciones" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label class="modal-label col-sm-5 col-form-label py-10">Archivo Adjunto</label>
                              <div class="col-sm-7">
                                <input type="file" name="ficha" id="ficha" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                                <label for="ficha"><i class="fa fa-upload" aria-hidden="true"></i> <span class="custom-file">Escoger Archivo &hellip;</span></label>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <button type="button" class="btn btn-primary col-sm-12 btn-buscar">Agregar Artículo</button>
                          </div>
                        </div>
                        <br/>
                        <h2 class="text-divider"><span>Lista de Artículos</span></h2>
                        <div class="table-responsive main-table">
                          <table class="tableArticuloIngresos table table-bordered" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Descripción del Articulo</th>
                                <th>Lote</th>
                                <th>Cantidad</th>
                                <th>Vencimiento</th>
                                <th>Costo Unitario</th>
                                <th>Categoría</th>
                                <th>Presentación</th>
                                <th></th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                        <hr/>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="tableArticuloModal" tabindex="-1" role="dialog" aria-labelledby="tableArticuloLabel" aria-hidden="false" style="z-index: 1600;">
                <div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="registrarTableroModalLabel">Seleccionar Artículo</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form id="formArticuloRegistrar">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group row">
                            <label class="modal-label col-sm-5 col-form-label py-10">Lote</label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control" name="lote" id="lote" value=""/>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group row">
                            <label class="modal-label col-sm-5 col-form-label py-10">Cantidad</label>
                            <div class="col-sm-7">
                              <input type="number" class="form-control" name="cantidad" id="cantidad" value=""/>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group row">
                            <label class="modal-label col-sm-5 col-form-label py-10">Fecha de Vencimiento</label>
                            <div class="col-sm-7">
                                <div class='input-group'>
                                  <input type="date" class="form-control" name="vencimiento" id="vencimiento" />
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group row">
                            <label class="modal-label col-sm-5 col-form-label py-10">Costo Unitario</label>
                            <div class="col-sm-7">
                              <input type="number" class="form-control" name="costo_unitario" id="costo_unitario" value=""/>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group row">
                            <label class="modal-label col-sm-5 col-form-label py-10">Observaciones</label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control" name="observacionArticulo" id="observacionArticulo" value=""/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <table class="tableArticulo table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Descripción del Articulo</th>
                            <th>Categoría</th>
                            <th>Presentación</th>
                            <th>Vía</th>
                            <th>Condición</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
              <?php $this->load->view("inc/footer-template");?>
              <script src="<?=base_url()?>public/js/moment.min.js"></script>
              <script src="<?=base_url()?>public/js/locale.es.js"></script>
         </div>
      </div>
     <?php $this->load->view("inc/resource-template");?>
      <script>
        var URI_MAP = "<?=base_url()?>";
        var lista = JSON.parse('<?=$listaIngresos?>');
      </script>
      <script src="<?=base_url()?>public/js/farmacia/ingresos.js?v=<?=date(" his")?>"></script>
   </body>
</html>