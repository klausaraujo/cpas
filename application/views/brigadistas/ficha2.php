<page backtop="22mm" backbottom="15mm" backleft="7mm" backright="7mm">
    <page_header>
    	 <br />
         <img src="<?=base_url()?>public/images/logo-informe.jpg" border="0" width="320" />
    </page_header>
    <page_footer>
    <table cellspacing="0" style="width: 520pt;font-size: 10px;height: 50px;border-top:0.5px solid #AAA;">
        <tr>
            <td style="width: 300pt;padding-top: 5px;">
            </td>
            <td style="width: 100pt;padding-top: 5px;">
            <a href="http://sireed.minsa.gob.pe/" target="_blank" style="margin-top:0px;">http://sireed.minsa.gob.pe</a>
			<p class="footer-margin">coesalud@minsa.gob.pe</p>
            </td>
            <td style="width: 2pt;vertical-align: top;margin-top:0;padding-top: 5px;">
            	<div class="vertical"></div>
            </td>
            <td style="width: 120pt;padding-left: 10px;padding-top: 5px;">
			 <p class="footer-margin" style="margin-top:0px;">Ca. Guillermo Marconi N&deg; 317</p>
			 <p class="footer-margin">San Isidro - Lima 27, Per&uacute;</p>
             <p class="footer-margin">Telf. (511) 611 9930</p>
             <p class="footer-margin">COE Salud: 611 9933</p>
            </td>
        </tr>
    </table>
    </page_footer>
