<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Fichas extends CI_Controller
{
    private $permisos = null;

    function __construct()
    {
        parent::__construct();

        $token = $this->session->userdata("token");

        (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY")):redirect("login");

        $this->session->set_userdata("idmodulo", 1);

        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");

        if(sha1($usuario)==$token->usuario){

            if (count($token->modulos)>0) {

                $listaModulos = $token->modulos;

                $permanecer = false;

                foreach ($listaModulos as $row) :
                if ($row->idmodulo == 1 and $row->estado == 1)
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
	
	public function index(){
		
	}
	
	public function lista()
    {

      $nivel = 1;
      $idmenu = 1;

      validarPermisos($nivel,$idmenu,$this->permisos);
      
      $temporal = $this->session->flashdata('Evento_Registro_Numero');
      $Evento_Registro_Numero="";
      if(empty($temporal) and !isset($temporal)) $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
      else $Evento_Registro_Numero = $temporal;
      
      if(strlen($Evento_Registro_Numero)==0) header("location:" . base_url() . "eventos/eventos/lista");
      
      $this->load->model("EventoFichaAtencion_model");
      $this->load->model("EventoTipoEntidadAtencion_model");      
      $this->load->model("TipoDocumento_model");
      
      $this->EventoFichaAtencion_model->setEvento_Registro_Numero($Evento_Registro_Numero);
      
      $tipodocumento = $this->TipoDocumento_model->lista();
      $fichas = $this->EventoFichaAtencion_model->lista();      
      $rsEntidad = $this->EventoTipoEntidadAtencion_model->lista();
      
      $rsPaises = $this->EventoTipoEntidadAtencion_model->paises();
      $paises = $rsPaises->result();
      
        $data = array(
            "fichas" => $fichas,
            "Evento_Registro_Numero" => $Evento_Registro_Numero,
            "listaEntidadAtencion" => $rsEntidad->result(),
            "tipodocumento" => $tipodocumento,
            "paises" => json_encode($paises)
        );
        
        $this->load->view("eventos/listaFichas", $data);
    }
    
    public function registrar(){
        
        $this->load->model("EventoFichaAtencion_model");
		$this->load->model("EventoTipoEntidadAtencionOfertaMovil_model");
		
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $fechaApertura = $this->input->post("fechaApertura");
        
        $fa = explode(" ",$fechaApertura);
        $fechaA = formatearFechaParaBD($fa[0]) . " " . $fa[1] . ":00";
        
        $this->EventoFichaAtencion_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoFichaAtencion_model->setEvento_Ficha_Atencion_Fecha(formatearFechaParaBD($fa[0]));
        $rs = $this->EventoFichaAtencion_model->existe();
        
        $this->session->set_flashdata('Evento_Registro_Numero', $Evento_Registro_Numero);
        
        if($rs->num_rows()>0){
            $this->session->set_flashdata('messageError', 'Ya se ingreso una ficha con esa fecha');
        }else{
            
            $this->EventoFichaAtencion_model->setEvento_Ficha_Atencion_Fecha($fechaA);
			
			$this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Registro_Numero($Evento_Registro_Numero);
			$result = $this->EventoTipoEntidadAtencionOfertaMovil_model->lista();
			
			if($result->num_rows()>0){
				            
				if($this->EventoFichaAtencion_model->registrar()){
					$this->session->set_flashdata('messageOK', 'La ficha ha sido registrada');
				} else {
					$this->session->set_flashdata('messageError', 'Error al registrar la ficha');
				}				
			}else{				
				$this->session->set_flashdata('messageWarning', 'Debe agregar una oferta movil para crear la ficha');				
			}
        }
        header("location:" . base_url() . "eventos/fichas/lista");        
    }
    
    public function editar(){
        
        $this->load->model("EventoFichaAtencion_model");
        $id = $this->input->post("id");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $horaApertura = $this->input->post("horaApertura");
        $horaApertura = $horaApertura.":00";

        $this->EventoFichaAtencion_model->setId($id);
        $this->session->set_flashdata('Evento_Registro_Numero', $Evento_Registro_Numero);

        $this->EventoFichaAtencion_model->setEvento_Ficha_Atencion_Hora_Cierre($horaApertura);

            if($this->EventoFichaAtencion_model->editar()){
                $this->session->set_flashdata('messageOK', 'La ficha ha sido editada');
            } else {
                $this->session->set_flashdata('messageError', 'Error al editar la ficha');
            }

        header("location:" . base_url() . "eventos/fichas/lista");

    }
    
    public function registrarAtencion(){
        
        $this->load->model("EventoFichaAtencionDetalle_model");
        $this->load->model("EventoFichaAtencion_model");
        
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $Evento_Ficha_Atencion_ID = $this->input->post("Evento_Ficha_Atencion_ID");
        $Evento_Ficha_Atencion_Detalle_Paciente = $this->input->post("Evento_Ficha_Atencion_Detalle_Paciente");
        $Evento_Ficha_Atencion_Detalle_Paciente = strtoupper($Evento_Ficha_Atencion_Detalle_Paciente);

        $Tipo_Documento_Codigo = $this->input->post("Tipo_Documento_Codigo");
        $Evento_Ficha_Atencion_Detalle_DNI = $this->input->post("Evento_Ficha_Atencion_Detalle_DNI");
        $Evento_Ficha_Atencion_Detalle_Edad = $this->input->post("Evento_Ficha_Atencion_Detalle_Edad");
        $Evento_Ficha_Atencion_Detalle_Genero = $this->input->post("Evento_Ficha_Atencion_Detalle_Genero");
        
        $Evento_Ficha_Atencion_Detalle_Gestante = ($this->input->post("Evento_Ficha_Atencion_Detalle_Gestante")) ? $this->input->post("Evento_Ficha_Atencion_Detalle_Gestante") : "0";
        $Evento_Ficha_Atencion_Detalle_Personal_Salud = ($this->input->post("Evento_Ficha_Atencion_Detalle_Personal_Salud")) ? $this->input->post("Evento_Ficha_Atencion_Detalle_Personal_Salud") : "0";
        
        $Evento_Ficha_Atencion_Detalle_Procedencia = $this->input->post("Evento_Ficha_Atencion_Detalle_Procedencia");
        $Evento_Ficha_Atencion_Detalle_Clasificacion = $this->input->post("Evento_Ficha_Atencion_Detalle_Clasificacion");
        $Evento_Ficha_Atencion_Detalle_Inicio_Sintomas = $this->input->post("Evento_Ficha_Atencion_Detalle_Inicio_Sintomas");
        $fa = explode(" ",$Evento_Ficha_Atencion_Detalle_Inicio_Sintomas);
        $Evento_Ficha_Atencion_Detalle_Inicio_Sintomas = formatearFechaParaBD($fa[0]) . " " . $fa[1] . ":00";
        
        $Evento_Ficha_Atencion_Detalle_Diagnostico = $this->input->post("Evento_Ficha_Atencion_Detalle_Diagnostico");
        $Evento_Ficha_Atencion_Detalle_CIE10_Codigo = $this->input->post("Evento_Ficha_Atencion_Detalle_CIE10_Codigo");
        $Evento_Ficha_Atencion_Detalle_Hora_Atencion = $this->input->post("Evento_Ficha_Atencion_Detalle_Hora_Atencion");
        $Evento_Ficha_Atencion_Detalle_Hora_Atencion = $Evento_Ficha_Atencion_Detalle_Hora_Atencion.":00";
        
        $Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID = $this->input->post("Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID");
        
        $Evento_Ficha_Atencion_Detalle_Quimioprofilaxis = ($this->input->post("Evento_Ficha_Atencion_Detalle_Quimioprofilaxis")) ? $this->input->post("Evento_Ficha_Atencion_Detalle_Quimioprofilaxis") : "0";
        $Evento_Ficha_Atencion_Detalle_Vacuna = ($this->input->post("Evento_Ficha_Atencion_Detalle_Vacuna")) ? $this->input->post("Evento_Ficha_Atencion_Detalle_Vacuna") : "0";
        $Evento_Ficha_Atencion_Detalle_Medicamentos = ($this->input->post("Evento_Ficha_Atencion_Detalle_Medicamentos")) ? $this->input->post("Evento_Ficha_Atencion_Detalle_Medicamentos") : "0";
        
        $Evento_Ficha_Atencion_Detalle_Destino = $this->input->post("Evento_Ficha_Atencion_Detalle_Destino");
        $Evento_Ficha_Atencion_Detalle_Lugar_Traslado = $this->input->post("Evento_Ficha_Atencion_Detalle_Lugar_Traslado");
        $Evento_Ficha_Atencion_Detalle_Responsable = $this->input->post("Evento_Ficha_Atencion_Detalle_Responsable");
        
        $Evento_Ficha_Atencion_Pais_Procedencia = $this->input->post("Evento_Ficha_Atencion_Pais_Procedencia");
        $Evento_Ficha_Atencion_Lugar_Residencia = $this->input->post("Evento_Ficha_Atencion_Lugar_Residencia");
        
        $this->EventoFichaAtencion_model->setId($Evento_Ficha_Atencion_ID);
        $rs = $this->EventoFichaAtencion_model->EventoFichaAtencion();
        $rsF = $rs->row();
        
        $Evento_Ficha_Atencion_Fecha = $rsF->Evento_Ficha_Atencion_Fecha;
        $Evento_Ficha_Atencion_Detalle_Hora_Atencion = $Evento_Ficha_Atencion_Fecha." ".$Evento_Ficha_Atencion_Detalle_Hora_Atencion;
        
        $this->EventoFichaAtencionDetalle_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_ID($Evento_Ficha_Atencion_ID);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Paciente($Evento_Ficha_Atencion_Detalle_Paciente);
        $this->EventoFichaAtencionDetalle_model->setTipo_Documento_Codigo($Tipo_Documento_Codigo);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_DNI($Evento_Ficha_Atencion_Detalle_DNI);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Edad($Evento_Ficha_Atencion_Detalle_Edad);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Genero($Evento_Ficha_Atencion_Detalle_Genero);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Gestante($Evento_Ficha_Atencion_Detalle_Gestante);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Personal_Salud($Evento_Ficha_Atencion_Detalle_Personal_Salud);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Procedencia($Evento_Ficha_Atencion_Detalle_Procedencia);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Clasificacion($Evento_Ficha_Atencion_Detalle_Clasificacion);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Inicio_Sintomas($Evento_Ficha_Atencion_Detalle_Inicio_Sintomas);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Diagnostico($Evento_Ficha_Atencion_Detalle_Diagnostico);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_CIE10_Codigo($Evento_Ficha_Atencion_Detalle_CIE10_Codigo);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Hora_Atencion($Evento_Ficha_Atencion_Detalle_Hora_Atencion);
        $this->EventoFichaAtencionDetalle_model->setEvento_Tipo_Entidad_Atencion_Oferta_Movil_ID($Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Vacuna($Evento_Ficha_Atencion_Detalle_Vacuna);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Quimioprofilaxis($Evento_Ficha_Atencion_Detalle_Quimioprofilaxis);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Medicamentos($Evento_Ficha_Atencion_Detalle_Medicamentos);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Destino($Evento_Ficha_Atencion_Detalle_Destino);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Lugar_Traslado($Evento_Ficha_Atencion_Detalle_Lugar_Traslado);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Responsable($Evento_Ficha_Atencion_Detalle_Responsable);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Pais_Procedencia($Evento_Ficha_Atencion_Pais_Procedencia);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Lugar_Residencia($Evento_Ficha_Atencion_Lugar_Residencia);

        if($this->EventoFichaAtencionDetalle_model->registrar()) $this->session->set_flashdata('messageOK', 'La atenci&oacute;n ha sido registrada');
        else $this->session->set_flashdata('messageError', 'Error al intentar registrar, vuelva a intentar');
        
        $this->session->set_flashdata('Evento_Registro_Numero', $Evento_Registro_Numero);
        header("location:" . base_url() . "eventos/fichas/lista");

    }

    public function listaOfertasMovilByEntidad(){
        
        $this->load->model("EventoTipoEntidadAtencionOfertaMovil_model");
        
        $Evento_Tipo_Entidad_Atencion_ID = $this->input->post("Evento_Tipo_Entidad_Atencion_ID");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");        
        
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Tipo_Entidad_Atencion_ID($Evento_Tipo_Entidad_Atencion_ID);
        $this->EventoTipoEntidadAtencionOfertaMovil_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        
        $rs = $this->EventoTipoEntidadAtencionOfertaMovil_model->listaByEntidad();
        
        echo json_encode(array("lista"=>$rs->result()));
    }
    
    public function cerrar(){
         
        $this->load->model("EventoFichaAtencion_model");
        $id = $this->input->post("id");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $horaCierre = $this->input->post("horaCierre");
        
        if( strlen($horaCierre)<1 ){
            $horaCierre = date("H:i");
        }
        $horaCierre = $horaCierre.":00";
        
        $this->EventoFichaAtencion_model->setId($id);
        $this->session->set_flashdata('Evento_Registro_Numero', $Evento_Registro_Numero);
        
        $this->EventoFichaAtencion_model->setEvento_Ficha_Atencion_Hora_Cierre($horaCierre);
        
        if($this->EventoFichaAtencion_model->cerrar()){
            $this->session->set_flashdata('messageOK', 'La ficha ha sido cerrada');
        } else {
            $this->session->set_flashdata('messageError', 'Error al cerrar la ficha');
        }
        
        header("location:" . base_url() . "eventos/fichas/lista");
        
    }

    public function abrir(){

        $this->load->model("EventoFichaAtencion_model");

        $id = $this->input->post("id");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");

        $this->EventoFichaAtencion_model->setId($id);

        $this->session->set_flashdata('Evento_Registro_Numero', $Evento_Registro_Numero);

        if($this->EventoFichaAtencion_model->abrir()){
            $this->session->set_flashdata('messageOK', 'La ficha ha sido re-abierta');
        } else {
            $this->session->set_flashdata('messageError', 'Error al re-abrir la ficha');
        }

        header("location:" . base_url() . "eventos/fichas/lista");
        
    }
    
    public function eliminar(){
        
        $this->load->model("EventoFichaAtencion_model");
        $this->load->model("EventoFichaAtencionDetalle_model");
        
        $id = $this->input->post("id");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_ID($id);
        $this->EventoFichaAtencion_model->setId($id);
        
        $rs = $this->EventoFichaAtencionDetalle_model->contarByFicha();
        $rsR = $rs->row();
        
        $this->session->set_flashdata('Evento_Registro_Numero', $Evento_Registro_Numero);
        
        if($rsR->total>0){
            $this->session->set_flashdata('messageError', 'Esta ficha tiene atenciones, no se puede eliminar');
        }
        else{
            if($this->EventoFichaAtencion_model->eliminar()) $this->session->set_flashdata('messageOK', 'La ficha ha sido eliminada');
            else $this->session->set_flashdata('messageError', 'Error al eliminar la ficha');

        }

        header("location:" . base_url() . "eventos/fichas/lista");
        
    }
    
    public function consolidado(){
        
        $this->load->model("EventoFichaAtencionDetalle_model");
        $this->load->model("EventoTipoEntidadAtencion_model");
        $this->load->model("TipoDocumento_model");
        
        $temporal1 = $this->session->flashdata('id');
        $temporal2 = $this->session->flashdata('Evento_Registro_Numero');
        $id = "";
        $Evento_Registro_Numero = "";
        if(empty($temporal1) and !isset($temporal1)) $id = $this->input->post("id");
        else $id = $temporal1;
        
        if(empty($temporal2) and !isset($temporal2)) $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        else $Evento_Registro_Numero = $temporal2;     
        
        if(strlen($Evento_Registro_Numero)==0 || strlen($id)==0) header("location:" . base_url() . "eventos/eventos/lista");
        
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_ID($id);
        $rs = $this->EventoFichaAtencionDetalle_model->ficha();
        
        $rsEntidad = $this->EventoTipoEntidadAtencion_model->lista();
        $tipodocumento = $this->TipoDocumento_model->lista();
        $rsPaises = $this->EventoTipoEntidadAtencion_model->paises();
        $paises = $rsPaises->result();

        $data = array(
            "lista" => $rs,
            "id" => $id,
            "Evento_Registro_Numero" => $Evento_Registro_Numero,
            "listaEntidadAtencion" => $rsEntidad->result(),
            "tipodocumento" => $tipodocumento,
            "paises" => json_encode($paises)
        );
        
        $this->load->view("eventos/fichaConsolidado",$data);
        
    }
    
    public function editarAtencion(){
        
        $this->load->model("EventoFichaAtencionDetalle_model");
        $this->load->model("EventoFichaAtencion_model");
        
        $id = $this->input->post("id");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $Evento_Ficha_Atencion_ID = $this->input->post("Evento_Ficha_Atencion_ID");
        $Evento_Ficha_Atencion_Detalle_Paciente = $this->input->post("Evento_Ficha_Atencion_Detalle_Paciente");
        $Evento_Ficha_Atencion_Detalle_Paciente = strtoupper($Evento_Ficha_Atencion_Detalle_Paciente);
        
        $Tipo_Documento_Codigo = $this->input->post("Tipo_Documento_Codigo");
        $Evento_Ficha_Atencion_Detalle_DNI = $this->input->post("Evento_Ficha_Atencion_Detalle_DNI");
        $Evento_Ficha_Atencion_Detalle_Edad = $this->input->post("Evento_Ficha_Atencion_Detalle_Edad");
        $Evento_Ficha_Atencion_Detalle_Genero = $this->input->post("Evento_Ficha_Atencion_Detalle_Genero");
        
        $Evento_Ficha_Atencion_Detalle_Gestante = ($this->input->post("Evento_Ficha_Atencion_Detalle_Gestante")) ? $this->input->post("Evento_Ficha_Atencion_Detalle_Gestante") : "0";
        $Evento_Ficha_Atencion_Detalle_Personal_Salud = ($this->input->post("Evento_Ficha_Atencion_Detalle_Personal_Salud")) ? $this->input->post("Evento_Ficha_Atencion_Detalle_Personal_Salud") : "0";
        
        $Evento_Ficha_Atencion_Detalle_Procedencia = $this->input->post("Evento_Ficha_Atencion_Detalle_Procedencia");
        $Evento_Ficha_Atencion_Detalle_Clasificacion = $this->input->post("Evento_Ficha_Atencion_Detalle_Clasificacion");
        $Evento_Ficha_Atencion_Detalle_Inicio_Sintomas = $this->input->post("Evento_Ficha_Atencion_Detalle_Inicio_Sintomas");
        $fa = explode(" ",$Evento_Ficha_Atencion_Detalle_Inicio_Sintomas);
       
        $Evento_Ficha_Atencion_Detalle_Inicio_Sintomas = formatearFechaParaBD($fa[0]) . " " . $fa[1] . ":00";
        
        $Evento_Ficha_Atencion_Detalle_Diagnostico = $this->input->post("Evento_Ficha_Atencion_Detalle_Diagnostico");
        $Evento_Ficha_Atencion_Detalle_CIE10_Codigo = $this->input->post("Evento_Ficha_Atencion_Detalle_CIE10_Codigo");
        $Evento_Ficha_Atencion_Detalle_Hora_Atencion = $this->input->post("Evento_Ficha_Atencion_Detalle_Hora_Atencion");
        $Evento_Ficha_Atencion_Detalle_Hora_Atencion = $Evento_Ficha_Atencion_Detalle_Hora_Atencion.":00";
        
        $Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID = $this->input->post("Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID");
        
        $Evento_Ficha_Atencion_Detalle_Quimioprofilaxis = ($this->input->post("Evento_Ficha_Atencion_Detalle_Quimioprofilaxis")) ? $this->input->post("Evento_Ficha_Atencion_Detalle_Quimioprofilaxis") : "0";
        $Evento_Ficha_Atencion_Detalle_Vacuna = ($this->input->post("Evento_Ficha_Atencion_Detalle_Vacuna")) ? $this->input->post("Evento_Ficha_Atencion_Detalle_Vacuna") : "0";
        $Evento_Ficha_Atencion_Detalle_Medicamentos = ($this->input->post("Evento_Ficha_Atencion_Detalle_Medicamentos")) ? $this->input->post("Evento_Ficha_Atencion_Detalle_Medicamentos") : "0";
        
        $Evento_Ficha_Atencion_Detalle_Destino = $this->input->post("Evento_Ficha_Atencion_Detalle_Destino");
        $Evento_Ficha_Atencion_Detalle_Lugar_Traslado = $this->input->post("Evento_Ficha_Atencion_Detalle_Lugar_Traslado");
        $Evento_Ficha_Atencion_Detalle_Responsable = $this->input->post("Evento_Ficha_Atencion_Detalle_Responsable");
        
        $Evento_Ficha_Atencion_Pais_Procedencia = $this->input->post("Evento_Ficha_Atencion_Pais_Procedencia");
        $Evento_Ficha_Atencion_Lugar_Residencia = $this->input->post("Evento_Ficha_Atencion_Lugar_Residencia");
        
        $this->EventoFichaAtencion_model->setId($Evento_Ficha_Atencion_ID);
        $rs = $this->EventoFichaAtencion_model->EventoFichaAtencion();
        $rsF = $rs->row();
        
        $Evento_Ficha_Atencion_Fecha = $rsF->Evento_Ficha_Atencion_Fecha;
        $Evento_Ficha_Atencion_Detalle_Hora_Atencion = $Evento_Ficha_Atencion_Fecha." ".$Evento_Ficha_Atencion_Detalle_Hora_Atencion;
        
        $this->EventoFichaAtencionDetalle_model->setId($id);
        $this->EventoFichaAtencionDetalle_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_ID($Evento_Ficha_Atencion_ID);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Paciente($Evento_Ficha_Atencion_Detalle_Paciente);
        $this->EventoFichaAtencionDetalle_model->setTipo_Documento_Codigo($Tipo_Documento_Codigo);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_DNI($Evento_Ficha_Atencion_Detalle_DNI);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Edad($Evento_Ficha_Atencion_Detalle_Edad);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Genero($Evento_Ficha_Atencion_Detalle_Genero);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Gestante($Evento_Ficha_Atencion_Detalle_Gestante);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Personal_Salud($Evento_Ficha_Atencion_Detalle_Personal_Salud);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Procedencia($Evento_Ficha_Atencion_Detalle_Procedencia);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Clasificacion($Evento_Ficha_Atencion_Detalle_Clasificacion);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Inicio_Sintomas($Evento_Ficha_Atencion_Detalle_Inicio_Sintomas);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Diagnostico($Evento_Ficha_Atencion_Detalle_Diagnostico);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_CIE10_Codigo($Evento_Ficha_Atencion_Detalle_CIE10_Codigo);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Hora_Atencion($Evento_Ficha_Atencion_Detalle_Hora_Atencion);
        $this->EventoFichaAtencionDetalle_model->setEvento_Tipo_Entidad_Atencion_Oferta_Movil_ID($Evento_Tipo_Entidad_Atencion_Oferta_Movil_ID);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Vacuna($Evento_Ficha_Atencion_Detalle_Vacuna);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Quimioprofilaxis($Evento_Ficha_Atencion_Detalle_Quimioprofilaxis);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Medicamentos($Evento_Ficha_Atencion_Detalle_Medicamentos);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Destino($Evento_Ficha_Atencion_Detalle_Destino);
        
        if($Evento_Ficha_Atencion_Detalle_Destino=="1"){
            $Evento_Ficha_Atencion_Detalle_Lugar_Traslado="";
            $Evento_Ficha_Atencion_Detalle_Responsable="";
        }
        
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Lugar_Traslado($Evento_Ficha_Atencion_Detalle_Lugar_Traslado);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Detalle_Responsable($Evento_Ficha_Atencion_Detalle_Responsable);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Pais_Procedencia($Evento_Ficha_Atencion_Pais_Procedencia);
        $this->EventoFichaAtencionDetalle_model->setEvento_Ficha_Atencion_Lugar_Residencia($Evento_Ficha_Atencion_Lugar_Residencia);
        
        $rs = $this->EventoFichaAtencionDetalle_model->buscarIdFichaDNINotID();
        $rsR = $rs->row();
        if($this->EventoFichaAtencionDetalle_model->actualizar()) $this->session->set_flashdata('messageOK', 'La atenci&oacute;n ha sido actualizada');
        else $this->session->set_flashdata('messageError', 'Error al intentar actualizar, vuelva a intentar');
        $this->session->set_flashdata('id', $Evento_Ficha_Atencion_ID);
        $this->session->set_flashdata('Evento_Registro_Numero', $Evento_Registro_Numero);
        header("location:" . base_url() . "eventos/fichas/consolidado");
        
    }
    
    public function reportarFicha() {
        
        $this->load->model("EventoFichaAtencion_model");
        
        $id = $this->input->post("id");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        
        $this->EventoFichaAtencion_model->setId($id);
        $this->EventoFichaAtencion_model->setEvento_Registro_Numero($Evento_Registro_Numero);
        
        $listaCantidadesAtencionesOfertaMovil = $this->EventoFichaAtencion_model->listaCantidadesAtencionesOfertaMovil();
        $listarCantidadesAtencionesDiagnosticos = $this->EventoFichaAtencion_model->listarCantidadesAtencionesDiagnosticos();
        
        $data = array(
            "listaCantidadesAtencionesOfertaMovil" => $listaCantidadesAtencionesOfertaMovil,
            "listarCantidadesAtencionesDiagnosticos" => $listarCantidadesAtencionesDiagnosticos,
            "id" => $id,
            "Evento_Registro_Numero" => $Evento_Registro_Numero,
        );        
        return $this->load->view("eventos/reportarFicha",$data);        
    }
    
    public function eliminarAtencion(){
        
        $this->load->model("EventoFichaAtencionDetalle_model");
        
        $id = $this->input->post("id");
        $Evento_Registro_Numero = $this->input->post("Evento_Registro_Numero");
        $Evento_Ficha_Atencion_ID = $this->input->post("Evento_Ficha_Atencion_ID");
        
        $this->EventoFichaAtencionDetalle_model->setId($id);
        
        if($this->EventoFichaAtencionDetalle_model->eliminar()) $this->session->set_flashdata('messageOK', 'La atenci&oacute;n ha sido eliminada');
        else $this->session->set_flashdata('messageError', 'Error al intentar eliminar, vuelva a intentar');      
    
        $this->session->set_flashdata('id', $Evento_Ficha_Atencion_ID);
        $this->session->set_flashdata('Evento_Registro_Numero', $Evento_Registro_Numero);
        
        header("location:" . base_url() . "eventos/fichas/consolidado");
    }
    
    public function exportar() {
        
        $this->load->model("EventoFichaAtencionDetalle_model");
        $lista = $this->EventoFichaAtencionDetalle_model->exportar();
        echo json_encode($lista->result());
        
    }

}