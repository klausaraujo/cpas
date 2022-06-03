<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport"
  content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?=TITULO_PRINCIPAL?></title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="<?=AUTOR?>">
  <?php
$this->load->view("inc/resources");
$titulo = "Gesti&oacute;n de Módulos por Perfil";
$botonCrear = "Registrar Módulos por Perfil";
?>
</head>
<body>
  <div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
  <?php $this->load->view("inc/nav"); ?>
    <div class="page-wrapper" style="min-height: 710px;">
      <div class="container pt-30">
        <div class="row heading-bg">
          <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark"><?=$titulo?></h5>
          </div>
          <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="<?=base_url()?>">Inicio</a></li>
              <li><a href="<?=base_url()?>tablas/main"><span>Tablas Padre</span></a></li>
              <li class="active"><span>Módulos por Perfil</span></li>
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

    <div id="div-alerta-success" class="d-none alert alert-success">
    	<span>Permisos modificados</span>
    </div>
        <?php $message = $this->session->flashdata('mensajeSuccess'); ?>
            <?php if($message){ ?>
              <div class="alert alert-success">
                                    <span><?= $message ?></span>
                                  </div>
            <?php } ?>
            <?php $message = $this->session->flashdata('mensajeError'); ?>
            <?php if($message){ ?>
              <div class="alert alert-danger">
                                    <span><?= $message ?></span>
                                  </div>
            <?php } ?>
            <?php $message = $this->session->flashdata('mensajeWarning'); ?>
            <?php if($message){ ?>
              <div class="alert alert-warning">
                                    <span><?= $message ?></span>
                                  </div>
            <?php } ?>
      <div class="row">
                            <div class="col-xs-12 pull-right pa-10">
                              <button type="button" class="btn btn-primary pull-right" id="btn-crear">
									<?=$botonCrear?>
								</button>
                            </div>
                          </div>
                          <div class="table-responsive">
                            <table id="tbLista" class="table table-bordered table-sm">
                              <thead>
                                <tr>
                                  <th class="text-center">Perfil</th>
                                  <th class="text-center">C&oacute;digo</th>
                                  <th class="text-center">Módulo</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                if ($lista->num_rows() > 0) {
                                foreach ($lista->result() as $row) :
                                    ?>
                              <tr>
                                  <td align="center"><?=$row->Descripcion_Perfil?></td>
                                  <td align="center"><?=$row->idmodulorol?></td>
                                  <td align="center"><?=$row->descripcion?></td>
                                  <td align="center">
                                    <button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button">
                                      <i class="fa fa-pencil-square-o"></i>
                                    </button>
                                  </td>
                                  <td align="center">
                                    <button class="btn btn-danger btn-circle actionDelete" title="ELIMINAR" type="button">
                                      <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                  </td>
                                  <td align="center"><?=$row->Codigo_Perfil?></td>
                                  <td align="center"><?=$row->idmodulo?></td>
                                </tr>
                                  <?php
                                    endforeach;
                                    }
                                    ?>
                                </tbody>
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
      <?php $this->load->view("inc/footer"); ?>
    </div>
  </div>
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalLabel">
    <div class="modal-dialog" role="document">
      <form id="formEliminar" action="<?=base_url()?>tablas/main/perfiles-modulo-eliminar" method="POST">
        <input type="hidden" name="idmodulorol" value="" readonly />
        <input type="hidden" name="Tipo_Accion_Entidad_Codigo" value="" readonly />
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"
              aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Eliminar Modulo del Perfil</h5>
          </div>
          <div class="modal-body">
            &iquest;Seguro(a) que desea Borrar el Modulo <strong id="elementoEliminar"></strong> del Perfil ?
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger">Borrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="registrarModal" tabindex="-1" role="dialog"
    aria-labelledby="registrarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="registrarTableroModalLabel">Registrar Módulo por Perfil</h5>
        </div>
        <form id="formRegistrar" name="formRegistrar" action="<?=base_url()?>tablas/main/perfiles-modulo-gestionar" method="POST">
          <div class="modal-body">
			<input type="hidden" name="idmodulorol" value="" readonly />
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Seleccionar Perfil</label> 
				  <select class="form-control" name="Codigo_Perfil" tabindex="-1">
				  	<option value="">[Seleccione]</option>
				  	<?php if($listarperfiles->num_rows() > 0) {
				  	         foreach($listarperfiles->result() as $row):
				  	    ?>
				  	<option value="<?=$row->Codigo_Perfil?>"><?=$row->Descripcion_Perfil?></option>
				  	<?php 
				  	         endforeach;
				  	} ?>
				  </select>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                <label class="">Seleccionar Modulo</label> 
				  <select class="form-control" name="idmodulo" tabindex="-1">
				  	<option value="">[Seleccione]</option>
				  	<?php if($listarmodulos->num_rows() > 0) {
				  	         foreach($listarmodulos->result() as $row):
				  	    ?>
				  	<option value="<?=$row->idmodulo?>"><?=$row->descripcion?></option>
				  	<?php 
				  	         endforeach;
				  	} ?>
				  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="<?=base_url()?>public/js/tablas/perfilesModulo.js?v=<?=date("s")?>"></script>
  <script>
	perfilesModulo("<?=base_url()?>");
  </script>
</body>
</html>