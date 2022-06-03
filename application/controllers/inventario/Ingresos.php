<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ingresos extends CI_Controller
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
        $this->load->model("Ingreso_model");

        $listaIngresos = $this->Ingreso_model->obtenerLista();
        $detalle = array(
          "listaIngresos" => $listaIngresos->num_rows()? $listaIngresos->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function cargarArchivo($file,$update,$id){
        $path = getenv('PATH_DOC_INVENTARIOS_INGRESOS');
        
        if (filesize($file["tmp_name"]) > 0) {
            $name = "ingreso_".date("Ymdhis");
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

    public function guardar() {
        $this->load->model("Ingreso_model");
        $idingreso = $this->input->post("idingreso");
        $this->Ingreso_model->setIngreso($idingreso);
        $articulos = $this->input->post("articulos");
        $fechaRegistro = $this->input->post("fechaEmision");
        $this->Ingreso_model->setAnio($this->input->post("anio"));
        $this->Ingreso_model->setFechaEmision($fechaRegistro. ' ' .'00:00:00');
        $this->Ingreso_model->setTipoIngreso($this->input->post("tipoIngreso"));
        $this->Ingreso_model->setAlmacen($this->input->post("almacen"));
        $this->Ingreso_model->setObservaciones($this->input->post("observaciones"));
        $this->Ingreso_model->setUsuarioRegistro($this->session->userdata("idusuario"));

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        $archivo = false;
        if (filesize($_FILES["ficha"]["tmp_name"])>0) {
            $archivo = $this->cargarArchivo($_FILES["ficha"], false, 0);
        }

        if ($archivo != false) {
            $this->Ingreso_model->setFichaTecnica($archivo);
        }

        if ($idingreso > 0) {
            if ($this->Ingreso_model->actualizarIngreso()) {
                $respuestaEliminar = $this->Ingreso_model->eliminarDetalleIngreso();
                if($respuestaEliminar && $this->guardarDetalle($idingreso, $articulos)){
                    $status = 200;
                    $message = "Historial registrado exitosamente";
                }
            }
        } else {
            $idingreso = $this->Ingreso_model->guardarIngreso();
            if ($idingreso) {
                if($this->guardarDetalle($idingreso, $articulos)){
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

    public function guardarDetalle($idingreso, $articulos) {
        $this->Ingreso_model->setIngreso($idingreso);
        $articulos = explode("|", $articulos);
        foreach($articulos as $id):
            $this->Ingreso_model->setIdArticulo($id);
            $this->Ingreso_model->guardarUbicacion();
            $this->Ingreso_model->guardarDetalle();
        endforeach;

        return $idingreso;
    }

    public function guardarArticuloInventariado() {
        $this->load->model("Articulo_model");

        $idarticulo = $this->input->post("idarticulo");
        $idarticuloregistro = $this->input->post("idarticuloregistro");
        $serie = $this->input->post("serie");
        $patrimonioOriginal = $this->input->post("patrimonioOriginal");
        $patrimonioActual = $this->input->post("patrimonioActual");
        $fechaRegistro = $this->input->post("fechaRegistro");
        $condicionActual = $this->input->post("condicionActual");
        $estadoInventariado = $this->input->post("estadoInventariado");

        if ($estadoInventariado) {
           $estado = 1;
        } else {
           $estado = 0;
        }

        $this->Articulo_model->setId($idarticulo);
        $this->Articulo_model->setIdArticuloRegistro($idarticuloregistro);
        $this->Articulo_model->setSerie($serie);
        $this->Articulo_model->setCodigoPatrimonialOriginal($patrimonioOriginal);
        $this->Articulo_model->setCodigoPatrimonialActual($patrimonioActual);
        $this->Articulo_model->setFechaRegistro(formatearFechaParaBD(explode(" ", $fechaRegistro)[0]));
        $this->Articulo_model->setCondicion($condicionActual);
        $this->Articulo_model->setEstado($estado);
        $this->Articulo_model->setUsuarioRegistro($this->session->userdata("idusuario"));
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($idarticuloregistro > 0) {
            if ($this->Articulo_model->actualizarArticuloInventariado()) {
                $status = 200;
                $message = "Historial actualizado exitosamente";
            }
        } else {
            if ($this->Articulo_model->guardarArticuloInventariado()) {
                $status = 200;
                $message = "Historial registrado exitosamente";
            }
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function obtenerDetalleIngreso(){
        $this->load->model("Ingreso_model");
        $this->Ingreso_model->setIngreso($this->input->post("id"));

        $lista = $this->Ingreso_model->obtenerDetalleLista();
        $detalle = array(
            "lista" => $lista->num_rows()? $lista->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function anularIngreso(){
        $this->load->model("Ingreso_model");
        $this->Ingreso_model->setIngreso($this->input->post("id"));
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if($this->Ingreso_model->anularIngreso()){
            $status = 200;
            $message = "Historial registrado exitosamente";
        }

        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function informe()
    {
        $this->load->library("dom");
        $this->load->model("Ingreso_model");
        $this->load->model("EventoRegistrar_model");
        // $this->load->model("Desplazamiento_model");
        $idIngreso = $this->uri->segment(4, 0);
        $this->Ingreso_model->setIngreso($idIngreso);
        $cabecera = $this->Ingreso_model->obtenerCabeceraReporte();
        $detalle = $this->Ingreso_model->obtenerDetalleReporte();
        $detalleAnio = $this->Ingreso_model->obtenerAnioDetalle();
        // $desplazamiento = $this->Desplazamiento_model->obtener();
               
        $data = array(
            "cabecera" => $cabecera,
            "detalle" => $detalle,
            // "desplazamiento" => $desplazamiento,
            "detalleAnio" => $detalleAnio->row()
        );
        
        $vista = "inventario/informeIngreso";
                
        $html = $this->load->view($vista, $data, true);
        $this->dom->generate("portrait", "informe", $html, "Informe");
    }

}