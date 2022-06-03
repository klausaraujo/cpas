<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title><?=TITULO_PRINCIPAL?></title>
   <meta name="author" content="<?=AUTOR?>">

   <!-- Favicon -->
   <link rel="shortcut icon" href="<?=base_url()?>public/images/favicon.jpg">
   <link rel="icon" href="<?=base_url()?>public/images/favicon.jpg" type="image/x-icon">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="<?=base_url()?>public/template/css/bootstrap.min.css">
   <!-- Typography CSS -->
   <link rel="stylesheet" href="<?=base_url()?>public/template/css/typography.css">
   <!-- Style CSS -->
   <link rel="stylesheet" href="<?=base_url()?>public/template/css/style.css">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="<?=base_url()?>public/template/css/responsive.css">


   <!-- Data table CSS -->
   <!-- <link href="<?=base_url()?>public/css/datatables.min.css" rel="stylesheet" type="text/css"> -->
   <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
   <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet"
      type="text/css">

   <link rel="stylesheet" href="<?=base_url()?>public/css/brigadistas/maincomisiones.css" />

   <!-- Data table CSS -->
   <link href="<?=base_url()?>public/css/datatables.min.css" rel="stylesheet" type="text/css">

</head>
<?php
    $months = array(
        array("id"=>1,"name"=>"Enero"),
        array("id"=>2,"name"=>"Febrero"),
        array("id"=>3,"name"=>"Marzo"),
        array("id"=>4,"name"=>"Abril"),
        array("id"=>5,"name"=>"Mayo"),
        array("id"=>6,"name"=>"Junio"),
        array("id"=>7,"name"=>"Julio"),
        array("id"=>8,"name"=>"Agosto"),
        array("id"=>9,"name"=>"Septiembre"),
        array("id"=>10,"name"=>"Octubre"),
        array("id"=>11,"name"=>"Noviembre"),
        array("id"=>12,"name"=>"Diciembre")
    );
?>

