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
  <?php $titulo = "Módulo de Gestión Logística y de Inventarios";?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>public/css/inventario/main.css?v=<?=date("his")?>" />
  <?php $opciones = $this->session->userdata("Permisos_Opcion");?>
</head>

<body>

  <div class="wrapper theme-2-active horizontal-nav navbar-top-blue">

    <?php $this->load->view("inc/nav");?>
    <div class="page-wrapper content">
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
              <li><a href="<?=base_url()?>inventario"><span>Almacenes</span></a></li>
              <li class="active"><span>Módulo Logistico e Inventarios</span></li>
            </ol>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <h4 class="content-title">Bienes Patrimoniales o Artículos Registrados</h4>
          <div>
            <div class="chip">
                <div class="chip-head"><?=$total?></div>
                <div class="chip-content">Artículos Totales </div>
                <div class="chip-close">
                  <!-- <svg class="chip-svg" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"></path></svg> -->
                </div>
            </div>
            <?php if ($idClasificacion > 0) {?>
              <div class="chip">
                <div class="chip-head"><?=$totalClasificacion?></div>
                <div class="chip-content">Artículos Filtrados</div>
                <div class="chip-close">
                  <svg class="chip-svg" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"></path></svg>
                </div>
              </div>
            <?php }?>
          </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group has-feedback has-search col-sm-8">
              <input type="text" class="form-control" placeholder="Buscar" id="buscarArticulo">
            </div>
            <div class="col-sm-4">
              <div class="table-responsive">
                <table class="tableArticulos table table-bordered table-hover table-responsive" cellspacing="0" width="100%" hidden>
                  <thead>
                    <tr>
                      <th>Articulo Registro</th>
                      <th>Articulo</th>
                      <th>Marca</th>
                      <th>Modelo</th>
                      <th>Clasificación</th>
                      <th>Cantidad</th>
                      <th>Estado</th>
                      <th>Imagen</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($listaArticulos as $row): ?>
                      <tr>
                        <td align="center"><?=$row->IdArticulo?></td>
                        <td align="center"><?=$row->Articulo?></td>
                        <td align="center"><?=$row->Marca?></td>
                        <td align="center"><?=$row->Modelo?></td>
                        <td align="center"><?=$row->Clasificacion?></td>
                        <td align="center"><?=$row->Cantidad?></td>
                        <td align="center"><?=$row->Estado?></td>
                        <td align="center"><?=$row->imagen?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>

      <div class="row">
        <form id="formClasificacion" action="<?=base_url()?>inventario" method="POST">
          <input type="hidden" name="idClasificacion" id ="idClasificacion">
          <input type="hidden" name="nombreBuscar" id ="nombreBuscar">
          <div class="col-lg-4">
            <h1 class="my-4 content-title">SELECCIONE LA CLASIFICACION DE ARTICULOS A FILTRAR</h1>
            <div class="list-group">
              <?php if ($idClasificacion > 0) {?>
                <a class="list-group-item btn-clasificacion" data-value="">TODOS LAS CLASIFICACIONES</a>
              <?php
              } else {?>
                <a class="list-group-item btn-clasificacion active" data-value="">TODOS LAS CLASIFICACIONES</a>
              <?php }?>

              <?php foreach($listaClasificacion as $row): ?>
                <?php if ($row->idclasificacion == $idClasificacion) {?>
                  <a class="list-group-item btn-clasificacion active" data-value="<?=$row->idclasificacion?>"><?=$row->descripcion?></a>
                <?php
                } else {?>
                  <a class="list-group-item btn-clasificacion" data-value="<?=$row->idclasificacion?>"><?=$row->descripcion?></a>
                <?php }?>

              <?php endforeach; ?>
            </div>
          </div>
        </form>
        <div class="col-sm-8">
          <div class="row" id="listaStock">
            <?php foreach($listaArticulos as $row): ?>
              <div class="col-lg-4 col-md-3 mb-4 nopadding">
                <div class="product-card">
                  <div class="product-tumb">
                    <img src="<?=base_url()?>public/inventarios/fotos/<?=$row->imagen?>"  alt="">
                  </div>
                  <div class="product-details">
                    <h4><a><?=$row->Articulo?></a></h4>
                    <div class="product-bottom-details">
                      <div class="product-price">
                        STOCK <?=$row->Cantidad?>
                      </div>
                      <div class="product-links">
                        <a data-id="<?=$row->IdArticulo?>" class="product__stock"><i class="fa fa-list"></i></a>
                        <?php if($row->ficha){ ?>
                          <a data-src="<?=$row->ficha?>" class="product__file"><i class="fa fa-file-pdf-o"></i></a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <?php
    $this->load->view("inc/footer");
    ?>
    <script src="<?=base_url()?>public/js/moment.min.js"></script>
    <script src="<?=base_url()?>public/js/locale.es.js"></script>
    <script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>

  </div>
  <div class="modal fade" id="tableDetalleModal" tabindex="-1" role="dialog" aria-labelledby="tableDetalleLabel" aria-hidden="false" style="z-index: 1600;">
    <div class="modal-dialog modal-lg" role="document" style="padding-top: 10px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="registrarTableroModalLabel">Stock Actual</h5>
      </div>
      <div class="modal-body">
        <table class="tableDetalle table table-striped table-bordered table-sm table-responsive" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Articulo</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Serie</th>
              <th>Barra 01</th>
              <th>Barra 02</th>
              <th>Condición</th>
              <th>Clasificación</th>
              <th>Ubicación</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
  <script>
    var URI_MAP = "<?=base_url()?>";
  </script>
  <script src="<?=base_url()?>public/js/inventarios/principal.js?v=<?=date("his")?>"></script>

</body>

</html>
