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
        $this->load->model("FarmaciaSalida_model");

        $listaSalida = $this->FarmaciaSalida_model->obtenerLista();
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
        $this->load->model("FarmaciaSalida_model");
        
        $idSalida = $this->input->post("id");
        $this->FarmaciaSalida_model->setIdSalida($idSalida);
        $lista = $this->FarmaciaSalida_model->obtenerDetalleSalida();

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
        $this->load->model("FarmaciaSalida_model");
        
        $idsalida = $this->input->post("idsalidaRegistro");
        $this->FarmaciaSalida_model->setIdSalida($idsalida);
        $this->FarmaciaSalida_model->setAnio($this->input->post("anio"));
        $this->FarmaciaSalida_model->setFechaEmision($this->input->post("fechaEmision"). ' ' .'00:00:00');
        $this->FarmaciaSalida_model->setAlmacen($this->input->post("almacen"));
        $this->FarmaciaSalida_model->setObservaciones($this->input->post("observaciones"));
        $this->FarmaciaSalida_model->setTipoDesplazamiento($this->input->post("tipoDesplazamiento"));
        $this->FarmaciaSalida_model->setIdrenipress($this->input->post("idrenipress"));
        $this->FarmaciaSalida_model->setRenipress($this->input->post("renipress"));
        $this->FarmaciaSalida_model->setInstitucion($this->input->post("institucion"));
        $this->FarmaciaSalida_model->setNombreSalud($this->input->post("nombreSalud"));
        $this->FarmaciaSalida_model->setTipoSalud($this->input->post("tipoSalud"));
        $this->FarmaciaSalida_model->setClasificacionSalud($this->input->post("clasificacionSalud"));
        $this->FarmaciaSalida_model->setRegionSalud($this->input->post("regionSalud"));
        $this->FarmaciaSalida_model->setNumeroDocumento($this->input->post("numeroDocumento"));
        $this->FarmaciaSalida_model->setNombreReceptor($this->input->post("nombreReceptor"));        
        $this->FarmaciaSalida_model->setUsuarioRegistro($this->session->userdata("idusuario"));
        $this->FarmaciaSalida_model->setCoordenadaIpress($this->input->post("ipressUbicacion"));        
        $this->FarmaciaSalida_model->setNumeroSireed($this->input->post("idEvento"));        
        $this->FarmaciaSalida_model->setCorrelativoSireed($this->input->post("idEvento"));        
        $this->FarmaciaSalida_model->setCoordenadaSireed($this->input->post("numeroEventoUbicacion"));        
        $this->FarmaciaSalida_model->setUbigeoSireed($this->input->post("departamentoEvento").''.$this->input->post("provinciaEvento").''.$this->input->post("distritoEvento"));
        $this->FarmaciaSalida_model->setOtrasactividadesdigerd($this->input->post("otrasactividadesdigerd"));

        $articulos = $this->input->post("articulos");
        $costo_unitario = $this->input->post("costo_unitario");
        $cantidad = $this->input->post("cantidad");
        $observacionesArticulo = $this->input->post("observacionArticulo");
        $vencimiento = $this->input->post("vencimiento");
        $lote = $this->input->post("lote");
        $caja = $this->input->post("caja");

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($idsalida > 0) {
            if ($this->FarmaciaSalida_model->actualizarSalida()) {
                $respuestaEliminar = $this->FarmaciaSalida_model->eliminarArticuloSalida();
                if($respuestaEliminar && $this->guardarDetalle($idsalida, $articulos, $costo_unitario, $cantidad, $observacionesArticulo, $vencimiento, $lote, $caja)){
                    $status = 200;
                    $message = "Historial registrado exitosamente";
                }
            }
        } else {
            $idsalida = $this->FarmaciaSalida_model->guardarSalida();
            if ($idsalida) {
                if($this->guardarDetalle($idsalida, $articulos, $costo_unitario, $cantidad, $observacionesArticulo, $vencimiento, $lote, $caja)){
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
        $this->load->model("FarmaciaSalida_model");
        
        $idsalida = $this->input->post("id");
        $this->FarmaciaSalida_model->setIdSalida($idsalida);
        $this->FarmaciaSalida_model->setIdArticulo($this->input->post("idArticulo"));

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($idsalida > 0) {
            if ($this->FarmaciaSalida_model->eliminarDetalleSalida()) {
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

    public function cargarArchivo($file,$update,$id){
        $path = getenv('PATH_DOC_FARMACIA_SALIDAS');
        
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
        $this->load->model("FarmaciaSalida_model");
        $this->FarmaciaSalida_model->setIdSalida($this->input->post("idsalida"));
        
        $archivo = false;
        if (filesize($_FILES["ficha"]["tmp_name"])>0) {
            $archivo = $this->cargarArchivo($_FILES["ficha"], false, 0);
        }

        if ($archivo != false) {
            $this->FarmaciaSalida_model->setAdjunto($archivo);
        }

        $this->FarmaciaSalida_model->setUsuarioRegistro($this->session->userdata("idusuario"));
        $idsalida = 0;

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        $idsalida = $this->FarmaciaSalida_model->guardarAdjunto();
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

    public function guardarDetalle($idsalida, $articulos, $costo_unitario, $cantidad, $observacionesArticulo, $vencimiento, $lote, $caja) {
        $this->FarmaciaSalida_model->setIdSalida($idsalida);
        $articulos = explode("|", $articulos);
        $costo_unitario = explode("|", $costo_unitario);
        $cantidad = explode("|", $cantidad);
        $observacionesArticulo = explode("|", $observacionesArticulo);
        //$vencimiento = explode("|", $vencimiento);
        $lote = explode("|", $lote);
        $caja = explode("|", $caja);

            $vencimiento = str_replace("-","/",$vencimiento);
            $fE = explode(" ", $vencimiento);
            $vencimiento = explode("|", formatearFechaParaBD($fE[0]));

        foreach($articulos as $key => $id):
            $this->FarmaciaSalida_model->setIdArticulo($id);
            $this->FarmaciaSalida_model->setCostoUnitario($costo_unitario[$key]);
            $this->FarmaciaSalida_model->setCantidad($cantidad[$key]);
            $this->FarmaciaSalida_model->setLote($lote[$key]);
            $this->FarmaciaSalida_model->setCaja($caja[$key]);
            $this->FarmaciaSalida_model->setObservacionArticulo($observacionesArticulo[$key]);
            $this->FarmaciaSalida_model->setVencimiento($vencimiento[$key]. ' ' .'00:00:00');
            $this->FarmaciaSalida_model->guardarDetalle();
        endforeach;

        return $idsalida;
    }

    public function informe(){
        $this->load->library("dom");
        
        $this->load->model("FarmaciaSalida_model");
        $this->load->model("FarmaciaDesplazamiento_model");        
        $idSalida = $this->uri->segment(4, 0);        
        $this->FarmaciaSalida_model->setIdSalida($idSalida);
        $cabecera = $this->FarmaciaSalida_model->obtenerCabeceraReporte();
        $detalle = $this->FarmaciaSalida_model->obtenerDetalleReporte();
        $detalleAnio = $this->FarmaciaSalida_model->obtenerAnioDetalle();
        $desplazamiento = $this->FarmaciaDesplazamiento_model->obtener();       
        $data = array(
            "cabecera" => $cabecera,
            "detalle" => $detalle,
            "desplazamiento" => $desplazamiento,
            "detalleAnio" => $detalleAnio->row()
        );
        
        $vista = "farmacia/informeSalida";
                
        $html = $this->load->view($vista, $data, true);
        $this->dom->generate("portrait", "informe", $html, "Informe");
    }
}