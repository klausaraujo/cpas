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
    margin: 0;
    padding: 0;
}
.titulo{margin:0 0 10px 0;font-size:18px;text-decoration:underline;text-align:center;color:#373643;font-weight:bold;text-transform:uppercase!important;}
.tabla{width:500pt;font-size: 11px;font-family: helvetica;border: 1px solid transparent;}
.tabla th{border:0.5px solid transparent;color:black;background:#DDDDDD;padding:5px;font-size:10px;}
.tabla td{border:0.5px solid transparent;padding:5px;font-size:10px;}
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
function parentesco($id){
    switch($id) {
        case 0: return "[N/A]";break;
        case 1: return "MADRE";break;
        case 2: return "PADRE";break;
        case 3: return "HIJO (A)";break;
        case 4: return "HERMANO (A)";break;
        case 5: return "PRIMO (A)";break;
        case 6: return "ABUELO (A)";break;
        case 7: return "CONYUGUE";break;
        case 8: return "AMIGO (A)";break;
        case 9: return "OTROS";break;
    }
}
function condicionLaboral($id) {
    $condicion = "[N/A]";
    switch($id){
        case 1:$condicion="NOMBRADO 276";break;
        case 2:$condicion="NOMBRADO 278";break;
        case 3:$condicion="D.L. 10578(CAS)";break;
        case 4:$condicion="LOCADOR";break;
    }
    return $condicion;
}
?>
	<div class="container">
	<h1 class="text-center">Ficha personal de brigadista</h1>
	<br />
	<table class="tabla">
		<tr>
			<td colspan="2" style="padding: 0; with: 100%;">
				<table>
        			<tr>
        				<td style="width: 100%;border:1px solid black;border-bottom: 1px solid transparent;text-align: center;background: #DDDDDD;padding: 5px;">DATOS DE IDENTIFICACI&Oacute;N</td>
        			</tr>
        		</table>
			</td>
		</tr>
        <tr>
        	<td style="padding: 0;">
        		<table style="border:0!important">
        			<tr>
        				<td style="width: 50pt;border:1px solid black;border-bottom:1px solid transparent"><b>Nombre:</b></td>
        				<td style="width: 117pt;border:1px solid black;border-bottom:1px solid transparent"><?=$brigadista->nombres?></td>
        				<td style="width: 50pt;border:1px solid black;border-bottom:1px solid transparent"><b>Apellidos:</b></td>
        				<td style="width: 117pt;border:1px solid black;border-bottom:1px solid transparent"><?=$brigadista->apellidos?></td>
        			</tr>
        		</table>
        		<table style="border:0!important">
        			<tr>
        				<td style="width: 35pt;border:1px solid black;border-bottom:1px solid transparent"><b>F. Nac.</b></td>
        				<td style="width: 40pt;border:1px solid black;border-bottom:1px solid transparent"><?=formatearFechaParaVista($brigadista->fecha_nacimiento)?></td>
        				<td style="width: 25pt;border:1px solid black;border-bottom:1px solid transparent"><b>Edad</b></td>
        				<td style="width: 25pt;border:1px solid black;border-bottom:1px solid transparent"><?=calcularEdad($brigadista->fecha_nacimiento)?></td>
        				<td style="width: 30pt;border:1px solid black;border-bottom:1px solid transparent"><b>G&eacute;nero</b></td>
        				<td style="width: 40pt;border:1px solid black;border-bottom:1px solid transparent"><?=($brigadista->genero==1)?"Masculino":"Femenino"?></td>
        				<td style="width: 28pt;border:1px solid black;border-bottom:1px solid transparent"><b>E.C</b></td>
        				<td style="width: 42pt;border:1px solid black;border-bottom:1px solid transparent"><?=estadoCivil($brigadista->estado_civil==1)?></td>
        			</tr>
        		</table>
        		<table style="border:0!important">
        			<tr>
        				<td style="width: 40pt;border:1px solid black;border-bottom:1px solid transparent"><b>DNI</b></td>
        				<td style="width: 58pt;border:1px solid white;border:1px solid black;border-bottom:1px solid transparent;"><?=$brigadista->documento_numero?></td>
        				<td style="width: 41pt;border:1px solid black;border-bottom:1px solid transparent"><b>T. Fijo</b></td>
        				<td style="width: 60pt;border:1px solid white;border:1px solid black;border-bottom:1px solid transparent;"><?=$brigadista->telefono_01?></td>
        				<td style="width: 40pt;border:1px solid black;border-bottom:1px solid transparent"><b>T. Movil</b></td>
        				<td style="width: 60pt;border:1px solid black;border-bottom:1px solid transparent"><?=$brigadista->telefono_02?></td>
        			</tr>
        		</table>
        		<table style="border:0!important">
        			<tr>
        				<td style="width: 45pt;border:1px solid black;border-bottom:1px solid transparent;"><b>Domicilio</b></td>
        				<td style="width: 323pt;border:1px solid black;border-bottom:1px solid transparent;"><?=$brigadista->domicilio?></td>
        			</tr>
        		</table>
        		<table style="border:0!important">
        			<tr>
        				<td style="width: 30pt;border:1px solid black;border-bottom:1px solid white;font-size: 10px;"><b>Regi&oacute;n:</b></td>
        				<td style="width: 68pt;border:1px solid black;border-bottom:1px solid white;font-size: 10px;text-transform:capitalize;"><?=$brigadista->departamento?></td>
        				<td style="width: 32pt;border:1px solid black;border-bottom:1px solid white;font-size: 10px;"><b>Provincia:</b></td>
        				<td style="width: 68pt;border:1px solid black;border-bottom:1px solid white;font-size: 10px;text-transform:capitalize;"><?=$brigadista->provincia?></td>
        				<td style="width: 32pt;border:1px solid black;border-bottom:1px solid white;font-size: 10px;"><b>Distrito:</b></td>
        				<td style="width: 69pt;border:1px solid black;border-bottom:1px solid white;font-size: 10px;text-transform:capitalize;"><?=$brigadista->distrito?></td>
        			</tr>
        		</table>
        		<table style="border:0!important">
        			<tr>
        				<td style="width: 100pt;border:1px solid black;border-bottom:1px solid transparent;font-size: 10px;"><b>Contacto de emergencia</b></td>
        				<td style="width: 122pt;border:1px solid black;border-bottom:1px solid transparent;font-size: 10px;"><?=$brigadista->contacto_emergencia?></td>
        				<td style="width: 49pt;border:1px solid black;border-bottom:1px solid transparent;font-size: 10px;"><b>Parentesco</b></td>
        				<td style="width: 63pt;border:1px solid white;border:1px solid black;border-bottom:1px solid transparent;font-size: 10px;"><?=parentesco($brigadista->parentesco)?></td>
        			</tr>
        		</table>
        		<table style="border:0!important">
        			<tr>
        				<td style="width: 90pt;border:1px solid black;"><b>N&uacute;mero Contacto 1</b></td>
        				<td style="width: 77pt;border:1px solid white;border:1px solid black;"><?=$brigadista->telefono_emergencia_01?></td>
        				<td style="width: 90pt;border:1px solid black;"><b>N&uacute;mero Contacto 2</b></td>
        				<td style="width: 77pt;border:1px solid white;border:1px solid black;"><?=$brigadista->telefono_emergencia_02?></td>
        			</tr>
        		</table>
        	</td>
        	<td style="padding: 0;">        	
        	<?php if(strlen($brigadista->foto)>0){ ?>
        	<table>
        		<tr>
        			<td style="border:1px solid black;border-left: 1px solid transparent;width: 90pt;"><img src="<?=base_url()?>public/images/brigadistas/<?=$brigadista->foto?>" style="width: 100%;height: 147px;"></td>            	
            	</tr>
            </table>
            <?php } ?>
        	</td>
        </tr>
	</table>
	<br />
	<table class="tabla">
        <tr>
            <td>
            	<table style="border:0!important">
                	<tr>
                    	<td style="width: 100%;background: #DDDDDD;border:1px solid black;border-bottom: 1px solid transparent;text-align: center"><b>DATOS DE SALUD</b></td>
                	</tr>
            	</table>
            	<table style="border:0!important">
                	<tr>
                    	<td style="width: 50pt;border:1px solid black;border-bottom: 1px solid transparent;">VACUNAS:</td>
                    	<td style="width: 30pt;border:1px solid black;border-bottom: 1px solid transparent;">Tetano:</td>
                    	<td style="width: 65pt;border:1px solid black;border-bottom: 1px solid transparent;">Fiebre Amarilla:</td>
                    	<td style="width: 10pt;border:1px solid black;border-bottom: 1px solid transparent;text-align:center;padding:5px 2px;"><?=(strlen($brigadista->vacuna_fiebre_amarilla)>0)?"X":""?></td>
                    	<td style="width: 48pt;border:1px solid black;border-bottom: 1px solid transparent;">Hepatitis B:</td>
                    	<td style="width: 10pt;border:1px solid black;border-bottom: 1px solid transparent;text-align:center;padding:5px 2px;"><?=(strlen($brigadista->vacuna_hepatitis_b)>0)?"X":""?></td>
                    	<td style="width: 30pt;border:1px solid black;border-bottom: 1px solid transparent;">Influenza:</td>
                    	<td style="width: 10pt;border:1px solid black;border-bottom: 1px solid transparent;text-align:center;padding:5px 2px;"><?=(strlen($brigadista->vacuna_influenza)>0)?"X":""?></td>
                    	<td style="width: 40pt;border:1px solid black;border-bottom: 1px solid transparent;">Sarampi&oacute;n:</td>
                    	<td style="width: 10pt;border:1px solid black;border-bottom: 1px solid transparent;text-align:center;padding:5px 2px;"><?=(strlen($brigadista->vacuna_sarampion)>0)?"X":""?></td>
                    	<td style="width: 35pt;border:1px solid black;border-bottom: 1px solid transparent;">Papiloma:</td>
                    	<td style="width: 10pt;border:1px solid black;border-bottom: 1px solid transparent;text-align:center;padding:5px 2px;"><?=(strlen($brigadista->vacuna_papiloma)>0)?"X":""?></td>
                	</tr>
            	</table>
            	<table style="border:0!important">
                	<tr>
                    	<td style="width: 80pt;border:1px solid black;border-bottom: 1px solid transparent;"><b>OTRAS VACUNAS:</b></td>
                    	<td style="width: 395pt;border:1px solid black;border-bottom: 1px solid transparent;"><?=str_replace("\\r\\n", ", ", $brigadista->vacunas_otras)?></td>
                	</tr>
            	</table>
            	<table style="border:0!important">
                    <tr>
                        <td style="width: 93pt;border:1px solid black;border-bottom: 1px solid transparent;"><b>GRUPO SANGU&Iacute;NEO:</b> </td>
                        <td style="width: 55pt;border:1px solid black;border-bottom: 1px solid transparent;"><?=grupo_sanguineo($brigadista->grupo_sanguineo)?></td>
                        <td style="width: 64pt;border:1px solid black;border-bottom: 1px solid transparent;"><b>TALLA:</b></td>
                        <td style="width: 65pt;border:1px solid black;border-bottom: 1px solid transparent;"><?=$brigadista->talla." mt"?></td>
                        <td style="width: 64pt;border:1px solid black;border-bottom: 1px solid transparent;"><b>PESO:</b></td>
                        <td style="width: 65pt;border:1px solid black;border-bottom: 1px solid transparent;"><?=$brigadista->peso." kg"?></td>
                    </tr>
            	</table>
            	<table style="border:0!important">
                    <tr>
                        <td style="width: 140pt;border:1px solid black;border-bottom: 1px solid transparent;"><b>ALERGIAS A MEDICAMENTOS:</b> </td>
                        <td style="width: 335pt;border:1px solid black;border-bottom: 1px solid transparent;"><?=str_replace("\\r\\n", ", ", $brigadista->alergias)?></td>                        
                    </tr>
            	</table>
            	<table style="border:0!important">
                    <tr>
                        <td style="width: 140pt;border:1px solid black;border-bottom: 1px solid transparent;"><b>INTERVENCIONES QUIRURGICAS:</b> </td>
                        <td style="width: 335pt;border:1px solid black;border-bottom: 1px solid transparent;"><?=str_replace("\\r\\n", ", ", $brigadista->intervenciones_quirurgica)?></td>                  
                    </tr>
            	</table>
            	<table style="border:0!important">
                    <tr>
                        <td style="width: 140pt;border:1px solid black;"><b>ANTECEDENTES M&Eacute;DICOS:</b> </td>
                        <td style="width: 335pt;border:1px solid black;"><?=str_replace("\\r\\n", ", ", $brigadista->antecedentes_medicos)?></td>                        
                    </tr>
            	</table>
            </td>
        </tr>
	</table>
	<br />
	<?php if($gradoestudios->num_rows()){ 
	   $nge = 1;
	    ?>
	<div>
	<table class="tabla">
		<tr>
			<td colspan="4" style="width: 100%;border:1px solid black;text-align: center;background: #DDDDDD;"><b>GRADO DE INSTRUCCI&Oacute;N</b></td>
		</tr>
		<?php foreach($gradoestudios->result() as $gradoestudio): 
		if ($nge < $gradoestudios->num_rows()) {
		?>
        <tr>
            <td style="width: 44pt;border:1px solid black;border-top: 1px solid transparent;"><b>Profesi&oacute;n:</b></td>
            <td style="width: 176pt;border:1px solid black;border-top: 1px solid transparent;"><?=$gradoestudio->profesion?></td>
        	<td style="width: 44pt;border:1px solid black;border-top: 1px solid transparent;"><b>Especialidad:</b></td>
        	<td style="width: 176pt;border:1px solid black;border-top: 1px solid transparent;"><?=$gradoestudio->especialidad?></td>
        </tr>
        <?php } 
        else { ?>        
        <tr>
            <td style="width: 44pt;border:1px solid black;"><b>Profesi&oacute;n:</b></td>
            <td style="width: 176pt;border:1px solid black;"><?=$gradoestudio->profesion?></td>
        	<td style="width: 44pt;border:1px solid black;"><b>Especialidad:</b></td>
        	<td style="width: 176pt;border:1px solid black;"><?=$gradoestudio->especialidad?></td>
        </tr>
        <?php 
		}
        $nge++;
        endforeach; ?>
	</table>
	</div>
	<?php } ?>

	<br />
  <?php if($certificaciones->num_rows() > 0){ 
    $nc = 1;
      ?>
  <div>
	<table class="tabla">
		<tr>
		<td colspan="5" style="width: 100%;border:1px solid black;text-align: center;background: #DDDDDD;"><b>CERTIFICADOS</b></td>
		</tr>
		<tr>
			<th style="width: 84pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Certificaci&oacute;n</th>
			<th style="width: 86pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">F. Reconocimiento</th>
			<th style="width: 84pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Resoluci&oacute;n</th>
			<th style="width: 86pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Fecha Inicio</th>
			<th style="width: 84pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Fecha Fin</th>
		</tr>
		<?php foreach($certificaciones->result() as $certificacion): 
		if ($nc < $certificaciones->num_rows()) {
		?>
        <tr>
            <td style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=tipo_certificacion($certificacion->tipo_certificacion)?></td>
        	<td style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$certificacion->fecha_reconocimiento?></td>
        	<td style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$certificacion->resolucion?></td>
        	<td style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$certificacion->fecha_inicio?></td>
        	<td style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$certificacion->fecha_vencimiento?></td>
        </tr>
        <?php }
        else {
        ?>        
        <tr>
            <td style="width: 84pt;border: 1px solid black;text-align:center;"><?=tipo_certificacion($certificacion->tipo_certificacion)?></td>
        	<td style="width: 86pt;border: 1px solid black;text-align:center;"><?=$certificacion->fecha_reconocimiento?></td>
        	<td style="width: 84pt;border: 1px solid black;text-align:center;"><?=$certificacion->resolucion?></td>
        	<td style="width: 86pt;border: 1px solid black;text-align:center;"><?=$certificacion->fecha_inicio?></td>
        	<td style="width: 84pt;border: 1px solid black;text-align:center;"><?=$certificacion->fecha_vencimiento?></td>
        </tr>
        <?php 
        }
        $nc++;
        endforeach; ?>
	</table>
	</div>
	<?php } ?>

	<br />
  <?php if($trabajos->num_rows() > 0){ 
    $nt = 1;
      ?>
  <div>
	<table class="tabla">
		<tr>
		<td colspan="5" style="width: 100%;border:1px solid black;text-align: center;background: #DDDDDD;"><b>INFORMACI&Oacute;N LABORAL</b></td>
		</tr>
		<?php foreach($trabajos->result() as $trabajo): 
		if ($nt < $trabajos->num_rows()) {
		?>
		<tr>
			<th style="width: 84pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Diresa/Geresa/Diris/Disa</th>
			<th style="width: 86pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Red</th>
			<th style="width: 84pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Microred</th>
			<th style="width: 86pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Establecimiento</th>
			<th style="width: 84pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Oficina</th>
		</tr>
        <tr>
            <td style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->DIRESA?></td>
        	<td style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->Red?></td>
        	<td style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->MicroRed?></td>
        	<td style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->CodEESS?></td>
        	<td style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->oficina?></td>
        </tr>
        <tr>
            <th style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;">Condici&oacute;n Laboral</th>
        	<td style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=condicionLaboral($trabajo->condicion_laboral)?></td>
        	<th style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;">Cargo Actual</th>
        	<td colspan="2" style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->cargo?></td>
        </tr>
        <tr>
            <th style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;border-bottom:2px solid black;text-align:center;">Tel&eacute;fono Institucional</th>
        	<td style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;border-bottom:2px solid black;text-align:center;"><?=$trabajo->telefono_institucional?></td>
        	<th style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;border-bottom:2px solid black;text-align:center;">Correo Institu.</th>
        	<td colspan="2" style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;border-bottom:2px solid black;text-align:center;"><?=$trabajo->email_institucional?></td>
        </tr>
        <?php }
        else {
        ?>
		<tr>
			<th style="width: 84pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Diresa/Geresa/Diris/Disa</th>
			<th style="width: 86pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Red</th>
			<th style="width: 84pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Microred</th>
			<th style="width: 86pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Establecimiento</th>
			<th style="width: 84pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Oficina</th>
		</tr>
        <tr>
            <td style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->DIRESA?></td>
        	<td style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->Red?></td>
        	<td style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->MicroRed?></td>
        	<td style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->CodEESS?></td>
        	<td style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->oficina?></td>
        </tr>
        <tr>
            <th style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;">Condici&oacute;n Laboral</th>
        	<td style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=condicionLaboral($trabajo->condicion_laboral)?></td>
        	<th style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;">Cargo Actual</th>
        	<td colspan="2" style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->cargo?></td>
        </tr>
        <tr>
            <th style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;">Tel&eacute;fono Institucional</th>
        	<td style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->telefono_institucional?></td>
        	<th style="width: 84pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;">Correo Institu.</th>
        	<td colspan="2" style="width: 86pt;border: 1px solid black;border-top: 0px solid transparent;text-align:center;"><?=$trabajo->email_institucional?></td>
        </tr>
        <?php 
        }
        $nt++;
        endforeach; ?>
	</table>
	</div>
	<?php } ?>
	
	<br />
	<?php if($capacitaciones->num_rows()){ 
	    $nc = 1;
	   ?>
	<div>
	<table class="tabla">
		<tr>
		<td colspan="5" style="width: 100%;border:1px solid black;text-align: center;background: #DDDDDD;"><b>CAPACITACIONES / CURSOS</b></td>
		</tr>
		<tr>
			<th style="width: 155pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Capacitaci&oacute;n/Curso</th>
			<th style="width: 88pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Entidad</th>
			<th style="width: 78pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Fecha Inicio</th>
			<th style="width: 58pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Fecha Fin</th>
			<th style="width: 48pt;text-align: center;border:1px solid black; border-top: 1px solid transparent;">Horas</th>
		</tr>
		<?php foreach($capacitaciones->result() as $capacitacion): 
		?>
		<?php  
		  if ($nc < $capacitaciones->num_rows()) {
		?>
        <tr>
            <td style="width: 155pt;border:1px solid black;border-top: 1px solid transparent;"><?=$capacitacion->curso_capacitacion?></td>
        	<td style="width: 88pt;border:1px solid black;border-top: 1px solid transparent;"><?=$capacitacion->entidad?></td>
        	<td style="width: 78pt;border:1px solid black;border-top: 1px solid transparent;"><?=$capacitacion->fecha_inicio?></td>
        	<td style="width: 58pt;border:1px solid black;border-top: 1px solid transparent;"><?=$capacitacion->fecha_fin?></td>
        	<td style="width: 48pt;border:1px solid black;border-top: 1px solid transparent;"><?=$capacitacion->horas?></td>
        </tr>
        <?php } 
            else {
         ?>
         <tr>
            <td style="width: 155pt;border:1px solid black;"><?=$capacitacion->curso_capacitacion?></td>
        	<td style="width: 88pt;border:1px solid black;"><?=$capacitacion->entidad?></td>
        	<td style="width: 78pt;border:1px solid black;text-align:center;"><?=$capacitacion->fecha_inicio?></td>
        	<td style="width: 58pt;border:1px solid black;text-align:center;"><?=$capacitacion->fecha_fin?></td>
        	<td style="width: 48pt;border:1px solid black;text-align:center;"><?=$capacitacion->horas?></td>
        </tr>
        <?php
        }
        $nc++;
        endforeach; ?>
	</table>
	</div>
	<?php } ?>
	<br />
	<?php if($emergencias->num_rows()){ 
	   $ne = 1;
	    ?>
	<div>
	<table class="tabla">
		<tr>
			<td style="width: 100%;border:1px solid black;text-align: center;background: #DDDDDD;"><b>PARTICIPACIONES EN EMERGENCIAS</b></td>
		</tr>
		<?php foreach($emergencias->result() as $emergencia): 
		  if ($ne < $emergencias->num_rows()) {
		?>
        <tr>
        	<td style="padding: 0;">
            	<table>
                	<tr>
                    	<td style="width: 42pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Fecha</b></td>
                    	<td style="width: 62pt;border: 1px solid black;border-top: 1px solid transparent;"><?=$emergencia->Evento_Fecha_Registro?></td>
                        <td style="width: 38pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Evento</b></td>
                        <td style="width: 299pt;border: 1px solid black;border-top: 1px solid transparent;"><?=$emergencia->evento." - ".$emergencia->eventoDetalle?></td>
                    </tr>
            	</table>
        	</td>
        </tr>
        <tr>
        	<td style="padding: 0;">
            	<table>
                	<tr>
                        <td class="text-center" style="width: 40pt;border: 1px solid black;border-top: 1px solid transparent;"><b>L&iacute;der</b></td>
                        <td class="text-center" style="width: 40pt;border: 1px solid black;border-top: 1px solid transparent;"><?=($emergencia->lider=="1")?"S&iacute;":"No"?></td>
                    	<td class="text-center" style="width: 100pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Fuerza Tarea</b></td>
                    	<td class="text-center" style="width: 40pt;border: 1px solid black;border-top: 1px solid transparent;"><?=($emergencia->fuerza_tarea=="1")?"S&iacute;":"No"?></td>
                    	<td class="text-center" style="width: 84pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Calificaci&oacute;n</b></td>
                    	<td class="text-center" style="width: 102pt;border: 1px solid black;border-top: 1px solid transparent;"><?=calificacion($emergencia->calificacion)?></td>
            		</tr>
            	</table>
        	</td>
        </tr>
        <tr>
            <td style="padding: 0;">
            	<table>
            		<tr>
	            		<td style="width: 492pt;border: 1px solid black;border-top: 1px solid transparent;"><p><b>Acciones realizadas:</b></p><?=str_replace("\\r\\n", "<br />", $emergencia->acciones_realizadas)?></td>
            		</tr>
            	</table>
            </td>
        </tr>
        <?php }
            else {
        ?>
        <tr>
        	<td style="padding: 0;">
            	<table>
                	<tr>
                    	<td style="width: 42pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Fecha</b></td>
                    	<td style="width: 62pt;border: 1px solid black;border-top: 1px solid transparent;"><?=$emergencia->Evento_Fecha_Registro?></td>
                        <td style="width: 38pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Evento</b></td>
                        <td style="width: 299pt;border: 1px solid black;border-top: 1px solid transparent;"><?=$emergencia->evento." - ".$emergencia->eventoDetalle?></td>
                    </tr>
            	</table>
        	</td>
        </tr>
        <tr>
        	<td style="padding: 0;">
            	<table>
                	<tr>
                        <td class="text-center" style="width: 40pt;border: 1px solid black;border-top: 1px solid transparent;"><b>L&iacute;der</b></td>
                        <td class="text-center" style="width: 40pt;border: 1px solid black;border-top: 1px solid transparent;"><?=($emergencia->lider=="1")?"S&iacute;":"No"?></td>
                    	<td class="text-center" style="width: 100pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Fuerza Tarea</b></td>
                    	<td class="text-center" style="width: 40pt;border: 1px solid black;border-top: 1px solid transparent;"><?=($emergencia->fuerza_tarea=="1")?"S&iacute;":"No"?></td>
                    	<td class="text-center" style="width: 84pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Calificaci&oacute;n</b></td>
                    	<td class="text-center" style="width: 102pt;border: 1px solid black;border-top: 1px solid transparent;"><?=calificacion($emergencia->calificacion)?></td>
            		</tr>
            	</table>
        	</td>
        </tr>
        <tr>
            <td style="padding: 0;">
            	<table>
            		<tr>
	            		<td style="width: 492pt;border: 1px solid black;border-top: 1px solid transparent;"><p><b>Acciones realizadas:</b></p><?=str_replace("\\r\\n", "<br />", $emergencia->acciones_realizadas)?></td>
            		</tr>
            	</table>
            </td>
        </tr>
        <?php 
            }
            $ne++;
        endforeach; ?>
	</table>
	</div>
	<?php } ?>
	<br />
	<?php if($contingencias->num_rows()){
	    $ncon = 1;
	    ?>
	<div>
	<table class="tabla">
		<tr>
			<td style="width: 100%;border:1px solid black;text-align: center;background: #DDDDDD;"><b>PARTICIPACIONES EN CONTINGENCIAS</b></td>
		</tr>
		<?php foreach($contingencias->result() as $contingencia): 
		if ($ncon < $contingencias->num_rows()) {
		?>
        <tr>
        	<td style="padding: 0;">
            	<table>
                	<tr>
                    	<td style="width: 42pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Fecha</b></td>
                    	<td style="width: 62pt;border: 1px solid black;border-top: 1px solid transparent;"><?=$contingencia->Evento_Fecha_Registro?></td>
                        <td style="width: 38pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Evento</b></td>
                        <td style="width: 299pt;border: 1px solid black;border-top: 1px solid transparent;"><?=$contingencia->evento." - ".$contingencia->eventoDetalle?></td>
                    </tr>
            	</table>
        	</td>
        </tr>
        <tr>
        	<td style="padding: 0;">
            	<table>
                	<tr>
                        <td class="text-center" style="width: 40pt;border: 1px solid black;border-top: 1px solid transparent;"><b>L&iacute;der</b></td>
                        <td class="text-center" style="width: 40pt;border: 1px solid black;border-top: 1px solid transparent;"><?=($contingencia->lider=="1")?"S&iacute;":"No"?></td>
                    	<td class="text-center" style="width: 100pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Fuerza Tarea</b></td>
                    	<td class="text-center" style="width: 40pt;border: 1px solid black;border-top: 1px solid transparent;"><?=($contingencia->fuerza_tarea=="1")?"S&iacute;":"No"?></td>
                    	<td class="text-center" style="width: 84pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Calificaci&oacute;n</b></td>
                    	<td class="text-center" style="width: 102pt;border: 1px solid black;border-top: 1px solid transparent;"><?=calificacion($contingencia->calificacion)?></td>
            		</tr>
            	</table>
        	</td>
        </tr>
        <tr>
            <td style="padding: 0;">
            	<table>
            		<tr>
	            		<td style="width: 492pt;border: 1px solid black;border-top: 1px solid transparent;"><p><b>Acciones realizadas:</b></p><?=str_replace("\\r\\n", "<br />", $contingencia->acciones_realizadas)?></td>
            		</tr>
            	</table>
            </td>
        </tr>
        <?php }
            else {
        ?>
        <tr>
        	<td style="padding: 0;">
            	<table>
                	<tr>
                    	<td style="width: 42pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Fecha</b></td>
                    	<td style="width: 62pt;border: 1px solid black;border-top: 1px solid transparent;"><?=$contingencia->Evento_Fecha_Registro?></td>
                        <td style="width: 38pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Evento</b></td>
                        <td style="width: 299pt;border: 1px solid black;border-top: 1px solid transparent;"><?=$contingencia->evento." - ".$contingencia->eventoDetalle?></td>
                    </tr>
            	</table>
        	</td>
        </tr>
        <tr>
        	<td style="padding: 0;">
            	<table>
                	<tr>
                        <td class="text-center" style="width: 40pt;border: 1px solid black;border-top: 1px solid transparent;"><b>L&iacute;der</b></td>
                        <td class="text-center" style="width: 40pt;border: 1px solid black;border-top: 1px solid transparent;"><?=($contingencia->lider=="1")?"S&iacute;":"No"?></td>
                    	<td class="text-center" style="width: 100pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Fuerza Tarea</b></td>
                    	<td class="text-center" style="width: 40pt;border: 1px solid black;border-top: 1px solid transparent;"><?=($contingencia->fuerza_tarea=="1")?"S&iacute;":"No"?></td>
                    	<td class="text-center" style="width: 84pt;border: 1px solid black;border-top: 1px solid transparent;"><b>Calificaci&oacute;n</b></td>
                    	<td class="text-center" style="width: 102pt;border: 1px solid black;border-top: 1px solid transparent;"><?=calificacion($contingencia->calificacion)?></td>
            		</tr>
            	</table>
        	</td>
        </tr>
        <tr>
            <td style="padding: 0;">
            	<table>
            		<tr>
	            		<td style="width: 492pt;border: 1px solid black;border-top: 1px solid transparent;"><p><b>Acciones realizadas:</b></p><?=str_replace("\\r\\n", "<br />", $contingencia->acciones_realizadas)?></td>
            		</tr>
            	</table>
            </td>
        </tr>
        <?php 
            }
        $ncon++;
        endforeach; ?>
	</table>
	</div>
	<?php } ?>
	</div>
</page>