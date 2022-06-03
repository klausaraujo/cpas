<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class ProgramaPresupuestal_model extends CI_Model
{
    private $anio;
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
        $this->db->select("Anio_Ejecucion,Codigo_Programa_Presupuestal,Nombre_Programa_Presupuestal,Activo");
        $this->db->from("tablero_programa_presupuestal");
        $this->db->where("Anio_Ejecucion", $this->anio);
        return $this->db->get();
    }
}