<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class FarmaciaViaAdministracion_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerLista()
    {
        $this->db->select("idviaadministracion id, descripcion");
        $this->db->from("farmacia_via_administracion");
        $this->db->where("estado", 1);
        $this->db->order_by("descripcion ASC");
        return $this->db->get();
    }
}