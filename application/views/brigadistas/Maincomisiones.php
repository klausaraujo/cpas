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
   <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
   <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet"
      type="text/css">
   <link rel="stylesheet" href="<?=base_url()?>public/css/brigadistas/maincomisiones.css" />
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
    <div id="loading">
      <div id="loading-center">
      </div>
   </div>
   <div class="wrapper">
      <?php $this->load->view("inc/nav-template"); ?>
      <div id="content-page" class="content-page">
         <?php $this->load->view("inc/nav-top-template"); ?>
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
                           <h4 class="mt-0 m-b-15 header-title">LISTADO GENERAL DE COMISIONES</h4>
                           <br>
                           <div class="form-group row">
                              <div class="col-sm-12 col-md-5 col-md-offset-5 pa-10">
                                 <button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal"
                                    id="btnRegistrarComi">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                    Registrar Nueva Comisión
                                 </button>
                              </div>
                           </div>
                           <div class="table-responsive">
                              <table class="tablaRegied table table-hover mb-0">
                                 <thead>
                                    <tr>
                                       <th>Acciones</th>
                                       <th>ID</th>
                                       <th>REGION</th>
                                       <th>TIPO</th>
                                       <th>INICIO</th>
                                       <th>FIN</th>
                                       <th>TIPO EVENTO</th>
                                       <th>EVENTO</th>
                                       <th>Estado</th>
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
                              <input type="hidden" name="idcomision" id="idcomision">
                              <input type="hidden" name="idEvento" id="idEvento">
                              <div class="alert alert-warning ingresos__alert" role="alert" hidden>
                                 <span class="alert__span"></span>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="row">
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Región</label>
                                       <div class="col-sm-7">
                                          <select class="form-control" name="region" id="region">
                                             <option value="">-- Seleccione --</option>
                                             <?php foreach($regiones as $row): ?>
                                             <option value="<?=$row->Codigo_Region?>"><?=$row->Nombre_Region?></option>
                                             <?php endforeach; ?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Tipo</label>
                                       <div class="col-sm-7">
                                          <select class="form-control" name="tipo" id="tipo">
                                             <option value="">-- Seleccione --</option>
                                             <option value="1">EMERGENCIAS</option>
                                             <option value="2">CONTINGENCIAS</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Tipo Evento</label>
                                       <div class="col-sm-7">
                                          <select class="form-control" name="tipoEvento" id="tipoEvento">
                                             <option value="">-- Seleccione --</option>
                                             <?php foreach($tipo as $row): ?>
                                             <option value="<?=$row->Evento_Tipo_Codigo?>"><?=$row->Evento_Tipo_Nombre?>
                                             </option>
                                             <?php endforeach; ?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Evento</label>
                                       <div class="col-sm-7">
                                          <select class="form-control" name="evento" id="evento">
                                             <option value="">-- Seleccione --</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Detalle Evento</label>
                                       <div class="col-sm-7">
                                          <select class="form-control" name="eventoDetalle" id="eventoDetalle">
                                             <option value="">-- Seleccione --</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">N° SIREED</label>
                                       <div class="col-sm-4">
                                          <input type="text" class="form-control" name="numeroEvento" id="numeroEvento"
                                             readonly="readonly" />
                                       </div>
                                       <div class="col-sm-3">
                                          <button type="button" class="btn btn-primary col-sm-12 btn-buscar"
                                             id="btnBuscarEvento">Buscar</button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Descripción de la
                                          Comisión</label>
                                       <div class="col-sm-9">
                                          <input type="text" class="form-control" name="descripcion" id="descripcion" />
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Fecha Inicio</label>
                                       <div class="col-sm-6">
                                          <div class="form-group">
                                             <div class='input-group'>
                                                <input type="date" class="form-control" name="fechaInicio"
                                                   id="fechaInicio" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Fecha Fin</label>
                                       <div class="col-sm-6">
                                          <div class="form-group">
                                             <div class='input-group'>
                                                <input type="date" class="form-control" name="fechaFin" id="fechaFin" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
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
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <button type="button" class="btn btn-primary col-sm-12 btn-buscarb">Agregar
                                          Brigadista</button>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <h2 class="text-divider"><span>Relación de Recursos Humanos Propuestos para la
                                       Misión</span></h2>
                                 <div class="table-responsive main-table">
                                    <table class="tablerrhhmision table table-bordered" cellspacing="0" width="100%">
                                       <thead>
                                          <tr>
                                             <th>ID</th>
                                             <th>Apellidos</th>
                                             <th>Nombres</th>
                                             <th>DNI</th>
                                             <th>Función</th>
                                             <th></th>
                                             <th></th>
                                          </tr>
                                       </thead>
                                    </table>
                                 </div>
                              </div>
                              <hr />
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <button type="submit" class="btn btn-primary">Guardar</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTablero">
                  <div class="modal-dialog" role="document">
                     <form action="<?=base_url()?>brigadistas/anucomisiones" method="POST">
                        <input type="hidden" name="idcomision" value="" readonly />
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
               <div class="modal fade" id="eventosModal" tabindex="-1" role="dialog" aria-labelledby="eventosModalLabel"
                  aria-hidden="true" style="z-index: 1600;">
                  <div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h4 class="modal-title" id="eventosModalLabel">Seleccionar Evento</h4>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           <div class="form-group row">
                              <label class="col-sm-12 col-form-label">Filtros</label>
                              <div class="col-sm-3">
                                 <select class="form-control" name="Anio_Ejecucion_Evento" id="Anio_Ejecucion_Evento">
                                    <?php foreach($listaAnioEjecucion->result() as $row): ?>
                                    <option value="<?=$row->Anio_Ejecucion?>"
                                       <?=($row->Anio_Ejecucion==date("Y"))?"selected":""?>><?=$row->Anio_Ejecucion?>
                                    </option>
                                    <?php endforeach; ?>
                                 </select>
                              </div>
                              <div class="col-sm-3">
                                 <select class="form-control" name="mes" id="mes">
                                    <?php foreach($months as $row): ?>
                                    <option value="<?=$row["id"]?>" <?=($row["id"]==date("m"))?"selected":""?>>
                                       <?=$row["name"]?></option>
                                    <?php endforeach; ?>
                                 </select>
                              </div>

                           </div>
                           <table class="tableEventos table table-striped table-bordered table-sm" width="100%">
                              <thead>
                                 <tr>
                                    <th class="text-center">N&deg;</th>
                                    <th>Evento Producido</th>
                                    <th>Fecha</th>
                                    <th>Ubicaci&oacute;n Evento(UBIGEO)</th>
                                    <th>Estado</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal fade" id="tableRHComiModal" tabindex="-1" role="dialog"
                  aria-labelledby="tableRHComiLabel" aria-hidden="false" style="z-index: 1600;">
                  <div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
                     <div class="modal-content">
                        <div class="modal-header">
                           <span class="modal-title" id="registrarTableroModalLabel">Seleccionar Renarhed</span>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <form id="formRRHHComiRegistrar">
                           <div class="modal-body">
                              <div class="col-sm-8">
                                 <div class="form-group row">
                                    <label class="modal-label col-sm-3 col-form-label py-10">Seleccionar Función</label>
                                    <div class="col-sm-5">
                                       <select class="form-control" name="idfuncion" id="idfuncion">
                                          <option value="">-- Seleccione --</option>
                                          <?php foreach($funcion as $row): ?>
                                          <option value="<?=$row->idfuncion?>"><?=$row->nombfuncion?></option>
                                          <?php endforeach; ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <table class="tableRHComi table table-striped table-bordered table-sm" cellspacing="0"
                                 width="100%">
                                 <thead>
                                    <tr>
                                       <th>ID</th>
                                       <th>Apellidos</th>
                                       <th>Nombres</th>
                                       <th>DNI</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                           </div>
                           <hr>
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
         <?php $this->load->view("inc/footer-template"); ?>
         <script src="<?=base_url()?>public/js/moment.min.js"></script>
         <script src="<?=base_url()?>public/js/locale.es.js"></script>
      </div>
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
   <script src="<?=base_url()?>public/template/js/chart.min.js"></script>
   <script src="<?=base_url()?>public/js/datatables.min.js"></script>
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
   <script src="<?=base_url()?>public/js/brigadistas/comisiones.js?v=<?=date("his")?>"></script>
</body>
</html>