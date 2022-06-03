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
        $this->load->model("FarmaciaIngreso_model");

        $listaIngresos = $this->FarmaciaIngreso_model->obtenerLista();
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
        $path = getenv('PATH_DOC_FARMACIA_INGRESOS');
        
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
        $this->load->model("FarmaciaIngreso_model");
        $idingreso = $this->input->post("idingreso");
        $this->FarmaciaIngreso_model->setIngreso($idingreso);

        $this->FarmaciaIngreso_model->setAnio($this->input->post("anio"));
        $this->FarmaciaIngreso_model->setFechaEmision($this->input->post("fechaEmision"). ' ' .'00:00:00');
        $this->FarmaciaIngreso_model->setTipoIngreso($this->input->post("tipoIngreso"));
        $this->FarmaciaIngreso_model->setAlmacen($this->input->post("almacen"));
        $this->FarmaciaIngreso_model->setObservaciones($this->input->post("observaciones"));
        $this->FarmaciaIngreso_model->setUsuarioRegistro($this->session->userdata("idusuario"));
        
        $articulos = $this->input->post("articulos");
        $costo_unitario = $this->input->post("costo_unitario");
        $cantidad = $this->input->post("cantidad");
        $observacionesArticulo = $this->input->post("observacionArticulo");
        $vencimiento = $this->input->post("vencimiento");
        $lote = $this->input->post("lote");

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        $archivo = false;
        if (filesize($_FILES["ficha"]["tmp_name"])>0) {
            $archivo = $this->cargarArchivo($_FILES["ficha"], false, 0);
        }

        if ($archivo != false) {
            $this->FarmaciaIngreso_model->setFichaTecnica($archivo);
        }

        if ($idingreso > 0) {
            if ($this->FarmaciaIngreso_model->actualizarIngreso()) {
                $respuestaEliminar = $this->FarmaciaIngreso_model->eliminarDetalleIngreso();
                if($respuestaEliminar && $this->guardarDetalle($idingreso, $articulos, $costo_unitario, $cantidad, $observacionesArticulo, $vencimiento, $lote)){
                    $status = 200;
                    $message = "Historial registrado exitosamente";
                }
            }
        } else {
            $idingreso = $this->FarmaciaIngreso_model->guardarIngreso();
            if ($idingreso) {
                if($this->guardarDetalle($idingreso, $articulos, $costo_unitario, $cantidad, $observacionesArticulo, $vencimiento, $lote)){
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

    public function guardarDetalle($idingreso, $articulos, $costo_unitario, $cantidad, $observacionesArticulo, $vencimiento, $lote) {
        $this->FarmaciaIngreso_model->setIngreso($idingreso);
        $articulos = explode("|", $articulos);
        $costo_unitario = explode("|", $costo_unitario);
        $cantidad = explode("|", $cantidad);
        $observacionesArticulo = explode("|", $observacionesArticulo);
        $vencimiento = explode("|", $vencimiento);
        $lote = explode("|", $lote);

        foreach($articulos as $key => $id):
            $this->FarmaciaIngreso_model->setIdArticulo($id);
            $this->FarmaciaIngreso_model->setCostoUnitario($costo_unitario[$key]);
            $this->FarmaciaIngreso_model->setCantidad($cantidad[$key]);
            $this->FarmaciaIngreso_model->setLote($lote[$key]);
            $this->FarmaciaIngreso_model->setObservacionArticulo($observacionesArticulo[$key]);
            $this->FarmaciaIngreso_model->setVencimiento($vencimiento[$key]. ' ' .'00:00:00');
            $this->FarmaciaIngreso_model->guardarDetalle();
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
        $this->Articulo_model->setFechaRegistro($fechaRegistro. ' ' .'00:00:00');
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
        $this->load->model("FarmaciaIngreso_model");
        $this->FarmaciaIngreso_model->setIngreso($this->input->post("id"));

        $lista = $this->FarmaciaIngreso_model->obtenerDetalleLista();
        $detalle = array(
            "lista" => $lista->num_rows()? $lista->result() : array()
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

}