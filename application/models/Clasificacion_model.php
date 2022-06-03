<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Clasificacion_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerLista()
    {
        $this->db->select("idclasificacion, descripcion");
        $this->db->from("inventarios_clasificacion");
        $this->db->where("estado", 1);
        $this->db->order_by("descripcion ASC");
        return $this->db->get();
    }

}