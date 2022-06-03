<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Indicador extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $token = $this->session->userdata("token");

        (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY")):redirect("login");

        $this->session->set_userdata("idmodulo", 3);

        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");

        if(sha1($usuario)==$token->usuario){

            if (count($token->modulos)>0) {

                $listaModulos = $token->modulos;

                $permanecer = false;

                foreach ($listaModulos as $row) :
                if ($row->idmodulo == 3 and $row->estado == 1)
                    $permanecer = true;
                    endforeach
                    ;

                    if ($permanecer == false)
                        redirect('errores/accesoDenegado');
            } else {
                redirect("login");
            }

        }else{
            redirect("login");
        }
    }

    public function index()
    {

        $this->load->model("AnioEjecucion_model");
        $this->load->model("Indicador_model");
        $this->load->model("Dimension_model");
        $this->load->model("AlertaPronostico_model");

        $anio = $this->input->post("Anio");
        $listaAnioEjecucion = $this->AnioEjecucion_model->lista();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();
        $rsListaDimension = $this->Dimension_model->listar();

        if(empty($anio) or strlen($anio)<1) {
          $rsListaAnioEjecucion = $listaAnioEjecucion->first_row();
          $anio = $rsListaAnioEjecucion->Anio_Ejecucion;
        }

        $this->Indicador_model->setAnioEjecucion($anio);

        $lista = $this->Indicador_model->lista();

        $data = array(
            "listaAnioEjecucion" => $listaAnioEjecucion,
            "listaDimension" => $rsListaDimension,
            "anio" => $anio,
            "lista" => $lista,
            "listaralerta" => $listaralerta
        );

        $this->load->view("tablero/gestionarIndicador", $data);
    }

    public function registrar()
    {
        $this->load->model("Indicador_model");

        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $IdDimension = $this->input->post("IdDimension");
        $Formula = $this->input->post("Formula");
        $Justificacion = $this->input->post("Justificacion");
        $Nombre_Indicador = $this->input->post("Nombre_Indicador");
        $Comentarios = $this->input->post("Comentarios");
        $Activo = $this->input->post("Activo");
        
        $archivo=false;
        
        if(filesize($_FILES["file"]["tmp_name"])>0) $archivo = $this->cargarArchivoIndicador($_FILES["file"],false,0);
        if($archivo==false) $archivo = "";

        $this->Indicador_model->setAnioEjecucion($Anio_Ejecucion);
        $this->Indicador_model->setIdDimension($IdDimension);
        $this->Indicador_model->setFormula($Formula);
        $this->Indicador_model->setJustificacion($Justificacion);
        $this->Indicador_model->setNombre_Indicador($Nombre_Indicador);
        $this->Indicador_model->setComentarios($Comentarios);
        $this->Indicador_model->setFicha_Tecnica($archivo);
        $this->Indicador_model->setActivo($Activo);

        if ($this->Indicador_model->registrar()) {
            $this->session->set_flashdata('mensajeSuccess', 'Registro exitoso');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se completo la operaci&oacute;n, verifique nuevamente');
        }

        header('location:' . base_url() . 'tablero/indicador');
    }

    public function actualizar()
    {
        $this->load->model("Indicador_model");

        $this->load->model("Indicador_model");
        
        $id = $this->input->post("id");
        $Anio_Ejecucion = $this->input->post("Anio_Ejecucion");
        $IdDimension = $this->input->post("IdDimension");
        $Formula = $this->input->post("Formula");
        $Justificacion = $this->input->post("Justificacion");
        $Nombre_Indicador = $this->input->post("Nombre_Indicador");
        $Comentarios = $this->input->post("Comentarios");
        $Activo = $this->input->post("Activo");
        
        $this->Indicador_model->setId($id);
        $this->Indicador_model->setAnioEjecucion($Anio_Ejecucion);
        $this->Indicador_model->setIdDimension($IdDimension);
        $this->Indicador_model->setFormula($Formula);
        $this->Indicador_model->setJustificacion($Justificacion);
        $this->Indicador_model->setNombre_Indicador($Nombre_Indicador);
        $this->Indicador_model->setComentarios($Comentarios);
        
        $this->Indicador_model->setActivo($Activo);        
        
        $archivo=false;
        
        if(filesize($_FILES["file"]["tmp_name"])>0) $archivo = $this->cargarArchivoIndicador($_FILES["file"],true,$id);
        if($archivo==false) $archivo = "";
        
        if(strlen($archivo)>0)
        {
            $this->Indicador_model->setFicha_Tecnica($archivo);
            $this->Indicador_model->actualizarFicha_Tecnica();
        }

        if ($this->Indicador_model->actualizar() > 0) {
            $this->session->set_flashdata('mensajeSuccess', 'Actualizaci&oacute;n exitosa');
        } else {
            $this->session->set_flashdata('mensajeError', 'No se completo la operaci&oacute;n, verifique nuevamente');
        }

        header('location:' . base_url() . 'tablero/indicador');
    }

    public function eliminar()
    {
        $this->load->model("Indicador_model");
        $this->load->model("TableroControl_model");
        $this->load->model("IndicadorActividadPOI_model");

        $id = $this->input->post("id");
        
        $this->TableroControl_model->setCodigo_Indicador($id);
        $this->IndicadorActividadPOI_model->setIdindicador($id);

        $result = $this->TableroControl_model->buscarPorIndicador();
        $resultI = $this->IndicadorActividadPOI_model->existePorIndetificador();
        
        if ($result->num_rows() > 0 or $resultI->num_rows() > 0) {
            $this->session->set_flashdata('mensajeWarning', 'No se completo la operaci&oacute;n, el indicador se usa en tablero o actividad POI');
        } else {
            $this->Indicador_model->setId($id);
            $file = $this->fileName($id);
            if($this->Indicador_model->eliminar()==1){
                $this->deleteFile($file);
                $this->session->set_flashdata('mensajeSuccess', 'Eliminaci&oacute;n exitosa');
            }else{
                $this->session->set_flashdata('mensajeError', 'No se pudo eliminar el indicador');
            }
        }

        header('location:' . base_url() . 'tablero/indicador');
    }
    
    public function cargarArchivoIndicador($file,$update,$id){
        $path = getenv('PATH_DOC_INDICADOR');
        
        if (filesize($file["tmp_name"]) > 0) {
            
            $name = "indicador_".date("Ymdhis");
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
    
    private function fileName($id){
        $this->load->model("Indicador_model");
        $this->Indicador_model->setId($id);
        $rs = $this->Indicador_model->fichaTecnica();
        $file = "";
        if($rs->num_rows()>0){
            $archivo = $rs->row();
            $file = $archivo->Ficha_Tecnica;
        }
        
        return $file;
    }
    
    private function deleteFile($file){
        $path = getenv('PATH_DOC_INDICADOR');
        if(strlen($file)>0){
            unlink($path . $file);
        }
        
    }
}
