<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class FarmaciaCategoria_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerLista()
    {
        $this->db->select("idcategoria id, descripcion, abreviatura");
        $this->db->from("farmacia_categoria");
        $this->db->where("estado", 1);
        $this->db->order_by("descripcion ASC");
        return $this->db->get();
    }
}