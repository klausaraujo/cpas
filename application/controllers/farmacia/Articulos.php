<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Articulos extends CI_Controller
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
        $this->load->model("FarmaciaArticulo_model");

        $listaArticulos = $this->FarmaciaArticulo_model->obtenerArticulos();
       
        if ($listaArticulos->num_rows() > 0) {
            $listaArticulos = $listaArticulos->result();
        } else {
            $listaArticulos = array();
        }

        $detalle = array(
          "listaArticulos" => $listaArticulos
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function agregarFoto($foto)
    {
        $path = getenv('PATH_DOC_FARMACIA_FOTOS');
        $estado = 1;
        $imagen = "";
        
        if (filesize($foto["tmp_name"]) > 0) {            
            
            if ($foto["type"] == "image/jpeg" || $foto["type"] == "image/jpg" || $foto["type"] == "image/png" || $foto["type"] == "image/svg") {
                
                $name = "articulo_" . date("Ymdhis");
                
                $data = $foto['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                $imagen = $name . '.' . $ext;
                redim($foto["tmp_name"], $path.$name.'.'.$ext, 375, 508);
                
            } else {
                $estado = -1;
                $message = ERROR_IMAGEN_FORMATO;
            }
        } else {
            $estado = 0;
        }
        
        return array("estado"=>$estado,"foto"=>$imagen);
        
    }

    public function cargarArchivo($file,$update,$id){
        $path = getenv('PATH_DOC_FARMACIA_FICHAS');
        
        if (filesize($file["tmp_name"]) > 0) {
            
            $name = "ficha_".date("Ymdhis");
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

    public function guardarArticulo() {
        $this->load->model("FarmaciaArticulo_model");
        
        $idarticulo = $this->input->post("idarticulo");
        $siga = $this->input->post("siga");
        $nombre = $this->input->post("nombre");
        $medida = $this->input->post("medida");
        $categoria = $this->input->post("categoria");
        $administracion = $this->input->post("administracion");
        $presentacion = $this->input->post("presentacion");
        $cantmin = $this->input->post("cantmin");
        $cantmax = $this->input->post("cantmax");
        $porcstock = $this->input->post("porcstock");

        $fichaTecnica = $this->input->post("fichaTecnica");
        $estado = $this->input->post("estado");
        $foto = $_FILES["file"];

        if ($estado) {
           $estado = 1;
        } else {
           $estado = 0;
        }
        
        $this->FarmaciaArticulo_model->setId($idarticulo);
        $this->FarmaciaArticulo_model->setSiga($siga);
        $this->FarmaciaArticulo_model->setDescripcion($nombre);
        $this->FarmaciaArticulo_model->setIdCategoria($categoria);
        $this->FarmaciaArticulo_model->setIdAdministracion($administracion);
        $this->FarmaciaArticulo_model->setMedida($medida);
        $this->FarmaciaArticulo_model->setIdPresentacion($presentacion);
        $this->FarmaciaArticulo_model->setCantmin($cantmin);
        $this->FarmaciaArticulo_model->setCantmax($cantmax);
        $this->FarmaciaArticulo_model->setPorcStock($porcstock);
        $this->FarmaciaArticulo_model->setFichaTecnica($fichaTecnica);
        $this->FarmaciaArticulo_model->setMedida($medida);
        $this->FarmaciaArticulo_model->setEstado($estado);
        $this->FarmaciaArticulo_model->setUsuarioRegistro($this->session->userdata("idusuario"));

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        $dataFoto = $this->agregarFoto($foto);
        if($dataFoto["estado"] > 0){
            $this->FarmaciaArticulo_model->setImagen($dataFoto["foto"]);
        }
        $archivo = false;
        if (filesize($_FILES["ficha"]["tmp_name"])>0) {
            $archivo = $this->cargarArchivo($_FILES["ficha"], false, 0);
        }

        if ($archivo != false) {
            $this->FarmaciaArticulo_model->setFichaTecnica($archivo);
        }
        if ($idarticulo > 0) {
            if ($this->FarmaciaArticulo_model->actualizarArticulo()) {
                $status = 200;
                $message = "Historial actualizado exitosamente";
            }
        } else {
            if ($this->FarmaciaArticulo_model->guardarArticulo()) {
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

    public function obtenerListaInventariado(){
        $this->load->model("FarmaciaArticulo_model");

        $listaArticulos = $this->FarmaciaArticulo_model->obtenerArticulosInventariado();
       
        if ($listaArticulos->num_rows() > 0) {
            $listaArticulos = $listaArticulos->result();
        } else {
            $listaArticulos = array();
        }

        $detalle = array(
          "listaArticulos" => $listaArticulos
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function obtenerArticulosSalida(){
        $this->load->model("FarmaciaArticulo_model");
        
        $idarticulo = $this->input->post("idAlmacen");
        $this->FarmaciaArticulo_model->setIdAlmacen($idarticulo);
        $listaArticulos = $this->FarmaciaArticulo_model->obtenerArticulosSalida();
       
        if ($listaArticulos->num_rows() > 0) {
            $listaArticulos = $listaArticulos->result();
        } else {
            $listaArticulos = array();
        }

        $detalle = array(
          "listaArticulos" => $listaArticulos
        );

        $data = array(
            "status" => 200,
            "data" => $detalle
        );

        echo json_encode($data);
    }

    public function inventario(){
        $this->load->model("FarmaciaArticulo_model");
        $idcategoria = $this->input->post("categoria");
        $idadministracion = $this->input->post("administracion");
        $idpresentacion = $this->input->post("presentacion");
        $idestado = $this->input->post("estado");
        $indstock = $this->input->post("indstock");
        $vencimientoinicial = $this->input->post("vencimientoinicial");
        $vencimientofinal = $this->input->post("vencimientofinal");
        $almacen = $this->input->post("almacen");
        
        //$fD = explode(" ", $vencimientoinicial);
        $vencimientoinicial = formatearFechaParaVista($vencimientoinicial);

        //$fH = explode(" ", $vencimientofinal);
        $vencimientofinal = formatearFechaParaVista($vencimientofinal);

        $this->FarmaciaArticulo_model->setIdCategoria($idcategoria);
        $this->FarmaciaArticulo_model->setIdAdministracion($idadministracion);
        $this->FarmaciaArticulo_model->setIdPresentacion($idpresentacion);
        $this->FarmaciaArticulo_model->setEstado($idestado);
        $this->FarmaciaArticulo_model->setIndstock($indstock);
        $this->FarmaciaArticulo_model->setVencimientoinicial($vencimientoinicial);
        $this->FarmaciaArticulo_model->setVencimientofinal($vencimientofinal);
        $this->FarmaciaArticulo_model->setIdAlmacen($almacen);

        
        $lista = $this->FarmaciaArticulo_model->obtenerReporteGeneral();
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
}