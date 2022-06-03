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
      <?php $titulo = "Lista General de Items con Registro de Subcomponentes Internos"; ?>
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
                           <div class="table-responsive">
                              <table id="tableComponentes" class="table table-striped table-bordered">
                                 <thead>
                                  <tr>
                                    <th>Editar</th>
                                    <th>Lista</th>
                                    <th>Descripción del Artículo Master</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Código Inventario</th>
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
            <?php $this->load->view("inc/footer-template");?>
            <script src="<?=base_url()?>public/js/moment.min.js"></script>
            <script src="<?=base_url()?>public/js/locale.es.js"></script>
         </div>
      </div>
      <div class="modal fade" id="tableArticuloModal" tabindex="-1" role="dialog" aria-labelledby="tableArticuloLabel" aria-hidden="false" style="z-index: 1600;">
        <div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="registrarTableroModalLabel">Listar Componentes</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form id="formRegistrar" method="post" action="" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="idarticuloregistro" id ="idarticuloregistro" >
            <div class="modal-body">
              <table class="tableListaComponentes table tableSelect table-striped table-bordered table-sm table-responsive" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Descripción del Articulo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Almacén</th>
                    <th>Código de Bien</th>
                    <th>Código Patrimonial de Componente</th>
                    <th>Condición</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
          </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="tableComponenteModal" tabindex="-1" role="dialog" aria-labelledby="tableArticuloLabel" aria-hidden="false" style="z-index: 1600;">
        <div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="registrarTableroModalLabel">Agregar Componente</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <table class="tableSinComponentes table table-striped table-bordered table-sm" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Descripción del Articulo</th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>Almacén</th>
                  <th>Código de Bien</th>
                  <th>Código Patrimonial de Componente</th>
                  <th>Condición</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view("inc/resource-template");?>
      <script>
        var URI_MAP = "<?=base_url()?>";
        var lista = JSON.parse('<?=$lista?>');
        console.log(lista)
      </script>
      <script src="<?=base_url()?>public/js/inventarios/componentes.js?v=<?=date(" his")?>"></script>
   </body>
</html>
