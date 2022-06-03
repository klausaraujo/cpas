<html>

<head>
  <style>
    @page {
      margin: 0cm 0cm;
    }

    /** Define now the real margins of every page in the PDF **/
    body {
      margin-top: 2cm;
      margin-left: 2cm;
      margin-right: 2cm;
      margin-bottom: 2.89cm;
      font-family: Helvetica;
    }

    /** Define the header rules **/
    header {
      position: fixed;
      /* top: 0.5cm; */
      left: 0cm;
      right: 0cm;
      height: 50px;
      width: 100%;
    }

    /** Define the footer rules **/
    footer {
      position: fixed;
      bottom: 1cm;
      left: 0;
      right: 0cm;
      height: 50px;
      width: 100%;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 10px auto;
    }

    th {
      background: #3498db;
      color: white;
      font-weight: bold;
    }

    td,
    th {
      padding: 2.1px;
      border: 1px solid #ccc;
      text-align: left;
      font-size: 10px;
    }

    .title {
      background: #2E74B5;
      color: white;
    }

    .subtitle {
      background: #ED7D31;
      color: white;
      text-align: center;
    }

    .detail {
      font-size: 6px;
    }

    .column__td {
      text-align: center;
      text-transform: uppercase;
    }

    .column__td.is-yellow {
      background: #ff0;
    }

    .column__td.is-orange {
      background: #f90;
    }

    .column__td.is-red {
      background: #f00;
    }

    .table__title{
      text-align: center;
      text-transform: uppercase;
      font-size: 12px;
    }
    .table_title{
      text-align: center;
      text-transform: uppercase;
      font-size: 18px;
    }
    .table__subtitle{
      text-align: center;
      text-transform: uppercase;
      font-size: 12px;
      background: #ff9900;
      color: white;
    }
    .table__subtitle1{
      text-align: center;
      text-transform: uppercase;
      font-size: 12px;
      background: #ff0000;
      color: white;
    }
    .table__subtitle2{
      text-align: center;
      text-transform: uppercase;
      font-size: 12px;
      background: #ffff00;
      color: black;
    }
    .table__subtitle3{
      text-align: center;
      text-transform: uppercase;
      font-size: 12px;
      background: #ffffff;
      color: black;
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
  <header>
    <img src="<?=base_url()?>public/images/header_alertas.png" border="0" width="100%" />
  </header>

  <footer>
    <img src="<?=base_url()?>public/images/footer_alertas.png" border="0" width="100%" />
  </footer>
  <?php
      if($alerta->tipo_aviso == 0){
	?>
  <main>
    <h4 style="margin: 60px 0 10px 0;font-size:22px;text-decoration:underline;text-align:center;font-wight: bold;">
      <strong>AVISO METEOROLÓGICO N&deg; <?=addCeros4($alerta->evento_avisos_numero)?> –
        <?=$alerta->evento_avisos_anio?> – COE SALUD – DIGERD – MINSA</strong>
    </h4>
    <br />
    <table>
      <thead>
        <tr>
          <th colspan=4 class="table__title" style="font-weight: bold;">
            <?=$alerta->titulo?> <br>
            <?=$alerta->fecha_registro?>
          </th>
        </tr>
      </thead>
      <tbody>
      <?php
        if($alerta->nivel_peligro==3)
            {?> 
              <tr class="table__subtitle"  style="font-weight: bold;"><?php
            }
        if($alerta->nivel_peligro==4)
            {?> 
              <tr class="table__subtitle1"  style="font-weight: bold;"><?php
            }
        if($alerta->nivel_peligro==2)
            {?> 
              <tr class="table__subtitle2"  style="font-weight: bold;"><?php
            }
        if($alerta->nivel_peligro==1)
            {?> 
              <tr class="table__subtitle3"  style="font-weight: bold;"><?php
            }                                
      ?>   
        <td colspan=4 style="text-align: center; font-size: 18px;">
          NIVEL: <?=$alerta->nivel_peligro?>
          </td>
        </tr>
        <tr>
          <td colspan=2 height="300" style="text-align: center;">
            <img style="margin: auto;border: 1px solid #ccc;" src="<?=base_url()?>public/avisos/<?=$alerta->archivo_mapa?>"
              width="300" height="400" text-align="center"/>
          </td>
          <td colspan=2 height="300">
            <?=$alerta->descripcion_general?>
          </td>
        </tr>
        <tr>
          <td colspan=4 class="title" style="font-weight: bold;">NIVELES DE PELIGRO</td>
        </tr>
        <tr>
          <td colspan=1 class="column__td">NIVEL 1</td>
          <td colspan=1 class="column__td is-yellow">NIVEL 2</td>
          <td colspan=1 class="column__td is-orange">NIVEL 3</td>
          <td colspan=1 class="column__td is-red">NIVEL 4</td>
        </tr>
        <tr class="detail">
          <td colspan=1>No es necesario tomar precauciones especiales.</td>
          <td colspan=1>Sea prudente si realiza actividades al aire libre que puedan acarrear riesgos en caso de mal
            tiempo,
            pueden ocurrir fenómenos meteorológicos peligrosos que sin embargo son normales en esta región. Manténganse
            al corriente del desarrollo de situación meteorológica.</td>
          <td colspan=1>Se predicen fenómenos meteorológicos peligrosos. Manténganse al corriente del desarrollo de la
            situación
            y cumpla los consejos e instrucciones dados por las autoridades.</td>
          <td colspan=1>Sea extremadamente precavido; se predicen fenómenos meteorológicos de gran magnitud. Este al
            corriente en
            todo momento del desarrollo de la situación y cumpla los consejos e instrucciones dados por las
            autoridades.</td>
        </tr>
        <tr>
          <td colspan=4 class="title">FUENTE</td>
        </tr>
        <tr>
          <td colspan=4 style="text-transform: uppercase; font-weight: bold;"><?=$alerta->fuente?> - AVISO </td>
        </tr>
        <tr>
          <td colspan=4 class="title" style="font-weight: bold;">VIGENCIA DEL EVENTO</td>
        </tr>
        <tr>
          <td colspan=1 >FECHA DE INICIO:</td>
          <td colspan=3 ><?=$alerta->fecha_inicio?></td>
        </tr>
        <tr>
          <td colspan=1 >FECHA DE TÉRMINO:</td>
          <td colspan=3 ><?=$alerta->fecha_fin?></td>
        </tr>
        <tr>
          <td colspan=1 >PERIODO DE VIGENCIA:</td>
          <td colspan=3 style="color: red;"><?=$alerta->horas?> Horas</td>
        </tr>
        <tr>
          <th colspan=4 class="table__title" style="font-weight: bold;">
            ZONAS ALERTADAS
          </th>
        </tr>
      <?php
      if($ubigeos1->num_rows()>0){
		    ?>
		  	<tr>
    			<th colspan=1>DEPARTAMENTO</th>
    			<th colspan=3>PROVINCIA</th>
    		</tr>
		<tbody>
		    <?php
		    $n=1;
		    foreach($ubigeos1->result() as $row):
		    ?>
		    <tr>
				<td colspan=1><?=$row->Region?></td>
        <td colspan=3><?=$row->Provincias?></td>
			</tr>
		<?php
		  $n++;
		  endforeach;
		  ?>
      </tbody>
		  <?php
		}
		?>
        <tr>
          <td colspan=4 class="title" style="font-weight: bold;">A LOS ESPACIOS DE MONITOREO</td>
        </tr>
        <?php if($recomendacionesEspacios->num_rows()>0){ ?>
          <?php foreach($recomendacionesEspacios->result() as $row): ?>
          <tr>
            <td colspan=4 style="height: 80px;"><?=$row->descripcion?></td>
          </tr>
          <?php endforeach; ?>
        <?php } ?>	
        <tr>
          <td colspan=4 class="title" style="font-weight: bold;">A LOS ESTABLECIMIENTOS DE SALUD</td>
        </tr>
        <?php if($recomendacionesSalud->num_rows()>0){ ?>
          <?php foreach($recomendacionesSalud->result() as $row): ?>
          <tr>
            <td colspan=4><?=$row->descripcion?></td>
          </tr>
          <?php endforeach; ?>
        <?php } ?>	
      </tbody>
    </table>
    
    <br />

  </main>

  <?php
      }
      else{
  ?>  
<main>
    <h4 style="margin: 60px 0 10px 0;font-size:19px;text-decoration:underline;text-align:center;font-wight: bold;">
      <strong>AVISO HIDROLÓGICO N&deg; <?=addCeros4($alerta->evento_avisos_numero)?> –
        <?=$alerta->evento_avisos_anio?> – COE SALUD – DIGERD – MINSA</strong>
    </h4>
  
    <table>
      <thead>
        <tr>
          <th colspan=4 class="table_title" style="font-weight: bold;">
            <?=$alerta->titulo?> <br>
          </th>
        </tr>
      </thead>
      <tbody>
      <?php
        if($alerta->nivel_peligro==3)
            {?> 
              <tr class="table__subtitle"  style="font-weight: bold;"><?php
            }
        if($alerta->nivel_peligro==4)
            {?> 
              <tr class="table__subtitle1"  style="font-weight: bold;"><?php
            }
        if($alerta->nivel_peligro==2)
            {?> 
              <tr class="table__subtitle2"  style="font-weight: bold;"><?php
            }
        if($alerta->nivel_peligro==1)
            {?> 
              <tr class="table__subtitle3"  style="font-weight: bold;"><?php
            }                                
      ?>   
        <td colspan=4 style="text-align: center; font-size: 18px;">
          NIVEL: <?=$alerta->nivel_peligro?>
          </td>
        </tr>

        <tr>  
          <td colspan=4 height="50">
            <?=$alerta->descripcion_general?>
          </td>
        </tr>

        <tr>
          <td colspan=4 height="280" style="text-align: center;">
            <img style="margin-left: 20px;border: 1px solid #ccc;" src="<?=base_url()?>public/avisos/<?=$alerta->archivo_mapa?>"
              height="380" text-align="center"/>
          </td>
        </tr>
        
        <tr>
          <td colspan=4 class="title" style="font-weight: bold;">NIVELES DE PELIGRO</td>
        </tr>
        <tr>
          <td colspan=1 class="column__td">NIVEL 1</td>
          <td colspan=1 class="column__td is-yellow">NIVEL 2</td>
          <td colspan=1 class="column__td is-orange">NIVEL 3</td>
          <td colspan=1 class="column__td is-red">NIVEL 4</td>
        </tr>
        <tr class="detail">
          <td colspan=1>No es necesario tomar precauciones especiales.</td>
          <td colspan=1>Sea precavido al realizar actividades cerca de los ríos, cursos o cuerpos de agua ante ligeros incrementos que puedan acarrear riesgos, sin embargo son situaciones normales en esta región. Manténgase al corriente del desarrollo de la situación hidrológica.</td>
          <td colspan=1>Se prevé la ocurrencia de un evento hidrológico peligroso. Este atento en todo momento del desarrollo de la situación y cumpla los consejos e instrucciones dados por las autoridades evitando desarrollar actividades cerca de los ríos, cursos o cuerpos de agua.</td>
          <td colspan=1>Sea extremadamente precavido; ante la ocurrencia de un evento hidrológico de gran magnitud (desbordes, inundaciones y/o huaycos). Este al corriente en todo momento del desarrollo de la situación y cumpla los consejos e instrucciones dados por las autoridades, evitando desarrollar actividades cerca de los ríos, cursos o cuerpos de agua.</td>
        </tr>
        <tr>
          <td colspan=4 class="title">FUENTE</td>
        </tr>
        <tr>
          <td colspan=4 style="text-transform: uppercase; font-weight: bold;"><?=$alerta->fuente?> - AVISO </td>
        </tr>
        <tr>
          <td colspan=1 >FECHA DE INICIO:</td>
          <td colspan=3 ><?=$alerta->fecha_inicio?></td>
        </tr>
        <tr>
          <td colspan=1 >FECHA DE TÉRMINO:</td>
          <td colspan=3 ><?=$alerta->fecha_fin?></td>
        </tr>
        <tr>
          <td colspan=1 >PERIODO DE VIGENCIA:</td>
          <td colspan=3 style="color: red;"><?=$alerta->horas?> Horas</td>
        </tr>
        <tr>
          <th colspan=4 class="table_title" style="font-weight: bold;">
            ZONAS ALERTADAS
          </th>
        </tr>
      <?php
      if($ubigeos1->num_rows()>0){
		    ?>
		  	<tr>
    			<th colspan=1>DEPARTAMENTO</th>
    			<th colspan=3>PROVINCIA</th>
    		</tr>
		<tbody>
		    <?php
		    $n=1;
		    foreach($ubigeos1->result() as $row):
		    ?>
		    <tr>
				<td colspan=1><?=$row->Region?></td>
        <td colspan=3><?=$row->Provincias?></td>
			</tr>
		<?php
		  $n++;
		  endforeach;
		  ?>
      </tbody>
		  <?php
		}
		?>
        <tr>
          <td colspan=4 class="title" style="font-weight: bold;">A LOS ESPACIOS DE MONITOREO</td>
        </tr>
        <?php if($recomendacionesEspacios->num_rows()>0){ ?>
          <?php foreach($recomendacionesEspacios->result() as $row): ?>
          <tr>
            <td colspan=4 style="height: 80px;"><?=$row->descripcion?></td>
          </tr>
          <?php endforeach; ?>
        <?php } ?>	
        <tr>
          <td colspan=4 class="title" style="font-weight: bold;">A LOS ESTABLECIMIENTOS DE SALUD</td>
        </tr>
        <?php if($recomendacionesSalud->num_rows()>0){ ?>
          <?php foreach($recomendacionesSalud->result() as $row): ?>
          <tr>
            <td colspan=4><?=$row->descripcion?></td>
          </tr>
          <?php endforeach; ?>
        <?php } ?>	
      </tbody>
    </table>
    
    <br />

  </main>
   <?php
      }
  ?>

</body>

</html>