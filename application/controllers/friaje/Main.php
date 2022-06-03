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
        
        $this->session->set_userdata("idmodulo", 4);
        
        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");
        
        if(sha1($usuario)==$token->usuario){
            
            if (count($token->modulos)>0) {
                
                $listaModulos = $token->modulos;
                
                $permanecer = false;
                
                foreach ($listaModulos as $row) :
                    if ($row->idmodulo == 4 and $row->estado == 1) {
                        $permanecer = true;
                    }
                endforeach;
                    
                    if ($permanecer == false) {
                        redirect('errores/accesoDenegado');
                    }
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
        $idmenu = 10;

        validarPermisos($nivel,$idmenu,$this->permisos);

        $this->load->model("Friaje_model");
        $this->load->model("AnioEjecucion_model");
        $this->load->model("AlertaPronostico_model");

        $anio = $this->input->post("Anio");
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        if(empty($anio) or strlen($anio)<1) {
            $rsListaAnioEjecucion = $listaAnioEjecucion->first_row();
            $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $this->Friaje_model->setAnio($anio);
        $lista = $this->Friaje_model->listar();

        $data = array(
            "lista" => $lista,
            "anio" => $anio,
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "listaralerta" => $listaralerta
        );
        
        $this->load->view("friaje/Main",$data);
    }
    
    public function registrar() {
        
        $this->load->model("Friaje_model");
        
        $apellidos = $this->input->post("apellidos");
        $nombres = $this->input->post("nombres");
        $Tipo_Documento_Codigo = $this->input->post("Tipo_Documento_Codigo");
        $documento_numero = $this->input->post("documento_numero");
        $genero = $this->input->post("genero");
        $fecha_nacimiento = $this->input->post("fecha_nacimiento");
        $edad = $this->input->post("edad");
        $estado_civil = $this->input->post("estado_civil");
                
        $foto = $_FILES["file"];
        $dataFoto = $this->agregarFoto($foto);
        $domicilio = $this->input->post("domicilio");
        $telefono_01 = $this->input->post("telefono_01");
        $telefono_02 = $this->input->post("telefono_02");
        $email = $this->input->post("email");
        
        $idioma_ingles = ($this->input->post("idioma_ingles"))?$this->input->post("idioma_ingles"):0;
        $idioma_quechua = ($this->input->post("idioma_quechua"))?$this->input->post("idioma_quechua"):0;
        $idioma_aimara = ($this->input->post("idioma_aimara"))?$this->input->post("idioma_aimara"):0;
        $idioma_otros = $this->input->post("idioma_otros");
                
        $this->Friaje_model->setApellidos($apellidos);
        $this->Friaje_model->setNombres($nombres);
        $this->Friaje_model->setTipo_Documento_Codigo($Tipo_Documento_Codigo);
        $this->Friaje_model->setDocumento_numero($documento_numero);        
        
        $count = $this->Friaje_model->existe();
        
        if(strlen($apellidos)<1 or strlen($nombres)<1 or strlen($Tipo_Documento_Codigo)<1
            or strlen($documento_numero)<1 or strlen($genero)<1 or strlen($fecha_nacimiento)<1){
                $data = array(
                    "status" => 500
                );
        }else {
        
            if($count>0) {
                $data = array(
                    "status" => 201
                );
            }
            else {
            
                $id = $this->Friaje_model->registrar();
                
                if($id>0) {
                    if($dataFoto["estado"] == 0){
                        $this->Friaje_model->setId($id);
                        $this->Friaje_model->setFoto($dataFoto["foto"]);
                        $this->Friaje_model->agregarFoto();
                    }
                    $data = array(
                        "status" => 200
                    );
                    
                } else {
                    $data = array(
                        "status" => 500
                    );
                }
            }
       
        }
            
        echo json_encode($data);
    }
    
    public function indicadoresAjax()
    {

        $this->load->model("Indicador_model");

        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
    
        $data = array();

        if (strlen($Anio_Ejecucion) > 2) {
            
            $this->Indicador_model->setAnioEjecucion($Anio_Ejecucion);
            
            $lista = $this->Indicador_model->lista();
            
            if ($lista->num_rows() > 0) {
                foreach ($lista->result() as $row) :
                $data[] = array(
                    "id" => $row->id,
                    "Indicador" => $row->Nombre_Indicador
                );
                endforeach;
            }
        }

        $datos = Array(
            "data" => $data
            );
        echo json_encode($datos);

    }
   
    public function editar() {
        
        $this->load->model("Friaje_model");
        
        $id = $this->input->post("id");
        $apellidos = $this->input->post("apellidos");
        $nombres = $this->input->post("nombres");
        $Tipo_Documento_Codigo = $this->input->post("Tipo_Documento_Codigo");
        $departamento = $this->input->post("departamento");
        $provincia = $this->input->post("provincia");
        $distrito = $this->input->post("distrito");
        
        $brigadistas_banco_id = $this->input->post("brigadistas_banco_id");
        $numero_cuenta = $this->input->post("numero_cuenta");
        
        $ubigeo_domicilio = $departamento.$provincia.$distrito;
        
        $fecha_nacimiento = formatearFechaParaBD($fecha_nacimiento);
    
        $this->Friaje_model->setIdioma_ingles($idioma_ingles);
        $this->Friaje_model->setBrigadistas_banco_id($brigadistas_banco_id);
        $this->Friaje_model->setNumero_cuenta($numero_cuenta);        
        
        if(strlen($id)<1 or strlen($apellidos)<1 or strlen($nombres)<1 or strlen($Tipo_Documento_Codigo)<1
            or strlen($documento_numero)<1 or strlen($genero)<1 or strlen($fecha_nacimiento)<1){
                $data = array(
                    "status" => 500
                );
        }else {
            if($this->Friaje_model->editar()) {     
                $enviar_imagen = $this->input->post("enviar_imagen");
                $foto = $_FILES["file"];
                $dataFoto = $this->editarFoto($id,$foto,$enviar_imagen);
                if($dataFoto["estado"] == 0){
                    $this->Friaje_model->setFoto($dataFoto["foto"]);
                    $this->Friaje_model->agregarFoto();
                }
                $data = array(
                    "status" => 200
                );
                
            } else {
                $data = array(
                    "status" => 500
                );
            }
        }
        echo json_encode($data);
    }
    
    public function agregarFoto($foto)
    {
        $path = getenv('PATH_IMG_BRIGADISTA');
        $estado = 0;
        $imagen = "";
        
        if (filesize($foto["tmp_name"]) > 0) {         
            if ($foto["type"] == "image/jpeg" || $foto["type"] == "image/jpg" || $foto["type"] == "image/png" || $foto["type"] == "image/svg") {
                $name = date("Ymdhis");                
                $data = $foto['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                $imagen = $name . '.' . $ext;
                redim($foto["tmp_name"],$path.$name.'.'.$ext,375,508);                
            } else {
                $estado = - 3;
                $message = ERROR_IMAGEN_FORMATO;
            }
        }else {
            $estado = -1;
        }
        
        return array("estado"=>$estado,"foto"=>$imagen);
        
    }
    
    public function editarFoto($id,$foto,$image)
    {
        $path = getenv('PATH_IMG_BRIGADISTA');
        $estado = 0;
        $imagen = "";              
        
        if (filesize($foto["tmp_name"]) > 0) {           
            
            if ($foto["type"] == "image/jpeg" || $foto["type"] == "image/jpg" || $foto["type"] == "image/png" || $foto["type"] == "image/svg") {
                if(file_exists($path . $image)) unlink($path . $image); 
                
                $name = date("Ymdhis");
                
                $data = $foto['name'];
                $ext = pathinfo($data, PATHINFO_EXTENSION);
                $imagen = $name . '.' . $ext;
                redim($foto["tmp_name"],$path.$name.'.'.$ext,375,508);
                
            } else {
                $estado = - 3;
                $message = ERROR_IMAGEN_FORMATO;
            }
        }else {
            $estado = -1;
        }
        
        return array("estado"=>$estado,"foto"=>$imagen);
        
    }
    
    public function cargarArchivoCertificado($file,$update,$id){
        $path = getenv('PATH_DOC_CERTIFICADO');
        
        if (filesize($file["tmp_name"]) > 0) {
            
            $name = "certificado_".date("Ymdhis");
            $data = $_FILES["file"]['name'];
            $ext = pathinfo($data, PATHINFO_EXTENSION);
            $fullName = $name . '.' . $ext;
            
            $allowedMimeTypes = array("pdf","doc","docx","PDF","DOC","DOCX");
            
            if(in_array( $ext, $allowedMimeTypes ) ){
                
                if (copy($_FILES["file"]["tmp_name"], $path . $fullName)) {
                    
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
    
    private function deleteFile($file){
        $path = getenv('PATH_DOC_CERTIFICADO');
        if(strlen($file)>0){
            unlink($path . $file);
        }        
    }
    
    private function fileName($id){
        $this->load->model("Friaje_model");
        $this->Friaje_model->setId($id);
        $rs = $this->Friaje_model->archivoCertificacion();
        $file = "";
        if($rs->num_rows()>0){
            $archivo = $rs->row();
            $file = $archivo->archivo;
        }
        
        return $file;
    }
    
    public function eliminarCapacitacion() {
        
        $this->load->model("Friaje_model");
        
        $id = $this->input->post("id");
        
        $status = 500;
        $this->Friaje_model->setId($id);
        if($this->Friaje_model->eliminarCapacitacion() == 1 ) $this->session->set_flashdata('messageOK', 'Registro eliminado');
        else { $this->session->set_flashdata('messageError', 'No se puede eliminar'); }
        
        redirect('brigadistas');
        
    }    
        
    public function foto() {
        
        $this->load->model("Friaje_model");
        
        $id = $this->input->post("id");
        
        $this->Friaje_model->setId($id);
        
        $foto = $this->Friaje_model->foto();
        $imagen = "";
        $status = 500;
        if($foto->num_rows()>0) {
            $foto = $foto->row();
            $imagen = $foto->foto;
            $status = 200;
        }
        
        echo json_encode(array("status"=>$status,"imagen"=>$imagen));        
        
    }

    public function curl() {
        
        $tipo_documento = $this->input->post("type");
        $documento = $this->input->post("document");
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, getenv("API_RENIEC_URL").$tipo_documento."/".$documento."/");
        curl_setopt($handler, CURLOPT_HEADER, FALSE);
        curl_setopt($handler, CURLOPT_HTTPHEADER,array("Authorization: ".getenv("API_RENIEC_TOKEN"),"Content-Type: application/json"));
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($handler);
        $code = curl_getinfo ($handler, CURLINFO_HTTP_CODE);
        
        curl_close($handler);
        
        echo $data;
        
    }   
    
}