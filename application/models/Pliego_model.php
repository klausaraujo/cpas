<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Pliego_model extends CI_Model
{
    private $id;
    private $anio;
    private $sector;
    public function setId($data)
    {
        $this->id = $this->db->escape_str($data);
    }
    public function setAnio($data)
    {
        $this->anio = $this->db->escape_str($data);
    }
    public function setSector($data)
    {
        $this->sector = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Sector,Codigo_Pliego,Nombre_Pliego,Activo");
        $this->db->from("tablero_pliego");
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where("Codigo_Sector", $this->sector);
        return $this->db->get();
    }
    public function seleccionar()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Sector,Codigo_Pliego,Nombre_Pliego,Activo");
        $this->db->from("tablero_pliego");
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where("Codigo_Sector", $this->sector);
        $this->db->where("Codigo_Pliego", $this->id);
        return $this->db->get();
    }
}