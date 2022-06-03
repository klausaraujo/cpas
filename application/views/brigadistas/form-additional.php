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
<link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript">
function d1(selectTag){
 if(selectTag.value == 'otro1'){
document.getElementById('prg1').disabled = false;
document.getElementById('prg1').style.visibility = 'visible'; 
document.getElementById('prg2').style.visibility = 'visible'; 
 }else{
 document.getElementById('prg1').disabled = true;
 document.getElementById('prg1').style.visibility = 'hidden'; 
 document.getElementById('prg2').style.visibility = 'hidden'; 
 }
}
</script>
<style>
#elemento_capacitacion{
   margin-top: 33px;
   height: 45px
}
.custom-file-label::after{
   background-color: #099dad;
   color:white;
}
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
               <div class="row">
                  <div class="clearfix"></div>
                  <br>
                  <div class="col-lg-12">
                    <?php
                    ?>
                     <br>
                     <div class="iq-card"> 
                        <div style="background-color:#089eaf" class="alert alert-primary" role="alert">
                        <a style="color:white; text-align: center" class="alert-link">
                        <b> REGISTRO DE INFORMACIÓN ADICIONAL </b> </a>
                        </div>
                        <div class="iq-card-body">
                           <br>
                              <div class="row">
                                 <div id="message" class="col-xs-12"></div>
                              </div>   

                              <ul class="nav nav-tabs" id="hospital__tabs" role="tablist">
                                 <li class="nav-item">
                                    <a class="nav-link active" id="tab-1" 
                                                               href="#tab1" 
                                                               aria-controls="tab1" data-toggle="tab"  role="tab"  aria-selected="true">
                                   Idiomas Adicionales
                                 </a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="tab-2" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">
                                    Información Profesional y Certificaciones</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="tab-3" 
                                                         href="#tab3" 
                                                         aria-controls="tab3" data-toggle="tab"  role="tab"  aria-selected="false">
                                    Información Laboral
                                 </a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="tab-4" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">
                                    Salud e Inmunizaciones
                                 </a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="tab-5" data-toggle="tab" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false">
                                    Capacitaciones y Cursos
                                 </a>
                                 </li>
                              </ul>
                              <br>
                              <input type="hidden" id="id" name="id" value="<?=$id?>">
                              <div class="tab-content" id="myTabContent-2">
                                 <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab-1">
                                    <div class="row"> 
                                    <span class="mb-4"><b>IDIOMA:</b></span>
                                    </div>
                                    <form id="formIdioma" name="formIdioma" method="POST" action="" autocomplete="off">
                                    <div class="row"> 
                                       <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Adicionar lengua: </label>
                                          <select class="form-control" name="ididioma" id="ididioma">
                                             <?php foreach($listaIdiomas as $row): ?>
                                             <option value="<?=$row->id?>"><?=$row->idioma?></option>
                                             <?php endforeach; ?>
                                          </select>
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label>Nivel: </label>
                                             <select class="form-control" name="nivel" id="nivel">
                                                <option value="1">BÁSICO</option>
                                                <option value="2">INTERMEDIO</option>
                                                <option value="3">AVANZADO</option>
                                                <option value="4">EXPERTO</option> 
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <div class="form-group">
                                             <label for="lectura"> Lectura </label>
                                             <input style="width: 10%;" type="checkbox" class="form-control" id="lectura" name="lectura"> 
                                             
                                          </div>
                                       </div> 
                                       <div class="col-md-2">
                                          <div class="form-group">
                                             <label for="escritura">Escritura </label>
                                             <input style="width: 10%;" type="checkbox" class="form-control" id="escritura" name="escritura">
                                          </div>
                                       </div>    
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label> </label>
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">  
                                             <button type="submit" class="btn btn-primary btn-block">Añadir registro</button>
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">  
                                          <a href="<?=base_url()?>brigadistas" class="col-12 btn btn-primary" role="button" aria-pressed="true">Cancelar registro</a>
                                          </div>
                                       </div>  
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label> </label>
                                          </div>
                                       </div>
                                       <div class="col-md-12 text-center" id="cargando"></div>
                                    </div>
                                    </form>
                                    <div class="row"> 
                                       <div class="col-xl-12 col-md-12">
                                          <div class="card m-b-30 pb-35">
                                             <div class="card-body">
                                                <h4 class="mt-0 m-b-15 header-title">Lista General de Idiomas Registrados</h4>
                                                <br>
                                                <div class="table-responsive">
                                                   <table id="tablaIdioma"  class="tablaIdioma table table-hover mb-0">
                                                   <thead>
                                                      <tr>
                                                         <th>Accion</th>
                                                         <th>Idioma</th> 
                                                         <th>Nivel</th>
                                                         <th>Lectura</th>
                                                         <th>Escritura</th> 
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
                                    </div>
                                 </div>
                              <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab-2">
                                 <div class="row"> 
                                       <h4 class="mb-4"> REGISTRO DE CARRERAS (PROFESIONALES Y TECNICOS) :</h4>
                                 </div>
                                 <form id="formCarrera" name="formCarrera" method="POST" action="" autocomplete="off" enctype="multipart/form-data">                      
                                 <div class="row">
                                    <!--  <input type="hidden" id="id" name="id" value="<?=$id?>"> -->
                                    <label class="span__bold" style="display:block; width:100%">
                                       <b>   CARRERAS </b>
                                    </label>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       <label for="idprofesion">Carrera:</label>
                                       <select class="form-control" name="idprofesion" id="idprofesion">
                                          <option value="">--Seleccione Profesión--</option>
                                          <?php foreach($listaRProfesion as $row): ?>
                                          <option value="<?=$row->idprofesion?>"><?=$row->profesion?></option>
                                          <?php endforeach; ?>
                                       </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       <label for="idespecialidad">Especialidad:</label>
                                       <select class="form-control" name="idespecialidad" id="idespecialidad">
                                             <option value=""> -- Seleccione Profesión -- </option>
                                       </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label for="colegiatura">Colegiatura: </label>
                                          <input type="number" maxlength="6" min="0"  class="form-control" name="colegiatura" id="colegiatura" value="0"/> 
                                       </div>
                                    </div>
                                    <div class="col-md-2">
                                       <div class="form-group">
                                          <label for="rne">RNE: </label>
                                          <input type="number" maxlength="6" min="0" class="form-control" name="rne" id="rne" value="0" /> 
                                       </div>
                                    </div>
                                    <div class="col-md-1">
                                       <div class="form-group">
                                       <label for="activo"> Activo </label>
                                          <input style="width: 40%;" type="checkbox" class="form-control" id="activo" name="activo">
                                       </div>
                                    </div>
                                    <label class="span__bold" style="display:block; width:100%">
                                       <b>  </b>
                                       </label>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       <br><br>
                                       <input type="file" class="custom-file-input" id="file_titulo" name="file_titulo" lang="es">
                                          <label class="custom-file-label" for="file_titulo">Cargar Archivo (Título)</label>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       <input type="file" class="custom-file-input" id="file_especialidad" name="file_especialidad" lang="es">
                                       <label class="custom-file-label" for="file_especialidad">Cargar Archivo (Especialidad)</label>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-check">
                                       </div>
                                    </div> 
                                    <label class="span__bold" style="display:block; width:100%">
                                       <b>  </b>
                                       </label>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label> </label>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label> </label> 
                                          <button type="submit" class="btn btn-primary btn-block">Añadir registro</button>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label></label> 
                                          <a href="<?=base_url()?>brigadistas" class="col-12 btn btn-primary" role="button" aria-pressed="true">Cancelar registro</a>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-check">
                                       </div>
                                    </div>  
                                 <div class="col-md-12 text-center" id="cargando"></div>
                                 </div>            
                                 </form>           
                                    <div class="card-body">
                                       <h4 class="mt-0 m-b-15 header-title">LISTADO DE CARRERAS REGISTRADAS</h4>
                                       <br>
                                       <div class="table-responsive">
                                          <table  id="tablaCarrera" class="tablaCarrera table table-hover mb-0">
                                          <thead>
                                             <tr>
                                                <th>Acciones</th>
                                                <th>ID</th> 
                                                <th>Carrera</th>
                                                <th>Especialidad</th>
                                                <th>Colegiatura</th>
                                                <th>RNE</th>
                                                <th>Titulo</th>
                                                <th>Especialidad</th>
                                                <th>Estado</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                          </table>
                                       </div> 
                                    </div>
                                    <br><br>    
                                 <form id="formCertificado" name="formCertificado" method="POST" action="" autocomplete="off" enctype="multipart/form-data">               
                                 <div class="row"> 
                                    <label class="span__bold" style="display:block; width:100%">
                                       <b>   REGISTRO DE CERTIFICACIONES </b>
                                    </label>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label for="idinstitucion">INSTITUCION:</label>
                                          <select class="form-control" id="idinstitucion" name="idinstitucion" placeholder="Institución">                                        
                                             <?php foreach($listaInstituciones as $row): ?>
                                                <option value="<?=$row->id?>"><?=$row->nombre?></option>
                                                <?php endforeach; ?>
                                             </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       <label for="idcertificacion">Tipo de certificación:</label>
                                       <select class="form-control" name="idcertificacion" id="idcertificacion">
                                             <option value="1">BRIGADISTA</option>
                                             <option value="2">E.M.T. I</option>
                                             <option value="3">E.M.T. II</option>
                                             <option value="4">E.M.T. III</option>
                                             <option value="5">RESCATISTA</option>
                                             <option value="6">MÉDICO TÁCTICO</option>
                                       </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label for="fecha_inicio">Fecha de emisión: </label>
                                          <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio"/> 
                                       </div>
                                    </div>
                                    <div class="col-md-2">
                                       <div class="form-group">
                                          <label for="fecha_vigencia">Fecha de Vigencia: </label>
                                          <input type="date" class="form-control" name="fecha_vigencia" id="fecha_vigencia"/> 
                                       </div>
                                    </div>
                                    <div class="col-md-1">
                                       <div class="form-group">
                                       <label for="activo1"> Activo </label>
                                           <input style="width: 40%;" type="checkbox" class="form-control" id="activo" name="activo"> 
                                       </div>
                                    </div>
                                    <label class="span__bold" style="display:block; width:100%">
                                       <b>  </b>
                                    </label>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       <input type="file" class="custom-file-input" id="file_certificado" name="file_certificado" lang="es">
                                       <label class="custom-file-label" for="file_certificado">Adjuntar Resolución</label><br><br>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-check">
                                       </div>
                                    </div>  
                                    <label class="span__bold" style="display:block; width:100%">
                                       <b>  </b>
                                    </label>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label> </label>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label> </label>
                                          <button type="submit" class="btn btn-primary btn-block">Añadir registro</button>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label></label>
                                          <a href="<?=base_url()?>brigadistas" class="col-12 btn btn-primary" role="button" aria-pressed="true">Cancelar registro</a>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-check">
                                       </div>
                                    </div>              
                                 </div>  
                                 </form>
                                 <div class="row"> 
                                    <div class="col-xl-12 col-md-12">
                                       <div class="card m-b-30 pb-35">
                                          <div class="card-body">
                                             <h4 class="mt-0 m-b-15 header-title">LISTADO DE CERTIFICACIONES REGISTRADAS</h4>
                                             <br>
                                             <div class="table-responsive">
                                             <table id="tablaCertificado" class="tablaCertificado table table-hover mb-0">
                                                <thead>
                                                   <tr>
                                                      <th>Acciones</th> 
                                                      <th>ID</th>
                                                      <th>Institución</th>
                                                      <th>F.Emisión</th>
                                                      <th>F.Vencimiento</th>
                                                      <th>Adjunto</th>
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
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab-3">
                                 <div class="row"> 
                                       <h4 class="mb-4"> INFORMACIÓN LABORAL :</h4>
                                 </div>
                                 <form name="formLaboral" id="formLaboral" method="POST" action="" autocomplete="off">
                                  <div class="form-group row">
                                     <label for="codigo_institucion" class="col-sm-4 col-form-label">Institución</label>
                                     <div class="col-sm-8">
                                        <select class="form-control" name="codigo_institucion" id="codigo_institucion">
                                           <option value="0">-- Seleccione --</option>
                                              <?php foreach ($listarInstitucion->result() as $row): ?>
                                              <option value="<?=$row->codigo_institucion?>">
                                              <?=$row->nombre_institucion?>
                                              </option>
                                              <?php endforeach;?>
                                        </select>
                                     </div>
                                  </div>
                                   <div class="form-group row">
                                     <label for="codigo_region" class="col-sm-4 col-form-label">Región</label>
                                     <div class="col-sm-8">
                                     <select class="form-control" name="codigo_region" id="codigo_region">
                                        <option value="0">-- Seleccione --</option>
                                           <?php foreach ($listarRegion->result() as $row): ?>
                                           <option value="<?=$row->codigo_region?>">
                                           <?=$row->nombre_region?>
                                           </option>
                                           <?php endforeach;?>
                                     </select>
                                     </div>
                                  </div>      
                                   <div class="form-group row">
                                     <label for="codigo_disa" class="col-sm-4 col-form-label">DISA/DIRESA</label>
                                     <div class="col-sm-8">
                                     <select class="form-control" name="codigo_disa" id="codigo_disa">
                                        <option value="0">-- Seleccione --</option>
                                     </select>
                                     </div>
                                  </div>    
                                  <div class="form-group row">
                                     <label for="codigo_red" class="col-sm-4 col-form-label">Red</label>
                                     <div class="col-sm-8">
                                     <select class="form-control" name="codigo_red" id="codigo_red">
                                        <option value="0">-- Seleccione --</option>
                                     </select>
                                     </div>
                                  </div>  
                                  <div class="form-group row">
                                     <label for="codigo_micro_red" class="col-sm-4 col-form-label">Micro Red</label>
                                     <div class="col-sm-8">
                                     <select class="form-control" name="codigo_micro_red" id="codigo_micro_red">
                                        <option value="0">-- Seleccione --</option>
                                     </select>
                                     </div>
                                  </div> 
                                  <div class="form-group row">
                                     <label for="codigo_renipress" class="col-sm-4 col-form-label">IPRESS</label>
                                     <div class="col-sm-8">
                                     <select class="form-control" name="codigo_renipress" id="codigo_renipress">
                                        <option value="0">-- Seleccione --</option>
                                     </select>
                                     </div>
                                  </div> 
                                  <div class="form-group row">
                                     <label for="codigo_condicion" class="col-sm-4 col-form-label">Condición Laboral</label>
                                     <div class="col-sm-8">
                                     <select class="form-control" name="codigo_condicion" id="codigo_condicion">
                                        <option value="0">-- Seleccione --</option>
                                        <option value="1">CAS</option>
                                        <option value="2">Régimen 276</option>
                                        <option value="3">Régimen 728</option>
                                        <option value="4">PAC</option>
                                        <option value="5">FAG</option>
                                        <option value="6">PNUD</option>
                                        <option value="7">Altos Funcionarios</option>
                                        <option value="8">Pensionistas</option>
                                        <option value="9">Ley Servir</option>
                                        <option value="10">Locador</option>
                                        <option value="11">Otros</option>
                                     </select>
                                     </div>
                                  </div> 
                                  <div class="form-group row">
                                     <div class="col-sm-6">
                                     <button type="submit" class="col-6 btn btn-primary">Guardar Registro </button>
                                     </div>
                                     <div class="col-sm-6">
                                     <a href="<?=base_url()?>brigadistas" class="col-6 btn btn-primary" role="button" aria-pressed="true">Cancelar</a>
                                     </div>
                                  </div> 
                                 </form>
                              </div>
                              <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab-4">
                                 <div class="row"> 
                                       <h4 class="mb-4"> ALERGIAS:</h4>
                                 </div>
                                 <form id="formAlergiaCampo" name="formAlergiaCampo" method="post" action="" autocomplete="off" enctype="multipart/form-data" >    
                                       <input type="hidden" name="idrenaherd" id ="idrenaherd" value="<?=$id?>">           
                                             <div class="row"> 
                                                 
                                                <div class="col-md-12">
                                                   <div class="form-group">
                                                      <label for="alergias_alimentarias">Alergias Alimentarias: </label>
                                                      <input type="text" class="form-control" name="alergias_alimentarias" id="alergias_alimentarias"/> 
                                                   </div>
                                                </div>
                                                <label class="span__bold" style="display:block; width:100%">
                                                   <b>  </b>
                                                </label>
                                                <div class="col-md-12">
                                                   <div class="form-group">
                                                      <label for="alergias_farmacologicas">Alergias Farmacologicas: </label>
                                                      <input type="text" class="form-control" name="alergias_farmacologicas" id="alergias_farmacologicas"/> 
                                                   </div>
                                                </div>
                                                <label class="span__bold" style="display:block; width:100%">
                                                   <b>  </b>
                                                </label>
                                                <div class="col">
                                                   <div class="form-group">
                                                      <label> </label>
                                                   </div>
                                                </div>
                                                <div class="col-md-3">
                                                   <div class="form-group">
                                                      <label> </label>
                                                      <button type="submit" class="btn btn-primary btn-block">Actualizar Alergia</button>
                                                   </div>
                                                </div>
                                                <div class="col">
                                                   <div class="form-check">
                                                   </div>
                                                </div>              
                                             </div> 
                                 </form>               
                                 <form id="formInmunizacion" name="formInmunizacion" method="POST" action="" autocomplete="off" enctype="multipart/form-data">               
                                 <div class="row"> 
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label for="tipo_inmunizacion">Tipo Inmunizacion (Vacuna):</label>
                                          <select class="form-control" onchange="d1(this)" id="tipo_inmunizacion" name="tipo_inmunizacion">                                        
                                              <option>--Seleccione --</option>
                                              <option value="01">(DT) Tétanos, Difteria</option>
                                              <option value="02">(Hep B) Hepatitis B</option>
                                              <option value="03">(SPR) Triple viral</option>
                                              <option value="04">(Hib) Influenza</option>
                                              <option value="05">(AMA) Fiebre Amarilla</option>
                                              <option value='otro1'>Otras Vacunas</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label for="numero_dosis">Horas: </label>
                                          <input type="number" min="0" class="form-control" name="numero_dosis" value="0" id="numero_dosis"/> 
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label for="fecha_vacuna">Fecha: </label>
                                          <input type="date" class="form-control" name="fecha_vacuna" id="fecha_vacuna"/> 
                                       </div>
                                    </div>

                                    <div class="col-md-3">
                                        <br>        
                                       <div class="form- group">
                                          <input  type="file" class="custom-file-input" name="file_inmunizacion" id="file_inmunizacion" lang="es">
                                          <label id="elemento_capacitacion" class="custom-file-label" for="customFileLang">Adjuntar archivo</label><br><br>
                                       </div>
                                    </div>
                               
                                    <label class="span__bold" style="display:block; width:100%">
                                       <b>  </b>
                                    </label>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          
                                       <label style="visibility: hidden;" id="prg2" for="nombre">Descripción: </label>
                                          <input style="visibility: hidden;" id="prg1" class="form-control" name='nombre' size='50' disabled="true">
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-check">
                                       </div>
                                    </div>  
                                    <label class="span__bold" style="display:block; width:100%">
                                       <b>  </b>
                                    </label>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label> </label>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label> </label>
                                          <button type="submit" class="btn btn-primary btn-block">Añadir registro</button>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label></label>
                                          <a href="<?=base_url()?>brigadistas" class="col-12 btn btn-primary" role="button" aria-pressed="true">Cancelar registro</a>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-check">
                                       </div>
                                    </div>              
                                 </div>  
                                 </form>
                                 <div class="row"> 
                                    <div class="col-xl-12 col-md-12">
                                       <div class="card m-b-30 pb-35">
                                          <div class="card-body">
                                             <h4 class="mt-0 m-b-15 header-title">LISTADO DE INMUNICZACIONES DEL PERSONAL </h4>
                                             <br>
                                             <div class="table-responsive">
                                             <table id="tablaInmunizacion" class="tablaInmunizacion table table-hover mb-0">
                                                <thead>
                                                   <tr>
                                                      <th>Acciones</th> 
                                                      <th>ID</th>
                                                      <th>Tipo inmunizacion</th>
                                                      <th>Nombre</th>
                                                      <th>Nº de dosis</th>
                                                      <th>Fecha</th>
                                                      <th>Adjunto</th>
                                                      <th>Activo</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <form id="formAlergia" name="formAlergia" method="post" action="" autocomplete="off" enctype="multipart/form-data" >    
                                 <input type="hidden" name="idrenaherd" id ="idrenaherd" value="<?=$id?>">           
                                             <div class="row"> 
                                                <div class="col">
                                                   <div class="form-group">
                                                      <label> </label>
                                                   </div>
                                                </div>
                                                <div class="col-md-3">
                                                   <br>        
                                                   <div class="form-group">
                                                      <input  type="file" class="custom-file-input" name="file_vacunacion" id="file_vacunacion" lang="es">
                                                      <label id="elemento_capacitacion" class="custom-file-label" for="customFileLang">Adjuntar Tarjeta de Vacunaciòn</label><br><br>
                                                   </div>
                                                </div>
                                                <div class="col">
                                                   <div class="form-group">
                                                      <label> </label>
                                                   </div>
                                                </div>
                                                <label class="span__bold" style="display:block; width:100%">
                                                   <b>  </b>
                                                </label>
                                                <div class="col">
                                                   <div class="form-group">
                                                      <label> </label>
                                                   </div>
                                                </div>
                                                <div class="col-md-3">
                                                   <div class="form-group">
                                                      <label> </label>
                                                      <button type="submit" class="btn btn-primary btn-block">Actualizar Alergia</button>
                                                   </div>
                                                </div>
                                                <div class="col">
                                                   <div class="form-check">
                                                   </div>
                                                </div>              
                                             </div> 
                                 </form>
                              </div>                
                              <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab-5">
                                 <div class="row"> 
                                       <h4 class="mb-4"> REGISTRO DE CAPACITACIONES:</h4>
                                 </div>
                                 <form id="formCapacitacion" name="formCapacitacion" method="POST" action="" autocomplete="off" enctype="multipart/form-data">               
                                 <div class="row"> 
                                                
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label for="tcapacitacion">Tipo Curso Capacitación::</label>
                                          <select class="form-control" onchange="d1(this)" id="tipo_capacitacion" name="tipo_capacitacion">                                        
                                             <option>--Seleccione --
                                             <option value="1">BLS (BASIC LIFE SUPPORT)
                                             <option value="2">PHTLS (PREHOSPITAL TRAUMA LIFE SUPPORT)
                                             <option value="3">ACLS (ADVANCED CARDIAC LIFE SUPPORT)
                                             <option value="4">ATLS (ADVANCE TRAUMA LIFE SUPPORT)
                                             <option value="5">GESTION DE RIESGOS DE DESASTRES
                                             <option value='otro1'>OTROS
                                         </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       <label for="institucion">Institución Certificadora:</label>
                                       <input type="text" class="form-control" name="institucion" id="institucion"/> 
                                       </div>
                                    </div>
                                    <div class="col-md-1">
                                       <div class="form-group">
                                          <label for="horas">Horas: </label>
                                          <input type="number" min="0" class="form-control" name="horas" value="0" id="horas"/> 
                                       </div>
                                    </div>
                                    <div class="col-md-2">
                                       <div class="form-group">
                                          <label for="fecha_emision">Fecha de Emisión: </label>
                                          <input type="date" class="form-control" name="fecha_emision" id="fecha_emision"/> 
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                        <br>        
                                       <div class="form- group">
                                          <input  type="file" class="custom-file-input" name="file_capacitacion" id="file_capacitacion" lang="es">
                                          <label id="elemento_capacitacion" class="custom-file-label" for="customFileLang">Adjuntar Capacitacion</label><br><br>
                                       </div>
                                    </div>
                                    <label class="span__bold" style="display:block; width:100%">
                                       <b>  </b>
                                    </label>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       <label style="visibility: hidden;" id="prg2" for="nombre">Descripción: </label>
                                          <input style="visibility: hidden;" id="prg1" class="form-control" name='nombre' size='50' disabled="true">
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-check">
                                       </div>
                                    </div>  
                                    <label class="span__bold" style="display:block; width:100%">
                                       <b>  </b>
                                    </label>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label> </label>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label> </label>
                                          <button type="submit" class="btn btn-primary btn-block">Añadir registro</button>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label></label>
                                          <a href="<?=base_url()?>brigadistas" class="col-12 btn btn-primary" role="button" aria-pressed="true">Cancelar registro</a>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-check">
                                       </div>
                                    </div>              
                                 </div>  
                                 </form>
                                 <div class="row"> 
                                    <div class="col-xl-12 col-md-12">
                                       <div class="card m-b-30 pb-35">
                                          <div class="card-body">
                                             <h4 class="mt-0 m-b-15 header-title">LISTADO DE CERTIFICACIONES REGISTRADAS</h4>
                                             <br>
                                             <div class="table-responsive">
                                             <table id="tablaCapacitacion" class="tablaCapacitacion table table-hover mb-0">
                                                <thead>
                                                   <tr>
                                                      <th>Acciones</th> 
                                                      <th>ID</th>
                                                      <th>Tipo</th>
                                                      <th>Nombre</th>
                                                      <th>Institución</th>
                                                      <th>Horas</th>
                                                      <th>Emisión</th>
                                                      <th>Adjunto</th>
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
                                 </div>
                              </div>
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
 </script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script> 
   <script>
      var URI_MAP = "<?=base_url()?>";
      var URI = "<?=base_url()?>";
      const canDelete = "1";
      const canEdit = "1";
      const canTracking = "1";
      const canHistory = "1"; 
      var table, tablaCarrera,tablaCertificado,tablaInmunizacion,tablaCapacitacion;
      const path_files =<?php echo "'".$path_files."'"; ?>;
   </script>
      <script>
      $("#formLaboral select[name=codigo_region]").on("change", function () {
			var id = $(this).val();
         cargarDISA($("#formLaboral"), 1, 0, id);
		});
		  function cargarDISA(form, select, codigo_disa, codigo_region) {
			var id_disa = codigo_disa;
			$.ajax({
				url: URI + 'contingencia/Main/cargarDISA',
				method: 'post',
				type: 'json',
				data: { codigo_disa: codigo_disa, codigo_region },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=codigo_disa]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {
						$(form).find("select[name=codigo_disa]").html('<option value="0">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_disa) > 0) { $(form).find("select[name=codigo_disa]").append('<option value="' + e.codigo_disa + '"' + (id_disa == e.codigo_disa ? 'selected' : "") + '>' + e.codigo_disa + ' - ' + e.nombre_disa + '</option>'); }
						else { $(form).find("select[name=codigo_disa]").append('<option value="' + e.codigo_disa + '">' + e.codigo_disa + ' - ' + e.nombre_disa + '</option>'); }
					});
				}
			});
		}   
      	$("#formLaboral select[name=codigo_disa]").on("change", function () {
			var id = $(this).val();
					cargarRed($("#formLaboral"), 1, 0, id);
		  });
		  function cargarRed(form, select, codigo_red, codigo_disa) {
			var id_red = codigo_red;
			$.ajax({
				url: URI + 'contingencia/Main/cargarRed',
				method: 'post',
				type: 'json',
				data: { codigo_red: codigo_red, codigo_disa },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=codigo_red]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {
					$(form).find("select[name=codigo_red]").html('<option value="0">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_red) > 0) { $(form).find("select[name=codigo_red]").append('<option value="' + e.codigo_red + '"' + (id_red == e.codigo_red ? 'selected' : "") + '>' + e.codigo_red + ' - ' + e.nombre_red + '</option>'); }
						else { $(form).find("select[name=codigo_red]").append('<option value="' + e.codigo_red + '">' + e.codigo_red + ' - ' + e.nombre_red + '</option>'); }
					});	
				}
			});	
		}
      $("#formLaboral select[name=codigo_red]").on("change", function () {
			var id = $(this).val();
			var disa = $("#formLaboral").find("select[name=codigo_disa]").val();
					cargarMicroRed($("#formLaboral"), 1, 0, id, disa);
		  });
		  function cargarMicroRed(form, select, codigo_micro_red, codigo_red,codigo_disa) {
			var id_microred = codigo_micro_red;
			$.ajax({
				url: URI + 'contingencia/Main/cargarMicroRed',
				method: 'post',
				type: 'json',
				data: { codigo_micro_red: codigo_micro_red, codigo_red, codigo_disa: codigo_disa },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=codigo_micro_red]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {
					$(form).find("select[name=codigo_micro_red]").html('<option value="0">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_micro_red) > 0) { $(form).find("select[name=codigo_micro_red]").append('<option value="' + e.codigo_micro_red + '"' + (id_microred == e.codigo_micro_red ? 'selected' : "") + '>' + e.codigo_micro_red + ' - ' + e.nombre_micro_red + '</option>'); }
						else { $(form).find("select[name=codigo_micro_red]").append('<option value="' + e.codigo_micro_red + '">' + e.codigo_micro_red + ' - ' + e.nombre_micro_red + '</option>'); }
					});
				}
			});
		}
      $("#formLaboral select[name=codigo_micro_red]").on("change", function () {
			var id = $(this).val();
			var institucion = $("#formLaboral").find("select[name=codigo_institucion]").val();
			var region = $("#formLaboral").find("select[name=codigo_region]").val();
			var disa = $("#formLaboral").find("select[name=codigo_disa]").val();
			var red = $("#formLaboral").find("select[name=codigo_red]").val();
					cargarIPRESS($("#formLaboral"), 1, 0, id,institucion,region,disa,red);
		  });
		  function cargarIPRESS(form, select, codigo_renipress, codigo_micro_red,codigo_institucion,codigo_region,codigo_disa,codigo_red) {
			var id_renipress = codigo_renipress;
			$.ajax({
				url: URI + 'contingencia/Main/cargarIPRESS',
				method: 'post',
				type: 'json',
				data: { codigo_renipress: codigo_renipress, codigo_micro_red, codigo_institucion,codigo_region,codigo_disa,codigo_red },
				error: function (xhr) { },
				beforeSend: function () {
					$(form).find("select[name=codigo_renipress]").html('<option value="">Cargando...</option>');
				},
				success: function (data) {
					$(form).find("select[name=codigo_renipress]").html('<option value="0">-- Seleccione --</option>');
					data = JSON.parse(data);
					$.each(data, function (i, e) {
						if (parseInt(codigo_renipress) > 0) { $(form).find("select[name=codigo_renipress]").append('<option value="' + e.codigo_renipress + '"' + (id_renipress == e.codigo_renipress ? 'selected' : "") + '>' + e.codigo_renipress + ' - ' + e.nombre + '</option>'); }
						else { $(form).find("select[name=codigo_renipress]").append('<option value="' + e.codigo_renipress + '">' + e.codigo_renipress + ' - ' + e.nombre + '</option>'); }
					});
				}
			});
		}
     </script>                                           
    <script>
    const idrenarhed = $('#id').val();
    let onlyForm = true;
         table = $('#tablaIdioma').DataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            dom: '<"html5buttons"B>lTfgitp',
            columns: [
               {
               data: null,
                  render: function (data, type, row) { 
                     const btnDelete = `
                     <button class="btn btn-primary btn-circle actionDeleteIdiomas" title="ELIMINAR" type="button">
                        <i class="fa fa-times" aria-hidden="true"></i>
                     </button>`;
                     return `<div style="display: flex"> 
                              ${canDelete ? btnDelete : ''}
                              </div>`;
                  }
               },
               {
                  data: "idioma"
               },
               {
                  data: "nivel"
               },
               {
                  data: "lectura",
               },
               {
                  data: "escritura"
               },         
               {
                  data: "Activo",
                  render: function (data, type, row, meta) {
                     return `<span class="badge ${data === 'Activo' ? 'badge-info' : 'badge-default'}">${data}</span>`
                  }
               },
            ],
            ajax : {
               url : URI + "brigadistas/main/cargarListaIdiomasAjax"+"/"+idrenarhed,
               type : "GET",
               complete:function(){
                  if(onlyForm)
                  cargarTablaCarrera() ;
               }
            },
            order: [],
            columnDefs: [],
            dom: 'Bfrtip',
            select: true,
            buttons: [
               {
                  extend: 'copy',
                  title: 'Lista General de Idicomas',
                  exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
               },
               {
                  extend: 'csv',
                  title: 'Lista General de Idiomas',
                  exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
               },
               {
                  extend: 'excel',
                  title: 'Lista General de Idiomas',
                  exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
               },
               {
                  extend: 'pdf',
                  title: 'Lista General de Idiomas',
                  orientation: 'landscape',
                  exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
               },
               {
                  extend: 'print',
                  title: 'Lista General de Idiomas',
                  exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
                  customize: function (win) {
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');

                  $(win.document.body).find('table')
                     .addClass('compact')
                     .css('font-size', 'inherit');

                  var css = '@page { size: landscape; }',
                     head = win.document.head || win.document.getElementsByTagName('head')[0],
                     style = win.document.createElement('style');

                  style.type = 'text/css';
                  style.media = 'print';

                  if (style.styleSheet) {
                     style.styleSheet.cssText = css;
                  }
                  else {
                     style.appendChild(win.document.createTextNode(css));
                  }
                  head.appendChild(style);
                  }
            }],
            language: 
         {
            search:         "Buscar:",
            lengthMenu: "Mostrando _MENU_ registros por página",
            zeroRecords: "Sin registros",
            info: "Mostrando página  _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(filrado de _MAX_ registros totales)",
            paginate: {
               first:      "Primero",
               last:       "Último",
               next:       "Siguiente",
               previous:   "Anterior"
            },
         }   
         });
