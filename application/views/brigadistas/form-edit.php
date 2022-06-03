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
<link href="<?=base_url()?>public/css/datatables.min.css" rel="stylesheet" type="text/css">
<style>                        
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
input[type=number] { -moz-appearance:textfield; }
</style>
   </head>
   <body>
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <div class="wrapper">
      <?php $this->load->view("inc/nav-template"); ?>
         <div id="content-page" class="content-page">
            <?php $this->load->view("inc/nav-top-template"); ?>
            <div class="container-fluid">
            <form id="formBrigadista" name="formBrigadista" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
               <input type="hidden" name="id" id="id" value="<?=$brigadista->id?>">
               <div id="message" class="col-xs-12"></div>
               <div class="row">                 
                  <div class="col-lg-3">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                              <h4 class="card-title">Consultar</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                              <div class="form-group">
                              <?php
                                 $url_imagen = (strlen($brigadista->foto)>6) ? base_url()."public/images/brigadistas/".$brigadista->foto : base_url()."public/images/brigadistas/10.jpg";
                                 $enviar_imagen = (strlen($brigadista->foto)>6)?$brigadista->foto:"0";
                              ?>
                                 <input type="hidden" value="<?=$enviar_imagen?>" id="enviar_imagen" name="enviar_imagen">
                                 <div class="add-img-user profile-img-edit">
                                 <input type="hidden" name="foto_dni_str" id="foto_dni_str" value="">
                                 <img style="border-radius: 0%;" class="profile-pic img-fluid" id="blah" src="<?=$url_imagen?>" alt="profile-pic">
                                    <div class="p-image">
                                       <input class="file-upload" type="file" accept="image/*">
                                    </div>
                                    <div class="custom-file">
                                          <input type="file" id="file" name="file" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon01">
                                          <label class="custom-file-label" for="foto">Escoger imagen</label>
                                    </div>
                                 </div>
                                 <div class="img-extension mt-3">
                                 </div>
                              </div>
                              <div class="form-group">
                              <label for="Tipo_Documento_Codigo">Tipo Documento Identidad:</label>
                                 <select class="form-control" name="Tipo_Documento_Codigo" id="Tipo_Documento_Codigo">
														<?php foreach($tipodocumento->result() as $row): ?>
                                                <option value="<?=$row->Tipo_Documento_Codigo?>"><?=$row->Tipo_Documento_Nombre?></option>
                                                <?php endforeach; ?>
                                 </select>
                              </div>
                              <div class="form-group" id="error_numero_documento">
                                 <label for="furl">Número Documento Identidad:</label>
                                 <input type="text" class="form-control" id="documento_numero" name="documento_numero" value="<?=$brigadista->numero_documento?>" placeholder="Número Documento Identidad">
                                 <span class="input-group-btn">
                                <button type="button" id="btn-buscar" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i>Buscar</button>
                              </span>
                              </div>
                              <div class="form-group">
                                 <label for="turl">Edad:</label>
                                 <input type="text" class="form-control" id="edad" name="edad" value="<?=calcularEdad($brigadista->fecha_nacimiento)?>" placeholder="Edad" readonly>
                              </div>
                              <div class="form-group">
                                 <label for="instaurl">Género:</label>
                                 <select class="form-control" name="genero" id="genero" rel="<?=$brigadista->sexo?>" readonly>
												<option value="">-- Seleccione --</option>
												<option value="1" <?=("1"==$brigadista->sexo)?"selected":""?>>MASCULINO</option>
												<option value="2" <?=("2"==$brigadista->sexo)?"selected":""?>>FEMENINO</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                       <label for="peso">Peso en Kilográmos:</label>
                                       <input type="number" class="form-control" maxlength="6" id="peso" name="peso" value="<?=$brigadista->peso?>"  placeholder="Peso en Kilográmos.">
                              </div>
                              <div class="form-group">
                                       <label for="peso">Talla en Metros:</label>
                                       <input type="number" class="form-control" maxlength="6" id="talla" name="talla" value="<?=$brigadista->talla?>" placeholder="Talla en Metros.">
                              </div>
                              <div class="form-group">
                                       <label for="imc">Índice de Masa Corporal (IMC):</label>
                                       <input type="number" class="form-control" maxlength="6" id="imc" name="imc" placeholder="IMC" value="<?=$brigadista->imc?>" readonly>
                              </div>
                              <div class="form-group">
                              <label for="grupo_sanguineo">Grupo Sanguíneo:</label>
                              <select class="form-control" name="grupo_sanguineo" id="grupo_sanguineo">
                              <option value="0">-- Seleccione --</option>
                                          <option value="1" <?=("1"==$brigadista->grupo_sanguineo)?"selected":""?>>O-</option>
                                          <option value="2" <?=("2"==$brigadista->grupo_sanguineo)?"selected":""?>>O+</option>
                                          <option value="3" <?=("3"==$brigadista->grupo_sanguineo)?"selected":""?>>A-</option>
                                          <option value="4" <?=("4"==$brigadista->grupo_sanguineo)?"selected":""?>>A+</option>
                                          <option value="5" <?=("5"==$brigadista->grupo_sanguineo)?"selected":""?>>B-</option>
                                          <option value="6" <?=("6"==$brigadista->grupo_sanguineo)?"selected":""?>>B+</option>
                                          <option value="7" <?=("7"==$brigadista->grupo_sanguineo)?"selected":""?>>AB-</option>
                                          <option value="8" <?=("8"==$brigadista->grupo_sanguineo)?"selected":""?>>AB+</option>
                                 </select>
                              </div>
                              <div class="form-group">
                              <label for="brigadistas_banco_id">Entidad Bancaria:</label>
                              <select class="form-control" name="brigadistas_banco_id" id="brigadistas_banco_id"  >
                              <?php foreach($listaBancosnew->result() as $row): ?>
                                 <option value="<?=$row->id?>" <?= ($row->id == $brigadista->idbanco) ?"selected":"" ?>><?=$row->banco?></option>
                                 <?php endforeach; ?>
                              </select>
									   </div>                 
                              <div class="form-group">
                                       <label for="numero_cuenta">Número Cuenta Ahorros:</label>
                                       <input type="number" class="form-control" maxlength="20" id="numero_cuenta" name="numero_cuenta" value="<?=$brigadista->numero_cuenta?>" placeholder="Número Cuenta de Ahorros">
                              </div>
                              <div class="form-group">
                                       <label for="numero_cci">Número de CCI:</label>
                                       <input type="number" class="form-control" maxlength="20" id="numero_cci" name="numero_cci" value="<?=$brigadista->numero_cci?>" placeholder="Número de CCI">
                              </div> 
                              <div class="form-group">
                                    <label>Lengua Materna: </label>
                              <select class="form-control" name="ididioma" id="ididioma" value="<?=$brigadista->ididioma?>">
                              <option value="">-- Seleccione Idioma --</option>
                                          <?php foreach($listaIdiomas as $row): ?> 
                                          <option value="<?=$row->id?>" <?=($row->id==$brigadista->ididioma)?"selected":""?>><?=$row->idioma?></option>
                                          <?php endforeach; ?>   
                              </select>
                              </div>                  
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-9">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                           <h4 class="card-title">Datos personales</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="new-user-info">
                               
                                 <div class="row">
                                    <div class="form-group col-md-6">
                                       <label for="fname">Nombres:</label>
                                       <input type="text" class="form-control" id="nombres" name="nombres" value="<?=$brigadista->nombres?>" placeholder="Nombres" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="lname">Apellidos:</label>
                                       <input type="text" id="apellidos" name="apellidos" value="<?=$brigadista->apellidos?>" class="form-control" placeholder="Apellidos" readonly>
                                    </div>
                                    <div class="form-group col-md-6" id="error_fecha_nacimiento">
                                       <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                                          <div class='input-group date' >
                                             <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento"  value="<?=formatearFechaParaVista($brigadista->fecha_nacimiento)?>" readonly />
                                             <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
                                          </div> 
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label>Estado Civil:</label>
                                       <select class="form-control" name="estado_civil" id="estado_civil" rel="<?=$brigadista->estado_civil?>" readonly>
																			<option value="">-- Seleccione --</option>
																			<option value="1" <?=("1"==$brigadista->estado_civil)?"selected":""?>>Soltero(a)</option>
																			<option value="2" <?=("2"==$brigadista->estado_civil)?"selected":""?>>Casado(a)</option>
																			<option value="3" <?=("3"==$brigadista->estado_civil)?"selected":""?>>Viudo(a)</option>
																			<option value="4" <?=("4"==$brigadista->estado_civil)?"selected":""?>>Divorciado(a)</option>
																			<option value="5" <?=("5"==$brigadista->estado_civil)?"selected":""?>>Conviviente</option>
                                        								</select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="cname">Domicilio:</label>
                                       <input type="text" class="form-control" id="domicilio" name="domicilio" value="<?=$brigadista->domicilio?>" placeholder="Domicilio">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label>Región:</label>
                                       <select class="form-control" name="departamento" id="departamento">
															<option value="">-- Regi&oacute;n --</option>
                                        		<?php foreach($departamentos as $row): ?>
                                        		<option value="<?=$row->Codigo_Departamento?>" <?=($row->Codigo_Departamento==$departamento)?"selected":""?>><?=$row->Nombre?></option>
                                        		<?php endforeach; ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="mobno">Provincia:</label>
                                       <select class="form-control" name="provincia" id="provincia">
														<option value="">-- Elija Regi&oacute;n --</option>
														<?php foreach($provincias as $row): ?>
                                        	<option value="<?=$row->Codigo_Provincia?>" <?=($row->Codigo_Provincia==$provincia)?"selected":""?>><?=$row->Nombre?></option>
                                        	<?php endforeach; ?>
													</select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="altconno">Distrito:</label>
                                       <select class="form-control" name="distrito" id="distrito">
														<option value="">-- Elija Provincia --</option>
														<?php foreach($distritos as $row): ?>
                                        	<option value="<?=$row->Codigo_Distrito?>" <?=($row->Codigo_Distrito==$distrito)?"selected":""?>><?=$row->Nombre?></option>
                                        	<?php endforeach; ?>
													</select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="email">Email Personal:</label>
                                       <input type="email" class="form-control" id="email" name="email" value="<?=$brigadista->email_personal?>" placeholder="Email Personal">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="email_institucional">Email institucional:</label>
                                       <input type="email" class="form-control" id="email_institucional" name="email_institucional" value="<?=$brigadista->email_institucional?>" placeholder="Email institucional">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="telefono_01">Teléfono 01:</label>
                                       <input type="number" maxlength="9" class="form-control" id="telefono_01" name="telefono_01" value="<?=$brigadista->telefono_1?>" placeholder="Teléfono 01:">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="telefono_02">Teléfono 02:</label>
                                       <input type="number" maxlength="9" class="form-control" id="telefono_02" name="telefono_02" value="<?=$brigadista->telefono_2?>" placeholder="Teléfono 02:">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="telefono_03">Teléfono 03:</label>
                                       <input type="number" class="form-control" maxlength="9" id="telefono_03" name="telefono_03" value="<?=$brigadista->telefono_3?>" placeholder="Teléfono 03:">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="pasaporte">Número pasaporte:</label>
                                       <input type="text" class="form-control" id="pasaporte" name="pasaporte" placeholder="Número pasaporte">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="caducidad_pasaporte">Fecha caducidad pasaporte:</label>
                                       <input type="date" class="form-control" id="caducidad_pasaporte" name="caducidad_pasaporte" placeholder="Fecha caducidad pasaporte">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="pno">Categoría:</label>
                                       <select class="form-control" name="Categoria" id="Categoria">
														<option value="0" <?=($brigadista->categoria=="0")?"selected":""?>>[N/A]</option>
														<option value="1" <?=($brigadista->categoria=="1")?"selected":""?>>EQUIPO T&Eacute;NICO</option>
														<option value="2" <?=($brigadista->categoria=="2")?"selected":""?>>BRIGADISTA</option>
														<option value="3" <?=($brigadista->categoria=="3")?"selected":""?>>EQUIPO M&Eacute;DICO DE EMERGENCIA</option>
														<option value="4" <?=($brigadista->categoria=="4")?"selected":""?>>BRIGADISTA / EMT</option>
                                       </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="institucion">Institución:</label> 
                                       <select class="form-control" id="idinstitucion" name="idinstitucion"  placeholder="Institución">  

                                          <option value="">-- Seleccione Institución --</option>                                                   
                                          <?php foreach($listaInstituciones as $row): ?> 
                                          <option value="<?=$row->id?>" <?=($row->id==$brigadista->idinstitucion)?"selected":""?>><?=$row->nombre?></option>
                                          <?php endforeach; ?>   
                                       </select>
                                    </div>
                                 </div>
                                 <hr>
                                 <h5 class="mb-3">Datos de contacto de emergencia</h5>
                                 <hr>
                                 <div class="row">
                                    <div class="form-group col-md-6">
                                    <label for="Tipo_Documento_Codigo">Tipo Documento Identidad:</label>
                                 <select class="form-control" name="Tipo_Documento_Codigo_C" id="Tipo_Documento_Codigo">
												<<option value="01">DNI</option>
                                    <<option value="03">CARNET EXTRANJERIA</option>
                                 </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Número Documento Identidad:</label>
                                       <input type="text" class="form-control" id="contacto_emergencia" name="contacto_emergencia" placeholder="Número Documento Identidad">
                                       <span class="input-group-btn">
                                          <button type="button" id="btn-buscar-contacto" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i>Buscar</button>
                                       </span>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Apelldos:</label>
                                       <input type="text" class="form-control" id="apellidos_contacto" name="apellidos_contacto" value="<?=$brigadista->apellidos_contacto?>" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Nombres:</label>
                                       <input type="text" class="form-control" id="nombres_contacto" name="nombres_contacto" value="<?=$brigadista->nombres_contacto?>" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Teléfono 1:</label>
                                       <input type="number" class="form-control" id="telefono_emergencia_01" name="telefono_emergencia_01" value="<?=$brigadista->telefono_1_contacto?>" placeholder="Teléfono 1">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Teléfono 2:</label>
                                       <input type="number" class="form-control" id="telefono_emergencia_02" name="telefono_emergencia_02" value="<?=$brigadista->telefono_2_contacto?>" placeholder="Teléfono 2">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Teléfono 3:</label>
                                       <input type="number" class="form-control" id="telefono_emergencia_03" name="telefono_emergencia_03" value="<?=$brigadista->telefono_3_contacto?>" placeholder="Teléfono 3">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Parentesco:</label>
                                       <select id="parentesco" name="parentesco" class="form-control">
                                          <option value="0">[N/A]</option>
                                          <option value="1" <?=("1"==$brigadista->parentesco_contacto)?"selected":""?>>MADRE</option>
                                          <option value="2" <?=("2"==$brigadista->parentesco_contacto)?"selected":""?>>PADRE</option>
                                          <option value="3" <?=("3"==$brigadista->parentesco_contacto)?"selected":""?>>HIJO (A)</option>
                                          <option value="4" <?=("4"==$brigadista->parentesco_contacto)?"selected":""?>>HERMANO (A)</option>
                                          <option value="5" <?=("5"==$brigadista->parentesco_contacto)?"selected":""?>>PRIMO (A)</option>
                                          <option value="6" <?=("6"==$brigadista->parentesco_contacto)?"selected":""?>>ABUELO (A)</option>
                                          <option value="7" <?=("7"==$brigadista->parentesco_contacto)?"selected":""?>>CONYUGUE</option>
                                          <option value="8" <?=("8"==$brigadista->parentesco_contacto)?"selected":""?>>AMIGO (A)</option>
                                          <option value="9" <?=("9"==$brigadista->parentesco_contacto)?"selected":""?>>OTROS</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="observacion">Observación:</label>
                                       <input type="text" class="form-control" id="observacion" name="observacion" value="<?=$brigadista->observacion?>" placeholder="Observación">
                                    </div>       

                                 </div>
                           </div>
                        </div>
                         <center>                    
                        <button type="submit" class="col-3 btn btn-primary">Actualizar registro</button>
                        <a href="<?=base_url()?>brigadistas" class="col-3 btn btn-primary" role="button" aria-pressed="true">Cancelar</a>
                       </center>    
                       <br>                  
                     </div>
                  </div>
                  <div class="col-md-12 text-center" id="cargando"></div>
                  </form>
               </div>
            </div>
            <?php $this->load->view("inc/footer-template"); ?>
         </div>
      </div>
      <script src="<?=base_url()?>public/template/js/jquery.min.js"></script>
      <script src="<?=base_url()?>public/template/js/popper.min.js"></script>
      <script src="<?=base_url()?>public/template/js/bootstrap.min.js"></script>
      <script src="<?=base_url()?>public/template/js/jquery.appear.js"></script>
      <script src="<?=base_url()?>public/template/js/countdown.min.js"></script>
      <script src="<?=base_url()?>public/template/js/waypoints.min.js"></script>
      <script src="<?=base_url()?>public/template/js/jquery.counterup.min.js"></script>
      <script src="<?=base_url()?>public/template/js/wow.min.js"></script>
      <script src="<?=base_url()?>public/template/js/apexcharts.js"></script>
      <script src="<?=base_url()?>public/template/js/slick.min.js"></script>
      <script src="<?=base_url()?>public/template/js/select2.min.js"></script>
      <script src="<?=base_url()?>public/template/js/owl.carousel.min.js"></script>
      <script src="<?=base_url()?>public/template/js/jquery.magnific-popup.min.js"></script>
      <script src="<?=base_url()?>public/template/js/smooth-scrollbar.js"></script>
      <script src="<?=base_url()?>public/template/js/lottie.js"></script>
      <script src="<?=base_url()?>public/template/js/chart-custom.js"></script>
      <script src="<?=base_url()?>public/template/js/custom.js"></script>
      <script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
      <script src="<?=base_url()?>public/js/moment.min.js"></script>
      <script src="<?=base_url()?>public/js/locale.es.js"></script>
      <script src="<?=base_url()?>public/js/bootstrap-datetimepicker.min.js"></script>
      <script>
    //const URI_MAP = "<?=base_url()?>";
    var URI = "<?=base_url()?>"; 
  </script> 
<script src="<?=base_url()?>public/js/brigadistas/editar.js?v=<?=date("his")?>"></script>
<script>
   nuevo("<?=base_url()?>");
</script>
   </body>
</html>