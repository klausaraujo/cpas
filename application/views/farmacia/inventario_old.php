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
  <?php $titulo = "Inventario General de PF - EPP - MM";?>
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
          <!-- Breadcrumb -->
          <div class="col-lg-7 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="<?=base_url()?>">Inicio</a></li>
              <li><a href="<?=base_url()?>farmacia"><span>Módulo de Farmacia</span></a></li>
              <li class="active"><span>Inventario General</span></li>
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
                        <form id="formTable">
                          <div class="row">
                            <div class="col-sm-6">
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
                            <div class="col-sm-6">
                              <div class="form-group row">
                                <label class="modal-label col-sm-5 col-form-label py-10">Vía de administración</label>
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
                            <div class="col-sm-6">
                              <div class="form-group row">
                                <label class="modal-label col-sm-5 col-form-label py-10">Presentación</label>
                                  <div class="col-sm-7">
                                    <select class="form-control" name="presentacion" id="presentacion">
                                      <option value="">-- SELECCIONE --</option>
                                      <?php foreach($listaPresentacion as $row): ?>
                                      <option value="<?=$row->id?>"><?=$row->descripcion?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group row">
                                <label class="modal-label col-sm-5 col-form-label py-10">Estado</label>
                                  <div class="col-sm-7">
                                    <select class="form-control" name="estado" id="estado">
                                      <option value="">-- SELECCIONE --</option>
                                      <option value="1">Vencido</option>
                                      <option value="2">Por Vencer</option>
                                      <option value="3">Riesgo de Vencimiento</option>
                                      <option value="4">Sin Riesgo</option>
                                    </select>
                                  </div>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <button type="submit" class="btn btn-primary col-sm-12" id="btn-buscar">Buscar</button>
                            </div>
														</div>
                        </form>
                        <div class="clearfix"></div>
                        <div class="table-responsive main-table">
                          <table id="dt-select" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>SIGA</th>
                                <th>Artículo</th>
                                <th>Categoría</th>
                                <th>Presentación</th>
                                <th>Via</th>
                                <th>Unidad Medida</th>
                                <th>Lote</th>
                                <th>Vencimiento</th>
                                <th>Stock</th>
                                <th>Almacen</th>
                                <th>Estado</th>
                                <th>Semaforo</th>
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
  <script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>

  </div>
  <script>
   var URI_MAP = "<?=base_url()?>";
   var lista = JSON.parse('<?=$lista?>');
  </script>
  <script src="<?=base_url()?>public/js/farmacia/inventario.js?v=<?=date(" his")?>"></script>


</body>

</html>