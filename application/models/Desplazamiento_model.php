<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Desplazamiento_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function obtener()
    {
        $this->db->select("idtipodesplazamiento, descripcion");
        $this->db->from("inventarios_tipo_desplazamiento");
        $this->db->where("estado", "1");
        $this->db->order_by("descripcion ASC");
        return $this->db->get();
    }
}