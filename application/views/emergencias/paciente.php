<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?=TITULO_PRINCIPAL?></title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="<?=AUTOR?>">

	<?php $this->load->view("inc/resources"); ?>
	<?php $titulo = "Lista de Pacientes"; ?>
	<link rel="stylesheet" href="<?=base_url()?>public/css/emergencias/main.css?v=<?=date("s")?>" />
	<?php $opciones = $this->session->userdata("Permisos_Opcion"); ?>

</head>

<body>
	<?php 
	   function documento($id) {
    	    $document = "[N/A]";
    	    switch($id) {
    	        case "01": $document = "D.N.I."; break;
    	        case "02": $document = "R.U.C."; break;
    	        case "03": $document = "CARNET EXT."; break;
    	        case "04": $document = "PASAPORTE"; break;
    	        case "05": $document = "P.T.P."; break;
    	    }
    	    return $document;
    	}
	?>
	<div class="wrapper theme-2-active horizontal-nav navbar-top-blue">

	<?php $this->load->view("inc/nav"); ?>

        <!-- Main Content -->
		<div class="page-wrapper" style="min-height: 710px;">
			<div class="container pt-30">

				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark"><?=$titulo?></h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="<?=base_url()?>">Inicio</a></li>
							<li><a href="<?=base_url()?>emergencias"><span>Emergencias</span></a></li>
							<li class="active"><span>Lista de Pacientes</span></li>
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
											<div class="sm-data-box pt-20">
												<div class="container-fluid">

													<div id="message" class="col-xs-12"></div>
													
                                                <?php $idrol = $this->session->userdata("idrol"); ?>
                                                <input type="hidden"
														id="Tipo_Accion" />
													<ul class="botones-evento">
														<?php /*if(validarPermisosOpciones(12,$opciones)){*/ ?>
														<li id="btn-nuevo" class="agregar">
															<label rel=""><span>Agregar Paciente</span><i class="fa fa-file-text-o" aria-hidden="true"></i></label>
														</li>
														<?php /*}*/ ?>
														<?php /*if(validarPermisosOpciones(1,$opciones)){*/ ?>
															<li id="btn-editar" class=""><label rel=""><span>Editar Paciente</span><i class="fa fa-check" aria-hidden="true"></i></label></li>
														<?php /*}*/ ?>
															<li id="btn-eliminar" data-toggle="modal" data-target="#deleteModal" class=""><label rel=""><span>Eliminar Paciente</span><i class="fa fa-trash" aria-hidden="true"></i></label></li>
													</ul>
                                                    <div class="clearfix"></div>

													<div class="table-responsive">

														<table class="table table-bordered table-hover tbLista">
															<!-- dataTables-example -->
															<thead>
																<tr>
																	<th>IDE</th>
                                                                    <th>Tipo_Documento</th>
                                                                    <th>Num.Doc</th>
                                                                    <th>Apellidos</th>
                                                                    <th>Nombres</th>
                                                                    <th>Edad</th>
                                                                    <th>Genero</th>
                                                                    <th>Gestante</th>
                                                                    <th>Peso</th>
                                                                    <th>Talla</th>
                                                                    <th>Inicio_Sintomas</th>
                                                                    <th>Ingreso_Hospital</th>
                                                                    <th>Ingreso_UCI</th>
                                                                    <th>DM</th>
                                                                    <th>HTA</th>
                                                                    <th>ERC</th>
                                                                    <th>VIH</th>
                                                                    <th>LES</th>
                                                                    <th>ASMA</th>
                                                                    <th>TBC</th>
                                                                    <th>NM</th>
                                                                    <th>Otros</th>
                                                                    <th>EDAs</th>
                                                                    <th>Dias_EDAs</th>
                                                                    <th>Resfrio</th>
                                                                    <th>Dias_Resfrio</th>
                                                                    <th>Vacunas</th>
                                                                    <th>Detalle_Vacunas</th>
                                                                    <th>Estancia_Horas</th>
                                                                    <th>Estancia_Dias</th>
                                                                    <th>VMI</th>
                                                                    <th>VMI_Horas</th>
                                                                    <th>VMI_Dias</th>
                                                                    <th>Dolor_Articular</th>
                                                                    <th>DFM_Miembros_Superiores</th>
                                                                    <th>DFM_Miembros_Inferiores</th>
                                                                    <th>Dificultad_Respiratoria</th>
                                                                    <th>Dolor_Extremidades</th>
                                                                    <th>Dificultad_Marcha</th>
                                                                    <th>Cuadriplejia</th>
                                                                    <th>Glasgow</th>
                                                                    <th>UCI_Habitual</th>
                                                                    <th>Cama_UCIH</th>
                                                                    <th>UCI_Contingencia</th>
                                                                    <th>Cama_UCIC</th>
                                                                    <th>PA</th>
                                                                    <th>T</th>
                                                                    <th>Vasopresores_o_Inotropicos</th>
                                                                    <th>Tipo_Vas.Inot</th>
                                                                    <th>ROT</th>
                                                                    <th>Fuerza_Muscular</th>
                                                                    <th>Escala_Glasgow</th>
                                                                    <th>Electromiografia</th>
                                                                    <th>Fecha_Elect</th>
                                                                    <th>Conclusion_1</th>
                                                                    <th>Conclusion_2</th>
                                                                    <th>Velocidad</th>
                                                                    <th>Puncion_Lumbar</th>
                                                                    <th>Fecha_PL</th>
                                                                    <th>PL_Enviado</th>
                                                                    <th>Tipificacion_Viral</th>
                                                                    <th>Fecha_TV</th>
                                                                    <th>TV_Enviado</th>
                                                                    <th>Tipifacion_Bacteriana</th>
                                                                    <th>Fecha_PB</th>
                                                                    <th>PB_Enviado</th>
                                                                    <th>Isopado_Orofaringia</th>
                                                                    <th>Fecha_IO</th>
                                                                    <th>IO_Enviado</th>
                                                                    <th>Examen_Heces</th>
                                                                    <th>Fecha_EH</th>
                                                                    <th>EH_Enviado</th>
                                                                    <th>CIE10-A</th>
                                                                    <th>CIE10-A_Presuntivo</th>
                                                                    <th>CIE10-A_Definitivo</th>
                                                                    <th>CIE10-B</th>
                                                                    <th>CIE10-B_Presuntivo</th>
                                                                    <th>CIE10-B_Definitivo</th>
                                                                    <th>CIE10-C</th>
                                                                    <th>CIE10-C_Presuntivo</th>
                                                                    <th>CIE10-C_Definitivo</th>
                                                                    <th>Inmunoglobulina</th>
                                                                    <th>I.Frascos</th>
                                                                    <th>I.Dias</th>
                                                                    <th>I.Reacciones_Adversas</th>
                                                                    <th>Plasmaferesis_Albunina</th>
                                                                    <th>P.A._Frascos</th>
                                                                    <th>P.A._Dias</th>
                                                                    <th>P.A._Reacciones_Adversas</th>
                                                                    <th>Plasmaferesis_PFC</th>
                                                                    <th>P.PFC_Frascos</th>
                                                                    <th>Apache_II</th>
                                                                    <th>Fecha_CAF</th>
                                                                    <th>Fecha_Intubacion</th>
                                                                    <th>Dias_en_UCI</th>
                                                                    <th>Dias_en_VMI</th>
                                                                    <th>Modo_Ventilatorio</th>
                                                                    <th>Fecha_Modo_Ventilatorio</th>
                                                                    <th>Horas_Destete</th>
                                                                    <th>Dias_Destete</th>
                                                                    <th>Traqueostomia</th>
                                                                    <th>Fecha_Traqueostomia</th>
                                                                    <th>Fecha_Extubacion</th>
                                                                    <th>Destino_Alta_UCI</th>
                                                                    <th>Ultima_Actualizacion</th>
                                                                    <th>ID</th>
																</tr>
															</thead>
															<tbody>
																<?php 
																    
    																if ($listar->num_rows() > 0) {
    																    $n = 1;
																    
																        foreach($listar->result() as $row):

																?>
																<tr>
																	<td class="text-center"><?=$row->IDE?></td>
                                                                    <td class="text-center"><?=$row->Tipo_Documento?></td>
                                                                    <td class="text-center"><?=$row->Num_Documento?></td>
                                                                    <td class="text-center"><?=$row->Apellidos?></td>
                                                                    <td class="text-center"><?=$row->Nombres?></td>
                                                                    <td class="text-center"><?=$row->Edad?></td>
                                                                    <td class="text-center"><?=$row->Genero?></td>
                                                                    <td class="text-center"><?=$row->Gestante?></td>
                                                                    <td class="text-center"><?=$row->Peso?></td>
                                                                    <td class="text-center"><?=$row->Talla?></td>
                                                                    <td class="text-center"><?=$row->Inicio_Sintomas?></td>
                                                                    <td class="text-center"><?=$row->Ingreso_Hospital?></td>
                                                                    <td class="text-center"><?=$row->Ingreso_UCI?></td>
                                                                    <td class="text-center"><?=$row->DM?></td>
                                                                    <td class="text-center"><?=$row->HTA?></td>
                                                                    <td class="text-center"><?=$row->ERC?></td>
                                                                    <td class="text-center"><?=$row->VIH?></td>
                                                                    <td class="text-center"><?=$row->LES?></td>
                                                                    <td class="text-center"><?=$row->ASMA?></td>
                                                                    <td class="text-center"><?=$row->TBC?></td>
                                                                    <td class="text-center"><?=$row->NM?></td>
                                                                    <td class="text-center"><?=$row->Otros?></td>
                                                                    <td class="text-center"><?=$row->EDAs?></td>
                                                                    <td class="text-center"><?=$row->Dias_EDAs?></td>
                                                                    <td class="text-center"><?=$row->Resfrio?></td>
                                                                    <td class="text-center"><?=$row->Dias_Resfrio?></td>
                                                                    <td class="text-center"><?=$row->Vacunas?></td>
                                                                    <td class="text-center"><?=$row->Detalle_Vacunas?></td>
                                                                    <td class="text-center"><?=$row->Estancia_Horas?></td>
                                                                    <td class="text-center"><?=$row->Estancia_Dias?></td>
                                                                    <td class="text-center"><?=$row->VMI?></td>
                                                                    <td class="text-center"><?=$row->VMI_Horas?></td>
                                                                    <td class="text-center"><?=$row->VMI_Dias?></td>
                                                                    <td class="text-center"><?=$row->Dolor_Articular?></td>
                                                                    <td class="text-center"><?=$row->DFM_Miembros_Superiores?></td>
                                                                    <td class="text-center"><?=$row->DFM_Miembros_Inferiores?></td>
                                                                    <td class="text-center"><?=$row->Dificultad_Respiratoria?></td>
                                                                    <td class="text-center"><?=$row->Dolor_Extremidades?></td>
                                                                    <td class="text-center"><?=$row->Dificultad_Marcha?></td>
                                                                    <td class="text-center"><?=$row->Cuadriplejia?></td>
                                                                    <td class="text-center"><?=$row->Glasgow?></td>
                                                                    <td class="text-center"><?=$row->UCI_Habitual?></td>
                                                                    <td class="text-center"><?=$row->Cama_UCIH?></td>
                                                                    <td class="text-center"><?=$row->UCI_Contingencia?></td>
                                                                    <td class="text-center"><?=$row->Cama_UCIC?></td>
                                                                    <td class="text-center"><?=$row->PA?></td>
                                                                    <td class="text-center"><?=$row->T?></td>
                                                                    <td class="text-center"><?=$row->Vasopresores_o_Inotropicos?></td>
                                                                    <td class="text-center"><?=$row->Tipo_Vas_Inot?></td>
                                                                    <td class="text-center"><?=$row->ROT?></td>
                                                                    <td class="text-center"><?=$row->Fuerza_Muscular?></td>
                                                                    <td class="text-center"><?=$row->Escala_Glasgow?></td>
                                                                    <td class="text-center"><?=$row->Electromiografia?></td>
                                                                    <td class="text-center"><?=$row->Fecha_Elect?></td>
                                                                    <td class="text-center"><?=$row->Conclusion_1?></td>
                                                                    <td class="text-center"><?=$row->Conclusion_2?></td>
                                                                    <td class="text-center"><?=$row->Velocidad?></td>
                                                                    <td class="text-center"><?=$row->Puncion_Lumbar?></td>
                                                                    <td class="text-center"><?=$row->Fecha_PL?></td>
                                                                    <td class="text-center"><?=$row->PL_Enviado?></td>
                                                                    <td class="text-center"><?=$row->Tipificacion_Viral?></td>
                                                                    <td class="text-center"><?=$row->Fecha_TV?></td>
                                                                    <td class="text-center"><?=$row->TV_Enviado?></td>
                                                                    <td class="text-center"><?=$row->Tipifacion_Bacteriana?></td>
                                                                    <td class="text-center"><?=$row->Fecha_PB?></td>
                                                                    <td class="text-center"><?=$row->PB_Enviado?></td>
                                                                    <td class="text-center"><?=$row->Isopado_Orofaringia?></td>
                                                                    <td class="text-center"><?=$row->Fecha_IO?></td>
                                                                    <td class="text-center"><?=$row->IO_Enviado?></td>
                                                                    <td class="text-center"><?=$row->Examen_Heces?></td>
                                                                    <td class="text-center"><?=$row->Fecha_EH?></td>
                                                                    <td class="text-center"><?=$row->EH_Enviado?></td>
                                                                    <td class="text-center"><?=$row->CIE10A?></td>
                                                                    <td class="text-center"><?=$row->CIE10A_Presuntivo?></td>
                                                                    <td class="text-center"><?=$row->CIE10A_Definitivo?></td>
                                                                    <td class="text-center"><?=$row->CIE10B?></td>
                                                                    <td class="text-center"><?=$row->CIE10B_Presuntivo?></td>
                                                                    <td class="text-center"><?=$row->CIE10B_Definitivo?></td>
                                                                    <td class="text-center"><?=$row->CIE10C?></td>
                                                                    <td class="text-center"><?=$row->CIE10C_Presuntivo?></td>
                                                                    <td class="text-center"><?=$row->CIE10C_Definitivo?></td>
                                                                    <td class="text-center"><?=$row->Inmunoglobulina?></td>
                                                                    <td class="text-center"><?=$row->I_Frascos?></td>
                                                                    <td class="text-center"><?=$row->I_Dias?></td>
                                                                    <td class="text-center"><?=$row->I_Reacciones_Adversas?></td>
                                                                    <td class="text-center"><?=$row->Plasmaferesis_Albunina?></td>
                                                                    <td class="text-center"><?=$row->P_A_Frascos?></td>
                                                                    <td class="text-center"><?=$row->P_A_Dias?></td>
                                                                    <td class="text-center"><?=$row->P_A_Reacciones_Adversas?></td>
                                                                    <td class="text-center"><?=$row->Plasmaferesis_PFC?></td>
                                                                    <td class="text-center"><?=$row->P_PFC_Frascos?></td>
                                                                    <td class="text-center"><?=$row->Apache_II?></td>
                                                                    <td class="text-center"><?=$row->Fecha_CAF?></td>
                                                                    <td class="text-center"><?=$row->Fecha_Intubacion?></td>
                                                                    <td class="text-center"><?=$row->Dias_en_UCI?></td>
                                                                    <td class="text-center"><?=$row->Dias_en_VMI?></td>
                                                                    <td class="text-center"><?=$row->Modo_Ventilatorio?></td>
                                                                    <td class="text-center"><?=$row->Fecha_Modo_Ventilatorio?></td>
                                                                    <td class="text-center"><?=$row->Horas_Destete?></td>
                                                                    <td class="text-center"><?=$row->Dias_Destete?></td>
                                                                    <td class="text-center"><?=$row->Traqueostomia?></td>
                                                                    <td class="text-center"><?=$row->Fecha_Traqueostomia?></td>
                                                                    <td class="text-center"><?=$row->Fecha_Extubacion?></td>
                                                                    <td class="text-center"><?=$row->Destino_Alta_UCI?></td>
                                                                    <td class="text-center"><?=$row->Ultima_Actualizacion?></td>
                                                                    <td class="text-center"><?=$row->ID?></td>
																</tr>
																<?php 
																        $n++;
																        endforeach;
                                                                    }
																?>
															</tbody>
														</table>

													</div>
													<!-- table -->

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
	
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form id="deleteForm" method="post" action="<?=base_url()?>emergencias/paciente/eliminar">
              <div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Eliminar Paciente</h5>
              </div>
              <div class="modal-body">
              	<input type="hidden" name="id" />
              	<p>&iquest;Seguro desea eliminar al paciente <strong id="paciente"></strong>?</p>
              </div>
              <div class="modal-footer">
              	<button type="submit" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
          </form>
        </div>
      </div>
    </div>

	<script src="<?=base_url()?>public/js/emergencias/paciente.js?v=<?=date("s")?>"></script>
	<script>
		paciente("<?=base_url()?>","<?=$id?>");
	</script>

</body>

</html>