<body>
   <!-- loader Start -->
   <div id="loading">
      <div id="loading-center">
      </div>
   </div>
   <!-- loader END -->
   <!-- Wrapper Start -->
   <div class="wrapper">

      <!-- Sidebar  -->
      <?php $this->load->view("inc/nav-template"); ?>


      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <!-- TOP Nav Bar -->
         <?php $this->load->view("inc/nav-top-template"); ?>
         <!-- TOP Nav Bar END -->
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  <?php //echo "<pre>"; echo $lista; echo '<br>'.$pacientes;//echo "<pre>"; echo var_dump($lista); ?>
               </div>
            </div>

            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-5 row m-0 p-0">
                     <div class="col-sm-12">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body">
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-7">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xl-12 col-md-12">
                     <div class="card m-b-30 pb-35">
                        <div class="card-body">
                           <h4 class="mt-0 m-b-15 header-title">LISTADO DOCUMENTOS TRAMITADOS</h4>
                           <br>
                           <div class="form-group row">
                              <div class="col-sm-12 col-md-5 col-md-offset-5 pa-10">
                                 <button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal"
                                    id="btnRegistrarComi">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                    Registrar Nuevo Trámite
                                 </button>
                              </div>
                           </div>
                           <div class="table-responsive">
                              <table class="tablaRegTra table table-hover mb-0">
                                 <thead>
                                    <tr>
                                       <th>Acciones</th>
                                       <th>ID</th>
                                       <th>AÑO</th>
                                       <th>EXPEDIENTE</th>
                                       <th>PROCEDENCIA</th>
                                       <th>FEC. RECEPCIÓN</th>
                                       <th>PLAZO</th>
                                       <th>SITUACIÓN</th>
                                       <th>ESTADO</th>
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
               </div>

               <div class="modal fade modal-fullscreen" id="editarModal" tabindex="-1" role="dialog"
                  aria-labelledby="editarModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <span class="modal-title" id="editarModalLabel"></span>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>

                        <form id="formRegistrar" method="post" action="" autocomplete="off"
                           enctype="multipart/form-data">
                           <div class="modal-body">
                              <input type="hidden" name="idregistro" id="idregistro">
                              <div class="alert alert-warning ingresos__alert" role="alert" hidden>
                                 <span class="alert__span"></span>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="row">
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-3 col-form-label py-10">Procedencia</label>
                                       <div class="col-sm-7">
                                          <select class="form-control" name="procedencia" id="procedencia">
                                             <option value="">-- Seleccione --</option>
                                             <?php foreach($listaprocedencia as $row): ?>
                                             <option value="<?=$row->idprocedencia?>"><?=$row->procedencia?></option>
                                             <?php endforeach; ?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-3 col-form-label py-10">N° Expediente</label>
                                       <div class="col-sm-7">
                                          <input type="text" class="form-control" name="expediente" id="expediente" />
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-3 col-form-label py-10">Fecha de Recepción</label>
                                       <div class="col-sm-6">
                                          <div class="form-group">
                                             <div class='input-group'>
                                                <input type="date" class="form-control" name="fecha_recepcion"
                                                   id="fecha_recepcion" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-sm-12">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Observaciones</label>
                                       <div class="col-sm-8">
                                          <input type="text" class="form-control" name="observaciones" id="observaciones" />
                                       </div>
                                    </div>
                                 </div>
                                 <!--
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Adjuntar PDF</label>
                                       <div class="col-sm-7">
                                          <input type="file" name="ficha" id="ficha" class="inputfile inputfile-1"
                                             data-multiple-caption="{count} files selected" multiple />
                                          <label for="ficha"><i class="fa fa-upload" aria-hidden="true"></i> <span
                                                class="custom-file">Escoger Archivo &hellip;</span></label>
                                       </div>
                                    </div>
                                 </div>-->
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

            </div>
         </div>
         <BR>
         <!-- Footer -->
         <?php $this->load->view("inc/footer-template"); ?>
         <script src="<?=base_url()?>public/js/moment.min.js"></script>
         <script src="<?=base_url()?>public/js/locale.es.js"></script>
         <!-- Footer END -->
      </div>
   </div>
   </div>
   <!-- Wrapper END -->
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="<?=base_url()?>public/template/js/jquery.min.js"></script>
   <script src="<?=base_url()?>public/template/js/popper.min.js"></script>
   <script src="<?=base_url()?>public/template/js/bootstrap.min.js"></script>
   <!-- Appear JavaScript -->
   <script src="<?=base_url()?>public/template/js/jquery.appear.js"></script>
   <!-- Countdown JavaScript -->
   <script src="<?=base_url()?>public/template/js/countdown.min.js"></script>
   <!-- Counterup JavaScript -->
   <script src="<?=base_url()?>public/template/js/waypoints.min.js"></script>
   <script src="<?=base_url()?>public/template/js/jquery.counterup.min.js"></script>
   <!-- Wow JavaScript -->
   <script src="<?=base_url()?>public/template/js/wow.min.js"></script>
   <!-- Apexcharts JavaScript -->
   <script src="<?=base_url()?>public/template/js/apexcharts.js"></script>
   <!-- Slick JavaScript -->
   <script src="<?=base_url()?>public/template/js/slick.min.js"></script>
   <!-- Select2 JavaScript -->
   <script src="<?=base_url()?>public/template/js/select2.min.js"></script>
   <!-- Owl Carousel JavaScript -->
   <script src="<?=base_url()?>public/template/js/owl.carousel.min.js"></script>
   <!-- Magnific Popup JavaScript -->
   <script src="<?=base_url()?>public/template/js/jquery.magnific-popup.min.js"></script>
   <!-- Smooth Scrollbar JavaScript -->
   <script src="<?=base_url()?>public/template/js/smooth-scrollbar.js"></script>
   <!-- lottie JavaScript -->
   <script src="<?=base_url()?>public/template/js/lottie.js"></script>
   <!-- Chart Custom JavaScript -->
   <script src="<?=base_url()?>public/template/js/chart-custom.js"></script>
   <!-- Custom JavaScript -->
   <script src="<?=base_url()?>public/template/js/custom.js"></script>
   <script src="<?=base_url()?>public/template/js/chart.min.js"></script>

   <!-- Data table JavaScript -->
   <script src="<?=base_url()?>public/js/datatables.min.js"></script>
   <!-- Data table JavaScript -->
   <!-- <script src="<?=base_url()?>public/js/datatables.min.js"></script>                                     -->
   <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js "></script>
   <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js "></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js "></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script>
   <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js "></script>


   <?php $this->load->view("inc/resource-template");?>
   <script>
      //const URI_MAP = "<?=base_url()?>";
      const canDelete = "1";
      const canEdit = "1";
      const canIdioma = "1";
      const canTracking = "1";
      const canHistory = "1";
      var URI = "<?=base_url()?>";
      const lista = <?= $lista ?>;

   </script>
   <script src="<?=base_url()?>public/js/tramite/main.js?v=<?=date("his")?>"></script>
</body>

</html>