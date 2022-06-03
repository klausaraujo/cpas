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
      <?php $titulo = "Módulo de Gestión Logística y de Farmacia"; ?>
      <link rel="stylesheet" href="<?=base_url()?>public/css/farmacia/main.css" />
      <link rel="stylesheet" href="<?=base_url()?>public/css/farmacia/modal.css" />
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
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title"><?=$titulo?></h4>
                              </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="row">
                              <div class="row col-sm-12">
                                  <div class="form-group has-feedback has-search col-sm-6">
                                    <input type="text" class="form-control" placeholder="Buscar" id="buscarArticulo">
                                  </div>
                                  <div class="col-sm-3">
                                    <div class="form-group row">
                                      <label class="col-sm-4 col-form-label py-10">Artículos por Clasificación</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="" value="<?=($totalCategoria >= 0)? $totalCategoria : $total?>" disabled>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-3">
                                    <div class="form-group row">
                                      <label class="col-sm-4 col-form-label py-10">Artículos Totales</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="" value="<?=$total?>" disabled>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <form id="formCategoria" action="<?=base_url()?>farmacia" method="POST">
                                      <div class="form-group row">
                                        <label class="col-sm-4 col-form-label py-10">Filtrar Clasificación</label>
                                        <div class="col-sm-8">
                                          <select class="form-control" name="idCategoria" id="idCategoria">
                                            <option value="">-- TODOS --</option>
                                            <?php foreach($listaCategoria as $row): ?>
                                            <option value="<?=$row->id?>" <?=($row->id==$idCategoria)?"selected":""?>><?=$row->descripcion?></option>
                                            <?php endforeach; ?>
                                          </select>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="table-responsive">
                                      <table class="tableArticulos table table-bordered table-hover" cellspacing="0" width="100%" hidden>
                                        <thead>
                                          <tr>
                                            <th>Articulo Registro</th>
                                            <th>Articulo</th>
                                            <th>Via</th>
                                            <th>Presentación</th>
                                            <th>Categoría</th>
                                            <th>Cantidad</th>
                                            <th>Estado</th>
                                            <th>Imagen</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach($listaArticulos as $row): ?>
                                            <tr>
                                              <td align="center"><?=$row->IdArticulo?></td>
                                              <td align="center"><?=$row->Articulo?></td>
                                              <td align="center"><?=$row->Marca?></td>
                                              <td align="center"><?=$row->Modelo?></td>
                                              <td align="center"><?=$row->Clasificacion?></td>
                                              <td align="center"><?=$row->Cantidad?></td>
                                              <td align="center"><?=$row->Estado?></td>
                                              <td align="center"><?=$row->imagen?></td>
                                            </tr>
                                          <?php endforeach; ?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="listaStock" class="row col-sm-12">
                    <?php foreach($listaArticulos as $row): ?>
                      <div class="col-sm-6 col-md-3">
                       <div class="iq-card">
                          <div class="iq-card-body text-center">
                             <div class="doc-profile">
                                <img class="rounded-circle img-fluid avatar-80" src="<?=base_url()?>public/farmacia/fotos/<?=$row->imagen?>" alt="picture">
                             </div>
                             <div class="iq-doc-info mt-3">
                                <h4 class="principal__span"><?=$row->Articulo?></h4>
                                <p class="mb-0" >STOCK (<?=$row->Cantidad?>)</p>
                             </div>
                             <div class="iq-doc-description mt-2">
                             </div>
                             <a data-id="<?=$row->IdArticulo?>" class="btn btn-primary product__stock"><i class="fa fa-list"></i> Ver Detalle </a>
                             <?php if($row->ficha){ ?>
                              <a data-src="<?=$row->ficha?>" class="btn product__file"><i class="fa fa-file-pdf-o"></i> Ficha</a>
                             <?php } ?>
                          </div>
                       </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
               </div>
            </div>
            <?php $this->load->view("inc/footer-template");?>
            <script src="<?=base_url()?>public/js/moment.min.js"></script>
            <script src="<?=base_url()?>public/js/locale.es.js"></script>
         </div>
      </div>
      <div class="modal fade" id="tableDetalleModal" tabindex="-1" role="dialog" aria-labelledby="tableDetalleLabel" aria-hidden="false" style="z-index: 1600;">
        <div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="registrarTableroModalLabel">Stock Actual</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <div class="modal-body">
            <div class="table-responsive">
              <table class="tableDetalle table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>SIGA</th>
                    <th>Artículo</th>
                    <th>Categoría</th>
                    <th>Lote</th>
                    <th>Expira</th>
                    <th>Stock</th>
                    <th>Ubicación</th>
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
      <?php $this->load->view("inc/resource-template");?>
      <script>
        var URI_MAP = "<?=base_url()?>";
      </script>
      <script src="<?=base_url()?>public/js/farmacia/principal.js?v=<?=date(" his")?>"></script>
   </body>
</html>
