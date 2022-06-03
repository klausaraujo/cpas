<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class AnioEjecucion_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Anio_Ejecucion,Activo");
        $this->db->from("anio_ejecucion");
        $this->db->order_by("Anio_Ejecucion","DESC");
        return $this->db->get();
    }
    public function obtenerAnioPredeterminado()
    {
        $this->db->select("Anio_Ejecucion,Activo");
        $this->db->from("anio_ejecucion");
        $this->db->where("Predeterminado","1");
        return $this->db->get();
    }
    public function obtenerMes()
    {
        $this->db->select("MONTH(CURRENT_DATE()) resultado");
        return $this->db->get();
    }
}