<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class IndicadorActividadPOI_model extends CI_Model
{
    private $id;
    private $Id_Actividad_POI;
    private $anio_ejecucion;
    private $idindicador;
    public function setId($data){$this->id = $this->db->escape_str($data);}
    public function setAnio($data){$this->anio_ejecucion = $this->db->escape_str($data);}
    public function setId_Actividad_POI($data){$this->Id_Actividad_POI = $this->db->escape_str($data);}
    public function setIdindicador($data){$this->idindicador = $this->db->escape_str($data);}
    public function __construct()
    {
        parent::__construct();
    }
    public function existePorIndetificador()
    {
        $this->db->select("1");
        $this->db->from("tablero_indicador_actividad_poi");
        $this->db->where("idindicador", $this->idindicador);
        return $this->db->get();
    }
}