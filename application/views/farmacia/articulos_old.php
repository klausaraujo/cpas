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
  <?php $titulo = "Lista General de PF - EPP - MM";?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>public/css/farmacia/main.css" />
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
          <div class="col-lg-7 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="<?=base_url()?>">Inicio</a></li>
              <li><a href="<?=base_url()?>farmacia"><span>Módulo de Farmacia</span></a></li>
              <li class="active"><span>Lista de Artículos Registrados</span></li>
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
                            <label>
                              <span>Nuevo Artículo</span>
                              <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            </label>
                          </li>
                          <li class="btn-editar">
                            <label>
                              <span>Editar Artículo</span>
                              <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            </label>
                          </li>
                        </ul>

                        <div class="table-responsive main-table">
                          <table id="dt-select" class="table table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Descripción de Artículo</th>
                                <th>Categoria</th>
                                <th>Via Administración</th>
                                <th>Presentacion</th>
                                <th>Foto</th>
                                <th>Ficha</th>
                                <th>Estado</th>
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

  <?php $this->load->view("inc/footer");?>
  <script src="<?=base_url()?>public/js/moment.min.js"></script>
  <script src="<?=base_url()?>public/js/locale.es.js"></script>

  </div>

  <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="editarModalLabel"></h5>
        </div>

        <form id="formRegistrar" method="post" action="" autocomplete="off" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="idarticulo" id ="idarticulo" >
            <div class="row">
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group row">
                      <label class="modal-label col-sm-5 col-form-label py-10">Código SIGA</label>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <div>
                            <input type="text" class="form-control" name="siga" id="siga" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group row">
                      <label class="modal-label col-sm-5 col-form-label py-10">Nombre / Descripción</label>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <div>
                            <input type="text" class="form-control" name="nombre" id="nombre" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                  <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Categoría</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="categoria" id="categoria">
                        <option value="">-- SELECCIONE --</option>
                        <?php foreach($listaCategoria as $row): ?>
                        <option value="<?=$row->id?>"><?=$row->descripcion?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                  <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Vía de Administración</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="administracion" id="administracion">
                        <option value="">-- SELECCIONE --</option>
                        <?php foreach($listaViaAdministracion as $row): ?>
                        <option value="<?=$row->id?>"><?=$row->descripcion?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                  <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Presentación</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="presentacion" id="presentacion">
                        <option value="">-- SELECCIONE --</option>
                      </select>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                  <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Medida</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="medida" id="medida">
                        <option value="">-- SELECCIONE --</option>
                        <?php foreach($listaMedida as $row): ?>
                        <option value="<?=$row->id?>"><?=$row->descripcion?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group row">
                      <label class="modal-label col-sm-5 col-form-label py-10">Ficha Técnica</label>
                      <div class="col-sm-7">
                        <div class="input-group col-sm-12">
                          <input type="file" name="ficha" id="ficha" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                          <label for="ficha"><i class="fa fa-upload" aria-hidden="true"></i> <span class="custom-file">Escoger Ficha &hellip;</span></label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="checkbox checkbox-primary">
                      <input id="estado" type="checkbox" name="estado" checked>
                      <label for="estado">
                      Artículo Activo
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
              <div class="form-group row">
                <div id='product-tumb' class="img_content">
                  <img class="img__form-farmacia" id="imagen" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="/>
                </div>
                <br>
                <div class="col-sm-12">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <div class="input-group col-sm-12">
                        <input type="file" name="file" id="file" class="inputfile inputfile-1" aria-describedby="inputGroupFileAddon01" />
                        <label for="file"><i class="fa fa-upload" aria-hidden="true"></i> <span class="custom-file-img">Escoger Imagen&hellip;</span></label>
                      </div>
                    </div>
                  </div>
                </div>
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

  <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Foto de Artículo</h4>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
  </div>


  <script src="<?=base_url()?>public/js/moment.min.js"></script>
  <script src="<?=base_url()?>public/js/locale.es.js"></script>
  <script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
  <script>
   var URI_MAP = "<?=base_url()?>";
   var lista = JSON.parse('<?=$listaArticulos?>');
  </script>
  <script src="<?=base_url()?>public/js/farmacia/articulos.js?v=<?=date(" his")?>"></script>


</body>

</html>