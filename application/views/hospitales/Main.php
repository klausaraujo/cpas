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

<!-- Data table CSS -->
<!-- <link href="<?=base_url()?>public/css/datatables.min.css" rel="stylesheet" type="text/css"> -->
<link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">




      <!-- Typography CSS -->
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/responsive.css">
 

   </head>
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
                  <div class="col-sm-12 "> 
                     <br>
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title" >REPORTE ESTADÍSTICO DE ÍNDICES DE SOBREDEMANDA EN HOSPITALES DE LIMA (TOP 5)  </h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div id="chart"></div>
                        </div>
                     </div>
                  
                   
                  </div>
               </div>

               <div class="row">  


                  <div class="col-xl-12 col-md-12">
                     <div class="card m-b-30 pb-35">
                     <div class="card-body"> 
                        <h4 class="mt-0 m-b-15 header-title">LISTA DE REGISTROS EMITIDOS A LA FECHA</h4>
                        <br>
                        <div class="table-responsive">
                           <table class="tablaPaciente table table-hover mb-0">
                           <thead>
                              <tr>
                                 <th><center>Acciones Disponibles</center></th>
                                 <th><center>Hospital Priorizado o Evaluado (IPRESS)</center></th>
                                 <th><center>Región Evaluada</center></th>
                                 <th><center>Servicio Hospitalización</center></th>
                                 <th><center>Servicio Emergencia</center></th>
                                 <th><center>Críticos Adultos</center></th> 
                                 <th><center>Críticos Pediatricos</center></th> 
                                 <th><center>Fecha Reporte</center></th> 
                                 <th><center>Estado Actual</center></th>
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


            <!-- Footer -->
            <?php $this->load->view("inc/footer-template"); ?>
            <!-- Footer END -->
         </div>
      </div>
      <!-- Wrapper END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="<?=base_url()?>public/template/js/jquery.min.js"></script>
      <script src="<?=base_url()?>public/template/js/popper.min.js"></script>
      <script src="<?=base_url()?>public/template/js/bootstrap.min.js"></script>


<!-- Data table JavaScript -->
<!-- <script src="<?=base_url()?>public/js/datatables.min.js"></script>                                     -->
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js "></script> 
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js "></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js "></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script> 
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js "></script> 






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

      

<script> 
   const canDelete = "1";
    const canEdit = "1";
    const canTracking = "1";
    const canHistory = "1"; 
    var URI = "<?=base_url()?>"; 
    const lista = <?=$lista?>;  

    const data_grafico_object = <?= $data_grafico?>;
</script>

