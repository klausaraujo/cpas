<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Ejecutora_model extends CI_Model
{
    private $id;
    private $anio;
    private $sector;
    private $pliego;
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
    public function setPliego($data)
    {
        $this->pliego = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Sector,Codigo_Pliego,Codigo_Ejecutora,Secuencia_Ejecutora,Nombre_Ejecutora,Activo");
        $this->db->from("tablero_ejecutora");
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where("Codigo_Sector", $this->sector);
        $this->db->where("Codigo_pliego", $this->pliego);
        return $this->db->get();
    }
    public function seleccionar()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Sector,Codigo_Pliego,Codigo_Ejecutora,Secuencia_Ejecutora,Nombre_Ejecutora,Activo");
        $this->db->from("tablero_ejecutora");
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where("Codigo_Sector", $this->sector);
        $this->db->where("Codigo_pliego", $this->pliego);
        $this->db->where("Codigo_Ejecutora", $this->id);
        return $this->db->get();
    }
}