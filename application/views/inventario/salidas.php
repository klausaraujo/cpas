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
      <?php echo link_tag("public/css/mapa.css"); ?>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css"/>
      <link rel="stylesheet" href="<?=base_url()?>public/css/inventario/main.css" />
      <?php $titulo = "Lista General Salidas de Bienes Patrimoniales"; ?>
      <?php $opciones = $this->session->userdata("Permisos_Opcion");?>
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
                           <div class="form-group row">
                            <div class="col-sm-12 col-md-5 col-md-offset-5 pa-10">
                                <button type="button" class="btn btn-primary btn-nuevo" data-toggle="modal" id="btnRegistrar">
                                  <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                  Registrar Nuevo Guía Salida
                                </button>
                            </div>
                           </div>
                           <div class="table-responsive">
                              <table id="tableArticuloInventariado" class="table table-striped table-bordered">
                                 <thead>
                                  <tr>
                                    <th>Editar</th>
                                    <th>AÑO</th>
                                    <th>NÚMERO</th>
                                    <th>EMISIÓN</th>
                                    <th>TIPO DESPLAZAMIENTO</th>
                                    <th>ALMACÉN ASIGNADO</th>
                                    <th>ADJUNTO</th>
                                    <th>OBSERVACIONES</th>
                                    <th>ESTADO</th>
                                    <th>DOCUMENTO</th>
                                  </tr>
                                 </thead>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
              <div class="modal fade modal-fullscreen" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <span class="modal-title" id="editarModalLabel"></span>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="formRegistrar" method="post" action="" autocomplete="off">
                      <div class="modal-body">
                        <input type="hidden" name="idsalidaRegistro" id ="idsalidaRegistro" >
                        <div class="alert alert-warning salida__alert" role="alert" hidden>
                          <span class="alert__span"></span>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label class="modal-label col-sm-5 col-form-label py-10">Año de Ejecución</label>
                              <div class="col-sm-7">
                                <select class="form-control" name="anio" id="anio">
                                  <option value="">[Seleccione]</option>
                                  <?php foreach ($listaAnioEjecucion->result() as $row): ?>
                                  <?php if ($row->Anio_Ejecucion == $anio) {?>
                                  <option value="<?=$row->Anio_Ejecucion?>" selected>
                                    <?=$row->Anio_Ejecucion?>
                                  </option>
                                  <?php
                                  } else {?>
                                  <option value="<?=$row->Anio_Ejecucion?>">
                                    <?=$row->Anio_Ejecucion?>
                                  </option>
                                  <?php }?>
                                  <?php endforeach;?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label class="modal-label col-sm-5 col-form-label py-10">Fecha de Emision</label>
                              <div class="col-sm-7">
                                <div class="form-group">
                                  <div class='input-group'>
                                    <input type="date" class="form-control" name="fechaEmision" id="fechaEmision" value="<?php echo date('Y-m-d'); ?>" max="<?= date("Y-m-d") ?>"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label class="modal-label col-sm-5 col-form-label py-10">Tipo Desplazamiento</label>
                              <div class="col-sm-7">
                                <select class="form-control" name="tipoDesplazamiento" id="tipoDesplazamiento">
                                <option value="">-- Tipos de Desplazamiento --</option>
                                <?php foreach($listaDesplazamiento as $row): ?>
                                <option value="<?=$row->idtipodesplazamiento?>"><?=$row->descripcion?></option>
                                <?php endforeach; ?>
                              </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group row">
                            <label class="modal-label col-sm-5 col-form-label py-10">Almacén de Salida</label>
                              <div class="col-sm-7">
                                <select class="form-control" name="almacen" id="almacen">
                                  <option value="">-- Almacén --</option>
                                  <?php foreach($listaAlmacenes as $row): ?>
                                  <option value="<?=$row->idalmacen?>"><?=$row->nombre?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group row">
                            <label class="modal-label col-sm-5 col-form-label py-10">Observaciones</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="observaciones" id="observaciones" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <h2 class="text-divider"><span>Datos de la Entidad (IPRESS) Receptora</span></h2>
                        <div class="row">
                          <input type="hidden" class="form-control" name="idrenipress" id="idrenipress" />
                          <div class="col-sm-4">
                            <div class="row">
                              <label class="modal-label col-sm-12 col-form-label py-10">Código Único RENIPRESS</label>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div>
                                    <input type="text" class="form-control" name="renipress" id="renipress" readonly="readonly"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="row">
                              <label class="modal-label col-sm-12 col-form-label py-10">Institución a la que Pertenece</label>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div>
                                    <input type="text" class="form-control" name="institucion" id="institucion" readonly="readonly"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="row">
                              <label class="modal-label col-sm-12 col-form-label py-10">Nombre de la IPRESS</label>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div>
                                    <input type="text" class="form-control" name="nombreSalud" id="nombreSalud" readonly="readonly"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="row">
                              <label class="modal-label col-sm-12 col-form-label py-10">Tipo</label>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div>
                                    <input type="text" class="form-control" name="tipoSalud" id="tipoSalud" readonly="readonly"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="row">
                              <label class="modal-label col-sm-12 col-form-label py-10">Clasificación</label>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div>
                                    <input type="text" class="form-control" name="clasificacionSalud" id="clasificacionSalud" readonly="readonly"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="row">
                              <label class="modal-label col-sm-12 col-form-label py-10">Región</label>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div>
                                    <input type="text" class="form-control" name="regionSalud" id="regionSalud" readonly="readonly"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <label class="modal-label col-sm-12 col-form-label py-10"><br></label>
                            <button type="button" class="btn btn-primary col-sm-12" id="btnBuscarRenipress" data-toggle="modal" data-target="#tableEntidadesSaludModal">Buscar</button>
                          </div>
                          <div class="col-sm-4">
                            <div class="row">
                              <label class="modal-label col-sm-12 col-form-label py-10">Coordenada Geográficas (IPRESS)</label>
                              <div class="col-sm-8">
                                <div class="form-group">
                                  <div>
                                    <input type="text" class="form-control" name="ipressUbicacion" id="ipressUbicacion" readonly="readonly"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <button type="button" class="btn btn-primary col-sm-12" id="btnIpressUbicacion">Buscar</button>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="row">
                              <label class="modal-label col-sm-12 col-form-label py-10">Enlazar Número Evento SIREED</label>
                              <div class="col-sm-8">
                                <div class="form-group">
                                  <div>
                                    <input type="text" class="form-control" name="numeroEvento" id="numeroEvento" readonly="readonly"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <button type="button" class="btn btn-primary col-sm-12" id="btnBuscarEvento">Buscar</button>
                              </div>
                            </div>
                          </div>
                          <input type="hidden" class="form-control" name="idEvento" id="idEvento"/>
                          <div class="col-sm-4">
                            <div class="row">
                              <label class="modal-label col-sm-12 col-form-label py-10">Coordenadas Geográficas (Evento SIREED)</label>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div>
                                    <input type="text" class="form-control" name="numeroEventoUbicacion" id="numeroEventoUbicacion" readonly="readonly"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="row">
                              <label class="modal-label col-sm-12 col-form-label py-10">Region Evento</label>
                              <div class="col-sm-12">
                                <select class="form-control" name="departamentoEvento" id="departamentoEvento">
                                <option value="">-- Elija Regi&oacute;n --</option>
                                <?php foreach ($departamentos as $row): ?>
                                <option value="<?=$row->Codigo_Departamento?>"><?=$row->Nombre?></option>
                                <?php endforeach;?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="row">
                              <label class="modal-label col-sm-12 col-form-label py-10">Provincia Evento</label>
                              <div class="col-sm-12">
                                <select class="form-control" name="provinciaEvento" id="provinciaEvento">
                                  <option value="">-- Elija Provincia --</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="row">
                              <label class="modal-label col-sm-12 col-form-label py-10">Distrito Evento</label>
                              <div class="col-sm-12">
                                <select class="form-control" name="distritoEvento" id="distritoEvento">
                                  <option value="">-- Elija Distrito --</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <h2 class="text-divider"><span>Datos de Receptor</span></h2>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <div class="form-group row">
                              <label class="col-sm-12 col-form-label py-10">Número de Documento</label>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div>
                                    <input type="text" class="form-control" name="numeroDocumento" id="numeroDocumento" />
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group row">
                              <label class="col-sm-12 col-form-label py-10">Nombre Completo</label>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div>
                                    <input type="text" class="form-control" name="nombreReceptor" id="nombreReceptor" readonly/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4" style="margin-top: 35px;">
                            <button type="button" class="btn btn-primary col-sm-12" id="btnBuscarPaciente">Buscar</button>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <button type="button" class="btn btn-primary col-sm-12 btn-buscar" disabled>Agregar Artículo</button>
                          </div>
                        </div>
                        <div class="row">
                          <h2 class="text-divider"><span>Lista de Artículos</span></h2>
                          <div class="table-responsive main-table">
                            <table class="tableArticuloIngresos table table-bordered" cellspacing="0" width="100%">
                              <thead>
                                <tr>
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
                            </table>
                          </div>
                        </div>
                        <hr/>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="tableArticuloModal" tabindex="-1" role="dialog" aria-labelledby="tableArticuloLabel" aria-hidden="false" style="z-index: 1600;">
                <div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
                  <div class="modal-content">
                    <div class="modal-header">
                      <span class="modal-title" id="registrarTableroModalLabel">Seleccionar Artículo</span>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <div class="col-sm-4">
                      <div class="form-group row">
                        <label class="col-sm-12 col-form-label py-10">Buscar Artículos</label>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <input type="text" class="form-control" name="searchArticulo" id="searchArticulo" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                       <span class="search__span" style="display:none">Se agregó exitosamente</span>
                    </div>
                    <div class="table-responsive">
                    <table class="tableArticulo table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
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
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="tableEntidadesSaludModal" tabindex="-1" role="dialog" aria-labelledby="tableEntidadesSaludModalLabel" aria-hidden="false" style="z-index: 1600;">
                <div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
                  <div class="modal-content">
                    <div class="modal-header">
                      <span class="modal-title" id="registrarTableroModalLabel">Seleccionar Entidad de Salud</span>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Datos del Ubigeo</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="departamento" id="departamento">
                              <option value="">-- Regi&oacute;n --</option>
                              <?php foreach ($departamentos as $row): ?>
                              <option value="<?=$row->Codigo_Departamento?>"><?=$row->Nombre?></option>
                              <?php endforeach;?>
                          </select>
                          </div>
                          <div class="col-sm-3">
                            <select class="form-control" name="provincia" id="provincia">
                              <option value="">-- Elija Provincia --</option>
                            </select>
                          </div>
                          <div class="col-sm-3">
                            <select class="form-control" name="distrito" id="distrito">
                              <option value="">-- Elija Distrito --</option>
                            </select>
                          </div>
                          <div class="col-sm-3">
                            <button id="btnFiltrarUbigeo" class="btn btn-primary col-sm-12">Buscar IPRESS</button>
                          </div>
                      </div>
                      <div class="table-responsive">
                      <table
                        class="tableEntidadesSalud table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>C&oacute;digo</th>
                            <th>Nombre IPRESS</th>
                            <th>Clasificaci&oacute;n</th>
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
              <div class="modal fade" id="documentoModal" tabindex="-1" role="dialog" aria-labelledby="modalDocumento" aria-hidden="true" >
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <span class="modal-title" id="modalDocumento">Documento Adjunto de Salida</span>
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    </div>
                    <form id="formDocumentoRegistrar" method="post" action="" autocomplete="off" enctype="multipart/form-data">
                    <div class="modal-body">
                      <div class="col-xs-12">
                          <input type="hidden" name="idsalida" id ="idsalida" >
                          <div class="form-group row">
                            <label class="modal-label col-sm-5 col-form-label py-10">Archivo Adjunto</label>
                            <div class="col-sm-7">
                              <div class="input-group col-sm-12">
                                <input type="file" name="ficha" id="ficha" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                                <label for="ficha"><i class="fa fa-upload" aria-hidden="true"></i> <span class="custom-file">Escoger Ficha &hellip;</span></label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="modal fade" id="eventosModal" tabindex="-1" role="dialog"  aria-labelledby="eventosModalLabel" aria-hidden="true" style="z-index: 1600;">
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
                                   <option value="<?=$row->Anio_Ejecucion?>" <?=($row->Anio_Ejecucion==date("Y"))?"selected":""?>><?=$row->Anio_Ejecucion?></option>
                                   <?php endforeach; ?>
                                   </select>
                             </div>
                             <div class="col-sm-3">
                                <select class="form-control" name="mes" id="mes">
                                <?php foreach($months as $row): ?>
                                <option value="<?=$row["id"]?>" <?=($row["id"]==date("m"))?"selected":""?>><?=$row["name"]?></option>
                                <?php endforeach; ?>
                                </select>
                             </div>
                          </div>
                          <div class="table-responsive">
                          <table class="tableEventos table table-striped table-bordered" width="100%">
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
              </div>
              <div class="modal fade" id="mapModal" tabindex="-1" role="dialog"  aria-labelledby="mapModalLabel" aria-hidden="true" style="z-index: 1600;">
                 <div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
                    <div class="modal-content">
                       <div class="modal-header">
                          <h4 class="modal-title" id="eventosModalLabel">Seleccionar Coordenadas Geográficas</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                       </div>
                       <div class="modal-body">
                          <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Datos del Ubigeo</label>
														<div class="col-sm-4">
															<select class="form-control" name="departamentoMap" id="departamentoMap">
                                <option value="">-- Regi&oacute;n --</option>
                                <?php foreach ($departamentos as $row): ?>
                                <option value="<?=$row->Codigo_Departamento?>"><?=$row->Nombre?></option>
                                <?php endforeach;?>
              								</select>
														</div>
														<div class="col-sm-4">
															<select class="form-control" name="provinciaMap"
																id="provinciaMap">
																<option value="">-- Elija Regi&oacute;n --</option>
															</select>
														</div>
														<div class="col-sm-4">
															<select class="form-control" name="distritoMap"
																id="distritoMap">
																<option value="">-- Elija Provincia --</option>
															</select>
														</div>
                            <br>
                            <div class="col-sm-12">
                                <input id="ubicacion" name="ubicacion" class="controls form-control" type="text" placeholder="direcci&oacute;n, ciudad, departamento" />
  															<div id="map"></div>
  															<input type="hidden" name="latitud" id="latitud" />
                                <input type="hidden" name="longitud" id="longitud" />
                            </div>
                          </div>
                       </div>
                       <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary btnMap">Guardar</button>
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
      <script>
        var URI_MAP = "<?=base_url()?>";
        var lista = JSON.parse('<?=$listaSalida?>');
        var generalZoom = 13;
      </script>
	    <script src="<?=base_url()?>public/js/inventarios/initMap.js"></script>
      <script src="<?=base_url()?>public/js/inventarios/salidas.js?v=<?=date(" his")?>"></script>
	    <script src="http://maps.googleapis.com/maps/api/js?key=<?=getenv('MAP_KEY')?>&libraries=places&callback=initMap" async defer></script>
   </body>
</html>
