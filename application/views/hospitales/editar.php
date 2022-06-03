<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?=TITULO_PRINCIPAL?></title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="<?=AUTOR?>">
  <?php $this->load->view("inc/resources"); ?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>public/css/hospitales/nuevo.css?v=<?=date("his")?>" />
  <?php $titulo = "Edición de la ficha de evaluación de situación de los servicios de Emergencia"; ?>
</head>

<body>

  <div class="wrapper theme-2-active horizontal-nav navbar-top-blue">

    <?php $this->load->view("inc/nav"); ?>

    <div class="page-wrapper" style="min-height: 710px;">
      <div class="container pt-30">
        <div class="row heading-bg">
          <div class="col-sm-9 col-xs-12">
            <h5 class="txt-dark"><?=$titulo?></h5>
          </div>
          <!-- Breadcrumb -->
          <div class="col-md-3 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="<?=base_url()?>">Inicio</a></li>
              <li><a href="<?=base_url()?>hospitales"><span>Fichas</span></a></li>
              <li class="active"><span>Editar</span></li>
            </ol>
          </div>

        </div>
        <!-- Row -->
        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-xs-12">
                <div class="panel panel-default card-view pa-0">
                  <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-10">
                      <div class="container-fluid">
                        <div class="col-xs-12 col-sm-10 col-sm-offset-1">

                          <div id="message" class="col-xs-12"></div>


                          <div class="clearfix"></div>
                          <br /> <br />
                          <form id="formHospital" name="formHospital" method="POST" action="" autocomplete="off">
                            <input type="hidden" id="id" name="id" value="<?=$hospital->id?>">
                            
                            <div class="row">
                              <h2 class="text-divider"><span>SELECCIONE IPRESS Y/O REGIÓN PRIORIZADA</span></h2>
                              <div class="row">
                                <?php if($hospital->tipo == 1){ ?>
                                  <div class="form-group col-sm-5">
                                    <label class="col-sm-12 pl-0">IPRESS</label>
                                    <select class="form-control" name="ipress" id="ipress">
                                      <option value="">-- Seleccione --</option>
                                      <?php foreach($hospitales as $row): ?>
                                      <!-- <option value="<?=$row->id?>"><?=$row->hospitales_situaciones_nombre?></option>-->
                                      <option value="<?=$row->id?>" <?=($row->id==$hospital->hospitales_situaciones_nombre_id)?"selected":""?>><?=$row->hospitales_situaciones_nombre?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                                <?php } ?>
                                <?php if($hospital->tipo == 0){ ?>
                                  <div class="form-group col-sm-7">
                                    <label class="col-sm-12 pl-0">REGIÓN</label>
                                    <select class="form-control" name="region" id="region">
                                      <option value="">-- Regi&oacute;n --</option>
                                      <?php foreach($listaRegiones as $row): ?>
                                      <!--<option value="<?=$row->Codigo_Region?>"><?=$row->Nombre_Region?></option>-->
                                      <option value="<?=$row->Codigo_Region?>" <?=($row->Codigo_Region==$hospital->codigo_region)?"selected":""?>><?=$row->Nombre_Region?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                                <?php } ?>
                                <div class="form-group col-sm-5">
                                  <label class="col-sm-12 pl-0">FECHA REGISTRO</label>
                                  <div class='input-group date' id="datetimepicker">
                                    <input type="text" class="form-control" name="fechaRegistro" id="fechaRegistro" value="<?=$hospital->fecha_reporte?>"/>
                                    <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
                                  </div>
                                </div>
                              </div>
                              <br>
                              <h2 class="text-divider"><span>Responsable de la Información - Encargado del EMED Salud (Aplicado según Directiva Administrativa 250-2018 MINSA/DIGERD)</span></h2>
                              <div class="row">
                                <div class="col-xs-6">						
                                  <div class="form-group row">
                                    <div class="col-sm-9">
                                      <label class="col-sm-6">Tip. Documento:</label>
                                      <select class="form-control" name="emed_tipo_documento" rel="<?=$hospital->emed_tipo_documento?>" id="emed_tipo_documento">
                                        <option value="">-- SELECCIONE --</option>
                                        <option value="01" <?=("01"==$hospital->emed_tipo_documento)?"selected":""?>>DNI</option>
                                        <option value="03" <?=("02"==$hospital->emed_tipo_documento)?"selected":""?>>CARNET DE EXTRANJERÍA</option>
                                        <option value="06" <?=("06"==$hospital->emed_tipo_documento)?"selected":""?>>[N/A]]</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group row">
                                    <div class="col-sm-9">
                                      <div class="input-group" id="error_numero_documento">
                                        <label class="col-sm-6">Nro. Documento:</label>
                                        <input id="dni_responsable_reporte" name="dni_responsable_reporte" class="form-control" type="text" value="<?=$hospital->emed_dni?>"/>
                                        <label class="col-sm-10"> <br /></label>
                                        <span class="input-group-btn">
                                          <button type="button" id="btn-buscarr" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-12">						
                                  <div class="form-group row">
                                    <div class="col-sm-12">
                                      <label class="col-sm-6">Nombres y Apellidos</label>
                                      <input id="responsable_reporte" name="responsable_reporte"
                                        class="form-control text-uppercase" type="text" value="<?=$hospital->emed_nombre?>" readonly/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-5">						
                                  <div class="form-group row">
                                    <label class="modal-label col-sm-3 col-form-label py-10">Ocupación:</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="ocupacion_responsable_reporte" rel="<?=$hospital->emed_ocupacion?>" id="ocupacion_responsable_reporte">
                                        <option value="">-- SELECCIONE --</option>
                                        <option value="1" <?=("1"==$hospital->emed_ocupacion)?"selected":""?>>MÉDICO</option>
                                        <option value="2" <?=("2"==$hospital->emed_ocupacion)?"selected":""?>>ENFERMERA</option>
                                        <option value="4" <?=("4"==$hospital->emed_ocupacion)?"selected":""?>>TEC. ENFERMERÍA</option>
                                        <option value="5" <?=("5"==$hospital->emed_ocupacion)?"selected":""?>>CIRUJANO DENTISTA</option>
                                        <option value="6" <?=("6"==$hospital->emed_ocupacion)?"selected":""?>>OBSTETRA</option>
                                        <option value="3" <?=("3"==$hospital->emed_ocupacion)?"selected":""?>>OTROS</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xs-7">						
                                  <div class="form-group row">
                                    <label class="modal-label col-sm-5 col-form-label py-10">Teléfono:</label>
                                    <div class="col-sm-7">
                                      <div class="form-group">
                                        <div>
                                          <input type="text" class="form-control" name="telefono_responsable_reporte" id="telefono_responsable_reporte" value="<?=$hospital->emed_telefono?>" /> 
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <h2 class="text-divider"><span>Jefe de Guardia (Supervisor)</span></h2>
                              <div class="row">
                               <div class="col-xs-6">						
                                  <div class="form-group row">
                                    <div class="col-sm-9">
                                      <label class="col-sm-6">Tip. Documento:</label>
                                      <select class="form-control" name="supervidor_tipo_documento" rel="<?=$hospital->emed_ocupacion?>" id="supervidor_tipo_documento">
                                        <option value="">-- SELECCIONE --</option>
                                        <option value="01" <?=("01"==$hospital->emed_tipo_documento)?"selected":""?>>DNI</option>
                                        <option value="03" <?=("02"==$hospital->emed_tipo_documento)?"selected":""?>>CARNET DE EXTRANJERÍA</option>
                                        <option value="06" <?=("06"==$hospital->emed_tipo_documento)?"selected":""?>>[N/A]]</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group row">
                                    <div class="col-sm-9">
                                      <div class="input-group" id="error_numero_documento">
                                        <label class="col-sm-6">Nro. Documento:</label>
                                        <input id="dni_jefe_guardia" name="dni_jefe_guardia" class="form-control" type="text" value="<?=$hospital->supervisor_dni?>"/>
                                        <label class="col-sm-10"> <br /></label>
                                        <span class="input-group-btn">
                                        <button type="button" id="btn-buscarj" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-12">						
                                  <div class="form-group row">
                                    <div class="col-sm-12">
                                      <label class="col-sm-6">Nombres y Apellidos</label>
                                      <input id="jefe_guardia" name="jefe_guardia"
                                        class="form-control text-uppercase" type="text" value="<?=$hospital->supervisor_nombre?>" readonly/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-5">						
                                  <div class="form-group row">
                                    <label class="modal-label col-sm-3 col-form-label py-10">Ocupación:</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="ocupacion_jefe_guardia" rel="<?=$hospital->supervisor_ocupacion?>" id="ocupacion_jefe_guardia">
                                        <!--<option value="">-- SELECCIONE --</option>-->
                                        <option value="1" <?=("1"==$hospital->supervisor_ocupacion)?"selected":""?>>MÉDICO</option>
                                        <!--<option value="2" <?=("2"==$hospital->supervisor_ocupacion)?"selected":""?>>ENFERMERA</option>-->
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xs-7">						
                                  <div class="form-group row">
                                    <label class="modal-label col-sm-5 col-form-label py-10">Teléfono:</label>
                                    <div class="col-sm-7">
                                      <div class="form-group">
                                        <div>
                                          <input type="text" class="form-control" name="telefono_jefe_guardia" id="telefono_jefe_guardia" value="<?=$hospital->supervisor_telefono?>"/> 
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--
                              <h2 class="text-divider"><span>Atención en triaje diferenciado</span></h2>
                              
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="checkbox checkbox-primary">
                                    <input id="atencionInterna" type="checkbox" name="atencionInterna">
                                    <label for="atencionInterna">
                                      Área Interna
                                    </label>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="checkbox checkbox-primary">
                                    <input id="atencionExterna" type="checkbox" name="atencionExterna">
                                    <label for="atencionExterna">
                                      Área Externa (PMA u Oferta Móvil)
                                    </label>
                                  </div>
                                </div>
                              </div>-->
                              <br>
                              <div id="hospital__tabs">	
                                <ul class="nav nav-tabs">
                                  <li class="active">
                                    <a href="#1" data-toggle="tab">Camas Hospitalarias</a>
                                  </li>
                                  <li>
                                    <a href="#2" data-toggle="tab">Servicio de Emergencia</a>
                                  </li>
                                  <li>
                                    <a href="#3" data-toggle="tab">UCI Adultos</a>
                                  </li>
                                  <li>
                                    <a href="#4" data-toggle="tab">UCI Pediátricos</a>
                                  </li>
                                  <li>
                                    <a href="#5" data-toggle="tab">INDICES DE SOBRESATURACIÓN</a>
                                  </li>
                                </ul>
                                <div class="tab-content">
                                  <div class="tab-pane active" id="1">
                                    <div>
                                      <label class="modal-label col-sm-8 col-form-label py-10">
                                      <br />
                                      <label class="span__bold"> SOBRESATURACIÓN DE CAMAS HOSPITALARIAS  (NO UCI, NO EMERGENCIA)</label>
                                      </label>
                                      <br /><br />                                   
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> HABILITADA </b>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> EN USO </b>
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <!--<label class="modal-label col-sm-6 col-form-label py-10 span__bold">-->
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                              <label class="span__bold">CAMAS DE HOSPITALIZACIÓN PARA NO COVID 19 CONVENCIONALES</label>
                                              <!--<a href="#" data-toggle="tooltip" data-placement="top" 
                                                title="(Camas registradas por OGTI, Todas las camas iniciales de hospitalización permanente de todo paciente NO COVID 19)"> 
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                              </a>-->
                                              (Camas registradas por OGTI, Todas las camas iniciales de hospitalización permanente de todo paciente NO COVID 19)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_convencionales_h" id="hospitalizacion_convencionales_h" value="<?=$hospital->hospitalizacion_convencionales_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_convencionales_u" id="hospitalizacion_convencionales_u" value="<?=$hospital->hospitalizacion_convencionales_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Interna: (B)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA HOSPITALIZACIÓN NO COVID 19</label> <br/>
                                          (Incluye camas en áreas de expansión interna o externa en otros EESS o Nosocomios y/o áreas de expansión convertidas para  Hospitalización NO COVID 19)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_covid_h" id="hospitalizacion_covid_h" value="<?=$hospital->hospitalizacion_covid_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Pabellones convertidos para COVID-19</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_covid_u" id="hospitalizacion_covid_u" value="<?=$hospital->hospitalizacion_covid_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA HOSPITALIZACIÓN COVID 19 , EN EXPANSIÓN INTERNA </label> <br/>
                                          (Pabellos convertidos para COVID 19, Camas de Hospitalización no considerados inicialmente para COVID 19, se tuvo que ampliar la hospitalización en servicios de Medicina, Cirugía, Traumatología, CENEX, Tropicales, etc.)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_e_interna_h" id="hospitalizacion_e_interna_h" value="<?=$hospital->hospitalizacion_e_interna_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_e_interna_u" id="hospitalizacion_e_interna_u" value="<?=$hospital->hospitalizacion_e_interna_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA HOSPITALIZACIÓN COVID 19  EXPANSIÓN EXTERNA</label> <br/>
                                          (Oferta Movil, Hospitalización en áreas externas como: Shelter; Masivas, Hospital Movil, TM54, Módulos de vivienda, etc)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_e_externa_h" id="hospitalizacion_e_externa_h" value="<?=$hospital->hospitalizacion_e_externa_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_e_externa_u" id="hospitalizacion_e_externa_u" value="<?=$hospital->hospitalizacion_e_externa_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <div class="col-sm-6">
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <div class="form-group" style="text-align: center;">
                                                  <span class="span__bold"> CAMAS HOSPITALARIAS DISPONIBLES AL MOMENTO </span>
                                                  <div>  
                                                    <input type="number" class="form-control" name="hospitalizacion_disponibles" id="hospitalizacion_disponibles" value="<?=$hospital->hospitalizacion_disponibles?>" readonly/> 
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> HABILITADAS TOTALES </span>
                                              <div>  
                                                <input type="number" class="form-control" name="hospitalizacion_total_h" id="hospitalizacion_total_h" value="<?=$hospital->hospitalizacion_total_h?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!-- <label>(*) A + B + C</label>-->
                                            <div class="form-group" style="text-align: center;">
                                              <span class="span__bold">HABILITADAS EN USO</span>
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_total_u" id="hospitalizacion_total_u" value="<?=$hospital->hospitalizacion_total_u?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> Sobresaturación en Hospitalización </span>
                                              <div>  
                                                <input type="number" class="form-control" name="hospitalizacion_porcentaje_01" id="hospitalizacion_porcentaje_01" value="<?=$hospital->hospitalizacion_porcentaje_01?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div>
                                      <hr />
                                    </div>
                                    <div>                                      
                                      <label class="modal-label col-sm-8 col-form-label py-10">
                                      <br />
                                      <label class="span__bold"> SOBRESATURACIÓN  DE CAMAS HOSPITALARIAS (NO UCI. NO EMERGENCIA) POR COVID 19</label>
                                      </label>
                                      <br /><br /><br /><br />  
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> HABILITADA </b>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> EN USO </b>
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                          <label class="span__bold">CAMAS EN HOSPITALILZACIÓN PARA COVID 19 (INCLUYE SOSPECHOSOS Y CONFIRMADOS)</label>
                                            (Corresponde a las camas de hospitalización consideradas inicialmente para atencion x COVID)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_sospechosos_h_covid" id="hospitalizacion_sospechosos_h_covid" value="<?=$hospital->hospitalizacion_sospechosos_h_covid?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_sospechosos_u_covid" id="hospitalizacion_sospechosos_u_covid" value="<?=$hospital->hospitalizacion_sospechosos_u_covid?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Interna: (B)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA HOSPITALIZACIÓN COVID 19, EN EXPANSIÓN INTERNA</label> <br/>
                                          (Pabellos convertidos para COVID 19, Camas de Hospitalización no considerados inicialmente para COVID 19, se tuvo que ampliar la hospitalización en servicios de Medicina, Cirugía, Traumatología, CENEX, Tropicales, etc.)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_e_interna_h_covid" id="hospitalizacion_e_interna_h_covid" value="<?=$hospital->hospitalizacion_e_interna_h_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Pabellones convertidos para COVID-19</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_e_interna_u_covid" id="hospitalizacion_e_interna_u_covid" value="<?=$hospital->hospitalizacion_e_interna_u_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA HOSPITALIZACIÓN COVID 19  EXPANSIÓN EXTERNA</label> <br/>
                                          (Oferta Movil, Hospitalización en áreas externas como: Shelter; Masivas, Hospital Movil, TM54, Módulos de vivienda, etc)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_e_externa_h_covid" id="hospitalizacion_e_externa_h_covid" value="<?=$hospital->hospitalizacion_e_externa_h_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_e_externa_u_covid" id="hospitalizacion_e_externa_u_covid" value="<?=$hospital->hospitalizacion_e_externa_u_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <div class="col-sm-6">
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <div class="form-group" style="text-align: center;">
                                                  <span class="span__bold"> CAMAS HOSPITALARIAS COVID 19 DISPONIBLES AL MOMENTO </span>
                                                  <div>  
                                                    <input type="number" class="form-control" name="hospitalizacion_disponibles_covid" id="hospitalizacion_disponibles_covid" value="<?=$hospital->hospitalizacion_disponibles_covid?>" readonly/> 
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> HABILITADAS TOTALES </span>
                                              <div>  
                                                <input type="number" class="form-control" name="hospitalizacion_total_h_covid" id="hospitalizacion_total_h_covid" value="<?=$hospital->hospitalizacion_total_h_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!-- <label>(*) A + B + C</label>-->
                                            <div class="form-group" style="text-align: center;">
                                              <span class="span__bold">HABILITADAS EN USO</span>
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_total_u_covid" id="hospitalizacion_total_u_covid" value="<?=$hospital->hospitalizacion_total_u_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> Sobresaturación en Hospitalización </span>
                                              <div>  
                                                <input type="number" class="form-control" name="hospitalizacion_porcentaje_02" id="hospitalizacion_porcentaje_02" value="<?=$hospital->hospitalizacion_porcentaje_02?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="tab-pane" id="2">
                                    <div>
                                      <label class="modal-label col-sm-8 col-form-label py-10">
                                      <br />
                                      <label class="span__bold"> SOBRESATURACIÓN DE CAMAS DEL SERVICIO DE EMERGENCIA ADULTOS</label>
                                      </label>
                                      <br /><br />                                   
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> HABILITADA </b>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> EN USO </b>
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <!--<label class="modal-label col-sm-6 col-form-label py-10 span__bold">-->
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                              <label class="span__bold">CAMAS DE EMERGENCIAS PARA NO COVID 19 CONVENCIONALES</label>
                                              <!--<a href="#" data-toggle="tooltip" data-placement="top" 
                                                title="(Camas registradas por OGTI, Todas las camas iniciales de hospitalización permanente de todo paciente NO COVID 19)"> 
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                              </a>-->
                                              (Todas las camas iniciales; Camillas de Emergencias Adulto de todo paciente NO COVID 19)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_convencionales_h" id="emergencia_convencionales_h" value="<?=$hospital->emergencia_convencionales_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_convencionales_u" id="emergencia_convencionales_u" value="<?=$hospital->emergencia_convencionales_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Interna: (B)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA EMERGENCIA ADULTOS PARA NO COVID 19</label> <br/>
                                          (Convertidos para NO COVID 19; son las Camas de Emergencia No COVID 19, fuera del servicio de emergencia )
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_covid_h" id="emergencia_covid_h" value="<?=$hospital->emergencia_covid_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Pabellones convertidos para COVID-19</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_covid_u" id="emergencia_covid_u" value="<?=$hospital->emergencia_covid_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA EMERGENCIA ADULTO COVID 19 , EN EXPANSIÓN INTERNA</label> <br/>
                                          (Convertidos para COVID 19; considerar camas que se tuvo que ampliar en espacios del servicios de emergencia como Cirugía, Traumatologia, etc; a cargo del servicio de Emergencia)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_e_interna_h" id="emergencia_e_interna_h" value="<?=$hospital->emergencia_e_interna_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_e_interna_u" id="emergencia_e_interna_u" value="<?=$hospital->emergencia_e_interna_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA EMERGENCIAS ADULTOS COVID 19  EN EXPANSIÓN EXTERNA</label> <br/>
                                          (Oferta Movil; camillas habilitadas en areas de expansion externa para el Servicio de Emergencia Adultos; como Shelter; Masivas, Hospital Movil, TM54, Módulos de vivienda)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_e_externa_h" id="emergencia_e_externa_h" value="<?=$hospital->emergencia_e_externa_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_e_externa_u" id="emergencia_e_externa_u" value="<?=$hospital->emergencia_e_externa_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">PACIENTES EN ESPERA DE CAMAS QUE REQUIEREN HOSPITALIZACION</label> <br/>
                                          Pacientes ingresados en pasillos (sillas de ruedas, camillas, bancas, etc.) que requieren hospitalización
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_espera_u" id="emergencia_espera_u" value="<?=$hospital->emergencia_espera_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <div class="col-sm-6">
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <div class="form-group" style="text-align: center;">
                                                  <span class="span__bold"> CAMAS PARA ATENCION DE EMERGENCIA DISPONIBLES AL MOMENTO </span>
                                                  <div>  
                                                    <input type="number" class="form-control" name="emergencia_disponibles" id="emergencia_disponibles" value="<?=$hospital->emergencia_disponibles?>" readonly/> 
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> HABILITADAS TOTALES </span>
                                              <div>  
                                                <input type="number" class="form-control" name="emergencia_total_h" id="emergencia_total_h" value="<?=$hospital->emergencia_total_h?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!-- <label>(*) A + B + C</label>-->
                                            <div class="form-group" style="text-align: center;">
                                              <span class="span__bold">HABILITADAS EN USO</span>
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_total_u" id="emergencia_total_u" value="<?=$hospital->emergencia_total_u?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> SOBRESATURACIÓN DEL SERVICIO DE EMERGENCIA </span>
                                              <div>  
                                                <input type="number" class="form-control" name="emergencia_porcentaje_01" id="emergencia_porcentaje_01" value="<?=$hospital->emergencia_porcentaje_01?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div>
                                      <hr />
                                    </div>
                                    <div>                                      
                                      <label class="modal-label col-sm-8 col-form-label py-10">
                                      <br />
                                      <label class="span__bold"> SOBRESATURACIÓN  DE CAMAS DEL SERVICIO DE EMERGENCIA ADULTOS POR COVID 19</label>
                                      </label>
                                      <br /><br /><br /><br />  
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> HABILITADA </b>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> EN USO </b>
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                          <label class="span__bold">CAMAS DE EMERGENCIA ADULTO PARA COVID 19 (INCLUYE SOSPECHOSOS Y CONFIRMADOS)</label>
                                            (Camas consideradas inicialmente para manejo de pacientes COVID 19 en Servicio de Emergencia adultos)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_sospechosos_h_covid" id="emergencia_sospechosos_h_covid" value="<?=$hospital->emergencia_sospechosos_h_covid?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_sospechosos_u_covid" id="emergencia_sospechosos_u_covid" value="<?=$hospital->emergencia_sospechosos_u_covid?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Interna: (B)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA EMERGENCIA ADULTO COVID 19 , EN EXPANSIÓN INTERNA</label> <br/>
                                          (Convertidos para COVID 19; considerar camas que se tuvo que ampliar en espacios del servicios de emergencia como Cirugía, Traumatologia, etc; a cargo del servicio de Emergencia)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_e_interna_h_covid" id="emergencia_e_interna_h_covid" value="<?=$hospital->emergencia_e_interna_h_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Pabellones convertidos para COVID-19</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_e_interna_u_covid" id="emergencia_e_interna_u_covid" value="<?=$hospital->emergencia_e_interna_u_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA EMERGENCIAS ADULTOS COVID 19 EN EXPANSIÓN EXTERNA</label> <br/>
                                          (Oferta Movil; camillas habilitadas en areas de expansion externa para el Servicio de Emergencia Adultos; como Shelter; Masivas, Hospital Movil, TM54, Módulos de vivienda)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_e_externa_h_covid" id="emergencia_e_externa_h_covid" value="<?=$hospital->emergencia_e_externa_h_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_e_externa_u_covid" id="emergencia_e_externa_u_covid" value="<?=$hospital->emergencia_e_externa_u_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Interna: (B)-->
                                          <label class="span__bold">PACIENTES EN ESPERA DE CAMAS QUE REQUIEREN HOSPITALIZACION EN AREA COVID</label> <br/>
                                          Pacientes ingresados en pasillos  del Servicio de Emergencia u otras areas (sillas de ruedas, camillas, bancos, etc.) que requiren hospitalacion en area COVID
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Pabellones convertidos para COVID-19</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_espera_u_covid" id="emergencia_espera_u_covid" value="<?=$hospital->emergencia_espera_u_covid?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <div class="col-sm-6">
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <div class="form-group" style="text-align: center;">
                                                  <span class="span__bold"> CAMAS PARA ATENCION COVID 19 EN EMERGENCIAS DISPONIBLES AL MOMENTO </span>
                                                  <div>  
                                                    <input type="number" class="form-control" name="emergencia_disponibles_covid" id="emergencia_disponibles_covid" value="<?=$hospital->emergencia_disponibles_covid?>" readonly/> 
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> HABILITADAS TOTALES </span>
                                              <div>  
                                                <input type="number" class="form-control" name="emergencia_total_h_covid" id="emergencia_total_h_covid" value="<?=$hospital->emergencia_total_h_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!-- <label>(*) A + B + C</label>-->
                                            <div class="form-group" style="text-align: center;">
                                              <span class="span__bold">HABILITADAS EN USO</span>
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_total_u_covid" id="emergencia_total_u_covid" value="<?=$hospital->emergencia_total_u_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> SOBRESATURACIÓN POR COVID DEL SERVICIO DE EMERGENCIA </span>
                                              <div>  
                                                <input type="number" class="form-control" name="emergencia_porcentaje_02" id="emergencia_porcentaje_02" value="<?=$hospital->emergencia_porcentaje_02?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="tab-pane" id="3">
                                    <div>
                                      <label class="modal-label col-sm-8 col-form-label py-10">
                                      <br />
                                      <label class="span__bold"> SOBRESATURACIÓN DE CAMAS DEL SERVICIO DE CUIDADOS CRITICOS ADULTOS </label>
                                      </label>
                                      <br /><br />                                   
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> HABILITADA </b>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> EN USO </b>
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <!--<label class="modal-label col-sm-6 col-form-label py-10 span__bold">-->
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                              <label class="span__bold">CAMAS DE UCI ADULTO PARA NO COVID 19 CONVENCIONALES</label>
                                              <!--<a href="#" data-toggle="tooltip" data-placement="top" 
                                                title="(Camas registradas por OGTI, Todas las camas iniciales de hospitalización permanente de todo paciente NO COVID 19)"> 
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                              </a>-->
                                              (Todas las camas iniciales, considerar aquellas camas de UCI Adulto de todo paciente NO COVID 19)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_convencionales_h" id="criticos_convencionales_h" value="<?=$hospital->criticos_convencionales_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_convencionales_u" id="criticos_convencionales_u" value="<?=$hospital->criticos_convencionales_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Interna: (B)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA UCI Adulto NO COVID 19</label> <br/>
                                          (Considerar en EESS o Nosocomios convertidos para UCI NO COVID 19; fuera de la institución)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_covid_h" id="criticos_covid_h" value="<?=$hospital->criticos_covid_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Pabellones convertidos para COVID-19</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_covid_u" id="criticos_covid_u" value="<?=$hospital->criticos_covid_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA UCI Adulto COVID 19 , EN EXPANSIÓN INTERNA </label> <br/>
                                          (Pabellones convertidos para UCI COVID 19; considerar camas que se tuvieron que ampliar para unidades de UCI COVID, por ejemplo de Cirugía, Cardiología, Traumatologia, etc)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_e_interna_h" id="criticos_e_interna_h" value="<?=$hospital->criticos_e_interna_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_e_interna_u" id="criticos_e_interna_u" value="<?=$hospital->criticos_e_interna_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA UCI Adulto COVID 19, EN EXPANSIÓN EXTERNA</label> <br/>
                                          (Oferta Movil; UCI Adulto COVID en áreas de expansión externas como: Shelter; Masivas, Hospital Movil, TM54, Módulos de vivienda )
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_e_externa_h" id="criticos_e_externa_h" value="<?=$hospital->criticos_e_externa_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_e_externa_u" id="criticos_e_externa_u" value="<?=$hospital->criticos_e_externa_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">PACIENTES NO COVID CON NECESIDAD DE SERVICIOS DE UCI</label> <br/>
                                          (Considerar pacientes que requieren de los servicios de UCI;  en espera de cama procedentes del Servicio de Emergencia u hospitalización)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_espera_u" id="criticos_espera_u" value="<?=$hospital->criticos_espera_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <div class="col-sm-6">
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <div class="form-group" style="text-align: center;">
                                                  <span class="span__bold"> CAMAS UCI ADULTOS DISPONIBLES AL MOMENTO </span>
                                                  <div>  
                                                    <input type="number" class="form-control" name="criticos_disponibles" id="criticos_disponibles" value="<?=$hospital->criticos_disponibles?>" readonly/> 
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> HABILITADAS TOTALES </span>
                                              <div>  
                                                <input type="number" class="form-control" name="criticos_total_h" id="criticos_total_h" value="<?=$hospital->criticos_total_h?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!-- <label>(*) A + B + C</label>-->
                                            <div class="form-group" style="text-align: center;">
                                              <span class="span__bold">HABILITADAS EN USO</span>
                                              <div>
                                                <input type="number" class="form-control" name="criticos_total_u" id="criticos_total_u" value="<?=$hospital->criticos_total_u?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> SOBRESATURACIÓN DEL SERVICIO DE CUIDADOS CRITICOS ADULTOS </span>
                                              <div>  
                                                <input type="number" class="form-control" name="criticos_porcentaje_01" id="criticos_porcentaje_01" value="<?=$hospital->criticos_porcentaje_01?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div>
                                      <hr />
                                    </div>
                                    <div>                                      
                                      <label class="modal-label col-sm-8 col-form-label py-10">
                                      <br />
                                      <label class="span__bold"> SOBRESATURACIÓN DE CAMAS DEL SERVICIO DE CUIDADOS CRITICOS ADULTOS POR COVID 19 </label>
                                      </label>
                                      <br /><br /><br /><br />  
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> HABILITADA </b>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> EN USO </b>
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                          <label class="span__bold">CAMAS DE UCI ADULTO PARA COVID 19 (INCLUYE SOSPECHOSOS Y CONFIRMADOS)</label>
                                          (Camas UCI adulto consideradas inicialmente para la atencion de pacientes que requieren UCI COVID)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_sospechosos_h_covid" id="criticos_sospechosos_h_covid" value="<?=$hospital->criticos_sospechosos_h_covid?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_sospechosos_u_covid" id="criticos_sospechosos_u_covid" value="<?=$hospital->criticos_sospechosos_u_covid?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Interna: (B)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA UCI Adulto COVID 19 , EN EXPANSIÓN INTERNA</label> <br/>
                                          (Pabellones convertidos para UCI COVID 19; considerar camas que se tuvieron que ampliar para unidades de UCI COVID, por ejemplo de Cirugía, Cardiología, Traumatologia, etc)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_e_interna_h_covid" id="criticos_e_interna_h_covid" value="<?=$hospital->criticos_e_interna_h_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Pabellones convertidos para COVID-19</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_e_interna_u_covid" id="criticos_e_interna_u_covid" value="<?=$hospital->criticos_e_interna_u_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA UCI Adulto COVID 19, EN EXPANSIÓN EXTERNA</label> <br/>
                                          (Oferta Movil; UCI Adulto COVID en áreas de expansión externas como: Shelter; Masivas, Hospital Movil, TM54, Módulos de vivienda )
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_e_externa_h_covid" id="criticos_e_externa_h_covid" value="<?=$hospital->criticos_e_externa_h_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_e_externa_u_covid" id="criticos_e_externa_u_covid" value="<?=$hospital->criticos_e_externa_u_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">PACIENTES COVID CON NECESIDAD DE SERVICIOS DE UCI</label> <br/>
                                          (Considerar pacientes que requieren de los servicios de UCI COVID; en espera de cama procedentes del Servicio de Emergencia u hospitalización)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_espera_u_covid" id="criticos_espera_u_covid"  value="<?=$hospital->criticos_espera_u_covid?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <div class="col-sm-6">
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <div class="form-group" style="text-align: center;">
                                                  <span class="span__bold">CAMAS UCI ADULTOS COVID 19 DISPONIBLES AL MOMENTO</span>
                                                  <div>  
                                                    <input type="number" class="form-control" name="criticos_disponibles_covid" id="criticos_disponibles_covid"  value="<?=$hospital->criticos_disponibles_covid?>" readonly/> 
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> HABILITADAS TOTALES </span>
                                              <div>  
                                                <input type="number" class="form-control" name="criticos_total_h_covid" id="criticos_total_h_covid"  value="<?=$hospital->criticos_total_h_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!-- <label>(*) A + B + C</label>-->
                                            <div class="form-group" style="text-align: center;">
                                              <span class="span__bold">HABILITADAS EN USO</span>
                                              <div>
                                                <input type="number" class="form-control" name="criticos_total_u_covid" id="criticos_total_u_covid"  value="<?=$hospital->criticos_total_u_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> SOBRESATURACIÓN DE UCI ADULTOS COVID </span>
                                              <div>  
                                                <input type="number" class="form-control" name="criticos_porcentaje_02" id="criticos_porcentaje_02"  value="<?=$hospital->criticos_porcentaje_02?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="tab-pane" id="4">
                                    <div>
                                      <label class="modal-label col-sm-8 col-form-label py-10">
                                      <br />
                                      <label class="span__bold"> SOBRESATURACIÓN DE CAMAS DE CUIDADOS CRITICOS PEDIATRICOS </label>
                                      </label>
                                      <br /><br />                                   
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> HABILITADA </b>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> EN USO </b>
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <!--<label class="modal-label col-sm-6 col-form-label py-10 span__bold">-->
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                              <label class="span__bold">CAMAS DE UCI PEDIATRICO PARA NO COVID 19 CONVENCIONALES</label>
                                              <!--<a href="#" data-toggle="tooltip" data-placement="top" 
                                                title="(Camas registradas por OGTI, Todas las camas iniciales de hospitalización permanente de todo paciente NO COVID 19)"> 
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                              </a>-->
                                              (Todas las camas iniciales, considerar aquellas camas de UCI Pediatrico de todo paciente NO COVID 19)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_convencionales_h" id="pediatricos_convencionales_h" value="<?=$hospital->pediatricos_convencionales_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_convencionales_u" id="pediatricos_convencionales_u" value="<?=$hospital->pediatricos_convencionales_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Interna: (B)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA UCI Pediatrico NO COVID 19 </label> <br/>
                                          (Considerar en EESS o Nosocomios convertidos para UCI NO COVID 19; fuera de la institución)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_covid_h" id="pediatricos_covid_h" value="<?=$hospital->pediatricos_covid_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Pabellones convertidos para COVID-19</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_covid_u" id="pediatricos_covid_u" value="<?=$hospital->pediatricos_covid_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA UCI Pediatrico COVID 19 , EN EXPANSIÓN INTERNA </label> <br/>
                                          (Pabellones convertidos para UCI COVID 19; considerar camas que se tuvieron que ampliar para unidades de UCI COVID, por ejemplo de Cirugía, Cardiología, Traumatologia, etc)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_e_interna_h" id="pediatricos_e_interna_h" value="<?=$hospital->pediatricos_e_interna_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_e_interna_u" id="pediatricos_e_interna_u" value="<?=$hospital->pediatricos_e_interna_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA HOSPITALIZACIÓN COVID 19  EXPANSIÓN EXTERNA</label> <br/>
                                          (Oferta Movil, Hospitalización en áreas externas como: Shelter; Masivas, Hospital Movil, TM54, Módulos de vivienda, etc)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_e_externa_h" id="pediatricos_e_externa_h" value="<?=$hospital->pediatricos_e_externa_h?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_e_externa_u" id="pediatricos_e_externa_u" value="<?=$hospital->pediatricos_e_externa_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">PACIENTES PEDIATRICOS NO COVID CON NECESIDAD DE SERVICIOS DE UCI</label> <br/>
                                          (Considerar pacientes que requieren de los servicios de UCI;  en espera de cama procedentes del Servicio de Emergencia u hospitalización)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_espera_u" id="pediatricos_espera_u" value="<?=$hospital->pediatricos_espera_u?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <div class="col-sm-6">
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <div class="form-group" style="text-align: center;">
                                                  <span class="span__bold"> CAMAS UCI PEDIATRICO DISPONIBLES AL MOMENTO </span>
                                                  <div>  
                                                    <input type="number" class="form-control" name="pediatricos_disponibles" id="pediatricos_disponibles" value="<?=$hospital->pediatricos_disponibles?>" readonly/> 
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> HABILITADAS TOTALES </span>
                                              <div>  
                                                <input type="number" class="form-control" name="pediatricos_total_h" id="pediatricos_total_h" value="<?=$hospital->pediatricos_total_h?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!-- <label>(*) A + B + C</label>-->
                                            <div class="form-group" style="text-align: center;">
                                              <span class="span__bold">HABILITADAS EN USO</span>
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_total_u" id="pediatricos_total_u" value="<?=$hospital->pediatricos_total_u?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> SOBRESATURACIÓN CUIDADOS CRITICOS PEDIATRICOS </span>
                                              <div>  
                                                <input type="number" class="form-control" name="pediatricos_porcentaje_01" id="pediatricos_porcentaje_01" value="<?=$hospital->pediatricos_porcentaje_01?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div>
                                      <hr />
                                    </div>
                                    <div>                                      
                                      <label class="modal-label col-sm-8 col-form-label py-10">
                                      <br />
                                      <label class="span__bold"> SOBRESATURACIÓN DE CAMAS  DE CUIDADOS CRITICOS PEDIATRICOS POR COVID 19 </label>
                                      </label>
                                      <br /><br /><br /><br />  
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> HABILITADA </b>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <b class="span__bold"> EN USO </b>
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                          <label class="span__bold">CAMAS DE UCI ADULTO PARA COVID 19 (INCLUYE SOSPECHOSOS Y CONFIRMADOS)</label>
                                          (Camas UCI Pediatrico consideradas inicialmente para la atencion de pacientes que requieren UCI COVID)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_sospechosos_h_covid" id="pediatricos_sospechosos_h_covid" value="<?=$hospital->pediatricos_sospechosos_h_covid?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_sospechosos_u_covid" id="pediatricos_sospechosos_u_covid" value="<?=$hospital->pediatricos_sospechosos_u_covid?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Interna: (B)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA UCI Adulto COVID 19, EN EXPANSIÓN INTERNA</label> <br/>
                                          (Pabellones convertidos para UCI COVID 19; considerar camas que se tuvieron que ampliar para unidades de UCI COVID, por ejemplo de Cirugía, Cardiología, Traumatologia, etc)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_e_interna_h_covid" id="pediatricos_e_interna_h_covid" value="<?=$hospital->pediatricos_e_interna_h_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Pabellones convertidos para COVID-19</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_e_interna_u_covid" id="pediatricos_e_interna_u_covid" value="<?=$hospital->pediatricos_e_interna_u_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">CAMAS HABILITADAS PARA UCI Adulto COVID 19, EN EXPANSIÓN EXTERNA</label> <br/>
                                          (Oferta Movil; UCI Pediatrico COVID en áreas de expansión externas como: Shelter; Masivas, Hospital Movil, TM54, Módulos de vivienda)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_e_externa_h_covid" id="pediatricos_e_externa_h_covid" value="<?=$hospital->pediatricos_e_externa_h_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_e_externa_u_covid" id="pediatricos_e_externa_u_covid" value="<?=$hospital->pediatricos_e_externa_u_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <label class="modal-label col-sm-6 col-form-label py-10">
                                          <!--Camas Habilitadas para Hospitalización COVID-19 en Expansión Externa: (C)-->
                                          <label class="span__bold">PACIENTES PEDIATRICOS COVID CON NECESIDAD DE SERVICIOS DE UCI</label> <br/>
                                          (Considerar pacientes que requieren de los servicios de UCI COVID; en espera de cama procedentes del Servicio de Emergencia u hospitalización)
                                          </label>
                                          <div class="col-sm-2">
                                            <div class="form-group">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Oferta Móvil</label>-->
                                            <div class="form-group">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_espera_u_covid" id="pediatricos_espera_u_covid" value="<?=$hospital->pediatricos_espera_u_covid?>" /> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">
                                          <div class="col-sm-6">
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <div class="form-group" style="text-align: center;">
                                                  <span class="span__bold"> CAMAS UCI PEDIATRICOS COVID 19 DISPONIBLES AL MOMENTO </span>
                                                  <div>  
                                                    <input type="number" class="form-control" name="hospitalizacion_disponibles_covid" id="hospitalizacion_disponibles_covid" value="<?=$hospital->hospitalizacion_disponibles_covid?>" readonly/> 
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> HABILITADAS TOTALES </span>
                                              <div>  
                                                <input type="number" class="form-control" name="pediatricos_total_h_covid" id="pediatricos_total_h_covid" value="<?=$hospital->pediatricos_total_h_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!-- <label>(*) A + B + C</label>-->
                                            <div class="form-group" style="text-align: center;">
                                              <span class="span__bold">HABILITADAS EN USO</span>
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_total_u_covid" id="pediatricos_total_u_covid" value="<?=$hospital->pediatricos_total_u_covid?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <div class="form-group" style="text-align: center;">
                                            <span class="span__bold"> SOBRESATURACIÓN DE UCI PEDIATRICOS COVID </span>
                                              <div>  
                                                <input type="number" class="form-control" name="pediatricos_porcentaje_02" id="pediatricos_porcentaje_02" value="<?=$hospital->pediatricos_porcentaje_02?>" readonly/> 
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="tab-pane" id="5">
                                    <div>
                                      <label class="modal-label col-sm-8 col-form-label py-10">
                                      <br />
                                      <label class="span__bold__center"></label>
                                      </label>
                                      <br /><br /> <br /><br />
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <!--<label class="modal-label col-sm-6 col-form-label py-10 span__bold">-->
                                          <label class="modal-label col-sm-6 col-form-label">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                              <label class="span__bold">SOBRESATURACIÓN DE CAMAS HOSPITALARIAS  (NO UCI, NO EMERGENCIA)</label>
                                          </label>
                                          <div class="col-sm-3">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_porcentaje_01_5" id="hospitalizacion_porcentaje_01_5" value="<?=$hospital->hospitalizacion_porcentaje_01?>" readonly /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <!--<label class="modal-label col-sm-6 col-form-label py-10 span__bold">-->
                                          <label class="modal-label col-sm-6 col-form-label">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                              <label class="span__bold">SOBRESATURACIÓN  DE CAMAS HOSPITALARIAS (NO UCI. NO EMERGENCIA) POR COVID 19</label>
                                          </label>
                                          <div class="col-sm-3">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="hospitalizacion_porcentaje_02_5" id="hospitalizacion_porcentaje_02_5" value="<?=$hospital->hospitalizacion_porcentaje_02?>" readonly /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <!--<label class="modal-label col-sm-6 col-form-label py-10 span__bold">-->
                                          <label class="modal-label col-sm-6 col-form-label">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                              <label class="span__bold">SOBRESATURACIÓN DE CAMAS DEL SERVICIO DE EMERGENCIA ADULTOS</label>
                                          </label>
                                          <div class="col-sm-3">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_porcentaje_01_5" id="emergencia_porcentaje_01_5" value="<?=$hospital->emergencia_porcentaje_01?>" readonly /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <!--<label class="modal-label col-sm-6 col-form-label py-10 span__bold">-->
                                          <label class="modal-label col-sm-6 col-form-label">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                              <label class="span__bold">SOBRESATURACIÓN  DE CAMAS DEL SERVICIO DE EMERGENCIA ADULTOS POR COVID 19</label>
                                          </label>
                                          <div class="col-sm-3">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="emergencia_porcentaje_02_5" id="emergencia_porcentaje_02_5" value="<?=$hospital->emergencia_porcentaje_02?>" readonly /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <!--<label class="modal-label col-sm-6 col-form-label py-10 span__bold">-->
                                          <label class="modal-label col-sm-6 col-form-label">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                              <label class="span__bold">SOBRESATURACIÓN DE CAMAS DEL SERVICIO DE CUIDADOS CRITICOS ADULTOS</label>
                                          </label>
                                          <div class="col-sm-3">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_porcentaje_01_5" id="criticos_porcentaje_01_5" value="<?=$hospital->criticos_porcentaje_01?>" readonly /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <!--<label class="modal-label col-sm-6 col-form-label py-10 span__bold">-->
                                          <label class="modal-label col-sm-6 col-form-label">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                              <label class="span__bold">SOBRESATURACIÓN DE CAMAS DEL SERVICIO DE CUIDADOS CRITICOS ADULTOS POR COVID 19 </label>
                                          </label>
                                          <div class="col-sm-3">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="criticos_porcentaje_02_5" id="criticos_porcentaje_02_5" value="<?=$hospital->criticos_porcentaje_02?>" readonly /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <!--<label class="modal-label col-sm-6 col-form-label py-10 span__bold">-->
                                          <label class="modal-label col-sm-6 col-form-label">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                              <label class="span__bold">SOBRESATURACIÓN DE CAMAS DE CUIDADOS CRITICOS PEDIATRICOS</label>
                                          </label>
                                          <div class="col-sm-3">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_porcentaje_01_5" id="pediatricos_porcentaje_01_5" value="<?=$hospital->pediatricos_porcentaje_01?>" readonly /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">						
                                        <div class="form-group row">                                      
                                          <!--<label class="modal-label col-sm-6 col-form-label py-10 span__bold">-->
                                          <label class="modal-label col-sm-6 col-form-label">
                                          <!--Camas en Hospitalización para COVID-19: (A)-->
                                              <label class="span__bold">SOBRESATURACIÓN DE CAMAS  DE CUIDADOS CRITICOS PEDIATRICOS POR COVID 19 </label>
                                          </label>
                                          <div class="col-sm-3">
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                <input type="number" class="form-control" name="pediatricos_porcentaje_02_5" id="pediatricos_porcentaje_02_5" value="<?=$hospital->pediatricos_porcentaje_02?>" readonly /> 
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-2">
                                            <!--<label>(*) Incluye Sospechosos y Confirmados</label>-->
                                            <div class="form-group"  style="text-align: center;">
                                              <div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>  
                                </div>
                              </div>
                            </div>

                            <!--
                            <div class="row">

                              <div class="form-group row">
                                <label class="col-sm-5">Establecimiento</label>
                                <div class="col-sm-7">
                                  <select id="hospitales_situaciones_nombre_id" name="hospitales_situaciones_nombre_id"
                                    class="form-control">
                                    <?php foreach($hospitales as $row): ?>
                                    <?php if($row->id==$hospital->hospitales_situaciones_nombre_id){ ?>
                                    <option value="<?=$row->id?>" selected><?=$row->hospitales_situaciones_nombre?>
                                    </option>
                                    <?php } ?>
                                    <?php endforeach; ?>
                                  </select>

                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-5">DNI Responsable Reporte</label>
                                <div class="col-sm-7">


                                  <div class="input-group" id="error_numero_documento">
                                    <input id="dni_responsable_reporte" value="<?=$hospital->dni_responsable_reporte?>"
                                      name="dni_responsable_reporte" class="form-control" type="text" />
                                    <span class="input-group-btn">
                                      <button type="button" id="btn-buscarr" class="btn btn-info"><i
                                          class="fa fa-search" aria-hidden="true"></i></button>
                                    </span>
                                  </div>

                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-5">Responsable Reporte</label>
                                <div class="col-sm-7">
                                  <input value="<?=$hospital->responsable_reporte?>" name="responsable_reporte"
                                    class="form-control" type="text" readonly />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-5">CMP Responsable Reporte</label>
                                <div class="col-sm-7">
                                  <input value="<?=$hospital->cmp_responsable_reporte?>" name="cmp_responsable_reporte"
                                    class="form-control" type="text" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-5">RNE Responsable Reporte</label>
                                <div class="col-sm-7">
                                  <input value="<?=$hospital->rne_responsable_reporte?>" name="rne_responsable_reporte"
                                    class="form-control" type="text" />
                                </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-sm-5">DNI Jefe de Guardia</label>
                                <div class="col-sm-7">


                                  <div class="input-group" id="error_numero_documento">
                                    <input id="dni_jefe_guardia" value="<?=$hospital->dni_jefe_guardia?>"
                                      name="dni_jefe_guardia" class="form-control" type="text" />
                                    <span class="input-group-btn">
                                      <button type="button" id="btn-buscarj" class="btn btn-info"><i
                                          class="fa fa-search" aria-hidden="true"></i></button>
                                    </span>
                                  </div>

                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-5">Jefe de Guardia</label>
                                <div class="col-sm-7">
                                  <input value="<?=$hospital->jefe_guardia?>" name="jefe_guardia" class="form-control"
                                    type="text" readonly />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-5">CMP Jefe de Guardia</label>
                                <div class="col-sm-7">
                                  <input value="<?=$hospital->cmp_jefe_guardia?>" name="cmp_jefe_guardia"
                                    class="form-control" type="text" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-5">RNE Jefe de Guardia</label>
                                <div class="col-sm-7">
                                  <input value="<?=$hospital->rne_jefe_guardia?>" name="rne_jefe_guardia"
                                    class="form-control" type="text" />
                                </div>
                              </div>

                              <div class="row">

                                <div class="col-sm-4 col-xs-12">

                                  <div class="form-group row">
                                    <label for="fecha" class="col-sm-4 col-form-label">Fecha</label>
                                    <div class="col-sm-8">
                                      <div class="form-group" id="error_fecha">
                                        <div class='input-group date' id='datetimepicker'>
                                          <input type="text" class="form-control" name="fecha"
                                            value="<?=$hospital->fecha?>" readonly />
                                          <span class="input-group-addon"> <span
                                              class="glyphicon glyphicon-calendar"></span> </span>
                                        </div>
                                      </div>

                                    </div>
                                  </div>

                                </div>

                                <div class="col-sm-4 col-xs-12">

                                  <div class="form-group row">
                                    <label for="hora" class="col-sm-4 col-form-label">Hora</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" id="hora" name="hora">
                                        <?php if("08:00"==$hospital->hora){ ?>
                                        <option value="08:00" selected>8:00 am</option>
                                        <?php } else{ ?>
                                        <option value="20:00" selected>8:00 pm</option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>

                                </div>

                                <div class="col-sm-4 col-xs-12">

                                  <div class="form-group row">
                                    <label for="telefono" class="col-sm-4 col-form-label">Teléfono Celular</label>
                                    <div class="col-sm-8">
                                      <input id="telefono" name="telefono" value="<?=$hospital->telefono?>"
                                        class="form-control" type="text" />
                                    </div>
                                  </div>

                                </div>

                              </div>

                            </div>
                            -->                            
                            <!--
                            <div class="row">

                              <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#nedocs">Indice NEDOCS</a></li>
                                <li><a data-toggle="tab" href="#emergencia">EMERGENCIA</a></li>
                                <li><a data-toggle="tab" href="#pediatria">PEDIATRIA</a></li>
                                <li><a data-toggle="tab" href="#ginecoobstetricia">GINECO-OBSTETRICIA</a></li>
                                <li><a data-toggle="tab" href="#sop">SOP</a></li>
                                <li><a data-toggle="tab" href="#personalMedico">PERSONAL MEDICO</a></li>
                                <li><a data-toggle="tab" href="#personalNoMedico">OTROS PROFESIONALES</a></li>
                                <li><a data-toggle="tab" href="#bancosangre">BANCO DE SANGRE</a></li>
                                <li><a data-toggle="tab" href="#ventiladores">VENTILADORES</a></li>
                                <li><a data-toggle="tab" href="#ambulancias">AMBULANCIAS</a></li>
                                <li><a data-toggle="tab" href="#ocurrencias">OCURRENCIAS</a></li>

                              </ul>

                              <div class="tab-content">

                                <div id="nedocs" class="tab-pane fade in active">
                                  <br />

                                  <div class="col-xs-12 col-sm-12">
                                    <div style="text-align: center;font-weight: 900;font-size: x-large;">
                                      <caption>INDICE NEDOCS</caption>
                                    </div>
                                    <div class="col-xs-6">
                                      <fieldset
                                        style="display: block;margin-inline-start: 2px;margin-inline-end: 2px;padding-block-start: 0.35em;padding-inline-start: 0.75em;padding-inline-end: 0.75em;padding-block-end: 0.625em;min-inline-size: min-content;border-width: 2px;border-style: groove;border-color: threedface;border-image: initial;">
                                        <legend>Camas Registradas en Emergencia por OGTI</legend>
                                        <div>
                                          <div class="table-responsive">
                                            <table class="table">
                                              <thead>
                                                <tr>

                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <th>SHOCK TRAUMA</th>
                                                  <td><input type="text" class="form-control text-center"
                                                      value="<?=$hospital->nedocs_shock_trauma?>"
                                                      id="nedocs_shock_trauma" name="nedocs_shock_trauma">
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th>TÓPICO MEDICINA</th>
                                                  <td><input type="text" class="form-control text-center"
                                                      value="<?=$hospital->nedocs_medicina?>" id="nedocs_medicina"
                                                      name="nedocs_medicina">
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th>TÓPICO CIRUGÍA</th>
                                                  <td><input type="text" class="form-control text-center"
                                                      value="<?=$hospital->nedocs_cirugia?>" id="nedocs_cirugia"
                                                      name="nedocs_cirugia">
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th>TÓPICO GINECO-OBSTETRICIA</th>
                                                  <td><input type="text" class="form-control text-center"
                                                      value="<?=$hospital->nedocs_gineco_obstetricia?>"
                                                      id="nedocs_gineco_obstetricia" name="nedocs_gineco_obstetricia">
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th>TÓPICO PEDIATRIA</th>
                                                  <td><input type="text" class="form-control text-center"
                                                      value="<?=$hospital->nedocs_pedriatria?>" id="nedocs_pedriatria"
                                                      name="nedocs_pedriatria">
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th>OBSERVACIÓN MEDICINA</th>
                                                  <td><input type="text" class="form-control text-center"
                                                      value="<?=$hospital->nedocs_observacion_medicina?>"
                                                      id="nedocs_observacion_medicina"
                                                      name="nedocs_observacion_medicina">
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th>OBSERVACIÓN CIRUGIA</th>
                                                  <td><input type="text" class="form-control text-center"
                                                      value="<?=$hospital->nedocs_observacion_cirugia?>"
                                                      id="nedocs_observacion_cirugia" name="nedocs_observacion_cirugia">
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th>OBSERVACIÓN GINECO-OBSTETRICIA</th>
                                                  <td><input type="text" class="form-control text-center"
                                                      value="<?=$hospital->nedocs_observacion_gineco_obstetricia?>"
                                                      id="nedocs_observacion_gineco_obstetricia"
                                                      name="nedocs_observacion_gineco_obstetricia">
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th>OBSERVACIÓN PEDIATRIA</th>
                                                  <td><input type="text" class="form-control text-center"
                                                      value="<?=$hospital->nedocs_observacion_pediatria?>"
                                                      id="nedocs_observacion_pediatria"
                                                      name="nedocs_observacion_pediatria">
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                          
                                        </div>
                                      </fieldset>

                                      <fieldset
                                        style="display: block;margin-inline-start: 2px;margin-inline-end: 2px;padding-block-start: 0.35em;padding-inline-start: 0.75em;padding-inline-end: 0.75em;padding-block-end: 0.625em;min-inline-size: min-content;border-width: 2px;border-style: groove;border-color: threedface;border-image: initial;">
                                        <legend>Pacientes en Espera de Cama de Internamiento en Tópico de Emergencia</legend>
                                        <div>
                                          <div class="table-responsive">
                                            <table class="table">
                                              <thead>
                                                <tr>

                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <th>CANTIDAD</th>
                                                  <td><input type="text" class="form-control text-center"
                                                      value="<?=$hospital->nedocs_pacientes_espera_cama_internamiento?>"
                                                      id="nedocs_pacientes_espera_cama_internamiento"
                                                      name="nedocs_pacientes_espera_cama_internamiento">
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                          
                                        </div>
                                      </fieldset>
                                      <fieldset
                                        style="display: block;margin-inline-start: 2px;margin-inline-end: 2px;padding-block-start: 0.35em;padding-inline-start: 0.75em;padding-inline-end: 0.75em;padding-block-end: 0.625em;min-inline-size: min-content;border-width: 2px;border-style: groove;border-color: threedface;border-image: initial;">
                                        <legend>Cantidad Total de Pacientes en Ventilación (Pedriatría, Medicina, Gineco-Obstetra, Cirugía)</legend>
                                        <div>
                                          <div class="table-responsive">
                                            <table class="table">
                                              <thead>
                                                <tr>

                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <th>CANTIDAD</th>
                                                  <td><input type="text" class="form-control text-center"
                                                      value="<?=$hospital->nedocs_cantidad_total_pacientes_ventilacion?>"
                                                      id="nedocs_cantidad_total_pacientes_ventilacion"
                                                      name="nedocs_cantidad_total_pacientes_ventilacion">
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                          
                                        </div>
                                      </fieldset>
                                    </div>

                                    <div class="col-xs-6">
                                      <fieldset
                                        style="display: block;margin-inline-start: 2px;margin-inline-end: 2px;padding-block-start: 0.35em;padding-inline-start: 0.75em;padding-inline-end: 0.75em;padding-block-end: 0.625em;min-inline-size: min-content;border-width: 2px;border-style: groove;border-color: threedface;border-image: initial;">
                                        <legend>Camas de Emergencia Ocupadas en Pasillos</legend>
                                        <div>
                                          <div class="table-responsive">
                                            <table class="table">
                                              <thead>
                                                <tr>

                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <th>CANTIDAD</th>
                                                  <td><input type="text" class="form-control text-center"
                                                      value="<?=$hospital->nedocs_camas_emergencia_ocupadas_pasillos?>"
                                                      id="nedocs_camas_emergencia_ocupadas_pasillos"
                                                      name="nedocs_camas_emergencia_ocupadas_pasillos">
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                          
                                        </div>
                                      </fieldset>
                                    </div>
                                    <p>
                                      <div class="col-xs-6">
                                        <fieldset
                                          style="display: block;margin-inline-start: 2px;margin-inline-end: 2px;padding-block-start: 0.35em;padding-inline-start: 0.75em;padding-inline-end: 0.75em;padding-block-end: 0.625em;min-inline-size: min-content;border-width: 2px;border-style: groove;border-color: threedface;border-image: initial;">
                                          <legend>Camas de Emergencia Ocupadas en Áreas de Contigencia</legend>
                                          <div>
                                            <div class="table-responsive">
                                              <table class="table">
                                                <thead>
                                                  <tr>

                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <th>CANTIDAD</th>
                                                    <td><input type="text" class="form-control text-center"
                                                        value="<?=$hospital->nedocs_camas_emergencia_ocupadas_areas_contigencia?>"
                                                        id="nedocs_camas_emergencia_ocupadas_areas_contigencia"
                                                        name="nedocs_camas_emergencia_ocupadas_areas_contigencia">
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                            
                                          </div>
                                        </fieldset>
                                      </div>
                                      <br />
                                      <div class="col-xs-6">
                                        <fieldset
                                          style="display: block;margin-inline-start: 2px;margin-inline-end: 2px;padding-block-start: 0.35em;padding-inline-start: 0.75em;padding-inline-end: 0.75em;padding-block-end: 0.625em;min-inline-size: min-content;border-width: 2px;border-style: groove;border-color: threedface;border-image: initial;">
                                          <legend>Camas de Emergencia Ocupadas en Emergencias Masivas y Desastres
                                          </legend>
                                          <div>
                                            <div class="table-responsive">
                                              <table class="table">
                                                <thead>
                                                  <tr>

                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <th>CANTIDAD</th>
                                                    <td><input type="text" class="form-control text-center"
                                                        value="<?=$hospital->nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres?>"
                                                        id="nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres"
                                                        name="nedocs_camas_emergencia_ocupadas_emergencias_masivas_desastres">
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                            
                                          </div>
                                        </fieldset>
                                      </div>
                                      <br />
                                      <div class="col-xs-6">
                                        <fieldset
                                          style="display: block;margin-inline-start: 2px;margin-inline-end: 2px;padding-block-start: 0.35em;padding-inline-start: 0.75em;padding-inline-end: 0.75em;padding-block-end: 0.625em;min-inline-size: min-content;border-width: 2px;border-style: groove;border-color: threedface;border-image: initial;">
                                          <legend>Camas de Expansión solo en Emegencias y Desastres</legend>
                                          <div>
                                            <div class="table-responsive">
                                              <table class="table">
                                                <thead>
                                                  <tr>

                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <th>CANTIDAD</th>
                                                    <td><input type="text" class="form-control text-center"
                                                        value="<?=$hospital->nedocs_capacidad_expansion_emergencias_desastres?>"
                                                        id="nedocs_capacidad_expansion_emergencias_desastres"
                                                        name="nedocs_capacidad_expansion_emergencias_desastres">
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                            
                                          </div>
                                        </fieldset>
                                      </div>
                                      <br />
                                    <div class="col-xs-6">
                                      <fieldset
                                        style="display: block;margin-inline-start: 2px;margin-inline-end: 2px;padding-block-start: 0.35em;padding-inline-start: 0.75em;padding-inline-end: 0.75em;padding-block-end: 0.625em;min-inline-size: min-content;border-width: 2px;border-style: groove;border-color: threedface;border-image: initial;">
                                        <legend>Tiempo de Espera (Expresado en Horas)</legend>
                                        <div>
                                          <div class="table-responsive">
                                            <table class="table">
                                              <thead>
                                                <tr>

                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <th>EN SALA DE ESPERA DEL ÚLTIMO PACIENTE LLAMADO</th>
                                                  <td><input type="text" class="form-control text-center" value="<?=$hospital->nedocs_tiempo_espera_ensala_ultimo_paciente_llamado?>"
                                                      id="nedocs_tiempo_espera_ensala_ultimo_paciente_llamado"
                                                      name="nedocs_tiempo_espera_ensala_ultimo_paciente_llamado">
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th>MÁS LARGO EN EVALUACIÓN AMBULATORIA HASTA EL ALTA U HOSPITALIZACIÓN</th>
                                                  <td><input type="text" class="form-control text-center" value="<?=$hospital->nedocs_tiempo_espera_mas_largo_por_cama_de_internacion?>"
                                                      id="nedocs_tiempo_espera_mas_largo_por_cama_de_internacion"
                                                      name="nedocs_tiempo_espera_mas_largo_por_cama_de_internacion">
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                          
                                        </div>
                                      </fieldset>
                                    </div>
                                    <div class="col-xs-6">
                                      <fieldset
                                        style="display: block;margin-inline-start: 2px;margin-inline-end: 2px;padding-block-start: 0.35em;padding-inline-start: 0.75em;padding-inline-end: 0.75em;padding-block-end: 0.625em;min-inline-size: min-content;border-width: 2px;border-style: groove;border-color: threedface;border-image: initial;">
                                        <legend>Cantidad Total de Camas del Hospital Registradas por OGTI</legend>
                                        <div>
                                          <div class="table-responsive">
                                            <table class="table">
                                              <thead>
                                                <tr>

                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <th>CANTIDAD</th>
                                                  <td><input type="text" class="form-control text-center" value="<?=$hospital->nedocs_cantidad_total_camas_hospital?>"
                                                      id="nedocs_cantidad_total_camas_hospital"
                                                      name="nedocs_cantidad_total_camas_hospital">
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                          
                                        </div>
                                      </fieldset>
                                    </div>   
                                    <div class="col-xs-6">
                                        <fieldset>
                                          <legend></legend>
                                          <div>
                                            <div class="table-responsive">
                                              <table class="table">
                                                <thead>
                                                  <tr>

                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <th><button type="button" id="btn-calcular"
                                                      class="btn btn-primary">Calcular Indice</button></th>
                                                    <td><input type="text" class="form-control text-center"
                                                        value="<?=$hospital->nedocs_resultado?>" id="nedocs_resultado"
                                                        name="nedocs_resultado" readonly>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                            
                                          </div>
                                        </fieldset>
                                      </div>
                                      <br />
                                      <div class="col-xs-12" style="text-align: center;">
                                        <img id="NEDOCS" align='middle'
                                          src="<?=base_url()?>public/images/escala_nedocs.jpg" alt="imagen" title='' />
                                      </div>
                                  </div>

                                  <div class="clearfix"></div>

                                </div>

                                <div id="emergencia" class="tab-pane fade in">
                                  <br />
                                  <div class="clearfix"></div>
                                  <div class="table-responsive">
                                    <table class="table">
                                      <thead>
                                        <caption style="text-align: center;font-weight: 900;font-size: x-large;">
                                          EMERGENCIA</caption>
                                        <tr>
                                          <th>AREAS</th>
                                          <th>CAMAS REGISTRADAS DE EMERGENCIA POR OGTI</th>
                                          <th>CAMAS DE EMERGENCIA OCUPADAS EN PASILLO</th>
                                          <th>CAMAS DE EMERGENCIA OCUPADAS EN AREAS DE CONTINGENCIA</th>
                                          <th>CAPACIDAD DE EXPANSION</th>
                                          <th>CAMAS DE EMERGENCIA OCUPADAS EN EMERGENCIA MASIVA Y DESASTRES</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <th>SHOCK TRAUMA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_ogti_shock_trauma?>"
                                              id="emergencia_camas_ogti_shock_trauma"
                                              name="emergencia_camas_ogti_shock_trauma">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_pasillos_shock_trauma?>"
                                              id="emergencia_camas_pasillos_shock_trauma"
                                              name="emergencia_camas_pasillos_shock_trauma">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_contingencia_shock_trauma?>"
                                              id="emergencia_camas_contingencia_shock_trauma"
                                              name="emergencia_camas_contingencia_shock_trauma"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_expansion_shock_trauma?>"
                                              id="emergencia_camas_expansion_shock_trauma"
                                              name="emergencia_camas_expansion_shock_trauma">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_desastres_shock_trauma?>"
                                              id="emergencia_camas_desastres_shock_trauma"
                                              name="emergencia_camas_desastres_shock_trauma"></td>
                                        </tr>
                                        <tr>
                                          <th>MEDICINA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_ogti_medicina?>"
                                              id="emergencia_camas_ogti_medicina" name="emergencia_camas_ogti_medicina">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_pasillos_medicina?>"
                                              id="emergencia_camas_pasillos_medicina"
                                              name="emergencia_camas_pasillos_medicina">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_contingencia_medicina?>"
                                              id="emergencia_camas_contingencia_medicina"
                                              name="emergencia_camas_contingencia_medicina"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_expansion_medicina?>"
                                              id="emergencia_camas_expansion_medicina"
                                              name="emergencia_camas_expansion_medicina">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_desastres_medicina?>"
                                              id="emergencia_camas_desastres_medicina"
                                              name="emergencia_camas_desastres_medicina"></td>
                                        </tr>
                                        <tr>
                                          <th>CIRUGIA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_ogti_cirugia?>"
                                              id="emergencia_camas_ogti_cirugia" name="emergencia_camas_ogti_cirugia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_pasillos_cirugia?>"
                                              id="emergencia_camas_pasillos_cirugia"
                                              name="emergencia_camas_pasillos_cirugia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_contingencia_cirugia?>"
                                              id="emergencia_camas_contingencia_cirugia"
                                              name="emergencia_camas_contingencia_cirugia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_expansion_cirugia?>"
                                              id="emergencia_camas_expansion_cirugia"
                                              name="emergencia_camas_expansion_cirugia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_desastres_cirugia?>"
                                              id="emergencia_camas_desastres_cirugia"
                                              name="emergencia_camas_desastres_cirugia"></td>
                                        </tr>
                                        <tr>
                                          <th>GINECO-OBSTETRICIA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_ogti_gineco_obstetricia?>"
                                              id="emergencia_camas_ogti_gineco_obstetricia"
                                              name="emergencia_camas_ogti_gineco_obstetricia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_pasillos_gineco_obstetricia?>"
                                              id="emergencia_camas_pasillos_gineco_obstetricia"
                                              name="emergencia_camas_pasillos_gineco_obstetricia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_contingencia_gineco_obstetricia?>"
                                              id="emergencia_camas_contingencia_gineco_obstetricia"
                                              name="emergencia_camas_contingencia_gineco_obstetricia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_expansion_gineco_obstetricia?>"
                                              id="emergencia_camas_expansion_gineco_obstetricia"
                                              name="emergencia_camas_expansion_gineco_obstetricia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_desastres_gineco_obstetricia?>"
                                              id="emergencia_camas_desastres_gineco_obstetricia"
                                              name="emergencia_camas_desastres_gineco_obstetricia"></td>
                                        </tr>
                                        <tr>
                                          <th>PEDIATRIA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_ogti_pedriatria?>"
                                              id="emergencia_camas_ogti_pedriatria"
                                              name="emergencia_camas_ogti_pedriatria">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_pasillos_pedriatria?>"
                                              id="emergencia_camas_pasillos_pedriatria"
                                              name="emergencia_camas_pasillos_pedriatria">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_contingencia_pedriatria?>"
                                              id="emergencia_camas_contingencia_pedriatria"
                                              name="emergencia_camas_contingencia_pedriatria"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_expansion_pedriatria?>"
                                              id="emergencia_camas_expansion_pedriatria"
                                              name="emergencia_camas_expansion_pedriatria">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_desastres_pedriatria?>"
                                              id="emergencia_camas_desastres_pedriatria"
                                              name="emergencia_camas_desastres_pedriatria"></td>
                                        </tr>
                                        <tr>
                                          <th>OBSERVACIÓN MEDICINA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_ogti_observacion_medicina?>"
                                              id="emergencia_camas_ogti_observacion_medicina"
                                              name="emergencia_camas_ogti_observacion_medicina">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_pasillos_observacion_medicina?>"
                                              id="emergencia_camas_pasillos_observacion_medicina"
                                              name="emergencia_camas_pasillos_observacion_medicina">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_contingencia_observacion_medicina?>"
                                              id="emergencia_camas_contingencia_observacion_medicina"
                                              name="emergencia_camas_contingencia_observacion_medicina"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_expansion_observacion_medicina?>"
                                              id="emergencia_camas_expansion_observacion_medicina"
                                              name="emergencia_camas_expansion_observacion_medicina">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_desastres_observacion_medicina?>"
                                              id="emergencia_camas_desastres_observacion_medicina"
                                              name="emergencia_camas_desastres_observacion_medicina"></td>
                                        </tr>
                                        <tr>
                                          <th>OBSERVACIÓN CIRUGIA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_ogti_observacion_cirugia?>"
                                              id="emergencia_camas_ogti_observacion_cirugia"
                                              name="emergencia_camas_ogti_observacion_cirugia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_pasillos_observacion_cirugia?>"
                                              id="emergencia_camas_pasillos_observacion_cirugia"
                                              name="emergencia_camas_pasillos_observacion_cirugia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_contingencia_observacion_cirugia?>"
                                              id="emergencia_camas_contingencia_observacion_cirugia"
                                              name="emergencia_camas_contingencia_observacion_cirugia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_expansion_observacion_cirugia?>"
                                              id="emergencia_camas_expansion_observacion_cirugia"
                                              name="emergencia_camas_expansion_observacion_cirugia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_desastres_observacion_cirugia?>"
                                              id="emergencia_camas_desastres_observacion_cirugia"
                                              name="emergencia_camas_desastres_observacion_cirugia"></td>
                                        </tr>
                                        <tr>
                                          <th>OBSERVACIÓN GINECO-OBSTETRICIA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_ogti_observacion_gineco_obstetricia?>"
                                              id="emergencia_camas_ogti_observacion_gineco_obstetricia"
                                              name="emergencia_camas_ogti_observacion_gineco_obstetricia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_pasillos_observacion_gineco_obstetricia?>"
                                              id="emergencia_camas_pasillos_observacion_gineco_obstetricia"
                                              name="emergencia_camas_pasillos_observacion_gineco_obstetricia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_contingencia_observacion_gineco_obstetricia?>"
                                              id="emergencia_camas_contingencia_observacion_gineco_obstetricia"
                                              name="emergencia_camas_contingencia_observacion_gineco_obstetricia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_expansion_observacion_gineco_obstetricia?>"
                                              id="emergencia_camas_expansion_observacion_gineco_obstetricia"
                                              name="emergencia_camas_expansion_observacion_gineco_obstetricia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_desastres_observacion_gineco_obstetricia?>"
                                              id="emergencia_camas_desastres_observacion_gineco_obstetricia"
                                              name="emergencia_camas_desastres_observacion_gineco_obstetricia"></td>
                                        </tr>
                                        <tr>
                                          <th>OBSERVACIÓN PEDIATRIA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_ogti_observacion_pediatria?>"
                                              id="emergencia_camas_ogti_observacion_pediatria"
                                              name="emergencia_camas_ogti_observacion_pediatria">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_pasillos_observacion_pediatria?>"
                                              id="emergencia_camas_pasillos_observacion_pediatria"
                                              name="emergencia_camas_pasillos_observacion_pediatria">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_contingencia_observacion_pediatria?>"
                                              id="emergencia_camas_contingencia_observacion_pediatria"
                                              name="emergencia_camas_contingencia_observacion_pediatria"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_expansion_observacion_pediatria?>"
                                              id="emergencia_camas_expansion_observacion_pediatria"
                                              name="emergencia_camas_expansion_observacion_pediatria">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->emergencia_camas_desastres_observacion_pediatria?>"
                                              id="emergencia_camas_desastres_observacion_pediatria"
                                              name="emergencia_camas_desastres_observacion_pediatria"></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>

                                <div id="pediatria" class="tab-pane fade in">
                                  <br />
                                  <div class="clearfix"></div>
                                  <div class="table-responsive">
                                    <table class="table">
                                      <thead>
                                        <caption style="text-align: center;font-weight: 900;font-size: x-large;">AREA
                                          PEDIATRICA</caption>
                                        <tr>
                                          <th>PEDIATRIA</th>
                                          <th>CAMAS REGISTRADAS POR OGTI</th>
                                          <th>CAMAS OCUPADAS</th>
                                          <th>CAMAS EN PASILLO</th>
                                          <th>CAMAS CONTINGENCIA</th>
                                          <th>CAPACIDAD DE EXPANSION</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <th>UCI PEDIATRICA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_ogti_uci_pedriatrica?>"
                                              id="pedriatria_camas_ogti_uci_pedriatrica"
                                              name="pedriatria_camas_ogti_uci_pedriatrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_ocupadas_uci_pedriatrica?>"
                                              id="pedriatria_camas_ocupadas_uci_pedriatrica"
                                              name="pedriatria_camas_ocupadas_uci_pedriatrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_pasillos_uci_pedriatrica?>"
                                              id="pedriatria_camas_pasillos_uci_pedriatrica"
                                              name="pedriatria_camas_pasillos_uci_pedriatrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_contigencia_uci_pedriatrica?>"
                                              id="pedriatria_camas_contigencia_uci_pedriatrica"
                                              name="pedriatria_camas_contigencia_uci_pedriatrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_expansion_uci_pedriatrica?>"
                                              id="pedriatria_camas_expansion_uci_pedriatrica"
                                              name="pedriatria_camas_expansion_uci_pedriatrica"></td>
                                        </tr>
                                        <tr>
                                          <th>UCIN PEDIATRICA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_ogti_ucin_pedriatrica?>"
                                              id="pedriatria_camas_ogti_ucin_pedriatrica"
                                              name="pedriatria_camas_ogti_ucin_pedriatrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_ocupadas_ucin_pedriatrica?>"
                                              id="pedriatria_camas_ocupadas_ucin_pedriatrica"
                                              name="pedriatria_camas_ocupadas_ucin_pedriatrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_pasillos_ucin_pedriatrica?>"
                                              id="pedriatria_camas_pasillos_ucin_pedriatrica"
                                              name="pedriatria_camas_pasillos_ucin_pedriatrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_contigencia_ucin_pedriatrica?>"
                                              id="pedriatria_camas_contigencia_ucin_pedriatrica"
                                              name="pedriatria_camas_contigencia_ucin_pedriatrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_expansion_ucin_pedriatrica?>"
                                              id="pedriatria_camas_expansion_ucin_pedriatrica"
                                              name="pedriatria_camas_expansion_ucin_pedriatrica"></td>
                                        </tr>
                                        <tr>
                                          <th>UCI NEONATO</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_ogti_uci_neonato?>"
                                              id="pedriatria_camas_ogti_uci_neonato"
                                              name="pedriatria_camas_ogti_uci_neonato"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_ocupadas_uci_neonato?>"
                                              id="pedriatria_camas_ocupadas_uci_neonato"
                                              name="pedriatria_camas_ocupadas_uci_neonato"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_pasillos_uci_neonato?>"
                                              id="pedriatria_camas_pasillos_uci_neonato"
                                              name="pedriatria_camas_pasillos_uci_neonato"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_contigencia_uci_neonato?>"
                                              id="pedriatria_camas_contigencia_uci_neonato"
                                              name="pedriatria_camas_contigencia_uci_neonato"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_expansion_uci_neonato?>"
                                              id="pedriatria_camas_expansion_uci_neonato"
                                              name="pedriatria_camas_expansion_uci_neonato"></td>
                                        </tr>
                                        <tr>
                                          <th>UCIN NEONATO</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_ogti_ucin_neonato?>"
                                              id="pedriatria_camas_ogti_ucin_neonato"
                                              name="pedriatria_camas_ogti_ucin_neonato"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_ocupadas_ucin_neonato?>"
                                              id="pedriatria_camas_ocupadas_ucin_neonato"
                                              name="pedriatria_camas_ocupadas_ucin_neonato"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_pasillos_ucin_neonato?>"
                                              id="pedriatria_camas_pasillos_ucin_neonato"
                                              name="pedriatria_camas_pasillos_ucin_neonato"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_contigencia_ucin_neonato?>"
                                              id="pedriatria_camas_contigencia_ucin_neonato"
                                              name="pedriatria_camas_contigencia_ucin_neonato"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->pedriatria_camas_expansion_ucin_neonato?>"
                                              id="pedriatria_camas_expansion_ucin_neonato"
                                              name="pedriatria_camas_expansion_ucin_neonato"></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>

                                <div id="ginecoobstetricia" class="tab-pane fade in">
                                  <br />
                                  <div class="clearfix"></div>
                                  <div class="table-responsive">
                                    <table class="table">
                                      <thead>
                                        <caption style="text-align: center;font-weight: 900;font-size: x-large;">UNIDAD
                                          DE CUIDADOS INTENSIVOS</caption>
                                        <tr>
                                          <th>GINECO-OBSTETRICIA</th>
                                          <th>CAMAS REGISTRADAS POR OGTI</th>
                                          <th>CAMAS OCUPADAS</th>
                                          <th>CAMAS EN PASILLO</th>
                                          <th>CAMAS CONTINGENCIA</th>
                                          <th>CAPACIDAD DE EXPANSION</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <th>UCI GINECO-OBSTETRICA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->gineco_obstetricia_camas_ogti_uci?>"
                                              id="gineco_obstetricia_camas_ogti_uci"
                                              name="gineco_obstetricia_camas_ogti_uci"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->gineco_obstetricia_camas_ocupadas_uci?>"
                                              id="gineco_obstetricia_camas_ocupadas_uci"
                                              name="gineco_obstetricia_camas_ocupadas_uci"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->gineco_obstetricia_camas_pasillos_uci?>"
                                              id="gineco_obstetricia_camas_pasillos_uci"
                                              name="gineco_obstetricia_camas_pasillos_uci"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->gineco_obstetricia_camas_contingencia_uci?>"
                                              id="gineco_obstetricia_camas_contingencia_uci"
                                              name="gineco_obstetricia_camas_contingencia_uci"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->gineco_obstetricia_camas_expansion_uci?>"
                                              id="gineco_obstetricia_camas_expansion_uci"
                                              name="gineco_obstetricia_camas_expansion_uci"></td>
                                        </tr>
                                        <tr>
                                          <th>UCIN GINECO-OBSTETRICA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->gineco_obstetricia_camas_ogti_ucin?>"
                                              id="gineco_obstetricia_camas_ogti_ucin"
                                              name="gineco_obstetricia_camas_ogti_ucin"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->gineco_obstetricia_camas_ocupadas_ucin?>"
                                              id="gineco_obstetricia_camas_ocupadas_ucin"
                                              name="gineco_obstetricia_camas_ocupadas_ucin"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->gineco_obstetricia_camas_pasillos_ucin?>"
                                              id="gineco_obstetricia_camas_pasillos_ucin"
                                              name="gineco_obstetricia_camas_pasillos_ucin"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->gineco_obstetricia_camas_contingencia_ucin?>"
                                              id="gineco_obstetricia_camas_contingencia_ucin"
                                              name="gineco_obstetricia_camas_contingencia_ucin"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->gineco_obstetricia_camas_expansion_ucin?>"
                                              id="gineco_obstetricia_camas_expansion_ucin"
                                              name="gineco_obstetricia_camas_expansion_ucin"></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>

                                <div id="sop" class="tab-pane fade in">
                                  <br />
                                  <div class="clearfix"></div>
                                  <div class="table-responsive">
                                    <table class="table">
                                      <thead>
                                        <caption style="text-align: center;font-weight: 900;font-size: x-large;">SALA DE
                                          OPERACIONES</caption>
                                        <tr>
                                          <th>SOP</th>
                                          <th>SOP DISPONIBLES</th>
                                          <th>SOP REQUERIDOS</th>
                                          <th>BRECHA</th>
                                          <th>CAPACIDAD DE EXPANSION</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <th>SOP GINECO-OBSTETRICA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->sop_camas_disponibles_gineco_obstetrica?>"
                                              id="sop_camas_disponibles_gineco_obstetrica"
                                              name="sop_camas_disponibles_gineco_obstetrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->sop_camas_requeridos_gineco_obstetrica?>"
                                              id="sop_camas_requeridos_gineco_obstetrica"
                                              name="sop_camas_requeridos_gineco_obstetrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->sop_camas_portatiles_gineco_obstetrica?>"
                                              id="sop_camas_portatiles_gineco_obstetrica"
                                              name="sop_camas_portatiles_gineco_obstetrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->sop_camas_expansion_gineco_obstetrica?>"
                                              id="sop_camas_expansion_gineco_obstetrica"
                                              name="sop_camas_expansion_gineco_obstetrica"></td>
                                        </tr>
                                        <tr>
                                          <th>SOP EMERGENCIA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->sop_camas_disponibles_emergencia?>"
                                              id="sop_camas_disponibles_emergencia"
                                              name="sop_camas_disponibles_emergencia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->sop_camas_requeridos_emergencia?>"
                                              id="sop_camas_requeridos_emergencia"
                                              name="sop_camas_requeridos_emergencia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->sop_camas_portatiles_emergencia?>"
                                              id="sop_camas_portatiles_emergencia"
                                              name="sop_camas_portatiles_emergencia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->sop_camas_expansion_emergencia?>"
                                              id="sop_camas_expansion_emergencia" name="sop_camas_expansion_emergencia">
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>

                                <div id="personalMedico" class="tab-pane fade in">
                                  <br />
                                  <div class="clearfix"></div>
                                  <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                                      <div class="table-responsive">
                                        <table class="table">
                                          <thead>
                                            <caption style="text-align: center;font-weight: 900;font-size: x-large;">
                                              PERSONAL MEDICO</caption>
                                            <tr>
                                              <th>PERSONAL MEDICO</th>
                                              <th>PROGRAMADO</th>
                                              <th>REQUERIDO</th>
                                              <th>RETEN DISPONIBLE</th>
                                              <th>BRECHA</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th>PEDIATRÍA</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_pediatria?>"
                                                  id="personal_medico_programado_pediatria"
                                                  name="personal_medico_programado_pediatria"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_pediatria?>"
                                                  id="personal_medico_requerido_pediatria"
                                                  name="personal_medico_requerido_pediatria"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_pediatria?>"
                                                  id="personal_medico_reten_pediatria"
                                                  name="personal_medico_reten_pediatria"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_pediatria?>"
                                                  id="personal_medico_portatiles_pediatria"
                                                  name="personal_medico_portatiles_pediatria"></td>
                                            </tr>
                                            <tr>
                                              <th>CIRUGIA PEDIATRICA</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_cirugia_pediatrica?>"
                                                  id="personal_medico_programado_cirugia_pediatrica"
                                                  name="personal_medico_programado_cirugia_pediatrica"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_cirugia_pediatrica?>"
                                                  id="personal_medico_requerido_cirugia_pediatrica"
                                                  name="personal_medico_requerido_cirugia_pediatrica"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_cirugia_pediatrica?>"
                                                  id="personal_medico_reten_cirugia_pediatrica"
                                                  name="personal_medico_reten_cirugia_pediatrica"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_cirugia_pediatrica?>"
                                                  id="personal_medico_portatiles_cirugia_pediatrica"
                                                  name="personal_medico_portatiles_cirugia_pediatrica"></td>
                                            </tr>
                                            <tr>
                                              <th>GINECO-OBSTETRICIA</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_gineco_obstetricia?>"
                                                  id="personal_medico_programado_gineco_obstetricia"
                                                  name="personal_medico_programado_gineco_obstetricia"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_gineco_obstetricia?>"
                                                  id="personal_medico_requerido_gineco_obstetricia"
                                                  name="personal_medico_requerido_gineco_obstetricia"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_gineco_obstetricia?>"
                                                  id="personal_medico_reten_gineco_obstetricia"
                                                  name="personal_medico_reten_gineco_obstetricia"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_gineco_obstetricia?>"
                                                  id="personal_medico_portatiles_gineco_obstetricia"
                                                  name="personal_medico_portatiles_gineco_obstetricia"></td>
                                            </tr>
                                            <tr>
                                              <th>MEDICINA INTERNISTA</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_medicina_internista?>"
                                                  id="personal_medico_programado_medicina_internista"
                                                  name="personal_medico_programado_medicina_internista"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_medicina_internista?>"
                                                  id="personal_medico_requerido_medicina_internista"
                                                  name="personal_medico_requerido_medicina_internista"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_medicina_internista?>"
                                                  id="personal_medico_reten_medicina_internista"
                                                  name="personal_medico_reten_medicina_internista"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_medicina_internista?>"
                                                  id="personal_medico_portatiles_medicina_internista"
                                                  name="personal_medico_portatiles_medicina_internista"></td>
                                            </tr>
                                            <tr>
                                              <th>MEDICINA CARDIOLOGIA</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_medicina_cardiologo?>"
                                                  id="personal_medico_programado_medicina_cardiologo"
                                                  name="personal_medico_programado_medicina_cardiologo"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_medicina_cardiologo?>"
                                                  id="personal_medico_requerido_medicina_cardiologo"
                                                  name="personal_medico_requerido_medicina_cardiologo"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_medicina_cardiologo?>"
                                                  id="personal_medico_reten_medicina_cardiologo"
                                                  name="personal_medico_reten_medicina_cardiologo"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_medicina_cardiologo?>"
                                                  id="personal_medico_portatiles_medicina_cardiologo"
                                                  name="personal_medico_portatiles_medicina_cardiologo"></td>
                                            </tr>
                                            <tr>
                                              <th>MEDICINA NEFROLOGO</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_medicina_nefrologo?>"
                                                  id="personal_medico_programado_medicina_nefrologo"
                                                  name="personal_medico_programado_medicina_nefrologo"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_medicina_nefrologo?>"
                                                  id="personal_medico_requerido_medicina_nefrologo"
                                                  name="personal_medico_requerido_medicina_nefrologo"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_medicina_nefrologo?>"
                                                  id="personal_medico_reten_medicina_nefrologo"
                                                  name="personal_medico_reten_medicina_nefrologo"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_medicina_nefrologo?>"
                                                  id="personal_medico_portatiles_medicina_nefrologo"
                                                  name="personal_medico_portatiles_medicina_nefrologo"></td>
                                            </tr>
                                            <tr>
                                              <th>CIRUGIA GENERAL</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_cirugia_general?>"
                                                  id="personal_medico_programado_cirugia_general"
                                                  name="personal_medico_programado_cirugia_general"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_cirugia_general?>"
                                                  id="personal_medico_requerido_cirugia_general"
                                                  name="personal_medico_requerido_cirugia_general"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_cirugia_general?>"
                                                  id="personal_medico_reten_cirugia_general"
                                                  name="personal_medico_reten_cirugia_general"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_cirugia_general?>"
                                                  id="personal_medico_portatiles_cirugia_general"
                                                  name="personal_medico_portatiles_cirugia_general"></td>
                                            </tr>
                                            <tr>
                                              <th>TRAUMATOLOGIA</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_traumatologia?>"
                                                  id="personal_medico_programado_traumatologia"
                                                  name="personal_medico_programado_traumatologia"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_traumatologia?>"
                                                  id="personal_medico_requerido_traumatologia"
                                                  name="personal_medico_requerido_traumatologia"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_traumatologia?>"
                                                  id="personal_medico_reten_traumatologia"
                                                  name="personal_medico_reten_traumatologia"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_traumatologia?>"
                                                  id="personal_medico_portatiles_traumatologia"
                                                  name="personal_medico_portatiles_traumatologia"></td>
                                            </tr>
                                            <tr>
                                              <th>NEUROCIRUGIA</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_neurocirugia?>"
                                                  id="personal_medico_programado_neurocirugia"
                                                  name="personal_medico_programado_neurocirugia"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_neurocirugia?>"
                                                  id="personal_medico_requerido_neurocirugia"
                                                  name="personal_medico_requerido_neurocirugia"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_neurocirugia?>"
                                                  id="personal_medico_reten_neurocirugia"
                                                  name="personal_medico_reten_neurocirugia"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_neurocirugia?>"
                                                  id="personal_medico_portatiles_neurocirugia"
                                                  name="personal_medico_portatiles_neurocirugia"></td>
                                            </tr>
                                            <tr>
                                              <th>CIRUGIA DE TORAX Y CARDIOVASCULAR</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_cirugia_torax?>"
                                                  id="personal_medico_programado_cirugia_torax"
                                                  name="personal_medico_programado_cirugia_torax"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_cirugia_torax?>"
                                                  id="personal_medico_requerido_cirugia_torax"
                                                  name="personal_medico_requerido_cirugia_torax"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_cirugia_torax?>"
                                                  id="personal_medico_reten_cirugia_torax"
                                                  name="personal_medico_reten_cirugia_torax"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_cirugia_torax?>"
                                                  id="personal_medico_portatiles_cirugia_torax"
                                                  name="personal_medico_portatiles_cirugia_torax"></td>
                                            </tr>
                                            <tr>
                                              <th>MEDICINA INTENSIVA</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_medicina_intensiva?>"
                                                  id="personal_medico_programado_medicina_intensiva"
                                                  name="personal_medico_programado_medicina_intensiva"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_medicina_intensiva?>"
                                                  id="personal_medico_requerido_medicina_intensiva"
                                                  name="personal_medico_requerido_medicina_intensiva"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_medicina_intensiva?>"
                                                  id="personal_medico_reten_medicina_intensiva"
                                                  name="personal_medico_reten_medicina_intensiva"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_medicina_intensiva?>"
                                                  id="personal_medico_portatiles_medicina_intensiva"
                                                  name="personal_medico_portatiles_medicina_intensiva"></td>
                                            </tr>
                                            <tr>
                                              <th>NEONATOLOGO</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_neonatologo?>"
                                                  id="personal_medico_programado_neonatologo"
                                                  name="personal_medico_programado_neonatologo"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_neonatologo?>"
                                                  id="personal_medico_requerido_neonatologo"
                                                  name="personal_medico_requerido_neonatologo"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_neonatologo?>"
                                                  id="personal_medico_reten_neonatologo"
                                                  name="personal_medico_reten_neonatologo"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_neonatologo?>"
                                                  id="personal_medico_portatiles_neonatologo"
                                                  name="personal_medico_portatiles_neonatologo"></td>
                                            </tr>
                                            <tr>
                                              <th>ANESTESIOLOGO</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_programado_anestesiologo?>"
                                                  id="personal_medico_programado_anestesiologo"
                                                  name="personal_medico_programado_anestesiologo"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_requerido_anestesiologo?>"
                                                  id="personal_medico_requerido_anestesiologo"
                                                  name="personal_medico_requerido_anestesiologo"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_reten_anestesiologo?>"
                                                  id="personal_medico_reten_anestesiologo"
                                                  name="personal_medico_reten_anestesiologo"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_medico_portatiles_anestesiologo?>"
                                                  id="personal_medico_portatiles_anestesiologo"
                                                  name="personal_medico_portatiles_anestesiologo"></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div id="personalNoMedico" class="tab-pane fade in">
                                  <br />
                                  <div class="clearfix"></div>
                                  <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                                      <div class="table-responsive">
                                        <table class="table">
                                          <thead>
                                            <caption style="text-align: center;font-weight: 900;font-size: x-large;">
                                              OTROS PROFESIONALES Y TÉCNICOS DE SALUD</caption>
                                            <tr>
                                              <th>&nbsp;</th>
                                              <th>PROGRAMADO</th>
                                              <th>REQUERIDO</th>
                                              <th>RETEN DISPONIBLE</th>
                                              <th>BRECHA</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th>ENFERMERAS</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_programado_enfermeras?>"
                                                  id="personal_no_medico_programado_enfermeras"
                                                  name="personal_no_medico_programado_enfermeras"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_requerido_enfermeras?>"
                                                  id="personal_no_medico_requerido_enfermeras"
                                                  name="personal_no_medico_requerido_enfermeras"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_requerido_social?>"
                                                  id="personal_no_medico_requerido_social"
                                                  name="personal_no_medico_requerido_social"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_portatiles_enfermeras?>"
                                                  id="personal_no_medico_portatiles_enfermeras"
                                                  name="personal_no_medico_portatiles_enfermeras"></td>
                                            </tr>
                                            <tr>
                                              <th>TECNOLOGOS</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_programado_tecnologos?>"
                                                  id="personal_no_medico_programado_tecnologos"
                                                  name="personal_no_medico_programado_tecnologos"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_requerido_tecnologos?>"
                                                  id="personal_no_medico_requerido_tecnologos"
                                                  name="personal_no_medico_requerido_tecnologos"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_reten_tecnologos?>"
                                                  id="personal_no_medico_reten_tecnologos"
                                                  name="personal_no_medico_reten_tecnologos"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_portatiles_tecnologos?>"
                                                  id="personal_no_medico_portatiles_tecnologos"
                                                  name="personal_no_medico_portatiles_tecnologos"></td>
                                            </tr>
                                            <tr>
                                              <th>OBSTETRICES</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_programado_obtetrices?>"
                                                  id="personal_no_medico_programado_obtetrices"
                                                  name="personal_no_medico_programado_obtetrices"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_requerido_obtetrices?>"
                                                  id="personal_no_medico_requerido_obtetrices"
                                                  name="personal_no_medico_requerido_obtetrices"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_reten_obtetrices?>"
                                                  id="personal_no_medico_reten_obtetrices"
                                                  name="personal_no_medico_reten_obtetrices"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_portatiles_obtetrices?>"
                                                  id="personal_no_medico_portatiles_obtetrices"
                                                  name="personal_no_medico_portatiles_obtetrices"></td>
                                            </tr>
                                            <tr>
                                              <th>TÉCNICOS</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_programado_tecnicos?>"
                                                  id="personal_no_medico_programado_tecnicos"
                                                  name="personal_no_medico_programado_tecnicos"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_requerido_tecnicos?>"
                                                  id="personal_no_medico_requerido_tecnicos"
                                                  name="personal_no_medico_requerido_tecnicos"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_reten_tecnicos?>"
                                                  id="personal_no_medico_reten_tecnicos"
                                                  name="personal_no_medico_reten_tecnicos"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_portatiles_tecnicos?>"
                                                  id="personal_no_medico_portatiles_tecnicos"
                                                  name="personal_no_medico_portatiles_tecnicos"></td>
                                            </tr>
                                            <tr>
                                              <th>SERVICIO SOCIAL</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_programado_social?>"
                                                  id="personal_no_medico_programado_social"
                                                  name="personal_no_medico_programado_social"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_requerido_social?>"
                                                  id="personal_no_medico_requerido_social"
                                                  name="personal_no_medico_requerido_social"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_reten_social?>"
                                                  id="personal_no_medico_reten_social"
                                                  name="personal_no_medico_reten_social"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->personal_no_medico_portatiles_social?>"
                                                  id="personal_no_medico_portatiles_social"
                                                  name="personal_no_medico_portatiles_social"></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div id="bancosangre" class="tab-pane fade in">
                                  <br />
                                  <div class="clearfix"></div>
                                  <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                                      <div class="table-responsive">
                                        <table class="table">
                                          <thead>
                                            <caption style="text-align: center;font-weight: 900;font-size: x-large;">
                                              BANCO DE SANGRE</caption>
                                            <tr>
                                              <th>&nbsp;</th>
                                              <th>DISPONIBLE</th>
                                              <th>REQUERIDO</th>
                                              <th>BRECHA</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th>SANGRE TOTAL</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->banco_sangre_disponible_sangre?>"
                                                  id="banco_sangre_disponible_sangre"
                                                  name="banco_sangre_disponible_sangre"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->banco_sangre_requerido_sangre?>"
                                                  id="banco_sangre_requerido_sangre"
                                                  name="banco_sangre_requerido_sangre"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->banco_sangre_portatiles_sangre?>"
                                                  id="banco_sangre_portatiles_sangre"
                                                  name="banco_sangre_portatiles_sangre"></td>
                                            </tr>
                                            <tr>
                                              <th>PLASMA FRESCO CONGELADO</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->banco_sangre_disponible_plasma?>"
                                                  id="banco_sangre_disponible_plasma"
                                                  name="banco_sangre_disponible_plasma"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->banco_sangre_requerido_plasma?>"
                                                  id="banco_sangre_requerido_plasma"
                                                  name="banco_sangre_requerido_plasma"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->banco_sangre_portatiles_plasma?>"
                                                  id="banco_sangre_portatiles_plasma"
                                                  name="banco_sangre_portatiles_plasma"></td>
                                            </tr>
                                            <tr>
                                              <th>PLAQUETAS</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->banco_sangre_disponible_plaquetas?>"
                                                  id="banco_sangre_disponible_plaquetas"
                                                  name="banco_sangre_disponible_plaquetas"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->banco_sangre_requerido_plaquetas?>"
                                                  id="banco_sangre_requerido_plaquetas"
                                                  name="banco_sangre_requerido_plaquetas"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->banco_sangre_portatiles_plaquetas?>"
                                                  id="banco_sangre_portatiles_plaquetas"
                                                  name="banco_sangre_portatiles_plaquetas"></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div id="ventiladores" class="tab-pane fade in">
                                  <br />
                                  <div class="clearfix"></div>
                                  <div class="table-responsive">
                                    <table class="table">
                                      <thead>
                                        <caption style="text-align: center;font-weight: 900;font-size: x-large;">
                                        </caption>
                                        <tr>
                                          <th></th>
                                          <th>REGISTRADOS CON COD. PATRIMONIAL</th>
                                          <th>OPERATIVOS</th>
                                          <th>DISPONIBLES</th>
                                          <th>ALQUILADOS</th>
                                          <th>BRECHA</th>
                                          <th>PORTATILES/TRASNPORTE</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <th>TRAUMA SHOCK ADULTO</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_registrados_trauma_shock_adulto?>"
                                              id="ventiladores_registrados_trauma_shock_adulto"
                                              name="ventiladores_registrados_trauma_shock_adulto">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_operativos_trauma_shock_adulto?>"
                                              id="ventiladores_operativos_trauma_shock_adulto"
                                              name="ventiladores_operativos_trauma_shock_adulto">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_disponibles_trauma_shock_adulto?>"
                                              id="ventiladores_disponibles_trauma_shock_adulto"
                                              name="ventiladores_disponibles_trauma_shock_adulto"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_alquilados_trauma_shock_adulto?>"
                                              id="ventiladores_alquilados_trauma_shock_adulto"
                                              name="ventiladores_alquilados_trauma_shock_adulto">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_brecha_trauma_shock_adulto?>"
                                              id="ventiladores_brecha_trauma_shock_adulto"
                                              name="ventiladores_brecha_trauma_shock_adulto"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_portatiles_trauma_shock_adulto?>"
                                              id="ventiladores_portatiles_trauma_shock_adulto"
                                              name="ventiladores_portatiles_trauma_shock_adulto"></td>
                                        </tr>
                                        <tr>
                                          <th>TRAUMA SHOCK PEDIATRICO</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_registrados_trauma_shock_pediatrico?>"
                                              id="ventiladores_registrados_trauma_shock_pediatrico"
                                              name="ventiladores_registrados_trauma_shock_pediatrico">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_operativos_trauma_shock_pediatrico?>"
                                              id="ventiladores_operativos_trauma_shock_pediatrico"
                                              name="ventiladores_operativos_trauma_shock_pediatrico">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_disponibles_trauma_shock_pediatrico?>"
                                              id="ventiladores_disponibles_trauma_shock_pediatrico"
                                              name="ventiladores_disponibles_trauma_shock_pediatrico"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_alquilados_trauma_shock_pediatrico?>"
                                              id="ventiladores_alquilados_trauma_shock_pediatrico"
                                              name="ventiladores_alquilados_trauma_shock_pediatrico">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_brecha_trauma_shock_pediatrico?>"
                                              id="ventiladores_brecha_trauma_shock_pediatrico"
                                              name="ventiladores_brecha_trauma_shock_pediatrico"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_portatiles_trauma_shock_pediatrico?>"
                                              id="ventiladores_portatiles_trauma_shock_pediatrico"
                                              name="ventiladores_portatiles_trauma_shock_pediatrico"></td>
                                        </tr>
                                        <tr>
                                          <th>UCI ADULTOS</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_registrados_uci_adultos?>"
                                              id="ventiladores_registrados_uci_adultos"
                                              name="ventiladores_registrados_uci_adultos">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_operativos_uci_adultos?>"
                                              id="ventiladores_operativos_uci_adultos"
                                              name="ventiladores_operativos_uci_adultos">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_disponibles_uci_adultos?>"
                                              id="ventiladores_disponibles_uci_adultos"
                                              name="ventiladores_disponibles_uci_adultos"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_alquilados_uci_adultos?>"
                                              id="ventiladores_alquilados_uci_adultos"
                                              name="ventiladores_alquilados_uci_adultos">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_brecha_uci_adultos?>"
                                              id="ventiladores_brecha_uci_adultos"
                                              name="ventiladores_brecha_uci_adultos"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_portatiles_uci_adultos?>"
                                              id="ventiladores_portatiles_uci_adultos"
                                              name="ventiladores_portatiles_uci_adultos"></td>
                                        </tr>
                                        <tr>
                                          <th>UCI PEDIATRICA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_registrados_uci_pedriatrica?>"
                                              id="ventiladores_registrados_uci_pedriatrica"
                                              name="ventiladores_registrados_uci_pedriatrica">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_operativos_uci_pedriatrica?>"
                                              id="ventiladores_operativos_uci_pedriatrica"
                                              name="ventiladores_operativos_uci_pedriatrica">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_disponibles_uci_pedriatrica?>"
                                              id="ventiladores_disponibles_uci_pedriatrica"
                                              name="ventiladores_disponibles_uci_pedriatrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_alquilados_uci_pedriatrica?>"
                                              id="ventiladores_alquilados_uci_pedriatrica"
                                              name="ventiladores_alquilados_uci_pedriatrica">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_brecha_uci_pedriatrica?>"
                                              id="ventiladores_brecha_uci_pedriatrica"
                                              name="ventiladores_brecha_uci_pedriatrica"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_portatiles_uci_pedriatrica?>"
                                              id="ventiladores_portatiles_uci_pedriatrica"
                                              name="ventiladores_portatiles_uci_pedriatrica"></td>
                                        </tr>
                                        <tr>
                                          <th>UCI NEONATOLOGIA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_registrados_uci_neonatologia?>"
                                              id="ventiladores_registrados_uci_neonatologia"
                                              name="ventiladores_registrados_uci_neonatologia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_operativos_uci_neonatologia?>"
                                              id="ventiladores_operativos_uci_neonatologia"
                                              name="ventiladores_operativos_uci_neonatologia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_disponibles_uci_neonatologia?>"
                                              id="ventiladores_disponibles_uci_neonatologia"
                                              name="ventiladores_disponibles_uci_neonatologia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_alquilados_uci_neonatologia?>"
                                              id="ventiladores_alquilados_uci_neonatologia"
                                              name="ventiladores_alquilados_uci_neonatologia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_brecha_uci_neonatologia?>"
                                              id="ventiladores_brecha_uci_neonatologia"
                                              name="ventiladores_brecha_uci_neonatologia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_portatiles_uci_neonatologia?>"
                                              id="ventiladores_portatiles_uci_neonatologia"
                                              name="ventiladores_portatiles_uci_neonatologia"></td>
                                        </tr>
                                        <tr>
                                          <th>SALA DE OPERACIONES</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_registrados_sala_operaciones?>"
                                              id="ventiladores_registrados_sala_operaciones"
                                              name="ventiladores_registrados_sala_operaciones">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_operativos_sala_operaciones?>"
                                              id="ventiladores_operativos_sala_operaciones"
                                              name="ventiladores_operativos_sala_operaciones">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_disponibles_sala_operaciones?>"
                                              id="ventiladores_disponibles_sala_operaciones"
                                              name="ventiladores_disponibles_sala_operaciones"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_alquilados_sala_operaciones?>"
                                              id="ventiladores_alquilados_sala_operaciones"
                                              name="ventiladores_alquilados_sala_operaciones">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_brecha_sala_operaciones?>"
                                              id="ventiladores_brecha_sala_operaciones"
                                              name="ventiladores_brecha_sala_operaciones"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_portatiles_sala_operaciones?>"
                                              id="ventiladores_portatiles_sala_operaciones"
                                              name="ventiladores_portatiles_sala_operaciones"></td>
                                        </tr>
                                        <tr>
                                          <th>UCIN ADULTO</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_registrados_ucin_adulto?>"
                                              id="ventiladores_registrados_ucin_adulto"
                                              name="ventiladores_registrados_ucin_adulto">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_operativos_ucin_adulto?>"
                                              id="ventiladores_operativos_ucin_adulto"
                                              name="ventiladores_operativos_ucin_adulto">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_disponibles_ucin_adulto?>"
                                              id="ventiladores_disponibles_ucin_adulto"
                                              name="ventiladores_disponibles_ucin_adulto"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_alquilados_ucin_adulto?>"
                                              id="ventiladores_alquilados_ucin_adulto"
                                              name="ventiladores_alquilados_ucin_adulto">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_brecha_ucin_adulto?>"
                                              id="ventiladores_brecha_ucin_adulto"
                                              name="ventiladores_brecha_ucin_adulto"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_portatiles_ucin_adulto?>"
                                              id="ventiladores_portatiles_ucin_adulto"
                                              name="ventiladores_portatiles_ucin_adulto"></td>
                                        </tr>
                                        <tr>
                                          <th>UCIN PEDIATRICO</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_registrados_ucin_pediatrico?>"
                                              id="ventiladores_registrados_ucin_pediatrico"
                                              name="ventiladores_registrados_ucin_pediatrico">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_operativos_ucin_pediatrico?>"
                                              id="ventiladores_operativos_ucin_pediatrico"
                                              name="ventiladores_operativos_ucin_pediatrico">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_disponibles_ucin_pediatrico?>"
                                              id="ventiladores_disponibles_ucin_pediatrico"
                                              name="ventiladores_disponibles_ucin_pediatrico"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_alquilados_ucin_pediatrico?>"
                                              id="ventiladores_alquilados_ucin_pediatrico"
                                              name="ventiladores_alquilados_ucin_pediatrico">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_brecha_ucin_pediatrico?>"
                                              id="ventiladores_brecha_ucin_pediatrico"
                                              name="ventiladores_brecha_ucin_pediatrico"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_portatiles_ucin_pediatrico?>"
                                              id="ventiladores_portatiles_ucin_pediatrico"
                                              name="ventiladores_portatiles_ucin_pediatrico"></td>
                                        </tr>
                                        <tr>
                                          <th>UCIN NEONATO</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_registrados_ucin_neonato?>"
                                              id="ventiladores_registrados_ucin_neonato"
                                              name="ventiladores_registrados_ucin_neonato">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_operativos_ucin_neonato?>"
                                              id="ventiladores_operativos_ucin_neonato"
                                              name="ventiladores_operativos_ucin_neonato">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_disponibles_ucin_neonato?>"
                                              id="ventiladores_disponibles_ucin_neonato"
                                              name="ventiladores_disponibles_ucin_neonato"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_alquilados_ucin_neonato?>"
                                              id="ventiladores_alquilados_ucin_neonato"
                                              name="ventiladores_alquilados_ucin_neonato">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_brecha_ucin_neonato?>"
                                              id="ventiladores_brecha_ucin_neonato"
                                              name="ventiladores_brecha_ucin_neonato"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_portatiles_ucin_neonato?>"
                                              id="ventiladores_portatiles_ucin_neonato"
                                              name="ventiladores_portatiles_ucin_neonato"></td>
                                        </tr>
                                        <tr>
                                          <th>UCI GINECO-OBSTETRICA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_registrados_uci_gineco_obstetricia?>"
                                              id="ventiladores_registrados_uci_gineco_obstetricia"
                                              name="ventiladores_registrados_uci_gineco_obstetricia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_operativos_uci_gineco_obstetricia?>"
                                              id="ventiladores_operativos_uci_gineco_obstetricia"
                                              name="ventiladores_operativos_uci_gineco_obstetricia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_disponibles_uci_gineco_obstetricia?>"
                                              id="ventiladores_disponibles_uci_gineco_obstetricia"
                                              name="ventiladores_disponibles_uci_gineco_obstetricia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_alquilados_uci_gineco_obstetricia?>"
                                              id="ventiladores_alquilados_uci_gineco_obstetricia"
                                              name="ventiladores_alquilados_uci_gineco_obstetricia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_brecha_uci_gineco_obstetricia?>"
                                              id="ventiladores_brecha_uci_gineco_obstetricia"
                                              name="ventiladores_brecha_uci_gineco_obstetricia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_portatiles_uci_gineco_obstetricia?>"
                                              id="ventiladores_portatiles_uci_gineco_obstetricia"
                                              name="ventiladores_portatiles_uci_gineco_obstetricia"></td>
                                        </tr>
                                        <tr>
                                          <th>UCIN GINECO-OBSTETRICA</th>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_registrados_ucin_gineco_obstetricia?>"
                                              id="ventiladores_registrados_ucin_gineco_obstetricia"
                                              name="ventiladores_registrados_ucin_gineco_obstetricia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_operativos_ucin_gineco_obstetricia?>"
                                              id="ventiladores_operativos_ucin_gineco_obstetricia"
                                              name="ventiladores_operativos_ucin_gineco_obstetricia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_disponibles_ucin_gineco_obstetricia?>"
                                              id="ventiladores_disponibles_ucin_gineco_obstetricia"
                                              name="ventiladores_disponibles_ucin_gineco_obstetricia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_alquilados_ucin_gineco_obstetricia?>"
                                              id="ventiladores_alquilados_ucin_gineco_obstetricia"
                                              name="ventiladores_alquilados_ucin_gineco_obstetricia">
                                          </td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_brecha_ucin_gineco_obstetricia?>"
                                              id="ventiladores_brecha_ucin_gineco_obstetricia"
                                              name="ventiladores_brecha_ucin_gineco_obstetricia"></td>
                                          <td><input type="text" class="form-control text-center"
                                              value="<?=$hospital->ventiladores_portatiles_ucin_gineco_obstetricia?>"
                                              id="ventiladores_portatiles_ucin_gineco_obstetricia"
                                              name="ventiladores_portatiles_ucin_gineco_obstetricia"></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div id="ambulancias" class="tab-pane fade in">
                                  <br />
                                  <div class="clearfix"></div>
                                  <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                                      <h4>Ambulancias</h4>
                                      <div class="table-responsive">
                                        <table class="table">
                                          <thead>
                                            <tr>
                                              <th>&nbsp;</th>
                                              <th>Registrados</th>
                                              <th>Operativos</th>
                                              <th>Radio Operativa</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th>AMBULANCIAS TIPO I</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->ambulancias_tipo_i_registradas?>"
                                                  name="ambulancias_tipo_i_registradas"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->ambulancias_tipo_i_operaivas?>"
                                                  name="ambulancias_tipo_i_operaivas"></td>
                                              <td><select class="form-control text-center"
                                                  name="ambulancias_tipo_i_radio">
                                                  <option value="0"
                                                    <?=("0"==$hospital->ambulancias_tipo_i_radio)?"selected":""?>>
                                                    No</option>
                                                  <option value="1"
                                                    <?=("1"==$hospital->ambulancias_tipo_i_radio)?"selected":""?>>
                                                    Sí</option>
                                                </select></td>
                                            </tr>
                                            <tr>
                                              <th>AMBULANCIAS TIPO II</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->ambulancias_tipo_ii_registradas?>"
                                                  name="ambulancias_tipo_ii_registradas"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->ambulancias_tipo_ii_operaivas?>"
                                                  name="ambulancias_tipo_ii_operaivas"></td>
                                              <td><select class="form-control text-center"
                                                  name="ambulancias_tipo_ii_radio">
                                                  <option value="0"
                                                    <?=("0"==$hospital->ambulancias_tipo_ii_radio)?"selected":""?>>
                                                    No</option>
                                                  <option value="1"
                                                    <?=("1"==$hospital->ambulancias_tipo_ii_radio)?"selected":""?>>
                                                    Sí</option>
                                                </select></td>
                                            </tr>
                                            <tr>
                                              <th>AMBULANCIAS TIPO III</th>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->ambulancias_tipo_iii_registradas?>"
                                                  name="ambulancias_tipo_iii_registradas"></td>
                                              <td><input type="text" class="form-control text-center"
                                                  value="<?=$hospital->ambulancias_tipo_iii_operaivas?>"
                                                  name="ambulancias_tipo_iii_operaivas"></td>
                                              <td><select class="form-control text-center"
                                                  name="ambulancias_tipo_iii_radio">
                                                  <option value="0"
                                                    <?=("0"==$hospital->ambulancias_tipo_iii_radio)?"selected":""?>>
                                                    No</option>
                                                  <option value="1"
                                                    <?=("1"==$hospital->ambulancias_tipo_iii_radio)?"selected":""?>>
                                                    Sí</option>
                                                </select></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>

                                    </div>
                                  </div>
                                </div>

                                <div id="ocurrencias" class="tab-pane fade in">
                                  <br />
                                  <div class="clearfix"></div>
                                  <div id="formOcurrencia">
                                    <div class="form-group row">
                                      <label class="col-sm-12 col-form-label">Fecha</label>
                                      <div class="col-sm-8 col-md-5 col-lg-3">

                                        <div class="form-group">
                                          <div class='input-group date datetimepicker' id="error_fecha_ocurrencia">
                                            <input type="text" class="form-control" name="fecha-ocurrencia"
                                              autocomplete="off" />
                                            <span class="input-group-addon">
                                              <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="fechaEvento" class="col-sm-12 col-form-label">Ocurrencia</label>
                                      <div class="col-sm-12">

                                        <div class="form-group">
                                          <textarea class="form-control" name="ocurrencia"
                                            autocomplete="off"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-xs-12 text-center">
                                        <button type="button" id="btn-ocurrencia"
                                          class="btn btn-primary">Agregar</button>
                                      </div>
                                    </div>
                                  </div>
                                  <br />
                                  <div class="clearfix"></div>
                                  <div class="">

                                    <table id="table-ocurrencia" class="table">
                                      <thead>
                                        <tr>
                                          <th>Fecha</th>
                                          <th>Ocurrencia</th>
                                          <th>&nbsp;</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php if($ocurrencias->num_rows() > 0){
                                                                                foreach($ocurrencias->result() as $row):
                                                                                if (strlen($row->ocurrencia) > 60) {
                                                                            ?>
                                        <tr class="ocurrencia">
                                          <td class="ocu-fecha"><?=$row->fecha?></td>
                                          <td class="tool ocu-ocu"><span
                                              class="toolt"><?=$row->ocurrencia?></span><?=substr($row->ocurrencia,0, 59)?>...
                                          </td>
                                          <td><i class="fa fa-times"></i></td>
                                        </tr>
                                        <?php 
                                                                                } else{
                                                                            ?>
                                        <tr class="ocurrencia">
                                          <td class="ocu-fecha"><?=$row->fecha?></td>
                                          <td class="ocu-ocu"><?=$row->ocurrencia?></td>
                                          <td><i class="fa fa-times"></i></td>
                                        </tr>
                                        <?php 
                                                                                }
                                                                                endforeach;
                                                                            } ?>
                                      </tbody>
                                    </table>

                                  </div>
                                </div>

                              </div>

                            </div>
                            -->
                            <div class="row">

                              <div class="col-xs-12 text-center">
                                <button type="submit" id="btnEditar" class="btn btn-primary">Editar</button>
                                <button type="button" id="btnCancelar" class="btn btn-default">Cancelar</button>
                              </div>

                              <div class="col-md-12 text-center" id="cargando"></div>

                            </div>

                          </form>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php $this->load->view("inc/footer"); ?>
      <script src="<?=base_url()?>public/js/moment.min.js"></script>
      <script src="<?=base_url()?>public/js/locale.es.js"></script>
      <script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>

    </div>

  </div>
  <script src="<?=base_url()?>public/js/hospitales/editar.js?v=<?=date("his")?>"></script>
  <script>
    editar("<?=base_url()?>");
  </script>

</body>

</html>