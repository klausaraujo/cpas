<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class FarmaciaPresentacion_model extends CI_Model
{
    private $idViaAdministracion;
    public function setId($data){
        $this->idViaAdministracion= $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function obtenerLista()
    {
        $this->db->select("idpresentacion id, descripcion");
        $this->db->from("farmacia_presentacion");
        $this->db->where("idviaadministracion", $this->idViaAdministracion);
        $this->db->where("estado", 1);
        $this->db->order_by("descripcion ASC");
        return $this->db->get();
    }
}