<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }			

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 3.2cm;
				font-family: Helvetica;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0.5cm;
                left: 0.5cm;
                right: 0cm;
                height: 50px;
				width: 100%;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 1cm; 
                left: 0.5cm; 
                right: 0cm;
                height: 50px;
				width: 100%;
            }
			
		.vertical {
			border-right: 2px solid #df5e5e;
			height: 50px;
		}

.titulo{
	margin:0 0 10px 0;
	font-size:17px;
	text-decoration:underline;
	text-align:center;
	color:#373643;
	font-weight:bold;
	text-transform:uppercase!important;
}

.complementario{
	margin:5px 0 0 0;
	font-size:15px;
	text-transform:uppercase;
	color:#373643;
	font-weight:400;
	text-align:center;
	text-transform:uppercase!important;
}

.fecha{margin:5px;font-size:16px;color:#373643;font-weight:400;text-align:center;}
.tabla_ubicacion,.tabla_sismo{width: 100%;text-align:center;text-transform:uppercase!important;font-size: 11px;font-family: Helvetica;}
.tabla_ubicacion th,.tabla_sismo th{text-transform: capitalize;border:0.5px solid #000000;color:#FFFFFF;background:#477de0;padding:5px;font-weight: 400;}
.tabla_sismo th{background:#CCC;font-weight: 400;}
.tabla_ubicacion td,.tabla_sismo td{border:0.5px solid #000000;padding:5px;}

.tabla_pacientes{text-align:center;width:300pt;text-transform:uppercase!important;font-size: 11px;font-family: Helvetica;}
.tabla_pacientes th{border:0.5px solid #000000;color:#FFFFFF;background:#477de0;padding:5px;font-size:11px;font-weight: 400;}
.tabla_pacientes td{border:0.5px solid #000000;padding:5px;font-size:11px;}

.tabla_fallecidos{margin:auto;text-align:center;font-size: 11px;font-family: Helvetica;}
.tabla_fallecidos th{border:0.5px solid #000000;color:#FFFFFF;background:#477de0;padding:5px;font-weight: 400;}
.tabla_fallecidos td{border:0.5px solid #000000;padding:5px;}
.tabla_fallecidos th.alternativo{background:#7AAEe4;}

.tabla_observaciones{margin:auto;text-align:center;font-size: 11px;font-family: Helvetica;}
.tabla_observaciones th{border:0.5px solid #000000;color:#FFFFFF;background:#477de0;padding:5px;font-weight: 400;}
.tabla_observaciones td{border:0.5px solid #000000;padding:5px;}

.lesionados{width: 100%;padding:0;border:0px;text-transform:uppercase!important;font-size: 11px;font-family: Helvetica;}
.lesionados th{border:0px;padding:1px 5px;text-transform:uppercase!important;font-weight: 400;}
.lesionados td{border:0px;padding:1px 5px;text-transform:uppercase!important;}
.movilizados{margin-left: 20px;padding:1px 5px;border:0px;text-transform:uppercase!important;font-size: 11px;font-family: Helvetica;}
.movilizados th{border:0px;padding:1px 5px;text-align:left;text-transform:uppercase!important;font-weight: 400;}

.tabla_acciones { margin-bottom: 5px;font-family: Helvetica;}
.tabla_acciones .acciones_content {margin-bottom: 10px;font-size: 11px;}
.tabla_acciones .acciones-cabecera{padding: 2px 10px 2px 10px;font-weight: bold;text-align: left;font-size:11px;background:#CDDFF8;font-weight: 400;}
.tabla_acciones .acciones-descripcion{padding: 2px 10px 10px 10px;font-size:11px;text-align: justify;}

.galeria{margin:auto;width:404px;text-transform:uppercase!important;}

.bold{font-weight:bold;}

 .footer-margin {
    margin: 1px 1px 3px 1px;
 }
* {
    text-transform: uppercase;
}

        </style>
    </head>
	<?php

$mes = "";

function mes($evento){
    switch($evento){
        case 1:$mes="ENERO";break;
        case 2:$mes="FEBRERO";break;
        case 3:$mes="MARZO";break;
        case 4:$mes="ABRIL";break;
        case 5:$mes="MAYO";break;
        case 6:$mes="JUNIO";break;
        case 7:$mes="JULIO";break;
        case 8:$mes="AGOSTO";break;
        case 9:$mes="SEPTIEMBRE";break;
        case 10:$mes="OCTUBRE";break;
        case 11:$mes="NOVIEMBRE";break;
        case 12:$mes="DICIEMBRE";break;
    }
return $mes;
}

function menorCentena($numero){

    $new = $numero;
    if($numero<10) $new="00".$numero;
    else if($numero<100) $new="0".$numero;

    return $new;

}

function nivel($codigo) {
    $nivel="";
    switch($codigo){
        case '01':$nivel="NIVEL 1";break;
        case '02':$nivel="NIVEL 2";break;
        case '03':$nivel="NIVEL 3";break;
        case '04':$nivel="NIVEL 4";break;
        case '05':$nivel="NIVEL 5";break;
    }
    return $nivel;
}

function situacion($codigo) {
    $situacion="";
    switch($codigo){
        case '01':$situacion="ALTA";break;
        case '02':$situacion="HOSPITALIZADO";break;
        case '03':$situacion="REFERIDO";break;
        case '04':$situacion="FALLECIDO";break;
        case '05':$situacion="DESAPARECIDO";break;
        case '06':$situacion="EN OBSERVACI&Oacute;N";break;
        case '07':$situacion="PARA EVACUACI&Oacute;N";break;
    }
    return $situacion;
}

function genero($codigo) {
    $situacion="";
    switch($codigo){
        case '1':$situacion="MASCULINO";break;
        case '2':$situacion="FEMENINO";break;
    }
    return $situacion;
}

function prioridad($pri) {
    $valor ="Baja";
    switch($pri) {
        case 1:$valor="Muy Alta";break;
        case 2:$valor="Alta";break;
        case 3:$valor="Media";break;        
    }
    return $valor;
}

?>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img src="<?=base_url()?>public/images/logo-informe.jpg" border="0" width="300" />
        </header>

        <footer>
            <table cellspacing="0" style="width: 100%;font-size: 10px;height: 50px;border-top:0.5px solid #AAA;">
        <tr>
            <td style="padding-top: 5px;">
            <?/*=$usuario_creacion*/?><br /><?/*=$usuario_actualizacion*/?>
            </td>
                                    
            <td style="padding-top: 5px;">
            <a href="http://sireed.minsa.gob.pe/" target="_blank" style="margin-top:0px;">http://sireed.minsa.gob.pe</a>
			<p class="footer-margin">coesalud@minsa.gob.pe</p>
            </td>
            <td style="vertical-align: top;margin-top:0;padding-top: 5px;">
            	<div class="vertical"></div>
            </td>
            <td style="padding-left: 10px;padding-top: 5px;">
			 <p class="footer-margin" style="margin-top:0px;">Ca. Guillermo Marconi N&deg; 317</p>
			 <p class="footer-margin">San Isidro - Lima 27, Per&uacute;</p>
             <p class="footer-margin">Telf. (511) 611 9930</p>
             <p class="footer-margin">COE Salud: 611 9933</p>
            </td>
        </tr>
    </table>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            

	<h4 style="margin:0 0 10px 0;font-size:17px;text-decoration:underline;text-align:center;font-wight: bold;">
		<strong>REPORTE DEL SUPER EVENTO N&deg; <?=$evento->E_ANIO?>  - COE SALUD - DIGERD</strong>
	</h4>
	<h3 class="fecha">FECHA DEL SUPER EVENTO: <?=$evento->E_DIA?> DE <?=mes($evento->E_MES)?> DEL <?=$evento->E_ANIO?>, A LAS <?=$evento->E_HORA?>:<?=$evento->E_MINUTO?> HORAS</h3>
	<br />	

	<h4>I. DESCRIPCI&Oacute;N</h4>
	<p style="font-size:12px;text-align:justify;width: 100%;"><?=str_replace("\\r\\n", "<br />",strtoupper($evento->Super_Evento_Registro_Descripcion))?></p>

	<br />
	<h4>II. UBICACI&Oacute;N</h4>
	
	<table cellpadding="0" cellspacing="0" class="tabla_ubicacion" style="margin: auto;">
		<thead>
			<tr>
    			<th>DEPARTAMENTO</th>
    			<th>PROVINCIA</th>
    			<th>DISTRITO</th>
    		</tr>
		</thead>
		<tbody>
			<?php 
			 foreach($listaEventos->result() as $row):
			?>
			<tr>
				<td><?=$row->departamento?></td>
				<td><?=$row->provincia?></td>
				<td><?=$row->distrito?></td>
			</tr>
      		<tr>
				<td colspan="3">LUGAR: <?=$row->Evento_Lugar?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<br />
	<div style="margin: auto; width: 350px; height: 350px;">
		<img style="margin: auto;border: 1px solid #ccc;" src="<?=base_url()?>public/images/eventos/supereventos/<?=$evento->id?>_gm.png" width="350" height="350" />
	</div>
	<br />

	<table style="width: 100%;" cellpadding="0" cellspacing="0" border="0">
		<tr><td>
	<h4 style="width: 100%;">III. DA&Ntilde;OS A LA SALUD</h4>

    		<table style="width: 100%;" class="lesionados" cellpadding="0" cellspacing="0">
    			<tr>
    				<th style="font-weight: bold;">LESIONADOS</th>
    				<th style="font-weight: bold;">:<?=$lesionados?></th>
    			</tr>
    			<tr>
    				<td>- MUJERES</td>
    				<td>:<?=$totalMujeres?>(*)</td>
    			</tr>
    			<tr>
    				<td>- GESTANTES</td>
    				<td>:<?=$totalGestantes?></td>
    			</tr>
    			<tr>
    				<td>- MENORES DE EDAD</td>
    				<td>:<?=$totalMenorEdad?>(**)</td>
    			</tr>
    			<tr>
    				<td>- ADULTO MAYOR</td>
    				<td>:<?=$totalAdultoMayor?>(**)</td>
    			</tr>
    			<tr>
    				<td colspan="2">(*) INCLUYENDO GESTANTES</td>
    			</tr>
    			<tr>
    				<td colspan="2">(**) INCLUYENDO AMBOS G&Eacute;NEROS</td>
    			</tr>
    			<tr>
    				<th style="font-weight: bold;">FALLECIDOS</th>
    				<th style="font-weight: bold;">:<?=$fallecidos?></th>
    			</tr>
    			<tr>
    				<th style="font-weight: bold;">DESAPARECIDOS</th>
    				<th style="font-weight: bold;">:<?=$desaparecidos?></th>
    			</tr>
    			<tr>
    				<th style="font-weight: bold;">IPRESS AFECTADAS OPERATIVAS</th>
    				<th style="font-weight: bold;">:<?=$totalIPRESSOperativas?></th>
    			</tr>
    			<tr>
    				<th style="font-weight: bold;">IPRESS AFECTADAS INOPERATIVAS</th>
    				<th style="font-weight: bold;">:<?=$totalIPRESSInoperativas?></th>
    			</tr>

    		</table>
		</td></tr>
	</table>
	<br />

	<h4>IV. RECURSOS MOVILIZADOS</h4>

	<table class="movilizados" cellpadding="0" cellspacing="0">
    			<tr>
    				<th>BRIGADISTAS</th>
    				<th>:<?=$brigadistas?></th>
    			</tr>
    			<tr>
    				<th>EQUIPOS M&Eacute;DICOS DE EMERGENCIA(E.M.T.) </th>
    				<th>:<?=$emt?></th>
    			</tr>
    			<tr>
    				<th>PERSONAL DE SALUD</th>
    				<th>:<?=$personalSalud?></th>
    			</tr>
    			<tr>
    				<th>AMBULANCIAS</th>
    				<th>:<?=$ambulancias?></th>
    			</tr>
    			<tr>
    				<th>MEDICAMENTOS E INSUMOS </th>
    				<th>:<?=$medicamentosInsumos?></th>
    			</tr>

    		</table>

	<br />
  		<?php if($accionesDescripcion->num_rows()>0){ ?>
	<h4>V. ACCIONES REALIZADAS</h4>

			<?php foreach($accionesDescripcion->result() as $row): ?>
			<div class="tabla_acciones">
				<div>
    				<table class="acciones_content" style="width: 100%;">
    					<tr>
    					<th class="acciones-cabecera"><?=$row->DIA?> DE <?=mes($row->MES)?> DE <?=$row->ANIO?>, A LAS <?=$row->HORA?></th>
    					</tr>
    					<tr>
    					<td class="acciones-descripcion"><?=str_replace("\\r\\n", "<br />", $row->descripcion)?></td>
    					</tr>
    				</table>
				</div>
			</div>
			<?php endforeach; ?>
		<?php } ?>		

	<?php 
	   $numero_tabla = 1;
	if($hospitalizadosReferidosObservados->num_rows()>0){
		    ?>
			<br />
		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - DA&Ntilde;OS A LA SALUD - RELACION DE LESIONADOS</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_observaciones" style="margin:auto">
		<thead>
			<tr>
    			<th style="width:15pt;">N&deg;</th>
    			<th style="width:80pt;">Nombres y Apellidos</th>
    			<th style="width:20pt;">Edad</th>
    			<th style="width:40pt;">Genero</th>
    			<th style="width:70pt;">Diagn&oacute;stico</th>
    			<th style="width:40pt;">Gravedad</th>
    			<th style="width:55pt;">Situaci&oacute;n</th>    			
    			<th style="width:60pt;">Lugar Atenci&oacute;n</th>
    		</tr>
		</thead>
		<tbody>
		    <?php
		    $n=1;
		    foreach($hospitalizadosReferidosObservados->result() as $row):
		    ?>
		    <tr>
		    	<td style="width:15pt;"><?=$n?></td>
				<td style="width:80pt;"><?=$row->Lesionado_Nombres.', '.$row->Lesionado_Apellidos?></td>
				<td style="width:20pt;"><?=$row->Lesionado_Edad?></td>
				<td style="width:40pt;"><?=genero($row->Lesionado_Genero)?></td>
				<td style="width:70pt;"><?=$row->CIE?></td>
				<td style="width:40pt;"><?=$row->Gravedad?></td>
				<td style="width:55pt;"><?=situacion($row->Situacion_Codigo)?></td>
				<td style="width:60pt;"><?=($row->Lesionado_Entidad_Salud_Codigo=="1")?"Atendido en foco":$row->Lesionado_Entidad_Salud_Nombre?></td>
			</tr>
		<?php
		  $n++;
		  endforeach;
		  ?>

		</tbody>
    	</table>
		  <?php
		    $numero_tabla++;
		}
		?>

		<?php if($tabla2->num_rows()>0){
		    ?>
			<br />
		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - CONSOLIDADO DE ALTAS</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="width: auto;">
		<thead>
			<tr>
    			<th>N&deg;</th>
    			<th>Nombres y Apellidos</th>
    			<th>Edad</th>
    			<th>Genero</th>
    			<th>Diagn&oacute;stico</th>
    			<th>Lugar Atenci&oacute;n</th>
    		</tr>
		</thead>
		<tbody>
		    <?php
		    $n=1;
		    foreach($tabla2->result() as $row):
		    ?>
		    <tr>
		    	<td><?=$n?></td>
				<td><?=$row->Lesionado_Nombres.', '.$row->Lesionado_Apellidos?></td>
				<td><?=$row->Lesionado_Edad?></td>
				<td><?=genero($row->Lesionado_Genero)?></td>
				<td><?=$row->CIE?></td>
				<td><?=($row->Lesionado_Entidad_Salud_Codigo=="1")?"Atendido en foco":$row->Lesionado_Entidad_Salud_Nombre?></td>
			</tr>
		<?php
		  $n++;
		  endforeach;
		  ?>

		</tbody>
	</table>
		  <?php
		    $numero_tabla++;
		}
		?>

		<?php if($consolidadoFallecidos->num_rows()>0){
		    ?>
			<br />
		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - CONSOLIDADO DE FALLECIDOS</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="margin:auto">
		<thead>
			<tr>
    			<th>N&deg;</th>
    			<th>Nombres y Apellidos</th>
    			<th>Edad</th>
    			<th>Genero</th>
    			<th>Lugar Atenci&oacute;n</th>
    		</tr>
		</thead>
		<tbody>
		    <?php
		    $n=1;
		    foreach($consolidadoFallecidos->result() as $row):
		    ?>
		    <tr>
		    	<td><?=$n?></td>
				<td><?=$row->Lesionado_Nombres.', '.$row->Lesionado_Apellidos?></td>
				<td><?=$row->Lesionado_Edad?></td>
				<td><?=genero($row->Lesionado_Genero)?></td>
				<td><?=($row->Lesionado_Entidad_Salud_Codigo=="1")?"fallecido en foco":$row->Lesionado_Entidad_Salud_Nombre?></td>
			</tr>
		<?php
		  $n++;
		  endforeach;
		  ?>

		</tbody>
    	</table>
		  <?php
		    $numero_tabla++;
		}
		?>
		
		<?php if($consolidadoDesaparecidos->num_rows()>0){
		    ?>
			<br />
		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - CONSOLIDADO DE DESAPARECIDOS</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="margin:auto">
		<thead>
			<tr>
    			<th>N&deg;</th>
    			<th>Nombres y Apellidos</th>
    			<th>Edad</th>
    			<th>Genero</th>
    		</tr>
		</thead>
		<tbody>
		    <?php
		    $n=1;
		    foreach($consolidadoDesaparecidos->result() as $row):
		    ?>
		    <tr>
		    	<td><?=$n?></td>
				<td><?=$row->Lesionado_Nombres.', '.$row->Lesionado_Apellidos?></td>
				<td><?=$row->Lesionado_Edad?></td>
				<td><?=genero($row->Lesionado_Genero)?></td>
			</tr>
		<?php
		  $n++;
		  endforeach;
		  ?>

		</tbody>
    	</table>
		  <?php
		    $numero_tabla++;
		}
		?>
		
		<?php if($brigadistas_regionales > 0 or $brigadistas_minsa > 0 or $rescatistas > 0 or $medicos_tacticos > 0){
		    ?>
			<br />
		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - BRIGADAS MOVILIZADAS</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="margin:auto">
		<thead>
			<tr>
    			<th>descripci&oacute;n</th>
    			<th>cantidad</th>
    		</tr>
		</thead>
		<tbody>
		    <tr>
				<td>regi&oacute;n / diris</td>
				<td><?=$brigadistas_regionales?></td>
			</tr>
		    <tr>
				<td>minsa nivel central</td>
				<td><?=$brigadistas_minsa?></td>
			</tr>
		    <tr>
				<td>rescatistas</td>
				<td><?=$rescatistas?></td>
			</tr>
		    <tr>
				<td>medicos t&aacute;cticos ff.aa.</td>
				<td><?=$medicos_tacticos?></td>
			</tr>
		    <tr>
				<td style="text-align: center;font-weight: bold;background-color: #7AAFF3;">total</td>
				<td style="font-weight: bold;background-color: #7AAFF3;"><?=($brigadistas_regionales+$brigadistas_minsa+$rescatistas+$medicos_tacticos)?></td>
			</tr>

		</tbody>
    	</table>
		  <?php
		    $numero_tabla++;
		}
		?>
		
		<?php if($emt_i > 0 or $emt_ii > 0 or $emt_iii > 0 or $celula_especializada > 0){
		    ?>
			<br />
		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - RECURSOS HUMANOS MOVILIZADOS - EMT</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="margin:auto">
		<thead>
			<tr>
    			<th>descripci&oacute;n</th>
    			<th>cantidad</th>
    		</tr>
		</thead>
		<tbody>
		    <tr>
				<td>e.m.t. i</td>
				<td><?=$emt_i?></td>
			</tr>
		    <tr>
				<td>e.m.t. ii</td>
				<td><?=$emt_ii?></td>
			</tr>
		    <tr>
				<td>e.m.t. iii</td>
				<td><?=$emt_iii?></td>
			</tr>
		    <tr>
				<td>celula especializada</td>
				<td><?=$celula_especializada?></td>
			</tr>
		    <tr>
				<td style="text-align: center;font-weight: bold;background-color: #7AAFF3;">total</td>
				<td style="font-weight: bold;background-color: #7AAFF3;"><?=($emt_i+$emt_ii+$emt_iii+$celula_especializada)?></td>
			</tr>

		</tbody>
    	</table>
		  <?php
		    $numero_tabla++;
		}
		?>
		
		<?php if($Personal_Minsa_Samu > 0 or $Personal_Salud_Minsa > 0 or $Personal_Essalud > 0 or $Personal_Municipalidades_Gores > 0
		    or $Personal_Voluntarios > 0 or $Personal_PNP_FFAA > 0){
		    ?>
			<br />
	<div>
		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - PERSONAL DE SALUD MOVILIZADO</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="margin:auto">
		<thead>
			<tr>
    			<th>descripci&oacute;n</th>
    			<th>cantidad</th>
    		</tr>
		</thead>
		<tbody>
		    <tr>
                <td>samu - minsa</td>
                <td><?=$Personal_Minsa_Samu?></td>
            </tr>
            <tr>
                <td>ipress - minsa</td>
                <td><?=$Personal_Salud_Minsa?></td>
            </tr>
            <tr>
                <td>essalud</td>
                <td><?=$Personal_Essalud?></td>
            </tr>
            <tr>
                <td>municipalidades / gores</td>
                <td><?=$Personal_Municipalidades_Gores?></td>
            </tr>
            <tr>
                <td>otros voluntarios</td>
                <td><?=$Personal_Voluntarios?></td>
            </tr>
            <tr>
                <td>sanidad pnp / ff.aa.</td>
                <td><?=$Personal_PNP_FFAA?></td>
            </tr>
		    <tr>
				<td style="text-align: center;font-weight: bold;background-color: #7AAFF3;">total</td>
				<td style="font-weight: bold;background-color: #7AAFF3;"><?=($Personal_Minsa_Samu+$Personal_Salud_Minsa+$Personal_Essalud+$Personal_Municipalidades_Gores+$Personal_Voluntarios+$Personal_PNP_FFAA)?></td>
			</tr>

		</tbody>
    	</table>
	</div>
		  <?php
		    $numero_tabla++;
		}
		?>

		<?php if($Ambulancias_Minsa_Samu > 0 or $Ambulancias_Minsa > 0 or $Ambulancias_Essalud > 0 or $Ambulancias_Bomberos > 0
		    or $Ambulancias_Municipalidades_Gores > 0 or $Ambulancias_PNP_FFAA > 0 or $Ambulancianas_Privadas > 0){
		    ?>
			<br />

		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - AMBULANCIAS MOVILIZADAS</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="margin:auto">
		<thead>
			<tr>
    			<th style="width: 250px">descripci&oacute;n</th>
    			<th style="width: 100px">cantidad</th>
    		</tr>
		</thead>
		<tbody>
		    <tr>
                <td>samu - minsa</td>
                <td><?=$Ambulancias_Minsa_Samu?></td>
            </tr>
            <tr>
                <td>ipress - minsa</td>
                <td><?=$Ambulancias_Minsa?></td>
            </tr>
            <tr>
                <td>essalud</td>
                <td><?=$Ambulancias_Essalud?></td>
            </tr>
            <tr>
                <td>municipalidades / gores</td>
                <td><?=$Ambulancias_Municipalidades_Gores?></td>
            </tr>
            <tr>
                <td>bomberos</td>
                <td><?=$Ambulancias_Bomberos?></td>
            </tr>
            <tr>
                <td>sanidad pnp / ff.aa.</td>
                <td><?=$Ambulancias_PNP_FFAA?></td>
            </tr>
            <tr>
                <td>privadas</td>
                <td><?=$Ambulancianas_Privadas?></td>
            </tr>
		    <tr>
				<td style="text-align: center;font-weight: bold;background-color: #7AAFF3;">total</td>
				<td style="font-weight: bold;background-color: #7AAFF3;"><?=($Ambulancias_Minsa_Samu+$Ambulancias_Minsa+$Ambulancias_Essalud+$Ambulancias_Bomberos+$Ambulancias_Municipalidades_Gores+$Ambulancias_PNP_FFAA+$Ambulancianas_Privadas)?></td>
			</tr>

		</tbody>
    	</table>
		  <?php
		    $numero_tabla++;
		}
		?>
		
		<?php if($MI_Emergencias_Desastres > 0 or $MI_Kit_Medicamentos_Insumos > 0 or $MI_Equipo_Biomedicos > 0 or $MI_Puesto_Comando > 0
		    or $MI_Ac_Victimas > 0 or $MI_Oferta_Movil_i > 0 or $MI_Oferta_Movil_ii > 0 or $MI_Oferta_Movil_iii > 0 or $MI_Hospital_Modular > 0 or $MI_Banio_Quimico_Portatil > 0){
		    ?>
			<br />

		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - MEDICAMENTOS E INSUMOS MOVILIZADOS</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="margin:auto">
		<thead>
			<tr>
    			<th style="width:270pt;">descripci&oacute;n</th>
    			<th style="width:45pt;">cantidad</th>
    		</tr>
		</thead>
		<tbody>
            <tr>
                <td style="width: 270pt;">m.e.d. (malet&iacute;n para emergencias y desastres</td>
                <td style="width: 45pt;"><?=$MI_Emergencias_Desastres?></td>
            </tr>
            <tr>
                <td style="width: 270pt;">k.m.i. (kit medicamentos e insumos)</td>
                <td style="width: 45pt;"><?=$MI_Kit_Medicamentos_Insumos?></td>
            </tr>
            <tr>
                <td style="width: 270pt;">equipos biome&eacute;dicos</td>
                <td style="width: 45pt;"><?=$MI_Equipo_Biomedicos?></td>
            </tr>
            <tr>
                <td style="width: 270pt;">puesto de comando</td>
                <td style="width: 45pt;"><?=$MI_Puesto_Comando?></td>
            </tr>
            <tr>
                <td style="width: 270pt;">a.c. victimas</td>
                <td style="width: 45pt;"><?=$MI_Ac_Victimas?></td>
            </tr>
            <tr>
                <td style="width: 270pt;">oferta m&oacute;vil tipo i</td>
                <td style="width: 45pt;"><?=$MI_Oferta_Movil_i?></td>
            </tr>
            <tr>
                <td style="width: 270pt;">oferta m&oacute;vil tipo ii</td>
                <td style="width: 45pt;"><?=$MI_Oferta_Movil_ii?></td>
            </tr>
            <tr>
                <td style="width: 270pt;">oferta m&oacute;vil tipo  iii</td>
                <td style="width: 45pt;"><?=$MI_Oferta_Movil_iii?></td>
            </tr>
            <tr>
                <td style="width: 270pt;">hospital modular</td>
                <td style="width: 45pt;"><?=$MI_Hospital_Modular?></td>
            </tr>
            <tr>
                <td style="width: 270pt;">ba&ntilde;o qu&iacute;mico portatil</td>
                <td style="width: 45pt;"><?=$MI_Banio_Quimico_Portatil?></td>
            </tr>
		    <tr>
				<td style="width:270pt;text-align: center;font-weight: bold;background-color: #7AAFF3;">total</td>
				<th style="width:45pt;font-weight: bold;background-color: #7AAFF3;"><?=($MI_Emergencias_Desastres+$MI_Kit_Medicamentos_Insumos+$MI_Equipo_Biomedicos+$MI_Puesto_Comando+$MI_Ac_Victimas+$MI_Oferta_Movil_i+$MI_Oferta_Movil_ii+$MI_Oferta_Movil_iii+$MI_Hospital_Modular+$MI_Banio_Quimico_Portatil)?></th>
			</tr>

		</tbody>
    	</table>
		  <?php
		    $numero_tabla++;
		  }
		?>
		
		<?php if(count($IPRESSOperativas)>0){
		    ?>
			<br />
		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - CONSOLIDADO DE IPRESS AFECTADAS OPERATIVAS</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="margin:auto">
        		<thead>
        			<tr>
            			<th style="width:20pt;">N&deg;</th>
            			<th style="width:30pt;">NIVEL</th>
            			<th style="width:125pt;">NOMBRE DE LA EESS</th>
            			<th style="width:105pt;">PROVINCIA</th>
            			<th style="width:105pt;">DISTRITO</th>
            		</tr>
        		</thead>
        		<tbody>
        		    <?php
        		    $n=1;
        		    for($i=0;$i<count($IPRESSOperativas);$i++){
        		    ?>
        		    <tr>
        		    	<td style="width:20pt;"><?=$n?></td>
        		    	<td style="width:30pt;"><?=$IPRESSOperativas[$i]->CodCategoria?></td>
        				<td style="width:125pt;"><?=$IPRESSOperativas[$i]->Nombre?></td>
        				<td style="width:105pt;"><?=$IPRESSOperativas[$i]->provincia?></td>
        				<td style="width:105pt;"><?=$IPRESSOperativas[$i]->distrito?></td>
        			</tr>
        		<?php
        		  $n++;
        		    }
        		  ?>

        		</tbody>
			</table>
        	<?php
        	   $numero_tabla++;
		      }
        	?>

		<?php if(count($IPRESSInoperativas)>0){ ?>
			<br />
			<h4 align="center">TABLA N&deg; <?=$numero_tabla?> - CONSOLIDADO DE IPRESS AFECTADAS INOPERATIVAS</h4>
		    <table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="margin:auto">
        		<thead>
        			<tr>
            			<th style="width:20pt;">N&deg;</th>
            			<th style="width:30pt;">NIVEL</th>
            			<th style="width:105pt;">NOMBRE DE LA EESS</th>
            			<th style="width:65pt;">PROVINCIA</th>
            			<th style="width:65pt;">DISTRITO</th>
            			<th style="width:100pt;">CONTIGENCIA</th>
            		</tr>
        		</thead>
        		<tbody>
        		    <?php
        		    $n=1;
        		    for($i=0;$i<count($IPRESSInoperativas);$i++){
        		    ?>
        		    <tr>
        		    	<td style="width:20pt;"><?=$n?></td>
        		    	<td style="width:30pt;"><?=$IPRESSInoperativas[$i]->CodCategoria?></td>
        				<td style="width:105pt;"><?=$IPRESSInoperativas[$i]->Nombre?></td>
        				<td style="width:65pt;"><?=$IPRESSInoperativas[$i]->provincia?></td>
        				<td style="width:65pt;"><?=$IPRESSInoperativas[$i]->distrito?></td>
        				<td style="width:100pt;"><?=$IPRESSInoperativas[$i]->lugar?></td>
        			</tr>
        		<?php
        		  $n++;
        		    }
        		  ?>

        		</tbody>
			</table>
        	<?php
        	   $numero_tabla++;
        		}
        	?>
    	<br />
		<?php if ($Equipos_Tecnicos->num_rows() > 0) { ?>
			<br />
			
			<?php 
			$total = 0;
			foreach($Equipos_Tecnicos->result() as $row): ?>
			<?php $total=$total+$row->Equipo_Tecnico_Movilizado_Diresa+$row->Equipo_Tecnico_Movilizado_Red+$row->Equipo_Tecnico_Movilizado_Diris+$row->Equipo_Tecnico_Movilizado_Ipress+$row->Equipo_Tecnico_Movilizado_Digerd+$row->Equipo_Tecnico_Movilizado_Minsa+$row->Equipo_Tecnico_Movilizado_Otros;  ?>
			<? endforeach; ?>
			<?php if($total > 0){ ?>
			<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - Equipo T&eacute;cnico Movilizado</h4>
			<?php foreach($Equipos_Tecnicos->result() as $row):
					if(($row->Equipo_Tecnico_Movilizado_Diresa+$row->Equipo_Tecnico_Movilizado_Red+$row->Equipo_Tecnico_Movilizado_Diris+$row->Equipo_Tecnico_Movilizado_Ipress+$row->Equipo_Tecnico_Movilizado_Digerd+$row->Equipo_Tecnico_Movilizado_Minsa+$row->Equipo_Tecnico_Movilizado_Otros) > 0){
			?>
		    <table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos alternativo" style="margin:auto;margin-bottom: 5px;">
        		<tbody>
        			<tr>
        				<th colspan="2" align="center"><?=$row->Fecha_Registro_F?></th>
        			</tr>
        			<tr>
        				<th class="alternativo" style="width:200px;">DIRESA/GERESA</th>
        				<td align="center" style="width:100px;"><?=$row->Equipo_Tecnico_Movilizado_Diresa?></td>
        			</tr>
        			<tr>
        				<th class="alternativo">RED</th>
        				<td align="center"><?=$row->Equipo_Tecnico_Movilizado_Red?></td>
        			</tr>
        			<tr>
        				<th class="alternativo">DIRIS</th>
        				<td align="center"><?=$row->Equipo_Tecnico_Movilizado_Diris?></td>
        			</tr>
        			<tr>
        				<th class="alternativo">IPRESS</th>
        				<td align="center"><?=$row->Equipo_Tecnico_Movilizado_Ipress?></td>
        			</tr>
        			<tr>
        				<th class="alternativo">DIGERD</th>
        				<td align="center"><?=$row->Equipo_Tecnico_Movilizado_Digerd?></td>
        			</tr>
        			<tr>
        				<th class="alternativo">MINSA</th>
        				<td align="center"><?=$row->Equipo_Tecnico_Movilizado_Minsa?></td>
        			</tr>
        			<tr>
        				<th class="alternativo">Otros</th>
        				<td align="center"><?=$row->Equipo_Tecnico_Movilizado_Otros?></td>
        			</tr>
        		</tbody>
			</table>
			<?php 
							}
						endforeach; ?>
        	<?php
					$numero_tabla++;
					}
				}
        	?>
    	<br />
		
		<?php if($eventomedicamentos->num_rows()>0){
		    ?>
			<br />
		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - MEDICAMENTOS E INSUMOS</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="margin:auto">
		<thead>
			<tr>
    			<th style="width:200px;">Art&iacute;culo</th>
    			<th style="width:200px;">Presentaci&oacute;n</th>
    			<th style="width:80px;">Cantidad</th>
    			<th style="width:80px;">Prioridad</th>
    		</tr>
		</thead>
		<tbody>
		    <?php
		    $n=1;
		    foreach($eventomedicamentos->result() as $row):
		    ?>
		    <tr>
				<td><?=$row->articulo?></td>
				<td><?=$row->presentacion?></td>
				<td><?=$row->cantidad?></td>
				<td><?=prioridad($row->prioridad)?></td>
			</tr>
		<?php
		  $n++;
		  endforeach;
		  ?>

		</tbody>
    	</table>
		  <?php
		    $numero_tabla++;
		}
		?>
    	<br />
		
		<?php if($eventoequipos->num_rows()>0){
		    ?>
			<br />
		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - EQUIPOS, MOBILIARIO Y OFERTA MOVIL</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="margin:auto">
		<thead>
			<tr>
    			<th style="width:200px;">Descripci&oacute;n</th>
    			<th style="width:200px;">Fuente</th>
    			<th style="width:80px;">Cantidad</th>
    			<th style="width:80px;">Prioridad</th>
    		</tr>
		</thead>
		<tbody>
		    <?php
		    $n=1;
		    foreach($eventoequipos->result() as $row):
		    ?>
		    <tr>
				<td><?=$row->descripcion?></td>
				<td><?=$row->fuente?></td>
				<td><?=$row->cantidad?></td>
				<td><?=prioridad($row->prioridad)?></td>
			</tr>
		<?php
		  $n++;
		  endforeach;
		  ?>

		</tbody>
    	</table>
		  <?php
		    $numero_tabla++;
		}
		?>
    	<br />
		
		<?php if($eventorecursos->num_rows()>0){
		    ?>
			<br />
		<h4 align="center">TABLA N&deg; 0<?=$numero_tabla?> - RECURSOS HUMANOS</h4>
		<table cellpadding="0" cellspacing="0" align="center" class="tabla_fallecidos" style="margin:auto">
		<thead>
			<tr>
    			<th style="width:200px;">Profesi&oacute;n</th>
    			<th style="width:200px;">Especialidad</th>
    			<th style="width:80px;">Cantidad</th>
    			<th style="width:80px;">Prioridad</th>
    		</tr>
		</thead>
		<tbody>
		    <?php
		    $n=1;
		    foreach($eventorecursos->result() as $row):
		    ?>
		    <tr>
				<td><?=$row->profesion?></td>
				<td><?=$row->especialidad?></td>
				<td><?=$row->cantidad?></td>
				<td><?=prioridad($row->prioridad)?></td>
			</tr>
		<?php
		  $n++;
		  endforeach;
		  ?>

		</tbody>
    	</table>
		  <?php
		    $numero_tabla++;
		}
		?>
		<br />
		<br />
    	
		<?php if($imagenes->num_rows()>0){ ?>
    	<h4 align="center">GALER&Iacute;A FOTOS</h4>
		 <?php
		    $n=1;
		    foreach($imagenes->result() as $row):
		    ?>
			<div class="col-xs-12 text-center galeria">
		    <img src="<?=base_url()?>public/images/eventos/<?=$row->imagen?>" border="0" width="400" />
		    <p align="center">IMAGEN <?=$n?>: <?=$row->descripcion?></p>
			</div>
		    <br />
		<?php
		$n++;
		endforeach; ?>
		<?php } ?>
			
			
        </main>
    </body>
</html>