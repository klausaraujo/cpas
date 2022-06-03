<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?=TITULO_PRINCIPAL?></title>
      <meta name="author" content="<?=AUTOR?>">
     
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
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

      <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
            
      <!-- Data table CSS -->
      <link href="<?=base_url()?>public/css/datepicker.css" rel="stylesheet" type="text/css">

      <style>                        
         #top-tab-list li{
            width:20%;
         }
         .izquierda{
            float: left;
         }

         input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

input[type=number] { -moz-appearance:textfield; }

         
      </style>
    <script type="text/javascript">
            $(document).ready(function(){
             

                $('#telefono_responsable_reporte').on('input', function () { 
                    this.value = this.value.replace(/[^0-9]/g,'');
                });

                $('#telefono_jefe_guardia').on('input', function () { 
                    this.value = this.value.replace(/[^0-9]/g,'');
                });



                })

                </script>

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

                  <div id="message" class="col-xs-12"></div>
                  <div class="clearfix"></div>

                 
                  <br>
               
                  <div class="col-lg-12">
                    <?php //echo '<pre>'; var_dump($hospitales); 
                    ?>
                     <br>
                 
                     <div class="iq-card"> 
                        <!-- <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Registrar de la ficha de evaluación de situación de los servicios de Emergencia</h4>
                           </div>
                        </div> -->
                        <!-- <div class="container"> -->

                        <div style="background-color:#089eaf" class="alert alert-primary" role="alert">
<a style="color:white; text-align: center" class="alert-link">
  <b> REGISTRAR DE LA FICHA DE EVALUACIÓN DE SITUACIÓN DE LOS SERVICIOS DE EMERGENCIA </b> </a>
