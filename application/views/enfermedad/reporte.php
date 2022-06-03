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
<?php $titulo = "Lista General de Almacenes";?>
<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="<?=base_url()?>public/css/enfermedad/main.css" />
<link rel="stylesheet" href="<?=base_url()?>public/css/eventos/listaEventos.css?v=<?=date(" s")?>" />
<?php $opciones = $this->session->userdata("Permisos_Opcion");?>
</head>
<body>
<div class="wrapper theme-2-active horizontal-nav navbar-top-blue slide-nav-toggle">
  <?php $this->load->view("inc/header");?>
  <div class="page-wrapper wrapper content">
          <div class="container-fluid">
              <div class="alert alert-success" role="alert" style="display:none;" >
                Registro exitoso
              </div>
              <div class="alert alert-danger" role="alert" style="display:none;" >
                Ocurrio un error
              </div>
              <div class="row">
                  <div class="col-sm-12">
                      <div class="page-title-box">
                          <h2 class="page-title pb-20">
                            <strong>
                            Lista Básica de Pacientes Registrados (COVID-19)
                            </strong>
                          </h2>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-xl-12 col-md-12">
                      <div class="card m-b-30 pb-35">
                          <div class="card-body">
                              <br>
                              <div class="table-responsive">
                                  <table class="tablaPaciente table table-hover mb-0">
                                  </table>
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
<script src="<?=base_url()?>public/js/moment.min.js"></script>
<script src="<?=base_url()?>public/js/locale.es.js"></script>
<script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
<script>
  var URI_MAP = "<?=base_url()?>";
  var lista = JSON.parse('<?=$pacientes?>');
</script>
<script src="<?=base_url()?>public/js/enfermedad/reporte.js?v=<?=date(" his")?>"></script>
</body>
</html>