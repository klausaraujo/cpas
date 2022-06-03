<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?=TITULO_PRINCIPAL?></title>
      <meta name="author" content="<?=AUTOR?>">
      <link rel="shortcut icon" href="<?=base_url()?>public/images/favicon.jpg">
      <link rel="icon" href="<?=base_url()?>public/images/favicon.jpg" type="image/x-icon">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/typography.css">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/style.css">
      <link rel="stylesheet" href="<?=base_url()?>public/template/css/responsive.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css"/>
      <link rel="stylesheet" href="<?=base_url()?>public/css/ofertamovil/main.css?v=<?=date("s")?>" />
	   <?php $opciones = $this->session->userdata("Permisos_Opcion"); ?>
      <?php $titulo = "Lista General de Artículos Registrados"; ?>
   </head>
   <?php
    $months = array(
        array("id"=>1,"name"=>"Enero"),
        array("id"=>2,"name"=>"Febrero"),
        array("id"=>3,"name"=>"Marzo"),
        array("id"=>4,"name"=>"Abril"),
        array("id"=>5,"name"=>"Mayo"),
        array("id"=>6,"name"=>"Junio"),
        array("id"=>7,"name"=>"Julio"),
        array("id"=>8,"name"=>"Agosto"),
        array("id"=>9,"name"=>"Septiembre"),
        array("id"=>10,"name"=>"Octubre"),
        array("id"=>11,"name"=>"Noviembre"),
        array("id"=>12,"name"=>"Diciembre")
    );
