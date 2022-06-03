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
      <link rel="stylesheet" href="<?=base_url()?>public/css/inventario/main.css" />
       <?php $titulo = "Lista General de Marcas Registradas"; ?>
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
                                  <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                  Registrar Nuevo Marca
                                </button>
                            </div>
                           </div>
                           <div class="table-responsive">
                              <table id="dt-select" class="table table-striped table-bordered">
                                 <thead>
                                  <tr>
                                    <th>Editar</th>
                                    <th>Descripción de marca</th>
                                    <th>Fecha de registro</th>
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
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editarModalLabel"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="formRegistrar">
                      <div class="modal-body">
                        <div class="col-xs-12">						
                          <div class="form-group row">
                            <label class="modal-label col-sm-5">Nombre / Descripción</label>
                            <div class="col-sm-7">
                              <div class="form-group">
                                <div>
                                  <input type="text" class="form-control" name="nombre" id="nombre" /> 
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12">					
                          <div class="form-group row">
                            <label class="modal-label col-sm-5">Fecha Registro</label>
                            <div class="col-sm-7">
                              <div class="form-group" id="error_fecha_registro">
                                <div class='input-group'>
                                  <input type="date" class="form-control" name="fecha_registro" id="fecha_registro" max="<?= date("Y-m-d") ?>" /> 
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12">
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="estado" name="estado">
                            <label class="form-check-label" for="estado">Marca Activa</label>
                          </div>
                        </div>            
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
        var listaMarcas = JSON.parse('<?=$listaMarcas?>');
      </script>
      <script src="<?=base_url()?>public/js/inventarios/marcas.js?v=<?=date(" his")?>"></script>
   </body>
</html>