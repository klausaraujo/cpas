<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?=TITULO_PRINCIPAL?></title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="<?=AUTOR?>">
  <?php $this->load->view("inc/resources");
  $titulo = "Gesti&oacute;n de Usuarios";
  $botonCrear = "Registrar Usuario";
?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/usuarios/usuarios.css?v=<?=date("s")?>" />
  <?php $opciones = $this->session->userdata("Permisos_Opcion"); ?>
</head>
<body>
  <div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
    <?php $this->load->view("inc/nav"); ?>
    <div class="page-wrapper" style="min-height: 710px;">
      <div class="container pt-30">
        <div class="row heading-bg">
          <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Gesti&oacute;n de Usuarios</h5>
          </div>
          <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="<?=base_url()?>">Inicio</a></li>
              <li><a href="<?=base_url()?>usuarios/main"><span>Usuarios</span></a></li>
              <li class="active"><span>Usuario</span></li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-xs-12">
                <!-- col-sm-8 col-sm-offset-2  -->
                <div class="panel panel-default card-view pa-0">
                  <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                      <div class="sm-data-box pa-10">
                        <div class="container-fluid">
                          <div id="div-alerta-success" class="d-none alert alert-success">
                            <span>Permisos modificados</span>
                          </div>
                          <?php $message = $this->session->flashdata('mensajeSuccess'); ?>
                          <?php if($message){ ?>
                          <div class="alert alert-success">
                            <span><?= $message ?></span>
                          </div>
                          <?php } ?>
                          <?php $message = $this->session->flashdata('mensajeError'); ?>
                          <?php if($message){ ?>
                          <div class="alert alert-danger">
                            <span><?= $message ?></span>
                          </div>
                          <?php } ?>
                          <?php $message = $this->session->flashdata('mensajeWarning'); ?>
                          <?php if($message){ ?>
                          <div class="alert alert-warning">
                            <span><?= $message ?></span>
                          </div>
                          <?php } ?>
                          <?php $idrol = $this->session->userdata("idrol"); ?>
                          <div class="row">
                            <div class="col-xs-12 pull-right pa-10">
                              <?php if(validarPermisosOpciones(40,$opciones)){?>
                              <button type="button" class="btn btn-primary pull-right" id="btnRegistrarModal">
                                <?=$botonCrear?>
                              </button>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="table-responsive">
                            <table id="tbListar" class="table table-bordered table-sm">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>C&oacute;digo</th>
                                  <th>DNI</th>
                                  <th>Apellidos</th>
                                  <th>Nombres</th>
                                  <th>Usuario</th>
                                  <th>Perfil</th>
                                  <th>Regi&oacute;n</th>
                                  <th>Áreas</th>
                                  <th>Clave</th>
                                  <th>A/D</th>
                                  <th>Editar</th>
                                  <th>Permisos</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
            $numero = 1;
            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :
                    ?>
                                <tr>
                                  <td align="center"><?=$numero?></td>
                                  <td align="center"><?=$row->Codigo_Usuario?></td>
                                  <td align="center"><?=$row->DNI?></td>
                                  <td align="center"><?=$row->Apellidos?></td>
                                  <td align="center"><?=$row->Nombres?></td>
                                  <td align="center"><?=strtolower($row->Usuario)?></td>
                                  <td align="center"><?=strtoupper($row->Descripcion_Perfil)?></td>
                                  <td align="center"><?=$row->Nombre_Region?></td>
                                  <td align="center">
                                    <?php if(validarPermisosOpciones(41,$opciones)){?>
                                    <?php if($row->Codigo_Perfil=='02' or $row->Codigo_Perfil=='01'){ ?>
                                    <button class="btn btn-info btn-circle areasEdit" title="AREAS" type="button"> <i
                                        class="fa fa-list-ul"></i> </button>
                                    <?php } ?>
                                    <?php } ?>
                                  </td>
                                  <td align="center">
                                    <?php if(validarPermisosOpciones(42,$opciones)){?>
                                    <button class="btn btn-muted btn-circle passwordEdit" title="PASSWORD"
                                      type="button">
                                      <i class="fa fa-lock"></i>
                                    </button>
                                    <?php } ?>
                                  </td>
                                  <td align="center">
                                    <?php if(validarPermisosOpciones(43,$opciones)){?>
                                    <?php if($row->Activo=="1"){ ?>
                                    <button class="btn btn-primary btn-circle actionDisable" title="ANULAR"
                                      type="button">
                                      <i class="fa fa-times"></i>
                                    </button>
                                    <?php }else{ ?>
                                    <button class="btn btn-success btn-circle actionEnable" title="ACTIVAR"
                                      type="button">
                                      <i class="fa fa-check"></i>
                                    </button>
                                    <?php } ?>
                                    <?php } ?>
                                  </td>
                                  <td align="center">
                                    <?php if(validarPermisosOpciones(44,$opciones)){?>
                                    <button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button">
                                      <i class="fa fa-pencil-square-o"></i>
                                    </button>
                                    <?php } ?>
                                  </td>
                                  <td align="center">
                                    <?php if(validarPermisosOpciones(45,$opciones)){?>
                                    <button class="btn btn-success btn-circle actionPermisos" title="PERMISOS"
                                      type="button">
                                      <i class="fa fa-lock" aria-hidden="true"></i>
                                    </button>
                                    <?php } ?>
                                  </td>
                                  <td><?=$row->Codigo_Perfil?></td>
                                  <td><?=$row->Codigo_Region?></td>
                                  <td><?=$row->Anio_Ejecucion?></td>
                                  <td><?=$row->Codigo_Sector?></td>
                                  <td><?=$row->Codigo_Pliego?></td>
                                  <td><?=$row->Codigo_Ejecutora?></td>
                                  <td><?=$row->Codigo_Centro_Costos?></td>
                                  <td><?=$row->Codigo_Sub_Centro_Costos?></td>
                                </tr>
                                <?php
                    $numero ++;
                endforeach
                ;
            }
            ?>
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
          </div>
        </div>
      </div>
      <?php $this->load->view("inc/footer"); ?>
      <script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>
    </div>
  </div>
  <div class="modal fade" id="permisosModal" tabindex="-1" role="dialog" aria-labelledby="activateModal">
    <div class="modal-dialog modal-xl" role="document">
      <input type="hidden" id="hIdUsuario" value="" />
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title">Otorgar Permisos</h5>
        </div>
        <div class="modal-body">
          <div class="row col-sm-12">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">SIREED</a></li>
              <li><a data-toggle="tab" href="#menu1">RENARHED</a></li>
              <li><a data-toggle="tab" href="#menu2">Tablero de Control</a></li>
              <li><a data-toggle="tab" href="#menu6">Ejecuci&oacute;n de Planes</a></li>
              <li><a data-toggle="tab" href="#menu4">Oferta Movil</a></li>
              <li><a data-toggle="tab" href="#menu5">Emergencias Sanitarias</a></li>
              <li><a data-toggle="tab" href="#menu7">Sobredemanda</a></li>
              <li><a data-toggle="tab" href="#menu8">Usuarios</a></li>
              <li><a data-toggle="tab" href="#menu9">Contingencias</a></li>
              <li><a data-toggle="tab" href="#menu10">Inventarios</a></li>
              <li><a data-toggle="tab" href="#menu11">COVID-19</a></li>
              <li><a data-toggle="tab" href="#menu12">Farmacia</a></li>
            </ul>
            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                <br />
                <div class="clearfix"></div>
                <div class="col-sm-4 col-xs-12">
                  <h3>Men&uacute; Principal</h3>
                  <?php foreach($eventos as $row): ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                      <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                        value="<?=$row->idmenu?>" />
                      <label for="chkMenu<?=$row->idmenu?>">
                        <?=$row->descripcion?>
                      </label>
                    </div>
                    <?php if($row->nivel==1){
                                   foreach($row->subMenu as $rowS): ?>
                    <div class="col-xs-12">
                      <div class="checkbox checkbox-primary">
                        <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                          rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" />
                        <label for="chkSubMenu<?=$rowS->idmenudetalle?>">
                          <?=$rowS->descripcion?>
                        </label>
                      </div>
                    </div>
                    <?php endforeach;
                                 } ?>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="col-sm-4 col-xs-12">

                  <h3>Permisos Registro de Eventos</h3>
                  <?php foreach($permisos->result() as $row):
                          		if($row->tipo=="1" and $row->idmodulo=="1"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                                }
                              endforeach; ?>
                </div>

                <div class="col-sm-4 col-xs-12">

                  <h3>Permisos Acciones de Eventos</h3>
                  <?php foreach($permisos->result() as $row):
                          		if($row->tipo=="2" and $row->idmodulo=="1"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                                }
                              endforeach; ?>
                </div>
              </div>
              <div id="menu1" class="tab-pane fade in">
                <div class="col-sm-4 col-xs-12">
                  <h3>Men&uacute; Principal</h3>
                  <?php foreach($brigadistas as $row): ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                        value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                    <?php if($row->nivel==1){
                                   foreach($row->subMenu as $rowS): ?>
                    <div class="col-xs-12">
                      <div class="checkbox checkbox-primary">
                      <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                          rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                    </div>
                    <?php endforeach;
                                 } ?>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <h3>Permisos Registro de Brigadista</h3>
                  <?php foreach($permisos->result() as $row):
                          		if($row->tipo=="1" and $row->idmodulo=="2"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                                }
                              endforeach; ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <h3>Permisos Acciones de Brigadista</h3>
                  <?php foreach($permisos->result() as $row):
                          		if($row->tipo=="2" and $row->idmodulo=="2"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                                }
                              endforeach; ?>
                </div>
              </div>
              <div id="menu2" class="tab-pane fade in">
                <br />
                <div class="clearfix"></div>
                <div class="col-xs-12">
                  <h3>Men&uacute; Principal</h3>
                  <?php foreach($tablero as $row): ?>
                  <div class="col-xs-12 col-sm-4">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                        value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                    <?php if($row->nivel==1){
                             foreach($row->subMenu as $rowS): ?>
                    <div class="col-xs-12">
                      <div class="checkbox checkbox-primary">
                      <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                          rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$rowS->descripcion?></label></div>
                    </div>
                    <?php endforeach;
                           } ?>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <div id="menu6" class="tab-pane fade in">
                <br />
                <div class="clearfix"></div>
                <div class="col-xs-12">
                  <h3>Men&uacute; Principal</h3>
                  <?php foreach($planes as $row): ?>
                  <div class="col-xs-12 col-sm-4">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                        value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                    <?php if($row->nivel==1){
                             foreach($row->subMenu as $rowS): ?>
                    <div class="col-xs-12">
                      <div class="checkbox checkbox-primary">
                      <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                          rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                    </div>
                    <?php endforeach;
                           } ?>
                  </div>
                  <?php endforeach; ?>
                </div>
                <br />
                <div class="col-sm-4 col-xs-12">
                  <h3>Permisos Acciones de Planes</h3>
                  <?php foreach($permisos->result() as $row):
                      		if($row->tipo=="1" and $row->idmodulo=="4"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                            }
                          endforeach; ?>

                </div>
              </div>
              <div id="menu4" class="tab-pane fade in">
                <br />
                <div class="clearfix"></div>
                <div class="col-xs-12">
                  <h3>Men&uacute; Principal</h3>
                  <?php foreach($ofertamovil as $row): ?>
                  <div class="col-xs-12 col-sm-4">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                        value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                    <?php if($row->nivel==1){
                             foreach($row->subMenu as $rowS): ?>
                    <div class="col-xs-12">
                      <div class="checkbox checkbox-primary">
                      <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                          rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                    </div>
                    <?php endforeach;
                           } ?>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <h3>Permisos Registro de Oferta Movil</h3>
                  <?php foreach($permisos->result() as $row):
                        if($row->tipo=="1" and $row->idmodulo=="10"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                          }
                        endforeach; ?>
                </div>
              </div>
              <div id="menu5" class="tab-pane fade in">
                <br />
                <div class="clearfix"></div>
                <div class="col-xs-12">

                  <h3>Men&uacute; Principal</h3>
                  <?php foreach($emergenciasSanitarias as $row): ?>
                  <div class="col-xs-12 col-sm-4">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                        value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                    <?php if($row->nivel==1){
                             foreach($row->subMenu as $rowS): ?>
                    <div class="col-xs-12">
                      <div class="checkbox checkbox-primary">
                      <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                          rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                    </div>
                    <?php endforeach;
                           } ?>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <h3>Permisos Registro de Emergencias</h3>
                  <?php foreach($permisos->result() as $row):
                        if($row->tipo=="1" and $row->idmodulo=="8"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                          }
                        endforeach; ?>
                </div>
              </div>
              <div id="menu7" class="tab-pane fade in">
                <br />
                <div class="clearfix"></div>
                <div class="col-xs-12">
                  <h3>Men&uacute; Principal</h3>
                  <?php foreach($hospitalesSeguros as $row): ?>
                  <div class="col-xs-12 col-sm-4">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                        value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                    <?php if($row->nivel==1){
                             foreach($row->subMenu as $rowS): ?>
                    <div class="col-xs-12">
                      <div class="checkbox checkbox-primary">
                      <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                          rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                    </div>
                    <?php endforeach;
                           } ?>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <h3>Permisos Registro de Hospitales</h3>
                  <?php foreach($permisos->result() as $row):
                          if($row->tipo=="1" and $row->idmodulo=="9"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                            }
                          endforeach; ?>
                </div>
              </div>
              <div id="menu8" class="tab-pane fade in">
                <br />
                <div class="clearfix"></div>
                <div class="col-xs-12">
                  <h3>Men&uacute; Principal</h3>
                  <?php foreach($usuarios as $row): ?>
                  <div class="col-xs-12 col-sm-4">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                        value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                    <?php if($row->nivel==1){
                             foreach($row->subMenu as $rowS): ?>
                    <div class="col-xs-12">
                      <div class="checkbox checkbox-primary">
                      <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                          rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                    </div>
                    <?php endforeach;
                           } ?>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <h3>Permisos Registro de Usuarios</h3>
                  <?php foreach($permisos->result() as $row):
                          		if($row->tipo=="1" and $row->idmodulo=="6"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                                }
                              endforeach; ?>
                </div>
              </div>
              <div id="menu9" class="tab-pane fade in">
                <br />
                <div class="clearfix"></div>
                <div class="col-xs-12">
                  <h3>Men&uacute; Principal</h3>
                  <?php foreach($contingencias as $row): ?>
                  <div class="col-xs-12 col-sm-4">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                        value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                    <?php if($row->nivel==1){
                             foreach($row->subMenu as $rowS): ?>
                    <div class="col-xs-12">
                      <div class="checkbox checkbox-primary">
                      <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                          rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                    </div>
                    <?php endforeach;
                           } ?>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <h3>Permisos Registro de Planes de Contingencia</h3>
                  <?php foreach($permisos->result() as $row):
                          		if($row->tipo=="1" and $row->idmodulo=="15"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                                }
                              endforeach; ?>
                </div>
              </div>
              <div id="menu10" class="tab-pane fade in">
                <br />
                <div class="clearfix"></div>
                <div class="col-xs-12">
                  <h3>Men&uacute; Principal</h3>
                  <?php foreach($inventarios as $row): ?>
                  <div class="col-xs-12 col-sm-4">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                        value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                    <?php if($row->nivel==1){
                             foreach($row->subMenu as $rowS): ?>
                    <div class="col-xs-12">
                      <div class="checkbox checkbox-primary">
                      <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                          rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                    </div>
                    <?php endforeach;
                           } ?>
                  </div>
                  <?php endforeach; ?>
                </div>
                <!--
                <div class="col-sm-4 col-xs-12">
                  <h3>Permisos Registro de Inventarios</h3>
                  <?php foreach($permisos->result() as $row):
                          		if($row->tipo=="1" and $row->idmodulo=="14"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for=""><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                                }
                              endforeach; ?>
                </div>
                            -->
              </div>
              <div id="menu11" class="tab-pane fade in">
                <br />
                <div class="clearfix"></div>
                <div class="col-xs-12">
                  <h3>Men&uacute; Principal</h3>
                  <?php foreach($coronavirus as $row): ?>
                  <div class="col-xs-12 col-sm-4">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                        value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                    <?php if($row->nivel==1){
                             foreach($row->subMenu as $rowS): ?>
                    <div class="col-xs-12">
                      <div class="checkbox checkbox-primary">
                      <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                          rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                    </div>
                    <?php endforeach;
                           } ?>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <h3>Permisos Especiales COVID-19</h3>
                  <?php foreach($permisos->result() as $row):
                          		if($row->tipo=="1" and $row->idmodulo=="18"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for="chkPermiso<?=$row->idpermiso?>"><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                                }
                              endforeach; ?>
                </div>
              </div>
              <div id="menu12" class="tab-pane fade in">
                <br />
                <div class="clearfix"></div>
                <div class="col-xs-12">
                  <h3>Men&uacute; Principal</h3>
                  <?php foreach($farmacia as $row): ?>
                  <div class="col-xs-12 col-sm-4">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class=menuUsuario id="chkMenu<?=$row->idmenu?>"
                        value="<?=$row->idmenu?>" /><label for="chkMenu<?=$row->idmenu?>"><?=$row->descripcion?></label></div>
                    <?php if($row->nivel==1){
                             foreach($row->subMenu as $rowS): ?>
                    <div class="col-xs-12">
                      <div class="checkbox checkbox-primary">
                      <input type="checkbox" class="subMenu" id="chkSubMenu<?=$rowS->idmenudetalle?>"
                          rel="<?=$rowS->idmenu?>" value="<?=$rowS->idmenudetalle?>" /><label for="chkSubMenu<?=$rowS->idmenudetalle?>"><?=$rowS->descripcion?></label></div>
                    </div>
                    <?php endforeach;
                           } ?>
                  </div>
                  <?php endforeach; ?>
                </div>
                <!--<div class="col-sm-4 col-xs-12">
                  <h3>Permisos Registro de Inventarios</h3>
                  <?php foreach($permisos->result() as $row):
                          		if($row->tipo=="1" and $row->idmodulo=="19"){ ?>
                  <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="menuPermiso" id="chkPermiso<?=$row->idpermiso?>"
                        value="<?=$row->idpermiso?>" /><label for=""><?=$row->descripcion?></label></div>
                  </div>
                  <?php
                                }
                              endforeach; ?>
               </div>-->
              </div>
            </div>
            <div class="clearfix"></div>
            <br />
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
          <button id="btnPermisos" class="btn btn-info">Otorgar Permisos</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="disableModal" tabindex="-1" role="dialog" aria-labelledby="activateModal">
    <div class="modal-dialog" role="document">
      <form action="<?=base_url()?>usuarios/main/desactivar" method="POST">
        <input type="hidden" name="Codigo_Usuario" value="" readonly />
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Desactivar Usuario</h5>
          </div>
          <div class="modal-body">
            &iquest;Seguro(a) desea Desactivar al usuario <strong id="usuario"></strong>?
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-info">Desactivar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="enableModal" tabindex="-1" role="dialog" aria-labelledby="activateModal">
    <div class="modal-dialog" role="document">
      <form action="<?=base_url()?>usuarios/main/activar" method="POST">
        <input type="hidden" name="Codigo_Usuario" value="" readonly />
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Activar Usuario</h5>
          </div>
          <div class="modal-body">
            &iquest;Seguro(a) desea Activar al usuario <strong id="usuario"></strong>?
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-info">Activar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTablero">
    <div class="modal-dialog" role="document">
      <form action="<?=base_url()?>usuarios/main/eliminar" method="POST">
        <input type="hidden" name="Codigo_Usuario" value="" readonly />
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Eliminar Usuario</h5>
          </div>
          <div class="modal-body">
            &iquest;Seguro(a) desea Borrar al usuario <strong id="eliminar_usuario"></strong>?
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-info">Borrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel">
    <div class="modal-dialog" role="document">
      <form id="formPassword" action="<?=base_url()?>usuarios/main/password" method="POST">
        <input type="hidden" name="Codigo_Usuario" value="" readonly />
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Contrase&ntilde;a Usuario</h5>
          </div>
          <div class="modal-body">
            <div class="row">
              <input type="hidden" name="Codigo_Usuario" />
              <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                <div class="form-group">
                  <label class="">Contrase&ntilde;a</label> <input type="password" class="form-control" name="password"
                    id="password" />
                </div>
              </div>
              <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                <div class="form-group">
                  <label class="">Repetir</label> <input type="password" class="form-control" name="re_password" />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-info">Cambiar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="registrarModal" tabindex="-1" role="dialog" aria-labelledby="registrarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="registrarTableroModalLabel">Registrar Usuario</h5>
        </div>
        <form id="formRegistrar" name="formRegistrar" action="<?=base_url()?>usuarios/main/registrar" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Usuario</label>
                  <input type="text" class="form-control text-lowercase" name="Usuario" />
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">DNI</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="DNI" autocomplete="off">
                    <span class="input-group-btn">
                      <button type="button" id="btn-buscar" class="btn btn-info"><i class="fa fa-search"
                          aria-hidden="true"></i></button>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Apellidos</label>
                  <input type="text" class="form-control text-uppercase" name="Apellidos" readonly />
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Nombres</label>
                  <input type="text" class="form-control text-uppercase" name="Nombres" readonly />
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Perfil</label> <select name="Codigo_Perfil" class="form-control">
                    <option value="">[Seleccione...]</option>
                    <?php foreach($listaPerfil->result() as $row): ?>
                    <option value="<?=$row->Codigo_Perfil?>"><?=$row->Descripcion_Perfil?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Regi&oacute;n</label> <select name="Codigo_Region" class="form-control">
                    <option value="">[Seleccione...]</option>
                    <?php foreach($listaRegion->result() as $row): ?>
                    <option value="<?=$row->Codigo_Region?>"><?=$row->Nombre_Region?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title">Editar Usuario</h5>
        </div>
        <form id="formActualizar" action="<?=base_url()?>usuarios/main/actualizar" method="POST">
          <div class="modal-body">
            <input type="hidden" name="Codigo_Usuario" id="Codigo_Usuario" />
            <div class="row">

              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Usuario</label> <input type="text" class="form-control text-lowercase" name="Usuario"
                    id="Usuario" />
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">DNI</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="DNI" id="DNI" autocomplete="off">
                    <span class="input-group-btn">
                      <button type="button" id="btn-buscar2" class="btn btn-info"><i class="fa fa-search"
                          aria-hidden="true"></i></button>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Apellidos</label>
                  <input type="text" class="form-control text-uppercase" name="Apellidos" id="Apellidos" readonly />
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Nombres</label>
                  <input type="text" class="form-control text-uppercase" name="Nombres" id="Nombres" readonly />
                </div>
              </div>
              <div class="col-xs-12" id="ocultar">
                <div class="form-group">
                  <label class="">Perfil</label> <select name="Codigo_Perfil" id="Codigo_Perfil" class="form-control">
                    <option value="">[Seleccione...]</option>
                    <?php foreach($listaPerfil->result() as $row): ?>
                    <option value="<?=$row->Codigo_Perfil?>"><?=$row->Descripcion_Perfil?></option>
                    <?php endforeach; ?>
                  </select>
                  <small><i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i> Cambiar de perfil
                    eliminar&aacute; los permisos actuales</small>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="">Regi&oacute;n</label> <select name="Codigo_Region" id="Codigo_Region"
                    class="form-control">
                    <option value="">[Seleccione...]</option>
                    <?php foreach($listaRegion->result() as $row): ?>
                    <option value="<?=$row->Codigo_Region?>"><?=$row->Nombre_Region?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="areasModal" tabindex="-1" role="dialog" aria-labelledby="areasModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title">Lista de &Aacute;reas</h5>
        </div>
        <form id="formInsertarAreas" action="<?=base_url()?>usuarios/main/areas" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group col-md-4">
                  <label for="Anio_Ejecucion">A&ntilde;o</label> <select name="Anio_Ejecucion" id="Anio_Ejecucion"
                    class="form-control">
                    <option value="">[Seleccione...]</option>
                    <?php foreach($listaAnioEjecucion->result() as $row): ?>
                    <option value="<?=$row->Anio_Ejecucion?>"><?=$row->Anio_Ejecucion?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="Codigo_Sector">Sector</label> <select name="Codigo_Sector" id="Codigo_Sector"
                    class="form-control">
                    <option value="">[Seleccione A&ntilde;o...]</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="Codigo_Pliego">Pliego</label> <select name="Codigo_Pliego" id="Codigo_Pliego"
                    class="form-control">
                    <option value="">[Seleccione Sector...]</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="Codigo_Ejecutora">Ejecutora</label> <select name="Codigo_Ejecutora" id="Codigo_Ejecutora"
                    class="form-control">
                    <option value="">[Seleccione Pliego...]</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="Codigo_Centro_Costos">Centro de Costos</label> <select name="Codigo_Centro_Costos"
                    id="Codigo_Centro_Costos" class="form-control detalle-size">
                    <option value="">[Seleccione Ejecutora...]</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="Codigo_Sub_Centro_Costos">Sub Centro de Costos</label>
                  <select name="Codigo_Sub_Centro_Costos" id="Codigo_Sub_Centro_Costos"
                    class="form-control detalle-size">
                    <option value="">[Seleccione Centro de Costos...]</option>
                  </select>
                </div>
              </div>
              <input type="hidden" name="Codigo_Usuario" />
              <div class="col-xs-12">
                <table id="tbAreas" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>C&oacute;digo</th>
                      <th>Nombre</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-basic" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="<?=base_url()?>public/js/usuarios/usuarios.js?v=<?=date("s")?>"></script>
  <script>
    usuarios("<?=base_url()?>", "<?=$this->session->userdata("Anio_Ejecucion")?>");
  </script>
</body>
</html>