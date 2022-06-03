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
      <link rel="stylesheet" href="<?=base_url()?>public/css/inventario/mapa.css" />
      <link rel="stylesheet" href="<?=base_url()?>public/css/inventario/main.css" />

      <?php $titulo = "Mapa General de Artículos Registrados"; ?>
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
               <div class="row row-eq-height">

                  <div class="col-md-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title"><?=$titulo?></h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                             <div class="table-responsive">
                              <table class="tableMap table table-bordered table-hover table-responsive" cellspacing="0" width="100%" hidden>
                                <thead>
                                  <tr>
                                    <th>ID Operación</th>
                                    <th>ID Inventario</th>
                                    <th>ID Artículo</th>
                                    <th>SIGA</th>
                                    <th>Descripción</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Serie</th>
                                    <th>Clasificación</th>
                                    <th>Código de Bien</th>
                                    <th>Código Componente</th>
                                    <th>SBN</th>
                                    <th>Clasificador</th>
                                    <th>Condición</th>
                                    <th>Ubigeo</th>
                                    <th>Coordenadas</th>
                                    <th>Código departamento</th>
                                    <th>Región</th>
                                    <th>Código provincia</th>
                                    <th>Provincia</th>
                                    <th>Código distrito</th>
                                    <th>Distrito</th>
                                  </tr>
                                </thead>
                              </table>
                            </div>
                           </div>
                        </div>
                        <div class="iq-card-body card__map">
                          <div id="divMap" class="maps__content"></div>
                          </div>
                     </div>
                   </div>
               </div>
               <div class="modal fade modal-fullscreen" id="modalMapa" tabindex="-1" role="dialog"
                  aria-labelledby="modalMapaLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <span class="modal-title" id="modalMapaLabel"></span>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                           <div class="modal-body">
                              <div class="alert alert-warning ingresos__alert" role="alert" hidden>
                                 <span class="alert__span"></span>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="row">
                                 <h2 class="text-divider"><span>Tabla de artículos registrados</span></h2>
                                 <div class="table-responsive main-table">
                                    <table class="tableRegistroMap table table-bordered" cellspacing="0" width="100%">
                                       <thead>
                                          <tr>
                                            <th>ID Operación</th>
                                            <th>ID Inventario</th>
                                            <th>ID Artículo</th>
                                            <th>SIGA</th>
                                            <th>Descripción</th>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>Serie</th>
                                            <th>Clasificación</th>
                                            <th>Código de Bien</th>
                                            <th>Código Componente</th>
                                            <th>SBN</th>
                                            <th>Clasificador</th>
                                            <th>Condición</th>
                                            <th>Ubigeo</th>
                                            <th>Coordenadas</th>
                                            <th>Código departamento</th>
                                            <th>Región</th>
                                            <th>Código provincia</th>
                                            <th>Provincia</th>
                                            <th>Código distrito</th>
                                            <th>Distrito</th>
                                          </tr>
                                       </thead>
                                    </table>
                                 </div>
                              </div>
                              <hr />
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
      <script src="https://maps.googleapis.com/maps/api/js?key=<?=getenv('MAP_KEY')?>&libraries=drawing"></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_01.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_02.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_03.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_04.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_05.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_06.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_07.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_08.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_09.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_10.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_11.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_12.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_13.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_14.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_15.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_16.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_17.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_18.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_19.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_20.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_21.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_22.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_23.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_24.js'></script>
      <script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_25.js'></script>
      <script type="text/javascript" src="<?=base_url()?>public/map/djperu_ind.js"></script>
      <script>
        const URI_MAP = "<?=base_url()?>";
      </script>
      <script src="<?=base_url()?>public/js/inventarios/mapa.js?v=<?=date("his")?>"></script>
   </body>
</html>
