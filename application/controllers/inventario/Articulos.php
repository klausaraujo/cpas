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
        $this->load->model("Articulo_model");

        $listaArticulos = $this->Articulo_model->obtenerArticulos();
       
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

    public function obtenerListaInventariado(){
        $this->load->model("Articulo_model");

        $listaArticulos = $this->Articulo_model->obtenerArticulosInventariado();
       
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
        $this->load->model("Articulo_model");
        
        $idarticulo = $this->input->post("idAlmacen");
        $this->Articulo_model->setIdAlmacen($idarticulo);
        $listaArticulos = $this->Articulo_model->obtenerArticulosSalida();
       
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

    public function obtenerListaBusqueda(){
        $this->load->model("Articulo_model");

        $listaArticulos = $this->Articulo_model->obtenerArticulosBusqueda();
       
        if ($listaArticulos->num_rows() > 0) {
            $listaArticulos = $listaArticulos->result();
        } else {
            $listaArticulos = array();
        }

        $data = array(
            "status" => 200,
            "data" => $listaArticulos
        );

        echo json_encode($data);
    }

    public function dependenciaComponente(){
        $this->load->model("Articulo_model");
        $idarticulo = $this->input->post("idArticulo");
        $this->Articulo_model->setIdArticuloRegistro($idarticulo);
 
        $listaArticulos = $this->Articulo_model->obtenerDependenciaComponente();
       
        if ($listaArticulos->num_rows() > 0) {
            $listaArticulos = $listaArticulos->result();
        } else {
            $listaArticulos = array();
        }

        $data = array(
            "status" => 200,
            "data" => $listaArticulos
        );

        echo json_encode($data);
    }

    public function agregarFoto($foto)
    {
        $path = getenv('PATH_DOC_INVENTARIOS_FOTOS');
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
        $path = getenv('PATH_DOC_INVENTARIOS_FICHAS');
        
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
        $this->load->model("Articulo_model");
        
        $idarticulo = $this->input->post("idarticulo");
        $siga = $this->input->post("siga");
        $nombre = $this->input->post("nombre");
        $marca = $this->input->post("marca");
        $modelo = $this->input->post("modelo");
        $dimensiones = $this->input->post("dimensiones");
        $peso = $this->input->post("peso");
        $color = $this->input->post("color");
        $medida = $this->input->post("medida");
        $clasificacion = $this->input->post("clasificacion");
        $fichaTecnica = $this->input->post("fichaTecnica");
        $estado = $this->input->post("estado");
        $observacion = $this->input->post("observacion");
        $foto = $_FILES["file"];

        if ($estado) {
           $estado = 1;
        } else {
           $estado = 0;
        }
        
        $this->Articulo_model->setId($idarticulo);
        $this->Articulo_model->setSiga($siga);
        $this->Articulo_model->setDescripcion($nombre);
        $this->Articulo_model->setIdMarca($marca);
        $this->Articulo_model->setModelo($modelo);
        $this->Articulo_model->setDimensiones($dimensiones);
        $this->Articulo_model->setPeso($peso);
        $this->Articulo_model->setIdColor($color);
        $this->Articulo_model->setIdClasificacion($clasificacion);
        $this->Articulo_model->setFichaTecnica($fichaTecnica);
        $this->Articulo_model->setMedida($medida);
        $this->Articulo_model->setEstado($estado);
        $this->Articulo_model->setObservacion($observacion);
        $this->Articulo_model->setUsuarioRegistro($this->session->userdata("idusuario"));

        $status = 500;
        $message = "Error al registrar, vuelva a intentar";


        $dataFoto = $this->agregarFoto($foto);
        if($dataFoto["estado"] > 0){
            $this->Articulo_model->setImagen($dataFoto["foto"]);
        }
        $archivo = false;
        if (filesize($_FILES["ficha"]["tmp_name"])>0) {
            $archivo = $this->cargarArchivo($_FILES["ficha"], false, 0);
        }

        if ($archivo != false) {
            $this->Articulo_model->setFichaTecnica($archivo);
        }
        if ($idarticulo > 0) {
            if ($this->Articulo_model->actualizarArticulo()) {
                $status = 200;
                $message = "Historial actualizado exitosamente";
            }
        } else {
            if ($this->Articulo_model->guardarArticulo()) {
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

        $costoInicial = $this->input->post("costoInicial");
        $ordenCompra = $this->input->post("ordenCompra");
        $numPecosa = $this->input->post("numPecosa");
        $codigoSbn = $this->input->post("codigoSbn");
        $tipoPresupuesto = $this->input->post("tipoPresupuesto");
        $observacion = $this->input->post("observacion");
        $caracteristica = $this->input->post("caracteristica");
        $estadoSubItems = $this->input->post("estadoSubItems");
        $fecCompra = $this->input->post("fecCompra");
        $anioFabricacion = $this->input->post("anioFabricacion");
        $codDigerd = $this->input->post("codDigerd");
        $tipohospital = $this->input->post("tipohospital");
        
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
        
        $this->Articulo_model->setCostoInicial($costoInicial);
        $this->Articulo_model->setOrdenCompra($ordenCompra);
        $this->Articulo_model->setNumPecosa($numPecosa);
        $this->Articulo_model->setCodigoSbn($codigoSbn);
        $this->Articulo_model->setTipoPresupuesto($tipoPresupuesto);
        $this->Articulo_model->setObservacion($observacion);
        $this->Articulo_model->setCaracteristica($caracteristica);
        $this->Articulo_model->setFecCompra($fecCompra. ' ' .'00:00:00');
        $this->Articulo_model->setAnioFabricacion($anioFabricacion);
        $this->Articulo_model->setCodigoDigerd($codDigerd);
        $this->Articulo_model->setTipoHospital($tipohospital);
        $this->Articulo_model->setEstadoSubItems($estadoSubItems? 1 : 0);

        $this->Articulo_model->setUsuarioRegistro($this->session->userdata("idusuario"));
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        $verificaserie = $this->Articulo_model->BuscarSerieInventario();
        $verificacodbien = $this->Articulo_model->BuscarCodBienInventario();
        $verificadcodpatomp = $this->Articulo_model->BuscarCodPatrimonialCompInventario();

        if ($verificaserie > 0) {
            $status = 501;
            $message = "Error al registrar, Serie ya Existente";
            http_response_code(400);
            $data = array(
                "status" => $status,
                "message" => $message
            );
    
            echo json_encode($data);
            return 0;
        }

        if ($verificacodbien > 0) {
            $status = 502;
            $message = "Error al registrar, Código de Bien ya Existente";
            http_response_code(400);
            $data = array(
                "status" => $status,
                "message" => $message
            );
    
            echo json_encode($data);
            return 0;
        }
        if ($verificadcodpatomp > 0) {
            $status = 503;
            $message = "Error al registrar, Código Patrimonial de Componente ya Existente";
            http_response_code(400);
            $data = array(
                "status" => $status,
                "message" => $message
            );
            
            echo json_encode($data);
            return 0;
        }

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

    public function obtenerListaComponentes(){
        $this->load->model("Articulo_model");

        $lista = $this->Articulo_model->obtenerArticulosComponentes();

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

    public function guardarComponente() {
        $this->load->model("Articulo_model");

        $idarticulopadre = $this->input->post("idPadre");
        $idarticulohijo = $this->input->post("idHijo");
        
        $this->Articulo_model->setIdPadre($idarticulopadre);
        $this->Articulo_model->setIdHijo($idarticulohijo);
        $this->Articulo_model->setUsuarioRegistro($this->session->userdata("idusuario"));
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($this->Articulo_model->guardarArticuloComponente()) {
            $status = 200;
            $message = "Historial registrado exitosamente";
        }
        
        $data = array(
            "status" => $status,
            "message" => $message
        );

        echo json_encode($data);
    }

    public function eliminarComponente() {
        $this->load->model("Articulo_model");

        $idarticulopadre = $this->input->post("idPadre");
        $idarticulohijo = $this->input->post("idHijo");
        
        $this->Articulo_model->setIdPadre($idarticulopadre);
        $this->Articulo_model->setIdHijo($idarticulohijo);
        $this->Articulo_model->setUsuarioRegistro($this->session->userdata("idusuario"));
        $status = 500;
        $message = "Error al registrar, vuelva a intentar";

        if ($this->Articulo_model->eliminarComponente()) {
            if($this->Articulo_model->eliminarArticuloComponente()){
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

    public function inventario(){
        $this->load->model("Articulo_model");
        $idmarca = $this->input->post("marca");
        $idclasificacion = $this->input->post("clasificacion");
        $idalmacen = $this->input->post("almacen");
        $this->Articulo_model->setIdMarca($idmarca);
        $this->Articulo_model->setIdClasificacion($idclasificacion);
        $this->Articulo_model->setIdAlmacen($idalmacen);

        $lista = $this->Articulo_model->obtenerReporteGeneral();
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
    public function disponibles(){
        $this->load->model("Articulo_model");
        $idmarca = $this->input->post("marca");
        $idclasificacion = $this->input->post("clasificacion");
        $idalmacen = $this->input->post("almacen");
        $this->Articulo_model->setIdMarca($idmarca);
        $this->Articulo_model->setIdClasificacion($idclasificacion);
        $this->Articulo_model->setIdAlmacen($idalmacen);

        $lista = $this->Articulo_model->obtenerReporteDisponibles();
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
    public function asignados(){
        $this->load->model("Articulo_model");
        $idmarca = $this->input->post("marca");
        $idclasificacion = $this->input->post("clasificacion");
        $idalmacen = $this->input->post("almacen");
        $this->Articulo_model->setIdMarca($idmarca);
        $this->Articulo_model->setIdClasificacion($idclasificacion);
        $this->Articulo_model->setIdAlmacen($idalmacen);

        $lista = $this->Articulo_model->obtenerReporteAsignados();
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