</div>
                        

                        <div class="iq-card-body">
                           <form id="formHospital" name="formHospital" method="POST" action="" autocomplete="off">
                              <input type="hidden" id="id" name="id" value="0">
                              <input type="hidden" id="camaUciTotalSuma" name="camaUciTotalSuma" value="0">

                             

                              <div class="row align-items-center">
                                          <label class="span__bold" style="display:block; width:100%">
                                           <b>  SELECCIONE IPRESS Y/O REGIÓN PRIORIZADA </b>
                                          </label> 
                                 <div class="form-group col-sm-6"> 
                                    <?php //if($tipo == 1){ ?>
                                       <!-- <label for="ipress">IPRESS:</label> -->
                                       <select class="form-control" name="ipress" id="ipress">
                                          <option value="">-- Seleccione IPRESS --</option>
                                          <?php foreach($hospitales as $row): ?>
                                          <option value="<?=$row->id?>"><?=$row->hospitales_situaciones_nombre?></option>
                                          <?php endforeach; ?>
                                          </select>
                                       <?php //} ?>
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <!-- <label for="lname">FECHA REGISTRO:</label>  -->
                                    <div class='input-group date' id="datetimepicker">
                                       <input type="text" class="form-control" name="fechaRegistro" id="fechaRegistro" />
                                       <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
                                    </div>
                                    <!-- <input type="text" class="form-control" id="fechaRegistro" name="fechaRegistro">  -->
                                 </div>
                              </div> 

                              <div class="row">
                                          <label class="span__bold">
                                           <b>  RESPONSABLE DE LA INFORMACIÓN - ENCARGADO DEL EMED SALUD (APLICADO SEGÚN DIRECTIVA ADMINISTRATIVA 250-2018 MINSA/DIGERD) </b>
                                          </label>

                              <br>
                                 <div class="col-6">
                                       <!-- <label class="col-sm-6 pl-0">Tip. Documento:</label> -->
                                       <select class="form-control" name="emed_tipo_documento" id="emed_tipo_documento" >
                                          <option value="">-- Seleccione su Tip. Documento --</option>
                                          <option value="01">DNI</option>
                                          <option value="03">CARNET DE EXTRANJERÍA</option>
                                          <option value="06">[N/A]</option>                                       
                                       </select>
                                 </div>
                                 <div class="col-6">
                                       <!-- <label class="col-sm-12 pl-0">Nro. Documento:</label>  -->
                                          <input id="dni_responsable_reporte" name="dni_responsable_reporte" class="form-control col-8 izquierda" type="text" placeholder="Ingrese su número de documento"/> 
                                          <button type="button" id="btn-buscarr" class="btn btn-info izquierda"><i class="fa fa-search" aria-hidden="true"></i></button>
                                          
                                 </div>
                              </div>

                              <br> 

                              <div class="row">
                                 <div class="col-12">
                                    <!-- <label class="col-sm-6 pl-0">Nombres y Apellidos</label> -->
                                       <input id="responsable_reporte" name="responsable_reporte" class="form-control text-uppercase" placeholder="Nombres y Apellidos " type="text" readonly/>
                                 </div>
                              </div>

                              <br>

                              <div class="row">
                                 <div class="col-6">
                                 <!-- <label class="modal-label col-sm-3 col-form-label py-10">Ocupación:</label> -->
                                 <select class="form-control" name="ocupacion_responsable_reporte" id="ocupacion_responsable_reporte">
                                       <option value="">-- Seleccione Ocupación --</option>
                                       <option value="1">MÉDICO</option>
                                       <option value="2">ENFERMERA</option>
                                       <option value="4">TEC. ENFERMERÍA</option>
                                       <option value="5">CIRUJANO DENTISTA</option>
                                       <option value="6">OBSTETRA</option>
                                       <option value="3">OTROS</option>
                                    </select>
                                 </div>
                                 <div class="col-6">
                                 <!-- <label class="modal-label col-sm-5 col-form-label py-10">Teléfono:</label> -->
                                 <input type="text" class="form-control" maxlength="9" name="telefono_responsable_reporte" id="telefono_responsable_reporte" placeholder="Ingrese número de teléfono"  /> 
                                 </div>

                              </div>

                              <br>


                              
                              <label class="span__bold">
                                           <b> JEFE DE GUARDIA (SUPERVISOR)  </b>
                                          </label>
                              
                              <br>

                              <div class="row">
                              
                                 <div class="col-6">
                                 <!-- <label class="col-sm-6">Tip. Documento:</label> -->
                                    <select class="form-control" name="supervidor_tipo_documento" id="supervidor_tipo_documento">
                                       <option value="">-- Seleccione Tip. Documento --</option>
                                       <option value="01">DNI</option>
                                       <option value="03">CARNET DE EXTRANJERÍA</option>
                                       <option value="06">[N/A]</option>                                       
                                    </select>
                                 </div>
                                 <div class="col-6">
                                 <!-- <label class="col-sm-6">Nro. Documento:</label> -->
                                       <input id="dni_jefe_guardia" name="dni_jefe_guardia" class="form-control col-8 izquierda" type="text" placeholder="Nro. Documento" />
                                      
                                       <button type="button" id="btn-buscarj" class="btn btn-info izquierda"><i class="fa fa-search" aria-hidden="true"></i></button>
                                      
                                 </div>

                              </div>

                                         
                              <br>




                              <div class="row">
                                 <div class="col-6">
                                 <select class="form-control" name="ocupacion_jefe_guardia" id="ocupacion_jefe_guardia">
                                        <!--<option value="">-- SELECCIONE --</option>-->
                                        <option value="1">MÉDICO</option>
                                        <option value="2">ENFERMERA</option>
                                        <option value="4">TEC. ENFERMERÍA</option>
                                        <option value="5">CIRUJANO DENTISTA</option>
                                        <option value="6">OBSTETRA</option>
                                        <option value="3">OTROS</option>
                                        <!--<option value="2">ENFERMERA</option>-->
                                    </select>
                                 </div>

                                 <div class="col-6">
                                 <!-- <label class="col-sm-6">Nombres y Apellidos:</label> -->
                                 <input type="text" class="form-control" name="telefono_jefe_guardia" id="telefono_jefe_guardia" placeholder="Nro.Telefono"/> 
                                 </div>
                           
                              </div>   

                              <br>


                              <div class="row">
                                 <div class="col-12">
                                 <!-- <label class="col-sm-6">Nombres y Apellidos:</label> -->
                                       <input id="jefe_guardia" name="jefe_guardia"
                                          class="form-control text-uppercase" type="text" placeholder="Nombres y Apellidos"  readonly/>
                                 </div>
                           
                              </div>   

                              <ul class="nav nav-tabs" id="hospital__tabs" role="tablist">
                                 <li class="nav-item">
                                    <a class="nav-link active" id="tab-1" 
                                                               href="#tab1" 
                                                               aria-controls="tab1" data-toggle="tab"  role="tab"  aria-selected="true">
                                    Camas Hospitalarias 
                                 </a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="tab-2" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">
                                    Servicio de Emergencia</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="tab-3" 
                                                         href="#tab3" 
                                                         aria-controls="tab3" data-toggle="tab"  role="tab"  aria-selected="false">
                                    UCI Adultos</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="tab-4" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">
                                    UCI Pediátricos</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="tab-5" data-toggle="tab" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false">
                                    Indices de Sobresaturación</a>
                                 </li>
                              </ul>
                              <br>
                              <div class="tab-content" id="myTabContent-2">
                                 <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab-1">
                                 <hr>   
                                 <div class="row"> 
                                          <h4 class="mb-4">SOBRESATURACIÓN DE CAMAS HOSPITALARIAS (NO UCI, NO EMERGENCIA):</h4>
                                    </div>
                                    <div class="row">
                                          <label class="span__bold">
                                           <b>  CAMAS DE HOSPITALIZACIÓN PARA NO COVID 19 CONVENCIONALES  </b>
                                          </label>
                                             (Camas registradas por Oficina General de Tecnologia de Informacion, Todas las camas iniciales de hospitalización permanente de todo paciente NO COVID 19)
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Habilitada: </label>
                                                <input type="number" min="0" max="1000" class="form-control" name="hospitalizacion_convencionales_h" id="hospitalizacion_convencionales_h" value="0"/>
                                             </div>
                                          </div>
                                          
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Uso:</label>
                                                <input type="number" min="0" max="1000" class="form-control" name="hospitalizacion_convencionales_u" id="hospitalizacion_convencionales_u" value="0" /> 
                                             </div>
                                          </div>

                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Observaciones: </label>
                                                <input type="text" maxlength="100" class="form-control" name="hospitalizacion_convencionales_o" id="hospitalizacion_convencionales_o" value="" /> 
                                             </div>
                                          </div>

                                          <label class="span__bold"><b>
                                             CAMAS HABILITADAS PARA HOSPITALIZACIÓN NO COVID 19</b>
                                          </label>
                                             (Incluye camas en áreas de expansión interna o externa en otros EESS o Nosocomios y/o áreas de expansión convertidas para  Hospitalización NO COVID 19)
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Habilitada: </label>
                                                <input type="number" min="0" max="1000" class="form-control" name="hospitalizacion_covid_h" id="hospitalizacion_covid_h" value="0" /> 
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                             <label>Uso: </label>
                                             <input type="number" min="0" max="1000" class="form-control" name="hospitalizacion_covid_u" id="hospitalizacion_covid_u" value="0" /> 
                                             </div>
                                          </div>

                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Observaciones: </label>
                                                <input type="text" maxlength="100" class="form-control" name="hospitalizacion_covid_o" id="hospitalizacion_covid_o" value="" /> 
                                             </div>
                                          </div>



                                          <label class="span__bold"><b>
                                             CAMAS HABILITADAS PARA HOSPITALIZACIÓN COVID 19 , EN EXPANSIÓN INTERNA</b>
                                          </label>
                                             (Pabellos convertidos para COVID 19, Camas de Hospitalización no considerados inicialmente para COVID 19, se tuvo que ampliar la hospitalización en servicios de Medicina, Cirugía, Traumatología, CENEX, Tropicales, etc.)
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Habilitada: *</label>
                                                <input type="number" min="0" max="1000" class="form-control" name="hospitalizacion_e_interna_h" id="hospitalizacion_e_interna_h" value="0" /> 
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                             <label>Uso: </label>
                                                <input type="number" min="0" max="1000" class="form-control" name="hospitalizacion_e_interna_u" id="hospitalizacion_e_interna_u" value="0" /> 
                                             </div>
                                          </div>

                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Observaciones: </label>
                                                <input type="text" maxlength="100" class="form-control" name="hospitalizacion_e_interna_o" id="hospitalizacion_e_interna_o" value="" /> 
                                             </div>
                                          </div>



                                          <label style="display:block; width:100%" class="span__bold"><b>
                                          CAMAS HABILITADAS PARA HOSPITALIZACIÓN COVID 19 EXPANSIÓN EXTERNA</b>
                                       </label>
                                             (Incluye camas en áreas de expansión interna o externa en otros EESS o Nosocomios y/o áreas de expansión convertidas para Hospitalización NO COVID 19)
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Habilitada: </label>
                                                <input type="number" min="0" max="1000" class="form-control" name="hospitalizacion_e_externa_h" id="hospitalizacion_e_externa_h" value="0" /> 
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                             <label>Uso: </label>
                                             <input type="number" min="0" max="1000" class="form-control" name="hospitalizacion_e_externa_u" id="hospitalizacion_e_externa_u" value="0" /> 
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Observaciones: </label>
                                                <input type="text" maxlength="100" class="form-control" name="hospitalizacion_e_externa_o" id="hospitalizacion_e_externa_o" value="" /> 
                                             </div>
                                          </div>


                                       

                                       
                                          <label class="span__bold"></label>
                                          <div style="width:20%;">
                                             <div class="form-group">
                                                <label>Camas hospitalarias disponibles al momento:</label>
                                                <input type="number" min="0" max="1000" class="form-control" name="hospitalizacion_disponibles" id="hospitalizacion_disponibles" value="0" readonly/> 
                                             </div>
                                          </div>
                                          <div style="width:20%;">
                                             <div class="form-group">
                                                <label>Camas hosp. COVID 19 disponibles al momento</label>
                                                <input type="number" min="0" max="1000" class="form-control" name="hospitalizacion_disponibles_momento" id="hospitalizacion_disponibles_momento" value="0"/> 
                                             </div>
                                          </div>
                                          <div style="width:20%;">
                                             <div class="form-group">
                                             <label>Habilitadas totales: 
                                                <br>   <br> 
                                             </label>
                                             <input type="number" min="0" max="1000" class="form-control" name="hospitalizacion_total_h" id="hospitalizacion_total_h" value="0" readonly/> 
                                             </div>
                                          </div>
                                          <div style="width:20%;">
                                             <div class="form-group">
                                                <label>Habilitadas en uso:
                                                <br>   <br> 
                                                </label>
                                                <input type="number" min="0" max="1000" class="form-control" name="hospitalizacion_total_u" id="hospitalizacion_total_u" value="0" readonly/> 
                                             </div>
                                          </div>



                                          <!-- -->

                                          <div style="width:20%;">
                                             <div class="form-group">
                                                <label>Sobresaturación en Hospitalización

                                                <br>  
                                                </label>
                                                <input type="number" class="form-control" name="hospitalizacion_porcentaje_01" id="hospitalizacion_porcentaje_01" value="0" readonly/> 
                                             </div>
                                          </div>

                                            <!-- -->

                                          

                                          
                                       
                                          <label class="span__bold" style="display:block; width:100%">
                                        <b>  RELACION DEL NUMERO DE CAMAS DE HOSPITALIZACIÓN ENTRE NUMERO DE MEDICOS POR TURNO  </b>
                                       </label>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Cama: </label>
                                                <input min="0" max="1000" type="number" class="form-control" name="hospitalizacion_camas_01" id="hospitalizacion_camas_01" value="0" /> 
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                             <label>Personal: </label>
                                             <input min="0" max="1000" type="number" class="form-control" name="hospitalizacion_medicos_01" id="hospitalizacion_medicos_01" value="0" /> 
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Indicador: </label>
                                                <input type="text" class="form-control" name="hospitalizacion_indicador_01" id="hospitalizacion_indicador_01" value="0" readonly/> 
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Observacion: </label>
                                                <input type="text" class="form-control" name="hospitalizacion_observaciones_01" id="hospitalizacion_observaciones_01" value="0" /> 
                                             </div>
                                          </div>




                                          <label class="span__bold" style="display:block; width:100%"><b>
                                          RELACION DEL NUMERO DE CAMAS DE HOSPITALIZACIÓN ENTRE NÚMERO DE PERSONAL DE ENFERMERÍA POR TURNO</b>
                                        </label>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Cama: </label>
                                                <input min="0" max="1000" type="number" class="form-control" name="hospitalizacion_camas_02" id="hospitalizacion_camas_02" value="0" /> 
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                             <label>Personal: </label>
                                             <input min="0" max="1000" type="number" class="form-control" name="hospitalizacion_enfermeras_02" id="hospitalizacion_enfermeras_02" value="0" /> 
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Indicador: </label>
                                                <input type="text" class="form-control" name="hospitalizacion_indicador_02" id="hospitalizacion_indicador_02" value="0" readonly/> 
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Observacion: </label>
                                                <input type="text" maxlength="100" class="form-control" name="hospitalizacion_observaciones_02" id="hospitalizacion_observaciones_02" value="0" /> 
                                             </div>
                                          </div> 

                                       </div>
                                 </div>
                                 <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab-2">
                                    <div class="row"> 
                                          <h4 class="mb-4">SOBRESATURACIÓN DE CAMAS DEL SERVICIO DE EMERGENCIA ADULTOS:</h4>
                                       
                                    </div>
                                    <div class="row">
                                       <label style="display:block; width:100%;" class="span__bold">
                                      <b> CAMAS DE EMERGENCIAS PARA NO COVID 19 CONVENCIONALES </b>
                                    </label>
                                    <p style="display:block; width:100%;"> (Todas las camas iniciales; Camillas de Emergencias Adulto de todo paciente NO COVID 19).</p>
                                      
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_convencionales_h" id="emergencia_convencionales_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_convencionales_u" id="emergencia_convencionales_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="text" maxlength="100" class="form-control" name="emergencia_convencionales_o" id="emergencia_convencionales_o" value="" /> 
                                          </div>
                                       </div>

                                       <label class="span__bold">
                                         <b> CAMAS HABILITADAS PARA EMERGENCIA ADULTOS PARA NO COVID 19 </b>
                                       </label>
                                       (Convertidos para NO COVID 19; son las Camas de Emergencia No COVID 19, fuera del servicio de emergencia ) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_covid_h" id="emergencia_covid_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_covid_u" id="emergencia_covid_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="text" maxlength="100" class="form-control" name="emergencia_covid_o" id="emergencia_covid_o" value="" /> 
                                          </div>
                                       </div>


                                       <!-- nuevo campo-->
                                       <label class="span__bold">
                                        <b>  CAMAS HABILITADAS PARA PACIENTE NO CRÍTICO COVID 19 EN EL SERVICIO DE EMERGENCIA ADULTO,COMO EXPANSIÓN INTERNA </b>
                                       </label>
                                       (Convertidos para COVID 19; considerar camas que se tuvo que ampliar en espacios del servicios de emergencia como Cirugía, Traumatologia, etc; a cargo del servicio de Emergencia)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_e_externa_02_h" id="emergencia_e_externa_02_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_e_externa_02_u" id="emergencia_e_externa_02_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="text" maxlength="100" class="form-control" name="emergencia_e_externa_o_02" id="emergencia_e_externa_o_02" value="" /> 
                                          </div>
                                       </div>


                                       


                                       <label class="span__bold">
                                        <b>  CAMAS HABILITADAS PARA EMERGENCIA ADULTO COVID 19 , EN EXPANSIÓN INTERNA </b>
                                       </label>
                                       (Convertidos para COVID 19; considerar camas que se tuvo que ampliar en espacios del servicios de emergencia como Cirugía, Traumatologia, etc; a cargo del servicio de Emergencia)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_e_interna_h" id="emergencia_e_interna_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_e_interna_u" id="emergencia_e_interna_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="text" maxlength="100" class="form-control" name="emergencia_e_interna_o" id="emergencia_e_interna_o" value="" /> 
                                          </div>
                                       </div>

                                       <label class="span__bold">
                                       <b>   CAMAS HABILITADAS PARA EMERGENCIAS ADULTOS COVID 19 EN EXPANSIÓN EXTERNA </b>
                                       </label> 
                                          (Oferta Movil; camillas habilitadas en areas de expansion externa para el Servicio de Emergencia Adultos; como Shelter; Masivas, Hospital Movil, TM54, Módulos de vivienda)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_e_externa_h" id="emergencia_e_externa_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_e_externa_u" id="emergencia_e_externa_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="text" maxlength="100" class="form-control" name="emergencia_e_externa_o" id="emergencia_e_externa_o" value="" /> 
                                          </div>
                                       </div>



                                             <!-- nuevo campo-->
                                             <label class="span__bold">
                                              <b>  CAMAS HABILITADAS PARA PACIENTE CRÍTICO COVID 19 EN EL SERVICIO DE EMERGENCIA ADULTO (PACIENTE VENTILADO, COMO EXPANSIÓN EXTERNA)  </b>
                                             </label>
                                       (Convertidos para COVID 19.considerar camas que se tuvo que emplear en espacio del servicio de emergencia como cirugia, traumatologia,etc, acargo del servicio de emergencia)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_e_externa_03_h" id="emergencia_e_externa_03_h" value="0" /> 
                                          </div>
                                       </div>


                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_e_externa_03_u" id="emergencia_e_externa_03_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="text" maxlength="100"  class="form-control" name="emergencia_e_externa_o_03" id="emergencia_e_externa_o_03" value="0" /> 
                                          </div>
                                       </div>


                                       <label class="span__bold">
                                        <b>  PACIENTES EN ESPERA DE CAMAS QUE REQUIEREN HOSPITALIZACION  </b>
                                       </label>
                                       Pacientes ingresados en pasillos (sillas de ruedas, camillas, bancas, etc.) que requieren hospitalización
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label></label>
                                             
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_pacientes_01" id="emergencia_pacientes_01" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label></label>
                                             
                                          </div>
                                       </div>



                                       <label class="span__bold">
                                        <b>  PACIENTES EN ESPERA DE CAMAS QUE REQUIEREN HOSPITALIZACION EN AREAS DE COVID 19  </b>
                                       </label>
                                       Pacientes ingresados en pasillos del Servicio de Emergencia u otras areas  (sillas de ruedas, camillas, bancas, etc.) que requieren hospitalización en área COVID
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label></label>
                                             
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_pacientes_02" id="emergencia_pacientes_02" value="0" /> 
                                          </div>
                                       </div>
                                          <div class="col-md-6">
                                          <div class="form-group">
                                          
                                             
                                          </div>
                                       </div>



                                       <label class="span__bold"> </label>
                                       
                                       <div style="width:20%;">
                                          <div class="form-group">
                                          <label>Camas hospitalarias disponibles al momento:</label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_espera_u" id="emergencia_espera_u" value="0" readonly/> 
                                          </div>
                                       </div>

                                       <div style="width:20%;">
                                          <div class="form-group">
                                          <label>Camas emerg. COVID 19 disponibles al momento</label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_espera_u_momento" id="emergencia_espera_u_momento" value="0"/> 
                                          </div>
                                       </div>



                                       <div style="width:20%;">
                                          <div class="form-group">
                                          <label>Habilitadas totales:
                                          <br> <br>  
                                       </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_total_h" id="emergencia_total_h" value="0" readonly/> 
                                          </div>
                                       </div>

                                       <div style="width:20%;">
                                          <div class="form-group">
                                       <label>Habilitadas en uso:
                                          <br> <br>        
                                       </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="emergencia_total_u" id="emergencia_total_u" value="0" readonly/> 
                                          </div>
                                       </div>


                                       
                                       <div style="width:15%;margin-right:1%">
                                          <div class="form-group">
                                       <label>
                                          Sobresaturación en emerg:
                                          <br>    
                                       </label>
                                          <input type="number" class="form-control" name="emergencia_porcentaje_01" id="emergencia_porcentaje_01" value="0" readonly/> 
                                          </div>
                                       </div>
                                       


                                       <label class="span__bold" style="display:block; width:100%">
                                     <b>  RELACION DEL NUMERO DE CAMAS DE EMERGENCIA ENTRE NUMERO DE MEDICOS POR TURNO  </b>
                                     </label>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                                <label>Cama: </label>
                                                <input min="0" max="1000" type="number" class="form-control" name="emergencia_camas_01" id="emergencia_camas_01" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Personal: </label>
                                          <input min="0" max="1000" type="number" class="form-control" name="emergencia_medicos_01" id="emergencia_medicos_01" value="0" /> 
                                          </div>
                                       </div>
                                          <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Indicador: </label>
                                             <input type="text" class="form-control" name="emergencia_indicador_01" id="emergencia_indicador_01" value="0" readonly /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Observacion: </label>
                                             <input type="text" class="form-control" name="emergencia_observaciones_01" id="emergencia_observaciones_01" value="0" /> 
                                          </div>
                                       </div>



                                       <label class="span__bold" style="display:block; width:100%">
                                    <b>   RELACION DEL NUMERO DE CAMAS DE EMERGENCIA ENTRE NÚMERO DE PERSONAL DE ENFERMERÍA POR TURNO </b>
                                     </label>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                                <label>Cama: </label>
                                                <input min="0" max="1000" type="number" class="form-control" name="emergencia_camas_02" id="emergencia_camas_02" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Personal: </label>
                                          <input min="0" max="1000" type="number" class="form-control" name="emergencia_enfermeras_02" id="emergencia_enfermeras_02" value="0" /> 
                                          </div>
                                       </div>
                                          <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Indicador: </label>
                                             <input type="text" class="form-control" name="emergencia_indicador_02" id="emergencia_indicador_02" value="0" readonly/> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Observacion: </label>
                                             <input type="text" maxlength="100" class="form-control" name="emergencia_observaciones_02" id="emergencia_observaciones_02" value="0" /> 
                                          </div>
                                       </div>






                                       
                                    


                                       
                                       

                                    </div>
                                 </div>
                                 <div class="tab-pane fade  " id="tab3" role="tabpanel" aria-labelledby="tab-3">
                                    <div class="row"> 
                                          <h4 class="mb-4">SOBRESATURACIÓN DE CAMAS DEL SERVICIO DE CUIDADOS CRITICOS ADULTOS:</h4>
                                       
                                    </div>
                                    <div class="row">
                                       <label class="span__bold">
                                       <b>   CAMAS DE UCI ADULTO PARA NO COVID 19 CONVENCIONALES </b>
                                       </label>
                                       (Todas las camas iniciales, considerar aquellas camas de la Unidad de Cuidados Intensivos en Adulto de todo paciente NO COVID 19)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_convencionales_h" id="criticos_convencionales_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_convencionales_u" id="criticos_convencionales_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="number" maxlength="100" class="form-control" name="criticos_convencionales_o" id="criticos_convencionales_o" value="0" /> 
                                          </div>
                                       </div>

                                       <label class="span__bold">
                                       <b>  CAMAS HABILITADAS PARA UCI Adulto NO COVID 19 </b>
                                       </label>
                                       (Considerar en EESS o Nosocomios convertidos para la Unidad de Cuidados Intensivos NO COVID 19; fuera de la institución) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_covid_h" id="criticos_covid_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_covid_u" id="criticos_covid_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="number" maxlength="100" class="form-control" name="criticos_covid_o" id="criticos_covid_o" value="0" /> 
                                          </div>
                                       </div>


                                       <!-- nuevo campo-->
                                       <label class="span__bold">
                                       <b>   CAMAS HABILITADAS PARA UCI Adulto COVID 19 , EN EXPANSIÓN INTERNA </b>
                                       </label>
                                       (Pabellones convertidos para UCI COVID 19; considerar camas que se tuvieron que ampliar para unidades de UCI COVID, por ejemplo de Cirugía, Cardiología, Traumatologia, etc)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_e_interna_h" id="criticos_e_interna_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_e_interna_u" id="criticos_e_interna_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="number" maxlength="100" class="form-control" name="criticos_e_interna_o" id="criticos_e_interna_o" value="0" /> 
                                          </div>
                                       </div>


                                       


                                       <label class="span__bold">
                                        <b>  CAMAS HABILITADAS PARA UCI Adulto COVID 19, EN EXPANSIÓN EXTERNA </b>
                                       </label>
                                       (Oferta Movil; UCI Adulto COVID en áreas de expansión externas como: Shelter; Masivas, Hospital Movil, TM54, Módulos de vivienda )
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_e_externa_h" id="criticos_e_externa_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_e_externa_u" id="criticos_e_externa_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="number" maxlength="100" class="form-control" name="criticos_e_externa_o" id="criticos_e_externa_o" value="0" /> 
                                          </div>
                                       </div>

                                       <label class="span__bold">
                                        <b>  PACIENTES NO COVID CON NECESIDAD DE SERVICIOS DE UCI </b>
                                       </label> 
                                       (Considerar pacientes que requieren de los servicios de UCI;  en espera de cama procedentes del Servicio de Emergencia u hospitalización)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label></label>
                                          
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_espera_u" id="criticos_espera_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="number" maxlength="100" class="form-control" name="criticos_espera_o" id="criticos_espera_o" value="0" /> 
                                          </div>
                                       </div>



                                    


                                       <label class="span__bold">
                                        <b>  PACIENTES COVID - 19 CON NECESIDAD DE SERVICIOS DE UCI </b>
                                       </label>
                                       (Considerar pacientes que requieren de los servicios de la Unidad de Cuidados Intensivos COVID; en espera de cama procedentes del Servicio de Emergencia u hospitalización)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label></label>
                                             
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_espera_u_momento" id="criticos_espera_u_momento" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="number" maxlength="100" class="form-control" name="criticos_espera_u_momento_o" id="criticos_espera_u_momento_o" value="0" /> 
                                             
                                          </div>
                                       </div>


                           

                                       <label class="span__bold"> </label>
                                       
                                       <div style="width:20%">
                                          <div class="form-group">
                                          <label>Camas UCI adultos disponibles al momento</label>
                                          <br>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_disponibles" id="criticos_disponibles" value="0" readonly/> 
                                          </div>
                                       </div>

                                       <div style="width:20%">
                                          <div class="form-group">
                                          <label>Camas UCI adultos COVID 19 disponibles al momento</label>
                                          <br>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_disponibles_momento" id="criticos_disponibles_momento" value="0"/> 
                                          </div>
                                       </div>

                                       
                                       <div style="width:20%">
                                          <div class="form-group">
                                          <label>Habilitadas totales: </label>
                                          <br> <br>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_total_h" id="criticos_total_h" value="0" readonly/> 
                                          </div>
                                       </div>

                                          
                                       <div style="width:20%">
                                          <div class="form-group">
                                          <label>Habilitadas en uso: </label>
                                          <br> <br>
                                          <input type="number" min="0" max="1000" class="form-control" name="criticos_total_u" id="criticos_total_u" value="0" readonly/> 
                                          </div>
                                       </div>

                                          <div style="width:20%">
                                          <div class="form-group">
                                          <label>Sobresaturación del servicio de cuidados críticos adultos: </label>
                                          <input type="number" class="form-control" name="criticos_porcentaje_01" id="criticos_porcentaje_01" value="0" readonly/> 
                                          </div>
                                       </div>




                                       <label class="span__bold" style="display:block; width:100%">
                                    <b>   RELACION DEL NUMERO DE CAMAS UCI ENTRE NUMERO DE MEDICOS POR TURNO </b>
                                    </label>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                                <label>Cama: </label>
                                                <input type="number" class="form-control" name="criticos_camas_01" id="criticos_camas_01" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Personal: </label>
                                          <input type="number" class="form-control" name="criticos_medicos_01" id="criticos_medicos_01" value="0" /> 
                                          </div>
                                       </div>
                                          <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Indicador: </label>
                                             <input type="text" class="form-control" name="criticos_indicador_01" id="criticos_indicador_01" value="0" readonly /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Observacion: </label>
                                             <input type="text" class="form-control" name="criticos_observaciones_01" id="criticos_observaciones_01" value="0" /> 
                                          </div>
                                       </div>



                                       <label class="span__bold" style="display:block; width:100%">
                                     <b>  RELACION DEL NUMERO DE CAMAS UCI ENTRE NÚMERO DE PERSONAL DE ENFERMERÍA POR TURNO </b>
                                     </label>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                                <label>Cama: </label>
                                                <input type="number" class="form-control" name="criticos_camas_02" id="criticos_camas_02" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Personal: </label>
                                          <input type="number" class="form-control" name="criticos_enfermeras_02" id="criticos_enfermeras_02" value="0" /> 
                                          </div>
                                       </div>
                                          <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Indicador: </label>
                                             <input type="text" class="form-control" name="criticos_indicador_02" id="criticos_indicador_02" value="" readonly/> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Observacion: </label>
                                             <input type="text" class="form-control" name="criticos_observaciones_02" id="criticos_observaciones_02" value="" /> 
                                          </div>
                                       </div>



                                       

                                    </div>
                                 </div>
                                 <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab-4">
                                    <div class="row"> 
                                          <h4 class="mb-4">SOBRESATURACIÓN DE CAMAS DE CUIDADOS CRITICOS PEDIATRICOS:</h4>
                                       
                                    </div>
                                    <div class="row">
                                       <label class="span__bold">
                                       <b>   CAMAS DE UCI PEDIATRICO PARA NO COVID 19 CONVENCIONALES </b>
                                       </label>
                                       (Todas las camas iniciales, considerar aquellas camas de la Unidad de Cuidados Intensivos Pediatrico de todo paciente NO COVID 19)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" class="form-control" name="pediatricos_convencionales_h" id="pediatricos_convencionales_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" class="form-control" name="pediatricos_convencionales_u" id="pediatricos_convencionales_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="number" class="form-control" name="pediatricos_convencionales_o" id="pediatricos_convencionales_o" value="0" /> 
                                          </div>
                                       </div>

                                       <label class="span__bold">
                                        <b>  CAMAS HABILITADAS PARA UCI Pediatrico NO COVID 19  </b>
                                       </label>
                                       (Considerar en EESS o Nosocomios convertidos para la Unidad de Cuidados Intensivos NO COVID 19; fuera de la institución)  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" class="form-control" name="pediatricos_covid_h" id="pediatricos_covid_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" class="form-control" name="pediatricos_covid_u" id="pediatricos_covid_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="number" class="form-control" name="pediatricos_covid_o" id="pediatricos_covid_o" value="0" /> 
                                          </div>
                                       </div>


                                       <!-- nuevo campo-->
                                       <label class="span__bold">
                                        <b>  CAMAS HABILITADAS PARA UCI Pediatrico COVID 19 , EN EXPANSIÓN INTERNA </b>
                                       </label>
                                       (Pabellones convertidos para UCI COVID 19; considerar camas que se tuvieron que ampliar para unidades de UCI COVID, por ejemplo de Cirugía, Cardiología, Traumatologia, etc)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" class="form-control" name="pediatricos_e_interna_h" id="pediatricos_e_interna_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" class="form-control" name="pediatricos_e_interna_u" id="pediatricos_e_interna_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: *</label>
                                          <input type="number" class="form-control" name="pediatricos_e_interna_o" id="pediatricos_e_interna_o" value="0" /> 
                                          </div>
                                       </div>


                                       


                                       <label class="span__bold">
                                      <b>    CAMAS HABILITADAS PARA HOSPITALIZACIÓN COVID 19  EXPANSIÓN EXTERNA </b>
                                       </label>
                                       (Oferta Movil, Hospitalización en áreas externas como: Shelter; Masivas, Hospital Movil, TM54, Módulos de vivienda, etc)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: *</label>
                                          <input type="number" class="form-control" name="pediatricos_e_externa_h" id="pediatricos_e_externa_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" class="form-control" name="pediatricos_e_externa_u" id="pediatricos_e_externa_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="number" class="form-control" name="pediatricos_e_externa_o" id="pediatricos_e_externa_o" value="0" /> 
                                          </div>
                                       </div>


                                       <label class="span__bold">
                                        <b>  PACIENTES PEDIATRICOS NO COVID CON NECESIDAD DE SERVICIOS DE UCI  </b>
                                       </label> 
                                       (Considerar pacientes que requieren de los servicios de UCI;  en espera de cama procedentes del Servicio de Emergencia u hospitalización)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label></label>
                                          
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" class="form-control" name="pediatricos_espera_u" id="pediatricos_espera_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="number" class="form-control" name="pediatricos_espera_o" id="pediatricos_espera_o" value="0" /> 
                                          </div>
                                       </div>





                                    


                                       <label class="span__bold">
                                       <b>   PACIENTES PEDIATRICOS COVID - 19 CON NECESIDAD DE SERVICIOS DE UCI </b>
                                       </label>
                                       (Considerar pacientes que requieren de los servicios de UCI COVID; en espera de cama procedentes del Servicio de Emergencia u hospitalización)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label></label>
                                             
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" class="form-control" name="pediatricos_paciente_01" id="pediatricos_paciente_01" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="number" class="form-control" name="pediatricos_paciente_01_o " id="pediatricos_paciente_01_o " value="0" /> 
                                             
                                          </div>
                                       </div>


                           

                                       <label class="span__bold"> </label>
                                       
                                       <div style="width:20%;">
                                          <div class="form-group">
                                          <label>Camas UCI pediátrico disponibles al momento</label>
                                          <input type="number" class="form-control" name="pediatricos_disponibles" id="pediatricos_disponibles" value="0" readonly/> 
                                          </div>
                                       </div>

                                       <div style="width:20%;">
                                          <div class="form-group">
                                          <label>Camas UCI pediát. COVID 19 disponibles al momento</label>
                                          <input type="number" class="form-control" name="pediatricos_disponibles_momento" id="pediatricos_disponibles_momento" value="0"/> 
                                          </div>
                                       </div>

                                       <div style="width:20%;">
                                          <div class="form-group">
                                          <label>Habilitadas totales:
                                             <br> <br>
                                          </label>
                                          <input type="number" class="form-control" name="pediatricos_total_h" id="pediatricos_total_h" value="0" readonly/> 
                                          </div>
                                       </div>

                                       
                                       <div style="width:20%;">
                                          <div class="form-group">
                                          <label>Habilitadas en uso:
                                             <br> <br>
                                          </label>
                                          <input type="number" class="form-control" name="pediatricos_total_u" id="pediatricos_total_u" value="0" readonly/> 
                                          </div>
                                       </div>


                                          <div style="width:20%;">
                                          <div class="form-group">
                                          <label>Sobresaturación cuidados críticos pediátricos: </label>
                                          <input type="number" class="form-control" name="pediatricos_porcentaje_01" id="pediatricos_porcentaje_01" value="0" readonly/> 
                                          </div>
                                       </div>




                                       <label class="span__bold" style="display:block; width:100%">
                                  <b>     RELACION DEL NUMERO DE CAMAS UCI PEDIÁTRICA ENTRE NUMERO DE MEDICOS POR TURNO </b>
                                    </label>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                                <label>Cama: </label>
                                                <input type="number" class="form-control" name="pediatricos_camas_01" id="pediatricos_camas_01" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Personal: </label>
                                          <input type="number" class="form-control" name="pediatricos_medicos_01" id="pediatricos_medicos_01" value="0" /> 
                                          </div>
                                       </div>
                                          <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Indicador: </label>
                                             <input type="text" class="form-control" name="pediatricos_indicador_01" id="pediatricos_indicador_01" value="0" readonly/> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Observacion: </label>
                                             <input type="text" class="form-control" name="pediatricos_observaciones_01" id="pediatricos_observaciones_01" value="0" /> 
                                          </div>
                                       </div>



                                       <label class="span__bold" style="display:block; width:100%">
                                   <b>    RELACION DEL NUMERO DE CAMAS UCI  PEDIÁTRICA ENTRE NÚMERO DE PERSONAL DE ENFERMERÍA POR TURNO </b>
                                     </label>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                                <label>Cama: </label>
                                                <input type="number" class="form-control" name="pediatricos_camas_02" id="pediatricos_camas_02" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Personal: </label>
                                          <input type="number" class="form-control" name="pediatricos_enfermeras_02" id="pediatricos_enfermeras_02" value="0" /> 
                                          </div>
                                       </div>
                                          <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Indicador: </label>
                                             <input type="text" class="form-control" name="pediatricos_indicador_02" id="pediatricos_indicador_02" value="0" readonly/> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Observacion: </label>
                                             <input type="text" class="form-control" name="pediatricos_observaciones_02" id="pediatricos_observaciones_02" value="0" /> 
                                          </div>
                                       </div>





                                       

                                    </div>
                                 </div>
                                 <div class="tab-pane fade  " id="tab5" role="tabpanel" aria-labelledby="tab-5">
                                 <div class="row"> 
                                          <h4 class="mb-4">SOBRESATURACIÓN DE CAMAS DE CUIDADOS CRITICOS PEDIATRICOS:</h4>
                                       
                                    </div>

                                    <div class="row">


                                        
                                        <table class="table table-bordered">
                                       <thead>
                                         
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td style="width:50%;">SOBRESATURACIÓN DE CAMAS HOSPITALARIAS (NO UCI, NO EMERGENCIA)</td>
                                             <td>
                                             <input type="number" class="form-control" name="hospitalizacion_porcentaje_01_5" id="hospitalizacion_porcentaje_01_5" value="0" readonly /> 
                                             </td>
                                            
                                          </tr>
                                          <tr>
                                             <td style="width:50%;">SOBRESATURACIÓN DE CAMAS HOSPITALARIAS (NO UCI. NO EMERGENCIA) POR COVID 19</td>
                                             <td>
                                             <input type="number" class="form-control" name="hospitalizacion_porcentaje_02_5" id="hospitalizacion_porcentaje_02_5" value="0" readonly /> 
                                             
                                             </td>
                                           
                                          </tr>
                                          <tr>
                                             <td style="width:50%;">SOBRESATURACIÓN DE CAMAS DEL SERVICIO DE EMERGENCIA ADULTOS</td>
                                             <td>
                                             <input type="number" class="form-control" name="emergencia_porcentaje_01_5" id="emergencia_porcentaje_01_5" value="0" readonly /> 
                                            
                                             </td>
                                          
                                          </tr>
                                          <tr>
                                             <td style="width:50%;">SOBRESATURACIÓN DE CAMAS DEL SERVICIO DE EMERGENCIA ADULTOS POR COVID 19</td>
                                             <td>
                                             <input type="number" class="form-control" name="emergencia_porcentaje_02_5" id="emergencia_porcentaje_02_5" value="0" readonly /> 
                                             
                                             </td>
                                          
                                          </tr>
                                          <tr>
                                             <td style="width:50%;">SOBRESATURACIÓN DE CAMAS DEL SERVICIO DE CUIDADOS CRITICOS ADULTOS</td>
                                             <td>
                                             <input type="number" class="form-control" name="criticos_porcentaje_01_5" id="criticos_porcentaje_01_5" value="0" readonly /> 
                                            
                                             </td>
                                          
                                          </tr>


                                          <tr>
                                             <td style="width:50%;">SOBRESATURACIÓN DE CAMAS DEL SERVICIO DE CUIDADOS CRITICOS ADULTOS POR COVID 19</td>
                                             <td>
                                             <input type="number" class="form-control" name="criticos_porcentaje_02_5" id="criticos_porcentaje_02_5" value="0" readonly /> 
                                           
                                             </td>
                                          
                                          </tr>
                                       

                                          <tr>
                                             <td style="width:50%;">SOBRESATURACIÓN DE CAMAS DE CUIDADOS CRITICOS PEDIATRICOS</td>
                                             <td>
                                             <input type="number" class="form-control" name="pediatricos_porcentaje_01_5" id="pediatricos_porcentaje_01_5" value="0" readonly /> 
                                            
                                             </td>
                                          
                                          </tr>

                                          <tr>
                                             <td style="width:50%;">SOBRESATURACIÓN DE CAMAS DE CUIDADOS CRITICOS PEDIATRICOS POR COVID 19</td>
                                             <td>
                                             <input type="number" class="form-control" name="pediatricos_porcentaje_02_5" id="pediatricos_porcentaje_02_5" value="0" readonly /> 
                                           
                                             </td>
                                          
                                          </tr>

                                       </tbody>
                                       </table>


                                       <!-- <label class="span__bold">CAMAS DE UCI PEDIATRICO PARA NO COVID 19 CONVENCIONALES</label>
                                       (Todas las camas iniciales, considerar aquellas camas de la Unidad de Cuidados Intensivos Pediatrico de todo paciente NO COVID 19)
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Habilitada: </label>
                                          <input type="number" class="form-control" name="pediatricos_convencionales_h" id="pediatricos_convencionales_h" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Uso: </label>
                                          <input type="number" class="form-control" name="pediatricos_convencionales_u" id="pediatricos_convencionales_u" value="0" /> 
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <label>Observaciones: </label>
                                          <input type="number" class="form-control" name="pediatricos_convencionales_o" id="pediatricos_convencionales_o" value="0" /> 
                                          </div>
                                       </div> -->

                                    
                                       






                                       

                                    </div>
                                 </div> 
                              </div>
                               
                              <center>     <button type="submit" class="col-3 btn btn-primary">Guardar Registro </button>
                              <a href="<?=base_url()?>hospitales" class="col-3 btn btn-primary" role="button" aria-pressed="true">Cancelar</a>

                           
                           
                              </center>
                         
                           <!-- <button type="reset" class="btn iq-bg-danger">cancel</button> -->

                           </form>
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


      <script src="<?=base_url()?>public/js/moment.min.js"></script>
      <script src="<?=base_url()?>public/js/locale.es.js"></script>
      <script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
      <!-- Validate -->
      <script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>

      <script>
         var URI = "<?=base_url()?>"; 
      </script> 
      <script src="<?=base_url()?>public/js/hospitales/form-lima.js?v=<?=date("his")?>"></script>
      <script>
         nuevo("<?=base_url()?>");
      </script>


   </body>
</html>