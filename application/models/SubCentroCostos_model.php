<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class SubCentroCostos_model extends CI_Model
{
    private $id;
    private $anio;
    private $sector;
    private $pliego;
    private $ejecutora;
    private $centroCostos;
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
    public function setEjecutora($data)
    {
        $this->ejecutora = $this->db->escape_str($data);
    }
    public function setCentroCostos($data)
    {
        $this->centroCostos = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Anio_Ejecucion, Codigo_Sector, Codigo_Pliego, Codigo_Ejecutora, Codigo_Centro_Costos, Codigo_Sub_Centro_Costos, Nombre_Sub_Centro_Costos, Abreviatura, Activo");
        $this->db->from("tablero_sub_centro_costos");
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where("Codigo_Sector", $this->sector);
        $this->db->where("Codigo_pliego", $this->pliego);
        $this->db->where("Codigo_ejecutora", $this->ejecutora);
        $this->db->where("Codigo_Centro_Costos", $this->centroCostos);
        return $this->db->get();
    }
    public function seleccionar()
    {
        $this->db->select("Anio_Ejecucion, Codigo_Sector, Codigo_Pliego, Codigo_Ejecutora, Codigo_Centro_Costos, Codigo_Sub_Centro_Costos, Nombre_Sub_Centro_Costos, Abreviatura, Activo");
        $this->db->from("tablero_sub_centro_costos");
        $this->db->where("Anio_Ejecucion", $this->$this->anio);
        $this->db->where("Codigo_Sector", $this->sector);
        $this->db->where("Codigo_pliego", $this->pliego);
        $this->db->where("Codigo_ejecutora", $this->ejecutora);
        $this->db->where("Codigo_Ejecutora", $this->id);
        $this->db->where("Codigo_Centro_Costos", $this->centroCostos);
        return $this->db->get();
    }
}