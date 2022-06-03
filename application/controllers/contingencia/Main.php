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
        
        $this->session->set_userdata("idmodulo", 15);
        
        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");
        
        if(sha1($usuario)==$token->usuario){
            
            if (count($token->modulos)>0) {
                
                $listaModulos = $token->modulos;
                
                $permanecer = false;
                
                foreach ($listaModulos as $row) :
                    if ($row->idmodulo == 15 and $row->estado == 1) {
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
        $idmenu = 15;

        validarPermisos($nivel,$idmenu,$this->permisos);

        $this->load->model("Friaje_model");
        $this->load->model("AnioEjecucion_model");
        $this->load->model("AlertaPronostico_model");
        $this->load->model("Contingencia_model");

        $anio = $this->input->post("Anio");
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $listarTipevento = $this->Contingencia_model->listarTipevento();
        $listarInstitucion = $this->Contingencia_model->listarInstitucion();
        $listarRegion = $this->Contingencia_model->listarRegion();
        $listarDISA = $this->Contingencia_model->listarDISA();
        $listarRed = $this->Contingencia_model->listarRed();
        $listarMicroRed = $this->Contingencia_model->listarMicroRed();
        $listarIPRESS = $this->Contingencia_model->listarIPRESS();
        $listarPlanesContingencia = $this->Contingencia_model->listarPlanesContingencia();
        $listarCuestionario = $this->Contingencia_model->listarCuestionario();

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
            "listaralerta" => $listaralerta,
            "listarTipevento" => $listarTipevento,
            "listarInstitucion" => $listarInstitucion,
            "listarRegion" => $listarRegion,
            "listarDISA" => $listarDISA,
            "listarRed" => $listarRed,
            "listarMicroRed" => $listarMicroRed,
            "listarIPRESS" => $listarIPRESS,
            "listarPlanesContingencia" => $listarPlanesContingencia,
            "listarCuestionario" => $listarCuestionario
        );
        
        $this->load->view("contingencia/Main",$data);
    }
    
    public function cargarDISA()
    {

        $this->load->model("Contingencia_model");

        $codigo_region = $this->input->post("codigo_region");

        $data = array();

        $this->Contingencia_model->setCodigo_region($codigo_region);
        $rsLista = $this->Contingencia_model->listarDISA();

        if ($rsLista->num_rows() > 0) {
            $data = $rsLista->result();
        }

        echo json_encode($data);

    }

    public function cargarRed()
    {

        $this->load->model("Contingencia_model");

        $codigo_disa = $this->input->post("codigo_disa");

        $data = array();

        $this->Contingencia_model->setCodigo_disa($codigo_disa);
        $rsLista = $this->Contingencia_model->listarRed();

        if ($rsLista->num_rows() > 0) {
            $data = $rsLista->result();
        }

        echo json_encode($data);

    }

    public function cargarMicroRed()
    {

        $this->load->model("Contingencia_model");

        $codigo_red = $this->input->post("codigo_red");
        $codigo_disa = $this->input->post("codigo_disa");

        $data = array();

        $this->Contingencia_model->setCodigo_red($codigo_red);
        $this->Contingencia_model->setCodigo_disa($codigo_disa);
        $rsLista = $this->Contingencia_model->listarMicroRed();

        if ($rsLista->num_rows() > 0) {
            $data = $rsLista->result();
        }

        echo json_encode($data);

    }

    public function cargarIPRESS()
    {

        $this->load->model("Contingencia_model");

        $codigo_institucion = $this->input->post("codigo_institucion");
        $codigo_region = $this->input->post("codigo_region");
        $codigo_disa = $this->input->post("codigo_disa");
        $codigo_red = $this->input->post("codigo_red");
        $codigo_micro_red = $this->input->post("codigo_micro_red");

        $data = array();

        $this->Contingencia_model->setCodigo_institucion($codigo_institucion);
        $this->Contingencia_model->setCodigo_region($codigo_region);
        $this->Contingencia_model->setCodigo_disa($codigo_disa);
        $this->Contingencia_model->setCodigo_red($codigo_red);
        $this->Contingencia_model->setCodigo_micro_red($codigo_micro_red);
        $rsLista = $this->Contingencia_model->listarIPRESS();

        if ($rsLista->num_rows() > 0) {
            $data = $rsLista->result();
        }

        echo json_encode($data);

    }

    public function cargarPeligros()
    {

        $this->load->model("Contingencia_model");

        if($this->input->post("idnat") != NULL){
        $contingencias_peligros_id_natural = $this->input->post("idnat");}
        else{
        $contingencias_peligros_id_natural = $this->input->post("origen");}
        $data = array();

        $this->Contingencia_model->setContingencias_peligros_id_natural($contingencias_peligros_id_natural);
        $rsLista = $this->Contingencia_model->listarPeligros();

        if ($rsLista->num_rows() > 0) {
            $data = $rsLista->result();
        }

        echo json_encode($data);

    }

    public function cargarPeligrosDetalle()
    {

        $this->load->model("Contingencia_model");

        $contingencias_peligros_detalle_items_id_natural = $this->input->post("codigo_peligro");

        $data = array();

        $this->Contingencia_model->setContingencias_peligros_detalle_items_id_natural($contingencias_peligros_detalle_items_id_natural);
        $rsLista = $this->Contingencia_model->listarPeligrosItems();

        if ($rsLista->num_rows() > 0) {
            $data = $rsLista->result();
        }

        echo json_encode($data);

    }

    public function registrar() {
        
        $this->load->model("Contingencia_model");
        
        $origen = $this->input->post("tipoAtencion");

        $titulo = $this->input->post("titulo");
        $resolplan = $this->input->post("resolplan");
        $fecha_publicacion = $this->input->post("fecha_publicacion");
        $presupuesto = $this->input->post("presupuesto");
        $calificacion = $this->input->post("calificacion");
        $estado = $this->input->post("estado");
        
        $codigo_region = $this->input->post("codigo_region");
        $codigo_disa = $this->input->post("codigo_disa");
        $codigo_red = $this->input->post("codigo_red");
        $idevento = $this->input->post("idevento");
        $codigo_institucion = $this->input->post("codigo_institucion");
        $codigo_micro_red = $this->input->post("codigo_micro_red");
        $codigo_renipress = $this->input->post("codigo_renipress");
        
        if($origen==1){
        $contingencias_peligros_id_natural = $this->input->post("tipoAtencion");            
        $contingencias_peligros_detalle_id_natural = $this->input->post("contingencias_peligros_detalle_id_natural");
        $contingencias_peligros_detalle_items_id_natural = $this->input->post("contingencias_peligros_detalle_items_id_natural");
        }
        else if($origen==2){
        $contingencias_peligros_id_antropico = $this->input->post("tipoAtencion");
        $contingencias_peligros_detalle_id_antropico = $this->input->post("contingencias_peligros_detalle_id_antropico");
        $contingencias_peligros_detalle_items_id_antropico = $this->input->post("contingencias_peligros_detalle_items_id_antropico");
        }
        $fecha_publicacion = formatearFechaParaBD($fecha_publicacion).' 00:00:00';
        $this->Contingencia_model->setTitulo($titulo);
        $this->Contingencia_model->setResolPlan($resolplan);
        $this->Contingencia_model->setFecha_publicacion($fecha_publicacion);
        $this->Contingencia_model->setPresupuesto($presupuesto);
        $this->Contingencia_model->setContingencias_peligros_id_natural($contingencias_peligros_id_natural);
        $this->Contingencia_model->setContingencias_peligros_id_antropico($contingencias_peligros_id_antropico);
        $this->Contingencia_model->setCalificacion($calificacion);
        $this->Contingencia_model->setEstado($estado);
        $this->Contingencia_model->setCodigo_region($codigo_region);
        $this->Contingencia_model->setCodigo_disa($codigo_disa);
        $this->Contingencia_model->setCodigo_red($codigo_red);
        $this->Contingencia_model->setIdevento($idevento);
        $this->Contingencia_model->setCodigo_institucion($codigo_institucion);
        $this->Contingencia_model->setCodigo_micro_red($codigo_micro_red);
        $this->Contingencia_model->setCodigo_renipress($codigo_renipress);
        $this->Contingencia_model->setContingencias_peligros_detalle_id_natural($contingencias_peligros_detalle_id_natural);
        $this->Contingencia_model->setContingencias_peligros_detalle_items_id_natural($contingencias_peligros_detalle_items_id_natural);
        $this->Contingencia_model->setContingencias_peligros_detalle_id_antropico($contingencias_peligros_detalle_id_antropico);
        $this->Contingencia_model->setContingencias_peligros_detalle_items_id_antropico($contingencias_peligros_detalle_items_id_antropico);             
        $filer = false;
        $filep = false;
        
        console.log($_FILES["file"]["tmp_name"]);
        
        if (filesize($_FILES["file"]["tmp_name"]) > 0) {
            $filer = $this->cargarArchivoResolucion($_FILES["file"], false, 0);
        }

        if ($filer == false) {
            $filer = "";
        }

        $this->Contingencia_model->setResolucion_file($filer);

        if (filesize($_FILES["filep"]["tmp_name"]) > 0) {
            $filep = $this->cargarArchivoPlan($_FILES["filep"], false, 0);
        }

        if ($filep == false) {
            $filep = "";
        }

        $this->Contingencia_model->setPlan_file($filep);

        if ($this->Contingencia_model->registrar() == 1) {
            $this->session->set_flashdata('flashdata', 'Plan registrado con exito');
        } else {
            $this->session->set_flashdata('flashdata', 'No se pudo registrar el plan');
        }
       header("location:" . base_url() . "contingencia/main");
    }

    public function actualizar() {
        
        $this->load->model("Contingencia_model");
        
        $origen = $this->input->post("tipoAtencionU");

        $id = $this->input->post("id");
        $titulo = $this->input->post("titulo");
        $resolplan = $this->input->post("resolplan");
        $fecha_publicacion = $this->input->post("fecha_publicacion");
        $presupuesto = $this->input->post("presupuesto");
        $calificacion = $this->input->post("calificacion");
        $estado = $this->input->post("estado");
        
        $codigo_region = $this->input->post("codigo_region");
        $codigo_disa = $this->input->post("codigo_disa");
        $codigo_red = $this->input->post("codigo_red");
        $idevento = $this->input->post("idevento");
        $codigo_institucion = $this->input->post("codigo_institucion");
        $codigo_micro_red = $this->input->post("codigo_micro_red");
        $codigo_renipress = $this->input->post("codigo_renipress");
        
        if($origen==1){
        $contingencias_peligros_id_natural = $this->input->post("tipoAtencionU");            
        $contingencias_peligros_detalle_id_natural = $this->input->post("contingencias_peligros_detalle_id_natural");
        $contingencias_peligros_detalle_items_id_natural = $this->input->post("contingencias_peligros_detalle_items_id_natural");
        $this->Contingencia_model->setContingencias_peligros_detalle_id_natural($contingencias_peligros_detalle_id_natural);
        $this->Contingencia_model->setContingencias_peligros_detalle_items_id_natural($contingencias_peligros_detalle_items_id_natural);
        $this->Contingencia_model->setContingencias_peligros_id_natural($contingencias_peligros_id_natural);
        }
        else if($origen==2){
        $contingencias_peligros_id_antropico = $this->input->post("tipoAtencionU");
        $contingencias_peligros_detalle_id_antropico = $this->input->post("contingencias_peligros_detalle_id_antropico");
        $contingencias_peligros_detalle_items_id_antropico = $this->input->post("contingencias_peligros_detalle_items_id_antropico");
        $this->Contingencia_model->setContingencias_peligros_detalle_id_antropico($contingencias_peligros_detalle_id_antropico);
        $this->Contingencia_model->setContingencias_peligros_detalle_items_id_antropico($contingencias_peligros_detalle_items_id_antropico);
        $this->Contingencia_model->setContingencias_peligros_id_antropico($contingencias_peligros_id_antropico);
        }
        $fecha_publicacion = formatearFechaParaBD($fecha_publicacion).' 00:00:00';
        $this->Contingencia_model->setId($id);
        $this->Contingencia_model->setTitulo($titulo);
        $this->Contingencia_model->setResolPlan($resolplan);
        $this->Contingencia_model->setFecha_publicacion($fecha_publicacion);
        $this->Contingencia_model->setPresupuesto($presupuesto);
        $this->Contingencia_model->setCalificacion($calificacion);
        $this->Contingencia_model->setEstado($estado);
        $this->Contingencia_model->setCodigo_region($codigo_region);
        $this->Contingencia_model->setCodigo_disa($codigo_disa);
        $this->Contingencia_model->setCodigo_red($codigo_red);
        $this->Contingencia_model->setIdevento($idevento);
        $this->Contingencia_model->setCodigo_institucion($codigo_institucion);
        $this->Contingencia_model->setCodigo_micro_red($codigo_micro_red);
        $this->Contingencia_model->setCodigo_renipress($codigo_renipress);

        $filer = false;
        $filep = false;
        
        $filer = "";
        if (filesize($_FILES["file"]["tmp_name"]) > 0) {
            $filer = $this->cargarArchivoResolucion($_FILES["file"], true, $id);
        }
        if ($filer == false) {$filer = "";}
        if (strlen($filer) > 1) {
            $this->Contingencia_model->setResolucion_file($filer);
            $this->TableroControl_model->actualizarArchivoR();
        }    
        
        $filep = "";
        if (filesize($_FILES["filep"]["tmp_name"]) > 0) {
            $filep = $this->cargarArchivoPlan($_FILES["filep"], true, $id);
        }
        if ($filep == false) {$filep = "";}               
        if (strlen($filep) > 1) {
            $this->Contingencia_model->setPlan_file($filep);
            $this->TableroControl_model->actualizarArchivoP();
        }

        if ($this->Contingencia_model->actualizar() == 1) {
            $this->session->set_flashdata('flashdata', 'Plan actualizado con exito');
        } else {
            $this->session->set_flashdata('flashdata', 'No se pudo actualizar el plan');
        }
       header("location:" . base_url() . "contingencia/main");
    }

    public function cargarArchivoResolucion($file, $update, $id)
    {
        $path = getenv('PATH_DOC_RESOLUCIONES');

        if (filesize($file["tmp_name"]) > 0) {

            $name = "resolucion_" . date("Ymdhis");
            $data = $_FILES["file"]['name'];
            $ext = pathinfo($data, PATHINFO_EXTENSION);
            $fullName = $name . '.' . $ext;

            $allowedMimeTypes = array("pdf", "doc", "docx", "PDF", "DOC", "DOCX");

            if (in_array($ext, $allowedMimeTypes)) {

                if (copy($_FILES["file"]["tmp_name"], $path . $fullName)) {

                    if ($update) {
                        $file = $this->fileName($id);
                        $this->deleteFile($file);
                    }

                    return $fullName;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    private function fileName($id)
    {
        $this->load->model("Contingencia_model");
        $this->Contingencia_model->setContingencias_registro_id($id);
        $rs = $this->Contingencia_model->archivoResolucion();
        $file = "";
        if ($rs->num_rows() > 0) {
            $archivo = $rs->row();
            $file = $archivo->resolucion_file;
        }

        return $file;
    }

    private function deleteFile($file)
    {
        $path = getenv('PATH_DOC_RESOLUCIONES');
        if (strlen($file) > 0) {
            unlink($path . $file);
        }

    }

    public function cargarArchivoPlan($file, $update, $id)
    {
        $path = getenv('PATH_DOC_PLANES');

        if (filesize($file["tmp_name"]) > 0) {

            $name = "plan_" . date("Ymdhis");
            $data = $_FILES["filep"]['name'];
            $ext = pathinfo($data, PATHINFO_EXTENSION);
            $fullName = $name . '.' . $ext;

            $allowedMimeTypes = array("pdf", "doc", "docx", "PDF", "DOC", "DOCX");

            if (in_array($ext, $allowedMimeTypes)) {

                if (copy($_FILES["filep"]["tmp_name"], $path . $fullName)) {

                    if ($update) {
                        $file = $this->fileName1($id);
                        $this->deleteFile1($file);
                    }

                    return $fullName;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    private function fileName1($id)
    {
        $this->load->model("Contingencia_model");
        $this->Contingencia_model->setContingencias_registro_id($id);
        $rs = $this->Contingencia_model->archivoPlan();
        $file = "";
        if ($rs->num_rows() > 0) {
            $archivo = $rs->row();
            $file = $archivo->plan_file;
        }

        return $file;
    }

    private function deleteFile1($file)
    {
        $path = getenv('PATH_DOC_PLANES');
        if (strlen($file) > 0) {
            unlink($path . $file);
        }

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

    public function registrarcuestionario() {
        
        $this->load->model("Contingencia_model");
        for($i=1;$i<=36;$i++){
            $idregistroplan = $this->input->post("idregistroplan");
            $cuestionarioid = $i;
            $cuestionariorespuesta = $this->input->post("codigo_pregunta_".$i);
            $cuestionariocomentario = $this->input->post("comentario_pregunta_".$i);
            if($cuestionariorespuesta==1){
                    $calificacion+=$this->input->post("valoracion_pregunta_".$i);
            }

        $this->Contingencia_model->setContingencias_registro_id($idregistroplan);
        $this->Contingencia_model->setContingencias_estructura_cuestionario_id($cuestionarioid);
        $this->Contingencia_model->setContingencias_registro_evaluacion_respuesta($cuestionariorespuesta);
        $this->Contingencia_model->setContingencias_registro_evaluacion_comentarios($cuestionariocomentario);
        $this->Contingencia_model->setContingencias_registro_evaluacion_comentarios($cuestionariocomentario);    
        $this->Contingencia_model->registrarcuestionario();
        if($i==36)
        {
            $this->Contingencia_model->setCalificacion($calificacion);
            $this->Contingencia_model->actualizarnota();
            $this->session->set_flashdata('flashdata', 'Plan registrado con exito');
        }

     }
       header("location:" . base_url() . "contingencia/main");
    }
    
}