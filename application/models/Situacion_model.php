<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Situacion_model extends CI_Model
{
    public function lista()
    {
        $this->db->select("Situacion_Codigo,Situacion_Descripcion,Activo");
        $this->db->from("situacion");
        return $this->db->get();
    }
}