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
      $titulo = "Reporte de Ejecución de Acciones Operativas por Unidades";
      ?>
      <link rel="stylesheet" href="<?=base_url()?>public/css/tablero/enlaceReporteNuevo.css?v=<?=date(" s")?>" />
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
                           <form id="formRegistrarEnlace" action="" method="POST">
                              <div class="form-group row">
                                 <label class="control-label col-sm-5 align-self-center mb-0">Selecionar Año de Ejecución</label>
                                 <div class="col-sm-7">
                                    <select class="form-control" id="Anio" name="Anio">
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
                              <div class="form-group row">
                                 <div class="control-label col-sm-5 align-self-center mb-0"><label>Seleccionar Unidad Operativa y/o Área</label></div>
                                 <div class="col-sm-7">
                                    <select class="form-control" id="Codigo_Area" name="Codigo_Area" style="font-size: 12px;"
                                       required>
                                       <option value="">[ -- Seleccione -- ]</option>
                                       <?php foreach($listaAreasByUser->result() as $row): ?>
                                       <option value="<?=$row->Codigo_Area?>">
                                       <?=$row->Nombre_Area?>
                                       </option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row" id="reportContent">
               </div>
            </div>                 
            <?php $this->load->view("inc/footer-template");?>
         </div>
      </div>                      
      <script src="<?=base_url()?>public/template/js/jquery.min.js"></script>
      <script src="<?=base_url()?>public/template/js/popper.min.js"></script>
      <script src="<?=base_url()?>public/template/js/bootstrap.min.js"></script>
      <script src="<?=base_url()?>public/template/js/jquery.appear.js"></script>
      <script src="<?=base_url()?>public/template/js/countdown.min.js"></script>
      <script src="<?=base_url()?>public/template/js/waypoints.min.js"></script>
      <script src="<?=base_url()?>public/template/js/jquery.counterup.min.js"></script>
      <script src="<?=base_url()?>public/template/js/wow.min.js"></script>
      <script src="<?=base_url()?>public/template/js/apexcharts.js"></script>
      <script src="<?=base_url()?>public/template/js/slick.min.js"></script>
      <script src="<?=base_url()?>public/template/js/select2.min.js"></script>
      <script src="<?=base_url()?>public/template/js/owl.carousel.min.js"></script>
      <script src="<?=base_url()?>public/template/js/jquery.magnific-popup.min.js"></script>
      <script src="<?=base_url()?>public/template/js/smooth-scrollbar.js"></script>
      <script src="<?=base_url()?>public/template/js/lottie.js"></script>
      <script src="<?=base_url()?>public/template/js/chart-custom.js"></script>
      <script src="<?=base_url()?>public/template/js/custom.js"></script>
      <script src="<?=base_url()?>public/js/echarts-en.min.js"></script>
      <?php $this->load->view("inc/resource-template");?>
      <script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
      <script src="<?=base_url()?>public/js/tablero/enlaceReporteNuevo.js?v=<?=date(" s")?>"></script>
      <script>
         enlazar("<?=base_url()?>");    
      </script>
   </body>
</html>