?>
   <body>
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <div class="wrapper">
        <?php $this->load->view("inc/nav-template");?>
         <div id="content-page" class="content-page">
            <?php $this->load->view("inc/nav-top-template");?>
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title"><?=$titulo?></h4>
                              </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3">Tipo de Evento</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="combo" id="combo">
                                            <option value="">-- SELECCIONE --</option>
                                            <?php
                                                foreach($lista->result() as $row):
                                            ?>
                                                <option value="<?=$row->Evento_Registro_Numero?>" <?=($row->prioridad)?'selected':''?>><?=$row->descripcion?></option>
                                            <?php
                                                endforeach;
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                  <div class="form-group row">
                                    <label class="col-sm-3">Opciones</label>
                                    <?php if(validarPermisosOpciones(33,$opciones)){ ?>
                                       <div class="col-sm-3">
                                          <button type="button" class="btn btn-primary agregar" data-toggle="modal" data-target="#eventosBuscarModal">
                                             Enlazar Evento
                                          </button>
                                       </div>
                                    <?php } ?>
                                    <?php if(validarPermisosOpciones(34,$opciones)){ ?>
                                       <div class="col-sm-3">
                                          <button type="button" class="btn btn-primary editar" id="nuevo">
                                          Ficha Atenci&oacute;n
                                          </button>
                                       </div>
                                    <?php } ?>
                                    <?php if(validarPermisosOpciones(35,$opciones)){ ?>
                                       <div class="col-sm-3">
                                          <button type="button" class="btn btn-primary exportar" id="consolidado">
                                          Reportes COE
                                          </button>
                                       </div>
                                    <?php } ?>
                                  </div>
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>
			   	  <div class="col-sm-12">
                     <div class="row">
                        <div class="col-md-6 col-lg-2">
                           <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                              <div class="iq-card-body iq-bg-primary rounded ofertamovil__card">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-user-fill"></i></div>
                                    <div class="text-right">
                                       <h2 class="mb-0"><span class="counter" id="t_total"><?=$datosDashBoard->total?></span></h2>
                                    </div>
                                 </div>
                                 <h5 class="">Total</h5>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                           <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                              <div class="iq-card-body iq-bg-warning rounded ofertamovil__card">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div class="rounded-circle iq-card-icon bg-warning"><i class="ri-men-fill"></i></div>
                                    <div class="text-right">
                                       <h2 class="mb-0"><span class="counter" id="t_hombres"><?=$datosDashBoard->hombres?></span></h2>
                                    </div>
                                 </div>
                                 <h5 class="">Varones</h5>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                           <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                              <div class="iq-card-body iq-bg-warning rounded ofertamovil__card">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div class="rounded-circle iq-card-icon bg-warning"><i class="ri-women-fill"></i></div>
                                    <div class="text-right">
                                       <h2 class="mb-0"><span class="counter" id="t_mujeres"><?=$datosDashBoard->mujeres?></span></h2>
                                    </div>
                                 </div>
                                 <h5 class="">Mujeres</h5>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                           <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                              <div class="iq-card-body iq-bg-danger rounded ofertamovil__card">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div class="rounded-circle iq-card-icon bg-danger"><i class="ri-group-fill"></i></div>
                                    <div class="text-right">
                                       <h2 class="mb-0"><span class="counter" id="t_gestantes"><?=$datosDashBoard->gestantes?></span></h2>
                                    </div>
                                 </div>
                                 <h5 class="">Gestantes</h5>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                           <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                              <div class="iq-card-body iq-bg-info rounded ofertamovil__card">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div class="rounded-circle iq-card-icon bg-info"><i class="ri-hospital-line"></i></div>
                                    <div class="text-right">
                                       <h2 class="mb-0"><span class="counter" id="t_adulto_mayor"><?=$datosDashBoard->adulto_mayor?></span></h2>
                                    </div>
                                 </div>
                                 <h5 class="">Adulto mayor</h5>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                           <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                              <div class="iq-card-body iq-bg-info rounded ofertamovil__card">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div class="rounded-circle iq-card-icon bg-info"><i class="ri-hospital-line"></i></div>
                                    <div class="text-right">
                                       <h2 class="mb-0"><span class="counter" id="t_menor_edad"><?=$datosDashBoard->menor_edad?></span></h2>
                                    </div>
                                 </div>
                                 <h5 class="">Menor edad</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                   <div class="col-sm-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Atenciones en Oferta Movil (últimos 15 días)</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <canvas id="lineChart"></canvas>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Resumén de diagnosticos</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          <canvas id="myChart"></canvas>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Resumén de diagnosticos</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          <canvas id="chart_pie"></canvas>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Total de atenciones por oferta movil</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <canvas id="polarChart"></canvas>
                        </div>
                     </div>
                  </div>
               </div>

			   <?php $this->load->view("inc/footer-template");?>
            <script src="<?=base_url()?>public/js/moment.min.js"></script>
            <script src="<?=base_url()?>public/js/locale.es.js"></script>
         </div>
      </div>
      <?php $this->load->view("inc/resource-template");?>
      <div class="modal fade modal-fullscreen" id="eventosBuscarModal" tabindex="-1" role="dialog" aria-labelledby="eventosBuscarModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <span class="modal-title">Buscar Evento</span>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form id="formBuscarEvento" name="formBuscarEvento" method="post" action="">
               <input type="hidden" name="id" />
               <input type="hidden" name="Registro_Evento_Numero" />
               <div class="modal-body">
               <input type="hidden" name="idsalidaRegistro" id ="idsalidaRegistro" >
               <div class="alert alert-warning salida__alert" role="alert" hidden>
                  <span class="alert__span"></span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="row">
                  <div class="col-sm-4">
                     <div class="form-group row">
                        <label class="modal-label col-sm-4 col-form-label py-10">C&oacute;digo</label>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" name="correlativo" disabled />
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group row">
                        <label class="modal-label col-sm-4 col-form-label py-10">Fecha</label>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" name="fecha" disabled />
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <button type="button" id="btnBuscar" class="btn btn-primary col-sm-12">Buscar</button>
                  </div>
                  <div class="col-sm-8">
                     <div class="form-group row">
                     <label class="modal-label col-sm-2 col-form-label py-10">Registro de Actividad</label>
                     <div class="col-sm-10">
                        <input type="text" class="form-control" name="descripcion" placeholder="Descripción de la actividad"/>
                     </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <button type="submit" id="btnEvento" class="btn btn-primary col-sm-12 btn-buscar" disabled>Gestionar</button>
                  </div>
                  <div class="col-md-12 text-center cargando"></div>
               </div>
               
               <div class="row">
                  <div class="table-responsive main-table">
                     <table class="tableAtencion table table-striped table-bordered" width="100%">
                     <thead>
                        <tr>								
                           <th class="text-center">N&deg;</th>
                           <th>Evento Producido</th>
                           <th>Fecha</th>
                           <th>Ubicaci&oacute;n Evento(UBIGEO)</th>
                           <th>Descripci&oacute;n</th>
                           <th>Estado</th>
                           </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr/>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               </div>
            </form>
         </div>
         </div>
      </div>
      <div class="modal fade" id="eventosModal" tabindex="-1" role="dialog" aria-labelledby="eventosModalLabel" aria-hidden="true" style="z-index: 1600;">
         <div class="modal-dialog modal-lg" role="document"
            style="padding-top: 10px;">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="eventosModalLabel">Seleccionar Evento</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="form-group row">
                     <label class="col-sm-12 col-form-label">Filtros</label>
                     <div class="col-sm-3">
                        <select class="form-control" name="Anio_Ejecucion" id="Anio_Ejecucion">
                           <?php foreach($listaAnioEjecucion->result() as $row): ?>
                           <option value="<?=$row->Anio_Ejecucion?>" <?=($row->Anio_Ejecucion==date("Y"))?"selected":""?>><?=$row->Anio_Ejecucion?></option>
                           <?php endforeach; ?>
                           </select>
                     </div>
                     <div class="col-sm-3">
                        <select class="form-control" name="mes" id="mes">
                        <?php foreach($months as $row): ?>
                        <option value="<?=$row["id"]?>" <?=($row["id"]==date("m"))?"selected":""?>><?=$row["name"]?></option>
                        <?php endforeach; ?>
                        </select>
                     </div>
                  </div>
                  <table class="tableEventos table table-striped table-bordered table-sm" width="100%">
                     <thead>
                        <tr>
                           <th class="text-center">N&deg;</th>
                           <th>Evento Producido</th>
                           <th>Fecha</th>
                           <th>Ubicaci&oacute;n Evento(UBIGEO)</th>
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
      <div class="modal fade" id="deleteAtencionModal" tabindex="-1" role="dialog" style="z-index: 1600;">
         <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form id="formEliminar" method="post" action="">
               <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  <h5 class="modal-title">Eliminar Atenci&oacute;n</h5>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="id" />
                  <p>&iquest;Seguro desea eliminar la atenci&oacute;n <span id="eventoCodigo"></span>?</p>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">Eliminar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               </div>
            </form>
         </div>
         </div>
      </div>
      <script>
        var URI_MAP = "<?=base_url()?>";
      </script>
      <script src="<?=base_url()?>public/js/ofertamovil/main.js?v=<?=date("s")?>"></script>
	  <script>
		var labelCie = '<?=json_encode($labelCie)?>';
		var dataCie = '<?=json_encode($dataCie)?>';
		var labelPie = '<?=json_encode($labelPie)?>';
		var dataPie = '<?=json_encode($dataPie)?>';
		var ofertaMovilLines = '<?=json_encode($ofertaMovilLines)?>';
		var fechaLines = '<?=json_encode($fechaLines)?>';
		var cantidadLines = '<?=json_encode($cantidadLines)?>';
		var labelPolar = '<?=json_encode($labelPolar)?>';
		var dataPolar = '<?=json_encode($dataPolar)?>';
      console.log({labelCie, dataCie, labelPie, dataPie, ofertaMovilLines, fechaLines, cantidadLines, labelPolar, dataPolar})
		main('<?=base_url()?>', labelCie, dataCie, labelPie, dataPie, ofertaMovilLines, fechaLines, cantidadLines, labelPolar, dataPolar);
	  </script>
   </body>
</html>