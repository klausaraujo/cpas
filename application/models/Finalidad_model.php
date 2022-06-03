<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Finalidad_model extends CI_Model
{
    private $Anio_Ejecucion;
    public function setAnio_Ejecucion($data)
    {
        $this->Anio_Ejecucion = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("Anio_Ejecucion,Codigo_Finalidad,Nombre_Finalidad,Activo");
        $this->db->from("tablero_finalidad");
        $this->db->where("Anio_Ejecucion", $this->Anio_Ejecucion);
        $this->db->where("Activo", "1");
        return $this->db->get();
    }
}