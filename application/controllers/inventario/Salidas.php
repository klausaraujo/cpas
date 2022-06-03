<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Salidas extends CI_Controller
{

    private $permisos = null;
    
    function __construct() {

      parent::__construct();
    
      $token = $this->session->userdata("token");
    
      (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY"),false):redirect("login");
    
      $this->session->set_userdata("idmodulo", 14);
    
      ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");
    
      if(sha1($usuario)==$token->usuario){
    
          if (count($token->modulos)>0) {
    
              $listaModulos = $token->modulos;
    
              $permanecer = false;
    
              foreach ($listaModulos as $row) :
              if ($row->idmodulo == 14 and $row->estado == 1)
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
        
    }

    public function obtenerLista(){
        $this->load->model("Salida_model");

        $listaSalida = $this->Salida_model->obtenerLista();
        $detalle = array(
          "listaSalida" => $listaSalida->num_rows()? $listaSalida->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtenerDetalleSalida(){
        $this->load->model("Salida_model");
        
        $idSalida = $this->input->post("id");
        $this->Salida_model->setIdSalida($idSalida);
        $lista = $this->Salida_model->obtenerDetalleSalida();
       
        if ($lista->num_rows() > 0) {
            $lista = $lista->result();
        } else {
            $lista = array();
        }

        $detalle = array(
          "lista" => $lista
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function guardar() {
        $this->load->model("Salida_model");
        
        $idsalida = $this->input->post("idsalidaRegistro");
        $this->Salida_model->setIdSalida($idsalida);
        $articulos = $this->input->post("articulos");
        $this->Salida_model->setAnio($this->input->post("anio"));
        $this->Salida_model->setFechaEmision($this->input->post("fechaEmision"). ' ' .'00:00:00');
        $this->Salida_model->setAlmacen($this->input->post("almacen"));
        $this->Salida_model->setObservaciones($this->input->post("observaciones"));
        $this->Salida_model->setTipoDesplazamiento($this->input->post("tipoDesplazamiento"));
        $this->Salida_model->setIdrenipress($this->input->post("idrenipress"));
        $this->Salida_model->setRenipress($this->input->post("renipress"));
        $this->Salida_model->setInstitucion($this->input->post("institucion"));
        $this->Salida_model->setNombreSalud($this->input->post("nombreSalud"));
        $this->Salida_model->setTipoSalud($this->input->post("tipoSalud"));
        $this->Salida_model->setClasificacionSalud($this->input->post("clasificacionSalud"));
        $this->Salida_model->setRegionSalud($this->input->post("regionSalud"));
        $this->Salida_model->setNumeroDocumento($this->input->post("numeroDocumento"));
        $this->Salida_model->setNombreReceptor($this->input->post("nombreReceptor"));        
        $this->Salida_model->setUsuarioRegistro($this->session->userdata("idusuario"));

        $this->Salida_model->setCoordenadaIpress($this->input->post("ipressUbicacion"));        
        $this->Salida_model->setNumeroSireed($this->input->post("idEvento"));        
        $this->Salida_model->setCorrelativoSireed($this->input->post("idEvento"));        
        $this->Salida_model->setCoordenadaSireed($this->input->post("numeroEventoUbicacion"));        
        $this->Salida_model->setUbigeoSireed($this->input->post("departamentoEvento").''.$this->input->post("provinciaEvento").''.$this->input->post("distritoEvento"));

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($idsalida > 0) {
            if ($this->Salida_model->actualizarSalida()) {
                $respuestaEliminar = $this->Salida_model->eliminarArticuloSalida();
                if($respuestaEliminar && $this->guardarDetalle($idsalida, $articulos)){
                    $status = 200;
                    $message = "Historial registrado exitosamente";
                }
            }
        } else {
            $idsalida = $this->Salida_model->guardarSalida();
            if ($idsalida) {
                if($this->guardarDetalle($idsalida, $articulos)){
                    $status = 200;
                    $message = "Historial registrado exitosamente";
                }
            }
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function eliminarDetalleSalida() {
        $this->load->model("Salida_model");
        
        $idsalida = $this->input->post("id");
        $this->Salida_model->setIdSalida($idsalida);
        $this->Salida_model->setIdArticulo($this->input->post("idArticulo"));

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($idsalida > 0) {
            if ($this->Salida_model->eliminarDetalleSalida()) {
                $status = 200;
                $message = "Historial actualizado exitosamente";
            }
        } 
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function anularIngreso() {
        $this->load->model("Salida_model");
        
        $idsalida = $this->input->post("id");
        $this->Salida_model->setIdSalida($idsalida);

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($this->Salida_model->anularIngreso()) {
            $status = 200;
            $message = "Historial actualizado exitosamente";
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function cargarArchivo($file,$update,$id){
        $path = getenv('PATH_DOC_INVENTARIOS_SALIDAS');
        
        if (filesize($file["tmp_name"]) > 0) {
            
            $name = "salida_".date("Ymdhis");
            $data = $file['name'];
            $ext = pathinfo($data, PATHINFO_EXTENSION);
            $fullName = $name . '.' . $ext;
            
            $allowedMimeTypes = array("pdf","doc","docx","PDF","DOC","DOCX");
            
            if(in_array( $ext, $allowedMimeTypes ) ){
                
                if (copy($file["tmp_name"], $path . $fullName)) {
                    
                    if($update){
                        $file = $this->fileName($id);
                        $this->deleteFile($file);
                    }
                    
                    return $fullName;
                } else {
                    return false;
                }
            }
            else{
                return false;
            }
            
        }else{
            return false;
        }
    }

    public function guardarAdjunto() {
        $this->load->model("Salida_model");
        $this->Salida_model->setIdSalida($this->input->post("idsalida"));
        
        $archivo = false;
        if (filesize($_FILES["ficha"]["tmp_name"])>0) {
            $archivo = $this->cargarArchivo($_FILES["ficha"], false, 0);
        }

        if ($archivo != false) {
            $this->Salida_model->setAdjunto($archivo);
        }

        $this->Salida_model->setUsuarioRegistro($this->session->userdata("idusuario"));
        $idsalida = 0;

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        $idsalida = $this->Salida_model->guardarAdjunto();
        if($idsalida){
            $status = 200;
            $message = "Historial registrado exitosamente";

        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function guardarDetalle($idsalida, $articulos) {
        $this->Salida_model->setIdSalida($idsalida);
        $articulos = explode("|", $articulos);
        foreach($articulos as $id):
            $this->Salida_model->setIdArticulo($id);
            $this->Salida_model->guardarUbicacion();
            $this->Salida_model->guardarDetalle();
        endforeach;

        return $idsalida;
    }

    public function informe()
    {
        $this->load->library("dom");
        
        $this->load->model("Salida_model");
        $this->load->model("EventoRegistrar_model");
        $this->load->model("Desplazamiento_model");
        $idSalida = $this->uri->segment(4, 0);
        $this->Salida_model->setIdSalida($idSalida);
        $cabecera = $this->Salida_model->obtenerCabeceraReporte();
        $detalle = $this->Salida_model->obtenerDetalleReporte();
        $detalleAnio = $this->Salida_model->obtenerAnioDetalle();
        $desplazamiento = $this->Desplazamiento_model->obtener();
               
        $data = array(
            "cabecera" => $cabecera,
            "detalle" => $detalle,
            "desplazamiento" => $desplazamiento,
            "detalleAnio" => $detalleAnio->row()
        );
        
        $vista = "inventario/informeSalida";
                
        $html = $this->load->view($vista, $data, true);
        $this->dom->generate("portrait", "informe", $html, "Informe");
    }
}