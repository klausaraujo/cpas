<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller
{
    private $permisos = null;

    function __construct()
    {
        parent::__construct();

        $token = $this->session->userdata("token");

        (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY")):redirect("login");

        $this->session->set_userdata("idmodulo", 8);

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
        
        $nivel = 1;
        $idmenu = 12;
        
		$this->load->model("Emergencia_model");
		$this->load->model("AlertaPronostico_model");
		
		$lista = $this->Emergencia_model->listar();
		$listaralerta = $this->AlertaPronostico_model->listaralerta();

	    $data = array(
			"lista" => $lista,
			"listaralerta" => $listaralerta
	    );
		$this->load->view("emergencias/Main", $data);
	}

	public function registrar() {
	    
		$this->load->model("Emergencia_model");
		$this->load->model("AlertaPronostico_model");
    
	    $idEmergencia = $this->input->post("id");
	    $titulo = $this->input->post("titulo");
	    $resolucion = $this->input->post("resolucion");
	    $descripcion = $this->input->post("descripcion");
	    $region_codigos = $this->input->post("region_codigos");
	    $archivo = $_FILES["file"];
	    $region_nombres = $this->input->post("region_nombres");
	    $dgos = ($this->input->post("dgos"))?$this->input->post("dgos"):0;
	    $digerd = ($this->input->post("digerd"))?$this->input->post("digerd"):0;
	    $cdc = ($this->input->post("cdc"))?$this->input->post("cdc"):0;
		$digesa = ($this->input->post("digesa"))?$this->input->post("digesa"):0;
		$listaralerta = $this->AlertaPronostico_model->listaralerta();

	    $this->Emergencia_model->setTitulo($titulo);
	    $this->Emergencia_model->setResolucion($resolucion);
	    $this->Emergencia_model->setDescripcion($descripcion);
	    $this->Emergencia_model->setRegionCodigos($region_codigos);
	    $this->Emergencia_model->setRegionNombres($region_nombres);
	    $this->Emergencia_model->setDgos($dgos);
	    $this->Emergencia_model->setDigerd($digerd);
	    $this->Emergencia_model->setCdc($cdc);
		$this->Emergencia_model->setDigesa($digesa);		
	    
	    if (strlen($titulo)<1 or strlen($resolucion)<1 or strlen($descripcion)<1 or strlen($region_codigos)<1) {
            $data = array(
				"status" => 500,
				"listaralerta" => $listaralerta
            );
	    } else {
	        
	        if ($idEmergencia > 0) {
	            $this->Emergencia_model->setId($idEmergencia);
	            $dataArchivo = $this->agregarArchivo($archivo, true, $idEmergencia);
	            
	            if ($this->Emergencia_model->actualizar()) {
	                if ($dataArchivo["status"] == 0) {
	                    $this->Emergencia_model->setArchivo($dataArchivo["name"]);
	                    $this->Emergencia_model->agregarArchivo();
	                }
	                $data = array(
						"status" => 200,
						"listaralerta" => $listaralerta
	                );
	                
	            } else {
	                $data = array(
						"status" => 500,
						"listaralerta" => $listaralerta
	                );
	            }
	            
	        } else {
	            $dataArchivo = $this->agregarArchivo($archivo, false, 0);
	            
	            $id = $this->Emergencia_model->registrar();
	            
	            if ($id > 0) {
	                if ($dataArchivo["status"] == 0) {
	                    $this->Emergencia_model->setId($id);
	                    $this->Emergencia_model->setArchivo($dataArchivo["name"]);
	                    $this->Emergencia_model->agregarArchivo();
	                }
	                $data = array(
						"status" => 200,
						"listaralerta" => $listaralerta
	                );
	                
	            } else {
	                $data = array(
						"status" => 500,
						"listaralerta" => $listaralerta
	                );
	            }
	            
	        }	        
            
        }
        
        echo json_encode($data);

	}
	
	public function cerrar() {
	    
	    $this->load->model("Emergencia_model");
	    
	    $idEmergencia = $this->input->post("id");
	    $this->Emergencia_model->setEstado(2);
	    $this->Emergencia_model->setId($idEmergencia);
	    $this->Emergencia_model->cerrar();
	    header("location:" . base_url()."emergencias");
	    
	}
	
	public function agregarArchivo($archivo, $update, $id)
	{
	    $path = getenv('PATH_BASE')."emergencias/";
	    $estado = 0;
	    $imagen = "";
	    $name = "";
	    if (filesize($archivo["tmp_name"]) > 0) {
	        
	        if ($archivo["type"] == "application/pdf") {
	            
	            $name = date("Ymdhis");
	            
	            $data = $archivo['name'];
	            $ext = pathinfo($data, PATHINFO_EXTENSION);
	            $name = $name . '.' . $ext;
	            if (copy($archivo["tmp_name"], $path . $name)) {
	                
	                if($update){
	                    $file = $this->fileName($id);
	                    $this->deleteFile($file);
	                }
	                
	            }
	            
	        } else {
	            $estado = - 3;
	            $message = ERROR_IMAGEN_FORMATO;
	        }
	    } else {
	        $estado = -1;
	    }
	    
	    return array("status"=>$estado,"name"=>$name);
	    
	}
	
	private function fileName($id){
	    $this->load->model("Emergencia_model");
	    $this->Emergencia_model->setId($id);
	    $rs = $this->Emergencia_model->archivo();
	    $file = "";
	    if($rs->num_rows()>0){
	        $archivo = $rs->row();
	        $file = $archivo->archivo;
	    }
	    
	    return $file;
	}
	
	private function deleteFile($file){
	    $path = getenv('PATH_BASE')."emergencias/";
	    if(strlen($file)>0){
	        unlink($path . $file);
	    }
	    
	}
}