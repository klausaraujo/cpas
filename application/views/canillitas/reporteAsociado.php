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
	<?php $titulo = "Reporte de Mapa de Eventos Monitoreados"; ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="<?=base_url()?>public/css/mapas/main.css" />
</head>

<body>

	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue slide-nav-toggle">

		<?php $this->load->view("inc/header"); ?>
    <div class="content">
      <div class="row row_map">
        <div class="col-sm-4 form__maps">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form__title">
            <h1 class="txt-dark">
              <?=$titulo?>
            </h1>
          </div>
          <form name="formMapaEventos" id="formMapaEventos" method="post">
            <div class="form__content">
              <div class="form-group">
                <div class="col-xl-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <label class="">Evento asociado</label>
                    <select class="form-control form-control-sm" name="asociado" required="required" id="asociado">
                      <option value="0">-- SELECCIONE --</option>
                      <?php foreach ($listaAsociado as $row): ?>
                      <option value="<?=$row->Id?>">
                        <?=$row->Nombre?>
                      </option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="col-sm-12 form__button">
              <div class="col-sm-12">
                <button type="submit" id="btnObtenerReporte" class="btn btn-primary col-md-12">
                  Mostrar Reporte dentro del Mapa
                </button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-sm-8 maps">
          <div id="divMap" class="maps__content"></div>
        </div>
      </div>
    </div>
		<!-- Main Content -->
		<!-- <div class="page-wrapper" style="min-height: 710px;">
			<div class="container">
					
			</div>
    </div> -->
    
    <div class="modal fade" id="leyendaMapa" tabindex="-1" role="dialog" aria-labelledby="condicionModalLabel" style="margin-top: -15px;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Leyenda</h5>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
            <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_natural.png" width="25" /></td>
                <td>Eventos Naturales</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_antropico.png" width="25" /></td>
                <td>Eventos Antr&oacute;pico</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_sanitario.png" width="25" /></td>
                <td>Eventos Sanitarios</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_explosion.png" width="25" /></td>
                <td>Explosiones</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_forestal.png" width="25" /></td>
                <td>Incendios Forestales</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_friaje.png" width="25" /></td>
                <td>Friajes</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_helada.png" width="25" /></td>
                <td>Heladas</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_incendio.png" width="25" /></td>
                <td>Incendios Urbanos</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_sismos.png" width="25" /></td>
                <td>Sismos y Terremotos</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_lluvias.png" width="25" /></td>
                <td>Lluvias Intensas</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_transito.png" width="25" /></td>
                <td>Accidentes de Transito</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_vientos.png" width="25" /></td>
                <td>Vientos Fuertes</td>
              </tr>
              <tr>
                <td><img src="<?=base_url()?>public/map/icons/ic_volcan.png" width="25" /></td>
                <td>Actividades Volc&aacute;nicas</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

		<div id="floating-panel" class="text-center">
			<div class="card">
				<table class="table table-bordered">
					<tr>
						<td><img src="<?=base_url()?>public/map/natural.png" width="25" /></td>
						<td>Natural</td>
					</tr>
					<tr>
						<td><img src="<?=base_url()?>public/map/antropico.png" width="25" /></td>
						<td>Antr&oacute;pico</td>
					</tr>
					<tr>
						<td><img src="<?=base_url()?>public/map/sanitario.png" width="25" /></td>
						<td>Sanitario</td>
					</tr>
				</table>
			</div>
		</div>

		<?php $this->load->view("inc/footer"); ?>
		<script src="<?=base_url()?>public/js/moment.min.js"></script>
		<script src="<?=base_url()?>public/js/locale.es.js"></script>
		<script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>

	</div>

	<script src="https://maps.googleapis.com/maps/api/js?key=<?=getenv('MAP_KEY')?>&libraries=drawing"></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_01.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_02.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_03.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_04.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_05.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_06.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_07.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_08.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_09.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_10.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_11.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_12.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_13.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_14.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_15.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_16.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_17.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_18.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_19.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_20.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_21.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_22.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_23.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_24.js'></script>
	<script type='text/javascript' src='<?=base_url()?>public/map/latlng/latlng_25.js'></script>
	<script type="text/javascript" src="<?=base_url()?>public/map/djperu_ind.js"></script>
	<script>
    var URI_MAP = "<?=base_url()?>";
    var registros = [];
    var marcadores = [];


  </script>

  <script src="<?=base_url()?>public/js/mapas/initMapReporteEventosAsociado.js?v=<?=date(" his")?>"></script>
  <script src="<?=base_url()?>public/js/mapas/mapa-eventos-asociado.js?v=<?=date(" his")?>"></script>
  <script>
    mapaEventosMonitoreo(URI_MAP, 1);
  </script>
</body>

</html>