<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Sector_model extends CI_Model
{
    private $id;
    private $anio;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setAnio($data)
    {
        $this->anio = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Sector,Nombre_Sector,Activo");
        $this->db->from("tablero_sector");
        $this->db->where("Anio_Ejecucion", $this->anio);
        return $this->db->get();
    }
    public function seleccionar()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Sector,Nombre_Sector,Activo");
        $this->db->from("tablero_sector");
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where("Codigo_Sector", $this->id);
        return $this->db->get();
    }
}