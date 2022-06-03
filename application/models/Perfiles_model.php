<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Perfiles_model extends CI_Model
{
    private $Codigo_Perfil;
    private $Descripcion_Perfil; 

    public function setCodigo_Perfil($data) {
        $this->Codigo_Perfil = $this->db->escape_str($data);
    }
    public function setDescripcion_Perfil($data) {
        $this->Descripcion_Perfil = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function listar()
    {
        $this->db->select("Codigo_Perfil,Descripcion_Perfil,Activo");
        $this->db->from("perfil");
        $this->db->where("Activo","1");        
        return $this->db->get();
    }   
    public function lista()
    {
        $this->db->select("Codigo_Perfil,Descripcion_Perfil,Activo");
        $this->db->from("perfil");
        return $this->db->get();
    }
    public function obtenerCodigoMayor() {
        $this->db->select("MAX(CAST(Codigo_Perfil AS UNSIGNED)) codigo");
        $this->db->from("perfil");
        $rs = $this->db->get();
        return $rs->row()->codigo;
    }   
    public function crear() {
        $data = array(
            "Codigo_Perfil" => $this->Codigo_Perfil,
            "Descripcion_Perfil" => $this->Descripcion_Perfil
        );
        if($this->db->insert("perfil", $data)) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function editar() {
        $this->db->set("Descripcion_Perfil", $this->Descripcion_Perfil, TRUE);
        $this->db->where("Codigo_Perfil", $this->Codigo_Perfil);       
        if ($this->db->update('perfil')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function eliminar() {
        $this->db->db_debug = FALSE;
        $this->db->where("Codigo_Perfil", $this->Codigo_Perfil);
        if ($this->db->delete('perfil')) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function moduloPorPerfil() {
        $this->db->select("COUNT(1) total");
        $this->db->from("modulo_rol");
        $this->db->where("Codigo_Perfil", $this->Codigo_Perfil);
        return $this->db->get();
    }    

    public function listarmodulos()
    {
        $this->db->select("mo.*");
        $this->db->from("modulo mo");   
        return $this->db->get();
    } 
}