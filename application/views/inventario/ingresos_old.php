<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>
    <?=TITULO_PRINCIPAL?>
  </title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="<?=AUTOR?>">

  <?php $this->load->view("inc/resources");?>
  <?php $titulo = "Lista General de Ingresos de Bienes Patrimoniales";?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>public/css/inventario/main.css" />
  <link rel="stylesheet" href="<?=base_url()?>public/css/enfermedad/main.css" />
  <link rel="stylesheet" href="<?=base_url()?>public/css/eventos/listaEventos.css?v=<?=date(" s")?>" />

  <?php $opciones = $this->session->userdata("Permisos_Opcion");?>
</head>

<body>

  <div class="wrapper theme-2-active horizontal-nav navbar-top-blue ">
    <?php $this->load->view("inc/header");?>
    <div class="page-wrapper">
      <div class="container pt-30">
        <div class="row heading-bg">
          <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">
              <?=$titulo?>
            </h5>
          </div>
          <!-- Breadcrumb -->
          <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="<?=base_url()?>">Inicio</a></li>
              <li><a href="<?=base_url()?>inventario"><span>Almacenes</span></a></li>
              <li class="active"><span><?=$titulo?></span></li>
            </ol>
          </div>

        </div>
      </div>
      <div class="row pl-30 pr-30">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-xs-12">
              <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                  <div class="panel-body pa-0">
                    <div class="sm-data-box pt-20">
                      <div class="container-fluid">
                        <div class="alert alert-success" role="alert" style="display:none;" >
                          Registro exitoso
                        </div>
                        <div class="alert alert-danger" role="alert" style="display:none;" >
                          Ocurrio un error
                        </div>

                        <ul class="botones-evento">
                          <li class="btn-nuevo active">
                            <span>Nuevo Guía Ingreso</span>
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                          </li>
                          <li class="btn-editar">
                            <span>Editar Guía Ingreso</span>
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                          </li>
                        </ul>

                        <div class="table-responsive main-table">
                          <table id="tableArticuloInventariado" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>AÑO</th>
                                <th>NÚMERO</th>
                                <th>EMISIÓN</th>
                                <th>TIPO DE INGRESO</th>
                                <th>ALMACÉN ASIGNADO</th>
                                <th>ADJUNTO</th>
                                <th>OBSERVACIONES</th>
                                <th>ESTADO</th>
                              </tr>
                            </thead>
                          </table>
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
      </div>
    </div>
  </div>

  <div class="modal fade modal-fullscreen" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="editarModalLabel"></h4>
        </div>

        <form id="formRegistrar" method="post" action="" autocomplete="off" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="idingreso" id ="idingreso" >
            <div class="alert alert-warning ingresos__alert" role="alert" hidden>
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
                      <div class='input-group date' id='fechaEmisionPicker'>
                        <input type="text" class="form-control" name="fechaEmision" id="fechaEmision" />
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Tipo de Ingreso</label>
                  <div class="col-sm-7">
                    <select class="form-control" name="tipoIngreso" id="tipoIngreso">
                    <option value="">-- Tipos de Ingreso --</option>
                    <?php foreach($listaTipoIngreso as $row): ?>
                    <option value="<?=$row->id?>"><?=$row->descripcion?></option>
                    <?php endforeach; ?>
                  </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group row">
                <label class="modal-label col-sm-5 col-form-label py-10">Almacén de Destino</label>
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
              <div class="col-sm-6">
                <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Archivo Adjunto</label>
                  <div class="col-sm-7">
                    <div class="input-group col-sm-12">
                      <input type="file" name="ficha" id="ficha" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                      <label for="ficha"><i class="fa fa-upload" aria-hidden="true"></i> <span class="custom-file">Escoger Archivo &hellip;</span></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <button type="button" class="btn btn-primary col-sm-12 btn-buscar">Agregar Artículo</button>
                </div>
              </div>
            </div>

            <div class="row">
              <h2 class="text-divider"><span>Lista de Artículos</span></h2>
              <div class="table-responsive main-table">
                <table class="tableArticuloIngresos table table-bordered table-responsive" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Descripción del Articulo</th>
                      <th>Marca</th>
                      <th>Modelo</th>
                      <th>Clasificación</th>
                      <th>Código Patrimonial Original</th>
                      <th>Código Patrimonial Actual</th>
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="registrarTableroModalLabel">Seleccionar Artículo</h5>
      </div>
      <div class="modal-body">
        <table class="tableArticulo table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Descripción del Articulo</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Clasificación</th>
              <th>Código Patrimonial Original</th>
              <th>Código Patrimonial Actual</th>
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
  <?php $this->load->view("inc/footer");?>
  <script src="<?=base_url()?>public/js/moment.min.js"></script>
  <script src="<?=base_url()?>public/js/locale.es.js"></script>
  <script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
  <script>
   var URI_MAP = "<?=base_url()?>";
   var lista = JSON.parse('<?=$listaIngresos?>');
  </script>
  <script src="<?=base_url()?>public/js/inventarios/ingresos.js?v=<?=date(" his")?>"></script>


</body>

</html>
