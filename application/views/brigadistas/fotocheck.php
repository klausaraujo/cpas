<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Fotocheck</title>
  <style type="text/css">
	@page {
	  margin: 0;
	}
	.page_break { page-break-before: always; }
	body {
        margin: 0;
        padding: 0;
        text-align: left;
        border-radius: 10px;
        font-family: 'Roboto', sans-serif;
        font-stretch: ultra-condensed;
	}
	div.header,div.header2,
	div.footer,div.footer2 {
	  position: fixed;
	  background: #ddd;
	  width: 100%;
	  border: 0px solid #888;
	  overflow: hidden;
	  padding: 0.1cm;
	}
	div.leftpane {
		position: fixed;
		background: #ddd;
		width: 3cm;
		border-right: 1px solid #888;
		top: 0cm;
	  left: 0cm;
		height: 30cm;
	}
	div.header,div.header2 {
	  top: 0cm;
		left: 0cm;
	  border-bottom-width: 1px;
	  height: 3cm;
	}
	div.footer,div.footer2 {
	  bottom: 0cm;
		left: 0cm;
	  border-top-width: 1px;
	  height: 1cm;
	}
	div.footer table,div.footer2 table {
	  width: 100%;
	  text-align: center;
	}
	hr {
	  page-break-after: always;
	  border: 0;
	}
    .logo {
        position: absolute;
        height: auto;
        width: 1000px;
        margin: auto;
        top: 50px;
        left: 67px;
	    z-index: 100;
    }
    .logo img {
        width: 100%;
        height: 100%;
    }
	.foto {
	   margin: auto;
	   position: absolute;
	   width: 755px;
	   height: 775px;
	   top: 280px;
	   left: 190px;
	   z-index: 100;
	}
	.imagen {
	   width: 755px;
	   height: 775px;
	   background-color: black;
	   margin:0;
	   padding: 0;
	   position: relative;
	}
	.imagen img {
	   width: 100%;
	   height: 100%;
	  }
	.imagen .icono {
	   width: 200px;
	   height: 200px;
	   position: absolute;
	   top: 620px;
	   right: 0;
	   margin-right: 10px;
	   z-index: 110;
	}
	.tipo {
	    align-items: center;
        height: 120px;
        background-color: #0E6E98;
        font-size: 24px;
        text-align: center;
        margin:0;
        padding: 0;
        position: relative;  
	}
	.tipo span {
	   display: block;
	   width: 100%;
	   height: 50px;
	   font-size: 80px;
	   color: white;
	   margin: auto;
	   padding-top: 30px;
	}
	.posicion {
	   position: absolute;
	   bottom: 12px;
	   height: 70px;
	   width: 100%;
	   font-size: 50px;
	   color: white;
	   text-align: center;
	   background-color: #5F6062;
	   height: 70px;
	}
	.posicion2 {
	   position: absolute;
	   width: 100%;
	   font-size: 50px;
	   color: white;
	   text-align: center;
	   background-color: #5F6062;
	   height: 70px;
	   top: 20px;
	}
	.ubicacion {
	   bottom: 350px;
	   text-transforme: uppercase;
	}
	.barcode {
	   position: absolute;
	   bottom: 20px;
	   width: 100%;
	   height: auto;
	   margin: auto;
	}
	.code {
	   width: 480px;
	   height: 480px;
	   text-align: center;
	   background-image:url('<?=base_url()?>public/images/brigadistas/<?=$fileName?>');
	   background-repeat: no-repeat;
	   background-position: 50%;
	   margin: auto;
	}
	.number {
	   font-size: 28px;
	   text-align: center;
	   width: 100%;
	}
    .nombre {
        position: absolute;
        bottom: 250px;
        width: 850px;
    }
    .nombre p {
        font-size: 80px;
        line-height: 80px;
        margin: 0;
        font-weight: bold;
        color: #5F6062;
        font-family: 'Helvetica';
        font-stretch: ultra-condensed;
        margin-bottom: 5px;
  }
  .nombre p:first-chid {
    font-weight: bold;
    margin-bottom: 0;
  }
  .nombre small {
    color: #5F6062;
    font-size: 40px;
    position: absolute;
    margin-top: 10px;
    font-weight: 800;
  }
  .datos {
    width: 750px;
    margin: auto;
    padding-top: 50px;
  }
  .datos.more {
	  padding-top: 100px;
  }
  .datos p {
    color: #5F6062;
    margin: 5px 0;
    font-size: 50px;
  }
  .datos .content {
    width: 100%;
    text-align: center;
    background-color: #0E6E98;
    border-radius: 20px;
    padding: 10px 5px;
  }
  .datos .content p {
    text-align: center;
    margin: 5px;
    color: white;
    font-weight: bold;
    font-size: 80px;
  }
  .datos .content p.medium {
    font-size: 50px;
  }
  .datos .content p.small {
    font-size: 40px;
    font-weight: normal;
  }
  .separador {
    width: 100%;
    overflow: hidden;
    height: 30px;
  }
  </style>
</head>
    <body>
    	<div class="logo">
    		<img src="<?=base_url()?>public/images/new-logo.jpg" />
    	</div>
        	<div class="foto">
    		<div class="imagen">
				<img src="<?=base_url()."public/images/brigadistas/".$foto?>" />
        		<div class="icono">
        			<img src="<?=base_url()?>public/images/login-icon.png" />
        		</div>
    		</div>
    		<?php if (strlen($certificado) > 5) { ?>
    		<div class="tipo" style="width: 520px;">
    			<span style="padding-top: 15px;"><?=$certificado?></span>
        	</div>
        	<?php } else { ?>
        	<div class="tipo" style="width: 282px;">
    			<span style="padding-top: 10px;"><?=$certificado?></span>
        	</div>
        	<?php } ?>
        <div class="nombre">
          <p><?=$carnet->nombres?></p>
          <p><?=$carnet->apellidos?></p>
        </div>
        <div class="nombre">
          <small><?=$profesionEspecialidad->Carrera?></small></div>
    	</div>
    	<div class="posicion"><?=($categoria == '[N/A]')?'':$categoria?></div>
    <div class="page_break"></div>
    <div class="posicion2"><?=$trabajo?></div>
    <div class="datos more">
      <p>GRUPO SANGU&Iacute;NEO</p>
      <div class="content">
        <p><?=$grupo_sanguineo?></p>
      </div>
    </div>
    <div class="separador"></div>
    <div class="datos">
      <p>AL&Eacute;RGICO A MEDICAMENTOS</p>
      <div class="content" style="height: 200px">
        <p class="medium"><?=$carnet->alergias?></p>
      </div>
    </div>
    <div class="separador"></div>
    <div class="datos">
      <p>EN CASO DE EMERGENCIAS, LLAMAR A:</p>
      <div class="content">
        <p class="medium"><?=strtoupper($carnet->contacto_emergencia)?></p>
        <p class="small">(<?=$parentesco?>)</p>
        <p class="small"><?=$carnet->telefono_emergencia_01;(strlen($carnet->telefono_emergencia_02)>0)?' - '.$carnet->telefono_emergencia_02:''?></p>
      </div>
    </div>
    	<div class="barcode">
    		<div class="code"></div>
    		<div class="number"><?=$carnet->documento_numero?></div>
    	</div>
    </body>
</html>