function cargarTablaCarrera(){
         tablaCarrera = $('#tablaCarrera').DataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            dom: '<"html5buttons"B>lTfgitp',
            columns: [
               {
               data: null,
                  render: function (data, type, row) { 
                     const btnDelete = `
                     <button class="btn btn-primary btn-circle actionDeleteCarreras" title="ELIMINAR" type="button">
                        <i class="fa fa-times" aria-hidden="true"></i>
                     </button>`;
                     return `<div style="display: flex"> 
                              ${canDelete ? btnDelete : ''}
                              </div>`;
                  }
               },
               {
                  data: "idcarreras"
               },
               {
                  data: "profesion" 
               },
               {
                  data: "especialidad"
               },
               {
                  data: "colegiatura"
               }, 
               {
                  data: "rne"
               },   
               {
                  data:null,
                  render: function (data, type, row) {   
                     let ruta = path_files + data.archivo_titulo;
                     return (data.archivo_titulo!="")?`<a href="${ ruta}" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a> `: "-";
                  }
               },    
               {
                  data:null,
                  render: function (data, type, row) {  
                     let ruta = path_files + data.archivo_especialidad;
                     return (data.archivo_especialidad!="")?`<a href="${ ruta}" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a> `: "-";
                  }
               },    
               {
                  data: "Activo",
                  render: function (data, type, row, meta) {
                     return `<span class="badge ${data === 'Activo' ? 'badge-info' : 'badge-default'}">${data}</span>`
                  }
               },
            ],
            ajax : {
               url : URI + "brigadistas/main/cargarListaCarrerasAjax"+"/"+idrenarhed,
               type : "GET",
               complete:function(){
                  if(onlyForm)
                  cargarTablaCertificado() ;
               }
            },
            order: [],
            columnDefs: [],
            dom: 'Bfrtip',
            select: true,
            buttons: [{
               extend: 'copy',
               title: 'Lista General de Carrera',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
            },
            {
               extend: 'csv',
               title: 'Lista General de Carrera',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
            },
            {
               extend: 'excel',
               title: 'Lista General de Carrera',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
            },
            {
               extend: 'pdf',
               title: 'Lista General de Carrera',
               orientation: 'landscape',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
            },
            {
               extend: 'print',
               title: 'Lista General de Carrera',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
               customize: function (win) {
               $(win.document.body).addClass('white-bg');
               $(win.document.body).css('font-size', '10px');

               $(win.document.body).find('table')
                  .addClass('compact')
                  .css('font-size', 'inherit');

               var css = '@page { size: landscape; }',
                  head = win.document.head || win.document.getElementsByTagName('head')[0],
                  style = win.document.createElement('style');

               style.type = 'text/css';
               style.media = 'print';

               if (style.styleSheet) {
                  style.styleSheet.cssText = css;
               }
               else {
                  style.appendChild(win.document.createTextNode(css));
               }

               head.appendChild(style);
               }
            }],
            language: 
         {
            search:         "Buscar:",
            lengthMenu: "Mostrando _MENU_ registros por página",
            zeroRecords: "Sin registros",
            info: "Mostrando página  _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(filrado de _MAX_ registros totales)",
            paginate: {
               first:      "Primero",
               last:       "Último",
               next:       "Siguiente",
               previous:   "Anterior"
            },
         }   
         });
}    
function cargarTablaCertificado(){
         tablaCertificado = $('#tablaCertificado').DataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            dom: '<"html5buttons"B>lTfgitp',
            columns: [
               {
               data: null,
                  render: function (data, type, row) { 
                     const btnDelete = `
                     <button class="btn btn-primary btn-circle actionDeletetablaCertificados" title="ELIMINAR" type="button">
                        <i class="fa fa-times" aria-hidden="true"></i>
                     </button>`;
                     return `<div style="display: flex"> 
                              ${canDelete ? btnDelete : ''}
                              </div>`;
                  }
               },
               {
                  data: "idcertificaciones"
               },
               {
                  data: "nombre" //idinstitucion
               },
              
               {
                  data: "fecha_inicio"
               }, 
               {
                  data: "fecha_vigencia"
               },          
               {
                  data: "Activo",
                  render: function (data, type, row, meta) {
                     return `<span class="badge ${data === 'Activo' ? 'badge-info' : 'badge-default'}">${data}</span>`
                  }
               },
               {
                  data: "Activo"
               }
            ],
            ajax : {
               url : URI + "brigadistas/main/cargarListaCertificacionAjax"+"/"+idrenarhed,
               type : "GET",
                  complete:function(){
                  if(onlyForm)
                  cargarTablaInmunizacion() ;
               }  
            },
            order: [],
            columnDefs: [],
            dom: 'Bfrtip',
            select: true,
            buttons: [{
               extend: 'copy',
               title: 'Lista General de Certificados',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
            },
            {
               extend: 'csv',
               title: 'Lista General de Certificados',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
            },
            {
               extend: 'excel',
               title: 'Lista General de Certificados',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
            },
            {
               extend: 'pdf',
               title: 'Lista General de Certificados',
               orientation: 'landscape',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
            },
            {
               extend: 'print',
               title: 'Lista General de Certificados',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
               customize: function (win) {
               $(win.document.body).addClass('white-bg');
               $(win.document.body).css('font-size', '10px');
               $(win.document.body).find('table')
                  .addClass('compact')
                  .css('font-size', 'inherit');
               var css = '@page { size: landscape; }',
                  head = win.document.head || win.document.getElementsByTagName('head')[0],
                  style = win.document.createElement('style');

               style.type = 'text/css';
               style.media = 'print';

               if (style.styleSheet) {
                  style.styleSheet.cssText = css;
               }
               else {
                  style.appendChild(win.document.createTextNode(css));
               }
               head.appendChild(style);
               }
            } ],
            language: 
         {
            search:         "Buscar:",
            lengthMenu: "Mostrando _MENU_ registros por página",
            zeroRecords: "Sin registros",
            info: "Mostrando página  _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(filrado de _MAX_ registros totales)",
            paginate: {
               first:      "Primero",
               last:       "Último",
               next:       "Siguiente",
               previous:   "Anterior"
            },
         }                                 
         });
}    
function cargarTablaInmunizacion(){
   tablaInmunizacion = $('#tablaInmunizacion').DataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            dom: '<"html5buttons"B>lTfgitp',
            columns: [
               {
               data: null,
                  render: function (data, type, row) { 
                     const btnDelete = `
                     <button class="btn btn-primary btn-circle actionDeletetablaInmunizacion" title="ELIMINAR" type="button">
                        <i class="fa fa-times" aria-hidden="true"></i>
                     </button>`;
                     return `<div style="display: flex"> 
                              ${canDelete ? btnDelete : ''}
                              </div>`;
                  }
               },
               {
                  data: "idinmunizacion"
               },
               {
                  data: "tipo_inmunizacion"
               },
               {
                  data: "nombre"
               }, 
              
               {
                  data: "numero_dosis"
               }, 
               {
                  data: "fecha_vacuna"
               },
               {
                  data:null,
                  render: function (data, type, row) {  
                     let ruta = path_files + data.archivo_adjunto;
                     return (data.archivo_adjunto!="")?`<a href="${ ruta}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i></a> `: "-";
                  }
               },          
               {
                  data: "Activo",
                  render: function (data, type, row, meta) {
                     return `<span class="badge ${data === 'Activo' ? 'badge-info' : 'badge-default'}">${data}</span>`
                  }
               }
            ],
            ajax : {
               url : URI + "brigadistas/main/cargarListaInmunizacionAjax"+"/"+idrenarhed,
               type : "GET",
                  complete:function(){
                  if(onlyForm)
                  cargarTablaCapacitacion() ;
               }  
            },
            order: [],
            columnDefs: [],
            dom: 'Bfrtip',
            select: true,
            buttons: [{
               extend: 'copy',
               title: 'Lista General de Inmunizacion',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
            },
            {
               extend: 'csv',
               title: 'Lista General de Inmunizacion',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
            },
            {
               extend: 'excel',
               title: 'Lista General de Inmunizacion',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
            },
            {
               extend: 'pdf',
               title: 'Lista General de Inmunizacion',
               orientation: 'landscape',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
            },
            {
               extend: 'print',
               title: 'Lista General de Inmunizacion',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ] },
               customize: function (win) {
               $(win.document.body).addClass('white-bg');
               $(win.document.body).css('font-size', '10px');
               $(win.document.body).find('table')
                  .addClass('compact')
                  .css('font-size', 'inherit');
               var css = '@page { size: landscape; }',
                  head = win.document.head || win.document.getElementsByTagName('head')[0],
                  style = win.document.createElement('style');
               style.type = 'text/css';
               style.media = 'print';

               if (style.styleSheet) {
                  style.styleSheet.cssText = css;
               }
               else {
                  style.appendChild(win.document.createTextNode(css));
               }
               head.appendChild(style);
               }
            }],
            language: 
         {
            search:         "Buscar:",
            lengthMenu: "Mostrando _MENU_ registros por página",
            zeroRecords: "Sin registros",
            info: "Mostrando página  _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(filrado de _MAX_ registros totales)",
            paginate: {
               first:      "Primero",
               last:       "Último",
               next:       "Siguiente",
               previous:   "Anterior"
            },
         }   
         });
} 
function cargarTablaCapacitacion(){
         tablaCapacitacion = $('#tablaCapacitacion').DataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            dom: '<"html5buttons"B>lTfgitp',
            columns: [
               {
               data: null,
                  render: function (data, type, row) { 
                     const btnDelete = `
                     <button class="btn btn-primary btn-circle actionDeletetablaCapacitacion" title="ELIMINAR" type="button">
                        <i class="fa fa-times" aria-hidden="true"></i>
                     </button>`;
                     return `<div style="display: flex"> 
                              ${canDelete ? btnDelete : ''}
                              </div>`;
                  }
               },
               {
                  data: "idcapacitacion"
               },
               {
                  data: "tipo_capacitacion"
               },
               {
                  data: "nombre"
               }, 
               {
                  data: "institucion"
               },          
               {
                  data: "horas"
               },
               {
                  data: "fecha_emision"
               }, 
               {
                  data:null,
                  render: function (data, type, row) {  
                     let ruta = path_files + data.archivo_adjunto;
                     return (data.archivo_adjunto!="")?`<a href="${ ruta}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i></a> `: "-";
                  }
               },
               {
                  data: "Activo",
                  render: function (data, type, row, meta) {
                     return `<span class="badge ${data === 'Activo' ? 'badge-info' : 'badge-default'}">${data}</span>`
                  }
               }
            ],
            ajax : {
               url : URI + "brigadistas/main/cargarListaCapacitacionAjax"+"/"+idrenarhed,
               type : "GET",    
            },
            order: [],
            columnDefs: [],
            dom: 'Bfrtip',
            select: true,
            buttons: [{
               extend: 'copy',
               title: 'Lista General de Capacitacion',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5,6 ] },
            },
            {
               extend: 'csv',
               title: 'Lista General de Capacitacion',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ,6] },
            },
            {
               extend: 'excel',
               title: 'Lista General de Capacitacion',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5,6  ] },
            },
            {
               extend: 'pdf',
               title: 'Lista General de Capacitacion',
               orientation: 'landscape',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ,6] },
            },
            {
               extend: 'print',
               title: 'Lista General de Capacitacion',
               exportOptions: { columns: [0, 1, 2, 3, 4, 5 ,6] },
               customize: function (win) {
               $(win.document.body).addClass('white-bg');
               $(win.document.body).css('font-size', '10px');
               $(win.document.body).find('table')
                  .addClass('compact')
                  .css('font-size', 'inherit');
               var css = '@page { size: landscape; }',
                  head = win.document.head || win.document.getElementsByTagName('head')[0],
                  style = win.document.createElement('style');

               style.type = 'text/css';
               style.media = 'print';
               if (style.styleSheet) {
                  style.styleSheet.cssText = css;
               }
               else {
                  style.appendChild(win.document.createTextNode(css));
               }
               head.appendChild(style);
               }
            }],
            language: 
         {
            search:         "Buscar:",
            lengthMenu: "Mostrando _MENU_ registros por página",
            zeroRecords: "Sin registros",
            info: "Mostrando página  _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(filrado de _MAX_ registros totales)",
            paginate: {
               first:      "Primero",
               last:       "Último",
               next:       "Siguiente",
               previous:   "Anterior"
            },
         }   
         });
} 
       $(document).ready(function () {
          $('.tablaCarrera').on('click','tr .actionDeleteCarreras',function(){
            var tr =$(this).parents('tr');
            var row=tablaCarrera.row(tr);
            data=row.data();
            var id=data.idcarreras;
            var txt;
            var r=confirm("¿Estás seguro que deseas realizar esta acción?");
            if(r==true){
               $.ajax({
                  url:URI+ "brigadistas/main/eliminarCarreraPersonal",
                  method:"post",
                  type:"json",
                  data:{
                     id_carrera:id
                  },
                  error: function(xhr){},
                  success:function(data){
                     onlyForm = false;
                     tablaCarrera.ajax.reload();
                  }
                });
            } else {
                    txt="You pressed Cancel";
                    console.log(txt);
                  }
         });   
         $("select[name=idprofesion]").on("change",function(){
            var id = $(this).val();
            if(id > 0){
               $.ajax({
                  url:URI + "brigadistas/main/getEspecialidadesxProfesion",
                  method:'post',
                  type:'json',
                  data:{
                     id_profesion: id
                  },
                  error:function(xhr){},
                  beforeSend:function(){
                     $("select[name=idespecialidad]").html('<option value="">Cargando...</option>'); 
                  },
                  success:function(data){	
                     data = JSON.parse(data);
                     if (parseInt(data.length) > 0) {
                        $htmlPOI = '<option value="">-- Seleccione especialidad --</option>';	
                     } else {
                        $htmlPOI = '<option value="">-- Sin Registros --</option>';
                     }
                     $.each(data, function(i, e){
                        $htmlPOI += '<option value="' + e.id + '">'+e.especialidad +'</option>'				
                     });
                     $("select[name=idespecialidad]").html($htmlPOI);				
                  }
                  });
            }
         });
         $('.tablaCertificado').on('click','tr .actionDeletetablaCertificados',function(){
            var tr =$(this).parents('tr');
            var row=tablaCertificado.row(tr);
            data=row.data();
            var id=data.idcertificaciones;
            var txt;
            var r=confirm("¿Estás seguro que deseas realizar esta acción?");
            if(r==true){
               $.ajax({
                  url:URI+ "brigadistas/main/eliminarCertificadoPersonal",
                  method:"post",
                  type:"json",
                  data:{
                     id_certificado:id
                  },
                  error: function(xhr){},
                  success:function(data){
                     onlyForm = false;
                     tablaCertificado.ajax.reload();
                  }
                });
            } else {
                    txt="You pressed Cancel";
                    console.log(txt);
                  }
         });   
         $('.tablaInmunizacion').on('click','tr .actionDeletetablaInmunizacion',function(){
            var tr =$(this).parents('tr');
            var row=tablaInmunizacion.row(tr);
            data=row.data();
            var id=data.idinmunizacion;
            var txt;
            var r=confirm("¿Estás seguro que deseas realizar esta acción?");
            if(r==true){
               $.ajax({
                  url:URI+ "brigadistas/main/eliminarInmunizacionPersonal",
                  method:"post",
                  type:"json",
                  data:{
                     id_inmunizacion:id
                  },
                  error: function(xhr){},
                  success:function(data){
                     onlyForm = false;
                     tablaInmunizacion.ajax.reload();
                  }
                });
            } else {
                    txt="You pressed Cancel";
                    console.log(txt);
                  }
         });   
         $('.tablaCapacitacion').on('click','tr .actionDeletetablaCapacitacion',function(){
            var tr =$(this).parents('tr');
            var row=tablaCapacitacion.row(tr);
            data=row.data();
            var id=data.idcapacitacion;
            var txt;
            var r=confirm("¿Estás seguro que deseas realizar esta acción?");
            if(r==true){
               $.ajax({
                  url:URI+ "brigadistas/main/eliminarCapacitacionPersonal",
                  method:"post",
                  type:"json",
                  data:{
                     id_capacitacion:id
                  },
                  error: function(xhr){},
                  success:function(data){
                     onlyForm = false;
                     tablaCapacitacion.ajax.reload();
                  }
                });
            } else {
                    txt="You pressed Cancel";
                    console.log(txt);
                  }
         }); 
         $('.tablaIdioma').on('click','tr .actionDeleteIdiomas',function(){
            var tr =$(this).parents('tr');
            var row=table.row(tr);
            data=row.data();
            var id=data.ididiomas;
            var txt;
            var r=confirm("¿Estás seguro que deseas realizar esta acción?");
            if(r==true){
               $.ajax({
                  url:URI+ "brigadistas/main/eliminarIdiomaPersonal",
                  method:"post",
                  type:"json",
                  data:{
                     id_idioma:id
                  },
                  error: function(xhr){},
                  success:function(data){
                     onlyForm = false;
                     table.ajax.reload();
                  }
                });
            } else {
                    txt="You pressed Cancel";
                    console.log(txt);
                  }
         });

      });
   $("#formIdioma").validate({
		rules:{
         ididioma:{required:function(){if($("#ididioma").css("display")!="none") return true; else return false;}}, 
         nivel:{required:function(){if($("#nivel").css("display")!="none") return true; else return false;}}, 
		},
		messages:{
			ididioma:{required:"(*) Campo Requerido"}, 
			nivel:{required:"(*) Campo Requerido"}, 
		},
		errorPlacement: function(error, element) {
		},
		submitHandler:function(form,event){
			event.preventDefault(); 
			var formData = new FormData(document.getElementById("formIdioma"));
         formData.append("id", $("#id").val());
			$.ajax({
				data: formData,
				url:URI+"brigadistas/registrarIdioma",
				method:"POST",
				dataType:"json",
				cache: false,
			   contentType: false,
			   processData: false,
				beforeSend: function(){
               $("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
               $(".btn-block").addClass("disabled");
               $("#message").html("");
            },
            success: function(data){
               $("#cargando").html("<i></i>");
               $('html, body').animate({ scrollTop: 0 }, 'fast');
					var $message = "";
				if(parseInt(data.status)==200){ $(".btn-block").removeClass("disabled");  $message = '<div class="alert alert-success"><h4 style="margin:0">Idioma registrado exitosamente</h4></div>'; }
					else {
						$message = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar el idioma</h4></div>';
						$(".btn-block").removeClass("disabled");
					}
               $("#message").html($message);
               $('#formIdioma')[0].reset();//reseteas el form
               setTimeout(function(){
                  $("#message").slideUp();
                  onlyForm = false;
                  table.ajax.reload();
                  $('html, body').animate({ scrollTop: $('body').height() }, 'fast');
               },3500);  
            }
			});
		}
	});
   $("#formCarrera").validate({
		rules:{
		},
		messages:{
		},
		errorPlacement: function(error, element) {
		},
		submitHandler:function(form,event){
			event.preventDefault(); 
			var formData = new FormData(document.getElementById("formCarrera"));
         formData.append("file", document.getElementById("file_titulo"));
         formData.append("file", document.getElementById("file_especialidad")); 	
         formData.append("id", $("#id").val());	
			$.ajax({
				data: formData,
				url:URI+"brigadistas/registrarCarrera",
				method:"POST",
				dataType:"json",
				cache: false,
			   contentType: false,
			   processData: false,
				beforeSend: function(){
               $("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
               $(".btn-block").addClass("disabled");
               $("#message").html("");
            },
            success: function(data){
               $("#cargando").html("<i></i>");
               $('html, body').animate({ scrollTop: 0 }, 'fast');
					var $message = "";
					if(parseInt(data.status)==200){ $(".btn-block").removeClass("disabled");  $message = '<div class="alert alert-success"><h4 style="margin:0">Carrera registrada exitosamente</h4></div>'; }
					else {
						$message = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar la carrera</h4></div>';
						$(".btn-block").removeClass("disabled");
					}
               $("#message").html($message);
               $('#formCarrera')[0].reset();
               setTimeout(function(){
                  $("#message").slideUp();
                  onlyForm = false;
                  tablaCarrera.ajax.reload();
               },3500);  
            }
			});
		}
	});
   $("#formCertificado").validate({
		rules:{
		},
		messages:{
		},
		errorPlacement: function(error, element) {
		},
		submitHandler:function(form,event){
			event.preventDefault(); 
			var formData = new FormData(document.getElementById("formCertificado"));
         formData.append("file", document.getElementById("file_certificado")); 
         formData.append("id", $("#id").val());
			$.ajax({
				data: formData,
				url:URI+"brigadistas/registrarCertificado",
				method:"POST",
				dataType:"json",
				cache: false,
			   contentType: false,
			   processData: false,
				beforeSend: function(){
               $("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
               $(".btn-block").addClass("disabled");
               $("#message").html("");
            },
            success: function(data){
               $("#cargando").html("<i></i>");
               $('html, body').animate({ scrollTop: 0 }, 'fast');
					var $message = "";
					if(parseInt(data.status)==200){ $(".btn-block").removeClass("disabled");  $message = '<div class="alert alert-success"><h4 style="margin:0">Idioma registrado exitosamente</h4></div>'; }
					else {
						$message = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar el idioma</h4></div>';
						$(".btn-block").removeClass("disabled");
					}
               $("#message").html($message);
               $('#formCertificado')[0].reset();
               setTimeout(function(){
                  $("#message").slideUp();
                  onlyForm = false;
                  tablaCertificado.ajax.reload();
               },3500);   
            }
			});

		}
	});
      $("#formLaboral").validate({
         rules:{
         },
         messages:{
         },
         errorPlacement: function(error, element) {
         },
         submitHandler:function(form,event){
            event.preventDefault(); 
            var formData = new FormData(document.getElementById("formLaboral"));
            formData.append("id", $("#id").val());
            $.ajax({
               data: formData,
               url:URI+"brigadistas/registrarLaboral",
               method:"POST",
               dataType:"json",
               cache: false,
               contentType: false,
               processData: false,
               beforeSend: function(){
                  $("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
                  $(".btn-block").addClass("disabled");
                  $("#message").html("");
               },
               success: function(data){
                  $("#cargando").html("<i></i>");
                  $('html, body').animate({ scrollTop: 0 }, 'fast');
                  var $message = "";
                  if(parseInt(data.status)==200){ $(".btn-block").removeClass("disabled");  $message = '<div class="alert alert-success"><h4 style="margin:0">Condición Laboral registrado exitosamente</h4></div>'; }
                  else {
                     $message = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar el idioma</h4></div>';
                     $(".btn-block").removeClass("disabled");
                  }
                  $("#message").html($message);
                  $('#formCertificado')[0].reset();
                  setTimeout(function(){
                     $("#message").slideUp();
                     onlyForm = false;
                     tablaCertificado.ajax.reload();
                  },3500); 
               }
            });

         }
      });
   $("#formAlergia").validate({
		rules:{
		},
		messages:{
		},
		errorPlacement: function(error, element) { 
		},
		submitHandler:function(form,event){
			event.preventDefault(); 
         var formData = new FormData(document.getElementById("formAlergia"));
         formData.append("file", document.getElementById("file_vacunacion")); 
         formData.append("id", $("#id").val());
			$.ajax({
				data: formData,
				url: URI + 'brigadistas/registrarAlergiaPersonal',
				method:"POST",
				dataType:"json",
				cache: false,
			   contentType: false,
			   processData: false,
				beforeSend: function(){
               $("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
               $(".btn-block").addClass("disabled");
               $("#message").html("");
            },
            success: function(data){
               $("#cargando").html("<i></i>");
               $('html, body').animate({ scrollTop: 0 }, 'fast');
					var $message = "";
					if(parseInt(data.status)==200){ $(".btn-block").removeClass("disabled");  $message = '<div class="alert alert-success"><h4 style="margin:0">Alergia actualizado exitosamente</h4></div>'; }
					else {
						$message = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar Inmunizacion</h4></div>';
						$(".btn-block").removeClass("disabled");
					}
               $("#message").html($message);
               $('#formAlergia')[0].reset();
               setTimeout(function(){
                  $("#message").slideUp();
                  onlyForm = false;
               },3500);  
            }
			});
		}
   });
   $("#formAlergiaCampo").validate({
		rules:{
		},
		messages:{
		},
		errorPlacement: function(error, element) {
		},
		submitHandler:function(form,event){
			event.preventDefault(); 
         var formData = new FormData(document.getElementById("formAlergiaCampo"));
         formData.append("id", $("#id").val());
			$.ajax({
				data: formData,
				url: URI + 'brigadistas/registrarAlergiaCampoPersonal',
				method:"POST",
				dataType:"json",
				cache: false,
			   contentType: false,
			   processData: false,
				beforeSend: function(){
               $("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
               $(".btn-block").addClass("disabled");
               $("#message").html("");
            },
            success: function(data){
               $("#cargando").html("<i></i>");
               $('html, body').animate({ scrollTop: 0 }, 'fast');
					var $message = "";
					if(parseInt(data.status)==200){ $(".btn-block").removeClass("disabled");  $message = '<div class="alert alert-success"><h4 style="margin:0">Alergia actualizado exitosamente</h4></div>'; }
					else {
						$message = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar Inmunizacion</h4></div>';
						$(".btn-block").removeClass("disabled");
					}
               $("#message").html($message);
               $('#formAlergiaCampo')[0].reset();
               setTimeout(function(){
                  $("#message").slideUp();
                  onlyForm = false;
               },3500);  
            }
			});
		}
   });
   $("#formInmunizacion").validate({
		rules:{
		},
		messages:{
		},
		errorPlacement: function(error, element) {
		},
		submitHandler:function(form,event){
			event.preventDefault(); 
         var formData = new FormData(document.getElementById("formInmunizacion"));
         formData.append("file", document.getElementById("file_inmunizacion")); 
         formData.append("id", $("#id").val());
			$.ajax({
				data: formData,
				url:URI+"brigadistas/registrarInmunizacionPersonal",
				method:"POST",
				dataType:"json",
				cache: false,
			   contentType: false,
			   processData: false,
				beforeSend: function(){
               $("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
               $(".btn-block").addClass("disabled");
               $("#message").html("");
            },
            success: function(data){
               $("#cargando").html("<i></i>");
               $('html, body').animate({ scrollTop: 0 }, 'fast');
					var $message = "";
					if(parseInt(data.status)==200){ $(".btn-block").removeClass("disabled");  $message = '<div class="alert alert-success"><h4 style="margin:0">Inmunizacion registrado exitosamente</h4></div>'; }
					else {
						$message = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar Inmunizacion</h4></div>';
						$(".btn-block").removeClass("disabled");
					}
               $("#message").html($message);
               $('#formInmunizacion')[0].reset();
               setTimeout(function(){
                  $("#message").slideUp();
                  onlyForm = false;
                  tablaInmunizacion.ajax.reload();
               },3500);  
            }
			});
		}
   });
   $("#formCapacitacion").validate({
		rules:{
		},
		messages:{
		},
		errorPlacement: function(error, element) {
		},
		submitHandler:function(form,event){
			event.preventDefault(); 
         var formData = new FormData(document.getElementById("formCapacitacion"));
         formData.append("file", document.getElementById("file_capacitacion")); 
         formData.append("id", $("#id").val());
			$.ajax({
				data: formData,
				url:URI+"brigadistas/registrarCapacitacionPersonal",
				method:"POST",
				dataType:"json",
				cache: false,
			   contentType: false,
			   processData: false,
				beforeSend: function(){
               $("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
               $(".btn-block").addClass("disabled");
               $("#message").html("");
            },
            success: function(data){
               $("#cargando").html("<i></i>");
               $('html, body').animate({ scrollTop: 0 }, 'fast');
					var $message = "";
					if(parseInt(data.status)==200){ $(".btn-block").removeClass("disabled");  $message = '<div class="alert alert-success"><h4 style="margin:0">Capacitación registrado exitosamente</h4></div>'; }
					else {
						$message = '<div class="alert alert-error"><h4 style="margin:0">No se pudo registrar el idioma</h4></div>';
						$(".btn-block").removeClass("disabled");
					}
               $("#message").html($message);
               $('#formCapacitacion')[0].reset();
               setTimeout(function(){
                  $("#message").slideUp();
                  onlyForm = false;
                  tablaCapacitacion.ajax.reload();
               },3500);  
            }
			});
		}
   });
  </script> 
  </body>
</html>