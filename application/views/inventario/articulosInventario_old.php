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
  <?php $titulo = "Lista General de Artículos Inventariados";?>
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
          <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">
              <?=$titulo?>
            </h5>
          </div>
          <!-- Breadcrumb -->
          <div class="col-lg-7 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="<?=base_url()?>">Inicio</a></li>
              <li><a href="<?=base_url()?>inventario"><span>Almacenes</span></a></li>
              <li class="active"><span>Lista de Artículos Inventariados</span></li>
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
                            <span>Nuevo Inventario</span>
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                          </li>
                          <li class="btn-editar">
                            <span>Editar Inventario</span>
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                          </li>
                        </ul>

                        <div class="table-responsive main-table">
                          <table id="tableArticuloInventariado" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Código SIGA</th>
                                <th>Descripción de Artículo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Clasificación</th>
                                <th>Código Patrimonial Original</th>
                                <th>Código Patrimonial Actual</th>
                                <th>Condición</th>
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

        <form id="formRegistrar">
          <div class="modal-body">
            <input type="hidden" name="idarticulo" id ="idarticulo" >
            <input type="hidden" name="idarticuloregistro" id ="idarticuloregistro" >
            <div class="row">
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group row">
                      <label class="modal-label col-sm-5 col-form-label py-10">Código SIGA</label>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <div>
                            <input type="text" class="form-control" name="siga" id="siga" disabled="disabled"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group row">
                      <label class="modal-label col-sm-5 col-form-label py-10">Nombre / Descripción</label>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <div>
                            <input type="text" class="form-control" name="nombre" id="nombre" disabled="disabled"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Marca</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="marca" id="marca" disabled="disabled">
                        <option value="">-- Marca --</option>
                        <?php foreach($listaMarcas as $row): ?>
                        <option value="<?=$row->idmarca?>"><?=$row->descripcion?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group row">
                      <label class="modal-label col-sm-5 col-form-label py-10">Modelo</label>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <div>
                            <input type="text" class="form-control" name="modelo" id="modelo" disabled="disabled"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group row">
                      <label class="modal-label col-sm-5 col-form-label py-10">Dimensiones</label>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <div>
                            <input type="text" class="form-control" name="dimensiones" id="dimensiones"  disabled="disabled"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group row">
                      <label class="modal-label col-sm-5 col-form-label py-10">Peso(En KG)</label>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <div>
                            <input type="text" class="form-control" name="peso" id="peso"  disabled="disabled"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                  <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Color</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="color" id="color" disabled="disabled">
                        <option value="">-- Color --</option>
                        <?php foreach($listaColor as $row): ?>
                        <option value="<?=$row->idcolor?>"><?=$row->descripcion?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                  <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Clasificación</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="clasificacion" id="clasificacion" disabled="disabled">
                        <option value="">-- Clasificación --</option>
                        <?php foreach($listaClasificacion as $row): ?>
                        <option value="<?=$row->idclasificacion?>"><?=$row->descripcion?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                  <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Unidad de Medida</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="medida" id="medida" disabled="disabled">
                        <option value="">-- Medida --</option>
                        <?php foreach($listaMedida as $row): ?>
                        <option value="<?=$row->idunidadmedida?>"><?=$row->descripcion?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <button type="button" class="btn btn-primary col-sm-12 btn-buscar">Buscar</button>
                  </div>
                </div>
              </div>
              <br>
              <div class="col-sm-6">
                <div class="form-group row">
                  <div id='product-tumb' class="img_content">
                    <img class="img_form" id="imagen" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <h2 class="text-divider"><span>Datos del Artículo</span></h2>
              <div class="col-sm-4">
                <div class="row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Número de Serie</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="serie" id="serie" />
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="row">
                  <label class="modal-label col-sm-12 col-form-label py-10">Código Patrimonial Original</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="patrimonioOriginal" id="patrimonioOriginal" />
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="row">
                  <label class="modal-label col-sm-12 col-form-label py-10">Código Patrimonial Actual</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="patrimonioActual" id="patrimonioActual" />
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
              <div class="form-group row">
                <label class="modal-label col-sm-12 col-form-label py-10">Fecha de Registro</label>
                <div class="col-sm-12">
                  <div class="form-group">
                    <div class='input-group date' id='fechaRegistroPicker'>
                      <input type="text" class="form-control" name="fechaRegistro" id="fechaRegistro" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Condición Actual</label>
                  <div class="col-sm-12">
                    <select class="form-control" name="condicionActual" id="condicionActual">
                        <option value="">-- Condicion --</option>
                        <option value="1">OPERATIVO</option>
                        <option value="2">INOPERATIVO</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <br><br>
                <div class="checkbox checkbox-primary">
                  <input id="estadoInventariado" type="checkbox" name="estadoInventariado" checked>
                  <label for="estadoInventariado">
                    Artículo Inventariado Activo
                  </label>
                </div>
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
  <div class="modal fade" id="tableArticulo" tabindex="-1" role="dialog" aria-labelledby="tableArticuloLabel" aria-hidden="false" style="z-index: 1600;">
    <div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="registrarTableroModalLabel">Seleccionar Artículo</h5>

      </div>
      <div class="modal-body">
        <table
          class="tableArticulo table table-striped table-bordered table-sm table-responsive" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Descripción del Articulo</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Clasificación</th>
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
  <?php $this->load->view("inc/footer");?>
  <script src="<?=base_url()?>public/js/moment.min.js"></script>
  <script src="<?=base_url()?>public/js/locale.es.js"></script>
  <script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
  <script>
   var URI_MAP = "<?=base_url()?>";
   var lista = JSON.parse('<?=$listaArticulos?>');
  </script>
  <script src="<?=base_url()?>public/js/inventarios/articulosInventario.js?v=<?=date(" his")?>"></script>


</body>

</html>
