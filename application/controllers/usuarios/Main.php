<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
	private $permisos = null;

    function __construct()
    {
        parent::__construct();

        $token = $this->session->userdata("token");

        (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY")):redirect("login");

        $this->session->set_userdata("idmodulo", 6);

        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");

        if(sha1($usuario)==$token->usuario){

            if (count($token->modulos)>0) {

                $listaModulos = $token->modulos;

                $permanecer = false;

                foreach ($listaModulos as $row) :
                if ($row->idmodulo == 6 and $row->estado == 1)
                    $permanecer = true;
                    endforeach
                    ;

                    if ($permanecer == false)
                        redirect('errores/accesoDenegado');
            } else {
                redirect("login");
            }
            if($this->permisos==null){ if($this->session->userdata("menu")) $this->permisos = $this->session->userdata("menu");}
        }else{
            redirect("login");
        }
    }

    public function index()
    {
        
        $nivel = 1;
        $idmenu = 14;

        validarPermisos($nivel,$idmenu,$this->permisos);

        $this->load->model("Usuario_model");
        $this->load->model("Perfil_model");
        $this->load->model("Region_model");
        $this->load->model("Area_model");
        $this->load->model("AnioEjecucion_model");
        $this->load->model("Menu_model");
        $this->load->model("AlertaPronostico_model");

        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        $Anio_Ejecucion = $this->session->userdata("Anio_Ejecucion");
        $Codigo_Usuario = $this->session->userdata("Codigo_Usuario");

        $this->Usuario_model->setAnio_Ejecucion($Anio_Ejecucion);

        $lista = $this->Usuario_model->lista();
        $listaPerfil = $this->Perfil_model->lista();
        $listaRegion = $this->Region_model->lista();
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();

        $this->Area_model->setAnio($Anio_Ejecucion);

        $menu = $this->Menu_model->listaMenuUsuario();
        $subMenu = $this->Menu_model->listaSubMenuUsuario();
        $permisos = $this->Menu_model->permisos();

        $eventos = array();
        $brigadistas = array();
        $tablero = array();
        $planes = array();
        $tablas = array();
        $usuarios = array();
        $emergenciasSanitarias = array();
        $hospitalesSeguros = array();
        $ofertamovil = array();
        $inventarios = array();
        $contingencias = array();
        $coronavirus = array();
        $farmacia = array();

        foreach($menu->result() as $row):

          switch($row->idmodulo){
            case 1:$eventos[] = $row;break;
            case 2:$brigadistas[] = $row;break;
            case 3:$tablero[] = $row;break;
            case 4:$planes[] = $row;break;
            case 5:$tablas[] = $row;break;
            case 6:$usuarios[] = $row;break;
            case 8:$emergenciasSanitarias[] = $row;break;
            case 9:$hospitalesSeguros[] = $row;break;
            case 10:$ofertamovil[] = $row;break;
            case 14:$inventarios[] = $row;break;
            case 15:$contingencias[] = $row;break;
            case 18:$coronavirus[] = $row;break;
            case 19:$farmacia[] = $row;break;
          }

        endforeach;

        $index = 0;

        foreach($eventos as $row):

          if($row->nivel==1){
            $this->Menu_model->setId($row->idmenu);
            $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
            $eventos[$index]->{"subMenu"} = $subMenuById->result();
          }
          $index++;
        endforeach;

        $index = 0;

        foreach($tablero as $row):

          if($row->nivel==1){
            $this->Menu_model->setId($row->idmenu);
            $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
            $tablero[$index]->{"subMenu"} = $subMenuById->result();
          }
          $index++;
        endforeach;
        
        $index = 0;
        
        foreach($brigadistas as $row):
        
            if($row->nivel==1){
                $this->Menu_model->setId($row->idmenu);
                $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
                $brigadistas[$index]->{"subMenu"} = $subMenuById->result();
            }
            $index++;
        endforeach;
        
        $index = 0;

        foreach($planes as $row):
        
        if($row->nivel==1){
            $this->Menu_model->setId($row->idmenu);
            $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
            $planes[$index]->{"subMenu"} = $subMenuById->result();
        }
        $index++;
        endforeach;
        
        $index = 0;
        
        foreach($hospitalesSeguros as $row):
        
        if($row->nivel==1){
            $this->Menu_model->setId($row->idmenu);
            $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
            $hospitalesSeguros[$index]->{"subMenu"} = $subMenuById->result();
        }
        $index++;
        endforeach;
        
        $index = 0;
        
        foreach($emergenciasSanitarias as $row):
        
        if($row->nivel==1){
            $this->Menu_model->setId($row->idmenu);
            $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
            $emergenciasSanitarias[$index]->{"subMenu"} = $subMenuById->result();
        }
        $index++;
        endforeach;
        
        $index = 0;
        
        foreach($ofertamovil as $row):
        
        if($row->nivel==1){
            $this->Menu_model->setId($row->idmenu);
            $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
            $ofertamovil[$index]->{"subMenu"} = $subMenuById->result();
        }
        $index++;
        endforeach;

        $index = 0;
        
        foreach($usuarios as $row):
        
        if($row->nivel==1){
            $this->Menu_model->setId($row->idmenu);
            $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
            $usuarios[$index]->{"subMenu"} = $subMenuById->result();
        }
        $index++;
        endforeach;

        $index = 0;
        
        foreach($inventarios as $row):
        
        if($row->nivel==1){
            $this->Menu_model->setId($row->idmenu);
            $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
            $inventarios[$index]->{"subMenu"} = $subMenuById->result();
        }
        $index++;
        endforeach;

        $index = 0;
        
        foreach($contingencias as $row):
        
        if($row->nivel==1){
            $this->Menu_model->setId($row->idmenu);
            $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
            $contingencias[$index]->{"subMenu"} = $subMenuById->result();
        }
        $index++;
        endforeach;

        $index = 0;
        
        foreach($coronavirus as $row):
        
        if($row->nivel==1){
            $this->Menu_model->setId($row->idmenu);
            $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
            $coronavirus[$index]->{"subMenu"} = $subMenuById->result();
        }
        $index++;
        endforeach;

        $index = 0;
        
        foreach($farmacia as $row):
        
        if($row->nivel==1){
            $this->Menu_model->setId($row->idmenu);
            $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
            $farmacia[$index]->{"subMenu"} = $subMenuById->result();
        }
        $index++;
        endforeach;

        $data = array(
            "lista" => $lista,
            "listaPerfil" => $listaPerfil,
            "listaRegion" => $listaRegion,
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "menu" => $menu,
            "subMenu" => $subMenu,
            "permisos" => $permisos,
            "eventos" => $eventos,
            "tablero" => $tablero,
            "brigadistas" => $brigadistas,
            "planes" => $planes,
            "ofertamovil" => $ofertamovil,
            "emergenciasSanitarias" => $emergenciasSanitarias,
            "hospitalesSeguros" => $hospitalesSeguros,
            "usuarios" => $usuarios,
            "inventarios" => $inventarios,
            "contingencias" => $contingencias,
            "coronavirus" => $coronavirus,
            "farmacia" => $farmacia,
            "listaralerta" => $listaralerta
        );

        $this->load->view("usuarios/usuarios", $data);
    }

    public function areasUsuario()
    {
        $this->load->model("Area_model");

        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Sector = $this->input->post("Codigo_Sector");
        $Codigo_Pliego = $this->input->post("Codigo_Pliego");
        $Codigo_Ejecutora = $this->input->post("Codigo_Ejecutora");
        $Codigo_Centro_Costos = $this->input->post("Codigo_Centro_Costos");
        $Codigo_Sub_Centro_Costos = $this->input->post("Codigo_Sub_Centro_Costos");
        $Codigo_Usuario = $this->input->post("Codigo_Usuario");

        $this->Area_model->setAnio($Anio_Ejecucion);
        $this->Area_model->setSector($Codigo_Sector);
        $this->Area_model->setPliego($Codigo_Pliego);
        $this->Area_model->setEjecutora($Codigo_Ejecutora);
        $this->Area_model->setCentroCostos($Codigo_Centro_Costos);
        $this->Area_model->setSubCentroCostos($Codigo_Sub_Centro_Costos);
        $this->Area_model->setCodigo_Usuario($Codigo_Usuario);
        $listaAreas = $this->Area_model->areasByAnioByUsuarioCompleto();

        echo json_encode($listaAreas->result());
    }

    public function areas()
    {
        $this->load->model("Area_model");

        $Anio_Ejecucion = $this->session->userdata("Anio_Ejecucion");
        $Codigo_Usuario = $this->input->post("Codigo_Usuario");
        $areas = $this->input->post("chk_areas[]");

        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $Codigo_Sector = $this->input->post("Codigo_Sector");
        $Codigo_Pliego = $this->input->post("Codigo_Pliego");
        $Codigo_Ejecutora = $this->input->post("Codigo_Ejecutora");
        $Codigo_Centro_Costos = $this->input->post("Codigo_Centro_Costos");
        $Codigo_Sub_Centro_Costos = $this->input->post("Codigo_Sub_Centro_Costos");

        $this->Area_model->setAnio($Anio_Ejecucion);
        $this->Area_model->setCodigo_Usuario($Codigo_Usuario);

        $this->Area_model->setCodigo_Sector($Codigo_Sector);
        $this->Area_model->setCodigo_Pliego($Codigo_Pliego);
        $this->Area_model->setCodigo_Ejecutora($Codigo_Ejecutora);
        $this->Area_model->setCodigo_Centro_Costos($Codigo_Centro_Costos);
        $this->Area_model->setCodigo_Sub_Centro_Costos($Codigo_Sub_Centro_Costos);

        $this->Area_model->eliminarUsuarioAreas();

        $mensaje="No hay &aacute;reas seleccionadas";
        $tipo = 'mensajeWarning';
        if(!empty($areas)){
          foreach ($areas as $area) :
              $this->Area_model->setId($area);
              $this->Area_model->registrarUsuariosAreas();
          endforeach;
          $mensaje = 'Las &aacute;reas han sido registradas';
          $tipo = 'mensajeSuccess';
        }

        $this->session->set_flashdata($tipo, $mensaje);
        header("location:" . base_url() . "usuarios/usuario");
    }

    public function registrar()
    {
        $this->load->model("Usuario_model");

        $Nuevo_Codigo = $this->Usuario_model->generarCodigo();

        $Nuevo_Codigo = addCeros4($Nuevo_Codigo);

        $Usuario = $this->input->post("Usuario");
        $DNI = $this->input->post("DNI");
        $Apellidos = $this->input->post("Apellidos");
        $Nombres = $this->input->post("Nombres");
        $Codigo_Perfil = $this->input->post("Codigo_Perfil");
        $Codigo_Region = $this->input->post("Codigo_Region");

        $this->Usuario_model->setCodigo_Usuario($Nuevo_Codigo);
        $this->Usuario_model->setUsuario($Usuario);
        $this->Usuario_model->setDNI($DNI);
        $this->Usuario_model->setApellidos($Apellidos);
        $this->Usuario_model->setNombres($Nombres);
        $this->Usuario_model->setCodigo_Perfil($Codigo_Perfil);
        $this->Usuario_model->setCodigo_Region($Codigo_Region);

        if (! $this->Usuario_model->existe()) {

            if ($this->Usuario_model->registrar()) {
                $this->session->set_flashdata('mensajeSuccess', 'Usuario registrado con exito');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo registrar el usuario');
            }
        } else {

            $this->session->set_flashdata('mensajeWarning', 'El usuario ya existe, elija otro');
        }

        header("location:" . base_url() . "usuarios/usuario");
    }

    public function password()
    {
        $this->load->model("Usuario_model");

        $password = $this->input->post("password");
        $Codigo_Usuario = $this->input->post("Codigo_Usuario");

        $this->Usuario_model->setPassword($password);
        $this->Usuario_model->setCodigo_Usuario($Codigo_Usuario);

        if ($this->Usuario_model->password2() == 1) {
            $this->session->set_flashdata('mensajeSuccess', 'La clave ha sido actualizada');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se pudo actualizar la clave');
        }

        header("location:" . base_url() . "usuarios/usuario");
    }

    public function actualizar()
    {
        $this->load->model("Usuario_model");

        $Codigo_Usuario = $this->input->post("Codigo_Usuario");
        $Usuario = $this->input->post("Usuario");
        $DNI = $this->input->post("DNI");
        $Apellidos = $this->input->post("Apellidos");
        $Nombres = $this->input->post("Nombres");
        $Codigo_Perfil = $this->input->post("Codigo_Perfil");
        $Codigo_Region = $this->input->post("Codigo_Region");

        $session_Codigo_Usuario = $this->session->userdata("Codigo_Usuario");

        $this->Usuario_model->setCodigo_Usuario($Codigo_Usuario);
        $this->Usuario_model->setUsuario($Usuario);
        $this->Usuario_model->setDNI($DNI);
        $this->Usuario_model->setApellidos($Apellidos);
        $this->Usuario_model->setNombres($Nombres);
        if ($Codigo_Usuario == '0001')
            $Codigo_Perfil = '01';

        $this->Usuario_model->setCodigo_Perfil($Codigo_Perfil);
        $this->Usuario_model->setCodigo_Region($Codigo_Region);
        
        $result = $this->Usuario_model->perfilByID();
        $row = $result->row();
        $Perfil_Anterior = $row->Codigo_Perfil;
        
        if($Perfil_Anterior!=$Codigo_Perfil) $this->eliminarTodosPermisos($Codigo_Usuario);
        
        if (! $this->Usuario_model->existeByCodigo()) {

            if ($this->Usuario_model->actualizar()) {
                $this->session->set_flashdata('mensajeSuccess', 'Usuario actualizado con exito');
            } else {
                $this->session->set_flashdata('mensajeError', 'No se pudo actualizar el usuario');
            }
        } else {

            $this->session->set_flashdata('mensajeWarning', 'El usuario ya existe, elija otro');
        }

        header("location:" . base_url() . "usuarios/usuario");
    }

    public function desactivar()
    {
        $this->load->model("Usuario_model");

        $Codigo_Usuario = $this->input->post("Codigo_Usuario");

        $this->Usuario_model->setCodigo_Usuario($Codigo_Usuario);

        if ($this->Usuario_model->desactivar() == 1) {
            $this->session->set_flashdata('mensajeSuccess', 'Usuario desactivado con exito');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se pudo desactivar al usuario');
        }

        header("location:" . base_url() . "usuarios/usuario");
    }

    public function activar()
    {
        $this->load->model("Usuario_model");

        $Codigo_Usuario = $this->input->post("Codigo_Usuario");

        $this->Usuario_model->setCodigo_Usuario($Codigo_Usuario);

        if ($this->Usuario_model->activar() == 1) {
            $this->session->set_flashdata('mensajeSuccess', 'Usuario activado con exito');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se pudo activar al usuario');
        }

        header("location:" . base_url() . "usuarios/usuario");
    }

    public function permisos(){

        $this->load->model("Menu_model");

        $idusuario = $this->input->post("idusuario");

        $this->Menu_model->setIdUsusario($idusuario);

        $menu = $this->Menu_model->permisosMenu();
        $subMenu = $this->Menu_model->permisosSubMenu();
        $permisos = $this->Menu_model->permisosDetalle();

        $eventos = array();
        $brigadistas = array();
        $tablero = array();
        $planes = array();
        $tablas = array();
        $emergenciasSanitarias = array();
        $hospitalesSeguros = array();
        $ofertamovil = array();
        $usuarios = array();
        $inventarios = array();
        $contingencias = array();
        $coronavirus = array();
        $farmacia = array();

        foreach($menu->result() as $row):

          switch($row->idmodulo){
            case 1:$eventos[] = $row;break;
            case 2:$brigadistas[] = $row;break;
            case 3:$tablero[] = $row;break;
            case 4:$planes[] = $row;break;
            case 5:$tablas[] = $row;break;
            case 6:$usuarios[] = $row;break;
            case 8:$emergenciasSanitarias[] = $row;break;
            case 9:$hospitalesSeguros[] = $row;break;
            case 10:$ofertamovil[] = $row;break;
            case 14:$inventarios[] = $row;break;
            case 15:$contingencias[] = $row;break;
            case 18:$coronavirus[] = $row;break;
            case 19:$farmacia[] = $row;break;
          }

        endforeach;

        $index = 0;

        foreach($eventos as $row):

          if($row->nivel==1){
            $this->Menu_model->setId($row->idmenu);
            $subMenuById = $this->Menu_model->permisosSubMenuById();
            $eventos[$index]->{"subMenu"} = $subMenuById->result();
          }
        $index++;
      endforeach;

      $index = 0;

      foreach($tablero as $row):

        if($row->nivel==1){
          $this->Menu_model->setId($row->idmenu);
          $subMenuById = $this->Menu_model->permisosSubMenuById();
          $tablero[$index]->{"subMenu"} = $subMenuById->result();
        }
      $index++;
    endforeach;
    
    foreach($brigadistas as $row):
    
    if($row->nivel==1){
        $this->Menu_model->setId($row->idmenu);
        $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
        $brigadistas[$index]->{"subMenu"} = $subMenuById->result();
    }
    $index++;
    endforeach;
    
    foreach($planes as $row):
    
    if($row->nivel==1){
        $this->Menu_model->setId($row->idmenu);
        $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
        $planes[$index]->{"subMenu"} = $subMenuById->result();
    }
    $index++;
    endforeach;
    
    $index = 0;
    
    foreach($hospitalesSeguros as $row):
    
    if($row->nivel==1){
        $this->Menu_model->setId($row->idmenu);
        $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
        $hospitalesSeguros[$index]->{"subMenu"} = $subMenuById->result();
    }
    $index++;
    endforeach;
    
    $index = 0;
    
    foreach($emergenciasSanitarias as $row):
    
    if($row->nivel==1){
        $this->Menu_model->setId($row->idmenu);
        $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
        $emergenciasSanitarias[$index]->{"subMenu"} = $subMenuById->result();
    }
    $index++;
    endforeach;
    
    $index = 0;
    
    foreach($ofertamovil as $row):
    
    if($row->nivel==1){
        $this->Menu_model->setId($row->idmenu);
        $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
        $ofertamovil[$index]->{"subMenu"} = $subMenuById->result();
    }
    $index++;
    endforeach;

    $index = 0;
    
    foreach($usuarios as $row):
    
    if($row->nivel==1){
        $this->Menu_model->setId($row->idmenu);
        $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
        $usuarios[$index]->{"subMenu"} = $subMenuById->result();
    }
    $index++;
    endforeach;

    $index = 0;
    
    foreach($inventarios as $row):
    
    if($row->nivel==1){
        $this->Menu_model->setId($row->idmenu);
        $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
        $inventarios[$index]->{"subMenu"} = $subMenuById->result();
    }
    $index++;
    endforeach;

    $index = 0;
    
    foreach($contingencias as $row):
    
    if($row->nivel==1){
        $this->Menu_model->setId($row->idmenu);
        $subMenuById = $this->Menu_model->permisosSubMenuById();
        $contingencias[$index]->{"subMenu"} = $subMenuById->result();
    }
    $index++;
    endforeach;

    $index = 0;
    
    foreach($coronavirus as $row):
    
    if($row->nivel==1){
        $this->Menu_model->setId($row->idmenu);
        $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
        $coronavirus[$index]->{"subMenu"} = $subMenuById->result();
    }
    $index++;
    endforeach;

    $index = 0;
    
    foreach($farmacia as $row):
    
    if($row->nivel==1){
        $this->Menu_model->setId($row->idmenu);
        $subMenuById = $this->Menu_model->listaSubMenuUsuarioById();
        $farmacia[$index]->{"subMenu"} = $subMenuById->result();
    }
    $index++;
    endforeach;

    $data = array(
        "menu"=>$menu->result(),
        "subMenu"=>$subMenu->result(),
        "permisos"=>$permisos->result(),
        "eventos"=>$eventos,
        "tablero"=>$tablero,
        "brigadistas"=>$brigadistas,
        "planes" => $planes,
        "ofertamovil" => $ofertamovil,
        "emergenciasSanitarias" => $emergenciasSanitarias,
        "hospitalesSeguros" => $hospitalesSeguros,
        "usuarios" => $usuarios,
        "inventarios" => $inventarios,
        "contingencias" => $contingencias,
        "coronavirus" => $coronavirus,
        "farmacia" => $farmacia
        
    );

      echo json_encode($data);

    }

    public function otorgarPermisos(){

        $menu = $this->input->post("menu");
        $subMenu = $this->input->post("subMenu");
        $permisos = $this->input->post("permisos");
        $idusuario = $this->input->post("idusuario");

        $this->load->model("Menu_model");

        foreach($menu as $row):
            $this->Menu_model->setId($row["idmenu"]);
            $this->Menu_model->setStatus($row["status"]);
            $this->Menu_model->setIdUsusario($idusuario);
            $this->Menu_model->otorgarPermisoMenu();

        endforeach;

        foreach($subMenu as $row):
        $this->Menu_model->setIdMenuDetalle($row["idmenudetalle"]);
        $this->Menu_model->setStatus($row["status"]);
        $this->Menu_model->setIdUsusario($idusuario);
        $this->Menu_model->otorgarPermisoSubMenu();

        endforeach;

        foreach($permisos as $row):
        $this->Menu_model->setIdPermiso($row["idpermiso"]);
        $this->Menu_model->setStatus($row["status"]);
        $this->Menu_model->setIdUsusario($idusuario);
        $this->Menu_model->otorgarPermiso();

        endforeach;

        echo json_encode(array("status"=>200));

    }
    
    private function eliminarTodosPermisos($Codigo_Usuario){
        
        $this->load->model("Menu_model");
        
        $this->Menu_model->setIdUsusario($Codigo_Usuario);
        
        $this->Menu_model->elimninarPermisosMenu();
        $this->Menu_model->elimninarPermisosMenuDetalle();
        $this->Menu_model->elimninarPermisosOpcion();
        
    }
}
