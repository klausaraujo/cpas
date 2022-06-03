<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

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
                if ($row->idmodulo == 4 and $row->estado == 1)
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
        $this->load->view("metas/Main");
    }

    public function mapa1()
    {
        $this->load->view("metas/mapa1");
    }

    public function mapa2()
    {
        $this->load->view("metas/mapa2");
    }

    public function mapa3()
    {
        $this->load->view("metas/mapa3");
    }

    public function mapa4()
    {
        $this->load->view("formas2");
    }
}