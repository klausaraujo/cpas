<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Region_model extends CI_Model
{
    private $Codigo_Region;
    public function setCodigo_Region($data)
    {
        $this->Codigo_Region = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Codigo_Region,Nombre_Region,Activo");
        $this->db->from("region");
        return $this->db->get();
    }
}