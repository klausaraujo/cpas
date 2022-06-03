<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller
{

    private $permisos = null;
    
    function __construct() {

      parent::__construct();
    
      $token = $this->session->userdata("token");
    
      (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY"),false):redirect("login");
    
      $this->session->set_userdata("idmodulo", 13);
    
      ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");
    
      if(sha1($usuario)==$token->usuario){
    
          if (count($token->modulos)>0) {
    
              $listaModulos = $token->modulos;
    
              $permanecer = false;
    
              foreach ($listaModulos as $row) :
              if ($row->idmodulo == 13 and $row->estado == 1)
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

    public function index() {

        $this->load->model("EventoTipo_model");
        $this->load->model("EventoNivel_model");
        $this->load->model("Ubigeo_model");
    
        $tipo = $this->EventoTipo_model->lista();
        $nivel = $this->EventoNivel_model->lista();
        $departamentos = $this->Ubigeo_model->departamentos();

        $data = array(
            "tipo" => $tipo->result(),
            "nivel" => $nivel->result(),
            "departamentos" => $departamentos->result()
        );

        $this->load->view("mapas/eventosMonitoreo", $data);
        
    }
	
	public function cargarProvincias()
    {
        $this->load->model("Ubigeo_model");
        
        $departamento = $this->input->post("departamento");
        
        $this->Ubigeo_model->setCodigo_Departamento($departamento);
        
        $lista = $this->Ubigeo_model->provincias();
        
        $data = array(
            "lista" => $lista->result()
        );
        
        echo json_encode($data);
    }

    public function cargarDistritos()
    {
        $this->load->model("Ubigeo_model");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        
        $this->Ubigeo_model->setCodigo_Departamento($departamento);
        $this->Ubigeo_model->setCodigo_Provincia($provincia);
        
        $lista = $this->Ubigeo_model->distritos();
        
        $data = array(
            "lista" => $lista->result()
        );
        
        echo json_encode($data);
    }
	
	public function cargarEvento()
    {
        $this->load->model("Evento_model");
        
        $tipoEvento = $this->input->post("tipoEvento");
        $lista = $this->Evento_model->setTipoEvento($tipoEvento);
        $lista = $this->Evento_model->listaTipo();
        
        $data = array(
            "lista" => $lista->result()
        );
        echo json_encode($data);
    }
    
    public function datosMapaEventosMonitoreo() {
        $this->load->model("EventoRegistrar_model");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        
        $nivelEmergencia = $this->input->post("nivelEmergencia");
        
        $tipoEvento = $this->input->post("tipoEvento");
        $evento = $this->input->post("evento");
        
        $desde = $this->input->post("desde");
        $hasta = $this->input->post("hasta");
        $tipoOcurrencia = $this->input->post("tipoOcurrencia");   
        $eventoConsolidado = $this->input->post("eventoConsolidado");

        $this->EventoRegistrar_model->setDepartamento($departamento);
        $this->EventoRegistrar_model->setProvincia($provincia);
        $this->EventoRegistrar_model->setDistrito($distrito);
        
        $this->EventoRegistrar_model->setNivelEmergencia($nivelEmergencia);
        
        $this->EventoRegistrar_model->setTipoEvento($tipoEvento);
        $this->EventoRegistrar_model->setEvento($evento);
        
        $this->EventoRegistrar_model->setFechaInicio(formatearFechaParaBD($desde));
        $this->EventoRegistrar_model->setFechaFin(formatearFechaParaBD($hasta));
        $this->EventoRegistrar_model->setOcurrencia($tipoOcurrencia);
        $this->EventoRegistrar_model->setEventoConsolidado($eventoConsolidado);
        
        $this->EventoRegistrar_model->setEstado(1);
        $mapaMonitoreo = $this->EventoRegistrar_model->mapaEventosFiltro();
        
        echo json_encode(array("registros"=>$mapaMonitoreo->result()));
    }

    public function datosMapaEventosAsociado() {
        $this->load->model("EventoRegistrar_model");
        
        $idAsociado = $this->input->post("asociado");

        $this->EventoRegistrar_model->setDepartamento($idAsociado);
        $mapaMonitoreo = $this->EventoRegistrar_model->mapaEventosAsociadoFiltro();
        
        echo json_encode(array("registros"=>$mapaMonitoreo->result()));
    }

    public function datosMapaEventosIpress() {
        
        $this->load->model("EventoRegistrar_model");
        
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        
        $nivelEmergencia = $this->input->post("nivelEmergencia");
        
        $tipoEvento = $this->input->post("tipoEvento");
        $evento = $this->input->post("evento");
        
        $desde = $this->input->post("desde");
        $hasta = $this->input->post("hasta");
        $tipoOcurrencia = $this->input->post("tipoOcurrencia");   
        $eventoConsolidado = $this->input->post("eventoConsolidado");

        $this->EventoRegistrar_model->setDepartamento($departamento);
        $this->EventoRegistrar_model->setProvincia($provincia);
        $this->EventoRegistrar_model->setDistrito($distrito);
        
        $this->EventoRegistrar_model->setNivelEmergencia($nivelEmergencia);
        
        $this->EventoRegistrar_model->setTipoEvento($tipoEvento);
        $this->EventoRegistrar_model->setEvento($evento);
        
        $this->EventoRegistrar_model->setFechaInicio(formatearFechaParaBD($desde));
        $this->EventoRegistrar_model->setFechaFin(formatearFechaParaBD($hasta));
        $this->EventoRegistrar_model->setOcurrencia($tipoOcurrencia);
        $this->EventoRegistrar_model->setEventoConsolidado($eventoConsolidado);
        
        $this->EventoRegistrar_model->setEstado(1);
        $mapaMonitoreo = $this->EventoRegistrar_model->mapaIpressFiltro();
        
        echo json_encode(array("registros"=>$mapaMonitoreo->result()));
    }
}
