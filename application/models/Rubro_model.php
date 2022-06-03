<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Rubro_model extends CI_Model
{
    private $anio;
    private $fuenteFinanciamiento;
    public function setAnio($data)
    {
        $this->anio = $this->db->escape_str($data);
    }
    public function setFuenteFinanciamiento($data)
    {
        $this->fuenteFinanciamiento = $this->db->escape_str($data);
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function lista()
    {
        $this->db->select("*");
        $this->db->from("rubro");
        $this->db->where("Anio_Ejecucion", $this->anio);
        $this->db->where("Codigo_FF", $this->fuenteFinanciamiento);
        return $this->db->get();
    }
}