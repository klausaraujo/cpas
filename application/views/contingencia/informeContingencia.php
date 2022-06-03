<html>
<head>
  <style>
    @page {
      margin: 0cm 0cm;        
    }
    body {
      margin-top: 3.5cm;
      margin-left: 2cm;
      margin-right: 2cm;
      margin-bottom: 2.89cm;
      font-family: Helvetica;
    }
    header {
      position: fixed;
      left: 0cm;
      right: 0cm;
      height: 80px;
      width: 100%;
    }
    footer {
      position: fixed;
      bottom: 1cm;
      left: 0;
      right: 0cm;
      height: 50px;
      width: 100%;
    }
    table {
      margin-top: 5px auto;
      width: 100%;
      border-collapse: collapse;
      margin: 3px auto;
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
    <img src="<?=base_url()?>public/images/header_contingencias.jpg" border="0" width="100%" />
  </header>
  <footer>
    <img src="<?=base_url()?>public/images/footer_contingencias.jpg" border="0" width="100%" />
  </footer>
<main>
    <h4 style="margin: 5px 0 10px 0;font-size:19px;text-decoration:underline;text-align:center;font-wight: bold;">
      <strong>FICHA DE EVALUACION DEL PLANES DE CONTINGENCIA</strong>
    </h4>
      <table>
      <thead>
      </thead>
      <tbody>
        <tr>
          <td colspan=4 class="title" style="font-weight: bold;">Datos del Plan de Contingencia</td>
        </tr>
        <tr>
          <td colspan=1 >TITULO</td>
          <td colspan=3 ><?=$cabecera->titulo?></td>
        </tr>
        <tr>
          <td colspan=1 >RESOLUCIÓN</td>
          <td colspan=3 ><?=$cabecera->resolplan?></td>
        </tr>
        <tr>
          <td colspan=1 >FECHA DE APROBACIÓN</td>
          <td colspan=3 ><?=$cabecera->fecha_publicacion?></td>
        </tr>
        <tr>
          <td colspan=1 >PRESUPUESTO</td>
          <td colspan=3 ><?=$cabecera->presupuesto?></td>
        </tr>
        <tr>
          <td colspan=1 >TIPO DE PELIGRO</td>
          <td colspan=3 ><?=$cabecera->origen?></td>
        </tr>
        <!--
        <tr>
          <td colspan=1 >VIGENCIA INCIO</td>
          <td colspan=3 ><?=$cabecera->vigencia_inicio?></td>
        </tr>
        <tr>
          <td colspan=1 >VIGENCIA FIN</td>
          <td colspan=3 ><?=$cabecera->vigencia_fin?></td>
        </tr>
        -->
        <tr>
          <td colspan=1 >Tipo de Evento</td>
          <td colspan=3 ><?=$cabecera->descripcion?></td>
        </tr>
        <tr>
          <td colspan=1 >Institución</td>
          <td colspan=3 ><?=$cabecera->institucion?></td>
        </tr>
        <tr>
          <td colspan=1 >Región</td>
          <td colspan=3 ><?=$cabecera->region?></td>
        </tr>
        <tr>
          <td colspan=1 >DISA/DIRESA</td>
          <td colspan=3 ><?=$cabecera->disa?></td>
        </tr>
        <tr>
          <td colspan=1 >Red</td>
          <td colspan=3 ><?=$cabecera->red?></td>
        </tr>
        <tr>
          <td colspan=1 >Micro Red</td>
          <td colspan=3 ><?=$cabecera->microred?></td>
        </tr>
        <tr>
          <td colspan=1 >IPRESS</td>
          <td colspan=3 ><?=$cabecera->ipress?></td>
        </tr>
      </tbody>
    </table>
        <table >
        <tbody>
        <tr>
          <td colspan=5 class="title" style="font-weight: bold;">DETALE DE LA EVALUACION</td>
        </tr>
        <tr>
          <td colspan=1 style="text-align: center;">Item</td>
          <td colspan=1 style="text-align: center;">Descripcion Item (Preguntas)</td>
          <td colspan=1 style="text-align: center;">RESPUESTA</td>
          <td colspan=1 style="text-align: center;">Puntaje</td>
          <td colspan=1 style="text-align: center;">Comentario</td>
        </tr>
        <?php
		    $n=1;
		    foreach($listacuestionario->result() as $row):
		    ?>
        <tr>
          <td colspan=1 style="text-align: center;"><?=$row->Item?></td>
          <td colspan=1 ><?=$row->Pregunta?></td>
          <td colspan=1 style="text-align: center;"><?=$row->Respuesta?></td>
          <td colspan=1 style="text-align: center;"><?=$row->Puntaje?></td>
          <td colspan=1 ><?=$row->Comentarios?></td>
        </tr>
      <?php
		  $n++;
		  endforeach;
		  ?>
        <tr>
          <td colspan=3 style="text-align: right;">Puntaje Total de Evaluacion</td>
          <td colspan=1 style="text-align: center;"><?=$cabecera->calificacion?></td>
          <td colspan=1 >Tipo de Evaluación: <?=$cabecera->condicion?></td>
        </tr>
        </tbody>
        </table>
        <br><br><br><br><br><br>
        <table style="border:none;">
        <tbody>
        <tr>
          <td colspan=3 style="text-align: center; border: 0px solid #ccc;" >________________________________________</td>
          <td colspan=2 style="text-align: center; border: 0px solid #ccc;" >________________________________________</td>
        </tr>
        <tr>
          <td colspan=3 style="text-align: center; border: 0px solid #ccc;">Evaluador</td>
          <td colspan=2 style="text-align: center; border: 0px solid #ccc;">Gestor del Plan</td>
        </tr>
        </tbody>
        </table>
  </main>
</body>
</html>