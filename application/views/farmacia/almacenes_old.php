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
  <?php $titulo = "Lista General de Almacenes Registrados";?>
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
              <li class="active"><span>Lista de Almacenes</span></li>
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
                              <span>Nuevo Almacén</span>
                              <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            </label>
                          </li>
                          <li class="btn-editar">
                            <label>
                              <span>Editar Almacén</span>
                              <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            </label>
                          </li>
                        </ul>

                        <div class="table-responsive main-table">
                          <table id="dt-select" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Nombre de Almacén</th>
                                <th>Dirección Domiciliaria</th>
                                <th>Ubigeo(Distrito)</th>
                                <th>Encargado Titular</th>
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
  <script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>

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

        <form id="formRegistrar">
          <input type="hidden" class="form-control" name="id" id="id" /> 
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-6">						
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
              <div class="col-xs-6">						
                <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Dirección Domiciliaria</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <div>
                        <input type="text" class="form-control" name="direccion" id="direccion" /> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
						  <label class="col-sm-12 col-form-label">Datos del Ubigeo</label>
              <div class="col-sm-3">
                    <select class="form-control" name="departamento"
                      id="departamento">
                      <option value="">-- Regi&oacute;n --</option>
                    <?php foreach($departamentos as $row): ?>
                    <option value="<?=$row->Codigo_Departamento?>"><?=$row->Nombre?></option>
                    <?php endforeach; ?>
                  </select>
                  </div>
              <div class="col-sm-3">
                <select class="form-control" name="provincia" id="provincia">
                  <option value="">-- Elija Regi&oacute;n --</option>
                </select>
              </div>
              <div class="col-sm-3">
                <select class="form-control" name="distrito" id="distrito">
                  <option value="">-- Elija Provincia --</option>
                </select>
              </div>
              <div class="col-xs-3">						
                <div class="form-group row">
                  <label class="col-sm-5 col-form-label py-10">Código Ubigeo</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <div>
                        <input type="text" class="form-control" name="codigoUbigeo" id="codigoUbigeo" readonly/> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-9">						
                <div class="form-group row">
                  <label class="modal-label col-sm-3 col-form-label py-10">Nombre Ubigeo</label>
                  <div class="col-sm-9">
                    <div class="form-group">
                      <div>
                        <input type="text" class="form-control" name="nombreUbigeo" id="nombreUbigeo" readonly/> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
					  </div>
            <hr>
            <div class="row">
              <div class="col-xs-12">
                <strong>
                  Encargado Titular
                </strong>
              </div>
              <div class="col-xs-6">						
                <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Numero DNI</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <div class="input-group" id="error_numero_documento">
                        <input type="text" class="form-control" name="numeroDniTitular" id="numeroDniTitular" /> 
                        <span class="input-group-btn">
                          <button type="button" id="btnBuscarTitular" class="btn btn-search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-6">						
                <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Nombre Completo</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <div>
                        <input type="text" class="form-control" name="nombreTitular" id="nombreTitular" readonly/> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">						
                <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Teléfono Contacto</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <div>
                        <input type="text" class="form-control" name="telefonoTitular" id="telefonoTitular" /> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xs-12">
                <strong>
                  Encargado Suplente
                </strong>
              </div>
              <div class="col-xs-6">						
                <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Numero DNI</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <div class="input-group" id="error_numero_documento">
                        <input type="text" class="form-control" name="numeroDniSuplente" id="numeroDniSuplente" /> 
                        <span class="input-group-btn">
                          <button type="button" id="btnBuscarSuplente" class="btn btn-search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-6">						
                <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Nombre Completo</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <div>
                        <input type="text" class="form-control" name="nombreSuplente" id="nombreSuplente" readonly/> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">						
                <div class="form-group row">
                  <label class="modal-label col-sm-5 col-form-label py-10">Teléfono Contacto</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <div>
                        <input type="text" class="form-control" name="telefonoSuplente" id="telefonoSuplente" /> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="estado" name="estado">
                  <label class="form-check-label" for="estado">Almacén Activo</label>
                </div>
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


  <script src="<?=base_url()?>public/js/moment.min.js"></script>
  <script src="<?=base_url()?>public/js/locale.es.js"></script>
  <script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
  <script>
   var URI_MAP = "<?=base_url()?>";
   var lista = JSON.parse('<?=$listaAlmacenes?>');
  </script>
  <script src="<?=base_url()?>public/js/farmacia/almacenes.js?v=<?=date(" his")?>"></script>


</body>

</html>