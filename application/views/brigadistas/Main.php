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
   <link href="<?=base_url()?>public/css/datatables.min.css" rel="stylesheet" type="text/css">
</head>
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
                              <div class="patient-steps">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div class="col-md-6">
                                       <h5 class="card-title text-primary">Total Nacional</h5>
                                       <div class="data-block">
                                          <p class="mb-0">Brigadistas</p>
                                          <h5>45</h5>
                                       </div>
                                       <div class="data-block mt-3">
                                          <p class="mb-0">E.M.T.</p>
                                          <h5>55</h5>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="progress-round patient-progress mx-auto" data-value="100">
                                          <span class="progress-left">
                                             <span class="progress-bar border-secondary"></span>
                                          </span>
                                          <span class="progress-right">
                                             <span class="progress-bar border-secondary"></span>
                                          </span>
                                          <div
                                             class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center text-center">
                                             <div class="h4 mb-0 text-primary">100<br> <span
                                                   class="font-size-14 text-success">Total</span></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <ul class="patient-role list-inline d-flex align-items-center p-0 mt-4 mb-0">
                                    <li class="text-left">
                                       <h6 class="text-primary">Médicos</h6>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar">
                                             <span class="bg-primary" data-percent="70"></span>
                                          </div>
                                          <h6 class="text-primary">10 (10%)</h6>
                                       </div>
                                    </li>
                                    <li class="text-left">
                                       <h6 class="text-primary">Enfermeros</h6>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar">
                                             <span class="bg-dark" data-percent="70"></span>
                                          </div>
                                          <h6 class="text-primary">20 (20%)</h6>
                                       </div>
                                    </li>
                                    <li class="text-left">
                                       <h6 class="text-primary">Técnicos</h6>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar">
                                             <span class="bg-success" data-percent="70"></span>
                                          </div>
                                          <h6 class="text-primary">30 (30%)</h6>
                                       </div>
                                    </li>
                                    <li class="text-left">
                                       <h6 class="text-primary">Logísticos</h6>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar">
                                             <span class="bg-info" data-percent="70"></span>
                                          </div>
                                          <h6 class="text-info">40 (40%)</h6>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                              <hr>
                              <div class="patient-steps2">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div class="col-md-6">
                                       <h5 class="card-title text-primary">Personal en Lima</h5>
                                       <div class="data-block">
                                          <p class="mb-0">Brigadistas</p>
                                          <h5>20</h5>
                                       </div>
                                       <div class="data-block mt-3">
                                          <p class="mb-0">E.M.T.</p>
                                          <h5>35</h5>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="progress-round patient-progress mx-auto" data-value="55">
                                          <span class="progress-left">
                                             <span class="progress-bar border-secondary"></span>
                                          </span>
                                          <span class="progress-right">
                                             <span class="progress-bar border-secondary"></span>
                                          </span>
                                          <div
                                             class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center text-center">
                                             <div class="h4 mb-0 text-dark">55<br> <span
                                                   class="font-size-14 text-success">Lima</span></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <ul class="patient-role list-inline d-flex align-items-center p-0 mt-4 mb-0">
                                    <li class="text-left">
                                       <h6 class="text-primary">Médicos</h6>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar">
                                             <span class="bg-primary" data-percent="70"></span>
                                          </div>
                                          <h6 class="text-primary">5 (10%)</h6>
                                       </div>
                                    </li>
                                    <li class="text-left">
                                       <h6 class="text-primary">Enfermeros</h6>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar">
                                             <span class="bg-dark" data-percent="70"></span>
                                          </div>
                                          <h6 class="text-primary">10 (20%)</h6>
                                       </div>
                                    </li>
                                    <li class="text-left">
                                       <h6 class="text-primary">Técnicos</h6>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar">
                                             <span class="bg-success" data-percent="70"></span>
                                          </div>
                                          <h6 class="text-primary">15 (30%)</h6>
                                       </div>
                                    </li>
                                    <li class="text-left">
                                       <h6 class="text-primary">Logísticos</h6>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar">
                                             <span class="bg-info" data-percent="70"></span>
                                          </div>
                                          <h6 class="text-primary">25 (40%)</h6>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                              <hr>
                              <div class="patient-steps3">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div class="col-md-6">
                                       <h5 class="card-title text-primary">Personal en Regiones</h5>
                                       <div class="data-block">
                                          <p class="mb-0">Brigadistas</p>
                                          <h5>25</h5>
                                       </div>
                                       <div class="data-block mt-3">
                                          <p class="mb-0">E.M.T.</p>
                                          <h5>20</h5>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="progress-round patient-progress mx-auto" data-value="45">
                                          <span class="progress-left">
                                             <span class="progress-bar border-secondary"></span>
                                          </span>
                                          <span class="progress-right">
                                             <span class="progress-bar border-secondary"></span>
                                          </span>
                                          <div
                                             class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center text-center">
                                             <div class="h4 mb-0 text-info">45<br> <span
                                                   class="font-size-14 text-success">Regiones</span></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <ul class="patient-role list-inline d-flex align-items-center p-0 mt-4 mb-0">
                                    <li class="text-left">
                                       <h6 class="text-primary">Médicos</h6>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar">
                                             <span class="bg-primary" data-percent="70"></span>
                                          </div>
                                          <h6 class="text-primary">5 (5%)</h6>
                                       </div>
                                    </li>
                                    <li class="text-left">
                                       <h6 class="text-primary">Enfermeros</h6>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar">
                                             <span class="bg-dark" data-percent="70"></span>
                                          </div>
                                          <h6 class="text-primary">10 (15%)</h6>
                                       </div>
                                    </li>
                                    <li class="text-left">
                                       <h6 class="text-primary">Técnicos</h6>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar">
                                             <span class="bg-success" data-percent="70"></span>
                                          </div>
                                          <h6 class="text-primary">15 (40%)</h6>
                                       </div>
                                    </li>
                                    <li class="text-left">
                                       <h6 class="text-primary">Logísticos</h6>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar">
                                             <span class="bg-info" data-percent="70"></span>
                                          </div>
                                          <h6 class="text-primary">15 (40%)</h6>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-7">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body pb-0">
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="iq-card">
                                    <div class="iq-header-title">
                                       <h4 class="card-title text-primary">Resumen de Registros</h4>
                                    </div>
                                    <div class="iq-card-body pl-0 pr-0 pb-0">
                                       <div class="row">
                                          <div class="col-md-4">
                                             <div class="training-block d-flex align-items-center">
                                                <div class="rounded-circle iq-card-icon iq-bg-primary">
                                                   <img src="<?=base_url()?>public/template/images/page-img/001.png"
                                                      class="img-fluid" alt="icon">
                                                </div>
                                                <div class="ml-3">
                                                   <h5 class="">Total</h5>
                                                   <p class="mb-0"> <?php echo $totalResumenRegistros->total1; ?></p>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <div class="training-block d-flex align-items-center">
                                                <div class="rounded-circle iq-card-icon iq-bg-primary">
                                                   <img src="<?=base_url()?>public/template/images/page-img/002.png"
                                                      class="img-fluid" alt="icon">
                                                </div>
                                                <div class="ml-3">
                                                   <h5 class="">En Misión</h5>
                                                   <p class="mb-0"><?php echo $totalResumenRegistros->total2; ?></p>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <div class="training-block d-flex align-items-center">
                                                <div class="rounded-circle iq-card-icon iq-bg-primary">
                                                   <img src="<?=base_url()?>public/template/images/page-img/003.png"
                                                      class="img-fluid" alt="icon">
                                                </div>
                                                <div class="ml-3">
                                                   <h5 class="">Disponibles</h5>
                                                   <p class="mb-0"><?php echo $totalResumenRegistros->total3; ?></p>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="iq-card">
                                    <hr>
                                    <div class="iq-card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title text-primary">Resumen de Desplazamiento de Brigadistas y
                                             E.M.T. Totales</h4>
                                       </div>
                                    </div>
                                    <div class="iq-card-body">
                                       <div id="apex-line-area"></div>
                                    </div>
                                    <ul
                                       class="doctoe-sedual d-flex align-items-center justify-content-between p-0 mt-4 mb-0">
                                       <li class="text-center">
                                          <h6 class="text-primary">Brigadistas <br> Movilizados</h6>
                                          <h3>12</h3>
                                       </li>
                                       <li class="text-center">
                                          <h6 class="text-primary">E.M.T. <br> Movilizados </h6>
                                          <h3>34</h3>
                                       </li>
                                       <li class="text-center">
                                          <h6 class="text-primary">Total <br> Movilizaciones </h6>
                                          <h3 class="text-warning">46</h3>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xl-12 col-md-12">
                  <div class="card m-b-30 pb-35">
                     <div class="card-body">
                        <h4 class="mt-0 m-b-15 header-title">LISTADO GENERAL DE RENARHED</h4>
                        <br>
                        <div class="table-responsive">
                           <table class="tablaRegied table table-hover mb-0">
                              <thead>
                                 <tr>
                                    <th>Acciones</th>
                                    <th>ID</th>
                                    <th>Apellidos y Nombres</th>
                                    <th>D.N.I./C.EXT.</th>
                                    <th>Género</th>
                                    <th>F. Nacimiento</th>
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
         </div>
         <?php $this->load->view("inc/footer-template"); ?>
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
   <script>
      $(document).ready(function () {
         console.log(lista);
         let table = $('.tablaRegied').DataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            data: lista,
            columns: [
               {
                  data: null,
                  render: function (data, type, row) {
                     const btnIdioma = `
                  <button class="btn btn-success btn-circle actionIdioma" title="Agregar más Detalles" type="button" style="margin-right: 5px;">
                     <i class="fa fa-user-plus" aria-hidden="true"></i>
                  </button>`;
                     const btnEdit = `
                  <button class="btn btn-warning btn-circle actionEdit" title="Editar Registro" type="button" style="margin-right: 5px;">
                     <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </button>`;
                     const btnDelete = `
                  <button class="btn btn-primary btn-circle actionDelete" title="Eliminar Registro" type="button style="margin-right: 5px;">
                     <i class="fa fa-times" aria-hidden="true"></i>
                  </button>`;
                     return `<div style="display: flex">
                           ${canIdioma ? btnIdioma : ''} 
                           ${canEdit ? btnEdit : ''} 
                           ${canDelete ? btnDelete : ''}
                           </div>`;
                  }
               },
               {
                  data: "idrenarhed"
               },
               {
                  data: "concatenado_nombre"
               },
               {
                  data: "numero_documento"
               },
               {
                  data: "sexo"
               },
               {
                  data: "fecha_nacimiento"
               },
               {
                  data: "Activo",
                  render: function (data, type, row, meta) {
                     return `<span class="badge ${data === 'Activo' ? 'badge-info' : 'badge-default'}">${data}</span>`
                  }
               },
            ],
            order: [],
            columnDefs: [],
            dom: 'Bfrtip',
            select: true,
            buttons: [{
               extend: 'copy',
               title: 'Lista General de Pacientes',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
            },
            {
               extend: 'csv',
               title: 'Lista General de Pacientes',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
            },
            {
               extend: 'excel',
               title: 'Lista General de Pacientes',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
            },
            {
               extend: 'pdf',
               title: 'Lista General de Pacientes',
               orientation: 'landscape',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
            },
            {
               extend: 'print',
               title: 'Lista General de Brigadistas',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
               customize: function (win) {
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
                  $(win.document.body).find('table')
                     .addClass('compact')
                     .css('font-size', 'inherit');
                  var css = '@page { size: landscape; }',
                     head = win.document.head || win.document.getElementsByTagName('head')[0],
                     style = win.document.createElement('style');
                  style.type = 'text/css';
                  style.media = 'print';
                  if (style.styleSheet) {
                     style.styleSheet.cssText = css;
                  }
                  else {
                     style.appendChild(win.document.createTextNode(css));
                  }
                  head.appendChild(style);
               }
            }],
            language:
            {
               search: "Buscar:",
               lengthMenu: "Mostrando _MENU_ registros por página",
               zeroRecords: "Sin registros",
               info: "Mostrando página  _PAGE_ de _PAGES_",
               infoEmpty: "No hay registros disponibles",
               infoFiltered: "(filrado de _MAX_ registros totales)",
               paginate: {
                  first: "Primero",
                  last: "Último",
                  next: "Siguiente",
                  previous: "Anterior"
               },
            }
        });
         $('.tablaRegied tbody').on('click', 'td .actionIdioma', function () {
            var data = table.row($(this).parents('tr')).data();
            post(URI + "brigadistas/formAdditional", { id: data.idrenarhed });
         });
         $('.tablaRegied tbody').on('click', 'td .actionEdit', function () {
            var data = table.row($(this).parents('tr')).data();
            post(URI + "brigadistas/formEdit", { id: data.idrenarhed });
         });
      });
      function post(path, params, method) {
         method = method || "post";
         var form = document.createElement("form");
         form.setAttribute("method", method);
         form.setAttribute("action", path);
         for (var key in params) {
            if (params.hasOwnProperty(key)) {
               var hiddenField = document.createElement("input");
               hiddenField.setAttribute("type", "hidden");
               hiddenField.setAttribute("name", key);
               hiddenField.setAttribute("value", params[key]);
               form.appendChild(hiddenField);
            }
         }
         document.body.appendChild(form);
         form.submit();
      }
   </script>
</body>
</html>