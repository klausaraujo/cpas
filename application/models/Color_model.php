<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Color_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerLista()
    {
        $this->db->select("idcolor, descripcion");
        $this->db->from("inventarios_color");
        $this->db->where("estado", 1);
        $this->db->order_by("descripcion ASC");
        return $this->db->get();
    }
}