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
                                 <div class="add-img-user profile-img-edit">
                                 <input type="hidden" name="foto_dni_str" id="foto_dni_str" value="">
                                 <img style="border-radius: 0%; margin-left: 35px;max-width: 120%;" class="profile-pic img-fluid" id="blah" src="<?=base_url()?>public/images/brigadistas/10.jpg" alt="profile-pic">
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
												<option value="1">DNI</option>
                                    <option value="3">CARNET EXTRANJERIA</option>
                                 </select>
                              </div>
                              <div class="form-group" id="error_numero_documento">
                                 <label for="furl">Numero Documento Identidad:</label>
                                 <input type="number" class="form-control" id="documento_numero" name="documento_numero" placeholder="Numero de identidad">
                                 <span class="input-group-btn">
                                <button type="button" id="btn-buscar" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i>Buscar</button>
                              </span>
                              </div>
                              <div class="form-group">
                                 <label for="edad">Edad:</label>
                                 <input type="text" class="form-control" id="edad" name="edad" placeholder="Edad" readonly>
                              </div>
                              <div class="form-group">
                                 <label for="instaurl">Género:</label>
                                 <select class="form-control" name="genero" id="genero" readonly>
													<option value="">-- Seleccione --</option>
													<option value="1">MASCULINO</option>
													<option value="2">FEMENINO</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                       <label for="peso">Peso en Kilográmos:</label>
                                       <input type="number" class="form-control" maxlength="6" id="peso" name="peso" placeholder="Peso en Kilográmos.">
                              </div>
                              <div class="form-group">
                                       <label for="talla">Talla en Metros:</label>
                                       <input type="number" class="form-control" maxlength="6" id="talla" name="talla" placeholder="Talla en Metros.">
                              </div>
                              <div class="form-group">
                                       <label for="imc">Índice de Masa Corporal (IMC):</label>
                                       <input type="number" class="form-control" maxlength="6" id="imc" name="imc" placeholder="IMC" value="0" readonly>
                              </div>
                              <div class="form-group">
                              <label for="grupo_sanguineo">Grupo Sanguíneo:</label>
                              <select class="form-control" name="grupo_sanguineo" id="grupo_sanguineo">
                                       <option value="">-- Seleccione --</option>
													<option value="1">O-</option>
													<option value="2">O+</option>
													<option value="3">A-</option>
													<option value="4">A+</option>
													<option value="5">B-</option>
													<option value="6">B+</option>
													<option value="7">AB-</option>
													<option value="8">AB+</option>
                                 </select>
                              </div>
                              <div class="form-group">
                              <label for="brigadistas_banco_id">Entidad Bancaria:</label>
                              <select class="form-control" name="brigadistas_banco_id" id="brigadistas_banco_id">
                              <?php foreach($listaBancosnew->result() as $row): ?>
                                 <option value="<?=$row->id?>"><?=$row->banco?></option>
                                 <?php endforeach; ?>
                              </select>
									   </div>
                              <div class="form-group">
                                       <label for="numero_cuenta">Número Cuenta Ahorros:</label>
                                       <input type="number" class="form-control" maxlength="20" id="numero_cuenta" name="numero_cuenta" placeholder="Número Cuenta de Ahorros">
                              </div>
                              <div class="form-group">
                                       <label for="numero_cci">Número de CCI:</label>
                                       <input type="number" class="form-control" maxlength="20" id="numero_cci" name="numero_cci" placeholder="Número de CCI">
                              </div>
                              <div class="form-group">
                                    <label>Lengua Materna: </label>
                              <select class="form-control" name="ididioma" id="ididioma">
                              <?php foreach($listaIdiomas->result() as $row): ?>
                                 <option value="<?=$row->id?>"><?=$row->idioma?></option>
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
                                       <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="lname">Apellidos:</label>
                                       <input type="text" id="apellidos" name="apellidos" class="form-control" id="lname" placeholder="Apellidos" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="fechaEvento">Fecha de Nacimiento:</label>
                                       <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Fecha de Nacimiento" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label>Estado Civil:</label>
                                       <select class="form-control" name="estado_civil" id="estado_civil" readonly>
															<option value="">-- Seleccione --</option>
															<option value="1">Soltero(a)</option>
															<option value="2">Casado(a)</option>
															<option value="3">Viudo(a)</option>
															<option value="4">Divorciado(a)</option>
															<option value="5">Conviviente</option>
                                       </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="cname">Domicilio:</label>
                                       <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Domicilio">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label>Región:</label>
                                       <select class="form-control" name="departamento" id="departamento">
																			<option value="">-- Regi&oacute;n --</option>
                                        								  	<?php foreach($departamentos as $row): ?>
                                        								  	<option value="<?=$row->Codigo_Departamento?>"><?=$row->Nombre?></option>
                                        								  	<?php endforeach; ?>
                                        								</select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="mobno">Provincia:</label>
                                       <select class="form-control" name="provincia" id="provincia">
														<option value="">-- Elija Regi&oacute;n --</option>
													</select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="altconno">Distrito:</label>
                                       <select class="form-control" name="distrito" id="distrito">
														<option value="">-- Elija Provincia --</option>
													</select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="email">Email Personal:</label>
                                       <input type="email" class="form-control" id="email" name="email" placeholder="Email Personal">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="email">Email institucional:</label>
                                       <input type="email" class="form-control" id="email_institucional" name="email_institucional" placeholder="Email institucional">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="telefono_01">Teléfono 01:</label>
                                       <input type="number" maxlength="9" class="form-control" id="telefono_01" name="telefono_01" placeholder="Teléfono 01:">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="telefono_02">Teléfono 02:</label>
                                       <input type="number" maxlength="9" class="form-control" id="telefono_02" name="telefono_02" placeholder="Teléfono 02:">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="telefono_03">Teléfono 03:</label>
                                       <input type="number" class="form-control" maxlength="9" id="telefono_03" name="telefono_03" placeholder="Teléfono 03:">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="email">Número pasaporte:</label>
                                       <input type="text" class="form-control" id="pasaporte" name="pasaporte" placeholder="Número pasaporte">
                                    </div>
                                   
                                    <div class="form-group col-md-6">
                                       <label for="email">Fecha caducidad pasaporte:</label>
                                       <input type="date" class="form-control" id="caducidad_pasaporte" name="caducidad_pasaporte" placeholder="Fecha caducidad pasaporte">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="pno">Categoría:</label>
                                       <select class="form-control" name="Categoria" id="Categoria">
															<option value="0">[N/A]</option>
															<option value="1">EQUIPO T&Eacute;NICO</option>
															<option value="2">BRIGADISTA</option>
															<option value="3">EQUIPO M&Eacute;DICO DE EMERGENCIA</option>
															<option value="4">BRIGADISTA / EMT</option>
                                       </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="institucion">Institución:</label>
                                 <select class="form-control" id="idinstitucion" name="idinstitucion" placeholder="Institución">                                        
                                 <?php foreach($listaInstituciones as $row): ?>
                                    <option value="<?=$row->id?>"><?=$row->nombre?></option>
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
												<<option value="1">DNI</option>
                                    <<option value="3">CARNET EXTRANJERIA</option>
                                 </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Numero documento de Identidad:</label>
                                       <input type="text" class="form-control" id="contacto_emergencia" name="contacto_emergencia" placeholder="Numero">
                                       <span class="input-group-btn">
                                          <button type="button" id="btn-buscar-contacto" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i>Buscar</button>
                                       </span>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Apelldos:</label>
                                       <input type="text" class="form-control" id="apellidos_contacto" name="apellidos_contacto" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Nombres:</label>
                                       <input type="text" class="form-control" id="nombres_contacto" name="nombres_contacto" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Teléfono 1:</label>
                                       <input type="number" class="form-control" id="telefono_emergencia_01" name="telefono_emergencia_01" placeholder="Teléfono 1">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Teléfono 2:</label>
                                       <input type="number" class="form-control" id="telefono_emergencia_02" name="telefono_emergencia_02" placeholder="Teléfono 2">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Teléfono 3:</label>
                                       <input type="number" class="form-control" id="telefono_emergencia_03" name="telefono_emergencia_03" placeholder="Teléfono 3">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="uname">Parentesco:</label>
                                       <select id="parentesco" name="parentesco" class="form-control">
                                                <option value="0">[N/A]</option>
                                                <option value="1">MADRE</option>
                                                <option value="2">PADRE</option>
                                                <option value="3">HIJO (A)</option>
                                                <option value="4">HERMANO (A)</option>
                                                <option value="5">PRIMO (A)</option>
                                                <option value="6">ABUELO (A)</option>
                                                <option value="7">CONYUGUE</option>
                                                <option value="8">AMIGO (A)</option>
                                                <option value="9">OTROS</option>
                                          </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="observacion">Observación:</label>
                                       <input type="text" class="form-control" id="observacion" name="observacion" placeholder="Observación">
                                    </div>       

                                 </div>
                           </div>
                        </div>
                         <center>                    
                        <button type="submit" class="col-3 btn btn-primary">Guardar registro</button>
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
    const URI_MAP = "<?=base_url()?>";
    const canDelete = "1";
    const canEdit = "1";
    const canTracking = "1";
    const canHistory = "1";
    var URI = "<?=base_url()?>"; 
  </script> 
<script src="<?=base_url()?>public/js/brigadistas/form-new.js?v=<?=date("his")?>"></script>
<script>
   nuevo("<?=base_url()?>");
</script>
   </body>
</html>