<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Perfil_model extends CI_Model
{
    private $Codigo_Perfil;
    public function setCodigo_Perfil($data)
    {
        $this->Codigo_Perfil = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Codigo_Perfil,Descripcion_Perfil,Activo");
        $this->db->from("perfil");
        return $this->db->get();
    }
}