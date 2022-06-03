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
  <?php $this->load->view("inc/resources"); ?>
  <?php
			$titulo = "Mantenimiento &Aacute;reas";
			$botonCrear = "Agregar Area";
		?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/tablero/gestionarTablero.css?v=<?=date(" s")?>" />
</head>
<body>
  <div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
    <?php $this->load->view("inc/nav"); ?>
    <div class="page-wrapper" style="min-height: 710px;">
      <div class="container pt-30">
        <div class="row heading-bg">
          <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">
              <?=$titulo?>
            </h5>
          </div>
          <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="<?=base_url()?>">Inicio</a></li>
              <li><a href="#"><span>Tablero Control</span></a></li>
              <li class="active"><span>Enlazar &Aacute;rea con Act. POI</span></li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-xs-12">
                <div class="panel panel-default card-view pa-0">
                  <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                      <div class="sm-data-box pa-10">
                        <div class="container-fluid">
                          <?php $message = $this->session->flashdata('mensajeSuccess'); ?>
                          <?php if($message){ ?>
                          <div class="alert alert-success">
                            <p>
                              <?= $message ?>
                            </p>
                          </div>
                          <?php } ?>
                          <?php $message = $this->session->flashdata('mensajeError'); ?>
                          <?php if($message){ ?>
                          <div class="alert alert-danger">
                            <p>
                              <?= $message ?>
                            </p>
                          </div>
                          <?php } ?>
                          <div class="col-xs-12" id="message"></div>
                          <div class="clearfix"></div>
                          <div class="row pa-10">
                            <form id="formInsertarAreas">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-xs-12">
                                    <div class="form-group col-md-4">
                                      <label for="Anio_Ejecucion">A&ntilde;o</label> <select name="Anio_Ejecucion" id="Anio_Ejecucion"
                                        class="form-control">
                                        <option value="">[Seleccione...]</option>
                                        <?php foreach($listaAnioEjecucion->result() as $row): ?>
                                        <option value="<?=$row->Anio_Ejecucion?>">
                                          <?=$row->Anio_Ejecucion?>
                                        </option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="Codigo_Sector">Sector</label> <select name="Codigo_Sector" id="Codigo_Sector"
                                        class="form-control">
                                        <option value="">[Seleccione A&ntilde;o...]</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="Codigo_Pliego">Pliego</label> <select name="Codigo_Pliego" id="Codigo_Pliego"
                                        class="form-control">
                                        <option value="">[Seleccione Sector...]</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="Codigo_Ejecutora">Ejecutora</label> <select name="Codigo_Ejecutora"
                                        id="Codigo_Ejecutora" class="form-control">
                                        <option value="">[Seleccione Pliego...]</option>
                                      </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="Codigo_Centro_Costos">Centro de Costos</label> <select name="Codigo_Centro_Costos"
                                        id="Codigo_Centro_Costos" class="form-control detalle-size">
                                        <option value="">[Seleccione Ejecutora...]</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="Codigo_Sub_Centro_Costos">Sub Centro de Costos</label>
                                      <select name="Codigo_Sub_Centro_Costos" id="Codigo_Sub_Centro_Costos" class="form-control detalle-size">
                                        <option value="">[Seleccione Centro de Costos...]</option>
                                      </select>
                                    </div>
                                    <input type="hidden" name="Codigo_Area"/>

                                    <div class="form-group col-md-4">
                                        <label class="">Siglas de Area</label> <input
                                          type="Siglas_Area" class="form-control" name="Siglas_Area"
                                          id="Siglas_Area" />
                                    </div>
                                    <div class="form-group col-md-7">
                                        <label class="">Nombre de Area</label> <input
                                          type="Nombre_Area" class="form-control" name="Nombre_Area"
                                          id="Nombre_Area" />
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="">Estado Activo</label> <input
                                          type="checkbox" class="form-check-input" name="Area_Estado"
                                          id="Area_Estado" value="1" />
                                    </div>
                                  </div>
                                  <input type="hidden" name="Codigo_Usuario"/>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" >Guardar</button>
                                  </div>
                                  <div class="col-xs-12">
                                    <table id="tbAreas" class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>C&oacute;digo</th>
                                          <th>Siglas</th>
                                          <th>Nombre</th>
                                          <th >Activo</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
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
          <?php $this->load->view("inc/footer"); ?>
        </div>
      </div>
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTablero">
        <div class="modal-dialog" role="document">
          <form id="formDelete" action="<?=base_url()?>tablero/procesoIndicador/eliminarEnlace" method="POST">
            <input type="hidden" name="Anio_Ejecucion" value="" readonly />
            <input type="hidden" name="Codigo_Area" value="" readonly />
            <input type="hidden" name="Id_Actividad_POI" value="" readonly />
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Borrar Registro</h5>
              </div>
              <div class="modal-body">
                &iquest;Seguro(a) desea Borrar el enlace?
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info">Borrar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <script src="<?=base_url()?>public/js/tablero/areas.js?v=<?=date(" s")?>"></script>
      <script>
        let Codigo_Usuario = '<?=$Codigo_Usuario?>';
        console.log(Codigo_Usuario.length)  
      </script>
</body>
</html>