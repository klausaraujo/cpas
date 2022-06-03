<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class NivelGravedad_model extends CI_Model
{
    public function lista()
    {
        $this->db->select("Nivel_Gravedad_Codigo,Nivel_Gravedad_Descripcion,Activo");
        $this->db->from("nivel_gravedad");
        return $this->db->get();
    }
}