<style>
.vertical {
    border-right: 2px solid #df5e5e;
    height: 50px;
}
html,body{margin:0;padding:0;font-family:Helvetica;}
*, ::after, ::before {
    box-sizing: border-box;
}
table {
    border-collapse: collapse;
    border: 0;
}
.titulo{margin:0 0 10px 0;font-size:18px;text-decoration:underline;text-align:center;color:#373643;font-weight:bold;text-transform:uppercase!important;}
.tabla{width:500pt;font-size: 11px;font-family: helvetica;border: 1px solid #ccc;}
.tabla th{border:0.5px solid #dee2e6;color:#FFFFFF;background:#477de0;padding:5px;font-size:11px;}
.tabla td{border:0.5px solid #dee2e6;padding:5px;font-size:11px;}
.no-border th,.no-border td{border: 0.5px solid #dee2e6;}
.text-center {
    text-align: center;
}
 .footer-margin {
    margin: 1px 1px 3px 1px;
 }
 h1,h3,h3,h4 {
 color:#888;text-transform:uppercase;max-width: 500pt;width: 100%;
 }
 h1 {
 font-size: 24px;
 }
 h3 {
 font-size: 20px;
 }
 h3 {
 font-size: 16px;
 }
 h4 {
 font-size: 12px;
 }
</style>
<?php
function estadoCivil($id) {
    switch($id){
        case 1: return 'Soltero(a)';break;
        case 2: return 'Casado(a)';break;
        case 3: return 'Viudo(a)';break;
        case 4: return 'Divorciado(a)';break;
        case 5: return 'Conviviente(a)';break;
    }
}
function tipo_certificacion($id){
    switch($id){
        case 1: return 'BRIGADISTA';break;
        case 2: return 'E.M.T. I';break;
        case 3: return 'E.M.T. II';break;
        case 4: return 'E.M.T. III';break;
        case 5: return 'CELULA ESPECIALIZADA';break;
    }
}
function grupo_sanguineo($id){
    switch($id){
        case 0: return '[N/A]';break;
        case 1: return 'O-';break;
        case 2: return 'O+';break;
        case 3: return 'A-';break;
        case 4: return 'A+';break;
        case 5: return 'B-';break;
        case 6: return 'B+';break;
        case 7: return 'AB-';break;
        case 8: return 'AB+';break;
    }
}
function calificacion($id){
    switch($id) {
        case 0: return "[N/A]";break;
        case 1: return "EXCELENTE";break;
        case 2: return "ACEPTABLE";break;
        case 3: return "REGULAR/MALO";break;
    }
}
?>
	<div class="container">
	<h1 class="text-center">Ficha personal de brigadista</h1>
	<h3 class="text-center">datos de identificaci&oacute;n</h3>
	<br />
	<table class="tabla">
        <tr>
            <td style="width: 180pt;"><b>Nombre:</b> <?=$brigadista->nombres?></td>
        	<td style="width: 180pt;"><b>Apellidos:</b> <?=$brigadista->apellidos?></td>
        	<td rowspan="6" style="width: 80pt;">
        	<?php if(strlen($brigadista->foto)>0){ ?>
            <img src="<?=base_url()?>public/images/brigadistas/<?=$brigadista->foto?>" style="width: 100%;height: 135px;">
            <?php } ?>
        	</td>
        </tr>
        <tr>
        	<td colspan="2" style="width: 360pt;padding: 0px;" class="no-border">
        		<table style="border:0!important">
        			<tr>
        				<td style="width: 88pt;border:1px solid white;border-right:1px solid #dee2e6"><b>F. Nac.</b> <?=formatearFechaParaVista($brigadista->fecha_nacimiento)?></td>
        				<td style="width: 88pt;text-align: center;border:1px solid white;border-right:1px solid #dee2e6"><b>Edad</b> <?=calcularEdad($brigadista->fecha_nacimiento)?></td>
        				<td style="width: 88pt;text-align: center;border:1px solid white;border-right:1px solid #dee2e6"><b>G&eacute;nero</b> <?=($brigadista->genero==1)?"Masculino":"Femenino"?></td>
        				<td style="width: 88pt;text-align: center;border:1px solid white;"><b>E.C</b> <?=estadoCivil($brigadista->estado_civil==1)?></td>
        			</tr>
        		</table>
        	</td>
        </tr>
        <tr>
        	<td colspan="2" style="width: 360pt;padding: 0px;" class="no-border">
        		<table style="border:0!important">
        			<tr>
        				<td style="width: 118pt;border:1px solid white;border-right:1px solid #dee2e6;"><b>DNI</b> <?=$brigadista->documento_numero?></td>
        				<td style="width: 118pt;border:1px solid white;border-right:1px solid #dee2e6;"><b>T. Fijo</b> <?=$brigadista->telefono_01?></td>
        				<td style="width: 118pt;border:1px solid white;"><b>T. Movil</b> <?=$brigadista->telefono_02?></td>
        			</tr>
        		</table>
        	</td>
        </tr>
        <tr>
        	<td colspan="2" style="width: 360pt;padding: 0px;" class="no-border">
        		<table style="border:0!important">
        			<tr>
        				<td style="width: 358pt;border:1px solid white;"><b>Domicilio</b> <?=$brigadista->domicilio?></td>
        			</tr>
        		</table>
        	</td>
        </tr>
        <tr>
        	<td colspan="2" style="width: 360pt;padding: 0px;" class="no-border">
        		<table style="border:0!important">
        			<tr>
        				<td style="width: 114pt;border:1px solid white;border-right:1px solid #dee2e6"><b>Dep:</b> <?=$brigadista->departamento?></td>
        				<td style="width: 114pt;border:1px solid white;border-right:1px solid #dee2e6"><b>Pro:</b> <?=$brigadista->provincia?></td>
        				<td style="width: 114pt;border:1px solid white;"><b>Dis:</b> <?=$brigadista->distrito?></td>
        			</tr>
        		</table>
        	</td>
        </tr>
        <tr>
        	<td colspan="2" style="width: 360pt;padding: 0px;" class="no-border">
        		<table style="border:0!important">
        			<tr>
        				<td style="width: 358pt;border:1px solid white;"><b>Contacto de emergencia</b> <?=$brigadista->contacto_emergencia?>
        				<?=(strlen($brigadista->telefono_emergencia_01)>0)?"/ ".$brigadista->telefono_emergencia_01." ":""?>
        				<?=(strlen($brigadista->telefono_emergencia_02)>0)?"/ ".$brigadista->telefono_emergencia_02." ":""?>
        				</td>
        			</tr>
        		</table>
        	</td>
        </tr>
	</table>
	<br />
	<h3 class="text-center">datos de Salud</h3>
	<table class="tabla">
        <tr>
            <td colspan="3" style="width: 480pt;"><p><b>Vacunas:</b></p>
            	<table style="border:0!important">
                	<tr>
                    	<td style="width: 55pt;border:1px solid white;"><?=(strlen($brigadista->vacuna_tetano)>0)?"Tetano":""?></td>
                    	<td style="width: 65pt;border:1px solid white;"><?=(strlen($brigadista->vacuna_fiebre_amarilla)>0)?"Fiebre Amarilla":""?></td>
                    	<td style="width: 55pt;border:1px solid white;"><?=(strlen($brigadista->vacuna_hepatitis_b)>0)?"Hepatitis B":""?></td>
                    	<td style="width: 55pt;border:1px solid white;"><?=(strlen($brigadista->vacuna_influenza)>0)?"Influenza":""?></td>
                    	<td style="width: 55pt;border:1px solid white;"><?=(strlen($brigadista->vacuna_sarampion)>0)?"Sarampion":""?></td>
                    	<td style="width: 55pt;border:1px solid white;"><?=(strlen($brigadista->vacuna_papiloma)>0)?"Papiloma":""?></td>
                	</tr>
            	</table>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="width: 480pt;"><p><b>Otras vacunas:</b></p>
            							<?=$brigadista->alergias?></td>
        </tr>
        <tr>
            <td style="width: 160pt;"><b>Grupo Sangu&iacute;neo:</b> <?=$brigadista->grupo_sanguineo?></td>
            <td style="width: 160pt;"><b>Talla:</b> <?=$brigadista->talla." mt"?></td>
            <td style="width: 160pt;"><b>Peso:</b> <?=$brigadista->peso." kg"?></td>
        </tr>
        <tr>
            <td colspan="3" style="width: 480pt;"><p><b>Intervenciones quirurgicas:</b></p>
            							<?=str_replace("\\r\\n", "<br />", $brigadista->intervenciones_quirurgica)?></td>
        </tr>
        <tr>
            <td colspan="3" style="width: 480pt;"><p><b>Antecedentes m&eacute;dicos:</b></p>
            							<?=str_replace("\\r\\n", "<br />", $brigadista->antecedentes_medicos)?></td>
        </tr>
	</table>
	<br />
	<?php if($gradoestudios->num_rows()){ ?>
	<div>
	<h3 class="text-center">grado de instrucci&oacute;n</h3>
	<table class="tabla">
		<?php foreach($gradoestudios->result() as $gradoestudio): ?>
        <tr>
            <td style="width: 100pt;"><b>Prosi&oacute;n:</b> <?=$gradoestudio->profesion?></td>
        	<td style="width: 380pt;"><b>Especialidad:</b> <?=$gradoestudio->especialidad?></td>
        </tr>
        <?php endforeach; ?>
	</table>
	</div>
	<?php } ?>
	<br />
  <?php if($certificaciones->num_rows() > 0){ ?>
  <div>
	<h3 class="text-center">grado de instrucci&oacute;n</h3>
	<table class="tabla">
		<tr>
			<th class="text-center" style="width: 88pt;">Certificaci&oacute;n</th>
			<th class="text-center" style="width: 8pt;">F. Reconocimiento</th>
			<th class="text-center" style="width: 88pt;">Resoluci&oacute;n</th>
			<th class="text-center" style="width: 88pt;">Fecha Inicio</th>
			<th class="text-center" style="width: 88pt;">Fecha Fin</th>
		</tr>
		<?php foreach($certificaciones->result() as $certificacion): ?>
        <tr>
            <td class="text-center" style="width: 88pt;"><?=tipo_certificacion($certificacion->tipo_certificacion)?></td>
        	<td class="text-center" style="width: 88pt;"><?=$certificacion->fecha_reconocimiento?></td>
        	<td class="text-center" style="width: 88pt;"><?=$certificacion->resolucion?></td>
        	<td class="text-center" style="width: 88pt;"><?=$certificacion->fecha_inicio?></td>
        	<td class="text-center" style="width: 88pt;"><?=$certificacion->fecha_vencimiento?></td>
        </tr>
        <?php endforeach; ?>
	</table>
	</div>
	<?php } ?>
	<br />
	<?php if($capacitaciones->num_rows()){ ?>
	<div>
	<h3 class="text-center">Capacitaciones / cursos</h3>
	<table class="tabla">
		<tr>
			<th class="text-center" style="width: 128pt;">Capacitaci&oacute;n/Curso</th>
			<th class="text-center" style="width: 88pt;">Entidad</th>
			<th class="text-center" style="width: 78pt;">Fecha Inicio</th>
			<th class="text-center" style="width: 78pt;">Fecha Fin</th>
			<th class="text-center" style="width: 68pt;">Horas</th>
		</tr>
		<?php foreach($capacitaciones->result() as $capacitacion): ?>
        <tr>
            <td class="text-center" style="width: 128pt;"><?=$capacitacion->curso_capacitacion?></td>
        	<td class="text-center" style="width: 88pt;"><?=$capacitacion->entidad?></td>
        	<td class="text-center" style="width: 78pt;"><?=$capacitacion->fecha_inicio?></td>
        	<td class="text-center" style="width: 78pt;"><?=$capacitacion->fecha_fin?></td>
        	<td class="text-center" style="width: 68pt;"><?=$capacitacion->horas?></td>
        </tr>
        <?php endforeach; ?>
	</table>
	</div>
	<?php } ?>
	<br />
	<?php if($emergencias->num_rows()){ ?>
	<div>
	<h3 class="text-center">Participaciones en emergencias</h3>
	<table class="tabla">
		<?php foreach($emergencias->result() as $emergencia): ?>
        <tr>
        	<td class="text-center" style="width: 128pt;"><b>Fecha:</b><?=$emergencia->Evento_Fecha_Registro?></td>
            <td colspan="2" class="text-center" style="width: 348pt;"><b>Evento:</b><?=$emergencia->evento." - ".$emergencia->eventoDetalle?></td>
        </tr>
        <tr>
            <td class="text-center" style="width: 158pt;"><b>L&iacute;der: </b><?=($emergencia->lider=="1")?"S&iacute;":"No"?></td>
        	<td class="text-center" style="width: 158pt;"><b>Fuerza Tarea: </b><?=($emergencia->fuerza_tarea=="1")?"S&iacute;":"No"?></td>
        	<td class="text-center" style="width: 158pt;"><b>Calificaci&oacute;n: </b><?=calificacion($emergencia->calificacion)?></td>
        </tr>
        <tr>
            <td colspan="3" style="padding-left:20px;width: 458pt;border-bottom:2px solid #dee2e6;"><p><b>Acciones realizadas:</b></p><?=str_replace("\\r\\n", "<br />", $emergencia->acciones_realizadas)?></td>
        </tr>
        <?php endforeach; ?>
	</table>
	</div>
	<?php } ?>
	<br />
	<?php if($contingencias->num_rows()){ ?>
	<div>
	<h3 class="text-center">Participaciones en contingencias</h3>
	<table class="tabla">
		<?php foreach($contingencias->result() as $contingencia): ?>
        <tr>
        	<td class="text-center" style="width: 128pt;"><b>Fecha:</b><?=$contingencia->Evento_Fecha_Registro?></td>
            <td colspan="2" class="text-center" style="width: 348pt;"><b>Evento:</b><?=$contingencia->evento." - ".$contingencia->eventoDetalle?></td>
        </tr>
        <tr>
            <td class="text-center" style="width: 158pt;"><b>L&iacute;der: </b><?=($contingencia->lider=="1")?"S&iacute;":"No"?></td>
        	<td class="text-center" style="width: 158pt;"><b>Fuerza Tarea: </b><?=($contingencia->fuerza_tarea=="1")?"S&iacute;":"No"?></td>
        	<td class="text-center" style="width: 158pt;"><b>Calificaci&oacute;n: </b><?=calificacion($contingencia->calificacion)?></td>
        </tr>
        <tr>
            <td colspan="3" style="padding-left:20px;width: 458pt;border-bottom:2px solid #dee2e6;"><p><b>Acciones realizadas:</b></p><?=str_replace("\\r\\n", "<br />", $contingencia->acciones_realizadas)?></td>
        </tr>
        <?php endforeach; ?>
	</table>
	</div>
	<?php } ?>
	</div>
</page>