<script> 
  $(document).ready(function () { 
    
      let table = $('.tablaPaciente').DataTable({
         pageLength: 5,
         lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
         data: lista,
         //dom: '<"html5buttons"B>lTfgitp',
         columns: [
            {
            data: null,
               render: function (data, type, row) {
                  const btnEdit = `
                  <button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button" style="margin-right: 5px;">
                     <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </button>`;
                  const btnDelete = `
                  <button class="btn btn-primary btn-circle actionDelete" title="ELIMINAR" type="button">
                     <i class="fa fa-times" aria-hidden="true"></i>
                  </button>`;
                  return `<div style="display: flex">
                           ${canEdit ? btnEdit : ''} 
                           ${canDelete ? btnDelete : ''}
                           </div>`;
               }
            },
            {
               data: "IPRESS"
            },
            {
               data: "Region"
            },
            {
               data: "Hospitalizacion",
            },
            {
               data: "Emergencia"
            },
            {
               data: "Criticos"
            }, 
            {
               data: "Pediatricos"
            },
            {
               data: "Fecha"
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
         buttons: [
            {
               extend: 'copy',
               title: 'Lista General de Pacientes',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6,7,8] },
            },
            {
               extend: 'csv',
               title: 'Lista General de Pacientes',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6,7,8] },
            },
            {
               extend: 'excel',
               title: 'Lista General de Pacientes',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6,7,8] },
            },
            {
               extend: 'pdf',
               title: 'Lista General de Pacientes',
               orientation: 'landscape',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6,7,8] },
            },            
            {
               extend: 'print',
               title: 'Lista General de Pacientes',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6,7,8] },
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
            }

         ],
         language: 
         {
            search:         "Buscar:",
            lengthMenu: "Mostrando _MENU_ registros por página",
            zeroRecords: "Sin registros",
            info: "Mostrando página  _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(filrado de _MAX_ registros totales)",
            paginate: {
               first:      "Primero",
               last:       "Último",
               next:       "Siguiente",
               previous:   "Anterior"
            },
         }
         
      });

      $('.tablaPaciente tbody').on('click', 'td .actionEdit', function () {
      //   var data = table.row(this).data();
      var data = table.row($(this).parents('tr')).data();


         //console.log(data);
         post(URI + "hospitales/main/editarFicha", { id: data.ID });
         
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
 

   var data_grafico = data_grafico_object;
    //console.log(data_grafico);

   let hospital_names = [], serieData = {}, series = [];
    
   /**
    key:0, name: 'Hospital x'...
    */
   data_grafico.forEach((item) => { 
      hospital_names.push(item.IPRESS);
   })
 
    

   var options = {
      series: [
         {
            name: 'HOSPITALIZACIÓN',
            data: (function() {
               // generate an array of random data
               //query deberia de devolver solo los hosp
               //
                  var data = [];
                  data_grafico.forEach((item) => { 
                    // data.push(item.Hospitalizacion);
                     var st = item.Hospitalizacion.replace(',', "");
                     var ft = parseFloat(st);
                     //console.log('parse ' + ft);
                     data.push(ft);
                  })
                  //console.log(data);
                  return data;
            })()
         }, {
            name: 'EMERGENCIA',
            data: (function() {
               // generate an array of random data
               //query deberia de devolver solo los hosp
               //
                  var data = [];
                  data_grafico.forEach((item) => {
                     var st = item.Emergencia.replace(',', "");
                     var ft = parseFloat(st);
                    // console.log('parse ' + ft);
                     data.push(ft);
                  })
                  //console.log(data);
                  return data;
            })()
         }, {
            name: 'CRÍTICOS ADULTOS',
            data: (function() {
               // generate an array of random data
               //query deberia de devolver solo los hosp
               //
                  var data = [];
                  data_grafico.forEach((item) => { 
                     var st = item.Criticos.replace(',', "");
                     var ft = parseFloat(st);
                     //console.log('parse ' + ft);
                     data.push(ft);
                  })
                  return data;
            })()
         }, {
            name: 'CRÍTICOS PEDIÁTRICOS',
            data: (function() {
               // generate an array of random data
               //query deberia de devolver solo los hosp
               //
                  var data = [];
                  data_grafico.forEach((item) => { 
                     //data.push(item.Pediatricos);
                     //console.log('items ped ' + item);
                     var st =  item.Pedriatricos.replace(',', "");
                     var ft = parseFloat(st);
                     //console.log('parse ' + ft);
                     data.push(ft);
                  })
                  return data;
            })()
         }
      ],
         chart: {
         type: 'bar',
         height: 350
      },
      plotOptions: {
         bar: {
         horizontal: false,
         columnWidth: '55%',
         endingShape: 'rounded'
         },
      },
      dataLabels: {
         enabled: false
      },
      stroke: {
         show: true,
         width: 2,
         colors: ['transparent']
      },
      xaxis: {
         categories: hospital_names,//['Hosp 1', 'Hosp 2', 'Hosp 3', 'Hosp 4'],
         labels: {
          show: true,
          rotate: 0,
          rotateAlways: false,
          /*hideOverlappingLabels: true,
          showDuplicates: false,
          trim: false,
          minHeight: undefined,
          maxHeight: 120,*/
          style: {
              colors: [],
              fontSize: '12px',
              fontFamily: 'Helvetica, Arial, sans-serif',
              fontWeight: 400,
              cssClass: 'apexcharts-xaxis-label',
          },
         },
      },
      yaxis: {
         title: {
         text: 'PORCENTAJE (%)',
         style: {
              colors: [],
              fontSize: '14px',
              fontFamily: 'Helvetica, Arial, sans-serif',
              fontWeight: 400,
              cssClass: 'apexcharts-yaxis-label',
          },
      
         }
      },
      fill: {
         opacity: 1
      },
      tooltip: {
         y: {
         formatter: function (val) {
            //return "$ " + val + " thousands"
            return val 
         }
         }
      }
   };

   var chart = new ApexCharts(document.querySelector("#chart"), options);
   chart.render();
  </script> 

   </body>
</html>