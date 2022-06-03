<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Atencion extends CI_Controller
{
    private $permisos = null;

    function __construct()
    {
        parent::__construct();

        $token = $this->session->userdata("token");
        
        (strlen($token)>0)?$token = JWT::decode($token,getenv("SECRET_SERVER_KEY")):redirect("login");

        $this->session->set_userdata("idmodulo", 10);

        ($this->session->userdata("idusuario"))?$usuario=$this->session->userdata("idusuario"):redirect("login");

        if(sha1($usuario)==$token->usuario){

            if (count($token->modulos)>0) {

                $listaModulos = $token->modulos;

                $permanecer = false;

                foreach ($listaModulos as $row) :
                if ($row->idmodulo == 10 and $row->estado == 1)
                    $permanecer = true;
                    endforeach;

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
    
    public function index()
    {
        
        
        
    }
    
}
