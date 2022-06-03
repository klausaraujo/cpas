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

   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
   <link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css" />
   <link rel="stylesheet" href="<?=base_url()?>public/css/brigadistas/maincomisiones.css" />


</head>
<?php
    $months = array(
        array("id"=>"01","name"=>"Enero"),
        array("id"=>"02","name"=>"Febrero"),
        array("id"=>"03","name"=>"Marzo"),
        array("id"=>"04","name"=>"Abril"),
        array("id"=>"05","name"=>"Mayo"),
        array("id"=>"06","name"=>"Junio"),
        array("id"=>"07","name"=>"Julio"),
        array("id"=>"08","name"=>"Agosto"),
        array("id"=>"09","name"=>"Septiembre"),
        array("id"=>"10","name"=>"Octubre"),
        array("id"=>"11","name"=>"Noviembre"),
        array("id"=>"12","name"=>"Diciembre")
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
                           <h4 class="mt-0 m-b-15 header-title">LISTA DE REPORTES EJECUTIVOS DEL COMANDO DE OPERACIONES COVID-19</h4>
                           <br>
                           <div class="form-group row">
                              <div class="col-sm-12 col-md-5 col-md-offset-5 pa-10">
                                <!-- <button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal"
                                    id="btnRegistrarInd">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                    Registrar Nuevo Indicador
                                 </button>-->
                              </div>
                           </div>
                           <div class="table-responsive">
                              <table class="tablaRegInd table table-hover mb-0">
                                 <thead>
                                    <tr>
                                       <th>Acciones</th>
                                       <th></th>
                                       <th>REGION</th>
                                       <th>FECHA</th>
                                       <th>AÑO EJECUCIÓN</th>
                                       <th>MES</th>
                                       <th>REPORTE</th>
                                       <th>ESTADO</th>
                                       <th></th>
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
                                       <label class="modal-label col-sm-2 col-form-label py-10">Unidad Ejecutora</label>
                                       <div class="col-sm-7">
                                          <select class="form-control" name="idejecutora" id="idejecutora">
                                             <option value="">-- Seleccione --</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Fecha de
                                          Registro</label>
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
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Año</label>
                                       <div class="col-sm-7">
                                          <select class="form-control" name="anio" id="anio">
                                             <?php foreach ($listaAnioEjecucion->result() as $row): ?>
                                             <option value="<?=$row->Anio_Ejecucion?>"><?=$row->Anio_Ejecucion?>
                                             </option>
                                             <?php endforeach;?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label class="modal-label col-sm-2 col-form-label py-10">Mes</label>
                                       <div class="col-sm-7">
                                          <select class="form-control" name="mes" id="mes">
                                             <?php foreach ($months as $row): ?>
                                             <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
                                             <?php endforeach;?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <h2 class="text-divider"><span></span></h2>
                                 <div class="table-responsive main-table">
                                    <table class="tablecalculo table table-bordered" cellspacing="0" width="100%">
                                       <thead>
                                          <tr>
                                             <th>PRODUCTO/PROYECTO</th>
                                             <th>ACTIVIDAD</th>
                                             <th>FORMA DE CÁLCULO</th>
                                             <th colspan="2">VALOR</th>
                                             <th>CALCULO</th>
                                             <th>COMENTARIOS</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td rowspan="2">3000737. ESTUDIOS PARA LA ESTIMACION DEL RIESGO DE
                                                DESASTRES</td>
                                             <td rowspan="2">5005572 DESARROLLO DE INVESTIGACION APLICADA PARA LA
                                                GESTION DEL RIESGO DE DESASTRES</td>
                                             <td>N° Investigaciones en el ámbito nacional sobre Gestión del Riesgo de
                                                Desastres realizadas en el año</td>
                                             <td>NUMERADOR</td>
                                             <td style="width: 5%;"><input type="text" class="form-control" name="matriz-1" id="matriz-1" /></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="valor-1" id="valor-1" readonly/></td>
                                             <td rowspan="2" style="width: 15%;"><input type="text" class="form-control" name="comentarios-1" id="comentarios-1" /></td>
                                          </tr>
                                          <tr>
                                             <td>N° Investigaciones en el ámbito nacional sobre Gestión del Riesgo de
                                                Desastres programadas en el año</td>
                                             <td>DENOMINADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-2" id="matriz-2" /></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="4">3000740. SERVICIOS PUBLICOS SEGUROS ANTE EMERGENCIAS Y
                                                DESASTRES</td>
                                             <td rowspan="2">5005570. DESARROLLO DE ESTUDIOS DE VULNERABILIDAD Y RIESGO
                                                EN SERVICIOS PUBLICOS</td>
                                             <td>N° Documentos técnicos sobre Vulnerabilidad y Riesgo en Servicios
                                                Públicos (ISH/formulario de evaluación y/o la ficha simplificada)
                                                elaborados en el año</td>
                                             <td>NUMERADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-3" id="matriz-3" /></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="valor-2" id="valor-2" readonly/></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="comentarios-2" id="comentarios-2" /></td>
                                          </tr>
                                          <tr>
                                             <td>N° Documentos técnicos sobre Vulnerabilidad y Riesgo en Servicios
                                                Públicos (ISH/formulario de evaluación y/o la ficha simplificada)
                                                programados en el año</td>
                                             <td>DENOMINADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-4" id="matriz-4" /></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="2">5005585. SEGURIDAD FISICO FUNCIONAL DE SERVICIOS PUBLICOS
                                             </td>
                                             <td>N° Intervenciones de mantenimiento y reparación de líneas vitales y/o
                                                elementos arquitectónicos realizados en el año</td>
                                             <td>NUMERADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-5" id="matriz-5" /></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="valor-3" id="valor-3" readonly/></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="comentarios-3" id="comentarios-3" /></td>
                                          </tr>
                                          <tr>
                                             <td>N° Intervenciones de mantenimiento y reparación de líneas vitales y/o
                                                elementos arquitectónicos programadas en el año</td>
                                             <td>DENOMINADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-6" id="matriz-6" /></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="8">3000734. CAPACIDAD INSTALADA PARA LA PREPARACION Y
                                                RESPUESTA FRENTE A EMERGENCIAS Y DESASTRES</td>
                                             <td rowspan="2">5005612. DESARROLLO DE LOS CENTROS Y ESPACIOS DE MONITOREO
                                                DE EMERGENCIAS Y DESASTRES</td>
                                             <td>N° Reportes mensuales elaborados por los EMED en el año</td>
                                             <td>NUMERADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-7" id="matriz-7" /></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="valor-4" id="valor-4" readonly/></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="comentarios-4" id="comentarios-4" /></td>
                                          </tr>
                                          <tr>
                                             <td>N° Reportes a elaborar por los EMED programados en el año</td>
                                             <td>DENOMINADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-8" id="matriz-8" /></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="2">5005560. DESARROLLO DE SIMULACROS EN GESTION REACTIVA</td>
                                             <td>N° Reportes de simulacros y/o simulaciones ejecutados en el año</td>
                                             <td>NUMERADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-9" id="matriz-9" /></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="valor-5" id="valor-5" readonly/></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="comentarios-5" id="comentarios-5" /></td>
                                          </tr>
                                          <tr>
                                             <td>N° Reportes de simulacros y/o simulaciones programado en el año</td>
                                             <td>DENOMINADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-10" id="matriz-10" /></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="2">5005610. ADMINISTRACION Y ALMACENAMIENTO DE INFRAESTRUCTURA
                                                MOVIL PARA LA ASISTENCIA FRENTE A EMERGENCIAS Y DESASTRES</td>
                                             <td>N° Infraestructura móvil adquirida en el año</td>
                                             <td>NUMERADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-11" id="matriz-11" /></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="valor-6" id="valor-6" readonly/></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="comentarios-6" id="comentarios-6" /></td>
                                          </tr>
                                          <tr>
                                             <td>N° Infraestructura móvil programada en el año</td>
                                             <td>DENOMINADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-12" id="matriz-12" /></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="2">5005561. IMPLEMENTACION DE BRIGADAS PARA LA ATENCION FRENTE
                                                A EMERGENCIAS Y DESASTRES</td>
                                             <td>N° Brigadas conformadas (entrenadas, capacitadas e implementadas) para
                                                emergencias y<br> desastres en el año</td>
                                             <td>NUMERADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-13" id="matriz-13" /></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="valor-7" id="valor-7" readonly/></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="comentarios-7" id="comentarios-7" /></td>
                                          </tr>
                                          <tr>
                                             <td>N° Brigadas programadas a conformar en el año</td>
                                             <td>DENOMINADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-14" id="matriz-14" /></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="2">3000739. POBLACION CON PRACTICAS SEGURAS PARA LA
                                                RESILIENCIA</td>
                                             <td rowspan="2">5005583. ORGANIZACION Y ENTRENAMIENTO DE COMUNIDADES EN
                                                HABILIDADES FRENTE AL RIESGO DE DESASTRES</td>
                                             <td>N° Personas entrenadas en el año</td>
                                             <td>NUMERADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-15" id="matriz-15" /></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="valor-8" id="valor-8" readonly/></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="comentarios-8" id="comentarios-8" /></td>
                                          </tr>
                                          <tr>
                                             <td>N° Personas para entrenamiento programadas en el año</td>
                                             <td>DENOMINADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-23" id="matriz-23" /></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="2">3000738. PERSONAS CON FORMACION Y CONOCIMIENTO EN GESTION
                                                DEL RIESGO DE DESASTRES Y ADAPTACION AL CAMBIO CLIMATICO</td>
                                             <td rowspan="2">5005580. FORMACION Y CAPACITACION EN MATERIA DE GESTION DE
                                                RIESGO DE DESASTRES Y ADAPTACION AL CAMBIO CLIMATICO</td>
                                             <td>N° Personas capacitadas en el año en temas de gestión de riesgo de
                                                desastres y/o adaptación al cambio climático con certificado</td>
                                             <td>NUMERADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-21" id="matriz-21" /></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="valor-9" id="valor-9" readonly/></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="comentarios-9" id="comentarios-9" /></td>
                                          </tr>
                                          <tr>
                                             <td>N° Personas programadas en el año para capacitación en temas de gestión
                                                de riesgo de desastres y/o adaptación al cambio climático</td>
                                             <td>DENOMINADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-22" id="matriz-22" /></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="6">3000001. ACCIONES COMUNES</td>
                                             <td rowspan="2">5005609. ASISTENCIA TECNICA Y ACOMPAÑAMIENTO EN GESTION DEL
                                                RIESGO DE DESASTRES</td>
                                             <td>N° Asistencias técnicas realizadas en el año</td>
                                             <td>NUMERADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-16" id="matriz-16" /></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="valor-10" id="valor-10" readonly/></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="comentarios-10" id="comentarios-10" /></td>
                                          </tr>
                                          <tr>
                                             <td>N° Asistencias técnicas programadas en el año</td>
                                             <td>DENOMINADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-24" id="matriz-24" /></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="2">5004279. MONITOREO,SUPERVISION Y EVALUACION DE PRODUCTOS Y
                                                ACTIVIDADES EN GESTION DE RIESGO DE DESASTRES</td>
                                             <td>N° Monitoreos, supervisiones, y evaluaciones ejecutadas en el año</td>
                                             <td>NUMERADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-17" id="matriz-17" /></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="valor-11" id="valor-11" readonly/></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="comentarios-11" id="comentarios-11" /></td>
                                          </tr>
                                          <tr>
                                             <td>N° Monitoreos, supervisiones, y evaluaciones programadas en el año</td>
                                             <td>DENOMINADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-18" id="matriz-18" /></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="2">5004280. DESARROLLO DE INSTRUMENTOS ESTRATEGICOS PARA LA
                                                GESTION DEL RIESGO DE DESASTRES</td>
                                             <td>N° de Planes de contingencia/respuesta/operaciones realizados en el año
                                                con Resolución</td>
                                             <td>NUMERADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-19" id="matriz-19" /></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="valor-12" id="valor-12" readonly/></td>
                                             <td rowspan="2"><input type="text" class="form-control" name="comentarios-12" id="comentarios-12" /></td>
                                          </tr>
                                          <tr>
                                             <td>N° de Planes de contingencia/respuesta/operaciones programados en el
                                                año</td>
                                             <td>DENOMINADOR</td>
                                             <td><input type="text" class="form-control" name="matriz-20" id="matriz-20" /></td>
                                          </tr>
                                       </tbody>
                                    </table>
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
               <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTablero">
                  <div class="modal-dialog" role="document">
                     <form action="<?=base_url()?>indicadoresppr/anuindicadores" method="POST">
                        <input type="hidden" name="idregistro" id="idregistro" value="" readonly />
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
   <script src="<?=base_url()?>public/js/comando/main.js?v=<?=date("his")?>"></script>
</body>

</html>