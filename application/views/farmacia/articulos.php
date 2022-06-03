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
      <!-- <link href="<?=base_url()?>public/css/datatables.min.css" rel="stylesheet" type="text/css"> -->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css"/>
      <?php
      $titulo = "Lista General de Productos Farmacéuticos, Equipos de Protección Personal y Material Médico Registrado";
      ?>
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
                            <div class="col-xs-12 col-md-5 col-md-offset-5 pa-10">
                                <button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal" id="btnRegistrar">
                                  Registrar Nuevo Artículo
                                </button>
                            </div>
                           </div>
                           <div class="table-responsive">
                              <table id="dt-select" class="table table-striped table-bordered">
                                 <thead>
                                  <tr>
                                    <th>Editar</th>
                                    <th>Descripción de Artículo</th>
                                    <th>Categoria</th>
                                    <th>Vía</th>
                                    <th>Presentación</th>
                                    <th>Foto</th>
                                    <th>Ficha</th>
                                    <th>Estado</th>
                                  </tr>
                                 </thead>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>    
              <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editarModalLabel"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="formRegistrar" method="post" action="" autocomplete="off" enctype="multipart/form-data">
                      <div class="modal-body">
                        <input type="hidden" name="idarticulo" id ="idarticulo" >
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group row">
                                  <label class="modal-label col-sm-5 col-form-label py-10">Código SIGA</label>
                                  <div class="col-sm-7">
                                    <div class="form-group">
                                      <div>
                                        <input type="text" class="form-control" name="siga" id="siga" />
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group row">
                                  <label class="modal-label col-sm-5 col-form-label py-10">Nombre / Descripción</label>
                                  <div class="col-sm-7">
                                    <div class="form-group">
                                      <div>
                                        <input type="text" class="form-control" name="nombre" id="nombre" />
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                              <div class="form-group row">
                              <label class="modal-label col-sm-5 col-form-label py-10">Categoría</label>
                                <div class="col-sm-7">
                                  <select class="form-control" name="categoria" id="categoria">
                                    <option value="">-- SELECCIONE --</option>
                                    <?php foreach($listaCategoria as $row): ?>
                                    <option value="<?=$row->id?>"><?=$row->descripcion?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                              <div class="form-group row">
                              <label class="modal-label col-sm-5 col-form-label py-10">Vía de Administración</label>
                                <div class="col-sm-7">
                                  <select class="form-control" name="administracion" id="administracion">
                                    <option value="">-- SELECCIONE --</option>
                                    <?php foreach($listaViaAdministracion as $row): ?>
                                    <option value="<?=$row->id?>"><?=$row->descripcion?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                              <div class="form-group row">
                              <label class="modal-label col-sm-5 col-form-label py-10">Presentación</label>
                                <div class="col-sm-7">
                                  <select class="form-control" name="presentacion" id="presentacion">
                                    <option value="">-- SELECCIONE --</option>
                                  </select>
                                </div>
                              </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                              <div class="form-group row">
                              <label class="modal-label col-sm-5 col-form-label py-10">Medida</label>
                                <div class="col-sm-7">
                                  <select class="form-control" name="medida" id="medida">
                                    <option value="">-- SELECCIONE --</option>
                                    <?php foreach($listaMedida as $row): ?>
                                    <option value="<?=$row->id?>"><?=$row->descripcion?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group row">
                                  <label class="modal-label col-sm-5 col-form-label py-10">Cantidad Mínima</label>
                                  <div class="col-sm-7">
                                    <div class="form-group">
                                      <div>
                                        <input type="text" class="form-control" name="cantmin" id="cantmin" />
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group row">
                                  <label class="modal-label col-sm-5 col-form-label py-10">Cantidad Máxima</label>
                                  <div class="col-sm-7">
                                    <div class="form-group">
                                      <div>
                                        <input type="text" class="form-control" name="cantmax" id="cantmax" />
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group row">
                                  <label class="modal-label col-sm-5 col-form-label py-10">% de Verificación Stock</label>
                                  <div class="col-sm-7">
                                    <div class="form-group">
                                      <div>
                                        <input type="text" class="form-control" name="porcstock" id="porcstock" />
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group row">
                                  <label class="modal-label col-sm-5 col-form-label py-10">Ficha Técnica</label>
                                  <div class="col-sm-7">
                                    <div class="input-group col-sm-12">
                                      <input type="file" name="ficha" id="ficha" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                                      <label for="ficha"><i class="fa fa-upload" aria-hidden="true"></i> <span class="custom-file">Escoger Ficha &hellip;</span></label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="checkbox checkbox-primary">
                                  <input id="estado" type="checkbox" name="estado" checked>
                                  <label for="estado">
                                  Artículo Activo
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                          <div class="form-group row">
                            <div id='product-tumb' class="img_content">
                              <img class="img__form-farmacia" id="imagen" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="/>
                            </div>
                            <br>
                            <div class="col-sm-12">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="input-group col-sm-12">
                                    <input type="file" name="file" id="file" class="inputfile inputfile-1" aria-describedby="inputGroupFileAddon01" />
                                    <label for="file"><i class="fa fa-upload" aria-hidden="true"></i> <span class="custom-file-img">Escoger Imagen&hellip;</span></label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </div>
                          </div>
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
              <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <h4 class="modal-title" id="myModalLabel">Foto de Artículo</h4>
                    </div>
                    <div class="modal-body">
                      <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
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
        var lista = JSON.parse('<?=$listaArticulos?>');
      </script>
      <script src="<?=base_url()?>public/js/farmacia/articulos.js?v=<?=date(" his")?>"></script>
   </body>
</html>