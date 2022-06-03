<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Main extends CI_Controller
{

    private $_permisos = null;

    function __construct()
    {
        parent::__construct();
        
        $token = $this->session->userdata("token");
        
        (strlen($token)>0)?$token = JWT::decode($token, getenv("SECRET_SERVER_KEY")):redirect("login");
        
        $this->session->set_userdata("idmodulo", 17);
        
        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");
        
        if (sha1($usuario)==$token->usuario) {

            if (count($token->modulos)>0) {

                $listaModulos = $token->modulos;
                
                $permanecer = false;

                foreach ($listaModulos as $row) :
                    if ($row->idmodulo == 17 and $row->estado == 1) {
                        $permanecer = true;
                    }
                endforeach;

                if ($permanecer == false) {
                    redirect('errores/accesoDenegado');
                }

            } else {
                redirect("login");
            }
            
            if ($this->_permisos==null) { 
                if ($this->session->userdata("menu")) {
                    $this->_permisos = $this->session->userdata("menu");
                }
            }
            
        } else {
            redirect("login");
        }
    }

    public function index()
    {
        
        $nivel = 1;
        $idmenu = 7;
        
        validarPermisos($nivel, $idmenu, $this->_permisos);
        
        $this->load->model("Tramite_model");
        $this->load->model("AlertaPronostico_model");
        
        $lista = $this->Tramite_model->listarTramites();
        $listaprocedencia = $this->Tramite_model->listarProcedencia();
        $listaralerta = $this->AlertaPronostico_model->listaralerta();

        $data = array(
            "lista" => json_encode($lista->result()),
            "listaralerta" => $listaralerta,
            "listaprocedencia" => $listaprocedencia->result()
        );
        
        $this->load->view("tramite/Main", $data);
    }
    
}